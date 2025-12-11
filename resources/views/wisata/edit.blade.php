<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Tempat Wisata - Kotabaru Tourism</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

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

        /* Loading Overlay */
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
            to { transform: rotate(360deg); }
        }

        .loading-text {
            color: #1b5e20;
            font-weight: 600;
            font-size: 16px;
        }

        .header-section {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
            background: linear-gradient(135deg, rgba(27, 94, 32, 0.95) 0%, rgba(46, 125, 50, 0.95) 100%);
            color: white;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .header-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-section p {
            font-size: 16px;
            opacity: 0.95;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 25px;
            max-width: 1000px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
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

        .section-title i {
            color: #2e7d32;
            font-size: 28px;
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

        .form-label i {
            color: #66bb6a;
            font-size: 16px;
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

        .form-control:hover,
        .form-select:hover {
            border-color: #66bb6a;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-text {
            font-size: 12px;
            color: #666;
            margin-top: 0.4rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-text i {
            color: #2e7d32;
            font-size: 14px;
        }

        /* Kategori Checkbox Styling */
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
            padding: 12px 16px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .kategori-item:hover {
            background: #e8f5e9;
            border-color: #66bb6a;
            transform: translateY(-2px);
        }

        .kategori-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .kategori-item input[type="checkbox"]:checked ~ .kategori-label {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .kategori-item input[type="checkbox"]:checked ~ .kategori-label::before {
            content: '\f26e';
            font-family: 'bootstrap-icons';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
        }

        .kategori-label {
            display: block;
            padding: 10px 35px 10px 10px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            color: #333;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        /* Jam Operasional Table */
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

        .table-operasional tbody tr:hover {
            background: #f1f8f4;
        }

        .table-operasional input[type="time"] {
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 13px;
        }

        .table-operasional input[type="time"]:disabled {
            background: #f5f5f5;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .day-name {
            font-weight: 600;
            color: #1b5e20;
            font-size: 14px;
        }

        .libur-checkbox {
            width: 22px;
            height: 22px;
            cursor: pointer;
            accent-color: #d32f2f;
        }

        /* Alert Info */
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

        /* File Upload Styling */
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

        .file-upload-text {
            color: #1b5e20;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .file-upload-hint {
            color: #666;
            font-size: 12px;
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

        .file-item-name i {
            color: #2e7d32;
            font-size: 18px;
        }

        .file-item-size {
            color: #666;
            font-size: 12px;
        }

        /* Foto Lama Styling */
        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 1rem;
        }

        .photo-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .photo-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .photo-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .photo-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            padding: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .photo-item:hover .photo-overlay {
            opacity: 1;
        }

        .photo-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(46, 125, 50, 0.9);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
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
            background: linear-gradient(135deg, #388e3c 0%, #43a047 100%);
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

        .btn-cancel:hover {
            background: #f5f5f5;
            border-color: #ccc;
            transform: translateY(-2px);
            color: #666;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
        }

        /* Counter Badge */
        .counter-badge {
            background: #ffd54f;
            color: #1b5e20;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-left: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }

            .header-section h1 {
                font-size: 32px;
            }

            .section-title {
                font-size: 20px;
            }

            .kategori-container {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
            }

            .photo-gallery {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container {
            animation: fadeIn 0.5s ease;
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div class="loading-text">Mengupdate data wisata...</div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <h1><i class="bi bi-pencil-square me-2"></i>Edit Tempat Wisata</h1>
            <p>Update informasi wisata untuk Kotabaru Tourism Data Center</p>
        </div>
    </div>

    <!-- Form Container -->
    <div class="container">
        <div class="form-container">
            <form method="POST" action="{{ route('wisata.update', $wisata->id_wisata) }}" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')

                <!-- Section: Informasi Dasar -->
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
                    <input type="text" name="nama_wisata" class="form-control" value="{{ $wisata->nama_wisata }}" placeholder="Contoh: Museum Sandi" required>
                    <div class="form-text">
                        <i class="bi bi-lightbulb"></i>
                        Masukkan nama lengkap tempat wisata
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-tags-fill"></i>
                        Kategori Wisata
                        <span class="required">*</span>
                        <span class="counter-badge" id="selectedCount">0 dipilih</span>
                    </label>
                    <div class="kategori-container">
                        @foreach ($kategori as $k)
                            <div class="kategori-item">
                                <input type="checkbox" name="kategori[]" value="{{ $k->id_kategori }}"
                                       id="kat_{{ $k->id_kategori }}" class="kategori-checkbox"
                                       {{ in_array($k->id_kategori, $wisata->kategori->pluck('id_kategori')->toArray()) ? 'checked' : '' }}>
                                <label class="kategori-label" for="kat_{{ $k->id_kategori }}">
                                    {{ $k->nama_kategori }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-text">
                        <i class="bi bi-check-circle"></i>
                        Pilih satu atau lebih kategori yang sesuai
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section: Lokasi -->
                <div class="section-title">
                    <i class="bi bi-map-fill"></i>
                    Lokasi & Koordinat
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">
                            <i class="bi bi-arrow-left-right"></i>
                            Longitude
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="longitude" class="form-control" value="{{ $wisata->longitude }}" placeholder="Contoh: 110.3750" required>
                        <div class="form-text">
                            <i class="bi bi-info-circle"></i>
                            Koordinat bujur (sumbu X)
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">
                            <i class="bi bi-arrow-up-down"></i>
                            Latitude
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="latitude" class="form-control" value="{{ $wisata->latitude }}" placeholder="Contoh: -7.7869" required>
                        <div class="form-text">
                            <i class="bi bi-info-circle"></i>
                            Koordinat lintang (sumbu Y)
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section: Deskripsi -->
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
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsikan tempat wisata..." required>{{ $wisata->deskripsi }}</textarea>
                    <div class="form-text">
                        <i class="bi bi-lightbulb"></i>
                        Gambaran umum tentang tempat wisata
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-clock-history"></i>
                        Sejarah Wisata
                        <span class="required">*</span>
                    </label>
                    <textarea name="sejarah" class="form-control" rows="4" placeholder="Ceritakan sejarah..." required>{{ $wisata->sejarah }}</textarea>
                    <div class="form-text">
                        <i class="bi bi-lightbulb"></i>
                        Informasi historis atau latar belakang tempat
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-mic-fill"></i>
                        Narasi Audio (Teks)
                        <span class="required">*</span>
                    </label>
                    <textarea name="narasi" class="form-control" rows="3" placeholder="Tulis narasi..." required>{{ $wisata->narasi }}</textarea>
                    <div class="form-text">
                        <i class="bi bi-lightbulb"></i>
                        Teks narasi untuk audio guide
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Section: Jam Operasional -->
                <div class="section-title">
                    <i class="bi bi-clock-fill"></i>
                    Jam Operasional
                </div>

                <div class="alert-info-custom">
                    <strong><i class="bi bi-info-circle-fill me-2"></i>Petunjuk Pengisian:</strong>
                    <ul>
                        <li>Jam default: <strong>00:00 – 23:59</strong> (buka 24 jam)</li>
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
                                $jamOps = $wisata->jamOperasional->keyBy('hari');
                            @endphp
                            @foreach ($days as $day)
                                <tr>
                                    <td>
                                        <input type="hidden" name="hari[]" value="{{ $day }}">
                                        <span class="day-name">{{ $day }}</span>
                                    </td>
                                    <td>
                                        <input type="time" name="jam_buka[]" class="form-control form-control-sm"
                                               value="{{ $jamOps[$day]->jam_buka ?? '00:00' }}">
                                    </td>
                                    <td>
                                        <input type="time" name="jam_tutup[]" class="form-control form-control-sm"
                                               value="{{ $jamOps[$day]->jam_tutup ?? '23:59' }}">
                                    </td>
                                    <td class="text-center">
                                        <input class="libur-checkbox" type="checkbox" name="libur[]" value="{{ $loop->index }}"
                                               {{ empty($jamOps[$day]->jam_buka) && empty($jamOps[$day]->jam_tutup) ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="section-divider"></div>

                <!-- Section: Foto -->
                <div class="section-title">
                    <i class="bi bi-images"></i>
                    Kelola Foto Wisata
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-image-fill"></i>
                        Foto Saat Ini
                    </label>
                    @if($wisata->foto->count() > 0)
                        <div class="photo-gallery">
                            @foreach ($wisata->foto as $index => $f)
                                <div class="photo-item">
                                    <img src="{{ asset('storage/' . $f->path_foto) }}" alt="Foto {{ $wisata->nama_wisata }}">
                                    <div class="photo-badge">Foto {{ $index + 1 }}</div>
                                    <div class="photo-overlay">
                                        <small style="color: white; font-size: 11px;">
                                            <i class="bi bi-image"></i> {{ basename($f->path_foto) }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Belum ada foto untuk tempat wisata ini
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-cloud-upload"></i>
                        Upload Foto Baru (Opsional)
                    </label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="foto[]" multiple accept="image/*" id="fileInput">
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
                    <div class="selected-files" id="selectedFiles"></div>
                    <div class="form-text mt-2">
                        <i class="bi bi-info-circle"></i>
                        Foto baru akan ditambahkan ke galeri yang sudah ada
                    </div>
                </div>

                <!-- Button Group -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // LOGIKA ASLI - Jam Operasional (TIDAK DIUBAH)
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll(".table-operasional tbody tr");

            rows.forEach((row, index) => {
                const liburCheckbox = row.querySelector(".libur-checkbox");
                const bukaInput = row.querySelector("input[name='jam_buka[]']");
                const tutupInput = row.querySelector("input[name='jam_tutup[]']");

                const toggleDisabled = (isLibur) => {
                    bukaInput.disabled = isLibur;
                    tutupInput.disabled = isLibur;
                    if (isLibur) {
                        bukaInput.value = '00:00';
                        tutupInput.value = '00:00';
                        row.style.opacity = '0.5';
                    } else {
                        row.style.opacity = '1';
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

        // Kategori Counter (Initialize dari kategori yang sudah terpilih)
        const kategoriCheckboxes = document.querySelectorAll('.kategori-checkbox');
        const selectedCountBadge = document.getElementById('selectedCount');

        function updateKategoriCount() {
            const checkedCount = document.querySelectorAll('.kategori-checkbox:checked').length;
            selectedCountBadge.textContent = `${checkedCount} dipilih`;
        }

        // Initialize counter on page load dengan kategori yang sudah terpilih
        updateKategoriCount();

        kategoriCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateKategoriCount);
        });

        // File Upload Preview
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
                            ${isOversized ? '<span style="color: #d32f2f; font-size: 11px; margin-left: 8px;">(Ukuran terlalu besar!)</span>' : ''}
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

        // Form Validation & Loading
        const form = document.getElementById('editForm');
        const loadingOverlay = document.getElementById('loadingOverlay');

        form.addEventListener('submit', function(e) {
            // Check kategori
            const kategoriChecked = document.querySelectorAll('.kategori-checkbox:checked').length;

            if (kategoriChecked === 0) {
                e.preventDefault();
                document.querySelector('[name="kategori[]"]').closest('.mb-4').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                alert('❌ Pilih minimal 1 kategori wisata!');
                return false;
            }

            // Check file sizes (jika ada file baru)
            const files = fileInput.files;
            let hasOversizedFile = false;

            for (let file of files) {
                if (file.size > 2 * 1024 * 1024) {
                    hasOversizedFile = true;
                    break;
                }
            }

            if (hasOversizedFile) {
                e.preventDefault();
                alert('❌ Ada file yang melebihi ukuran 2MB. Silakan pilih file yang lebih kecil.');
                return false;
            }

            // Validate coordinates
            const longitude = document.querySelector('[name="longitude"]').value;
            const latitude = document.querySelector('[name="latitude"]').value;

            if (isNaN(longitude) || isNaN(latitude)) {
                e.preventDefault();
                alert('❌ Longitude dan Latitude harus berupa angka!');
                return false;
            }

            // Show loading
            loadingOverlay.classList.add('active');
        });
    </script>
</body>

</html>
