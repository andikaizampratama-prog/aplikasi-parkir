
@extends('layouts.role')

@section('title', 'Detail Anggota')
@section('page-title', 'Detail Anggota')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

        <h5 class="mb-0 fw-bold">Detail Anggota</h5>

        <a href="{{ route('admin.anggota.index') }}"
           class="btn btn-secondary btn-sm">
            Kembali
        </a>

    </div>

    <div class="card-body">

        <div class="row mb-3">
            <div class="col-md-3 text-muted">ID Anggota</div>
            <div class="col-md-9 fw-semibold">{{ $anggota->id }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-3 text-muted">Nama Lengkap</div>
            <div class="col-md-9 fw-semibold">{{ $anggota->name }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-3 text-muted">Email</div>
            <div class="col-md-9">{{ $anggota->email }}</div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-3 text-muted">Role</div>
            <div class="col-md-9">

                @if ($anggota->role === 'admin')
                    <span class="badge bg-danger">Admin</span>
                @elseif ($anggota->role === 'petugas')
                    <span class="badge bg-primary">Petugas</span>
                @else
                    <span class="badge bg-success">Owner</span>
                @endif

            </div>
        </div>

        <hr>

        <div class="row mb-3">
            <div class="col-md-3 text-muted">Tanggal Dibuat</div>
            <div class="col-md-9">
                {{ $anggota->created_at?->format('d-m-Y H:i') }}
            </div>
        </div>

        <hr>

        <div class="row mb-4">
            <div class="col-md-3 text-muted">Terakhir Diperbarui</div>
            <div class="col-md-9">
                {{ $anggota->updated_at?->format('d-m-Y H:i') }}
            </div>
        </div>

        <a href="{{ route('admin.anggota.edit', ['anggota' => $anggota->id]) }}"
           class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit Anggota
        </a>

    </div>

</div>

@endsection
