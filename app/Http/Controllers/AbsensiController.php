<?php

namespace App\Http\Controllers;

use App\Models\Rapat;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function scan(string $token)
    {
        // pastikan user login
        if (! Auth::check()) {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        $rapat = Rapat::where('qr_token', $token)
            ->where('qr_status', true)
            ->firstOrFail();

        $sudahAbsen = Absensi::where('rapat_id', $rapat->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($sudahAbsen) {
            abort(403, 'Anda sudah absen.');
        }

        Absensi::create([
            'rapat_id'    => $rapat->id,
            'user_id'     => $user->id,
            'waktu_absen' => now(),
        ]);

        return view('absensi.berhasil', compact('rapat'));
    }
}
