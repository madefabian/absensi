<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rapat extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'qr_status',
        'qr_token',
    ];

    /**
     * Auto generate QR token saat create
     */
    protected static function booted()
    {
        static::creating(function ($rapat) {
            if (empty($rapat->qr_token)) {
                $rapat->qr_token = (string) Str::uuid();
            }
        });
    }

    /**
     * Accessor URL QR Absensi
     */
    public function getQrUrlAttribute(): string
    {
        return url('192.168.21.144/absen/' . $this->qr_token);
    }
}
