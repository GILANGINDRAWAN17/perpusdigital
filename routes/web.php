<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*PUBLIC*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [AuthController::class, 'indexLogin'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'masuk'])->name('login.post');
Route::post('/register', [AuthController::class, 'daftar']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*AUTH (SEMUA HARUS LOGIN)*/

Route::middleware('auth')->group(function () {

    /*ANGGOTA*/
    Route::middleware('role:anggota')->group(function () {

        Route::get('/dashboard', [BukuController::class, 'dashboardAnggota'])
            ->name('dashboard.anggota');

        Route::get('/katalog', [BukuController::class, 'katalog']);

        Route::post('/pinjam/{id}', [BukuController::class, 'pinjam'])
            ->name('pinjam.buku');

        Route::post('/kembalikan/{id}', [BukuController::class, 'kembalikan'])
            ->name('kembalikan.buku');

        Route::get('/riwayat', [BukuController::class, 'riwayat'])
            ->name('riwayat');

        Route::get('/profile', function () {
            return view('anggota.profile.profileanggota');
        });
    });


    /*PETUGAS*/
    Route::middleware('role:petugas')->group(function () {

        Route::get('/dashboardpetugas', [BukuController::class, 'dashboardPetugas'])
            ->name('dashboard.petugas');

        Route::post('/peminjaman/{id}/approve', [BukuController::class, 'approve'])
            ->name('peminjaman.approve');

        Route::post('/peminjaman/{id}/tolak', [BukuController::class, 'tolak'])
            ->name('peminjaman.tolak');

        Route::post('/pengembalian/{id}/confirm', [BukuController::class, 'confirmKembali'])
            ->name('pengembalian.confirm');

        Route::get('/peminjaman', [BukuController::class, 'peminjaman'])
            ->name('peminjaman');

        Route::get('/pengembalian', [BukuController::class, 'pengembalian'])
            ->name('pengembalian');

        Route::post('/bayar-denda/{id}', [BukuController::class, 'bayarDenda'])
            ->name('bayar.denda');

        Route::get('/profilepetugas', function () {
            return view('petugas.profile.profilepetugas');
        });

        // CRUD Buku
        Route::controller(BukuController::class)->group(function () {
            Route::get('/buku/create', 'create')->name('buku.create');
            Route::post('/buku', 'store')->name('buku.store');
            Route::get('/buku/{buku}/edit', 'edit')->name('buku.edit');
            Route::put('/buku/{buku}', 'update')->name('buku.update');
            Route::delete('/buku/{buku}', 'destroy')->name('buku.destroy');
        });
    });


    /*KEPALA PERPUSTAKAAN*/
    Route::middleware('role:kepala_perpustakaan')->group(function () {

        Route::get('/dashboardkepalaperpus', [BukuController::class, 'dashboardKepala'])
            ->name('dashboard.kepala');

        Route::get('/transaksi', [BukuController::class, 'transaksi'])
            ->name('transaksi');

        Route::get('/transaksi/export-pdf', [BukuController::class, 'exportPdf'])
            ->name('transaksi.export');

        Route::get('/daftaruser', [UserController::class, 'index'])
            ->name('user.index');

        Route::resource('user', UserController::class);

        Route::get('/profilekepala', function () {
            return view('kepalaperpus.profile.profilekepalaperpus');
        });
    });


    /*GLOBAL (KECUALI ROUTE BUKU CUMA PETUGAS DAN KEPALA)*/

    Route::get('/buku', [BukuController::class, 'index'])
        ->name('buku.index')
        ->middleware('role:petugas,kepala_perpustakaan');
        
    Route::put('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');

    Route::post('/profile/foto', [ProfileController::class, 'updateFoto'])
        ->name('profile.foto');

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
    });
});
