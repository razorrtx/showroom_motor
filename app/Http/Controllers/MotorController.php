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
        // 1. Validasi inputan (samakan standarnya dengan proses Store)
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // nullable karena user gak wajib ganti foto
            'merk_tipe' => 'required|string|max:255',
            'harga' => 'required|numeric|min:1000000|max:500000000',
            'tahun_kendaraan' => 'required|integer|digits:4|min:2000|max:' . (date('Y') + 1),
            'kilometer' => 'required|integer|min:0|max:999999',
            'kondisi_kendaraan' => 'required|in:Sangat Bagus,Bagus, Cukup Bagus',
            'kelengkapan_dokumen' => 'required|in:BPKB & STNK Lengkap,Hanya BPKB,Hanya STNK',
            'detail_spesifikasi' => 'nullable|string', // Ubah jadi nullable
        ]);

        $motor = Motor::findOrFail($id);
        $data = $request->except(['foto']); // Ambil semua data kecuali file foto dulu

        // 2. Proses upload foto BARU jika user memilih foto baru
        if ($request->hasFile('foto')) {
            // Opsional: Hapus foto lama dari folder public/foto_motor agar tidak menumpuk
            if ($motor->foto && file_exists(public_path('foto_motor/' . $motor->foto))) {
                unlink(public_path('foto_motor/' . $motor->foto));
            }
            
            // Upload foto baru
            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_motor'), $nama_foto);
            $data['foto'] = $nama_foto;
        }

        // 3. Jaga data detail_spesifikasi agar tidak hilang!
        // Karena input detail_spesifikasi dihapus dari form edit, request akan bernilai null.
        // Kita timpa kembali dengan data lama yang ada di database agar tidak kerest.
        if (!$request->has('detail_spesifikasi')) {
            $data['detail_spesifikasi'] = $motor->detail_spesifikasi;
        }

        // 4. Update ke database
        $motor->update($data);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Data Kendaraan berhasil diperbarui!');
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
