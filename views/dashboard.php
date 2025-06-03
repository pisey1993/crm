<?php include '../layouts/header.php' ?>

<div class="content" style="background-color:#f5f5f5;margin-top: -35px">
    <div class="container py-4">

        <div class="mb-4">
            <h1 class="h4 fw-bold text-dark mb-1">
                Welcome To Client Portal <br>

            </h1>
        </div>

        <!-- Group buttons in 3 columns -->
        <main class="container-fluid">
            <div class="row">

                <!-- Claims Column -->
                <div class="col-md-4">
                    <h6 style="color: teal; border-bottom: 2px solid teal; padding-bottom: 0.3rem; margin-bottom: 1rem;">
                        Claims <br>
                        <span class="font-khmer" style="font-size: 0.85rem; color: #555;">ការទាមទារ</span>
                    </h6>
                    <a href="claims_online.php" class="dashboard-btn text-decoration-none d-flex flex-column align-items-center justify-content-center mb-3"
                       style="height:150px; border-radius: 10px; color: teal;">
                        <i class="bi bi-file-earmark-plus" style="font-size: 2rem; margin-bottom: 0.4rem;"></i>
                        <span><h6>Submit Claims</h6><small style="font-size: 0.8rem; color: #555;" >ដាក់សំណើរ</small></span>
                    </a>
                    <a href="checker" class="dashboard-btn text-decoration-none d-flex flex-column align-items-center justify-content-center"
                       style="height:150px; border-radius: 10px; color: teal;">
                        <i class="bi bi-check-circle" style="font-size: 2rem; margin-bottom: 0.4rem;"></i>
                        <span><h6>Claims Checker</h6><small style="font-size: 0.8rem; color: #555;">ត្រួតពិនិត្យការទាមទារ</small></span>
                    </a>
                </div>

                <!-- Finder Column -->
                <div class="col-md-4">
                    <h6 style="color: teal; border-bottom: 2px solid teal; padding-bottom: 0.3rem; margin-bottom: 1rem;">
                        Finder <br>
                        <span class="font-khmer" style="font-size: 0.85rem; color: #555;">កម្មវិធីស្វែងរក</span>
                    </h6>
                    <a href="policy-finder.php" class="dashboard-btn text-decoration-none d-flex flex-column align-items-center justify-content-center mb-3"
                       style="height:150px; border-radius: 10px; color: teal;">
                        <i class="bi bi-search" style="font-size: 2rem; margin-bottom: 0.4rem;"></i>
                        <span><h6>Policy Finder</span></h6><small style="font-size: 0.8rem; color: #555;">មើលពត័មានបណ្ណធានា</small></span>
                    </a>
                    <a href="https://www.peoplenpartners.com/panel-clinic" target="_blank" class="dashboard-btn text-decoration-none d-flex flex-column align-items-center justify-content-center mb-3"
                       style="height:150px; border-radius: 10px; color: teal;">
                        <i class="bi bi-hospital" style="font-size: 2rem; margin-bottom: 0.4rem;"></i>
                        <span><h6>Panel Clinic Finder</h6><small style="font-size: 0.8rem; color: #555;">ស្វែងរកគ្លីនិកដៃគូ</small></span>
                    </a>
                    <a href="https://www.peoplenpartners.com/repair-garage" target="_blank" class="dashboard-btn text-decoration-none d-flex flex-column align-items-center justify-content-center"
                       style="height:150px; border-radius: 10px; color: teal;">
                        <i class="bi bi-tools" style="font-size: 2rem; margin-bottom: 0.4rem;"></i>
                        <span><h6>Panel Garage Finder</h6><small style="font-size: 0.8rem; color: #555;">ស្វែងរកហាងជួសជុលដៃគូរ</small></span>
                    </a>
                </div>

                <!-- Product Column -->
                <div class="col-md-4">
                    <h6 style="color: teal; border-bottom: 2px solid teal; padding-bottom: 0.3rem; margin-bottom: 1rem;">
                        Product <br>
                        <span class="font-khmer" style="font-size: 0.85rem; color: #555;">ផលិតផល</span>
                    </h6>
                    <a href="buy-insurance.php" class="dashboard-btn text-decoration-none d-flex flex-column align-items-center justify-content-center mb-3"
                       style="height:150px; border-radius: 10px; color: teal;">
                        <i class="bi bi-cart-plus" style="font-size: 2rem; margin-bottom: 0.4rem;"></i>
                        <span><h6>Buy Insurance</h6><small style="font-size: 0.8rem; color: #555;">ទិញកញ្ចប់ធានារ៉ាប់រង</small></span>
                    </a>
                    <a href="request-quote-home.php" class="dashboard-btn text-decoration-none d-flex flex-column align-items-center justify-content-center"
                       style="height:150px; border-radius: 10px; color: teal;">
                        <i class="bi bi-pencil-square" style="font-size: 2rem; margin-bottom: 0.4rem;"></i>
                        <span><h6>Request Quote</h6><small style="font-size: 0.8rem; color: #555;">ស្នើសុំតម្លៃ</small></span>
                    </a>
                </div>

            </div>
        </main>

    </div>
</div>

<!-- Contact Info and Map Section -->
<div class="container py-5" style="background-color:#f8f9fa; border-radius: 8px; margin-top: 3rem;">
    <div class="row">

        <!-- Contact Info -->
        <div class="col-md-5 mb-4">
            <h6 class="mb-4" style="color: teal; font-weight: 700;">
                Contact Us <br>
                <span class="font-khmer" style="font-size: 0.85rem; color: #555;">ទំនាក់ទំនងមកយើងខ្ញុំ</span>
            </h6>
            <ul class="list-unstyled">
                <li class="mb-3 d-flex align-items-start">
                    <i class="bi bi-telephone-fill" style="font-size: 1.2rem; color:teal; margin-right: 12px;"></i>
                    <div>
                        <a href="tel:+85515780078" style="color: #212529; text-decoration: none;">+855 15 78 00 78</a><br>
                        <a href="tel:+85523217878" style="color: #212529; text-decoration: none;">+855 23 21 78 78</a>
                    </div>
                </li>
                <li class="mb-3 d-flex align-items-start">
                    <i class="bi bi-envelope-fill" style="font-size: 1.2rem; color:teal; margin-right: 12px;"></i>
                    <a href="mailto:info@peoplenpartners.com" style="color: #212529; text-decoration: none;">info@peoplenpartners.com</a>
                </li>
                <li class="d-flex align-items-start">
                    <i class="bi bi-geo-alt-fill" style="font-size: 1.2rem; color:teal; margin-right: 12px;"></i>
                    <address style="margin: 0; color: #212529;">
                        Building No. 7E, Mao Tse Toung Blvd.,<br>
                        Sangkat Boeng Keng Kang 1,<br>
                        Khan Boeng Keng Kang,<br>
                        Phnom Penh, Cambodia.
                    </address>
                </li>
            </ul>
        </div>

        <!-- Google Map -->
        <div class="col-md-7">
            <div style="border-radius: 8px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.068975733501!2d104.91985311526052!3d11.55916119186961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095118e25abfdb%3A0x7c2d61eaba204536!2sPeople%20%26%20Partners%20Insurance%20Plc!5e0!3m2!1sen!2skh!4v1659928176820!5m2!1sen!2skh"
                        width="100%"
                        height="350"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>

    <div class="text-center mt-4" style="color: #6c757d; font-size: 0.9rem;">
        &copy; People &amp; Partners Insurance Plc.
    </div>
</div>

<?php include '../layouts/footer.php' ?>
