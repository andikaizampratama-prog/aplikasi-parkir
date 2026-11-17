
@extends('layouts.role')

@section('title', 'Notifikasi')
@section('page-title', 'Notifikasi')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Notifikasi Saya</h5>
            <small class="text-muted">
                {{ $jumlahBelumDibaca }} notifikasi belum dibaca
            </small>
        </div>

        @if($jumlahBelumDibaca > 0)
            <form action="{{ route('notifikasi.baca-semua') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="bi bi-check2-all"></i>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    <div class="card-body">

        @forelse($notifikasis as $notifikasi)

            <div class="border rounded p-3 mb-3
                {{ $notifikasi->dibaca ? 'bg-white' : 'bg-light' }}">

                <div class="d-flex justify-content-between align-items-center">

                    <strong>
                        {{ $notifikasi->judul }}
                    </strong>

                    @if(!$notifikasi->dibaca)
                        <span class="badge bg-primary">
                            Baru
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            Sudah Dibaca
                        </span>
                    @endif

                </div>

                <p class="mb-2 mt-2">
                    {{ $notifikasi->pesan }}
                </p>

                <small class="text-muted">
                    <i class="bi bi-clock"></i>
                    {{ $notifikasi->created_at->format('d/m/Y H:i') }}
                </small>

                @if(!$notifikasi->dibaca)

                    <form
                        action="{{ route('notifikasi.baca', $notifikasi->id) }}"
                        method="POST"
                        class="mt-3">

                        @csrf

                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-check-circle"></i>
                            Tandai Dibaca
                        </button>

                    </form>

                @endif

            </div>

        @empty

            <div class="text-center py-5">

                <i class="bi bi-bell-slash fs-1 text-muted"></i>

                <h5 class="mt-3">
                    Belum Ada Notifikasi
                </h5>

                <p class="text-muted">
                    Notifikasi transaksi akan muncul di halaman ini.
                </p>

            </div>

        @endforelse

        <div class="mt-3">
            {{ $notifikasis->links() }}
        </div>

    </div>

</div>

@endsection
