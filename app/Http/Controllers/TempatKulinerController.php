<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatKuliner;
use App\Models\FotoKuliner;
use App\Models\KategoriKuliner;
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

    public function index()
    {
        $kuliner = TempatKuliner::with([
            'foto',
            'jamOperasionalAdmin',
            'kategoriAktif'
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
            'telepon' => 'required|string|max:15',
            'email' => 'required|email',
            'no_nib' => 'required|digits:13',
            'sertifikat_lain' => 'nullable|array',
            'sertifikat_lain.*' => 'string',
            'sertifikat_text' => 'required_if:sertifikat_lain.*,Lainnya|nullable|string|max:255',
            'jumlah_pegawai' => 'required|integer|min:0',
            'jumlah_kursi' => 'required|integer|min:0',
            'jumlah_gerai' => 'required|integer|min:0',
            'jumlah_pelanggan_per_hari' => 'required|integer|min:0',
            'profil_pelanggan' => 'required|array|min:1',
            'profil_pelanggan.*' => 'string|in:Lokal,Wisatawan,Pelajar/Mahasiswa,Pekerja',
            'metode_pembayaran' => 'required|array|min:1',
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
            'kategori' => 'required|array|min:1',
            'kategori.*' => 'exists:kategori_kuliner,id_kategori',
            'menu_unggulan' => 'required|string|max:255',
            'bahan_baku_utama' => 'required|string|max:255',
            'sumber_bahan_baku' => 'required|in:Lokal,Domestik / Luar Kota,Import / Luar Negeri,Campuran',
            'menu_bersifat' => 'required|array|min:1',
            'menu_bersifat.*' => 'string|in:Tetap,Musiman',

            // Tempat & Fasilitas
            'bentuk_fisik' => 'required|in:Restoran,Warung,Kafe,Food Court,Jasa Boga (Katering),Penyedia Makanan oleh Pedagang Keliling,Penyedia Makanan oleh Pedagang Tidak Keliling',
            'status_bangunan' => 'required|string|in:Milik Sendiri,Sewa,Pinjam Pakai,Lainnya...',
            'status_bangunan_lain' => 'required_if:status_bangunan,Lainnya...|nullable|string|max:255',
            'fasilitas_pendukung' => 'required|array|min:1',
            'fasilitas_pendukung.*' => 'string|in:Toilet,Wastafel,Parkir,Mushola,WiFi,Tempat Sampah',

            // Praktik K3 & Sanitasi
            'pelatihan_k3' => 'required|in:Ya,Tidak',
            'jumlah_penjamah_makanan' => 'required|integer|min:0',
            'apd_penjamah_makanan' => 'required|array|min:1',
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
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',

            // Foto
            'foto' => 'required|array|min:1',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ], [
            // Custom error messages - Identitas Usaha
            'nama_sentra.required' => 'Nama sentra/usaha wajib diisi.',
            'tahun_berdiri.required' => 'Tahun berdiri wajib diisi.',
            'tahun_berdiri.min' => 'Tahun berdiri tidak valid (minimal 1900).',
            'tahun_berdiri.max' => 'Tahun berdiri tidak boleh melebihi tahun sekarang.',
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'kepemilikan.required' => 'Kepemilikan wajib dipilih.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'telepon.required' => 'No. telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_nib.required' => 'No. NIB wajib diisi.',
            'no_nib.digits' => 'No. NIB harus terdiri dari 13 digit angka.',
            'profil_pelanggan.required' => 'Profil pelanggan wajib dipilih minimal 1.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih minimal 1.',
            'pajak_retribusi.required' => 'Status pajak/retribusi wajib dipilih.',

            // Kategori & Menu
            'kategori.required' => 'Kategori kuliner wajib dipilih minimal 1.',
            'kategori.min' => 'Pilih minimal 1 kategori kuliner.',
            'menu_unggulan.required' => 'Menu unggulan wajib diisi.',
            'bahan_baku_utama.required' => 'Bahan baku utama wajib diisi.',
            'sumber_bahan_baku.required' => 'Sumber bahan baku wajib dipilih.',
            'menu_bersifat.required' => 'Sifat menu wajib dipilih minimal 1.',

            // Tempat & Fasilitas
            'bentuk_fisik.required' => 'Bentuk fisik usaha wajib dipilih.',
            'status_bangunan.required' => 'Status bangunan wajib dipilih.',
            'status_bangunan_lain.required_if' => 'Mohon tuliskan status bangunan lainnya.',
            'fasilitas_pendukung.required' => 'Fasilitas pendukung wajib dipilih minimal 1.',

            // K3 & Sanitasi
            'pelatihan_k3.required' => 'Status pelatihan K3 wajib dipilih.',
            'jumlah_penjamah_makanan.required' => 'Jumlah penjamah makanan wajib diisi.',
            'apd_penjamah_makanan.required' => 'APD penjamah makanan wajib dipilih minimal 1.',
            'prosedur_sanitasi_alat.required' => 'Prosedur sanitasi alat wajib dipilih.',
            'frekuensi_sanitasi_alat.required' => 'Frekuensi sanitasi alat wajib diisi.',
            'prosedur_sanitasi_bahan.required' => 'Prosedur sanitasi bahan wajib dipilih.',
            'frekuensi_sanitasi_bahan.required' => 'Frekuensi sanitasi bahan wajib diisi.',
            'penyimpanan_mentah.required' => 'Metode penyimpanan bahan mentah wajib dipilih.',
            'penyimpanan_matang.required' => 'Metode penyimpanan bahan matang wajib dipilih.',
            'fifo_fefo.required' => 'Penerapan prinsip FIFO/FEFO wajib dipilih.',
            'limbah_dapur.required' => 'Pengelolaan limbah dapur wajib dipilih.',
            'ventilasi_dapur.required' => 'Jenis ventilasi dapur wajib dipilih.',
            'dapur.required' => 'Kondisi dapur wajib dipilih.',
            'sumber_air_cuci.required' => 'Sumber air untuk cuci wajib dipilih.',
            'sumber_air_masak.required' => 'Sumber air untuk masak wajib dipilih.',
            'sumber_air_minum.required' => 'Sumber air minum wajib dipilih.',

            // Koordinat
            'latitude.required' => 'Latitude wajib diisi.',
            'latitude.numeric' => 'Latitude harus berupa angka.',
            'latitude.between' => 'Latitude harus dalam rentang -90 sampai 90.',
            'longitude.required' => 'Longitude wajib diisi.',
            'longitude.numeric' => 'Longitude harus berupa angka.',
            'longitude.between' => 'Longitude harus dalam rentang -180 sampai 180.',

            // Foto
            'foto.required' => 'Foto kuliner wajib diunggah minimal 1.',
            'foto.min' => 'Minimal 1 foto harus diunggah.',
            'foto.*.image' => 'File harus berupa gambar.',
            'foto.*.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.*.max' => 'Ukuran foto maksimal 2MB per file.',
        ]);

        // ✅ VALIDASI KOORDINAT: Cek apakah dalam batas wilayah Kotabaru
        if (!$this->wilayahService->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            return back()->withInput()
                ->withErrors([
                    'latitude' => 'Koordinat berada di luar wilayah Kotabaru.',
                    'longitude' => 'Koordinat berada di luar wilayah Kotabaru.',
                    'lokasi' => '⚠️ Lokasi yang Anda masukkan berada di luar batas wilayah Kabupaten Kotabaru. Silakan periksa kembali koordinat latitude dan longitude yang dimasukkan.'
                ])
                ->with('previous_files', $this->getFileInfo($request->file('foto')));
        }

        // ✅ VALIDASI JAM OPERASIONAL (KONSISTEN DENGAN WISATA)
        $validationError = $this->validateJamOperasional(
            $request->input('hari', []),
            $request->input('jam_buka', []),
            $request->input('jam_tutup', []),
            $request->input('jam_sibuk_mulai', []),
            $request->input('jam_sibuk_selesai', []),
            $request->input('libur', [])
        );

        if ($validationError) {
            return back()
                ->withInput()
                ->withErrors(['jam_operasional' => $validationError])
                ->with('previous_files', $this->getFileInfo($request->file('foto')));
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

    public function edit($id)
    {
        $kuliner = TempatKuliner::with([
            'foto',
            'jamOperasionalAdmin',
            'kategori'
        ])->findOrFail($id);

        $kategori = KategoriKuliner::aktif()->orderBy('nama_kategori', 'asc')->get();

        return view('kuliner.edit', compact('kuliner', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        Log::info('🔵 CONTROLLER UPDATE START', [
            'id' => $id,
            'method' => $request->method(),
            'url' => $request->url()
        ]);

        $validated = $request->validate([
            // Identitas Usaha
            'nama_sentra' => 'required|string|max:255',
            'tahun_berdiri' => 'required|numeric|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:255',
            'kepemilikan' => 'required|in:Pribadi,Keluarga,Komunitas,Waralaba',
            'alamat_lengkap' => 'required|string',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email',
            'no_nib' => 'required|digits:13',
            'sertifikat_lain' => 'nullable|array',
            'sertifikat_lain.*' => 'string',
            'sertifikat_text' => 'required_if:sertifikat_lain.*,Lainnya|nullable|string|max:255',
            'jumlah_pegawai' => 'required|integer|min:0',
            'jumlah_kursi' => 'required|integer|min:0',
            'jumlah_gerai' => 'required|integer|min:0',
            'jumlah_pelanggan_per_hari' => 'required|integer|min:0',
            'profil_pelanggan' => 'required|array|min:1',
            'profil_pelanggan.*' => 'string|in:Lokal,Wisatawan,Pelajar/Mahasiswa,Pekerja',
            'metode_pembayaran' => 'required|array|min:1',
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
            'kategori' => 'required|array|min:1',
            'kategori.*' => 'exists:kategori_kuliner,id_kategori',
            'menu_unggulan' => 'required|string|max:255',
            'bahan_baku_utama' => 'required|string|max:255',
            'sumber_bahan_baku' => 'required|in:Lokal,Domestik / Luar Kota,Import / Luar Negeri,Campuran',
            'menu_bersifat' => 'required|array|min:1',
            'menu_bersifat.*' => 'string|in:Tetap,Musiman',

            // Tempat & Fasilitas
            'bentuk_fisik' => 'required|in:Restoran,Warung,Kafe,Food Court,Jasa Boga (Katering),Penyedia Makanan oleh Pedagang Keliling,Penyedia Makanan oleh Pedagang Tidak Keliling',
            'status_bangunan' => 'required|string|in:Milik Sendiri,Sewa,Pinjam Pakai,Lainnya...',
            'status_bangunan_lain' => 'required_if:status_bangunan,Lainnya...|nullable|string|max:255',
            'fasilitas_pendukung' => 'required|array|min:1',
            'fasilitas_pendukung.*' => 'string|in:Toilet,Wastafel,Parkir,Mushola,WiFi,Tempat Sampah',

            // Praktik K3 & Sanitasi
            'pelatihan_k3' => 'required|in:Ya,Tidak',
            'jumlah_penjamah_makanan' => 'required|integer|min:0',
            'apd_penjamah_makanan' => 'required|array|min:1',
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

            // Foto (nullable untuk update)
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ], [
            // Custom error messages - Identitas Usaha
            'nama_sentra.required' => 'Nama sentra/usaha wajib diisi.',
            'tahun_berdiri.required' => 'Tahun berdiri wajib diisi.',
            'tahun_berdiri.min' => 'Tahun berdiri tidak valid (minimal 1900).',
            'tahun_berdiri.max' => 'Tahun berdiri tidak boleh melebihi tahun sekarang.',
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'kepemilikan.required' => 'Kepemilikan wajib dipilih.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'telepon.required' => 'No. telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_nib.required' => 'No. NIB wajib diisi.',
            'no_nib.digits' => 'No. NIB harus terdiri dari 13 digit angka.',
            'profil_pelanggan.required' => 'Profil pelanggan wajib dipilih minimal 1.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih minimal 1.',
            'pajak_retribusi.required' => 'Status pajak/retribusi wajib dipilih.',

            // Kategori & Menu
            'kategori.required' => 'Kategori kuliner wajib dipilih minimal 1.',
            'kategori.min' => 'Pilih minimal 1 kategori kuliner.',
            'menu_unggulan.required' => 'Menu unggulan wajib diisi.',
            'bahan_baku_utama.required' => 'Bahan baku utama wajib diisi.',
            'sumber_bahan_baku.required' => 'Sumber bahan baku wajib dipilih.',
            'menu_bersifat.required' => 'Sifat menu wajib dipilih minimal 1.',

            // Tempat & Fasilitas
            'bentuk_fisik.required' => 'Bentuk fisik usaha wajib dipilih.',
            'status_bangunan.required' => 'Status bangunan wajib dipilih.',
            'status_bangunan_lain.required_if' => 'Mohon tuliskan status bangunan lainnya.',
            'fasilitas_pendukung.required' => 'Fasilitas pendukung wajib dipilih minimal 1.',

            // K3 & Sanitasi
            'pelatihan_k3.required' => 'Status pelatihan K3 wajib dipilih.',
            'jumlah_penjamah_makanan.required' => 'Jumlah penjamah makanan wajib diisi.',
            'apd_penjamah_makanan.required' => 'APD penjamah makanan wajib dipilih minimal 1.',
            'prosedur_sanitasi_alat.required' => 'Prosedur sanitasi alat wajib dipilih.',
            'frekuensi_sanitasi_alat.required' => 'Frekuensi sanitasi alat wajib diisi.',
            'prosedur_sanitasi_bahan.required' => 'Prosedur sanitasi bahan wajib dipilih.',
            'frekuensi_sanitasi_bahan.required' => 'Frekuensi sanitasi bahan wajib diisi.',
            'penyimpanan_mentah.required' => 'Metode penyimpanan bahan mentah wajib dipilih.',
            'penyimpanan_matang.required' => 'Metode penyimpanan bahan matang wajib dipilih.',
            'fifo_fefo.required' => 'Penerapan prinsip FIFO/FEFO wajib dipilih.',
            'limbah_dapur.required' => 'Pengelolaan limbah dapur wajib dipilih.',
            'ventilasi_dapur.required' => 'Jenis ventilasi dapur wajib dipilih.',
            'dapur.required' => 'Kondisi dapur wajib dipilih.',
            'sumber_air_cuci.required' => 'Sumber air untuk cuci wajib dipilih.',
            'sumber_air_masak.required' => 'Sumber air untuk masak wajib dipilih.',
            'sumber_air_minum.required' => 'Sumber air minum wajib dipilih.',

            // Koordinat
            'latitude.required' => 'Latitude wajib diisi.',
            'latitude.numeric' => 'Latitude harus berupa angka.',
            'latitude.between' => 'Latitude harus dalam rentang -90 sampai 90.',
            'longitude.required' => 'Longitude wajib diisi.',
            'longitude.numeric' => 'Longitude harus berupa angka.',
            'longitude.between' => 'Longitude harus dalam rentang -180 sampai 180.',

            // Foto
            'foto.required' => 'Foto kuliner wajib diunggah minimal 1.',
            'foto.min' => 'Minimal 1 foto harus diunggah.',
            'foto.*.image' => 'File harus berupa gambar.',
            'foto.*.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto.*.max' => 'Ukuran foto maksimal 2MB per file.',
        ]);

        Log::info('🟢 VALIDATION PASSED');

        // Validasi koordinat
        if (!$this->wilayahService->dalamBoundingBox($validated['latitude'], $validated['longitude'])) {
            log::warning('⚠️ Koordinat di luar wilayah');
            return back()->withInput()
                ->withErrors([
                    'latitude' => 'Koordinat berada di luar wilayah Kotabaru.',
                    'longitude' => 'Koordinat berada di luar wilayah Kotabaru.',
                    'lokasi' => '⚠️ Lokasi yang Anda masukkan berada di luar batas wilayah Kabupaten Kotabaru. Silakan periksa kembali koordinat latitude dan longitude yang dimasukkan.'
                ])
                ->with('previous_files', $this->getFileInfo($request->file('foto')));
        }

        // ✅ VALIDASI JAM OPERASIONAL
        $validationError = $this->validateJamOperasional(
            $request->input('hari', []),
            $request->input('jam_buka', []),
            $request->input('jam_tutup', []),
            $request->input('jam_sibuk_mulai', []),
            $request->input('jam_sibuk_selesai', []),
            $request->input('libur', [])
        );

        if ($validationError) {
            log::warning('⚠️ Validasi jam operasional invalid', ['error' => $validationError]);
            return back()
                ->withInput()
                ->withErrors(['jam_operasional' => $validationError])
                ->with('previous_files', $this->getFileInfo($request->file('foto')));
        }

        try {
            Log::info('🟡 Calling service update');

            $this->kulinerService->update($id, $validated, $request);

            Log::info('✅ UPDATE SUCCESS - Redirecting to index');

            return redirect()->route('kuliner.index')
                ->with('success', 'Data tempat kuliner berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('🔴 CONTROLLER UPDATE ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']);
        }
    }

    public function destroy($id)
    {
        try {
            $kuliner = TempatKuliner::findOrFail($id);

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
        $kuliner = TempatKuliner::with([
            'foto',
            'jamOperasionalUser',
            'kategoriAktif'
        ])
            ->aktif()
            ->findOrFail($id);

        return view('kuliner.show', compact('kuliner'));
    }

    public function api()
    {
        $kuliner = TempatKuliner::with([
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

        return response()->json($kuliner);
    }

    public function deleteFoto($id_foto_kuliner)
    {
        try {
            $foto = FotoKuliner::findOrFail($id_foto_kuliner);

            $kuliner = TempatKuliner::findOrFail($foto->id_kuliner);
            if ($kuliner->foto()->count() <= 1) {
                return back()->withErrors(['error' => 'Tidak dapat menghapus foto. Minimal harus ada 1 foto.']);
            }

            $this->kulinerService->deleteFoto($id_foto_kuliner);

            return back()->with('success', 'Foto berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Error deleting foto kuliner: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus foto.']);
        }
    }

    // Toggle status aktif/non-aktif
    public function toggleStatus($id)
    {
        try {
            $kuliner = TempatKuliner::findOrFail($id);

            // Toggle status
            $kuliner->status = !$kuliner->status;
            $kuliner->save();

            $statusText = $kuliner->status ? 'diaktifkan' : 'dinonaktifkan';
            $message = "Tempat kuliner \"{$kuliner->nama_sentra}\" berhasil {$statusText}!";

            return back()->with('success', $message);
        } catch (\Throwable $e) {
            Log::error('Error toggling kuliner status: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengubah status.']);
        }
    }

    private function validateJamOperasional(
        array $hari,
        array $jamBuka,
        array $jamTutup,
        array $jamSibukMulai,
        array $jamSibukSelesai,
        array $libur
    ) {
        foreach ($hari as $index => $day) {
            // ✅ SKIP VALIDASI JIKA HARI LIBUR
            if (in_array($index, $libur)) {
                continue;
            }

            $buka = $jamBuka[$index] ?? null;
            $tutup = $jamTutup[$index] ?? null;
            $sibukMulai = $jamSibukMulai[$index] ?? null;
            $sibukSelesai = $jamSibukSelesai[$index] ?? null;

            // ✅ SKIP jika 00:00 (indikasi libur dari JavaScript)
            if ($buka === '00:00' && $tutup === '00:00') {
                continue;
            }

            // Validasi jam tidak boleh kosong untuk hari operasional
            if (empty($buka) || empty($tutup)) {
                return "Jam buka dan tutup pada hari {$day} harus diisi!";
            }

            // Validasi format waktu HH:MM
            if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $buka)) {
                return "Format jam buka pada hari {$day} tidak valid! Gunakan format HH:MM (contoh: 08:00)";
            }

            if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $tutup)) {
                return "Format jam tutup pada hari {$day} tidak valid! Gunakan format HH:MM (contoh: 21:00)";
            }

            // ✅ VALIDASI UTAMA: Jam tutup harus lebih besar dari jam buka
            if ($tutup <= $buka) {
                return "Jam tutup pada hari {$day} harus lebih besar dari jam buka! (Buka: {$buka}, Tutup: {$tutup})";
            }

            // Validasi jam sibuk mulai (opsional, tapi jika diisi harus valid)
            if (!empty($sibukMulai) && $sibukMulai !== '00:00') {
                if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $sibukMulai)) {
                    return "Format jam sibuk mulai pada hari {$day} tidak valid!";
                }

                // Jam sibuk mulai harus antara jam buka dan tutup
                if ($sibukMulai < $buka || $sibukMulai >= $tutup) {
                    return "Jam sibuk mulai pada hari {$day} harus antara jam buka ({$buka}) dan tutup ({$tutup})!";
                }
            }

            // Validasi jam sibuk selesai
            if (!empty($sibukSelesai) && $sibukSelesai !== '00:00') {
                if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $sibukSelesai)) {
                    return "Format jam sibuk selesai pada hari {$day} tidak valid!";
                }

                // Jam sibuk selesai harus antara jam buka dan tutup
                if ($sibukSelesai <= $buka || $sibukSelesai > $tutup) {
                    return "Jam sibuk selesai pada hari {$day} harus antara jam buka ({$buka}) dan tutup ({$tutup})!";
                }

                // Jam sibuk selesai harus lebih besar dari jam sibuk mulai
                if (!empty($sibukMulai) && $sibukSelesai <= $sibukMulai) {
                    return "Jam sibuk selesai pada hari {$day} harus lebih besar dari jam sibuk mulai!";
                }
            }

            // Validasi konsistensi: jika salah satu diisi, keduanya harus diisi
            if ((!empty($sibukMulai) && $sibukMulai !== '00:00' && (empty($sibukSelesai) || $sibukSelesai === '00:00')) ||
                ((empty($sibukMulai) || $sibukMulai === '00:00') && !empty($sibukSelesai) && $sibukSelesai !== '00:00')
            ) {
                return "Jam sibuk mulai dan selesai pada hari {$day} harus diisi keduanya atau kosong keduanya!";
            }
        }

        return null; // Valid
    }

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
