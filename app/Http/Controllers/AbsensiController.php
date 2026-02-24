<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Rapat;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function scan($token)
    {
        $rapat = Rapat::where('qr_token', $token)->first();

        if (!$rapat || !$rapat->qr_status) {
            return view('absensi.qr-tidak-valid');
        }

        return view('absensi.form', compact('rapat'));
    }

    public function store(Request $request, $token)
    {
        $rapat = Rapat::where('qr_token', $token)->first();

        if (!$rapat || !$rapat->qr_status) {
            return view('absensi.qr-tidak-valid');
        }

        $request->validate([
            'nama'         => 'required|string|max:255',
            'jabatan'      => 'required|string|max:255',
            'status'       => 'required|in:hadir,telat',
            'tanda_tangan' => 'nullable|string',
        ]);

        Absensi::create([
            'user_id'      => auth()->id(),
            'rapat_id'     => $rapat->id,
            'waktu_scan'   => now(),
            'status'       => $request->status,
            'nama'         => $request->nama,
            'jabatan'      => $request->jabatan,
            'tanda_tangan' => $request->tanda_tangan,
        ]);

        return view('absensi.berhasil');
    }
}