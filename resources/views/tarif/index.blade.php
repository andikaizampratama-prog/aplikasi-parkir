
@extends('layouts.role')

@section('title', 'Data Tarif')
@section('page-title', 'Data Tarif Parkir')

@section('content')

<style>
    .tarif-page {
        --tarif-primary: #2563eb;
        --tarif-border: #e5eaf1;
    }

    .tarif-page .tarif-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .tarif-page .tarif-title {
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -.4px;
    }

    .tarif-page .tarif-subtitle {
        color: #64748b;
        font-size: 14px;
    }

    /* HERO */
    .tarif-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(120deg, #1d4ed8, #2563eb, #06b6d4);
        border-radius: 20px;
        color: white;
        padding: 28px;
        margin-bottom: 25px;
        box-shadow: 0 10px 25px rgba(37,99,235,.15);
    }

    .tarif-hero::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(255,255,255,.09);
        right: -55px;
        top: -65px;
    }

    .tarif-hero::before {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: 100px;
        bottom: -65px;
    }

    .tarif-hero-content {
        position: relative;
        z-index: 1;
    }

    .tarif-hero-icon {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.17);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 16px;
        font-size: 26px;
        margin-bottom: 15px;
    }

    /* KART TARIF */
    .tarif-card {
        border: 1px solid var(--tarif-border);
        border-radius: 20px;
        background: #fff;
        overflow: hidden;
        transition: .25s;
    }

    .tarif-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(15,23,42,.08) !important;
    }

    .tarif-card .card-body {
        padding: 25px;
    }

    .tarif-vehicle-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 17px;
        font-size: 28px;
    }

    .tarif-motor {
        background: #eff6ff;
        color: #2563eb;
    }

    .tarif-mobil {
        background: #ecfeff;
        color: #0891b2;
    }

    .tarif-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .tarif-current {
        padding: 18px;
        border: 1px dashed #dbe4ef;
        border-radius: 15px;
        background: #f8fafc;
        margin: 20px 0;
    }

    .tarif-price {
        font-size: 30px;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -.6px;
    }

    .tarif-price small {
        font-size: 13px;
        font-weight: 500;
        color: #64748b;
        letter-spacing: 0;
    }

    .tarif-input {
        border-radius: 12px;
        padding: 12px 14px;
        border: 1px solid #dbe3ed;
        font-weight: 600;
    }

    .tarif-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }

    .tarif-save {
        padding: 12px;
        border-radius: 12px;
        font-weight: 700;
        transition: .2s;
    }

    .tarif-save:hover {
        transform: translateY(-1px);
    }

    .tarif-info {
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 13px;
    }

    .tarif-footer {
        color: #64748b;
        font-size: 12px;
        margin-top: 18px;
    }

    @media (max-width: 767px) {
        .tarif-hero {
            padding: 22px;
        }

        .tarif-card .card-body {
            padding: 20px;
        }

        .tarif-price {
            font-size: 26px;
        }
    }
</style>

