<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Rapat;

class AbsensiController extends Controller
{
    /**
     * Tampilkan form absensi berdasarkan QR token
     */
    public function scan($token)
    {
        $rapat = Rapat::where('qr_token', $token)->first();

        if (!$rapat) {
            return view('absensi.qr-tidak-valid');
        }

        return view('absensi.form', compact('rapat'));
    }

    /**
     * Simpan absensi peserta rapat
     */
    public function store(Request $request, $token)
    {
        $rapat = Rapat::where('qr_token', $token)->first();

        if (!$rapat) {
            return view('absensi.qr-tidak-valid');
        }

        $request->validate([
            'nama' => 'required|string',
        ]);

        Absensi::create([
            'rapat_id' => $rapat->id,
            'waktu_scan' => now(),
            'status' => 'hadir',
            'nama' => $request->nama,
        ]);

        return view('absensi.berhasil');
    }
}
