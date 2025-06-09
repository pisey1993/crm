<?php
// Define base upload directory (not ID-specific yet)
$uploadBase = '../uploads/claims/';

require_once '../config/db.php';
require_once '../models/ClaimsOnline.php';

$claimModel = new ClaimModel($connection);

// Collect form fields (excluding file fields for now)
$data = [
    'policy_type' => $_POST['policy_type'] ?? '',
    'claim_type' => $_POST['claim_type'] ?? '',
    'policy_number' => $_POST['policy_number'] ?? '',
    'insured_name' => $_POST['insured_name'] ?? '',
    'insured_contact' => $_POST['contact_number'] ?? '',
    'contact_number' => $_POST['contact_number'] ?? '',
    'claim_amount' => $_POST['claim_amount'] ?? '',
    'reason_for_claim' => $_POST['reason_for_claim'] ?? '',
    // Additional fields for vehicle claims
    'driver_name' => $_POST['driver_name'] ?? '',
    'driver_contact' => $_POST['driver_contact'] ?? '',
    'vehicle_registration_number' => $_POST['vehicle_registration_number'] ?? '',
    'vehicle_location' => $_POST['vehicle_location'] ?? '',
    'incident_date' => $_POST['incident_date'] ?? '',
    'incident_location' => $_POST['incident_location'] ?? '',
    'incident_description' => $_POST['incident_description'] ?? '',
    // Additional fields for health claims
    'patient_name' => $_POST['patient_name'] ?? '',
    'patient_dob' => $_POST['patient_dob'] ?? '',
    'relationship_to_insured' => $_POST['relationship_to_insured'] ?? '',
    'diagnosis' => $_POST['diagnosis'] ?? '',
    'treatment_date' => $_POST['treatment_date'] ?? '',
    'hospital_name' => $_POST['hospital_name'] ?? '',
    'hospital_type' => $_POST['hospital_type'] ?? '',
    'claim_status' => $_POST['claim_status'] ?? '',
    'notes' => $_POST['notes'] ?? '',
    'vehicle_details' => $_POST['vehicle_details'] ?? '',
    'health_details' => $_POST['health_details'] ?? '',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
];

// Validate required fields
$requiredFields = ['policy_type', 'claim_type', 'policy_number'];
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        die("Error: The field '$field' is required.");
    }
}

// Insert into DB first
$success = $claimModel->insertClaim($data);
$insertedId = mysqli_insert_id($connection);

// Define upload fields
$fileFields = [
    'driver_license', 'claim_form', 'insured_id_card', 'insurance_card', 'employee_card',
    'vehicle_registration_card', 'theft_complaint_letter', 'police_report', 'death_certificate',
    'lab_results', 'echo_result', 'xray_result', 'discharge_summary', 'medical_report',
    'medical_certificate', 'medical_expense_form', 'medical_bills', 'prescription', 'hospital_invoice'
];

