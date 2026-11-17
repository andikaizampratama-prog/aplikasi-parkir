
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tarif Parkir - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .hero {
            background: linear-gradient(135deg, #1d4ed8, #06b6d4);
            color: white;
            padding: 25px;
            border-radius: 18px;
        }

        .card {
            border: 0;
            border-radius: 18px;
        }

        .tarif-icon {
            font-size: 40px;
            color: #2563eb;
        }

        .btn-save {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <div class="hero mb-4">
        <h3><i class="bi bi-cash-stack"></i> Pengaturan Tarif</h3>
        <p class="mb-0">Atur biaya parkir kendaraan per jam</p>
    </div>

    <a href="{{ route('admin.dashboard') }}"
       class="text-decoration-none d-inline-block mb-3">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i>
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

    <div class="row g-4">

        {{-- TARIF MOTOR --}}
        <div class="col-md-6">
            <div class="card shadow-sm p-4 h-100">

                <div class="tarif-icon mb-3">
                    <i class="bi bi-bicycle"></i>
                </div>

                <h4 class="fw-bold">Tarif Motor</h4>
                <p class="text-secondary">Biaya parkir motor per jam</p>

                <form action="{{ route('admin.tarif.update', $motor->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <label class="form-label fw-semibold">
                        Tarif Motor (Rupiah)
                    </label>

                    <input type="number"
                           name="tarif_per_jam"
                           min="0"
                           class="form-control form-control-lg mb-3"
                           value="{{ old('tarif_per_jam', $motor->tarif_per_jam) }}"
                           required>

                    <button type="submit" class="btn btn-primary btn-save w-100">
                        <i class="bi bi-save"></i>
                        Simpan Tarif Motor
                    </button>

                </form>

            </div>
        </div>

        {{-- TARIF MOBIL --}}
        <div class="col-md-6">
            <div class="card shadow-sm p-4 h-100">

                <div class="tarif-icon mb-3">
                    <i class="bi bi-car-front-fill"></i>
                </div>

                <h4 class="fw-bold">Tarif Mobil</h4>
                <p class="text-secondary">Biaya parkir mobil per jam</p>

                <form action="{{ route('admin.tarif.update', $mobil->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <label class="form-label fw-semibold">
                        Tarif Mobil (Rupiah)
                    </label>

                    <input type="number"
                           name="tarif_per_jam"
                           min="0"
                           class="form-control form-control-lg mb-3"
                           value="{{ old('tarif_per_jam', $mobil->tarif_per_jam) }}"
                           required>

                    <button type="submit" class="btn btn-primary btn-save w-100">
                        <i class="bi bi-save"></i>
                        Simpan Tarif Mobil
                    </button>

                </form>

            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
