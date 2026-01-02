<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\TempatKuliner;
use App\Models\KategoriWisata;
use App\Models\KategoriKuliner;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        // Ambil kategori AKTIF dari database
        $kategoriWisata = KategoriWisata::aktif()
            ->orderBy('nama_kategori')
            ->get();

        $kategoriKuliner = KategoriKuliner::aktif()
            ->orderBy('nama_kategori')
            ->get();

        // Data marker - hanya tempat yang AKTIF dengan relasi
        $wisata = TempatWisata::aktif()
            ->with([
                'kategoriAktif:id_kategori,nama_kategori',
                'foto' => fn($q) => $q->limit(1),
                'jamOperasionalUser'
            ])
            ->get();

        $kuliner = TempatKuliner::aktif()
            ->with([
                'kategoriAktif:id_kategori,nama_kategori',
                'foto' => fn($q) => $q->limit(1),
                'jamOperasionalUser'
            ])
            ->get();

        return view('map', compact(
            'kategoriWisata',
            'kategoriKuliner',
            'wisata',
            'kuliner'
        ));
    }

    /**
     * API endpoint untuk mendapatkan markers berdasarkan filter
     */
    public function getMarkers(Request $request)
    {
        $type = $request->type; // 'wisata' atau 'kuliner'
        $kategori = $request->kategori;
        $lat = $request->lat;
        $lng = $request->lng;
        $radius = $request->radius ?? 10; // default 10km

        if ($type === 'wisata') {
            $query = TempatWisata::aktif()
                ->with([
                    'kategoriAktif:id_kategori,nama_kategori',
                    'foto' => fn($q) => $q->limit(1)
                ]);

            if ($kategori && $kategori !== 'semua') {
                $query->byKategori([$kategori]);
            }

            if ($lat && $lng) {
                $query->nearby($lat, $lng, $radius);
            }

            $data = $query->get();

        } elseif ($type === 'kuliner') {
            $query = TempatKuliner::aktif()
                ->with([
                    'kategoriAktif:id_kategori,nama_kategori',
                    'foto' => fn($q) => $q->limit(1)
                ]);

            if ($kategori && $kategori !== 'semua') {
                $query->byKategori([$kategori]);
            }

            if ($lat && $lng) {
                $query->nearby($lat, $lng, $radius);
            }

            $data = $query->get();

        } else {
            // Return both
            $wisata = TempatWisata::aktif()
                ->with([
                    'kategoriAktif:id_kategori,nama_kategori',
                    'foto' => fn($q) => $q->limit(1)
                ])
                ->get()
                ->map(function($item) {
                    $item->type = 'wisata';
                    return $item;
                });

            $kuliner = TempatKuliner::aktif()
                ->with([
                    'kategoriAktif:id_kategori,nama_kategori',
                    'foto' => fn($q) => $q->limit(1)
                ])
                ->get()
                ->map(function($item) {
                    $item->type = 'kuliner';
                    return $item;
                });

            return response()->json([
                'wisata' => $wisata,
                'kuliner' => $kuliner
            ]);
        }

        return response()->json($data);
    }
}
