<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KriteriaSaw;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = [
            ['nama_kriteria' => 'Harga', 'jenis_kriteria' => 'Cost', 'bobot' => 5],
            ['nama_kriteria' => 'Tahun Kendaraan', 'jenis_kriteria' => 'Benefit', 'bobot' => 4],
            ['nama_kriteria' => 'Kilometer', 'jenis_kriteria' => 'Cost', 'bobot' => 3],
            ['nama_kriteria' => 'Kondisi Kendaraan', 'jenis_kriteria' => 'Benefit', 'bobot' => 5],
            ['nama_kriteria' => 'Kelengkapan Dokumen', 'jenis_kriteria' => 'Benefit', 'bobot' => 5],
        ];

        foreach ($kriteria as $item) {
            KriteriaSaw::create($item);
        }
    }
}
