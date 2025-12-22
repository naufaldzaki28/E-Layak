<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* 1. DASAR SIDEBAR (RESPONSIF) */
    .sidebar {
        width: 260px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: fixed;
        /* Fixed agar melayang di HP */
        left: 0;
        top: 0;
        z-index: 50;
        transition: transform 0.3s ease-in-out;
        transform: translateX(-100%);
        /* Sembunyi di kiri (Default HP) */
    }

    /* Tampilkan Sidebar permanen di layar Laptop (Desktop) */
    @media (min-width: 1024px) {
        .sidebar {
            position: fixed;
            transform: translateX(0);
            /* Tampil normal */
        }
    }

    /* Class untuk membuka sidebar di HP */
    .sidebar.open {
        transform: translateX(0);
    }

    /* 2. TOMBOL HAMBURGER (Hanya muncul di HP) */
    #toggleSidebarMahasiswa {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 60;
        background: #1d4ed8;
        color: white;
        border: none;
        padding: 10px 12px;
        border-radius: 8px;
        cursor: pointer;
        display: block;
    }

    @media (min-width: 1024px) {
        #toggleSidebarMahasiswa {
            display: none;
        }

        /* Sembunyi di Laptop */
    }

    /* 3. OVERLAY (Layar Gelap saat Sidebar Buka di HP) */
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 40;
        display: none;
    }

    .sidebar-overlay.active {
        display: block;
    }

    /* 4. STYLING MENU (Gunakan kodingan asli kamu) */
    .sidebar-header {
        margin-bottom: 32px;
        display: flex;
        align-items: center;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        flex: 1;
    }

    .sidebar-menu li {
        margin-bottom: 8px;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 12px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        transition: all 0.25s ease;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
        background: #e0e7ff;
        color: #1d4ed8;
        font-weight: 600;
    }

    .sidebar-footer {
        border-top: 1px solid #e5e7eb;
        padding-top: 16px;
    }

    .sidebar-footer a {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #dc2626;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<button id="toggleSidebarMahasiswa">
    <i class="fas fa-bars"></i>
</button>

<div id="sidebarOverlayMahasiswa" class="sidebar-overlay"></div>

<div id="mainSidebarMahasiswa" class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('img/logonavbar1.png') }}" alt="E-Layak Logo" style="width: 120px; height: auto;">
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('mahasiswa.dashboard') }}"
                class="{{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home mr-3"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="/mahasiswa/aduan" class="{{ request()->is('mahasiswa/aduan*') ? 'active' : '' }}">
                <i class="fas fa-edit mr-3"></i> Buat Aduan
            </a>
        </li>
        <li>
            <a href="/mahasiswa/layanan" class="{{ request()->is('mahasiswa/layanan*') ? 'active' : '' }}">
                <i class="fas fa-concierge-bell mr-3"></i> Layanan Kampus
            </a>
        </li>
        <li>
            <a href="/mahasiswa/riwayat" class="{{ request()->is('mahasiswa/riwayat*') ? 'active' : '' }}">
                <i class="fas fa-history mr-3"></i> Riwayat Pengajuan
            </a>
        </li>
        <li>
            <a href="/mahasiswa/bantuan" class="{{ request()->is('mahasiswa/bantuan*') ? 'active' : '' }}">
                <i class="fas fa-question-circle mr-3"></i> Pusat Bantuan
            </a>
        </li>
        <li>
            <a href="/profile" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="fas fa-user mr-3"></i> Profil Saya
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="fas fa-right-from-bracket mr-2"></i> Log out
            </a>
        </form>
    </div>
</div>

<script>
    const btnMahasiswa = document.getElementById('toggleSidebarMahasiswa');
    const sideMahasiswa = document.getElementById('mainSidebarMahasiswa');
    const overMahasiswa = document.getElementById('sidebarOverlayMahasiswa');

    btnMahasiswa.addEventListener('click', () => {
        sideMahasiswa.classList.toggle('open');
        overMahasiswa.classList.toggle('active');
    });

    overMahasiswa.addEventListener('click', () => {
        sideMahasiswa.classList.remove('open');
        overMahasiswa.classList.remove('active');
    });
</script>
