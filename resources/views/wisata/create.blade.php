<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Tempat Wisata - Kotabaru Tourism</title>
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

        /* ✅ UPDATED: Kategori Styles */
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
            user-select: none;
            display: flex;
            min-height: 50px;
        }

        .kategori-item:hover {
            background: #e8f5e9;
            border-color: #66bb6a;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(46, 125, 50, 0.2);
        }

        .kategori-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .kategori-label {
            display: flex;
            padding: 14px 45px 14px 18px;
            font-weight: 500;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            border-radius: 10px;
            margin: 0;
            width: 100%;
            height: 100%;
        }

        .kategori-item input[type="checkbox"]:checked~.kategori-label,
        .kategori-item input[type="checkbox"]:checked+.kategori-label {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            border-radius: 10px;
        }

        .kategori-item input[type="checkbox"]:checked~.kategori-label::after,
        .kategori-item input[type="checkbox"]:checked+.kategori-label::after {
            content: '\F26E';
            font-family: 'bootstrap-icons';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: white;
            font-weight: bold;
        }

        /* Pastikan border tidak terlihat saat checked */
        .kategori-item:has(input[type="checkbox"]:checked) {
            border-color: transparent;
            background: transparent;
        }

        /* ✅ EMPTY STATE jika tidak ada kategori aktif */
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

        .empty-kategori h5 {
            color: #856404;
            margin-bottom: 0.5rem;
        }

        .empty-kategori p {
            color: #856404;
            font-size: 14px;
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

        /* Error Alert Jam Operasional */
        .alert-jam-operasional {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            border: none;
            border-left: 4px solid #c62828;
            border-radius: 12px;
            padding: 16px 20px;
            margin-top: 1rem;
            display: flex;
            align-items: start;
            gap: 12px;
            box-shadow: 0 4px 15px rgba(198, 40, 40, 0.15);
            animation: slideDown 0.3s ease;
        }

        .alert-jam-operasional i {
            color: #c62828;
            font-size: 24px;
            margin-top: 2px;
        }

        .alert-jam-operasional strong {
            color: #b71c1c;
            display: block;
            margin-bottom: 4px;
            font-size: 15px;
        }

        .alert-jam-operasional span {
            color: #d32f2f;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Error Alert Lokasi (untuk validasi wilayah Kotabaru) */
        .alert-lokasi-error {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            border: none;
            border-left: 4px solid #f57c00;
            border-radius: 12px;
            padding: 16px 20px;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 15px rgba(245, 124, 0, 0.15);
            animation: slideDown 0.3s ease;
        }

        .alert-lokasi-error i {
            color: #f57c00;
            font-size: 24px;
        }

        .alert-lokasi-error .alert-content {
            flex: 1;
            color: #e65100;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Enhanced Invalid Feedback - untuk error field form */
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #d32f2f !important;
            background-color: #ffebee !important;
            animation: shakeError 0.5s ease;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            border-color: #c62828 !important;
            box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25) !important;
        }

        .invalid-feedback {
            display: block;
            color: #d32f2f;
            font-size: 13px;
            margin-top: 8px;
            font-weight: 500;
            padding: 8px 12px;
            background: #ffebee;
            border-radius: 8px;
            border-left: 3px solid #d32f2f;
        }

        .invalid-feedback i {
            margin-right: 6px;
        }

        /* Error untuk textarea khusus */
        textarea.form-control.is-invalid {
            border-color: #d32f2f !important;
            background: linear-gradient(135deg, #ffebee 0%, #fff 100%) !important;
        }

        /* Error state untuk kategori checkbox */
        .kategori-container.has-error {
            border: 2px dashed #d32f2f;
            border-radius: 12px;
            padding: 12px;
            background: #ffebee;
            animation: pulseError 1s ease infinite;
        }

        /* Error state untuk file upload */
        .file-upload-wrapper.has-error {
            border-color: #d32f2f !important;
            background: #ffebee !important;
        }

        /* Animation untuk error */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shakeError {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        @keyframes pulseError {

            0%,
            100% {
                border-color: #d32f2f;
                background: #ffebee;
            }

            50% {
                border-color: #f44336;
                background: #ffcdd2;
            }
        }

        /* Error badge untuk menunjukkan jumlah error */
        .error-badge {
            background: linear-gradient(135deg, #d32f2f 0%, #c62828 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
            animation: bounce 0.5s ease;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Highlight error section */
        .section-has-error {
            border: 2px solid #ffcdd2;
            border-radius: 12px;
            padding: 20px;
            background: #ffebee;
            margin: -20px;
            margin-bottom: 20px;
        }

        /* Focus state untuk error fields */
        .form-control.is-invalid:focus::placeholder,
        .form-select.is-invalid:focus::placeholder,
        textarea.is-invalid:focus::placeholder {
            color: #d32f2f;
            opacity: 0.6;
        }

        /* Error tooltip untuk hover */
        .form-control.is-invalid:hover,
        textarea.is-invalid:hover {
            border-color: #b71c1c !important;
            box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.1);
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
        }

        .error-summary {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            border: none;
            border-left: 5px solid #d32f2f;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 2rem;
        }

        .error-summary h5 {
            color: #d32f2f;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-summary ul {
            margin: 0;
            padding-left: 25px;
        }

        .error-summary li {
            color: #b71c1c;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .alert-sticky {
            position: sticky;
            top: 20px;
            z-index: 100;
            margin-bottom: 2rem;
            animation: shake 0.5s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
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
            <h1><i class="bi bi-plus-circle-fill me-2"></i>Tambah Tempat Wisata</h1>
            <p>Lengkapi data wisata baru untuk Kotabaru Tourism Data Center</p>
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
                        placeholder="Contoh: Museum Sandi" value="{{ old('nama_wisata') }}" required>
                    @error('nama_wisata')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- ✅ UPDATED: Kategori Section --}}
                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-tags-fill"></i>
                        Kategori Wisata
                        <span class="required">*</span>
                        <span class="counter-badge" id="selectedCount">0 dipilih</span>
                    </label>

                    @if ($kategori->isEmpty())
                        {{-- Empty state jika tidak ada kategori aktif --}}
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
                                        {{ in_array($k->id_kategori, old('kategori', [])) ? 'checked' : '' }}>
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
                        placeholder="Contoh: Jl. Faridan M Noto No.21, Kotabaru" required>{{ old('alamat_lengkap') }}</textarea>
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
                            placeholder="Contoh: 110.3750" value="{{ old('longitude') }}" required>
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
                            value="{{ old('latitude') }}" required>
                        @error('latitude')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                @if ($errors->has('lokasi'))
                    <div class="alert-lokasi-error">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div class="alert-content">
                            {{ $errors->first('lokasi') }}
                        </div>
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
                        placeholder="Deskripsikan tempat wisata..." required>{{ old('deskripsi') }}</textarea>
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
                        placeholder="Ceritakan sejarah tempat wisata..." required>{{ old('sejarah') }}</textarea>
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
                        placeholder="Tulis narasi untuk audio guide..." required>{{ old('narasi') }}</textarea>
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
                                $defaultBuka = '08:00';
                                $defaultTutup = '17:00';
                            @endphp
                            @foreach ($days as $index => $day)
                                <tr>
                                    <td>
                                        <input type="hidden" name="hari[]" value="{{ $day }}">
                                        <span class="day-name">{{ $day }}</span>
                                    </td>
                                    <td>
                                        <input type="time" name="jam_buka[]"
                                            class="form-control form-control-sm jam-buka-input"
                                            value="{{ old('jam_buka.' . $index, $defaultBuka) }}"
                                            {{ old('libur') && in_array($index, old('libur')) ? 'disabled' : '' }}>
                                    </td>
                                    <td>
                                        <input type="time" name="jam_tutup[]"
                                            class="form-control form-control-sm jam-tutup-input"
                                            value="{{ old('jam_tutup.' . $index, $defaultTutup) }}"
                                            {{ old('libur') && in_array($index, old('libur')) ? 'disabled' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input class="libur-checkbox" type="checkbox" name="libur[]"
                                            value="{{ $index }}"
                                            {{ old('libur') && in_array($index, old('libur')) ? 'checked' : '' }}>
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

                <div class="mb-4">
                    @if (session('previous_files'))
                        <div class="previous-files-info">
                            <strong>
                                <i class="bi bi-info-circle-fill"></i>
                                File yang tadi Anda pilih:
                            </strong>
                            <ul class="previous-files-list">
                                @foreach (session('previous_files') as $file)
                                    <li>
                                        <i class="bi bi-file-image"></i>
                                        <span>{{ $file['name'] }}</span>
                                        <small style="color: #666;">({{ $file['size'] }})</small>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="file-warning">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>Silakan upload ulang file-file tersebut karena browser tidak dapat menyimpan file
                                    sementara</span>
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

        // ✅ FIXED: Libur checkbox handler - JANGAN DISABLE INPUT
        document.querySelectorAll('.libur-checkbox').forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('tr');
                const bukaInput = row.querySelector('.jam-buka-input');
                const tutupInput = row.querySelector('.jam-tutup-input');

                if (this.checked) {
                    // Set value 00:00 untuk libur, TAPI TETAP KIRIM
                    bukaInput.value = '00:00';
                    tutupInput.value = '00:00';

                    // Visual feedback ONLY (tidak disable)
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
                    // Reset ke jam normal
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
        const selectedFilesContainer = document.getElementById('selectedFiles');
        const uploadWrapper = document.querySelector('.file-upload-wrapper');
        let selectedFiles = [];

        uploadWrapper.addEventListener('click', function() {
            if (e.target !== fileInput) {
                fileInput.click();
            }
        });

        fileInput.addEventListener('change', function(e) {
            handleFiles(e.target.files);
        });

        uploadWrapper.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadWrapper.style.borderColor = '#1b5e20';
            uploadWrapper.style.background = 'linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%)';
        });

        uploadWrapper.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadWrapper.style.borderColor = '#2e7d32';
            uploadWrapper.style.background = 'linear-gradient(135deg, #f1f8f4 0%, #e8f5e9 100%)';
        });

        uploadWrapper.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadWrapper.style.borderColor = '#2e7d32';
            uploadWrapper.style.background = 'linear-gradient(135deg, #f1f8f4 0%, #e8f5e9 100%)';
            handleFiles(e.dataTransfer.files);
        });

        function handleFiles(files) {
            const filesArray = Array.from(files);
            let hasError = false;

            filesArray.forEach(file => {
                if (!file.type.match('image.*')) {
                    alert('❌ ' + file.name + ' bukan file gambar!');
                    hasError = true;
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('❌ ' + file.name + ' terlalu besar! Maksimal 2MB per file.');
                    hasError = true;
                    return;
                }

                selectedFiles.push(file);
            });

            if (!hasError) {
                displayFiles();
                updateFileInput();
            }
        }

        function displayFiles() {
            selectedFilesContainer.innerHTML = '';
            selectedFilesContainer.style.display = selectedFiles.length > 0 ? 'grid' : 'none';
            selectedFilesContainer.style.gridTemplateColumns = 'repeat(auto-fill, minmax(150px, 1fr))';
            selectedFilesContainer.style.gap = '15px';
            selectedFilesContainer.style.marginTop = '1.5rem';

            selectedFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.style.cssText = `
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background: white;
            transition: all 0.3s ease;
        `;

                const reader = new FileReader();
                reader.onload = function(e) {
                    fileItem.innerHTML = `
                <img src="${e.target.result}" alt="${file.name}" style="width:100%; height:150px; object-fit:cover; display:block;">
                <div style="position:absolute; bottom:40px; left:8px; background:rgba(46,125,50,0.9); color:white; padding:4px 8px; border-radius:8px; font-size:11px; font-weight:600;">
                    ${formatFileSize(file.size)}
                </div>
                <button type="button" onclick="removeFile(${index})" style="position:absolute; top:8px; right:8px; background:rgba(211,47,47,0.95); color:white; border:none; border-radius:50%; width:28px; height:28px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:16px; transition:all 0.3s ease; z-index:3;">
                    <i class="bi bi-x"></i>
                </button>
                <div style="padding:10px; font-size:12px; color:#333; text-align:center; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; background:#f8f9fa;" title="${file.name}">
                    ${file.name}
                </div>
            `;
                };
                reader.readAsDataURL(file);
                selectedFilesContainer.appendChild(fileItem);
            });
        }

        function updateFileInput() {
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

        window.removeFile = function(index) {
            selectedFiles.splice(index, 1);
            displayFiles();
            updateFileInput();
        };

        // Kategori counter
        const kategoriCheckboxes = document.querySelectorAll('.kategori-checkbox');
        const selectedCountBadge = document.getElementById('selectedCount');

        function updateKategoriCount() {
            const checkedCount = document.querySelectorAll('.kategori-checkbox:checked').length;
            if (selectedCountBadge) {
                selectedCountBadge.textContent = `${checkedCount} dipilih`;
            }
        }

        // Initial count
        updateKategoriCount();

        // Update on change
        kategoriCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateKategoriCount);
        });

        // Form validation
        const form = document.getElementById('wisataForm');
        const loadingOverlay = document.getElementById('loadingOverlay');

        form.addEventListener('submit', function(e) {
            // 1. Validasi kategori
            const kategoriChecked = document.querySelectorAll('.kategori-checkbox:checked').length;
            const hasKategori = document.querySelectorAll('.kategori-checkbox').length > 0;

            if (hasKategori && kategoriChecked === 0) {
                e.preventDefault();
                alert('❌ Pilih minimal 1 kategori wisata!');
                return false;
            }

            // 2. ✅ VALIDASI JAM OPERASIONAL (BARU!)
            const rows = document.querySelectorAll('.table-operasional tbody tr');
            let hasInvalidTime = false;
            let errorMessage = '';

            rows.forEach((row) => {
                const liburCheckbox = row.querySelector('.libur-checkbox');

                // Skip jika hari libur
                if (liburCheckbox && liburCheckbox.checked) {
                    return;
                }

                const jamBuka = row.querySelector('.jam-buka-input').value;
                const jamTutup = row.querySelector('.jam-tutup-input').value;
                const hari = row.querySelector('input[name="hari[]"]').value;

                // Validasi jam kosong
                if (!jamBuka || !jamTutup) {
                    hasInvalidTime = true;
                    errorMessage = `Jam buka dan tutup pada hari ${hari} harus diisi!`;
                    return false;
                }

                // Validasi jam tutup harus > jam buka
                if (jamTutup <= jamBuka) {
                    hasInvalidTime = true;
                    errorMessage =
                        `Jam tutup pada hari ${hari} harus lebih besar dari jam buka!\n\nBuka: ${jamBuka}\nTutup: ${jamTutup}`;
                    return false;
                }
            });

            if (hasInvalidTime) {
                e.preventDefault();
                alert('❌ ' + errorMessage);
                // Scroll ke section jam operasional
                document.querySelector('.table-operasional').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                return false;
            }

            // 3. Validasi file upload
            const files = fileInput.files;
            if (files.length === 0) {
                e.preventDefault();
                alert('❌ Upload minimal 1 foto!');
                return false;
            }

            // 4. Validasi ukuran file
            let hasOversizedFile = false;
            let oversizedFileName = '';

            for (let file of files) {
                if (file.size > 2 * 1024 * 1024) {
                    hasOversizedFile = true;
                    oversizedFileName = file.name;
                    break;
                }
            }

            if (hasOversizedFile) {
                e.preventDefault();
                alert(`❌ File "${oversizedFileName}" melebihi ukuran maksimal 2MB!`);
                return false;
            }

            // ✅ Semua validasi lolos - Show loading overlay
            loadingOverlay.classList.add('active');
        });
        // Initialize libur state on page load (untuk old() values)
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.libur-checkbox').forEach((checkbox) => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const bukaInput = row.querySelector('.jam-buka-input');
                    const tutupInput = row.querySelector('.jam-tutup-input');

                    // Apply visual state untuk checkbox yang sudah checked
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
            // Scroll to first error on page load
            const firstError = document.querySelector('.is-invalid, .error-summary');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
</body>

</html>
