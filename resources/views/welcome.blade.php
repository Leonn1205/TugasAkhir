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

    <!-- Konten Utama -->
    <div class="container mt-4">
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

    <!-- Leaflet Map Logic -->
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
    </script>
</body>

</html>
