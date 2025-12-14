<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Kotabaru Tourism Data Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            overflow-x: hidden;
        }

        /* Header/Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            font-size: 20px;
            font-weight: 600;
        }

        .navbar-brand img {
            height: 45px;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.2));
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: white;
            color: #1b5e20;
            border-color: white;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #1b5e20 0%, #2e7d32 100%);
            min-height: calc(100vh - 73px);
            padding: 1.5rem 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            margin-bottom: 0.5rem;
        }

        .menu-link {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 15px;
            position: relative;
        }

        .menu-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 25px;
        }

        .menu-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-left: 4px solid #ffd54f;
        }

        .menu-link i {
            font-size: 18px;
            width: 24px;
        }

        .menu-link .badge {
            margin-left: auto;
            background: #ffd54f;
            color: #1b5e20;
            font-size: 11px;
            padding: 4px 8px;
        }

        /* Submenu */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: rgba(0, 0, 0, 0.2);
        }

        .submenu.show {
            max-height: 200px;
        }

        .submenu .menu-link {
            padding-left: 56px;
            font-size: 14px;
        }

        .submenu .menu-link:hover {
            padding-left: 61px;
        }

        .menu-toggle {
            cursor: pointer;
        }

        .menu-toggle::after {
            content: '\F282';
            font-family: 'bootstrap-icons';
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .menu-toggle.active::after {
            transform: rotate(180deg);
        }

        /* Main Content */
        .main-content {
            padding: 2rem;
            min-height: calc(100vh - 73px);
        }

        /* Page Header - Konsisten */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-title i {
            font-size: 32px;
        }

        .page-subtitle {
            color: #666;
            font-size: 15px;
            margin-left: 42px;
        }

        /* Section Title - Konsisten */
        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: #1b5e20;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            font-size: 24px;
        }

        /* Map Section */
        .map-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        #map {
            height: 500px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Detail Panel */
        #detail-panel {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            max-height: 500px;
            overflow-y: auto;
            margin-top: 1.5rem;
        }

        #detail-panel::-webkit-scrollbar {
            width: 8px;
        }

        #detail-panel::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #detail-panel::-webkit-scrollbar-thumb {
            background: #2e7d32;
            border-radius: 10px;
        }

        #detail-nama {
            color: #1b5e20;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        #detail-panel h6 {
            color: #2e7d32;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
        }

        #detail-panel ul {
            padding-left: 1.5rem;
            margin-bottom: 0;
        }

        #detail-panel li {
            margin-bottom: 0.5rem;
            color: #555;
            font-size: 14px;
        }

        #detail-link {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        #detail-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
            color: white;
        }

        /* Stats Section */
        .stats-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background: linear-gradient(135deg, #f8fdf9 0%, #e8f5e9 100%);
            border-radius: 15px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(46, 125, 50, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #2e7d32 0%, #66bb6a 100%);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(46, 125, 50, 0.15);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            background: white;
            color: #2e7d32;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.1);
            flex-shrink: 0;
        }

        .stat-info {
            flex: 1;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: #1b5e20;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 14px;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stat-trend {
            font-size: 13px;
            color: #2e7d32;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        .stat-trend i {
            font-size: 14px;
        }

        /* Mobile Menu Toggle */
        .mobile-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 73px;
                width: 250px;
                z-index: 999;
                transition: left 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                padding: 1rem;
            }

            .page-title {
                font-size: 24px;
            }

            .page-title i {
                font-size: 24px;
            }

            .page-subtitle {
                margin-left: 34px;
            }

            .section-title {
                font-size: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            #map {
                height: 350px;
            }

            .mobile-toggle {
                display: block;
            }

            .map-section,
            .stats-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <div class="navbar-brand">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Kotabaru">
                    <span>Kotabaru Tourism Data Center</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Layout -->
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar" id="sidebar">
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{ route('dashboard.superadmin') }}" class="menu-link active">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link menu-toggle" id="wisataMenu">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Tempat Wisata</span>
                    </a>
                    <ul class="submenu" id="submenuWisata">
                        <li>
                            <a href="{{ route('wisata.index') }}" class="menu-link">
                                <i class="bi bi-list-ul"></i>
                                <span>Daftar Wisata</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kategori-wisata.index') }}" class="menu-link">
                                <i class="bi bi-tags"></i>
                                <span>Kategori Wisata</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="{{ route('kuliner.index') }}" class="menu-link">
                        <i class="bi bi-cup-hot-fill"></i>
                        <span>Tempat Kuliner</span>
                    </a>
                </li>
                @if (auth()->user()->role === 'Super Admin')
                    <li class="menu-item">
                        <a href="{{ route('superadmin.admin.index') }}" class="menu-link">
                            <i class="bi bi-people-fill"></i>
                            <span>Kelola Admin</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 main-content">

            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard Overview
                </h1>
                <p class="page-subtitle">Selamat datang di Kotabaru Tourism Data Center</p>
            </div>

            <!-- Map Section -->
            <div class="map-section">
                <h2 class="section-title">
                    <i class="bi bi-map"></i>
                    Peta Lokasi Wisata & Kuliner
                </h2>
                <div class="row">
                    <div id="map-container" class="col-12">
                        <div id="map"></div>
                    </div>
                    <div id="detail-container" class="col-12" style="display:none;">
                        <div id="detail-panel">
                            <h4 id="detail-nama"></h4>
                            <h6><i class="bi bi-clock"></i> Jam Operasional</h6>
                            <ul id="detail-jam"></ul>
                            <h6><i class="bi bi-images"></i> Foto</h6>
                            <div id="detail-foto" class="row"></div>
                            <a id="detail-link" href="#">
                                <i class="bi bi-arrow-right-circle"></i>
                                <span>Lihat Selengkapnya</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <h2 class="section-title">
                    <i class="bi bi-bar-chart-fill"></i>
                    Ringkasan Data
                </h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">{{ $wisata->count() }}</div>
                            <div class="stat-label">Lokasi Wisata</div>
                            <div class="stat-trend">
                                <i class="bi bi-graph-up-arrow"></i>
                                Total destinasi wisata
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-cup-hot-fill"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">{{ $kuliner->count() }}</div>
                            <div class="stat-label">Lokasi Kuliner</div>
                            <div class="stat-trend">
                                <i class="bi bi-graph-up-arrow"></i>
                                Total sentra kuliner
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        // Submenu Toggle
        document.getElementById("wisataMenu").addEventListener("click", function(e) {
            e.preventDefault();
            const submenu = document.getElementById("submenuWisata");
            const toggle = this;

            submenu.classList.toggle("show");
            toggle.classList.toggle("active");
        });

        // Map Initialization
        var map = L.map('map').setView([-7.78694, 110.375], 15);

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

        let currentMarkerId = null;

        // Add Wisata Markers
        @foreach ($wisata as $w)
            if ("{{ $w->latitude }}" && "{{ $w->longitude }}") {
                var wisataIcon = L.icon({
                    iconUrl: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                });

                var marker = L.marker([{{ $w->latitude }}, {{ $w->longitude }}], {
                    icon: wisataIcon
                }).addTo(map);

                marker.on('click', function() {
                    showDetail("wisata-{{ $w->id_wisata }}", {
                        nama: @json($w->nama_wisata),
                        link: @json(route('wisata.show', $w->id_wisata)),
                        jam: `{!! collect($w->jamOperasional)->map(function ($jam) {
                                return is_null($jam->jam_buka) && is_null($jam->jam_tutup)
                                    ? "<li><b>{$jam->hari}:</b> Libur</li>"
                                    : "<li><b>{$jam->hari}:</b> {$jam->jam_buka} - {$jam->jam_tutup}</li>";
                            })->implode('') !!}`,
                        foto: `{!! collect($w->foto)->map(function ($f) {
                                return "<div class='col-md-6 mb-2'><img src='" .
                                    asset('storage/' . $f->path_foto) .
                                    "' class='img-fluid rounded' style='box-shadow: 0 2px 8px rgba(0,0,0,0.1);'></div>";
                            })->implode('') !!}`
                    }, [{{ $w->latitude }}, {{ $w->longitude }}]);
                });
            }
        @endforeach

        // Add Kuliner Markers
        @foreach ($kuliner as $k)
            if ("{{ $k->latitude }}" && "{{ $k->longitude }}") {
                var kulinerIcon = L.icon({
                    iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                });

                var marker = L.marker([{{ $k->latitude }}, {{ $k->longitude }}], {
                    icon: kulinerIcon
                }).addTo(map);

                marker.on('click', function() {
                    showDetail("kuliner-{{ $k->id_kuliner }}", {
                        nama: @json($k->nama_sentra),
                        link: "{{ route('kuliner.show', $k->id_kuliner) }}",
                        jam: `{!! collect($k->jamOperasional)->map(function ($jam) {
                                return is_null($jam->jam_buka) && is_null($jam->jam_tutup)
                                    ? "<li><b>{$jam->hari}:</b> Libur</li>"
                                    : "<li><b>{$jam->hari}:</b> {$jam->jam_buka} - {$jam->jam_tutup}</li>";
                            })->implode('') !!}`,
                        foto: `{!! collect($k->foto)->map(function ($f) {
                                return "<div class='col-md-6 mb-2'><img src='" .
                                    asset('storage/' . $f->path_foto) .
                                    "' class='img-fluid rounded' style='box-shadow: 0 2px 8px rgba(0,0,0,0.1);'></div>";
                            })->implode('') !!}`
                    }, [{{ $k->latitude }}, {{ $k->longitude }}]);
                });
            }
        @endforeach

        // Show Detail Panel
        function showDetail(markerId, data, coords) {
            let detailContainer = document.getElementById('detail-container');
            let mapContainer = document.getElementById('map-container');

            if (currentMarkerId === markerId) {
                detailContainer.style.display = 'none';
                mapContainer.classList.remove('col-md-8');
                mapContainer.classList.add('col-md-12');
                currentMarkerId = null;
                map.invalidateSize();
            } else {
                detailContainer.style.display = 'block';
                mapContainer.classList.remove('col-md-12');
                mapContainer.classList.add('col-md-8');
                currentMarkerId = markerId;

                document.getElementById('detail-nama').innerText = data.nama;
                document.getElementById('detail-link').href = data.link;
                document.getElementById('detail-jam').innerHTML = data.jam;
                document.getElementById('detail-foto').innerHTML = data.foto;

                map.setView(coords, 17);
                map.invalidateSize();
            }
        }

        // Close sidebar on link click (mobile)
        document.querySelectorAll('.menu-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>
