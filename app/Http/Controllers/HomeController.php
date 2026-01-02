<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatKuliner;
use App\Models\TempatWisata;
use App\Models\KategoriWisata;
use App\Models\KategoriKuliner;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // ========== AUTH LOGIC ==========
        if (auth()->check()) {
            $role = auth()->user()->role;

            if ($role === 'Admin') {
                return redirect()->route('dashboard.admin');
            } elseif ($role === 'Super Admin') {
                return redirect()->route('dashboard.superadmin');
            }
        }

        // ========== DROPDOWN DATA ==========
        $kategoriWisataList = KategoriWisata::aktif()
            ->orderBy('nama_kategori')
            ->get();

        $kategoriKulinerList = KategoriKuliner::aktif()
            ->orderBy('nama_kategori')
            ->get();

        // ========== FILTERING ==========
        $filterWisata = $request->filter_wisata;
        $filterKuliner = $request->filter_kuliner;
        $lat = $request->lat;
        $lng = $request->lng;

        // Query Wisata
        $wisataQuery = TempatWisata::aktif()
            ->with([
                'kategoriAktif:id_kategori,nama_kategori',
                'foto' => fn($q) => $q->limit(1)
            ]);

        if ($filterWisata && $filterWisata !== 'semua') {
            $wisataQuery->byKategori([$filterWisata]);
        }

        // Query Kuliner
        $kulinerQuery = TempatKuliner::aktif()
            ->with([
                'kategoriAktif:id_kategori,nama_kategori',
                'foto' => fn($q) => $q->limit(1)
            ]);

        if ($filterKuliner && $filterKuliner !== 'semua') {
            $kulinerQuery->byKategori([$filterKuliner]);
        }

        // ========== GEOLOCATION FILTER ==========
        if ($lat && $lng) {
            $wisata = $wisataQuery
                ->nearby($lat, $lng, 10)
                ->limit(20)
                ->get();

            $kulinerFiltered = $kulinerQuery
                ->nearby($lat, $lng, 10)
                ->limit(20)
                ->get();
        } else {
            $wisata = $wisataQuery
                ->latest('created_at')
                ->limit(20)
                ->get();

            $kulinerFiltered = $kulinerQuery
                ->latest('created_at')
                ->limit(20)
                ->get();
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
