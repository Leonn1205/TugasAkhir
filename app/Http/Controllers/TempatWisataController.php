<?php

namespace App\Http\Controllers;

use App\Models\FotoWisata;
use App\Models\TempatWisata;
use App\Models\KategoriWisata;
use Illuminate\Http\Request;
use App\Services\WilayahKotabaruService;
use App\Services\TempatWisataService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TempatWisataController extends Controller
{
    public function index()
    {
        $wisata = TempatWisata::with(['foto', 'jamOperasionalAdmin', 'kategori'])->get();
        return view('wisata.index', compact('wisata'));
    }

    public function create()
    {
        $kategori = KategoriWisata::aktif()->orderBy('nama_kategori', 'asc')->get();
        $selectedKategori = old('kategori', []);
        return view('wisata.create', compact('kategori', 'selectedKategori'));
    }

    public function store(Request $request, WilayahKotabaruService $wilayah, TempatWisataService $wisataServices)
    {
        $validated = $request->validate([
            'nama_wisata'    => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'kategori'       => 'required|array',
            'kategori.*'     => 'exists:kategori_wisata,id_kategori',
            'longitude'      => 'required|numeric',
            'latitude'       => 'required|numeric',
            'deskripsi'      => 'required|string',
            'sejarah'        => 'required|string',
            'narasi'         => 'required|string',
            'foto.*'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'hari'           => 'required|array',
            'hari.*'         => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_buka'       => 'array',
            'jam_tutup'      => 'array',
            'libur'          => 'array',
        ]);

        if (!$wilayah->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        try {
            $wisataServices->buatWisata($validated, $request);
        } catch (\Throwable $e) {
            Log::error('Error creating wisata: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
        }

        return redirect()->route('wisata.index')
            ->with('success', 'Tempat wisata berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $wisata = TempatWisata::with(['foto', 'jamOperasionalAdmin', 'kategori'])->findOrFail($id);
        $kategori = KategoriWisata::aktif()->orderBy('nama_kategori', 'asc')->get();
        return view('wisata.edit', compact('wisata', 'kategori'));
    }

    public function update(Request $request, $id, WilayahKotabaruService $wilayah, TempatWisataService $wisataServices)
    {
        $validated = $request->validate([
            'nama_wisata'    => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'kategori'       => 'required|array',
            'kategori.*'     => 'exists:kategori_wisata,id_kategori',
            'longitude'      => 'required|numeric',
            'latitude'       => 'required|numeric',
            'deskripsi'      => 'required|string',
            'sejarah'        => 'required|string',
            'narasi'         => 'required|string',
            'foto.*'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'hari'           => 'required|array',
            'hari.*'         => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_buka'       => 'array',
            'jam_tutup'      => 'array',
            'libur'          => 'array',
        ]);

        if (!$wilayah->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        $foto = $request->file('foto');
        $jamOperasional = [
            'hari'      => $request->input('hari', []),
            'jam_buka'  => $request->input('jam_buka', []),
            'jam_tutup' => $request->input('jam_tutup', []),
            'libur'     => $request->input('libur', []),
        ];

        try {
            $wisataServices->updateWisata($id, $validated, $foto, $jamOperasional);
        } catch (\Throwable $e) {
            Log::error('Error updating wisata: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']);
        }

        return redirect()->route('wisata.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $wisata = TempatWisata::findOrFail($id);

            // Hapus file foto dari storage
            foreach ($wisata->foto as $foto) {
                if (Storage::disk('public')->exists($foto->path_foto)) {
                    Storage::disk('public')->delete($foto->path_foto);
                }
            }

            $wisata->delete();

            return back()->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Error deleting wisata: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }

    public function show($id)
    {
        $wisata = TempatWisata::with(['foto', 'jamOperasionalUser', 'kategori'])
            ->aktif()
            ->findOrFail($id);
        return view('wisata.show', compact('wisata'));
    }

    public function api()
    {
        return response()->json(
            TempatWisata::with(['foto', 'jamOperasionalUser', 'kategori'])
                ->aktif()
                ->get()
        );
    }

    // Method untuk menghapus foto individual
    public function deleteFoto($id)
    {
        try {
            $foto = FotoWisata::findOrFail($id);

            // Pastikan minimal ada 1 foto tersisa
            $wisata = TempatWisata::findOrFail($foto->id_wisata);
            if ($wisata->foto()->count() <= 1) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus foto. Minimal harus ada 1 foto.']);
            }

            // Hapus file dari storage
            if (Storage::disk('public')->exists($foto->path_foto)) {
                Storage::disk('public')->delete($foto->path_foto);
            }

            $foto->delete();

            return back()->with('success', 'Foto berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Error deleting foto wisata: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus foto.']);
        }
    }
}
