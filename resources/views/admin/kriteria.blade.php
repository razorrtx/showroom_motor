<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Bobot Kriteria - Cepi Anugerah Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Panel Admin Showroom</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">Halo, {{ Auth::user()->username }}!</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="m-0 fw-bold">Kelola Bobot Kriteria SAW</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Sesuaikan bobot tingkat kepentingan untuk masing-masing kriteria. Perubahan ini akan mempengaruhi algoritma rekomendasi pada halaman calon pembeli.</p>

                    <form action="{{ route('admin.kriteria.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Nama Kriteria</th>
                                        <th>Sifat Kriteria</th>
                                        <th width="30%">Nilai Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kriteria as $item)
                                    <tr>
                                        <td class="fw-bold">{{ $item->nama_kriteria }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $item->jenis_kriteria == 'Benefit' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $item->jenis_kriteria }}
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Input dinamis berdasarkan ID Kriteria -->
                                            <input type="number" step="0.1" min="1" max="10" class="form-control text-center" name="bobot_{{ $item->id }}" value="{{ $item->bobot }}" required>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                            <button type="submit" class="btn btn-primary fw-bold">Simpan Perubahan Bobot</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>