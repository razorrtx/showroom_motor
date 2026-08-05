@extends('layouts.publik')

@section('title', 'Detail Motor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    
    <div class="mb-6">
    <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
        &larr; Kembali ke Katalog</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">
        <!-- Kolom Kiri: Foto-foto -->
        <div class="flex flex-col gap-4">
            <!-- Foto Utama -->
            <div class="w-full h-64 md:h-112.5 overflow-hidden rounded-2xl shadow-md border border-gray-100 bg-gray-50">
                <img src="{{ asset('foto_motor/' . $motor->foto) }}" alt="{{ $motor->merk }}" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Kolom Kanan: Detail Motor -->
        <div class="flex flex-col">
            <h1 class="text-2xl md:text-3xl font-bold text-black mb-2">{{ $motor->merk_tipe ?? 'Honda Beat Street 2021' }}</h1>
            <p class="text-2xl md:text-3xl font-bold text-black mb-6">Rp. {{ number_format($motor->harga ?? 15500000, 0, '.', '.') }}</p>

            <!-- Tabel Spesifikasi Asli seperti Mockup -->
            <table class="w-full text-left text-lg text-black border-collapse border border-black mb-8">
                <tbody>
                    <tr>
                        <td class="border border-black px-4 py-3 w-1/3">Tahun</td>
                        <td class="border border-black px-4 py-3">{{ $motor->tahun_kendaraan ?? '2021' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-3">Kilometer</td>
                        <td class="border border-black px-4 py-3">{{ $motor->kilometer ?? '15.000 km' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-3">Kondisi</td>
                        <td class="border border-black px-4 py-3">{{ $motor->kondisi_kendaraan ?? 'Mulus' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-3">Dokumen</td>
                        <td class="border border-black px-4 py-3 text-sm md:text-lg">{{ $motor->kelengkapan_dokumen ?? 'BPKB & STNK Lengkap' }}</td>
                    </tr>
                    <tr>
                        <td class="border border-black px-4 py-3">Detail Spesifikasi</td>
                        <td class="border border-black px-4 py-3 text-sm md:text-lg">{{ $motor->detail_spesifikasi ?? 'Detail spesifikasi tidak tersedia' }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Tombol WA -->
            <a href="https://wa.me/6282318413915" target="_blank" class="w-full bg-[#1CD02B] hover:bg-green-600 text-white font-bold text-lg py-4 rounded-lg flex items-center justify-center transition-colors">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.022-.967-.264-.099-.456-.149-.648.149-.192.297-.768.967-.942 1.165-.174.198-.348.223-.645.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.645-1.556-.883-2.131-.233-.561-.469-.485-.645-.494-.17-.008-.368-.01-.563-.01-.195 0-.51.074-.777.372-.267.297-1.02.991-1.02 2.418s1.045 2.809 1.192 3.007c.149.198 2.052 3.136 4.968 4.398 2.916 1.263 2.916.843 3.461.843.545 0 1.758-.718 2.006-1.411.248-.694.248-1.288.174-1.411-.074-.124-.272-.198-.57-.347z"/><path d="M12 2.004c-5.523 0-10 4.477-10 10 0 1.748.455 3.395 1.256 4.84L2 22l5.313-1.233C8.71 21.55 10.3 22.004 12 22.004c5.523 0 10-4.477 10-10s-4.477-10-10-10zm0 18.332c-1.53 0-3.004-.396-4.301-1.127l-.308-.182-3.197.742.753-3.11-.2-.319A8.324 8.324 0 013.667 12c0-4.6 3.738-8.333 8.333-8.333 4.6 0 8.333 3.733 8.333 8.333s-3.733 8.333-8.333 8.333z"/></svg>
                Hubungi via WhatsApp
            </a>
        </div>
    </div>

</div>
@endsection