<div class="tarif-page">

    {{-- HEADER --}}
    <div class="tarif-header">
        <div>
            <h4 class="tarif-title mb-1">
                <i class="bi bi-cash-stack text-primary me-2"></i>
                Pengaturan Tarif Parkir
            </h4>

            <p class="tarif-subtitle mb-0">
                Kelola biaya parkir kendaraan motor dan mobil.
            </p>
        </div>
    </div>

    {{-- HERO --}}
    <div class="tarif-hero">
        <div class="tarif-hero-content">

            <div class="tarif-hero-icon">
                <i class="bi bi-wallet2"></i>
            </div>

            <h3 class="fw-bold mb-2">
                Manajemen Tarif Parkir
            </h3>

            <p class="mb-0 text-white-50">
                Atur tarif kendaraan untuk membantu pengelolaan
                transaksi parkir secara terstruktur.
            </p>

        </div>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-circle me-2"></i>
                Tarif gagal diperbarui
            </div>

            @foreach($errors->all() as $error)
                <div class="small">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- KARTU TARIF --}}
    <div class="row g-4 mb-4">

        {{-- MOTOR --}}
        <div class="col-lg-6">
            <div class="card tarif-card shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex align-items-center gap-3 mb-3">

                        <div class="tarif-vehicle-icon tarif-motor">
                            <i class="bi bi-bicycle"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Tarif Motor</h5>
                            <span class="badge bg-primary-subtle text-primary rounded-pill">
                                Kendaraan roda dua
                            </span>
                        </div>

                    </div>

                    <p class="text-muted small mb-0">
                        Tarif parkir yang berlaku untuk kendaraan sepeda motor.
                    </p>

                    {{-- TARIF AKTIF --}}
                    <div class="tarif-current">

                        <div class="tarif-label mb-1">
                            Tarif Saat Ini
                        </div>

                        <div class="tarif-price">
                            Rp{{ number_format($motor->tarif_per_jam, 0, ',', '.') }}
                            <small>/ jam</small>
                        </div>

                        <div class="text-success small mt-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Tarif aktif
                        </div>

                    </div>

                    {{-- FORM UPDATE MOTOR --}}
                    <form action="{{ route('admin.tarif.update', $motor->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <label class="form-label fw-bold small">
                            Ubah Tarif Motor
                        </label>

                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light">
                                Rp
                            </span>

                            <input type="number"
                                   name="tarif_per_jam"
                                   min="0"
                                   step="1"
                                   class="form-control tarif-input"
                                   value="{{ old('tarif_per_jam', $motor->tarif_per_jam) }}"
                                   placeholder="Masukkan tarif motor"
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-primary tarif-save w-100">
                            <i class="bi bi-save2 me-2"></i>
                            Simpan Tarif Motor
                        </button>

                    </form>

                </div>
            </div>
        </div>

        {{-- MOBIL --}}
        <div class="col-lg-6">
            <div class="card tarif-card shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex align-items-center gap-3 mb-3">

                        <div class="tarif-vehicle-icon tarif-mobil">
                            <i class="bi bi-car-front-fill"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Tarif Mobil</h5>
                            <span class="badge bg-info-subtle text-info rounded-pill">
                                Kendaraan roda empat
                            </span>
                        </div>

                    </div>

                    <p class="text-muted small mb-0">
                        Tarif parkir yang berlaku untuk kendaraan mobil.
                    </p>

                    {{-- TARIF AKTIF --}}
                    <div class="tarif-current">

                        <div class="tarif-label mb-1">
                            Tarif Saat Ini
                        </div>

                        <div class="tarif-price">
                            Rp{{ number_format($mobil->tarif_per_jam, 0, ',', '.') }}
                            <small>/ jam</small>
                        </div>

                        <div class="text-success small mt-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Tarif aktif
                        </div>

                    </div>

                    {{-- FORM UPDATE MOBIL --}}
                    <form action="{{ route('admin.tarif.update', $mobil->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <label class="form-label fw-bold small">
                            Ubah Tarif Mobil
                        </label>

                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bold bg-light">
                                Rp
                            </span>

                            <input type="number"
                                   name="tarif_per_jam"
                                   min="0"
                                   step="1"
                                   class="form-control tarif-input"
                                   value="{{ old('tarif_per_jam', $mobil->tarif_per_jam) }}"
                                   placeholder="Masukkan tarif mobil"
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-primary tarif-save w-100">
                            <i class="bi bi-save2 me-2"></i>
                            Simpan Tarif Mobil
                        </button>

                    </form>

                </div>
            </div>
        </div>

    </div>

    {{-- INFORMASI --}}
    <div class="tarif-info mb-3">
        <div class="d-flex gap-2 align-items-start">
            <i class="bi bi-info-circle-fill fs-5"></i>

            <div>
                <strong>Informasi Pengaturan Tarif</strong>
                <div class="mt-1">
                    Perubahan tarif digunakan pada perhitungan biaya transaksi
                    sesuai sistem parkir yang berlaku.
                </div>
            </div>
        </div>
    </div>

    <div class="tarif-footer text-center">
        <i class="bi bi-shield-check me-1"></i>
        Pengaturan tarif dikelola oleh Administrator ParkirKu.
    </div>

</div>

@endsection
