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
            // Validasi file foto: wajib diisi, harus berupa gambar jpeg/jpg/png, maksimal 5MB
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'merk_tipe' => 'required|string|max:255',
            'tahun_kendaraan' => 'required|integer|digits:4|min:2000|max:' . (date('Y')+1), // Tahun kendaraan minimal 2000 dan maksimal tahun sekarang + 1
            'harga' => 'required|numeric|min:1000000|max:500000000', //min 1 juta, max 500 juta
            'kilometer' => 'required|integer|min:0|max:999999',
            'kondisi_kendaraan' => 'required|in:Sangat Bagus,Bagus, Cukup Bagus',
            'kelengkapan_dokumen' => 'required|in:BPKB & STNK Lengkap,Hanya BPKB,Hanya STNK',
            'detail_spesifikasi' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran gambar maksimal 5MB.',
            'harga.min' => 'Harga tidak boleh kurang dari Rp 1.000.000.',
            'tahun_kendaraan.digits' => 'Tahun harus 4 angka.',
            'tahun_kendaraan.min' => 'Tahun kendaraan minimal 2000.',
            'tahun_kendaraan.max' => 'Tahun kendaraan tidak valid.',
        ];
    }
}
