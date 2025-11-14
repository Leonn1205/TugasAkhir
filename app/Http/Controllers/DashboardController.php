<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;
use App\Models\TempatKuliner;

class DashboardController extends Controller
{
    public function index()
    {
        $wisata = TempatWisata::with(['kategori', 'foto', 'jamOperasional'])->get();
        $kuliner = TempatKuliner::with(['foto', 'jamOperasional'])->get();

        return view('dashboard_admin', compact('wisata', 'kuliner'));
    }
}
