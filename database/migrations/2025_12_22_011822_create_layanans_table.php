<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_layanan'); // Contoh: Surat Aktif, Cuti, Legalisir
            $table->text('keterangan'); // Detail keperluan
            $table->string('dokumen_pendukung')->nullable(); // File PDF/Gambar jika butuh
            $table->date('tanggal_butuh')->nullable(); // Kapan mau diambil
            $table->enum('status', ['diajukan', 'diproses', 'disetujui', 'ditolak'])->default('diajukan');
            $table->timestamps();
        });
    }
};
