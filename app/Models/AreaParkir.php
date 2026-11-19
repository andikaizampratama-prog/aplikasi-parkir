<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $table = 'areas_parkir';

    protected $fillable = [
        'nama_area',
        'jenis_kendaraan',
        'kapasitas',
        'keterangan',
        'status',
    ];
}
