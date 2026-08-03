@extends('layouts.publik')

@section('title', 'Fitur Rekomendasi SAW - Cepi Anugerah Motor')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 text-center">
    <h1 class="text-2xl md:text-3xl font-bold text-black mb-2">Temukan Motor Impian Anda</h1>
    <p class="text-lg md:text-xl text-black font-normal">Masukkan preferensi Anda dibawah untuk mendapatkan rekomendasi terbaik dari kami</p>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="bg-white rounded border border-slate-300 p-6 md:p-10 shadow-sm">
        
        <form action="{{ route('hitung.saw') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Rentang Harga -->
            <div>
                <label class="block text-base text-black mb-2">Rentang Harga (RP)</label>
                <input type="text" name="harga" class="w-full px-4 py-2 border border-black rounded text-base focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Contoh: Rp 10.000.000 - Rp 25.000.000">
            </div>

            <!-- Tahun Kendaraan -->
            <div>
                <label class="block text-base text-black mb-2">Minimal Tahun Kendaraan</label>
                <input type="text" name="tahun" class="w-full px-4 py-2 border border-black rounded text-base focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Contoh: 2018">
            </div>

            <!-- Kilometer -->
            <div>
                <label class="block text-base text-black mb-2">Batas Maksimal Kilometer</label>
                <input type="text" name="kilometer" class="w-full px-4 py-2 border border-black rounded text-base focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Contoh: 50.000 km">
            </div>

            <!-- Row 2 Kolom untuk Kondisi & Dokumen -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-base text-black mb-2">Kondisi Kendaraan</label>
                    <select name="kondisi" class="w-full px-4 py-2 bg-white border border-black rounded text-base focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M5%207l5%205%205-5%22%20fill%3D%22none%22%20stroke%3D%22%23000%22%20stroke-width%3D%221.5%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fsvg%3E')] bg-no-repeat bg-position-[right_10px_center]">
                        <option>Pilih Kondisi</option>
                        <option>Sangat Bagus</option>
                        <option>Bagus</option>
                    </select>
                </div>
                <div>
                    <label class="block text-base text-black mb-2">Kelengkapan Dokumen</label>
                    <select name="dokumen" class="w-full px-4 py-2 bg-white border border-black rounded text-base focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M5%207l5%205%205-5%22%20fill%3D%22none%22%20stroke%3D%22%23000%22%20stroke-width%3D%221.5%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fsvg%3E')] bg-no-repeat bg-position-[right_10px_center]">
                        <option>Pilih Dokumen</option>
                        <option>Tanpa BPKB</option>
                        <option>Tanpa STNK</option>
                    </select>
                </div>
            </div>

            <!-- Tombol Cari -->
            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-[#69A1FF] hover:bg-blue-500 text-white text-lg font-bold rounded">
                    Cari Rekomendasi
                </button>
            </div>
        </form>

    </div>
</div>
@endsection