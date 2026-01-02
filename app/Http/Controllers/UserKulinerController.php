<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatKuliner;

class UserKulinerController extends Controller
{
    public function index()
    {
        $kuliner = TempatKuliner::with(['foto', 'kategoriAktif'])
            ->aktif()
            ->get();

        return view('user.kuliner-list', compact('kuliner'));
    }

    public function show($id)
    {
        // Pakai jamOperasionalAdmin untuk tampilkan semua hari (termasuk libur)
        $kuliner = TempatKuliner::with(['foto', 'jamOperasionalAdmin', 'kategoriAktif'])
            ->findOrFail($id);

        return view('user.kuliner', compact('kuliner'));
    }
}
