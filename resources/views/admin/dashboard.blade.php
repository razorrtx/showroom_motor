<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Cepi Anugerah Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar Admin -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#">Panel Admin Showroom</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">Halo, {{ Auth::user()->username }}!</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid px-4">
    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistik Card -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Motor</h5>
                    <h2>{{ $totalMotor }} Unit</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Motor Tayang (Katalog)</h5>
                    <h2>{{ $motorTayang }} Unit</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Kriteria SAW Aktif</h5>
                    <h2>{{ $totalKriteria }} Kriteria</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Motor -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Kelola Data Motor</h5>
            <!-- Tombol Tambah Data -->
            <a href="{{ route('admin.motor.create') }}" class="btn btn-primary btn-sm">+ Tambah Motor Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Merk & Tipe</th>
                            <th>Tahun</th>
                            <th>Harga (Rp)</th>
                            <th>Status Katalog</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($motors as $index => $motor)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                <img src="{{ route('tampil.foto', $motor->foto) }}" alt="Foto" style="width: 80px; height: 60px; object-fit: cover;" class="rounded">
                            </td>
                            <td>{{ $motor->merk_tipe }}</td>
                            <td class="text-center">{{ $motor->tahun_kendaraan }}</td>
                            <td>{{ number_format($motor->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <!-- Tombol Toggle Status Tayang -->
                                <form action="{{ route('admin.motor.toggle', $motor->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($motor->status_tayang)
                                        <button type="submit" class="btn btn-sm btn-success">Tayang</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-secondary">Disembunyikan</button>
                                    @endif
                                </form>
                            </td>
                            <td class="text-center">
                                <!-- Tombol Edit & Hapus -->
                                <a href="{{ route('admin.motor.edit', $motor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                
                                <form action="{{ route('admin.motor.destroy', $motor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data motor ini? Foto juga akan terhapus permanen.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data motor yang ditambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>