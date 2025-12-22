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
        Schema::create('pelayanan_kampus', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (siapa yang minta)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Jenis layanan (Gedung, Surat, atau Alat)
            $table->enum('kategori', ['peminjaman_gedung', 'surat', 'peminjaman_alat']);

            $table->string('kebutuhan'); // Misal: "Gedung Aula", "Kamera DSLR", "Surat Aktif Kuliah"
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('keterangan')->nullable(); // Detail tambahan

            $table->enum('status', ['diajukan', 'disetujui', 'ditolak'])->default('diajukan');
            $table->text('catatan_admin')->nullable(); // Alasan tolak/acc

            $table->timestamps();
        });
    }
};
