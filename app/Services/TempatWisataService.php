<?php

namespace App\Services;

use App\Models\TempatWisata;
use App\Models\FotoWisata;
use App\Models\JamOperasionalWisata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TempatWisataService
{
    /**
     * Buat data wisata baru
     */
    public function store(array $data, $request): TempatWisata
    {
        $uploadedFiles = [];

        try {
            return DB::transaction(function () use ($data, $request, &$uploadedFiles) {

                // 1. Create wisata record
                $wisata = TempatWisata::create([
                    'nama_wisata'    => $data['nama_wisata'],
                    'alamat_lengkap' => $data['alamat_lengkap'],
                    'longitude'      => $data['longitude'],
                    'latitude'       => $data['latitude'],
                    'deskripsi'      => $data['deskripsi'],
                    'sejarah'        => $data['sejarah'],
                    'narasi'         => $data['narasi'],
                    'status'         => true,
                ]);

                // 2. Handle foto upload
                if ($request->hasFile('foto')) {
                    foreach ($request->file('foto') as $file) {
                        $path = $file->store('wisata', 'public');
                        $uploadedFiles[] = $path;

                        FotoWisata::create([
                            'id_wisata' => $wisata->id_wisata,
                            'path_foto' => $path,
                        ]);
                    }
                }

                // 3. Handle jam operasional
                // ✅ FIXED: Convert libur array to set for proper checking
                $liburIndexes = $data['libur'] ?? [];

                if (!empty($data['hari'])) {
                    foreach ($data['hari'] as $index => $hari) {
                        // ✅ FIXED: Check if index exists in libur array VALUES
                        $isLibur = in_array($index, $liburIndexes);

                        JamOperasionalWisata::create([
                            'id_wisata'  => $wisata->id_wisata,
                            'hari'       => $hari,
                            'jam_buka'   => $isLibur ? null : ($data['jam_buka'][$index] ?? null),
                            'jam_tutup'  => $isLibur ? null : ($data['jam_tutup'][$index] ?? null),
                            'libur'      => $isLibur,
                        ]);
                    }
                }

                // 4. Sync kategori (many-to-many)
                $wisata->kategori()->sync($data['kategori']);

                return $wisata;
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
     * Update data wisata
     */
    public function update(int $id, array $data, $request): TempatWisata
    {
        $uploadedFiles = [];

        try {
            return DB::transaction(function () use ($id, $data, $request, &$uploadedFiles) {

                $wisata = TempatWisata::findOrFail($id);

                // 1. Update wisata data
                $wisata->update([
                    'nama_wisata'    => $data['nama_wisata'],
                    'alamat_lengkap' => $data['alamat_lengkap'],
                    'longitude'      => $data['longitude'],
                    'latitude'       => $data['latitude'],
                    'deskripsi'      => $data['deskripsi'],
                    'sejarah'        => $data['sejarah'],
                    'narasi'         => $data['narasi'],
                ]);

                // 2. Handle foto baru (append mode)
                if ($request->hasFile('foto')) {
                    foreach ($request->file('foto') as $file) {
                        $path = $file->store('wisata', 'public');
                        $uploadedFiles[] = $path;

                        FotoWisata::create([
                            'id_wisata' => $wisata->id_wisata,
                            'path_foto' => $path,
                        ]);
                    }
                }

                // 3. Reset jam operasional (delete existing, then create new)
                $wisata->jamOperasionalAdmin()->delete();

                // ✅ FIXED: Convert libur array to set for proper checking
                $liburIndexes = $data['libur'] ?? [];

                if (!empty($data['hari'])) {
                    foreach ($data['hari'] as $index => $hari) {
                        // ✅ FIXED: Check if index exists in libur array VALUES
                        $isLibur = in_array($index, $liburIndexes);

                        JamOperasionalWisata::create([
                            'id_wisata'  => $wisata->id_wisata,
                            'hari'       => $hari,
                            'jam_buka'   => $isLibur ? null : ($data['jam_buka'][$index] ?? null),
                            'jam_tutup'  => $isLibur ? null : ($data['jam_tutup'][$index] ?? null),
                            'libur'      => $isLibur,
                        ]);
                    }
                }

                // 4. Sync kategori (many-to-many)
                $wisata->kategori()->sync($data['kategori']);

                return $wisata;
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
     * Hapus foto wisata
     */
    public function deleteFoto(int $idFoto): void
    {
        $foto = FotoWisata::findOrFail($idFoto);

        // Delete file from storage
        if (Storage::disk('public')->exists($foto->path_foto)) {
            Storage::disk('public')->delete($foto->path_foto);
        }

        // Delete database record
        $foto->delete();
    }
}
