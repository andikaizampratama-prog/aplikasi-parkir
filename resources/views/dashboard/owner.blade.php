
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Owner - ParkirKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Dashboard Owner</h2>
            <p>Selamat datang, {{ auth()->user()->name }}</p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h6>Transaksi Selesai</h6>
                <h2>{{ $totalTransaksi }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h6>Pendapatan Hari Ini</h6>
                <h2>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h6>Pendapatan Bulan Ini</h6>
                <h2>Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('laporan.index') }}" class="btn btn-primary">
            Lihat Laporan Pendapatan
        </a>
    </div>

</div>

</body>
</html>
