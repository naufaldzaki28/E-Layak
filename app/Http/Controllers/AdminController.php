<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiBantuan;
// --- GANTI MODEL LAMA DENGAN YANG BARU ---
use App\Models\Aduan;    // Dulu: AduanFasilitas
use App\Models\Layanan;  // Dulu: PelayananKampus
// -----------------------------------------
use App\Models\PesanBantuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil data Layanan Terbaru (Ganti PelayananKampus jadi Layanan)
        // Status di model baru: 'diajukan', bukan 'pending'
        $permintaan_terbaru = Layanan::with('user')
            ->where('status', 'diajukan')
            ->latest()
            ->take(6)
            ->get();

        // 2. Kirim data ke view dashboard
        return view('admin.dashboard', compact('permintaan_terbaru'));
    }

    // Fungsi untuk update status Layanan (Terima/Tolak)
    public function updateStatus(Request $request, $id)
    {
        // Ganti PelayananKampus jadi Layanan
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:disetujui,ditolak', // Sesuaikan status model baru
        ]);

        $layanan->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status layanan berhasil diperbarui!');
    }

    // Fungsi Update Status Aduan (Tambahan Penting)
    public function updateStatusAduan(Request $request, $id)
    {
        $aduan = Aduan::findOrFail($id);

        // Validasi status yang boleh dipilih admin
        $request->validate([
            'status' => 'required|in:diproses,selesai,ditolak',
        ]);

        $aduan->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status aduan berhasil diperbarui!');
    }

    public function aduan()
    {
        // Ganti AduanFasilitas jadi Aduan
        $aduan = Aduan::with('user')->latest()->get();

        return view('admin.aduan', compact('aduan'));
    }

    public function layanan()
    {
        // Ganti PelayananKampus jadi Layanan
        $layanan = Layanan::with('user')->latest()->get();

        return view('admin.layanan', compact('layanan'));
    }

    public function laporan()
    {
        // 1. Ambil Aduan yang statusnya 'selesai' (Pakai Model Aduan)
        $aduanSelesai = Aduan::with('user')
            ->where('status', 'selesai')
            ->get()
            ->map(function ($item) {
                $item->jenis = 'Aduan'; // Penanda buat di tabel

                return $item;
            });

        // 2. Ambil Layanan yang statusnya 'disetujui' atau 'ditolak' (Pakai Model Layanan)
        $layananSelesai = Layanan::with('user')
            ->whereIn('status', ['disetujui', 'ditolak'])
            ->get()
            ->map(function ($item) {
                $item->jenis = 'Layanan'; // Penanda
                $item->judul = $item->jenis_layanan; // Samakan nama kolom biar gampang

                return $item;
            });

        // 3. Gabungkan keduanya
        $laporan = $aduanSelesai->concat($layananSelesai)->sortByDesc('updated_at');

        return view('admin.laporan', compact('laporan'));
    }

    public function downloadSurat($id)
    {
        // Cek di Layanan dulu
        $data = \App\Models\Layanan::with('user')->find($id);

        // Jika tidak ada di layanan, cek di Aduan
        if (! $data) {
            $data = \App\Models\Aduan::with('user')->findOrFail($id);
        }

        // Ubah pengecekan status agar sesuai dengan database (huruf kecil)
        if (! in_array($data->status, ['disetujui', 'selesai'])) {
            return back()->with('error', 'Surat hanya tersedia untuk permohonan yang disetujui.');
        }

        // Pastikan path view benar: folder admin, file surat_pdf.blade.php
        $pdf = Pdf::loadView('admin.surat_pdf', compact('data'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Surat_Keterangan_'.$data->user->nim.'.pdf');
    }

    // --- FUNGSI KIRIM PESAN ---
    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        $dataPesan = [
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang, // Pastikan input ini ada di view
            'email' => $request->email,
            'pesan' => $request->pesan,
        ];

        PesanBantuan::create($dataPesan);

        Mail::to('dnaufal283@gmail.com')->send(new NotifikasiBantuan($dataPesan));

        return redirect()->back()->with('success', 'Pesan terkirim!');
    }

    public function bantuan()
    {
        return view('admin.bantuan');
    }

    public function pengaturan()
    {
        return view('admin.pengaturan');
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
