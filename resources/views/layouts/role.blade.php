
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
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --sidebar-width: 265px;
            --sidebar-bg: #101828;
            --body-bg: #f4f7fc;
            --text-main: #1e293b;
            --text-muted: #8491a5;
            --border-color: #e8edf5;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--body-bg);
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* ==============================
           ANIMATION GLOBAL
        ============================== */

        @keyframes pageEnter {
            from {
                opacity:  0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(-12px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(.96) translateY(8px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ==============================
           PAGE LOADER
        ============================== */

        .page-loader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
            background: rgba(244,247,252,.92);
            backdrop-filter: blur(10px);
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease, visibility .25s ease;
        }

        .page-loader.show {
            opacity: 1;
            visibility: visible;
        }

        .loader-logo {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: linear-gradient(135deg, #60a5fa, #2563eb, #1e40af);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            box-shadow: 0 12px 35px rgba(37,99,235,.25);
            animation: popIn .4s ease;
        }

        .loader-spinner {
            width: 25px;
            height: 25px;
            border: 3px solid #dbeafe;
            border-top-color: #2563eb;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        .loader-text {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            letter-spacing: .4px;
        }

        /* ==============================
           SIDEBAR
        ============================== */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-width);
            height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(59,130,246,.13), transparent 35%),
                linear-gradient(160deg, #101828, #111c32 60%, #101828);
            color: white;
            padding: 22px 15px;
            overflow-y: auto;
            z-index: 1050;
            transition: transform .35s cubic-bezier(.22,1,.36,1);
            scrollbar-width: thin;
            scrollbar-color: #334155 transparent;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 7px 10px 24px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            margin-bottom: 25px;
        }

        .brand-icon {
            width: 49px;
            height: 49px;
            flex-shrink: 0;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            background: linear-gradient(135deg, #60a5fa, #2563eb, #1d4ed8);
            box-shadow: 0 7px 24px rgba(37,99,235,.3);
            transition: transform .3s, box-shadow .3s;
        }

        .brand:hover .brand-icon {
            transform: rotate(-5deg) scale(1.07);
            box-shadow: 0 10px 30px rgba(37,99,235,.45);
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
            letter-spacing: .5px;
        }

        .sidebar-label {
            font-size: 10px;
            font-weight: 800;
            color: #66758c;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0 13px;
            margin: 22px 0 11px;
        }

        .sidebar .nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 13px;
            color: #aebbd0;
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 12px;
            text-decoration: none;
            transition:
                background .25s,
                color .25s,
                transform .25s,
                box-shadow .25s;
            font-size: 13px;
            font-weight: 550;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90, rgba(59,130,246,.09), transparent);
            opacity: 0;
            transition: opacity .25s;
        }

        .sidebar .nav-link i {
            position: relative;
            width: 22px;
            text-align: center;
            font-size: 17px;
            transition: transform .25s, color .25s;
        }

        .sidebar .nav-link span,
        .sidebar .nav-link .badge {
            position: relative;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,.055);
            color: #fff;
            transform: translateX(4px);
        }

        .sidebar .nav-link:hover::before {
            opacity: 1;
        }

        .sidebar .nav-link:hover i {
            transform: scale(1.12);
            color: #60a5fa;
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(110deg, #2563eb, #3b82f6);
            font-weight: 700;
            box-shadow: 0 6px 18px rgba(37,99,235,.22);
        }

        .sidebar .nav-link.active i {
            color: white;
        }

        .sidebar .nav-link.active::after {
            content: "";
            position: absolute;
            right: 0;
            width: 3px;
            height: 22px;
            border-radius: 5px 0 0 5px;
            background: white;
            opacity: .8;
        }

        .sidebar .nav-link .badge {
            margin-left: auto;
            font-size: 10px;
        }

        .logout-link {
            color: #fda4af !important;
            cursor: pointer;
            transition: all .25s !important;
        }

        .logout-link:hover {
            background: rgba(239,68,68,.12) !important;
            color: #fecaca !important;
        }

        .logout-link:hover i {
            color: #fb7185 !important;
        }

        /* ==============================
           MAIN WRAPPER
        ============================== */

        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin .3s;
        }

        /* ==============================
           TOPBAR
        ============================== */

        .topbar {
            background: rgba(255,255,255,.86);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(226,232,240,.8);
            position: sticky;
            top: 0;
            z-index: 900;
            backdrop-filter: blur(18px);
            box-shadow: 0 3px 20px rgba(15,23,42,.025);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar h5 {
            margin: 0;
            font-size: 19px;
            font-weight: 800;
            color: #101828;
            letter-spacing: -.3px;
        }

        .topbar small {
            color: var(--text-muted);
            font-size: 11px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 5px 8px 5px 12px;
            border: 1px solid #e9edf4;
            border-radius: 15px;
            background: white;
            box-shadow: 0 3px 12px rgba(15,23,42,.025);
            transition: box-shadow .25s, transform .25s;
        }

        .topbar-user:hover {
            box-shadow: 0 5px 18px rgba(15,23,42,.06);
            transform: translateY(-1px);
        }

        .user-avatar {
            width: 39px;
            height: 39px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #2563eb;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .user-name {
            font-size: 12px;
            font-weight: 800;
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
            border-radius: 12px;
            font-size: 20px;
            display: none;
            transition: all .2s;
        }

        .btn-sidebar:hover {
            background: #dbeafe;
            transform: scale(1.04);
        }

        /* ==============================
           NOTIFICATION
        ============================== */

        .notification-btn {
            width: 40px;
            height: 40px;
            border: 1px solid #edf0f5;
            background: #f8fafc;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .25s;
        }

        .notification-btn:hover {
            background: #eff6ff;
            color: #2563eb;
            transform: translateY(-2px);
        }

        .dropdown-menu {
            border: 1px solid #edf0f5 !important;
            border-radius: 15px !important;
            animation: popIn .22s ease both;
            overflow: hidden;
        }

        .notification-item {
            transition: background .2s;
        }

        .notification-item:hover {
            background: #eff6ff !important;
        }

        /* ==============================
           CONTENT
        ============================== */

        .content {
            padding: 30px;
            flex: 1;
            min-width: 0;
            animation: pageEnter .45s cubic-bezier(.22,1,.36,1) both;
        }

        .page-heading {
            margin-bottom: 25px;
            animation: slideRight .4s ease both;
        }

        .page-heading h4 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 6px;
            color: #101828;
            letter-spacing: -.5px;
        }

        .page-heading p {
            color: var(--text-muted);
            margin: 0;
            font-size: 13px;
        }

        /* ==============================
           CARD
        ============================== */

        .card {
            border: 1px solid #e9edf5;
            border-radius: 17px;
            box-shadow: 0 5px 24px rgba(15,23,42,.035);
            overflow: hidden;
            background: #fff;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .card:hover {
            box-shadow: 0 9px 30px rgba(15,23,42,.055);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #edf0f5;
            padding: 17px 20px;
            font-weight: 750;
        }

        .card-body {
            padding: 20px;
        }

        /* ==============================
           TABLE
        ============================== */

        .table-responsive {
            border-radius: 12px;
        }

        .table {
            vertical-align: middle;
            margin-bottom: 0;
        }

        .table thead th {
            font-size: 11px;
            color: #64748b;
            font-weight: 800;
            white-space: nowrap;
            background: #f8fafc;
            padding: 14px 15px;
            border-bottom: 1px solid #e2e8f0;
            text-transform: uppercase;
            letter-spacing: .35px;
        }

        .table tbody td {
            font-size: 13px;
            padding: 13px 15px;
            color: #334155;
        }

        .table tbody tr {
            transition: background .2s;
        }

        .table tbody tr:hover {
            background: #f6f9ff;
        }

        /* ==============================
           BUTTONS
        ============================== */

        .btn {
            border-radius: 10px;
            font-weight: 650;
            transition: transform .2s, box-shadow .2s, background .2s;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn:active {
            transform: scale(.96);
        }

        .btn-primary {
            box-shadow: 0 3px 10px rgba(37,99,235,.12);
        }

        /* ==============================
           FORM
        ============================== */

        .form-control,
        .form-select {
            border-radius: 11px;
            border-color: #dbe2ea;
            padding: 10px 13px;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s, transform .2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 .22rem rgba(37,99,235,.11);
        }

        /* ==============================
           ALERT
        ============================== */

        .alert {
            border: none;
            border-radius: 13px;
            font-size: 13px;
            box-shadow: 0 4px 15px rgba(0,0,0,.025);
            animation: popIn .35s ease both;
        }

        /* ==============================
           FOOTER
        ============================== */

        .app-footer {
            margin: 0 30px 25px;
            padding: 17px 22px;
            background: rgba(255,255,255,.9);
            border: 1px solid #e9edf5;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 11px;
            color: #8491a5;
        }

        .app-footer strong {
            color: #2563eb;
        }

        /* ==============================
           MOBILE OVERLAY
        ============================== */

        .sidebar-overlay {
            display: none;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 15px 0 40px rgba(15,23,42,.15);
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
                background: rgba(15,23,42,.48);
                backdrop-filter: blur(3px);
                z-index: 1040;
                animation: fadeIn .2s ease;
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
                padding: 12px 14px;
            }

            .topbar h5 {
                font-size: 15px;
            }

            .topbar small {
                display: none;
            }

            .topbar-user {
                gap: 7px;
                padding: 4px 6px;
            }

            .user-name {
                font-size: 10px;
                max-width: 85px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .user-avatar {
                width: 34px;
                height: 34px;
                font-size: 16px;
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
                font-size: 10px;
                padding: 13px;
            }
        }

        /* Kurangi animasi jika user memilih reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

{{-- LOADING TRANSITION --}}
<div class="page-loader" id="pageLoader">
    <div class="loader-logo">
        <i class="bi bi-car-front-fill"></i>
    </div>
    <div class="loader-spinner"></div>
    <div class="loader-text">Memuat Andika Parking...</div>
</div>

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
            <div class="dropdown me-2">

                <button class="btn notification-btn position-relative rounded-circle"
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
                        <span class="badge bg-primary">{{ $jumlahNotifikasi }} Baru</span>
                    </div>

                    <div style="max-height: 350px; overflow-y: auto;">

                        @forelse($notifikasiTerbaru as $notifikasi)

                            <a href="{{ route('notifikasi.index') }}"
                               class="dropdown-item notification-item p-3 border-bottom text-wrap
                               {{ !$notifikasi->dibaca ? 'bg-light' : '' }}">

                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-bell-fill text-primary mt-1"></i>

                                    <div>
                                        <strong class="d-block">{{ $notifikasi->judul }}</strong>
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
                                <p class="mb-0 mt-2 text-muted">Belum ada notifikasi</p>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
    const loader = document.getElementById('pageLoader');

    // SIDEBAR MOBILE
    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }

    if (toggle) {
        toggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    document.querySelectorAll('.sidebar a.nav-link').forEach(function (link) {
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

    // ANIMASI SAAT NAVIGASI MENU
    document.querySelectorAll('a[href]').forEach(function (link) {
        link.addEventListener('click', function (event) {

            // Abaikan link tab, dropdown, anchor, atau link eksternal
            const href = link.getAttribute('href');

            if (
                !href ||
                href.startsWith('#') ||
                link.target === '_blank' ||
                link.hasAttribute('data-bs-toggle') ||
                event.ctrlKey ||
                event.shiftKey ||
                event.altKey ||
                event.metaKey
            ) {
                return;
            }

            // Hanya animasikan navigasi halaman internal
            let url;

            try {
                url = new URL(href, window.location.href);
            } catch (e) {
                return;
            }

            if (url.origin !== window.location.origin) {
                return;
            }

            // Jangan tampilkan loading untuk link halaman yang sama
            if (url.href === window.location.href) {
                return;
            }

            loader.classList.add('show');
        });
    });

    // ANIMASI FORM SAAT SUBMIT
    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function () {

            // Form logout tetap memakai konfirmasi
            const submitButton = form.querySelector('[type="submit"]');

            if (submitButton && submitButton.classList.contains('logout-link')) {
                return;
            }

            // Tampilkan loading setelah form dikirim
            loader.classList.add('show');
        });
    });

    // Kembali dari browser: pastikan loader tidak tertinggal
    window.addEventListener('pageshow', function () {
        loader.classList.remove('show');
    });
</script>

@stack('scripts')

</body>
</html>
