<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/foto-motor/{filename}', function ($filename) {
    $path = 'foto_motor/' . $filename;
    // Cek apakah file ada di folder rahasia
    if (!Storage::exists($path)) {
        abort(404);
    }
    // Tampilkan gambar langsung ke browser
    return Storage::response($path);
})->name('tampil.foto');

Route::get('/', [MotorController::class, 'katalog'])->name('katalog');

Route::get('/motor/{id}', [MotorController::class, 'detail'])->name('detail.motor');

Route::get('/rekomendasi', function () {
    return view('publik.form_saw');
})->name('form.saw');

Route::post('/rekomendasi/proses', [SawController::class, 'hitungRekomendasi'])->name('hitung.saw');
