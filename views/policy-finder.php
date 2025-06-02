<?php include '../layouts/header.php' ?>

<div class="content" style="background-color:#f5f5f5">
    <div class="container py-4">
        <div class="mb-4">
            <h1 class="h4 fw-bold text-dark mb-1">Policy Finder</h1>
            <p>Enter a policy number to retrieve its details.</p>
        </div>

        <form id="policyForm" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <label for="policy_number" class="form-label">Policy Number</label>
                    <input value="<?php echo $session_policy?>" type="text" id="policy_number" name="policy_number" class="form-control" placeholder="Enter policy number" required>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" id="submitBtn" class="btn btn-primary">Check Your Policy</button>
                </div>
            </div>
        </form>

        <div id="result" class="fw-semibold"></div>
        <!-- Card for all fields except content -->
        <div id="policyCard" class="card mb-4" style="display:none;">
            <div class="card-body">
                <div class="row" id="policyFieldsContainer"></div>
            </div>
        </div>

        <!-- Separate full-width card for content -->
        <div id="contentCard" class="card" style="display:none;">
            <div class="card-body">
                <h5 class="card-title">Deductible</h5>
                <pre id="contentField" style="white-space: pre-wrap;font-family: 'Noto Serif Khmer', serif;"></pre>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php' ?>

<style>
    /* Remove inner card borders and shadows for the small cards inside policyFieldsContainer */
    #policyFieldsContainer .card {
        border: none;
        box-shadow: none;
    }
</style>

