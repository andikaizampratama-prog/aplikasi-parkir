<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | MENCATAT LOG AKTIVITAS
    |--------------------------------------------------------------------------
    */

    private function catatAktivitas(
        User $user,
        string $aktivitas,
        string $deskripsi,
        Request $request
    ): void {
        LogAktivitas::create([
            'user_id' => $user->id,
            'aktivitas' => $aktivitas,
            'deskripsi' => $deskripsi,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password yang Anda masukkan salah.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Periksa role akun
        if (!in_array($user->role, ['admin', 'petugas', 'owner'])) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('error', 'Role akun tidak dikenali.');
        }

        // Catat aktivitas login
        $this->catatAktivitas(
            $user,
            'Login',
            $user->name . ' berhasil login sebagai ' . ucfirst($user->role),
            $request
        );

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Selamat datang Admin!');
        }

        if ($user->role === 'petugas') {
            return redirect()
                ->route('petugas.dashboard')
                ->with('success', 'Selamat datang Petugas!');
        }

        return redirect()
            ->route('owner.dashboard')
            ->with('success', 'Selamat datang Owner!');
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN REGISTER
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES REGISTER OWNER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Membuat akun Owner
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'owner',
        ]);

        // Catat aktivitas registrasi
        $this->catatAktivitas(
            $user,
            'Registrasi Owner',
            'Akun Owner baru berhasil didaftarkan: ' . $user->name,
            $request
        );

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi Owner berhasil! Silakan login.');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        // Ambil data pengguna sebelum logout
        $user = Auth::user();

        if ($user) {
            // Catat aktivitas logout sebelum sesi dihapus
            $this->catatAktivitas(
                $user,
                'Logout',
                $user->name . ' berhasil logout sebagai ' . ucfirst($user->role),
                $request
            );
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil logout.');
    }
}
