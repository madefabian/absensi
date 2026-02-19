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
        'waktu_scan',
        'status',
        'nama',
        'jabatan',
        'tanda_tangan'
    ];

    public $timestamps = false;

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Relation ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation ke Rapat
     */
    public function rapat()
    {
        return $this->belongsTo(Rapat::class);
    }
}
