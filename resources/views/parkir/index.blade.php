
@extends('layouts.role')

@section('title', 'Transaksi Parkir')
@section('page-title', 'Transaksi Parkir')

@section('content')

<style>
    .parkir-page {
        --parkir-primary: #2563eb;
        --parkir-soft: #eff6ff;
        --parkir-border: #e5eaf1;
    }

    .parkir-page .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 25px;
    }

    .parkir-page .page-title {
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -.5px;
    }

    .parkir-page .page-subtitle {
        color: #64748b;
        font-size: 14px;
    }

    .parkir-page .btn-masuk {
        border: none;
        padding: 11px 18px;
        border-radius: 12px;
        font-weight: 600;
        box-shadow: 0 5px 14px rgba(37,99,235,.18);
        transition: .2s;
    }

    .parkir-page .btn-masuk:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(37,99,235,.25);
    }

    /* KAPASITAS */
    .kapasitas-card {
        border: 1px solid var(--parkir-border);
        border-radius: 18px;
        background: #fff;
        overflow: hidden;
        transition: .25s;
    }

    .kapasitas-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(15,23,42,.07) !important;
    }

    .kapasitas-card .card-body {
        padding: 22px;
    }

    .kapasitas-icon {
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 15px;
        font-size: 23px;
    }

    .kapasitas-stat {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 13px;
        padding: 12px 5px;
    }

    .kapasitas-stat h3 {
        font-size: 23px;
        font-weight: 800;
    }

    .kapasitas-stat small {
        font-size: 11px;
    }

    .kapasitas-progress {
        height: 9px;
        border-radius: 20px;
        background: #e9eef5;
        overflow: hidden;
    }

    .kapasitas-progress .progress-bar {
        border-radius: 20px;
    }

    /* STATISTIK */
    .stat-transaksi {
        border: 1px solid #e8edf4;
        border-radius: 17px;
        background: #fff;
        transition: .2s;
    }

    .stat-transaksi:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(15,23,42,.06) !important;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .stat-number {
        font-size: 27px;
        font-weight: 800;
        color: #1e293b;
    }

    /* TABEL */
    .transaksi-card {
        border: 1px solid #e5eaf1;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
    }

    .transaksi-table {
        width: 100%;
        table-layout: fixed;
        margin-bottom: 0;
    }

    .transaksi-table th,
    .transaksi-table td {
        padding: 13px 8px;
        vertical-align: middle;
        white-space: normal;
        overflow-wrap: anywhere;
        font-size: 12px;
    }

    .transaksi-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-bottom: 1px solid #e5eaf1;
    }

    .transaksi-table tbody tr {
        transition: background .15s;
    }

    .transaksi-table tbody tr:hover {
        background: #f8fbff;
    }

    .transaksi-table th:nth-child(1) { width: 4%; }
    .transaksi-table th:nth-child(2) { width: 12%; }
    .transaksi-table th:nth-child(3) { width: 10%; }
    .transaksi-table th:nth-child(4) { width: 7%; }
    .transaksi-table th:nth-child(5) { width: 12%; }
    .transaksi-table th:nth-child(6) { width: 12%; }
    .transaksi-table th:nth-child(7) { width: 9%; }
    .transaksi-table th:nth-child(8) { width: 10%; }
    .transaksi-table th:nth-child(9) { width: 12%; }
    .transaksi-table th:nth-child(10) { width: 8%; }

    .transaksi-table .btn {
        font-size: 11px;
        padding: 6px 9px;
        border-radius: 8px;
    }

    .kode-tiket {
        display: inline-block;
        background: #eff6ff;
        color: #2563eb;
        padding: 5px 8px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 700;
    }

    .plat-label {
        color: #1e293b;
        font-weight: 800;
        letter-spacing: .3px;
    }

    .status-masuk {
        background: #dcfce7;
        color: #166534;
        padding: 6px 9px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
    }

    .status-keluar {
        background: #e2e8f0;
        color: #475569;
        padding: 6px 9px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
    }

    .table-title {
        font-weight: 800;
        color: #1e293b;
    }

    @media (min-width: 768px) {
        .parkir-page .table-responsive {
            overflow-x: visible;
        }
    }

    @media (max-width: 767px) {
        .parkir-page .page-header {
            align-items: flex-start;
        }

        .parkir-page .btn-masuk {
            width: 100%;
        }

        .transaksi-table {
            min-width: 950px;
        }

        .kapasitas-card .card-body {
            padding: 17px;
        }

        .stat-number {
            font-size: 23px;
        }
    }
