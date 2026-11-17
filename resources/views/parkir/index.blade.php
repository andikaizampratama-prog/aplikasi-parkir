
@extends('layouts.role')

@section('title', 'Transaksi Parkir')
@section('page-title', 'Transaksi Parkir')

@section('content')


<style>
    .transaksi-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
    }

    .transaksi-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    /* TABEL AGAR MUAT DALAM LAYAR */
    .transaksi-table {
        width: 100%;
        table-layout: fixed;
        margin-bottom: 0;
    }

    .transaksi-table th,
    .transaksi-table td {
        padding: 10px 6px;
        vertical-align: middle;
        white-space: normal;
        overflow-wrap: anywhere;
        font-size: 12px;
    }

    .transaksi-table thead th {
        background: #f1f5f9;
        color: #475569;
        font-size: 11px;
    }

    /* Lebar masing-masing kolom */
    .transaksi-table th:nth-child(1) { width: 4%; }
    .transaksi-table th:nth-child(2) { width: 12%; }
    .transaksi-table th:nth-child(3) { width: 10%; }
    .transaksi-table th:nth-child(4) { width: 7%; }
    .transaksi-table th:nth-child(5) { width: 12%; }
    .transaksi-table th:nth-child(6) { width: 12%; }
    .transaksi-table th:nth-child(7) { width: 8%; }
    .transaksi-table th:nth-child(8) { width: 8%; }
    .transaksi-table th:nth-child(9) { width: 12%; }
    .transaksi-table th:nth-child(10) { width: 10%; }

    .transaksi-table .btn {
        font-size: 11px;
        padding: 5px 7px;
    }

    .status-masuk {
        background: #dcfce7;
        color: #166534;
    }

    .status-keluar {
        background: #e2e8f0;
        color: #475569;
    }

    /* Desktop: tidak perlu scroll horizontal */
    @media (min-width: 768px) {
        .table-responsive {
            overflow-x: visible;
        }
    }

    /* HP: tetap bisa digeser jika layar terlalu kecil */
    @media (max-width: 767px) {
        .transaksi-table {
            min-width: 850px;
        }
    }
</style>


{{-- HEADER --}}
<div class="transaksi-header">
    <div>
        <h4 class="fw-bold mb-1">
            <i class="bi bi-receipt text-primary"></i>
            Data Transaksi Parkir
        </h4>
        <p class="text-muted mb-0">
            Riwayat transaksi kendaraan masuk dan keluar
        </p>
    </div>

    <a href="{{ route(auth()->user()->role . '.parkir.create') }}"
       class="btn btn-primary">
        <i class="bi bi-plus-circle"></i>
        Kendaraan Masuk
    </a>
</div>

{{-- KAPASITAS AREA PARKIR --}}
<h5 class="fw-bold mb-3">
    <i class="bi bi-p-square text-primary"></i>
    Kapasitas Area Parkir
</h5>

