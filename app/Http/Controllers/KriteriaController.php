<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KriteriaSaw;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaSaw::all();
        return view('admin.kriteria', compact('kriteria'));
    }

    // Menyimpan perubahan bobot
    public function update(Request $request)
    {
        // 1. Validasi dasar (pastikan semua diisi dan berupa angka)
        $request->validate([
            'harga' => 'required|numeric|min:0|max:100',
            'tahun_kendaraan' => 'required|numeric|min:0|max:100',
            'kilometer' => 'required|numeric|min:0|max:100',
            'kondisi_kendaraan' => 'required|numeric|min:0|max:100',
            'kelengkapan_dokumen' => 'required|numeric|min:0|max:100',
        ]);

        // 2. LOGIKA SAW: Hitung total semua bobot
        $totalBobot = $request->harga + $request->tahun_kendaraan + $request->kilometer + $request->kondisi_kendaraan + $request->kelengkapan_dokumen;

        // 3. Jika totalnya bukan 100, tendang balik bawa pesan error!
        if ($totalBobot != 100) {
            return redirect()->back()
                ->withInput() // Biar angka yang udah diketik user gak ilang
                ->withErrors(['total_bobot' => 'GAGAL! Total keseluruhan bobot kriteria harus pas 100. (Total angka Anda saat ini: ' . $totalBobot . ')']);
        }

        // 4. Jika lolos (total pas 100), simpan ke database
        // Biasanya settingan kriteria cuma ada 1 baris di tabel, jadi kita ambil baris pertama
        $kriteria = KriteriaSaw::first(); 
        
        if ($kriteria) {
            $kriteria->update($request->all());
        } else {
            // Jaga-jaga kalau tabel kriteria masih kosong melompong
            KriteriaSaw::create($request->all());
        }

        return redirect()->back()->with('success', 'Bobot Kriteria SAW berhasil diperbarui.');
    }
}
