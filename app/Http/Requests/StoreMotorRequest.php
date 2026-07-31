<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMotorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Izinkan proses validasi
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Validasi file foto: wajib diisi, harus berupa gambar jpeg/jpg/png, maksimal 2MB
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'merk_tipe' => 'required|string|max:255',
            'tahun_kendaraan' => 'required|integer|min:1990|max:' . date('Y'),
            'harga' => 'required|numeric|min:0',
            'kilometer' => 'required|integer|min:0',
            'kondisi_kendaraan' => 'required|in:Sangat Bagus,Bagus,Normal,Kurang,Buruk',
            'kelengkapan_dokumen' => 'required|in:BPKB & STNK Lengkap,Hanya BPKB,Hanya STNK,Tanpa Surat',
            'detail_spesifikasi' => 'required|string'
        ];
    }
}
