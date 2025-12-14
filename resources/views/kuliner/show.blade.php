<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $kuliner->nama_sentra }} - Kotabaru Tourism</title>
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

        /* Full Width Info Item */
        .info-item-full {
            grid-column: 1 / -1;
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

            .schedule-table {
                overflow-x: auto;
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
                <a href="{{ route('kuliner.index') }}">
                    <i class="bi bi-house-door"></i> Daftar Kuliner
                </a>
                <span class="mx-2">/</span>
                <span class="active">{{ $kuliner->nama_sentra }}</span>
            </nav>
            <h1 class="header-title">
                <i class="bi bi-cup-hot-fill me-2"></i>{{ $kuliner->nama_sentra }}
            </h1>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="main-container">

            <!-- Hero Image -->
            @if($kuliner->foto->count() > 0)
                <img src="{{ asset('storage/' . $kuliner->foto->first()->path_foto) }}"
                     alt="{{ $kuliner->nama_sentra }}"
                     class="hero-image">
            @else
                <div class="hero-placeholder">
                    <i class="bi bi-cup-hot"></i>
                </div>
            @endif

            <!-- Content Wrapper -->
            <div class="content-wrapper">

                <!-- Kategori Badges -->
                <div class="category-badges">
                    @php
                        $kategori = json_decode($kuliner->kategori, true);
                        $kategori = is_array($kategori) ? $kategori : [];
                    @endphp
                    @forelse ($kategori as $k)
                        <span class="badge-category">
                            <i class="bi bi-tag-fill"></i>
                            {{ $k }}
                        </span>
                    @empty
                        <span class="badge-category">
                            <i class="bi bi-tag-fill"></i>
                            Tidak ada kategori
                        </span>
                    @endforelse
                </div>

                <!-- Section: Identitas Usaha -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-building-fill"></i>
                        Identitas Usaha
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-shop"></i>
                                Nama Usaha
                            </div>
                            <div class="info-value">{{ $kuliner->nama_sentra ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-calendar-check"></i>
                                Tahun Berdiri
                            </div>
                            <div class="info-value">{{ $kuliner->tahun_berdiri ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-person-fill"></i>
                                Nama Pemilik
                            </div>
                            <div class="info-value">{{ $kuliner->nama_pemilik ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-key-fill"></i>
                                Status Kepemilikan
                            </div>
                            <div class="info-value">{{ $kuliner->kepemilikan ?? '-' }}</div>
                        </div>
                        <div class="info-item info-item-full">
                            <div class="info-label">
                                <i class="bi bi-geo-alt-fill"></i>
                                Alamat Lengkap
                            </div>
                            <div class="info-value">{{ $kuliner->alamat_lengkap ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-telephone-fill"></i>
                                Nomor Telepon
                            </div>
                            <div class="info-value">{{ $kuliner->telepon ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-envelope-fill"></i>
                                Email
                            </div>
                            <div class="info-value">{{ $kuliner->email ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-card-text"></i>
                                No. NIB
                            </div>
                            <div class="info-value">{{ $kuliner->no_nib ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Section: Informasi Operasional -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-info-circle-fill"></i>
                        Informasi Operasional
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-people-fill"></i>
                                Jumlah Pegawai
                            </div>
                            <div class="info-value">{{ $kuliner->jumlah_pegawai ?? '-' }} orang</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-chair-fill"></i>
                                Jumlah Kursi
                            </div>
                            <div class="info-value">{{ $kuliner->jumlah_kursi ?? '-' }} kursi</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-shop-window"></i>
                                Jumlah Gerai
                            </div>
                            <div class="info-value">{{ $kuliner->jumlah_gerai ?? '-' }} gerai</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-graph-up"></i>
                                Pelanggan per Hari
                            </div>
                            <div class="info-value">{{ $kuliner->jumlah_pelanggan_per_hari ?? '-' }} orang</div>
                        </div>
                        <div class="info-item info-item-full">
                            <div class="info-label">
                                <i class="bi bi-award-fill"></i>
                                Sertifikat
                            </div>
                            <div class="info-value">
                                @php
                                    $sertifikat_lain = json_decode($kuliner->sertifikat_lain, true);
                                    $sertifikat_lain = is_array($sertifikat_lain) ? $sertifikat_lain : [];
                                @endphp
                                {{ implode(', ', $sertifikat_lain) ?: '-' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-person-badge"></i>
                                Profil Pelanggan
                            </div>
                            <div class="info-value">
                                @php
                                    $profil_pelanggan = json_decode($kuliner->profil_pelanggan, true);
                                    $profil_pelanggan = is_array($profil_pelanggan) ? $profil_pelanggan : [];
                                @endphp
                                {{ implode(', ', $profil_pelanggan) ?: '-' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-credit-card-fill"></i>
                                Metode Pembayaran
                            </div>
                            <div class="info-value">
                                @php
                                    $metode_pembayaran = json_decode($kuliner->metode_pembayaran, true);
                                    $metode_pembayaran = is_array($metode_pembayaran) ? $metode_pembayaran : [];
                                @endphp
                                {{ implode(', ', $metode_pembayaran) ?: '-' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-receipt"></i>
                                Pajak Retribusi
                            </div>
                            <div class="info-value">{{ $kuliner->pajak_retribusi ? 'Ya' : 'Tidak' }}</div>
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
                                    <th>Jam Sibuk</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kuliner->jamOperasional as $jam)
                                    <tr>
                                        <td class="day-name">{{ $jam->hari }}</td>
                                        <td>{{ $jam->jam_buka ?? '-' }}</td>
                                        <td>{{ $jam->jam_tutup ?? '-' }}</td>
                                        <td>
                                            @if($jam->jam_sibuk_mulai && $jam->jam_sibuk_selesai)
                                                {{ $jam->jam_sibuk_mulai }} - {{ $jam->jam_sibuk_selesai }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$jam->jam_buka || $jam->jam_buka == '-')
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
                                        <td colspan="5">Belum ada data jam operasional</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section: Jenis Kuliner -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-card-list"></i>
                        Jenis Kuliner
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-star-fill"></i>
                                Menu Unggulan
                            </div>
                            <div class="info-value">{{ $kuliner->menu_unggulan ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-basket-fill"></i>
                                Bahan Baku Utama
                            </div>
                            <div class="info-value">{{ $kuliner->bahan_baku_utama ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-truck"></i>
                                Sumber Bahan Baku
                            </div>
                            <div class="info-value">{{ $kuliner->sumber_bahan_baku ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-book-fill"></i>
                                Menu Bersifat
                            </div>
                            <div class="info-value">
                                @php
                                    $menu_bersifat = json_decode($kuliner->menu_bersifat, true);
                                    $menu_bersifat = is_array($menu_bersifat) ? $menu_bersifat : [];
                                @endphp
                                {{ implode(', ', $menu_bersifat) ?: '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Tempat & Fasilitas -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-shop"></i>
                        Tempat & Fasilitas
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-building"></i>
                                Bentuk Fisik
                            </div>
                            <div class="info-value">{{ $kuliner->bentuk_fisik ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-house-door-fill"></i>
                                Status Bangunan
                            </div>
                            <div class="info-value">{{ $kuliner->status_bangunan ?? '-' }}</div>
                        </div>
                        <div class="info-item info-item-full">
                            <div class="info-label">
                                <i class="bi bi-gear-fill"></i>
                                Fasilitas Pendukung
                            </div>
                            <div class="info-value">
                                @php
                                    $fasilitas = is_array($kuliner->fasilitas_pendukung)
                                        ? $kuliner->fasilitas_pendukung
                                        : (json_decode($kuliner->fasilitas_pendukung, true) ?: []);
                                @endphp
                                {{ implode(', ', $fasilitas) ?: '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: K3 & Sanitasi -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-shield-check"></i>
                        Praktik K3 & Sanitasi
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-clipboard-check"></i>
                                Pelatihan K3
                            </div>
                            <div class="info-value">{{ $kuliner->pelatihan_k3_penjamah ? 'Ya' : 'Tidak' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-people"></i>
                                Jumlah Penjamah Makanan
                            </div>
                            <div class="info-value">{{ $kuliner->jumlah_penjamah_makanan ?? '-' }} orang</div>
                        </div>
                        <div class="info-item info-item-full">
                            <div class="info-label">
                                <i class="bi bi-shield-fill-check"></i>
                                APD Penjamah Makanan
                            </div>
                            <div class="info-value">
                                @php
                                    $apd = json_decode($kuliner->apd_penjamah_makanan, true);
                                    $apd = is_array($apd) ? $apd : [];
                                @endphp
                                {{ implode(', ', $apd) ?: '-' }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-droplet-fill"></i>
                                Prosedur Sanitasi Alat
                            </div>
                            <div class="info-value">{{ $kuliner->prosedur_sanitasi_alat ? 'Melakukan' : 'Tidak Melakukan' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-clock-history"></i>
                                Frekuensi Sanitasi Alat
                            </div>
                            <div class="info-value">{{ $kuliner->frekuensi_sanitasi_alat ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-droplet-half"></i>
                                Prosedur Sanitasi Bahan
                            </div>
                            <div class="info-value">{{ $kuliner->prosedur_sanitasi_bahan ? 'Melakukan' : 'Tidak Melakukan' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-alarm"></i>
                                Frekuensi Sanitasi Bahan
                            </div>
                            <div class="info-value">{{ $kuliner->frekuensi_sanitasi_bahan ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-box-seam"></i>
                                Penyimpanan Bahan Mentah
                            </div>
                            <div class="info-value">{{ $kuliner->penyimpanan_mentah ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-box-seam-fill"></i>
                                Penyimpanan Bahan Matang
                            </div>
                            <div class="info-value">{{ $kuliner->penyimpanan_matang ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-arrow-repeat"></i>
                                Prinsip FIFO / FEFO
                            </div>
                            <div class="info-value">{{ $kuliner->prinsip_fifo_fefo ? 'Ya' : 'Tidak' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-trash"></i>
                                Limbah Dapur
                            </div>
                            <div class="info-value">{{ $kuliner->limbah_dapur ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-wind"></i>
                                Ventilasi Dapur
                            </div>
                            <div class="info-value">{{ $kuliner->ventilasi_dapur ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-house-check"></i>
                                Kondisi Dapur
                            </div>
                            <div class="info-value">{{ $kuliner->dapur ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-droplet"></i>
                                Sumber Air Cuci
                            </div>
                            <div class="info-value">{{ $kuliner->sumber_air_cuci ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-droplet"></i>
                                Sumber Air Masak
                            </div>
                            <div class="info-value">{{ $kuliner->sumber_air_masak ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-cup-straw"></i>
                                Sumber Air Minum
                            </div>
                            <div class="info-value">{{ $kuliner->sumber_air_minum ?? '-' }}</div>
                        </div>
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
                            <div class="info-value">{{ $kuliner->latitude ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-arrow-left-right"></i>
                                Longitude
                            </div>
                            <div class="info-value">{{ $kuliner->longitude ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Section: Galeri Foto -->
                <div class="detail-section">
                    <div class="section-title">
                        <i class="bi bi-images"></i>
                        Galeri Foto ({{ $kuliner->foto->count() }})
                    </div>
                    @if($kuliner->foto->count() > 0)
                        <div class="photo-gallery">
                            @foreach ($kuliner->foto as $index => $foto)
                                <div class="photo-item" onclick="openLightbox('{{ asset('storage/' . $foto->path_foto) }}')">
                                    <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                         alt="Foto {{ $kuliner->nama_sentra }} {{ $index + 1 }}">
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
                            <p>Belum ada foto untuk tempat kuliner ini</p>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('kuliner.index') }}" class="btn-custom btn-back">
                        <i class="bi bi-arrow-left-circle"></i>
                        Kembali ke Daftar
                    </a>
                    <a href="{{ route('kuliner.edit', $kuliner->id_kuliner) }}" class="btn-custom btn-edit">
                        <i class="bi bi-pencil-square"></i>
                        Edit Data
                    </a>
                    <a href="https://www.google.com/maps?q={{ $kuliner->latitude }},{{ $kuliner->longitude }}"
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
