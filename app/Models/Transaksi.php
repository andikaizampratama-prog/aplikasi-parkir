<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'parkir_id',
        'kode_transaksi',
        'total_biaya',
        'metode_pembayaran',
        'status_pembayaran',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'total_biaya' => 'decimal:2',
        'tanggal_transaksi' => 'datetime',
    ];

   public function parkir()
{
    return $this->belongsTo(
        Parkir::class,
        'parkir_id',
        'id_area'
    );
}
}
