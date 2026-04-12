<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kepalaperpus.daftaruser.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('kepalaperpus.daftaruser.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect('/daftaruser')->with('success', 'User dihapus');
    }
}
