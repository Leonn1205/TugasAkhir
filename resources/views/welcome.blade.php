<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kotabaru Tourism Data Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles & Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .header {
            background-color: #2f5233;
            color: white;
            padding: 1.5rem;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }

        #map {
            height: 500px;
            border-radius: 10px;
            border: 2px solid #ccc;
            margin-bottom: 20px;
        }

        .stat-box {
            border-radius: 10px;
            padding: 25px;
            background: white;
            text-align: center;
            border: 1px solid #ddd;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .stat-box h3 {
            font-size: 28px;
            margin: 0;
            color: #2f5233;
        }

        .stat-box p {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #555;
        }

        .fade-item {
            animation: fadeIn .2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header d-flex align-items-center justify-content-between px-4">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Kotabaru" style="height: 50px;">
            <h1 class="mb-0" style="font-size: 22px;">Kotabaru Tourism Data Center</h1>
        </div>
        @guest
            <a class="btn btn-light text-success fw-bold" href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </a>
        @endguest
    </div>
    <div class="container-fluid p-0" style="height: 100vh; overflow: hidden;">
        <div class="row m-0 h-100">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-primary text-white p-3" style="background-color: #062b5b !important;">

                <!-- Input Cari Tempat -->
                <label class="fw-bold mb-1">Cari Tempat</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari wisata / kuliner">
                <div id="searchResult" class="list-group mt-2"></div>

                <!-- Filter Kategori -->
                <label class="fw-bold mb-1">Filter Kategori</label>
                <select id="filter-kategori" class="form-select mb-3">
                    <option value="semua">Semua</option>
                    <option value="wisata">Wisata</option>
                    <option value="kuliner">Kuliner</option>
                </select>

                <!-- Rekomendasi -->
                <label class="fw-bold mb-1">Rekomendasi Terdekat</label>
                <button class="btn btn-warning w-100 mb-3 fw-bold" id="btn-rekomendasi">
                    Tampilkan
                </button>

                <!-- Status Buka -->
                <label class="fw-bold mb-1">Status Buka</label>
                <button class="btn btn-success w-100 fw-bold" id="btn-statusbuka">
                    Buka Sekarang
                </button>
            </div>

            <!-- Konten Utama -->
            <div class="col-md-9 col-lg-10 p-4" style="height: 100%; overflow-y: auto;">
                <div class="row">
                    <!-- Peta -->
                    <div id="map-container" class="col-md-12">
                        <div id="map"></div>
                    </div>

                    <!-- Panel Detail -->
                    <div id="detail-container" class="col-md-4" style="display:none;">
                        <div id="detail-panel" class="p-3 bg-white border rounded shadow-sm"
                            style="max-height:500px; overflow-y:auto;">
                            <h4 id="detail-nama" class="fw-bold"></h4>

                            <p id="detail-deskripsi"></p>
                            <h6>Jam Operasional:</h6>
                            <ul id="detail-jam"></ul>
                            <h6>Foto:</h6>
                            <div id="detail-foto" class="row"></div>
                            <a id="detail-link" href="#" class="btn btn-success mt-3">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan -->
                <h5 class="mb-3 mt-4">Ringkasan Data</h5>
                <div class="row text-center">
                    <div class="col-md-6 mb-3">
                        <div class="stat-box">
                            <h3>{{ $wisata->count() }}</h3>
                            <p>Lokasi Wisata</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="stat-box">
                            <h3>{{ $kuliner->count() }}</h3>
                            <p>Lokasi Kuliner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([-7.78694, 110.375], 15);

        L.tileLayer('https://cartodb-basemaps-a.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO',
            subdomains: 'abcd',
            maxZoom: 20
        }).addTo(map);

        let currentMarkerId = null;

        // Tempat Wisata
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
                                    "' class='img-fluid rounded'></div>";
                            })->implode('') !!}`
                    }, [{{ $w->latitude }}, {{ $w->longitude }}]);
                });
            }
        @endforeach

        // Tempat Kuliner
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
                                    "' class='img-fluid rounded'></div>";
                            })->implode('') !!}`
                    }, [{{ $k->latitude }}, {{ $k->longitude }}]);
                });
            }
        @endforeach

        // Tampilkan detail
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

        // Pencarian dengan debounce
        let debounceTimer;
        let activeIndex = -1;

        const searchInput = document.getElementById('searchInput');
        const resultBox = document.getElementById('searchResult');

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);

            const query = this.value.trim();
            if (query.length < 2) {
                resultBox.innerHTML = "";
                return;
            }

            debounceTimer = setTimeout(() => searchQuery(query), 200);
        });

        function searchQuery(query) {
            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    resultBox.innerHTML = "";
                    activeIndex = -1;

                    if (data.length === 0) {
                        resultBox.innerHTML = `<div class="list-group-item">Tidak ada hasil</div>`;
                        return;
                    }

                    data.forEach((item, index) => {
                        let highlighted = item.nama.replace(
                            new RegExp(query, "gi"),
                            match => `<strong>${match}</strong>`
                        );

                        let el = document.createElement('button');
                        el.classList.add('list-group-item', 'list-group-item-action', 'fade-item');
                        el.innerHTML = `
                        ${highlighted}
                        <small class="text-muted d-block">(${item.tipe})</small>
                    `;

                        // Klik -> fokus ke marker
                        el.addEventListener('click', () => handleResultClick(item));

                        resultBox.appendChild(el);
                    });
                });
        }

        function handleResultClick(item) {
            map.setView([item.latitude, item.longitude], 18);

            L.popup()
                .setLatLng([item.latitude, item.longitude])
                .setContent(`<b>${item.nama}</b><br>${item.tipe}`)
                .openOn(map);

            resultBox.innerHTML = "";
            searchInput.value = item.nama;
        }

        // Keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            const items = resultBox.querySelectorAll('.list-group-item');

            if (items.length === 0) return;

            if (e.key === "ArrowDown") {
                e.preventDefault();
                activeIndex = (activeIndex + 1) % items.length;
                updateActive(items);
            }
            if (e.key === "ArrowUp") {
                e.preventDefault();
                activeIndex = (activeIndex - 1 + items.length) % items.length;
                updateActive(items);
            }
            if (e.key === "Enter" && activeIndex >= 0) {
                e.preventDefault();
                items[activeIndex].click();
            }
        });

        function updateActive(items) {
            items.forEach(item => item.classList.remove('active'));
            items[activeIndex].classList.add('active');
        }

        // Klik di luar -> close list
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !resultBox.contains(e.target)) {
                resultBox.innerHTML = "";
            }
        });
    </script>
</body>

</html>
