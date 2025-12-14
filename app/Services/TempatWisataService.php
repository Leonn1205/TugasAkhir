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

        DB::transaction(function () use ($data, $request, &$uploadedFiles) {

            $wisata = TempatWisata::create([
                'nama_wisata'    => $data['nama_wisata'],
                'alamat_lengkap' => $data['alamat_lengkap'],
                'longitude'      => $data['longitude'],
                'latitude'       => $data['latitude'],
                'deskripsi'      => $data['deskripsi'],
                'sejarah'        => $data['sejarah'],
                'narasi'         => $data['narasi'],
            ]);

            // Foto
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

            // Jam operasional
            if ($request->filled('hari')) {
                foreach ($request->hari as $index => $hari) {
                    $isLibur = isset($request->libur[$index]);

                    JamOperasionalWisata::create([
                        'id_wisata' => $wisata->id_wisata,
                        'hari'      => $hari,
                        'jam_buka'  => $isLibur ? null : ($request->jam_buka[$index] ?? null),
                        'jam_tutup' => $isLibur ? null : ($request->jam_tutup[$index] ?? null),
                    ]);
                }
            }

            $wisata->kategori()->sync($data['kategori']);
        });
    }

    public function updateWisata(int $id, array $data, ?array $foto, array $jamOperasional): void
    {
        DB::transaction(function () use ($id, $data, $foto, $jamOperasional) {

            $wisata = TempatWisata::findOrFail($id);

            $wisata->update([
                'nama_wisata'    => $data['nama_wisata'],
                'alamat_lengkap' => $data['alamat_lengkap'] ?? null,
                'longitude'      => $data['longitude'] ?? $wisata->longitude,
                'latitude'       => $data['latitude'] ?? $wisata->latitude,
                'deskripsi'      => $data['deskripsi'] ?? null,
                'sejarah'        => $data['sejarah'] ?? null,
                'narasi'         => $data['narasi'] ?? null,
            ]);

            // Foto baru (append, bukan replace)
            if (!empty($foto)) {
                foreach ($foto as $file) {
                    $path = $file->store('wisata', 'public');

                    FotoWisata::create([
                        'id_wisata' => $wisata->id_wisata,
                        'path_foto' => $path,
                    ]);
                }
            }

            // Jam operasional → reset total
            $wisata->jamOperasional()->delete();

            foreach ($jamOperasional['hari'] as $index => $hari) {
                $isLibur = isset($jamOperasional['libur'][$index]);

                JamOperasionalWisata::create([
                    'id_wisata' => $wisata->id_wisata,
                    'hari'      => $hari,
                    'jam_buka'  => $isLibur ? null : ($jamOperasional['jam_buka'][$index] ?? null),
                    'jam_tutup' => $isLibur ? null : ($jamOperasional['jam_tutup'][$index] ?? null),
                ]);
            }

            $wisata->kategori()->sync($data['kategori']);
        });
    }
}
