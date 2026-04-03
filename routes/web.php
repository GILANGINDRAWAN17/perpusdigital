<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('index');
});


//Anggota

Route::get('/dashboard', function () {
    return view('anggota.dashboard');
});

Route::get('/katalog', function () {
    return view('anggota.daftarbuku.buku');
});

Route::get('/riwayat', function () {
    return view('anggota.riwayat.pinjaman');
});

Route::get('/profile', function () {
    return view('anggota.profile.profileanggota');
});

//KepalaPerpustakaan

Route::get('/dashboardkepalaperpus', function () {
    return view('kepalaperpus.dashboard');
});

Route::get('/transaksi', function () {
    return view('kepalaperpus.transaksi');
});

Route::get('/daftarbukukep', function () {
    return view('kepalaperpus.daftarbuku.buku');
});

Route::get('/daftaruser', function () {
    return view('kepalaperpus.daftaruser.user');
});

Route::get('/profilekepala', function () {
    return view('kepalaperpus.profile.profilekepalaperpus');
});

//Petugas

Route::get('/dashboardpetugas', function () {
    return view('petugas.dashboard');
});

Route::get('/peminjaman', function () {
    return view('petugas.peminjaman.buku');
});

Route::get('/pengembalian', function () {
    return view('petugas.pengembalian.buku');
});

Route::get('/daftarbuku', function () {
    return view('petugas.daftarbuku.buku');
});

Route::get('/profilepetugas', function () {
    return view('petugas.profile.profilepetugas');
});

//Databuku
Route::get('/daftarbuku', function () {
    $buku = App\Models\Buku::all();
    return view('petugas.daftarbuku.buku', compact('buku'));
});

Route::controller(BukuController::class)->group(function () {
    Route::get('/buku', 'index')->name('buku.index');
    Route::get('/buku/create', 'create')->name('buku.create');
    Route::post('/buku', 'store')->name('buku.store');
    Route::get('/buku/{buku}/edit', 'edit')->name('buku.edit');
    Route::put('/buku/{buku}', 'update')->name('buku.update');
    Route::delete('/buku/{buku}', 'destroy')->name('buku.destroy');
});

 