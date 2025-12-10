<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\TempatKuliner;
use App\Models\KategoriWisata;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {

        $kategoriWisata = KategoriWisata::all();


        $kategoriKuliner = config('kategori.kuliner');

        // Data marker
         $wisata = TempatWisata::with('kategori')->where('status', 'aktif')->get();
        $kuliner = TempatKuliner::where('status', 'aktif')->get();

        return view('welcome', compact(
            'kategoriWisata',
            'kategoriKuliner',
            'wisata',
            'kuliner'
        ));
    }
}
