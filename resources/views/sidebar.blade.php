<style>
    /* CSS Sidebar tetap di sini agar ikut terpanggil saat komponen dipakai */
    .sidebar {
        width: 260px;
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .sidebar-header {
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        gap: 0px;
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

    .sidebar-menu a:hover {
        background: #f3f4f6;
        color: #1d4ed8;
        transform: translateX(4px);
    }

    /* Logic agar menu aktif warnanya beda */
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
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 14px;
        text-decoration: none;
        color: #dc2626;
        font-weight: 600;
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .sidebar-footer a:hover {
        background: #fee2e2;
        color: #b91c1c;
        transform: translateX(4px);
    }

    .sidebar-footer a i {
        transition: transform 0.25s ease;
    }

    .sidebar-footer a:hover i {
        transform: rotate(-10deg) scale(1.1);
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('img/logonavbar1.png') }}" alt="E-Layak Logo" style="width: 120px; height: auto;">
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.aduan') }}" class="{{ request()->routeIs('admin.aduan') ? 'active' : '' }}">
                Aduan Fasilitas
            </a>
        </li>

        <li>
            <a href="/admin/layanan" class="{{ request()->is('admin/layanan*') ? 'active' : '' }}">
                Pelayanan Kampus
            </a>
        </li>

        <li>
            <a href="/admin/laporan" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
                Laporan
            </a>
        </li>

        <li>
            <a href="/admin/bantuan" class="{{ request()->is('admin/bantuan*') ? 'active' : '' }}">
                Bantuan
            </a>
        </li>

        <li>
            <a href="/admin/pengaturan" class="{{ request()->is('admin/pengaturan*') ? 'active' : '' }}">
                Pengaturan
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="fas fa-right-from-bracket"></i>
                Log out
            </a>
        </form>
    </div>
</div>
