
@extends('layouts.role')

@section('title', 'Area Parkir')
@section('page-title', 'Data Area Parkir')

@push('styles')
<style>
    .area-card {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0,0,0,.05);
    }
    .stat-number {
        font-size: 27px;
        font-weight: 700;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        text-transform: uppercase;
        padding: 15px;
    }
    .table tbody td {
        padding: 15px;
        vertical-align: middle;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Manajemen Area Parkir</h4>
            <p class="text-muted mb-0">Kelola area dan kapasitas parkir kendaraan.</p>
        </div>
        <a href="{{ route('admin.area-parkir.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Area
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card area-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Total Area</div>
                        <div class="stat-number">{{ $totalArea }}</div>
                    </div>
                    <div class="stat-icon bg-primary-subtle text-primary">
                        <i class="bi bi-grid"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card area-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Kapasitas Motor</div>
                        <div class="stat-number">{{ $totalMotor }}</div>
                    </div>
                    <div class="stat-icon bg-success-subtle text-success">
                        <i class="bi bi-bicycle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card area-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Kapasitas Mobil</div>
                        <div class="stat-number">{{ $totalMobil }}</div>
                    </div>
                    <div class="stat-icon bg-info-subtle text-info">
                        <i class="bi bi-car-front"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card area-card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Area Aktif</div>
                        <div class="stat-number">{{ $areaAktif }}</div>
                    </div>
                    <div class="stat-icon bg-warning-subtle text-warning">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card area-card">
        <div class="card-header bg-white border-0 p-3">
            <h5 class="fw-bold mb-0">Daftar Area Parkir</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Area</th>
                        <th>Jenis Kendaraan</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($areas as $area)
                        <tr>
                            <td>{{ $areas->firstItem() + $loop->index }}</td>
                            <td class="fw-semibold">{{ $area->nama_area }}</td>
                            <td>
                                @if($area->jenis_kendaraan === 'motor')
                                    <span class="badge bg-success-subtle text-success">Motor</span>
                                @else
                                    <span class="badge bg-info-subtle text-info">Mobil</span>
                                @endif
                            </td>
                            <td>{{ number_format($area->kapasitas) }} kendaraan</td>
                            <td>
                                @if($area->status === 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $area->keterangan ?: '-' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.area-parkir.edit', $area->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.area-parkir.destroy', $area->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus area ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data area parkir.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $areas->links() }}
        </div>
    </div>
</div>
@endsection
