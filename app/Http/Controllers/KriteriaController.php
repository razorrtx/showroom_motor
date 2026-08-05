<?php

namespace App\Http\Controllers;

use App\Models\KriteriaSaw;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    // 1. Tampilkan Data (Penyebab error nama_kriteria berhasil diatasi di sini)
    public function index()
    {
        // Menggunakan all() karena struktur tabel database lu adalah Multi-Row
        $kriteria = KriteriaSaw::all();
        return view('admin.kriteria', compact('kriteria'));
    }

    // 2. Fungsi Proses Simpan / Update (Super Pintar)
    public function update(Request $request)
    {
        $kriterias = KriteriaSaw::all();
        $totalBobot = 0;

        // KITA BIKIN SISTEM JADI PINTAR MENDETEKSI STRUKTUR FORM HTML LU:
        
        // Skenario A: Jika form HTML lu pakai name="bobot[]" atau name="bobot[{{ $kriteria->id }}]"
        if ($request->has('bobot') && is_array($request->input('bobot'))) {
            $bobots = $request->input('bobot');
            $totalBobot = array_sum($bobots);

            // Validasi Logika SAW
            if ($totalBobot != 100) {
                return redirect()->back()->withErrors(['GAGAL! Total keseluruhan bobot kriteria harus pas 100. (Total angka Anda saat ini: ' . $totalBobot . ')']);
            }

            // Simpan ke database sesuai ID baris
            foreach ($bobots as $id => $nilai) {
                $k = KriteriaSaw::find($id);
                if ($k) {
                    $k->bobot = $nilai; 
                    $k->save();
                }
            }
        } 
        // Skenario B: Jika form HTML lu pakai nama input manual (name="harga", dll)
        else {
            $totalBobot += (int)$request->harga;
            $totalBobot += (int)$request->tahun_kendaraan;
            $totalBobot += (int)$request->kilometer;
            $totalBobot += (int)$request->kondisi_kendaraan;
            $totalBobot += (int)$request->kelengkapan_dokumen;

            // Validasi Logika SAW
            if ($totalBobot != 100) {
                return redirect()->back()->withErrors(['GAGAL! Total keseluruhan bobot kriteria harus pas 100. (Total angka Anda saat ini: ' . $totalBobot . ')']);
            }

            // Update manual dengan mencocokkan teks di nama_kriteria
            foreach($kriterias as $k) {
                $nama = strtolower($k->nama_kriteria);
                
                if (str_contains($nama, 'harga')) $k->bobot = $request->harga;
                elseif (str_contains($nama, 'tahun')) $k->bobot = $request->tahun_kendaraan;
                elseif (str_contains($nama, 'kilometer') || str_contains($nama, 'jarak')) $k->bobot = $request->kilometer;
                elseif (str_contains($nama, 'kondisi')) $k->bobot = $request->kondisi_kendaraan;
                elseif (str_contains($nama, 'dokumen') || str_contains($nama, 'kelengkapan')) $k->bobot = $request->kelengkapan_dokumen;

                $k->save();
            }
        }

        return redirect()->back()->with('success', 'Mantap! Bobot Kriteria SAW berhasil diperbarui.');
    }

    // Jaga-jaga kalau routing sistem lu pakai method store, kita arahkan ke update
    public function store(Request $request)
    {
        return $this->update($request);
    }
}