// Function to send message to Telegram
function sendTelegramMessage($token, $chatId, $message) {
    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    $postFields = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML' // allows basic HTML formatting
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

// Now upload files if insert was successful
if ($success && $insertedId) {
    $uploadDir = $uploadBase . $insertedId . '/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileUpdates = [];
    foreach ($fileFields as $field) {
        if (
            isset($_FILES[$field]) &&
            is_array($_FILES[$field]) &&
            $_FILES[$field]['error'] === UPLOAD_ERR_OK &&
            !empty($_FILES[$field]['name'])
        ) {
            $tmpPath = $_FILES[$field]['tmp_name'];
            $originalName = basename($_FILES[$field]['name']);
            $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $safeExtension = preg_replace('/[^a-zA-Z0-9]/', '', $fileExtension);
            $newFileName = uniqid($field . '_', true) . '.' . $safeExtension;
            $destination = $uploadDir . $newFileName;

            if (move_uploaded_file($tmpPath, $destination)) {
                $fileUpdates[$field] = $newFileName;
            }
        }
    }

    // Update the claim record with uploaded filenames
    if (!empty($fileUpdates)) {
        $claimModel->updateClaimFiles($insertedId, $fileUpdates);
    }

    // Prepare message for Telegram
    $message = "<b>New Claim Submitted!</b>\n";
    $message .= "ID: {$insertedId}\n";
    $message .= "Policy Type: " . htmlspecialchars($data['policy_type']) . "\n";
    $message .= "Claim Type: " . htmlspecialchars($data['claim_type']) . "\n";
    $message .= "Policy Number: " . htmlspecialchars($data['policy_number']) . "\n";
    $message .= "Insured Name: " . htmlspecialchars($data['insured_name']) . "\n";
    $message .= "Insured Contact: " . htmlspecialchars($data['insured_contact']) . "\n";
    $message .= "Contact Number: " . htmlspecialchars($data['contact_number']) . "\n";
    $message .= "Claim Amount: " . htmlspecialchars($data['claim_amount']) . "\n";
    $message .= "Reason for Claim: " . htmlspecialchars($data['reason_for_claim']) . "\n";
    $message .= "Plate Number: " . htmlspecialchars($data['vehicle_registration_number']) . "\n";
    $message .= "Patient Name: " . htmlspecialchars($data['patient_name']) . "\n";
// Add claim view link

    $message .= "\n\n📎 Please click the link below to view full info and documents:\n";
    //$message .= "http://localhost/crm/view-claims?id={$insertedId}";
    $message .= "https://peoplenpartners.com/public/portal/client/view-claims?id={$insertedId}";

    // Your Telegram bot credentials
    $telegramToken = "1728711438:AAEwG-o5dqHGAeBy6bf3Z-uCLwEtNBUwh7g";
    $telegramChatId = "-1001738293636";

    // Send message to Telegram
    sendTelegramMessage($telegramToken, $telegramChatId, $message);
}

include "../layouts/header.php";
?>

<div class="content">
    <div class="bg-white py-4 shadow-sm border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="w-100">
                    <?php if ($success): ?>
                        <div id="claim-summary">
                            <h3 class="h4 fw-bold text-success mb-4">Claim Submitted Successfully!</h3>
                            <h4 class="h4 fw-bold text-danger mb-4">
                                Please download the submitted ticket for later tracking.
                            </h4>
                            <button id="download-summary" class="btn btn-success mt-3">Download</button>

                            <table class="table table-bordered mt-4">
                                <thead class="table-light">
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td><?php echo htmlspecialchars($insertedId); ?></td>
                                </tr>
                                <tr>
                                    <td>Policy Type</td>
                                    <td><?php echo htmlspecialchars($data['policy_type']); ?></td>
                                </tr>
                                <tr>
                                    <td>Claim Type</td>
                                    <td><?php echo htmlspecialchars($data['claim_type']); ?></td>
                                </tr>
                                <tr>
                                    <td>Policy Number</td>
                                    <td><?php echo htmlspecialchars($data['policy_number']); ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Name</td>
                                    <td><?php echo htmlspecialchars($data['insured_name']); ?></td>
                                </tr>
                                <tr>
                                    <td>Insured Contact</td>
                                    <td><?php echo htmlspecialchars($data['insured_contact']); ?></td>
                                </tr>
                                <tr>
                                    <td>Contact Number</td>
                                    <td><?php echo htmlspecialchars($data['contact_number']); ?></td>
                                </tr>
                                <tr>
                                    <td>Claim Amount</td>
                                    <td><?php echo htmlspecialchars($data['claim_amount']); ?></td>
                                </tr>
                                <tr>
                                    <td>Reason for Claim</td>
                                    <td><?php echo htmlspecialchars($data['reason_for_claim']); ?></td>
                                </tr>
                                <tr>
                                    <td>Plate Number</td>
                                    <td><?php echo htmlspecialchars($data['vehicle_registration_number']); ?></td>
                                </tr>
                                <tr>
                                    <td>Patient Name</td>
                                    <td><?php echo htmlspecialchars($data['patient_name']); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="../claims_online.php" class="btn btn-primary mt-3">Submit Another Claim</a>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            Failed to insert claim. Error: <?php echo mysqli_error($connection); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.getElementById("download-summary").addEventListener("click", function () {
        html2canvas(document.getElementById("claim-summary")).then(canvas => {
            const link = document.createElement("a");
            link.download = "claim-summary.png";
            link.href = canvas.toDataURL("image/png");
            link.click();
        });
    });
</script>

<?php include "../layouts/footer.php"; ?>
