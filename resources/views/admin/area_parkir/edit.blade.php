
@extends('layouts.role')

@section('title', 'Edit Area Parkir')
@section('page-title', 'Edit Area Parkir')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white p-4">
            <h5 class="fw-bold mb-1">Edit Area Parkir</h5>
            <p class="text-muted mb-0">Perbarui informasi area parkir.</p>
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

            <form action="{{ route('admin.area-parkir.update', $areaParkir->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.area_parkir.form')

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
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
