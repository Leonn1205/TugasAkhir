<?php

namespace App\Services;

use App\Models\TempatKuliner;
use App\Models\FotoKuliner;
use App\Models\JamOperasionalKuliner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TempatKulinerService
{
    public function storeData(array $validated, $request)
    {
        $uploadedFiles = [];

        try {
            return DB::transaction(function () use ($validated, $request, &$uploadedFiles) {

                // 1. Prepare data utama menggunakan prepareData
                $dataUtama = $this->prepareData($validated);

                // 2. Simpan data utama ke database
                $kuliner = TempatKuliner::create($dataUtama);

                // 3. Simpan Relasi Jam Operasional
                if (!empty($validated['hari'])) {
                    foreach ($validated['hari'] as $index => $hari) {
                        $isLibur = isset($validated['libur'][$index]);

                        JamOperasionalKuliner::create([
                            'id_kuliner' => $kuliner->id_kuliner,
                            'hari' => $hari,
                            'jam_buka' => $isLibur ? null : ($validated['jam_buka'][$index] ?? null),
                            'jam_tutup' => $isLibur ? null : ($validated['jam_tutup'][$index] ?? null),
                            'jam_sibuk_mulai' => $isLibur ? null : ($validated['jam_sibuk_mulai'][$index] ?? null),
                            'jam_sibuk_selesai' => $isLibur ? null : ($validated['jam_sibuk_selesai'][$index] ?? null),
                            'libur' => $isLibur,
                        ]);
                    }
                }

                // 4. Simpan Relasi Foto
                if ($request->hasFile('foto')) {
                    foreach ($request->file('foto') as $file) {
                        $path = $file->store('kuliner', 'public');
                        $uploadedFiles[] = $path;

                        FotoKuliner::create([
                            'id_kuliner' => $kuliner->id_kuliner,
                            'path_foto' => $path,
                        ]);
                    }
                }

                // 5. Sync Kategori (many-to-many)
                $kuliner->kategori()->sync($validated['kategori']);

                return $kuliner;
            });
        } catch (\Throwable $e) {
            // Rollback uploaded files if transaction fails
            foreach ($uploadedFiles as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            throw $e;
        }
    }

    public function updateData(int $id, array $validated, ?array $foto, array $jamOperasional)
    {
        $uploadedFiles = [];

        try {
            DB::transaction(function () use ($id, $validated, $foto, $jamOperasional, &$uploadedFiles) {

                $kuliner = TempatKuliner::findOrFail($id);

                // 1. Prepare data utama
                $dataUtama = $this->prepareData($validated);

                // 2. Update data utama
                $kuliner->update($dataUtama);

                // 3. Handle foto baru (append mode)
                if (!empty($foto)) {
                    foreach ($foto as $file) {
                        $path = $file->store('kuliner', 'public');
                        $uploadedFiles[] = $path;

                        FotoKuliner::create([
                            'id_kuliner' => $kuliner->id_kuliner,
                            'path_foto' => $path,
                        ]);
                    }
                }

                // 4. Reset jam operasional (delete existing, then create new)
                $kuliner->jamOperasionalAdmin()->delete();

                if (!empty($jamOperasional['hari'])) {
                    foreach ($jamOperasional['hari'] as $index => $hari) {
                        $isLibur = isset($jamOperasional['libur'][$index]);

                        JamOperasionalKuliner::create([
                            'id_kuliner' => $kuliner->id_kuliner,
                            'hari' => $hari,
                            'jam_buka' => $isLibur ? null : ($jamOperasional['jam_buka'][$index] ?? null),
                            'jam_tutup' => $isLibur ? null : ($jamOperasional['jam_tutup'][$index] ?? null),
                            'jam_sibuk_mulai' => $isLibur ? null : ($jamOperasional['jam_sibuk_mulai'][$index] ?? null),
                            'jam_sibuk_selesai' => $isLibur ? null : ($jamOperasional['jam_sibuk_selesai'][$index] ?? null),
                            'libur' => $isLibur,
                        ]);
                    }
                }

                // 5. Sync Kategori (many-to-many)
                $kuliner->kategori()->sync($validated['kategori']);
            });
        } catch (\Throwable $e) {
            // Rollback uploaded files if transaction fails
            foreach ($uploadedFiles as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            throw $e;
        }
    }

    public function hapusFoto(int $idFoto): void
    {
        $foto = FotoKuliner::findOrFail($idFoto);

        // Delete file from storage
        if (Storage::disk('public')->exists($foto->path_foto)) {
            Storage::disk('public')->delete($foto->path_foto);
        }

        // Delete database record
        $foto->delete();
    }

    protected function prepareData(array $data)
    {
        // === Konversi Boolean (Radio Button) ===
        $data['pelatihan_k3'] = ($data['pelatihan_k3'] === 'Ya') ? 1 : 0;
        $data['pajak_retribusi'] = ($data['pajak_retribusi'] === 'Ya') ? 1 : 0;
        $data['fifo_fefo'] = ($data['fifo_fefo'] === 'Ya') ? 1 : 0;

        // === Konversi Prosedur Sanitasi ===
        $data['prosedur_sanitasi_alat'] = ($data['prosedur_sanitasi_alat'] === 'Melakukan') ? 1 : 0;
        $data['prosedur_sanitasi_bahan'] = ($data['prosedur_sanitasi_bahan'] === 'Melakukan') ? 1 : 0;

        // === Handling Input "Lainnya" ===
        // Sertifikat
        if (isset($data['sertifikat_lain']) && is_array($data['sertifikat_lain'])) {
            $sertifikat = $data['sertifikat_lain'];
            if (in_array('Lainnya', $sertifikat)) {
                $key = array_search('Lainnya', $sertifikat);
                $sertifikat[$key] = 'Lainnya: ' . ($data['sertifikat_text'] ?? '');
            }
            $data['sertifikat_lain'] = $sertifikat;
        }

        // Status Bangunan
        if ($data['status_bangunan'] === 'Lainnya...') {
            $data['status_bangunan'] = 'Lainnya: ' . ($data['status_bangunan_lain'] ?? 'Lainnya');
        }

        // Set default status
        $data['status'] = true;

        // === FILTER AKHIR ===
        // Buang field yang bukan kolom tabel utama
        return collect($data)->except([
            'foto',
            'hari',
            'jam_buka',
            'jam_tutup',
            'libur',
            'jam_sibuk_mulai',
            'jam_sibuk_selesai',
            'kategori', // Akan di-sync terpisah via relasi many-to-many
            'kategori_lain',
            'sertifikat_text',
            'status_bangunan_lain'
        ])->toArray();
    }
}
