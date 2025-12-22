<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanBantuan extends Model
{
    use HasFactory;

    // INI PENTING: Mengizinkan semua kolom diisi
    protected $guarded = ['id'];
}
