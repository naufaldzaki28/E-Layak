<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .footer {
        background-color: #EBEAEA;
        padding: 10px 80px;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-top: 1px solid #e5e7eb;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .footer-left {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 200px;
    }

    .footer-logo {
        width: 120px;
        height: auto;
    }

    .social-icons {
        display: flex;
        gap: 15px;
    }

    .social-icons a {
        color: #6b7280;
        font-size: 1.2rem;
        transition: color 0.3s;
    }

    .social-icons a:hover {
        color: #0e4f61;
    }

    .footer-cols {
        display: flex;
        gap: 150px;
    }

    @media (max-width: 768px) {
        .footer {
            flex-direction: column;
            gap: 30px;
        }

        .footer-cols {
            flex-direction: column;
            gap: 30px;
        }
    }

    .footer-col h4 {
        color: #1f2937;
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 1rem;
    }

    .footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-col ul li {
        margin-bottom: 10px;
    }

    .footer-col ul li a {
        text-decoration: none;
        color: #6b7280;
    }

    .footer-col ul li a:hover {
        color: #111827;
    }
</style>
<div class="footer">
    <div class="footer-left">
        <img src="{{ asset('img/logonavbar1.png') }}" alt="Logo Footer" class="footer-logo">

        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>

    <div class="footer-cols">
        <div class="footer-col">
            <h4>Menu</h4>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Fitur</a></li>
                <li><a href="#">Tentang</a></li>
                <li><a href="#">Hubungi</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Fitur</h4>
            <ul>
                <li><a href="#">Ringkasan Sistem</a></li>
                <li><a href="#">Pelayanan</a></li>
                <li><a href="#">Aduan</a></li>
                <li><a href="#">Laporan</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Layanan Lainnya</h4>
            <ul>
                <li><a href="#">Ketentuan Pengguna</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Pelajari</a></li>
                <li><a href="#">Bantuan</a></li>
                <li><a href="#">Hubungi Kami</a></li>
            </ul>
        </div>
    </div>
</div>
