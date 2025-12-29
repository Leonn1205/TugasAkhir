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
    protected $wisataService;
    protected $wilayahService;

    public function __construct(
        TempatWisataService $wisataService,
        WilayahKotabaruService $wilayahService
    ) {
        $this->wisataService = $wisataService;
        $this->wilayahService = $wilayahService;
    }

    /**
     * ✅ UPDATED: Gunakan kategoriAktif untuk display
     */
    public function index()
    {
        $wisata = TempatWisata::with([
            'foto',
            'jamOperasionalAdmin',
            'kategoriAktif'  // ← CHANGED: kategori → kategoriAktif
        ])->get();

        return view('wisata.index', compact('wisata'));
    }

    public function create()
    {
        $kategori = KategoriWisata::aktif()->orderBy('nama_kategori', 'asc')->get();
        $selectedKategori = old('kategori', []);
        return view('wisata.create', compact('kategori', 'selectedKategori'));
    }

    public function store(Request $request)
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
            'foto'           => 'required|array|min:1',
            'foto.*'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'hari'           => 'required|array|size:7',
            'hari.*'         => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_buka'       => 'nullable|array',
            'jam_tutup'      => 'nullable|array',
            'libur'          => 'nullable|array',
        ]);

        // Validasi lokasi dalam wilayah Kotabaru
        if (!$this->wilayahService->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        try {
            $this->wisataService->store($validated, $request);

            return redirect()->route('wisata.index')
                ->with('success', 'Tempat wisata berhasil ditambahkan!');
        } catch (\Throwable $e) {
            Log::error('Error creating wisata: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
        }
    }

    /**
     * Untuk edit, tetap gunakan kategori (semua) karena admin perlu lihat semua
     */
    public function edit($id)
    {
        $wisata = TempatWisata::with([
            'foto',
            'jamOperasionalAdmin',
            'kategori'  // ← TETAP: kategori (semua) untuk admin
        ])->findOrFail($id);

        $kategori = KategoriWisata::aktif()->orderBy('nama_kategori', 'asc')->get();
        return view('wisata.edit', compact('wisata', 'kategori'));
    }

    public function update(Request $request, $id)
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
            'foto'           => 'nullable|array',
            'foto.*'         => 'image|mimes:jpg,jpeg,png|max:2048',
            'hari'           => 'required|array|size:7',
            'hari.*'         => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_buka'       => 'nullable|array',
            'jam_tutup'      => 'nullable|array',
            'libur'          => 'nullable|array',
        ]);

        // Validasi lokasi dalam wilayah Kotabaru
        if (!$this->wilayahService->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        try {
            $this->wisataService->update($id, $validated, $request);

            return redirect()->route('wisata.index')
                ->with('success', 'Data berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('Error updating wisata: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']);
        }
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

    /**
     * ✅ UPDATED: Gunakan kategoriAktif untuk public
     */
    public function show($id)
    {
        $wisata = TempatWisata::with([
            'foto',
            'jamOperasionalUser',
            'kategoriAktif'  // ← CHANGED: kategori → kategoriAktif
        ])
            ->aktif()
            ->findOrFail($id);

        return view('wisata.show', compact('wisata'));
    }

    /**
     * ✅ UPDATED: Gunakan kategoriAktif untuk API public
     */
    public function api()
    {
        $wisata = TempatWisata::with([
            'foto',
            'jamOperasionalUser',
            'kategoriAktif'  // ← CHANGED: kategori → kategoriAktif
        ])
            ->aktif()
            ->get()
            ->map(function ($item) {
                return array_merge($item->toArray(), [
                    'open_status' => $item->getOpenStatus()
                ]);
            });

        return response()->json($wisata);
    }

    /**
     * Hapus foto individual
     */
    public function deleteFoto($id)
    {
        try {
            $foto = FotoWisata::findOrFail($id);

            // Pastikan minimal ada 1 foto tersisa
            $wisata = TempatWisata::findOrFail($foto->id_wisata);
            if ($wisata->foto()->count() <= 1) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus foto. Minimal harus ada 1 foto.']);
            }

            $this->wisataService->deleteFoto($id);

            return back()->with('success', 'Foto berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Error deleting foto wisata: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus foto.']);
        }
    }
}
