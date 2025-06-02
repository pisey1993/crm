<?php
$title = 'crm';
include '../layouts/header.php';

$claimFormsDir = 'uploads/resource/claim-forms/';

$claimForms = [
    ['name' => 'Auto Claim Form', 'file' => 'auto-claim-form.pdf'],
    ['name' => 'Healthcare Claim Form', 'file' => 'healthcare-claim-form.pdf'],
];
?>

<div class="container py-5">


            <h2 class="mb-3"><i class="bi bi-file-earmark-arrow-down text-primary me-2"></i>Download Claim Forms</h2>
            <p class="text-muted">Please preview or download the claim forms below. These documents are provided in PDF format.</p>



    <div class="list-group list-group-flush shadow-sm rounded-4 overflow-hidden">
        <?php foreach ($claimForms as $form):
            $filePath = $claimFormsDir . $form['file'];
            ?>
            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-pdf-fill fs-4 text-danger me-3"></i>
                    <span class="fw-semibold fs-5"><?php echo htmlspecialchars($form['name']); ?></span>
                </div>
                <div class="btn-group">
                    <button
                            class="btn btn-outline-info btn-sm"
                            onclick="previewPdf('<?php echo htmlspecialchars($filePath); ?>', '<?php echo htmlspecialchars($form['name']); ?>')"
                    >
                        <i class="bi bi-eye me-1"></i> Preview
                    </button>
                    <a
                            href="<?php echo htmlspecialchars($filePath); ?>"
                            class="btn btn-outline-primary btn-sm"
                            target="_blank"
                            download
                    >
                        <i class="bi bi-download me-1"></i> Download
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- PDF Preview Modal -->
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90vw;">
        <div class="modal-content" style="height: 90vh;">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfPreviewLabel">PDF Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe
                        id="pdfPreviewFrame"
                        src=""
                        style="width: 100%; height: 100%; border: none;"
                        frameborder="0"
                ></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    function previewPdf(fileUrl, title) {
        document.getElementById('pdfPreviewLabel').textContent = title;
        document.getElementById('pdfPreviewFrame').src = fileUrl;

        const pdfModal = new bootstrap.Modal(document.getElementById('pdfPreviewModal'));
        pdfModal.show();
    }
</script>

<?php include '../layouts/footer.php'; ?>
