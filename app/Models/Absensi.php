<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'rapat_id',
        'user_id',
        'waktu_absen',
    ];
}

