<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\KriteriaSaw;

class SawController extends Controller
{
    public function hitungRekomendasi(Request $request)
    {
        // ====================================================================
        // TAHAP 1: FILTERING (Mendengarkan kemauan & budget calon pembeli)
        // ====================================================================
        $query = Motor::where('status_tayang', true);

        // Filter Rentang Harga Maksimal (Hapus format titik/koma dari input, misal "10.000.000" jadi 10000000)
        if ($request->filled('harga')) {
            $harga = (int) preg_replace('/\D/', '', $request->input('harga'));
            $query->where('harga', '<=', $harga);
        }

        // Filter Minimal Tahun Kendaraan
        if ($request->filled('tahun')) {
            $query->where('tahun_kendaraan', '>=', $request->input('tahun'));
        }

        // Filter Batas Maksimal Kilometer
        if ($request->filled('kilometer')) {
            $km = (int) preg_replace('/\D/', '', $request->input('kilometer'));
            $query->where('kilometer', '<=', $km);
        }

        // Filter Kondisi & Dokumen (Opsional, jika form mengirim data selain "Semua")
        if ($request->filled('kondisi_kendaraan') && $request->input('kondisi_kendaraan') != '') {
            $query->where('kondisi_kendaraan', $request->input('kondisi_kendaraan'));
        }
        if ($request->filled('kelengkapan_dokumen') && $request->input('kelengkapan_dokumen') != '') {
            $query->where('kelengkapan_dokumen', $request->input('kelengkapan_dokumen'));
        }

        // Eksekusi pencarian motor yang LULUS FILTER
        $motors = $query->get();

        // Uji "Mimpi Siang Bolong" -> Jika budget terlalu kecil dan tidak ada motor yang cocok
        if ($motors->isEmpty()) {
            return view('publik.rekomendasi', ['hasilRekomendasi' => []]);
        }

        // ====================================================================
        // TAHAP 2: AMBIL "OTAK" BOBOT DARI ADMIN
        // ====================================================================
        $kriterias = KriteriaSaw::all();
        // Array bobot default jaga-jaga kalau admin belum pernah input
        $bobot = ['harga' => 20, 'tahun' => 20, 'kilometer' => 20, 'kondisi' => 20, 'dokumen' => 20];

        foreach ($kriterias as $k) {
            $nama = strtolower($k->nama_kriteria);
            if (str_contains($nama, 'harga')) $bobot['harga'] = $k->bobot;
            elseif (str_contains($nama, 'tahun')) $bobot['tahun'] = $k->bobot;
            elseif (str_contains($nama, 'kilometer') || str_contains($nama, 'jarak')) $bobot['kilometer'] = $k->bobot;
            elseif (str_contains($nama, 'kondisi')) $bobot['kondisi'] = $k->bobot;
            elseif (str_contains($nama, 'dokumen') || str_contains($nama, 'kelengkapan')) $bobot['dokumen'] = $k->bobot;
        }

        // ====================================================================
        // TAHAP 3: KONVERSI NILAI & SIAPKAN MATRIKS
        // ====================================================================
        $dataMotor = [];
        foreach ($motors as $motor) {
            // Konversi String Kondisi ke Skala Angka
            $nilaiKondisi = match ($motor->kondisi_kendaraan) {
                'Sangat Bagus' => 3, 'Bagus' => 2, 'Cukup Bagus' => 1, default => 0
            };
            // Konversi String Dokumen ke Skala Angka
            $nilaiDokumen = match ($motor->kelengkapan_dokumen) {
                'BPKB & STNK Lengkap' => 3, 'Hanya BPKB' => 2, 'Hanya STNK' => 1, default => 0
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

        // Cari Nilai Maksimum (Benefit) dan Minimum (Cost) dari sisa motor yang lulus filter
        $koleksiData  = collect($dataMotor);
        $minHarga     = $koleksiData->min('harga');
        $maxTahun     = $koleksiData->max('tahun');
        $minKilometer = $koleksiData->min('kilometer');
        $maxKondisi   = $koleksiData->max('kondisi');
        $maxDokumen   = $koleksiData->max('dokumen');

        // ====================================================================
        // TAHAP 4: NORMALISASI MATRIKS & KALKULASI FINAL
        // ====================================================================
        $hasilRekomendasi = [];
        foreach ($dataMotor as $item) {
            // Normalisasi
            $normHarga     = $item['harga'] != 0 ? $minHarga / $item['harga'] : 0; 
            $normTahun     = $maxTahun != 0 ? $item['tahun'] / $maxTahun : 0; 
            $normKilometer = $item['kilometer'] != 0 ? $minKilometer / $item['kilometer'] : 0; 
            $normKondisi   = $maxKondisi != 0 ? $item['kondisi'] / $maxKondisi : 0; 
            $normDokumen   = $maxDokumen != 0 ? $item['dokumen'] / $maxDokumen : 0; 

            // RUMUS SAW FINAL: Menggunakan Bobot dari Admin
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

        // ====================================================================
        // TAHAP 5: PERANGKINGAN (Peringkat 1 s/d seterusnya)
        // ====================================================================
        $hasilRekomendasi = collect($hasilRekomendasi)->sortByDesc('nilai_akhir')->values();

        return view('publik.rekomendasi', compact('hasilRekomendasi'));
    }
}