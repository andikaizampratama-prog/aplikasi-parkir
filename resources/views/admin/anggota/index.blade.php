
@extends('layouts.role')

@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data Anggota</h4>
            <p class="text-muted mb-0">Kelola semua akun pengguna ParkirKu.</p>
        </div>

        <a href="{{ route('admin.anggota.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Tambah Anggota
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.anggota.index') }}" method="GET"
                  class="row g-2 mb-4">

                <div class="col-md-5">
                    <input type="text"
                           name="q"
                           class="form-control"
                           placeholder="Cari nama atau email..."
                           value="{{ request('q') }}">
                </div>

                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="{{ route('admin.anggota.index') }}"
                       class="btn btn-secondary">Reset</a>
                </div>

            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($anggotas as $anggota)
                            <tr>
                                <td>{{ $anggotas->firstItem() + $loop->index }}</td>

                                <td class="fw-semibold">
                                    {{ $anggota->name }}

                                    @if ($anggota->id === auth()->id())
                                        <span class="badge bg-info text-dark">Anda</span>
                                    @endif
                                </td>

                                <td>{{ $anggota->email }}</td>

                                <td>
                                    @if ($anggota->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @elseif ($anggota->role === 'petugas')
                                        <span class="badge bg-primary">Petugas</span>
                                    @else
                                        <span class="badge bg-success">Owner</span>
                                    @endif
                                </td>

                                <td>{{ $anggota->created_at?->format('d-m-Y') }}</td>

                                <td>
                                    <div class="d-flex gap-1">

                                        <a href="{{ route('admin.anggota.show', ['anggota' => $anggota->id]) }}"
                                           class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.anggota.edit', ['anggota' => $anggota->id]) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        @if ($anggota->id !== auth()->id())
                                            <form action="{{ route('admin.anggota.destroy', ['anggota' => $anggota->id]) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-people fs-2 d-block mb-2"></i>
                                    Data anggota belum tersedia.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $anggotas->links() }}
            </div>

        </div>
    </div>

</div>

@endsection
