@extends('layouts.admin')

@section('title', 'Bobot Kriteria SAW - Cepi Anugerah Motor')

@section('content')
<div class="mb-6">
    <h2 class="text-xl md:text-2xl font-bold text-slate-800">Bobot Kriteria SAW</h2>
    <p class="text-sm text-slate-500 mt-1">Sesuaikan nilai bobot untuk setiap kriteria. Total bobot biasanya bernilai 1 atau 100%.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <!-- Form Update Bobot -->
    <form action="{{ route('admin.kriteria.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-4 font-semibold uppercase text-xs w-16">No</th>
                        <th class="px-5 py-4 font-semibold uppercase text-xs">Nama Kriteria</th>
                        <th class="px-5 py-4 font-semibold uppercase text-xs text-center">Sifat (Benefit/Cost)</th>
                        <th class="px-5 py-4 font-semibold uppercase text-xs text-center">Bobot Nilai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kriteria as $index => $item)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-5 py-4 text-slate-500 font-medium">{{ $index + 1 }}</td>
                        <td class="px-5 py-4 font-bold text-slate-800">{{ $item->nama_kriteria }}</td>
                        <td class="px-5 py-4 text-center">
                            @if(strtolower($item->jenis_kriteria) == 'benefit')
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-emerald-100 text-emerald-700">
                                    Benefit
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-orange-100 text-orange-700">
                                    Cost
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            <!-- Input Hidden untuk ID Kriteria -->
                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                            
                            <!-- Input Number untuk mengubah Bobot -->
                            <input type="number" step="0.01" min="0" name="bobot[]" value="{{ $item->bobot }}" 
                                class="w-24 px-3 py-2 text-center border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all font-semibold text-blue-700 bg-slate-50 hover:bg-white" required>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-slate-500">Belum ada data kriteria SAW di database.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Bagian Footer Tabel untuk Tombol Simpan -->
        @if(count($kriteria) > 0)
        <div class="px-5 py-4 border-t border-slate-200 bg-slate-50 flex justify-end">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Simpan Perubahan
            </button>
        </div>
        @endif
    </form>
</div>
@endsection