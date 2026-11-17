
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Dashboard') - Andika Parking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --sidebar-bg: #111827;
            --sidebar-hover: #1e293b;
            --content-bg: #f1f5f9;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --sidebar-width: 270px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--content-bg);
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--text-main);
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #111827, #172554);
            color: white;
            padding: 22px 16px;
            overflow-y: auto;
            z-index: 1050;
            transition: transform .3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 5px 10px 25px;
            border-bottom: 1px solid rgba(255,255,255,.1);
            margin-bottom: 27px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            box-shadow: 0 5px 15px rgba(37,99,235,.3);
        }

        .brand h5 {
            font-weight: 800;
            margin: 0;
            font-size: 17px;
            letter-spacing: .3px;
        }

        .brand small {
            color: #94a3b8;
            font-size: 10px;
        }

        .sidebar-label {
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.4px;
            padding: 0 13px;
            margin: 22px 0 12px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            color: #cbd5e1;
            padding: 12px 14px;
            margin-bottom: 6px;
            border-radius: 11px;
            text-decoration: none;
            transition: all .2s ease;
            font-size: 13px;
            font-weight: 500;
        }

        .sidebar .nav-link i {
            font-size: 18px;
            width: 22px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,.08);
            color: white;
            transform: translateX(3px);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(37,99,235,.25);
        }

        .sidebar .nav-link .badge {
            margin-left: auto;
            font-size: 10px;
        }

        .logout-link {
            color: #fca5a5 !important;
            cursor: pointer;
        }

        .logout-link:hover {
            background: rgba(239,68,68,.15) !important;
            color: #fecaca !important;
        }

        /* MAIN */

        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */

        .topbar {
            background: rgba(255,255,255,.96);
            padding: 17px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 900;
            backdrop-filter: blur(12px);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar h5 {
            margin: 0;
            font-size: 19px;
            font-weight: 750;
            color: #0f172a;
        }

        .topbar small {
            color: var(--text-muted);
            font-size: 12px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 5px 12px 5px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #fff;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
        }

        .user-role {
            font-size: 10px;
            color: #64748b;
            text-transform: capitalize;
        }

        .btn-sidebar {
            border: none;
            background: #eff6ff;
            color: #2563eb;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            font-size: 21px;
            display: none;
        }

        /* CONTENT */

        .content {
            padding: 30px;
            flex: 1;
            min-width: 0;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h4 {
            font-size: 24px;
            font-weight: 750;
            margin-bottom: 6px;
            color: #0f172a;
        }

        .page-heading p {
            color: var(--text-muted);
            margin: 0;
            font-size: 13px;
        }

        /* CARD DAN TABEL */

        .card {
            border: 1px solid #e8edf4;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15,23,42,.035);
            overflow: hidden;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #edf0f5;
            padding: 17px 20px;
            font-weight: 700;
        }

        .card-body {
            padding: 20px;
        }

        .table-responsive {
            border-radius: 12px;
        }

        .table {
            vertical-align: middle;
            margin-bottom: 0;
        }

        .table thead th {
            font-size: 12px;
            color: #64748b;
            font-weight: 700;
            white-space: nowrap;
            background: #f8fafc;
            padding: 14px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .table tbody td {
            font-size: 13px;
            padding: 13px 15px;
            color: #334155;
        }

        .table tbody tr:hover {
            background: #f8fbff;
        }

        .btn {
            border-radius: 9px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border-color: #dbe2ea;
            padding: 10px 13px;
            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 .2rem rgba(37,99,235,.12);
        }

        .alert {
            border: none;
            border-radius: 12px;
            font-size: 13px;
            box-shadow: 0 3px 12px rgba(0,0,0,.03);
        }

        /* FOOTER */

        .app-footer {
            margin: 0 30px 25px;
            padding: 17px 22px;
            background: white;
            border: 1px solid #e8edf4;
            border-radius: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 12px;
            color: #64748b;
        }

        .app-footer strong {
            color: #2563eb;
        }

        /* OVERLAY */

        .sidebar-overlay {
            display: none;
        }

        /* RESPONSIVE */

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .btn-sidebar {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(15,23,42,.55);
                backdrop-filter: blur(2px);
                z-index: 1040;
            }

            .content {
                padding: 22px;
            }

            .topbar {
                padding: 14px 22px;
            }

            .app-footer {
                margin: 0 22px 22px;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                padding: 12px 15px;
            }

            .topbar h5 {
                font-size: 15px;
            }

            .topbar small {
                display: none;
            }

            .topbar-user {
                gap: 8px;
                padding: 4px 7px;
            }

            .user-name {
                font-size: 11px;
                max-width: 90px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .user-avatar {
                width: 34px;
                height: 34px;
                font-size: 17px;
            }

            .content {
                padding: 15px;
            }

            .page-heading h4 {
                font-size: 20px;
            }

            .card-body {
                padding: 15px;
            }

            .app-footer {
                margin: 0 15px 15px;
                font-size: 11px;
                padding: 14px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

@php
    $role = auth()->user()->role ?? '';

    $jumlahNotifikasi = auth()->check()
        ? \App\Models\Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->count()
        : 0;
@endphp

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">

    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-car-front-fill"></i>
        </div>

        <div>
            <h5>Andika Parking</h5>
            <small>Parking Management System</small>
        </div>
    </div>

    <div class="sidebar-label">Menu Utama</div>

    <nav class="nav flex-column">

        {{-- ADMIN --}}
        @if($role === 'admin')

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.anggota.index') }}"
               class="nav-link {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Data Anggota</span>
            </a>

            <a href="{{ route('admin.kendaraan.index') }}"
               class="nav-link {{ request()->routeIs('admin.kendaraan.*') ? 'active' : '' }}">
                <i class="bi bi-car-front-fill"></i>
                <span>Data Kendaraan</span>
            </a>

            <a href="{{ route('admin.parkir.index') }}"
               class="nav-link {{ request()->routeIs('admin.parkir.*') ? 'active' : '' }}">
                <i class="bi bi-p-square-fill"></i>
                <span>Data Parkir</span>
            </a>

            <a href="{{ route('admin.tarif.index') }}"
               class="nav-link {{ request()->routeIs('admin.tarif.*') ? 'active' : '' }}">
                <i class="bi bi-cash-stack"></i>
                <span>Data Tarif</span>
            </a>

            <a href="{{ route('admin.laporan.index') }}"
               class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Laporan Parkir</span>
            </a>

            <a href="{{ route('admin.validasi.index') }}"
               class="nav-link {{ request()->routeIs('admin.validasi.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i>
                <span>Validasi Transaksi</span>
            </a>

            <a href="{{ route('admin.log-aktivitas.index') }}"
               class="nav-link {{ request()->routeIs('admin.log-aktivitas.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                <span>Log Aktivitas</span>
            </a>

        {{-- PETUGAS --}}
        @elseif($role === 'petugas')

            <a href="{{ route('petugas.dashboard') }}"
               class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('petugas.parkir.index') }}"
               class="nav-link {{ request()->routeIs('petugas.parkir.index') ? 'active' : '' }}">
                <i class="bi bi-list-ul"></i>
                <span>Data Parkir</span>
            </a>

            <a href="{{ route('petugas.parkir.create') }}"
               class="nav-link {{ request()->routeIs('petugas.parkir.create') ? 'active' : '' }}">
                <i class="bi bi-car-front-fill"></i>
                <span>Kendaraan Masuk</span>
            </a>

        {{-- OWNER --}}
        @elseif($role === 'owner')

            <a href="{{ route('owner.dashboard') }}"
               class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('owner.laporan.index') }}"
               class="nav-link {{ request()->routeIs('owner.laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Laporan Parkir</span>
            </a>

            <a href="{{ route('owner.rekap-transaksi.index') }}"
               class="nav-link {{ request()->routeIs('owner.rekap-transaksi.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-range"></i>
                <span>Rekap Transaksi</span>
            </a>

        @endif

        {{-- INFORMASI --}}
        <div class="sidebar-label">Informasi</div>

        <a href="{{ route('notifikasi.index') }}"
           class="nav-link {{ request()->routeIs('notifikasi.*') ? 'active' : '' }}">
            <i class="bi bi-bell-fill"></i>
            <span>Notifikasi</span>

            @if($jumlahNotifikasi > 0)
                <span class="badge rounded-pill bg-danger">{{ $jumlahNotifikasi }}</span>
            @endif
        </a>

        {{-- AKUN --}}
        <div class="sidebar-label">Akun</div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit"
                    class="nav-link logout-link w-100 border-0 bg-transparent text-start"
                    onclick="return confirm('Apakah Anda yakin ingin logout?')">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>

    </nav>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- MAIN WRAPPER --}}
