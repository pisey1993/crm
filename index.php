<?php include 'layouts/header.php' ?>



<div class="content" style="background-color:#f5f5f5">
    <div class="">
        <div class="container">


            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h4 fw-bold text-dark mb-1">
                        Welcome To Client Portal
                    </h1>
                    <p class="text-muted small mb-0">

                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Dashboard Buttons -->
    <main class="container-fluid" >
        <div class="dashboard-buttons">

            <a href="views/claims_online.php" class="dashboard-btn text-decoration-none">
                <i class="bi bi-file-earmark-plus"></i>
                <span>Submit Claims</span>
            </a>

            <a href="checker" class="dashboard-btn text-decoration-none">
                <i class="bi bi-check-circle"></i>
                <span>Claims Checker</span>
            </a>

            <a href="views/policy-finder" class="dashboard-btn text-decoration-none">
                <i class="bi bi-search"></i>
                <span>Policy Finder</span>
            </a>

            <a href="https://www.peoplenpartners.com/panel-clinic" target="_blank"
                class="dashboard-btn text-decoration-none">
                <i class="bi bi-hospital"></i>
                <span>Panel Clinic Finder</span>
            </a>

            <a href="https://www.peoplenpartners.com/repair-garage" target="_blank"
                class="dashboard-btn text-decoration-none">
                <i class="bi bi-tools"></i>
                <span>Panel Garage Finder</span>
            </a>

            <a href="views/buy-insurance" class="dashboard-btn text-decoration-none">
                <i class="bi bi-cart-plus"></i>
                <span>Buy Insurance</span>
            </a>

            <a href="views/insurance/request-quote" class="dashboard-btn text-decoration-none">
                <i class="bi bi-pencil-square"></i>
                <span>Request Quote</span>
            </a>

        </div>
    </main>


</div>


<?php include 'layouts/footer.php' ?>