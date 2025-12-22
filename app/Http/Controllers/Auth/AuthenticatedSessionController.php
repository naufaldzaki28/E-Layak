<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // --- TAMBAHAN LOGIKA CEK ROLE ---

        // Ambil role user yang sedang login
        $role = Auth::user()->role;

        // Cek database: apakah role-nya 'admin'?
        if ($role === 'admin') {
            // Arahkan ke rute khusus admin (sesuaikan dengan web.php kamu)
            // Bisa pakai url '/admin/dashboard' atau route name
            return redirect()->intended('/admin/dashboard');
        }

        // Cek database: apakah role-nya 'mahasiswa'?
        if ($role === 'mahasiswa') {
            // Arahkan ke rute khusus mahasiswa
            return redirect()->intended('/mahasiswa/dashboard');
        }

        // Default jika role tidak dikenal, kembalikan ke home atau dashboard umum
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
