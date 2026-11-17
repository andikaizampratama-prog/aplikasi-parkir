
@extends('layouts.role')

@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')

@section('content')

<div class="page-heading">
    <h4>Log Aktivitas</h4>
    <p>Riwayat seluruh aktivitas pengguna dalam sistem parkir.</p>
</div>

{{-- RINGKASAN --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 bg-primary-subtle text-primary p-3">
                    <i class="bi bi-clock-history fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Aktivitas</div>
                    <h4 class="fw-bold mb-0">{{ number_format($totalLog) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 bg-success-subtle text-success p-3">
                    <i class="bi bi-people fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Jenis Aktivitas</div>
                    <h4 class="fw-bold mb-0">{{ $daftarAktivitas->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 bg-warning-subtle text-warning p-3">
                    <i class="bi bi-list-check fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small">Data Ditampilkan</div>
                    <h4 class="fw-bold mb-0">{{ $logs->count() }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FILTER DAN PENCARIAN --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('admin.log-aktivitas.index') }}"
              method="GET">

            <div class="row g-3">

                <div class="col-md-5">
                    <label class="form-label fw-semibold">
                        Cari Aktivitas
                    </label>

                    <input type="text"
                           name="cari"
                           class="form-control"
                           placeholder="Nama pengguna atau deskripsi..."
                           value="{{ request('cari') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Filter Jenis Aktivitas
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

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>

                    <a href="{{ route('admin.log-aktivitas.index') }}"
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>

{{-- TABEL LOG AKTIVITAS --}}
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3">
        <h6 class="fw-bold mb-0">
            <i class="bi bi-journal-text me-2 text-primary"></i>
            Riwayat Aktivitas Pengguna
        </h6>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
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
                            <td>
                                {{ $logs->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $log->user->name ?? 'Pengguna dihapus' }}
                                </div>
                                <small class="text-muted">
                                    {{ $log->user->role ?? '-' }}
                                </small>
                            </td>

                            <td>
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ ucfirst(str_replace('_', ' ', $log->aktivitas)) }}
                                </span>
                            </td>

                            <td style="min-width: 230px;">
                                {{ $log->deskripsi ?? '-' }}
                            </td>

                            <td>
                                <small>{{ $log->ip_address ?? '-' }}</small>
                            </td>

                            <td style="min-width: 145px;">
                                <div>
                                    {{ $log->created_at->format('d-m-Y') }}
                                </div>
                                <small class="text-muted">
                                    {{ $log->created_at->format('H:i:s') }}
                                </small>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                <p class="text-muted mt-2 mb-0">
                                    Belum ada data aktivitas.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($logs->hasPages())
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-3">

                <small class="text-muted">
                    Menampilkan {{ $logs->firstItem() }} sampai
                    {{ $logs->lastItem() }} dari {{ $logs->total() }} data
                </small>

                {{ $logs->links('pagination::bootstrap-5') }}

            </div>
        @endif

    </div>
</div>

@endsection
