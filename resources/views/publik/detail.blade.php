<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ route('tampil.foto', $motor->foto) }}" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="Foto Motor">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h2 class="card-title">{{ $motor->merk_tipe }}</h2>
                    <h4 class="text-danger fw-bold mb-4">Rp {{ number_format($motor->harga, 0, ',', '.') }}</h4>
                    
                    <table class="table table-sm">
                        <tr><td width="40%">Tahun Kendaraan</td><td>: {{ $motor->tahun_kendaraan }}</td></tr>
                        <tr><td>Kilometer</td><td>: {{ number_format($motor->kilometer, 0, ',', '.') }} km</td></tr>
                        <tr><td>Kondisi</td><td>: {{ $motor->kondisi_kendaraan }}</td></tr>
                        <tr><td>Dokumen</td><td>: {{ $motor->kelengkapan_dokumen }}</td></tr>
                    </table>

                    <div class="mt-4">
                        <h5>Detail Spesifikasi:</h5>
                        <p class="text-muted">{{ $motor->detail_spesifikasi }}</p>
                    </div>

                    <!-- Tombol URL Redirect langsung ke WhatsApp -->
                    <a href="{{ $linkWA }}" target="_blank" class="btn btn-success btn-lg mt-3 w-100">
                        💬 Hubungi via WhatsApp
                    </a>
                    
                    <a href="{{ route('katalog') }}" class="btn btn-outline-secondary mt-2 w-100">Kembali ke Katalog</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>