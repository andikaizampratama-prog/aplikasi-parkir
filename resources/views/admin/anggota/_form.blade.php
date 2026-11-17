
@php
    $isEdit = isset($anggota) && $anggota;
@endphp

<form action="{{ $isEdit
    ? route('admin.anggota.update', ['anggota' => $anggota->id])
    : route('admin.anggota.store') }}"
    method="POST">

    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label fw-semibold">Nama Lengkap</label>

        <input type="text"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $anggota->name ?? '') }}"
               placeholder="Masukkan nama lengkap"
               required>

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>

        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $anggota->email ?? '') }}"
               placeholder="contoh@email.com"
               required>

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>

        <input type="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}"
               {{ $isEdit ? '' : 'required' }}>

        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Konfirmasi Password</label>

        <input type="password"
               name="password_confirmation"
               class="form-control"
               placeholder="Ulangi password"
               {{ $isEdit ? '' : 'required' }}>
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Role / Hak Akses</label>

        <select name="role"
                class="form-select @error('role') is-invalid @enderror"
                required>

            <option value="">-- Pilih Role --</option>

            <option value="admin"
                {{ old('role', $anggota->role ?? '') === 'admin' ? 'selected' : '' }}>
                Admin
            </option>

            <option value="petugas"
                {{ old('role', $anggota->role ?? 'petugas') === 'petugas' ? 'selected' : '' }}>
                Petugas
            </option>

            <option value="owner"
                {{ old('role', $anggota->role ?? '') === 'owner' ? 'selected' : '' }}>
                Owner
            </option>

        </select>

        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if ($isEdit && $anggota->id === auth()->id())
            <small class="text-muted">
                Role akun yang sedang digunakan tidak dapat diubah.
            </small>
        @endif
    </div>

    <div class="d-flex gap-2">

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i>
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Anggota' }}
        </button>

        <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </div>

</form>
