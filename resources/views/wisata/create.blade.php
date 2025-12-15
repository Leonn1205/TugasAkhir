<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tempat Wisata - Kotabaru Tourism</title>
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
            to { transform: rotate(360deg); }
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

        .form-control, .form-select {
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #d32f2f;
            background-color: #ffebee;
        }

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
        }

        .kategori-item:hover {
            background: #e8f5e9;
            border-color: #66bb6a;
            transform: translateY(-2px);
        }

        .kategori-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
        }

        .kategori-item input[type="checkbox"]:checked~.kategori-label {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .kategori-item input[type="checkbox"]:checked~.kategori-label::before {
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
            cursor: pointer;
            position: relative;
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

        .table-operasional input[type="time"]:disabled {
            background: #f5f5f5;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .libur-checkbox {
            width: 22px;
            height: 22px;
            cursor: pointer;
            accent-color: #d32f2f;
        }

        /* Previous Files Info */
        .previous-files-info {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 15px;
        }

        .previous-files-info strong {
            display: block;
            color: #1565c0;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .previous-files-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .previous-files-list li {
            background: white;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #333;
        }

        .previous-files-list i {
            color: #2196f3;
            font-size: 16px;
        }

        .file-warning {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 10px 12px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #856404;
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
            .form-container { padding: 25px; }
            .header-section h1 { font-size: 32px; }
            .button-group { flex-direction: column; }
            .btn-submit, .btn-cancel { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div class="loading-text">Menyimpan data wisata...</div>
        </div>
    </div>

    @if(session('success'))
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

    @if($errors->any())
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
            <h1><i class="bi bi-plus-circle-fill me-2"></i>Tambah Tempat Wisata</h1>
            <p>Lengkapi data wisata baru untuk Kotabaru Tourism Data Center</p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <form method="POST" action="{{ route('wisata.store') }}" enctype="multipart/form-data" id="wisataForm">
                @csrf

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
                        placeholder="Contoh: Museum Sandi"
                        value="{{ old('nama_wisata') }}" required>
                    @error('nama_wisata')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-tags-fill"></i>
                        Kategori Wisata
                        <span class="required">*</span>
                        <span class="counter-badge" id="selectedCount">0 dipilih</span>
                    </label>
                    <div class="kategori-container">
                        @foreach($kategori as $k)
                        <div class="kategori-item">
                            <input type="checkbox" name="kategori[]" value="{{ $k->id_kategori }}"
                                id="kat_{{ $k->id_kategori }}" class="kategori-checkbox"
                                {{ in_array($k->id_kategori, old('kategori', [])) ? 'checked' : '' }}>
                            <label class="kategori-label" for="kat_{{ $k->id_kategori }}">
                                {{ $k->nama_kategori }}
                            </label>
                        </div>
                        @endforeach
                    </div>
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
                    <textarea name="alamat_lengkap"
                        class="form-control @error('alamat_lengkap') is-invalid @enderror"
                        rows="3" placeholder="Contoh: Jl. Faridan M Noto No.21, Kotabaru"
                        required>{{ old('alamat_lengkap') }}</textarea>
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
                            placeholder="Contoh: 110.3750"
                            value="{{ old('longitude') }}" required>
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
                            class="form-control @error('latitude') is-invalid @enderror"
                            placeholder="Contoh: -7.7869"
                            value="{{ old('latitude') }}" required>
                        @error('latitude')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                @if($errors->has('lokasi'))
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
                    <textarea name="deskripsi"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        rows="4" placeholder="Deskripsikan tempat wisata..."
                        required>{{ old('deskripsi') }}</textarea>
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
                    <textarea name="sejarah"
                        class="form-control @error('sejarah') is-invalid @enderror"
                        rows="4" placeholder="Ceritakan sejarah tempat wisata..."
                        required>{{ old('sejarah') }}</textarea>
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
                    <textarea name="narasi"
                        class="form-control @error('narasi') is-invalid @enderror"
                        rows="3" placeholder="Tulis narasi untuk audio guide..."
                        required>{{ old('narasi') }}</textarea>
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
                                $defaultBuka = '08:00';
                                $defaultTutup = '17:00';
                            @endphp
                            @foreach($days as $index => $day)
                            <tr>
                                <td>
                                    <input type="hidden" name="hari[]" value="{{ $day }}">
                                    <span class="day-name">{{ $day }}</span>
                                </td>
                                <td>
                                    <input type="time" name="jam_buka[]"
                                           class="form-control form-control-sm jam-buka-input"
                                           value="{{ old('jam_buka.'.$index, $defaultBuka) }}"
                                           {{ old('libur') && in_array($index, old('libur')) ? 'disabled' : '' }}>
                                </td>
                                <td>
                                    <input type="time" name="jam_tutup[]"
                                           class="form-control form-control-sm jam-tutup-input"
                                           value="{{ old('jam_tutup.'.$index, $defaultTutup) }}"
                                           {{ old('libur') && in_array($index, old('libur')) ? 'disabled' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input class="libur-checkbox" type="checkbox"
                                           name="libur[]" value="{{ $index }}"
                                           {{ old('libur') && in_array($index, old('libur')) ? 'checked' : '' }}>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-images"></i>
                    Foto Wisata
                </div>

                <div class="mb-4">
                    @if(session('previous_files'))
                    <div class="previous-files-info">
                        <strong>
                            <i class="bi bi-info-circle-fill"></i>
                            File yang tadi Anda pilih:
                        </strong>
                        <ul class="previous-files-list">
                            @foreach(session('previous_files') as $file)
                            <li>
                                <i class="bi bi-file-image"></i>
                                <span>{{ $file['name'] }}</span>
                                <small style="color: #666;">({{ $file['size'] }})</small>
                            </li>
                            @endforeach
                        </ul>
                        <div class="file-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span>Silakan upload ulang file-file tersebut karena browser tidak dapat menyimpan file sementara</span>
                        </div>
                    </div>
                    @endif

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

                <div class="button-group">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Submit Data Wisata
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
        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-notification .alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Template Quick Fill
        const templates = {
            museum: {
                buka: '08:00',
                tutup: '16:00',
                libur: [0] // Senin
            },
            pantai: {
                buka: '06:00',
                tutup: '18:00',
                libur: []
            },
            mall: {
                buka: '10:00',
                tutup: '22:00',
                libur: []
            },
            kantor: {
                buka: '08:00',
                tutup: '17:00',
                libur: [5, 6] // Sabtu, Minggu
            },
            '24jam': {
                buka: '00:00',
                tutup: '23:59',
                libur: []
            }
        };

        function applyTemplate(template) {
            const rows = document.querySelectorAll('.table-operasional tbody tr');

            rows.forEach((row, index) => {
                const bukaInput = row.querySelector('.jam-buka-input');
                const tutupInput = row.querySelector('.jam-tutup-input');
                const liburCheckbox = row.querySelector('.libur-checkbox');

                const isLibur = template.libur.includes(index);

                bukaInput.value = isLibur ? '00:00' : template.buka;
                tutupInput.value = isLibur ? '00:00' : template.tutup;
                liburCheckbox.checked = isLibur;

                bukaInput.disabled = isLibur;
                tutupInput.disabled = isLibur;
                row.style.opacity = isLibur ? '0.5' : '1';
            });
        }

        document.querySelectorAll('.btn-template').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active from all
                document.querySelectorAll('.btn-template').forEach(b => b.classList.remove('active'));
                // Add active to clicked
                this.classList.add('active');

                const templateName = this.dataset.template;
                applyTemplate(templates[templateName]);
            });
        });

        // Libur checkbox handler
        document.querySelectorAll('.libur-checkbox').forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('tr');
                const bukaInput = row.querySelector('.jam-buka-input');
                const tutupInput = row.querySelector('.jam-tutup-input');

                if (this.checked) {
                    bukaInput.value = '00:00';
                    tutupInput.value = '00:00';
                    bukaInput.disabled = true;
                    tutupInput.disabled = true;
                    row.style.opacity = '0.5';
                } else {
                    bukaInput.value = '08:00';
                    tutupInput.value = '17:00';
                    bukaInput.disabled = false;
                    tutupInput.disabled = false;
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

            if (kategoriChecked === 0) {
                e.preventDefault();
                alert('❌ Pilih minimal 1 kategori wisata!');
                return false;
            }

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
                alert('❌ Ada file yang melebihi ukuran 2MB!');
                return false;
            }

            loadingOverlay.classList.add('active');
        });
    </script>
</body>
</html>
