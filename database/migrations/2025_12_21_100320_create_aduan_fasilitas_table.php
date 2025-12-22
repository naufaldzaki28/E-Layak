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
        Schema::create('aduan_fasilitas', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (siapa yang lapor)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto_bukti')->nullable(); // Foto bisa kosong dulu jaga-jaga
            $table->enum('status', ['menunggu', 'diproses', 'selesai'])->default('menunggu');
            $table->text('tanggapan_admin')->nullable(); // Diisi admin nanti

            $table->timestamps();
        });
    }
};
