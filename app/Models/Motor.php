<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motor extends Model
{
    use HasFactory;

    // Daftar kolom yang diizinkan untuk diisi dari form
    protected $fillable = [
        'merk_tipe',
        'harga',
        'tahun_kendaraan',
        'kilometer',
        'kondisi_kendaraan',
        'kelengkapan_dokumen',
        'foto',                 
        'detail_spesifikasi',
        'status_tayang'
    ];
}
