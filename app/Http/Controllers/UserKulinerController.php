<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatKuliner;

class UserKulinerController extends Controller
{
    public function index()
    {
        $kuliner = TempatKuliner::all();
        return view('user.kuliner', compact('kuliner'));
    }

    public function show($id)
    {
        $kuliner = TempatKuliner::with(['foto','jamOperasional'])->findOrFail($id);
        return view('user.kuliner', compact('kuliner'));
    }
}
