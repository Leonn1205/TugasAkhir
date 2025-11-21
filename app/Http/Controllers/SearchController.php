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


        $results = TempatWisata::select('id_wisata as id', 'nama_wisata as nama', 'longitude', 'latitude')
            ->where('nama_wisata', 'LIKE', '%' . $q . '%')
            ->get()
            ->map(fn($i) => tap($i, fn() => $i->tipe = 'wisata'))
            ->concat(
                TempatKuliner::select('id_kuliner as id', 'nama_sentra as nama', 'longitude', 'latitude')
                ->where('nama_sentra', 'LIKE', '%' . $q . '%')
                ->get()
                ->map(fn($i) => tap($i, fn() => $i->tipe = 'kuliner'))
            );



        return response()->json($results);
    }
}
