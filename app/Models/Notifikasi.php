<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk menyimpan notifikasi ke user
class Notifikasi extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'user_id',
        'pesan',
        'is_read'
    ];
}
