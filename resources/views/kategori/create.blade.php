<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori Wisata - Kotabaru Tourism</title>
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
            padding: 3rem;
            border-radius: 25px;
            max-width: 700px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e8f5e9;
        }

        .section-title i {
            font-size: 28px;
            color: #2e7d32;
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

        .form-control {
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .form-control:hover {
            border-color: #66bb6a;
        }

        .form-text {
            font-size: 12px;
            color: #666;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-text i {
            color: #2e7d32;
            font-size: 14px;
        }

        .info-box {
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f4 100%);
            border-left: 4px solid #2e7d32;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 2rem;
        }

        .info-box h6 {
            color: #1b5e20;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box ul {
            margin: 0;
            padding-left: 1.5rem;
            color: #333;
        }

        .info-box li {
            margin-bottom: 0.5rem;
            font-size: 14px;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
        }

        .btn-custom {
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-back {
            background: white;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .btn-back:hover {
            background: #f5f5f5;
            border-color: #ccc;
            transform: translateY(-2px);
            color: #666;
        }

        .btn-submit {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
            background: linear-gradient(135deg, #388e3c 0%, #43a047 100%);
            color: white;
        }

        .invalid-feedback {
            display: block;
            color: #d32f2f;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
        }

        .invalid-feedback i {
            margin-right: 5px;
        }

        .form-control.is-invalid {
            border-color: #d32f2f;
            background-color: #ffebee;
        }

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
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 2rem;
            }

            .header-section h1 {
                font-size: 32px;
            }

            .section-title {
                font-size: 20px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }
        }

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

        /* Examples Box */
        .examples-box {
            background: white;
            border: 2px solid #e8f5e9;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .examples-box h6 {
            color: #2e7d32;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .example-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .example-tag {
            background: #e8f5e9;
            color: #1b5e20;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid #c8e6c9;
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div style="color: #1b5e20; font-weight: 600;">Menyimpan kategori...</div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <h1><i class="bi bi-plus-circle-fill me-2"></i>Tambah Kategori Wisata</h1>
            <p>Buat kategori baru untuk mengklasifikasikan tempat wisata</p>
        </div>
    </div>

    <!-- Form Container -->
    <div class="container">
        <div class="form-container">

            <!-- Section Title -->
            <div class="section-title">
                <i class="bi bi-tags-fill"></i>
                Informasi Kategori
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <h6><i class="bi bi-info-circle-fill"></i> Petunjuk</h6>
                <ul>
                    <li>Gunakan nama yang <strong>deskriptif</strong> dan mudah dipahami</li>
                    <li>Kategori akan digunakan untuk <strong>mengelompokkan</strong> tempat wisata</li>
                    <li>Satu tempat wisata dapat memiliki <strong>lebih dari satu</strong> kategori</li>
                </ul>
            </div>

            <form method="POST" action="{{ route('kategori-wisata.store') }}" id="kategoriForm">
                @csrf

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-tag-fill"></i>
                        Nama Kategori Wisata
                        <span class="required">*</span>
                    </label>
                    <input type="text"
                           name="nama_kategori"
                           class="form-control @error('nama_kategori') is-invalid @enderror"
                           value="{{ old('nama_kategori') }}"
                           required
                           autofocus>
                    @error('nama_kategori')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror

                    <div class="form-text">
                        <i class="bi bi-lightbulb"></i>
                        Masukkan nama kategori yang jelas dan spesifik
                    </div>

                    <!-- Examples Box -->
                    <div class="examples-box">
                        <h6><i class="bi bi-stars"></i> Contoh Kategori:</h6>
                        <div class="example-tags">
                            <span class="example-tag">Wisata Alam</span>
                            <span class="example-tag">Wisata Sejarah</span>
                            <span class="example-tag">Wisata Budaya</span>
                            <span class="example-tag">Wisata Religi</span>
                            <span class="example-tag">Wisata Edukasi</span>
                            <span class="example-tag">Wisata Kuliner</span>
                            <span class="example-tag">Wisata Belanja</span>
                            <span class="example-tag">Wisata Petualangan</span>
                        </div>
                    </div>
                </div>

                <!-- Button Group -->
                <div class="button-group">
                    <a href="{{ route('kategori-wisata.index') }}" class="btn-custom btn-back">
                        <i class="bi bi-arrow-left-circle"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn-custom btn-submit">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Kategori
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form Submit with Loading
        const form = document.getElementById('kategoriForm');
        const loadingOverlay = document.getElementById('loadingOverlay');

        form.addEventListener('submit', function(e) {
            // Basic validation
            const namaKategori = document.querySelector('[name="nama_kategori"]').value.trim();

            if (namaKategori.length < 3) {
                e.preventDefault();
                alert('❌ Nama kategori minimal 3 karakter!');
                return false;
            }

            if (namaKategori.length > 50) {
                e.preventDefault();
                alert('❌ Nama kategori maksimal 50 karakter!');
                return false;
            }

            // Show loading
            loadingOverlay.classList.add('active');
        });

        // Remove validation error on input
        document.querySelector('[name="nama_kategori"]').addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const feedback = this.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.style.display = 'none';
            }
        });

        // Auto-capitalize first letter
        document.querySelector('[name="nama_kategori"]').addEventListener('blur', function() {
            if (this.value) {
                this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
            }
        });
    </script>
</body>

</html>
