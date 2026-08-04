<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KriteriaSaw extends Model
{
    use HasFactory;

    protected $fillable = [
        'harga',
        'tahun_kendaraan',
        'kilometer',
        'kondisi_kendaraan',
        'kelengkapan_dokumen'
    ];
}
