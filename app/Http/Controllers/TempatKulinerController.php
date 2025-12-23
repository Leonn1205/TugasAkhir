<?php

namespace App\Http\Controllers;

use App\Models\TempatKuliner;
use App\Models\FotoKuliner;
use App\Models\JamOperasionalKuliner;
use Illuminate\Http\Request;
use App\Services\WilayahKotabaruService;
use App\Services\TempatKulinerService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TempatKulinerController extends Controller
{
    // GET /dashboard/kuliner
    public function index()
    {
        $kuliner = TempatKuliner::with(['foto','jamOperasionalAdmin'])->get();
        return view('kuliner.index', compact('kuliner'));
    }

    // GET /dashboard/kuliner/create
    public function create()
    {
        return view('kuliner.create');
    }

    public function store(Request $request, WilayahKotabaruService $wilayah, TempatKulinerService $kulinerServices)
    {
        //dd($request->all());

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
            'profil_pelanggan' => 'required|array',
            'profil_pelanggan.*' => 'string|in:Lokal,Wisatawan,Pelajar/Mahasiswa,Pekerja',
            'metode_pembayaran' => 'required|array',
            'metode_pembayaran.*' => 'string|in:Tunai,Qris / Transfer',
            'pajak_retribusi' => 'required|in:Ya,Tidak',

            // Jenis Kuliner
            'kategori' => 'required|array',
            'kategori.*' => 'required|in:Tradisional/Domestik,Modern/Luar Negeri,Street Food,Lainnya',
            'kategori_lain' => 'required_if:kategori.*,Lainnya|nullable|string|max:255',
            'menu_unggulan' => 'required|string|max:255',
            'bahan_baku_utama' => 'required|string|max:255',
            'sumber_bahan_baku' => 'required|in:Lokal,Domestik / Luar Kota,Import / Luar Negeri,Campuran',
            'menu_bersifat' => 'required|array',
            'menu_bersifat.*' => 'string|in:Tetap,Musiman',

            // Tempat & Fasilitas
            'bentuk_fisik' => 'required|in:Restoran,Warung,Kafe,Food Court,Jasa Boga (Katering), Penyedia Makanan oleh Pedagang Keliling, Penyedia Makanan oleh Pedagang Tidak Keliling',
            'status_bangunan'      => 'required|string|in:Milik Sendiri,Sewa,Pinjam Pakai,Lainnya...',
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
            'foto'   => 'nullable|array|min:1',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (! $wilayah->dalamBoundingBox(
            $validated['latitude'],
            $validated['longitude']
            )) {
            return back()->withInput()
                ->withErrors(['lokasi' => 'Lokasi yang dimasukkan berada di luar wilayah Kotabaru.']);
        }

        try {
            $kulinerServices->storeData($validated, $request);
        } catch(\Throwable $e) {
            Log::error($e);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);}

        return redirect()->route('kuliner.index')
            ->with('success', 'Data tempat kuliner berhasil ditambahkan!');
    }

    // GET /dashboard/kuliner/{id}/edit
    public function edit($id)
    {
        $kuliner = TempatKuliner::with(['foto', 'jamOperasional'])->findOrFail($id);

        // Ambil teks “Lainnya” dari kategori atau sertifikat kalau ada
        $kategoriData = is_array($kuliner->kategori)
            ? $kuliner->kategori
            : json_decode($kuliner->kategori, true);

        $kategoriLain = '';
        if (is_array($kuliner->kategori)) {
            foreach ($kuliner->kategori as $item) {
                if (str_starts_with($item, 'Lainnya:')) {
                    $kategoriLain = trim(substr($item, 9));
                }
            }
        }

        $sertifikatData = is_array($kuliner->sertifikat_lain)
            ? $kuliner->sertifikat_lain
            : json_decode($kuliner->sertifikat_lain, true);
        $sertifikatLainText = '';
        if (is_array($kuliner->sertifikat_lain)) {
            foreach ($kuliner->sertifikat_lain as $item) {
                if (str_starts_with($item, 'Lainnya:')) {
                    $sertifikatLainText = trim(substr($item, 9));
                }
            }
        }

        // --- Susun ulang data jam operasional per hari ---
        $jamOperasional = [];
        foreach ($kuliner->jamOperasional as $jam) {
            $jamOperasional[$jam->hari] = [
                'buka' => $jam->jam_buka,
                'tutup' => $jam->jam_tutup,
                'sibuk_mulai' => $jam->jam_sibuk_mulai,
                'sibuk_selesai' => $jam->jam_sibuk_selesai,
                'libur' => $jam->jam_buka === null && $jam->jam_tutup === null,
            ];
        }

        return view('kuliner.edit', compact('kuliner', 'jamOperasional', 'kategoriLain', 'sertifikatLainText'));
    }

    public function update(Request $request, $id)
    {
        $kuliner = TempatKuliner::findOrFail($id);

        $request->validate([
            'nama_sentra' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:12',
            'tahun_berdiri' => 'nullable|numeric|min:1900|max:' . date('Y'),
            'no_nib' => 'nullable|digits:13',
            'jumlah_pegawai' => 'nullable|integer|min:0',
            'jumlah_penjamah_makanan' => 'nullable|integer|min:0',
            'jumlah_kursi' => 'nullable|integer|min:0',
            'jumlah_gerai' => 'nullable|integer|min:0',
            'jumlah_pelanggan_per_hari' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        // === KONVERSI ARRAY / CHECKBOX ===
        // Sertifikat
        $sertifikat = $request->input('sertifikat_lain', []);
        if (in_array('Lainnya', $sertifikat)) {
            $lain = trim($request->input('sertifikat_lain_text'));
            $key = array_search('Lainnya', $sertifikat);
            $sertifikat[$key] = $lain ? 'Lainnya: ' . $lain : 'Lainnya';
        }
        $data['sertifikat_lain'] = json_encode($sertifikat);

        $data['profil_pelanggan'] = $request->profil_pelanggan
            ? json_encode($request->profil_pelanggan)
            : null;

        $data['metode_pembayaran'] = $request->metode_pembayaran
            ? json_encode($request->metode_pembayaran)
            : null;

        // Kategori
        $kategori = $request->input('kategori', []);
        if (in_array('Lainnya', $kategori)) {
            $lain = trim($request->input('kategori_lain'));
            $key = array_search('Lainnya', $kategori);
            $kategori[$key] = $lain ? 'Lainnya: ' . $lain : 'Lainnya';
        }
        $data['kategori'] = json_encode($kategori);

        $data['menu_bersifat'] = $request->menu_bersifat
            ? json_encode($request->menu_bersifat)
            : null;

        $data['apd_penjamah_makanan'] = $request->apd_penjamah_makanan
            ? json_encode($request->apd_penjamah_makanan)
            : null;

        $data['fasilitas_pendukung'] = $request->fasilitas_pendukung
            ? json_encode($request->fasilitas_pendukung)
            : null;

        // === BOOLEAN / RADIO ===
        $data['pelatihan_k3'] = $request->input('pelatihan_k3') ? 1 : 0;
        $data['pajak_retribusi'] = $request->input('pajak_retribusi') ? 1 : 0;
        $data['fifo_fefo'] = $request->input('fifo_fefo') ? 1 : 0;
        $data['prosedur_sanitasi_alat'] = $request->input('prosedur_sanitasi_alat') ? 1 : 0;
        $data['prosedur_sanitasi_bahan'] = $request->input('prosedur_sanitasi_bahan') ? 1 : 0;

        if ($request->status_bangunan === 'Lainnya') {
            $data['status_bangunan'] = 'Lainnya: ' . $request->status_lain;
        } else {
            $data['status_bangunan'] = $request->status_bangunan;
        }

        // === UPDATE DATA UTAMA ===
        $kuliner->update($data);

        // === FOTO BARU ===
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('kuliner', 'public');
                FotoKuliner::create([
                    'id_kuliner' => $kuliner->id_kuliner,
                    'path_foto' => $path,
                ]);
            }
        }

        // === JAM OPERASIONAL ===
        $kuliner->jamOperasional()->delete();

        if ($request->filled('hari')) {
            foreach ($request->hari as $i => $hari) {
                $isLibur = isset($request->libur[$i]);
                JamOperasionalKuliner::create([
                    'id_kuliner' => $kuliner->id_kuliner,
                    'hari' => $hari,
                    'jam_buka' => $isLibur ? null : ($request->jam_buka[$i] ?? null),
                    'jam_tutup' => $isLibur ? null : ($request->jam_tutup[$i] ?? null),
                    'jam_sibuk_mulai' => $isLibur ? null : ($request->jam_sibuk_mulai[$i] ?? null),
                    'jam_sibuk_selesai' => $isLibur ? null : ($request->jam_sibuk_selesai[$i] ?? null),
                ]);
            }
        }

        return redirect()->route('kuliner.index')
            ->with('success', 'Data tempat kuliner berhasil diperbarui!');
    }

    // DELETE /dashboard/kuliner/{id}
    public function destroy($id)
    {
        $kuliner = TempatKuliner::findOrFail($id);
        $kuliner->delete();

        return back()->with('success','Data kuliner berhasil dihapus!');
    }

    // GET /dashboard/kuliner/{id}
    public function show($id)
    {
        $kuliner = TempatKuliner::with(['foto','jamOperasional'])->findOrFail($id);
        return view('kuliner.show', compact('kuliner'));
    }

    // API JSON untuk peta
    public function api()
    {
        return response()->json(
            TempatKuliner::with(['foto','jamOperasional'])->get()
        );
    }

    private function handleProgramInput(Request $request)
    {
        $program = $request->input('program_pemerintah', []);
        if (in_array('Dll', $program)) {
            $dll = trim($request->input('program_dll'));
            $key = array_search('Dll', $program);
            $program[$key] = $dll ? 'Dll: ' . $dll : 'Dll';
        }
        return $program;
    }

    private function handleSertifikasiInput(Request $request)
    {
        $sertifikasi = $request->input('sertifikasi', []);
        if (in_array('Dll', $sertifikasi)) {
            $dll = trim($request->input('sertifikasi_dll'));
            $key = array_search('Dll', $sertifikasi);
            $sertifikasi[$key] = $dll ? 'Dll: ' . $dll : 'Dll';
        }
        return $sertifikasi;
    }

}
