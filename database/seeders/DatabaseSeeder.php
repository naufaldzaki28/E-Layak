<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // PENTING: Jangan lupa ini biar password bisa di-hash

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun ADMIN (Manual dari sini)
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@elayak.com',  // Email Login Admin
            'nim' => 'NIP001',              // NIP Admin (Isi sembarang)
            'role' => 'admin',              // <--- PENTING: Role diset admin
            'no_hp' => '08123456789',
            'password' => Hash::make('password'), // Password Login Admin
        ]);

        // 2. Buat Akun Mahasiswa Dummy (Opsional, buat ngetes aja)
        User::create([
            'name' => 'Mahasiswa Test',
            'email' => 'mhs@gmail.com',
            'nim' => '12345678',
            'role' => 'mahasiswa',
            'password' => Hash::make('password'),
        ]);
    }
}
