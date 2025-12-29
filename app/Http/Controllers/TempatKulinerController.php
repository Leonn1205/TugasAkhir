<?php

namespace App\Http\Controllers;

use App\Models\TempatKuliner;
use App\Models\FotoKuliner;
use App\Models\KategoriKuliner;
use Illuminate\Http\Request;
use App\Services\WilayahKotabaruService;
use App\Services\TempatKulinerService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TempatKulinerController extends Controller
{
    protected $kulinerService;
    protected $wilayahService;

    public function __construct(
        TempatKulinerService $kulinerService,
        WilayahKotabaruService $wilayahService
    ) {
        $this->kulinerService = $kulinerService;
        $this->wilayahService = $wilayahService;
    }

    /**
     * ✅ UPDATED: Gunakan kategoriAktif untuk display
     */
    public function index()
    {
        $kuliner = TempatKuliner::with([
            'foto',
            'jamOperasionalAdmin',
            'kategoriAktif'  // ← CHANGED: kategori → kategoriAktif
        ])->get();

        return view('kuliner.index', compact('kuliner'));
    }

    public function create()
    {
        $kategori = KategoriKuliner::aktif()->orderBy('nama_kategori', 'asc')->get();
        $selectedKategori = old('kategori', []);
        return view('kuliner.create', compact('kategori', 'selectedKategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Identitas Usaha
            'nama_sentra' => 'required|string|max:255',
            'tahun_berdiri' => 'required|numeric|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'kepemilikan' => 'required|in:Pribadi,Keluarga,Komunitas,Waralaba',
            'alamat_lengkap' => 'required|string',
            'telepon' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'no_nib' => 'nullable|digits:13',
            'sertifikat_lain' => 'nullable|array',
            'sertifikat_lain.*' => 'string',
            'sertifikat_text' => 'required_if:sertifikat_lain.*,Lainnya|nullable|string|max:255',
            'jumlah_pegawai' => 'required|integer|min:0',
            'jumlah_kursi' => 'required|integer|min:0',
            'jumlah_gerai' => 'required|integer|min:0',
            'jumlah_pelanggan_per_hari' => 'required|integer|min:0',
            'profil_pelanggan' => 'required|array',
            'profil_pelanggan.*' => 'string|in:Lokal,Wisatawan,Pelajar/Mahasiswa,Pekerja',
            'metode_pembayaran' => 'required|array',
            'metode_pembayaran.*' => 'string|in:Tunai,Qris / Transfer',
            'pajak_retribusi' => 'required|in:Ya,Tidak',

            // Jam Operasional
            'hari' => 'required|array|size:7',
            'hari.*' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_buka' => 'nullable|array|size:7',
            'jam_buka.*' => 'nullable|date_format:H:i',
            'jam_tutup' => 'nullable|array|size:7',
            'jam_tutup.*' => 'nullable|date_format:H:i',
            'jam_sibuk_mulai' => 'nullable|array|size:7',
            'jam_sibuk_mulai.*' => 'nullable|date_format:H:i',
            'jam_sibuk_selesai' => 'nullable|array|size:7',
            'jam_sibuk_selesai.*' => 'nullable|date_format:H:i',
            'libur' => 'nullable|array',

            // Jenis Kuliner & Kategori
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategori_kuliner,id_kategori',
            'menu_unggulan' => 'required|string|max:255',
            'bahan_baku_utama' => 'required|string|max:255',
            'sumber_bahan_baku' => 'required|in:Lokal,Domestik / Luar Kota,Import / Luar Negeri,Campuran',
            'menu_bersifat' => 'required|array',
            'menu_bersifat.*' => 'string|in:Tetap,Musiman',

            // Tempat & Fasilitas
            'bentuk_fisik' => 'required|in:Restoran,Warung,Kafe,Food Court,Jasa Boga (Katering),Penyedia Makanan oleh Pedagang Keliling,Penyedia Makanan oleh Pedagang Tidak Keliling',
            'status_bangunan' => 'required|string|in:Milik Sendiri,Sewa,Pinjam Pakai,Lainnya...',
            'status_bangunan_lain' => 'required_if:status_bangunan,Lainnya...|nullable|string|max:255',
            'fasilitas_pendukung' => 'required|array',
            'fasilitas_pendukung.*' => 'string|in:Toilet,Wastafel,Parkir,Mushola,WiFi,Tempat Sampah',

            // Praktik K3 & Sanitasi
            'pelatihan_k3' => 'required|in:Ya,Tidak',
            'jumlah_penjamah_makanan' => 'required|integer|min:0',
            'apd_penjamah_makanan' => 'required|array',
            'apd_penjamah_makanan.*' => 'string|in:Masker,Hairnet,Celemek,Sarung Tangan',
            'prosedur_sanitasi_alat' => 'required|in:Tidak Melakukan,Melakukan',
            'frekuensi_sanitasi_alat' => 'required|string|max:14',
            'prosedur_sanitasi_bahan' => 'required|in:Tidak Melakukan,Melakukan',
            'frekuensi_sanitasi_bahan' => 'required|string|max:14',
            'penyimpanan_mentah' => [
                'required',
                Rule::in([
                    'Dengan Pendingin, Terpisah',
                    'Dengan Pendingin, Tidak Terpisah',
                    'Tanpa Pendingin, Terpisah',
                    'Tanpa Pendingin, Tidak Terpisah'
                ])
            ],
            'penyimpanan_matang' => [
                'required',
                Rule::in([
                    'Dengan Pendingin, Terpisah',
                    'Dengan Pendingin, Tidak Terpisah',
                    'Tanpa Pendingin, Terpisah',
                    'Tanpa Pendingin, Tidak Terpisah'
                ])
            ],
            'fifo_fefo' => 'required|in:Ya,Tidak',
            'limbah_dapur' => 'required|in:Dipisah,Tidak dipisah',
            'ventilasi_dapur' => 'required|in:Alami,Buatan',
            'dapur' => [
                'required',
                Rule::in([
                    'Ada, terpisah',
                    'Ada, tidak terpisah',
                    'Tidak ada'
                ])
            ],
            'sumber_air_cuci' => 'required|in:PDAM,Sumur,Air Isi Ulang',
            'sumber_air_masak' => 'required|in:PDAM,Sumur,Air Isi Ulang',
            'sumber_air_minum' => 'required|in:PDAM,Sumur,Air Isi Ulang',

            // Koordinat Lokasi
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',

            // Foto
            'foto' => 'required|array|min:1',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Validasi lokasi dalam wilayah Kotabaru
        if (!$this->wilayahService->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        try {
            $this->kulinerService->store($validated, $request);

            return redirect()->route('kuliner.index')
                ->with('success', 'Tempat kuliner berhasil ditambahkan!');
        } catch (\Throwable $e) {
            Log::error('Error storing kuliner: ' . $e->getMessage());

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
        $kuliner = TempatKuliner::with([
            'foto',
            'jamOperasionalAdmin',
            'kategori'  // ← TETAP: kategori (semua) untuk admin
        ])->findOrFail($id);

        $kategori = KategoriKuliner::aktif()->orderBy('nama_kategori', 'asc')->get();

        // Susun ulang data jam operasional per hari
        $jamOperasional = [];
        foreach ($kuliner->jamOperasionalAdmin as $jam) {
            $jamOperasional[$jam->hari] = [
                'buka' => $jam->jam_buka,
                'tutup' => $jam->jam_tutup,
                'sibuk_mulai' => $jam->jam_sibuk_mulai,
                'sibuk_selesai' => $jam->jam_sibuk_selesai,
                'libur' => $jam->libur,
            ];
        }

        return view('kuliner.edit', compact('kuliner', 'jamOperasional', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validation rules sama dengan store, tapi foto tidak required
        $validated = $request->validate([
            // ... (copy validation dari store, ubah foto jadi nullable)
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Validasi lokasi dalam wilayah Kotabaru
        if (!$this->wilayahService->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        try {
            $this->kulinerService->update($id, $validated, $request);

            return redirect()->route('kuliner.index')
                ->with('success', 'Data tempat kuliner berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('Error updating kuliner: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']);
        }
    }

    public function destroy($id)
    {
        try {
            $kuliner = TempatKuliner::findOrFail($id);

            // Hapus file foto dari storage
            foreach ($kuliner->foto as $foto) {
                if (Storage::disk('public')->exists($foto->path_foto)) {
                    Storage::disk('public')->delete($foto->path_foto);
                }
            }

            $kuliner->delete();

            return back()->with('success', 'Data kuliner berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Error deleting kuliner: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }

    /**
     * ✅ UPDATED: Gunakan kategoriAktif untuk public
     */
    public function show($id)
    {
        $kuliner = TempatKuliner::with([
            'foto',
            'jamOperasionalUser',
            'kategoriAktif'  // ← CHANGED: kategori → kategoriAktif
        ])
        ->aktif()
        ->findOrFail($id);

        return view('kuliner.show', compact('kuliner'));
    }

    /**
     * ✅ UPDATED: Gunakan kategoriAktif untuk API public
     */
    public function api()
    {
        $kuliner = TempatKuliner::with([
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

        return response()->json($kuliner);
    }

    /**
     * Hapus foto individual
     */
    public function deleteFoto($id)
    {
        try {
            $foto = FotoKuliner::findOrFail($id);

            // Pastikan minimal ada 1 foto tersisa
            $kuliner = TempatKuliner::findOrFail($foto->id_kuliner);
            if ($kuliner->foto()->count() <= 1) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus foto. Minimal harus ada 1 foto.']);
            }

            $this->kulinerService->deleteFoto($id);

            return back()->with('success', 'Foto berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Error deleting foto kuliner: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus foto.']);
        }
    }
}
