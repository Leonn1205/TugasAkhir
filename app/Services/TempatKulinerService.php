<?php

namespace App\Services;

use App\Models\TempatKuliner;
use Illuminate\Support\Facades\DB;

class TempatKulinerService
{
    public function storeData(array $validated, $request)
    {
        return DB::transaction(function () use ($validated, $request) {

            // 1. Olah data menggunakan prepareData
            $dataUtama = $this->prepareData($validated);

            // 2. Simpan ke database (Laravel otomatis encode array ke JSON karena $casts di Model)
            $kuliner = TempatKuliner::create($dataUtama);

            // 3. Simpan Relasi Jam Operasional
            foreach ($validated['hari'] as $index => $hari) {
                $isLibur = isset($request->libur[$index]);

                $kuliner->jamOperasional()->create([
                    'hari'               => $hari,
                    'jam_buka'           => $isLibur ? null : ($validated['jam_buka'][$index] ?? null),
                    'jam_tutup'          => $isLibur ? null : ($validated['jam_tutup'][$index] ?? null),
                    'jam_sibuk_mulai'    => $isLibur ? null : ($validated['jam_sibuk_mulai'][$index] ?? null),
                    'jam_sibuk_selesai'  => $isLibur ? null : ($validated['jam_sibuk_selesai'][$index] ?? null),
                ]);
            }

            // 4. Simpan Relasi Foto (Nama fungsi: foto())
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $path = $file->store('foto-kuliner', 'public');
                    $kuliner->foto()->create(['path_foto' => $path]);
                }
            }

            return $kuliner;
        });
    }

    protected function prepareData(array $data)
    {
        // === Konversi Boolean (Radio Button) ===
        $data['pelatihan_k3']    = ($data['pelatihan_k3'] === 'Ya') ? 1 : 0;
        $data['pajak_retribusi'] = ($data['pajak_retribusi'] === 'Ya') ? 1 : 0;
        $data['fifo_fefo']       = ($data['fifo_fefo'] === 'Ya') ? 1 : 0;

        // === Konversi Prosedur Sanitasi ===
        $data['prosedur_sanitasi_alat']  = ($data['prosedur_sanitasi_alat'] === 'Melakukan') ? 1 : 0;
        $data['prosedur_sanitasi_bahan'] = ($data['prosedur_sanitasi_bahan'] === 'Melakukan') ? 1 : 0;

        // === Handling Input "Lainnya" ===
        // Kategori
        if (in_array('Lainnya', $data['kategori'])) {
            $key = array_search('Lainnya', $data['kategori']);
            $data['kategori'][$key] = 'Lainnya: ' . ($data['kategori_lain'] ?? '');
        }

        // Sertifikat
        $sertifikat = $data['sertifikat_lain'] ?? [];
        if (in_array('Lainnya', $sertifikat)) {
            $key = array_search('Lainnya', $sertifikat);
            $sertifikat[$key] = 'Lainnya: ' . ($data['sertifikat_text'] ?? '');
        }
        $data['sertifikat_lain'] = $sertifikat;

        // Status Bangunan
        if ($data['status_bangunan'] === 'Lainnya...') {
            $data['status_bangunan'] = $data['status_bangunan_lain'] ?? 'Lainnya';
        }
        
        // === FILTER AKHIR ===
        // Buang field yang bukan kolom tabel utama
        return collect($data)->except([
            'foto', 'hari', 'jam_buka', 'jam_tutup', 'libur',
            'jam_sibuk_mulai', 'jam_sibuk_selesai',
            'kategori_lain', 'sertifikat_text', 'status_bangunan_lain'
        ])->toArray();
    }
}
