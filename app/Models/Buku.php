<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk mengelola data buku di database
class Buku extends Model
{
    protected $table = 'buku';
    protected $guarded = [];

     // Relasi: satu buku bisa punya banyak peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
