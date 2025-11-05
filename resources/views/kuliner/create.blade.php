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
            <form method="POST" action="{{ route('kuliner.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- 1. Identitas Usaha --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success">1. Identitas Usaha</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Sentra / Usaha</label>
                            <input type="text" name="nama_sentra" class="form-control"
                                placeholder="Contoh: Warung Sari Laut Kotabaru">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control text-center" maxlength="4"
                                style="max-width:120px;" placeholder="2020">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="form-control"
                                placeholder="Contoh: Budi Santoso">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Kepemilikan</label>
                            <select name="kepemilikan" class="form-control" style="max-width:210px;">
                                <option value="" disabled selected>-- Pilih Status Kepemilikan --</option>
                                <option value="Pribadi">Pribadi</option>
                                <option value="Keluarga">Keluarga</option>
                                <option value="Komunitas">Komunitas</option>
                                <option value="Waralaba">Waralaba</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control" rows="2"
                            placeholder="Contoh: Jl. Veteran No.12, Kotabaru, Kalimantan Selatan"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>No. Telepon</label>
                            <input type="text" name="telepon" class="form-control" placeholder="0812-3456-7890">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="contoh@email.com">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>No. NIB</label>
                            <input type="text" name="no_nib" class="form-control"
                                placeholder="Nomor Induk Berusaha">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Sertifikat (boleh lebih dari satu)</label><br>
                        @foreach (['PIRT', 'BPOM', 'Halal', 'NIB', 'Lainnya'] as $item)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="sertifikat_lain[]" value="{{ $item }}"
                                    id="sertifikat_{{ $item }}" class="form-check-input sertifikat-check">
                                <label class="form-check-label"
                                    for="sertifikat_{{ $item }}">{{ $item }}</label>
                            </div>
                        @endforeach
                        <input type="text" id="sertifikat_lain_text" name="sertifikat_lain_text"
                            class="form-control mt-2" placeholder="Tulis sertifikat lainnya..."
                            style="display:none; max-width:300px;">
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Pegawai</label>
                            <input type="number" name="jumlah_pegawai" class="form-control" placeholder="Contoh: 25">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Kursi</label>
                            <input type="number" name="jumlah_kursi" class="form-control" placeholder="Contoh: 25">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Gerai</label>
                            <input type="number" name="jumlah_gerai" class="form-control" placeholder="Contoh: 25">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Pelanggan per Hari</label>
                            <input type="number" name="jumlah_pelanggan_per_hari" class="form-control"
                                placeholder="Contoh: 25">
                        </div>
                    </div>

                    <!-- JAM OPERASIONAL -->
                    <hr>
                    <h6 class="fw-bold text-success mt-4 mb-3">Jam Operasional & Jam Sibuk</h6>
                    <div class="alert alert-info">
                        <ul class="mb-0">
                            <li>Isi jam buka, jam tutup, dan jam sibuk jika ada.</li>
                            <li>Centang “Libur” bila tempat tidak beroperasi hari itu.</li>
                        </ul>
                    </div>

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
                            @php
                                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                            @endphp
                            @foreach ($days as $day)
                                <tr>
                                    <td><input type="text" name="hari[]"
                                            class="form-control text-center form-control-sm"
                                            value="{{ $day }}" readonly></td>
                                    <td><input type="time" name="jam_buka[]" class="form-control form-control-sm"
                                            value="08:00"></td>
                                    <td><input type="time" name="jam_tutup[]" class="form-control form-control-sm"
                                            value="21:00"></td>
                                    <td><input type="time" name="jam_sibuk_mulai[]"
                                            class="form-control form-control-sm"></td>
                                    <td><input type="time" name="jam_sibuk_selesai[]"
                                            class="form-control form-control-sm"></td>
                                    <td><input type="checkbox" name="libur[]" class="form-check-input"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mb-3">
                        <label>Profil Pelanggan</label><br>
                        @foreach (['Lokal', 'Wisatawan', 'Pelajar/Mahasiswa', 'Pekerja'] as $p)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="profil_pelanggan[]" value="{{ $p }}"
                                    class="form-check-input">
                                <label class="form-check-label">{{ $p }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label>Metode Pembayaran</label><br>
                        @foreach (['Tunai', 'QRIS', 'Transfer'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="metode_pembayaran[]" value="{{ $m }}"
                                    class="form-check-input">
                                <label class="form-check-label">{{ $m }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label>Pajak / Retribusi</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pajak_retribusi" value="1">
                            <label class="form-check-label">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pajak_retribusi" value="0">
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
                            @foreach (['Tradisional/Domestik', 'Modern/Luar Negeri', 'Street Food', 'Lainnya'] as $kategori)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="kategori[]" value="{{ $kategori }}"
                                        class="form-check-input kategori-check">
                                    <label class="form-check-label">{{ $kategori }}</label>
                                </div>
                            @endforeach
                            <input type="text" id="kategori_lain" name="kategori_lain" class="form-control mt-2"
                                placeholder="Tulis kategori lain..." style="display:none; max-width:400px;">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Menu Unggulan</label>
                            <input type="text" name="menu_unggulan" class="form-control"
                                placeholder="Contoh: Soto Banjar Spesial">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Bahan Baku Utama</label>
                            <input type="text" name="bahan_baku_utama" class="form-control"
                                placeholder="Contoh: Daging ayam, rempah lokal">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sumber Bahan Baku</label>
                            <select name="sumber_bahan_baku" class="form-control">
                                <option value="" disabled selected>-- Pilih Sumber Bahan Baku --</option>
                                <option value="Lokal">Lokal</option>
                                <option value="Domestik/Luar Kota">Domestik / Luar Kota</option>
                                <option value="Import/Luar Negeri">Import / Luar Negeri</option>
                                <option value="Campuran">Campuran</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Menu Bersifat</label><br>
                        @foreach (['Tetap', 'Musiman', 'Berganti Tiap Minggu'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="menu_bersifat[]" value="{{ $m }}"
                                    class="form-check-input">
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
                                <option value="" disabled selected>-- Pilih Bentuk Fisik--</option>
                                <option value="Restoran">Restoran</option>
                                <option value="Warung">Warung</option>
                                <option value="Kafe">Kafe</option>
                                <option value="Foodcourt">Foodcourt</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Status Bangunan</label>
                            <select name="status_bangunan" class="form-control">
                                <option value="" disabled selected>-- Pilih Status Bangunan --</option>
                                <option value="Milik Sendiri">Milik Sendiri</option>
                                <option value="Sewa">Sewa</option>
                                <option value="Pinjam Pakai">Pinjam Pakai</option>
                                <option value="Lainnya">Lainnya...</option>
                            </select>
                            <input type="text" id="status_lain" name="status_lain" class="form-control mt-1"
                                placeholder="Tulis status lain..." style="display:none; max-width:400px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Fasilitas Pendukung</label><br>
                        @foreach (['Toilet', 'Wastafel', 'Parkir', 'Mushola', 'WiFi', 'Tempat Sampah'] as $f)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="fasilitas_pendukung[]" value="{{ $f }}"
                                    class="form-check-input">
                                <label class="form-check-label">{{ $f }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4. PRAKTIK K3 & SANITASI -->
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success mb-3">4. Praktik K3 & Sanitasi</h5>

                    <!-- Pelatihan & Penjamah -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Pelatihan K3 untuk Penjamah Makanan</label>
                            <select name="pelatihan_k3" class="form-control" style="max-width:250px;">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Jumlah Penjamah Makanan</label>
                            <input type="number" name="jumlah_penjamah_makanan" class="form-control"
                                placeholder="Contoh: 3">
                        </div>
                    </div>

                    <!-- APD -->
                    <div class="mb-4">
                        <label class="d-block mb-2">Alat Pelindung Diri Penjamah Makanan</label>
                        <div class="d-flex flex-wrap" style="gap: 1rem;">
                            @foreach (['Masker', 'Hairnet', 'Celemek', 'Sarung Tangan'] as $apd)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="apd_penjamah_makanan[]" value="{{ $apd }}"
                                        class="form-check-input">
                                    <label class="form-check-label">{{ $apd }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sanitasi Alat & Bahan -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Sanitasi Alat Dapur</label>
                            <select name="prosedur_sanitasi_alat" class="form-control" style="max-width:250px;">
                                <option value="0">Tidak Melakukan</option>
                                <option value="1">Melakukan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 frekuensi-sanitasi-alat">
                            <label>Frekuensi Sanitasi Alat</label>
                            <select name="frekuensi_sanitasi_alat" class="form-control" style="max-width:250px;">
                                <option value="">-- Pilih Frekuensi --</option>
                                <option value="Harian">Harian</option>
                                <option value="Mingguan">Mingguan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Sanitasi Bahan Makanan</label>
                            <select name="prosedur_sanitasi_bahan" class="form-control" style="max-width:250px;">
                                <option value="0">Tidak Melakukan</option>
                                <option value="1">Melakukan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 frekuensi-sanitasi-bahan">
                            <label>Frekuensi Sanitasi Bahan</label>
                            <select name="frekuensi_sanitasi_bahan" class="form-control" style="max-width:250px;">
                                <option value="">-- Pilih Frekuensi --</option>
                                <option value="Harian">Harian</option>
                                <option value="Mingguan">Mingguan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Penyimpanan -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Penyimpanan Bahan Mentah</label>
                            <select name="penyimpanan_mentah" class="form-control">
                                <option value="">-- Pilih Penyimpanan Bahan Mentah --</option>
                                <option value="Dengan Pendingin">Dengan Pendingin</option>
                                <option value="Tanpa Pendingin">Tanpa Pendingin</option>
                                <option value="Terpisah">Terpisah</option>
                                <option value="Tidak Terpisah">Tidak Terpisah</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Penyimpanan Bahan Matang</label>
                            <select name="penyimpanan_matang" class="form-control">
                                <option value="">-- Pilih Penyimpanan Bahan Matang --</option>
                                <option value="Dengan Pendingin">Dengan Pendingin</option>
                                <option value="Tanpa Pendingin">Tanpa Pendingin</option>
                                <option value="Terpisah">Terpisah</option>
                                <option value="Tidak Terpisah">Tidak Terpisah</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label>Prinsip FIFO / FEFO</label>
                            <select name="fifo_fefo" class="form-control" style="max-width:250px;">
                                <option value="0">Tidak Diterapkan</option>
                                <option value="1">Diterapkan</option>
                            </select>
                        </div>
                    </div>



                    <!-- Limbah & Ventilasi -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Limbah Dapur</label>
                            <select name="limbah_dapur" class="form-control">
                                <option value="">-- Pilih Limbah Dapur--</option>
                                <option value="Dipisah">Dipisah</option>
                                <option value="Tidak Dipisah">Tidak Dipisah</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Ventilasi Dapur</label>
                            <select name="ventilasi_dapur" class="form-control">
                                <option value="">-- Pilih Ventilasi Dapur --</option>
                                <option value="Alami">Alami</option>
                                <option value="Buatan">Buatan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Dapur</label>
                            <select name="kondisi_dapur" class="form-control">
                                <option value="">-- Pilih Dapur --</option>
                                <option value="Ada, terpisah">Ada, terpisah</option>
                                <option value="Ada, tidak terpisah">Ada, tidak terpisah</option>
                                <option value="Tidak ada">Tidak ada</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sumber Air -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Sumber Air Cuci</label>
                            <select name="sumber_air_cuci" class="form-control">
                                <option value="">-- Pilih Sumber Air Cuci --</option>
                                <option value="PDAM">PDAM</option>
                                <option value="Sumur">Sumur</option>
                                <option value="Air Isi Ulang">Air Isi Ulang</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Sumber Air Masak</label>
                            <select name="sumber_air_masak" class="form-control">
                                <option value="">-- Pilih Sumber Air Masak --</option>
                                <option value="PDAM">PDAM</option>
                                <option value="Sumur">Sumur</option>
                                <option value="Air Isi Ulang">Air Isi Ulang</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Sumber Air Minum</label>
                            <select name="sumber_air_minum" class="form-control">
                                <option value="">-- Pilih Sumber Air Minum --</option>
                                <option value="PDAM">PDAM</option>
                                <option value="Sumur">Sumur</option>
                                <option value="Air Isi Ulang">Air Isi Ulang</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 5. KOORDINAT -->
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success">5. Koordinat Lokasi</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Longitude</label>
                            <input type="text" name="longitude" class="form-control" placeholder="116.8225">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Latitude</label>
                            <input type="text" name="latitude" class="form-control" placeholder="-3.3211">
                        </div>
                    </div>
                </div>

                <div class="form-section mb-4">
                    <h5 class="fw-bold text-success">6. Foto Kuliner</h3>
                        <div class="mb-3">
                            <input type="file" name="foto[]" class="form-control" multiple>
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
            // --- SERTIFIKAT "LAINNYA" ---
            const sertifikatChecks = document.querySelectorAll(".sertifikat-check");
            const sertifikatLainText = document.getElementById("sertifikat_lain_text");

            sertifikatChecks.forEach(c => {
                c.addEventListener("change", () => {
                    const isOtherChecked = Array.from(sertifikatChecks)
                        .some(chk => chk.value === "Lainnya" && chk.checked);
                    sertifikatLainText.style.display = isOtherChecked ? "block" : "none";
                    if (!isOtherChecked) sertifikatLainText.value = "";
                });
            });

            // --- KATEGORI "LAINNYA" ---
            const kategoriChecks = document.querySelectorAll(".kategori-check");
            const kategoriLainText = document.getElementById("kategori_lain");

            kategoriChecks.forEach(c => {
                c.addEventListener("change", () => {
                    const isOtherChecked = Array.from(kategoriChecks)
                        .some(chk => chk.value === "Lainnya" && chk.checked);
                    kategoriLainText.style.display = isOtherChecked ? "block" : "none";
                    if (!isOtherChecked) kategoriLainText.value = "";
                });
            });

            // --- STATUS BANGUNAN "LAINNYA" ---
            const statusSelect = document.querySelector('select[name="status_bangunan"]');
            const statusLainInput = document.getElementById("status_lain");

            statusSelect.addEventListener("change", () => {
                if (statusSelect.value === "Lainnya") {
                    statusLainInput.style.display = "block";
                } else {
                    statusLainInput.style.display = "none";
                    statusLainInput.value = "";
                }
            });

            // --- TABEL JAM OPERASIONAL: LIBUR CHECKBOX ---
            const rows = document.querySelectorAll("table tbody tr");
            rows.forEach(row => {
                const checkbox = row.querySelector('input[type="checkbox"][name="libur[]"]');
                const timeInputs = row.querySelectorAll('input[type="time"]');

                checkbox.addEventListener("change", () => {
                    timeInputs.forEach(input => {
                        input.disabled = checkbox.checked;
                        if (checkbox.checked) input.value = "";
                    });
                });
            });

            function toggleFrekuensi(selectId, frekuensiDivId) {
                const select = document.querySelector(selectId);
                const frekuensiDiv = document.querySelector(frekuensiDivId);

                function updateVisibility() {
                    if (select.value === "1") { // 1 = Melakukan
                        frekuensiDiv.style.display = "block";
                    } else {
                        frekuensiDiv.style.display = "none";
                        // Hapus nilai agar tidak terkirim waktu disembunyikan
                        const freqSelect = frekuensiDiv.querySelector("select");
                        if (freqSelect) freqSelect.value = "";
                    }
                }

                select.addEventListener("change", updateVisibility);
                updateVisibility(); // jalankan saat load
            }

            // Terapkan untuk sanitasi alat
            toggleFrekuensi(
                "select[name='prosedur_sanitasi_alat']",
                ".frekuensi-sanitasi-alat"
            );

            // Terapkan untuk sanitasi bahan
            toggleFrekuensi(
                "select[name='prosedur_sanitasi_bahan']",
                ".frekuensi-sanitasi-bahan"
            );
        });
    </script>
</body>

</html>