<div class="main-wrapper">

   
{{-- HEADER --}}
@php
    $notifikasiTerbaru = \App\Models\Notifikasi::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

    $jumlahNotifikasi = \App\Models\Notifikasi::where('user_id', auth()->id())
        ->where('dibaca', false)
        ->count();
@endphp

<header class="topbar">

    <div class="topbar-left">

        <button class="btn-sidebar" id="sidebarToggle" type="button">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <h5>@yield('page-title', 'Dashboard')</h5>
            <small>
                <i class="bi bi-house-door me-1"></i>
                Sistem Informasi Parkir Andika Parking
            </small>
        </div>

    </div>

    <div class="topbar-user">

        {{-- NOTIFIKASI --}}
        <div class="dropdown me-3">

            <button
                class="btn btn-light position-relative rounded-circle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                title="Notifikasi">

                <i class="bi bi-bell fs-5"></i>

                @if($jumlahNotifikasi > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $jumlahNotifikasi > 99 ? '99+' : $jumlahNotifikasi }}
                    </span>
                @endif

            </button>

            <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0"
                 style="width: 320px; max-width: 90vw;">

                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <strong>Notifikasi</strong>

                    <span class="badge bg-primary">
                        {{ $jumlahNotifikasi }} Baru
                    </span>
                </div>

                <div style="max-height: 350px; overflow-y: auto;">

                    @forelse($notifikasiTerbaru as $notifikasi)

                        <a href="{{ route('notifikasi.index') }}"
                           class="dropdown-item p-3 border-bottom text-wrap
                           {{ !$notifikasi->dibaca ? 'bg-light' : '' }}">

                            <div class="d-flex align-items-start gap-2">

                                <i class="bi bi-bell-fill text-primary mt-1"></i>

                                <div>
                                    <strong class="d-block">
                                        {{ $notifikasi->judul }}
                                    </strong>

                                    <small class="text-muted d-block">
                                        {{ \Illuminate\Support\Str::limit($notifikasi->pesan, 90) }}
                                    </small>

                                    <small class="text-secondary">
                                        {{ $notifikasi->created_at->diffForHumans() }}
                                    </small>
                                </div>

                            </div>

                        </a>

                    @empty

                        <div class="text-center p-4">
                            <i class="bi bi-bell-slash fs-2 text-muted"></i>
                            <p class="mb-0 mt-2 text-muted">
                                Belum ada notifikasi
                            </p>
                        </div>

                    @endforelse

                </div>

                <a href="{{ route('notifikasi.index') }}"
                   class="dropdown-item text-center text-primary fw-semibold p-3 border-top">

                    Lihat Semua Notifikasi
                </a>

            </div>

        </div>

        {{-- INFORMASI PENGGUNA --}}
        <div class="text-end">
            <div class="user-name">
                {{ auth()->user()->name ?? 'Pengguna' }}
            </div>

            <div class="user-role">
                <i class="bi bi-shield-check me-1"></i>
                {{ ucfirst($role) }}
            </div>
        </div>

        <div class="user-avatar">
            <i class="bi bi-person-fill"></i>
        </div>

    </div>

</header>


    {{-- CONTENT --}}
    <main class="content">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}

                <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    Terjadi kesalahan:
                </strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @include('components.notifikasi')

        @yield('content')

    </main>

    {{-- FOOTER --}}
    <footer class="app-footer">

        <div>
            <strong>
                <i class="bi bi-car-front-fill me-1"></i>
                Andika Parking
            </strong>
            <span class="ms-2">Parking Management System</span>
        </div>

        <div>
            &copy; {{ date('Y') }} Andika Parking. All Rights Reserved.
        </div>

    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }

    toggle.addEventListener('click', function () {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    });

    overlay.addEventListener('click', closeSidebar);

    document.querySelectorAll('.sidebar .nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 992) {
                closeSidebar();
            }
        });
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            closeSidebar();
        }
    });
</script>

@stack('scripts')

</body>
</html>
