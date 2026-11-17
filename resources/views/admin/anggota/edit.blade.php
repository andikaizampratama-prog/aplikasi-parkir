
@extends('layouts.role')

@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Form Edit Anggota</h5>
    </div>

    <div class="card-body">

        @include('admin.anggota._form')

    </div>

</div>

@endsection
