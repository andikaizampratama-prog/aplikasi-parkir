<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktivitas::with('user')->latest();

        // Filter jenis aktivitas
        if ($request->filled('aktivitas')) {
            $query->where('aktivitas', $request->aktivitas);
        }

        // Pencarian
        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('aktivitas', 'like', "%{$cari}%")
                    ->orWhere('deskripsi', 'like', "%{$cari}%")
                    ->orWhereHas('user', function ($userQuery) use ($cari) {
                        $userQuery->where('name', 'like', "%{$cari}%");
                    });
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        $daftarAktivitas = LogAktivitas::select('aktivitas')
            ->distinct()
            ->orderBy('aktivitas')
            ->pluck('aktivitas');

        $totalLog = LogAktivitas::count();

        return view('admin.log_aktivitas.index', compact(
            'logs',
            'daftarAktivitas',
            'totalLog'
        ));
    }
}
