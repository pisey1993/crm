<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['insured_id_card'])) {
    $target_dir = "../uploads/claims/";
    $fileName = basename($_FILES["insured_id_card"]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Allowed file types
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'docx'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only JPG, PNG, JPEG, GIF, PDF & DOCX files are allowed.<br>";
        $uploadOk = 0;
    }

    // File size limit
    if ($_FILES["insured_id_card"]["size"] > 5000000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["insured_id_card"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "No file was uploaded.";
}
?>
