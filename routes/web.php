<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\anggota;
use App\Http\Middleware\kepalaperpustakaan;
use App\Http\Middleware\petugas;
use App\Http\Middleware\petugasdankepala;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('index');
});

//LOGIN & REGISTER
Route::get('/login', [AuthController::class, 'indexLogin']);
Route::post('/login', [AuthController::class, 'masuk']);
Route::post('/register', [AuthController::class, 'daftar']);


//ANGGOTA
Route::get('/dashboard', [BukuController::class, 'dashboardAnggota'])
    ->middleware(anggota::class)
    ->name('dashboard.anggota');

Route::get('/katalog', [
    BukuController::class,
    'katalog'
])->middleware(anggota::class);

Route::post('/pinjam/{id}', [BukuController::class, 'pinjam'])
    ->middleware(anggota::class)
    ->name('pinjam.buku');

Route::post('/kembalikan/{id}', [BukuController::class, 'kembalikan'])
    ->middleware(anggota::class)
    ->name('kembalikan.buku');

Route::get('/riwayat', [BukuController::class, 'riwayat'])
    ->middleware(anggota::class)
    ->name('riwayat');

Route::get('/profile', function () {
    return view('anggota.profile.profileanggota');
})->middleware(anggota::class);

Route::post('/profile/foto', [ProfileController::class, 'updateFoto'])
    ->name('profile.foto');

Route::put('/profile/update', [ProfileController::class, 'update'])
    ->middleware(anggota::class)
    ->name('profile.update');

Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
    ->middleware(anggota::class)
    ->name('password.update');

Route::post('/notifikasi/{id}/read', function ($id) {
    $notif = \App\Models\Notifikasi::findOrFail($id);

    if ($notif->user_id != auth()->id()) {
        abort(403);
    }

    $notif->update(['is_read' => true]);

    return response()->json(['success' => true]);
})->name('notifikasi.read');

Route::get('/notifikasi/data', function () {
    return \App\Models\Notifikasi::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();
})->middleware('auth');



//KEPALA PERPUSTAKAAN
Route::get('/dashboardkepalaperpus', [BukuController::class, 'dashboardKepala'])
    ->middleware(kepalaperpustakaan::class)
    ->name('dashboard.kepala');

Route::get('/transaksi', [BukuController::class, 'transaksi'])->name('transaksi');

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
Route::get('/dashboardpetugas', [BukuController::class, 'dashboardPetugas'])
    ->middleware(petugas::class)
    ->name('dashboard.petugas');

// Approve peminjaman
Route::post('/peminjaman/{id}/approve', [BukuController::class, 'approve'])
    ->middleware(petugas::class)
    ->name('peminjaman.approve');

// Tolak peminjaman
Route::post('/peminjaman/{id}/tolak', [BukuController::class, 'tolak'])
    ->middleware(petugas::class)
    ->name('peminjaman.tolak');

// Konfirmasi pengembalian
Route::post('/pengembalian/{id}/confirm', [BukuController::class, 'confirmKembali'])
    ->middleware(petugas::class)
    ->name('pengembalian.confirm');

Route::get('/peminjaman', [BukuController::class, 'peminjaman'])
    ->middleware(petugas::class);

Route::get('/pengembalian', [BukuController::class, 'pengembalian'])
    ->middleware(petugas::class);

Route::get('/profilepetugas', function () {
    return view('petugas.profile.profilepetugas');
})->middleware(petugas::class);

//Daftar buku, hanya dapat diakses oleh petugas dan kepala
Route::get('/daftarbuku', [BukuController::class, 'index'])
    ->middleware(petugasdankepala::class)
    ->name('daftarbuku');

Route::controller(BukuController::class)->group(function () {
    Route::get('/buku', 'index')->name('buku.index');
    Route::get('/buku/create', 'create')->name('buku.create');
    Route::post('/buku', 'store')->name('buku.store');
    Route::get('/buku/{buku}/edit', 'edit')->name('buku.edit');
    Route::put('/buku/{buku}', 'update')->name('buku.update');
    Route::delete('/buku/{buku}', 'destroy')->name('buku.destroy');
})->middleware(petugas::class);
