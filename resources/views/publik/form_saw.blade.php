<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Fitur Rekomendasi Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Cari Motor Idaman Anda (Metode SAW)</h4>
                </div>
                <div class="card-body p-4">
                    <p class="text-center text-muted mb-4">Tentukan tingkat kepentingan (bobot) untuk masing-masing kriteria. Skala 1 (Tidak Penting) hingga 5 (Sangat Penting).</p>
                    
                    <form action="{{ route('hitung.saw') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tingkat Kepentingan HARGA (Cost)</label>
                            <input type="range" class="form-range" name="bobot_harga" min="1" max="5" value="5">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tingkat Kepentingan TAHUN KENDARAAN (Benefit)</label>
                            <input type="range" class="form-range" name="bobot_tahun" min="1" max="5" value="4">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tingkat Kepentingan JARAK TEMPUH/KILOMETER (Cost)</label>
                            <input type="range" class="form-range" name="bobot_kilometer" min="1" max="5" value="3">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tingkat Kepentingan KONDISI FISIK (Benefit)</label>
                            <input type="range" class="form-range" name="bobot_kondisi" min="1" max="5" value="5">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Tingkat Kepentingan KELENGKAPAN DOKUMEN (Benefit)</label>
                            <input type="range" class="form-range" name="bobot_dokumen" min="1" max="5" value="5">
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 btn-lg">Cari Rekomendasi Sekarang</button>
                        <a href="{{ route('katalog') }}" class="btn btn-link w-100 mt-2 text-decoration-none">Batal, kembali ke katalog</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>