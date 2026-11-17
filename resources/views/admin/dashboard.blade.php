
@extends('layouts.role')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Administrator')

@push('styles')
<style>
    .welcome-banner {
        background: linear-gradient(120deg, #1d4ed8, #2563eb, #3b82f6);
        color: white;
        border-radius: 18px;
        padding: 28px 30px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(37,99,235,.16);
    }

    .welcome-banner::after {
        content: "\F1B9";
        font-family: "bootstrap-icons";
        position: absolute;
        right: 35px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 105px;
        opacity: .13;
    }

    .welcome-banner h4 {
        font-weight: 750;
        margin-bottom: 8px;
    }

    .welcome-banner p {
        margin: 0;
        font-size: 13px;
        opacity: .85;
    }

    .stat-card {
        background: white;
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 21px;
        height: 100%;
        box-shadow: 0 4px 18px rgba(15,23,42,.035);
        transition: transform .2s, box-shadow .2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 9px 25px rgba(15,23,42,.08);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 23px;
    }

    .icon-blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .icon-green {
        background: #dcfce7;
        color: #16a34a;
    }

    .icon-purple {
        background: #f3e8ff;
        color: #9333ea;
    }

    .icon-orange {
        background: #ffedd5;
        color: #ea580c;
    }

    .stat-label {
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        margin-top: 19px;
        margin-bottom: 7px;
    }

    .stat-number {
        color: #0f172a;
        font-size: 27px;
        font-weight: 800;
        margin: 0;
    }

    .stat-description {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 5px;
    }

    .dashboard-card {
        background: white;
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 18px rgba(15,23,42,.035);
    }

    .dashboard-card-title {
        font-size: 16px;
        font-weight: 750;
        color: #1e293b;
        margin: 0;
    }

    .dashboard-card-subtitle {
        color: #94a3b8;
        font-size: 12px;
        margin-top: 5px;
    }

    .status-badge {
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
    }

    .status-masuk {
        background: #dcfce7;
        color: #15803d;
    }

    .status-keluar {
        background: #e2e8f0;
        color: #475569;
    }

    .ticket-code {
        color: #2563eb;
        font-weight: 700;
        font-size: 12px;
    }

    .empty-state {
        padding: 35px 15px !important;
        color: #94a3b8 !important;
    }

    .empty-state i {
        display: block;
        font-size: 35px;
        margin-bottom: 10px;
    }

    @media (max-width: 576px) {
        .welcome-banner {
            padding: 23px 20px;
        }

        .welcome-banner::after {
            right: 12px;
            font-size: 75px;
        }

        .welcome-banner h4 {
            font-size: 18px;
        }

        .stat-card {
            padding: 17px;
        }

        .stat-number {
            font-size: 23px;
        }

        .dashboard-card {
            padding: 16px;
        }
    }
</style>
@endpush

@section('content')

{{-- WELCOME --}}
<div class="welcome-banner">
    <h4>Selamat Datang, {{ auth()->user()->name }}!</h4>
    <p>
        <i class="bi bi-calendar3 me-1"></i>
        {{ now()->translatedFormat('l, d F Y') }}
        <span class="mx-2">|</span>
        Anda masuk sebagai Administrator.
    </p>
</div>

{{-- STATISTIK --}}
<div class="row g-4">

    {{-- TOTAL KENDARAAN --}}
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-top">
                <div>
                    <div class="stat-label mt-0">Total Kendaraan</div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="bi bi-car-front-fill"></i>
                </div>
            </div>

            <h2 class="stat-number">
                {{ number_format($totalKendaraan, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                <i class="bi bi-database me-1"></i>
                Seluruh kendaraan terdaftar
            </div>
        </div>
    </div>

    {{-- PARKIR AKTIF --}}
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-top">
                <div>
                    <div class="stat-label mt-0">Parkir Aktif</div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="bi bi-p-square-fill"></i>
                </div>
            </div>

            <h2 class="stat-number">
                {{ number_format($parkirAktif, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                <i class="bi bi-clock me-1"></i>
                Kendaraan sedang parkir
            </div>
        </div>
    </div>

    {{-- TOTAL TRANSAKSI --}}
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-top">
                <div>
                    <div class="stat-label mt-0">Total Transaksi</div>
                </div>
                <div class="stat-icon icon-purple">
                    <i class="bi bi-receipt-cutoff"></i>
                </div>
            </div>

            <h2 class="stat-number">
                {{ number_format($totalTransaksi, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                <i class="bi bi-graph-up me-1"></i>
                Seluruh transaksi tercatat
            </div>
        </div>
    </div>

    {{-- PENDAPATAN --}}
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-top">
                <div>
                    <div class="stat-label mt-0">Pendapatan Hari Ini</div>
                </div>
                <div class="stat-icon icon-orange">
                    <i class="bi bi-wallet2"></i>
                </div>
            </div>

            <h2 class="stat-number" style="font-size: 23px;">
                Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                <i class="bi bi-calendar-check me-1"></i>
                Pendapatan pada hari ini
            </div>
        </div>
    </div>

</div>

{{-- TRANSAKSI TERBARU --}}
<div class="dashboard-card mt-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">

        <div>
            <h5 class="dashboard-card-title">
                <i class="bi bi-clock-history text-primary me-2"></i>
                Aktivitas Parkir Terbaru
            </h5>

            <div class="dashboard-card-subtitle">
                Daftar kendaraan yang terakhir tercatat dalam sistem
            </div>
        </div>

        <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
            <i class="bi bi-list-ul me-1"></i>
            Data Terbaru
        </span>

    </div>

    <div class="table-responsive">
        <table class="table table-hover">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Tiket</th>
                    <th>Plat Nomor</th>
                    <th>Waktu Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($parkirTerbaru as $index => $parkir)

                    <tr>
                        <td class="text-secondary">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            <span class="ticket-code">
                                {{ $parkir->kode_tiket }}
                            </span>
                        </td>

                        <td>
                            <span class="fw-semibold">
                                {{ $parkir->kendaraan->plat_nomor ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <i class="bi bi-calendar-event text-secondary me-1"></i>
                            {{ $parkir->waktu_masuk
                                ? \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d/m/Y H:i')
                                : '-' }}
                        </td>

                        <td>
                            @if($parkir->status == 'masuk')
                                <span class="status-badge status-masuk">
                                    <i class="bi bi-circle-fill me-1" style="font-size:7px;"></i>
                                    Sedang Parkir
                                </span>
                            @else
                                <span class="status-badge status-keluar">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    Keluar
                                </span>
                            @endif
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center empty-state">
                            <i class="bi bi-inbox"></i>
                            Belum ada data parkir.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection
