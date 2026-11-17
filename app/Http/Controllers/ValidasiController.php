<?php

namespace App\Http\Controllers;

use App\Models\Validasi;
use App\Models\Notifikasi;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidasiController extends Controller
{
    public function index()
    {
        $validasis = Validasi::with([
            'transaksi.parkir.kendaraan',
            'validator'
        ])->latest()->paginate(10);

        return view('admin.validasi.index', compact('validasis'));
    }

    public function setujui(Validasi $validasi)
    {
        if ($validasi->status !== 'menunggu') {
            return back()->with('error', 'Validasi sudah diproses.');
        }

        DB::transaction(function () use ($validasi) {
            $validasi->update([
                'status' => 'disetujui',
                'validator_id' => auth()->id(),
                'tanggal_validasi' => now(),
            ]);

            $transaksi = $validasi->transaksi;

            if ($transaksi) {
                $transaksi->update([
                    'status_pembayaran' => 'lunas',
                    'tanggal_transaksi' => now(),
                ]);

                $parkir = $transaksi->parkir;

                if ($parkir) {
                    $pesan = 'Transaksi parkir ' .
                        $parkir->kode_tiket .
                        ' telah disetujui admin.';
                } else {
                    $pesan = 'Transaksi pembayaran telah disetujui admin.';
                }
            } else {
                $pesan = 'Validasi telah disetujui admin.';
            }

            User::where('role', 'petugas')->get()->each(function ($user) use ($pesan) {
                Notifikasi::create([
                    'user_id' => $user->id,
                    'judul' => 'Validasi Disetujui',
                    'pesan' => $pesan,
                    'tipe' => 'success',
                ]);
            });
        });

        return back()->with('success', 'Validasi berhasil disetujui.');
    }

    public function tolak(Request $request, Validasi $validasi)
    {
        $request->validate([
            'catatan' => 'required|string|max:1000',
        ]);

        if ($validasi->status !== 'menunggu') {
            return back()->with('error', 'Validasi sudah diproses.');
        }

        DB::transaction(function () use ($request, $validasi) {
            $validasi->update([
                'status' => 'ditolak',
                'validator_id' => auth()->id(),
                'catatan' => $request->catatan,
                'tanggal_validasi' => now(),
            ]);

            User::where('role', 'petugas')->get()->each(function ($user) use ($request) {
                Notifikasi::create([
                    'user_id' => $user->id,
                    'judul' => 'Validasi Ditolak',
                    'pesan' => 'Validasi transaksi ditolak. Catatan: ' .
                        $request->catatan,
                    'tipe' => 'danger',
                ]);
            });
        });

        return back()->with('success', 'Validasi berhasil ditolak.');
    }
}
