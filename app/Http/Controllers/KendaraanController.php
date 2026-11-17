<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $kendaraans = Kendaraan::query()
            ->when($request->search, function ($query, $search) {
                $query->where('plat_nomor', 'like', "%{$search}%")
                    ->orWhere('pemilik', 'like', "%{$search}%");
            })
            ->withCount('parkirs')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:20|unique:kendaraans,plat_nomor',
            'jenis' => 'required|in:motor,mobil',
            'pemilik' => 'nullable|string|max:255',
        ]);

        Kendaraan::create([
            'plat_nomor' => strtoupper(trim($request->plat_nomor)),
            'jenis' => $request->jenis,
            'pemilik' => $request->pemilik,
        ]);

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Kendaraan $kendaraan)
    {
        $kendaraan->load('parkirs');

        return view('admin.kendaraan.show', compact('kendaraan'));
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:20|unique:kendaraans,plat_nomor,' . $kendaraan->id,
            'jenis' => 'required|in:motor,mobil',
            'pemilik' => 'nullable|string|max:255',
        ]);

        $kendaraan->update([
            'plat_nomor' => strtoupper(trim($request->plat_nomor)),
            'jenis' => $request->jenis,
            'pemilik' => $request->pemilik,
        ]);

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        if ($kendaraan->parkirs()->exists()) {
            return back()->with('error', 'Kendaraan memiliki riwayat parkir dan tidak dapat dihapus.');
        }

        $kendaraan->delete();

        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}
