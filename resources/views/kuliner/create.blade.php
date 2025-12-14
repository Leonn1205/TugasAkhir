<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Tempat Kuliner - Kotabaru Tourism</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url("{{ asset('images/bg-view.png') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            padding: 20px 0;
        }

        .header-section {
            background: linear-gradient(135deg, rgba(27, 94, 32, 0.95) 0%, rgba(46, 125, 50, 0.95) 100%);
            color: white;
            padding: 2.5rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .header-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-section p {
            font-size: 15px;
            opacity: 0.95;
            margin: 0;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        .form-section {
            border-left: 4px solid #2e7d32;
            padding-left: 15px;
            margin-bottom: 2.5rem;
        }

        .form-section h5 {
            color: #1b5e20;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section h6 {
            color: #2e7d32;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 16px;
        }

        label {
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 14px;
            display: block;
        }

        .form-control,
        .form-select {
            border: 2px solid #c8e6c9;
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid #c8e6c9;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }

        .form-check-label {
            font-size: 14px;
            color: #333;
            cursor: pointer;
            margin-left: 5px;
        }

        .form-check-inline {
            margin-right: 1.5rem;
        }

        .form-text.note {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-top: 5px;
        }

        .file-upload-wrapper {
            position: relative;
            border: 3px dashed #2e7d32;
            border-radius: 15px;
            padding: 3rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, #f1f8f4 0%, #e8f5e9 100%);
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .file-upload-wrapper:hover {
            border-color: #1b5e20;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(46, 125, 50, 0.2);
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .file-upload-icon {
            font-size: 60px;
            color: #2e7d32;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .file-upload-wrapper:hover .file-upload-icon {
            transform: scale(1.1);
            color: #1b5e20;
        }

        .file-upload-text {
            font-size: 18px;
            font-weight: 600;
            color: #1b5e20;
            margin-bottom: 0.5rem;
        }

        .file-upload-hint {
            font-size: 13px;
            color: #666;
            margin-top: 0.5rem;
        }

        /* Selected Files Display */
        .selected-files {
            margin-top: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .file-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: white;
            transition: all 0.3s ease;
        }

        .file-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .file-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .file-item-name {
            padding: 10px;
            font-size: 12px;
            color: #333;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            background: #f8f9fa;
        }

        .file-item-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(211, 47, 47, 0.95);
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            z-index: 3;
        }

        .file-item-remove:hover {
            background: #c62828;
            transform: scale(1.1);
        }

        .file-item-size {
            position: absolute;
            bottom: 40px;
            left: 8px;
            background: rgba(46, 125, 50, 0.9);
            color: white;
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Drag and Drop Active State */
        .file-upload-wrapper.drag-over {
            border-color: #1b5e20;
            background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
            transform: scale(1.02);
        }

        /* Invalid State */
        .file-upload-wrapper:has(input.is-invalid) {
            border-color: #d32f2f;
        }

        .invalid-feedback {
            color: #d32f2f;
            font-size: 14px;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Alert Info */
        .alert-info {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: none;
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 1.5rem;
        }

        .alert-info ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .alert-info li {
            color: #1565c0;
            font-size: 13px;
            margin-bottom: 5px;
        }

        /* Table Styling */
        .table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 12px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            border-bottom: 1px solid #e8f5e9;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f1f8f4;
        }

        .table tbody td {
            padding: 10px;
            vertical-align: middle;
        }

        .table-sm input {
            font-size: 13px;
            padding: 6px 10px;
        }

        /* Buttons */
        .btn-custom {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-submit {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
            color: white;
        }

        .btn-cancel {
            background: white;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .btn-cancel:hover {
            background: #f5f5f5;
            border-color: #ccc;
            transform: translateY(-2px);
            color: #666;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
        }

        /* Sub-section headers */
        .sub-section-header {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            border-left: 4px solid #2e7d32;
        }

        .sub-section-header h6 {
            margin: 0;
            color: #1b5e20;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group-card {
            background: #fafcfb;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 1rem;
            border: 1px solid #e8f5e9;
        }

        /* Section Divider */
        hr {
            border: none;
            border-top: 2px solid #e8f5e9;
            margin: 1.5rem 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 28px;
            }

            .form-container {
                padding: 1.5rem;
            }

            .form-section {
                padding-left: 10px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .form-check-inline {
                display: block;
                margin-bottom: 10px;
            }

            .table-responsive {
                font-size: 12px;
            }

            .selected-files {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .file-item img {
                height: 120px;
            }

            .file-upload-wrapper {
                padding: 2rem 1rem;
            }

            .file-upload-icon {
                font-size: 48px;
            }

            .file-upload-text {
                font-size: 16px;
            }
        }

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-content {
            background: white;
            padding: 30px 40px;
            border-radius: 15px;
            text-align: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #e8f5e9;
            border-top-color: #2e7d32;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* File Upload */
        input[type="file"] {
            padding: 10px;
            border: 2px dashed #c8e6c9;
            border-radius: 10px;
            background: #f1f8f4;
        }

        input[type="file"]:hover {
            border-color: #388e3c;
            background: #e8f5e9;
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div style="color: #1b5e20; font-weight: 600;">Menyimpan data...</div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="header-section">
        <div class="container text-center">
            <h1><i class="bi bi-cup-hot-fill me-2"></i>Tambah Data Tempat Kuliner</h1>
            <p>Kotabaru Tourism Data Center - Formulir Input Sentra Kuliner</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="form-container">
            <form method="POST" action="{{ route('kuliner.store') }}" enctype="multipart/form-data" id="kulinerForm">
                @csrf

                <!-- 1. IDENTITAS USAHA -->
                <div class="form-section">
                    <h5><i class="bi bi-building"></i> 1. Identitas Usaha</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Sentra / Usaha</label>
                            <input type="text" name="nama_sentra" class="form-control"
                                placeholder="Contoh: Warung Sari Laut Kotabaru" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control" maxlength="4"
                                placeholder="2020">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="form-control"
                                placeholder="Contoh: Budi Santoso">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kepemilikan</label>
                            <select name="kepemilikan" class="form-control">
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
                            style="display:none; max-width:400px;">
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Pegawai</label>
                            <input type="number" name="jumlah_pegawai" class="form-control" placeholder="25">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Kursi</label>
                            <input type="number" name="jumlah_kursi" class="form-control" placeholder="25">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Gerai</label>
                            <input type="number" name="jumlah_gerai" class="form-control" placeholder="1">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Pelanggan per Hari</label>
                            <input type="number" name="jumlah_pelanggan_per_hari" class="form-control"
                                placeholder="50">
                        </div>
                    </div>

                    <!-- JAM OPERASIONAL -->
                    <hr>
                    <h6><i class="bi bi-clock"></i> Jam Operasional & Jam Sibuk</h6>
                    <div class="alert alert-info">
                        <ul class="mb-0">
                            <li>Isi jam buka, jam tutup, dan jam sibuk jika ada</li>
                            <li>Centang "Libur" bila tempat tidak beroperasi hari itu</li>
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle table-sm">
                            <thead>
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
                                @foreach ($days as $i => $day)
                                    <tr>
                                        <td><input type="text" name="hari[{{ $i }}]"
                                                class="form-control text-center form-control-sm"
                                                value="{{ $day }}" readonly></td>
                                        <td><input type="time" name="jam_buka[{{ $i }}]"
                                                class="form-control form-control-sm" value="08:00"></td>
                                        <td><input type="time" name="jam_tutup[{{ $i }}]"
                                                class="form-control form-control-sm" value="21:00"></td>
                                        <td><input type="time" name="jam_sibuk_mulai[{{ $i }}]"
                                                class="form-control form-control-sm"></td>
                                        <td><input type="time" name="jam_sibuk_selesai[{{ $i }}]"
                                                class="form-control form-control-sm"></td>
                                        <td><input type="checkbox" name="libur[{{ $i }}]"
                                                class="form-check-input"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label>Profil Pelanggan</label><br>
                            @foreach (['Lokal', 'Wisatawan', 'Pelajar/Mahasiswa', 'Pekerja'] as $p)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="profil_pelanggan[]" value="{{ $p }}"
                                        class="form-check-input" id="profil_{{ $p }}">
                                    <label class="form-check-label"
                                        for="profil_{{ $p }}">{{ $p }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Metode Pembayaran</label><br>
                            @foreach (['Tunai', 'QRIS / Transfer'] as $m)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="metode_pembayaran[]" value="{{ $m }}"
                                        class="form-check-input" id="metode_{{ $m }}">
                                    <label class="form-check-label"
                                        for="metode_{{ $m }}">{{ $m }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Pajak / Retribusi</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pajak_retribusi" value="1"
                                id="pajak_ya">
                            <label class="form-check-label" for="pajak_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pajak_retribusi" value="0"
                                id="pajak_tidak">
                            <label class="form-check-label" for="pajak_tidak">Tidak</label>
                        </div>
                    </div>
                </div>

                <!-- 2. JENIS KULINER -->
                <div class="form-section">
                    <h5><i class="bi bi-card-list"></i> 2. Jenis Kuliner</h5>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Kategori</label><br>
                            @foreach (['Tradisional/Domestik', 'Modern/Luar Negeri', 'Street Food', 'Lainnya'] as $kategori)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="kategori[]" value="{{ $kategori }}"
                                        class="form-check-input kategori-check" id="kategori_{{ $kategori }}">
                                    <label class="form-check-label"
                                        for="kategori_{{ $kategori }}">{{ $kategori }}</label>
                                </div>
                            @endforeach
                            <input type="text" id="kategori_lain" name="kategori_lain" class="form-control mt-2"
                                placeholder="Tulis kategori lain..." style="display:none; max-width:400px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Menu Unggulan</label>
                            <input type="text" name="menu_unggulan" class="form-control"
                                placeholder="Contoh: Soto Banjar Spesial">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Bahan Baku Utama</label>
                            <input type="text" name="bahan_baku_utama" class="form-control"
                                placeholder="Contoh: Daging ayam, rempah lokal">
                            <small class="form-text note">Bisa sesuaikan dengan menu unggulan</small>
                        </div>
                    </div>

                    <div class="row">
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

                        <div class="col-md-6 mb-3">
                            <label>Menu Bersifat</label><br>
                            @foreach (['Tetap', 'Musiman'] as $m)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="menu_bersifat[]" value="{{ $m }}"
                                        class="form-check-input" id="menu_{{ $m }}">
                                    <label class="form-check-label"
                                        for="menu_{{ $m }}">{{ $m }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 3. TEMPAT & FASILITAS -->
                <div class="form-section">
                    <h5><i class="bi bi-shop"></i> 3. Tempat & Fasilitas</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Bentuk Fisik</label>
                            <select name="bentuk_fisik" class="form-control">
                                <option value="" disabled selected>-- Pilih Bentuk Fisik --</option>
                                <option value="Restoran">Restoran</option>
                                <option value="Warung">Warung</option>
                                <option value="Kafe">Kafe</option>
                                <option value="Foodcourt">Foodcourt</option>
                                <option value="Jasa Boga (Katering)">Jasa Boga (Katering)</option>
                                <option value="Penyedia Makanan oleh Pedagang Keliling">Penyedia Makanan oleh Pedagang
                                    Keliling</option>
                                <option value="Penyedia Makanan oleh Pedagang Tidak Keliling">Penyedia Makanan oleh
                                    Pedagang Tidak Keliling</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status Bangunan</label>
                            <select name="status_bangunan" class="form-control">
                                <option value="" disabled selected>-- Pilih Status Bangunan --</option>
                                <option value="Milik Sendiri">Milik Sendiri</option>
                                <option value="Sewa">Sewa</option>
                                <option value="Pinjam Pakai">Pinjam Pakai</option>
                                <option value="Lainnya">Lainnya...</option>
                            </select>
                            <input type="text" id="status_lain" name="status_lain" class="form-control mt-2"
                                placeholder="Tulis status lain..." style="display:none;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Fasilitas Pendukung</label><br>
                        @foreach (['Toilet', 'Wastafel', 'Parkir', 'Mushola', 'WiFi', 'Tempat Sampah'] as $f)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="fasilitas_pendukung[]" value="{{ $f }}"
                                    class="form-check-input" id="fasilitas_{{ $f }}">
                                <label class="form-check-label"
                                    for="fasilitas_{{ $f }}">{{ $f }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4. PRAKTIK K3 & SANITASI -->
                <div class="form-section">
                    <h5><i class="bi bi-shield-check"></i> 4. Praktik K3 & Sanitasi</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Pelatihan K3</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pelatihan_k3" value="1"
                                    id="k3_ya">
                                <label class="form-check-label" for="k3_ya">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pelatihan_k3" value="0"
                                    id="k3_tidak">
                                <label class="form-check-label" for="k3_tidak">Tidak</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jumlah Penjamah Makanan</label>
                            <input type="number" name="jumlah_penjamah_makanan" class="form-control"
                                placeholder="3">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Alat Pelindung Diri Penjamah Makanan</label><br>
                        @foreach (['Masker', 'Hairnet', 'Celemek', 'Sarung Tangan'] as $apd)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="apd_penjamah_makanan[]" value="{{ $apd }}"
                                    class="form-check-input" id="apd_{{ $apd }}">
                                <label class="form-check-label"
                                    for="apd_{{ $apd }}">{{ $apd }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Sanitasi Alat Dapur</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prosedur_sanitasi_alat"
                                    id="sanitasi_tidak" value="0">
                                <label class="form-check-label" for="sanitasi_tidak">Tidak Melakukan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prosedur_sanitasi_alat"
                                    id="sanitasi_ya" value="1">
                                <label class="form-check-label" for="sanitasi_ya">Melakukan</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 frekuensi-sanitasi-alat">
                            <label>Frekuensi Sanitasi Alat</label>
                            <input type="text" name="frekuensi_sanitasi_alat" class="form-control"
                                style="max-width:250px;" placeholder="2 kali sehari">
                            <small class="form-text note">Hanya diisi jika melakukan sanitasi</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Sanitasi Bahan Makanan</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prosedur_sanitasi_bahan"
                                    id="sanitasi_bahan_tidak" value="0">
                                <label class="form-check-label" for="sanitasi_bahan_tidak">Tidak Melakukan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prosedur_sanitasi_bahan"
                                    id="sanitasi_bahan_ya" value="1">
                                <label class="form-check-label" for="sanitasi_bahan_ya">Melakukan</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 frekuensi-sanitasi-bahan">
                            <label>Frekuensi Sanitasi Bahan</label>
                            <input type="text" name="frekuensi_sanitasi_bahan" class="form-control"
                                style="max-width:250px;" placeholder="2 kali sehari">
                            <small class="form-text note">Hanya diisi jika melakukan sanitasi</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Penyimpanan Bahan Mentah</label>
                            <select name="penyimpanan_mentah" class="form-control">
                                <option value="">-- Pilih Penyimpanan --</option>
                                <option value="Dengan Pendingin, Terpisah">Dengan Pendingin, Terpisah</option>
                                <option value="Dengan Pendingin, Tidak Terpisah">Dengan Pendingin, Tidak Terpisah
                                </option>
                                <option value="Tanpa Pendingin, Terpisah">Tanpa Pendingin, Terpisah</option>
                                <option value="Tanpa Pendingin, Tidak Terpisah">Tanpa Pendingin, Tidak Terpisah
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Penyimpanan Bahan Matang</label>
                            <select name="penyimpanan_matang" class="form-control">
                                <option value="">-- Pilih Penyimpanan --</option>
                                <option value="Dengan Pendingin, Terpisah">Dengan Pendingin, Terpisah</option>
                                <option value="Dengan Pendingin, Tidak Terpisah">Dengan Pendingin, Tidak Terpisah
                                </option>
                                <option value="Tanpa Pendingin, Terpisah">Tanpa Pendingin, Terpisah</option>
                                <option value="Tanpa Pendingin, Tidak Terpisah">Tanpa Pendingin, Tidak Terpisah
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Prinsip FIFO / FEFO</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fifo_fefo" value="1"
                                    id="fifo_ya">
                                <label class="form-check-label" for="fifo_ya">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fifo_fefo" value="0"
                                    id="fifo_tidak">
                                <label class="form-check-label" for="fifo_tidak">Tidak</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Limbah Dapur</label>
                            <select name="limbah_dapur" class="form-control">
                                <option value="">-- Pilih Limbah Dapur --</option>
                                <option value="Dipisah">Dipisah</option>
                                <option value="Tidak Dipisah">Tidak Dipisah</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Ventilasi Dapur</label>
                            <select name="ventilasi_dapur" class="form-control">
                                <option value="">-- Pilih Ventilasi --</option>
                                <option value="Alami">Alami (jendela/ventilasi langsung)</option>
                                <option value="Buatan">Buatan (exhaust fan/blower)</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Dapur</label>
                            <select name="dapur" class="form-control">
                                <option value="">-- Pilih Dapur --</option>
                                <option value="Ada, terpisah">Ada, terpisah</option>
                                <option value="Ada, tidak terpisah">Ada, tidak terpisah</option>
                                <option value="Tidak ada">Tidak ada</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Sumber Air Cuci</label>
                            <select name="sumber_air_cuci" class="form-control">
                                <option value="">-- Pilih Sumber Air --</option>
                                <option value="PDAM">PDAM</option>
                                <option value="Sumur">Sumur</option>
                                <option value="Air Isi Ulang">Air Isi Ulang</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Sumber Air Masak</label>
                            <select name="sumber_air_masak" class="form-control">
                                <option value="">-- Pilih Sumber Air --</option>
                                <option value="PDAM">PDAM</option>
                                <option value="Sumur">Sumur</option>
                                <option value="Air Isi Ulang">Air Isi Ulang</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Sumber Air Minum</label>
                            <select name="sumber_air_minum" class="form-control">
                                <option value="">-- Pilih Sumber Air --</option>
                                <option value="PDAM">PDAM</option>
                                <option value="Sumur">Sumur</option>
                                <option value="Air Isi Ulang">Air Isi Ulang</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 5. KOORDINAT -->
                <div class="form-section">
                    <h5><i class="bi bi-geo-alt"></i> 5. Koordinat Lokasi</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Longitude</label>
                            <input type="text" name="longitude" class="form-control" placeholder="116.8225"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Latitude</label>
                            <input type="text" name="latitude" class="form-control" placeholder="-3.3211"
                                required>
                        </div>
                    </div>
                </div>

                <!-- 6. FOTO -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="bi bi-camera"></i>
                        Foto Kuliner
                    </div>

                    <div class="mb-4">
                        <div class="file-upload-wrapper">
                            <input type="file" name="foto[]" multiple accept="image/*" id="fileInput"
                                class="@error('foto.*') is-invalid @enderror">
                            <div class="file-upload-icon">
                                <i class="bi bi-cloud-upload"></i>
                            </div>
                            <div class="file-upload-text">
                                Klik untuk upload foto atau drag & drop
                            </div>
                            <div class="file-upload-hint">
                                Format: JPG, PNG, JPEG | Maksimal: 2MB per file | Bisa multiple
                            </div>
                        </div>
                        @error('foto.*')
                            <div class="invalid-feedback" style="display: block;">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="selected-files" id="selectedFiles"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="submit" class="btn-custom btn-submit">
                        <i class="bi bi-save"></i>
                        Simpan Data
                    </button>
                    <a href="{{ route('kuliner.index') }}" class="btn-custom btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // SERTIFIKAT "LAINNYA"
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

            // KATEGORI "LAINNYA"
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

            // STATUS BANGUNAN "LAINNYA"
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

            // TABEL JAM OPERASIONAL: LIBUR CHECKBOX
            const rows = document.querySelectorAll("table tbody tr");

            rows.forEach(row => {
                const checkbox = row.querySelector('input[type="checkbox"][name^="libur["]');
                const timeInputs = row.querySelectorAll('input[type="time"]');
                if (!checkbox) return;

                const defaultValues = Array.from(timeInputs).map(input => input.value);

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

            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('fileInput');
                const selectedFilesContainer = document.getElementById('selectedFiles');
                const uploadWrapper = document.querySelector('.file-upload-wrapper');
                let selectedFiles = [];

                // File input change event
                fileInput.addEventListener('change', function(e) {
                    handleFiles(e.target.files);
                });

                // Drag and drop events
                uploadWrapper.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    uploadWrapper.classList.add('drag-over');
                });

                uploadWrapper.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    uploadWrapper.classList.remove('drag-over');
                });

                uploadWrapper.addEventListener('drop', function(e) {
                    e.preventDefault();
                    uploadWrapper.classList.remove('drag-over');

                    const files = e.dataTransfer.files;
                    handleFiles(files);
                });

                function handleFiles(files) {
                    // Convert FileList to Array and add to selectedFiles
                    const filesArray = Array.from(files);

                    filesArray.forEach(file => {
                        // Validate file type
                        if (!file.type.match('image.*')) {
                            alert(file.name + ' bukan file gambar!');
                            return;
                        }

                        // Validate file size (2MB)
                        if (file.size > 2 * 1024 * 1024) {
                            alert(file.name + ' terlalu besar! Maksimal 2MB');
                            return;
                        }

                        selectedFiles.push(file);
                    });

                    displayFiles();
                    updateFileInput();
                }

                function displayFiles() {
                    selectedFilesContainer.innerHTML = '';

                    selectedFiles.forEach((file, index) => {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'file-item';

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            fileItem.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}">
                    <div class="file-item-size">${formatFileSize(file.size)}</div>
                    <button type="button" class="file-item-remove" onclick="removeFile(${index})">
                        <i class="bi bi-x"></i>
                    </button>
                    <div class="file-item-name" title="${file.name}">${file.name}</div>
                `;
                        };
                        reader.readAsDataURL(file);

                        selectedFilesContainer.appendChild(fileItem);
                    });
                }

                function updateFileInput() {
                    // Create a new DataTransfer object to update the file input
                    const dataTransfer = new DataTransfer();
                    selectedFiles.forEach(file => {
                        dataTransfer.items.add(file);
                    });
                    fileInput.files = dataTransfer.files;
                }

                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
                }

                // Make removeFile globally accessible
                window.removeFile = function(index) {
                    selectedFiles.splice(index, 1);
                    displayFiles();
                    updateFileInput();
                };
            });

            // Show loading on form submit
            document.getElementById('kulinerForm').addEventListener('submit', function() {
                document.getElementById('loadingOverlay').classList.add('active');
            });
        });
    </script>
</body>

</html>
