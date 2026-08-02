@extends('layouts.publik')

@section('title', 'Katalog Motor - Cepi Anugerah Motor')

@section('content')
<!-- Header Banner -->
<div class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">Katalog Motor Bekas Berkualitas</h1>
        <p class="mt-4 text-slate-500 max-w-2xl mx-auto text-sm md:text-base">Temukan berbagai pilihan kendaraan bermotor dengan kondisi prima dan harga bersaing. Semua unit telah melewati proses inspeksi kami.</p>
    </div>
</div>

<!-- Daftar Motor (Grid Cards) -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($motors as $motor)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col">
                <!-- Area Foto -->
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <img src="{{ route('tampil.foto', $motor->foto) }}" alt="{{ $motor->merk_tipe }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <!-- Badge Tahun -->
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-xs font-bold text-slate-800 shadow-sm">
                        {{ $motor->tahun_kendaraan }}
                    </div>
                </div>
                
                <!-- Area Konten Info Motor -->
                <div class="p-5 flex flex-col grow">
                    <h3 class="text-lg font-bold text-slate-800 line-clamp-1" title="{{ $motor->merk_tipe }}">{{ $motor->merk_tipe }}</h3>
                    
                    <div class="mt-2 flex items-center text-xs text-slate-500">
                        <span class="flex items-center gap-1 bg-slate-100 px-2 py-1 rounded-md font-medium">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $motor->kondisi_kendaraan }}
                        </span>
                    </div>
                    
                    <!-- Harga -->
                    <div class="mt-4 mb-5">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider mb-1">Harga Tunai</p>
                        <p class="text-xl font-bold text-blue-600">Rp {{ number_format($motor->harga, 0, ',', '.') }}</p>
                    </div>
                    
                    <!-- Tombol Detail -->
                    <div class="mt-auto pt-4 border-t border-slate-100">
                        <!-- Perhatikan href ini, sementara saya arahkan ke '#' jika rute detail belum ada -->
                        <a href="{{ url('/detail/' . $motor->id) }}" class="block w-full py-2.5 px-4 bg-slate-50 hover:bg-blue-600 text-slate-700 hover:text-white text-center rounded-xl text-sm font-semibold transition-colors border border-slate-200 hover:border-blue-600">
                            Lihat Spesifikasi Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <!-- Tampilan Jika Katalog Kosong -->
            <div class="col-span-full py-16 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2l2 2h8a2 2 0 012 2v2M4 6v10a2 2 0 002 2h12a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Katalog Kosong</h3>
                <p class="text-slate-500 mt-1">Saat ini belum ada motor yang ditayangkan di katalog.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection