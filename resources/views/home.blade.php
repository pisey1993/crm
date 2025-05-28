@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-center">Welcome to People & Partners Insurance PLC Client Portal</h2>
        <p class="text-center mb-5">Get in touch with us today and explore how we can help protect what matters most.</p>

        <div class="row g-5 justify-content-center">
            <!-- Contact Info & Map -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="mb-3"><i class="bi bi-geo-alt-fill me-2 text-danger"></i>Contact Information</h5>

                        <p class="mb-1"><strong>Phone:</strong></p>
                        <p class="text-muted ms-3 mb-2">+855 15 78 00 78<br>+855 23 21 78 78</p>

                        <p class="mb-1"><strong>Email:</strong></p>
                        <p class="text-muted ms-3 mb-2">info@peoplenpartners.com</p>

                        <p class="mb-1"><strong>Office Address:</strong></p>
                        <p class="text-muted ms-3">
                            Building No. 7E, Mao Tse Toung Blvd.,<br>
                            Sangkat Boeng Keng Kang 1,<br>
                            Khan Boeng Keng Kang,<br>
                            Phnom Penh, Cambodia.
                        </p>

                        <a href="/insurance/plans" class="btn btn-outline-success w-100 mt-3">Buy Insurance</a>
                    </div>
                </div>

                <!-- Google Map -->
                <div class="ratio ratio-16x9 rounded shadow-sm">
                    <iframe
                        src="https://www.google.com/maps?q=Building+No.+7E,+Mao+Tse+Toung+Blvd.,+Phnom+Penh,+Cambodia&output=embed"
                        style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>


@endsection
