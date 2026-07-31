<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Rekomendasi SAW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Hasil Rekomendasi Motor (Metode SAW)</h2>
    <div class="alert alert-success text-center">
        Berikut adalah urutan motor yang paling sesuai dengan kriteria dan preferensi Anda.
    </div>

    <div class="row mt-4">
        @foreach($hasilRekomendasi as $index => $hasil)
        <div class="col-md-4 mb-4">
            <div class="card border-{{ $index == 0 ? 'success border-3' : 'secondary' }}">
                @if($index == 0)
                    <div class="card-header bg-success text-white text-center fw-bold">⭐ REKOMENDASI TERBAIK ⭐</div>
                @else
                    <div class="card-header text-center">Peringkat {{ $index + 1 }}</div>
                @endif
                
                <img src="{{ route('tampil.foto', $hasil['motor']->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $hasil['motor']->merk_tipe }}</h5>
                    <p class="mb-1 text-danger fw-bold">Rp {{ number_format($hasil['motor']->harga, 0, ',', '.') }}</p>
                    <p class="mb-1"><strong>Nilai Preferensi:</strong> {{ round($hasil['nilai_akhir'], 3) }}</p>
                </div>
                <div class="card-footer bg-white text-center">
                    <a href="{{ route('detail.motor', $hasil['motor']->id) }}" class="btn btn-outline-primary w-100">Cek Detail Motor</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="text-center mt-4 mb-5">
        <a href="{{ route('katalog') }}" class="btn btn-secondary">Kembali ke Katalog Utama</a>
    </div>
</div>

</body>
</html>