
@extends('layouts.role')

@section('title', 'Tambah Area Parkir')
@section('page-title', 'Tambah Area Parkir')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white p-4">
            <h5 class="fw-bold mb-1">Tambah Area Parkir</h5>
            <p class="text-muted mb-0">Masukkan informasi area parkir baru.</p>
        </div>

        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.area-parkir.store') }}" method="POST">
                @csrf

                @include('admin.area_parkir.form')

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Area
                    </button>

                    <a href="{{ route('admin.area-parkir.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
