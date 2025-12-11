<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $wisata->nama_wisata }} - Kotabaru Tourism</title>
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
            background: linear-gradient(135deg, rgba(27, 94, 32, 0.95) 0%, rgba(46, 125, 50, 0.95) 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin: 0 0 1rem 0;
        }

        .breadcrumb-custom a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-custom a:hover {
            color: #ffd54f;
        }

        .breadcrumb-custom .active {
            color: white;
        }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            margin: 0;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        /* Hero Image Section */
        .hero-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
        }

        .hero-placeholder {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, #c8e6c9 0%, #e8f5e9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2e7d32;
            font-size: 80px;
        }

        .content-wrapper {
            padding: 2.5rem;
        }

        /* Badge Categories */
        .category-badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .badge-category {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Section Styling */
        .detail-section {
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #e8f5e9;
        }

        .detail-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            font-size: 32px;
            color: #2e7d32;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid #2e7d32;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .info-item:hover {
            background: #e8f5e9;
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .info-label {
            font-weight: 600;
            color: #2e7d32;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-label i {
            font-size: 16px;
        }

        .info-value {
            background: #f1f8f4;
            color: #1b5e20;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #c8e6c9;
        }

        /* Description Box */
        .description-box {
            background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f4 100%);
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid #2e7d32;
            margin-bottom: 1.5rem;
        }

        .description-box h5 {
            color: #1b5e20;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .description-box p {
            color: #333;
            line-height: 1.8;
            margin: 0;
        }

        /* Jam Operasional Table */
        .schedule-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .schedule-table table {
            width: 100%;
            margin: 0;
        }

        .schedule-table thead {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
        }

        .schedule-table th {
            padding: 14px;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            border: none;
        }

        .schedule-table td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #e8f5e9;
            color: #333;
        }

        .schedule-table tbody tr:hover {
            background: #f1f8f4;
        }

        .schedule-table tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-open {
            background: #c8e6c9;
            color: #1b5e20;
        }

        .status-closed {
            background: #ffcdd2;
            color: #c62828;
        }

        .day-name {
            font-weight: 600;
            color: #1b5e20;
        }

        /* Photo Gallery */
        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .photo-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .photo-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .photo-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        .photo-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .photo-item:hover .photo-overlay {
            opacity: 1;
        }

        .photo-number {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(46, 125, 50, 0.95);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .empty-gallery {
            text-align: center;
            padding: 3rem;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .empty-gallery i {
            font-size: 60px;
            color: #c8e6c9;
            margin-bottom: 1rem;
        }

        .empty-gallery p {
            color: #999;
            margin: 0;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-custom {
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
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

        .btn-edit {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 152, 0, 0.4);
            color: white;
        }

        .btn-map {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        }

        .btn-map:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
            color: white;
        }

        /* Stats Mini Cards */
        .mini-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .mini-stat-card {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            text-align: center;
            border: 2px solid #e8f5e9;
            transition: all 0.3s ease;
        }

        .mini-stat-card:hover {
            border-color: #2e7d32;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.1);
        }

        .mini-stat-icon {
            font-size: 28px;
            color: #2e7d32;
            margin-bottom: 0.5rem;
        }

        .mini-stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 0.25rem;
        }

        .mini-stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-title {
                font-size: 28px;
            }

            .hero-image,
            .hero-placeholder {
                height: 250px;
            }

            .content-wrapper {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 22px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .photo-gallery {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }
        }

        /* Lightbox for Images */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 12px;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .lightbox-close:hover {
            color: #ffd54f;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <nav class="breadcrumb-custom">
                <a href="{{ route('wisata.index') }}">
                    <i class="bi bi-house-door"></i> Daftar Wisata
                </a>
                <span class="mx-2">/</span>
                <span class="active">{{ $wisata->nama_wisata }}</span>
            </nav>
            <h1 class="header-title">
                <i class="bi bi-geo-alt-fill me-2"></i>{{ $wisata->nama_wisata }}
            </h1>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="main-container">

            <!-- Hero Image -->
            @if($wisata->foto->count() > 0)
                <img src="{{ asset('storage/' . $wisata->foto->first()->path_foto) }}"
                     alt="{{ $wisata->nama_wisata }}"
                     class="hero-image">
            @else
                <div class="hero-placeholder">
                    <i class="bi bi-image"></i>
                </div>
            @endif

            <!-- Content Wrapper -->
            <div class="content-wrapper">

                <!-- Kategori Badges -->
                <div class="category-badges">
                    @forelse ($wisata->kategori as $k)
                        <span class="badge-category">
                            <i class="bi bi-tag-fill"></i>
                            {{ $k->nama_kategori }}
                        </span>
                    @empty
                        <span class="badge-category">
                            <i class="bi bi-tag-fill"></i>
                            Tidak ada kategori
                        </span>
                    @endforelse
                </div>

                <!-- Section: Deskripsi -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-file-text-fill"></i>
                        Deskripsi
                    </div>
                    <div class="description-box">
                        <p>{{ $wisata->deskripsi ?? 'Belum ada deskripsi untuk tempat wisata ini.' }}</p>
                    </div>
                </div>

                <!-- Section: Sejarah & Narasi -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-book-fill"></i>
                        Sejarah & Informasi
                    </div>

                    <div class="description-box">
                        <h5><i class="bi bi-clock-history"></i> Sejarah</h5>
                        <p>{{ $wisata->sejarah ?? 'Belum ada informasi sejarah.' }}</p>
                    </div>

                    <div class="description-box">
                        <h5><i class="bi bi-mic-fill"></i> Narasi Audio Guide</h5>
                        <p>{{ $wisata->narasi ?? 'Belum ada narasi audio guide.' }}</p>
                    </div>
                </div>

                <!-- Section: Lokasi -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-map-fill"></i>
                        Koordinat Lokasi
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-arrow-up-down"></i>
                                Latitude
                            </div>
                            <div class="info-value">{{ $wisata->latitude ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-arrow-left-right"></i>
                                Longitude
                            </div>
                            <div class="info-value">{{ $wisata->longitude ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Section: Jam Operasional -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-clock-fill"></i>
                        Jam Operasional
                    </div>
                    <div class="schedule-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam Buka</th>
                                    <th>Jam Tutup</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wisata->jamOperasional as $jam)
                                    <tr>
                                        <td class="day-name">{{ $jam->hari }}</td>
                                        <td>{{ $jam->jam_buka ?? '-' }}</td>
                                        <td>{{ $jam->jam_tutup ?? '-' }}</td>
                                        <td>
                                            @if (($jam->jam_buka == '00:00' && $jam->jam_tutup == '00:00') || !$jam->jam_buka)
                                                <span class="status-badge status-closed">
                                                    <i class="bi bi-x-circle"></i> Libur
                                                </span>
                                            @else
                                                <span class="status-badge status-open">
                                                    <i class="bi bi-check-circle"></i> Buka
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Belum ada data jam operasional</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section: Galeri Foto -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-images"></i>
                        Galeri Foto ({{ $wisata->foto->count() }})
                    </div>
                    @if($wisata->foto->count() > 0)
                        <div class="photo-gallery">
                            @foreach ($wisata->foto as $index => $foto)
                                <div class="photo-item" onclick="openLightbox('{{ asset('storage/' . $foto->path_foto) }}')">
                                    <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                         alt="Foto {{ $wisata->nama_wisata }} {{ $index + 1 }}">
                                    <div class="photo-number">Foto {{ $index + 1 }}</div>
                                    <div class="photo-overlay">
                                        <small style="color: white; font-size: 12px;">
                                            <i class="bi bi-zoom-in"></i> Klik untuk memperbesar
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-gallery">
                            <i class="bi bi-image"></i>
                            <p>Belum ada foto untuk tempat wisata ini</p>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('wisata.index') }}" class="btn-custom btn-back">
                        <i class="bi bi-arrow-left-circle"></i>
                        Kembali ke Daftar
                    </a>
                    <a href="https://www.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}"
                       target="_blank" class="btn-custom btn-map">
                        <i class="bi bi-pin-map-fill"></i>
                        Lihat di Google Maps
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Lightbox for Images -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close">&times;</span>
        <img src="" alt="Preview" id="lightboxImage">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openLightbox(imageSrc) {
            document.getElementById('lightbox').classList.add('active');
            document.getElementById('lightboxImage').src = imageSrc;
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close lightbox on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
</body>

</html>
