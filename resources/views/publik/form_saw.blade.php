@extends('layouts.publik')

@section('title', 'Cari Rekomendasi Motor - Cepi Anugerah Motor')

@section('content')
<div class="bg-blue-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative z-10 text-center">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-4">Temukan Motor Impianmu</h1>
        <p class="text-blue-100 text-lg max-w-2xl mx-auto">Sistem cerdas kami akan menganalisis kebutuhanmu dan memberikan rekomendasi motor bekas terbaik yang tersedia di showroom.</p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20 pb-16">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 md:p-10">
        
        <div class="mb-8 border-b border-slate-100 pb-6">
            <h2 class="text-xl font-bold text-slate-800">Isi Preferensi Anda</h2>
            <p class="text-sm text-slate-500 mt-1">Pilih tingkat kepentingan untuk masing-masing kriteria di bawah ini (1 = Kurang Penting, 5 = Sangat Penting).</p>
        </div>

        <form action="{{ route('saw.hitung') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Input Harga -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga <span class="text-red-500">*</span></label>
                    <select name="kriteria[harga]" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-slate-700">
                        <option value="">-- Pilih Nilai --</option>
                        <option value="1">1 - Sangat Mahal</option>
                        <option value="2">2 - Mahal</option>
                        <option value="3">3 - Sedang / Menengah</option>
                        <option value="4">4 - Murah</option>
                        <option value="5">5 - Sangat Murah</option>
                    </select>
                </div>

                <!-- Input Tahun -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tahun Kendaraan <span class="text-red-500">*</span></label>
                    <select name="kriteria[tahun]" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-slate-700">
                        <option value="">-- Pilih Nilai --</option>
                        <option value="1">1 - Sangat Tua</option>
                        <option value="2">2 - Tua</option>
                        <option value="3">3 - Lumayan Baru</option>
                        <option value="4">4 - Baru</option>
                        <option value="5">5 - Sangat Baru (Tahun Muda)</option>
                    </select>
                </div>

                <!-- Input Kondisi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kondisi Fisik / Mesin <span class="text-red-500">*</span></label>
                    <select name="kriteria[kondisi]" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-slate-700">
                        <option value="">-- Pilih Nilai --</option>
                        <option value="1">1 - Kurang Baik (Perlu banyak perbaikan)</option>
                        <option value="3">3 - Cukup Baik (Minus pemakaian wajar)</option>
                        <option value="5">5 - Sangat Mulus (Seperti baru)</option>
                    </select>
                </div>

                <!-- Input Dokumen -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kelengkapan Dokumen <span class="text-red-500">*</span></label>
                    <select name="kriteria[dokumen]" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-slate-700">
                        <option value="">-- Pilih Nilai --</option>
                        <option value="1">1 - Tidak Lengkap (Hanya BPKB/STNK, Pajak Mati)</option>
                        <option value="3">3 - Lengkap, Pajak Mati</option>
                        <option value="5">5 - Sangat Lengkap (BPKB & STNK Hidup)</option>
                    </select>
                </div>
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full md:w-auto md:px-12 py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center mx-auto">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    Mulai Perhitungan SAW
                </button>
            </div>
        </form>
        
    </div>
</div>
@endsection