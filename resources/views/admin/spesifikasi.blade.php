@extends('layouts.admin')

@section('title', 'Detail Spesifikasi - Cepi Anugerah Motor')

@section('content')
<div class="mb-6">
    <h2 class="text-xl md:text-2xl font-bold text-slate-800">Detail Spesifikasi Motor</h2>
    <p class="text-sm text-slate-500 mt-1">Pantau dan kelola rincian kondisi serta kelengkapan dokumen motor.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-4 font-semibold uppercase text-xs whitespace-nowrap">Merk / Tipe</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs whitespace-nowrap">Kondisi Fisik</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs whitespace-nowrap">Dokumen</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs w-2/5">Spesifikasi Tambahan</th>
                    <th class="px-5 py-4 font-semibold uppercase text-xs text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($motors as $motor)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-5 py-4 whitespace-nowrap">
                        <p class="font-semibold text-slate-800">{{ $motor->merk_tipe }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">Tahun: {{ $motor->tahun_kendaraan }}</p>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                            {{ $motor->kondisi_kendaraan }}
                        </span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                            {{ $motor->kelengkapan_dokumen }}
                        </span>
                    </td>
                    <td class="px-5 py-4 whitespace-normal text-xs leading-relaxed text-slate-500">
                        {{ $motor->detail_spesifikasi ?? 'Tidak ada spesifikasi tambahan.' }}
                    </td>
                    <td class="px-5 py-4 text-center whitespace-nowrap">
                        <a href="{{ route('admin.motor.edit', $motor->id) }}" class="inline-block px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold rounded transition-colors">Edit Spek</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-slate-500">Belum ada data spesifikasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection