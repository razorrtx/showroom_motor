@extends('layouts.publik')

@section('title', 'Katalog Motor - Cepi Anugerah Motor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    
    <!-- Hero Banner -->
    <div class="bg-blue-50 rounded-xl p-8 md:p-12 mb-8">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-normal text-slate-800 mb-4">
            Selamat Datang di Showroom Motor Cepi Anugerah Motor<br>
            Motor Bekas Berkualitas!
        </h1>
        <p class="text-lg text-slate-700">Temukan motor idaman Anda di sini. Cek katalog kami sekarang !</p>
    </div>

    <!-- Search & Filter Bar -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div class="relative w-full md:w-1/2 lg:w-1/3">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border-none rounded-full text-sm focus:ring-2 focus:ring-blue-500" placeholder="Cari Merk, Tipe, atau Tahun..">
        </div>
        <div class="w-full md:w-auto">
            <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Urutkan Berdasarkan Terbaru</option>
                <option>Harga Termurah</option>
                <option>Harga Termahal</option>
            </select>
        </div>
    </div>

    <!-- Grid Katalog -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($motors as $motor)
        <div class="bg-white border border-slate-300 rounded-xl overflow-hidden flex flex-col">
            <!-- Foto Placeholder sesuai mockup -->
            <div class="w-full h-48 md:h-56 overflow-hidden rounded-t-xl bg-gray-100 relative">
                <img src="{{ asset('foto_motor/' . $motor->foto) }}" alt="{{ $motor->merk }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
            </div>
            
            <div class="p-5 grow flex flex-col">
                <h3 class="font-bold text-lg text-black">{{ $motor->merk_tipe }}</h3>
                <p class="font-bold text-lg text-black">Rp {{ number_format($motor->harga, 0, ',', '.') }}</p>
                <p class="text-sm text-slate-700 mt-1 mb-6">Tahun {{ $motor->tahun_kendaraan }}</p>
                
                <div class="mt-auto">
                    <!-- Nanti link ini disesuaikan dengan route asli -->
                    <a href="{{ route('detail.motor', $motor->id) }}" class="block w-full py-3 bg-blue-500 hover:bg-blue-600 text-white text-center font-bold rounded-lg transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-10 text-center text-slate-500 border border-slate-200 rounded-xl">
            Katalog masih kosong.
        </div>
        @endforelse
    </div>

</div>
@endsection