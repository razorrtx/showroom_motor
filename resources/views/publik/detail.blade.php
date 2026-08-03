@extends('layouts.publik')

@section('title', 'Detail ' . $motor->merk_tipe . ' - Cepi Anugerah Motor')

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <a href="{{ url('/katalog') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Katalog
        </a>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
            <!-- Area Foto Kiri -->
            <div class="bg-slate-100 p-6 flex items-center justify-center">
                <img src="{{ route('tampil.foto', $motor->foto) }}" alt="{{ $motor->merk_tipe }}" class="w-full max-w-lg object-contain rounded-xl shadow-md border border-slate-200">
            </div>

            <!-- Area Info Kanan -->
            <div class="p-8 lg:p-10 flex flex-col justify-center">
                <div class="mb-6">
                    <div class="inline-block px-3 py-1 mb-4 text-xs font-bold tracking-wider text-blue-600 bg-blue-100 rounded-full uppercase">
                        Tahun {{ $motor->tahun_kendaraan }}
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2">{{ $motor->merk_tipe }}</h1>
                    <p class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($motor->harga, 0, ',', '.') }}</p>
                </div>

                <div class="space-y-6">
                    <!-- Kondisi & Dokumen -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-1">Kondisi Fisik</p>
                            <p class="font-medium text-slate-800">{{ $motor->kondisi_kendaraan }}</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-1">Kelengkapan Dokumen</p>
                            <p class="font-medium text-slate-800">{{ $motor->kelengkapan_dokumen }}</p>
                        </div>
                    </div>

                    <!-- Spesifikasi Tambahan -->
                    <div>
                        <h3 class="text-sm text-slate-500 uppercase tracking-wider font-semibold mb-3 border-b border-slate-100 pb-2">Spesifikasi Detail</h3>
                        <div class="prose prose-sm text-slate-600">
                            @if($motor->detail_spesifikasi)
                                {!! nl2br(e($motor->detail_spesifikasi)) !!}
                            @else
                                <p class="italic text-slate-400">Tidak ada spesifikasi tambahan yang dicantumkan.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tombol Hubungi Penjual (Opsional/Bisa diarahkan ke WhatsApp) -->
                <div class="mt-10 pt-6 border-t border-slate-100">
                    <button onclick="alert('Fitur hubungi penjual via WhatsApp akan segera hadir!')" class="w-full flex justify-center items-center px-6 py-4 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl shadow-md transition-all duration-200 hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Hubungi Showroom
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection