<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Parkir extends Model
{
    protected $table = 'parkirs';

    protected $primaryKey = 'id_area';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'kendaraan_id',
        'petugas_id',
        'kode_tiket',
        'waktu_masuk',
        'waktu_keluar',
        'biaya',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'waktu_masuk' => 'datetime',
            'waktu_keluar' => 'datetime',
            'biaya' => 'decimal:2',
        ];
    }

    // Relasi kendaraan
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(
            Kendaraan::class,
            'kendaraan_id',
            'id'
        );
    }

    // Relasi transaksi
    public function transaksi(): HasOne
    {
        return $this->hasOne(
            Transaksi::class,
            'parkir_id',
            'id_area'
        );
    }

    // Relasi petugas
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'petugas_id',
            'id'
        );
    }
}
