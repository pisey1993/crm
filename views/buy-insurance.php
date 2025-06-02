<?php include '../layouts/header.php' ?>

<!-- Bootstrap Icons CDN (if not already in header.php) -->
<link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
/>

<style>
    .icon-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 220px; /* wider */
        height: 160px;
        border: 2px solid #0d9488; /* teal */
        border-radius: 16px;
        background-color: #e6f7f5;
        color: #0d9488;
        font-weight: 600;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        user-select: none;
    }

    .icon-button:hover {
        background-color: #0d9488;
        color: white;
    }

    .icon-button .bi {
        font-size: 3.5rem;
        margin-bottom: 0.5rem;
    }

    .buttons-container {
        display: flex;
        gap: 40px;
        justify-content: center;
        margin-top: 50px;
        flex-wrap: wrap;
    }

    .page-title {
        text-align: center;
        margin-top: 60px;
        font-size: 2rem;
        font-weight: bold;
        color: #0d9488;
    }

    /* Khmer translation style */
    .translation {
        font-size: 0.9rem;
        color: #0d9488;
        margin-top: 0.2rem;
        font-weight: 400;
    }
</style>

<div class="container">
    <h2 class="page-title">Please choose product to buy online</h2>

    <div class="buttons-container">
        <a href="https://buynow.peoplenpartners.net/products/motor" class="icon-button" id="btnAuto" aria-label="Auto" target="_blank">
            <i class="bi bi-car-front"></i>
            Auto
            <span class="translation">យានយន្ត</span>
        </a>

        <a href="https://buynow.peoplenpartners.net/products/travel" class="icon-button" id="btnTravel" aria-label="Travel" target="_blank">
            <i class="bi bi-airplane-engines"></i>
            Travel
            <span class="translation">ការធ្វើដំណើរ</span>
        </a>
    </div>
</div>

<?php include '../layouts/footer.php' ?>
