<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // LAPORAN PARKIR ADMIN
    public function index(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai
            ?? Carbon::now()->startOfMonth()->format('Y-m-d');

        $tanggalSelesai = $request->tanggal_selesai
            ?? Carbon::today()->format('Y-m-d');

        $query = Parkir::with('kendaraan')
            ->where('status', 'keluar')
            ->whereDate('waktu_keluar', '>=', $tanggalMulai)
            ->whereDate('waktu_keluar', '<=', $tanggalSelesai);

        $parkirs = $query
            ->orderBy('waktu_keluar', 'desc')
            ->get();

        return view('laporan.index', compact(
            'parkirs',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }

    // REKAP TRANSAKSI KHUSUS OWNER
    public function rekapTransaksi(Request $request)
    {
        $defaultMulai = Carbon::now()
            ->startOfMonth()
            ->format('Y-m-d\TH:i');

        $defaultSelesai = Carbon::now()
            ->format('Y-m-d\TH:i');

        $data = $request->validate([
            'tanggal_mulai' => [
                'nullable',
                'date_format:Y-m-d\TH:i',
            ],
            'tanggal_selesai' => [
                'nullable',
                'date_format:Y-m-d\TH:i',
                'after_or_equal:tanggal_mulai',
            ],
        ]);

        $tanggalMulai = $data['tanggal_mulai'] ?? $defaultMulai;
        $tanggalSelesai = $data['tanggal_selesai'] ?? $defaultSelesai;

        $waktuMulai = Carbon::parse($tanggalMulai)->startOfMinute();
        $waktuSelesai = Carbon::parse($tanggalSelesai)->endOfMinute();

        // Hanya transaksi yang sudah lunas
        // Jika tanggal_transaksi kosong, gunakan created_at
        $query = Transaksi::with([
                'parkir.kendaraan',
                'parkir.petugas'
            ])
            ->where('status_pembayaran', 'lunas')
            ->whereRaw(
                'COALESCE(tanggal_transaksi, created_at) BETWEEN ? AND ?',
                [$waktuMulai, $waktuSelesai]
            );

        // Total transaksi pada periode
        $totalTransaksi = (clone $query)->count();

        // Total pendapatan pada periode
        $totalPendapatan = (clone $query)->sum('total_biaya');

        // Rincian transaksi
        $transaksis = $query
            ->orderByRaw('COALESCE(tanggal_transaksi, created_at) DESC')
            ->paginate(15)
            ->withQueryString();

        return view('owner.rekap_transaksi.index', compact(
            'transaksis',
            'tanggalMulai',
            'tanggalSelesai',
            'totalTransaksi',
            'totalPendapatan'
        ));
    }
}
