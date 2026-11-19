
@extends('layouts.role')

@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')

@section('content')

<style>
    .log-page {
        padding-bottom: 20px;
    }

    .log-hero {
        background: linear-gradient(135deg, #172554, #1d4ed8, #60a5fa);
        border-radius: 20px;
        padding: 28px;
        color: #fff;
        margin-bottom: 24px;
    }

    .log-hero h3 {
        font-weight: 800;
        margin-bottom: 8px;
    }

    .log-hero p {
        margin: 0;
        color: rgba(255,255,255,.85);
    }

    .log-hero-icon {
        width: 65px;
        height: 65px;
        background: rgba(255,255,255,.17);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .log-stat {
        height: 100%;
        padding: 21px;
        border: none;
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15,23,42,.05);
        transition: .2s;
    }

    .log-stat:hover {
        transform: translateY(-3px);
    }

    .log-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-bottom: 15px;
    }

    .log-stat h3 {
        color: #1e293b;
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .log-stat p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    .log-card {
        border: none;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 4px 20px rgba(15,23,42,.05);
        overflow: hidden;
    }

    .log-card-header {
        padding: 21px;
        border-bottom: 1px solid #edf0f5;
    }

    .log-card-header h5 {
        color: #1e293b;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .log-filter {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 18px rgba(15,23,42,.04);
        margin-bottom: 24px;
    }

    .log-filter .form-control,
    .log-filter .form-select {
        min-height: 43px;
        border-radius: 10px;
        border-color: #e2e8f0;
    }

    .log-filter .form-control:focus,
    .log-filter .form-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    }

    .log-table {
        margin-bottom: 0;
    }

    .log-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 800;
        padding: 15px;
        white-space: nowrap;
        border-bottom: 1px solid #e9eef5;
    }

    .log-table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .log-table tbody tr:hover {
        background: #f8fbff;
    }

    .log-user-name {
        color: #1e293b;
        font-weight: 700;
        font-size: 13px;
    }

    .log-user-role {
        color: #64748b;
        font-size: 11px;
        margin-top: 3px;
    }

    .log-description {
        min-width: 220px;
        max-width: 360px;
        color: #475569;
        font-size: 13px;
        line-height: 1.6;
    }

    .log-activity-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 9px;
        padding: 7px 10px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .log-ip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #64748b;
        font-size: 12px;
        white-space: nowrap;
    }

    .log-time-date {
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .log-time-hour {
        color: #94a3b8;
        font-size: 11px;
        margin-top: 4px;
    }

    .log-empty {
        padding: 55px 20px !important;
        text-align: center;
    }

    .log-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 20px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .log-pagination {
        padding: 20px;
        border-top: 1px solid #edf0f5;
    }

    @media(max-width: 768px) {
        .log-hero {
            padding: 22px;
        }

        .log-hero-icon {
            width: 52px;
            height: 52px;
            font-size: 24px;
        }

        .log-table thead th,
        .log-table tbody td {
            padding: 12px;
        }
    }

    @media print {
        .log-hero,
        .log-filter,
        .log-stat,
        .log-pagination {
            display: none !important;
        }

        .log-card {
            box-shadow: none !important;
        }
    }
</style>

<div class="log-page">

    {{-- HEADER --}}
    <div class="log-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3>
                    <i class="bi bi-journal-text me-2"></i>
                    Log Aktivitas Sistem
                </h3>
                <p>
                    Pantau riwayat aktivitas pengguna dan perubahan yang terjadi
                    dalam sistem parkir.
                </p>
            </div>

            <div class="log-hero-icon">
                <i class="bi bi-activity"></i>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL LOG --}}
        <div class="col-6 col-lg-4">
            <div class="log-stat">
                <div class="log-stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-clock-history"></i>
                </div>

                <h3>{{ number_format($totalLog) }}</h3>
                <p>Total Seluruh Aktivitas</p>
            </div>
        </div>

        {{-- JENIS AKTIVITAS --}}
        <div class="col-6 col-lg-4">
            <div class="log-stat">
                <div class="log-stat-icon bg-success-subtle text-success">
                    <i class="bi bi-diagram-3"></i>
                </div>

                <h3>{{ $daftarAktivitas->count() }}</h3>
                <p>Jenis Aktivitas</p>
            </div>
        </div>

        {{-- DATA HALAMAN --}}
        <div class="col-12 col-lg-4">
            <div class="log-stat">
                <div class="log-stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-list-ul"></i>
                </div>

                <h3>{{ $logs->count() }}</h3>
                <p>Data di Halaman Ini</p>
            </div>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="log-filter">

        <div class="mb-3">
            <h5 class="fw-bold mb-1">
                <i class="bi bi-funnel text-primary me-2"></i>
                Filter Aktivitas
            </h5>

            <small class="text-muted">
                Cari pengguna atau filter berdasarkan jenis aktivitas.
            </small>
        </div>

        <form action="{{ route('admin.log-aktivitas.index') }}" method="GET">

            <div class="row g-3">

                {{-- PENCARIAN --}}
                <div class="col-md-5">
                    <label class="form-label fw-semibold">
                        Pencarian
                    </label>

                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input type="text"
                               name="cari"
                               class="form-control border-start-0"
                               placeholder="Nama pengguna atau deskripsi..."
                               value="{{ request('cari') }}">
                    </div>
                </div>

                {{-- FILTER AKTIVITAS --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Jenis Aktivitas
                    </label>

                    <select name="aktivitas" class="form-select">
                        <option value="">Semua Aktivitas</option>

                        @foreach($daftarAktivitas as $aktivitas)
                            <option value="{{ $aktivitas }}"
                                {{ request('aktivitas') == $aktivitas ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $aktivitas)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- BUTTON --}}
                <div class="col-md-3 d-flex align-items-end gap-2">

                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>

                    <a href="{{ route('admin.log-aktivitas.index') }}"
                       class="btn btn-outline-secondary"
                       title="Reset Filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>

                </div>

            </div>
        </form>

    </div>

    {{-- TABEL --}}
    <div class="log-card">

        <div class="log-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5>
                    <i class="bi bi-list-ul text-primary me-2"></i>
                    Riwayat Aktivitas Pengguna
                </h5>

                <small class="text-muted">
                    Catatan aktivitas yang tersimpan di sistem.
                </small>
            </div>

            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                {{ $logs->total() }} Data
            </span>
        </div>

        <div class="table-responsive">
            <table class="table log-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                        <th>Deskripsi</th>
                        <th>Alamat IP</th>
                        <th>Waktu</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($logs as $log)
                        <tr>

                            {{-- NOMOR --}}
                            <td class="text-muted fw-semibold">
                                {{ $logs->firstItem() + $loop->index }}
                            </td>

                            {{-- PENGGUNA --}}
                            <td>
                                <div class="log-user-name">
                                    <i class="bi bi-person-circle text-primary me-1"></i>
                                    {{ $log->user->name ?? 'Pengguna dihapus' }}
                                </div>

                                <div class="log-user-role">
                                    {{ ucfirst($log->user->role ?? '-') }}
                                </div>
                            </td>

                            {{-- AKTIVITAS --}}
                            <td>
                                <span class="log-activity-badge">
                                    <i class="bi bi-lightning-charge"></i>
                                    {{ ucfirst(str_replace('_', ' ', $log->aktivitas)) }}
                                </span>
                            </td>

                            {{-- DESKRIPSI --}}
                            <td>
                                <div class="log-description">
                                    {{ $log->deskripsi ?? '-' }}
                                </div>
                            </td>

                            {{-- IP ADDRESS --}}
                            <td>
                                <span class="log-ip">
                                    <i class="bi bi-globe2"></i>
                                    {{ $log->ip_address ?? '-' }}
                                </span>
                            </td>

                            {{-- WAKTU --}}
                            <td>
                                <div class="log-time-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $log->created_at ? $log->created_at->format('d-m-Y') : '-' }}
                                </div>

                                <div class="log-time-hour">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $log->created_at ? $log->created_at->format('H:i:s') : '-' }}
                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="log-empty">

                                <div class="log-empty-icon">
                                    <i class="bi bi-inbox"></i>
                                </div>

                                <h6 class="fw-bold text-secondary">
                                    Tidak Ada Aktivitas
                                </h6>

                                <p class="text-muted small mb-0">
                                    Data aktivitas belum tersedia atau tidak ditemukan.
                                </p>

                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($logs->hasPages())
            <div class="log-pagination d-flex justify-content-between align-items-center flex-wrap gap-3">

                <small class="text-muted">
                    Menampilkan {{ $logs->firstItem() }}–{{ $logs->lastItem() }}
                    dari {{ $logs->total() }} data
                </small>

                {{ $logs->links('pagination::bootstrap-5') }}

            </div>
        @endif

    </div>

</div>

@endsection
