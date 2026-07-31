<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\SawController;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.proses');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    // Tombol Logout
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    // Halaman Dashboard & Daftar Motor (Read)
    Route::get('/dashboard', [App\Http\Controllers\MotorController::class, 'index'])->name('admin.dashboard');
    // Rute CRUD Motor (Create, Store, Edit, Update, Destroy)
    Route::get('/motor/create', [App\Http\Controllers\MotorController::class, 'create'])->name('admin.motor.create');
    Route::post('/motor', [App\Http\Controllers\MotorController::class, 'store'])->name('admin.motor.store');
    Route::get('/motor/{id}/edit', [App\Http\Controllers\MotorController::class, 'edit'])->name('admin.motor.edit');
    Route::put('/motor/{id}', [App\Http\Controllers\MotorController::class, 'update'])->name('admin.motor.update');
    Route::delete('/motor/{id}', [App\Http\Controllers\MotorController::class, 'destroy'])->name('admin.motor.destroy');
    // Rute untuk mengubah status tayang di katalog (Toggle Status)
    Route::patch('/motor/{id}/toggle', [App\Http\Controllers\MotorController::class, 'toggleStatus'])->name('admin.motor.toggle');
    // Rute Kelola Bobot Kriteria SAW
    Route::get('/kriteria', [App\Http\Controllers\KriteriaController::class, 'index'])->name('admin.kriteria.index');
    Route::put('/kriteria', [App\Http\Controllers\KriteriaController::class, 'update'])->name('admin.kriteria.update');
});
