<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        // Statistik aktivitas
        $totalLog = LogAktivitas::count();

        $logHariIni = LogAktivitas::whereDate(
            'created_at',
            today()
        )->count();

        // Daftar jenis aktivitas unik untuk pilihan filter
        $daftarAktivitas = LogAktivitas::query()
            ->whereNotNull('aktivitas')
            ->select('aktivitas')
            ->distinct()
            ->orderBy('aktivitas')
            ->pluck('aktivitas');

        // Query utama
        $query = LogAktivitas::with('user')->latest();

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('aktivitas', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filter jenis aktivitas
        if ($request->filled('aktivitas')) {
            $query->where('aktivitas', $request->aktivitas);
        }

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Pagination
        $logs = $query->paginate(10)->withQueryString();

        return view('admin.log_aktivitas.index', compact(
            'logs',
            'totalLog',
            'logHariIni',
            'daftarAktivitas'
        ));
    }

    public function destroy($id)
    {
        $log = LogAktivitas::findOrFail($id);

        $log->delete();

        return redirect()
            ->route('admin.log-aktivitas.index')
            ->with('success', 'Log aktivitas berhasil dihapus.');
    }
}
