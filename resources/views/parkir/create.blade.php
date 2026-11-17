
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kendaraan Masuk - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .card {
            border: 0;
            border-radius: 20px;
        }

        .header {
            background: linear-gradient(135deg, #1d4ed8, #06b6d4);
            color: white;
            padding: 25px;
            border-radius: 18px;
        }

        .form-control,
        .form-select {
            padding: 13px;
            border-radius: 10px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="header mb-4">
        <h3>
            <i class="bi bi-car-front-fill"></i>
            Kendaraan Masuk
        </h3>

        <p class="mb-0">
            Form pencatatan kendaraan masuk area parkir
        </p>
    </div>

    <!-- FORM -->
    <div class="card shadow-sm p-4">

        <!-- TOMBOL KEMBALI -->
        <a href="{{ request()->routeIs('petugas.*')
            ? route('petugas.parkir.index')
            : route('admin.parkir.index') }}"
            class="btn btn-secondary w-100 mb-3">

            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

        <!-- NOTIFIKASI ERROR -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- VALIDASI -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM SIMPAN -->
        <form action="{{ request()->routeIs('petugas.*')
            ? route('petugas.parkir.store')
            : route('admin.parkir.store') }}"
            method="POST">

            @csrf

            <!-- PLAT NOMOR -->
            <div class="mb-3">
                <label class="form-label fw-bold">
                    Plat Nomor Kendaraan
                </label>

                <input
                    type="text"
                    name="plat_nomor"
                    class="form-control text-uppercase"
                    placeholder="Contoh: N 1234 AB"
                    value="{{ old('plat_nomor') }}"
                    required>
            </div>

            <!-- JENIS KENDARAAN -->
            <div class="mb-3">
                <label class="form-label fw-bold">
                    Jenis Kendaraan
                </label>

                <select name="jenis_kendaraan" class="form-select" required>

                    <option value="">
                        -- Pilih Kendaraan --
                    </option>

                    <option value="motor"
                        {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>
                        Motor
                    </option>

                    <option value="mobil"
                        {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>
                        Mobil
                    </option>

                </select>
            </div>

            <!-- NAMA PEMILIK -->
            <div class="mb-4">
                <label class="form-label fw-bold">
                    Nama Pemilik (Opsional)
                </label>

                <input
                    type="text"
                    name="nama_pemilik"
                    class="form-control"
                    placeholder="Nama pemilik kendaraan"
                    value="{{ old('nama_pemilik') }}">
            </div>

            <!-- TOMBOL SIMPAN -->
            <button type="submit" class="btn btn-primary w-100">

                <i class="bi bi-ticket-perforated"></i>
                Simpan & Buat Tiket

            </button>

        </form>

    </div>

</div>

</body>
</html>
