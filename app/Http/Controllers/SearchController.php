<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;
use App\Models\TempatKuliner;

class SearchController extends Controller
{
    /**
     * Search untuk landing page dan map
     */
    public function searchAll(Request $request)
    {
        $q = $request->input('query');

        // Validasi input
        if (empty($q) || strlen($q) < 2) {
            return response()->json([]);
        }

        // Search Wisata (hanya yang aktif)
        $wisata = TempatWisata::aktif()
            ->select('id_wisata as id', 'nama_wisata as nama', 'longitude', 'latitude')
            ->where('nama_wisata', 'LIKE', "%{$q}%")
            ->with('kategoriAktif:id_kategori,nama_kategori')
            ->limit(10)
            ->get()
            ->map(function($item) {
                $item->tipe = 'wisata';
                $item->kategori = $item->kategoriAktif->pluck('nama_kategori')->join(', ');
                unset($item->kategoriAktif);
                return $item;
            });

        // Search Kuliner (hanya yang aktif)
        $kuliner = TempatKuliner::aktif()
            ->select('id_kuliner as id', 'nama_sentra as nama', 'longitude', 'latitude')
            ->where('nama_sentra', 'LIKE', "%{$q}%")
            ->with('kategoriAktif:id_kategori,nama_kategori')
            ->limit(10)
            ->get()
            ->map(function($item) {
                $item->tipe = 'kuliner';
                $item->kategori = $item->kategoriAktif->pluck('nama_kategori')->join(', ');
                unset($item->kategoriAktif);
                return $item;
            });

        // Gabungkan hasil
        $results = $wisata->concat($kuliner);

        return response()->json($results);
    }

    /**
     * Advanced search dengan filter
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2',
            'type' => 'nullable|in:wisata,kuliner,all',
            'kategori' => 'nullable|integer',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'radius' => 'nullable|numeric|min:1|max:50'
        ]);

        $query = $request->query;
        $type = $request->type ?? 'all';
        $kategori = $request->kategori;
        $lat = $request->lat;
        $lng = $request->lng;
        $radius = $request->radius ?? 10;

        $results = collect();

        // Search Wisata
        if ($type === 'all' || $type === 'wisata') {
            $wisataQuery = TempatWisata::aktif()
                ->with([
                    'kategoriAktif:id_kategori,nama_kategori',
                    'foto' => fn($q) => $q->limit(1)
                ])
                ->where('nama_wisata', 'LIKE', "%{$query}%");

            if ($kategori) {
                $wisataQuery->byKategori([$kategori]);
            }

            if ($lat && $lng) {
                $wisataQuery->nearby($lat, $lng, $radius);
            }

            $wisata = $wisataQuery->limit(20)->get()->map(function($item) {
                return [
                    'id' => $item->id_wisata,
                    'nama' => $item->nama_wisata,
                    'tipe' => 'wisata',
                    'kategori' => $item->kategoriAktif->pluck('nama_kategori')->join(', '),
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'foto' => $item->foto->first()?->url_foto,
                    'url' => route('user.wisata.show', $item->id_wisata)
                ];
            });

            $results = $results->concat($wisata);
        }

        // Search Kuliner
        if ($type === 'all' || $type === 'kuliner') {
            $kulinerQuery = TempatKuliner::aktif()
                ->with([
                    'kategoriAktif:id_kategori,nama_kategori',
                    'foto' => fn($q) => $q->limit(1)
                ])
                ->where('nama_sentra', 'LIKE', "%{$query}%");

            if ($kategori) {
                $kulinerQuery->byKategori([$kategori]);
            }

            if ($lat && $lng) {
                $kulinerQuery->nearby($lat, $lng, $radius);
            }

            $kuliner = $kulinerQuery->limit(20)->get()->map(function($item) {
                return [
                    'id' => $item->id_kuliner,
                    'nama' => $item->nama_sentra,
                    'tipe' => 'kuliner',
                    'kategori' => $item->kategoriAktif->pluck('nama_kategori')->join(', '),
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'foto' => $item->foto->first()?->url_foto,
                    'url' => route('user.kuliner.show', $item->id_kuliner)
                ];
            });

            $results = $results->concat($kuliner);
        }

        return response()->json([
            'query' => $query,
            'total' => $results->count(),
            'results' => $results
        ]);
    }

    /**
     * Autocomplete untuk search box
     */
    public function autocomplete(Request $request)
    {
        $q = $request->input('query');

        if (empty($q) || strlen($q) < 2) {
            return response()->json([]);
        }

        // Ambil nama wisata
        $wisata = TempatWisata::aktif()
            ->select('nama_wisata as text')
            ->where('nama_wisata', 'LIKE', "%{$q}%")
            ->limit(5)
            ->pluck('text');

        // Ambil nama kuliner
        $kuliner = TempatKuliner::aktif()
            ->select('nama_sentra as text')
            ->where('nama_sentra', 'LIKE', "%{$q}%")
            ->limit(5)
            ->pluck('text');

        $suggestions = $wisata->concat($kuliner)->unique()->values();

        return response()->json($suggestions);
    }
}
