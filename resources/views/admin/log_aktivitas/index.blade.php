
@extends('layouts.role')

@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')

@section('content')
<style>
    .log-page {
        padding-bottom: 25px;
    }

    .log-hero {
        background: linear-gradient(120deg, #172554, #1d4ed8, #3b82f6);
        color: #fff;
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 8px 25px rgba(29, 78, 216, .15);
    }

    .log-hero h3 {
        font-weight: 800;
        margin-bottom: 8px;
    }

    .log-hero p {
        color: rgba(255,255,255,.82);
        margin: 0;
        font-size: 14px;
    }

    .log-hero-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        background: rgba(255,255,255,.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .log-stat {
        height: 100%;
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 17px;
        padding: 21px;
        box-shadow: 0 4px 18px rgba(15,23,42,.04);
        transition: .2s;
    }

    .log-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(15,23,42,.08);
    }

    .log-stat-icon {
        width: 47px;
        height: 47px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-bottom: 14px;
    }

    .log-stat h3 {
        color: #1e293b;
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .log-stat p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .log-filter,
    .log-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(15,23,42,.04);
    }

    .log-filter {
        padding: 22px;
        margin-bottom: 24px;
    }

    .log-filter .form-control,
    .log-filter .form-select {
        min-height: 44px;
        border-radius: 10px;
        border-color: #e2e8f0;
        font-size: 13px;
    }

    .log-filter .form-control:focus,
    .log-filter .form-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    }

    .log-card {
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

    .log-card-header small {
        color: #64748b;
    }

    .log-table {
        margin-bottom: 0;
        min-width: 850px;
    }

    .log-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
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
        font-size: 13px;
        font-weight: 700;
    }

    .log-user-role {
        color: #64748b;
        font-size: 11px;
        margin-top: 4px;
    }

    .log-description {
        min-width: 200px;
        max-width: 340px;
        color: #475569;
        font-size: 12px;
        line-height: 1.6;
    }

    .log-activity-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 9px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .log-ip {
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
        margin-top: 5px;
        white-space: nowrap;
    }

    .log-empty {
        padding: 55px 20px !important;
        text-align: center;
    }

    .log-empty-icon {
        width: 68px;
        height: 68px;
        margin: 0 auto 15px;
        border-radius: 20px;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 29px;
    }

    .log-pagination {
        padding: 20px;
        border-top: 1px solid #edf0f5;
    }

    .log-pagination nav p {
        margin-bottom: 0;
    }

    @media(max-width: 768px) {
        .log-hero {
            padding: 21px;
        }

        .log-hero-icon {
            width: 52px;
            height: 52px;
            font-size: 24px;
        }

        .log-stat {
            padding: 16px;
        }

        .log-stat h3 {
            font-size: 22px;
        }

        .log-filter {
            padding: 17px;
        }
    }

    @media print {
        .log-hero,
        .log-stat,
        .log-filter,
        .log-pagination,
        .sidebar,
        .topbar {
            display: none !important;
        }

        .log-card {
            box-shadow: none !important;
            border: none !important;
        }

        .table-responsive {
            overflow: visible !important;
        }

        .log-table {
            min-width: 100%;
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
                    Pantau riwayat login, logout, dan registrasi pengguna
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

        <div class="col-6 col-lg-4">
            <div class="log-stat">
                <div class="log-stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h3>{{ number_format($totalLog) }}</h3>
                <p>Total Seluruh Aktivitas</p>
            </div>
        </div>

        <div class="col-6 col-lg-4">
            <div class="log-stat">
                <div class="log-stat-icon bg-success-subtle text-success">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h3>{{ number_format($logHariIni) }}</h3>
                <p>Aktivitas Hari Ini</p>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="log-stat">
                <div class="log-stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-diagram-3"></i>
                </div>
                <h3>{{ $daftarAktivitas->count() }}</h3>
                <p>Jenis Aktivitas</p>
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
                Cari pengguna atau tampilkan aktivitas berdasarkan jenis dan tanggal.
            </small>
        </div>

        <form action="{{ route('admin.log-aktivitas.index') }}" method="GET">
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Nama, deskripsi, atau IP..."
                            value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Jenis Aktivitas</label>
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

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ request('tanggal') }}">
                </div>

                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>

                    <a href="{{ route('admin.log-aktivitas.index') }}"
                       class="btn btn-outline-secondary"
                       title="Reset filter">
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
                <small>Catatan login, logout, dan registrasi pengguna.</small>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                    {{ $logs->total() }} Data
                </span>

                <button type="button" onclick="window.print()"
                        class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-printer me-1"></i>
                    Cetak
                </button>
            </div>
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
                            <td class="text-muted fw-semibold">
                                {{ $logs->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="log-user-name">
                                    <i class="bi bi-person-circle text-primary me-1"></i>
                                    {{ $log->user->name ?? 'Pengguna dihapus' }}
                                </div>
                                <div class="log-user-role">
                                    {{ ucfirst($log->user->role ?? '-') }}
                                </div>
                            </td>

                            <td>
                                <span class="log-activity-badge">
                                    <i class="bi bi-lightning-charge"></i>
                                    {{ ucfirst(str_replace('_', ' ', $log->aktivitas)) }}
                                </span>
                            </td>

                            <td>
                                <div class="log-description">
                                    {{ $log->deskripsi ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <span class="log-ip">
                                    <i class="bi bi-globe2 me-1"></i>
                                    {{ $log->ip_address ?? '-' }}
                                </span>
                            </td>

                            <td>
                                @if($log->created_at)
                                    <div class="log-time-date">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $log->created_at->timezone('Asia/Jakarta')->format('d-m-Y') }}
                                    </div>
                                    <div class="log-time-hour">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $log->created_at->timezone('Asia/Jakarta')->format('H:i:s') }} WIB
                                    </div>
                                @else
                                    -
                                @endif
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
