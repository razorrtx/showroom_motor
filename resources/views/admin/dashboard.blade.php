@extends('layouts.admin')

@section('title', 'Dashboard - Cepi Anugerah Motor')

@section('content')
<div class="mb-6">
    <h2 class="text-xl md:text-2xl font-bold text-slate-800">Dashboard</h2>
    <p class="text-sm text-slate-500 mt-1">Ringkasan statistik showroom motor Anda hari ini.</p>
</div>

<!-- 4 Kotak Statistik (Akan memanjang ke bawah di HP, sejajar di PC) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 md:mb-8">
    
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center space-x-4">
        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Motor</p>
            <h3 class="text-xl md:text-2xl font-bold text-slate-800">{{ $totalMotor }}</h3>
        </div>
    </div>
    
    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center space-x-4">
        <div class="p-3 bg-green-50 text-green-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Motor Tayang</p>
            <h3 class="text-xl md:text-2xl font-bold text-slate-800">{{ $motorTayang }}</h3>
        </div>
    </div>

    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center space-x-4">
        <div class="p-3 bg-yellow-50 text-yellow-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Menunggu Spesifikasi</p>
            <h3 class="text-xl md:text-2xl font-bold text-slate-800">0</h3>
        </div>
    </div>

    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center space-x-4">
        <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Kriteria SAW</p>
            <h3 class="text-xl md:text-2xl font-bold text-slate-800">{{ $totalKriteria }}</h3>
        </div>
    </div>
</div>

<!-- Tabel Data Singkat -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
        <h3 class="text-sm font-bold text-slate-800">Data Motor Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600 whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3 font-semibold uppercase text-xs">Merk / Tipe</th>
                    <th class="px-5 py-3 font-semibold uppercase text-xs">Tahun</th>
                    <th class="px-5 py-3 font-semibold uppercase text-xs">Harga</th>
                    <th class="px-5 py-3 font-semibold uppercase text-xs text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($motors as $index => $motor)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-5 py-3 font-medium text-slate-800">{{ $motor->merk_tipe }}</td>
                    <td class="px-5 py-3">{{ $motor->tahun_kendaraan }}</td>
                    <td class="px-5 py-3 font-medium">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                    <td class="px-5 py-3 text-center">
                        @if($motor->status_tayang)
                            <span class="px-2.5 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-md">Tayang</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-semibold bg-slate-100 text-slate-600 rounded-md">Sembunyi</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-8 text-center text-slate-500 text-sm">Belum ada data motor terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection