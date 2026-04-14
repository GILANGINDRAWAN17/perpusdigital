<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    // Mengupdate data profil user (nama, NIK/NIS, nomor telepon)
    public function update(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nik_nis' => $request->nik_nis,
            'no_telp' => $request->no_telp,
        ]);

        return back()->with('success', 'Profile berhasil diupdate');
    }

    // Mengubah password user dengan validasi password lama dan konfirmasi password baru
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'error' => 'Password lama salah'
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

       return back()->with('success', 'Password berhasil diubah');
    }

    // Mengupdate foto profil user dan menghapus foto lama jika ada
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        // hapus foto lama
        if ($user->foto) {
            Storage::delete('public/' . $user->foto);
        }

        // simpan baru
        $path = $request->file('foto')->store('profile', 'public');

        $user->update([
            'foto' => $path
        ]);

        return back()->with('success', 'Foto berhasil diupdate');
    }
}
