<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Tempat Wisata - {{ $wisata->nama_wisata }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .alert-info-custom {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: none;
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 1.5rem;
        }

        .alert-info-custom strong {
            color: #1565c0;
        }

        .alert-info-custom ul {
            margin: 8px 0 0 20px;
            color: #1976d2;
        }

        .alert-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 350px;
            max-width: 500px;
            animation: slideInRight 0.4s ease;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .alert-custom {
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            border: none;
            backdrop-filter: blur(10px);
        }

        .alert-success-custom {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
            color: white;
        }

        .invalid-feedback {
            display: block;
            color: #d32f2f;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9998;
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
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
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

        .header-section {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
            background: linear-gradient(135deg, rgba(27, 94, 32, 0.95) 0%, rgba(46, 125, 50, 0.95) 100%);
            color: white;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .header-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 25px;
            max-width: 1000px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .section-divider {
            border-bottom: 2px solid #e8f5e9;
            margin: 2.5rem 0;
            position: relative;
        }

        .section-divider::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, #2e7d32 0%, #66bb6a 100%);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-label {
            font-weight: 600;
            color: #2e7d32;
            margin-bottom: 0.5rem;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label .required {
            color: #d32f2f;
            margin-left: 4px;
        }

        .form-control,
        .form-select {
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #d32f2f;
            background-color: #ffebee;
        }

        /* Kategori Styles */
        .kategori-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
            margin-top: 1rem;
        }

        .kategori-item {
            background: #f5f5f5;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: flex;
            min-height: 50px;
        }

        .kategori-item:hover {
            background: #e8f5e9;
            border-color: #66bb6a;
            transform: translateY(-2px);
        }

        .kategori-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .kategori-label {
            display: flex;
            padding: 12px 40px 12px 16px;
            font-weight: 500;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            width: 100%;
            height: 100%;
        }

        .kategori-item input[type="checkbox"]:checked+.kategori-label {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .kategori-item input[type="checkbox"]:checked+.kategori-label::after {
            content: '\F26E';
            font-family: 'bootstrap-icons';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: white;
        }

        .empty-kategori {
            text-align: center;
            padding: 3rem 2rem;
            background: #fff3cd;
            border: 2px dashed #ffc107;
            border-radius: 12px;
        }

        .empty-kategori i {
            font-size: 48px;
            color: #ff9800;
            margin-bottom: 1rem;
        }

        /* Table Operasional */
        .table-operasional {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table-operasional thead {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
        }

        .table-operasional th {
            font-weight: 600;
            font-size: 14px;
            padding: 14px 10px;
            border: none;
        }

        .table-operasional td {
            padding: 10px;
            vertical-align: middle;
            border-color: #e8f5e9;
        }

        .table-operasional input[type="time"] {
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 13px;
            width: 100%;
        }

        .libur-checkbox {
            width: 22px;
            height: 22px;
            cursor: pointer;
            accent-color: #d32f2f;
        }

        /* Existing Photos Grid */
        .existing-photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .photo-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .photo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        }

        .photo-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .photo-card .delete-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(211, 47, 47, 0.95);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .photo-card .delete-btn:hover {
            background: #c62828;
            transform: scale(1.1);
        }

        .photo-count-badge {
            background: #2e7d32;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            border: 2px dashed #c8e6c9;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            background: #f1f8f4;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-wrapper:hover {
            border-color: #388e3c;
            background: #e8f5e9;
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload-icon {
            font-size: 48px;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .selected-files {
            margin-top: 15px;
            text-align: left;
        }

        .file-item {
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #e0e0e0;
        }

        .file-item-name {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            font-size: 14px;
        }

        /* Buttons */
        .btn-submit {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            font-weight: 600;
            padding: 14px 40px;
            border-radius: 50px;
            border: none;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
        }

        .btn-cancel {
            background: white;
            color: #666;
            font-weight: 600;
            padding: 14px 40px;
            border-radius: 50px;
            border: 2px solid #e0e0e0;
            font-size: 16px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
        }

        .counter-badge {
            background: #ffd54f;
            color: #1b5e20;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }

            .header-section h1 {
                font-size: 32px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
            }

            .existing-photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }
    </style>
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div class="loading-text">Memperbarui data wisata...</div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert-notification">
            <div class="alert alert-success-custom alert-custom alert-dismissible fade show">
                <i class="bi bi-check-circle-fill"></i>
                <div class="alert-content">
                    <div class="alert-title">Berhasil!</div>
                    <div class="alert-message">{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-notification">
            <div class="alert alert-danger-custom alert-custom alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div class="alert-content">
                    <div class="alert-title">Terjadi Kesalahan!</div>
                    <div class="alert-message">{{ $errors->count() }} kesalahan ditemukan.</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <div class="header-section">
        <div class="container">
            <h1><i class="bi bi-pencil-square me-2"></i>Edit Tempat Wisata</h1>
            <p>Perbarui informasi untuk: <strong>{{ $wisata->nama_wisata }}</strong></p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            {{-- Error Summary untuk Koordinat di Luar Batas --}}
            @if ($errors->has('lokasi'))
                <div class="error-summary alert-sticky">
                    <h5>
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Peringatan Lokasi
                    </h5>
                    <p><strong>{{ $errors->first('lokasi') }}</strong></p>
                    <p class="mb-0 mt-2">
                        <i class="bi bi-info-circle"></i>
                        Pastikan koordinat yang Anda masukkan berada dalam wilayah Kabupaten Kotabaru, Kalimantan
                        Selatan.
                    </p>
                </div>
            @endif
            
            <form method="POST" action="{{ route('wisata.update', $wisata->id_wisata) }}" enctype="multipart/form-data"
                id="wisataForm">
                @csrf
                @method('PUT')

                <div class="section-title">
                    <i class="bi bi-info-circle-fill"></i>
                    Informasi Dasar
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-geo-alt-fill"></i>
                        Nama Tempat Wisata
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="nama_wisata"
                        class="form-control @error('nama_wisata') is-invalid @enderror"
                        placeholder="Contoh: Museum Sandi" value="{{ old('nama_wisata', $wisata->nama_wisata) }}"
                        required>
                    @error('nama_wisata')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Kategori Section --}}
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-tags-fill"></i>
                        Kategori Wisata
                        <span class="required">*</span>
                        <span class="counter-badge" id="selectedCount">0 dipilih</span>
                    </label>

                    @php
                        $selectedKategori = old('kategori', $wisata->kategori->pluck('id_kategori')->toArray());
                    @endphp

                    @if ($kategori->isEmpty())
                        <div class="empty-kategori">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <h5>Tidak Ada Kategori Aktif</h5>
                            <p>Belum ada kategori wisata yang aktif. Hubungi administrator untuk mengaktifkan kategori
                                terlebih dahulu.</p>
                        </div>
                    @else
                        <div class="kategori-container">
                            @foreach ($kategori as $k)
                                <div class="kategori-item">
                                    <input type="checkbox" name="kategori[]" value="{{ $k->id_kategori }}"
                                        id="kat_{{ $k->id_kategori }}" class="kategori-checkbox"
                                        {{ in_array($k->id_kategori, $selectedKategori) ? 'checked' : '' }}>
                                    <label class="kategori-label" for="kat_{{ $k->id_kategori }}">
                                        {{ $k->nama_kategori }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @error('kategori')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-map-fill"></i>
                    Lokasi & Koordinat
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-house-fill"></i>
                        Alamat Lengkap
                        <span class="required">*</span>
                    </label>
                    <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" rows="3"
                        placeholder="Contoh: Jl. Faridan M Noto No.21, Kotabaru" required>{{ old('alamat_lengkap', $wisata->alamat_lengkap) }}</textarea>
                    @error('alamat_lengkap')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">
                            <i class="bi bi-arrow-left-right"></i>
                            Longitude
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="longitude"
                            class="form-control @error('longitude') is-invalid @enderror"
                            placeholder="Contoh: 110.3750" value="{{ old('longitude', $wisata->longitude) }}"
                            required>
                        @error('longitude')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">
                            <i class="bi bi-arrow-up-down"></i>
                            Latitude
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="latitude"
                            class="form-control @error('latitude') is-invalid @enderror" placeholder="Contoh: -7.7869"
                            value="{{ old('latitude', $wisata->latitude) }}" required>
                        @error('latitude')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                @if ($errors->has('lokasi'))
                    <div class="alert alert-danger">
                        <i class="bi bi-geo-alt-fill"></i> {{ $errors->first('lokasi') }}
                    </div>
                @endif

                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-file-text-fill"></i>
                    Deskripsi & Informasi
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-card-text"></i>
                        Deskripsi Wisata
                        <span class="required">*</span>
                    </label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4"
                        placeholder="Deskripsikan tempat wisata..." required>{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-clock-history"></i>
                        Sejarah Wisata
                        <span class="required">*</span>
                    </label>
                    <textarea name="sejarah" class="form-control @error('sejarah') is-invalid @enderror" rows="4"
                        placeholder="Ceritakan sejarah tempat wisata..." required>{{ old('sejarah', $wisata->sejarah) }}</textarea>
                    @error('sejarah')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-mic-fill"></i>
                        Narasi Audio (Teks)
                        <span class="required">*</span>
                    </label>
                    <textarea name="narasi" class="form-control @error('narasi') is-invalid @enderror" rows="3"
                        placeholder="Tulis narasi untuk audio guide..." required>{{ old('narasi', $wisata->narasi) }}</textarea>
                    @error('narasi')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-clock-fill"></i>
                    Jam Operasional
                </div>

                <div class="alert-info-custom">
                    <strong><i class="bi bi-info-circle-fill me-2"></i>Petunjuk Pengisian:</strong>
                    <ul>
                        <li>Sesuaikan jam buka dan tutup sesuai operasional tempat</li>
                        <li>Centang <strong>"Libur"</strong> jika tempat tidak buka pada hari tersebut</li>
                    </ul>
                </div>

                <div class="table-responsive">
                    <table class="table table-operasional">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Hari</th>
                                <th style="width: 30%;">Jam Buka</th>
                                <th style="width: 30%;">Jam Tutup</th>
                                <th style="width: 15%;" class="text-center">Libur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                $jamOperasional = $wisata->jamOperasionalAdmin->keyBy('hari');
                            @endphp
                            @foreach ($days as $index => $day)
                                @php
                                    $jadwal = $jamOperasional->get($day);

                                    // Tentukan jam buka
                                    if (old('jam_buka.' . $index)) {
                                        $jamBuka = old('jam_buka.' . $index);
                                    } elseif ($jadwal && $jadwal->jam_buka) {
                                        $jamBuka = $jadwal->jam_buka->format('H:i');
                                    } else {
                                        $jamBuka = '08:00';
                                    }

                                    // Tentukan jam tutup
                                    if (old('jam_tutup.' . $index)) {
                                        $jamTutup = old('jam_tutup.' . $index);
                                    } elseif ($jadwal && $jadwal->jam_tutup) {
                                        $jamTutup = $jadwal->jam_tutup->format('H:i');
                                    } else {
                                        $jamTutup = '17:00';
                                    }

                                    // Tentukan status libur
                                    if (old('libur')) {
                                        $isLibur = in_array($index, old('libur', []));
                                    } else {
                                        $isLibur = $jadwal ? $jadwal->libur : false;
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <input type="hidden" name="hari[]" value="{{ $day }}">
                                        <span class="day-name">{{ $day }}</span>
                                    </td>
                                    <td>
                                        <input type="time" name="jam_buka[]"
                                            class="form-control form-control-sm jam-buka-input"
                                            value="{{ $isLibur ? '00:00' : $jamBuka }}">
                                    </td>
                                    <td>
                                        <input type="time" name="jam_tutup[]"
                                            class="form-control form-control-sm jam-tutup-input"
                                            value="{{ $isLibur ? '00:00' : $jamTutup }}">
                                    </td>
                                    <td class="text-center">
                                        <input class="libur-checkbox" type="checkbox" name="libur[]"
                                            value="{{ $index }}" {{ $isLibur ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @error('jam_operasional')
                    <div class="alert-jam-operasional">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div>
                            <strong>⚠️ Error Jam Operasional</strong>
                            <span>{{ $message }}</span>
                        </div>
                    </div>
                @enderror
                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-images"></i>
                    Foto Wisata
                </div>

                {{-- Existing Photos --}}
                @if ($wisata->foto->count() > 0)
                    <div class="mb-4">
                        <span class="photo-count-badge">
                            <i class="bi bi-images me-1"></i>
                            {{ $wisata->foto->count() }} Foto Tersimpan
                        </span>

                        <div class="existing-photos-grid">
                            @foreach ($wisata->foto as $foto)
                                <div class="photo-card" id="photo-{{ $foto->id_foto }}">
                                    <img src="{{ $foto->url_foto }}" alt="Foto {{ $wisata->nama_wisata }}">
                                    <button type="button" class="delete-btn"
                                        onclick="deleteFoto({{ $foto->id_foto }}, '{{ $wisata->nama_wisata }}')"
                                        {{ $wisata->foto->count() <= 1 ? 'disabled title="Minimal 1 foto harus tersisa"' : '' }}>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="alert-info-custom mt-3">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <strong>Klik ikon tempat sampah</strong> untuk menghapus foto. Minimal 1 foto harus tersisa.
                        </div>
                    </div>
                @endif

                {{-- Upload New Photos --}}
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-cloud-upload-fill"></i>
                        Tambah Foto Baru (Opsional)
                    </label>

                    <div class="file-upload-wrapper">
                        <input type="file" name="foto[]" multiple accept="image/*" id="fileInput"
                            class="@error('foto.*') is-invalid @enderror">
                        <div class="file-upload-icon">
                            <i class="bi bi-cloud-upload"></i>
                        </div>
                        <div class="file-upload-text">
                            Klik untuk upload foto baru atau drag & drop
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

                <div class="button-group">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Update Data Wisata
                    </button>
                    <a href="{{ route('wisata.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle me-2"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%); color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Konfirmasi Hapus Foto
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding: 25px;">
                    <p style="font-size: 15px; color: #333; margin-bottom: 15px;">
                        Apakah Anda yakin ingin menghapus foto dari <strong id="fotoWisataName"></strong>?
                    </p>
                    <p style="font-size: 13px; color: #666; margin: 0;">
                        <i class="bi bi-info-circle me-1"></i>
                        Foto yang dihapus tidak dapat dikembalikan.
                    </p>
                </div>
                <div class="modal-footer" style="border: none; padding: 15px 25px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="border-radius: 8px;">
                        <i class="bi bi-x-circle me-1"></i>
                        Batal
                    </button>
                    <form id="deleteFotoForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="border-radius: 8px;">
                            <i class="bi bi-trash me-1"></i>
                            Ya, Hapus Foto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-notification .alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Libur checkbox handler
        document.querySelectorAll('.libur-checkbox').forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('tr');
                const bukaInput = row.querySelector('.jam-buka-input');
                const tutupInput = row.querySelector('.jam-tutup-input');

                if (this.checked) {
                    bukaInput.value = '00:00';
                    tutupInput.value = '00:00';
                    bukaInput.readOnly = true;
                    tutupInput.readOnly = true;
                    bukaInput.style.background = '#f5f5f5';
                    tutupInput.style.background = '#f5f5f5';
                    bukaInput.style.cursor = 'not-allowed';
                    tutupInput.style.cursor = 'not-allowed';
                    bukaInput.style.pointerEvents = 'none';
                    tutupInput.style.pointerEvents = 'none';
                    row.style.opacity = '0.5';
                } else {
                    bukaInput.value = '08:00';
                    tutupInput.value = '17:00';
                    bukaInput.readOnly = false;
                    tutupInput.readOnly = false;
                    bukaInput.style.background = '';
                    tutupInput.style.background = '';
                    bukaInput.style.cursor = '';
                    tutupInput.style.cursor = '';
                    bukaInput.style.pointerEvents = '';
                    tutupInput.style.pointerEvents = '';
                    row.style.opacity = '1';
                }
            });
        });

        // File upload preview
        const fileInput = document.getElementById('fileInput');
        const selectedFilesDiv = document.getElementById('selectedFiles');

        fileInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            selectedFilesDiv.innerHTML = '';

            if (files.length > 0) {
                files.forEach(file => {
                    const fileSize = (file.size / 1024).toFixed(2);
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    const isOversized = file.size > 2 * 1024 * 1024;

                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';
                    fileItem.innerHTML = `
                        <div class="file-item-name">
                            <i class="bi bi-file-image"></i>
                            <span>${file.name}</span>
                            ${isOversized ? '<span style="color: #d32f2f; font-size: 11px; margin-left: 8px;">(Terlalu besar!)</span>' : ''}
                        </div>
                        <div class="file-item-size">${fileSize > 1024 ? fileSizeMB + ' MB' : fileSize + ' KB'}</div>
                    `;
                    if (isOversized) {
                        fileItem.style.borderColor = '#d32f2f';
                        fileItem.style.background = '#ffebee';
                    }
                    selectedFilesDiv.appendChild(fileItem);
                });
            }
        });

        // Kategori counter
        const kategoriCheckboxes = document.querySelectorAll('.kategori-checkbox');
        const selectedCountBadge = document.getElementById('selectedCount');

        function updateKategoriCount() {
            const checkedCount = document.querySelectorAll('.kategori-checkbox:checked').length;
            selectedCountBadge.textContent = `${checkedCount} dipilih`;
        }

        updateKategoriCount();

        kategoriCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateKategoriCount);
        });

        // Form validation
        const form = document.getElementById('wisataForm');
        const loadingOverlay = document.getElementById('loadingOverlay');

        form.addEventListener('submit', function(e) {
            const kategoriChecked = document.querySelectorAll('.kategori-checkbox:checked').length;
            const hasKategori = document.querySelectorAll('.kategori-checkbox').length > 0;

            if (hasKategori && kategoriChecked === 0) {
                e.preventDefault();
                alert('❌ Pilih minimal 1 kategori wisata!');
                return false;
            }

            const files = fileInput.files;
            if (files.length > 0) {
                let hasOversizedFile = false;
                for (let file of files) {
                    if (file.size > 2 * 1024 * 1024) {
                        hasOversizedFile = true;
                        break;
                    }
                }

                if (hasOversizedFile) {
                    e.preventDefault();
                    alert('❌ Ada file yang melebihi ukuran 2MB!');
                    return false;
                }
            }

            loadingOverlay.classList.add('active');
        });

        // Delete foto function
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

        function deleteFoto(idFoto, namaWisata) {
            document.getElementById('fotoWisataName').textContent = namaWisata;
            document.getElementById('deleteFotoForm').action = `/dashboard/wisata/foto/${idFoto}`;
            deleteModal.show();
        }

        // Initialize libur state on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.libur-checkbox').forEach((checkbox) => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const bukaInput = row.querySelector('.jam-buka-input');
                    const tutupInput = row.querySelector('.jam-tutup-input');

                    bukaInput.readOnly = true;
                    tutupInput.readOnly = true;
                    bukaInput.style.background = '#f5f5f5';
                    tutupInput.style.background = '#f5f5f5';
                    bukaInput.style.cursor = 'not-allowed';
                    tutupInput.style.cursor = 'not-allowed';
                    bukaInput.style.pointerEvents = 'none';
                    tutupInput.style.pointerEvents = 'none';
                    row.style.opacity = '0.5';
                }
            });
        });
    </script>
</body>

</html>
