<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* 1. DASAR FOOTER (RESPONSIF) */
    .footer {
        background-color: #EBEAEA;
        padding: 60px 20px;
        font-family: 'Inter', Arial, sans-serif;
        display: flex;
        flex-direction: column;
        gap: 50px;
        border-top: 1px solid #e5e7eb;
        font-size: 0.9rem;
        color: #6b7280;
    }

    /* PENGATURAN LAPTOP - AGAR MERAPAT KE PINGGIR */
    @media (min-width: 1024px) {
        .footer {
            flex-direction: row;
            /* justify-between memaksa konten kiri mentok kiri, kanan mentok kanan */
            justify-content: space-between;
            /* Mengurangi padding samping (dari 100px ke 5%) agar lebih ke pinggir */
            padding: 60px 5%;
        }
    }

    /* 2. BAGIAN KIRI (LOGO & DESKRIPSI) */
    .footer-left {
        display: flex;
        flex-direction: column;
        /* Gap diperkecil dari 20px ke 8px agar tulisan naik mendekati logo */
        gap: 8px;
        max-width: 320px;
        text-align: left;
    }

    .footer-logo {
        width: 140px;
        height: auto;
        /* Menghilangkan sedikit margin default jika ada */
        margin-left: -4px;
    }

    .footer-desc {
        line-height: 1.5;
        font-size: 0.85rem;
        color: #4b5563;
        /* Memberi ruang sedikit sebelum icon sosmed */
        margin-bottom: 10px;
    }

    /* Icon Media Sosial */
    .social-icons {
        display: flex;
        gap: 12px;
    }

    .social-icons a {
        color: #6b7280;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        color: #1d4ed8;
        transform: translateY(-2px);
    }

    /* 3. BAGIAN KOLOM MENU */
    .footer-cols {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        width: 100%;
    }

    @media (max-width: 480px) {
        .footer-cols {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 1024px) {
        .footer-cols {
            display: flex;
            /* Memastikan kumpulan menu merapat ke arah kanan layar */
            justify-content: flex-end;
            width: auto;
            /* Jarak antar kolom menu (Menu Utama, Sistem, dll) */
            gap: 60px;
        }
    }

    .footer-col h4 {
        color: #1f2937;
        margin-bottom: 18px;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
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
        display: block;
        transition: all 0.2s ease;
    }

    .footer-col ul li a:hover {
        color: #1d4ed8;
        padding-left: 4px;
    }
</style>

<div class="footer">
    <div class="footer-left">
        <img src="{{ asset('img/logonavbar1.png') }}" alt="Logo E-Layak" class="footer-logo">

        <p class="footer-desc">
            Sistem Elektronik Layanan dan Aduan Fasilitas Kampus terintegrasi untuk kenyamanan dan kemajuan akademik
            civitas kampus.
        </p>

        <div class="social-icons">
            <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
            <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

    <div class="footer-cols">
        <div class="footer-col">
            <h4>Menu Utama</h4>
            <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="#">Fitur</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Hubungi</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Sistem</h4>
            <ul>
                <li><a href="#">Ringkasan</a></li>
                <li><a href="#">Pelayanan</a></li>
                <li><a href="#">Aduan Fasilitas</a></li>
                <li><a href="#">Laporan</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Pusat Informasi</h4>
            <ul>
                <li><a href="#">Ketentuan Layanan</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="{{ route('login') }}">Masuk Sistem</a></li>
                <li><a href="#">Pelajari</a></li>
                <li><a href="#">Bantuan</a></li>
            </ul>
        </div>
    </div>
</div>
