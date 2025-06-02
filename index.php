<?php
$title = 'crm';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>People & Partners Insurance Plc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bayon&family=Noto+Serif+Khmer:wght@100..900&display=swap" rel="stylesheet" />

    <!-- Custom Style -->
    <style>
        body {
            font-family: "Noto Serif Khmer", serif;
            padding-top: 70px;
        }

        .navbar-brand img {
            height: 50px;
        }

        .search-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 60px 20px;
        }

        .search-box h2 {
            color: #0d9488;
            margin-bottom: 20px;
        }

        .input-group input {
            padding: 12px 16px;
            font-size: 1rem;
            border: 2px solid #0d9488;
            border-radius: 8px;
            outline: none;
            width: 300px;
        }

        .input-group button {
            padding: 12px 20px;
            font-size: 1rem;
            background-color: #0d9488;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .result-message {
            margin-top: 20px;
            font-size: 1.1rem;
            font-weight: bold;
        }

        footer {
            background-color: #0d9488;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 60px;
        }

        .bg-teal {
            background-color: #0d9488 !important;
        }

        body.d-flex {
            display: flex !important;
            flex-direction: column !important;
            min-height: 100vh !important;
            padding-top: 70px;
        }
    </style>
</head>

<body class="d-flex">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-teal fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://www.peoplenpartners.com/"><img src="https://ppicis.peoplenpartners.net/logo-long-white.png" alt="Logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
            <ul class="navbar-nav">
                <!-- Menu content removed -->
            </ul>
        </div>
    </div>
</nav>

<!-- Main Section -->
<div class="container search-box flex-grow-1">
    <h2>Enter Your Policy Number</h2>
    <div class="input-group mb-3">
        <input type="text" id="policyInput" class="form-control" placeholder="Enter policy number" />
        <button class="btn btn-primary" onclick="checkPolicy()" id="checkBtn">
            Check
            <span class="spinner-border spinner-border-sm text-light ms-2" role="status" id="loadingSpinner" style="display:none;"></span>
        </button>
    </div>
    <div class="result-message" id="resultMsg"></div>
</div>

<!-- Footer -->
<footer class="mt-auto">
    <div class="container">
        <p class="mb-0">© <?= date("Y"); ?> People & Partners Insurance Plc. All rights reserved.</p>
    </div>
</footer>

<!-- JavaScript -->
<script>
    function checkPolicy() {
        const policyNumber = document.getElementById("policyInput").value;
        const resultMsg = document.getElementById("resultMsg");
        const checkButton = document.getElementById("checkBtn");
        const spinner = document.getElementById("loadingSpinner");

        if (!policyNumber.trim()) {
            resultMsg.textContent = "Please enter your policy number.";
            resultMsg.style.color = "red";
            return;
        }

        // Start loading
        checkButton.disabled = true;
        spinner.style.display = "inline-block";

        fetch("controllers/getdata.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "policy_number_check=" + encodeURIComponent(policyNumber),
        })
            .then((res) => res.json())
            .then((data) => {
                // Use innerHTML to render any <br> tags in the message
                resultMsg.innerHTML = data.message;
                resultMsg.style.color = data.status_code === 1 ? "green" : "red";

                if (data.status_code === 1) {
                    setTimeout(() => {
                        window.location.href = "dashboard";
                    }, 1000);
                }
            })
            .catch(() => {
                resultMsg.textContent = "Error occurred while checking policy.";
                resultMsg.style.color = "red";
            })
            .finally(() => {
                // Stop loading
                checkButton.disabled = false;
                spinner.style.display = "none";
            });
    }

</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
