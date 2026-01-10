<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kuliner->nama_sentra }} - Detail Kuliner</title>
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
        .hero-gallery {
            position: relative;
            height: 500px;
            background: #000;
            overflow: hidden;
        }

        .hero-gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
        }

        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(27, 94, 32, 0.95), transparent);
            padding: 3rem 2rem;
            color: white;
        }

        .hero-overlay h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-tags {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .hero-tag {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 14px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Container */
        .container-detail {
            max-width: 1000px;
            margin: -80px auto 0;
            padding: 0 20px 50px;
            position: relative;
            z-index: 2;
        }

        /* Info Card */
        .info-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* Quick Stats */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            padding: 2rem;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-item i {
            font-size: 32px;
            color: #1b5e20;
            margin-bottom: 0.5rem;
        }

        .stat-item .number {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            display: block;
        }

        .stat-item .label {
            font-size: 13px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Section Title */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 3px solid #1b5e20;
            padding-bottom: 0.5rem;
        }

        .section-title i {
            font-size: 32px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.2rem;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .info-item:hover {
            background: #e8f5e9;
            transform: translateX(5px);
        }

        .info-item.today {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border: 2px solid #2e7d32;
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
        }

        .info-item.today .label {
            color: #1b5e20;
            font-weight: 700;
        }

        .info-item.today i {
            color: #2e7d32;
            font-size: 28px;
        }

        .info-item i {
            font-size: 24px;
            color: #2e7d32;
            margin-top: 2px;
        }

        .info-item .text {
            flex: 1;
        }

        .info-item .label {
            font-size: 13px;
            color: #666;
            font-weight: 500;
            display: block;
            margin-bottom: 0.3rem;
        }

        .info-item .value {
            font-weight: 600;
            color: #333;
            font-size: 15px;
            word-break: break-word;
        }

        .info-item a {
            color: #1b5e20;
            text-decoration: none;
            font-weight: 600;
        }

        .info-item a:hover {
            text-decoration: underline;
        }

        /* Full Width Item */
        .info-item-full {
            grid-column: 1 / -1;
        }

        /* Menu Highlight */
        .menu-highlight {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            padding: 2rem;
            border-radius: 15px;
            border-left: 5px solid #2e7d32;
            margin-bottom: 2rem;
        }

        .menu-highlight h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: #1b5e20;
            margin-bottom: 1rem;
        }

        .menu-highlight p {
            font-size: 18px;
            color: #333;
            line-height: 1.8;
            font-weight: 500;
        }

        /* Tags */
        .tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .tag {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tag i {
            font-size: 16px;
        }

        /* Photo Gallery */
        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .photo-item {
            position: relative;
            padding-bottom: 75%;
            overflow: hidden;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .photo-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .photo-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .btn-action {
            flex: 1;
            min-width: 200px;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .btn-primary-action {
            background: linear-gradient(135deg, #1b5e20, #2e7d32);
            color: white;
            box-shadow: 0 5px 15px rgba(27, 94, 32, 0.3);
        }

        .btn-primary-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(27, 94, 32, 0.4);
            color: white;
        }

        .btn-secondary-action {
            background: white;
            color: #333;
            border: 2px solid #ddd;
        }

        .btn-secondary-action:hover {
            background: #f8f9fa;
            border-color: #2e7d32;
            color: #2e7d32;
            transform: translateY(-3px);
        }

        .btn-edit-action {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
        }

        .btn-edit-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 152, 0, 0.4);
            color: white;
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero-gallery {
                height: 350px;
            }

            .hero-overlay h1 {
                font-size: 32px;
            }

            .container-detail {
                margin-top: -50px;
            }

            .info-card {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 22px;
            }

            .quick-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Gallery -->
    <div class="hero-gallery">
        @if ($kuliner->foto->count() > 0)
            <img src="{{ asset('storage/' . $kuliner->foto->first()->path_foto) }}" alt="{{ $kuliner->nama_sentra }}">
        @else
            <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&h=600&fit=crop"
                alt="{{ $kuliner->nama_sentra }}">
        @endif

        <div class="hero-overlay">
            <div class="container-detail">
                <h1>{{ $kuliner->nama_sentra }}</h1>
                <div class="hero-tags">
                    @forelse($kuliner->kategoriAktif as $kat)
                        <span class="hero-tag">
                            <i class="bi bi-bookmark-star-fill me-1"></i>{{ $kat->nama_kategori }}
                        </span>
                    @empty
                        <span class="hero-tag">
                            <i class="bi bi-tag-fill me-1"></i>Kuliner
                        </span>
                    @endforelse
                    <span class="hero-tag">
                        <i class="bi bi-calendar-check me-1"></i>Sejak {{ $kuliner->tahun_berdiri ?? '-' }}
                    </span>
                    <span class="hero-tag">
                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $kuliner->bentuk_fisik ?? 'Tempat Makan' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-detail">

        <!-- Quick Statistics -->
        <div class="quick-stats">
            <div class="stat-item">
                <i class="bi bi-shop"></i>
                <span class="number">{{ $kuliner->jumlah_gerai ?? '1' }}</span>
                <span class="label">Gerai</span>
            </div>

            <div class="stat-item">
                <i class="bi bi-person-fill"></i>
                <span class="number">{{ $kuliner->jumlah_kursi ?? '-' }}</span>
                <span class="label">Kapasitas Kursi</span>
            </div>

            <div class="stat-item">
                <i class="bi bi-people-fill"></i>
                <span class="number">{{ $kuliner->jumlah_pelanggan_per_hari ?? '-' }}</span>
                <span class="label">Pelanggan/Hari</span>
            </div>

            <div class="stat-item">
                <i class="bi bi-calendar2-check"></i>
                <span class="number">{{ $kuliner->tahun_berdiri ?? '-' }}</span>
                <span class="label">Tahun Berdiri</span>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-telephone-fill"></i>
                Informasi Kontak
            </h2>

            <div class="info-grid">
                <div class="info-item info-item-full">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div class="text">
                        <span class="label">Alamat Lengkap</span>
                        <span class="value">{{ $kuliner->alamat_lengkap ?? '-' }}</span>
                    </div>
                </div>

                @if ($kuliner->telepon)
                    <div class="info-item">
                        <i class="bi bi-telephone-fill"></i>
                        <div class="text">
                            <span class="label">Nomor Telepon</span>
                            <a href="tel:{{ $kuliner->telepon }}">{{ $kuliner->telepon }}</a>
                        </div>
                    </div>
                @endif

                @if ($kuliner->email)
                    <div class="info-item">
                        <i class="bi bi-envelope-fill"></i>
                        <div class="text">
                            <span class="label">Email</span>
                            <a href="mailto:{{ $kuliner->email }}">{{ $kuliner->email }}</a>
                        </div>
                    </div>
                @endif

                <div class="info-item">
                    <i class="bi bi-person-fill"></i>
                    <div class="text">
                        <span class="label">Nama Pemilik</span>
                        <span class="value">{{ $kuliner->nama_pemilik ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-key-fill"></i>
                    <div class="text">
                        <span class="label">Status Kepemilikan</span>
                        <span class="value">{{ $kuliner->kepemilikan ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-card-text"></i>
                    <div class="text">
                        <span class="label">No. NIB</span>
                        <span class="value">{{ $kuliner->no_nib ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-credit-card-fill"></i>
                    <div class="text">
                        <span class="label">Metode Pembayaran</span>
                        <span class="value">
                            @php
                                $metode_pembayaran = is_array($kuliner->metode_pembayaran)
                                    ? $kuliner->metode_pembayaran
                                    : json_decode($kuliner->metode_pembayaran, true);
                                $metode_pembayaran = is_array($metode_pembayaran) ? $metode_pembayaran : [];
                            @endphp
                            {{ !empty($metode_pembayaran) ? implode(', ', $metode_pembayaran) : '-' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu & Specialty -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-egg-fried"></i>
                Menu & Spesialisasi
            </h2>

            <div class="menu-highlight">
                <h3><i class="bi bi-star-fill text-warning me-2"></i>Menu Unggulan</h3>
                <p>{{ $kuliner->menu_unggulan ?? 'Berbagai menu lezat tersedia' }}</p>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <i class="bi bi-basket-fill"></i>
                    <div class="text">
                        <span class="label">Bahan Baku Utama</span>
                        <span class="value">{{ $kuliner->bahan_baku_utama ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-truck"></i>
                    <div class="text">
                        <span class="label">Sumber Bahan Baku</span>
                        <span class="value">{{ $kuliner->sumber_bahan_baku ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <h3 style="font-size: 18px; font-weight: 600; margin: 2rem 0 1rem; color: #666;">
                <i class="bi bi-tags-fill me-2"></i>Jenis Menu
            </h3>
            <div class="tags-list">
                @php
                    $menu_bersifat = is_array($kuliner->menu_bersifat)
                        ? $kuliner->menu_bersifat
                        : json_decode($kuliner->menu_bersifat, true);
                    $menu_bersifat = is_array($menu_bersifat) ? $menu_bersifat : [];
                @endphp
                @forelse($menu_bersifat as $menu)
                    <span class="tag">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ $menu }}
                    </span>
                @empty
                    <span class="text-muted">Tidak ada informasi</span>
                @endforelse
            </div>
        </div>

        <!-- Informasi Operasional -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-info-circle-fill"></i>
                Informasi Operasional
            </h2>

            <div class="info-grid">
                <div class="info-item">
                    <i class="bi bi-people-fill"></i>
                    <div class="text">
                        <span class="label">Jumlah Pegawai</span>
                        <span class="value">{{ $kuliner->jumlah_pegawai ?? '-' }} orang</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-person-badge"></i>
                    <div class="text">
                        <span class="label">Profil Pelanggan</span>
                        <span class="value">
                            @php
                                $profil_pelanggan = is_array($kuliner->profil_pelanggan)
                                    ? $kuliner->profil_pelanggan
                                    : json_decode($kuliner->profil_pelanggan, true);
                                $profil_pelanggan = is_array($profil_pelanggan) ? $profil_pelanggan : [];
                            @endphp
                            {{ !empty($profil_pelanggan) ? implode(', ', $profil_pelanggan) : '-' }}
                        </span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-award-fill"></i>
                    <div class="text">
                        <span class="label">Sertifikat</span>
                        <span class="value">
                            @php
                                $sertifikat_lain = is_array($kuliner->sertifikat_lain)
                                    ? $kuliner->sertifikat_lain
                                    : json_decode($kuliner->sertifikat_lain, true);
                                $sertifikat_lain = is_array($sertifikat_lain) ? $sertifikat_lain : [];
                            @endphp
                            {{ !empty($sertifikat_lain) ? implode(', ', $sertifikat_lain) : '-' }}
                        </span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-receipt"></i>
                    <div class="text">
                        <span class="label">Pajak Retribusi</span>
                        <span class="value">{{ $kuliner->pajak_retribusi ? 'Ya' : 'Tidak' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facilities -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-grid-3x3-gap-fill"></i>
                Tempat & Fasilitas
            </h2>

            <div class="info-grid">
                <div class="info-item">
                    <i class="bi bi-building"></i>
                    <div class="text">
                        <span class="label">Bentuk Fisik</span>
                        <span class="value">{{ $kuliner->bentuk_fisik ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-house-door-fill"></i>
                    <div class="text">
                        <span class="label">Status Bangunan</span>
                        <span class="value">{{ $kuliner->status_bangunan ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <h3 style="font-size: 18px; font-weight: 600; margin: 2rem 0 1rem; color: #666;">
                <i class="bi bi-gear-fill me-2"></i>Fasilitas Pendukung
            </h3>
            <div class="tags-list">
                @php
                    $fasilitas = is_array($kuliner->fasilitas_pendukung)
                        ? $kuliner->fasilitas_pendukung
                        : json_decode($kuliner->fasilitas_pendukung, true);
                    $fasilitas = is_array($fasilitas) ? $fasilitas : [];
                @endphp
                @forelse($fasilitas as $fas)
                    <span class="tag">
                        <i class="bi bi-check2-circle"></i>
                        {{ $fas }}
                    </span>
                @empty
                    <span class="text-muted">Tidak ada informasi fasilitas</span>
                @endforelse
            </div>
        </div>

        <!-- Operating Hours -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-clock-fill"></i>
                Jam Operasional
            </h2>

            @php
                $hariSekarang = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now()->dayOfWeek];
            @endphp

            <div class="info-grid">
                @forelse($kuliner->jamOperasionalAdmin as $jam)
                    <div class="info-item {{ $jam->hari === $hariSekarang ? 'today' : '' }}">
                        <i class="bi bi-calendar2-day"></i>
                        <div class="text">
                            <span class="label">
                                {{ $jam->hari }}
                                @if ($jam->hari === $hariSekarang)
                                    <span
                                        style="background: #2e7d32; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; margin-left: 5px;">HARI
                                        INI</span>
                                @endif
                            </span>
                            <span class="value">
                                @if ($jam->libur || !$jam->jam_buka)
                                    <span style="color: #f44336; font-weight: 600;">Libur</span>
                                @else
                                    <div style="font-weight: 600;">{{ $jam->jam_buka->format('H:i') }} -
                                        {{ $jam->jam_tutup->format('H:i') }}</div>
                                    @if ($jam->jam_sibuk_mulai && $jam->jam_sibuk_selesai)
                                        <small style="color: #2e7d32; display: block; margin-top: 4px;">
                                            <i class="bi bi-people-fill"></i> Jam Sibuk:
                                            {{ $jam->jam_sibuk_mulai->format('H:i') }} -
                                            {{ $jam->jam_sibuk_selesai->format('H:i') }}
                                        </small>
                                    @endif
                                @endif
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="info-item info-item-full">
                        <i class="bi bi-calendar-x"></i>
                        <div class="text">
                            <span class="value">Belum ada data jam operasional</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- K3 & Sanitasi -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-shield-check"></i>
                Praktik K3 & Sanitasi
            </h2>

            <div class="info-grid">
                <div class="info-item">
                    <i class="bi bi-clipboard-check"></i>
                    <div class="text">
                        <span class="label">Pelatihan K3</span>
                        <span class="value">{{ $kuliner->pelatihan_k3 ? 'Ya' : 'Tidak' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-people"></i>
                    <div class="text">
                        <span class="label">Jumlah Penjamah Makanan</span>
                        <span class="value">{{ $kuliner->jumlah_penjamah_makanan ?? '-' }} orang</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-droplet-fill"></i>
                    <div class="text">
                        <span class="label">Prosedur Sanitasi Alat</span>
                        <span
                            class="value">{{ $kuliner->prosedur_sanitasi_alat ? 'Melakukan' : 'Tidak Melakukan' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-clock-history"></i>
                    <div class="text">
                        <span class="label">Frekuensi Sanitasi Alat</span>
                        <span class="value">{{ $kuliner->frekuensi_sanitasi_alat ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-droplet-half"></i>
                    <div class="text">
                        <span class="label">Prosedur Sanitasi Bahan</span>
                        <span
                            class="value">{{ $kuliner->prosedur_sanitasi_bahan ? 'Melakukan' : 'Tidak Melakukan' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-alarm"></i>
                    <div class="text">
                        <span class="label">Frekuensi Sanitasi Bahan</span>
                        <span class="value">{{ $kuliner->frekuensi_sanitasi_bahan ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-box-seam"></i>
                    <div class="text">
                        <span class="label">Penyimpanan Bahan Mentah</span>
                        <span class="value">{{ $kuliner->penyimpanan_mentah ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-box-seam-fill"></i>
                    <div class="text">
                        <span class="label">Penyimpanan Bahan Matang</span>
                        <span class="value">{{ $kuliner->penyimpanan_matang ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-arrow-repeat"></i>
                    <div class="text">
                        <span class="label">Prinsip FIFO / FEFO</span>
                        <span class="value">{{ $kuliner->fifo_fefo ? 'Ya' : 'Tidak' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-trash"></i>
                    <div class="text">
                        <span class="label">Limbah Dapur</span>
                        <span class="value">{{ $kuliner->limbah_dapur ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-wind"></i>
                    <div class="text">
                        <span class="label">Ventilasi Dapur</span>
                        <span class="value">{{ $kuliner->ventilasi_dapur ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-house-check"></i>
                    <div class="text">
                        <span class="label">Kondisi Dapur</span>
                        <span class="value">{{ $kuliner->dapur ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-droplet"></i>
                    <div class="text">
                        <span class="label">Sumber Air Cuci</span>
                        <span class="value">{{ $kuliner->sumber_air_cuci ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-droplet"></i>
                    <div class="text">
                        <span class="label">Sumber Air Masak</span>
                        <span class="value">{{ $kuliner->sumber_air_masak ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-cup-straw"></i>
                    <div class="text">
                        <span class="label">Sumber Air Minum</span>
                        <span class="value">{{ $kuliner->sumber_air_minum ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <h3 style="font-size: 18px; font-weight: 600; margin: 2rem 0 1rem; color: #666;">
                <i class="bi bi-shield-fill-check me-2"></i>APD Penjamah Makanan
            </h3>
            <div class="tags-list">
                @php
                    $apd = is_array($kuliner->apd_penjamah_makanan)
                        ? $kuliner->apd_penjamah_makanan
                        : json_decode($kuliner->apd_penjamah_makanan, true);
                    $apd = is_array($apd) ? $apd : [];
                @endphp
                @forelse($apd as $item)
                    <span class="tag">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ $item }}
                    </span>
                @empty
                    <span class="text-muted">Tidak ada informasi</span>
                @endforelse
            </div>
        </div>

        <!-- Lokasi -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-map-fill"></i>
                Koordinat Lokasi
            </h2>

            <div class="info-grid">
                <div class="info-item">
                    <i class="bi bi-arrow-up-down"></i>
                    <div class="text">
                        <span class="label">Latitude</span>
                        <span class="value">{{ $kuliner->latitude ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-arrow-left-right"></i>
                    <div class="text">
                        <span class="label">Longitude</span>
                        <span class="value">{{ $kuliner->longitude ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Photo Gallery -->
        @if ($kuliner->foto->count() > 0)
            <div class="info-card">
                <h2 class="section-title">
                    <i class="bi bi-images"></i>
                    Galeri Foto ({{ $kuliner->foto->count() }})
                </h2>

                <div class="photo-gallery">
                    @foreach ($kuliner->foto as $index => $foto)
                        <div class="photo-item" onclick="openLightbox('{{ asset('storage/' . $foto->path_foto) }}')">
                            <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                alt="Foto {{ $kuliner->nama_sentra }} {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('kuliner.index') }}" class="btn-action btn-secondary-action">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Kembali ke Daftar
            </a>

            <a href="{{ route('kuliner.edit', $kuliner->id_kuliner) }}" class="btn-action btn-edit-action">
                <i class="bi bi-pencil-square"></i>
                Edit Data
            </a>
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
