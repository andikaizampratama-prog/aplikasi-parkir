
@extends('layouts.role')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Administrator')

@push('styles')
<style>
    .admin-dashboard {
        --dash-text: #172033;
        --dash-muted: #8994a7;
        color: var(--dash-text);
    }

    /* ANIMASI */
    @keyframes dashReveal {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes softPulse {
        0%, 100% { opacity: .65; }
        50% { opacity: 1; }
    }

    @keyframes floatIcon {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .dash-animate {
        animation: dashReveal .65s cubic-bezier(.2,.7,.3,1) both;
    }

    .dash-delay-1 { animation-delay: .08s; }
    .dash-delay-2 { animation-delay: .16s; }
    .dash-delay-3 { animation-delay: .24s; }
    .dash-delay-4 { animation-delay: .32s; }
    .dash-delay-5 { animation-delay: .40s; }

    /* WELCOME */
    .dash-welcome {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        padding: 30px;
        color: white;
        background: linear-gradient(120deg, #111c3b, #1d4ed8 60%, #3b82f6);
        box-shadow: 0 15px 40px rgba(37,99,235,.20);
        margin-bottom: 26px;
    }

    .dash-welcome::before,
    .dash-welcome::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .dash-welcome::before {
        width: 280px;
        height: 280px;
        background: rgba(255,255,255,.07);
        right: -70px;
        top: -130px;
    }

    .dash-welcome::after {
        width: 180px;
        height: 180px;
        background: rgba(255,255,255,.05);
        right: 100px;
        bottom: -120px;
    }

    .dash-welcome-content {
        position: relative;
        z-index: 2;
    }

    .dash-welcome h3 {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 9px;
        letter-spacing: -.5px;
    }

    .dash-welcome p {
        font-size: 13px;
        margin-bottom: 0;
        color: rgba(255,255,255,.8);
    }

    .dash-welcome-icon {
        position: absolute;
        right: 35px;
        bottom: -18px;
        font-size: 115px;
        color: rgba(255,255,255,.10);
        transform: rotate(-8deg);
        transition: .4s ease;
    }

    .dash-welcome:hover .dash-welcome-icon {
        transform: rotate(0deg) scale(1.08);
    }

    .dash-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
        padding: 8px 13px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 10px;
        font-size: 12px;
        backdrop-filter: blur(8px);
    }

    /* STATISTIK */
    .dash-stat-card {
        height: 100%;
        min-height: 175px;
        padding: 22px;
        border-radius: 19px;
        background: #fff;
        border: 1px solid #edf0f5;
        box-shadow: 0 5px 20px rgba(15,23,42,.035);
        position: relative;
        overflow: hidden;
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }

    .dash-stat-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        right: -45px;
        bottom: -50px;
        background: var(--card-glow, rgba(59,130,246,.07));
        transition: transform .4s ease;
    }

    .dash-stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 32px rgba(15,23,42,.09);
        border-color: var(--card-border, #dbeafe);
    }

    .dash-stat-card:hover::after {
        transform: scale(2);
    }

    .dash-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dash-stat-icon {
        width: 49px;
        height: 49px;
        border-radius: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        transition: transform .3s ease;
    }

    .dash-stat-card:hover .dash-stat-icon {
        animation: floatIcon .8s ease;
    }

    .dash-stat-label {
        font-size: 12px;
        color: #8792a5;
        font-weight: 700;
        letter-spacing: .3px;
    }

    .dash-stat-number {
        font-size: 30px;
        font-weight: 850;
        letter-spacing: -.8px;
        margin-top: 20px;
        margin-bottom: 5px;
        color: var(--dash-text);
        line-height: 1.2;
        position: relative;
        z-index: 1;
    }

    .dash-stat-description {
        color: #9aa4b5;
        font-size: 11px;
        position: relative;
        z-index: 1;
    }

    .dash-stat-description i {
        margin-right: 4px;
    }

    .stat-blue {
        --card-glow: rgba(59,130,246,.1);
        --card-border: #bfdbfe;
    }

    .stat-blue .dash-stat-icon {
        background: #eff6ff;
        color: #3b82f6;
    }

    .stat-green {
        --card-glow: rgba(16,185,129,.1);
        --card-border: #bbf7d0;
    }

    .stat-green .dash-stat-icon {
        background: #ecfdf5;
        color: #10b981;
    }

    .stat-purple {
        --card-glow: rgba(139,92,246,.1);
        --card-border: #ddd6fe;
    }

    .stat-purple .dash-stat-icon {
        background: #f5f3ff;
        color: #8b5cf6;
    }

    .stat-orange {
        --card-glow: rgba(249,115,22,.1);
        --card-border: #fed7aa;
    }

    .stat-orange .dash-stat-icon {
        background: #fff7ed;
        color: #f97316;
    }

    /* PANEL */
    .dash-panel {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 20px;
        box-shadow: 0 5px 22px rgba(15,23,42,.035);
        overflow: hidden;
    }

    .dash-panel-header {
        padding: 22px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
        border-bottom: 1px solid #f0f2f6;
    }

    .dash-panel-title {
        font-size: 16px;
        font-weight: 800;
        color: #202b40;
        margin: 0;
    }

    .dash-panel-subtitle {
        color: #98a2b3;
        font-size: 12px;
        margin-top: 5px;
    }

    .dash-panel-tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 30px;
        background: #eff6ff;
        color: #3b82f6;
        font-size: 11px;
        font-weight: 700;
    }

    .dash-live-dot {
        width: 7px;
        height: 7px;
        background: #3b82f6;
        border-radius: 50%;
        animation: softPulse 1.6s infinite;
    }

    /* GRAFIK */
    .dash-chart-wrapper {
        position: relative;
        height: 320px;
        padding: 22px 24px 25px;
    }

    /* TABEL */
    .dash-table {
        margin: 0;
        min-width: 650px;
    }

    .dash-table thead th {
        background: #f8fafc;
        color: #8490a3;
        text-transform: uppercase;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .7px;
        padding: 14px 20px;
        border-bottom: 1px solid #edf0f5;
        white-space: nowrap;
    }

    .dash-table tbody td {
        padding: 15px 20px;
        vertical-align: middle;
        font-size: 12px;
        border-bottom: 1px solid #f1f4f8;
    }

    .dash-table tbody tr {
        transition: background .2s ease;
    }

    .dash-table tbody tr:hover {
        background: #f8fbff;
    }

    .dash-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .dash-ticket {
        display: inline-block;
        padding: 6px 10px;
        background: #eff6ff;
        border-radius: 8px;
        color: #2563eb;
        font-size: 11px;
        font-weight: 800;
    }

    .dash-plate {
        color: #273449;
        font-weight: 800;
        letter-spacing: .4px;
    }

    .dash-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .dash-status-in {
        background: #ecfdf5;
        color: #059669;
    }

    .dash-status-out {
        background: #f1f5f9;
        color: #64748b;
    }

    .dash-empty {
        padding: 45px 15px !important;
        text-align: center;
        color: #a0aabb;
    }

    .dash-empty i {
        display: block;
        font-size: 40px;
        margin-bottom: 10px;
    }

    /* RESPONSIVE */
    @media(max-width:768px) {
        .dash-welcome {
            padding: 24px 20px;
            border-radius: 17px;
        }

        .dash-welcome h3 {
            font-size: 20px;
        }

        .dash-welcome-icon {
            font-size: 80px;
            right: 10px;
            bottom: -10px;
        }

        .dash-stat-card {
            padding: 18px;
            min-height: 160px;
        }

        .dash-stat-number {
            font-size: 26px;
        }

        .dash-panel-header {
            padding: 18px;
        }

        .dash-chart-wrapper {
            height: 270px;
            padding: 15px;
        }
    }

    @media(prefers-reduced-motion: reduce) {
        .admin-dashboard *,
        .admin-dashboard *::before,
        .admin-dashboard *::after {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endpush

@section('content')

<div class="admin-dashboard">

    {{-- WELCOME --}}
    <div class="dash-welcome dash-animate">
        <div class="dash-welcome-content">
            <h3>Selamat Datang, {{ auth()->user()->name }}!</h3>

            <p>
                <i class="bi bi-shield-check me-1"></i>
                Anda masuk ke panel Administrator Andika Parking.
            </p>

            <div class="dash-date">
                <i class="bi bi-calendar3"></i>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        <i class="bi bi-car-front-fill dash-welcome-icon"></i>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 g-xl-4">

        {{-- TOTAL KENDARAAN --}}
        <div class="col-xl-3 col-sm-6 dash-animate dash-delay-1">
            <div class="dash-stat-card stat-blue">
                <div class="dash-stat-top">
                    <span class="dash-stat-label">Total Kendaraan</span>
                    <div class="dash-stat-icon">
                        <i class="bi bi-car-front-fill"></i>
                    </div>
                </div>

                <h2 class="dash-stat-number counter"
                    data-target="{{ $totalKendaraan }}">0</h2>

                <div class="dash-stat-description">
                    <i class="bi bi-database"></i>
                    Seluruh kendaraan terdaftar
                </div>
            </div>
        </div>

        {{-- PARKIR AKTIF --}}
        <div class="col-xl-3 col-sm-6 dash-animate dash-delay-2">
            <div class="dash-stat-card stat-green">
                <div class="dash-stat-top">
                    <span class="dash-stat-label">Parkir Aktif</span>
                    <div class="dash-stat-icon">
                        <i class="bi bi-p-square-fill"></i>
                    </div>
                </div>

                <h2 class="dash-stat-number counter"
                    data-target="{{ $parkirAktif }}">0</h2>

                <div class="dash-stat-description">
                    <i class="bi bi-clock"></i>
                    Kendaraan sedang parkir
                </div>
            </div>
        </div>

        {{-- TOTAL TRANSAKSI --}}
        <div class="col-xl-3 col-sm-6 dash-animate dash-delay-3">
            <div class="dash-stat-card stat-purple">
                <div class="dash-stat-top">
                    <span class="dash-stat-label">Total Transaksi</span>
                    <div class="dash-stat-icon">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                </div>

                <h2 class="dash-stat-number counter"
                    data-target="{{ $totalTransaksi }}">0</h2>

                <div class="dash-stat-description">
                    <i class="bi bi-graph-up-arrow"></i>
                    Seluruh transaksi tercatat
                </div>
            </div>
        </div>

        {{-- PENDAPATAN HARI INI --}}
        <div class="col-xl-3 col-sm-6 dash-animate dash-delay-4">
            <div class="dash-stat-card stat-orange">
                <div class="dash-stat-top">
                    <span class="dash-stat-label">Pendapatan Hari Ini</span>
                    <div class="dash-stat-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>

                <h2 class="dash-stat-number counter currency"
                    data-target="{{ (int) $pendapatanHariIni }}">0</h2>

                <div class="dash-stat-description">
                    <i class="bi bi-calendar-check"></i>
                    Pendapatan pada hari ini
                </div>
            </div>
        </div>

    </div>

    {{-- GRAFIK PENDAPATAN 7 HARI --}}
    <div class="dash-panel mt-4 dash-animate dash-delay-3">

        <div class="dash-panel-header">
            <div>
                <h5 class="dash-panel-title">
                    <i class="bi bi-bar-chart-line text-primary me-2"></i>
                    Grafik Pendapatan Parkir
                </h5>

                <div class="dash-panel-subtitle">
                    Ringkasan pendapatan selama 7 hari terakhir
                </div>
            </div>

            <div class="dash-panel-tag">
                <i class="bi bi-calendar-week"></i>
                7 Hari Terakhir
            </div>
        </div>

        <div class="dash-chart-wrapper">
            <canvas id="grafikPendapatan"></canvas>
        </div>

    </div>

    {{-- AKTIVITAS PARKIR --}}
    <div class="dash-panel mt-4 dash-animate dash-delay-5">

        <div class="dash-panel-header">
            <div>
                <h5 class="dash-panel-title">
                    <i class="bi bi-activity text-primary me-2"></i>
                    Aktivitas Parkir Terbaru
                </h5>

                <div class="dash-panel-subtitle">
                    Riwayat kendaraan terbaru yang tercatat dalam sistem
                </div>
            </div>

            <div class="dash-panel-tag">
                <span class="dash-live-dot"></span>
                Data Terbaru
            </div>
        </div>

        <div class="table-responsive">
            <table class="table dash-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Tiket</th>
                        <th>Plat Nomor</th>
                        <th>Waktu Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($parkirTerbaru as $index => $parkir)
                    <tr>
                        <td class="text-muted">{{ $index + 1 }}</td>

                        <td>
                            <span class="dash-ticket">
                                {{ $parkir->kode_tiket }}
                            </span>
                        </td>

                        <td>
                            <span class="dash-plate">
                                {{ $parkir->kendaraan->plat_nomor ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <i class="bi bi-calendar-event text-muted me-1"></i>

                            {{ $parkir->waktu_masuk
                                ? \Carbon\Carbon::parse($parkir->waktu_masuk)->format('d/m/Y H:i')
                                : '-' }}
                        </td>

                        <td>
                            @if($parkir->status == 'masuk')
                                <span class="dash-status dash-status-in">
                                    <i class="bi bi-clock-fill"></i>
                                    Sedang Parkir
                                </span>
                            @else
                                <span class="dash-status dash-status-out">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Keluar
                                </span>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="dash-empty">
                            <i class="bi bi-inbox"></i>
                            Belum ada data parkir.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection

@push('scripts')

{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ANIMASI ANGKA STATISTIK */
    document.querySelectorAll('.admin-dashboard .counter').forEach(function (element) {

        const target = Number(element.dataset.target) || 0;
        const duration = 1100;
        const startTime = performance.now();

        function animateNumber(currentTime) {
            const progress = Math.min((currentTime - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 4);
            const value = Math.floor(target * eased);

            if (element.classList.contains('currency')) {
                element.innerHTML = 'Rp ' + value.toLocaleString('id-ID');
            } else {
                element.textContent = value.toLocaleString('id-ID');
            }

            if (progress < 1) {
                requestAnimationFrame(animateNumber);
            }
        }

        requestAnimationFrame(animateNumber);
    });

    /* GRAFIK PENDAPATAN 7 HARI */
    const canvas = document.getElementById('grafikPendapatan');

    if (canvas && typeof Chart !== 'undefined') {

        const ctx = canvas.getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.25)');
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.01)');

        const labels = @json($labels);
        const dataPendapatan = @json($pendapatanGrafik);

        new Chart(ctx, {
            type: 'line',

            data: {
                labels: labels,

                datasets: [{
                    label: 'Pendapatan',
                    data: dataPendapatan,

                    borderColor: '#3b82f6',
                    backgroundColor: gradient,

                    borderWidth: 3,
                    fill: true,

                    tension: 0.4,

                    pointRadius: 5,
                    pointHoverRadius: 8,

                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 3
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                animation: {
                    duration: 1200,
                    easing: 'easeOutQuart'
                },

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        backgroundColor: '#172033',
                        titleColor: '#ffffff',
                        bodyColor: '#dbeafe',
                        padding: 12,
                        cornerRadius: 10,

                        displayColors: false,

                        callbacks: {
                            label: function(context) {
                                return 'Pendapatan: Rp ' +
                                    Number(context.parsed.y).toLocaleString('id-ID');
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        },

                        ticks: {
                            color: '#8994a7',
                            font: {
                                size: 11
                            }
                        }
                    },

                    y: {
                        beginAtZero: true,

                        border: {
                            display: false,
                            dash: [5, 5]
                        },

                        grid: {
                            color: 'rgba(148, 163, 184, 0.15)'
                        },

                        ticks: {
                            color: '#8994a7',
                            padding: 10,

                            callback: function(value) {
                                return 'Rp ' + Number(value).toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }

});
</script>
@endpush
