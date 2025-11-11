<?php

namespace App\Http\Controllers;

use App\Models\TempatKuliner;
use App\Models\FotoKuliner;
use App\Models\JamOperasionalKuliner;
use Illuminate\Http\Request;

class TempatKulinerController extends Controller
{
    // GET /dashboard/kuliner
    public function index()
    {
        $kuliner = TempatKuliner::with(['foto','jamOperasional'])->get();
        return view('kuliner.index', compact('kuliner'));
    }

    // GET /dashboard/kuliner/create
    public function create()
    {
        return view('kuliner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sentra' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'nullable|email',
            'tahun_berdiri' => 'nullable|numeric|min:1900|max:' . date('Y'),
            'prosedur_sanitasi_alat' => 'required|string',
            'prosedur_sanitasi_bahan' => 'required|string',
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

        // Profil pelanggan
        $data['profil_pelanggan'] = $request->profil_pelanggan
            ? json_encode($request->profil_pelanggan)
            : null;

        // Metode pembayaran
        $data['metode_pembayaran'] = $request->metode_pembayaran
            ? json_encode($request->metode_pembayaran)
            : null;

        // Kategori kuliner
        $kategori = $request->input('kategori', []);
        if (in_array('Lainnya', $kategori)) {
            $lain = trim($request->input('kategori_lain'));
            $key = array_search('Lainnya', $kategori);
            $kategori[$key] = $lain ? 'Lainnya: ' . $lain : 'Lainnya';
        }
        $data['kategori'] = json_encode($kategori);

        // Pengelolaan limbah
        $data['pengelolaan_limbah'] = $request->pengelolaan_limbah
            ? json_encode($request->pengelolaan_limbah)
            : null;

        // Bahan baku
        $data['bahan_baku'] = $request->bahan_baku
            ? json_encode($request->bahan_baku)
            : null;

        // Metode transaksi
        $data['metode_transaksi'] = $request->metode_transaksi
            ? json_encode($request->metode_transaksi)
            : null;

        // Menu bersifat
        $data['menu_bersifat'] = $request->menu_bersifat
            ? json_encode($request->menu_bersifat)
            : null;

        // APD penjamah makanan
        $data['apd_penjamah_makanan'] = $request->apd_penjamah_makanan
            ? json_encode($request->apd_penjamah_makanan)
            : null;

        // === KONVERSI RADIO BUTTON ===
        $data['pelatihan_k3'] = $request->has('pelatihan_k3') ? 1 : 0;
        $data['pajak_retribusi'] = $request->has('pajak_retribusi') ? 1 : 0;
        $data['fifo_fefo'] = $request->has('fifo_fefo') ? 1 : 0;


        // === KONVERSI DROPDOWN ===
        $data['dapur'] = match ($request->input('dapur')) {
            'Terpisah' => 'Terpisah',
            'Tidak Terpisah' => 'Tidak Terpisah',
            'Tidak Ada' => 'Tidak Ada',
            default => null,
        };

       $data['prosedur_sanitasi_alat'] = (int) $request->input('prosedur_sanitasi_alat');
        $data['prosedur_sanitasi_bahan'] = (int) $request->input('prosedur_sanitasi_bahan');

        $data['penyimpanan_mentah'] = match ($request->input('penyimpanan_mentah')) {
            'Dengan Pendingin, Terpisah' => 'Dengan Pendingin, Terpisah',
            'Dengan Pendingin, Tidak Terpisah' => 'Dengan Pendingin, Tidak Terpisah',
            'Tanpa Pendingin, Terpisah' => 'Tanpa Pendingin, Terpisah',
            'Tanpa Pendingin, Tidak Terpisah' => 'Tanpa Pendingin, Tidak Terpisah',
            default => null,
        };

        $data['penyimpanan_matang'] = match ($request->input('penyimpanan_matang')) {
            'Dengan Pendingin, Terpisah' => 'Dengan Pendingin, Terpisah',
            'Dengan Pendingin, Tidak Terpisah' => 'Dengan Pendingin, Tidak Terpisah',
            'Tanpa Pendingin, Terpisah' => 'Tanpa Pendingin, Terpisah',
            'Tanpa Pendingin, Tidak Terpisah' => 'Tanpa Pendingin, Tidak Terpisah',
            default => null,
        };

        $data['limbah_dapur'] = match ($request->input('limbah_dapur')) {
            'Dipisah' => 'Dipisah',
            'Tidak dipisah' => 'Tidak dipisah',
            default => null,
        };

        $data['ventilasi_dapur'] = match ($request->input('ventilasi_dapur')) {
            'Alami' => 'Alami',
            'Buatan' => 'Buatan',
            default => null,
        };

        $data['dapur'] = match ($request->input('dapur')) {
            'Ada, terpisah' => 'Ada, terpisah',
            'Ada, tidak terpisah' => 'Ada, tidak terpisah',
            'Tidak ada' => 'Tidak ada',
        };

        $data['sumber_air_cuci'] = match ($request->input('sumber_air_cuci')) {
            'PDAM' => 'PDAM',
            'Sumur' => 'Sumur',
            'Air Isi Ulang' => 'Air Isi Ulang',
            default => null,
        };

        $data['sumber_air_masak'] = match ($request->input('sumber_air_masak')) {
            'PDAM' => 'PDAM',
            'Sumur' => 'Sumur',
            'Air Isi Ulang' => 'Air Isi Ulang',
            default => null,
        };

        $data['sumber_air_minum'] = match ($request->input('sumber_air_minum')) {
            'PDAM' => 'PDAM',
            'Sumur' => 'Sumur',
            'Air Isi Ulang' => 'Air Isi Ulang',
            default => null,
        };

        // === SIMPAN DATA UTAMA ===
        $kuliner = TempatKuliner::create([
            'nama_sentra' => $data['nama_sentra'] ?? null,
            'tahun_berdiri' => $data['tahun_berdiri'] ?? null,
            'nama_pemilik' => $data['nama_pemilik'] ?? null,
            'kepemilikan' => $data['kepemilikan'] ?? null,
            'alamat_lengkap' => $data['alamat_lengkap'] ?? null,
            'telepon' => $data['telepon'] ?? null,
            'email' => $data['email'] ?? null,
            'no_nib' => $data['no_nib'] ?? null,
            'sertifikat_lain' => $data['sertifikat_lain'] ?? null,
            'jumlah_pegawai' => $data['jumlah_pegawai'] ?? null,
            'jumlah_kursi' => $data['jumlah_kursi'] ?? null,
            'jumlah_gerai' => $data['jumlah_gerai'] ?? null,
            'jumlah_pelanggan_per_hari' => $data['jumlah_pelanggan_per_hari'] ?? null,
            'profil_pelanggan' => $data['profil_pelanggan'] ?? null,
            'metode_pembayaran' => $data['metode_pembayaran'] ?? null,
            'pajak_retribusi' => $data['pajak_retribusi'] ?? null,
            'kategori' => $data['kategori'] ?? null,
            'menu_unggulan' => $data['menu_unggulan'] ?? null,
            'bahan_baku_utama' => $data['bahan_baku_utama'] ?? null,
            'sumber_bahan_baku' => $data['sumber_bahan_baku'] ?? null,
            'menu_bersifat' => $data['menu_bersifat'] ?? null,
            'bentuk_fisik' => $data['bentuk_fisik'] ?? null,
            'status_bangunan' => $data['status_bangunan'] ?? null,
            'fasilitas_pendukung' => $data['fasilitas_pendukung'] ?? null,
            'dapur' => $data['dapur'] ?? null,
            'pengelolaan_limbah' => $data['pengelolaan_limbah'] ?? null,
            'pelatihan_k3' => $data['pelatihan_k3'] ?? null,
            'jumlah_penjamah_makanan' => $data['jumlah_penjamah_makanan'] ?? null,
            'apd_penjamah_makanan' => $data['apd_penjamah_makanan'] ?? null,
            'prosedur_sanitasi_alat' => $data['prosedur_sanitasi_alat'] ?? null,
            'frekuensi_sanitasi_alat' => $data['frekuensi_sanitasi_alat'] ?? null,
            'prosedur_sanitasi_bahan' => $data['prosedur_sanitasi_bahan'] ?? null,
            'frekuensi_sanitasi_bahan' => $data['frekuensi_sanitasi_bahan'] ?? null,
            'penyimpanan_mentah' => $data['penyimpanan_mentah'] ?? null,
            'penyimpanan_matang' => $data['penyimpanan_matang'] ?? null,
            'fifo_fefo' => $data['fifo_fefo'] ?? null,
            'limbah_dapur' => $data['limbah_dapur'] ?? null,
            'ventilasi_dapur' => $data['ventilasi_dapur'] ?? null,
            'dapur' => $data['dapur'] ?? null,
            'sumber_air_cuci' => $data['sumber_air_cuci'] ?? null,
            'sumber_air_masak' => $data['sumber_air_masak'] ?? null,
            'sumber_air_minum' => $data['sumber_air_minum'] ?? null,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
        ]);

        // === SIMPAN FOTO ===
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('kuliner', 'public');
                FotoKuliner::create([
                    'id_kuliner' => $kuliner->id_kuliner,
                    'path_foto' => $path,
                ]);
            }
        }

