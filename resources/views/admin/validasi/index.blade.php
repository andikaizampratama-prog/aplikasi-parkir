
@extends('layouts.role')

@section('title', 'Validasi Transaksi')
@section('page-title', 'Validasi Transaksi')

@section('content')

<style>
    .validasi-page {
        padding-bottom: 20px;
    }

    .validasi-hero {
        background: linear-gradient(135deg, #1e40af, #2563eb, #60a5fa);
        border-radius: 20px;
        padding: 28px;
        color: white;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .validasi-hero h3 {
        font-weight: 800;
        margin-bottom: 8px;
    }

    .validasi-hero p {
        margin-bottom: 0;
        opacity: .9;
    }

    .validasi-hero-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        background: rgba(255,255,255,.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

    .validasi-stat {
        border: none;
        border-radius: 17px;
        padding: 20px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15,23,42,.05);
        height: 100%;
        transition: .2s;
    }

    .validasi-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(15,23,42,.08);
    }

    .validasi-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .validasi-stat h3 {
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 5px;
        color: #1e293b;
    }

    .validasi-stat p {
        color: #64748b;
        margin: 0;
        font-size: 13px;
    }

    .validasi-card {
        background: #fff;
        border-radius: 18px;
        border: none;
        box-shadow: 0 4px 20px rgba(15,23,42,.05);
        overflow: hidden;
    }

    .validasi-card-header {
        padding: 22px;
        border-bottom: 1px solid #edf0f5;
    }

    .validasi-card-header h5 {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .validasi-table {
        margin-bottom: 0;
    }

    .validasi-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 15px;
        white-space: nowrap;
        border-bottom: 1px solid #e9eef5;
    }

    .validasi-table tbody td {
        padding: 16px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .validasi-table tbody tr:hover {
        background: #f8fbff;
    }

    .validasi-kode {
        font-weight: 700;
        color: #2563eb;
        font-size: 13px;
    }

    .validasi-tiket {
        font-weight: 600;
        color: #475569;
        font-size: 13px;
    }

    .validasi-total {
        font-weight: 800;
        color: #1e293b;
        white-space: nowrap;
    }

    .validasi-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 30px;
        padding: 7px 11px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fff7df;
        color: #a16207;
    }

    .status-disetujui {
        background: #dcfce7;
        color: #15803d;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #b91c1c;
    }

    .validasi-validator {
        color: #475569;
        font-size: 13px;
        font-weight: 600;
    }

    .validasi-action {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .validasi-action .btn {
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        padding: 7px 11px;
    }

    .validasi-empty {
        padding: 55px 20px !important;
        text-align: center;
        color: #94a3b8;
    }

    .validasi-empty i {
        font-size: 45px;
        display: block;
        margin-bottom: 12px;
    }

    .validasi-pagination {
        padding: 18px;
        border-top: 1px solid #edf0f5;
    }

    .validasi-modal .modal-content {
        border: none;
        border-radius: 18px;
        overflow: hidden;
    }

    .validasi-modal .modal-header {
        background: #fff1f2;
        padding: 20px;
    }

    .validasi-modal .modal-title {
        font-weight: 800;
        color: #991b1b;
    }

    .validasi-modal .modal-body {
        padding: 22px;
    }

    .validasi-modal textarea {
        min-height: 120px;
        border-radius: 12px;
    }

    @media(max-width: 768px) {
        .validasi-hero {
            padding: 22px;
        }

        .validasi-hero-icon {
            width: 52px;
            height: 52px;
            font-size: 24px;
        }

        .validasi-table thead th,
        .validasi-table tbody td {
            padding: 12px;
        }
    }
</style>

<div class="validasi-page">

    {{-- HEADER --}}
    <div class="validasi-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h3>
                    <i class="bi bi-shield-check me-2"></i>
                    Validasi Transaksi
                </h3>
                <p>
                    Kelola pemeriksaan dan persetujuan transaksi parkir dengan mudah.
                </p>
            </div>

            <div class="validasi-hero-icon">
                <i class="bi bi-clipboard-check"></i>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-lg-3">
            <div class="validasi-stat">
                <div class="validasi-stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-collection"></i>
                </div>
                <h3>{{ $validasis->count() }}</h3>
                <p>Data pada halaman ini</p>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="validasi-stat">
                <div class="validasi-stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <h3>{{ $validasis->where('status', 'menunggu')->count() }}</h3>
                <p>Menunggu Validasi</p>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="validasi-stat">
                <div class="validasi-stat-icon bg-success-subtle text-success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <h3>{{ $validasis->where('status', 'disetujui')->count() }}</h3>
                <p>Transaksi Disetujui</p>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="validasi-stat">
                <div class="validasi-stat-icon bg-danger-subtle text-danger">
                    <i class="bi bi-x-circle"></i>
                </div>
                <h3>{{ $validasis->where('status', 'ditolak')->count() }}</h3>
                <p>Transaksi Ditolak</p>
            </div>
        </div>

    </div>

    {{-- TABEL VALIDASI --}}
    <div class="validasi-card">

        <div class="validasi-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5>
                    <i class="bi bi-list-check text-primary me-2"></i>
                    Daftar Validasi Transaksi
                </h5>
                <small class="text-muted">
                    Periksa transaksi dan lakukan tindakan validasi.
                </small>
            </div>

            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                {{ $validasis->total() }} Total Data
            </span>
        </div>

        <div class="table-responsive">
            <table class="table validasi-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Kode Tiket</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                        <th>Validator</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($validasis as $validasi)
                    <tr>

                        {{-- NOMOR --}}
                        <td class="text-muted fw-semibold">
                            {{ $validasis->firstItem() + $loop->index }}
                        </td>

                        {{-- KODE TRANSAKSI --}}
                        <td>
                            <div class="validasi-kode">
                                <i class="bi bi-receipt me-1"></i>
                                {{ $validasi->transaksi->kode_transaksi ?? '-' }}
                            </div>
                        </td>

                        {{-- KODE TIKET --}}
                        <td>
                            <div class="validasi-tiket">
                                <i class="bi bi-ticket-perforated me-1 text-secondary"></i>
                                {{ $validasi->transaksi->parkir->kode_tiket ?? '-' }}
                            </div>
                        </td>

                        {{-- TOTAL --}}
                        <td>
                            <div class="validasi-total">
                                Rp {{ number_format($validasi->transaksi->total_biaya ?? 0, 0, ',', '.') }}
                            </div>
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($validasi->status == 'menunggu')
                                <span class="validasi-status status-menunggu">
                                    <i class="bi bi-clock"></i>
                                    Menunggu
                                </span>
                            @elseif($validasi->status == 'disetujui')
                                <span class="validasi-status status-disetujui">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Disetujui
                                </span>
                            @else
                                <span class="validasi-status status-ditolak">
                                    <i class="bi bi-x-circle-fill"></i>
                                    Ditolak
                                </span>
                            @endif
                        </td>

                        {{-- VALIDATOR --}}
                        <td>
                            <div class="validasi-validator">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ $validasi->validator->name ?? '-' }}
                            </div>
                        </td>

                        {{-- AKSI --}}
                        <td>
                            @if($validasi->status == 'menunggu')

                                <div class="validasi-action">

                                    {{-- SETUJUI --}}
                                    <form action="{{ route('admin.validasi.setujui', $validasi->id) }}"
                                          method="POST">
                                        @csrf

                                        <button type="submit"
                                                class="btn btn-success btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui transaksi ini?')">
                                            <i class="bi bi-check-lg me-1"></i>
                                            Setujui
                                        </button>
                                    </form>

                                    {{-- TOLAK --}}
                                    <button type="button"
                                            class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#tolak{{ $validasi->id }}">
                                        <i class="bi bi-x-lg me-1"></i>
                                        Tolak
                                    </button>

                                </div>

                                {{-- MODAL PENOLAKAN --}}
                                <div class="modal fade validasi-modal"
                                     id="tolak{{ $validasi->id }}"
                                     tabindex="-1"
                                     aria-labelledby="judulTolak{{ $validasi->id }}"
                                     aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <form method="POST"
                                                  action="{{ route('admin.validasi.tolak', $validasi->id) }}">
                                                @csrf

                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="judulTolak{{ $validasi->id }}">
                                                        <i class="bi bi-exclamation-circle me-2"></i>
                                                        Tolak Validasi
                                                    </h5>

                                                    <button type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Tutup">
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">
                                                            Kode Transaksi
                                                        </label>
                                                        <input type="text"
                                                               class="form-control"
                                                               value="{{ $validasi->transaksi->kode_transaksi ?? '-' }}"
                                                               readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">
                                                            Catatan Penolakan
                                                        </label>

                                                        <textarea name="catatan"
                                                                  class="form-control"
                                                                  rows="4"
                                                                  placeholder="Tuliskan alasan penolakan transaksi..."
                                                                  required></textarea>

                                                        <small class="text-muted">
                                                            Berikan alasan penolakan yang jelas.
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button"
                                                            class="btn btn-light"
                                                            data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <button type="submit"
                                                            class="btn btn-danger">
                                                        <i class="bi bi-x-circle me-1"></i>
                                                        Konfirmasi Tolak
                                                    </button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>

                            @else
                                <span class="text-muted small fw-semibold">
                                    <i class="bi bi-check2-all me-1"></i>
                                    Sudah diproses
                                </span>
                            @endif
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="validasi-empty">
                            <i class="bi bi-inbox"></i>
                            <h6 class="fw-bold text-secondary">Belum Ada Data Validasi</h6>
                            <p class="mb-0 small">
                                Data validasi transaksi akan muncul di sini.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($validasis->hasPages())
            <div class="validasi-pagination">
                {{ $validasis->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
