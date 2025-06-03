</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebarCollapse");
    const content = document.querySelector(".content");
    const sidebarWidth = 260;

    const toggleBtn = document.querySelector(".navbar-toggler");

    if (sidebar && content && toggleBtn) {
        // Set initial state based on screen size
        if (window.innerWidth > 992) {
            sidebar.classList.add("show");
            content.style.marginLeft = sidebarWidth + "px";
        } else {
            sidebar.classList.remove("show");
            content.style.marginLeft = "0px";
        }

        // Toggle sidebar on button click (only on small screens)
        toggleBtn.addEventListener("click", () => {
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle("show");
                if (sidebar.classList.contains("show")) {
                    content.classList.add("sidebar-visible");
                    content.style.marginLeft = sidebarWidth + "px";
                } else {
                    content.classList.remove("sidebar-visible");
                    content.style.marginLeft = "0px";
                }
            }
        });

        // Reset layout on resize
        window.addEventListener("resize", () => {
            if (window.innerWidth > 992) {
                sidebar.classList.add("show");
                content.style.marginLeft = sidebarWidth + "px";
                content.classList.remove("sidebar-visible");
            } else {
                sidebar.classList.remove("show");
                content.style.marginLeft = "0px";
                content.classList.remove("sidebar-visible");
            }
        });
    }
});


//Next Button

document.addEventListener('DOMContentLoaded', function() {
    const tabs = Array.from(document.querySelectorAll('#myTab .nav-link'));
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');

    function activateTab(index) {
        if (index < 0 || index >= tabs.length) return;

        const targetTab = tabs[index];
        const tabInstance = new bootstrap.Tab(targetTab);
        tabInstance.show();

        updateButtonVisibility(index);
    }

    function getCurrentTabIndex() {
        return tabs.findIndex(tab => tab.classList.contains('active'));
    }

    function updateButtonVisibility(index) {
        // Hide "Previous" button on the first tab
        prevBtn.style.display = index === 0 ? 'none' : 'inline-block';

        // Reference to the checkbox
        var check = document.getElementById('confirmcheck');

        // Show "Submit" button on the last tab, hide "Next" button
        if (index === tabs.length - 1) {
            nextBtn.style.display = 'none';

            if (check && check.checked) {
                submitBtn.style.display = 'inline-block';
            } else {
                submitBtn.style.display = 'none';
            }

            // Optionally, listen for changes to dynamically show/hide the Submit button
            check.addEventListener('change', function() {
                submitBtn.style.display = check.checked ? 'inline-block' : 'none';
            });

        } else {
            nextBtn.style.display = 'inline-block';
            submitBtn.style.display = 'none';
        }
    }


    nextBtn.addEventListener('click', () => {
        const currentIndex = getCurrentTabIndex();
        activateTab(currentIndex + 1);

    });

    prevBtn.addEventListener('click', () => {
        const currentIndex = getCurrentTabIndex();
        activateTab(currentIndex - 1);
    });

    // Initialize on page load
    updateButtonVisibility(getCurrentTabIndex());
    document.getElementById('nextBtn').style.display = 'none';
});








// Function to update the displayed file name for file inputs
function updateFileName(inputId) {
    const input = document.getElementById(inputId);
    const fileNameSpan = document.getElementById(inputId + '_name');
    if (input.files.length > 0) {
        fileNameSpan.textContent = input.files[0].name;
    } else {
        fileNameSpan.textContent = 'No file chosen';
    }
}

// Function to toggle visibility of document sections based on policy type
function toggleDocumentSections() {
    const policyType = document.getElementById('policy_type').value;
    const autoDocsSection = document.getElementById('auto_documents_section');
    const healthcareDocsSection = document.getElementById('healthcare_documents_section');
    const driverDetailsSection = document.getElementById('driver_details_section');
    const vehicleDetailsSection = document.getElementById('vehicle_details_section');
    const patientHealthDetailsSection = document.getElementById('patient_health_details_section');

    // Hide all specific sections first
    autoDocsSection.style.display = 'none';
    healthcareDocsSection.style.display = 'none';
    driverDetailsSection.style.display = 'none';
    vehicleDetailsSection.style.display = 'none';
    patientHealthDetailsSection.style.display = 'none';


    // Show sections based on selected policy type
    if (policyType === 'Auto') {
        autoDocsSection.style.display = 'block';
        driverDetailsSection.style.display = 'block';
        vehicleDetailsSection.style.display = 'block';
    } else if (policyType === 'Healthcare') {
        healthcareDocsSection.style.display = 'block';
        patientHealthDetailsSection.style.display = 'block';
    }
}






// Next Previous Step Functionality
document.addEventListener('DOMContentLoaded', toggleDocumentSections);
const steps = document.querySelectorAll('.form-section');
const sidebarSteps = document.querySelectorAll('.sidebar .step');
let currentStep = 0;

function showStep(index) {
    steps.forEach((step, i) => {
        step.classList.toggle('active', i === index);
    });

    sidebarSteps.forEach((step, i) => {
        step.classList.remove('active', 'done');
        step.querySelector('i').className = 'bi bi-circle-fill';
        if (i < index) {
            step.classList.add('done');
            step.querySelector('i').className = 'bi bi-check-circle-fill';
        } else if (i === index) {
            step.classList.add('active');
        }
    });

    currentStep = index;
}

document.querySelectorAll('.next-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
            showStep(currentStep + 1);
        }
    });
});

document.querySelectorAll('.prev-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        if (currentStep > 0) {
            showStep(currentStep - 1);
        }
    });
});

document.getElementById('multiStepForm').addEventListener('submit', e => {
    e.preventDefault();
    alert('Form submitted!');
});

showStep(currentStep);

//Select Product
function myFunction(buttonId) {
    const policySelect = document.getElementById('policy_type');

    const policy = document.getElementById('policy');

    if (buttonId === 'btn_auto') {
        policySelect.value = 'Auto';
    } else if (buttonId === 'btn_chc') {
        policySelect.value = 'Healthcare';

    }
    document.getElementById('btn_auto').style.display = 'none';
    document.getElementById('btn_chc').style.display = 'none';

    // Trigger the onchange event manually if needed
    policySelect.dispatchEvent(new Event('change'));
    policy.style.display = 'block'; // or 'inline-block' for better alignment


   const form = document.getElementById('myForm');
const resultDiv = document.getElementById('result');
const resultInput = document.getElementById('policystatus');
const submitButton = form.querySelector('button[type="submit"]');
const policyNumberCheck = document.getElementById('policy_number_check');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    // Save original text and show loading
    const originalText = submitButton.textContent;
    submitButton.textContent = 'Verifying...';
    submitButton.disabled = true;

    const formData = new FormData(form);

    fetch('controllers/getdata.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            resultInput.value = data.status_code;
            resultDiv.textContent = data.message;

            if (data.status_code === 1 || data.status_code === "1") {
                document.getElementById('myTabContent').style.display = 'block';
                document.getElementById('pcheck').style.display = 'block';
                document.getElementById('policy').style.display = 'none';
                document.getElementById('policy_number').value = policyNumberCheck.value;
                document.getElementById('nextBtn').style.display = 'block';
            } else {
                document.getElementById('myTabContent').style.display = 'none';
            }
        })
        .catch(error => {
            resultDiv.textContent = 'Error: ' + error.message;
            resultInput.value = 'Error';
        })
        .finally(() => {
            // Restore button state
            submitButton.textContent = originalText;
            submitButton.disabled = false;
        });
});

}
</script>

<!--<hr>-->
<!--<p>&copy; -->

<!-- PPI CRM</p>-->
</body>

</html>