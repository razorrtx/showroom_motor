<?php

namespace App\Http\Controllers;
use App\Models\Motor; 
use App\Models\KriteriaSaw;
use App\Http\Requests\StoreMotorRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    public function index()
    {
        $motors = Motor::latest()->get();
        
        // Data untuk kartu statistik di atas tabel
        $totalMotor = $motors->count();
        $motorTayang = $motors->where('status_tayang', true)->count();
        $totalKriteria = KriteriaSaw::count(); // Menghitung kriteria SAW yang aktif

        return view('admin.dashboard', compact('motors', 'totalMotor', 'motorTayang', 'totalKriteria'));
    }

    public function kendaraan()
    {
        $motors = Motor::latest()->get();
        return view('admin.kendaraan', compact('motors'));
    }

    public function spesifikasi()
    {
        $motors = Motor::latest()->get();
        return view('admin.spesifikasi', compact('motors'));
    }

    public function katalogAdmin()
    {
        $motors = Motor::latest()->get();
        return view('admin.katalog', compact('motors'));
    }

    public function create()
    {
        return view('admin.create'); //Menampilkan Form Tambah Data
    }

    public function store(StoreMotorRequest $request)
    {
        // 1. Ambil data yang sudah lolos validasi
        $data = $request->validated();

        // 2. Proses upload foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_motor'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        // 3. Penyelamat Database: Isi otomatis jika detail spesifikasi kosong
        $data['detail_spesifikasi'] = $request->detail_spesifikasi ?? '-';

        // 4. Set default status_tayang menjadi 1 (Tayang)
        $data['status_tayang'] = $request->status_tayang ?? 1;

        // 5. Simpan ke database
        Motor::create($data);

        // 6. Redirect kembali ke halaman Data Kendaraan
        return redirect()->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $motor = Motor::findOrFail($id);
        return view('admin.edit', compact('motor')); //Menampilkan Form Edit
    }

    public function update(Request $request, $id)
    {
        $motor = Motor::findOrFail($id);

        // Validasi (Foto opsional saat edit)
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'merk_tipe' => 'required|string|max:255',
            'tahun_kendaraan' => 'required|integer',
            'harga' => 'required|numeric',
            'kilometer' => 'required|integer',
            'kondisi_kendaraan' => 'required',
            'kelengkapan_dokumen' => 'required',
            'detail_spesifikasi' => 'required'
        ]);

        $dataUpdate = $request->except(['_token', '_method', 'foto']);

        // Jika admin mengupload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage
            if (Storage::exists('foto_motor/' . $motor->foto)) {
                Storage::delete('foto_motor/' . $motor->foto);
            }
            // Upload foto baru
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('foto_motor', $namaFoto); 
            
            $dataUpdate['foto'] = $namaFoto;
        }

        $motor->update($dataUpdate);

        return redirect()->route('admin.dashboard')->with('success', 'Data motor berhasil diperbarui!');
    }

    //Menghapus Data Motor
    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        
        // Hapus file foto dari storage rahasia
        if (Storage::exists('foto_motor/' . $motor->foto)) {
            Storage::delete('foto_motor/' . $motor->foto);
        }

        $motor->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Data motor berhasil dihapus!');
    }

    //Mengubah Status Tayang di Katalog
    public function toggleStatus($id)
    {
        $motor = Motor::findOrFail($id);
        $motor->status_tayang = !$motor->status_tayang; // Balikkan nilainya (true jadi false, dst)
        $motor->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status katalog berhasil diubah!');
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
