<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Parkir;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalKendaraan = Kendaraan::count();

        $parkirAktif = Parkir::where('status', 'masuk')->count();

        $totalTransaksi = Parkir::where('status', 'keluar')->count();

        $pendapatanHariIni = Parkir::where('status', 'keluar')
            ->whereDate('waktu_keluar', Carbon::today())
            ->sum('biaya');

        // Parkir terbaru
        $parkirTerbaru = Parkir::with('kendaraan')
            ->latest()
            ->take(5)
            ->get();

        // Grafik pendapatan 7 hari
        $labels = [];
        $pendapatanGrafik = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);

            $labels[] = $tanggal->format('d/m');

            $pendapatan = Parkir::where('status', 'keluar')
                ->whereDate('waktu_keluar', $tanggal->toDateString())
                ->sum('biaya');

            $pendapatanGrafik[] = (float) $pendapatan;
        }

        // Kapasitas parkir
        $kapasitas = 50;

        $slotKosong = max(
            0,
            $kapasitas - $parkirAktif
        );

        // Dashboard berdasarkan role
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return view('admin.dashboard', compact(
                'totalKendaraan',
                'parkirAktif',
                'totalTransaksi',
                'pendapatanHariIni',
                'parkirTerbaru',
                'labels',
                'pendapatanGrafik',
                'kapasitas',
                'slotKosong'
            ));
        }

        if ($role === 'petugas') {
            return view('petugas.dashboard', compact(
                'totalKendaraan',
                'parkirAktif',
                'totalTransaksi',
                'parkirTerbaru'
            ));
        }

        if ($role === 'owner') {
            return view('owner.dashboard', compact(
                'totalKendaraan',
                'parkirAktif',
                'totalTransaksi',
                'pendapatanHariIni',
                'labels',
                'pendapatanGrafik',
                'kapasitas',
                'slotKosong'
            ));
        }

        abort(403, 'Anda tidak memiliki akses ke dashboard ini.');
    }
}
