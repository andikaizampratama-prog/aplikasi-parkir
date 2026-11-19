
<div class="mb-3">
    <label class="form-label fw-semibold">Nama Area Parkir</label>
    <input type="text"
           name="nama_area"
           class="form-control"
           value="{{ old('nama_area', $areaParkir->nama_area ?? '') }}"
           placeholder="Contoh: Area Parkir A"
           required>
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Jenis Kendaraan</label>
    <select name="jenis_kendaraan" class="form-select" required>
        <option value="">-- Pilih Kendaraan --</option>
        <option value="motor"
            {{ old('jenis_kendaraan', $areaParkir->jenis_kendaraan ?? '') == 'motor' ? 'selected' : '' }}>
            Motor
        </option>
        <option value="mobil"
            {{ old('jenis_kendaraan', $areaParkir->jenis_kendaraan ?? '') == 'mobil' ? 'selected' : '' }}>
            Mobil
        </option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Kapasitas Kendaraan</label>
    <input type="number"
           name="kapasitas"
           class="form-control"
           value="{{ old('kapasitas', $areaParkir->kapasitas ?? '') }}"
           min="1"
           placeholder="Masukkan kapasitas"
           required>
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Keterangan</label>
    <textarea name="keterangan"
              class="form-control"
              rows="3"
              placeholder="Keterangan area parkir">{{ old('keterangan', $areaParkir->keterangan ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Status Area</label>
    <select name="status" class="form-select" required>
        <option value="aktif"
            {{ old('status', $areaParkir->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>
            Aktif
        </option>
        <option value="nonaktif"
            {{ old('status', $areaParkir->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
            Nonaktif
        </option>
    </select>
</div>
