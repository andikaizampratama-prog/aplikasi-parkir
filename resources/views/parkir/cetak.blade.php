
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiket Parkir</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 30px;
        }

        .ticket {
            max-width: 420px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 5px;
            color: #1e293b;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 20px;
        }

        .detail {
            text-align: left;
            border-top: 1px dashed #cbd5e1;
            padding-top: 15px;
            margin-top: 15px;
        }

        .detail p {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin: 12px 0;
            font-size: 14px;
        }

        .detail strong {
            text-align: right;
            overflow-wrap: anywhere;
        }

        .biaya {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
        }

        .biaya .label {
            color: #475569;
            font-size: 14px;
        }

        .biaya .nominal {
            display: block;
            margin-top: 8px;
            font-size: 25px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .catatan {
            display: block;
            margin-top: 8px;
            color: #64748b;
            font-size: 11px;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
        }

        .status-masuk {
            background: #fef3c7;
            color: #92400e;
        }

        #qrcode {
            display: flex;
            justify-content: center;
            margin: 25px 0;
        }

        .buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        button, .back {
            border: none;
            padding: 11px 18px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #64748b;
            color: white;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .ticket {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .buttons {
                display: none;
            }
        }
    </style>
</head>
<body>

@php
    use App\Models\Tarif;
    use Carbon\Carbon;

    $sudahKeluar = $parkir->status === 'keluar';

    $waktuMasuk = Carbon::parse($parkir->waktu_masuk);

    $waktuAkhir = $sudahKeluar
        ? Carbon::parse($parkir->waktu_keluar)
        : now();

    $durasiMenit = max(
        0,
        $waktuMasuk->diffInMinutes($waktuAkhir)
    );

    $durasiJam = max(
        1,
        (int) ceil($durasiMenit / 60)
    );

    $tarif = Tarif::where(
        'jenis',
        $parkir->kendaraan?->jenis
    )->first();

    $estimasiBiaya = $tarif
        ? $durasiJam * $tarif->tarif_per_jam
        : null;

    $totalBiaya = $sudahKeluar
        ? ($parkir->biaya ?? 0)
        : $estimasiBiaya;
@endphp

<div class="ticket">

    <h2>ANDIKA PARKING</h2>
    <div class="subtitle">Bukti Tiket Parkir</div>

    <div class="detail">

        <p>
            <span>Kode Tiket</span>
            <strong>{{ $parkir->kode_tiket }}</strong>
        </p>

        <p>
            <span>Plat Nomor</span>
            <strong>{{ $parkir->kendaraan?->plat_nomor ?? '-' }}</strong>
        </p>

        <p>
            <span>Jenis Kendaraan</span>
            <strong>{{ ucfirst($parkir->kendaraan?->jenis ?? '-') }}</strong>
        </p>

        <p>
            <span>Area Parkir</span>
            <strong>
                Area {{ ucfirst($parkir->kendaraan?->jenis ?? '-') }}
            </strong>
        </p>

        <p>
            <span>Nama Petugas</span>
            <strong>{{ $parkir->petugas?->name ?? '-' }}</strong>
        </p>

        <p>
            <span>Waktu Masuk</span>
            <strong>
                {{ $waktuMasuk->format('d-m-Y H:i') }}
            </strong>
        </p>

        <p>
            <span>Waktu Keluar</span>
            <strong>
                {{ $sudahKeluar
                    ? Carbon::parse($parkir->waktu_keluar)->format('d-m-Y H:i')
                    : 'Belum Keluar'
                }}
            </strong>
        </p>

        <p>
            <span>Status Parkir</span>
            <strong>
                @if($sudahKeluar)
                    <span class="status">Sudah Keluar</span>
                @else
                    <span class="status status-masuk">Masih Parkir</span>
                @endif
            </strong>
        </p>

        @if($sudahKeluar)
            <p>
                <span>Durasi Parkir</span>
                <strong>{{ $durasiJam }} Jam</strong>
            </p>
        @endif

    </div>

    <div class="biaya">

        @if($sudahKeluar)

            <div class="label">TOTAL BIAYA FINAL</div>

            <span class="nominal">
                Rp {{ number_format($totalBiaya, 0, ',', '.') }}
            </span>

            <span class="catatan">
                Biaya akhir berdasarkan durasi parkir.
            </span>

        @else

            <div class="label">ESTIMASI BIAYA SEMENTARA</div>

            <span class="nominal">
                @if($estimasiBiaya !== null)
                    Rp {{ number_format($estimasiBiaya, 0, ',', '.') }}
                @else
                    Tarif belum tersedia
                @endif
            </span>

            <span class="catatan">
                Durasi sementara: {{ $durasiJam }} jam.
                Biaya dapat berubah saat kendaraan keluar.
            </span>

        @endif

    </div>

    <div id="qrcode"></div>

    <small>
        Silakan simpan tiket ini untuk proses keluar parkir.
    </small>

    <div class="buttons">
        <button onclick="window.print()">Cetak Tiket</button>

        <a href="{{ url()->previous() }}" class="back">Kembali</a>
    </div>

</div>

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
