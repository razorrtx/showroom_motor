@extends('layouts.admin')

@section('title', 'Detail Spesifikasi - Cepi Anugerah Motor')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-slate-800">Detail Spesifikasi Motor</h2>
        <p class="text-sm text-slate-500 mt-1">Pantau dan kelola rincian spesifikasi tambahan motor.</p>
    </div>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

<div class="flex flex-col lg:flex-row gap-6 items-start">
    
    <!-- Kolom Kiri: Daftar Card Motor -->
    <div class="w-full lg:w-1/2 flex flex-col gap-4">
        @forelse($motors as $motor)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-slate-800">{{ $motor->merk_tipe }}</h3>
                <p class="text-sm text-slate-500">Tahun {{ $motor->tahun_kendaraan }}</p>
            </div>
            <div class="flex justify-between items-center mt-2">
                <!-- Badge Penanda -->
                @if(empty($motor->detail_spesifikasi) || $motor->detail_spesifikasi == '-')
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700 border border-amber-200">
                        Belum Lengkap
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 border border-emerald-200">
                        Sudah Lengkap
                    </span>
                @endif
                
                <a href="{{ route('admin.spesifikasi.index', ['id' => $motor->id]) }}" class="inline-flex items-center px-4 py-1.5 bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-700 text-sm font-semibold rounded-lg border border-slate-200 transition-colors">
                    Pilih Motor
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-10 bg-white border border-slate-200 rounded-xl text-slate-500 shadow-sm">
            Belum ada data motor.
        </div>
        @endforelse
    </div>

    <!-- Kolom Kanan: Form Textarea -->
    <div class="w-full lg:w-1/2 bg-white rounded-xl shadow-sm border border-slate-200 p-6 lg:p-8 sticky top-6">
        @php
            $selectedMotor = null;
            if(request()->has('id')) {
                $selectedMotor = $motors->firstWhere('id', request('id'));
            }
        @endphp

        @if($selectedMotor)
            <div class="mb-6 border-b border-slate-100 pb-4">
                <h3 class="text-lg font-bold text-slate-800">Input Spesifikasi:</h3>
                <p class="text-blue-600 font-medium">{{ $selectedMotor->merk_tipe }} ({{ $selectedMotor->tahun_kendaraan }})</p>
            </div>

            <form action="{{ route('admin.motor.update', $selectedMotor->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Data hidden agar saat save tidak ke-reset DB nya -->
                <input type="hidden" name="merk_tipe" value="{{ $selectedMotor->merk_tipe }}">
                <input type="hidden" name="harga" value="{{ $selectedMotor->harga }}">
                <input type="hidden" name="tahun_kendaraan" value="{{ $selectedMotor->tahun_kendaraan }}">
                <input type="hidden" name="kilometer" value="{{ $selectedMotor->kilometer }}">
                <input type="hidden" name="kondisi_kendaraan" value="{{ $selectedMotor->kondisi_kendaraan }}">
                <input type="hidden" name="kelengkapan_dokumen" value="{{ $selectedMotor->kelengkapan_dokumen }}">

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Detail Spesifikasi Tambahan</label>
                    <textarea name="detail_spesifikasi" maxlength="1000" rows="10" placeholder="Tuliskan kelengkapan, minus, atau info tambahan di sini." class="w-full p-4 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-slate-700 resize-none transition-all">{{ $selectedMotor->detail_spesifikasi }}</textarea>
                </div>
                
                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('admin.spesifikasi.index') }}" class="px-5 py-2.5 border border-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-50 text-slate-700 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold shadow-sm transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Spesifikasi
                    </button>
                </div>
            </form>
        @else
            <!-- Tampilan Kanan Saat Belum Memilih Motor -->
            <div class="h-64 flex flex-col items-center justify-center text-slate-400">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <p class="text-sm font-medium text-slate-500">Pilih motor di sebelah kiri</p>
                <p class="text-xs mt-1">untuk mulai mengisi spesifikasi.</p>
            </div>
        @endif
    </div>

</div>
@endsection