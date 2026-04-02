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

Route::get('/lay', function () {
    return view('layout.sidebaranggota');
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
Route::get('/lai', function () {
    return view('layout.sidebarkepalaperpus');
});

//Petugas
Route::get('/lap', function () {
    return view('layout.sidebarpetugas');
});

Route::get('/dashboardpetugas', function () {
    return view('petugas.dashboard');
});



Route::get('/buku', function () {
    return view('daftarbuku.buku');
 });

Route::controller(BukuController::class)->group(function () {
    Route::get('/buku', 'index')->name('buku.index');
    Route::get('/buku/create', 'create')->name('buku.create');
    Route::post('/buku', 'store')->name('buku.store');
    Route::get('/buku/{buku}/edit', 'edit')->name('buku.edit');
    Route::put('/buku/{buku}', 'update')->name('buku.update');
    Route::delete('/buku/{buku}', 'destroy')->name('buku.destroy');
});

 