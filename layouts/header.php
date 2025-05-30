<?php $title = 'crm' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>People & Partners Insurance Plc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        /* Reset and base */
        body {
            margin: 0;
            padding: 0;
            padding-top: 56px;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        /* Navbar */
        .navbar.fixed-top {
            height: 70px;
            background: linear-gradient(90deg, #3B8F88, #4EA79F);
            box-shadow: 0 3px 8px rgb(62 145 138 / 0.4);
            padding: 0 1.5rem;
            transition: background-color 0.3s ease;
        }
        .navbar-brand img {
            height: 45px;
            object-fit: contain;
        }
        .navbar-toggler {
            border: none;
            outline: none;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23fff' stroke-linecap='round' stroke-miterlimit='10' stroke-width='3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #3b8f88;
            min-height: 100vh;
            position: fixed;
            top: 70px; /* below navbar */
            left: 0;
            padding-top: 1rem;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgb(0 0 0 / 0.1);
            border-top-right-radius: 0.5rem;
            transition: width 0.3s ease;
            z-index: 1020;
        }

        .sidebar .nav-link {
            color: #e1f0ef;
            font-weight: 500;
            padding: 12px 25px;
            margin: 0.25rem 0;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: background-color 0.25s ease, color 0.25s ease;
        }
        .sidebar .nav-link i {
            font-size: 1.2rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #2c6f6b;
            color: #d4fff9;
        }
        .sidebar-group h6 {
            color: #b9dbd9;
            padding: 0 1.6rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 0.2rem;
            margin-bottom: 0.5rem;
            letter-spacing: 0.05em;
        }

        /* Nested nav links (if any) */
        .sidebar .collapse .nav-link {
            padding-left: 50px;
            font-size: 0.9rem;
            color: #b8dbd9;
        }
        .sidebar .collapse .nav-link:hover {
            background-color: #27675e;
            color: #e3f6f4;
        }

        /* Content */
        .content {
            margin-left: 260px;
            padding: 2rem 2.5rem;
            min-height: calc(100vh - 70px);
            background: #fff;
            box-shadow: inset 0 0 30px rgb(0 0 0 / 0.03);
            border-top-left-radius: 0.75rem;
            transition: margin-left 0.3s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                width: 0 !important;
                overflow: hidden;
                border-radius: 0;
                padding-top: 0;
                box-shadow: none;
                position: fixed;
                height: 100vh;
                top: 0;
                left: 0;
                z-index: 1050;
                transition: width 0.3s ease;
            }
            .sidebar.show {
                width: 260px !important;
                padding-top: 70px;
                box-shadow: 2px 0 10px rgb(0 0 0 / 0.15);
                border-top-right-radius: 0.5rem;
                top: 70px;
            }
            .content {
                margin-left: 0 !important;
                padding: 1.5rem;
                transition: margin-left 0.3s ease;
            }
            .content.sidebar-visible {
                margin-left: 260px !important;
            }
        }

        /* Placeholder content styling */
        .placeholder-content {
            background-color: #fafafa;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgb(0 0 0 / 0.08);
            text-align: center;
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #4EA79F;
        }
        .placeholder-content h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .placeholder-content p {
            font-size: 1.1rem;
            color: #6a8a87;
        }

        .form-section-header {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .claim-section {
            display: none; /* Hidden by default */
        }
        /* Custom styling for different claim sections */
        #health_fields {
            background-color: #e0f7fa; /* Light blue */
            border-color: #00bcd4; /* Cyan */
        }
        #vehicle_fields {
            background-color: #e8f5e9; /* Light green */
            border-color: #4caf50; /* Green */
        }
        .file-input-custom {
            background-color: #e9ecef; /* Light gray for file inputs */
            border-color: #ced4da;
        }




        /* Base styling for stepper nav */
        .stepper-nav {
            display: flex;
            flex-wrap: wrap; /* Allows wrapping on smaller screens */
            justify-content: center;
            align-items: center;

            padding: 15px;

            gap: 0;
        }

        /* Wrapper for individual items */
        .stepper-nav .nav-item {
            position: relative;
            margin: 5px 10px;
        }

        /* Line between items */
        .stepper-nav .nav-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -20px;
            width: 20px;
            height: 2px;
            background-color: #bcdfff;
            transform: translateY(-50%);
            z-index: 0;
        }

        /* Remove line for wrapped (stacked) items */
        @media (max-width: 600px) {
            .stepper-nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .stepper-nav .nav-item:not(:last-child)::after {
                display: none;
            }

            .stepper-nav .nav-link {
                width: 100%;
                text-align: left;
            }
        }

        /* Button styles */
        .stepper-nav .nav-link {
            position: relative;
            z-index: 1;
            border-radius: 30px;
            background-color: #e0f0ff;
            color: #333;
            padding: 10px 20px;
            font-weight: 500;
            transition: background-color 0.3s;
            border: none;
            white-space: nowrap;
        }

        /* Active tab */
        .stepper-nav .nav-link.active {
            background-color: #339cff;
            color: white;
            font-weight: bold;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="https://ppicis.peoplenpartners.net/logo-long-white.png" alt="People & Partners Insurance Logo" />
        </a>
        <button
            class="navbar-toggler"
            type="button"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div
    class="sidebar show"
    id="sidebarCollapse"
    style="margin-top: 0"
>
    <nav class="nav flex-column pt-3">
        <a href="/<?php echo htmlspecialchars($title); ?>/index.php" class="nav-link">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sidebar-group mb-3">
            <h6>Claims</h6>
            <a href="/<?php echo htmlspecialchars($title); ?>/views/claims_online.php" class="nav-link px-3">
            <i class="bi bi-file-earmark-plus"></i> Submit Claims
            </a>
            <a href="checker" class="nav-link px-3">
                <i class="bi bi-check-circle"></i> Claims Checker
            </a>
        </div>

        <div class="sidebar-group mb-3">
            <h6>Finders</h6>
            <a href="/<?php echo htmlspecialchars($title); ?>/views/policy-finder" class="nav-link px-3">
                <i class="bi bi-search"></i> Policy Finder
            </a>
            <a
                href="https://www.peoplenpartners.com/panel-clinic"
                target="_blank"
                class="nav-link px-3"
            >
                <i class="bi bi-hospital"></i> Panel Clinic Finder
            </a>
            <a
                href="https://www.peoplenpartners.com/repair-garage"
                target="_blank"
                class="nav-link px-3"
            >
                <i class="bi bi-tools"></i> Panel Garage Finder
            </a>
        </div>

        <div class="sidebar-group mb-3">
            <h6>Product</h6>
            <a href="/<?php echo htmlspecialchars($title); ?>/views/buy-insurance" class="nav-link px-3">
                <i class="bi bi-cart-plus"></i> Buy Insurance Policy
            </a>
            <a href="/<?php echo htmlspecialchars($title); ?>/views/insurance/request-quote" class="nav-link px-3">
                <i class="bi bi-pencil-square"></i> Ask For Quote
            </a>
        </div>
    </nav>
</div>