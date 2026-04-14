<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk mengelola proses peminjaman buku
class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_kembali',
        'status',
        'denda',
        'status_denda',
        'petugas_id'
    ];


    // Mengatur tipe data otomatis
    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_jatuh_tempo' => 'datetime',
        'tanggal_kembali' => 'datetime',
        'petugas_id' => 'integer'
    ];

    // Relasi ke user (yang meminjam)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke buku yang dipinjam
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // Relasi ke petugas yang mengkonfirmasi
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
