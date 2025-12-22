<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// --- ROUTE YANG MEMBUTUHKAN LOGIN ---
Route::middleware(['auth'])->group(function () {

    // 1. PENGATUR DASHBOARD (Redirect sesuai role)
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }

        return abort(403, 'Unauthorized');
    })->name('dashboard');

    // ====================================================
    // AREA ADMIN
    // ====================================================

    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Kelola Layanan Kampus
    Route::get('/admin/layanan', [AdminController::class, 'layanan'])->name('admin.layanan');
    // Saya tambahkan prefix '/admin' di depannya biar rapi
    Route::patch('/admin/layanan/{id}/update', [AdminController::class, 'updateStatus'])->name('layanan.update');

    // Kelola Aduan Fasilitas
    Route::get('/admin/aduan', [AdminController::class, 'aduan'])->name('admin.aduan');
    Route::patch('/admin/aduan/{id}/update', [AdminController::class, 'updateStatusAduan'])->name('admin.aduan.update');

    // Laporan & Bantuan
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/admin/bantuan', [AdminController::class, 'bantuan'])->name('admin.bantuan');
    Route::post('/admin/bantuan/kirim', [AdminController::class, 'kirimPesan'])->name('bantuan.kirim');

    // Pengaturan Admin (Khusus Admin)
    Route::get('/admin/pengaturan', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::patch('/admin/pengaturan/update', [AdminController::class, 'updateProfil'])->name('admin.pengaturan.update');

    // ====================================================
    // AREA MAHASISWA
    // ====================================================

    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');

    // Fitur Aduan
    Route::get('/mahasiswa/aduan', [MahasiswaController::class, 'createAduan'])->name('mahasiswa.aduan');
    Route::post('/mahasiswa/aduan', [MahasiswaController::class, 'storeAduan'])->name('mahasiswa.aduan.store');

    // Fitur Layanan
    Route::get('/mahasiswa/layanan', [MahasiswaController::class, 'createLayanan'])->name('mahasiswa.layanan');
    Route::post('/mahasiswa/layanan', [MahasiswaController::class, 'storeLayanan'])->name('mahasiswa.layanan.store');

    // Riwayat & Bantuan
    Route::get('/mahasiswa/riwayat', [MahasiswaController::class, 'riwayat'])->name('mahasiswa.riwayat');
    Route::get('/mahasiswa/bantuan', [MahasiswaController::class, 'bantuan'])->name('mahasiswa.bantuan');

    // ====================================================
    // FITUR PROFILE (Untuk Mahasiswa ganti Password/Nama)
    // ====================================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
