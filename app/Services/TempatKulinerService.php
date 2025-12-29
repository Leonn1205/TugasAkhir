<?php

namespace App\Services;

use App\Models\TempatKuliner;
use App\Models\FotoKuliner;
use App\Models\JamOperasionalKuliner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TempatKulinerService
{
    /**
     * Buat data kuliner baru
     */
    public function store(array $data, $request): TempatKuliner
    {
        $uploadedFiles = [];

        try {
            return DB::transaction(function () use ($data, $request, &$uploadedFiles) {

                // 1. Prepare dan simpan data utama
                $dataUtama = $this->prepareMainData($data);
                $kuliner = TempatKuliner::create($dataUtama);

                // 2. Handle foto upload
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

                // 3. Handle jam operasional
                if (!empty($data['hari'])) {
                    foreach ($data['hari'] as $index => $hari) {
                        $isLibur = isset($data['libur'][$index]);

                        JamOperasionalKuliner::create([
                            'id_kuliner' => $kuliner->id_kuliner,
                            'hari' => $hari,
                            'jam_buka' => $isLibur ? null : ($data['jam_buka'][$index] ?? null),
                            'jam_tutup' => $isLibur ? null : ($data['jam_tutup'][$index] ?? null),
                            'jam_sibuk_mulai' => $isLibur ? null : ($data['jam_sibuk_mulai'][$index] ?? null),
                            'jam_sibuk_selesai' => $isLibur ? null : ($data['jam_sibuk_selesai'][$index] ?? null),
                            'libur' => $isLibur,
                        ]);
                    }
                }

                // 4. Sync kategori (many-to-many)
                $kuliner->kategori()->sync($data['kategori']);

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

    /**
     * Update data kuliner
     */
    public function update(int $id, array $data, $request): TempatKuliner
    {
        $uploadedFiles = [];

        try {
            return DB::transaction(function () use ($id, $data, $request, &$uploadedFiles) {

                $kuliner = TempatKuliner::findOrFail($id);

                // 1. Prepare dan update data utama
                $dataUtama = $this->prepareMainData($data);
                $kuliner->update($dataUtama);

                // 2. Handle foto baru (append mode)
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

                // 3. Reset jam operasional (delete existing, then create new)
                $kuliner->jamOperasionalAdmin()->delete();

                if (!empty($data['hari'])) {
                    foreach ($data['hari'] as $index => $hari) {
                        $isLibur = isset($data['libur'][$index]);

                        JamOperasionalKuliner::create([
                            'id_kuliner' => $kuliner->id_kuliner,
                            'hari' => $hari,
                            'jam_buka' => $isLibur ? null : ($data['jam_buka'][$index] ?? null),
                            'jam_tutup' => $isLibur ? null : ($data['jam_tutup'][$index] ?? null),
                            'jam_sibuk_mulai' => $isLibur ? null : ($data['jam_sibuk_mulai'][$index] ?? null),
                            'jam_sibuk_selesai' => $isLibur ? null : ($data['jam_sibuk_selesai'][$index] ?? null),
                            'libur' => $isLibur,
                        ]);
                    }
                }

                // 4. Sync kategori (many-to-many)
                $kuliner->kategori()->sync($data['kategori']);

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

    /**
     * Hapus foto kuliner
     */
    public function deleteFoto(int $idFoto): void
    {
        $foto = FotoKuliner::findOrFail($idFoto);

        // Delete file from storage
        if (Storage::disk('public')->exists($foto->path_foto)) {
            Storage::disk('public')->delete($foto->path_foto);
        }

        // Delete database record
        $foto->delete();
    }

    /**
     * Prepare data utama untuk insert/update
     * Konversi dan clean data sebelum disimpan
     */
    private function prepareMainData(array $data): array
    {
        // Konversi boolean (Ya/Tidak -> 1/0)
        $data['pelatihan_k3'] = ($data['pelatihan_k3'] ?? 'Tidak') === 'Ya';
        $data['pajak_retribusi'] = ($data['pajak_retribusi'] ?? 'Tidak') === 'Ya';
        $data['fifo_fefo'] = ($data['fifo_fefo'] ?? 'Tidak') === 'Ya';
        $data['prosedur_sanitasi_alat'] = ($data['prosedur_sanitasi_alat'] ?? 'Tidak Melakukan') === 'Melakukan';
        $data['prosedur_sanitasi_bahan'] = ($data['prosedur_sanitasi_bahan'] ?? 'Tidak Melakukan') === 'Melakukan';

        // Handle "Lainnya" untuk sertifikat
        if (isset($data['sertifikat_lain']) && is_array($data['sertifikat_lain'])) {
            $sertifikat = $data['sertifikat_lain'];
            if (in_array('Lainnya', $sertifikat)) {
                $key = array_search('Lainnya', $sertifikat);
                $sertifikat[$key] = 'Lainnya: ' . ($data['sertifikat_text'] ?? '');
            }
            $data['sertifikat_lain'] = $sertifikat;
        }

        // Handle "Lainnya" untuk status bangunan
        if (($data['status_bangunan'] ?? '') === 'Lainnya...') {
            $data['status_bangunan'] = 'Lainnya: ' . ($data['status_bangunan_lain'] ?? 'Lainnya');
        }

        // Set default status
        $data['status'] = true;

        // Filter: hapus field yang bukan kolom tabel
        return collect($data)->except([
            'foto',
            'hari',
            'jam_buka',
            'jam_tutup',
            'libur',
            'jam_sibuk_mulai',
            'jam_sibuk_selesai',
            'kategori',
            'sertifikat_text',
            'status_bangunan_lain'
        ])->toArray();
    }
}
