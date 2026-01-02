<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wisata->nama_wisata }} - Detail Wisata</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            line-height: 1.6;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 400px;
            background: linear-gradient(135deg, rgba(27, 94, 32, 0.9), rgba(46, 125, 50, 0.9));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-bottom: -50px;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset('images/bg-view.png') }}') center/cover;
            opacity: 0.2;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 0 2rem;
        }

        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-badges {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        .badge-hero {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Container */
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Card Sections */
        .detail-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #1b5e20;
            border-bottom: 3px solid #1b5e20;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .card-title i {
            font-size: 32px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .info-label {
            font-weight: 600;
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #333;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.6;
        }

        /* Table */
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 12px;
        }

        .table-modern thead {
            background: linear-gradient(135deg, #1b5e20, #2e7d32);
            color: white;
        }

        .table-modern th {
            padding: 1rem;
            font-weight: 600;
            text-align: center;
            font-size: 14px;
        }

        .table-modern td {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
        }

        .table-modern tbody tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
        }

        .status-buka {
            background: #d4edda;
            color: #155724;
        }

        .status-libur {
            background: #f8d7da;
            color: #721c24;
        }

        /* Photos Grid */
        .photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .photo-item {
            position: relative;
            padding-bottom: 75%;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .photo-item:hover {
            transform: scale(1.05);
        }

        .photo-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Tags */
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-top: 0.5rem;
        }

        .tag {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Back Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #1b5e20, #2e7d32);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 2rem auto;
            box-shadow: 0 5px 15px rgba(27, 94, 32, 0.3);
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(27, 94, 32, 0.4);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 32px;
            }

            .card-title {
                font-size: 22px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .detail-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>{{ $wisata->nama_wisata }}</h1>
            <div class="hero-badges">
                @forelse($wisata->kategoriAktif as $kat)
                    <span class="badge-hero">
                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $kat->nama_kategori }}
                    </span>
                @empty
                    <span class="badge-hero">
                        <i class="bi bi-geo-alt-fill me-1"></i>Wisata
                    </span>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-custom" style="padding-top: 70px; padding-bottom: 50px;">

        <!-- Informasi Umum -->
        <div class="detail-card">
            <h2 class="card-title">
                <i class="bi bi-info-circle"></i>
                Informasi Umum
            </h2>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nama Tempat Wisata</span>
                    <span class="info-value">{{ $wisata->nama_wisata ?? '-' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Kategori Wisata</span>
                    <div class="tags-container">
                        @forelse ($wisata->kategoriAktif as $k)
                            <span class="tag">
                                <i class="bi bi-bookmark-star-fill"></i>{{ $k->nama_kategori }}
                            </span>
                        @empty
                            <span class="text-muted">-</span>
                        @endforelse
                    </div>
                </div>

                <div class="info-item">
                    <span class="info-label">Alamat Lengkap</span>
                    <span class="info-value">{{ $wisata->alamat_lengkap ?? '-' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Koordinat</span>
                    <span class="info-value">
                        @if ($wisata->latitude && $wisata->longitude)
                            <i class="bi bi-geo-alt-fill me-1"></i>
                            {{ number_format($wisata->latitude, 6) }}, {{ number_format($wisata->longitude, 6) }}
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>

            <hr style="margin: 2rem 0; border-color: #e0e0e0;">

            <div class="info-item">
                <span class="info-label">Deskripsi</span>
                <span class="info-value">{{ $wisata->deskripsi ?? '-' }}</span>
            </div>

            @if ($wisata->sejarah)
                <div class="info-item mt-3">
                    <span class="info-label">Sejarah</span>
                    <span class="info-value">{{ $wisata->sejarah }}</span>
                </div>
            @endif

            @if ($wisata->narasi)
                <div class="info-item mt-3">
                    <span class="info-label">Narasi</span>
                    <span class="info-value">{{ $wisata->narasi }}</span>
                </div>
            @endif
        </div>

        <!-- Jam Operasional -->
        <div class="detail-card">
            <h2 class="card-title">
                <i class="bi bi-clock"></i>
                Jam Operasional
            </h2>
            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wisata->jamOperasionalAdmin as $jam)
                            <tr>
                                <td><strong>{{ $jam->hari }}</strong></td>
                                <td>{{ $jam->jam_buka ? $jam->jam_buka->format('H:i') : '-' }}</td>
                                <td>{{ $jam->jam_tutup ? $jam->jam_tutup->format('H:i') : '-' }}</td>
                                <td>
                                    @if ($jam->libur || !$jam->jam_buka)
                                        <span class="status-badge status-libur">Libur</span>
                                    @else
                                        <span class="status-badge status-buka">Buka</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">Belum ada data jam operasional</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Foto Gallery -->
        <div class="detail-card">
            <h2 class="card-title">
                <i class="bi bi-images"></i>
                Galeri Foto
            </h2>
            <div class="photos-grid">
                @forelse ($wisata->foto as $foto)
                    <div class="photo-item">
                        <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Foto {{ $wisata->nama_wisata }}">
                    </div>
                @empty
                    <p class="text-muted">Belum ada foto untuk tempat wisata ini.</p>
                @endforelse
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="back-btn">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Kembali ke Halaman Utama
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
