<?php include '../layouts/header.php' ?>

<div class="content" style="background-color:#f5f5f5">
    <div class="container py-4">
        <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your insurance quote request has been submitted. We will contact you shortly.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <h1 class="h4 fw-bold text-dark mb-1">Request Insurance Quote</h1>
            <p class="text-muted">សូមជ្រើសរើសប្រភេទផលិតផល និងបំពេញព័ត៌មាន (Please select a product type and fill in the form)</p>
        </div>

        <div class="card shadow-sm p-4 rounded-4">
            <form action="controllers/submit-quote.php" method="POST">

                <!-- Select Product Type -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">ជ្រើសរើសផលិតផល (Select Product Type)</label>
                    <select id="product_type" name="product_type" class="form-select" onchange="toggleFields()" required>
                        <option value="" disabled selected>-- Select Insurance Product --</option>
                        <option value="auto">Auto Insurance</option>
                        <option value="health">Health Insurance</option>
                        <option value="travel">Travel Insurance</option>
                        <option value="home">Home Insurance</option>
                        <option value="business">Business Insurance</option>
                        <option value="motorcycle">Motorcycle Insurance</option>
                        <option value="marine">Marine Insurance</option>
                        <option value="personal_accident">Personal Accident Insurance</option>
                        <option value="other">Other Insurance</option>
                    </select>
                </div>

                <!-- Customer Name (common field, label changes for auto or other) -->
                <div class="mb-3">
                    <label class="form-label fw-semibold" id="customer_name_label">ឈ្មោះអតិថិជន (Customer Name)</label>
                    <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="បញ្ចូលឈ្មោះរបស់អ្នក (Input your name)" required>
                </div>

                <!-- Auto-specific fields -->
                <div id="auto_fields" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">ជ្រើសរើសប្រភេទយាន្តយន្ត (Select type of Vehicle)</label>
                        <select name="vehicle_type" class="form-select">
                            <option value="">-- ជ្រើសរើស --</option>
                            <option value="car">Car</option>
                            <option value="motorbike">Motorbike</option>
                            <option value="truck">Truck</option>
                            <option value="van">Van</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">ម៉ាក/ម៉ូដែលនៃយាន្តយន្ត (Model of Vehicle)</label>
                        <input type="text" name="vehicle_model" class="form-control" placeholder="សូមបញ្ចូលម៉ាក/ម៉ូដែល">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">តម្លៃយាន្តយន្ត (Price of Vehicle)</label>
                        <input type="number" name="vehicle_price" class="form-control" placeholder="បញ្ចូលតម្លៃយាន្តយន្ត" step="0.01" min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">ស្លាកលេខយាន្តយន្ត (Vehicle License Plates)</label>
                        <input type="text" name="vehicle_plate" class="form-control" placeholder="បញ្ចូលស្លាកលេខយាន្តយន្ត">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">កម្លាំងម៉ាសុីន (Engine Power)</label>
                        <input type="text" name="engine_power" class="form-control" placeholder="បញ្ចូលកម្លាំងម៉ាសុីន">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">ចំនួនកៅអីអ្នករួមដំណើរ (Passenger Seat Count)</label>
                        <input type="number" name="seat_count" class="form-control" placeholder="បញ្ចូលចំនួនកៅអី" min="0">
                    </div>
                </div>

                <!-- Common contact fields -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">លេខទូរសព្ទ័ (Phone Number)</label>
                    <input type="tel" name="phone" class="form-control" placeholder="012345678" pattern="[0-9]{8,10}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">អ៊ីម៉ែល (Email)</label>
                    <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">ព័ត៌មានបន្ថែម (Additional Information)</label>
                    <textarea name="additional_info" rows="4" class="form-control" placeholder="សូមបញ្ចូលព័ត៌មានបន្ថែម..."></textarea>
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-send"></i> Submit Request
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
    function setFieldsDisabled(disabled) {
        // Get all form inputs except the product_type select
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.id === 'product_type') {
                input.disabled = false; // always enabled
            } else {
                input.disabled = disabled;
            }
        });
    }

    function toggleFields() {
        const productType = document.getElementById('product_type').value;
        const autoFields = document.getElementById('auto_fields');
        const customerNameLabel = document.getElementById('customer_name_label');
        const customerNameInput = document.getElementById('customer_name');

        if (productType) {
            // Enable fields
            setFieldsDisabled(false);

            if (productType === 'auto') {
                autoFields.style.display = 'block';
                customerNameLabel.innerText = 'ឈ្មោះអតិថិជន (Customer Name)';
                customerNameInput.name = 'customer_name';
                customerNameInput.placeholder = 'បញ្ចូលឈ្មោះរបស់អ្នក (Input your name)';
            } else {
                autoFields.style.display = 'none';
                customerNameLabel.innerText = 'ឈ្មោះអតិថិជន (Customer Name)';
                customerNameInput.name = 'other_customer_name';
                customerNameInput.placeholder = 'បញ្ចូលឈ្មោះរបស់អ្នក (Input your name)';
            }
        } else {
            // No product type selected, disable all except dropdown
            setFieldsDisabled(true);
            autoFields.style.display = 'none';
        }
    }

    // Run on page load to disable fields if product type not selected
    window.addEventListener('DOMContentLoaded', () => {
        const productType = document.getElementById('product_type').value;
        if (!productType) {
            setFieldsDisabled(true);
            document.getElementById('auto_fields').style.display = 'none';
        }
    });
</script>


<?php include '../layouts/footer.php' ?>
