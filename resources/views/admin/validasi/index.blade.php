
@extends('layouts.role')

@section('title', 'Validasi Transaksi')
@section('page-title', 'Validasi Transaksi')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0">Daftar Validasi Transaksi</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Kode Tiket</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Validator</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($validasis as $validasi)
                    <tr>
                        <td>{{ $validasis->firstItem() + $loop->index }}</td>

                        <td>
                            {{ $validasi->transaksi->kode_transaksi ?? '-' }}
                        </td>

                        <td>
                            {{ $validasi->transaksi->parkir->kode_tiket ?? '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($validasi->transaksi->total_biaya ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($validasi->status == 'menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($validasi->status == 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>

                        <td>
                            {{ $validasi->validator->name ?? '-' }}
                        </td>

                        <td>
                            @if($validasi->status == 'menunggu')
                                <form action="{{ route('admin.validasi.setujui', $validasi->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm"
                                            onclick="return confirm('Setujui transaksi ini?')">
                                        Setujui
                                    </button>
                                </form>

                                <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#tolak{{ $validasi->id }}">
                                    Tolak
                                </button>

                                <div class="modal fade" id="tolak{{ $validasi->id }}">
                                    <div class="modal-dialog">
                                        <form method="POST"
                                              action="{{ route('admin.validasi.tolak', $validasi->id) }}"
                                              class="modal-content">
                                            @csrf

                                            <div class="modal-header">
                                                <h5 class="modal-title">Tolak Validasi</h5>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <label class="form-label">Catatan penolakan</label>
                                                <textarea name="catatan"
                                                          class="form-control"
                                                          required></textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-danger">
                                                    Konfirmasi Tolak
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted">Sudah diproses</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            Belum ada data validasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $validasis->links() }}
    </div>
</div>
@endsection
