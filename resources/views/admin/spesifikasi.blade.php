@extends('layouts.admin')

@section('title', 'Detail Spesifikasi - Cepi Anugerah Motor')

@section('content')

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="m-0 fw-bold text-primary">Kelola Detail Spesifikasi Motor</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Merk / Tipe</th>
                            <th>Kondisi Fisik</th>
                            <th>Kelengkapan Dokumen</th>
                            <th width="35%">Detail Spesifikasi Tambahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($motors as $index => $motor)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $motor->merk_tipe }} <br> <small class="text-muted">{{ $motor->tahun_kendaraan }}</small></td>
                            <td class="text-center">{{ $motor->kondisi_kendaraan }}</td>
                            <td class="text-center">{{ $motor->kelengkapan_dokumen }}</td>
                            <td><small>{{ $motor->detail_spesifikasi }}</small></td>
                            <td class="text-center">
                                <a href="{{ route('admin.motor.edit', $motor->id) }}" class="btn btn-sm btn-warning">Edit Spesifikasi</a>
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