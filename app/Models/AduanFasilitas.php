<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AduanFasilitas extends Model
{
    use HasFactory;

    protected $table = 'aduan_fasilitas'; // Nama tabel di database

    protected $guarded = ['id']; // Izinkan semua kolom diisi

    // Relasi ke User (Siapa yang melapor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
