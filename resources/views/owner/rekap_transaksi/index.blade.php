
@extends('layouts.role')

@section('title', 'Rekap Transaksi')
@section('page-title', 'Rekap Transaksi')

@section('content')

<style>
    .rekap-page {
        color: #1e293b;
    }

    .rekap-page .rekap-hero {
        background: linear-gradient(135deg, #101d38, #1d4ed8, #0e7490);
        border-radius: 22px;
        padding: 28px 30px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 28px rgba(37, 99, 235, .15);
    }

    .rekap-hero::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border-radius: 50%;
        border: 35px solid rgba(255,255,255,.07);
        right: -65px;
        top: -95px;
    }

    .rekap-hero::before {
        content: "";
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,.04);
        right: 120px;
        bottom: -90px;
    }

    .rekap-hero-content {
        position: relative;
        z-index: 1;
    }

    .rekap-hero-icon {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.12);
        font-size: 25px;
        margin-bottom: 16px;
    }

    .rekap-hero h3 {
        font-weight: 800;
        letter-spacing: -.5px;
        margin-bottom: 7px;
    }

    .rekap-hero p {
        font-size: 13px;
        color: #dbeafe;
        margin-bottom: 0;
    }

    .rekap-hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255,255,255,.12);
        padding: 8px 13px;
        border-radius: 30px;
        font-size: 12px;
        margin-top: 16px;
    }

    /* FILTER */
    .rekap-filter-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 19px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
    }

    .rekap-section-heading {
        font-weight: 800;
        font-size: 15px;
        color: #1e293b;
    }

    .rekap-section-sub {
        font-size: 12px;
        color: #8491a5;
    }

    .rekap-page .form-label {
        font-size: 12px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
    }

    .rekap-page .form-control {
        min-height: 47px;
        border: 1px solid #dce4ee;
        background: #f8fafc;
        border-radius: 11px;
        font-size: 13px;
        transition: .2s;
    }

    .rekap-page .form-control:focus {
        background: #fff;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59,130,246,.09);
    }

    .rekap-btn-filter {
        min-height: 47px;
        border-radius: 11px;
        font-weight: 700;
        background: linear-gradient(135deg, #2563eb, #0e7490);
        border: none;
        box-shadow: 0 4px 12px rgba(37,99,235,.15);
    }

    .rekap-btn-filter:hover {
        background: linear-gradient(135deg, #1d4ed8, #0e7490);
    }

    /* STATISTIC */
    .rekap-stat-card {
        border: 1px solid #e8edf5;
        border-radius: 19px;
        background: white;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
        height: 100%;
        transition: .2s;
    }

    .rekap-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(15,23,42,.07);
    }

    .rekap-stat-inner {
        padding: 23px;
        display: flex;
        align-items: center;
        gap: 17px;
    }

    .rekap-stat-icon {
        width: 62px;
        height: 62px;
        flex-shrink: 0;
        border-radius: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
    }

    .rekap-stat-blue {
        background: #eaf2ff;
        color: #2563eb;
    }

    .rekap-stat-green {
        background: #e5f7ed;
        color: #159455;
    }

    .rekap-stat-label {
        color: #8491a5;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .rekap-stat-value {
        font-size: clamp(21px, 2.3vw, 29px);
        font-weight: 800;
        letter-spacing: -.5px;
        color: #1e293b;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .rekap-stat-value.money {
        color: #159455;
    }

    .rekap-stat-caption {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 5px;
    }

    /* TABLE CARD */
    .rekap-table-card {
        background: white;
        border: 1px solid #e8edf5;
        border-radius: 20px;
        box-shadow: 0 5px 18px rgba(15,23,42,.04);
        overflow: hidden;
    }

    .rekap-table-header {
        padding: 21px 24px;
        border-bottom: 1px solid #edf1f7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .rekap-table-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .rekap-table-title-icon {
        width: 43px;
        height: 43px;
        border-radius: 13px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .rekap-table-title h5 {
        font-size: 15px;
        font-weight: 800;
        margin: 0 0 4px;
    }

    .rekap-table-title small {
        font-size: 11px;
        color: #8491a5;
    }

    .rekap-print-btn {
        border-radius: 10px;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 700;
    }

    .rekap-table-wrapper {
        padding: 20px 24px 10px;
    }

    .rekap-table {
        margin-bottom: 0;
        white-space: nowrap;
        border-collapse: separate;
        border-spacing: 0;
    }

    .rekap-table thead th {
        background: #f5f8fc;
        color: #718198;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .4px;
        font-weight: 800;
        padding: 15px 13px;
        border-bottom: 1px solid #e4eaf2;
    }

    .rekap-table thead th:first-child {
        border-radius: 10px 0 0 10px;
    }

    .rekap-table thead th:last-child {
        border-radius: 0 10px 10px 0;
    }

    .rekap-table tbody td {
        padding: 15px 13px;
        font-size: 12px;
        color: #475569;
        border-bottom: 1px solid #edf1f6;
        vertical-align: middle;
    }

    .rekap-table tbody tr:hover {
        background: #f8fbff;
    }

    .rekap-number {
        color: #94a3b8;
        font-weight: 700;
    }

    .rekap-code {
        font-weight: 800;
        color: #334155;
    }

    .rekap-plate {
        display: inline-block;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        padding: 5px 9px;
        border-radius: 7px;
        font-weight: 800;
        color: #334155;
        letter-spacing: .3px;
    }

    .rekap-price {
        color: #159455 !important;
        font-weight: 800;
    }

    .rekap-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #e8f8ef;
        color: #15803d;
        border: 1px solid #d0f0dc;
        padding: 5px 10px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
    }

    .rekap-empty {
        padding: 55px 20px !important;
        text-align: center;
    }

    .rekap-empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin: 0 auto 15px;
    }

    .rekap-footer-total {
        background: #f8fafc;
        border-top: 1px solid #e7edf5;
    }

    .rekap-pagination {
        padding: 18px 24px;
        border-top: 1px solid #edf1f6;
    }

    .rekap-pagination nav {
        margin: 0;
    }

    .rekap-page .pagination {
        margin-bottom: 0;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .rekap-hero {
            padding: 23px !important;
            border-radius: 18px !important;
        }

        .rekap-hero h3 {
            font-size: 22px;
        }

        .rekap-stat-inner {
            padding: 19px;
        }

        .rekap-stat-icon {
            width: 53px;
            height: 53px;
            font-size: 23px;
        }

        .rekap-table-header {
            padding: 17px;
        }

        .rekap-table-wrapper {
            padding: 13px;
        }

        .rekap-pagination {
            padding: 15px;
        }
    }

    /* PRINT */
    @media print {
        body {
            background: white !important;
            color: black !important;
        }

        .rekap-hero,
        .rekap-filter-card,
        .rekap-stat-card,
        .rekap-table-card {
            box-shadow: none !important;
        }

        .rekap-hero {
            background: white !important;
            color: black !important;
            border: 1px solid #ccc !important;
        }

        .rekap-hero p,
        .rekap-hero-tag {
            color: #444 !important;
        }

        .rekap-hero-icon,
        .rekap-hero-tag,
        .rekap-table-title-icon,
        .rekap-stat-icon {
            background: white !important;
            color: black !important;
            border: 1px solid #ccc !important;
        }

        .sidebar,
        .topbar,
        .app-footer,
        .sidebar-overlay,
        form,
        button,
        .pagination,
        .rekap-print-btn {
            display: none !important;
        }

        .main-wrapper {
            margin: 0 !important;
            width: 100% !important;
        }

        .content {
            padding: 0 !important;
        }

        .rekap-page {
            width: 100% !important;
        }

        .rekap-table-wrapper {
            padding: 5px !        !important;
        }

        .rekap-table {
            width: 100% !important;
            white-space: normal !important;
        }

        .rekap-table th,
        .rekap-table td {
            font-size: 9px !important;
            padding: 8px 5px !important;
            color: black !important;
        }

        .rekap-table-card {
            border: 1px solid #bbb !important;
        }

        .rekap-status {
            color: black !important;
            background: white !important;
            border: 1px solid #999 !important;
        }

        .rekap-price,
        .rekap-stat-value {
            color: black !important;
        }

        .rekap-table-header {
            border-bottom: 1px solid #bbb !important;
        }
    }
