<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AreaParkirController extends Controller
{
    public function index()
    {
        $areas = AreaParkir::latest()->paginate(10);

        $totalArea = AreaParkir::count();

        $totalMotor = AreaParkir::where('jenis_kendaraan', 'motor')->sum('kapasitas');

        $totalMobil = AreaParkir::where('jenis_kendaraan', 'mobil')->sum('kapasitas');

        $areaAktif = AreaParkir::where('status', 'aktif')->count();

        return view('admin.area_parkir.index', compact(
            'areas',
            'totalArea',
            'totalMotor',
            'totalMobil',
            'areaAktif'
        ));
    }

    public function create()
    {
        return view('admin.area_parkir.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_area' => ['required', 'string', 'max:100'],
            'jenis_kendaraan' => ['required', Rule::in(['motor', 'mobil'])],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'keterangan' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        AreaParkir::create($validated);

        return redirect()
            ->route('admin.area-parkir.index')
            ->with('success', 'Area parkir berhasil ditambahkan.');
    }

    public function edit(AreaParkir $areaParkir)
    {
        return view('admin.area_parkir.edit', compact('areaParkir'));
    }

    public function update(Request $request, AreaParkir $areaParkir)
    {
        $validated = $request->validate([
            'nama_area' => ['required', 'string', 'max:100'],
            'jenis_kendaraan' => ['required', Rule::in(['motor', 'mobil'])],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'keterangan' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        $areaParkir->update($validated);

        return redirect()
            ->route('admin.area-parkir.index')
            ->with('success', 'Area parkir berhasil diperbarui.');
    }

    public function destroy(AreaParkir $areaParkir)
    {
        $areaParkir->delete();

        return redirect()
            ->route('admin.area-parkir.index')
            ->with('success', 'Area parkir berhasil dihapus.');
    }
}
