
@extends('layouts.role')

@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')

@push('styles')
<style>
    .anggota-page {
        --anggota-primary: #2563eb;
        --anggota-text: #172033;
        --anggota-muted: #64748b;
    }

    .anggota-page .page-heading {
        margin-bottom: 24px;
    }

    .anggota-page .heading-title {
        font-size: 25px;
        font-weight: 800;
        color: var(--anggota-text);
        letter-spacing: -0.5px;
    }

    .anggota-page .heading-desc {
        color: var(--anggota-muted);
        font-size: 14px;
    }

    .anggota-page .btn-add-anggota {
        border: none;
        border-radius: 12px;
        padding: 11px 17px;
        font-weight: 600;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        box-shadow: 0 5px 15px rgba(37, 99, 235, .20);
        transition: .2s;
    }

    .anggota-page .btn-add-anggota:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, .28);
    }

    .anggota-page .stat-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        transition: .25s;
    }

    .anggota-page .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(15, 23, 42, .06);
    }

    .anggota-page .stat-icon {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 20px;
    }

    .anggota-page .stat-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
    }

    .anggota-page .stat-number {
        font-size: 27px;
        font-weight: 800;
        color: #172033;
        margin-top: 5px;
    }

    .anggota-page .main-card {
        border: 1px solid #edf0f5;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
    }

    .anggota-page .card-heading {
        padding: 21px 23px;
        border-bottom: 1px solid #f0f2f6;
    }

    .anggota-page .card-heading h5 {
        font-weight: 750;
        color: #172033;
        margin-bottom: 4px;
    }

    .anggota-page .search-input,
    .anggota-page .role-select {
        border-radius: 11px;
        min-height: 43px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
    }

    .anggota-page .search-input:focus,
    .anggota-page .role-select:focus {
        border-color: #93c5fd;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
    }

    .anggota-page .btn-search {
        border-radius: 11px;
        font-weight: 600;
        padding: 10px 18px;
    }

    .anggota-page .btn-reset {
        border-radius: 11px;
        padding: 10px 17px;
        font-weight: 600;
    }

    .anggota-page .table {
        margin-bottom: 0;
    }

    .anggota-page .table thead th {
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

    .anggota-page .table tbody td {
        padding: 14px 17px;
        border-color: #f1f4f8;
        color: #334155;
        font-size: 13px;
    }

    .anggota-page .table tbody tr {
        transition: .18s;
    }

    .anggota-page .table tbody tr:hover {
        background: #f8fbff;
    }

    .anggota-page .avatar-anggota {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #1d4ed8;
        font-size: 15px;
        font-weight: 800;
    }

    .anggota-page .member-name {
        font-weight: 700;
        color: #172033;
        font-size: 13px;
    }

    .anggota-page .member-email {
        color: #64748b;
        font-size: 12px;
    }

    .anggota-page .role-badge {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 750;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .anggota-page .role-admin {
        color: #b91c1c;
        background: #fee2e2;
    }

    .anggota-page .role-petugas {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .anggota-page .role-owner {
        color: #047857;
        background: #d1fae5;
    }

    .anggota-page .you-badge {
        font-size: 10px;
        color: #0369a1;
        background: #e0f2fe;
        padding: 3px 7px;
        border-radius: 6px;
        margin-left: 5px;
    }

    .anggota-page .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        border: none;
        transition: .2s;
    }

    .anggota-page .action-view {
        background: #e0f2fe;
        color: #0284c7;
    }

    .anggota-page .action-edit {
        background: #fef3c7;
        color: #b45309;
    }

    .anggota-page .action-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .anggota-page .action-btn:hover {
        transform: translateY(-2px);
        filter: brightness(.96);
    }

    .anggota-page .empty-state {
        padding: 55px 20px !important;
        color: #94a3b8 !important;
    }

    .anggota-page .empty-icon {
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

    .anggota-page .pagination {
        margin-bottom: 0;
        gap: 4px;
    }

    .anggota-page .pagination .page-link {
        border-radius: 8px !important;
        border: 1px solid #e2e8f0;
        color: #475569;
        margin: 0 2px;
    }

    .anggota-page .pagination .active .page-link {
        background: #2563eb;
        border-color: #2563eb;
        color: #fff;
    }

    @media(max-width: 767px) {
        .anggota-page .heading-title {
            font-size: 21px;
        }

        .anggota-page .page-heading {
            align-items: flex-start !important;
            gap: 15px;
            flex-direction: column;
        }

        .anggota-page .btn-add-anggota {
            width: 100%;
        }

        .anggota-page .stat-number {
            font-size: 23px;
        }

        .anggota-page .card-heading {
            padding: 17px;
        }

        .anggota-page .table tbody td,
        .anggota-page .table thead th {
            padding: 12px;
        }
    }
</style>
@endpush

@section('content')

@php
    $totalAnggota = \App\Models\User::count();
    $totalAdmin = \App\Models\User::where('role', 'admin')->count();
    $totalPetugas = \App\Models\User::where('role', 'petugas')->count();
    $totalOwner = \App\Models\User::where('role', 'owner')->count();
@endphp

<div class="container-fluid anggota-page pb-4">

    {{-- HEADER --}}
    <div class="page-heading d-flex justify-content-between align-items-center">
        <div>
            <div class="heading-title">
                <i class="bi bi-people-fill text-primary me-2"></i>
                Data Anggota
            </div>
            <p class="heading-desc mb-0 mt-1">
                Kelola akun pengguna dan hak akses ParkirKu.
            </p>
        </div>

        <a href="{{ route('admin.anggota.create') }}"
           class="btn btn-primary btn-add-anggota">
            <i class="bi bi-person-plus-fill me-1"></i>
            Tambah Anggota
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Total Anggota</div>
                        <div class="stat-number">{{ $totalAnggota }}</div>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Administrator</div>
                        <div class="stat-number">{{ $totalAdmin }}</div>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Petugas</div>
                        <div class="stat-number">{{ $totalPetugas }}</div>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Owner</div>
                        <div class="stat-number">{{ $totalOwner }}</div>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i class="bi bi-person-check-fill"></i>
            </div>
        </div>
    </div>

</div>

    {{-- TABEL DATA --}}
    <div class="main-card">

        <div class="card-heading">
            <h5>
                <i class="bi bi-list-ul text-primary me-2"></i>
                Daftar Anggota
            </h5>
            <div class="text-muted small">
                Data akun dan role pengguna sistem
            </div>
        </div>

        <div class="p-3 p-md-4">

            {{-- SEARCH & FILTER --}}
            <form action="{{ route('admin.anggota.index') }}"
                  method="GET"
                  class="row g-2 mb-4">

                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-3">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text"
                               name="q"
                               class="form-control search-input border-start-0"
                               placeholder="Cari nama atau email anggota..."
                               value="{{ request('q') }}">
                    </div>
                </div>

                <div class="col-lg-3">
                    <select name="role" class="form-select role-select">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                            Administrator
                        </option>
                        <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>
                            Petugas
                        </option>
                        <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>
                            Owner
                        </option>
                    </select>
                </div>

                <div class="col-lg-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-search">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>

                    <a href="{{ route('admin.anggota.index') }}"
                       class="btn btn-light border btn-reset">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </a>
                </div>

            </form>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Anggota</th>
                            <th>Role</th>
                            <th>Tanggal Bergabung</th>
                            <th class="text-center" style="width:145px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse ($anggotas as $anggota)

                        <tr>
                            <td class="text-muted">
                                {{ $anggotas->firstItem() + $loop->index }}
                            </td>

                            {{-- IDENTITAS --}}
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-anggota">
                                        {{ strtoupper(substr($anggota->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="member-name">
                                            {{ $anggota->name }}

                                            @if ($anggota->id === auth()->id())
                                                <span class="you-badge">Anda</span>
                                            @endif
                                        </div>

                                        <div class="member-email">
                                            <i class="bi bi-envelope me-1"></i>
                                            {{ $anggota->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- ROLE --}}
                            <td>
                                @if ($anggota->role === 'admin')
                                    <span class="role-badge role-admin">
                                        <i class="bi bi-shield-fill-check"></i>
                                        Admin
                                    </span>
                                @elseif ($anggota->role === 'petugas')
                                    <span class="role-badge role-petugas">
                                        <i class="bi bi-person-badge-fill"></i>
                                        Petugas
                                    </span>
                                @else
                                    <span class="role-badge role-owner">
                                        <i class="bi bi-person-check-fill"></i>
                                        Owner
                                    </span>
                                @endif
                            </td>

                            {{-- TANGGAL --}}
                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $anggota->created_at?->format('d M Y') ?? '-' }}
                                </div>
                                <div class="small text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    Akun dibuat
                                </div>
                            </td>

                            {{-- ACTION --}}
                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.anggota.show', ['anggota' => $anggota->id]) }}"
                                       class="action-btn action-view"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <a href="{{ route('admin.anggota.edit', ['anggota' => $anggota->id]) }}"
                                       class="action-btn action-edit"
                                       title="Edit Anggota">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    @if ($anggota->id !== auth()->id())
                                        <form action="{{ route('admin.anggota.destroy', ['anggota' => $anggota->id]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="action-btn action-delete"
                                                    title="Hapus Anggota">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="empty-state text-center">
                                <div class="empty-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="fw-bold text-secondary mb-1">
                                    Data anggota belum tersedia
                                </div>
                                <div class="small">
                                    Coba ubah kata pencarian atau tambahkan anggota baru.
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
                    Menampilkan {{ $anggotas->firstItem() ?? 0 }}
                    - {{ $anggotas->lastItem() ?? 0 }}
                    dari {{ $anggotas->total() }} anggota
                </div>

                <div>
                    {{ $anggotas->appends(request()->query())->links() }}
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
