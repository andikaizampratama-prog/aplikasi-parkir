
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Parkir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f4f7fb;
            font-family: Arial, sans-serif;
            color: #1e293b;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #0f172a;
            color: white;
            padding: 25px 18px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 35px;
            padding-left: 10px;
        }

        .brand i { color: #38bdf8; }

        .menu-title {
            font-size: 11px;
            color: #94a3b8;
            margin: 25px 10px 10px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: flex;
            gap: 12px;
            padding: 13px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            margin-left: 260px;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h2 {
            font-size: 27px;
            font-weight: bold;
        }

        .admin {
            background: white;
            padding: 10px 16px;
            border-radius: 12px;
            box-shadow: 0 3px 15px #e2e8f0;
        }

        .stat-card {
            background: white;
            border-radius: 18px;
            padding: 22px;
            height: 100%;
            box-shadow: 0 5px 20px rgba(0,0,0,.03);
            border: 1px solid #eef2f7;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .blue { background: #dbeafe; color: #2563eb; }
        .green { background: #dcfce7; color: #16a34a; }
        .orange { background: #ffedd5; color: #ea580c; }
        .purple { background: #f3e8ff; color: #9333ea; }

        .stat-card h3 {
            font-size: 27px;
            font-weight: bold;
            margin: 8px 0;
        }

        .stat-card p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .content-card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            margin-top: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,.03);
        }

        .content-card h5 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table th {
            background: #f8fafc;
            color: #64748b;
            font-size: 13px;
            padding: 15px;
        }

        .table td {
            padding: 15px;
            vertical-align: middle;
        }

        .badge-status {
            background: #dcfce7;
            color: #15803d;
            padding: 7px 12px;
            border-radius: 20px;
        }

        .quick-btn {
            border-radius: 12px;
            padding: 15px;
            font-weight: 600;
        }

        @media(max-width:900px) {
            .sidebar { width: 75px; padding: 20px 10px; }
            .brand { font-size: 20px; text-align: center; }
            .brand span, .sidebar a span, .menu-title { display: none; }
            .sidebar a { justify-content: center; font-size: 20px; }
            .main { margin-left: 75px; padding: 18px; }
        }
    </style>
</head>

<body>

<div class="sidebar">
    <div class="brand">
        <i class="bi bi-p-circle-fill"></i>
        <span>ParkirKu</span>
    </div>

    <div class="menu-title">MENU UTAMA</div>

    <a href="{{ route('dashboard') }}" class="active">
        <i class="bi bi-grid"></i><span>Dashboard</span>
    </a>

    <a href="{{ route('parkir.index') }}">
        <i class="bi bi-car-front"></i><span>Data Parkir</span>
    </a>

    <a href="{{ route('kendaraan.index') }}">
        <i class="bi bi-truck"></i><span>Data Kendaraan</span>
    </a>

    <a href="{{ route('tarif.index') }}">
        <i class="bi bi-cash-stack"></i><span>Tarif Parkir</span>
    </a>


<a href="{{ route('laporan.index') }}">
    <i class="bi bi-bar-chart"></i><span>Laporan Pendapatan</span>
</a>


    <div class="menu-title">LAINNYA</div>

    <a href="{{ route('parkir.index') }}">
        <i class="bi bi-receipt"></i><span>Transaksi</span>
    </a>
</div>

<div class="main">

    <div class="topbar">
        <div>
            <h2>Dashboard</h2>
            <p class="text-secondary mb-0">Selamat datang di sistem manajemen parkir.</p>
        </div>

       
<div class="admin d-flex align-items-center gap-3">
    <i class="bi bi-person-circle text-primary"></i>
    Admin Parkir

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-sm btn-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</div>

    </div>

    <div class="row g-4">

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="bi bi-car-front"></i></div>
                <p>Total Kendaraan</p>
                <h3>{{ number_format($totalKendaraan) }}</h3>
                <small class="text-secondary">Kendaraan terdaftar</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-p-circle"></i></div>
                <p>Parkir Aktif</p>
                <h3>{{ number_format($parkirAktif) }}</h3>
                <small class="text-secondary">Sedang berada di area</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon orange"><i class="bi bi-receipt"></i></div>
                <p>Transaksi Selesai</p>
                <h3>{{ number_format($totalTransaksi) }}</h3>
                <small class="text-secondary">Transaksi keseluruhan</small>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon purple"><i class="bi bi-wallet2"></i></div>
                <p>Pendapatan Hari Ini</p>
                <h3 style="font-size:23px">
                    Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
                </h3>
                <small class="text-secondary">Pendapatan parkir</small>
            </div>
        </div>

    </div>


<div class="content-card">
    <h5><i class="bi bi-bar-chart text-primary"></i> Grafik Pendapatan 7 Hari</h5>

    <div style="height:320px">
        <canvas id="grafikPendapatan"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($labels);
    const dataPendapatan = @json($pendapatanGrafik);

    new Chart(document.getElementById('grafikPendapatan'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: dataPendapatan,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.15)',
                fill: true,
                tension: 0.4,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: true }
            }
        }
    });
</script>


    <div class="content-card">
        <h5><i class="bi bi-lightning-charge text-primary"></i> Aksi Cepat</h5>

        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('parkir.create') }}"
                   class="btn btn-primary quick-btn w-100">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Kendaraan Masuk
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('parkir.index') }}"
                   class="btn btn-success quick-btn w-100">
                    <i class="bi bi-box-arrow-right"></i>
                    Kendaraan Keluar
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('tarif.index') }}"
                   class="btn btn-outline-primary quick-btn w-100">
                    <i class="bi bi-gear"></i>
                    Pengaturan Tarif
                </a>
            </div>
        </div>
    </div>

    <div class="content-card">
        <h5><i class="bi bi-clock-history text-primary"></i> Transaksi Parkir Terbaru</h5>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>KODE TIKET</th>
                        <th>PLAT NOMOR</th>
                        <th>JENIS</th>
                        <th>WAKTU MASUK</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($parkirTerbaru as $parkir)
                    <tr>
                        <td>{{ $parkir->kode_tiket }}</td>
                        <td><strong>{{ $parkir->kendaraan->plat_nomor }}</strong></td>
                        <td>{{ ucfirst($parkir->kendaraan->jenis) }}</td>
                        <td>{{ $parkir->waktu_masuk->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($parkir->status == 'masuk')
                                <span class="badge-status">Sedang Parkir</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-4">
                            Belum ada transaksi parkir.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
