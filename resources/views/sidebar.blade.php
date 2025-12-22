<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* 1. DASAR SIDEBAR */
    .sidebar {
        width: 260px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: fixed;
        /* Melayang di HP */
        left: 0;
        top: 0;
        z-index: 50;
        transition: transform 0.3s ease-in-out;
        transform: translateX(-100%);
        /* Sembunyi ke kiri (HP) */
    }

    /* Tampilan di Desktop (Laptop) */
    @media (min-width: 1024px) {
        .sidebar {
            position: fixed;
            /* Tetap fixed tapi tidak sembunyi */
            transform: translateX(0);
        }
    }

    /* Class untuk buka sidebar di HP */
    .sidebar.open {
        transform: translateX(0);
    }

    /* 2. TOMBOL HAMBURGER (Hanya muncul di HP) */
    #toggleSidebar {
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
        #toggleSidebar {
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
    }
</style>

<button id="toggleSidebar">
    <i class="fas fa-bars"></i>
</button>

<div id="sidebarOverlay" class="sidebar-overlay"></div>

<div id="mainSidebar" class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('img/logonavbar1.png') }}" alt="Logo" style="width: 120px;">
    </div>

    <ul class="sidebar-menu">
        <li><a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('admin.aduan') }}" class="{{ request()->routeIs('admin.aduan') ? 'active' : '' }}">Aduan
                Fasilitas</a></li>
        <li><a href="/admin/layanan" class="{{ request()->is('admin/layanan*') ? 'active' : '' }}">Pelayanan Kampus</a>
        </li>
        <li><a href="/admin/laporan" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">Laporan</a></li>
        <li>
            <a href="/admin/bantuan" class="{{ request()->is('admin/bantuan*') ? 'active' : '' }}">Bantuan</a>
        </li>
        <li><a href="/admin/pengaturan" class="{{ request()->is('admin/pengaturan*') ? 'active' : '' }}">Pengaturan</a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a onclick="event.preventDefault(); this.closest('form').submit();" style="cursor:pointer">
                <i class="fas fa-right-from-bracket"></i> Log out
            </a>
        </form>
    </div>
</div>

<script>
    const btn = document.getElementById('toggleSidebar');
    const side = document.getElementById('mainSidebar');
    const over = document.getElementById('sidebarOverlay');

    btn.addEventListener('click', () => {
        side.classList.toggle('open');
        over.classList.toggle('active');
    });

    over.addEventListener('click', () => {
        side.classList.remove('open');
        over.classList.remove('active');
    });
</script>
