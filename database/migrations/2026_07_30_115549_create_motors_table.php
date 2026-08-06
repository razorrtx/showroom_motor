<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('merk_tipe');
            $table->integer('tahun_kendaraan');
            $table->bigInteger('harga'); 
            $table->integer('kilometer');
            $table->enum('kondisi_kendaraan', [
            'Sangat Bagus', 'Bagus', 'Cukup Bagus'
        ]);
            $table->enum('kelengkapan_dokumen', [
            'BPKB & STNK Lengkap', 'Hanya BPKB', 'Hanya STNK'
        ]);
            $table->text('detail_spesifikasi');
            $table->boolean('status_tayang')->default(true); // Fitur kelola katalog
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