        // === SIMPAN JAM OPERASIONAL ===
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
            ->with('success', 'Data tempat kuliner berhasil ditambahkan!');
    }

    // GET /dashboard/kuliner/{id}/edit
    public function edit($id)
    {
        $kuliner = TempatKuliner::with(['foto', 'jamOperasional'])->findOrFail($id);

        // Ambil teks “Lainnya” dari kategori atau sertifikat kalau ada
        $kategoriLain = '';
        if (is_array($kuliner->kategori)) {
            foreach ($kuliner->kategori as $item) {
                if (str_starts_with($item, 'Lainnya:')) {
                    $kategoriLain = trim(substr($item, 9));
                }
            }
        }

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
            'tahun_berdiri' => 'nullable|numeric|min:1900|max:' . date('Y'),
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
        $data['pelatihan_k3'] = $request->has('pelatihan_k3') ? 1 : 0;
        $data['pajak_retribusi'] = $request->has('pajak_retribusi') ? 1 : 0;
        $data['fifo_fefo'] = $request->has('fifo_fefo') ? 1 : 0;
        $data['prosedur_sanitasi_alat'] = $request->has('prosedur_sanitasi_alat') ? 1 : 0;
        $data['prosedur_sanitasi_bahan'] = $request->has('prosedur_sanitasi_bahan') ? 1 : 0;

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
