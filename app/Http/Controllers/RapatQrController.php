<?php

namespace App\Http\Controllers;

use App\Models\Rapat;

class RapatQrController extends Controller
{
    public function show($token)
    {
        $rapat = Rapat::where('qr_token', $token)->firstOrFail();

        return view('rapat.qr-show', compact('rapat'));
    }
}
