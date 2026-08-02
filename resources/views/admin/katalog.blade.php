@extends('layouts.admin')

@section('title', 'Kelola Katalog - Cepi Anugerah Motor')

@section('content')
<div class="mb-6">
    <h2 class="text-xl md:text-2xl font-bold text-slate-800">Kelola Katalog Publik</h2>
    <p class="text-sm text-slate-500 mt-1">Atur motor mana saja yang akan ditampilkan ke calon pembeli di halaman depan.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600 whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase text-xs">Foto</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs">Detail Motor</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs text-center">Status Saat Ini</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs text-center">Aksi Tampilan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($motors as $motor)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-5 py-4 w-24">
                        <img src="{{ route('tampil.foto', $motor->foto) }}" class="w-20 h-14 object-cover rounded shadow-sm border border-slate-200">
                    </td>
                    <td class="px-5 py-4">
                        <p class="font-bold text-slate-800 text-base">{{ $motor->merk_tipe }}</p>
                        <p class="text-blue-600 font-medium mt-0.5">Rp {{ number_format($motor->harga, 0, ',', '.') }}</p>
                    </td>
                    <td class="px-5 py-4 text-center">
                        @if($motor->status_tayang)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span> Tayang
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">
                                <span class="w-2 h-2 mr-1.5 bg-slate-400 rounded-full"></span> Disembunyikan
                            </span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-center">
                        <form action="{{ route('admin.motor.toggle', $motor->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if($motor->status_tayang)
                                <button type="submit" class="px-4 py-2 border border-slate-300 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition-colors">
                                    Sembunyikan
                                </button>
                            @else
                                <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg text-xs font-semibold shadow-sm transition-colors">
                                    Tampilkan ke Katalog
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-10 text-center text-slate-500">Belum ada data motor di katalog.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection