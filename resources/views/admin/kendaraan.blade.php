@extends('layouts.admin')

@section('title', 'Data Kendaraan - Cepi Anugerah Motor')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold text-primary">Kelola Data Kendaraan</h5>
            <!-- Tombol Tambah Data dipindah ke sini -->
            <a href="{{ route('admin.motor.create') }}" class="btn btn-primary">+ Tambah Motor Baru</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Merk / Tipe</th>
                            <th>Tahun</th>
                            <th>Harga (Rp)</th>
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
                            <td class="fw-bold">{{ $motor->merk_tipe }}</td>
                            <td class="text-center">{{ $motor->tahun_kendaraan }}</td>
                            <td class="text-end">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.motor.edit', $motor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.motor.destroy', $motor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data motor ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data motor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection