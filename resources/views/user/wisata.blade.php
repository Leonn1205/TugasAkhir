<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wisata->nama_wisata }} - Detail Wisata</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

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
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 14px;
            border: 1px solid rgba(255,255,255,0.3);
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
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
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
            flex-direction: column;
            gap: 0.3rem;
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

        .info-item.today .info-label {
            color: #1b5e20;
            font-weight: 700;
        }

        .info-label {
            font-weight: 600;
            color: #666;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #333;
            font-size: 15px;
            font-weight: 500;
            line-height: 1.6;
        }

        /* Description Box */
        .description-box {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            padding: 2rem;
            border-radius: 15px;
            border-left: 5px solid #2e7d32;
            margin-top: 1.5rem;
        }

        .description-box h3 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: #1b5e20;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .description-box p {
            font-size: 15px;
            color: #333;
            line-height: 1.8;
            margin-bottom: 0;
        }

        /* Audio Button */
        .description-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .description-header h3 {
            margin: 0;
        }

        .btn-audio {
            background: linear-gradient(135deg, #2e7d32, #388e3c);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(46, 125, 50, 0.3);
            white-space: nowrap;
        }

        .btn-audio:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.4);
        }

        .btn-audio.playing {
            background: linear-gradient(135deg, #f44336, #e53935);
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 3px 10px rgba(244, 67, 54, 0.3);
            }
            50% {
                box-shadow: 0 5px 20px rgba(244, 67, 54, 0.6);
            }
        }

        .btn-audio:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-audio i {
            font-size: 16px;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            margin-top: 1rem;
        }

        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
            background: white;
        }

        .table-modern tbody tr:hover td {
            background: #f8f9fa;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
        }

        .status-buka {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #1b5e20;
        }

        .status-libur {
            background: #f8d7da;
            color: #721c24;
        }

        .status-today {
            background: linear-gradient(135deg, #2e7d32, #388e3c);
            color: white;
            box-shadow: 0 3px 10px rgba(46, 125, 50, 0.3);
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .photo-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
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

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
            }

            .table-modern {
                font-size: 13px;
            }

            .table-modern th,
            .table-modern td {
                padding: 0.8rem 0.5rem;
            }

            .description-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-audio {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Gallery -->
    <div class="hero-gallery">
        @if($wisata->foto->count() > 0)
            <img src="{{ asset('storage/' . $wisata->foto->first()->path_foto) }}" alt="{{ $wisata->nama_wisata }}">
        @else
            <img src="{{ asset('images/default-tourism.jpg') }}" alt="{{ $wisata->nama_wisata }}">
        @endif

        <div class="hero-overlay">
            <div class="container-detail">
                <h1>{{ $wisata->nama_wisata }}</h1>
                <div class="hero-tags">
                    @forelse($wisata->kategoriAktif as $kat)
                        <span class="hero-tag">
                            <i class="bi bi-bookmark-star-fill me-1"></i>{{ $kat->nama_kategori }}
                        </span>
                    @empty
                        <span class="hero-tag">
                            <i class="bi bi-geo-alt-fill me-1"></i>Wisata
                        </span>
                    @endforelse
                    @if($wisata->latitude && $wisata->longitude)
                        <span class="hero-tag">
                            <i class="bi bi-geo-alt-fill me-1"></i>{{ number_format($wisata->latitude, 4) }}, {{ number_format($wisata->longitude, 4) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-detail">

        <!-- Informasi Umum -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-info-circle"></i>
                Informasi Umum
            </h2>

            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nama Tempat Wisata</span>
                    <span class="info-value">{{ $wisata->nama_wisata ?? '-' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Alamat Lengkap</span>
                    <span class="info-value">{{ $wisata->alamat_lengkap ?? '-' }}</span>
                </div>

                @if($wisata->latitude && $wisata->longitude)
                <div class="info-item">
                    <span class="info-label">Koordinat Lokasi</span>
                    <span class="info-value">
                        <i class="bi bi-geo-alt-fill me-1" style="color: #2e7d32;"></i>
                        {{ number_format($wisata->latitude, 6) }}, {{ number_format($wisata->longitude, 6) }}
                    </span>
                </div>
                @endif

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
            </div>

            @if($wisata->deskripsi)
            <div class="description-box">
                <h3><i class="bi bi-file-text-fill"></i>Deskripsi</h3>
                <p>{{ $wisata->deskripsi }}</p>
            </div>
            @endif

            @if($wisata->sejarah)
            <div class="description-box" style="margin-top: 1rem;">
                <h3><i class="bi bi-book-fill"></i>Sejarah</h3>
                <p>{{ $wisata->sejarah }}</p>
            </div>
            @endif

            @if($wisata->narasi)
            <div class="description-box" style="margin-top: 1rem;">
                <div class="description-header">
                    <h3><i class="bi bi-chat-square-text-fill"></i>Narasi</h3>
                    <button id="playNarasi" class="btn-audio" onclick="bacaNarasi()">
                        <i class="bi bi-volume-up-fill"></i>
                        <span>Putar Audio</span>
                    </button>
                </div>
                <p id="narasiText">{{ $wisata->narasi }}</p>
            </div>
            @endif
        </div>

        <!-- Jam Operasional -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-clock-fill"></i>
                Jam Operasional
            </h2>

            @php
                $hariSekarang = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now()->dayOfWeek];
            @endphp

            <div class="info-grid">
                @foreach($wisata->jamOperasionalAdmin as $jam)
                    <div class="info-item {{ $jam->hari === $hariSekarang ? 'today' : '' }}">
                        <i class="bi bi-calendar2-day" style="font-size: 24px; color: #2e7d32; margin-bottom: 0.5rem;"></i>
                        <div class="text" style="width: 100%;">
                            <span class="info-label">
                                {{ $jam->hari }}
                                @if($jam->hari === $hariSekarang)
                                    <span style="background: #2e7d32; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; margin-left: 5px;">HARI INI</span>
                                @endif
                            </span>
                            <span class="info-value">
                                @if($jam->libur || !$jam->jam_buka || $jam->jam_buka == '-')
                                    <span style="color: #f44336; font-weight: 600;">Libur</span>
                                @else
                                    <div style="font-weight: 600;">{{ $jam->jam_buka->format('H:i') }} - {{ $jam->jam_tutup->format('H:i') }}</div>
                                @endif
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Foto Gallery -->
        @if($wisata->foto->count() > 0)
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-images"></i>
                Galeri Foto
            </h2>
            <div class="photo-gallery">
                @foreach ($wisata->foto as $foto)
                    <div class="photo-item">
                        <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Foto {{ $wisata->nama_wisata }}">
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons">
            @if($wisata->latitude && $wisata->longitude)
            <a href="https://www.google.com/maps/search/?api=1&query={{ $wisata->latitude }},{{ $wisata->longitude }}"
               target="_blank"
               class="btn-action btn-primary-action">
                <i class="bi bi-map-fill"></i>
                Lihat di Google Maps
            </a>
            @endif

            <a href="{{ route('home') }}" class="btn-action btn-secondary-action">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script untuk Text-to-Speech -->
    <script>
        let sedangBerbicara = false;
        let synthesis = window.speechSynthesis;
        let utterance = null;

        function bacaNarasi() {
            const btn = document.getElementById('playNarasi');
            const narasiText = document.getElementById('narasiText').textContent;

            if (sedangBerbicara) {
                // Stop audio
                synthesis.cancel();
                sedangBerbicara = false;
                btn.classList.remove('playing');
                btn.innerHTML = '<i class="bi bi-volume-up-fill"></i><span>Putar Audio</span>';
                return;
            }

            // Cek apakah browser mendukung
            if (!('speechSynthesis' in window)) {
                alert('Browser Anda tidak mendukung fitur Text-to-Speech');
                return;
            }

            // Mulai berbicara
            utterance = new SpeechSynthesisUtterance(narasiText);
            utterance.lang = 'id-ID'; // Bahasa Indonesia
            utterance.rate = 0.9; // Kecepatan bicara (0.1 - 10)
            utterance.pitch = 1; // Nada suara (0 - 2)
            utterance.volume = 1; // Volume (0 - 1)

            utterance.onstart = function() {
                sedangBerbicara = true;
                btn.classList.add('playing');
                btn.innerHTML = '<i class="bi bi-stop-fill"></i><span>Stop Audio</span>';
            };

            utterance.onend = function() {
                sedangBerbicara = false;
                btn.classList.remove('playing');
                btn.innerHTML = '<i class="bi bi-volume-up-fill"></i><span>Putar Audio</span>';
            };

            utterance.onerror = function(event) {
                console.error('Error:', event);
                sedangBerbicara = false;
                btn.classList.remove('playing');
                btn.innerHTML = '<i class="bi bi-volume-up-fill"></i><span>Putar Audio</span>';
                alert('Terjadi kesalahan saat memutar audio');
            };

            synthesis.speak(utterance);
        }

        // Stop audio saat user meninggalkan halaman
        window.addEventListener('beforeunload', function() {
            if (sedangBerbicara) {
                synthesis.cancel();
            }
        });
    </script>
</body>

</html>
