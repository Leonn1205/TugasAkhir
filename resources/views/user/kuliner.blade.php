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
            background: linear-gradient(135deg, #fff8e1 0%, #ffe0b2 100%);
            color: #333;
            line-height: 1.6;
        }

        /* Hero Section with Photo Slider */
        .hero-section {
            position: relative;
            height: 500px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .hero-slider {
            position: relative;
            height: 100%;
            width: 100%;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, transparent 100%);
            padding: 3rem 2rem;
            color: white;
            z-index: 2;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        .hero-badges {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .badge-custom {
            background: rgba(212, 175, 55, 0.9);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        /* Quick Action Bar */
        .quick-actions {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            margin: -3rem 2rem 2rem;
            position: relative;
            z-index: 10;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .action-btn {
            flex: 1;
            min-width: 150px;
            padding: 1rem;
            border: 2px solid #d4af37;
            border-radius: 15px;
            background: white;
            color: #d4af37;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #d4af37;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        }

        .action-btn i {
            font-size: 20px;
        }

        /* Container */
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 50px;
        }

        /* Status Card */
        .status-card {
            background: linear-gradient(135deg, #4caf50, #45a049);
            color: white;
            padding: 1.5rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3);
        }

        .status-card.closed {
            background: linear-gradient(135deg, #f44336, #e53935);
        }

        .status-icon {
            font-size: 48px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .status-text h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .status-text p {
            margin: 0;
            opacity: 0.9;
        }

        /* Tabs Navigation */
        .custom-tabs {
            background: white;
            border-radius: 20px;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .custom-tabs::-webkit-scrollbar {
            height: 6px;
        }

        .custom-tabs::-webkit-scrollbar-thumb {
            background: #d4af37;
            border-radius: 3px;
        }

        .tab-btn {
            padding: 1rem 1.5rem;
            border: none;
            background: transparent;
            border-radius: 12px;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tab-btn:hover {
            background: #fff8e1;
            color: #d4af37;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #d4af37, #c19a2e);
            color: white;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }

        .tab-btn i {
            font-size: 18px;
        }

        /* Tab Content */
        .tab-content-custom {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .tab-content-custom.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Content Card */
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #d4af37;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .section-title i {
            font-size: 28px;
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
            color: #8b4513;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .info-value a {
            color: #d4af37;
            text-decoration: none;
            font-weight: 600;
        }

        .info-value a:hover {
            text-decoration: underline;
        }

        /* Tags */
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            margin-top: 0.5rem;
        }

        .tag {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #e65100;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 2px solid #ffcc80;
        }

        .tag i {
            font-size: 14px;
        }

        /* Table */
        .schedule-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .schedule-table thead {
            background: linear-gradient(135deg, #d4af37, #c19a2e);
            color: white;
        }

        .schedule-table th {
            padding: 1rem;
            font-weight: 600;
            text-align: left;
            font-size: 14px;
        }

        .schedule-table td {
            padding: 1rem;
            border-bottom: 1px solid #f5f5f5;
            text-align: left;
        }

        .schedule-table tbody tr:hover {
            background: #fffbf0;
        }

        .schedule-table tbody tr:last-child td {
            border-bottom: none;
        }

        .day-name {
            font-weight: 700;
            color: #333;
        }

        .day-today {
            background: #e8f5e9 !important;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 12px;
        }

        .badge-open {
            background: #d4edda;
            color: #155724;
        }

        .badge-closed {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-busy {
            background: #fff3cd;
            color: #856404;
        }

        /* Accordion */
        .accordion-custom {
            border: none;
        }

        .accordion-item-custom {
            background: white;
            border: 2px solid #f5f5f5;
            border-radius: 12px !important;
            margin-bottom: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .accordion-item-custom:hover {
            border-color: #d4af37;
        }

        .accordion-header-custom {
            padding: 1.2rem 1.5rem;
            background: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #333;
            transition: all 0.3s ease;
        }

        .accordion-header-custom:hover {
            background: #fffbf0;
            color: #d4af37;
        }

        .accordion-header-custom.active {
            background: linear-gradient(135deg, #fff8e1, #ffe0b2);
            color: #d4af37;
        }

        .accordion-icon {
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .accordion-header-custom.active .accordion-icon {
            transform: rotate(180deg);
        }

        .accordion-body-custom {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
            padding: 0 1.5rem;
        }

        .accordion-body-custom.active {
            max-height: 1000px;
            padding: 1.5rem;
            border-top: 2px solid #f5f5f5;
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
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .photo-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.3);
        }

        .photo-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-item:hover img {
            transform: scale(1.1);
        }

        /* Back Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #d4af37, #c19a2e);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.4);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }

            .quick-actions {
                margin: -2rem 1rem 1.5rem;
                padding: 1rem;
            }

            .action-btn {
                min-width: 120px;
                padding: 0.8rem;
                font-size: 14px;
            }

            .custom-tabs {
                padding: 0.5rem;
            }

            .tab-btn {
                padding: 0.8rem 1rem;
                font-size: 14px;
            }

            .content-card {
                padding: 1.5rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Loading State */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section with Photo Slider -->
    <div class="hero-section">
        <div class="hero-slider">
            @forelse($kuliner->foto as $index => $foto)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="{{ $kuliner->nama_sentra }}">
                </div>
            @empty
                <div class="hero-slide active">
                    <img src="{{ asset('images/default-culinary.jpg') }}" alt="{{ $kuliner->nama_sentra }}">
                </div>
            @endforelse
        </div>

        <div class="hero-overlay">
            <h1 class="hero-title">{{ $kuliner->nama_sentra }}</h1>
            <div class="hero-badges">
                @forelse($kuliner->kategoriAktif as $kat)
                    <span class="badge-custom">
                        <i class="bi bi-cup-hot-fill me-1"></i>{{ $kat->nama_kategori }}
                    </span>
                @empty
                    <span class="badge-custom">
                        <i class="bi bi-cup-hot-fill me-1"></i>Kuliner
                    </span>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="container-custom">
        <div class="quick-actions">
            @if ($kuliner->telepon)
                <a href="tel:{{ $kuliner->telepon }}" class="action-btn">
                    <i class="bi bi-telephone-fill"></i>
                    <span>Hubungi</span>
                </a>
            @endif
            @if ($kuliner->latitude && $kuliner->longitude)
                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $kuliner->latitude }},{{ $kuliner->longitude }}"
                    target="_blank" class="action-btn">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Petunjuk Arah</span>
                </a>
            @endif
            <a href="#" class="action-btn" onclick="shareContent(event)">
                <i class="bi bi-share-fill"></i>
                <span>Bagikan</span>
            </a>
        </div>

        <!-- Status Card (Open/Closed Today) -->
        @php
            $today = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now()->dayOfWeek];
            $todaySchedule = $kuliner->jamOperasionalAdmin->where('hari', $today)->first();
            $isOpen = false;
            $statusText = 'Tutup Hari Ini';

            if ($todaySchedule && !$todaySchedule->libur && $todaySchedule->jam_buka) {
                $currentTime = now()->format('H:i');
                $jamBuka = $todaySchedule->jam_buka->format('H:i');
                $jamTutup = $todaySchedule->jam_tutup->format('H:i');

                if ($currentTime >= $jamBuka && $currentTime <= $jamTutup) {
                    $isOpen = true;
                    $statusText = 'Buka Sekarang';
                } elseif ($currentTime < $jamBuka) {
                    $statusText = 'Buka Pukul ' . $jamBuka;
                } else {
                    $statusText = 'Sudah Tutup';
                }
            }
        @endphp

        <div class="status-card {{ $isOpen ? '' : 'closed' }}">
            <div class="status-icon">
                <i class="bi {{ $isOpen ? 'bi-door-open' : 'bi-door-closed' }}"></i>
            </div>
            <div class="status-text">
                <h3>{{ $statusText }}</h3>
                @if ($todaySchedule && !$todaySchedule->libur)
                    <p>{{ $todaySchedule->jam_buka->format('H:i') }} - {{ $todaySchedule->jam_tutup->format('H:i') }}
                    </p>
                @else
                    <p>{{ $today }} - Libur</p>
                @endif
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="custom-tabs">
            <button class="tab-btn active" data-tab="info">
                <i class="bi bi-info-circle"></i>
                <span>Informasi</span>
            </button>
            <button class="tab-btn" data-tab="menu">
                <i class="bi bi-egg-fried"></i>
                <span>Menu</span>
            </button>
            <button class="tab-btn" data-tab="schedule">
                <i class="bi bi-clock"></i>
                <span>Jam Buka</span>
            </button>
            <button class="tab-btn" data-tab="facilities">
                <i class="bi bi-house-door"></i>
                <span>Fasilitas</span>
            </button>
            <button class="tab-btn" data-tab="gallery">
                <i class="bi bi-images"></i>
                <span>Galeri</span>
            </button>
            <button class="tab-btn" data-tab="details">
                <i class="bi bi-list-ul"></i>
                <span>Detail Lengkap</span>
            </button>
        </div>

        <!-- Tab: Informasi -->
        <div class="tab-content-custom active" id="tab-info">
            <div class="content-card">
                <h2 class="section-title">
                    <i class="bi bi-building"></i>
                    Informasi Umum
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nama Usaha</span>
                        <span class="info-value">{{ $kuliner->nama_sentra }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tahun Berdiri</span>
                        <span class="info-value">{{ $kuliner->tahun_berdiri }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Alamat</span>
                        <span class="info-value">{{ $kuliner->alamat_lengkap }}</span>
                    </div>
                    @if ($kuliner->telepon)
                        <div class="info-item">
                            <span class="info-label">Telepon</span>
                            <span class="info-value">
                                <a href="tel:{{ $kuliner->telepon }}">
                                    <i class="bi bi-telephone-fill me-1"></i>{{ $kuliner->telepon }}
                                </a>
                            </span>
                        </div>
                    @endif
                    @if ($kuliner->email)
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">
                                <a href="mailto:{{ $kuliner->email }}">
                                    <i class="bi bi-envelope-fill me-1"></i>{{ $kuliner->email }}
                                </a>
                            </span>
                        </div>
                    @endif
                    <div class="info-item">
                        <span class="info-label">Jumlah Gerai</span>
                        <span class="info-value">{{ $kuliner->jumlah_gerai }} Gerai</span>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <h2 class="section-title">
                    <i class="bi bi-people"></i>
                    Informasi Tambahan
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Jumlah Kursi</span>
                        <span class="info-value">{{ $kuliner->jumlah_kursi }} Kursi</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kapasitas Per Hari</span>
                        <span class="info-value">~{{ $kuliner->jumlah_pelanggan_per_hari }} Pelanggan</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Metode Pembayaran</span>
                        <div class="tags-container">
                            @php
                                $metode = is_array($kuliner->metode_pembayaran)
                                    ? $kuliner->metode_pembayaran
                                    : json_decode($kuliner->metode_pembayaran, true) ?? [];
                            @endphp
                            @foreach ($metode as $m)
                                <span class="tag">
                                    <i class="bi bi-credit-card-fill"></i>{{ $m }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Profil Pelanggan</span>
                        <div class="tags-container">
                            @php
                                $profil = is_array($kuliner->profil_pelanggan)
                                    ? $kuliner->profil_pelanggan
                                    : json_decode($kuliner->profil_pelanggan, true) ?? [];
                            @endphp
                            @foreach ($profil as $p)
                                <span class="tag">
                                    <i class="bi bi-people-fill"></i>{{ $p }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Menu -->
        <div class="tab-content-custom" id="tab-menu">
            <div class="content-card">
                <h2 class="section-title">
                    <i class="bi bi-star-fill text-warning"></i>
                    Menu Unggulan
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Menu Spesial</span>
                        <span class="info-value">{{ $kuliner->menu_unggulan }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Bahan Baku Utama</span>
                        <span class="info-value">{{ $kuliner->bahan_baku_utama }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Sumber Bahan</span>
                        <span class="info-value">{{ $kuliner->sumber_bahan_baku }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Karakteristik Menu</span>
                        <div class="tags-container">
                            @php
                                $menu_sifat = is_array($kuliner->menu_bersifat)
                                    ? $kuliner->menu_bersifat
                                    : json_decode($kuliner->menu_bersifat, true) ?? [];
                            @endphp
                            @foreach ($menu_sifat as $sifat)
                                <span class="tag">
                                    <i class="bi bi-check-circle-fill"></i>{{ $sifat }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Jam Operasional -->
        <div class="tab-content-custom" id="tab-schedule">
            <div class="content-card">
                <h2 class="section-title">
                    <i class="bi bi-clock-history"></i>
                    Jadwal Operasional
                </h2>
                <div class="table-responsive">
                    <table class="schedule-table">
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
                            @foreach ($kuliner->jamOperasionalAdmin as $jam)
                                <tr class="{{ $jam->hari === $today ? 'day-today' : '' }}">
                                    <td class="day-name">
                                        {{ $jam->hari }}
                                        @if ($jam->hari === $today)
                                            <span class="badge-busy ms-2">Hari Ini</span>
                                        @endif
                                    </td>
                                    <td>{{ $jam->jam_buka ? $jam->jam_buka->format('H:i') : '-' }}</td>
                                    <td>{{ $jam->jam_tutup ? $jam->jam_tutup->format('H:i') : '-' }}</td>
                                    <td>
                                        @if ($jam->jam_sibuk_mulai && $jam->jam_sibuk_selesai)
                                            {{ $jam->jam_sibuk_mulai->format('H:i') }} -
                                            {{ $jam->jam_sibuk_selesai->format('H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($jam->libur || !$jam->jam_buka)
                                            <span class="status-badge badge-closed">Libur</span>
                                        @else
                                            <span class="status-badge badge-open">Buka</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Tab: Fasilitas -->
        <div class="tab-content-custom" id="tab-facilities">
            <div class="content-card">
                <h2 class="section-title">
                    <i class="bi bi-house-door"></i>
                    Tempat & Fasilitas
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Bentuk Fisik</span>
                        <span class="info-value">{{ $kuliner->bentuk_fisik }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status Bangunan</span>
                        <span class="info-value">{{ $kuliner->status_bangunan }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fasilitas Tersedia</span>
                        <div class="tags-container">
                            @php
                                $fasilitas = is_array($kuliner->fasilitas_pendukung)
                                    ? $kuliner->fasilitas_pendukung
                                    : json_decode($kuliner->fasilitas_pendukung, true) ?? [];
                            @endphp
                            @foreach ($fasilitas as $f)
                                <span class="tag">
                                    <i class="bi bi-check2-circle"></i>{{ $f }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Gallery -->
        <div class="tab-content-custom" id="tab-gallery">
            <div class="content-card">
                <h2 class="section-title">
                    <i class="bi bi-images"></i>
                    Galeri Foto
                </h2>
                @if ($kuliner->foto->count() > 0)
                    <div class="photos-grid">
                        @foreach ($kuliner->foto as $foto)
                            <div class="photo-item"
                                onclick="viewImage('{{ asset('storage/' . $foto->path_foto) }}')">
                                <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                    alt="{{ $kuliner->nama_sentra }}" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">Belum ada foto</p>
                @endif
            </div>
        </div>

        <!-- Tab: Detail Lengkap (Accordion) -->
        <div class="tab-content-custom" id="tab-details">
            <div class="content-card">
                <h2 class="section-title">
                    <i class="bi bi-list-ul"></i>
                    Informasi Detail
                </h2>

                <div class="accordion-custom">
                    <!-- K3 & Sanitasi -->
                    <div class="accordion-item-custom">
                        <div class="accordion-header-custom" onclick="toggleAccordion(this)">
                            <span><i class="bi bi-shield-check me-2"></i>Praktik K3 & Sanitasi</span>
                            <i class="bi bi-chevron-down accordion-icon"></i>
                        </div>
                        <div class="accordion-body-custom">
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Pelatihan K3</span>
                                    <span class="info-value">
                                        {{ $kuliner->pelatihan_k3 ? '✓ Ya' : '✗ Tidak' }}
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Jumlah Penjamah Makanan</span>
                                    <span class="info-value">{{ $kuliner->jumlah_penjamah_makanan }} Orang</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">APD Penjamah</span>
                                    <div class="tags-container">
                                        @php
                                            $apd = is_array($kuliner->apd_penjamah_makanan)
                                                ? $kuliner->apd_penjamah_makanan
                                                : json_decode($kuliner->apd_penjamah_makanan, true) ?? [];
                                        @endphp
                                        @foreach ($apd as $a)
                                            <span class="tag">{{ $a }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Sanitasi Alat</span>
                                    <span class="info-value">
                                        {{ $kuliner->prosedur_sanitasi_alat ? '✓' : '✗' }}
                                        ({{ $kuliner->frekuensi_sanitasi_alat }})
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Sanitasi Bahan</span>
                                    <span class="info-value">
                                        {{ $kuliner->prosedur_sanitasi_bahan ? '✓' : '✗' }}
                                        ({{ $kuliner->frekuensi_sanitasi_bahan }})
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">FIFO/FEFO</span>
                                    <span
                                        class="info-value">{{ $kuliner->fifo_fefo ? '✓ Diterapkan' : '✗ Tidak' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Penyimpanan & Kebersihan -->
                    <div class="accordion-item-custom">
                        <div class="accordion-header-custom" onclick="toggleAccordion(this)">
                            <span><i class="bi bi-droplet me-2"></i>Penyimpanan & Kebersihan</span>
                            <i class="bi bi-chevron-down accordion-icon"></i>
                        </div>
                        <div class="accordion-body-custom">
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Penyimpanan Bahan Mentah</span>
                                    <span class="info-value">{{ $kuliner->penyimpanan_mentah }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Penyimpanan Bahan Matang</span>
                                    <span class="info-value">{{ $kuliner->penyimpanan_matang }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Pengelolaan Limbah</span>
                                    <span class="info-value">{{ $kuliner->limbah_dapur }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Ventilasi Dapur</span>
                                    <span class="info-value">{{ $kuliner->ventilasi_dapur }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Kondisi Dapur</span>
                                    <span class="info-value">{{ $kuliner->dapur }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sumber Air -->
                    <div class="accordion-item-custom">
                        <div class="accordion-header-custom" onclick="toggleAccordion(this)">
                            <span><i class="bi bi-droplet-fill me-2"></i>Sumber Air</span>
                            <i class="bi bi-chevron-down accordion-icon"></i>
                        </div>
                        <div class="accordion-body-custom">
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Air Cuci</span>
                                    <span class="info-value">{{ $kuliner->sumber_air_cuci }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Air Masak</span>
                                    <span class="info-value">{{ $kuliner->sumber_air_masak }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Air Minum</span>
                                    <span class="info-value">{{ $kuliner->sumber_air_minum }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Legalitas -->
                    @if ($kuliner->no_nib || $kuliner->sertifikat_lain)
                        <div class="accordion-item-custom">
                            <div class="accordion-header-custom" onclick="toggleAccordion(this)">
                                <span><i class="bi bi-file-earmark-text me-2"></i>Legalitas & Sertifikat</span>
                                <i class="bi bi-chevron-down accordion-icon"></i>
                            </div>
                            <div class="accordion-body-custom">
                                <div class="info-grid">
                                    @if ($kuliner->no_nib)
                                        <div class="info-item">
                                            <span class="info-label">Nomor NIB</span>
                                            <span class="info-value">{{ $kuliner->no_nib }}</span>
                                        </div>
                                    @endif
                                    @if ($kuliner->sertifikat_lain)
                                        <div class="info-item">
                                            <span class="info-label">Sertifikat Lainnya</span>
                                            <div class="tags-container">
                                                @php
                                                    $sertifikat = is_array($kuliner->sertifikat_lain)
                                                        ? $kuliner->sertifikat_lain
                                                        : json_decode($kuliner->sertifikat_lain, true) ?? [];
                                                @endphp
                                                @foreach ($sertifikat as $s)
                                                    <span class="tag">{{ $s }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div class="info-item">
                                        <span class="info-label">Pajak/Retribusi</span>
                                        <span class="info-value">
                                            {{ $kuliner->pajak_retribusi ? '✓ Terdaftar' : '✗ Belum Terdaftar' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="back-btn">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Kembali ke Halaman Utama
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Photo Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');

        if (slides.length > 1) {
            setInterval(() => {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }, 5000);
        }

        // Tab Switching
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content-custom');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTab = btn.dataset.tab;

                // Remove active class from all
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked
                btn.classList.add('active');
                document.getElementById(`tab-${targetTab}`).classList.add('active');

                // Smooth scroll to content
                window.scrollTo({
                    top: document.querySelector('.custom-tabs').offsetTop - 20,
                    behavior: 'smooth'
                });
            });
        });

        // Accordion Toggle
        function toggleAccordion(header) {
            const body = header.nextElementSibling;
            const isActive = header.classList.contains('active');

            // Close all accordions
            document.querySelectorAll('.accordion-header-custom').forEach(h => {
                h.classList.remove('active');
                h.nextElementSibling.classList.remove('active');
            });

            // Open clicked accordion if it wasn't active
            if (!isActive) {
                header.classList.add('active');
                body.classList.add('active');
            }
        }

        // Share Function
        function shareContent(event) {
            event.preventDefault();
            if (navigator.share) {
                navigator.share({
                    title: '{{ $kuliner->nama_sentra }}',
                    text: 'Lihat tempat kuliner ini: {{ $kuliner->nama_sentra }}',
                    url: window.location.href
                });
            } else {
                // Fallback: Copy to clipboard
                navigator.clipboard.writeText(window.location.href);
                alert('Link telah disalin ke clipboard!');
            }
        }

        // View Image (Simple lightbox)
        function viewImage(src) {
            const lightbox = document.createElement('div');
            lightbox.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        `;

            const img = document.createElement('img');
            img.src = src;
            img.style.cssText = 'max-width: 90%; max-height: 90%; object-fit: contain;';

            lightbox.appendChild(img);
            document.body.appendChild(lightbox);

            lightbox.onclick = () => lightbox.remove();
        }
    </script>
</body>

</html>
