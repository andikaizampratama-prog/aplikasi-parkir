<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('q')) {
            $keyword = $request->q;

            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $anggotas = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.anggota.index', compact('anggotas'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.anggota.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => [
                'required',
                Rule::in(['admin', 'petugas', 'owner'])
            ],
        ]);

        unset($validated['password_confirmation']);

        User::create($validated);

        return redirect()
            ->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function show(User $anggota)
    {
        return view('admin.anggota.show', compact('anggota'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function edit(User $anggota)
    {
        return view('admin.anggota.edit', compact('anggota'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, User $anggota)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($anggota->id),
            ],

            'password' => 'nullable|string|min:8|confirmed',

            'role' => [
                'required',
                Rule::in(['admin', 'petugas', 'owner'])
            ],
        ]);

        // Tidak boleh mengubah role akun sendiri.
        if (
            $anggota->id === auth()->id() &&
            $validated['role'] !== $anggota->role
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'role' => 'Role akun yang sedang digunakan tidak dapat diubah.'
                ]);
        }

        // Melindungi admin terakhir.
        if (
            $anggota->role === 'admin' &&
            $validated['role'] !== 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'role' => 'Admin terakhir tidak dapat diubah rolenya.'
                ]);
        }

        // Password hanya berubah jika diisi.
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        unset($validated['password_confirmation']);

        $anggota->update($validated);

        return redirect()
            ->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function destroy(User $anggota)
    {
        // Tidak boleh menghapus akun sendiri.
        if ($anggota->id === auth()->id()) {
            return back()
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Melindungi admin terakhir.
        if (
            $anggota->role === 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->with('error', 'Admin terakhir tidak dapat dihapus.');
        }

        $anggota->delete();

        return redirect()
            ->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
