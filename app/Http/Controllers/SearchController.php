<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;
use App\Models\TempatKuliner;

class SearchController extends Controller
{
    public function searchAll(Request $request)
    {
        $q = $request->input('query');

        // Wisata
        $wisata = TempatWisata::where('nama_wisata', 'LIKE', "%$q%")
            ->select('id_wisata as id', 'nama_wisata as nama', 'longitude', 'latitude')
            ->get()
            ->map(function ($item) {
                $item->tipe = 'wisata';
                return $item;
            });

        // Kuliner
        $kuliner = TempatKuliner::where('nama_sentra', 'LIKE', "%$q%")
            ->select('id_kuliner as id', 'nama_sentra as nama', 'longitude', 'latitude')
            ->get()
            ->map(function ($item) {
                $item->tipe = 'kuliner';
                return $item;
            });

        $results = $wisata->merge($kuliner);

        return response()->json($results);
    }
}
