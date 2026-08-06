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

    <!-- Search & Filter Bar (Sudah diubah menjadi Form Pencarian Dinamis) -->
    <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        
        <!-- Kotak Pencarian -->
        <div class="relative w-full md:w-1/2 lg:w-1/3">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <!-- Tambahan: name="cari" dan value request('cari') agar inputan tidak hilang setelah enter -->
            <input type="text" name="cari" value="{{ request('cari') }}" class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border-none rounded-full text-sm focus:ring-2 focus:ring-blue-500" placeholder="Cari Motor Disini.">
        </div>

        <!-- Dropdown Filter Pengurutan -->
        <div class="w-full md:w-auto">
            <!-- Tambahan: name="sort" dan onchange="this.form.submit()" agar otomatis mencari saat opsi dipilih -->
            <select name="sort" onchange="this.form.submit()" class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                <option value="" disabled {{ !request('sort') ? 'selected' : '' }} hidden>Urutkan Berdasarkan</option>
                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Harga Termahal</option>
            </select>
        </div>
    </form>

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
        <!-- Tampilan jika motor yang dicari tidak ditemukan -->
        <div class="col-span-full py-12 text-center flex flex-col items-center justify-center border border-slate-200 rounded-xl bg-slate-50">
            <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-lg font-medium text-slate-600">Maaf, Motor yang Anda cari belum tersedia.</p>
            <a href="{{ url('/katalog') }}" class="mt-3 text-blue-500 hover:underline">Reset Pencarian</a>
        </div>
        @endforelse
    </div>

</div>
@endsection