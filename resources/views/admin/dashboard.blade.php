@extends('layouts.admin')

@section('title', 'Dashboard - Cepi Anugerah Motor')

@section('content')
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card bg-light border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-0">Selamat Datang di Dashboard Admin</h5>
        </div>
    </div>

    <!-- 4 Kotak Statistik Sesuai Mockup -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Motor</p>
                    <h3 class="fw-bold">{{ $totalMotor }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Motor Tayang</p>
                    <h3 class="fw-bold">{{ $motorTayang }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Menunggu Spesifikasi</p>
                    <h3 class="fw-bold">0</h3> <!-- Sementara diset 0 karena di sistem kita input spesifikasi bersifat wajib -->
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Kriteria SAW Aktif</p>
                    <h3 class="fw-bold">{{ $totalKriteria }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Motor Sesuai Mockup -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold">Data Motor Terbaru</h6>
            <a href="{{ route('admin.motor.create') }}" class="btn btn-primary btn-sm">+ Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Merk / Tipe</th>
                            <th>Tahun</th>
                            <th>Harga (Rp)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($motors as $index => $motor)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                <img src="{{ route('tampil.foto', $motor->foto) }}" alt="Foto" style="width: 80px; height: 60px; object-fit: cover;" class="rounded border">
                            </td>
                            <td class="fw-bold text-primary">{{ $motor->merk_tipe }}</td>
                            <td class="text-center">{{ $motor->tahun_kendaraan }}</td>
                            <td class="text-end">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.motor.toggle', $motor->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($motor->status_tayang)
                                        <button type="submit" class="btn btn-sm btn-outline-success">Tayang</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Disembunyikan</button>
                                    @endif
                                </form>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.motor.edit', $motor->id) }}" class="btn btn-sm btn-warning">Edit Detail</a>
                                <form action="{{ route('admin.motor.destroy', $motor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus motor ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data motor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection