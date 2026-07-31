<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Cepi Anugerah Motor</title>
    <!-- Kita pakai Bootstrap CDN agar tampilannya rapi seperti Figma tanpa pusing CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('katalog') }}">Cepi Anugerah Motor</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('katalog') }}">Katalog Motor</a>
            <a class="nav-link text-warning" href="{{ route('form.saw') }}">Fitur Rekomendasi SAW</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="p-4 mb-4 bg-primary text-white rounded">
        <h2>Selamat Datang di Showroom Cepi Anugerah Motor!</h2>
        <p>Motor Bekas Berkualitas. Temukan motor idaman Anda di sini.</p>
    </div>

    <div class="row">
        @forelse($motors as $motor)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <!-- Memanggil route 'tampil.foto' untuk akses gambar aman -->
                <img src="{{ route('tampil.foto', $motor->foto) }}" class="card-img-top" alt="Foto Motor" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $motor->merk_tipe }}</h5>
                    <p class="card-text text-danger fw-bold">Rp {{ number_format($motor->harga, 0, ',', '.') }}</p>
                    <p class="card-text"><small class="text-muted">Tahun: {{ $motor->tahun_kendaraan }}</small></p>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('detail.motor', $motor->id) }}" class="btn btn-primary w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>Belum ada motor yang ditambahkan ke katalog.</p>
        </div>
        @endforelse
    </div>
</div>

</body>
</html>