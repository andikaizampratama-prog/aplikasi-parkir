
@extends('layouts.role')

@section('title', 'Notifikasi')
@section('page-title', 'Notifikasi')

@section('content')

<style>
    .notif-page {
        padding-bottom: 20px;
    }

    .notif-hero {
        background: linear-gradient(135deg, #172554, #1d4ed8, #60a5fa);
        border-radius: 20px;
        padding: 28px;
        color: white;
        margin-bottom: 24px;
    }

    .notif-hero h3 {
        font-weight: 800;
        margin-bottom: 8px;
    }

    .notif-hero p {
        margin-bottom: 0;
        color: rgba(255,255,255,.85);
    }

    .notif-hero-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        background: rgba(255,255,255,.17);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 29px;
    }

    .notif-stat {
        height: 100%;
        background: #fff;
        border: none;
        border-radius: 17px;
        padding: 21px;
        box-shadow: 0 4px 18px rgba(15,23,42,.05);
        transition: .2s;
    }

    .notif-stat:hover {
        transform: translateY(-3px);
    }

    .notif-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        margin-bottom: 15px;
    }

    .notif-stat h3 {
        font-size: 25px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .notif-stat p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .notif-card {
        background: #fff;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(15,23,42,.05);
    }

    .notif-card-header {
        padding: 21px;
        border-bottom: 1px solid #edf0f5;
    }

    .notif-card-header h5 {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .notif-item {
        position: relative;
        display: flex;
        gap: 16px;
        padding: 20px;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        margin-bottom: 14px;
        transition: .2s;
    }

    .notif-item:hover {
        border-color: #bfdbfe;
        transform: translateY(-1px);
    }

    .notif-item.unread {
        background: #f0f7ff;
        border-color: #bfdbfe;
    }

    .notif-item.read {
        background: #fff;
    }

    .notif-icon {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .notif-content {
        flex: 1;
        min-width: 0;
    }

    .notif-title {
        font-weight: 800;
        color: #1e293b;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .notif-message {
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 12px;
        overflow-wrap: anywhere;
    }

    .notif-time {
        color: #94a3b8;
        font-size: 11px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .notif-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .notif-badge-new {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .notif-badge-read {
        background: #f1f5f9;
        color: #64748b;
    }

    .notif-read-btn {
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        padding: 7px 12px;
    }

    .notif-empty {
        text-align: center;
        padding: 55px 20px;
    }

    .notif-empty-icon {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        color: #94a3b8;
        border-radius: 23px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
        margin: 0 auto 18px;
    }

    .notif-pagination {
        border-top: 1px solid #edf0f5;
        padding: 20px;
    }

    @media(max-width: 768px) {
        .notif-hero {
            padding: 22px;
        }

        .notif-hero-icon {
            width: 52px;
            height: 52px;
            font-size: 24px;
        }

        .notif-item {
            padding: 15px;
            gap: 12px;
        }

        .notif-icon {
            width: 42px;
            height: 42px;
            font-size: 18px;
        }
    }
</style>

<div class="notif-page">

    {{-- HEADER --}}
    <div class="notif-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3>
                    <i class="bi bi-bell me-2"></i>
                    Pusat Notifikasi
                </h3>
                <p>
                    Informasi terbaru dan pemberitahuan aktivitas sistem parkir.
                </p>
            </div>

            <div class="notif-hero-icon">
                <i class="bi bi-bell-fill"></i>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL NOTIFIKASI --}}
        <div class="col-6 col-lg-4">
            <div class="notif-stat">
                <div class="notif-stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-bell"></i>
                </div>

                <h3>{{ $notifikasis->total() }}</h3>
                <p>Total Notifikasi</p>
            </div>
        </div>

        {{-- BELUM DIBACA --}}
        <div class="col-6 col-lg-4">
            <div class="notif-stat">
                <div class="notif-stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-envelope"></i>
                </div>

                <h3>{{ $jumlahBelumDibaca }}</h3>
                <p>Belum Dibaca</p>
            </div>
        </div>

        {{-- SUDAH DIBACA --}}
        <div class="col-12 col-lg-4">
            <div class="notif-stat">
                <div class="notif-stat-icon bg-success-subtle text-success">
                    <i class="bi bi-envelope-check"></i>
                </div>

                <h3>{{ max(0, $notifikasis->total() - $jumlahBelumDibaca) }}</h3>
                <p>Sudah Dibaca</p>
            </div>
        </div>

    </div>

    {{-- DAFTAR NOTIFIKASI --}}
    <div class="notif-card">

        {{-- HEADER --}}
        <div class="notif-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

            <div>
                <h5>
                    <i class="bi bi-list-ul text-primary me-2"></i>
                    Notifikasi Saya
                </h5>

                <small class="text-muted">
                    Daftar pemberitahuan aktivitas terbaru.
                </small>
            </div>

            {{-- TANDAI SEMUA --}}
            @if($jumlahBelumDibaca > 0)
                <form action="{{ route('notifikasi.baca-semua') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-primary btn-sm rounded-3">
                        <i class="bi bi-check2-all me-1"></i>
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif

        </div>

        <div class="card-body p-3 p-md-4">

            @forelse($notifikasis as $notifikasi)

                {{-- ITEM NOTIFIKASI --}}
                <div class="notif-item {{ $notifikasi->dibaca ? 'read' : 'unread' }}">

                    {{-- ICON --}}
                    <div class="notif-icon {{ $notifikasi->dibaca ? 'bg-secondary-subtle text-secondary' : 'bg-primary-subtle text-primary' }}">
                        <i class="bi {{ $notifikasi->dibaca ? 'bi-envelope-open' : 'bi-bell-fill' }}"></i>
                    </div>

                    {{-- CONTENT --}}
                    <div class="notif-content">

                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">

                            <div class="notif-title">
                                {{ $notifikasi->judul }}
                            </div>

                            @if(!$notifikasi->dibaca)
                                <span class="notif-badge notif-badge-new">
                                    <i class="bi bi-circle-fill"></i>
                                    Baru
                                </span>
                            @else
                                <span class="notif-badge notif-badge-read">
                                    <i class="bi bi-check-circle"></i>
                                    Sudah Dibaca
                                </span>
                            @endif

                        </div>

                        {{-- PESAN --}}
                        <div class="notif-message">
                            {{ $notifikasi->pesan }}
                        </div>

                        {{-- WAKTU --}}
                        <div class="notif-time">
                            <i class="bi bi-clock"></i>

                            {{ $notifikasi->created_at ? $notifikasi->created_at->format('d/m/Y H:i') : '-' }}
                        </div>

                        {{-- ACTION --}}
                        @if(!$notifikasi->dibaca)
                            <form action="{{ route('notifikasi.baca', $notifikasi->id) }}"
                                  method="POST"
                                  class="mt-3">
                                @csrf

                                <button type="submit" class="btn btn-outline-primary notif-read-btn">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Tandai Dibaca
                                </button>
                            </form>
                        @endif

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}
                <div class="notif-empty">

                    <div class="notif-empty-icon">
                        <i class="bi bi-bell-slash"></i>
                    </div>

                    <h5 class="fw-bold text-secondary">
                        Belum Ada Notifikasi
                    </h5>

                    <p class="text-muted mb-0">
                        Notifikasi transaksi dan aktivitas sistem akan muncul di sini.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
        @if($notifikasis->hasPages())
            <div class="notif-pagination">
                {{ $notifikasis->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
