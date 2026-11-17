
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Petugas - ParkirKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Dashboard Petugas</h2>
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
                <h6>Kendaraan Sedang Parkir</h6>
                <h2>{{ $parkirAktif }}</h2>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2 flex-wrap">
        <a href="{{ route('parkir.create') }}" class="btn btn-primary">
            Parkir Masuk
        </a>

        <a href="{{ route('parkir.index') }}" class="btn btn-success">
            Parkir Keluar
        </a>

        <a href="{{ route('parkir.scanner') }}" class="btn btn-dark">
            Scanner QR
        </a>
    </div>

    <div class="card mt-4">
        <div class="card-header">Parkir Terbaru</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kode Tiket</th>
                        <th>Plat Nomor</th>
                        <th>Waktu Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($parkirTerbaru as $p)
                    <tr>
                        <td>{{ $p->kode_tiket }}</td>
                        <td>{{ $p->kendaraan->plat_nomor ?? '-' }}</td>
                        <td>{{ $p->waktu_masuk }}</td>
                        <td>{{ $p->status }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada parkir.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
