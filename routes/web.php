<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\anggota;
use App\Http\Middleware\kepalaperpustakaan;
use App\Http\Middleware\petugas;
use App\Http\Middleware\petugasdankepala;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});



Route::get('/login', [AuthController::class, 'indexLogin']);
Route::post('/login', [AuthController::class, 'masuk']);

Route::post('/register', [AuthController::class, 'daftar']);

//ANGGOTA
Route::get('/dashboard', function () {
    return view('anggota.dashboard');
})->middleware(anggota::class);

Route::get('/katalog', function () {
    return view('anggota.daftarbuku.buku');
})->middleware(anggota::class);

Route::get('/riwayat', function () {
    return view('anggota.riwayat.pinjaman');
})->middleware(anggota::class);

Route::get('/profile', function () {
    return view('anggota.profile.profileanggota');
})->middleware(anggota::class);



//KEPALA PERPUSTAKAAN
Route::get('/dashboardkepalaperpus', function () {
    return view('kepalaperpus.dashboard');
})->middleware(kepalaperpustakaan::class);

Route::get('/transaksi', function () {
    return view('kepalaperpus.transaksi');
})->middleware(kepalaperpustakaan::class);

Route::get('/daftaruser', [
    UserController::class,
    'index'
])->middleware(kepalaperpustakaan::class);

Route::get('/profilekepala', function () {
    return view('kepalaperpus.profile.profilekepalaperpus');
})->middleware(kepalaperpustakaan::class);

//Hanya dapat diakses oleh Kepala Perpus
Route::middleware(['auth', 'role:kepala_perpustakaan'])->group(function () {
    Route::resource('user', UserController::class);
});



//PETUGAS
Route::get('/dashboardpetugas', function () {
    return view('petugas.dashboard');
})->middleware(petugas::class);

Route::get('/peminjaman', function () {
    return view('petugas.peminjaman.buku');
})->middleware(petugas::class);

Route::get('/pengembalian', function () {
    return view('petugas.pengembalian.buku');
})->middleware(petugas::class);

Route::get('/profilepetugas', function () {
    return view('petugas.profile.profilepetugas');
})->middleware(petugas::class);

//Daftar buku, hanya dapat diakses oleh petugas dan kepala
Route::get('/daftarbuku', function () {
    $buku = App\Models\Buku::all();
    return view('petugas.daftarbuku.buku', compact('buku'));
})->middleware(petugasdankepala::class)->name('daftarbuku');

Route::controller(BukuController::class)->group(function () {
    Route::get('/buku', 'index')->name('buku.index');
    Route::get('/buku/create', 'create')->name('buku.create');
    Route::post('/buku', 'store')->name('buku.store');
    Route::get('/buku/{buku}/edit', 'edit')->name('buku.edit');
    Route::put('/buku/{buku}', 'update')->name('buku.update');
    Route::delete('/buku/{buku}', 'destroy')->name('buku.destroy');
})->middleware(petugas::class);
