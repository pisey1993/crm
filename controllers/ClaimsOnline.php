<?php
require_once '../config/db.php'; // Database connection
require_once '../models/ClaimsOnline.php'; // ClaimModel class

$claimModel = new ClaimModel($connection);

// Collect all fields, default to empty string if not posted
$data = [
    'policy_type' => $_POST['policy_type'] ?? '',
    'claim_type' => $_POST['claim_type'] ?? '',
    'policy_number' => $_POST['policy_number'] ?? '',
    'insured_name' => $_POST['insured_name'] ?? '',
    'insured_contact' => $_POST['contact_number'] ?? '',
    'contact_number' => $_POST['contact_number'] ?? '',

    'claim_amount' => $_POST['claim_amount'] ?? '',
    'reason_for_claim' => $_POST['reason_for_claim'] ?? '',
    'driver_name' => $_POST['driver_name'] ?? '',
    'driver_contact' => $_POST['driver_contact'] ?? '',

    'vehicle_registration_number' => $_POST['vehicle_registration_number'] ?? '',
    'vehicle_location' => $_POST['vehicle_location'] ?? '',
    'incident_date' => $_POST['incident_date'] ?? '',
    'incident_location' => $_POST['incident_location'] ?? '',
    'incident_description' => $_POST['incident_description'] ?? '',
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

//file upload
    'driver_license' => $_POST['driver_license'] ?? '',
    'claim_form' => $_POST['claim_form'] ?? '',
    'insured_id_card' => $_POST['insured_id_card'] ?? '',
    'insurance_card' => $_POST['insurance_card'] ?? '',
    'employee_card' => $_POST['employee_card'] ?? '',
    'vehicle_registration_card' => $_POST['vehicle_registration_card'] ?? '',
    'theft_complaint_letter' => $_POST['theft_complaint_letter'] ?? '',
    'police_report' => $_POST['police_report'] ?? '',
    'death_certificate' => $_POST['death_certificate'] ?? '',
    'lab_results' => $_POST['lab_results'] ?? '',
    'echo_result' => $_POST['echo_result'] ?? '',
    'xray_result' => $_POST['xray_result'] ?? '',
    'discharge_summary' => $_POST['discharge_summary'] ?? '',
    'medical_report' => $_POST['medical_report'] ?? '',
    'medical_certificate' => $_POST['medical_certificate'] ?? '',
    'medical_expense_form' => $_POST['medical_expense_form'] ?? '',
    'medical_bills' => $_POST['medical_bills'] ?? '',
    'prescription' => $_POST['prescription'] ?? '',
    'hospital_invoice' => $_POST['hospital_invoice'] ?? '',


];

// Define which fields are required (adjust this list as needed)
$requiredFields = [
    'policy_type', 'claim_type', 'policy_number', 'insured_name', 'insured_contact', 'created_at', 'updated_at'
];

// Validate required fields
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        die("Error: The field '$field' is required.");
    }
}

// Insert data
$success = $claimModel->insertClaim($data);
$insertedId = mysqli_insert_id($connection); // Get last inserted ID

include "../layouts/header.php";

if ($success):
    ?>
    <div class="content">
        <div class="bg-white py-4 shadow-sm border-bottom">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="w-100">
                        <div id="claim-summary">
                            <h3 class="h4 fw-bold text-success mb-4">Claim Submitted Successfully!</h3>
                            <h4 class="h4 fw-bold text-danger mb-4">
                                Please download the submitted ticket for later search or tracking your claim process.
                                Thanks!
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
                                </tbody>
                            </table>
                        </div>

                        <a href="../views/claims_online.php" class="btn btn-primary mt-3">Submit Another Claim</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Load html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        document.getElementById("download-summary").addEventListener("click", function () {
            const element = document.getElementById("claim-summary");

            html2canvas(element).then(canvas => {
                const link = document.createElement("a");
                link.download = "claim-summary.png";
                link.href = canvas.toDataURL("image/png");
                link.click();
            });
        });
    </script>

<?php
else:
    ?>
    <div class="alert alert-danger">
        Failed to insert claim. Error: <?php echo mysqli_error($connection); ?>
    </div>
<?php
endif;

include "../layouts/footer.php";
?>
