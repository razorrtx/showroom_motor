<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Motor - Cepi Anugerah Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="m-0">Edit Data: {{ $motor->merk_tipe }}</h5>
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

                    <form action="{{ route('admin.motor.update', $motor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Bagian Foto Saat Ini (Sudah dirapikan) -->
                        <div class="mb-4 text-center">
                            <label class="form-label fw-bold text-muted mb-2">Foto Saat Ini</label>
                            <div class="mx-auto border rounded bg-white shadow-sm" style="width: 240px; height: 160px; overflow: hidden;">
                                @if($motor->foto)
                                    <img src="{{ asset('foto_motor/' . $motor->foto) }}" alt="Foto Motor" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                        Tidak ada foto
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Ganti Foto Motor (Opsional)</label>
                            <input type="file" class="form-control" name="foto" accept="image/png, image/jpeg, image/jpg">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Merk & Tipe Motor</label>
                                <input type="text" class="form-control" name="merk_tipe" value="{{ old('merk_tipe', $motor->merk_tipe) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Kendaraan</label>
                                <input type="number" class="form-control" name="tahun_kendaraan" value="{{ old('tahun_kendaraan', $motor->tahun_kendaraan) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" name="harga" value="{{ old('harga', $motor->harga) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kilometer (Jarak Tempuh)</label>
                                <input type="number" class="form-control" name="kilometer" value="{{ old('kilometer', $motor->kilometer) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kondisi Kendaraan</label>
                                <select class="form-select" name="kondisi_kendaraan" required>
                                    <option value="Sangat Bagus" {{ old('kondisi_kendaraan', $motor->kondisi_kendaraan) == 'Sangat Bagus' ? 'selected' : '' }}>Sangat Bagus</option>
                                    <option value="Bagus" {{ old('kondisi_kendaraan', $motor->kondisi_kendaraan) == 'Bagus' ? 'selected' : '' }}>Bagus</option>
                                    <option value="Cukup Bagus" {{ old('kondisi_kendaraan', $motor->kondisi_kendaraan) == 'Cukup Bagus' ? 'selected' : '' }}>Cukup Bagus</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kelengkapan Dokumen</label>
                                <select class="form-select" name="kelengkapan_dokumen" required>
                                    <option value="BPKB & STNK Lengkap" {{ old('kelengkapan_dokumen', $motor->kelengkapan_dokumen) == 'BPKB & STNK Lengkap' ? 'selected' : '' }}>BPKB & STNK Lengkap</option>
                                    <option value="Hanya BPKB" {{ old('kelengkapan_dokumen', $motor->kelengkapan_dokumen) == 'Hanya BPKB' ? 'selected' : '' }}>Hanya BPKB</option>
                                    <option value="Hanya STNK" {{ old('kelengkapan_dokumen', $motor->kelengkapan_dokumen) == 'Hanya STNK' ? 'selected' : '' }}>Hanya STNK</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-warning fw-bold px-4">Update Data Motor</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>