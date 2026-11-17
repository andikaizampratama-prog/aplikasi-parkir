<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KapasitasParkir extends Model
{
    protected $table = 'kapasitas_parkirs';

    protected $fillable = [
        'jenis',
        'kapasitas',
    ];
}
