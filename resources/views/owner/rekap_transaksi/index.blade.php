
@extends('layouts.role')

@section('title', 'Rekap Transaksi')
@section('page-title', 'Rekap Transaksi')

@section('content')

<div class="page-heading">
    <h4>Rekap Transaksi</h4>
    <p>Laporan pendapatan parkir berdasarkan periode tanggal dan waktu.</p>
</div>

{{-- FILTER PERIODE --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('owner.rekap-transaksi.index') }}"
              method="GET">

            <div class="row g-3">

                <div class="col-md-5">
                    <label class="form-label fw-semibold">
                        Tanggal dan Waktu Mulai
                    </label>

                    <input type="datetime-local"
                           name="tanggal_mulai"
                           class="form-control"
                           value="{{ $tanggalMulai }}"
                           required>
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-semibold">
                        Tanggal dan Waktu Selesai
                    </label>

                    <input type="datetime-local"
                           name="tanggal_selesai"
                           class="form-control"
                           value="{{ $tanggalSelesai }}"
                           min="{{ $tanggalMulai }}"
                           required>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>
                        Tampilkan
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

{{-- RINGKASAN --}}
<div class="row g-3 mb-4">

    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">

                <div class="bg-primary-subtle text-primary rounded-3 p-3">
                    <i class="bi bi-receipt fs-2"></i>
                </div>

                <div>
                    <div class="text-muted small">
                        Total Transaksi Lunas
                    </div>

                    <h3 class="fw-bold mb-0">
                        {{ number_format($totalTransaksi, 0, ',', '.') }}
                    </h3>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">

                <div class="bg-success-subtle text-success rounded-3 p-3">
                    <i class="bi bi-cash-stack fs-2"></i>
                </div>

                <div>
                    <div class="text-muted small">
                        Total Pendapatan
                    </div>

                    <h3 class="fw-bold text-success mb-0">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h3>
                </div>

            </div>
        </div>
    </div>

</div>

{{-- TABEL TRANSAKSI --}}
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">

        <div>
            <h6 class="fw-bold mb-1">
                <i class="bi bi-table text-primary me-2"></i>
                Rincian Transaksi
            </h6>

            <small class="text-muted">
                Periode:
                {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y H:i') }}
                sampai
                {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y H:i') }}
            </small>
        </div>

        <button type="button"
                onclick="window.print()"
                class="btn btn-outline-primary btn-sm">
            <i class="bi bi-printer me-1"></i>
            Cetak Laporan
        </button>

    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
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
                            <td>
                                {{ $transaksis->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $transaksi->kode_transaksi }}
                                </span>
                            </td>

                            <td>
                                {{ $transaksi->parkir?->kode_tiket ?? '-' }}
                            </td>

                            <td>
                                {{ $transaksi->parkir?->kendaraan?->plat_nomor ?? '-' }}
                            </td>

                            <td>
                                {{ $transaksi->parkir?->petugas?->name ?? '-' }}
                            </td>

                            <td>
                                @php
                                    $waktu = $transaksi->tanggal_transaksi
                                        ?? $transaksi->created_at;
                                @endphp

                                {{ $waktu?->format('d/m/Y H:i') ?? '-' }}
                            </td>

                            <td class="fw-semibold text-success">
                                Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    Lunas
                                </span>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted"></i>

                                <p class="text-muted mb-0 mt-2">
                                    Tidak ada transaksi lunas pada periode ini.
                                </p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

                @if($transaksis->count() > 0)
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="6" class="text-end">
                                Total Pendapatan:
                            </th>

                            <th colspan="2" class="text-success">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                @endif

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($transaksis->hasPages())
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">

                <small class="text-muted">
                    Menampilkan {{ $transaksis->firstItem() }}
                    sampai {{ $transaksis->lastItem() }}
                    dari {{ $transaksis->total() }} transaksi
                </small>

                {{ $transaksis->links('pagination::bootstrap-5') }}

            </div>
        @endif

    </div>
</div>

<style>
    @media print {
        .sidebar,
        .topbar,
        .app-footer,
        .sidebar-overlay,
        form,
        button,
        .pagination {
            display: none !important;
        }

        .main-wrapper {
            margin: 0 !important;
        }

        .content {
            padding: 0 !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    }
</style>

@endsection
