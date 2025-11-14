<?php

namespace App\Http\Controllers;

use App\Models\TempatWisata;
use App\Models\FotoWisata;
use App\Models\JamOperasionalWisata;
use App\Models\KategoriWisata;
use Illuminate\Http\Request;

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
        return view('wisata.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata'   => 'required|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'id_kategori'   => 'required|exists:kategori_wisata,id_kategori',
            'longitude'     => 'nullable|numeric',
            'latitude'      => 'nullable|numeric',
            'deskripsi'     => 'nullable|string',
            'sejarah'       => 'nullable|string',
            'narasi'        => 'nullable|string',
            'foto.*'        => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $wisata = TempatWisata::create($request->only([
            'nama_wisata',
            'alamat_lengkap',
            'id_kategori',
            'longitude',
            'latitude',
            'deskripsi',
            'sejarah',
            'narasi'
        ]));

        // Foto
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('wisata', 'public');
                FotoWisata::create([
                    'id_wisata' => $wisata->id_wisata,
                    'path_foto' => $path,
                ]);
            }
        }

        // Jam Operasional
        if ($request->filled('hari')) {
            foreach ($request->hari as $index => $hari) {
                $isLibur = isset($request->libur[$index]) && $request->libur[$index] == 1;

                JamOperasionalWisata::create([
                    'id_wisata' => $wisata->id_wisata,
                    'hari'      => $hari,
                    'jam_buka'  => $isLibur ? null : ($request->jam_buka[$index] ?? null),
                    'jam_tutup' => $isLibur ? null : ($request->jam_tutup[$index] ?? null),
                ]);
            }
        }

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_wisata'   => 'required|string|max:255',
            'id_kategori'   => 'required|exists:kategori_wisata,id_kategori',
            'longitude'   => 'nullable|numeric',
            'latitude'    => 'nullable|numeric',
            'deskripsi'   => 'nullable|string',
            'sejarah'     => 'nullable|string',
            'narasi'      => 'nullable|string',
        ]);

        $wisata = TempatWisata::findOrFail($id);
        $wisata->update($request->only([
            'nama_wisata','id_kategori',
            'longitude','latitude',
            'deskripsi','sejarah','narasi'
        ]));

        // Tambah foto baru kalau ada
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('wisata', 'public');
                FotoWisata::create([
                    'id_wisata' => $wisata->id_wisata,
                    'path_foto' => $path,
                ]);
            }
        }

        // Update jam operasional → hapus semua dulu biar bersih
        $wisata->jamOperasional()->delete();

        if ($request->filled('hari')) {
            foreach ($request->hari as $index => $hari) {
                $isLibur = isset($request->libur[$index]) && $request->libur[$index] == 1;

                JamOperasionalWisata::create([
                    'id_wisata' => $wisata->id_wisata,
                    'hari'      => $hari,
                    'jam_buka'  => $isLibur ? null : ($request->jam_buka[$index] ?? null),
                    'jam_tutup' => $isLibur ? null : ($request->jam_tutup[$index] ?? null),
                ]);
            }
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
