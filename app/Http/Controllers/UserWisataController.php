<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use Illuminate\Http\Request;

class UserWisataController extends Controller
{
    public function index()
    {
        $wisata = TempatWisata::all();
        return view('user.wisata', compact('wisata'));
    }

    public function show($id)
    {
        $wisata = TempatWisata::with(['foto','jamOperasional'])->findOrFail($id);
        return view('user.wisata', compact('wisata'));
    }
}
