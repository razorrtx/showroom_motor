@extends('layouts.publik')

@section('title', 'Hasil Rekomendasi - Cepi Anugerah Motor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 text-center">
    <h1 class="text-2xl md:text-3xl font-bold text-black mb-2">Hasil Rekomendasi Untuk Anda</h1>
    <p class="text-lg md:text-xl text-black font-normal">Berikut adalah urutan motor bekas yang sesuai dengan preferensi anda</p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    
    <!-- Peringkat 1 (Kartu Besar) -->
    <div class="border border-slate-400 rounded-xl p-4 md:p-6 mb-8 flex flex-col md:flex-row gap-6 relative">
        <div class="absolute top-4 md:top-8 left-0 z-10 bg-[#FFD700] border border-black px-4 py-1.5 rounded-r font-medium text-sm">
            Peringkat 1 - Paling Sesuai
        </div>
        
        <div class="w-full md:w-5/12 bg-slate-200 rounded-xl flex items-center justify-center h-48 md:h-64 border border-slate-300 mt-8 md:mt-0">
            <!-- [foto] placeholder -->
            <span class="text-slate-500 font-medium">[foto]</span>
        </div>
        
        <div class="w-full md:w-7/12 flex flex-col justify-center">
            <h2 class="text-xl md:text-2xl text-black mb-2">Yamaha NMAX 155 ABS 2023</h2>
            <p class="text-lg md:text-xl text-black mb-4">Rp 32.500.000</p>
            <p class="text-base text-black mb-1">Short Specs</p>
            <p class="text-base text-black mb-6">2023 | 5,000 km | Surat Lengkap</p>
            <a href="#" class="w-full text-center py-3 bg-[#69A1FF] hover:bg-blue-500 text-white font-bold rounded-lg transition-colors">
                Lihat Detail
            </a>
        </div>
    </div>

    <!-- Peringkat Lainnya (Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Peringkat 2 -->
        <div class="border border-slate-400 rounded-xl p-4 relative pt-14 flex flex-col">
            <div class="absolute top-0 left-0 bg-slate-300 border-r border-b border-black px-4 py-2 rounded-tl-xl rounded-br-lg font-medium text-sm">
                Peringkat 2
            </div>
            <div class="bg-slate-200 h-40 rounded-lg flex items-center justify-center border border-slate-300 mb-4">
                <span class="text-slate-500 font-medium">[foto]</span>
            </div>
            <h3 class="text-lg text-black mb-1">Honda CBR250RR</h3>
            <p class="text-base text-black mb-4">Rp 45.000.000</p>
            <a href="#" class="mt-auto w-full text-center py-2 text-[#69A1FF] font-bold rounded-full border border-[#69A1FF] hover:bg-blue-50 transition-colors">
                Lihat Detail
            </a>
        </div>

        <!-- Card Peringkat 3 -->
        <div class="border border-slate-400 rounded-xl p-4 relative pt-14 flex flex-col">
            <div class="absolute top-0 left-0 bg-[#C88B46] border-r border-b border-black px-4 py-2 rounded-tl-xl rounded-br-lg font-medium text-sm text-black">
                Peringkat 3
            </div>
            <div class="bg-slate-200 h-40 rounded-lg flex items-center justify-center border border-slate-300 mb-4">
                <span class="text-slate-500 font-medium">[foto]</span>
            </div>
            <h3 class="text-lg text-black mb-1">Honda Vario 160</h3>
            <p class="text-base text-black mb-4">Rp 22.500.000</p>
            <a href="#" class="mt-auto w-full text-center py-2 text-[#69A1FF] font-bold rounded-full border border-[#69A1FF] hover:bg-blue-50 transition-colors">
                Lihat Detail
            </a>
        </div>

        <!-- Card Peringkat 4 -->
        <div class="border border-slate-400 rounded-xl p-4 relative pt-14 flex flex-col">
            <div class="absolute top-0 left-0 bg-slate-300 border-r border-b border-black px-4 py-2 rounded-tl-xl rounded-br-lg font-medium text-sm">
                Peringkat 4
            </div>
            <div class="bg-slate-200 h-40 rounded-lg flex items-center justify-center border border-slate-300 mb-4">
                <span class="text-slate-500 font-medium">[foto]</span>
            </div>
            <h3 class="text-lg text-black mb-1">Yamaha Aerox 155</h3>
            <p class="text-base text-black mb-4">Rp 25.800.000</p>
            <a href="#" class="mt-auto w-full text-center py-2 text-[#69A1FF] font-bold rounded-full border border-[#69A1FF] hover:bg-blue-50 transition-colors">
                Lihat Detail
            </a>
        </div>
    </div>
</div>
@endsection