@extends('layouts.admin')

@section('title', 'Data Kendaraan - Cepi Anugerah Motor')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-slate-800">Kelola Data Kendaraan</h2>
        <p class="text-sm text-slate-500 mt-1">Tambah, ubah, atau hapus data motor yang ada di showroom.</p>
    </div>
    <a href="{{ route('admin.motor.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Motor Baru
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600 whitespace-nowrap">
            <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase text-xs">No</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs">Foto</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs">Merk / Tipe</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs">Tahun</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs">Harga</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($motors as $index => $motor)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-5 py-4">{{ $index + 1 }}</td>
                    <td class="px-5 py-4">
                        <img src="{{ route('tampil.foto', $motor->foto) }}" class="w-20 h-14 object-cover rounded shadow-sm border border-slate-200">
                    </td>
                    <td class="px-5 py-4 font-semibold text-slate-800">{{ $motor->merk_tipe }}</td>
                    <td class="px-5 py-4">{{ $motor->tahun_kendaraan }}</td>
                    <td class="px-5 py-4 font-bold text-slate-700">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                    <td class="px-5 py-4">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.motor.edit', $motor->id) }}" class="px-3 py-1.5 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-xs font-semibold rounded transition-colors">Edit</a>
                            <form action="{{ route('admin.motor.destroy', $motor->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data motor ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-semibold rounded transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-slate-500">Belum ada data kendaraan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection