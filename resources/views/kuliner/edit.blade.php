<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Tempat Kuliner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inknut Antiqua', serif;
            background: url("{{ asset('images/bg-view.png') }}") no-repeat center center fixed;
            background-size: cover;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            max-width: 950px;
            margin: 40px auto;
        }

        .form-section {
            border-left: 4px solid #198754;
            padding-left: 10px;
        }

        .form-check-inline {
            margin-right: 1rem;
        }

        .form-text.note {
            font-size: 13px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <h5 class="mt-4 text-center fw-bold">Kotabaru Tourism Data Center</h5>
        <h2 class="text-center fw-bold text-success mb-4">Tambah Data Tempat Kuliner</h2>

        <div class="form-container shadow">
            <form action="{{ route('kuliner.update', $kuliner->id_kuliner) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')


                {{-- 1. Identitas Usaha --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success">1. Identitas Usaha</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Sentra / Usaha</label>
                            <input type="text" name="nama_sentra" class="form-control"
                                value="{{ old('nama_sentra', $kuliner->nama_sentra) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control text-center"
                                style="max-width:120px;" value="{{ old('tahun_berdiri', $kuliner->tahun_berdiri) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="form-control"
                                value="{{ old('nama_pemilik', $kuliner->nama_pemilik) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Kepemilikan</label>
                            <select name="kepemilikan" class="form-control" style="max-width:210px;">
                                <option value="">-- Pilih Status Kepemilikan --</option>
                                @foreach (['Pribadi', 'Keluarga', 'Komunitas', 'Waralaba'] as $kep)
                                    <option value="{{ $kep }}"
                                        {{ old('kepemilikan', $kuliner->kepemilikan) == $kep ? 'selected' : '' }}>
                                        {{ $kep }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control" rows="2">{{ old('alamat_lengkap', $kuliner->alamat_lengkap) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>No. Telepon</label>
                            <input type="text" name="telepon" class="form-control"
                                value="{{ old('telepon', $kuliner->telepon) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $kuliner->email) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>No. NIB</label>
                            <input type="text" name="no_nib" class="form-control"
                                value="{{ old('no_nib', $kuliner->no_nib) }}">
                        </div>
                    </div>

                    {{-- Sertifikat --}}
                    @php
                        // Pastikan sertifikat disimpan sebagai array
                        $sertifikatData = is_array($kuliner->sertifikat_lain)
                            ? $kuliner->sertifikat_lain
                            : json_decode($kuliner->sertifikat_lain ?? '[]', true);

                        $sertifikatLainText = '';

                        // Cek kalau ada data "Lainnya: ..."
                        foreach ($sertifikatData as $item) {
                            if (str_starts_with($item, 'Lainnya:')) {
                                $sertifikatLainText = trim(substr($item, 8)); // ambil teks setelah "Lainnya:"
                            }
                        }
                    @endphp

                    <div class="mb-3">
                        <label>Sertifikat (boleh lebih dari satu)</label><br>
                        @foreach (['PIRT', 'BPOM', 'Halal', 'NIB', 'Lainnya'] as $item)
                            @php
                                $checked =
                                    in_array($item, $sertifikatData) || ($item === 'Lainnya' && $sertifikatLainText)
                                        ? 'checked'
                                        : '';
                            @endphp
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="sertifikat_lain[]" value="{{ $item }}"
                                    id="sertifikat_{{ $item }}" class="form-check-input sertifikat-check"
                                    {{ $checked }}>
                                <label class="form-check-label"
                                    for="sertifikat_{{ $item }}">{{ $item }}</label>
                            </div>
                        @endforeach

                        <input type="text" id="sertifikat_lain_text" name="sertifikat_lain_text"
                            class="form-control mt-2" value="{{ $sertifikatLainText }}"
                            placeholder="Tulis sertifikat lainnya..."
                            style="display: {{ $sertifikatLainText ? 'block' : 'none' }}; max-width:300px;">
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Pegawai</label>
                            <input type="number" name="jumlah_pegawai" class="form-control"
                                value="{{ old('jumlah_pegawai', $kuliner->jumlah_pegawai) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Kursi</label>
                            <input type="number" name="jumlah_kursi" class="form-control"
                                value="{{ old('jumlah_kursi', $kuliner->jumlah_kursi) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Gerai</label>
                            <input type="number" name="jumlah_gerai" class="form-control"
                                value="{{ old('jumlah_gerai', $kuliner->jumlah_gerai) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Pelanggan per Hari</label>
                            <input type="number" name="jumlah_pelanggan_per_hari" class="form-control"
                                value="{{ old('jumlah_pelanggan_per_hari', $kuliner->jumlah_pelanggan_per_hari) }}">
                        </div>
                    </div>

                    {{-- Jam Operasional --}}
                    @php
                        $jam = $kuliner->jamOperasional->keyBy('hari');
                    @endphp
                    <hr>
                    <h6 class="fw-bold text-success mt-4 mb-3">Jam Operasional & Jam Sibuk</h6>
                    <table class="table table-bordered text-center align-middle table-sm" style="font-size: 0.9rem;">
                        <thead class="table-light">
                            <tr>
                                <th>Hari</th>
                                <th>Jam Buka</th>
                                <th>Jam Tutup</th>
                                <th>Jam Sibuk Mulai</th>
                                <th>Jam Sibuk Selesai</th>
                                <th>Libur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $i => $hari)
                                @php $data = $jam[$hari] ?? null; @endphp
                                <tr>
                                    <td><input type="text" name="hari[{{ $i }}]"
                                            class="form-control text-center form-control-sm"
                                            value="{{ $hari }}" readonly></td>
                                    <td><input type="time" name="jam_buka[{{ $i }}]"
                                            class="form-control form-control-sm"
                                            value="{{ old('jam_buka.' . $i, $data->jam_buka ?? '08:00') }}"></td>
                                    <td><input type="time" name="jam_tutup[{{ $i }}]"
                                            class="form-control form-control-sm"
                                            value="{{ old('jam_tutup.' . $i, $data->jam_tutup ?? '21:00') }}"></td>
                                    <td><input type="time" name="jam_sibuk_mulai[{{ $i }}]"
                                            class="form-control form-control-sm"
                                            value="{{ old('jam_sibuk_mulai.' . $i, $data->jam_sibuk_mulai ?? '') }}">
                                    </td>
                                    <td><input type="time" name="jam_sibuk_selesai[{{ $i }}]"
                                            class="form-control form-control-sm"
                                            value="{{ old('jam_sibuk_selesai.' . $i, $data->jam_sibuk_selesai ?? '') }}">
                                    </td>
                                    <td><input type="checkbox" name="libur[{{ $i }}]"
                                            class="form-check-input" {{ empty($data->jam_buka) ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Profil Pelanggan --}}
                    @php
                        $profil = json_decode($kuliner->profil_pelanggan ?? '[]', true);
                    @endphp
                    <div class="mb-3">
                        <label>Profil Pelanggan</label><br>
                        @foreach (['Lokal', 'Wisatawan', 'Pelajar/Mahasiswa', 'Pekerja'] as $p)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="profil_pelanggan[]" value="{{ $p }}"
                                    class="form-check-input"
                                    {{ in_array($p, old('profil_pelanggan', $profil)) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $p }}</label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Metode Pembayaran --}}
                    @php
                        $metode = json_decode($kuliner->metode_pembayaran ?? '[]', true);
                    @endphp
                    <div class="mb-3">
                        <label>Metode Pembayaran</label><br>
                        @foreach (['Tunai', 'QRIS / Transfer'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="metode_pembayaran[]" value="{{ $m }}"
                                    class="form-check-input"
                                    {{ in_array($m, old('metode_pembayaran', $metode)) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $m }}</label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pajak / Retribusi --}}
                    <div class="mb-3">
                        <label>Pajak / Retribusi</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pajak_retribusi" value="1"
                                {{ old('pajak_retribusi', $kuliner->pajak_retribusi) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pajak_retribusi" value="0"
                                {{ old('pajak_retribusi', $kuliner->pajak_retribusi) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label">Tidak</label>
                        </div>
                    </div>
                </div>

                <!-- 2. JENIS KULINER -->
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success">2. Jenis Kuliner</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kategori</label><br>
                            @php
                                $kategoriData = json_decode($kuliner->kategori ?? '[]', true) ?? [];
                                $kategoriLain = '';

                                // Cek apakah ada data kategori yang diawali dengan 'Lainnya:'
                                foreach ($kategoriData as $item) {
                                    if (str_starts_with($item, 'Lainnya:')) {
                                        $kategoriLain = trim(substr($item, 8));
                                        break;
                                    }
                                }
                            @endphp

                            @foreach (['Tradisional/Domestik', 'Modern/Luar Negeri', 'Street Food', 'Lainnya'] as $kategori)
                                @php
                                    $checked =
                                        in_array($kategori, $kategoriData) || ($kategori === 'Lainnya' && $kategoriLain)
                                            ? 'checked'
                                            : '';
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="kategori[]" value="{{ $kategori }}"
                                        class="form-check-input kategori-check" {{ $checked }}>
                                    <label class="form-check-label">{{ $kategori }}</label>
                                </div>
                            @endforeach

                            <input type="text" id="kategori_lain" name="kategori_lain"
                                value="{{ $kategoriLain }}" class="form-control mt-2"
                                placeholder="Tulis kategori lain..."
                                style="{{ $kategoriLain ? '' : 'display:none;' }}; max-width:400px;">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Menu Unggulan</label>
                            <input type="text" name="menu_unggulan" class="form-control"
                                value="{{ old('menu_unggulan', $kuliner->menu_unggulan) }}"
                                placeholder="Contoh: Soto Banjar Spesial">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Bahan Baku Utama</label>
                            <input type="text" name="bahan_baku_utama" class="form-control"
                                value="{{ old('bahan_baku_utama', $kuliner->bahan_baku_utama) }}"
                                placeholder="Contoh: Daging ayam, rempah lokal">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sumber Bahan Baku</label>
                            <select name="sumber_bahan_baku" class="form-control">
                                <option value="" disabled>-- Pilih Sumber Bahan Baku --</option>
                                @foreach (['Lokal', 'Domestik/Luar Kota', 'Import/Luar Negeri', 'Campuran'] as $sumber)
                                    <option value="{{ $sumber }}"
                                        {{ $kuliner->sumber_bahan_baku == $sumber ? 'selected' : '' }}>
                                        {{ $sumber }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Menu Bersifat</label><br>
                        @foreach (['Tetap', 'Musiman'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="menu_bersifat[]" value="{{ $m }}"
                                    class="form-check-input"
                                    {{ in_array($m, json_decode($kuliner->menu_bersifat ?? '[]', true) ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $m }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 3. TEMPAT & FASILITAS -->
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success">3. Tempat & Fasilitas</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Bentuk Fisik</label>
                            <select name="bentuk_fisik" class="form-control">
                                <option value="" disabled {{ $kuliner->bentuk_fisik ? '' : 'selected' }}>--
                                    Pilih Bentuk Fisik--</option>
                                <option value="Restoran" {{ $kuliner->bentuk_fisik == 'Restoran' ? 'selected' : '' }}>
                                    Restoran</option>
                                <option value="Warung" {{ $kuliner->bentuk_fisik == 'Warung' ? 'selected' : '' }}>
                                    Warung</option>
                                <option value="Kafe" {{ $kuliner->bentuk_fisik == 'Kafe' ? 'selected' : '' }}>Kafe
                                </option>
                                <option value="Foodcourt"
                                    {{ $kuliner->bentuk_fisik == 'Foodcourt' ? 'selected' : '' }}>Foodcourt</option>
                                <option value="Jasa Boga (Katering)"
                                    {{ $kuliner->bentuk_fisik == 'Jasa Boga (Katering)' ? 'selected' : '' }}>Jasa Boga
                                    (Katering)</option>
                                <option value="Penyedia Makanan oleh Pedagang Keliling"
                                    {{ $kuliner->bentuk_fisik == 'Penyedia Makanan oleh Pedagang Keliling' ? 'selected' : '' }}>
                                    Penyedia Makanan oleh Pedagang Keliling</option>
                                <option value="Penyedia Makanan oleh Pedagang Tidak Keliling"
                                    {{ $kuliner->bentuk_fisik == 'Penyedia Makanan oleh Pedagang Tidak Keliling' ? 'selected' : '' }}>
                                    Penyedia Makanan oleh Pedagang Tidak Keliling</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Status Bangunan</label>
                            <select name="status_bangunan" id="status_bangunan" class="form-control">
                                <option value="" disabled {{ $kuliner->status_bangunan ? '' : 'selected' }}>--
                                    Pilih Status Bangunan --</option>
                                <option value="Milik Sendiri"
                                    {{ $kuliner->status_bangunan == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri
                                </option>
                                <option value="Sewa" {{ $kuliner->status_bangunan == 'Sewa' ? 'selected' : '' }}>
                                    Sewa</option>
                                <option value="Pinjam Pakai"
                                    {{ $kuliner->status_bangunan == 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai
                                </option>
                                <option value="Lainnya"
                                    {{ str_starts_with($kuliner->status_bangunan, 'Lainnya:') ? 'selected' : '' }}>
                                    Lainnya...</option>
                            </select>

                            <input type="text" id="status_lain" name="status_lain" class="form-control mt-1"
                                placeholder="Tulis status lain..."
                                value="{{ str_starts_with($kuliner->status_bangunan, 'Lainnya:') ? substr($kuliner->status_bangunan, 9) : '' }}"
                                style="{{ str_starts_with($kuliner->status_bangunan, 'Lainnya:') ? '' : 'display:none;' }}; max-width:400px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Fasilitas Pendukung</label><br>
                        @php
                            $fasilitas = is_string($kuliner->fasilitas_pendukung)
                                ? json_decode($kuliner->fasilitas_pendukung, true)
                                : $kuliner->fasilitas_pendukung;
                            $fasilitas = is_array($fasilitas) ? $fasilitas : [];
                        @endphp
                        @foreach (['Toilet', 'Wastafel', 'Parkir', 'Mushola', 'WiFi', 'Tempat Sampah'] as $f)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="fasilitas_pendukung[]" value="{{ $f }}"
                                    class="form-check-input" {{ in_array($f, $fasilitas ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $f }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4. PRAKTIK K3 & SANITASI -->
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success mb-3">4. Praktik K3 & Sanitasi</h5>

                    {{-- Pelatihan & Penjamah --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Pelatihan K3</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pelatihan_k3_penjamah"
                                    value="1" {{ $kuliner->pelatihan_k3_penjamah == 1 ? 'checked' : '' }}>
                                <label class="form-check-label">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pelatihan_k3_penjamah"
                                    value="0" {{ $kuliner->pelatihan_k3_penjamah == 0 ? 'checked' : '' }}>
                                <label class="form-check-label">Tidak</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Jumlah Penjamah Makanan</label>
                            <input type="number" name="jumlah_penjamah_makanan" class="form-control"
                                value="{{ $kuliner->jumlah_penjamah_makanan }}" placeholder="Contoh: 3">
                        </div>
                    </div>

                    {{-- APD --}}
                    <div class="mb-4">
                        <label class="d-block mb-2">Alat Pelindung Diri Penjamah Makanan</label>
                        @php
                            $apdPenjamah = json_decode($kuliner->apd_penjamah_makanan, true) ?? [];
                        @endphp
                        <div class="d-flex flex-wrap" style="gap: 1rem;">
                            @foreach (['Masker', 'Hairnet', 'Celemek', 'Sarung Tangan'] as $apd)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="apd_penjamah_makanan[]" value="{{ $apd }}"
                                        class="form-check-input" {{ in_array($apd, $apdPenjamah) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $apd }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sanitasi Alat & Bahan --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Sanitasi Alat Dapur</label>
                            <select name="prosedur_sanitasi_alat" class="form-control" style="max-width:250px;">
                                <option value="0" {{ $kuliner->prosedur_sanitasi_alat == 0 ? 'selected' : '' }}>
                                    Tidak Melakukan</option>
                                <option value="1" {{ $kuliner->prosedur_sanitasi_alat == 1 ? 'selected' : '' }}>
                                    Melakukan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 frekuensi-sanitasi-alat">
                            <label>Frekuensi Sanitasi Alat</label>
                            <input type="text" name="frekuensi_sanitasi_alat" class="form-control"
                                style="max-width:250px;" placeholder="2 kali sehari"
                                value="{{ $kuliner->frekuensi_sanitasi_alat }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Sanitasi Bahan Makanan</label>
                            <select name="prosedur_sanitasi_bahan" class="form-control" style="max-width:250px;">
                                <option value="0" {{ $kuliner->prosedur_sanitasi_bahan == 0 ? 'selected' : '' }}>
                                    Tidak Melakukan</option>
                                <option value="1" {{ $kuliner->prosedur_sanitasi_bahan == 1 ? 'selected' : '' }}>
                                    Melakukan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 frekuensi-sanitasi-bahan">
                            <label>Frekuensi Sanitasi Bahan</label>
                            <input type="text" name="frekuensi_sanitasi_bahan" class="form-control"
                                style="max-width:250px;" placeholder="2 kali sehari"
                                value="{{ $kuliner->frekuensi_sanitasi_bahan }}">
                        </div>
                    </div>

                    {{-- Penyimpanan --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Penyimpanan Bahan Mentah</label>
                            <select name="penyimpanan_mentah" class="form-control">
                                @foreach (['Dengan Pendingin, Terpisah', 'Dengan Pendingin, Tidak Terpisah', 'Tanpa Pendingin, Terpisah', 'Tanpa Pendingin, Tidak Terpisah'] as $opt)
                                    <option value="{{ $opt }}"
                                        {{ $kuliner->penyimpanan_mentah == $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Penyimpanan Bahan Matang</label>
                            <select name="penyimpanan_matang" class="form-control">
                                @foreach (['Dengan Pendingin, Terpisah', 'Dengan Pendingin, Tidak Terpisah', 'Tanpa Pendingin, Terpisah', 'Tanpa Pendingin, Tidak Terpisah'] as $opt)
                                    <option value="{{ $opt }}"
                                        {{ $kuliner->penyimpanan_matang == $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Prinsip FIFO / FEFO</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="prinsip_fifo_fefo"
                                        value="1" {{ $kuliner->prinsip_fifo_fefo == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="prinsip_fifo_fefo"
                                        value="0" {{ $kuliner->prinsip_fifo_fefo == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Limbah & Ventilasi --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Limbah Dapur</label>
                            <select name="limbah_dapur" class="form-control">
                                @foreach (['Dipisah', 'Tidak Dipisah'] as $opt)
                                    <option value="{{ $opt }}"
                                        {{ $kuliner->limbah_dapur == $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Ventilasi Dapur</label>
                            <select name="ventilasi_dapur" class="form-control">
                                @foreach (['Alami', 'Buatan'] as $opt)
                                    <option value="{{ $opt }}"
                                        {{ $kuliner->ventilasi_dapur == $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Dapur</label>
                            <select name="dapur" class="form-control">
                                @foreach (['Ada, terpisah', 'Ada, tidak terpisah', 'Tidak ada'] as $opt)
                                    <option value="{{ $opt }}"
                                        {{ $kuliner->dapur == $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Sumber Air --}}
                    <div class="row">
                        @foreach (['sumber_air_cuci' => 'Sumber Air Cuci', 'sumber_air_masak' => 'Sumber Air Masak', 'sumber_air_minum' => 'Sumber Air Minum'] as $name => $label)
                            <div class="col-md-4 mb-3">
                                <label>{{ $label }}</label>
                                <select name="{{ $name }}" class="form-control">
                                    @foreach (['PDAM', 'Sumur', 'Air Isi Ulang'] as $opt)
                                        <option value="{{ $opt }}"
                                            {{ $kuliner->$name == $opt ? 'selected' : '' }}>
                                            {{ $opt }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 5. KOORDINAT -->
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success">5. Koordinat Lokasi</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Longitude</label>
                            <input type="text" name="longitude" class="form-control"
                                value="{{ $kuliner->longitude }}" placeholder="116.8225">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Latitude</label>
                            <input type="text" name="latitude" class="form-control"
                                value="{{ $kuliner->latitude }}" placeholder="-3.3211">
                        </div>
                    </div>
                </div>

                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success">6. Foto Kuliner</h3>
                        <div class="mb-3">
                            <label>Foto Lama</label><br>
                            @foreach ($kuliner->foto as $f)
                                <img src="{{ asset('storage/' . $f->path_foto) }}"
                                    alt="Foto {{ $kuliner->nama_sentra }}" width="100" class="me-2 mb-2">
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label>Upload Foto Baru</label>
                            <input type="file" name="foto[]" class="form-control" multiple>
                            <small class="form-text text-muted">Bisa upload beberapa foto. Maks 2MB per file.</small>
                        </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                    <a href="{{ route('kuliner.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // === 1. SERTIFIKAT "LAINNYA" ===
            const sertifikatChecks = document.querySelectorAll(".sertifikat-check");
            const sertifikatLainText = document.getElementById("sertifikat_lain_text");
            if (sertifikatChecks.length && sertifikatLainText) {
                sertifikatChecks.forEach(c => {
                    c.addEventListener("change", () => {
                        const isOtherChecked = Array.from(sertifikatChecks)
                            .some(chk => chk.value === "Lainnya" && chk.checked);
                        sertifikatLainText.style.display = isOtherChecked ? "block" : "none";
                        if (!isOtherChecked) sertifikatLainText.value = "";
                    });
                });
            }

            // === 2. KATEGORI "LAINNYA" ===
            const kategoriChecks = document.querySelectorAll(".kategori-check");
            const kategoriLainText = document.getElementById("kategori_lain");
            if (kategoriChecks.length && kategoriLainText) {
                kategoriChecks.forEach(c => {
                    c.addEventListener("change", () => {
                        const isOtherChecked = Array.from(kategoriChecks)
                            .some(chk => chk.value === "Lainnya" && chk.checked);
                        kategoriLainText.style.display = isOtherChecked ? "block" : "none";
                        if (!isOtherChecked) kategoriLainText.value = "";
                    });
                });
            }

            // === 3. STATUS BANGUNAN "LAINNYA" ===
            const statusSelect = document.querySelector('select[name="status_bangunan"]');
            const statusLainInput = document.getElementById("status_lain");
            if (statusSelect && statusLainInput) {
                statusSelect.addEventListener("change", () => {
                    if (statusSelect.value === "Lainnya") {
                        statusLainInput.style.display = "block";
                    } else {
                        statusLainInput.style.display = "none";
                        statusLainInput.value = "";
                    }
                });
            }

            // === 4. JAM OPERASIONAL: Checkbox "Libur" ===
            const rows = document.querySelectorAll("table tbody tr");
            rows.forEach(row => {
                const checkbox = row.querySelector('input[type="checkbox"][name^="libur["]');
                const timeInputs = row.querySelectorAll('input[type="time"]');
                if (!checkbox || !timeInputs.length) return;

                const defaultValues = Array.from(timeInputs).map(input => input.value);

                if (checkbox.checked) {
                    timeInputs.forEach(input => {
                        input.value = "";
                        input.disabled = true;
                    });
                }

                checkbox.addEventListener("change", () => {
                    if (checkbox.checked) {
                        timeInputs.forEach(input => {
                            input.value = "";
                            input.disabled = true;
                        });
                    } else {
                        timeInputs.forEach((input, idx) => {
                            input.disabled = false;
                            input.value = defaultValues[idx] || "";
                        });
                    }
                });
            });

            // === 5. AUTO TAMPIL SAAT ADA NILAI DARI DATABASE ===
            if (sertifikatLainText && sertifikatLainText.value.trim() !== "") {
                sertifikatLainText.style.display = "block";
                const lainCheckbox = Array.from(sertifikatChecks).find(chk => chk.value === "Lainnya");
                if (lainCheckbox) lainCheckbox.checked = true;
            }

            if (kategoriLainText && kategoriLainText.value.trim() !== "") {
                kategoriLainText.style.display = "block";
                const lainCheckbox = Array.from(kategoriChecks).find(chk => chk.value === "Lainnya");
                if (lainCheckbox) lainCheckbox.checked = true;
            }

            if (statusLainInput && statusLainInput.value.trim() !== "") {
                statusLainInput.style.display = "block";
                if (statusSelect) statusSelect.value = "Lainnya";
            }
        });
    </script>

</body>

</html>
