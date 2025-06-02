<?php include '../layouts/header.php' ?>

<!-- Bootstrap Icons CDN (if not already in header.php) -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
/>

<style>
    .section-container {
        display: flex;
        justify-content: center;
        align-items: stretch;
        gap: 40px;
        margin-top: 60px;
        flex-wrap: wrap;
    }

    .half-section {
        flex: 1 1 300px;
        max-width: 500px;
        padding: 30px;
        text-align: center;
        border-radius: 12px;
        background-color: #f9f9f9;
        position: relative;
    }

    .half-section h3 {
        font-size: 1.25rem;
        color: #0d9488;
        margin-top: 20px;
    }

    .half-section .icon-button {
        width: 100%;
        height: 140px;
        border: 2px solid #0d9488;
        border-radius: 12px;
        background-color: white;
        color: #0d9488;
        font-weight: 600;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .half-section .icon-button .bi {
        font-size: 2.2rem;
    }

    .half-section .icon-button:hover {
        background-color: #0d9488;
        color: white;
    }

    .half-section .icon-button:hover .bi {
        color: white;
    }


    .divider-vertical {
        width: 2px;
        background-color: #ddd;
        margin: 0 20px;
    }

    @media (max-width: 768px) {
        .section-container {
            flex-direction: column;
        }

        .divider-vertical {
            display: none;
        }
    }

    .page-title {
        text-align: center;
        margin-top: 40px;
        font-size: 2rem;
        font-weight: bold;
        color: #0d9488;
    }
</style>

<div class="container">
    <h2 class="page-title">Interested in Our Insurance Product?</h2>

    <div class="section-container">
        <!-- Left Column: Check Estimate -->
        <div class="half-section">
            <a href="https://www.peoplenpartners.com/scanGetQoute" class="icon-button" target="_blank">
                <i class="bi bi-calculator"></i>
                <span>Check Auto Estimate Price</span>
            </a>
            <h3>If you're interested in Auto insurance, you can check the price by clicking the button above</h3>
        </div>

        <!-- Divider Line -->
        <div class="divider-vertical"></div>

        <!-- Right Column: Request Quote -->
        <div class="half-section">
            <a href="request-quote" class="icon-button" target="_blank">
                <i class="bi bi-chat-dots"></i>
                <span>Request Quote</span>
            </a>
            <h3>You can request a direct quote from our sales team for other products</h3>
        </div>

    </div>
</div>

<?php include '../layouts/footer.php' ?>
