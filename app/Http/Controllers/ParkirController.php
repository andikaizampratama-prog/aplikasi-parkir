<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\Kendaraan;
use App\Models\Tarif;
use App\Models\KapasitasParkir;
use App\Models\LogAktivitas;
use App\Models\Transaksi;
use App\Models\Validasi;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ParkirController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FUNGSI MENCATAT LOG AKTIVITAS
    |--------------------------------------------------------------------------
    */

    private function catatAktivitas($aktivitas, $deskripsi)
    {
        try {
            LogAktivitas::create([
                'user_id' => auth()->id(),
                'aktivitas' => $aktivitas,
                'deskripsi' => $deskripsi,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        } catch (\Throwable $e) {
            report($e);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DATA PARKIR DAN KAPASITAS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $parkirs = Parkir::with([
            'kendaraan',
            'petugas',
            'transaksi'
        ])
            ->latest()
            ->paginate(10);

        $kapasitas = KapasitasParkir::all()->map(function ($item) {

            $terisi = Parkir::where('status', 'masuk')
                ->whereHas('kendaraan', function ($query) use ($item) {
                    $query->where('jenis', $item->jenis);
                })
                ->count();

            $item->terisi = $terisi;
            $item->tersedia = max(
                0,
                $item->kapasitas - $terisi
            );

            return $item;
        });

        return view(
            'parkir.index',
            compact('parkirs', 'kapasitas')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORM KENDARAAN MASUK
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $kendaraans = Kendaraan::latest()->get();

        return view(
            'parkir.create',
            compact('kendaraans')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN KENDARAAN MASUK
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'plat_nomor' => 'required|string|max:20',
                'jenis_kendaraan' => 'required|in:motor,mobil',
                'nama_pemilik' => 'nullable|string|max:100',
            ],
            [
                'plat_nomor.required' => 'Plat nomor kendaraan wajib diisi.',
                'jenis_kendaraan.required' => 'Jenis kendaraan wajib dipilih.',
                'jenis_kendaraan.in' => 'Jenis kendaraan harus Motor atau Mobil.',
            ]
        );

        if ($validator->fails()) {

            $this->catatAktivitas(
                'parkir_masuk_gagal',
                'Validasi parkir masuk gagal: ' .
                implode(', ', $validator->errors()->all())
            );

            return back()
                ->withErrors($validator)
                ->withInput()
                ->with(
                    'error',
                    'Gagal memproses kendaraan masuk. Periksa kembali data kendaraan.'
                );
        }

        DB::beginTransaction();

        try {

            $jenis = $request->jenis_kendaraan;

            $kapasitas = DB::table('kapasitas_parkirs')
                ->where('jenis', $jenis)
                ->lockForUpdate()
                ->first();

            if (!$kapasitas) {

                DB::rollBack();

                $this->catatAktivitas(
                    'parkir_masuk_gagal',
                    'Kapasitas parkir ' . ucfirst($jenis) .
                    ' belum diatur.'
                );

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Kapasitas parkir ' . ucfirst($jenis) .
                        ' belum diatur.'
                    );
            }

            $terisi = Parkir::where('status', 'masuk')
                ->whereHas('kendaraan', function ($query) use ($jenis) {
                    $query->where('jenis', $jenis);
                })
                ->count();

            if ($terisi >= $kapasitas->kapasitas) {

                DB::rollBack();

                $this->catatAktivitas(
                    'parkir_masuk_gagal',
                    'Parkir masuk ditolak karena area ' .
                    ucfirst($jenis) . ' penuh.'
                );

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Area parkir ' . ucfirst($jenis) .
                        ' sudah penuh!'
                    );
            }

            $platNomor = strtoupper(
                str_replace(' ', '', $request->plat_nomor)
            );

            $kendaraan = Kendaraan::updateOrCreate(
                [
                    'plat_nomor' => $platNomor
                ],
                [
                    'jenis' => $jenis,
                    'pemilik' => $request->nama_pemilik,
                ]
            );

            $kodeTiket = 'PKR-' .
                strtoupper(Str::random(8));

            $parkir = Parkir::create([
                'kendaraan_id' => $kendaraan->id,
                'petugas_id' => auth()->id(),
                'kode_tiket' => $kodeTiket,
                'waktu_masuk' => now(),
                'status' => 'masuk',
            ]);

            DB::commit();

            $this->catatAktivitas(
                'parkir_masuk',
                'Kendaraan ' . $platNomor .
                ' berhasil masuk. Kode tiket: ' . $kodeTiket
            );

            return redirect()
                ->route(
                    auth()->user()->role . '.parkir.cetak',
                    $parkir->id_area
                )
                ->with(
                    'success',
                    'Kendaraan berhasil masuk dan tiket berhasil dibuat. Kode tiket: ' .
                    $kodeTiket
                );

        } catch (\Throwable $e) {

            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            $this->catatAktivitas(
                'parkir_masuk_gagal',
                'Gagal menyimpan kendaraan masuk. Kesalahan: ' .
                $e->getMessage()
            );

            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal menyimpan kendaraan masuk. Silakan periksa kembali.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PARKIR
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $parkir = Parkir::with([
            'kendaraan',
            'transaksi',
            'petugas',
        ])->findOrFail($id);

        return view(
            'parkir.show',
            compact('parkir')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | KENDARAAN KELUAR DAN TRANSAKSI OTOMATIS
    |--------------------------------------------------------------------------
    */

    public function keluar($id)
    {
        DB::beginTransaction();

        try {

            $parkir = Parkir::with('kendaraan')
                ->where('id_area', $id)
                ->lockForUpdate()
                ->first();

            if (!$parkir) {

                DB::rollBack();

                $this->catatAktivitas(
                    'parkir_keluar_gagal',
                    'Data parkir dengan ID ' . $id .
                    ' tidak ditemukan.'
                );

                return back()->with(
                    'error',
                    'Data parkir tidak ditemukan.'
                );
            }

            if ($parkir->status !== 'masuk') {

                DB::rollBack();

                return back()->with(
                    'error',
                    'Kendaraan ini sudah keluar dari area parkir.'
                );
            }

            if ($parkir->transaksi()->exists()) {

                DB::rollBack();

                return back()->with(
                    'error',
                    'Transaksi untuk parkir ini sudah tersedia.'
                );
            }

            $waktuMasuk = Carbon::parse(
                $parkir->waktu_masuk
            );

            $waktuKeluar = now();

            $durasi = max(
                1,
                (int) ceil(
                    $waktuMasuk->diffInMinutes($waktuKeluar) / 60
                )
            );

            $tarif = Tarif::where(
                'jenis',
                $parkir->kendaraan->jenis
            )->first();

            if (!$tarif) {

                DB::rollBack();

                $this->catatAktivitas(
                    'parkir_keluar_gagal',
                    'Tarif kendaraan belum tersedia. Kode tiket: ' .
                    $parkir->kode_tiket
                );

                return back()->with(
                    'error',
                    'Tarif kendaraan belum tersedia.'
                );
            }

            $biaya = $durasi * $tarif->tarif_per_jam;

            // Perbarui data parkir
            $parkir->update([
                'waktu_keluar' => $waktuKeluar,
                'biaya' => $biaya,
                'status' => 'keluar',
            ]);

            // Simpan transaksi dengan status belum bayar
            $transaksi = Transaksi::create([
                'parkir_id' => $parkir->id_area,
                'kode_transaksi' => 'TRX-' .
                    strtoupper(Str::random(10)),
                'total_biaya' => $biaya,
                'metode_pembayaran' => 'tunai',
                'status_pembayaran' => 'belum_bayar',
                'tanggal_transaksi' => $waktuKeluar,
            ]);

            // Buat data validasi otomatis
            Validasi::create([
                'transaksi_id' => $transaksi->id,
                'status' => 'menunggu',
            ]);

            // Ambil semua admin dan owner
            $penerima = User::whereIn('role', [
                'admin',
                'owner'
            ])->get();

            // Kirim notifikasi transaksi baru
            foreach ($penerima as $user) {

                Notifikasi::create([
                    'user_id' => $user->id,
                    'judul' => 'Transaksi Menunggu Validasi',
                    'pesan' => 'Transaksi ' .
                        $transaksi->kode_transaksi .
                        ' menunggu persetujuan admin. Total: Rp ' .
                        number_format($biaya, 0, ',', '.'),
                    'tipe' => 'info',
                    'dibaca' => false,
                ]);
            }

            DB::commit();

            $this->catatAktivitas(
                'parkir_keluar',
                'Kendaraan ' .
                $parkir->kendaraan->plat_nomor .
                ' berhasil keluar. Kode tiket: ' .
                $parkir->kode_tiket .
                '. Durasi: ' . $durasi .
                ' jam. Biaya: Rp ' .
                number_format($biaya, 0, ',', '.')
            );

            return back()->with(
                'success',
                'Kendaraan berhasil keluar. Transaksi menunggu validasi admin. Total biaya: Rp ' .
                number_format($biaya, 0, ',', '.')
            );

        } catch (\Throwable $e) {

            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            $this->catatAktivitas(
                'parkir_keluar_gagal',
                'Gagal memproses kendaraan keluar. ID parkir: ' .
                $id . '. Kesalahan: ' . $e->getMessage()
            );

            report($e);

            return back()->with(
                'error',
                'Gagal memproses kendaraan keluar. Periksa kembali data dan struktur database.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CETAK TIKET / STRUK
    |--------------------------------------------------------------------------
    */

    public function cetak($id)
    {
        try {

            $parkir = Parkir::with([
                'kendaraan',
                'transaksi',
                'petugas',
            ])->findOrFail($id);

            $this->catatAktivitas(
                'cetak_struk',
                'Halaman cetak struk dibuka. Kode tiket: ' .
                $parkir->kode_tiket .
                '. Plat nomor: ' .
                $parkir->kendaraan->plat_nomor
            );

            return view(
                'parkir.cetak',
                compact('parkir')
            );

        } catch (\Throwable $e) {

            $this->catatAktivitas(
                'cetak_struk_gagal',
                'Gagal membuka halaman cetak struk. ID parkir: ' .
                $id . '. Kesalahan: ' . $e->getMessage()
            );

            report($e);

            return back()->with(
                'error',
                'Gagal membuka halaman cetak struk. Silakan coba kembali.'
            );
        }
    }
}
