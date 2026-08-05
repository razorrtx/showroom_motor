@extends('layouts.publik')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-5xl">
    
    <!-- Header Halaman -->
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Hasil Rekomendasi Untuk Anda</h1>
        <p class="text-lg text-gray-600">Berikut adalah urutan motor bekas yang paling sesuai dengan preferensi Anda berdasarkan algoritma SAW.</p>
    </div>

    <!-- AREA HASIL REKOMENDASI DINAMIS -->
    @if(isset($hasilRekomendasi) && count($hasilRekomendasi) > 0)
        <div class="space-y-6">
            @foreach($hasilRekomendasi as $index => $item)
                @php $motor = $item['motor']; @endphp
                
                <div class="flex flex-col md:flex-row bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                    
                    <!-- Kiri: Bagian Gambar & Label Peringkat -->
                    <div class="relative w-full md:w-1/3 h-56 md:h-auto bg-gray-100 shrink-0">
                        <!-- Badge Peringkat (Warna kuning untuk Peringkat 1, abu-abu untuk sisanya) -->
                        <div class="absolute top-4 left-0 {{ $index == 0 ? 'bg-yellow-400 text-yellow-900' : 'bg-gray-200 text-gray-700' }} font-bold px-4 py-1 text-sm rounded-r-lg z-10 shadow-sm">
                            Peringkat {{ $index + 1 }} {{ $index == 0 ? '- Paling Sesuai' : '' }}
                        </div>
                        
                        <!-- Wrapper Foto Presisi -->
                        <div class="w-full h-full overflow-hidden relative">
                            <img src="{{ asset('foto_motor/' . $motor->foto) }}" alt="{{ $motor->merk }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        </div>
                    </div>

                    <!-- Kanan: Bagian Informasi Motor -->
                    <div class="p-6 w-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-1">{{ $motor->merk }}</h3>
                            <p class="text-2xl font-bold text-blue-600 mb-4">Rp {{ number_format($motor->harga, 0, ',', '.') }}</p>

                            <div class="text-sm text-gray-600 mb-2">
                                <span class="font-semibold text-gray-800">Spesifikasi Singkat:</span><br>
                                {{ $motor->tahun_kendaraan }} | {{ number_format($motor->kilometer, 0, ',', '.') }} km | {{ $motor->kelengkapan_dokumen }}
                            </div>
                            
                            <!-- Skor Algoritma SAW -->
                            <div class="text-sm font-medium mb-4 {{ $index == 0 ? 'text-green-600' : 'text-gray-500' }}">
                                Skor Kecocokan Algoritma SAW: {{ number_format($item['nilai_akhir'], 4) }}
                            </div>
                        </div>

                        <a href="{{ url('/motor/' . $motor->id) }}" class="inline-block text-center w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors mt-4 md:mt-0">
                            Lihat Detail
                        </a>
                    </div>
                    
                </div>
            @endforeach
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-10 text-center">
            <a href="{{ url('/rekomendasi') }}" class="text-blue-600 hover:text-blue-800 font-medium underline">
                &larr; Sesuaikan Ulang Preferensi Pencarian
            </a>
        </div>

    @else
        <!-- Tampilan Default Jika Belum Melakukan Pencarian atau Data Kosong -->
        <div class="text-center p-12 bg-white border border-gray-200 shadow-sm rounded-xl mt-8">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Hasil Rekomendasi</h3>
            <p class="text-gray-500 mb-6">Silakan atur preferensi kriteria Anda terlebih dahulu atau belum ada motor yang memenuhi syarat pencarian Anda.</p>
            <a href="{{ url('/rekomendasi') }}" class="inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                Kembali ke Form Pencarian
            </a>
        </div>
    @endif

</div>
@endsection