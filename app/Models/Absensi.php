<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'user_id',
        'rapat_id',
        'waktu_scan',
        'status',
        'nama',
        'jabatan',
        'tanda_tangan',
    ];

    public $timestamps = false;
}


