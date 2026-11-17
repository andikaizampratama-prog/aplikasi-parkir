
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kendaraan - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .hero {
            background: linear-gradient(135deg, #1d4ed8, #06b6d4);
            color: white;
            padding: 25px;
            border-radius: 18px;
        }

        .card {
            border: 0;
            border-radius: 18px;
        }

        .table th,
        .table td {
            padding: 15px;
            vertical-align: middle;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <div class="hero mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3><i class="bi bi-truck"></i> Data Kendaraan</h3>
            <p class="mb-0">Kelola data kendaraan terdaftar</p>
        </div>

        <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-light">
            <i class="bi bi-plus-circle"></i> Tambah Kendaraan
        </a>
    </div>

    <a href="{{ route('admin.dashboard') }}"
       class="text-decoration-none d-inline-block mb-3">
        <i class="bi bi-arrow-left"></i> Dashboard
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm p-4">

        <form method="GET" class="row g-2 mb-4">

            <div class="col-md-9">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari plat nomor atau pemilik..."
                    value="{{ request('search') }}"
                >
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                        <th>Jenis</th>
                        <th>Pemilik</th>
                        <th>Jumlah Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($kendaraans as $kendaraan)

                    <tr>
                        <td>
                            {{ $kendaraans->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <strong>{{ $kendaraan->plat_nomor }}</strong>
                        </td>

                        <td>
                            <span class="badge {{ $kendaraan->jenis == 'motor' ? 'bg-primary' : 'bg-success' }}">
                                {{ ucfirst($kendaraan->jenis) }}
                            </span>
                        </td>

                        <td>
                            {{ $kendaraan->pemilik ?? '-' }}
                        </td>

                        <td>
                            {{ $kendaraan->parkirs_count }}
                        </td>

                        <td>
                            <div class="d-flex gap-1">

                                {{-- DETAIL --}}
                                <a href="{{ route('admin.kendaraan.show', $kendaraan->id) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('admin.kendaraan.edit', $kendaraan->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                {{-- HAPUS --}}
                                <form action="{{ route('admin.kendaraan.destroy', $kendaraan->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center py-4">
                            Belum ada kendaraan.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{ $kendaraans->links('pagination::bootstrap-5') }}

    </div>

</div>

</body>
</html>
