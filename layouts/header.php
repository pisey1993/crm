<?php $title = 'crm'; ?>
<?php
session_start();

if (empty($_SESSION['policy_number'])) {
    header("Location: index");
    exit;
} else {
    $session_policy = $_SESSION['policy_number'];
}
?>

<?php include '../controllers/getInsuredName.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>People & Partners Insurance Plc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=Bayon&family=Hanuman:wght@100;300;400;700;900&family=Noto+Serif+Khmer:wght@100..900&display=swap" rel="stylesheet">

    <link href="../layouts/style/style.css" rel="stylesheet">
    <link href="layouts/style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="font-family: Arial, sans-serif">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="">
            <img src="https://ppicis.peoplenpartners.net/logo-long-white.png" alt="Logo" height="30">
        </a>

        <!-- Toggle for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="dashboard">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <!-- Claims -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="claimsDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-file-earmark-text"></i> Claims
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="claimsDropdown">
                        <li>
                            <a class="dropdown-item"
                               href="/<?php echo htmlspecialchars($title); ?>/claims_online">
                                <i class="bi bi-file-earmark-plus"></i> Submit Claims
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="checker">
                                <i class="bi bi-check-circle"></i> Claims Checker
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Finders -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="findersDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-search"></i> Finders
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="findersDropdown">
                        <li>
                            <a class="dropdown-item"
                               href="/<?php echo htmlspecialchars($title); ?>/policy-finder">
                                <i class="bi bi-search"></i> Policy Finder
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="https://www.peoplenpartners.com/panel-clinic"
                               target="_blank">
                                <i class="bi bi-hospital"></i> Panel Clinic Finder
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="https://www.peoplenpartners.com/repair-garage"
                               target="_blank">
                                <i class="bi bi-tools"></i> Panel Garage Finder
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Product -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-box-seam"></i> Product
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="productDropdown">
                        <li>
                            <a class="dropdown-item"
                               href="/<?php echo htmlspecialchars($title); ?>/buy-insurance">
                                <i class="bi bi-cart-plus"></i> Buy Insurance Policy
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                               href="request-quote-home">
                                <i class="bi bi-pencil-square"></i> Ask For Quote
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Download (New menu) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="downloadDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-download"></i> Download
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="downloadDropdown">
                        <!--                        <li>-->
                        <!--                            <a class="dropdown-item" href="/-->
                        <?php //echo htmlspecialchars($title); ?><!--/download-policies">-->
                        <!--                                <i class="bi bi-file-earmark-arrow-down"></i> Policy Documents-->
                        <!--                            </a>-->
                        <!--                        </li>-->
                        <!--                        <li>-->
                        <!--                            <a class="dropdown-item" href="/-->
                        <?php //echo htmlspecialchars($title); ?><!--/download-claims">-->
                        <!--                                <i class="bi bi-file-earmark-arrow-down"></i> Claims Reports-->
                        <!--                            </a>-->
                        <!--                        </li>-->
                        <li>
                            <a class="dropdown-item" href="claim-forms">
                                <i class="bi bi-file-earmark-arrow-down"></i> Claim Forms
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Right side content: Policy number and logout -->
            <div class="d-flex align-items-center text-white">
                <span class="me-3">Insured Name: <strong><?php echo htmlspecialchars($insuredName); ?></strong></span>
                <a href="logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </div>
</nav>
<div class="animate__animated animate__fadeIn">

