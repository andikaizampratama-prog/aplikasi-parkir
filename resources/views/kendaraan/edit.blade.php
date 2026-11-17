
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f4f7fb;font-family:Arial,sans-serif; }
        .card { border:0;border-radius:20px; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="card shadow-sm p-4 mx-auto" style="max-width:650px">
        <h3 class="fw-bold mb-4">Edit Kendaraan</h3>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.kendaraan.update',$kendaraan->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Plat Nomor</label>
                <input name="plat_nomor" class="form-control"
                    value="{{ old('plat_nomor',$kendaraan->plat_nomor) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select name="jenis" class="form-select" required>
                    <option value="motor" {{ old('jenis',$kendaraan->jenis)=='motor'?'selected':'' }}>Motor</option>
                    <option value="mobil" {{ old('jenis',$kendaraan->jenis)=='mobil'?'selected':'' }}>Mobil</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Pemilik</label>
                <input name="pemilik" class="form-control"
                    value="{{ old('pemilik',$kendaraan->pemilik) }}">
            </div>

            <button class="btn btn-primary w-100">Simpan Perubahan</button>
            <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
        </form>
    </div>
</div>
</body>
</html>
