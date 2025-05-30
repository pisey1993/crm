<?php include '../layouts/header.php' ?>

<div class="content">

    <div class="bg-white py-4 shadow-sm border-bottom">
        <div class="container">


            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="container" style="background-color: #fff">
                    <h4>Claims Submit Online</h4>

                    <div class="col-md-12">
                        <form class="space-y-6" action="../controllers/ClaimsOnline.php" method="post" enctype="multipart/form-data">


                            <ul class="nav nav-tabs stepper-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">
                                        <i class="bi bi-person-fill me-1"></i> Insured Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="incident-tab" data-bs-toggle="tab"
                                        data-bs-target="#incident" type="button" role="tab" aria-controls="incident"
                                        aria-selected="false">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Incident Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="doc-tab" data-bs-toggle="tab" data-bs-target="#doc"
                                        type="button" role="tab" aria-controls="doc" aria-selected="false">
                                        <i class="bi bi-file-earmark-text-fill me-1"></i> Documents
                                    </button>
                                </li>
                            </ul>


                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">

                                    <div class="section">

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                            <div class="form-group">
                                                <label style="font-weight:500" for="policy_type"
                                                    class="form-label">Policy
                                                    Type</label>
                                                <select id="policy_type" name="policy_type" class="form-select"
                                                    onchange="toggleDocumentSections()">
                                                    <option value="">Select Policy Type</option>
                                                    <option value="Auto">Auto</option>
                                                    <option value="Healthcare">Healthcare</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="claim_type" class="form-label">Claim
                                                    Type</label>
                                                <input type="text" id="claim_type" name="claim_type"
                                                    class="form-control" placeholder="e.g., Medical, Accident, Theft">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="policy_number"
                                                    class="form-label">Policy
                                                    Number</label>
                                                <input type="text" id="policy_number" name="policy_number"
                                                    class="form-control" placeholder="Enter policy number">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="claim_amount"
                                                    class="form-label">Estimate
                                                    Claim
                                                    Amount
                                                    ($)</label>
                                                <input type="number" id="claim_amount" name="claim_amount" step="0.01"
                                                    class="form-control" placeholder="e.g., 1500.00">
                                            </div>
                                            <div class="form-group md:col-span-3">
                                                <label style="font-weight:500" for="reason_for_claim"
                                                    class="form-label">Loss Details</label>
                                                <textarea id="reason_for_claim" name="reason_for_claim"
                                                    class="form-control"
                                                    placeholder="Briefly describe the reason for your claim"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="insured_name"
                                                    class="form-label">Insured
                                                    Name</label>
                                                <input type="text" id="insured_name" name="insured_name"
                                                    class="form-control" placeholder="Full name of the insured">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="insured_contact"
                                                    class="form-label">Phone Number (If have Telegram is
                                                    good)</label>
                                                <input type="text" id="insured_contact" name="insured_contact"
                                                    class="form-control" placeholder="Email or phone number">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="contact_number"
                                                    class="form-label">Alternate
                                                    Contact
                                                    Number</label>
                                                <input type="text" id="contact_number" name="contact_number"
                                                    class="form-control" placeholder="Another contact number">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="incident" role="tabpanel" aria-labelledby="incident-tab">
                                    <div class="section mt-8">

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div class="form-group">
                                                <label style="font-weight:500" for="incident_date"
                                                    class="form-label">Incident
                                                    Date</label>
                                                <input type="date" id="incident_date" name="incident_date"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="incident_location"
                                                    class="form-label">Incident
                                                    Location</label>
                                                <input type="text" id="incident_location" name="incident_location"
                                                    class="form-control" placeholder="Where did the incident occur?">
                                            </div>
                                            <div class="form-group md:col-span-3"><label style="font-weight:500"
                                                    for="incident_description" class="form-label">Incident
                                                    Description</label>
                                                <textarea id="incident_description" name="incident_description"
                                                    class="form-control"
                                                    placeholder="Provide a detailed description of the incident"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section mt-8" id="driver_details_section">
                                        <h5 class="text-xl font-semibold mb-4 text-gray-800">Driver Details (if
                                            applicable)</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div class="form-group">
                                                <label style="font-weight:500" for="driver_name"
                                                    class="form-label">Driver
                                                    Name</label>
                                                <input type="text" id="driver_name" name="driver_name"
                                                    class="form-control" placeholder="Full name of the driver">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="driver_contact"
                                                    class="form-label">Driver
                                                    Contact</label>
                                                <input type="text" id="driver_contact" name="driver_contact"
                                                    class="form-control" placeholder="Driver's email or phone number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section mt-8" id="vehicle_details_section">
                                        <h5 class="text-xl font-semibold mb-4 text-gray-800">Vehicle Details (if
                                            applicable)</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div class="form-group">
                                                <label style="font-weight:500" for="vehicle_registration_number"
                                                    class="form-label">Vehicle
                                                    Registration
                                                    Number</label>
                                                <input type="text" id="vehicle_registration_number"
                                                    name="vehicle_registration_number" class="form-control"
                                                    placeholder="e.g., ABC-1234">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="vehicle_location"
                                                    class="form-label">Vehicle
                                                    Location</label>
                                                <input type="text" id="vehicle_location" name="vehicle_location"
                                                    class="form-control" placeholder="Current location of the vehicle">
                                            </div>
                                            <div class="form-group md:col-span-3"><label style="font-weight:500"
                                                    for="vehicle_details" class="form-label">Vehicle
                                                    Details</label>
                                                <textarea id="vehicle_details" name="vehicle_details"
                                                    class="form-control"
                                                    placeholder="Make, model, year, VIN, etc."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section mt-8" id="patient_health_details_section">
                                        <h5 class="text-xl font-semibold mb-4 text-gray-800">Patient/Health Details
                                            (if
                                            applicable)</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div class="form-group">
                                                <label style="font-weight:500" for="patient_name"
                                                    class="form-label">Patient
                                                    Name</label>
                                                <input type="text" id="patient_name" name="patient_name"
                                                    class="form-control" placeholder="Full name of the patient">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="patient_dob"
                                                    class="form-label">Patient
                                                    Date of
                                                    Birth</label>
                                                <input type="date" id="patient_dob" name="patient_dob"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="relationship_to_insured"
                                                    class="form-label">Relationship
                                                    to
                                                    Insured</label>
                                                <input type="text" id="relationship_to_insured"
                                                    name="relationship_to_insured" class="form-control"
                                                    placeholder="e.g., Self, Spouse, Child">
                                            </div>
                                           
                                            <div class="form-group">
                                                <label style="font-weight:500" for="hospital_name"
                                                    class="form-label">Hospital
                                                    Name</label>
                                                <input type="text" id="hospital_name" name="hospital_name"
                                                    class="form-control" placeholder="Name of the hospital">
                                            </div>
                                            <div class="form-group">
                                                <label style="font-weight:500" for="hospital_type"
                                                    class="form-label">Hospital
                                                    Type</label>
                                                <select id="hospital_type" name="hospital_type" class="form-control">
                                                    <option value="" disabled selected>Select Hospital Type</option>
                                                    <option value="Panel">Panel</option>
                                                    <option value="Non-Panel">Non-Panel</option>
                                                </select>
                                            </div>

                                            <div class="form-group md:col-span-3"><label style="font-weight:500"
                                                    for="diagnosis" class="form-label">Diagnosis</label>
                                                <textarea id="diagnosis" name="diagnosis" class="form-control"
                                                    placeholder="Medical diagnosis"></textarea>
                                            </div>
                                           
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="doc" role="tabpanel" aria-labelledby="doc-tab">
                                    <div class="col-12">
                                        <div class="row">
                                            <!-- General Document Uploads -->
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-4">
                                                <h5 class="text-xl font-semibold mb-4 text-gray-800">Document</h5>
                                                <p class="text-sm text-gray-600 mb-4">Please upload common required
                                                    documents.</p>
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="insured_id_card"
                                                            class="form-label">Insured ID
                                                            Card</label>
                                                        <input type="file" id="insured_id_card" name="insured_id_card"
                                                            class="form-control"
                                                            onchange="updateFileName('insured_id_card')">
                                                        <span id="insured_id_card_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="insurance_card"
                                                            class="form-label">Insurance
                                                            Card</label>
                                                        <input type="file" id="insurance_card" name="insurance_card"
                                                            class="form-control"
                                                            onchange="updateFileName('insurance_card')">
                                                        <span id="insurance_card_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="employee_card"
                                                            class="form-label">Employee Card</label>
                                                        <input type="file" id="employee_card" name="employee_card"
                                                            class="form-control"
                                                            onchange="updateFileName('employee_card')">
                                                        <span id="employee_card_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="claim_form"
                                                            class="form-label">Claim Form</label>
                                                        <input type="file" id="claim_form" name="claim_form"
                                                            class="form-control"
                                                            onchange="updateFileName('claim_form')">
                                                        <span id="claim_form_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                  
                                                </div>
                                            </div>

                                            <!-- Auto Claim Document Uploads -->
                                            <div class="col-md-4" id="auto_documents_section">
                                                <h5 class="text-xl font-semibold mb-4 text-gray-800">Auto Claim Document
                                                    Uploads</h5>
                                                <p class="text-sm text-gray-600 mb-4">Please upload documents specific
                                                    to
                                                    auto claims.</p>
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="driver_license"
                                                            class="form-label">Driver
                                                            License</label>
                                                        <input type="file" id="driver_license" name="driver_license"
                                                            class="form-control"
                                                            onchange="updateFileName('driver_license')">
                                                        <span id="driver_license_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="vehicle_registration_card"
                                                            class="form-label">Vehicle
                                                            Registration Card</label>
                                                        <input type="file" id="vehicle_registration_card"
                                                            name="vehicle_registration_card" class="form-control"
                                                            onchange="updateFileName('vehicle_registration_card')">
                                                        <span id="vehicle_registration_card_name" class="file-name">No
                                                            file chosen</span>
                                                    </div>
                                                    <!--                                                    <div class="form-group">-->
                                                    <!--                                                        <label style="font-weight:500" for="vehicle_road_tax"-->
                                                    <!--                                                               class="form-label">Vehicle Road-->
                                                    <!--                                                            Tax</label>-->
                                                    <!--                                                        <input type="file" id="vehicle_road_tax" name="vehicle_road_tax"-->
                                                    <!--                                                               class="form-control"-->
                                                    <!--                                                               onchange="updateFileName('vehicle_road_tax')">-->
                                                    <!--                                                        <span id="vehicle_road_tax_name"-->
                                                    <!--                                                              class="file-name">No file chosen</span>-->
                                                    <!--                                                    </div>-->
                                                    <!--                                                    <div class="form-group">-->
                                                    <!--                                                        <label style="font-weight:500" for="repair_estimate"-->
                                                    <!--                                                               class="form-label">Repair-->
                                                    <!--                                                            Estimate</label>-->
                                                    <!--                                                        <input type="file" id="repair_estimate" name="repair_estimate"-->
                                                    <!--                                                               class="form-control"-->
                                                    <!--                                                               onchange="updateFileName('repair_estimate')">-->
                                                    <!--                                                        <span id="repair_estimate_name"-->
                                                    <!--                                                              class="file-name">No file chosen</span>-->
                                                    <!--                                                    </div>-->
                                                    <!--                                                    <div class="form-group">-->
                                                    <!--                                                        <label style="font-weight:500" for="original_vehicle_keys"-->
                                                    <!--                                                               class="form-label">Original-->
                                                    <!--                                                            Vehicle Keys</label>-->
                                                    <!--                                                        <input type="file" id="original_vehicle_keys"-->
                                                    <!--                                                               name="original_vehicle_keys" class="form-control"-->
                                                    <!--                                                               onchange="updateFileName('original_vehicle_keys')">-->
                                                    <!--                                                        <span id="original_vehicle_keys_name" class="file-name">No file chosen</span>-->
                                                    <!--                                                    </div>-->
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="theft_complaint_letter"
                                                            class="form-label">Theft
                                                            Complaint Letter</label>
                                                        <input type="file" id="theft_complaint_letter"
                                                            name="theft_complaint_letter" class="form-control"
                                                            onchange="updateFileName('theft_complaint_letter')">
                                                        <span id="theft_complaint_letter_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="police_report"
                                                            class="form-label">Police Report</label>
                                                        <input type="file" id="police_report" name="police_report"
                                                            class="form-control"
                                                            onchange="updateFileName('police_report')">
                                                        <span id="police_report_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Healthcare Document Uploads -->
                                            <div class="col-md-4" id="healthcare_documents_section">
                                                <h5 class="text-xl font-semibold mb-4 text-gray-800">Healthcare Claim
                                                    Document Uploads</h5>
                                                <p class="text-sm text-gray-600 mb-4">Please upload documents specific
                                                    to
                                                    healthcare claims.</p>
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="lab_results"
                                                            class="form-label">Lab Results</label>
                                                        <input type="file" id="lab_results" name="lab_results"
                                                            class="form-control"
                                                            onchange="updateFileName('lab_results')">
                                                        <span id="lab_results_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="echo_result"
                                                            class="form-label">Echo Result</label>
                                                        <input type="file" id="echo_result" name="echo_result"
                                                            class="form-control"
                                                            onchange="updateFileName('echo_result')">
                                                        <span id="echo_result_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="xray_result"
                                                            class="form-label">X-ray Result</label>
                                                        <input type="file" id="xray_result" name="xray_result"
                                                            class="form-control"
                                                            onchange="updateFileName('xray_result')">
                                                        <span id="xray_result_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="discharge_summary"
                                                            class="form-label">Discharge
                                                            Summary</label>
                                                        <input type="file" id="discharge_summary"
                                                            name="discharge_summary" class="form-control"
                                                            onchange="updateFileName('discharge_summary')">
                                                        <span id="discharge_summary_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="medical_report"
                                                            class="form-label">Medical
                                                            Report</label>
                                                        <input type="file" id="medical_report" name="medical_report"
                                                            class="form-control"
                                                            onchange="updateFileName('medical_report')">
                                                        <span id="medical_report_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="medical_certificate"
                                                            class="form-label">Medical
                                                            Certificate</label>
                                                        <input type="file" id="medical_certificate"
                                                            name="medical_certificate" class="form-control"
                                                            onchange="updateFileName('medical_certificate')">
                                                        <span id="medical_certificate_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="medical_expense_form"
                                                            class="form-label">Medical Expense
                                                            Form</label>
                                                        <input type="file" id="medical_expense_form"
                                                            name="medical_expense_form" class="form-control"
                                                            onchange="updateFileName('medical_expense_form')">
                                                        <span id="medical_expense_form_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="medical_bills"
                                                            class="form-label">Medical Bills</label>
                                                        <input type="file" id="medical_bills" name="medical_bills"
                                                            class="form-control"
                                                            onchange="updateFileName('medical_bills')">
                                                        <span id="medical_bills_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="prescription"
                                                            class="form-label">Prescription</label>
                                                        <input type="file" id="prescription" name="prescription"
                                                            class="form-control"
                                                            onchange="updateFileName('prescription')">
                                                        <span id="prescription_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-weight:500" for="hospital_invoice"
                                                            class="form-label">Hospital
                                                            Invoice</label>
                                                        <input type="file" id="hospital_invoice" name="hospital_invoice"
                                                            class="form-control"
                                                            onchange="updateFileName('hospital_invoice')">
                                                        <span id="hospital_invoice_name" class="file-name">No file
                                                            chosen</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-center mt-8">
                                        <input type="checkbox" name="confirmcheck" id="confirmcheck"> Please confirm before submitting the claims
                                        </div>
                                    </div>
                                </div>

                            </div>
                        

                    </div>
                </div>

                <div class="col-md-12 col-lg-12" style="margin-top: 10px">
                    <div class="row">
                        <div class="col-md-11 col-lg-11 col-xs-11">
                            <button type="button" class="btn btn-secondary me-auto" id="prevBtn">Previous</button>
                        </div>
                        <div class="col-md-1 col-lg-1 col-xs-1">
                            <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn"
                                style="display: none;">Submit</button>

                        </div>

                    </div>
                </div>
                </form>
            </div>
        </div>


        <?php include '../layouts/footer.php' ?>