<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    use HasFactory;

    // --- TAMBAHKAN INI ---
    // Ini memberi izin ke Laravel untuk mengisi kolom-kolom ini secara otomatis
    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'lokasi',
        'deskripsi',
        'bukti_foto',
        'status',
    ];

    // Relasi ke User (Opsional tapi bagus untuk nanti)
    // Supaya kita bisa tahu siapa pemilik aduan ini dengan mudah: $aduan->user->name
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
