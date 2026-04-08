<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'user_id',
        'pesan',
        'is_read'
    ];
}
