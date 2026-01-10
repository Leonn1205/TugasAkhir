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

        .hero-tag.inactive {
            background: rgba(158, 158, 158, 0.3);
            border: 1px solid rgba(117, 117, 117, 0.3);
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

        /* Mini Stats */
        .mini-stats {
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

            0%,
            100% {
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

        /* Category Alert */
        .category-info-alert {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            border-left: 4px solid #ff9800;
            border-radius: 12px;
            padding: 12px 16px;
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #e65100;
        }

        .category-info-alert i {
            font-size: 20px;
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

        /* Lightbox */
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

            .mini-stats {
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
        @if ($wisata->foto->count() > 0)
            <img src="{{ asset('storage/' . $wisata->foto->first()->path_foto) }}" alt="{{ $wisata->nama_wisata }}">
        @else
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop"
                alt="{{ $wisata->nama_wisata }}">
        @endif

        <div class="hero-overlay">
            <div class="container-detail">
                <h1>{{ $wisata->nama_wisata }}</h1>
                <div class="hero-tags">
                    @php
                        $kategoriAktif = $wisata->kategoriAktif;
                        $kategoriNonaktif = $wisata->kategori->whereNotIn(
                            'id_kategori',
                            $kategoriAktif->pluck('id_kategori'),
                        );
                    @endphp

                    @forelse($kategoriAktif as $kat)
                        <span class="hero-tag">
                            <i class="bi bi-bookmark-star-fill me-1"></i>{{ $kat->nama_kategori }}
                        </span>
                    @empty
                        <span class="hero-tag">
                            <i class="bi bi-geo-alt-fill me-1"></i>Wisata
                        </span>
                    @endforelse

                    @foreach ($kategoriNonaktif as $kat)
                        <span class="hero-tag inactive" title="Kategori nonaktif">
                            <i class="bi bi-dash-circle me-1"></i>{{ $kat->nama_kategori }} (Nonaktif)
                        </span>
                    @endforeach

                    @if ($wisata->latitude && $wisata->longitude)
                        <span class="hero-tag">
                            <i class="bi bi-geo-alt-fill me-1"></i>{{ number_format($wisata->latitude, 4) }},
                            {{ number_format($wisata->longitude, 4) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-detail">

        <!-- Quick Statistics -->
        <div class="mini-stats">
            <div class="stat-item">
                <i class="bi bi-tags"></i>
                <span class="number">{{ $wisata->kategori->count() }}</span>
                <span class="label">Total Kategori</span>
            </div>

            <div class="stat-item">
                <i class="bi bi-check-circle"></i>
                <span class="number">{{ $kategoriAktif->count() }}</span>
                <span class="label">Kategori Aktif</span>
            </div>

            <div class="stat-item">
                <i class="bi bi-images"></i>
                <span class="number">{{ $wisata->foto->count() }}</span>
                <span class="label">Total Foto</span>
            </div>

            <div class="stat-item">
                <i class="bi bi-clock-history"></i>
                <span class="number">{{ $wisata->jamOperasionalAdmin->count() }}</span>
                <span class="label">Hari Operasional</span>
            </div>
        </div>

        <!-- Info Alert for Nonaktif Categories -->
        @if ($kategoriNonaktif->isNotEmpty())
            <div class="category-info-alert" style="margin-bottom: 2rem;">
                <i class="bi bi-info-circle-fill"></i>
                <span>
                    Kategori dengan label <strong>"(Nonaktif)"</strong> tidak akan ditampilkan di halaman publik.
                    Total kategori nonaktif: <strong>{{ $kategoriNonaktif->count() }}</strong>
                </span>
            </div>
        @endif

        <!-- Informasi Umum -->
        <div class="info-card">
            <h2 class="section-title">
                <i class="bi bi-info-circle"></i>
                Informasi Umum
            </h2>

            <div class="info-grid">
                <div class="info-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div class="text">
                        <span class="label">Nama Tempat Wisata</span>
                        <span class="value">{{ $wisata->nama_wisata ?? '-' }}</span>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-house-fill"></i>
                    <div class="text">
                        <span class="label">Alamat Lengkap</span>
                        <span class="value">{{ $wisata->alamat_lengkap ?? '-' }}</span>
                    </div>
                </div>

                @if ($wisata->latitude && $wisata->longitude)
                    <div class="info-item">
                        <i class="bi bi-crosshair"></i>
                        <div class="text">
                            <span class="label">Koordinat Lokasi</span>
                            <span class="value">
                                {{ number_format($wisata->latitude, 6) }}, {{ number_format($wisata->longitude, 6) }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>

            <h3 style="font-size: 18px; font-weight: 600; margin: 2rem 0 1rem; color: #666;">
                <i class="bi bi-tags-fill me-2"></i>Kategori Wisata
            </h3>
            <div class="tags-container">
                @forelse ($kategoriAktif as $k)
                    <span class="tag">
                        <i class="bi bi-bookmark-star-fill"></i>{{ $k->nama_kategori }}
                    </span>
                @empty
                    <span class="text-muted">Tidak ada kategori aktif</span>
                @endforelse
            </div>

            @if ($wisata->deskripsi)
                <div class="description-box">
                    <h3><i class="bi bi-file-text-fill"></i>Deskripsi</h3>
                    <p>{{ $wisata->deskripsi }}</p>
                </div>
            @endif

            @if ($wisata->sejarah)
                <div class="description-box" style="margin-top: 1rem;">
                    <h3><i class="bi bi-book-fill"></i>Sejarah</h3>
                    <p>{{ $wisata->sejarah }}</p>
                </div>
            @endif

            @if ($wisata->narasi)
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
                @forelse($wisata->jamOperasionalAdmin as $jam)
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
                                @endif
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="info-item" style="grid-column: 1 / -1; text-align: center;">
                        <i class="bi bi-calendar-x"></i>
                        <div class="text">
                            <span class="value">Belum ada data jam operasional</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Foto Gallery -->
        @if ($wisata->foto->count() > 0)
            <div class="info-card">
                <h2 class="section-title">
                    <i class="bi bi-images"></i>
                    Galeri Foto ({{ $wisata->foto->count() }})
                </h2>
                <div class="photo-gallery">
                    @foreach ($wisata->foto as $foto)
                        <div class="photo-item" onclick="openLightbox('{{ asset('storage/' . $foto->path_foto) }}')">
                            <img src="{{ asset('storage/' . $foto->path_foto) }}"
                                alt="Foto {{ $wisata->nama_wisata }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('wisata.index') }}" class="btn-action btn-secondary-action">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Kembali ke Daftar
            </a>

            <a href="{{ route('wisata.edit', $wisata->id_wisata) }}" class="btn-action btn-edit-action">
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

    <!-- Script untuk Text-to-Speech -->
    <script>
        let sedangBerbicara = false;
        let synthesis = window.speechSynthesis;
        let utterance = null;

        function bacaNarasi() {
            const btn = document.getElementById('playNarasi');
            const narasiText = document.getElementById('narasiText').textContent;

            if (sedangBerbicara) {
                synthesis.cancel();
                sedangBerbicara = false;
                btn.classList.remove('playing');
                btn.innerHTML = '<i class="bi bi-volume-up-fill"></i><span>Putar Audio</span>';
                return;
            }

            if (!('speechSynthesis' in window)) {
                alert('Browser Anda tidak mendukung fitur Text-to-Speech');
                return;
            }

            utterance = new SpeechSynthesisUtterance(narasiText);
            utterance.lang = 'id-ID';
            utterance.rate = 0.9;
            utterance.pitch = 1;
            utterance.volume = 1;

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

        function openLightbox(imageSrc) {
            document.getElementById('lightbox').classList.add('active');
            document.getElementById('lightboxImage').src = imageSrc;
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });

        window.addEventListener('beforeunload', function() {
            if (sedangBerbicara) {
                synthesis.cancel();
            }
        });
    </script>
</body>

</html>
