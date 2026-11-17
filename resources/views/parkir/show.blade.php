
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Tiket Parkir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .ticket {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 650px;
            margin: auto;
        }

        .ticket-code {
            background: #eff6ff;
            color: #2563eb;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .line {
            border-bottom: 1px dashed #cbd5e1;
            padding: 13px 0;
            gap: 15px;
        }

        .line strong {
            text-align: right;
        }

        #qrcode img {
            margin: auto;
        }
    </style>
</head>

<body>
<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="ticket shadow-sm">

        <div class="text-center mb-4">
            <h3 class="fw-bold">TIKET PARKIR</h3>
            <p class="text-secondary">ParkirKu - Sistem Parkir</p>
        </div>

        <div class="ticket-code mb-4">
            {{ $parkir->kode_tiket }}
        </div>

        <div class="text-center mb-4">
            <div id="qrcode" class="d-flex justify-content-center my-3"></div>
            <p class="text-secondary mt-2">Scan QR Code tiket parkir</p>
        </div>

        <div class="line d-flex justify-content-between">
            <span>Plat Nomor</span>
            <strong>{{ $parkir->kendaraan?->plat_nomor ?? '-' }}</strong>
        </div>

        <div class="line d-flex justify-content-between">
            <span>Jenis Kendaraan</span>
            <strong>{{ ucfirst($parkir->kendaraan?->jenis ?? '-') }}</strong>
        </div>

        <div class="line d-flex justify-content-between">
            <span>Area Parkir</span>
            <strong>
                Area {{ ucfirst($parkir->kendaraan?->jenis ?? '-') }}
            </strong>
        </div>

        <div class="line d-flex justify-content-between">
            <span>Nama Petugas</span>
            <strong>{{ $parkir->petugas?->name ?? '-' }}</strong>
        </div>

        <div class="line d-flex justify-content-between">
            <span>Pemilik</span>
            <strong>{{ $parkir->kendaraan?->pemilik ?? '-' }}</strong>
        </div>

        <div class="line d-flex justify-content-between">
            <span>Waktu Masuk</span>
            <strong>
                {{ $parkir->waktu_masuk
                    ? $parkir->waktu_masuk->format('d/m/Y H:i:s')
                    : '-' }}
            </strong>
        </div>

        <div class="line d-flex justify-content-between">
            <span>Waktu Keluar</span>
            <strong>
                {{ $parkir->waktu_keluar
                    ? $parkir->waktu_keluar->format('d/m/Y H:i:s')
                    : 'Belum keluar' }}
            </strong>
        </div>

        <div class="line d-flex justify-content-between">
            <span>Status</span>
            <strong>{{ strtoupper($parkir->status) }}</strong>
        </div>

        <div class="text-center mt-4">
            <h6 class="text-secondary">TOTAL BIAYA PARKIR</h6>
            <h2 class="fw-bold text-primary">
                Rp {{ number_format($parkir->biaya ?? 0, 0, ',', '.') }}
            </h2>
        </div>

        <div class="d-grid gap-2 mt-4">

            @if($parkir->status == 'masuk')
                <form action="{{ route(auth()->user()->role . '.parkir.keluar', $parkir->id_area) }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="btn btn-danger w-100 py-3"
                        onclick="return confirm('Yakin ingin memproses kendaraan keluar?')">
                        <i class="bi bi-box-arrow-right"></i>
                        Kendaraan Keluar
                    </button>
                </form>
            @endif

            <a href="{{ route(auth()->user()->role . '.parkir.cetak', $parkir->id_area) }}"
               class="btn btn-primary py-3">
                <i class="bi bi-printer"></i>
                Cetak Tiket
            </a>

            <a href="{{ route(auth()->user()->role . '.parkir.index') }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Data Parkir
            </a>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const qrElement = document.getElementById('qrcode');

        if (qrElement && typeof QRCode !== 'undefined') {
            new QRCode(qrElement, {
                text: @json($parkir->kode_tiket),
                width: 180,
                height: 180,
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    });
</script>

</body>
</html>