</style>

<div class="rekap-page">

    {{-- HERO --}}
    <div class="rekap-hero mb-4">
        <div class="rekap-hero-content">

            <div class="rekap-hero-icon">
                <i class="bi bi-bar-chart-line-fill"></i>
            </div>

            <h3>Rekap Transaksi</h3>

            <p>
                Pantau transaksi parkir dan pendapatan berdasarkan periode waktu yang Anda tentukan.
            </p>

            <div class="rekap-hero-tag">
                <i class="bi bi-shield-check"></i>
                Owner Dashboard · Laporan Keuangan
            </div>

        </div>
    </div>

    {{-- FILTER PERIODE --}}
    <div class="rekap-filter-card mb-4">
        <div class="card-body p-4">

            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="rekap-table-title-icon">
                    <i class="bi bi-calendar-range"></i>
                </div>

                <div>
                    <div class="rekap-section-heading">Filter Periode Laporan</div>
                    <div class="rekap-section-sub">
                        Tentukan rentang tanggal dan waktu transaksi.
                    </div>
                </div>
            </div>

            <form action="{{ route('owner.rekap-transaksi.index') }}" method="GET">
                <div class="row g-3 align-items-end">

                    <div class="col-lg-5 col-md-6">
                        <label class="form-label">
                            <i class="bi bi-calendar-event me-1 text-primary"></i>
                            Tanggal & Waktu Mulai
                        </label>

                        <input type="datetime-local"
                               name="tanggal_mulai"
                               class="form-control"
                               value="{{ $tanggalMulai }}"
                               required>
                    </div>

                    <div class="col-lg-5 col-md-6">
                        <label class="form-label">
                            <i class="bi bi-calendar-check me-1 text-primary"></i>
                            Tanggal & Waktu Selesai
                        </label>

                        <input type="datetime-local"
                               name="tanggal_selesai"
                               class="form-control"
                               value="{{ $tanggalSelesai }}"
                               min="{{ $tanggalMulai }}"
                               required>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        <button type="submit" class="btn btn-primary rekap-btn-filter w-100">
                            <i class="bi bi-search me-1"></i>
                            Tampilkan
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL TRANSAKSI --}}
        <div class="col-xl-6 col-md-6">
            <div class="rekap-stat-card">
                <div class="rekap-stat-inner">

                    <div class="rekap-stat-icon rekap-stat-blue">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>

                    <div class="flex-grow-1">
                        <div class="rekap-stat-label">
                            Total Transaksi Lunas
                        </div>

                        <h3 class="rekap-stat-value">
                            {{ number_format($totalTransaksi, 0, ',', '.') }}
                        </h3>

                        <div class="rekap-stat-caption">
                            <i class="bi bi-check-circle-fill text-success me-1"></i>
                            Transaksi berhasil dibayar
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- TOTAL PENDAPATAN --}}
        <div class="col-xl-6 col-md-6">
            <div class="rekap-stat-card">
                <div class="rekap-stat-inner">

                    <div class="rekap-stat-icon rekap-stat-green">
                        <i class="bi bi-wallet-fill"></i>
                    </div>

                    <div class="flex-grow-1">
                        <div class="rekap-stat-label">
                            Total Pendapatan
                        </div>

                        <h3 class="rekap-stat-value money">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h3>

                        <div class="rekap-stat-caption">
                                <i class="bi bi-graph-up-arrow text-success me-1"></i>
                                Pendapatan dari transaksi lunas
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- TABEL TRANSAKSI --}}
    <div class="rekap-table-card">

        {{-- TABLE HEADER --}}
        <div class="rekap-table-header">

            <div class="rekap-table-title">
                <div class="rekap-table-title-icon">
                    <i class="bi bi-table"></i>
                </div>

                <div>
                    <h5>Rincian Transaksi</h5>

                    <small>
                        Periode:
                        {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y H:i') }}
                        sampai
                        {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>

            <button type="button"
                    onclick="window.print()"
                    class="btn btn-outline-primary rekap-print-btn">
                <i class="bi bi-printer me-1"></i>
                Cetak Laporan
            </button>

        </div>

        {{-- TABLE --}}
        <div class="rekap-table-wrapper">

            <div class="table-responsive">
                <table class="table rekap-table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Kode Tiket</th>
                            <th>Kendaraan</th>
                            <th>Petugas</th>
                            <th>Waktu Transaksi</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($transaksis as $transaksi)

                            <tr>
                                <td class="rekap-number">
                                    {{ $transaksis->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <span class="rekap-code">
                                        {{ $transaksi->kode_transaksi }}
                                    </span>
                                </td>

                                <td>
                                    {{ $transaksi->parkir?->kode_tiket ?? '-' }}
                                </td>

                                <td>
                                    <span class="rekap-plate">
                                        {{ $transaksi->parkir?->kendaraan?->plat_nomor ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <i class="bi bi-person-circle text-muted me-1"></i>
                                    {{ $transaksi->parkir?->petugas?->name ?? '-' }}
                                </td>

                                <td>
                                    @php
                                        $waktu = $transaksi->tanggal_transaksi
                                            ?? $transaksi->created_at;
                                    @endphp

                                    <i class="bi bi-clock text-muted me-1"></i>
                                    {{ $waktu?->format('d/m/Y H:i') ?? '-' }}
                                </td>

                                <td class="rekap-price">
                                    Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
                                </td>

                                <td>
                                    <span class="rekap-status">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Lunas
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="rekap-empty">
                                    <div class="rekap-empty-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>

                                    <div class="fw-bold text-secondary">
                                        Tidak ada transaksi ditemukan
                                    </div>

                                    <div class="text-muted small mt-1">
                                        Tidak ada transaksi lunas pada periode yang dipilih.
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                    {{-- FOOTER TOTAL --}}
                    @if($transaksis->count() > 0)
                        <tfoot>
                            <tr class="rekap-footer-total">
                                <th colspan="6" class="text-end py-3">
                                    Total Pendapatan Periode
                                </th>

                                <th colspan="2" class="text-success py-3">
                                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                    @endif

                </table>
            </div>

        </div>

        {{-- PAGINATION --}}
        @if($transaksis->hasPages())
            <div class="rekap-pagination d-flex justify-content-between align-items-center flex-wrap gap-3">

                <small class="text-muted">
                    <i class="bi bi-list-ul me-1"></i>
                    Menampilkan {{ $transaksis->firstItem() }}
                    – {{ $transaksis->lastItem() }}
                    dari {{ $transaksis->total() }} transaksi
                </small>

                {{ $transaksis->links('pagination::bootstrap-5') }}

            </div>
        @endif

    </div>

</div>

@endsection
