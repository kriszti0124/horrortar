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
</style>

<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <a href=https://horrortar.hu/>Horrortár</a>
        </div>
        <div class="footer-links">
            <a href="#">Általános szerződési feltételek</a>
            <a href="#">Adatvédelmi szabályzat</a>
            <a href="#">GY.I.K.</a>
        </div>
        <div class="footer-social">
            <a href="#" class="social-icon"><i class='bx bxl-facebook'></i></a>
            <a href="#" class="social-icon"><i class='bx bxl-twitter'></i></a>
            <a href="#" class="social-icon"><i class='bx bxl-instagram'></i></a>
        </div>
    </div>
</footer>
