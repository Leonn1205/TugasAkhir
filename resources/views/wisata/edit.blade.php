<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Tempat Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inknut Antiqua', serif;
            background: url("{{ asset('images/bg-view.png') }}") no-repeat center center fixed;
            background-size: cover;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 15px;
            max-width: 900px;
            margin: 40px auto;
        }

        .btn-submit {
            background-color: #1e3932;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #2d5447;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: #b0b0b0;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background-color: #8c8c8c;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="container">
        <h5 class="mt-4 text-center fw-bold">Kotabaru Tourism Data Center</h5>
        <h2 class="text-center fw-bold text-success mb-4">Edit Tempat Wisata</h2>

        <div class="form-container shadow">
            <form method="POST" action="{{ route('wisata.update', $wisata->id_wisata) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Tempat Wisata</label>
                    <input type="text" name="nama_wisata" class="form-control" value="{{ $wisata->nama_wisata }}"
                        required>
                    <small class="form-text text-muted">Contoh: Pantai Gedambaan</small>
                </div>

                <div class="mb-3">
                    <label>Kategori Wisata</label><br>

                    @foreach ($kategori as $k)
                        <label>
                            <input type="checkbox" name="kategori[]" value="{{ $k->id_kategori }}"
                                {{ in_array($k->id_kategori, $wisata->kategori->pluck('id_kategori')->toArray()) ? 'checked' : '' }}>
                            {{ $k->nama_kategori }}
                        </label><br>
                    @endforeach

                    <small class="form-text text-muted">Kategori bisa lebih dari satu, ditentukan oleh admin.</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control" value="{{ $wisata->longitude }}">
                        <small class="form-text text-muted">Contoh: 116.8225</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control" value="{{ $wisata->latitude }}">
                        <small class="form-text text-muted">Contoh: -3.3211</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Deskripsi Wisata</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ $wisata->deskripsi }}</textarea>
                    <small class="form-text text-muted">Gambaran umum wisata</small>
                </div>
                <div class="mb-3">
                    <label>Sejarah Wisata</label>
                    <textarea name="sejarah" class="form-control" rows="3">{{ $wisata->sejarah }}</textarea>
                    <small class="form-text text-muted">Asal usul tempat wisata</small>
                </div>
                <div class="mb-3">
                    <label>Narasi Wisata</label>
                    <textarea name="narasi" class="form-control" rows="3">{{ $wisata->narasi }}</textarea>
                    <small class="form-text text-muted">Narasi opsional yang akan dibacakan</small>
                </div>

                <div class="mb-4">
                    <label class="fw-bold mb-2">Jam Operasional</label>
                    <div class="alert alert-info">
                        <strong>Petunjuk:</strong>
                        <ul class="mb-0">
                            <li>Jam default: 00:00 – 23:59</li>
                            <li>Centang "Libur" jika tempat tidak buka hari itu</li>
                        </ul>
                    </div>
                    <table class="table table-bordered text-center align-middle table-sm" style="font-size: 0.9rem;">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 25%;">Hari</th>
                                <th style="width: 25%;">Jam Buka</th>
                                <th style="width: 25%;">Jam Tutup</th>
                                <th style="width: 15%;">Libur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                $jamOps = $wisata->jamOperasional->keyBy('hari');
                            @endphp
                            @foreach ($days as $day)
                                <tr>
                                    <td><input type="text" name="hari[]"
                                            class="form-control form-control-sm text-center"
                                            value="{{ $day }}" readonly></td>
                                    <td><input type="time" name="jam_buka[]" class="form-control form-control-sm"
                                            value="{{ $jamOps[$day]->jam_buka ?? '00:00' }}"></td>
                                    <td><input type="time" name="jam_tutup[]" class="form-control form-control-sm"
                                            value="{{ $jamOps[$day]->jam_tutup ?? '23:59' }}"></td>
                                    <td>
                                        <div class="form-check d-flex justify-content-center align-items-center">
                                            <input class="form-check-input libur-check" type="checkbox" name="libur[]"
                                                value="{{ $loop->index }}"
                                                {{ empty($jamOps[$day]->jam_buka) && empty($jamOps[$day]->jam_tutup) ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mb-3">
                    <label>Foto Lama</label><br>
                    @foreach ($wisata->foto as $f)
                        <img src="{{ asset('storage/' . $f->path_foto) }}" alt="Foto {{ $wisata->nama_wisata }}"
                            width="100" class="me-2 mb-2">
                    @endforeach
                </div>

                <div class="mb-3">
                    <label>Upload Foto Baru</label>
                    <input type="file" name="foto[]" class="form-control" multiple>
                    <small class="form-text text-muted">Bisa upload beberapa foto. Maks 2MB per file.</small>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-submit me-3 px-4">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                    <a href="{{ route('wisata.index') }}" class="btn btn-cancel px-4">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll("table tbody tr");

            rows.forEach((row, index) => {
                const liburCheckbox = row.querySelector(".libur-check");
                const bukaInput = row.querySelector("input[name='jam_buka[]']");
                const tutupInput = row.querySelector("input[name='jam_tutup[]']");

                const toggleDisabled = (isLibur) => {
                    bukaInput.disabled = isLibur;
                    tutupInput.disabled = isLibur;
                    if (isLibur) {
                        bukaInput.value = '00:00';
                        tutupInput.value = '00:00';
                    }
                };

                toggleDisabled(liburCheckbox.checked);

                liburCheckbox.addEventListener("change", function() {
                    toggleDisabled(this.checked);
                    if (!this.checked) {
                        bukaInput.value = '00:00';
                        tutupInput.value = '23:59';
                    }
                });
            });
        });
    </script>
</body>

</html>