<div class="row g-3 mb-4">

    @foreach($kapasitas as $item)

        @php
            $persentase = $item->kapasitas > 0
                ? min(100, ($item->terisi / $item->kapasitas) * 100)
                : 0;

            $penuh = $item->tersedia <= 0;
            $warna = $penuh ? 'danger' : ($persentase >= 80 ? 'warning' : 'success');
        @endphp

        <div class="col-md-6">
            <div class="card kapasitas-card shadow-sm h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div class="d-flex align-items-center gap-3">
                            <div class="kapasitas-icon
                                {{ $item->jenis == 'motor' ? 'bg-primary-subtle text-primary' : 'bg-info-subtle text-info' }}">
                                <i class="bi {{ $item->jenis == 'motor' ? 'bi-bicycle' : 'bi-car-front-fill' }}"></i>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-0">
                                    Parkir {{ ucfirst($item->jenis) }}
                                </h5>
                                <small class="text-muted">Kapasitas kendaraan</small>
                            </div>
                        </div>

                        @if($penuh)
                            <span class="badge bg-danger">PENUH</span>
                        @else
                            <span class="badge bg-success">TERSEDIA</span>
                        @endif

                    </div>

                    <div class="row text-center mb-3">

                        <div class="col-4">
                            <h3 class="fw-bold mb-0">
                                {{ $item->kapasitas }}
                            </h3>
                            <small class="text-muted">Total Slot</small>
                        </div>

                        <div class="col-4">
                            <h3 class="fw-bold mb-0 text-primary">
                                {{ $item->terisi }}
                            </h3>
                            <small class="text-muted">Terisi</small>
                        </div>

                        <div class="col-4">
                            <h3 class="fw-bold mb-0 text-success">
                                {{ $item->tersedia }}
                            </h3>
                            <small class="text-muted">Tersedia</small>
                        </div>

                    </div>

                    <div class="progress kapasitas-progress">
                        <div class="progress-bar bg-{{ $warna }}"
                             role="progressbar"
                             style="width: {{ $persentase }}%">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <small class="text-muted">Penggunaan area</small>
                        <small class="fw-bold">{{ number_format($persentase, 1) }}%</small>
                    </div>

                </div>
            </div>
        </div>

    @endforeach

</div>

{{-- RINGKASAN TRANSAKSI --}}
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">Total Transaksi</small>
                    <h4 class="fw-bold mb-0">{{ $parkirs->total() }}</h4>
                </div>
                <i class="bi bi-receipt fs-2 text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">Kendaraan Sedang Parkir</small>
                    <h4 class="fw-bold mb-0">
                        {{ \App\Models\Parkir::where('status', 'masuk')->count() }}
                    </h4>
                </div>
                <i class="bi bi-car-front fs-2 text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="text-muted">Transaksi Selesai</small>
                    <h4 class="fw-bold mb-0">
                        {{ \App\Models\Parkir::where('status', 'keluar')->count() }}
                    </h4>
                </div>
                <i class="bi bi-check-circle fs-2 text-secondary"></i>
            </div>
        </div>
    </div>

</div>

{{-- TABEL TRANSAKSI --}}
<div class="card transaksi-card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover transaksi-table mb-0">

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
                        <td>{{ $parkirs->firstItem() + $index }}</td>

                        <td>
                            <strong class="text-primary">
                                {{ $parkir->kode_tiket }}
                            </strong>
                        </td>

                        <td>
                            <span class="fw-bold">
                                {{ $parkir->kendaraan?->plat_nomor ?? '-' }}
                            </span>
                        </td>

                        <td>{{ ucfirst($parkir->kendaraan?->jenis ?? '-') }}</td>

                        <td>
                            <i class="bi bi-clock text-success"></i>
                            {{ $parkir->waktu_masuk->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            @if($parkir->waktu_keluar)
                                <i class="bi bi-clock text-danger"></i>
                                {{ $parkir->waktu_keluar->format('d/m/Y H:i') }}
                            @else
                                <span class="text-muted">Belum keluar</span>
                            @endif
                        </td>

                        <td>{{ $jam }} jam {{ $menit }} menit</td>

                        <td>
                            <strong>
                                Rp {{ number_format($parkir->biaya ?? 0, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td>
                            @if($parkir->status == 'masuk')
                                <span class="badge status-masuk">
                                    <i class="bi bi-car-front"></i>
                                    Sedang Parkir
                                </span>
                            @else
                                <span class="badge status-keluar">
                                    <i class="bi bi-check-circle"></i>
                                    Selesai
                                </span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route(auth()->user()->role . '.parkir.show', $parkir->id_area) }}"
                               class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i>
                                Detail
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="10" class="text-center py-5">
                            <i class="bi bi-receipt fs-1 text-muted"></i>
                            <p class="mt-2 mb-0">
                                Belum ada transaksi parkir.
                            </p>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        <div class="mt-4">
            {{ $parkirs->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@endsection
