<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan daftar user dengan fitur search dan filter berdasarkan role
    public function index(Request $request)
    {
        $query = User::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_lengkap', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER ROLE
        if ($request->role) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(5)->withQueryString();

        return view('kepalaperpus.daftaruser.user', compact('users'));
    }


    // Menampilkan halaman form tambah user
    public function create()
    {
        return view('kepalaperpus.daftaruser.create');
    }


    // Menyimpan data user baru ke database dengan validasi
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'no_telp' => 'nullable|numeric',
            'nik_nis' => 'nullable|numeric|min:5',
            'role' => 'required',
        ]);

        \App\Models\User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'no_telp' => $request->no_telp,
            'nik_nis' => $request->nik_nis,
            'role' => $request->role,
        ]);

        return redirect('/daftaruser')->with('success', 'User berhasil ditambahkan');
    }


    // (Tidak digunakan) menampilkan detail user
    public function show(string $id)
    {
        //
    }

    // Menampilkan halaman edit data user
    public function edit(string $id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('kepalaperpus.daftaruser.edit', compact('user'));
    }

    // Mengupdate data user dengan validasi
    public function update(Request $request, $id)
    {
        // VALIDASI DI SINI
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'nama_lengkap' => 'required',
            'no_telp' => 'nullable|numeric|digits_between:10,15',
            'nik_nis' => 'nullable|numeric|min:5|digits_between:8,20',
            'role' => 'required',
        ], [
            'no_telp.numeric' => 'Nomor telepon harus berupa angka',
        ]);

        $user = \App\Models\User::findOrFail($id);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'nama_lengkap' => $request->nama_lengkap,
            'no_telp' => $request->no_telp,
            'nik_nis' => $request->nik_nis,
        ]);

        return redirect('/daftaruser')->with('success', 'User "' . $user->username . '" berhasil diupdate');
    }

    // Menghapus data user dari database
    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect('/daftaruser')->with('success', 'User dihapus');
    }
}
