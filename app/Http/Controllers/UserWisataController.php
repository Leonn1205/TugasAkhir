<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use Illuminate\Http\Request;

class UserWisataController extends Controller
{
    public function index()
    {
        $wisata = TempatWisata::with(['foto', 'kategoriAktif'])
            ->aktif()
            ->get();

        return view('user.wisata-list', compact('wisata'));
    }

    public function show($id)
    {
        // Pakai jamOperasionalAdmin untuk tampilkan semua hari (termasuk libur)
        $wisata = TempatWisata::with(['foto', 'jamOperasionalAdmin', 'kategoriAktif'])
            ->findOrFail($id);

        return view('user.wisata', compact('wisata'));
    }
}
