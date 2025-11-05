<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Tempat Wisata</title>
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
            padding: 10px 30px;
            border-radius: 8px;
        }

        .btn-submit:hover {
            background-color: #2d5447;
        }
    </style>
</head>

<body>
    <div class="container">
        <h5 class="mt-4 text-center fw-bold">Kotabaru Tourism Data Center</h5>
        <h2 class="text-center fw-bold text-success mb-4">Tambah Tempat Wisata</h2>

        <div class="form-container shadow">
            <form method="POST" action="{{ route('wisata.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Nama Tempat Wisata</label>
                    <input type="text" name="nama_wisata" class="form-control" required>
                    <small class="form-text text-muted">Contoh: Pantai Gedambaan</small>
                </div>

                <div class="mb-3">
                    <label for="id_kategori">Kategori Wisata</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Kategori ditentukan oleh admin</small>
                </div>

                <div class="mb-3">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" class="form-control" rows="2"
                        placeholder="Contoh: Jl. Veteran No.12, Kotabaru, Kalimantan Selatan"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control">
                        <small class="form-text text-muted">Contoh: 116.8225</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control">
                        <small class="form-text text-muted">Contoh: -3.3211</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Deskripsi Wisata</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    <small class="form-text text-muted">Gambaran umum wisata</small>
                </div>
                <div class="mb-3">
                    <label>Sejarah Wisata</label>
                    <textarea name="sejarah" class="form-control" rows="3"></textarea>
                    <small class="form-text text-muted">Asal usul tempat wisata</small>
                </div>
                <div class="mb-3">
                    <label>Narasi Wisata</label>
                    <textarea name="narasi" class="form-control" rows="3"></textarea>
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
                            @endphp
                            @foreach ($days as $day)
                                <tr>
                                    <td class="py-1 px-2">
                                        <input type="text" name="hari[]"
                                            class="form-control form-control-sm text-center" value="{{ $day }}"
                                            readonly>
                                    </td>
                                    <td class="py-1 px-2">
                                        <input type="time" name="jam_buka[]" class="form-control form-control-sm"
                                            value="00:00">
                                    </td>
                                    <td class="py-1 px-2">
                                        <input type="time" name="jam_tutup[]" class="form-control form-control-sm"
                                            value="23:59">
                                    </td>
                                    <td class="py-1 px-2">
                                        <div class="form-check d-flex justify-content-center align-items-center">
                                            <input class="form-check-input libur-check" type="checkbox" name="libur[]"
                                                value="{{ $loop->index }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mb-3">
                    <label>Upload Foto</label>
                    <input type="file" name="foto[]" class="form-control" multiple>
                    <small class="form-text text-muted">Bisa upload beberapa foto. Maks 2MB per file.</small>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-submit">Submit</button>
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

                liburCheckbox.addEventListener("change", function() {
                    const isLibur = this.checked;
                    bukaInput.disabled = isLibur;
                    tutupInput.disabled = isLibur;
                    if (isLibur) {
                        bukaInput.value = '00:00';
                        tutupInput.value = '00:00';
                    } else {
                        bukaInput.value = '00:00';
                        tutupInput.value = '23:59';
                    }
                });
            });
        });
    </script>
</body>

</html>
