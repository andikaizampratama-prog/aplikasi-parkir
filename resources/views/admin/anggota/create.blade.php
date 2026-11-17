
@extends('layouts.role')

@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Form Tambah Anggota</h5>
    </div>

    <div class="card-body">

        @php($anggota = null)

        @include('admin.anggota._form')

    </div>

</div>

@endsection
