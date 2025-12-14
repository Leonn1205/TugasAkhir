<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\FotoWisata;
use App\Models\JamOperasionalWisata;
use App\Models\KategoriWisata;
use Illuminate\Http\Request;
use App\Services\WilayahKotabaruService;
use App\Services\TempatWisataService;
use Illuminate\Support\Facades\Log;


class TempatWisataController extends Controller
{
    // GET /dashboard/wisata
    public function index()
    {
        $wisata = TempatWisata::with(['foto','jamOperasional','kategori'])->get();
        return view('wisata.index', compact('wisata'));
    }

    // GET /dashboard/wisata/create
    public function create()
    {
        $kategori = KategoriWisata::all(); // ambil semua kategori untuk dropdown
        $selectedKategori = old('kategori', []);
        return view('wisata.create', compact('kategori', 'selectedKategori'));
    }

    public function store(Request $request , WilayahKotabaruService $wilayah, TempatWisataService $wisataServices)
    {
        $validated = $request->validate([
            'nama_wisata'   => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategori_wisata,id_kategori',
            'longitude'     => 'required|numeric',
            'latitude'      => 'required|numeric',
            'deskripsi'     => 'required|string',
            'sejarah'       => 'required|string',
            'narasi'        => 'required|string',
            'foto.*'        => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (! $wilayah->dalamBoundingBox(
            $validated['latitude'],
            $validated['longitude']
            )) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        try {
            $wisataServices->buatWisata($validated, $request);
        } catch(\Throwable $e) {
            Log::error($e);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);}


        return redirect()->route('wisata.index')
            ->with('success','Tempat wisata berhasil ditambahkan!');
    }

    // GET /dashboard/wisata/{id}/edit
    public function edit($id)
    {
        $wisata = TempatWisata::with(['foto','jamOperasional','kategori'])->findOrFail($id);
        $kategori = KategoriWisata::all();
        return view('wisata.edit', compact('wisata','kategori'));
    }

    // Update
    public function update(Request $request, $id , WilayahKotabaruService $wilayah, TempatWisataService $wisataServices)
    {
        $validated = $request->validate([
            'nama_wisata'   => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'kategori'    => 'required|array',
            'kategori.*'  => 'exists:kategori_wisata,id_kategori',
            'longitude'   => 'required|numeric',
            'latitude'    => 'required|numeric',
            'deskripsi'   => 'required|string',
            'sejarah'     => 'required|string',
            'narasi'      => 'required|string',
        ]);

        if (
            isset($validated['latitude'], $validated['longitude']) &&
            ! $wilayah->dalamBoundingBox(
                $validated['latitude'],
                $validated['longitude']
            )
        ) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        $foto = $request->file('foto');
        $jam_operasional = [
            'hari' => $request->input('hari', []),
            'jam_buka' => $request->input('jam_buka', []),
            'jam_tutup' => $request->input('jam_tutup', []),
            'libur' => $request->input('libur', []),
        ];

        try {
            $wisataServices->updateWisata($id, $validated, $foto, $jam_operasional);
        } catch(\Throwable $e) {
            Log::error($e);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']);
        }

        return redirect()->route('wisata.index')
            ->with('success','Data berhasil diperbarui!');
    }

    // DELETE /dashboard/wisata/{id}
    public function destroy($id)
    {
        $wisata = TempatWisata::findOrFail($id);
        $wisata->delete();

        return back()->with('success','Data berhasil dihapus!');
    }

    public function show($id)
    {
        $wisata = TempatWisata::with(['foto','jamOperasional','kategori'])->findOrFail($id);
        return view('wisata.show', compact('wisata'));
    }

    // API untuk peta
    public function api()
    {
        return response()->json(
            TempatWisata::with(['foto', 'jamOperasional','kategori'])->get()
        );
    }
}
