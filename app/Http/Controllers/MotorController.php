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
}
