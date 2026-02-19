<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
     * Scope untuk menampilkan rapat yang belum melewati tanggalnya
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('tanggal', '>=', now()->toDateString())
                     ->orderBy('tanggal', 'asc');
    }

    /**
     * Accessor URL QR Absensi
     */
    public function getQrUrlAttribute(): string
    {
        return config('app.url') . '/absensi/' . $this->qr_token;
    }

    /**
     * Relasi ke Absensi (One to Many)
     */
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
