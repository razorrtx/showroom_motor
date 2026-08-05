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
                    <th class="px-4 py-3 font-semibold text-black">No</th>
                    <th class="px-4 py-3 font-semibold text-black">Foto</th>
                    <th class="px-4 py-3 font-semibold text-black text-left">Merk/tipe</th>
                    <th class="px-4 py-3 font-semibold text-black">Tahun</th>
                    <th class="px-4 py-3 font-semibold text-black">Harga (RP)</th>
                    <th class="px-4 py-3 font-semibold text-black">Status Tayang</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($motors as $motor)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">
                        <img src="{{ asset('foto_motor/' . $motor->foto) }}" class="w-20 h-14 object-cover rounded shadow-sm border border-slate-200">
                    </td>
                    <td class="px-4 py-3 text-left">{{ $motor->merk_tipe }}</td>
                    <td class="px-4 py-3">{{ $motor->tahun_kendaraan }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.motor.toggle', $motor->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" onChange="this.form.submit()" class="sr-only peer" {{ $motor->status_tayang ? 'checked' : '' }}>
                                <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-green-500"></div>
                            </label>
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