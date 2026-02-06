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

    protected static function booted()
    {
        static::creating(function ($rapat) {
            $rapat->qr_token = Str::uuid();
        });
    }
    public function getQrUrlAttribute(): string
{
    return url('/absensi/' . $this->qr_token);
}

}
