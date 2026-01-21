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

        .alert-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 350px;
            max-width: 500px;
            animation: slideInRight 0.4s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
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
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            margin: 0 auto 2rem;
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

        .counter-badge {
            background: #ffd54f;
            color: #1b5e20;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-left: 10px;
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

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #d32f2f;
            background-color: #ffebee;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23d32f2f'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23d32f2f' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            display: block;
            color: #d32f2f;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .invalid-feedback::before {
            content: "⚠";
            font-size: 14px;
        }

        .form-check-input.is-invalid {
            border-color: #d32f2f;
        }

        .form-check-input.is-invalid~.form-check-label {
            color: #d32f2f;
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

        .form-text.note {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-top: 5px;
        }

        .alert-info-custom {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: none;
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 1.5rem;
        }

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

        .table-operasional thead th {
            border: none;
            padding: 14px 10px;
            font-size: 13px;
            font-weight: 600;
        }

        .table-operasional tbody td {
            padding: 10px;
            vertical-align: middle;
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
        }

        .file-upload-wrapper:hover {
            border-color: #1b5e20;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        }

        .file-upload-wrapper.is-invalid {
            border-color: #d32f2f;
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
        }

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
            text-decoration: none;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
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
    </style>
</head>

<body>
    {{-- <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div class="loading-text">Menyimpan data kuliner...</div>
        </div>
    </div> --}}

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
            <h1><i class="bi bi-plus-circle-fill me-2"></i>Tambah Data Tempat Kuliner</h1>
            <p>Lengkapi data kuliner baru untuk Kotabaru Tourism Data Center</p>
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

            <form method="POST" action="{{ route('kuliner.store') }}" enctype="multipart/form-data" id="kulinerForm">
                @csrf

                <!-- 1. IDENTITAS USAHA -->
                <div class="section-title">
                    <i class="bi bi-building"></i>
                    Identitas Usaha
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-shop"></i>
                            Nama Sentra / Usaha
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_sentra"
                            class="form-control @error('nama_sentra') is-invalid @enderror"
                            value="{{ old('nama_sentra') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Contoh: Warung Sari Laut Kotabaru
                        </small>
                        @error('nama_sentra')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-calendar-event"></i>
                            Tahun Berdiri <span class="required">*</span>
                        </label>
                        <input type="number" name="tahun_berdiri"
                            class="form-control @error('tahun_berdiri') is-invalid @enderror" min="1900"
                            max="{{ date('Y') }}" value="{{ old('tahun_berdiri') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Rentang Tahun : 1900 - {{ date('Y') }}
                        </small>
                        @error('tahun_berdiri')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person"></i>
                            Nama Pemilik <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_pemilik"
                            class="form-control @error('nama_pemilik') is-invalid @enderror"
                            value="{{ old('nama_pemilik') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Contoh: Ananda Leon
                        </small>
                        @error('nama_pemilik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-briefcase"></i>
                            Kepemilikan <span class="required">*</span>
                        </label>
                        <select name="kepemilikan" class="form-control @error('kepemilikan') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Kepemilikan --</option>
                            <option value="Pribadi" {{ old('kepemilikan') == 'Pribadi' ? 'selected' : '' }}>Pribadi
                            </option>
                            <option value="Keluarga" {{ old('kepemilikan') == 'Keluarga' ? 'selected' : '' }}>Keluarga
                            </option>
                            <option value="Komunitas" {{ old('kepemilikan') == 'Komunitas' ? 'selected' : '' }}>
                                Komunitas</option>
                            <option value="Waralaba" {{ old('kepemilikan') == 'Waralaba' ? 'selected' : '' }}>Waralaba
                            </option>
                        </select>
                        @error('kepemilikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-geo-alt"></i>
                        Alamat Lengkap <span class="required">*</span>
                    </label>
                    <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" rows="2"
                        required>{{ old('alamat_lengkap') }}</textarea>
                    <small class="form-text text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Contoh: Jl. Veteran No.12, Kotabaru
                    </small>
                    @error('alamat_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-telephone"></i>
                            No. Telepon <span class="required">*</span>
                        </label>
                        <input type="text" name="telepon"
                            class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}"
                            maxlength="15" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Contoh: 081234567890 (Maksimal 12 digit)
                        </small>
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-envelope"></i>
                            Email <span class="required">*</span>
                        </label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Contoh: contoh@email.com
                        </small>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-file-text"></i>
                            No. NIB <span class="required">*</span>
                        </label>
                        <input type="text" name="no_nib"
                            class="form-control @error('no_nib') is-invalid @enderror" value="{{ old('no_nib') }}"
                            maxlength="13" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Harus 13 digit angka. Contoh: 9120001380361
                        </small>
                        @error('no_nib')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-award"></i>
                        Sertifikat (boleh lebih dari satu)
                    </label><br>
                    @foreach (['PIRT', 'BPOM', 'Halal', 'NIB', 'Lainnya'] as $item)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="sertifikat_lain[]" value="{{ $item }}"
                                id="sertifikat_{{ $item }}" class="form-check-input sertifikat-check"
                                {{ in_array($item, old('sertifikat_lain', [])) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="sertifikat_{{ $item }}">{{ $item }}</label>
                        </div>
                    @endforeach
                    <input type="text" id="sertifikat_text" name="sertifikat_text"
                        class="form-control mt-2 @error('sertifikat_text') is-invalid @enderror"
                        placeholder="Tulis sertifikat lainnya..."
                        style="display:{{ in_array('Lainnya', old('sertifikat_lain', [])) ? 'block' : 'none' }}; max-width:400px;"
                        value="{{ old('sertifikat_text') }}">
                    @error('sertifikat_text')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-people"></i>
                            Jumlah Pegawai <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_pegawai"
                            class="form-control @error('jumlah_pegawai') is-invalid @enderror" min="0"
                            value="{{ old('jumlah_pegawai') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            contoh : 25
                        </small>
                        @error('jumlah_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-grid"></i>
                            Jumlah Kursi <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_kursi"
                            class="form-control @error('jumlah_kursi') is-invalid @enderror" min="0"
                            value="{{ old('jumlah_kursi') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            contoh : 25
                        </small>
                        @error('jumlah_kursi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-shop-window"></i>
                            Jumlah Gerai <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_gerai"
                            class="form-control @error('jumlah_gerai') is-invalid @enderror" min="0"
                            value="{{ old('jumlah_gerai') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            contoh : 1
                        </small>
                        @error('jumlah_gerai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person-check"></i>
                            Pelanggan/Hari <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_pelanggan_per_hari"
                            class="form-control @error('jumlah_pelanggan_per_hari') is-invalid @enderror"
                            min="0" value="{{ old('jumlah_pelanggan_per_hari') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            contoh : 50
                        </small>
                        @error('jumlah_pelanggan_per_hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- JAM OPERASIONAL -->
                <div class="section-title">
                    <i class="bi bi-clock"></i>
                    Jam Operasional
                </div>

                <div class="alert-info-custom">
                    <strong><i class="bi bi-info-circle-fill me-2"></i>Petunjuk Pengisian:</strong>
                    <ul>
                        <li>Sesuaikan jam buka dan tutup sesuai operasional tempat</li>
                        <li>Jam sibuk bersifat opsional</li>
                        <li>Centang "Libur" bila tempat tidak beroperasi hari itu</li>
                    </ul>
                </div>

                <div class="table-responsive">
                    <table class="table table-operasional text-center align-middle">
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
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $i => $day)
                                <tr>
                                    <td><input type="text" name="hari[{{ $i }}]"
                                            class="form-control text-center" value="{{ $day }}" readonly>
                                    </td>
                                    <td><input type="time" name="jam_buka[{{ $i }}]"
                                            class="form-control" value="{{ old('jam_buka.' . $i, '08:00') }}"></td>
                                    <td><input type="time" name="jam_tutup[{{ $i }}]"
                                            class="form-control" value="{{ old('jam_tutup.' . $i, '21:00') }}"></td>
                                    <td><input type="time" name="jam_sibuk_mulai[{{ $i }}]"
                                            class="form-control" value="{{ old('jam_sibuk_mulai.' . $i) }}"></td>
                                    <td><input type="time" name="jam_sibuk_selesai[{{ $i }}]"
                                            class="form-control" value="{{ old('jam_sibuk_selesai.' . $i) }}"></td>
                                    <td><input type="checkbox" name="libur[{{ $i }}]"
                                            class="libur-checkbox"
                                            {{ in_array($i, old('libur', [])) ? 'checked' : '' }}></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @error('jam_operasional')
                        <div class="alert-jam-operasional"
                            style="
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
    ">
                            <i class="bi bi-exclamation-triangle-fill"
                                style="color: #c62828; font-size: 24px; margin-top: 2px;"></i>
                            <div>
                                <strong style="color: #b71c1c; display: block; margin-bottom: 4px; font-size: 15px;">
                                    ⚠️ Error Jam Operasional
                                </strong>
                                <span style="color: #d32f2f; font-size: 14px; line-height: 1.5;">
                                    {{ $message }}
                                </span>
                            </div>
                        </div>
                    @enderror
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label @error('profil_pelanggan') text-danger @enderror">
                            <i class="bi bi-person-badge"></i>
                            Profil Pelanggan <span class="required">*</span>
                        </label><br>
                        @foreach (['Lokal', 'Wisatawan', 'Pelajar/Mahasiswa', 'Pekerja'] as $p)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="profil_pelanggan[]" value="{{ $p }}"
                                    class="form-check-input @error('profil_pelanggan') is-invalid @enderror"
                                    id="profil_{{ $p }}"
                                    {{ in_array($p, old('profil_pelanggan', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="profil_{{ $p }}">{{ $p }}</label>
                            </div>
                        @endforeach
                        @error('profil_pelanggan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label @error('metode_pembayaran') text-danger @enderror">
                            <i class="bi bi-credit-card"></i>
                            Metode Pembayaran <span class="required">*</span>
                        </label><br>
                        @foreach (['Tunai', 'Qris / Transfer'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="metode_pembayaran[]" value="{{ $m }}"
                                    class="form-check-input @error('metode_pembayaran') is-invalid @enderror"
                                    id="metode_{{ $m }}"
                                    {{ in_array($m, old('metode_pembayaran', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="metode_{{ $m }}">{{ $m }}</label>
                            </div>
                        @endforeach
                        @error('metode_pembayaran')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label @error('pajak_retribusi') text-danger @enderror">
                        <i class="bi bi-cash-coin"></i>
                        Pajak / Retribusi <span class="required">*</span>
                    </label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('pajak_retribusi') is-invalid @enderror" type="radio"
                            name="pajak_retribusi" value="Ya" id="pajak_ya"
                            {{ old('pajak_retribusi') == 'Ya' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="pajak_ya">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('pajak_retribusi') is-invalid @enderror" type="radio"
                            name="pajak_retribusi" value="Tidak" id="pajak_tidak"
                            {{ old('pajak_retribusi') == 'Tidak' ? 'checked' : '' }}>
                        <label class="form-check-label" for="pajak_tidak">Tidak</label>
                    </div>
                    @error('pajak_retribusi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="section-divider"></div>

                <!-- 2. JENIS KULINER -->
                <div class="section-title">
                    <i class="bi bi-card-list"></i>
                    Jenis Kuliner & Kategori
                </div>

                <div class="mb-3">
                    <label class="form-label @error('kategori') text-danger @enderror">
                        <i class="bi bi-tags"></i>
                        Kategori
                        <span class="required">*</span>
                        <span class="counter-badge" id="selectedCount">0 dipilih</span>
                    </label>

                    @if ($kategori->isEmpty())
                        {{-- Empty state jika tidak ada kategori aktif --}}
                        <div class="empty-kategori">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <h5>Tidak Ada Kategori Aktif</h5>
                            <p>Belum ada kategori kuliner yang aktif. Hubungi administrator untuk mengaktifkan kategori
                                terlebih dahulu.</p>
                        </div>
                    @else
                        <div class="kategori-container">
                            @foreach ($kategori as $kat)
                                <div class="kategori-item">
                                    <input type="checkbox" name="kategori[]" value="{{ $kat->id_kategori }}"
                                        id="kategori_{{ $kat->id_kategori }}" class="kategori-checkbox"
                                        {{ in_array($kat->id_kategori, old('kategori', [])) ? 'checked' : '' }}>
                                    <label class="kategori-label" for="kategori_{{ $kat->id_kategori }}">
                                        {{ $kat->nama_kategori }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @error('kategori')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-star"></i>
                            Menu Unggulan <span class="required">*</span>
                        </label>
                        <input type="text" name="menu_unggulan"
                            class="form-control @error('menu_unggulan') is-invalid @enderror"
                            value="{{ old('menu_unggulan') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            contoh : Soto Banjar Spesial
                        </small>
                        @error('menu_unggulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-basket"></i>
                            Bahan Baku Utama <span class="required">*</span>
                        </label>
                        <input type="text" name="bahan_baku_utama"
                            class="form-control @error('bahan_baku_utama') is-invalid @enderror"
                            value="{{ old('bahan_baku_utama') }}" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            contoh : Daging Ayam, Rempah Lokal
                        </small>
                        @error('bahan_baku_utama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-truck"></i>
                            Sumber Bahan Baku <span class="required">*</span>
                        </label>
                        <select name="sumber_bahan_baku"
                            class="form-control @error('sumber_bahan_baku') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            <option value="Lokal" {{ old('sumber_bahan_baku') == 'Lokal' ? 'selected' : '' }}>Lokal
                            </option>
                            <option value="Domestik / Luar Kota"
                                {{ old('sumber_bahan_baku') == 'Domestik / Luar Kota' ? 'selected' : '' }}>Domestik /
                                Luar Kota</option>
                            <option value="Import / Luar Negeri"
                                {{ old('sumber_bahan_baku') == 'Import / Luar Negeri' ? 'selected' : '' }}>Import /
                                Luar Negeri</option>
                            <option value="Campuran" {{ old('sumber_bahan_baku') == 'Campuran' ? 'selected' : '' }}>
                                Campuran</option>
                        </select>
                        @error('sumber_bahan_baku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label @error('menu_bersifat') text-danger @enderror">
                            <i class="bi bi-calendar-check"></i>
                            Menu Bersifat <span class="required">*</span>
                        </label><br>
                        @foreach (['Tetap', 'Musiman'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="menu_bersifat[]" value="{{ $m }}"
                                    class="form-check-input @error('menu_bersifat') is-invalid @enderror"
                                    id="menu_{{ $m }}"
                                    {{ in_array($m, old('menu_bersifat', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="menu_{{ $m }}">{{ $m }}</label>
                            </div>
                        @endforeach
                        @error('menu_bersifat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 3. TEMPAT & FASILITAS -->
                <div class="section-title">
                    <i class="bi bi-shop"></i>
                    Tempat & Fasilitas
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-building"></i>
                            Bentuk Fisik <span class="required">*</span>
                        </label>
                        <select name="bentuk_fisik" class="form-control @error('bentuk_fisik') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Bentuk Fisik --</option>
                            <option value="Restoran" {{ old('bentuk_fisik') == 'Restoran' ? 'selected' : '' }}>
                                Restoran</option>
                            <option value="Warung" {{ old('bentuk_fisik') == 'Warung' ? 'selected' : '' }}>Warung
                            </option>
                            <option value="Kafe" {{ old('bentuk_fisik') == 'Kafe' ? 'selected' : '' }}>Kafe</option>
                            <option value="Food Court" {{ old('bentuk_fisik') == 'Food Court' ? 'selected' : '' }}>
                                Food Court</option>
                            <option value="Jasa Boga (Katering)"
                                {{ old('bentuk_fisik') == 'Jasa Boga (Katering)' ? 'selected' : '' }}>Jasa Boga
                                (Katering)</option>
                            <option value="Penyedia Makanan oleh Pedagang Keliling"
                                {{ old('bentuk_fisik') == 'Penyedia Makanan oleh Pedagang Keliling' ? 'selected' : '' }}>
                                Penyedia Makanan oleh Pedagang Keliling</option>
                            <option value="Penyedia Makanan oleh Pedagang Tidak Keliling"
                                {{ old('bentuk_fisik') == 'Penyedia Makanan oleh Pedagang Tidak Keliling' ? 'selected' : '' }}>
                                Penyedia Makanan oleh Pedagang Tidak Keliling</option>
                        </select>
                        @error('bentuk_fisik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-house-door"></i>
                            Status Bangunan <span class="required">*</span>
                        </label>
                        <select name="status_bangunan"
                            class="form-control @error('status_bangunan') is-invalid @enderror"
                            id="statusBangunanSelect" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Milik Sendiri"
                                {{ old('status_bangunan') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri
                            </option>
                            <option value="Sewa" {{ old('status_bangunan') == 'Sewa' ? 'selected' : '' }}>Sewa
                            </option>
                            <option value="Pinjam Pakai"
                                {{ old('status_bangunan') == 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
                            <option value="Lainnya..."
                                {{ old('status_bangunan') == 'Lainnya...' ? 'selected' : '' }}>Lainnya...</option>
                        </select>
                        @error('status_bangunan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="text" id="status_bangunan_lain" name="status_bangunan_lain"
                            class="form-control mt-2 @error('status_bangunan_lain') is-invalid @enderror"
                            placeholder="Tulis status lain..."
                            style="display:{{ old('status_bangunan') == 'Lainnya...' ? 'block' : 'none' }};"
                            value="{{ old('status_bangunan_lain') }}">
                        @error('status_bangunan_lain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label @error('fasilitas_pendukung') text-danger @enderror">
                        <i class="bi bi-wifi"></i>
                        Fasilitas Pendukung <span class="required">*</span>
                    </label><br>
                    @foreach (['Toilet', 'Wastafel', 'Parkir', 'Mushola', 'WiFi', 'Tempat Sampah'] as $f)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="fasilitas_pendukung[]" value="{{ $f }}"
                                class="form-check-input @error('fasilitas_pendukung') is-invalid @enderror"
                                id="fasilitas_{{ $f }}"
                                {{ in_array($f, old('fasilitas_pendukung', [])) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="fasilitas_{{ $f }}">{{ $f }}</label>
                        </div>
                    @endforeach
                    @error('fasilitas_pendukung')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="section-divider"></div>

                <!-- 4. PRAKTIK K3 & SANITASI -->
                <div class="section-title">
                    <i class="bi bi-shield-check"></i>
                    Praktik K3 & Sanitasi
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label @error('pelatihan_k3') text-danger @enderror">
                            <i class="bi bi-clipboard-check"></i>
                            Pelatihan K3 <span class="required">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('pelatihan_k3') is-invalid @enderror"
                                type="radio" name="pelatihan_k3" value="Ya" id="k3_ya"
                                {{ old('pelatihan_k3') == 'Ya' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="k3_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('pelatihan_k3') is-invalid @enderror"
                                type="radio" name="pelatihan_k3" value="Tidak" id="k3_tidak"
                                {{ old('pelatihan_k3') == 'Tidak' ? 'checked' : '' }}>
                            <label class="form-check-label" for="k3_tidak">Tidak</label>
                        </div>
                        @error('pelatihan_k3')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-people"></i>
                            Jumlah Penjamah Makanan <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_penjamah_makanan"
                            class="form-control @error('jumlah_penjamah_makanan') is-invalid @enderror"
                            value="{{ old('jumlah_penjamah_makanan') }}" min="0" required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            contoh : 3
                        </small>
                        @error('jumlah_penjamah_makanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label @error('apd_penjamah_makanan') text-danger @enderror">
                        <i class="bi bi-shield-fill-check"></i>
                        APD Penjamah Makanan <span class="required">*</span>
                    </label><br>
                    @foreach (['Masker', 'Hairnet', 'Celemek', 'Sarung Tangan'] as $apd)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="apd_penjamah_makanan[]" value="{{ $apd }}"
                                class="form-check-input @error('apd_penjamah_makanan') is-invalid @enderror"
                                id="apd_{{ $apd }}"
                                {{ in_array($apd, old('apd_penjamah_makanan', [])) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="apd_{{ $apd }}">{{ $apd }}</label>
                        </div>
                    @endforeach
                    @error('apd_penjamah_makanan')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label @error('prosedur_sanitasi_alat') text-danger @enderror">
                            <i class="bi bi-droplet"></i>
                            Sanitasi Alat Dapur <span class="required">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('prosedur_sanitasi_alat') is-invalid @enderror"
                                type="radio" name="prosedur_sanitasi_alat" value="Tidak Melakukan"
                                id="sanitasi_tidak"
                                {{ old('prosedur_sanitasi_alat') == 'Tidak Melakukan' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="sanitasi_tidak">Tidak Melakukan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('prosedur_sanitasi_alat') is-invalid @enderror"
                                type="radio" name="prosedur_sanitasi_alat" value="Melakukan" id="sanitasi_ya"
                                {{ old('prosedur_sanitasi_alat') == 'Melakukan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="sanitasi_ya">Melakukan</label>
                        </div>
                        @error('prosedur_sanitasi_alat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-clock-history"></i>
                            Frekuensi Sanitasi Alat <span class="required">*</span>
                        </label>
                        <input type="text" name="frekuensi_sanitasi_alat"
                            class="form-control @error('frekuensi_sanitasi_alat') is-invalid @enderror"
                            value="{{ old('frekuensi_sanitasi_alat') }}" maxlength="14" required>
                        <small class="form-text text-muted d-block mt-1">
                            <i class="bi bi-check-circle me-1 text-success"></i>
                            <strong>Melakukan:</strong> Tulis frekuensi (contoh: 2x sehari, 1x seminggu)
                        </small>
                        <small class="form-text text-muted d-block">
                            <i class="bi bi-x-circle me-1 text-danger"></i>
                            <strong>Tidak Melakukan:</strong> Tulis tanda <strong>-</strong> (strip)
                        </small>
                        @error('frekuensi_sanitasi_alat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label @error('prosedur_sanitasi_bahan') text-danger @enderror">
                            <i class="bi bi-droplet"></i>
                            Sanitasi Bahan Makanan <span class="required">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('prosedur_sanitasi_bahan') is-invalid @enderror"
                                type="radio" name="prosedur_sanitasi_bahan" value="Tidak Melakukan"
                                id="sanitasi_bahan_tidak"
                                {{ old('prosedur_sanitasi_bahan') == 'Tidak Melakukan' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="sanitasi_bahan_tidak">Tidak Melakukan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('prosedur_sanitasi_bahan') is-invalid @enderror"
                                type="radio" name="prosedur_sanitasi_bahan" value="Melakukan"
                                id="sanitasi_bahan_ya"
                                {{ old('prosedur_sanitasi_bahan') == 'Melakukan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="sanitasi_bahan_ya">Melakukan</label>
                        </div>
                        @error('prosedur_sanitasi_bahan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-clock-history"></i>
                            Frekuensi Sanitasi Bahan <span class="required">*</span>
                        </label>
                        <input type="text" name="frekuensi_sanitasi_bahan"
                            class="form-control @error('frekuensi_sanitasi_bahan') is-invalid @enderror"
                            placeholder="2 kali sehari atau -" value="{{ old('frekuensi_sanitasi_bahan') }}"
                            maxlength="14" required>
                        <small class="form-text text-muted d-block mt-1">
                            <i class="bi bi-check-circle me-1 text-success"></i>
                            <strong>Melakukan:</strong> Tulis frekuensi (contoh: 2x sehari, 1x seminggu)
                        </small>
                        <small class="form-text text-muted d-block">
                            <i class="bi bi-x-circle me-1 text-danger"></i>
                            <strong>Tidak Melakukan:</strong> Tulis tanda <strong>-</strong> (strip)
                        </small>
                        @error('frekuensi_sanitasi_bahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-thermometer-snow"></i>
                            Penyimpanan Bahan Mentah <span class="required">*</span>
                        </label>
                        <select name="penyimpanan_mentah"
                            class="form-control @error('penyimpanan_mentah') is-invalid @enderror" required>
                            <option value="">-- Pilih Penyimpanan --</option>
                            <option value="Dengan Pendingin, Terpisah"
                                {{ old('penyimpanan_mentah') == 'Dengan Pendingin, Terpisah' ? 'selected' : '' }}>
                                Dengan Pendingin, Terpisah</option>
                            <option value="Dengan Pendingin, Tidak Terpisah"
                                {{ old('penyimpanan_mentah') == 'Dengan Pendingin, Tidak Terpisah' ? 'selected' : '' }}>
                                Dengan Pendingin, Tidak Terpisah</option>
                            <option value="Tanpa Pendingin, Terpisah"
                                {{ old('penyimpanan_mentah') == 'Tanpa Pendingin, Terpisah' ? 'selected' : '' }}>Tanpa
                                Pendingin, Terpisah</option>
                            <option value="Tanpa Pendingin, Tidak Terpisah"
                                {{ old('penyimpanan_mentah') == 'Tanpa Pendingin, Tidak Terpisah' ? 'selected' : '' }}>
                                Tanpa Pendingin, Tidak Terpisah</option>
                        </select>
                        @error('penyimpanan_mentah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-thermometer-snow"></i>
                            Penyimpanan Bahan Matang <span class="required">*</span>
                        </label>
                        <select name="penyimpanan_matang"
                            class="form-control @error('penyimpanan_matang') is-invalid @enderror" required>
                            <option value="">-- Pilih Penyimpanan --</option>
                            <option value="Dengan Pendingin, Terpisah"
                                {{ old('penyimpanan_matang') == 'Dengan Pendingin, Terpisah' ? 'selected' : '' }}>
                                Dengan Pendingin, Terpisah</option>
                            <option value="Dengan Pendingin, Tidak Terpisah"
                                {{ old('penyimpanan_matang') == 'Dengan Pendingin, Tidak Terpisah' ? 'selected' : '' }}>
                                Dengan Pendingin, Tidak Terpisah</option>
                            <option value="Tanpa Pendingin, Terpisah"
                                {{ old('penyimpanan_matang') == 'Tanpa Pendingin, Terpisah' ? 'selected' : '' }}>Tanpa
                                Pendingin, Terpisah</option>
                            <option value="Tanpa Pendingin, Tidak Terpisah"
                                {{ old('penyimpanan_matang') == 'Tanpa Pendingin, Tidak Terpisah' ? 'selected' : '' }}>
                                Tanpa Pendingin, Tidak Terpisah</option>
                        </select>
                        @error('penyimpanan_matang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label @error('fifo_fefo') text-danger @enderror">
                            <i class="bi bi-arrow-repeat"></i>
                            Prinsip FIFO / FEFO <span class="required">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('fifo_fefo') is-invalid @enderror" type="radio"
                                name="fifo_fefo" value="Ya" id="fifo_ya"
                                {{ old('fifo_fefo') == 'Ya' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="fifo_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('fifo_fefo') is-invalid @enderror" type="radio"
                                name="fifo_fefo" value="Tidak" id="fifo_tidak"
                                {{ old('fifo_fefo') == 'Tidak' ? 'checked' : '' }}>
                            <label class="form-check-label" for="fifo_tidak">Tidak</label>
                        </div>
                        @error('fifo_fefo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-trash"></i>
                            Limbah Dapur <span class="required">*</span>
                        </label>
                        <select name="limbah_dapur" class="form-control @error('limbah_dapur') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Limbah --</option>
                            <option value="Dipisah" {{ old('limbah_dapur') == 'Dipisah' ? 'selected' : '' }}>Dipisah
                            </option>
                            <option value="Tidak dipisah"
                                {{ old('limbah_dapur') == 'Tidak dipisah' ? 'selected' : '' }}>Tidak dipisah</option>
                        </select>
                        @error('limbah_dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-wind"></i>
                            Ventilasi Dapur <span class="required">*</span>
                        </label>
                        <select name="ventilasi_dapur"
                            class="form-control @error('ventilasi_dapur') is-invalid @enderror" required>
                            <option value="">-- Pilih Ventilasi --</option>
                            <option value="Alami" {{ old('ventilasi_dapur') == 'Alami' ? 'selected' : '' }}>Alami
                            </option>
                            <option value="Buatan" {{ old('ventilasi_dapur') == 'Buatan' ? 'selected' : '' }}>Buatan
                            </option>
                        </select>
                        @error('ventilasi_dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-house"></i>
                            Dapur <span class="required">*</span>
                        </label>
                        <select name="dapur" class="form-control @error('dapur') is-invalid @enderror" required>
                            <option value="">-- Pilih Dapur --</option>
                            <option value="Ada, terpisah" {{ old('dapur') == 'Ada, terpisah' ? 'selected' : '' }}>
                                Ada, terpisah</option>
                            <option value="Ada, tidak terpisah"
                                {{ old('dapur') == 'Ada, tidak terpisah' ? 'selected' : '' }}>Ada, tidak terpisah
                            </option>
                            <option value="Tidak ada" {{ old('dapur') == 'Tidak ada' ? 'selected' : '' }}>Tidak ada
                            </option>
                        </select>
                        @error('dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="bi bi-water"></i>
                                Sumber Air Cuci <span class="required">*</span>
                            </label>
                            <select name="sumber_air_cuci"
                                class="form-control @error('sumber_air_cuci') is-invalid @enderror" required>
                                <option value="">-- Pilih Sumber --</option>
                                <option value="PDAM" {{ old('sumber_air_cuci') == 'PDAM' ? 'selected' : '' }}>PDAM
                                </option>
                                <option value="Sumur" {{ old('sumber_air_cuci') == 'Sumur' ? 'selected' : '' }}>
                                    Sumur</option>
                                <option value="Air Isi Ulang"
                                    {{ old('sumber_air_cuci') == 'Air Isi Ulang' ? 'selected' : '' }}>Air Isi Ulang
                                </option>
                            </select>
                            @error('sumber_air_cuci')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="bi bi-water"></i>
                                Sumber Air Masak <span class="required">*</span>
                            </label>
                            <select name="sumber_air_masak"
                                class="form-control @error('sumber_air_masak') is-invalid @enderror" required>
                                <option value="">-- Pilih Sumber --</option>
                                <option value="PDAM" {{ old('sumber_air_masak') == 'PDAM' ? 'selected' : '' }}>PDAM
                                </option>
                                <option value="Sumur" {{ old('sumber_air_masak') == 'Sumur' ? 'selected' : '' }}>
                                    Sumur</option>
                                <option value="Air Isi Ulang"
                                    {{ old('sumber_air_masak') == 'Air Isi Ulang' ? 'selected' : '' }}>Air Isi Ulang
                                </option>
                            </select>
                            @error('sumber_air_masak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="bi bi-cup-straw"></i>
                                Sumber Air Minum <span class="required">*</span>
                            </label>
                            <select name="sumber_air_minum"
                                class="form-control @error('sumber_air_minum') is-invalid @enderror" required>
                                <option value="">-- Pilih Sumber --</option>
                                <option value="PDAM" {{ old('sumber_air_minum') == 'PDAM' ? 'selected' : '' }}>PDAM
                                </option>
                                <option value="Sumur" {{ old('sumber_air_minum') == 'Sumur' ? 'selected' : '' }}>
                                    Sumur</option>
                                <option value="Air Isi Ulang"
                                    {{ old('sumber_air_minum') == 'Air Isi Ulang' ? 'selected' : '' }}>Air Isi Ulang
                                </option>
                            </select>
                            @error('sumber_air_minum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- 5. KOORDINAT -->
                    <div class="section-title">
                        <i class="bi bi-geo-alt"></i>
                        Koordinat Lokasi
                    </div>

                    @if ($errors->has('lokasi'))
                        <div class="alert alert-danger mb-3">
                            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Peringatan:</strong>
                            {{ $errors->first('lokasi') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-arrow-left-right"></i>
                                Longitude <span class="required">*</span>
                            </label>
                            <input type="text" name="longitude"
                                class="form-control @error('longitude') is-invalid @enderror"
                                value="{{ old('longitude') }}" step="any" required>
                            <small class="form-text note">Format: 116.8225 (gunakan titik sebagai pemisah
                                desimal)</small>
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-arrow-up-down"></i>
                                Latitude <span class="required">*</span>
                            </label>
                            <input type="text" name="latitude"
                                class="form-control @error('latitude') is-invalid @enderror"
                                value="{{ old('latitude') }}" step="any" required>
                            <small class="form-text note">Format: -3.3211 (gunakan titik sebagai pemisah
                                desimal)</small>
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- 6. FOTO -->
                    <div class="section-title">
                        <i class="bi bi-camera"></i>
                        Foto Kuliner
                    </div>

                    <div class="mb-4">
                        <div class="file-upload-wrapper @error('foto') is-invalid @enderror" id="fileUploadWrapper">
                            <input type="file" name="foto[]" multiple accept="image/*" id="fileInput"
                                style="display:none;" required>
                            <div class="file-upload-icon">
                                <i class="bi bi-cloud-upload" style="font-size: 48px; color: #2e7d32;"></i>
                            </div>
                            <div class="file-upload-text"
                                style="font-size: 18px; font-weight: 600; color: #1b5e20; margin-top: 15px;">
                                Klik untuk upload foto atau drag & drop
                            </div>
                            <div class="file-upload-hint" style="font-size: 14px; color: #666; margin-top: 10px;">
                                Format: JPG, PNG, JPEG | Maksimal: 2MB per file | Minimal 1 foto <span
                                    class="required">*</span>
                            </div>
                        </div>
                        @error('foto')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('foto.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="selected-files" id="selectedFiles"></div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="button-group">
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-circle-fill"></i>
                            Simpan Data
                        </button>
                        <a href="{{ route('kuliner.index') }}" class="btn-cancel">
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

            // ============================================================================
            // 1. SERTIFIKAT "LAINNYA" - FIXED VERSION
            // ============================================================================
            const sertifikatChecks = document.querySelectorAll(".sertifikat-check");
            const sertifikatText = document.getElementById("sertifikat_text");

            // Fungsi untuk toggle visibility textbox
            function toggleSertifikatText() {
                const isOtherChecked = Array.from(sertifikatChecks).some(chk =>
                    chk.value === "Lainnya" && chk.checked
                );

                if (sertifikatText) {
                    sertifikatText.style.display = isOtherChecked ? "block" : "none";

                    // Clear value jika di-uncheck
                    if (!isOtherChecked) {
                        sertifikatText.value = "";
                    }
                }
            }

            // Jalankan saat halaman load (untuk handle old() values)
            toggleSertifikatText();

            // Attach event listener ke semua checkbox
            sertifikatChecks.forEach(checkbox => {
                checkbox.addEventListener("change", toggleSertifikatText);
            });

            // ============================================================================
            // 2. STATUS BANGUNAN "LAINNYA" - FIXED VERSION
            // ============================================================================
            const statusSelect = document.getElementById("statusBangunanSelect");
            const statusLain = document.getElementById("status_bangunan_lain");

            function toggleStatusLain() {
                if (statusSelect && statusLain) {
                    if (statusSelect.value === "Lainnya...") {
                        statusLain.style.display = "block";
                    } else {
                        statusLain.style.display = "none";
                        statusLain.value = "";
                    }
                }
            }

            // Jalankan saat load
            toggleStatusLain();

            // Event listener
            if (statusSelect) {
                statusSelect.addEventListener("change", toggleStatusLain);
            }

            // ============================================================================
            // 3. JAM OPERASIONAL - LIBUR CHECKBOX (FIXED VERSION)
            // ============================================================================
            const operasionalRows = document.querySelectorAll("table tbody tr"); // ← GANTI NAMA

            operasionalRows.forEach(row => {
                const checkbox = row.querySelector('.libur-checkbox');
                const timeInputs = row.querySelectorAll('input[type="time"]');
                if (!checkbox) return;

                // Store default values
                const defaultValues = Array.from(timeInputs).map(input => input.value || '');

                // Apply initial state for checked libur
                if (checkbox.checked) {
                    timeInputs.forEach(input => {
                        input.value = '00:00';
                        input.readOnly = true;
                        input.style.background = '#f5f5f5';
                        input.style.cursor = 'not-allowed';
                        input.style.pointerEvents = 'none';
                    });
                    row.style.opacity = '0.5';
                }

                // Handle checkbox change
                checkbox.addEventListener("change", () => {
                    if (checkbox.checked) {
                        // LIBUR: Set 00:00
                        timeInputs.forEach(input => {
                            input.value = '00:00';
                            input.readOnly = true;
                            input.style.background = '#f5f5f5';
                            input.style.cursor = 'not-allowed';
                            input.style.pointerEvents = 'none';
                        });
                        row.style.opacity = '0.5';
                    } else {
                        // BUKA: Reset ke jam normal
                        timeInputs.forEach((input, idx) => {
                            input.readOnly = false;
                            input.style.background = '';
                            input.style.cursor = '';
                            input.style.pointerEvents = '';

                            // Restore default atau set default values
                            if (idx === 0) input.value = defaultValues[idx] ||
                                '08:00'; // jam_buka
                            else if (idx === 1) input.value = defaultValues[idx] ||
                                '21:00'; // jam_tutup
                            else input.value = defaultValues[idx] ||
                                ''; // jam sibuk (opsional)
                        });
                        row.style.opacity = '1';
                    }
                });
            });

            // ============================================================================
            // 4. VALIDASI SEBELUM SUBMIT FORM
            // ============================================================================
            const form = document.getElementById('kulinerForm');
            const loadingOverlay = document.getElementById('loadingOverlay');

            if (form) {
                form.addEventListener('submit', function(e) {
                    const tableRows = document.querySelectorAll(
                        '.table-operasional tbody tr'); // ← GANTI NAMA
                    let hasInvalidTime = false;
                    let errorMessage = '';

                    tableRows.forEach((row, index) => {
                        const liburCheckbox = row.querySelector('.libur-checkbox');

                        // Skip jika hari libur
                        if (liburCheckbox && liburCheckbox.checked) {
                            return;
                        }

                        const jamBuka = row.querySelector('input[name="jam_buka[' + index + ']"]')
                            ?.value;
                        const jamTutup = row.querySelector('input[name="jam_tutup[' + index + ']"]')
                            ?.value;
                        const jamSibukMulai = row.querySelector('input[name="jam_sibuk_mulai[' +
                            index + ']"]')?.value;
                        const jamSibukSelesai = row.querySelector('input[name="jam_sibuk_selesai[' +
                            index + ']"]')?.value;
                        const hari = row.querySelector('input[name="hari[' + index + ']"]')?.value;

                        // Validasi jam kosong
                        if (!jamBuka || !jamTutup) {
                            hasInvalidTime = true;
                            errorMessage = `Jam buka dan tutup pada hari ${hari} harus diisi!`;
                            return;
                        }

                        // Validasi jam tutup harus > jam buka
                        if (jamTutup <= jamBuka) {
                            hasInvalidTime = true;
                            errorMessage =
                                `Jam tutup pada hari ${hari} harus lebih besar dari jam buka!\n\nBuka: ${jamBuka}\nTutup: ${jamTutup}`;
                            return;
                        }

                        // Validasi jam sibuk mulai (harus antara jam buka dan tutup)
                        if (jamSibukMulai && (jamSibukMulai < jamBuka || jamSibukMulai >=
                                jamTutup)) {
                            hasInvalidTime = true;
                            errorMessage =
                                `Jam sibuk mulai pada hari ${hari} harus antara jam buka (${jamBuka}) dan tutup (${jamTutup})!`;
                            return;
                        }

                        // Validasi jam sibuk selesai
                        if (jamSibukSelesai) {
                            if (jamSibukSelesai <= jamBuka || jamSibukSelesai > jamTutup) {
                                hasInvalidTime = true;
                                errorMessage =
                                    `Jam sibuk selesai pada hari ${hari} harus antara jam buka (${jamBuka}) dan tutup (${jamTutup})!`;
                                return;
                            }

                            if (jamSibukMulai && jamSibukSelesai <= jamSibukMulai) {
                                hasInvalidTime = true;
                                errorMessage =
                                    `Jam sibuk selesai pada hari ${hari} harus lebih besar dari jam sibuk mulai!`;
                                return;
                            }
                        }

                        // Validasi jika salah satu jam sibuk diisi, yang lain juga harus diisi
                        if ((jamSibukMulai && !jamSibukSelesai) || (!jamSibukMulai &&
                                jamSibukSelesai)) {
                            hasInvalidTime = true;
                            errorMessage =
                                `Jam sibuk mulai dan selesai pada hari ${hari} harus diisi keduanya atau kosong keduanya!`;
                            return;
                        }

                        if (!hasInvalidTime) {
                            loadingOverlay.classlist.add('active');
                        }
                    });

                    if (hasInvalidTime) {
                        e.preventDefault();
                        alert('⚠️ ' + errorMessage);

                        // Scroll ke section jam operasional
                        document.querySelector('.table-operasional').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        return false;
                    }
                });
            }

            // Scroll to first error on page load
            const firstError = document.querySelector('.is-invalid, .error-summary');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });

        // ============================================================================
        // 5. FILE UPLOAD HANDLER (DI LUAR DOMContentLoaded)
        // ============================================================================
        const fileInput = document.getElementById('fileInput');
        const selectedFilesContainer = document.getElementById('selectedFiles');
        const uploadWrapper = document.getElementById('fileUploadWrapper');
        let selectedFiles = [];

        uploadWrapper.addEventListener('click', function() {
            fileInput.click();
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
    </script>
</body>

</html>
