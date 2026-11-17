
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f4f7fb;font-family:Arial,sans-serif; }
        .card { border:0;border-radius:20px; }
        .hero { background:linear-gradient(135deg,#1d4ed8,#06b6d4);color:white;padding:25px;border-radius:18px; }
        .form-control,.form-select { padding:13px;border-radius:10px; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="hero mb-4">
        <h3>Tambah Kendaraan</h3>
        <p class="mb-0">Daftarkan kendaraan baru</p>
    </div>

    <div class="card shadow-sm p-4">
        <a href="{{ route('admin.kendaraan.index') }}" class="mb-3">← Kembali</a>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.kendaraan.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Plat Nomor</label>
                <input name="plat_nomor" class="form-control text-uppercase"
                       placeholder="N 1234 AB" value="{{ old('plat_nomor') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kendaraan</label>
                <select name="jenis" class="form-select" required>
                    <option value="">Pilih jenis</option>
                    <option value="motor">Motor</option>
                    <option value="mobil">Mobil</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Nama Pemilik</label>
                <input name="pemilik" class="form-control"
                       value="{{ old('pemilik') }}" placeholder="Nama pemilik">
            </div>

            <button class="btn btn-primary w-100">Simpan Kendaraan</button>
        </form>
    </div>
</div>
</body>
</html>
