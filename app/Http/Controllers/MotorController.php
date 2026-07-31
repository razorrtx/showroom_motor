<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function store(StoreMotorRequest $request)
    {
        // 1. Proses Upload Foto ke folder 'storage/app/foto_motor'
        $namaFoto = time() . '_' . $request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('foto_motor', $namaFoto); 

        // 2. Simpan ke database
        Motor::create([
            'foto' => $namaFoto,
            'merk_tipe' => $request->merk_tipe,
            'tahun_kendaraan' => $request->tahun_kendaraan,
            'harga' => $request->harga,
            'kilometer' => $request->kilometer,
            'kondisi_kendaraan' => $request->kondisi_kendaraan,
            'kelengkapan_dokumen' => $request->kelengkapan_dokumen,
            'detail_spesifikasi' => $request->detail_spesifikasi,
            'status_tayang' => true
        ]);

        return redirect()->back()->with('success', 'Data motor berhasil ditambahkan!');
    }

    public function katalog()
    {
        $motors = Motor::where('status_tayang', true)->latest()->get();
        return view('publik.katalog', compact('motors'));
    }

    public function detail($id)
    {
        $motor = Motor::findOrFail($id);
 
        $nomorWA = "082318413915";
        $pesan = "Halo Cepi Anugerah Motor, saya tertarik dengan motor " . $motor->merk_tipe . " keluaran tahun " . $motor->tahun_kendaraan . ". Apakah unitnya masih tersedia?";
        $linkWA = "https://wa.me/" . $nomorWA . "?text=" . urlencode($pesan);

        return view('publik.detail', compact('motor', 'linkWA'));
    }
}
