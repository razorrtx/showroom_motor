@extends('layouts.admin')

@section('title', 'Dashboard - Cepi Anugerah Motor')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-800">Selamat Datang, {{ Auth::user()->username }}!</h2>
    <p class="text-slate-500 text-sm mt-1">Ini adalah ringkasan data showroom Anda hari ini.</p>
</div>

<!-- 4 Kotak Statistik -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4 hover:shadow-md transition-shadow">
        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
            <!-- Ikon Motor/Data -->
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Total Motor</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $totalMotor }}</h3>
        </div>
    </div>
    
    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4 hover:shadow-md transition-shadow">
        <div class="p-3 bg-green-50 text-green-600 rounded-xl">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Motor Tayang</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $motorTayang }}</h3>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4 hover:shadow-md transition-shadow">
        <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Menunggu Spek</p>
            <h3 class="text-2xl font-bold text-slate-800">0</h3>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4 hover:shadow-md transition-shadow">
        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">Kriteria SAW</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $totalKriteria }}</h3>
        </div>
    </div>
</div>

<!-- Tabel Data Singkat -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800">Data Motor Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Foto</th>
                    <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Merk / Tipe</th>
                    <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Tahun</th>
                    <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Harga (Rp)</th>
                    <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($motors as $motor)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ route('tampil.foto', $motor->foto) }}" alt="Foto" class="w-20 h-14 object-cover rounded-lg border border-slate-200 shadow-sm">
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $motor->merk_tipe }}</td>
                    <td class="px-6 py-4">{{ $motor->tahun_kendaraan }}</td>
                    <td class="px-6 py-4 font-bold text-blue-600">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($motor->status_tayang)
                            <span class="px-3 py-1.5 text-xs font-bold bg-green-100 text-green-700 rounded-lg">Tayang</span>
                        @else
                            <span class="px-3 py-1.5 text-xs font-bold bg-slate-100 text-slate-600 rounded-lg">Sembunyi</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada data motor terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection