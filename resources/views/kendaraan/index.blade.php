
@extends('layouts.role')

@section('title', 'Data Kendaraan')
@section('page-title', 'Data Kendaraan')

@push('styles')
<style>
    .kendaraan-page {
        --k-primary: #2563eb;
        --k-text: #172033;
        --k-muted: #64748b;
    }

    .kendaraan-page .page-heading {
        margin-bottom: 24px;
    }

    .kendaraan-page .heading-title {
        font-size: 25px;
        font-weight: 800;
        color: var(--k-text);
        letter-spacing: -.5px;
    }

    .kendaraan-page .heading-desc {
        color: var(--k-muted);
        font-size: 14px;
    }

    .kendaraan-page .btn-add {
        border: none;
        border-radius: 12px;
        padding: 11px 17px;
        font-weight: 600;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        box-shadow: 0 5px 15px rgba(37, 99, 235, .20);
        transition: .2s;
    }

    .kendaraan-page .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, .28);
    }

    .kendaraan-page .stat-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        transition: .25s;
    }

    .kendaraan-page .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(15, 23, 42, .06);
    }

    .kendaraan-page .stat-icon {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 20px;
    }

    .kendaraan-page .stat-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
    }

    .kendaraan-page .stat-number {
        font-size: 27px;
        font-weight: 800;
        color: #172033;
        margin-top: 5px;
    }

    .kendaraan-page .main-card {
        border: 1px solid #edf0f5;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
    }

    .kendaraan-page .card-heading {
        padding: 21px 23px;
        border-bottom: 1px solid #f0f2f6;
    }

    .kendaraan-page .card-heading h5 {
        font-weight: 750;
        color: #172033;
        margin-bottom: 4px;
    }

    .kendaraan-page .search-input {
        border-radius: 11px;
        min-height: 44px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .kendaraan-page .search-input:focus {
        border-color: #93c5fd;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
    }

    .kendaraan-page .btn-search {
        border-radius: 11px;
        font-weight: 600;
        padding: 10px 18px;
    }

    .kendaraan-page .btn-reset {
        border-radius: 11px;
        padding: 10px 17px;
        font-weight: 600;
    }

    .kendaraan-page .table {
        margin-bottom: 0;
    }

    .kendaraan-page .table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 750;
        text-transform: uppercase;
        letter-spacing: .6px;
        padding: 15px 17px;
        border-bottom: 1px solid #edf0f5;
        white-space: nowrap;
    }

    .kendaraan-page .table tbody td {
        padding: 14px 17px;
        border-color: #f1f4f8;
        color: #334155;
        font-size: 13px;
    }

    .kendaraan-page .table tbody tr {
        transition: .18s;
    }

    .kendaraan-page .table tbody tr:hover {
        background: #f8fbff;
    }

    .kendaraan-page .plat-box {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #1d4ed8;
        padding: 8px 12px;
        border-radius: 9px;
        font-weight: 800;
        letter-spacing: .5px;
        white-space: nowrap;
    }

    .kendaraan-page .vehicle-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .kendaraan-page .vehicle-name {
        font-weight: 700;
        color: #172033;
    }

    .kendaraan-page .vehicle-sub {
        color: #64748b;
        font-size: 12px;
    }

    .kendaraan-page .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 750;
    }

    .kendaraan-page .type-motor {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .kendaraan-page .type-mobil {
        background: #d1fae5;
        color: #047857;
    }

    .kendaraan-page .transaction-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 6px 10px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 12px;
    }

    .kendaraan-page .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        border: none;
        transition: .2s;
    }

    .kendaraan-page .action-view {
        background: #e0f2fe;
        color: #0284c7;
    }

    .kendaraan-page .action-edit {
        background: #fef3c7;
        color: #b45309;
    }

    .kendaraan-page .action-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .kendaraan-page .action-btn:hover {
        transform: translateY(-2px);
        filter: brightness(.96);
    }

    .kendaraan-page .empty-state {
        padding: 55px 20px !important;
        color: #94a3b8 !important;
    }

    .kendaraan-page .empty-icon {
        width: 68px;
        height: 68px;
        margin: 0 auto 15px;
        background: #f1f5f9;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        color: #94a3b8;
    }

    @media(max-width: 767px) {
        .kendaraan-page .heading-title {
            font-size: 21px;
        }

        .kendaraan-page .page-heading {
            align-items: flex-start !important;
            gap: 15px;
            flex-direction: column;
        }

        .kendaraan-page .btn-add {
            width: 100%;
        }

        .kendaraan-page .stat-number {
            font-size: 23px;
        }

        .kendaraan-page .card-heading {
            padding: 17px;
        }

        .kendaraan-page .table tbody td,
        .kendaraan-page .table thead th {
            padding: 12px;
        }
    }
</style>
@endpush

@section('content')

@php
    $totalKendaraan = \App\Models\Kendaraan::count();
    $totalMotor = \App\Models\Kendaraan::where('jenis', 'motor')->count();
    $totalMobil = \App\Models\Kendaraan::where('jenis', 'mobil')->count();
@endphp

<div class="container-fluid kendaraan-page pb-4">

    {{-- HEADER --}}
    <div class="page-heading d-flex justify-content-between align-items-center">
        <div>
            <div class="heading-title">
                <i class="bi bi-car-front-fill text-primary me-2"></i>
                Data Kendaraan
            </div>
            <p class="heading-desc mb-0 mt-1">
                Kelola kendaraan yang terdaftar pada sistem ParkirKu.
            </p>
        </div>

        <a href="{{ route('admin.kendaraan.create') }}"
           class="btn btn-primary btn-add">
            <i class="bi bi-plus-circle-fill me-1"></i>
            Tambah Kendaraan
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-xl-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Kendaraan</div>
                        <div class="stat-number">{{ $totalKendaraan }}</div>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-car-front-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Kendaraan Motor</div>
                        <div class="stat-number">{{ $totalMotor }}</div>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-bicycle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Kendaraan Mobil</div>
                        <div class="stat-number">{{ $totalMobil }}</div>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-car-front"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-3">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- TABEL --}}
    <div class="main-card">

        <div class="card-heading">
            <h5>
                <i class="bi bi-list-ul text-primary me-2"></i>
                Daftar Kendaraan
            </h5>
            <div class="text-muted small">
                Informasi kendaraan, pemilik, dan riwayat transaksi
            </div>
        </div>

        <div class="p-3 p-md-4">

            {{-- SEARCH --}}
            <form method="GET"
                  action="{{ route('admin.kendaraan.index') }}"
                  class="row g-2 mb-4">

                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-3">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input type="text"
                               name="search"
                               class="form-control search-input border-start-0"
                               placeholder="Cari plat nomor atau pemilik kendaraan..."
                               value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-lg-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-search">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>

                    <a href="{{ route('admin.kendaraan.index') }}"
                       class="btn btn-light border btn-reset">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset
                    </a>
                </div>

            </form>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Plat Nomor</th>
                            <th>Jenis Kendaraan</th>
                            <th>Pemilik</th>
                            <th>Transaksi</th>
                            <th class="text-center" style="width:150px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($kendaraans as $kendaraan)

                        <tr>
                            <td class="text-muted">
                                {{ $kendaraans->firstItem() + $loop->index }}
                            </td>

                            {{-- PLAT NOMOR --}}
                            <td>
                                <span class="plat-box">
                                    <i class="bi bi-car-front"></i>
                                    {{ $kendaraan->plat_nomor }}
                                </span>
                            </td>

                            {{-- JENIS --}}
                            <td>
                                @if(strtolower($kendaraan->jenis) == 'motor')
                                    <span class="type-badge type-motor">
                                        <i class="bi bi-bicycle"></i>
                                        Motor
                                    </span>
                                @else
                                    <span class="type-badge type-mobil">
                                        <i class="bi bi-car-front-fill"></i>
                                        Mobil
                                    </span>
                                @endif
                            </td>

                            {{-- PEMILIK --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="vehicle-icon bg-light text-secondary">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <div class="vehicle-name">
                                            {{ $kendaraan->pemilik ?? 'Tidak diketahui' }}
                                        </div>
                                        <div class="vehicle-sub">
                                            Pemilik kendaraan
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- TRANSAKSI --}}
                            <td>
                                <span class="transaction-badge">
                                    <i class="bi bi-receipt me-1"></i>
                                    {{ $kendaraan->parkirs_count ?? 0 }} transaksi
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.kendaraan.show', $kendaraan->id) }}"
                                       class="action-btn action-view"
                                       title="Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <a href="{{ route('admin.kendaraan.edit', $kendaraan->id) }}"
                                       class="action-btn action-edit"
                                       title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    <form action="{{ route('admin.kendaraan.destroy', $kendaraan->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="action-btn action-delete"
                                                title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty-state text-center">
                                <div class="empty-icon">
                                    <i class="bi bi-car-front"></i>
                                </div>
                                <div class="fw-bold text-secondary mb-1">
                                    Data kendaraan belum tersedia
                                </div>
                                <div class="small">
                                    Silakan tambah kendaraan atau ubah pencarian.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mt-4">
                <div class="small text-muted">
                    Menampilkan {{ $kendaraans->firstItem() ?? 0 }}
                    - {{ $kendaraans->lastItem() ?? 0 }}
                    dari {{ $kendaraans->total() }} kendaraan
                </div>

                <div>
                    {{ $kendaraans->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
