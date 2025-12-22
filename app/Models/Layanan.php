<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    // --- BAGIAN INI YANG HARUS DITAMBAH ---
    protected $fillable = [
        'user_id',
        'jenis_layanan',
        'keterangan',
        'dokumen_pendukung',
        'tanggal_butuh',
        'status',
    ];

    // Relasi ke User (supaya tahu siapa yang mengajukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
