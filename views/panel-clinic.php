<?php include '../layouts/header.php'; ?>

<style>
    .iframe-wrapper {
        width: 100%;
        height: 700px;
        overflow: auto;
        border: 2px solid teal;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        overflow: hidden

        /* Hide scrollbar for WebKit browsers */
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none;  /* IE and Edge */
    }
    .iframe-wrapper::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
        overflow: hidden
    }

    iframe {
        width: 100%;
        height: 1250px; /* taller than wrapper for scroll */
        border: none;
        display: block;
        pointer-events: none; /* Disable user interaction (locks iframe scroll & clicks) */
        overflow: hidden
    }
    .iframe-fixed {
        position: fixed;
        top: 80px; /* adjust based on header height */
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 1200px;
        height: 700px;
        z-index: 999;
        border: 2px solid teal;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        background: #fff;
    }

    .iframe-fixed iframe {
        width: 100%;
        height: 100%;
        border: none;
        pointer-events: auto;
    }

</style>

<div class="content" style="background-color:#f5f5f5; min-height: 80vh;">
    <div class="container py-4">
        <h1 class="h4 fw-bold text-dark mb-4" style="color: teal;">
            Panel Clinic Finder
        </h1>

        <div class="iframe-wrapper" id="iframeWrapper">
            <iframe
                    src="https://www.peoplenpartners.com/panel-clinic"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
            style="overflow:hidden; pointer-events: auto; width: 100%; height: 1250px; border:none;">
            </iframe>

        </div>
    </div>
</div>

<script>
    // Scroll the wrapper div to middle vertically and horizontally when page loads
    window.addEventListener('load', () => {
        const wrapper = document.getElementById('iframeWrapper');
        wrapper.scrollTop = (wrapper.scrollHeight - wrapper.clientHeight) / 2;
        wrapper.scrollLeft = (wrapper.scrollWidth - wrapper.clientWidth) / 2;
    });
</script>

<?php include '../layouts/footer.php'; ?>
