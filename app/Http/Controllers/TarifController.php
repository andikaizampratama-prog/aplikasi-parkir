<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    // Menampilkan halaman pengaturan tarif
    public function index()
    {
        $motor = Tarif::firstOrCreate(
            ['jenis' => 'motor'],
            ['tarif_per_jam' => 2000]
        );

        $mobil = Tarif::firstOrCreate(
            ['jenis' => 'mobil'],
            ['tarif_per_jam' => 5000]
        );

        return view('tarif.index', compact('motor', 'mobil'));
    }

    // Memperbarui satu tarif berdasarkan ID
    public function update(Request $request, Tarif $tarif)
    {
        $data = $request->validate([
            'tarif_per_jam' => 'required|numeric|min:0',
        ], [
            'tarif_per_jam.required' => 'Tarif wajib diisi.',
            'tarif_per_jam.numeric' => 'Tarif harus berupa angka.',
            'tarif_per_jam.min' => 'Tarif tidak boleh kurang dari 0.',
        ]);

        // Hanya memperbarui tarif yang dipilih
        $tarif->tarif_per_jam = $data['tarif_per_jam'];
        $tarif->save();

        return redirect()
            ->route('admin.tarif.index')
            ->with('success', 'Tarif ' . ucfirst($tarif->jenis) . ' berhasil diperbarui.');
    }
}
