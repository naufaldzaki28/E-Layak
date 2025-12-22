<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananKampus extends Model
{
    use HasFactory;

    // 1. Definisikan nama tabel (jika nama tabel di database bukan 'pelayanan_kampuses')
    // Sesuaikan dengan nama tabel yang Anda buat di database (misal: 'pelayanan_kampus')
    protected $table = 'pelayanan_kampus';

    // 2. Tentukan kolom mana saja yang boleh diisi (Mass Assignment)
    // Sesuaikan dengan kolom yang ada di database Anda
    protected $fillable = [
        'user_id',    // Pastikan kolom ini ada di database untuk relasi
        'kebutuhan',
        'status',
        // tambahkan kolom lain jika ada, misal: 'deskripsi', 'lampiran', dll
    ];

    /**
     * 3. Relasi ke User
     * Ini Wajib ada karena di Controller Anda memanggil ::with('user')
     */
    public function user()
    {
        // Artinya: Data pelayanan ini milik satu User
        return $this->belongsTo(User::class, 'user_id');
    }
}