<script>
    const form = document.getElementById('policyForm');
    const resultDiv = document.getElementById('result');
    const policyCard = document.getElementById('policyCard');
    const policyFieldsContainer = document.getElementById('policyFieldsContainer');
    const contentCard = document.getElementById('contentCard');
    const contentField = document.getElementById('contentField');
    const submitBtn = document.getElementById('submitBtn');

    const scopeCoverKeyMap = {
        tpl: "Third Party Liability",
        od: "Own Damage",
        theft: "Theft",
        pl: "Passenger Liability",
        ipd: "In Patient Department",
        opd: "Out Patient Department",
        dental: "Dental Care",
        vision: "Vision Care",
        maternity: "Maternity",
        emergency: "Emergency Services",
        annualcheckup: "Annual Checkup",
        pharmacy: "Pharmacy Coverage",
        mentalhealth: "Mental Health",
        rehabilitation: "Rehabilitation",
        wellness: "Wellness Programs",
        consultation: "Doctor Consultation"
    };

    const fieldsToShow = [
        'insured_name',
        'policy_no',
        'policy_type',
        'status',
        'issue_date',
        'insurance_period',
        'insurance_period_to',
        'insurance_period_from',
        'total_premium',
        'total_sum_insured',
        'additional_column',
        'scope_of_cover',
        'content'
    ];

    // Convert HTML string to plain text (for fallback)
    function htmlToPlainText(html) {
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;
        return tempDiv.textContent || tempDiv.innerText || '';
    }

    // Convert scope_of_cover JSON string to friendly text
    function mapScopeCoverJson(value) {
        try {
            const parsed = JSON.parse(value);
            if (Array.isArray(parsed)) {
                return parsed.map(key => scopeCoverKeyMap[key.toLowerCase()] || key).join(', ');
            }
            if (typeof parsed === 'object' && parsed !== null) {
                return Object.entries(parsed)
                    .map(([k, v]) => {
                        const labelKey = scopeCoverKeyMap[k.toLowerCase()] || k;
                        let labelValue = v;
                        if (typeof v === 'string') {
                            labelValue = scopeCoverKeyMap[v.toLowerCase()] || v;
                        }
                        return `${labelKey}: ${labelValue}`;
                    }).join('; ');
            }
            if (typeof parsed === 'string') {
                return scopeCoverKeyMap[parsed.toLowerCase()] || parsed;
            }
            return String(parsed);
        } catch {
            return htmlToPlainText(value);
        }
    }

    // Convert additional_column JSON string to formatted value or just number for liability_limit
    function mapAdditionalColumn(value) {
        try {
            const parsed = JSON.parse(value);
            if (typeof parsed === 'object' && parsed !== null) {
                if ('liability_limit' in parsed) {
                    // Return only the number value of liability_limit
                    return String(parsed['liability_limit']);
                }
                // Otherwise show all key-value pairs
                return Object.entries(parsed)
                    .map(([k,v]) => `<div><strong>${k.replace(/_/g, ' ')}:</strong> ${v}</div>`)
                    .join('');
            }
            return htmlToPlainText(value);
        } catch {
            return htmlToPlainText(value);
        }
    }

    // Capitalize and prettify labels
    function formatLabel(label) {
        return label.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
    }

    // Beautify and clean the content field to remove JSON quotes, escaped characters, and HTML tags
    function beautifyContent(rawContent) {
        if (!rawContent) return '';

        let cleaned = rawContent.trim();

        try {
            // Attempt to parse JSON if possible
            const maybeParsed = JSON.parse(cleaned);
            if (typeof maybeParsed === 'string') {
                cleaned = maybeParsed;
            } else if (typeof maybeParsed === 'object' && maybeParsed !== null) {
                cleaned = Object.values(maybeParsed).join(' ');
            }
        } catch {
            // Not JSON, use raw string
        }

        // Unescape common escaped sequences
        cleaned = cleaned
            .replace(/\\n/g, '\n')
            .replace(/\\"/g, '"')
            .replace(/\\'/g, "'")
            .replace(/\\\\/g, '\\')
            .replace(/\\\//g, '/');

        // Replace HTML tags with new lines or remove them
        cleaned = cleaned
            .replace(/<\/p>/gi, '\n')
            .replace(/<br\s*\/?>/gi, '\n')
            .replace(/<[^>]+>/g, '');

        // Trim lines and remove empty lines
        cleaned = cleaned
            .split('\n')
            .map(line => line.trim())
            .filter(line => line.length > 0)
            .join('\n\n');

        return cleaned;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Clear old results
        resultDiv.textContent = '';
        resultDiv.style.color = '';
        policyCard.style.display = 'none';
        contentCard.style.display = 'none';
        policyFieldsContainer.innerHTML = '';
        contentField.textContent = '';

        const policyNumber = document.getElementById('policy_number').value.trim();
        if (!policyNumber) {
            resultDiv.textContent = 'Please enter a policy number.';
            resultDiv.style.color = 'red';
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Loading...';

        const formData = new FormData();
        formData.append('policy_number_check', policyNumber);

        try {
            const response = await fetch('controllers/PolicyCheck.php', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const data = await response.json();

            submitBtn.disabled = false;
            submitBtn.textContent = 'Find Your Policy';

            if (data.status_code === 1 || data.status_code === "1") {
                resultDiv.textContent = data.message || 'Policy found successfully!';
                resultDiv.style.color = 'green';

                const policyData = data.data;
                if (policyData && typeof policyData === 'object') {
                    // Display all fields except content in 3 columns
                    const nonContentFields = fieldsToShow.filter(f => f !== 'content');
                    let html = '';

                    for (const key of nonContentFields) {
                        let val = policyData[key];
                        if (!val || val === '') continue;

                        let label = formatLabel(key);
                        let displayValue = '';

                        if (key === 'scope_of_cover') {
                            displayValue = mapScopeCoverJson(val);
                        } else if (key === 'additional_column') {
                            label = 'Liability Limit';  // Replace label here
                            displayValue = mapAdditionalColumn(val);
                        } else {
                            displayValue = htmlToPlainText(String(val));
                        }

                        html += `
            <div class="col-md-4 mb-3">
              <div class="card h-100">
                <div class="card-body p-3">
                  <h6 class="card-subtitle mb-2 text-muted">${label}</h6>
                  <p class="card-text mb-0">${displayValue}</p>
                </div>
              </div>
            </div>
          `;
                    }
                    policyFieldsContainer.innerHTML = html;
                    policyCard.style.display = 'block';

                    // Show content as clean text in a separate full width card
                    if (policyData.content && policyData.content.trim() !== '') {
                        contentField.textContent = beautifyContent(policyData.content);
                        contentCard.style.display = 'block';
                    }

                } else {
                    resultDiv.textContent = 'Policy found, but no detailed data available.';
                    resultDiv.style.color = 'orange';
                }
            } else {
                resultDiv.textContent = data.message || 'Policy not found.';
                resultDiv.style.color = 'red';
            }
        } catch (error) {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Find Your Policy';
            resultDiv.textContent = `An error occurred: ${error.message}`;
            resultDiv.style.color = 'red';
            console.error('Fetch error:', error);
        }
    });
</script>
