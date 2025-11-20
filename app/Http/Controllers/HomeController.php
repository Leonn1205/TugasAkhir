<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatKuliner;
use App\Models\TempatWisata;
use App\Models\KategoriWisata;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // ========== AUTH LOGIC ==========
        // dd(auth()->check(), auth()->user());

        if (auth()->check()) {
            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'superadmin') {
                return redirect()->route('superadmin.dashboard_user');
            }
        }

        // ========== DROPDOWN DATA ==========

        // Wisata: kategori dari tabel master
        $kategoriWisataList = KategoriWisata::all();

        // Kuliner: kategori dari JSON kuliner (unique)
        $kuliner = TempatKuliner::all();
        $kategoriKulinerList = $kuliner
            ->map(fn ($item) => json_decode($item->kategori, true) ?: [])
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        // ========== FILTERING ==========

        // Filter wisata
        $filterWisata = $request->filter_wisata;
        $wisata = ($filterWisata && $filterWisata !== 'semua')
            ? TempatWisata::where('id_kategori', $filterWisata)->get()
            : TempatWisata::all();

        // Filter kuliner
        $filterKuliner = $request->filter_kuliner;
        $kulinerFiltered = ($filterKuliner && $filterKuliner !== 'semua')
            ? TempatKuliner::whereJsonContains('kategori', $filterKuliner)->get()
            : TempatKuliner::all();

        $lat = $request->lat;
        $lng = $request->lng;

        if ($lat && $lng) {
            $wisata = TempatWisata::selectRaw("
                *,
                (
                    6371 * acos(
                        cos(radians(?)) *
                        cos(radians(latitude)) *
                        cos(radians(longitude) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(latitude))
                    )
                ) AS jarak
            ", [$lat, $lng, $lat])
            ->orderBy('jarak', 'ASC')
            ->limit(10)
            ->get();
        } else {
            $wisata = TempatWisata::all();
        }

        if ($lat && $lng) {
            $kulinerFiltered = TempatKuliner::selectRaw("
                *,
                (
                    6371 * acos(
                        cos(radians(?)) *
                        cos(radians(latitude)) *
                        cos(radians(longitude) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(latitude))
                    )
                ) AS jarak
            ", [$lat, $lng, $lat])
            ->orderBy('jarak', 'ASC')
            ->limit(10)
            ->get();
        } else {
            $kulinerFiltered = TempatKuliner::all();
        }

        return view('welcome', compact(
            'kategoriWisataList',
            'kategoriKulinerList',
            'wisata',
            'kulinerFiltered',
            'filterWisata',
            'filterKuliner'
        ));
    }
}
