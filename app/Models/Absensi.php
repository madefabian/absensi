<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Absensi extends Model
{
    protected $fillable = [
        'user_id',
        'rapat_id',
        'uuid',
        'nip',
        'nama',
        'jabatan',
        'waktu_scan',
        'status',
        'tanda_tangan',
    ];

    public $timestamps = false;

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rapat()
    {
        return $this->belongsTo(Rapat::class);
    }
}