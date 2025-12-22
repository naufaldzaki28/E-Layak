<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan Dashboard dengan Data Statistik
     */
    public function index()
    {
        $userId = Auth::id(); // Ambil ID mahasiswa yang sedang login

        // --- 1. Hitung Statistik ADUAN ---
        // Kita pakai Model 'Aduan' yang sudah dibuat tadi
        $totalAduan = Aduan::where('user_id', $userId)->count();

        // Hitung yang sedang diproses (selain selesai/ditolak)
        $aduanProses = Aduan::where('user_id', $userId)
            ->whereIn('status', ['pending', 'diproses'])
            ->count();

        // Hitung yang selesai
        $aduanSelesai = Aduan::where('user_id', $userId)
            ->where('status', 'selesai')
            ->count();

        // --- 2. Hitung Statistik LAYANAN (SUDAH AKTIF) ---
        $totalLayanan = Layanan::where('user_id', $userId)->count();

        $layananProses = Layanan::where('user_id', $userId)
            ->where('status', 'diajukan') // atau diproses
            ->count();

        $layananSelesai = Layanan::where('user_id', $userId)
            ->where('status', 'disetujui')
            ->count();
        // Total Gabungan
        $totalProses = $aduanProses + $layananProses;
        $totalSelesai = $aduanSelesai + $layananSelesai;

        // --- 3. Ambil Riwayat Terkini ---
        // Ambil 5 aduan terakhir
        $riwayatTerkini = Aduan::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->type = 'Aduan'; // Menambahkan label tipe

                return $item;
            });

        // Kirim data ke View Dashboard
        return view('mahasiswa.dashboard', compact(
            'totalAduan',
            'totalLayanan',
            'totalProses',
            'totalSelesai',
            'riwayatTerkini'
        ));
    }

    /**
     * Menampilkan Form Buat Aduan
     */
    public function createAduan()
    {
        return view('mahasiswa.aduan.create');
    }

    /**
     * Menyimpan Data Aduan ke Database
     */
    public function storeAduan(Request $request)
    {
        // 1. Validasi inputan
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required',
            'lokasi' => 'required|string',
            'deskripsi' => 'required',
            'bukti_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // 2. Upload Foto
        $fotoPath = null;
        if ($request->hasFile('bukti_foto')) {
            // Simpan di folder: storage/app/public/bukti_aduan
            $fotoPath = $request->file('bukti_foto')->store('bukti_aduan', 'public');
        }

        // 3. Simpan ke Database
        Aduan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'bukti_foto' => $fotoPath,
            'status' => 'pending', // Default status
        ]);

        // 4. Balikin ke halaman dashboard dengan pesan sukses
        return redirect()->route('mahasiswa.dashboard')->with('success', 'Laporan berhasil dikirim! Petugas akan segera mengecek.');
    }
    // --- FITUR LAYANAN ---

    public function createLayanan()
    {
        return view('mahasiswa.layanan.create');
    }

    public function storeLayanan(Request $request)
    {
        $request->validate([
            'jenis_layanan' => 'required',
            'keterangan' => 'required',
            'tanggal_butuh' => 'required|date',
            'dokumen_pendukung' => 'nullable|mimes:pdf,jpg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('dokumen_pendukung')) {
            $filePath = $request->file('dokumen_pendukung')->store('dokumen_layanan', 'public');
        }

        Layanan::create([
            'user_id' => Auth::id(),
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
            'tanggal_butuh' => $request->tanggal_butuh,
            'dokumen_pendukung' => $filePath,
            'status' => 'diajukan',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengajuan layanan berhasil dikirim!');
    }

    // --- FITUR RIWAYAT ---
    public function riwayat()
    {
        $userId = Auth::id();

        // 1. Ambil semua Aduan user ini
        $aduan = Aduan::where('user_id', $userId)->get()->map(function ($item) {
            $item->jenis = 'Aduan'; // Penanda

            return $item;
        });

        // 2. Ambil semua Layanan user ini
        $layanan = Layanan::where('user_id', $userId)->get()->map(function ($item) {
            $item->jenis = 'Layanan'; // Penanda
            // Kita samakan nama kolom judul biar gampang ditampilkan
            $item->judul = $item->jenis_layanan;

            return $item;
        });

        // 3. Gabungkan keduanya dan urutkan dari yang terbaru
        $gabunganData = $aduan->concat($layanan)->sortByDesc('created_at');

        return view('mahasiswa.riwayat.index', [
            'dataRiwayat' => $gabunganData,
        ]);
    }

    public function bantuan()
    {
        return view('mahasiswa.bantuan.index');
    }
}
