
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Kendaraan</h4>
        </div>

        <div class="card-body">
            <p><strong>Plat Nomor:</strong> {{ $kendaraan->plat_nomor }}</p>
            <p><strong>Jenis Kendaraan:</strong> {{ $kendaraan->jenis_kendaraan ?? $kendaraan->jenis ?? '-' }}</p>
            <p><strong>Nama Pemilik:</strong> {{ $kendaraan->nama_pemilik ?? $kendaraan->pemilik ?? '-' }}</p>

            <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
</div>

</body>
</html>
