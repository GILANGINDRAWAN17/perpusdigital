<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    protected $table = 'petugas';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

      public function peminjaman()
    {
        return $this->belongsTo(peminjamanBuku::class);
    }
}
