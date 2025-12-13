<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Explore Kotabaru - Discover Hidden Paradise</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles & Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #f8f5f0;
        }

        /* Navbar Transparan */
        .navbar-custom {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1.5rem 3rem;
            background: rgba(34, 87, 50, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 1rem 3rem;
        }

        .navbar-custom .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-custom.scrolled .navbar-brand,
        .navbar-custom.scrolled .nav-link {
            color: #1b5e20 !important;
        }

        .navbar-custom .nav-link {
            color: white;
            font-weight: 500;
            margin: 0 1rem;
            transition: all 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #ffd54f !important;
        }

        .btn-explore {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            padding: 0.7rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-explore:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(46, 125, 50, 0.4);
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)),
                url('{{ asset('images/bg-login.png') }}') center/cover;
            animation: zoomIn 20s infinite alternate;
        }

        @keyframes zoomIn {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 900px;
            padding: 0 2rem;
        }

        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 72px;
            font-weight: 900;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease;
        }

        .hero-content p {
            font-size: 22px;
            margin-bottom: 2.5rem;
            font-weight: 300;
            letter-spacing: 1px;
            animation: fadeInUp 1.2s ease;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            animation: fadeInUp 1.4s ease;
        }

        .btn-hero {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-hero {
            background: white;
            color: #1b5e20;
        }

        .btn-primary-hero:hover {
            background: #ffd54f;
            color: #1b5e20;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 213, 79, 0.4);
        }

        .btn-secondary-hero {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary-hero:hover {
            background: white;
            color: #1a1a1a;
            transform: translateY(-3px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            animation: bounce 2s infinite;
        }

        .scroll-indicator i {
            color: white;
            font-size: 32px;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(10px);
            }
        }

        /* Section Styling */
        section {
            padding: 100px 0;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: #1b5e20;
        }

        .section-subtitle {
            text-align: center;
            font-size: 18px;
            color: #2e7d32;
            max-width: 600px;
            margin: 0 auto 4rem;
        }

        /* Quick Search */
        .quick-search {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            padding: 80px 0;
        }

        .search-box {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 60px;
            padding: 1rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            display: flex;
            gap: 1rem;
        }

        .search-box input {
            flex: 1;
            border: none;
            padding: 1rem 2rem;
            font-size: 16px;
            outline: none;
        }

        .search-box select {
            border: none;
            padding: 1rem;
            font-size: 16px;
            background: transparent;
            outline: none;
            cursor: pointer;
        }

        .search-box button {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-box button:hover {
            transform: scale(1.05);
        }

        /* Destination Cards */
        .destination-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 400px;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .destination-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.4s ease;
        }

        .destination-card:hover img {
            transform: scale(1.1);
        }

        .destination-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 2rem;
            color: white;
        }

        .destination-overlay h3 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .destination-overlay p {
            font-size: 14px;
            opacity: 0.9;
        }

        .destination-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 213, 79, 0.95);
            color: #1b5e20;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Map Section */
        .map-section {
            background: #e8f5e9;
        }

        #interactiveMap {
            height: 600px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .map-controls {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            height: 600px;
            overflow-y: auto;
        }

        .map-controls::-webkit-scrollbar {
            width: 8px;
        }

        .map-controls::-webkit-scrollbar-thumb {
            background: #388e3c;
            border-radius: 10px;
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-group label {
            font-weight: 600;
            color: #1b5e20;
            margin-bottom: 0.5rem;
            display: block;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #c8e6c9;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            border-color: #388e3c;
            outline: none;
        }

        .place-list {
            margin-top: 1.5rem;
        }

        .place-item {
            padding: 1rem;
            background: #ffffff;
            border-radius: 10px;
            margin-bottom: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #c8e6c9;
        }

        .place-item:hover {
            background: #388e3c;
            color: white;
            transform: translateX(5px);
            border-color: #388e3c;
        }

        .place-item h6 {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .place-item small {
            opacity: 0.8;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
            text-align: center;
        }

        .stat-item {
            padding: 2rem;
        }

        .stat-item i {
            font-size: 48px;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .stat-item h2 {
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            font-size: 18px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)),
                url('{{ asset('images/cta-kotabaru.jpg') }}') center/cover;
            color: white;
            text-align: center;
            padding: 150px 0;
        }

        .cta-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            font-size: 20px;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 3rem 0 1.5rem;
        }

        footer h5 {
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: #ffd700;
            padding-left: 5px;
        }

        .social-links a {
            display: inline-block;
            margin-right: 1rem;
            font-size: 24px;
        }

        /* Search Results Dropdown */
        #searchResults {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 20px;
            margin-top: 0.5rem;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 100;
        }

        .search-result-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-result-item:hover {
            background: #f8f9fa;
            padding-left: 2rem;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 42px;
            }

            .hero-content p {
                font-size: 18px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .section-title {
                font-size: 36px;
            }

            .navbar-custom {
                padding: 1rem;
            }

            .search-box {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
                KOTABARU
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#culinary">Culinary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#map">Explore Map</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h1>Discover Kotabaru</h1>
            <p>Heritage Garden City - Where Colonial Charm Meets Yogyakarta's Soul</p>
            <div class="hero-buttons">
                <a href="#destinations" class="btn-hero btn-primary-hero">
                    Explore Destinations
                </a>
                <a href="#map" class="btn-hero btn-secondary-hero">
                    View Map
                </a>
            </div>
        </div>
        <div class="scroll-indicator">
            <i class="bi bi-chevron-down"></i>
        </div>
    </section>

    <!-- Quick Search -->
    <section class="quick-search">
        <div class="container">
            <div style="position: relative;">
                <div class="search-box">
                    <input type="text" id="quickSearch"
                        placeholder="Search destinations, culinary, or activities...">
                    <select id="categoryFilter">
                        <option value="all">All Categories</option>
                        <option value="wisata">Tourism</option>
                        <option value="kuliner">Culinary</option>
                    </select>
                    <button onclick="performSearch()">
                        <i class="bi bi-search me-2"></i>Search
                    </button>
                </div>
                <div id="searchResults"></div>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section id="destinations">
        <div class="container">
            <h2 class="section-title">Top Destinations</h2>
            <p class="section-subtitle">Explore the most beautiful places in Kotabaru, from colonial heritage buildings
                to lush green parks</p>

            <div class="row g-4 mb-4">
                @foreach ($wisata->take(6) as $index => $w)
                    <div class="col-md-4">
                        <div class="destination-card"
                            onclick="showOnMap({{ $w->latitude }}, {{ $w->longitude }}, 'wisata')">
                            @if ($w->foto->count() > 0)
                                <img src="{{ asset('storage/' . $w->foto->first()->path_foto) }}"
                                    alt="{{ $w->nama_wisata }}">
                            @else
                                <img src="{{ asset('images/default-heritage.jpg') }}" alt="{{ $w->nama_wisata }}">
                            @endif
                            <div class="destination-badge">
                                <i
                                    class="bi bi-geo-alt-fill me-1"></i>{{ $w->kategoriWisata->nama_kategori ?? 'Tourism' }}
                            </div>
                            <div class="destination-overlay">
                                <h3>{{ $w->nama_wisata }}</h3>
                                <p><i class="bi bi-pin-map me-1"></i>Kotabaru, Yogyakarta</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="#map" class="btn-hero btn-primary-hero">
                    View All Destinations <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Culinary Section -->
    <section id="culinary" style="background: #f5f1e8;">
        <div class="container">
            <h2 class="section-title">Local Culinary</h2>
            <p class="section-subtitle">Taste the authentic flavors of Kotabaru's traditional and modern cuisine</p>

            <div class="row g-4 mb-4">
                @foreach ($kulinerFiltered->take(6) as $k)
                    <div class="col-md-4">
                        <div class="destination-card"
                            onclick="showOnMap({{ $k->latitude }}, {{ $k->longitude }}, 'kuliner')">
                            @if ($k->foto->count() > 0)
                                <img src="{{ asset('storage/' . $k->foto->first()->path_foto) }}"
                                    alt="{{ $k->nama_sentra }}">
                            @else
                                <img src="{{ asset('images/default-culinary.jpg') }}" alt="{{ $k->nama_sentra }}">
                            @endif
                            <div class="destination-badge"
                                style="background: rgba(212, 175, 55, 0.95); color: #3e2723;">
                                <i class="bi bi-cup-hot-fill me-1"></i>Culinary
                            </div>
                            <div class="destination-overlay">
                                <h3>{{ $k->nama_sentra }}</h3>
                                <p><i class="bi bi-star-fill me-1"></i>Local Favorite</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="text-center">
        <a href="#map" class="btn-hero btn-primary-hero">
            Explore More Culinary <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
    </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="stat-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <h2>{{ $wisata->count() }}</h2>
                        <p>Destinations</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-item">
                        <i class="bi bi-cup-hot-fill"></i>
                        <h2>{{ $kulinerFiltered->count() }}</h2>
                        <p>Culinary Spots</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Map Section -->
    <section id="map" class="map-section">
        <div class="container-fluid px-5">
            <h2 class="section-title">Explore Interactive Map</h2>
            <p class="section-subtitle">Find the perfect destination near you with our interactive map</p>

            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="map-controls">
                        <div class="filter-group">
                            <label><i class="bi bi-search me-2"></i>Search Location</label>
                            <input type="text" id="mapSearch" placeholder="Search..." onkeyup="searchOnMap()">
                        </div>

                        <div class="filter-group">
                            <label><i class="bi bi-funnel me-2"></i>Filter Tourism</label>
                            <select id="wisataFilter" onchange="filterWisata()">
                                <option value="semua">All Categories</option>
                                @foreach ($kategoriWisataList as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label><i class="bi bi-funnel me-2"></i>Filter Culinary</label>
                            <select id="kulinerFilter" onchange="filterKuliner()">
                                <option value="semua">All Types</option>
                                @foreach ($kategoriKulinerList as $k)
                                    <option value="{{ $k }}">{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-explore w-100 mb-3" onclick="getNearby()">
                            <i class="bi bi-compass me-2"></i>Find Nearby
                        </button>

                        <div class="place-list">
                            <h6 class="fw-bold mb-3">Popular Places</h6>
                            @foreach ($wisata->take(5) as $w)
                                <div class="place-item"
                                    onclick="focusOnPlace({{ $w->latitude }}, {{ $w->longitude }})">
                                    <h6>{{ $w->nama_wisata }}</h6>
                                    <small><i class="bi bi-geo-alt me-1"></i>Tourism Destination</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="interactiveMap"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Start Your Journey Today</h2>
            <p>Plan your perfect trip to Kotabaru and create unforgettable memories</p>
            <a href="#map" class="btn-hero btn-primary-hero" style="background: #d4af37; color: #3e2723;">
                Plan Your Trip <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Kotabaru Tourism</h5>
                    <p style="color: rgba(255,255,255,0.7);">Discover the hidden paradise of Kotabaru Yogyakarta.
                        Experience heritage, culture, and culinary delights.</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Explore</h5>
                    <a href="#destinations">Destinations</a>
                    <a href="#culinary">Culinary</a>
                    <a href="#map">Map</a>
                    <a href="#">Events</a>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Information</h5>
                    <a href="#">About Kotabaru</a>
                    <a href="#">Travel Guide</a>
                    <a href="#">Contact Us</a>
                    <a href="#">FAQ</a>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Contact</h5>
                    <a href="#"><i class="bi bi-envelope me-2"></i>info@kotabaru-tourism.id</a>
                    <a href="#"><i class="bi bi-telephone me-2"></i>+62 123 4567 890</a>
                    <a href="#"><i class="bi bi-geo-alt me-2"></i>Kotabaru, Gondokusuman, Yogyakarta</a>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 2rem 0;">
            <div class="text-center" style="color: rgba(255,255,255,0.6);">
                <p class="mb-0">&copy; 2025 Kotabaru Tourism Data Center. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Initialize Map dengan koordinat Kotabaru Yogyakarta
        const map = L.map('interactiveMap').setView([-7.78694, 110.375], 15);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO',
            maxZoom: 20
        }).addTo(map);

        fetch('/geojson/kotabru.geojson')
            .then(res => res.json())
            .then(data => {
                var border = L.geoJSON(data, {
                    style: {
                        color: "#ff5500",
                        weight: 3,
                        fillOpacity: 0
                    }
                }).addTo(map);

                map.fitBounds(border.getBounds());
            });

        // Store markers
        let wisataMarkers = [];
        let kulinerMarkers = [];

        // Add Tourism Markers
        @foreach ($wisata as $w)
            @if ($w->latitude && $w->longitude)
                {
                    const wisataIcon = L.icon({
                        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    const marker = L.marker([{{ $w->latitude }}, {{ $w->longitude }}], {
                        icon: wisataIcon,
                        kategori: '{{ $w->id_kategori }}'
                    }).addTo(map);

                    marker.bindPopup(`
                        <div style="min-width: 200px;">
                            <h6 class="fw-bold mb-2">{{ $w->nama_wisata }}</h6>
                            <p class="mb-2 small">{{ $w->kategoriWisata->nama_kategori ?? 'Tourism' }}</p>
                            <a href="{{ route('user.wisata.show', $w->id_wisata) }}" class="btn btn-sm btn-primary w-100">
                                View Details
                            </a>
                        </div>
                    `);

                    wisataMarkers.push(marker);
                }
            @endif
        @endforeach

        // Add Culinary Markers
        @foreach ($kulinerFiltered as $k)
            @if ($k->latitude && $k->longitude)
                {
                    const kulinerIcon = L.icon({
                        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    @php
                        $kategoriArray = json_decode($k->kategori, true) ?: [];
                    @endphp

                    const marker = L.marker([{{ $k->latitude }}, {{ $k->longitude }}], {
                        icon: kulinerIcon,
                        kategori: '{{ implode(',', $kategoriArray) }}'
                    }).addTo(map);

                    marker.bindPopup(`
                        <div style="min-width: 200px;">
                            <h6 class="fw-bold mb-2">{{ $k->nama_sentra }}</h6>
                            <p class="mb-2 small">Culinary Spot</p>
                            <a href="{{ route('user.kuliner.show', $k->id_kuliner) }}" class="btn btn-sm btn-danger w-100">
                                View Details
                            </a>
                        </div>
                    `);

                    kulinerMarkers.push(marker);
                }
            @endif
        @endforeach

        // Show on Map Function
        function showOnMap(lat, lng, type) {
            const mapSection = document.getElementById('map');
            mapSection.scrollIntoView({
                behavior: 'smooth'
            });

            setTimeout(() => {
                map.setView([lat, lng], 16);

                // Find and open the popup
                if (type === 'wisata') {
                    wisataMarkers.forEach(marker => {
                        const latLng = marker.getLatLng();
                        if (latLng.lat === lat && latLng.lng === lng) {
                            marker.openPopup();
                        }
                    });
                } else {
                    kulinerMarkers.forEach(marker => {
                        const latLng = marker.getLatLng();
                        if (latLng.lat === lat && latLng.lng === lng) {
                            marker.openPopup();
                        }
                    });
                }
            }, 1000);
        }

        // Focus on Place
        function focusOnPlace(lat, lng) {
            map.setView([lat, lng], 16);
        }

        // Filter Wisata
        function filterWisata() {
            const filter = document.getElementById('wisataFilter').value;

            wisataMarkers.forEach(marker => {
                if (filter === 'semua' || marker.options.kategori === filter) {
                    marker.addTo(map);
                } else {
                    map.removeLayer(marker);
                }
            });
        }

        // Filter Kuliner
        function filterKuliner() {
            const filter = document.getElementById('kulinerFilter').value;

            kulinerMarkers.forEach(marker => {
                const kategoriList = marker.options.kategori.split(',');
                if (filter === 'semua' || kategoriList.includes(filter)) {
                    marker.addTo(map);
                } else {
                    map.removeLayer(marker);
                }
            });
        }

        // Get Nearby Places
        function getNearby() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        map.setView([lat, lng], 14);

                        // Add user location marker
                        const userIcon = L.icon({
                            iconUrl: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32]
                        });

                        L.marker([lat, lng], {
                                icon: userIcon
                            })
                            .addTo(map)
                            .bindPopup('Your Location')
                            .openPopup();
                    },
                    function() {
                        alert('Unable to get your location. Please enable location services.');
                    }
                );
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        }

        // Quick Search with Debounce
        let searchTimeout;
        const quickSearchInput = document.getElementById('quickSearch');
        const searchResultsDiv = document.getElementById('searchResults');

        quickSearchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length < 2) {
                searchResultsDiv.innerHTML = '';
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/search?query=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.length === 0) {
                            searchResultsDiv.innerHTML = `
                                <div class="search-result-item">
                                    <strong>No results found</strong>
                                </div>
                            `;
                            return;
                        }

                        let html = '';
                        data.forEach(item => {
                            html += `
                                <div class="search-result-item" onclick="searchResultClick(${item.latitude}, ${item.longitude}, '${item.tipe}')">
                                    <strong>${item.nama}</strong>
                                    <br>
                                    <small class="text-muted">${item.tipe}</small>
                                </div>
                            `;
                        });
                        searchResultsDiv.innerHTML = html;
                    })
                    .catch(err => {
                        console.error('Search error:', err);
                    });
            }, 300);
        });

        // Handle search result click
        function searchResultClick(lat, lng, type) {
            searchResultsDiv.innerHTML = '';
            quickSearchInput.value = '';
            showOnMap(lat, lng, type);
        }

        // Perform Search Button
        function performSearch() {
            const query = quickSearchInput.value.trim();
            if (query.length > 0) {
                // Trigger the input event to show results
                quickSearchInput.dispatchEvent(new Event('input'));
            }
        }

        // Close search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!quickSearchInput.contains(e.target) && !searchResultsDiv.contains(e.target)) {
                searchResultsDiv.innerHTML = '';
            }
        });

        // Map Search
        function searchOnMap() {
            const query = document.getElementById('mapSearch').value.toLowerCase();

            if (query.length < 2) return;

            let found = false;

            // Search in wisata markers
            wisataMarkers.forEach(marker => {
                const popup = marker.getPopup();
                if (popup) {
                    const content = popup.getContent().toLowerCase();
                    if (content.includes(query)) {
                        marker.openPopup();
                        map.setView(marker.getLatLng(), 16);
                        found = true;
                    }
                }
            });

            // If not found in wisata, search in kuliner
            if (!found) {
                kulinerMarkers.forEach(marker => {
                    const popup = marker.getPopup();
                    if (popup) {
                        const content = popup.getContent().toLowerCase();
                        if (content.includes(query)) {
                            marker.openPopup();
                            map.setView(marker.getLatLng(), 16);
                            found = true;
                        }
                    }
                });
            }
        }

        // Animation on Scroll
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe destination cards
        document.querySelectorAll('.destination-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Observe stat items
        document.querySelectorAll('.stat-item').forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    </script>
</body>

</html>
