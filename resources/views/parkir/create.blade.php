
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kendaraan Masuk - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f1f5f9;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #1e293b;
        }

        .page-wrapper {
            max-width: 1200px;
            margin: auto;
            padding: 35px 20px;
        }

        /* HEADER */
        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #10254d, #1d4ed8, #0891b2);
            border-radius: 24px;
            padding: 35px;
            color: white;
            margin-bottom: 28px;
            box-shadow: 0 15px 35px rgba(30, 64, 175, .15);
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border: 35px solid rgba(255,255,255,.07);
            border-radius: 50%;
            right: -80px;
            top: -90px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-icon {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 19px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.15);
            font-size: 32px;
            margin-bottom: 20px;
        }

        .hero h2 {
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -.5px;
        }

        .hero p {
            color: #dbeafe;
            margin-bottom: 0;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.12);
            padding: 9px 14px;
            border-radius: 50px;
            font-size: 13px;
            margin-top: 18px;
        }

        /* LAYOUT */
        .main-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 24px;
            align-items: stretch;
        }

        .form-card,
        .info-card {
            background: white;
            border: 1px solid #e8edf4;
            border-radius: 22px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, .04);
        }

        .form-card {
            padding: 30px;
        }

        .section-title {
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .section-subtitle {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 27px;
        }

        /* FORM */
        .form-label {
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 9px;
            color: #334155;
        }

        .input-group-custom {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 18px;
            z-index: 3;
        }

        .form-control,
        .form-select {
            min-height: 52px;
            border: 1px solid #dce4ee;
            border-radius: 12px;
            background-color: #f8fafc;
            padding: 12px 15px 12px 45px;
            font-size: 14px;
            transition: .2s;
        }

        .form-select {
            padding-left: 15px;
        }

        .form-control:focus,
        .form-select:focus {
            background: white;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59,130,246,.1);
        }

        .plate-input {
            font-size: 18px !important;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .form-text {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 8px;
        }

        /* VEHICLE SELECT */
        .vehicle-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .vehicle-option {
            position: relative;
        }

        .vehicle-option input {
            position: absolute;
            opacity: 0;
        }

        .vehicle-option label {
            border: 1px solid #dce4ee;
            border-radius: 14px;
            padding: 18px 12px;
            display: flex;
            align-items: center;
            gap: 13px;
            cursor: pointer;
            background: #f8fafc;
            transition: .2s;
        }

        .vehicle-option label:hover {
            border-color: #93c5fd;
            background: #eff6ff;
        }

        .vehicle-option input:checked + label {
            border-color: #2563eb;
            background: #eff6ff;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .vehicle-option input:focus-visible + label {
            outline: 3px solid #93c5fd;
        }

        .vehicle-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e0edff;
            color: #2563eb;
            border-radius: 12px;
            font-size: 23px;
            flex-shrink: 0;
        }

        .vehicle-name {
            font-weight: 800;
            font-size: 14px;
            display: block;
        }

        .vehicle-desc {
            font-size: 11px;
            color: #64748b;
        }

        /* BUTTON */
        .btn-submit {
            background: linear-gradient(135deg, #2563eb, #0891b2);
            color: white;
            border: none;
            border-radius: 13px;
            padding: 15px;
            font-weight: 800;
            transition: .2s;
        }

        .btn-submit:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(37,99,235,.2);
        }

        .btn-back {
            border: 1px solid #e2e8f0;
            background: white;
            color: #475569;
            border-radius: 12px;
            padding: 11px 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
        }

        .btn-back:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        /* INFO PANEL */
        .info-card {
            padding: 27px;
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 23px;
        }

        .info-header-icon {
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ecfeff;
            color: #0891b2;
            border-radius: 13px;
            font-size: 21px;
        }

        .info-header h5 {
            font-size: 16px;
            font-weight: 800;
            margin: 0;
        }

        .info-header small {
            color: #94a3b8;
        }

        .step-item {
            display: flex;
            gap: 13px;
            margin-bottom: 22px;
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: #2563eb;
            font-size: 13px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .step-item h6 {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .step-item p {
            color: #64748b;
            font-size: 12px;
            margin: 0;
            line-height: 1.6;
        }

        .info-notice {
            background: #f0f9ff;
            border: 1px solid #dbeafe;
            border-radius: 14px;
            padding: 15px;
            margin-top: 25px;
        }

        .info-notice i {
            color: #0284c7;
        }

        .info-notice p {
            font-size: 12px;
            color: #475569;
            margin: 8px 0 0;
            line-height: 1.6;
        }

        .footer-text {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 28px;
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .page-wrapper {
                padding: 20px 14px;
            }

            .hero {
                padding: 25px;
                border-radius: 19px;
            }

            .hero h2 {
                font-size: 23px;
            }

            .form-card,
            .info-card {
                padding: 22px;
                border-radius: 18px;
            }

            .vehicle-options {
                gap: 9px;
            }

            .vehicle-option label {
                padding: 13px 9px;
                gap: 8px;
            }

            .vehicle-icon {
                width: 38px;
                height: 38px;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    {{-- HEADER --}}
    <div class="hero">
        <div class="hero-content">

            <div class="hero-icon">
                <i class="bi bi-car-front-fill"></i>
            </div>

            <h2>Kendaraan Masuk</h2>

            <p>Catat kendaraan yang memasuki area parkir dengan cepat dan mudah.</p>

            <div class="hero-badge">
                <i class="bi bi-shield-check"></i>
                Sistem ParkirKu • Pencatatan Kendaraan
            </div>

        </div>
    </div>

    {{-- MAIN --}}
    <div class="main-grid">

        {{-- FORM CARD --}}
        <div class="form-card">

            <a href="{{ request()->routeIs('petugas.*')
                ? route('petugas.parkir.index')
                : route('admin.parkir.index') }}"
                class="btn-back mb-4">

                <i class="bi bi-arrow-left"></i>
                Kembali ke Data Parkir
            </a>

            <h4 class="section-title">Form Kendaraan</h4>

            <p class="section-subtitle">
                Lengkapi informasi kendaraan sebelum membuat tiket parkir.
            </p>

            {{-- ERROR SESSION --}}
            @if(session('error'))
                <div class="alert alert-danger rounded-3">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- VALIDATION --}}
            @if($errors->any())
                <div class="alert alert-danger rounded-3">
                    <strong><i class="bi bi-exclamation-triangle me-2"></i>Periksa kembali data Anda</strong>
                    <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ request()->routeIs('petugas.*')
                ? route('petugas.parkir.store')
                : route('admin.parkir.store') }}"
                method="POST">

                @csrf

                {{-- PLAT NOMOR --}}
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-card-text me-1 text-primary"></i>
                        Plat Nomor Kendaraan
                    </label>

                    <div class="input-group-custom">
                        <i class="bi bi-car-front input-icon"></i>

                        <input
                            type="text"
                            name="plat_nomor"
                            class="form-control plate-input text-uppercase"
                            placeholder="Contoh: N 1234 AB"
                            value="{{ old('plat_nomor') }}"
                            maxlength="15"
                            autocomplete="off"
                            required>
                    </div>

                    <div class="form-text">
                        Masukkan nomor polisi kendaraan sesuai plat.
                    </div>
                </div>

                {{-- JENIS KENDARAAN --}}
                <div class="mb-4">

                    <label class="form-label">
                        <i class="bi bi-truck-front me-1 text-primary"></i>
                        Jenis Kendaraan
                    </label>

                    <div class="vehicle-options">

                        {{-- MOTOR --}}
                        <div class="vehicle-option">
                            <input
                                type="radio"
                                name="jenis_kendaraan"
                                id="motor"
                                value="motor"
                                {{ old('jenis_kendaraan') == 'motor' ? 'checked' : '' }}
                                required>

                            <label for="motor">
                                <div class="vehicle-icon">
                                    <i class="bi bi-bicycle"></i>
                                </div>

                                <div>
                                    <span class="vehicle-name">Roda Dua</span>
                                    <span class="vehicle-desc">Roda dua</span>
                                </div>
                            </label>
                        </div>

                        {{-- MOBIL --}}
                        <div class="vehicle-option">
                            <input
                                type="radio"
                                name="jenis_kendaraan"
                                id="mobil"
                                value="mobil"
                                {{ old('jenis_kendaraan') == 'mobil' ? 'checked' : '' }}
                                required>

                            <label for="mobil">
                                <div class="vehicle-icon">
                                    <i class="bi bi-car-front-fill"></i>
                                </div>

                                <div>
                                    <span class="vehicle-name">Roda Empat</span>
                                    <span class="vehicle-desc">Roda empat</span>
                                </div>
                            </label>
                        </div>

                    </div>
                </div>

                {{-- NAMA PEMILIK --}}
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-person me-1 text-primary"></i>
                        Nama Pemilik
                        <span class="text-muted fw-normal">(Opsional)</span>
                    </label>

                    <div class="input-group-custom">
                        <i class="bi bi-person-circle input-icon"></i>

                        <input
                            type="text"
                            name="nama_pemilik"
                            class="form-control"
                            placeholder="Masukkan nama pemilik kendaraan"
                            value="{{ old('nama_pemilik') }}">
                    </div>
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-submit w-100">
                    <i class="bi bi-ticket-perforated me-2"></i>
                    Simpan & Buat Tiket
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>

            </form>

        </div>

        {{-- INFORMATION PANEL --}}
        <div class="info-card">

            <div class="info-header">
                <div class="info-header-icon">
                    <i class="bi bi-info-circle-fill"></i>
                </div>

                <div>
                    <h5>Informasi Parkir</h5>
                    <small>Prosedur kendaraan masuk</small>
                </div>
            </div>

            {{-- STEP 1 --}}
            <div class="step-item">
                <div class="step-number">01</div>

                <div>
                    <h6>Input Plat Nomor</h6>
                    <p>Pastikan nomor polisi kendaraan dimasukkan dengan benar dan sesuai kendaraan.</p>
                </div>
            </div>

            {{-- STEP 2 --}}
            <div class="step-item">
                <div class="step-number">02</div>

                <div>
                    <h6>Pilih Jenis Kendaraan</h6>
                    <p>Tentukan apakah kendaraan yang masuk merupakan motor atau mobil.</p>
                </div>
            </div>

            {{-- STEP 3 --}}
            <div class="step-item">
                <div class="step-number">03</div>

                <div>
                    <h6>Isi Nama Pemilik</h6>
                    <p>Nama pemilik dapat diisi untuk mempermudah identifikasi kendaraan.</p>
                </div>
            </div>

            {{-- STEP 4 --}}
            <div class="step-item mb-0">
                <div class="step-number">04</div>

                <div>
                    <h6>Simpan & Cetak Tiket</h6>
                    <p>Simpan data kendaraan untuk melanjutkan proses parkir dan pembuatan tiket.</p>
                </div>
            </div>

            {{-- NOTICE --}}
            <div class="info-notice">
                <i class="bi bi-lightbulb-fill fs-5"></i>

                <p>
                    <strong>Tips Petugas</strong><br>
                    Periksa kembali plat nomor dan jenis kendaraan sebelum menekan tombol simpan agar data parkir tercatat dengan benar.
                </p>
            </div>

        </div>

    </div>

    <div class="footer-text">
        <i class="bi bi-shield-lock me-1"></i>
        ParkirKu — Sistem Informasi Manajemen Parkir
    </div>

</div>

</body>
</html>
