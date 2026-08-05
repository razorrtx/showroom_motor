<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\KriteriaSaw;

class SawController extends Controller
{
    public function hitungRekomendasi(Request $request)
    {
        // 1. Ambil bobot preferensi dari inputan Calon Pembeli (asumsi skala 1-10 atau 1-5)
        // Nilai default diberikan jika form belum diisi
        $bobot = [
            'harga'    => $request->input('bobot_harga', 5),
            'tahun'    => $request->input('bobot_tahun', 5),
            'kilometer'=> $request->input('bobot_kilometer', 5),
            'kondisi'  => $request->input('bobot_kondisi', 5),
            'dokumen'  => $request->input('bobot_dokumen', 5),
        ];

        // 2. Ambil semua data motor yang statusnya tayang di katalog
        $motors = Motor::where('status_tayang', true)->get();

        if ($motors->isEmpty()) {
            return redirect()->back()->with('error', 'Belum ada data motor yang tersedia untuk direkomendasikan.');
        }

        // 3. Konversi nilai String ke Angka Numerik & Siapkan Matriks Keputusan
        $dataMotor = [];
        foreach ($motors as $motor) {
            // Konversi Kondisi Kendaraan (Sesuai Skala)
            $nilaiKondisi = match ($motor->kondisi_kendaraan) {
                'Sangat Bagus' => 5,
                'Bagus'        => 4,
                'Normal'       => 3,
                'Kurang'       => 2,
                'Buruk'        => 1,
                default        => 0
            };

            // Konversi Kelengkapan Dokumen (Sesuai Skala)
            $nilaiDokumen = match ($motor->kelengkapan_dokumen) {
                'BPKB & STNK Lengkap' => 5,
                'Hanya BPKB'          => 3,
                'Hanya STNK'          => 2,
                'Tanpa Surat'         => 1,
                default               => 0
            };

            $dataMotor[] = [
                'motor'     => $motor,
                'harga'     => $motor->harga,           // Kriteria COST
                'tahun'     => $motor->tahun_kendaraan, // Kriteria BENEFIT
                'kilometer' => $motor->kilometer,       // Kriteria COST
                'kondisi'   => $nilaiKondisi,           // Kriteria BENEFIT
                'dokumen'   => $nilaiDokumen            // Kriteria BENEFIT
            ];
        }

        // 4. Cari Nilai Maksimum (Benefit) dan Minimum (Cost) untuk Normalisasi
        $koleksiData  = collect($dataMotor);
        $minHarga     = $koleksiData->min('harga');
        $maxTahun     = $koleksiData->max('tahun');
        $minKilometer = $koleksiData->min('kilometer');
        $maxKondisi   = $koleksiData->max('kondisi');
        $maxDokumen   = $koleksiData->max('dokumen');

        // 5. Proses Normalisasi Matriks & Perhitungan Nilai Preferensi Akhir (V)
        $hasilRekomendasi = [];
        foreach ($dataMotor as $item) {
            // Normalisasi (mencegah pembagian dengan nol jika data kosong/error)
            $normHarga     = $item['harga'] != 0 ? $minHarga / $item['harga'] : 0; 
            $normTahun     = $maxTahun != 0 ? $item['tahun'] / $maxTahun : 0; 
            $normKilometer = $item['kilometer'] != 0 ? $minKilometer / $item['kilometer'] : 0; 
            $normKondisi   = $maxKondisi != 0 ? $item['kondisi'] / $maxKondisi : 0; 
            $normDokumen   = $maxDokumen != 0 ? $item['dokumen'] / $maxDokumen : 0; 

            // Rumus Perhitungan SAW: (Nilai Normalisasi * Bobot Preferensi Pembeli)
            $nilaiAkhir = ($normHarga * $bobot['harga']) +
                          ($normTahun * $bobot['tahun']) +
                          ($normKilometer * $bobot['kilometer']) +
                          ($normKondisi * $bobot['kondisi']) +
                          ($normDokumen * $bobot['dokumen']);

            $hasilRekomendasi[] = [
                'motor'       => $item['motor'],
                'nilai_akhir' => $nilaiAkhir
            ];
        }

        // 6. Urutkan hasil (Perangkingan) dari nilai preferensi tertinggi ke terendah
        $hasilRekomendasi = collect($hasilRekomendasi)->sortByDesc('nilai_akhir')->values();

        // 7. Kirim data hasil algoritma ke tampilan antarmuka (Front-End)
        return view('publik.rekomendasi', compact('hasilRekomendasi'));
    }
}
