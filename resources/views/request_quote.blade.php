@extends('layouts.app')

@section('content')
    <div class="container mt-5" style="max-width: 700px;">
        <h2 class="mb-4 text-primary"><i class="bi bi-card-checklist me-2"></i> Request a Quote</h2>
        <p class="text-muted mb-4">Fill out the form below to request a personalized insurance quote. Our team will get back to you shortly.</p>

        <form action="/insurance/request-quote" method="POST">
        @csrf

        <!-- Requester Information -->
            <h5 class="mb-3">Your Information</h5>
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="fullName" name="fullName" required placeholder="Your full name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="+855 12 345 678">
            </div>

            <hr>

            <!-- Insured Information -->
            <h5 class="mb-3">Insured Person's Information</h5>
            <div class="mb-3">
                <label for="insuredName" class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="insuredName" name="insuredName" required placeholder="Insured person's full name">
            </div>

            <div class="mb-3">
                <label for="insuredDOB" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="insuredDOB" name="insuredDOB" required>
            </div>

            <div class="mb-3">
                <label for="insuredAddress" class="form-label">Address</label>
                <textarea class="form-control" id="insuredAddress" name="insuredAddress" rows="2" placeholder="Insured person's address"></textarea>
            </div>

            <hr>

            <!-- Insurance Details -->
            <h5 class="mb-3">Insurance Details</h5>
            <div class="mb-3">
                <label for="insuranceType" class="form-label">Insurance Product <span class="text-danger">*</span></label>
                <select class="form-select" id="insuranceType" name="insuranceType" required>
                    <option value="" selected disabled>Select insurance product</option>
                    <option value="fire">Fire</option>
                    <option value="property">Property</option>
                    <option value="auto">Auto</option>
                    <option value="cargo">Cargo</option>
                    <option value="car">CAR (Contractors All Risk)</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="pa">PA (Personal Accident)</option>
                    <option value="international_health">International Health</option>
                    <option value="marine">Marine</option>
                    <option value="engineering">Engineering</option>
                    <option value="liability">Liability</option>
                    <option value="travel">Travel</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="additionalInfo" class="form-label">Additional Information</label>
                <textarea class="form-control" id="additionalInfo" name="additionalInfo" rows="4" placeholder="Tell us more about your needs (optional)"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Request Quote</button>
        </form>
    </div>
@endsection
