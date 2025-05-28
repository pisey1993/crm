@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-primary"><i class="bi bi-cart-plus me-2"></i> Buy Insurance</h2>

        <div class="row g-4">
            <!-- Auto Insurance Card -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="card-title"><i class="bi bi-car-front me-2 text-danger"></i> Auto Insurance</h4>
                            <p class="text-muted">Protect your vehicle with comprehensive or third-party coverage.</p>
                        </div>
                        <a href="/insurance/auto" class="btn btn-danger mt-3">Buy Auto Insurance</a>
                    </div>
                </div>
            </div>

            <!-- Travel Insurance Card -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="card-title"><i class="bi bi-airplane me-2 text-info"></i> Travel Insurance</h4>
                            <p class="text-muted">Ensure a safe journey with travel protection for you and your loved ones.</p>
                        </div>
                        <a href="/insurance/travel" class="btn btn-info text-white mt-3">Buy Travel Insurance</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
