<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        $jumlahBelumDibaca = Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->count();

        return view('notifikasi.index', compact(
            'notifikasis',
            'jumlahBelumDibaca'
        ));
    }

    public function baca(Notifikasi $notifikasi)
    {
        if ($notifikasi->user_id !== auth()->id()) {
            abort(403);
        }

        $notifikasi->update([
            'dibaca' => true,
            'dibaca_at' => now(),
        ]);

        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function bacaSemua()
    {
        Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->update([
                'dibaca' => true,
                'dibaca_at' => now(),
            ]);

        return back()->with('success', 'Semua notifikasi sudah dibaca.');
    }
}
