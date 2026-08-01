@extends('layouts.admin')

@section('title', 'Kelola Katalog - Cepi Anugerah Motor')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="m-0 fw-bold text-primary">Kelola Tampilan Katalog Publik</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Merk / Tipe</th>
                            <th>Harga (Rp)</th>
                            <th>Status Saat Ini</th>
                            <th>Aksi Tampilan</th>
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
                            <td class="text-end">Rp {{ number_format($motor->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($motor->status_tayang)
                                    <span class="badge bg-success">Sedang Tayang</span>
                                @else
                                    <span class="badge bg-secondary">Disembunyikan</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <!-- Tombol Toggle Status Tayang -->
                                <form action="{{ route('admin.motor.toggle', $motor->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($motor->status_tayang)
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Sembunyikan dari Katalog</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-success">Tampilkan ke Katalog</button>
                                    @endif
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