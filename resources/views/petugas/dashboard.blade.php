
@extends('layouts.role')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas')

@push('styles')
<style>
    .welcome-banner {
        background: linear-gradient(120deg, #047857, #059669, #10b981);
        color: white;
        padding: 27px 30px;
        border-radius: 18px;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(5,150,105,.15);
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
    .icon-purple { background: #f3e8ff; color: #9333ea; }

    .stat-label {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        margin-top: 18px;
        margin-bottom: 7px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .stat-description {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 6px;
    }

    .operation-card {
        background: white;
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 23px;
        height: 100%;
        box-shadow: 0 4px 18px rgba(15,23,42,.035);
    }

    .operation-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 17px;
        border: 1px solid #e8edf4;
        border-radius: 13px;
        margin-top: 15px;
        transition: .2s;
        text-decoration: none;
        color: #1e293b;
    }

    .operation-item:hover {
        background: #f8fbff;
        border-color: #bfdbfe;
        transform: translateY(-2px);
        color: #2563eb;
    }

    .operation-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        background: #dbeafe;
        color: #2563eb;
        flex-shrink: 0;
    }

    .operation-item h6 {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .operation-item p {
        font-size: 11px;
        color: #94a3b8;
        margin: 0;
    }

    @media(max-width:576px) {
        .welcome-banner { padding: 22px 19px; }
        .welcome-banner h4 { font-size: 18px; }
        .stat-card { padding: 17px; }
        .stat-number { font-size: 24px; }
        .operation-card { padding: 17px; }
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
        Panel operasional petugas parkir.
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
                <div class="stat-label mt-0">Kendaraan Sedang Parkir</div>
                <div class="stat-icon icon-green">
                    <i class="bi bi-p-square-fill"></i>
                </div>
            </div>

            <h2 class="stat-number">
                {{ number_format($parkirAktif, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                Kendaraan yang belum keluar
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-label mt-0">Total Transaksi Selesai</div>
                <div class="stat-icon icon-purple">
                    <i class="bi bi-receipt-cutoff"></i>
                </div>
            </div>

            <h2 class="stat-number">
                {{ number_format($totalTransaksi, 0, ',', '.') }}
            </h2>

            <div class="stat-description">
                Transaksi yang telah tercatat
            </div>
        </div>
    </div>

</div>

{{-- MENU OPERASIONAL --}}
<div class="operation-card mt-4">

    <h5 class="fw-bold mb-1">
        <i class="bi bi-grid-fill text-primary me-2"></i>
        Menu Operasional
    </h5>

    <p class="text-secondary small mb-3">
        Pilih menu untuk menjalankan aktivitas parkir.
    </p>

    <div class="row g-3">

        <div class="col-md-6">
            <a href="{{ route('petugas.parkir.create') }}"
               class="operation-item">

                <div class="operation-icon">
                    <i class="bi bi-car-front-fill"></i>
                </div>

                <div class="flex-grow-1">
                    <h6>Kendaraan Masuk</h6>
                    <p>Catat kendaraan yang memasuki area parkir.</p>
                </div>

                <i class="bi bi-arrow-right text-secondary"></i>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('petugas.parkir.index') }}"
               class="operation-item">

                <div class="operation-icon">
                    <i class="bi bi-list-check"></i>
                </div>

                <div class="flex-grow-1">
                    <h6>Data Parkir</h6>
                    <p>Lihat dan kelola data kendaraan parkir.</p>
                </div>

                <i class="bi bi-arrow-right text-secondary"></i>
            </a>
        </div>

    </div>
</div>

@endsection
