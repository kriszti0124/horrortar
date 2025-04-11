<style>
    footer {
        width: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 2rem 0;
        color: #fff;
        position: relative;
    }

    .footer-content {
        bottom: 0;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .footer-logo a {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff;
        text-decoration: none;
    }

    .footer-links {
        display: flex;
        gap: 3rem;
    }

    .footer-links a {
        color: #fff;
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.3s;
    }

    .footer-links a:hover {
        color: #e74c3c;
    }

    .footer-social {
        display: flex;
        gap: 1rem;
    }

    .footer-social .social-icon {
        font-size: 1.5rem;
        color: #fff;
        transition: color 0.3s;
    }

    .footer-social .social-icon:hover {
        color: #e74c3c;
    }

    @media(max-width: 992px) {
        .footer-content {
            flex-direction: column;
            text-align: center;
        }

        .footer-links {
            margin-top: 1rem;
        }

        .footer-social {
            margin-top: 1rem;
        }
    }
    
    @media(max-width: 576px) {
        .footer-links {
            margin-left: 3px;
            margin-right: 13px;
        }
    }
</style>

<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <a href=https://horrortar.hu/>Horrortár</a>
        </div>
        <div class="footer-links">
            <a href="#" onclick="downloadFile('/pdf/aszf.pdf')">Általános szerződési feltételek</a>
            <a href="#" onclick="downloadFile('/pdf/adatvedelmi-szabalyzat.pdf')">Adatvédelmi szabályzat</a>
            <a href="#">GY.I.K.</a>
        </div>
        <div class="footer-social">
            <a href="#" class="social-icon"><i class='bx bxl-facebook'></i></a>
            <a href="#" class="social-icon"><i class='bx bxl-tiktok'></i></i></a>
            <a href="#" class="social-icon"><i class='bx bxl-instagram'></i></a>
        </div>
    </div>
</footer>

<script>
    function downloadFile(filePath) {
        const link = document.createElement('a');
        link.href = filePath;
        link.download = filePath.split('/').pop(); // pl. aszf.pdf
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
