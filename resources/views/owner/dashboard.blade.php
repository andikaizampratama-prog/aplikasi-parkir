
@extends('layouts.role')

@section('title', 'Dashboard Owner')
@section('page-title', 'Dashboard Owner')

@push('styles')
<style>
    .welcome-banner {
        background: linear-gradient(120deg, #4338ca, #4f46e5, #818cf8);
        color: white;
        padding: 27px 30px;
        border-radius: 18px;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(79,70,229,.15);
    }

    .welcome-banner h4 {
        font-weight: 750;
        margin-bottom: 7px;
    }

    .welcome-banner p {
        margin: 0;
        font-size: 13px;
        opacity: .9;
    }

    .stat-card {
        background: white;
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 22px;
        height: 100%;
        box-shadow: 0 4px 18px rgba(15,23,42,.035);
        transition: .2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 9px 25px rgba(15,23,42,.08);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-icon {
        width: 49px;
        height: 49px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }

    .icon-blue { background: #dbeafe; color: #2563eb; }
    .icon-green { background: #dcfce7; color: #16a34a; }
    .icon-orange { background: #ffedd5; color: #ea580c; }

    .stat-label {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        margin-top: 18px;
        margin-bottom: 7px;
    }

    .stat-number {
        font-size: 27px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .stat-description {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 6px;
    }

    .business-card {
        background: white;
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 23px;
        box-shadow: 0 4px 18px rgba(15,23,42,.035);
    }

    .business-title {
        font-size: 16px;
        font-weight: 750;
        color: #1e293b;
    }

    .business-subtitle {
        color: #94a3b8;
        font-size: 12px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 17px 0;
        border-bottom: 1px solid #edf0f5;
        font-size: 13px;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-label {
        color: #64748b;
    }

    .summary-value {
        color: #0f172a;
        font-weight: 750;
        text-align: right;
    }

    .capacity-track {
        width: 100%;
        height: 11px;
        background: #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        margin-top: 13px;
    }

    .capacity-progress {
        height: 100%;
        background: linear-gradient(90deg, #2563eb, #60a5fa);
        border-radius: 20px;
        transition: width .4s;
    }

    .business-action {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid #edf0f5;
    }

    @media(max-width:576px) {
        .welcome-banner { padding: 22px 19px; }
        .welcome-banner h4 { font-size: 18px; }
        .stat-card { padding: 17px; }
        .stat-number { font-size: 23px; }
        .business-card { padding: 17px; }
    }
</style>
@endpush

@section('content')

{{-- SAMBUTAN --}}
<div class="welcome-banner">
    <h4>
        Selamat Datang, {{ auth()->user()->name }}!
    </h4>

    <p>
        <i class="bi bi-calendar3 me-1"></i>
        {{ now()->translatedFormat('l, d F Y') }}
        <span class="mx-2">|</span>
        Ringkasan informasi bisnis parkir Anda.
    </p>
</div>

{{-- STATISTIK --}}
<div class="row g-4">

    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label mt-0">Total Kendaraan</div>

                <div class="stat-icon icon-blue">
                    <i class="bi bi-car-front-fill"></i>
                </div>
            </div>

            <h2 class="stat-number">
                {{ number_format($totalKendaraan, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                Seluruh kendaraan terdaftar
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label mt-0">Parkir Aktif</div>

                <div class="stat-icon icon-green">
                    <i class="bi bi-p-square-fill"></i>
                </div>
            </div>

            <h2 class="stat-number">
                {{ number_format($parkirAktif, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                Kendaraan sedang berada di area parkir
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label mt-0">Pendapatan Hari Ini</div>

                <div class="stat-icon icon-orange">
                    <i class="bi bi-wallet2"></i>
                </div>
            </div>

            <h2 class="stat-number" style="font-size:23px;">
                Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                Pendapatan pada hari ini
            </div>
        </div>
    </div>

</div>

{{-- RINGKASAN BISNIS --}}
<div class="business-card mt-4">

    <div class="mb-3">
        <h5 class="business-title mb-1">
            <i class="bi bi-bar-chart-line-fill text-primary me-2"></i>
            Ringkasan Bisnis Parkir
        </h5>

        <p class="business-subtitle mb-0">
            Informasi transaksi dan kapasitas area parkir.
        </p>
    </div>

    <div class="summary-item">
        <div class="summary-label">
            <i class="bi bi-receipt me-2"></i>
            Total Transaksi Selesai
        </div>

        <div class="summary-value">
            {{ number_format($totalTransaksi, 0, ',', '.') }} transaksi
        </div>
    </div>

    <div class="summary-item">
        <div class="summary-label">
            <i class="bi bi-p-square me-2"></i>
            Kapasitas Parkir
        </div>

        <div class="summary-value">
            {{ number_format($kapasitas, 0, ',', '.') }} kendaraan
        </div>
    </div>

    <div class="summary-item">
        <div class="summary-label">
            <i class="bi bi-check-circle me-2"></i>
            Slot Kosong
        </div>

        <div class="summary-value text-success">
            {{ number_format($slotKosong, 0, ',', '.') }} slot
        </div>
    </div>

    @php
        $persentaseTerisi = $kapasitas > 0
            ? min(100, max(0, ($parkirAktif / $kapasitas) * 100))
            : 0;
    @endphp

    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <span class="small fw-semibold text-secondary">
                Penggunaan Kapasitas Parkir
            </span>

            <span class="small fw-bold text-primary">
                {{ number_format($persentaseTerisi, 1) }}%
            </span>
        </div>

        <div class="capacity-track">
            <div class="capacity-progress"
                 style="width: {{ $persentaseTerisi }}%;">
            </div>
        </div>

        <div class="d-flex justify-content-between mt-2">
            <small class="text-secondary">
                {{ $parkirAktif }} kendaraan terisi
            </small>

            <small class="text-secondary">
                {{ $kapasitas }} kapasitas
            </small>
        </div>
    </div>

    <div class="business-action">
        <div class="small text-secondary">
            <i class="bi bi-info-circle me-1"></i>
            Pantau kondisi operasional dan pendapatan parkir.
        </div>

        <a href="{{ route('owner.laporan.index') }}"
           class="btn btn-primary btn-sm px-3 py-2">
            <i class="bi bi-file-earmark-bar-graph me-1"></i>
            Lihat Laporan
        </a>
    </div>

</div>

@endsection
