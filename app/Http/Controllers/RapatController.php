<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapat;

class RapatController extends Controller
{
    /**
     * Tampilkan form untuk membuat rapat baru
     */
    public function create()
    {
        return view('rapat.create');
    }

    /**
     * Simpan rapat baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'lokasi' => 'required|string|max:255',
        ]);

        Rapat::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'lokasi' => $request->lokasi,
            'qr_status' => true,
        ]);

        return redirect()->back()->with('success', 'Rapat berhasil dibuat');
    }

    /**
     * Tampilkan detail rapat dan QR code
     */
    public function show(Rapat $rapat)
    {
        return view('rapat.show', compact('rapat'));
    }

    /**
     * Tampilkan daftar rapat
     */
    public function index()
    {
        $rapats = Rapat::orderBy('tanggal', 'desc')->get();
        return view('rapat.index', compact('rapats'));
    }
}
