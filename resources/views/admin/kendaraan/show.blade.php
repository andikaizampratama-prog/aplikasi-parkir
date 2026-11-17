
@extends('layouts.role')

@section('title', 'Detail Kendaraan')
@section('page-title', 'Detail Kendaraan')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Data Kendaraan</h5>

        <a href="{{ route('admin.kendaraan.index') }}"
           class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="text-muted">ID Kendaraan</label>
                <div class="fw-bold">
                    {{ $kendaraan->id }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted">Plat Nomor</label>
                <div class="fw-bold">
                    {{ $kendaraan->plat_nomor }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted">Jenis Kendaraan</label>
                <div class="fw-bold">
                    {{ ucfirst($kendaraan->jenis) }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted">Nama Pemilik</label>
                <div class="fw-bold">
                    {{ $kendaraan->pemilik ?? '-' }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted">Tanggal Terdaftar</label>
                <div class="fw-bold">
                    {{ $kendaraan->created_at?->format('d-m-Y H:i') ?? '-' }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted">Terakhir Diperbarui</label>
                <div class="fw-bold">
                    {{ $kendaraan->updated_at?->format('d-m-Y H:i') ?? '-' }}
                </div>
            </div>

        </div>

        <hr>

        <h5 class="mb-3">Riwayat Parkir Kendaraan</h5>

        @if($kendaraan->parkirs && $kendaraan->parkirs->count() > 0)

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Tiket</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Biaya</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($kendaraan->parkirs as $parkir)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $parkir->kode_tiket }}
                                </td>

                                <td>
                                    {{ $parkir->waktu_masuk
                                        ? \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d-m-Y H:i')
                                        : '-'
                                    }}
                                </td>

                                <td>
                                    {{ $parkir->waktu_keluar
                                        ? \Carbon\Carbon::parse($parkir->waktu_keluar)->format('d-m-Y H:i')
                                        : '-'
                                    }}
                                </td>

                                <td>
                                    Rp {{ number_format($parkir->biaya ?? 0, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if($parkir->status == 'masuk')
                                        <span class="badge bg-warning text-dark">
                                            Masih Parkir
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Sudah Keluar
                                        </span>
                                    @endif
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="alert alert-info">
                Kendaraan ini belum memiliki riwayat parkir.
            </div>

        @endif

    </div>
</div>

@endsection
