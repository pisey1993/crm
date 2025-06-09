<?php
session_start(); // ⬅️ First line, no whitespace above it
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once '../config/db.php';
require_once '../models/ClaimsOnline.php';

//require_once '../config/db.php';
//require_once '../models/ClaimsOnline.php';

$claimModel = new ClaimModel($connection);
$id = $_GET['id'] ?? null;
echo $id;
if (!$id || !is_numeric($id)) {
    die("Invalid claim ID.");
}

$claim = $claimModel->getClaimById((int)$id);

if (!$claim) {
    die("Claim record not found.");
}

function safeEcho($val) {
    return htmlspecialchars((string)$val);
}

$uploadDir = __DIR__ . "/../uploads/claims/" . $id . "/";
//$uploadUrl = "/crm/uploads/claims/" . $id . "/";
$uploadUrl = "client/uploads/claims/" . $id . "/";
$files = [];
echo $uploadUrl;
if (is_dir($uploadDir)) {
    $allFiles = scandir($uploadDir);
    foreach ($allFiles as $file) {
        if ($file === '.' || $file === '..') continue;
        if (is_file($uploadDir . $file)) {
            $files[] = $file;
        }
    }
}

function renderCardItem($label, $value) {
    if ($value !== null && $value !== '') {
        ?>
        <div class="col-md-4 mb-3">
            <div class="card-body p-4">
                <h6 class="card-title text-muted text-sm font-semibold mb-1"><?php echo safeEcho($label); ?></h6>
                <p class="card-text text-gray-800 text-base font-medium break-words"><?php echo safeEcho($value); ?></p>
            </div>
        </div>
        <?php
    }
}
?>

<?php include '../layouts/header.php'; ?>

<div class="container mb-5 mt-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center sm:text-left">Claim Details</h1>

    <div class="row" style="background-color: #fff">
        <?php
        $commonFields = [
            'ID' => 'id',
            'Policy Type' => 'policy_type',
            'Claim Type' => 'claim_type',
            'Policy Number' => 'policy_number',
            'Insured Name' => 'insured_name',
            'Insured Contact' => 'insured_contact',
            'Contact Number' => 'contact_number',
            'Claim Amount' => 'claim_amount',
            'Reason for Claim' => 'reason_for_claim',
        ];

        $autoFields = [
            'Driver Name' => 'driver_name',
            'Driver Contact' => 'driver_contact',
            'Driver License' => 'driver_license',
            'Vehicle Registration Number' => 'vehicle_registration_number',
            'Vehicle Location' => 'vehicle_location',
            'Vehicle Registration Card' => 'vehicle_registration_card',
            'Vehicle Road Tax' => 'vehicle_road_tax',
            'Repair Estimate' => 'repair_estimate',
            'Original Vehicle Keys' => 'original_vehicle_keys',
            'Theft Complaint Letter' => 'theft_complaint_letter',
            'Police Report' => 'police_report',
            'Incident Date' => 'incident_date',
            'Incident Location' => 'incident_location',
            'Incident Description' => 'incident_description',
            'Vehicle Details' => 'vehicle_details',
        ];

        $healthcareFields = [
            'Patient Name' => 'patient_name',
            'Patient DOB' => 'patient_dob',
            'Relationship to Insured' => 'relationship_to_insured',
            'Diagnosis' => 'diagnosis',
            'Treatment Date' => 'treatment_date',
            'Hospital Name' => 'hospital_name',
            'Hospital Type' => 'hospital_type',
            'Attending Physician' => 'attending_physician',
            'Benefit Schedule' => 'benefit_schedule',
            'Lab Results' => 'lab_results',
            'Echo Result' => 'echo_result',
            'Xray Result' => 'xray_result',
            'Discharge Summary' => 'discharge_summary',
            'Medical Report' => 'medical_report',
            'Medical Certificate' => 'medical_certificate',
            'Medical Expense Form' => 'medical_expense_form',
            'Medical Bills' => 'medical_bills',
            'Prescription' => 'prescription',
            'Hospital Invoice' => 'hospital_invoice',
            'Reimbursement Due Date' => 'reimbursement_due_date',
            'Reimbursement Status' => 'reimbursement_status',
            'Health Details' => 'health_details',
        ];

        $finalFields = [
            'Claim Status' => 'claim_status',
            'Notes' => 'notes',
            'Created At' => 'created_at',
            'Updated At' => 'updated_at',
        ];

        $allFields = array_merge($commonFields, []);
        if (strtolower($claim['policy_type']) === 'auto') {
            $allFields = array_merge($allFields, $autoFields);
        } elseif (strtolower($claim['policy_type']) === 'healthcare') {
            $allFields = array_merge($allFields, $healthcareFields);
        }
        $allFields = array_merge($allFields, $finalFields);

        foreach ($allFields as $label => $key) {
            if (isset($claim[$key])) {
                renderCardItem($label, $claim[$key]);
            }
        }
        ?>
    </div>

    <hr class="my-4"/>
    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center sm:text-left">Uploaded Files</h2>

    <?php if (count($files) > 0): ?>
<!--
        <?php

        echo $id;
// Local server path to the folder
        $folderPath = $_SERVER['DOCUMENT_ROOT'] . "/public/portal/client/uploads/claims/$id/";

// Public URL to access files
        $publicUrlPath = "https://peoplenpartners.com/public/portal/client/uploads/claims/$id/";

        if (is_dir($folderPath)) {
            $files = scandir($folderPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];

                    if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                        $fileUrl = $publicUrlPath . $file;
                        echo "<img src=\"$fileUrl\" alt=\"Uploaded Image\" style=\"max-width: 200px; margin: 10px;\">";
                    }
                }
            }
        } else {
            echo "Folder not found: $folderPath";
        }
        ?>
<br>
<br>
<br>
        <a href="https://peoplenpartners.com/public/portal/client/uploads/claims/<?php echo $id; ?>/"
           class="btn btn-primary"
           target="_blank"
           rel="noopener noreferrer">
            View Uploaded Files
        </a>

        <script>
            const files = <?php echo json_encode($files); ?>;
            const uploadUrl = <?php echo json_encode($uploadUrl); ?>;

            // Bootstrap Modal instance
            let imageModal = null;
            let carousel = null;

            document.addEventListener('DOMContentLoaded', () => {
                const modalEl = document.getElementById('imageModal');
                imageModal = new bootstrap.Modal(modalEl);
                carousel = bootstrap.Carousel.getOrCreateInstance(document.getElementById('modalCarousel'), {
                    interval: false,
                    ride: false
                });
            });

            function openModalCarousel(index) {
                if (carousel) {
                    carousel.to(index);
                }
                if (imageModal) {
                    imageModal.show();
                }
            }

            function downloadAllImages() {
                files.forEach(file => {
                    const ext = file.split('.').pop().toLowerCase();
                    if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(ext)) {
                        const a = document.createElement('a');
                        a.href = uploadUrl + encodeURIComponent(file);
                        a.download = file;
                        a.style.display = 'none';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    }
                });
            }
        </script>

    <?php else: ?>
        <p class="text-muted text-center"><em>No uploaded files found for this claim.</em></p>
    <?php endif; ?>
</div>

<?php include '../layouts/footer.php'; ?>
