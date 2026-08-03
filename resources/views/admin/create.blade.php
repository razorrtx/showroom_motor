<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Motor - Cepi Anugerah Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0">Tambah Data Kendaraan Baru</h5>
                </div>
                <div class="card-body">
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.motor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Unggah Foto Motor (JPG/PNG, Max 2MB)</label>
                            <input type="file" class="form-control" name="foto" accept="image/png, image/jpeg" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Merk & Tipe Motor</label>
                                <input type="text" class="form-control" name="merk_tipe" value="{{ old('merk_tipe') }}" placeholder="Contoh: Honda Beat Street" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Kendaraan</label>
                                <input type="number" class="form-control" name="tahun_kendaraan" value="{{ old('tahun_kendaraan') }}" placeholder="Contoh: 2021" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 15500000" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kilometer (Jarak Tempuh)</label>
                                <input type="number" class="form-control" name="kilometer" value="{{ old('kilometer') }}" placeholder="Contoh: 25000" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kondisi Kendaraan</label>
                                <select class="form-select" name="kondisi_kendaraan" required>
                                    <option value="" disabled selected>Pilih Kondisi</option>
                                    <option value="Sangat Bagus" {{ old('kondisi_kendaraan') == 'Sangat Bagus' ? 'selected' : '' }}>Sangat Bagus</option>
                                    <option value="Bagus" {{ old('kondisi_kendaraan') == 'Bagus' ? 'selected' : '' }}>Bagus</option>
                                    <option value="Cukup Bagus" {{ old('kondisi_kendaraan') == 'Cukup Bagus' ? 'selected' : '' }}>Cukup Bagus</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kelengkapan Dokumen</label>
                                <select class="form-select" name="kelengkapan_dokumen" required>
                                    <option value="" disabled selected>Pilih Kelengkapan</option>
                                    <option value="BPKB & STNK Lengkap" {{ old('kelengkapan_dokumen') == 'BPKB & STNK Lengkap' ? 'selected' : '' }}>BPKB & STNK Lengkap</option>
                                    <option value="Hanya BPKB" {{ old('kelengkapan_dokumen') == 'Hanya BPKB' ? 'selected' : '' }}>Hanya BPKB</option>
                                    <option value="Hanya STNK" {{ old('kelengkapan_dokumen') == 'Hanya STNK' ? 'selected' : '' }}>Hanya STNK</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Data Motor</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>