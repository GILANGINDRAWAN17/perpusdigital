<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // Menampilkan halaman login dan redirect user sesuai role jika sudah login
    public function indexLogin()
    {
        if (Auth::check()) {

            $role = Auth::user()->role;

            if ($role === 'anggota') {
                return redirect()->route('dashboard.anggota');
            } elseif ($role === 'petugas') {
                return redirect()->route('dashboard.petugas');
            } elseif ($role === 'kepala_perpustakaan') {
                return redirect()->route('dashboard.kepala');
            }
        }

        return response()
            ->view('index')
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }

    // Proses login user dengan validasi username & password lalu redirect sesuai role
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


        $request->session()->regenerate();


        if ($user->role == 'anggota') {
            return redirect()->route('dashboard.anggota')
                ->with('success', 'Selamat datang, ' . $user->username);
        } elseif ($user->role == 'petugas') {
            return redirect()->route('dashboard.petugas')
                ->with('success', 'Selamat datang, ' . $user->username);
        } elseif ($user->role == 'kepala_perpustakaan') {
            return redirect()->route('dashboard.kepala')
                ->with('success', 'Selamat datang, ' . $user->username);
        }

        return redirect('/');
    }

    // Proses registrasi user baru sebagai anggota dengan validasi dan enkripsi password
    public function daftar(Request $request)
    {

        // Validasi Input
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

        return redirect('/login')->with('success', 'Registrasi berhasil, silahkan login');
    }

    // Proses logout user dan menghapus session
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 1990 00:00:00 GMT',
        ]);
    }
}
