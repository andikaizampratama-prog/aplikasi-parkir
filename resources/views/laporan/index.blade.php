
@extends('layouts.role')

@section('title', 'Laporan Parkir')
@section('page-title', 'Laporan Parkir')

@section('content')

<style>
    .laporan-page {
        --laporan-border: #e5eaf1;
        --laporan-text: #1e293b;
    }

    .laporan-page .laporan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .laporan-page .laporan-title {
        font-weight: 800;
        color: var(--laporan-text);
        letter-spacing: -.4px;
    }

    .laporan-page .laporan-subtitle {
        font-size: 14px;
        color: #64748b;
    }

    /* HERO */
    .laporan-hero {
        background: linear-gradient(120deg, #1d4ed8, #2563eb, #0ea5e9);
        color: #fff;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(37,99,235,.15);
    }

    .laporan-hero::after {
        content: "";
        width: 180px;
        height: 180px;
        position: absolute;
        top: -65px;
        right: -45px;
        background: rgba(255,255,255,.09);
        border-radius: 50%;
    }

    .laporan-hero-content {
        position: relative;
        z-index: 1;
    }

    .laporan-hero-icon {
        width: 54px;
        height: 54px;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        margin-bottom: 14px;
    }

    /* FILTER */
    .laporan-filter {
        border: 1px solid var(--laporan-border);
        border-radius: 18px;
        background: #fff;
        margin-bottom: 24px;
    }

    .laporan-filter .card-body {
        padding: 22px;
    }

    .laporan-filter .form-control {
        border-radius: 11px;
        min-height: 43px;
        border-color: #dbe3ed;
    }

    .laporan-filter .form-control:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }

    .btn-filter {
        border-radius: 11px;
        min-height: 43px;
        font-weight: 600;
    }

    /* STATISTIK */
    .laporan-stat-card {
        border: 1px solid var(--laporan-border);
        border-radius: 18px;
        background: #fff;
        transition: .25s;
    }

    .laporan-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(15,23,42,.06) !important;
    }

    .laporan-stat-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        font-size: 23px;
    }

    .laporan-stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
    }

    .laporan-stat-number {
        font-size: 25px;
        font-weight: 800;
        color: #1e293b;
        word-break: break-word;
    }

    /* TABLE */
    .laporan-table-card {
        border: 1px solid var(--laporan-border);
        border-radius: 18px;
        background: #fff;
        overflow: hidden;
    }

    .laporan-table {
        width: 100%;
        margin-bottom: 0;
    }

    .laporan-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 14px 12px;
        white-space: nowrap;
        border-bottom: 1px solid #e5eaf1;
    }

    .laporan-table tbody td {
        padding: 13px 12px;
        font-size: 12px;
        vertical-align: middle;
    }

    .laporan-table tbody tr:hover {
        background: #f8fbff;
    }

    .laporan-plat {
        display: inline-block;
        background: #1e293b;
        color: #fff;
        border-radius: 8px;
        padding: 6px 10px;
        font-weight: 700;
        letter-spacing: .5px;
        white-space: nowrap;
    }

    .laporan-jenis {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 8px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .jenis-motor {
        background: #eff6ff;
        color: #2563eb;
    }

    .jenis-mobil {
        background: #ecfeff;
        color: #0891b2;
    }

    .laporan-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-selesai {
        background: #dcfce7;
        color: #166534;
    }

    .status-aktif {
        background: #fef3c7;
        color: #92400e;
    }

    .laporan-card-header {
        padding: 20px;
        border-bottom: 1px solid #e5eaf1;
        background: #fff;
    }

    .laporan-footer {
        padding: 16px 20px;
        background: #f8fafc;
        border-top: 1px solid #e5eaf1;
    }

    @media (max-width: 767px) {
        .laporan-hero {
            padding: 21px;
        }

        .laporan-stat-number {
            font-size: 21px;
        }

        .laporan-filter .card-body {
            padding: 17px;
        }

        .laporan-header-actions {
            width: 100%;
        }

        .laporan-header-actions .btn {
            flex: 1;
        }
    }

    /* CETAK */
    @media print {
        body {
            background: #fff !important;
        }

        .sidebar,
        .topbar,
        nav,
        .laporan-filter,
        .laporan-header-actions,
        .btn,
        footer {
            display: none !important;
        }

        .laporan-page {
            width: 100%;
        }

        .laporan-hero {
            background: #fff !important;
            color: #000 !important;
            border: 1px solid #ccc;
            box-shadow: none !important;
        }

        .laporan-hero p {
            color: #333 !important;
        }

        .laporan-stat-card,
        .laporan-table-card {
            box-shadow: none !important;
            border: 1px solid #ccc !important;
        }

        .laporan-table thead th {
            background: #eee !important;
            color: #000 !important;
        }

        .laporan-table tbody td {
            color: #000 !important;
        }

        .laporan-plat {
            background: #eee !important;
            color: #000 !important;
            border: 1px solid #aaa;
        }

        .laporan-table-card {
            overflow: visible !important;
        }

        .table-responsive {
            overflow: visible !important;
        }
    }
</style>

<div class="laporan-page">

    {{-- HEADER --}}
    <div class="laporan-header">
        <div>
            <h4 class="laporan-title mb-1">
                <i class="bi bi-file-earmark-bar-graph text-primary me-2"></i>
                Laporan Parkir
            </h4>

            <p class="laporan-subtitle mb-0">
                Rekap transaksi, kendaraan, dan pendapatan parkir.
            </p>
        </div>

        <div class="d-flex gap-2 laporan-header-actions">
            <button type="button"
                    onclick="window.print()"
                    class="btn btn-outline-primary rounded-3">
                <i class="bi bi-printer me-1"></i>
                Cetak Laporan
            </button>

            <a href="{{ auth()->user()->role === 'owner'
                ? route('owner.dashboard')
                : (auth()->user()->role === 'admin'
                    ? route('admin.dashboard')
                    : route('petugas.dashboard')) }}"
               class="btn btn-outline-secondary rounded-3">
                <i class="bi bi-arrow-left me-1"></i>
                Dashboard
            </a>
        </div>
    </div>

    {{-- HERO --}}
    <div class="laporan-hero">
        <div class="laporan-hero-content">

            <div class="laporan-hero-icon">
                <i class="bi bi-clipboard-data"></i>
            </div>

            <h3 class="fw-bold mb-2">
                Ringkasan Laporan Parkir
            </h3>

            <p class="mb-0 text-white-50">
                Pantau aktivitas parkir dan pendapatan berdasarkan periode tanggal.
            </p>

        </div>
    </div>

    {{-- FILTER TANGGAL --}}
    <div class="card laporan-filter shadow-sm">
        <div class="card-body">

            <div class="mb-3">
                <h6 class="fw-bold mb-1">
                    <i class="bi bi-calendar-range text-primary me-2"></i>
                    Filter Periode Laporan
                </h6>

                <small class="text-muted">
                    Pilih rentang tanggal untuk menampilkan laporan.
                </small>
            </div>

            <form action="{{ route('owner.laporan.index') }}" method="GET">
                <div class="row g-3 align-items-end">

                    <div class="col-lg-4 col-md-5">
                        <label class="form-label fw-semibold small">
                            Tanggal Mulai
                        </label>

                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control"
                               value="{{ $tanggalMulai }}">
                    </div>

                    <div class="col-lg-4 col-md-5">
                        <label class="form-label fw-semibold small">
                            Tanggal Selesai
                        </label>

                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control"
                               value="{{ $tanggalSelesai }}">
                    </div>

                    <div class="col-lg-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-filter flex-grow-1">
                            <i class="bi bi-search me-1"></i>
                            Filter
                        </button>

                        <a href="{{ route('owner.laporan.index') }}"
                           class="btn btn-outline-secondary btn-filter">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>

    {{-- STATISTIK --}}
    @php
        $jumlahTransaksi = $parkirs->count();
        $totalPendapatan = $parkirs->sum('biaya');
        $rataPendapatan = $jumlahTransaksi > 0
            ? $totalPendapatan / $jumlahTransaksi
            : 0;

        $jumlahMotor = $parkirs->filter(function ($item) {
            return strtolower($item->kendaraan->jenis ?? '') === 'motor';
        })->count();

        $jumlahMobil = $parkirs->filter(function ($item) {
            return strtolower($item->kendaraan->jenis ?? '') === 'mobil';
        })->count();
    @endphp

    <div class="row g-3 mb-4">

        {{-- TOTAL TRANSAKSI --}}
        <div class="col-xl-4 col-md-6">
            <div class="card laporan-stat-card shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="laporan-stat-label mb-2">
                                Total Transaksi
                            </div>

                            <div class="laporan-stat-number">
                                {{ number_format($jumlahTransaksi, 0, ',', '.') }}
                            </div>

                            <small class="text-muted">
                                <i class="bi bi-receipt me-1"></i>
                                Transaksi selesai
                            </small>
                        </div>

                        <div class="laporan-stat-icon bg-primary-subtle text-primary">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- PENDAPATAN --}}
        <div class="col-xl-4 col-md-6">
            <div class="card laporan-stat-card shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="laporan-stat-label mb-2">
                                Total Pendapatan
                            </div>

                            <div class="laporan-stat-number text-success">
                                Rp{{ number_format($totalPendapatan, 0, ',', '.') }}
                            </div>

                            <small class="text-muted">
                                <i class="bi bi-cash-stack me-1"></i>
                                Akumulasi biaya parkir
                            </small>
                        </div>

                        <div class="laporan-stat-icon bg-success-subtle text-success">
                            <i class="bi bi-wallet2"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- RATA RATA --}}
        <div class="col-xl-4 col-md-6">
            <div class="card laporan-stat-card shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="laporan-stat-label mb-2">
                                Rata-rata Transaksi
                            </div>

                            <div class="laporan-stat-number text-info">
                                Rp{{ number_format($rataPendapatan, 0, ',', '.') }}
                            </div>

                            <small class="text-muted">
                                <i class="bi bi-graph-up me-1"></i>
                                Pendapatan per transaksi
                            </small>
                        </div>

                        <div class="laporan-stat-icon bg-info-subtle text-info">
                            <i class="bi bi-bar-chart-line"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- STATISTIK JENIS KENDARAAN --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card laporan-stat-card shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">

                        <div class="laporan-stat-icon bg-primary-subtle text-primary">
                            <i class="bi bi-bicycle"></i>
                        </div>

                        <div>
                            <small class="text-muted fw-semibold">
                                Transaksi Motor
                            </small>

                            <h4 class="fw-bold mb-0">
                                {{ $jumlahMotor }}
                                <small class="text-muted fs-6">transaksi</small>
                            </h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card laporan-stat-card shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3">

                        <div class="laporan-stat-icon bg-info-subtle text-info">
                            <i class="bi bi-car-front-fill"></i>
                        </div>

                        <div>
                            <small class="text-muted fw-semibold">
                                Transaksi Mobil
                            </small>

                            <h4 class="fw-bold mb-0">
                                {{ $jumlahMobil }}
                                <small class="text-muted fs-6">transaksi</small>
                            </h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL LAPORAN --}}
    <div class="card laporan-table-card shadow-sm">

        {{-- HEADER TABEL --}}
        <div class="laporan-card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-table text-primary me-2"></i>
                        Detail Transaksi Parkir
                    </h5>

                    <small class="text-muted">
                        Daftar kendaraan yang telah menyelesaikan parkir.
                    </small>
                </div>

                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                    {{ $jumlahTransaksi }} Transaksi
                </span>

            </div>
        </div>

        {{-- TABEL --}}
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-hover laporan-table">

                    <thead>
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Kendaraan</th>
                            <th>Plat Nomor</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Durasi</th>
                            <th>Biaya</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($parkirs as $parkir)

                        @php
                            $jenis = strtolower($parkir->kendaraan->jenis ?? '');
                        @endphp

                        <tr>

                            {{-- NOMOR --}}
                            <td class="ps-4 text-muted">
                                {{ $loop->iteration }}
                            </td>

                            {{-- JENIS --}}
                            <td>
                                <span class="laporan-jenis {{ $jenis === 'motor' ? 'jenis-motor' : 'jenis-mobil' }}">
                                    <i class="bi {{ $jenis === 'motor' ? 'bi-bicycle' : 'bi-car-front-fill' }} me-1"></i>
                                    {{ ucfirst($jenis ?: '-') }}
                                </span>
                            </td>

                            {{-- PLAT --}}
                            <td>
                                <span class="laporan-plat">
                                    {{ $parkir->kendaraan->plat_nomor ?? '-' }}
                                </span>
                            </td>

                            {{-- MASUK --}}
                            <td>
                                @if($parkir->waktu_masuk)
                                    <div class="fw-semibold text-dark">
                                        {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d/m/Y') }}
                                    </div>

                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($parkir->waktu_masuk)->format('H:i') }}
                                    </small>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- KELUAR --}}
                            <td>
                                @if($parkir->waktu_keluar)
                                    <div class="fw-semibold text-dark">
                                        {{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format('d/m/Y') }}
                                    </div>

                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($parkir->waktu_keluar)->format('H:i') }}
                                    </small>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- DURASI --}}
                            <td>
                                <span class="fw-semibold">
                                    {{ $parkir->durasi ?? '-' }}
                                </span>
                            </td>

                            {{-- BIAYA --}}
                            <td>
                                <span class="fw-bold text-success text-nowrap">
                                    Rp{{ number_format($parkir->biaya ?? 0, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($parkir->status == 'keluar')
                                    <span class="laporan-status status-selesai">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Selesai
                                    </span>
                                @else
                                    <span class="laporan-status status-aktif">
                                        <i class="bi bi-hourglass-split me-1"></i>
                                        Aktif
                                    </span>
                                @endif
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-5">

                                <div class="mb-2">
                                    <i class="bi bi-inbox display-4 text-secondary opacity-50"></i>
                                </div>

                                <h6 class="fw-bold text-secondary mb-1">
                                    Belum Ada Data Transaksi
                                </h6>

                                <small class="text-muted">
                                    Data transaksi akan muncul setelah kendaraan menyelesaikan parkir.
                                </small>

                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>
        </div>

        {{-- FOOTER --}}
        <div class="laporan-footer">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <small class="text-muted">
                    <i class="bi bi-database me-1"></i>
                    Menampilkan {{ $jumlahTransaksi }} transaksi parkir.
                </small>

                <small class="text-muted">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }}
                    –
                    {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y') }}
                </small>

            </div>
        </div>

    </div>

</div>

@endsection
