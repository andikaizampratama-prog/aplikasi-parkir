<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
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

    public function update(Request $request)
    {
        $request->validate([
            'motor' => 'required|numeric|min:0',
            'mobil' => 'required|numeric|min:0',
        ]);

        Tarif::updateOrCreate(
            ['jenis' => 'motor'],
            ['tarif_per_jam' => $request->motor]
        );

        Tarif::updateOrCreate(
            ['jenis' => 'mobil'],
            ['tarif_per_jam' => $request->mobil]
        );

        return redirect()->route('tarif.index')
            ->with('success', 'Tarif parkir berhasil diperbarui.');
    }
}
