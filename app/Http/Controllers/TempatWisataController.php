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

    public function index()
    {
        $wisata = TempatWisata::with([
            'foto',
            'jamOperasionalAdmin',
            'kategoriAktif'
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
        $validated = $request->validate(
            [
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
            ],
            [
                'nama_wisata.required' => 'Nama tempat wisata wajib diisi.',
                'nama_wisata.max' => 'Nama tempat wisata maksimal 255 karakter.',
                'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
                'kategori.required' => 'Kategori wisata wajib dipilih minimal 1.',
                'longitude.required' => 'Longitude wajib diisi.',
                'longitude.numeric' => 'Longitude harus berupa angka.',
                'latitude.required' => 'Latitude wajib diisi.',
                'latitude.numeric' => 'Latitude harus berupa angka.',
                'deskripsi.required' => 'Deskripsi tempat wisata wajib diisi.',
                'sejarah.required' => 'Sejarah tempat wisata wajib diisi.',
                'narasi.required' => 'Narasi tempat wisata wajib diisi.',
                'foto.required' => 'Foto wisata wajib diunggah minimal 1.',
                'foto.min' => 'Minimal 1 foto harus diunggah.',
                'foto.*.image' => 'File harus berupa gambar.',
                'foto.*.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
                'foto.*.max' => 'Ukuran foto maksimal 2MB per file.',
            ]
        );

        // ✅ VALIDASI LOKASI
        if (!$this->wilayahService->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors([
                    'latitude' => 'Koordinat berada di luar wilayah Kotabaru.',
                    'longitude' => 'Koordinat berada di luar wilayah Kotabaru.',
                    'lokasi' => '⚠️ Lokasi yang dimasukkan berada di luar wilayah Kotabaru.'
                ])
                ->with('previous_files', $this->getFileInfo($request->file('foto')));
        }

        // ✅ VALIDASI JAM OPERASIONAL
        $validationError = $this->validateJamOperasional(
            $request->input('hari', []),
            $request->input('jam_buka', []),
            $request->input('jam_tutup', []),
            $request->input('libur', [])
        );

        if ($validationError) {
            return back()
                ->withInput()
                ->withErrors(['jam_operasional' => $validationError])
                ->with('previous_files', $this->getFileInfo($request->file('foto')));
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

    public function edit($id)
    {
        $wisata = TempatWisata::with([
            'foto',
            'jamOperasionalAdmin',
            'kategori'
        ])->findOrFail($id);

        $kategori = KategoriWisata::aktif()->orderBy('nama_kategori', 'asc')->get();
        return view('wisata.edit', compact('wisata', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
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
            ],
            [
                'nama_wisata.required' => 'Nama tempat wisata wajib diisi.',
                'nama_wisata.max' => 'Nama tempat wisata maksimal 255 karakter.',
                'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
                'kategori.required' => 'Kategori wisata wajib dipilih minimal 1.',
                'longitude.required' => 'Longitude wajib diisi.',
                'longitude.numeric' => 'Longitude harus berupa angka.',
                'latitude.required' => 'Latitude wajib diisi.',
                'latitude.numeric' => 'Latitude harus berupa angka.',
                'deskripsi.required' => 'Deskripsi tempat wisata wajib diisi.',
                'sejarah.required' => 'Sejarah tempat wisata wajib diisi.',
                'narasi.required' => 'Narasi tempat wisata wajib diisi.',
                'foto.required' => 'Foto wisata wajib diunggah minimal 1.',
                'foto.min' => 'Minimal 1 foto harus diunggah.',
                'foto.*.image' => 'File harus berupa gambar.',
                'foto.*.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
                'foto.*.max' => 'Ukuran foto maksimal 2MB per file.',
            ]
        );

        // ✅ VALIDASI LOKASI
        if (!$this->wilayahService->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors([
                    'latitude' => 'Koordinat berada di luar wilayah Kotabaru.',
                    'longitude' => 'Koordinat berada di luar wilayah Kotabaru.',
                    'lokasi' => '⚠️ Lokasi yang dimasukkan berada di luar wilayah Kotabaru.'
                ])
                ->with('previous_files', $this->getFileInfo($request->file('foto')));
        }

        // ✅ VALIDASI JAM OPERASIONAL
        $validationError = $this->validateJamOperasional(
            $request->input('hari', []),
            $request->input('jam_buka', []),
            $request->input('jam_tutup', []),
            $request->input('libur', [])
        );

        if ($validationError) {
            return back()
                ->withInput()
                ->withErrors(['jam_operasional' => $validationError])
                ->with('previous_files', $this->getFileInfo($request->file('foto')));
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
        $wisata = TempatWisata::with([
            'foto',
            'jamOperasionalUser',
            'kategoriAktif'
        ])
            ->aktif()
            ->findOrFail($id);

        return view('wisata.show', compact('wisata'));
    }

    public function api()
    {
        $wisata = TempatWisata::with([
            'foto',
            'jamOperasionalUser',
            'kategoriAktif'
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

    public function deleteFoto($id)
    {
        try {
            $foto = FotoWisata::findOrFail($id);

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

    public function toggleStatus($id)
    {
        try {
            $wisata = TempatWisata::findOrFail($id);
            $wisata->update(['status' => !$wisata->status]);

            $statusText = $wisata->status ? 'diaktifkan' : 'dinonaktifkan';

            return redirect()->route('wisata.index')
                ->with('success', "Tempat wisata {$wisata->nama_wisata} berhasil {$statusText}!");
        } catch (\Throwable $e) {
            Log::error('Error toggling wisata status: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengubah status.']);
        }
    }

    // ============================================================================
    // ✅ PRIVATE HELPER METHODS
    // ============================================================================

    /**
     * Validasi jam operasional
     *
     * @return string|null Error message jika ada error, null jika valid
     */
    private function validateJamOperasional(array $hari, array $jamBuka, array $jamTutup, array $libur)
    {
        foreach ($hari as $index => $day) {
            // Skip validasi jika hari libur
            if (in_array($index, $libur)) {
                continue;
            }

            // ✅ SKIP jika 00:00 (indikasi libur dari JavaScript)
            if (($jamBuka[$index] ?? null) === '00:00' && ($jamTutup[$index] ?? null) === '00:00') {
                continue;
            }

            // Validasi jam tidak boleh kosong untuk hari operasional
            if (empty($jamBuka[$index]) || empty($jamTutup[$index])) {
                return "Jam buka dan tutup pada hari {$day} harus diisi!";
            }

            // Validasi format waktu HH:MM
            if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $jamBuka[$index])) {
                return "Format jam buka pada hari {$day} tidak valid! Gunakan format HH:MM (contoh: 08:00)";
            }

            if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $jamTutup[$index])) {
                return "Format jam tutup pada hari {$day} tidak valid! Gunakan format HH:MM (contoh: 17:00)";
            }

            // ✅ VALIDASI UTAMA: Jam tutup harus lebih besar dari jam buka
            if ($jamTutup[$index] <= $jamBuka[$index]) {
                return "Jam tutup pada hari {$day} harus lebih besar dari jam buka! (Buka: {$jamBuka[$index]}, Tutup: {$jamTutup[$index]})";
            }
        }

        return null; // Valid
    }

    /**
     * Get info file untuk session (saat validation error)
     */
    private function getFileInfo($files)
    {
        if (!$files) {
            return [];
        }

        $fileInfo = [];
        foreach ($files as $file) {
            $sizeKB = round($file->getSize() / 1024, 2);
            $fileInfo[] = [
                'name' => $file->getClientOriginalName(),
                'size' => $sizeKB > 1024
                    ? round($sizeKB / 1024, 2) . ' MB'
                    : $sizeKB . ' KB'
            ];
        }
        return $fileInfo;
    }
}
