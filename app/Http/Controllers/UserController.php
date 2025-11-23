<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;
use App\Models\TempatKuliner;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
