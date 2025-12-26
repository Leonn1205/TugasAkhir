<?php

namespace App\Services;

use App\Models\TempatWisata;
use App\Models\FotoWisata;
use App\Models\JamOperasionalWisata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TempatWisataService
{
    public function buatWisata(array $data, $request): void
    {
        $uploadedFiles = [];

        try {
            DB::transaction(function () use ($data, $request, &$uploadedFiles) {

                // Create wisata record
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

                // Handle foto upload
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

                // Handle jam operasional
                if (!empty($data['hari'])) {
                    foreach ($data['hari'] as $index => $hari) {
                        $isLibur = isset($data['libur'][$index]);

                        JamOperasionalWisata::create([
                            'id_wisata'  => $wisata->id_wisata,
                            'hari'       => $hari,
                            'jam_buka'   => $isLibur ? null : ($data['jam_buka'][$index] ?? null),
                            'jam_tutup'  => $isLibur ? null : ($data['jam_tutup'][$index] ?? null),
                            'libur'      => $isLibur,
                        ]);
                    }
                }

                // Sync kategori (many-to-many)
                $wisata->kategori()->sync($data['kategori']);
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

    public function updateWisata(int $id, array $data, ?array $foto, array $jamOperasional): void
    {
        $uploadedFiles = [];

        try {
            DB::transaction(function () use ($id, $data, $foto, $jamOperasional, &$uploadedFiles) {

                $wisata = TempatWisata::findOrFail($id);

                // Update wisata data
                $wisata->update([
                    'nama_wisata'    => $data['nama_wisata'],
                    'alamat_lengkap' => $data['alamat_lengkap'],
                    'longitude'      => $data['longitude'],
                    'latitude'       => $data['latitude'],
                    'deskripsi'      => $data['deskripsi'],
                    'sejarah'        => $data['sejarah'],
                    'narasi'         => $data['narasi'],
                ]);

                // Handle foto baru (append mode)
                if (!empty($foto)) {
                    foreach ($foto as $file) {
                        $path = $file->store('wisata', 'public');
                        $uploadedFiles[] = $path;

                        FotoWisata::create([
                            'id_wisata' => $wisata->id_wisata,
                            'path_foto' => $path,
                        ]);
                    }
                }

                // Reset jam operasional (delete existing, then create new)
                $wisata->jamOperasionalAdmin()->delete();

                if (!empty($jamOperasional['hari'])) {
                    foreach ($jamOperasional['hari'] as $index => $hari) {
                        $isLibur = isset($jamOperasional['libur'][$index]);

                        JamOperasionalWisata::create([
                            'id_wisata'  => $wisata->id_wisata,
                            'hari'       => $hari,
                            'jam_buka'   => $isLibur ? null : ($jamOperasional['jam_buka'][$index] ?? null),
                            'jam_tutup'  => $isLibur ? null : ($jamOperasional['jam_tutup'][$index] ?? null),
                            'libur'      => $isLibur,
                        ]);
                    }
                }

                // Sync kategori (many-to-many)
                $wisata->kategori()->sync($data['kategori']);
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
        $foto = FotoWisata::findOrFail($idFoto);

        // Delete file from storage
        if (Storage::disk('public')->exists($foto->path_foto)) {
            Storage::disk('public')->delete($foto->path_foto);
        }

        // Delete database record
        $foto->delete();
    }
}
