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
    public function index()
    {
        $kuliner = TempatKuliner::with(['foto', 'jamOperasionalAdmin', 'kategori'])->get();
        return view('kuliner.index', compact('kuliner'));
    }

    public function create()
    {
        $kategori = KategoriKuliner::aktif()->get();
        $selectedKategori = old('kategori', []);
        return view('kuliner.create', compact('kategori', 'selectedKategori'));
    }

    public function store(Request $request, WilayahKotabaruService $wilayah, TempatKulinerService $kulinerServices)
    {
        $validated = $request->validate([
            // Identitas Usaha
            'nama_sentra' => 'required|string|max:255',
            'tahun_berdiri' => 'required|numeric|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'kepemilikan' => 'required|in:Pribadi,Keluarga,Komunitas,Waralaba',
            'alamat_lengkap' => 'required|string',
            'telepon' => 'nullable|string|max:12',
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
            'foto' => 'nullable|array|min:1',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (!$wilayah->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        try {
            $kulinerServices->storeData($validated, $request);
        } catch (\Throwable $e) {
            Log::error('Error creating kuliner: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
        }

        return redirect()->route('kuliner.index')
            ->with('success', 'Data tempat kuliner berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kuliner = TempatKuliner::with(['foto', 'jamOperasionalAdmin', 'kategori'])->findOrFail($id);
        $kategori = KategoriKuliner::aktif()->get();

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

    public function update(Request $request, $id, WilayahKotabaruService $wilayah, TempatKulinerService $kulinerServices)
    {
        $validated = $request->validate([
            // Identitas Usaha
            'nama_sentra' => 'required|string|max:255',
            'tahun_berdiri' => 'required|numeric|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'kepemilikan' => 'required|in:Pribadi,Keluarga,Komunitas,Waralaba',
            'alamat_lengkap' => 'required|string',
            'telepon' => 'nullable|string|max:12',
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
            'metode_pembayaran' => 'required|array',
            'pajak_retribusi' => 'required|in:Ya,Tidak',

            // Jam Operasional
            'hari' => 'required|array|size:7',
            'jam_buka' => 'nullable|array',
            'jam_tutup' => 'nullable|array',
            'jam_sibuk_mulai' => 'nullable|array',
            'jam_sibuk_selesai' => 'nullable|array',
            'libur' => 'nullable|array',

            // Kategori
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategori_kuliner,id_kategori',
            'menu_unggulan' => 'required|string|max:255',
            'bahan_baku_utama' => 'required|string|max:255',
            'sumber_bahan_baku' => 'required|string',
            'menu_bersifat' => 'required|array',

            // Tempat & Fasilitas
            'bentuk_fisik' => 'required|string',
            'status_bangunan' => 'required|string',
            'status_bangunan_lain' => 'nullable|string|max:255',
            'fasilitas_pendukung' => 'required|array',

            // K3 & Sanitasi
            'pelatihan_k3' => 'required|in:Ya,Tidak',
            'jumlah_penjamah_makanan' => 'required|integer|min:0',
            'apd_penjamah_makanan' => 'required|array',
            'prosedur_sanitasi_alat' => 'required|in:Tidak Melakukan,Melakukan',
            'frekuensi_sanitasi_alat' => 'required|string|max:14',
            'prosedur_sanitasi_bahan' => 'required|in:Tidak Melakukan,Melakukan',
            'frekuensi_sanitasi_bahan' => 'required|string|max:14',
            'penyimpanan_mentah' => 'required|string',
            'penyimpanan_matang' => 'required|string',
            'fifo_fefo' => 'required|in:Ya,Tidak',
            'limbah_dapur' => 'required|string',
            'ventilasi_dapur' => 'required|string',
            'dapur' => 'required|string',
            'sumber_air_cuci' => 'required|string',
            'sumber_air_masak' => 'required|string',
            'sumber_air_minum' => 'required|string',

            // Koordinat
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',

            // Foto
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (!$wilayah->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        $foto = $request->file('foto');
        $jamOperasional = [
            'hari' => $request->input('hari', []),
            'jam_buka' => $request->input('jam_buka', []),
            'jam_tutup' => $request->input('jam_tutup', []),
            'jam_sibuk_mulai' => $request->input('jam_sibuk_mulai', []),
            'jam_sibuk_selesai' => $request->input('jam_sibuk_selesai', []),
            'libur' => $request->input('libur', []),
        ];

        try {
            $kulinerServices->updateData($id, $validated, $foto, $jamOperasional);
        } catch (\Throwable $e) {
            Log::error('Error updating kuliner: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']);
        }

        return redirect()->route('kuliner.index')
            ->with('success', 'Data tempat kuliner berhasil diperbarui!');
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

    public function show($id)
    {
        $kuliner = TempatKuliner::with(['foto', 'jamOperasionalUser', 'kategori'])
            ->aktif()
            ->findOrFail($id);
        return view('kuliner.show', compact('kuliner'));
    }

    public function api()
    {
        return response()->json(
            TempatKuliner::with(['foto', 'jamOperasionalUser', 'kategori'])
                ->aktif()
                ->get()
        );
    }

    // Method untuk menghapus foto individual
    public function deleteFoto($id)
    {
        try {
            $foto = FotoKuliner::findOrFail($id);

            // Pastikan minimal ada 1 foto tersisa
            $kuliner = TempatKuliner::findOrFail($foto->id_kuliner);
            if ($kuliner->foto()->count() <= 1) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus foto. Minimal harus ada 1 foto.']);
            }

            // Hapus file dari storage
            if (Storage::disk('public')->exists($foto->path_foto)) {
                Storage::disk('public')->delete($foto->path_foto);
            }

            $foto->delete();

            return back()->with('success', 'Foto berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Error deleting foto kuliner: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus foto.']);
        }
    }
}