</style>

<div class="parkir-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h4 class="page-title mb-1">
                <i class="bi bi-car-front-fill text-primary me-2"></i>
                Data Transaksi Parkir
            </h4>

            <p class="page-subtitle mb-0">
                Monitoring kendaraan masuk, keluar, dan kapasitas area parkir.
            </p>
        </div>

        <a href="{{ route(auth()->user()->role . '.parkir.create') }}"
           class="btn btn-primary btn-masuk">
            <i class="bi bi-plus-circle me-1"></i>
            Kendaraan Masuk
        </a>
    </div>

    {{-- KAPASITAS PARKIR --}}
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-p-square-fill text-primary"></i>
        <h5 class="fw-bold mb-0">Kapasitas Area Parkir</h5>
    </div>

    <div class="row g-3 mb-4">

        @foreach($kapasitas as $item)

            @php
                $persentase = $item->kapasitas > 0
                    ? min(100, ($item->terisi / $item->kapasitas) * 100)
                    : 0;

                $penuh = $item->tersedia <= 0;

                $warna = $penuh
                    ? 'danger'
                    : ($persentase >= 80 ? 'warning' : 'success');
            @endphp

            <div class="col-md-6">
                <div class="card kapasitas-card shadow-sm h-100">
                    <div class="card-body">

                        {{-- HEADER KAPASITAS --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div class="d-flex align-items-center gap-3">

                                <div class="kapasitas-icon
                                    {{ $item->jenis == 'motor'
                                        ? 'bg-primary-subtle text-primary'
                                        : 'bg-info-subtle text-info' }}">
                                    <i class="bi {{ $item->jenis == 'motor'
                                        ? 'bi-bicycle'
                                        : 'bi-car-front-fill' }}"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-0">
                                        Parkir {{ ucfirst($item->jenis) }}
                                    </h5>
                                    <small class="text-muted">
                                        Monitoring kapasitas kendaraan
                                    </small>
                                </div>
                            </div>

                            @if($penuh)
                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    PENUH
                                </span>
                            @else
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i>
                                    TERSEDIA
                                </span>
                            @endif

                        </div>

                        {{-- ANGKA KAPASITAS --}}
                        <div class="row g-2 text-center mb-3">

                            <div class="col-4">
                                <div class="kapasitas-stat">
                                    <h3 class="mb-0">
                                        {{ $item->kapasitas }}
                                    </h3>
                                    <small class="text-muted">Total Slot</small>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="kapasitas-stat">
                                    <h3 class="mb-0 text-primary">
                                        {{ $item->terisi }}
                                    </h3>
                                    <small class="text-muted">Terisi</small>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="kapasitas-stat">
                                    <h3 class="mb-0 text-success">
                                        {{ $item->tersedia }}
                                    </h3>
                                    <small class="text-muted">Tersedia</small>
                                </div>
                            </div>

                        </div>

                        {{-- PROGRESS --}}
                        <div class="progress kapasitas-progress">
                            <div class="progress-bar bg-{{ $warna }}"
                                 role="progressbar"
                                 style="width: {{ $persentase }}%">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">
                                <i class="bi bi-bar-chart me-1"></i>
                                Penggunaan area
                            </small>

                            <span class="fw-bold small">
                                {{ number_format($persentase, 1) }}%
                            </span>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach

    </div>

    {{-- RINGKASAN --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL TRANSAKSI --}}
        <div class="col-md-4">
            <div class="card stat-transaksi shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted fw-semibold">
                                Total Transaksi
                            </small>

                            <h3 class="stat-number mb-0">
                                {{ $parkirs->total() }}
                            </h3>

                            <small class="text-muted">
                                Seluruh data parkir
                            </small>
                        </div>

                        <div class="stat-icon bg-primary-subtle text-primary">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- SEDANG PARKIR --}}
        <div class="col-md-4">
            <div class="card stat-transaksi shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted fw-semibold">
                                Sedang Parkir
                            </small>

                            <h3 class="stat-number mb-0 text-success">
                                {{ \App\Models\Parkir::where('status', 'masuk')->count() }}
                            </h3>

                            <small class="text-muted">
                                Kendaraan di area parkir
                            </small>
                        </div>

                        <div class="stat-icon bg-success-subtle text-success">
                            <i class="bi bi-car-front"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- TRANSAKSI SELESAI --}}
        <div class="col-md-4">
            <div class="card stat-transaksi shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <small class="text-muted fw-semibold">
                                Transaksi Selesai
                            </small>

                            <h3 class="stat-number mb-0 text-secondary">
                                {{ \App\Models\Parkir::where('status', 'keluar')->count() }}
                            </h3>

                            <small class="text-muted">
                                Kendaraan sudah keluar
                            </small>
                        </div>

                        <div class="stat-icon bg-secondary-subtle text-secondary">
                            <i class="bi bi-check-circle"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL TRANSAKSI --}}
    <div class="card transaksi-card shadow-sm">

        {{-- HEADER TABEL --}}
        <div class="card-body border-bottom">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>
                    <h5 class="table-title mb-1">
                        <i class="bi bi-list-ul text-primary me-2"></i>
                        Riwayat Transaksi
                    </h5>

                    <small class="text-muted">
                        Daftar kendaraan masuk dan keluar area parkir
                    </small>
                </div>

                <span class="badge bg-light text-secondary border px-3 py-2">
                    <i class="bi bi-database me-1"></i>
                    {{ $parkirs->total() }} Data
                </span>

            </div>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover transaksi-table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Plat Nomor</th>
                            <th>Jenis</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Durasi</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($parkirs as $index => $parkir)

                        @php
                            $waktuAkhir = $parkir->waktu_keluar ?? now();

                            $durasiMenit = (int) $parkir->waktu_masuk
                                ->diffInMinutes($waktuAkhir);

                            $jam = intdiv($durasiMenit, 60);
                            $menit = $durasiMenit % 60;
                        @endphp

                        <tr>

                            {{-- NOMOR --}}
                            <td class="text-muted">
                                {{ $parkirs->firstItem() + $index }}
                            </td>

                            {{-- KODE --}}
                            <td>
                                <span class="kode-tiket">
                                    {{ $parkir->kode_tiket }}
                                </span>
                            </td>

                            {{-- PLAT --}}
                            <td>
                                <span class="plat-label">
                                    {{ $parkir->kendaraan?->plat_nomor ?? '-' }}
                                </span>
                            </td>

                            {{-- JENIS --}}
                            <td>
                                <span class="text-capitalize">
                                    {{ $parkir->kendaraan?->jenis ?? '-' }}
                                </span>
                            </td>

                            {{-- MASUK --}}
                            <td>
                                <div class="text-success fw-semibold">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>
                                    {{ $parkir->waktu_masuk->format('d/m/Y') }}
                                </div>

                                <small class="text-muted">
                                    {{ $parkir->waktu_masuk->format('H:i') }}
                                </small>
                            </td>

                            {{-- KELUAR --}}
                            <td>
                                @if($parkir->waktu_keluar)
                                    <div class="text-danger fw-semibold">
                                        <i class="bi bi-box-arrow-right me-1"></i>
                                        {{ $parkir->waktu_keluar->format('d/m/Y') }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $parkir->waktu_keluar->format('H:i') }}
                                    </small>
                                @else
                                    <span class="text-muted">
                                        <i class="bi bi-hourglass-split me-1"></i>
                                        Belum keluar
                                    </span>
                                @endif
                            </td>

                            {{-- DURASI --}}
                            <td>
                                <span class="fw-semibold">
                                    {{ $jam }}j {{ $menit }}m
                                </span>
                            </td>

                            {{-- BIAYA --}}
                            <td>
                                <span class="fw-bold text-dark">
                                    Rp{{ number_format($parkir->biaya ?? 0, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($parkir->status == 'masuk')
                                    <span class="status-masuk">
                                        <i class="bi bi-car-front me-1"></i>
                                        Parkir
                                    </span>
                                @else
                                    <span class="status-keluar">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Selesai
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <a href="{{ route(auth()->user()->role . '.parkir.show', $parkir->id_area) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye me-1"></i>
                                    Detail
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="10" class="text-center py-5">

                                <div class="mb-2">
                                    <i class="bi bi-receipt display-4 text-secondary opacity-50"></i>
                                </div>

                                <h6 class="fw-bold text-secondary">
                                    Belum Ada Transaksi Parkir
                                </h6>

                                <p class="text-muted small mb-0">
                                    Transaksi kendaraan akan muncul di sini.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>

        </div>

        {{-- PAGINATION --}}
        @if($parkirs->hasPages())
            <div class="card-body border-top">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <small class="text-muted">
                        Menampilkan {{ $parkirs->firstItem() ?? 0 }}
                        – {{ $parkirs->lastItem() ?? 0 }}
                        dari {{ $parkirs->total() }} transaksi
                    </small>

                    <div>
                        {{ $parkirs->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        @endif

    </div>

</div>

@endsection
