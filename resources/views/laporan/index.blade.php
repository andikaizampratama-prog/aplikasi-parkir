
@extends('layouts.role')

@section('title', 'Laporan Parkir')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Laporan Parkir</h2>
            <p class="text-muted mb-0">
                Rekap transaksi dan pendapatan parkir
            </p>
        </div>

        <a href="{{ auth()->user()->role === 'owner'
            ? route('owner.dashboard')
            : (auth()->user()->role === 'admin'
                ? route('admin.dashboard')
                : route('petugas.dashboard')) }}"
            class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Dashboard
        </a>
    </div>

    {{-- FILTER TANGGAL --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">

            <form action="{{ route('owner.laporan.index') }}" method="GET">
                <div class="row g-3 align-items-end">

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Tanggal Mulai
                        </label>
                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control"
                               value="{{ request('tanggal_mulai') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Tanggal Selesai
                        </label>
                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control"
                               value="{{ request('tanggal_selesai') }}">
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Filter
                        </button>

                        <a href="{{ route('owner.laporan.index') }}"
                           class="btn btn-outline-secondary">
                            Reset
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>

    {{-- TOTAL PENDAPATAN --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-2">Total Transaksi</p>
                            <h3 class="fw-bold mb-0">
                                {{ $parkirs->count() }}
                            </h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-receipt text-primary fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-2">Total Pendapatan</p>
                            <h3 class="fw-bold mb-0 text-success">
                                Rp {{ number_format($parkirs->sum('biaya'), 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-cash-stack text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-2">Rata-rata Pendapatan</p>
                            <h3 class="fw-bold mb-0 text-info">
                                Rp {{ number_format($parkirs->count() > 0 ? $parkirs->sum('biaya') / $parkirs->count() : 0, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-graph-up text-info fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL LAPORAN --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 p-4">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-table me-2"></i>
                Detail Transaksi Parkir
            </h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="px-4">No</th>
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

                            <tr>
                                <td class="px-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $parkir->kendaraan->jenis ?? '-' }}
                                </td>

                                <td>
                                    <span class="badge bg-dark">
                                        {{ $parkir->kendaraan->plat_nomor ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $parkir->waktu_masuk
                                        ? \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d/m/Y H:i')
                                        : '-' }}
                                </td>

                                <td>
                                    {{ $parkir->waktu_keluar
                                        ? \Carbon\Carbon::parse($parkir->waktu_keluar)->format('d/m/Y H:i')
                                        : '-' }}
                                </td>

                                <td>
                                    {{ $parkir->durasi ?? '-' }}
                                </td>

                                <td class="fw-semibold text-success">
                                    Rp {{ number_format($parkir->biaya ?? 0, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if($parkir->status == 'keluar')
                                        <span class="badge bg-success">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            Aktif
                                        </span>
                                    @endif
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted mt-2 mb-0">
                                        Belum ada data transaksi parkir.
                                    </p>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white border-0 p-3">
            <div class="text-muted small">
                Menampilkan {{ $parkirs->count() }} transaksi parkir.
            </div>
        </div>

    </div>

</div>

@endsection
