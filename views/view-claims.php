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
        <div class="row g-3">
            <?php foreach ($files as $index => $file):
                $filePath = $uploadUrl . rawurlencode($file);
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                ?>
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="card h-100 shadow-sm rounded-lg">
                        <div class="d-flex flex-column h-100">
                            <?php if ($isImage): ?>
                                <a href="javascript:void(0);"
                                   onclick="openModalCarousel(<?php echo $index; ?>)"
                                   title="<?php echo safeEcho($file); ?>"
                                   class="d-block flex-grow-1">
                                    <img src="<?php echo $filePath; ?>" alt="<?php echo safeEcho($file); ?>"
                                         class="card-img-top uploaded-img w-full h-32 object-cover rounded-t-lg"
                                         onerror="this.onerror=null; this.src='https://placehold.co/150x100/CCCCCC/333333?text=Image+Error';"/>
                                </a>
                            <?php else: ?>
                                <div class="card-body d-flex align-items-center justify-content-center flex-grow-1 bg-gray-100 rounded-t-lg"
                                     style="min-height:150px;">
                                    <a href="<?php echo $filePath; ?>" target="_blank" rel="noopener"
                                       class="stretched-link text-truncate text-center text-gray-400 text-6xl"
                                       title="<?php echo safeEcho($file); ?>" style="display:block; width:100%;">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="card-footer bg-white text-center text-sm text-gray-700 font-medium py-2 px-1 break-words rounded-b-lg">
                                <?php echo safeEcho($file); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Modal for Carousel -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div id="modalCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                            <div class="carousel-inner">
                                <?php foreach ($files as $idx => $file):
                                    $filePath = $uploadUrl . rawurlencode($file);
                                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                    if (!$isImage) continue;
                                    ?>
                                    <div class="carousel-item <?php echo $idx === 0 ? 'active' : ''; ?>">
                                        <img src="<?php echo $filePath; ?>" class="d-block w-100" alt="<?php echo safeEcho($file); ?>"
                                             onerror="this.onerror=null; this.src='https://placehold.co/800x400/CCCCCC/333333?text=Image+Error';" />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#modalCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#modalCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Download All Button -->
<!--        <div class="text-center mt-4">-->
<!--            <button class="btn btn-primary" onclick="downloadAllImages()">Download All Images</button>-->
<!--        </div>-->
        <a href="https://peoplenpartners.com/public/portal/client/uploads/claims/66/"
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
