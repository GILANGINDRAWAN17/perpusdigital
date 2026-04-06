<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('index');
    }

    public function masuk(Request $request)
    {
        $request->validate([
            "username" => "required|string",
            "password" => "required"
        ], [
            "username.username" => "Username tidak valid.",
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'Username tidak terdaftar'
            ])->onlyInput('username');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah'
            ])->onlyInput('username');
        }

        Auth::login($user);

        if ($user->role == 'anggota') {
            return redirect('/dashboard');
        } elseif ($user->role == 'petugas') {
            return redirect('/dashboardpetugas');
        } elseif ($user->role == 'kepala_perpustakaan') {
            return redirect('/dashboardkepalaperpus');
        }
    }

    public function daftar(Request $request)
    {

        // Validasi Input
        // dd($request->all());
        $validasiData = $request->validate([
            "username" => "required|max:14|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6"
        ], [
            // pesan validasi
            "username.required" => "Username wajib diisi.",
            "username.max" => "Username maksimal 14 karakter.",
            "username.unique" => "Username sudah digunakan.",

            "email.required" => "Email wajib diisi.",
            "email.email" => "Format email tidak valid.",
            "email.unique" => "Email sudah terdaftar.",

            "password.required" => "Password wajib diisi.",
            "password.min" => "Password minimal 6 karakter."
        ]);

        // Buat Data User
        $data = $validasiData;
        // Enkripsi Password
        $data['password'] = Hash::make($data['password']);
        // Isi Role
        $data['role'] = 'anggota';
        // Simpan Data User ke Database
        User::create($data);

        return redirect('/login');
    }

    // Fungsi Logout
    public function logout(Request $request)
    {
        // Logout User
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect('/');
    }
}
