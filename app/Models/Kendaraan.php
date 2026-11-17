<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kendaraan extends Model
{
    protected $fillable = [
        'plat_nomor',
        'jenis',
        'pemilik',
    ];

    public function parkirs(): HasMany
    {
        return $this->hasMany(Parkir::class);
    }
}
