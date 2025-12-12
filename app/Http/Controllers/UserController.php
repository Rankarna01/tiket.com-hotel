<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ==========================================================
    // 1. MENAMPILKAN DAFTAR USER
    // ==========================================================
    public function index()
    {
        // Mengambil data user terbaru dengan pagination (10 per halaman)
        $users = User::latest()->paginate(10);
        
        // Pastikan kamu punya file view di folder: resources/views/admin/users/index.blade.php
        return view('admin.users.index', compact('users'));
    }

    // ==========================================================
    // 2. FORM TAMBAH USER
    // ==========================================================
    public function create()
    {
        // Menampilkan form tambah
        return view('admin.users.create');
    }

    // ==========================================================
    // 3. PROSES SIMPAN USER BARU
    // ==========================================================
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Pastikan ada input name="password_confirmation" di view
            // 'role'  => 'required' // Aktifkan jika ada kolom role
        ]);

        // Simpan ke Database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash
            // 'role'  => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // ==========================================================
    // 4. FORM EDIT USER
    // ==========================================================
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // ==========================================================
    // 5. PROSES UPDATE USER
    // ==========================================================
    public function update(Request $request, User $user)
    {
        // Validasi
        $request->validate([
            'name'  => 'required|string|max:255',
            // Validasi email unik, tapi abaikan untuk user yang sedang diedit ini
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            // Password boleh kosong jika tidak ingin diganti
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update Data Dasar
        $dataToUpdate = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Cek apakah password diisi? Jika ya, update password baru
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $user->update($dataToUpdate);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    // ==========================================================
    // 6. HAPUS USER
    // ==========================================================
    public function destroy(User $user)
    {
        // Mencegah menghapus diri sendiri (Opsional tapi disarankan)
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri saat sedang login!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}