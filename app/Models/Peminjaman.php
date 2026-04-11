<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'petugas_id'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_jatuh_tempo' => 'datetime',
        'tanggal_kembali' => 'datetime',
        'petugas_id' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
