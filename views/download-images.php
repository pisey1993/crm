<?php
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    die("Invalid claim ID.");
}

$uploadDir = __DIR__ . "/../uploads/claims/" . $id . "/";
if (!is_dir($uploadDir)) {
    die("No uploads found.");
}

$zipFilename = "claim_{$id}_images.zip";
$zipFilePath = sys_get_temp_dir() . '/' . $zipFilename;

$zip = new ZipArchive();
if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
    die("Could not create ZIP file.");
}

$imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
$files = scandir($uploadDir);
foreach ($files as $file) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, $imageExtensions)) {
        $filePath = $uploadDir . $file;
        if (is_file($filePath)) {
            $zip->addFile($filePath, $file);
        }
    }
}
$zip->close();

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
header('Content-Length: ' . filesize($zipFilePath));
readfile($zipFilePath);
unlink($zipFilePath);
exit;
