<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Tempat Kuliner - Kotabaru Tourism</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

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
            padding: 2.5rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .header-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-section p {
            font-size: 15px;
            opacity: 0.95;
            margin: 0;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        /* Alert Success */
        .alert-success-custom {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border: none;
            border-left: 4px solid #388e3c;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success-custom i {
            font-size: 24px;
            color: #2e7d32;
        }

        .alert-success-custom .alert-content {
            flex: 1;
            color: #1b5e20;
            font-weight: 500;
        }

        /* Toolbar */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .toolbar-left {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .toolbar-right {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Buttons */
        .btn-custom {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
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

        .btn-add {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
            color: white;
        }

        .btn-export {
            background: linear-gradient(135deg, #ffd54f 0%, #ffca28 100%);
            color: #1b5e20;
            box-shadow: 0 4px 15px rgba(255, 213, 79, 0.3);
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 213, 79, 0.4);
            color: #1b5e20;
        }

        /* Search & Filter */
        .search-filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px 12px 45px;
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #66bb6a;
            font-size: 18px;
        }

        .filter-select {
            padding: 12px 16px;
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            font-size: 14px;
            min-width: 180px;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        /* Filter Status */
        .filter-status {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .filter-btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: 2px solid #e0e0e0;
            background: white;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-btn:hover {
            border-color: #2e7d32;
            color: #2e7d32;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            border-color: #2e7d32;
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .table-responsive {
            border-radius: 15px;
        }

        /* Table Styling */
        .table-custom {
            margin-bottom: 0;
        }

        .table-custom thead {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
        }

        .table-custom thead th {
            font-weight: 600;
            font-size: 14px;
            padding: 16px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom tbody tr {
            border-bottom: 1px solid #e8f5e9;
            transition: all 0.3s ease;
        }

        .table-custom tbody tr:hover {
            background: #f1f8f4;
        }

        .table-custom tbody tr:last-child {
            border-bottom: none;
        }

        .table-custom tbody td {
            padding: 16px;
            vertical-align: middle;
            font-size: 14px;
            color: #333;
        }

        /* Row Status - Inactive */
        .table-custom tbody tr.inactive-row {
            background: #ffebee;
            opacity: 0.7;
        }

        .table-custom tbody tr.inactive-row:hover {
            background: #ffcdd2;
            opacity: 0.85;
        }

        .table-custom tbody tr.inactive-row td {
            color: #999;
        }

        /* Badge Category */
        .badge-category {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin: 2px;
            display: inline-block;
        }

        .badge-category-inactive {
            background: linear-gradient(135deg, #9e9e9e 0%, #757575 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin: 2px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            opacity: 0.7;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.active {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #2e7d32;
        }

        .status-badge.inactive {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            color: #d32f2f;
        }

        .status-badge i {
            font-size: 10px;
        }

        /* Toggle Status Switch */
        .status-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .status-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 26px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 6px;
            justify-content: center;
            flex-wrap: nowrap;
        }

        .btn-action {
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }

        .btn-detail {
            background: #2196f3;
            color: white;
        }

        .btn-detail:hover {
            background: #1976d2;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
            color: white;
        }

        .btn-edit {
            background: #ff9800;
            color: white;
        }

        .btn-edit:hover {
            background: #f57c00;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
            color: white;
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background: #d32f2f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 80px;
            color: #c8e6c9;
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: #666;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #999;
            margin-bottom: 1.5rem;
        }

        /* Stats Card */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
        }

        .stat-icon.total {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
        }

        .stat-icon.active {
            background: linear-gradient(135deg, #1976d2 0%, #2196f3 100%);
        }

        .stat-icon.inactive {
            background: linear-gradient(135deg, #d32f2f 0%, #f44336 100%);
        }

        .stat-info h3 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }

        .stat-info.total h3 {
            color: #1b5e20;
        }

        .stat-info.active h3 {
            color: #1565c0;
        }

        .stat-info.inactive h3 {
            color: #c62828;
        }

        .stat-info p {
            font-size: 13px;
            color: #666;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 28px;
            }

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .toolbar-left,
            .toolbar-right {
                flex-direction: column;
                width: 100%;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .search-filter-bar {
                flex-direction: column;
            }

            .filter-select {
                width: 100%;
            }

            .filter-status {
                justify-content: center;
            }

            .action-buttons {
                gap: 4px;
            }

            .btn-action {
                padding: 6px 10px;
                font-size: 11px;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }
        }

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-content {
            background: white;
            padding: 30px 40px;
            border-radius: 15px;
            text-align: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #e8f5e9;
            border-top-color: #2e7d32;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    

    <!-- Header Section -->
    <div class="header-section">
        <div class="container text-center">
            <h1><i class="bi bi-cup-hot-fill me-2"></i>Daftar Tempat Kuliner</h1>
            <p>Kelola data sentra kuliner Kotabaru Tourism Data Center</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="main-container">

            <!-- Toolbar -->
            <div class="toolbar">
                <div class="toolbar-left">
                    @if (auth()->user()->role === 'Super Admin')
                        <a href="{{ route('dashboard.superadmin') }}" class="btn-custom btn-back">
                            <i class="bi bi-arrow-left"></i>
                            Kembali ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('dashboard.admin') }}" class="btn-custom btn-back">
                            <i class="bi bi-arrow-left"></i>
                            Kembali ke Dashboard
                        </a>
                    @endif
                </div>
                <div class="toolbar-right">
                    <a href="{{ route('export.excel', ['tipe' => 'kuliner']) }}" class="btn-custom btn-export">
                        <i class="bi bi-file-earmark-spreadsheet"></i>
                        Export Excel
                    </a>
                    <a href="{{ route('kuliner.create') }}" class="btn-custom btn-add">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Kuliner
                    </a>
                </div>
            </div>

            <!-- Alert Success -->
            @if (session('success'))
                <div class="alert-success-custom">
                    <i class="bi bi-check-circle-fill"></i>
                    <div class="alert-content">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="bi bi-shop"></i>
                    </div>
                    <div class="stat-info total">
                        <h3>{{ $kuliner->count() }}</h3>
                        <p>Total Sentra Kuliner</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon active">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-info active">
                        <h3>{{ $kuliner->where('status', true)->count() }}</h3>
                        <p>Aktif</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon inactive">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="stat-info inactive">
                        <h3>{{ $kuliner->where('status', false)->count() }}</h3>
                        <p>Tidak Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Search & Filter Bar -->
            <div class="search-filter-bar">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput"
                        placeholder="Cari nama sentra kuliner, kategori, atau lokasi..." onkeyup="searchTable()">
                </div>
                <select class="filter-select" id="filterKategori" onchange="filterTable()">
                    <option value="">Semua Kategori</option>
                    @php
                        $allKategori = $kuliner
                            ->pluck('kategoriAktif')
                            ->flatten()
                            ->unique('id_kategori')
                            ->sortBy('nama_kategori');
                    @endphp
                    @foreach ($allKategori as $kat)
                        <option value="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
                <div class="filter-status">
                    <button class="filter-btn active" onclick="filterStatus('all')">
                        <i class="bi bi-list-ul"></i>
                        Semua
                    </button>
                    <button class="filter-btn" onclick="filterStatus('active')">
                        <i class="bi bi-check-circle"></i>
                        Aktif
                    </button>
                    <button class="filter-btn" onclick="filterStatus('inactive')">
                        <i class="bi bi-x-circle"></i>
                        Tidak Aktif
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-custom" id="kulinerTable">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 18%;">Nama Sentra</th>
                                <th style="width: 18%;">Kategori</th>
                                <th style="width: 15%;">Lokasi</th>
                                <th style="width: 9%;">Latitude</th>
                                <th style="width: 9%;">Longitude</th>
                                <th style="width: 8%;" class="text-center">Status</th>
                                <th style="width: 18%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kuliner as $index => $k)
                                <tr class="{{ $k->status ? '' : 'inactive-row' }}"
                                    data-status="{{ $k->status ? 'active' : 'inactive' }}">
                                    <td class="text-center"><strong>{{ $index + 1 }}</strong></td>
                                    <td>
                                        <strong style="color: {{ $k->status ? '#1b5e20' : '#999' }};">
                                            {{ $k->nama_sentra }}
                                        </strong>
                                    </td>
                                    <td>
                                        @php
                                            $kategoriAktif = $k->kategoriAktif;
                                            $kategoriNonaktif = $k->kategori->whereNotIn(
                                                'id_kategori',
                                                $kategoriAktif->pluck('id_kategori'),
                                            );
                                        @endphp

                                        @forelse($kategoriAktif as $kat)
                                            <span class="badge-category">{{ $kat->nama_kategori }}</span>
                                        @empty
                                        @endforelse

                                        @foreach ($kategoriNonaktif as $kat)
                                            <span class="badge-category-inactive"
                                                title="Kategori ini sudah dinonaktifkan">
                                                <i class="bi bi-dash-circle"></i>
                                                {{ $kat->nama_kategori }}
                                            </span>
                                        @endforeach

                                        @if ($kategoriAktif->isEmpty() && $kategoriNonaktif->isEmpty())
                                            <span class="text-muted small">Tidak ada kategori</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($k->alamat_lengkap, 30) }}</td>
                                    <td>{{ number_format($k->latitude, 6) }}</td>
                                    <td>{{ number_format($k->longitude, 6) }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('kuliner.toggle-status', $k->id_kuliner) }}"
                                            method="POST" class="toggle-status-form" style="display:inline;">
                                            @csrf
                                            <label class="status-switch"
                                                title="Klik untuk {{ $k->status ? 'menonaktifkan' : 'mengaktifkan' }}">
                                                <input type="checkbox" {{ $k->status ? 'checked' : '' }}
                                                    onchange="toggleStatus(this, '{{ $k->nama_sentra }}', {{ $k->status ? 'true' : 'false' }})">
                                                <span class="slider"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('kuliner.show', $k->id_kuliner) }}"
                                                class="btn-action btn-detail">
                                                <i class="bi bi-eye-fill"></i>
                                                Detail
                                            </a>
                                            <a href="{{ route('kuliner.edit', $k->id_kuliner) }}"
                                                class="btn-action btn-edit">
                                                <i class="bi bi-pencil-fill"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('kuliner.destroy', $k->id_kuliner) }}"
                                                method="POST" style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action btn-delete"
                                                    onclick="confirmDelete(this, '{{ $k->nama_sentra }}')">
                                                    <i class="bi bi-trash-fill"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row">
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <i class="bi bi-cup-straw"></i>
                                            <h4>Belum Ada Data Kuliner</h4>
                                            <p>Mulai tambahkan data sentra kuliner dengan klik tombol "Tambah Kuliner"
                                                di atas</p>
                                            <a href="{{ route('kuliner.create') }}" class="btn-custom btn-add">
                                                <i class="bi bi-plus-circle"></i>
                                                Tambah Kuliner Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Auto-hide success alert
        setTimeout(function() {
            const alert = document.querySelector('.alert-success-custom');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);

        // Search & Filter
        let currentFilter = 'all';
        let currentKategori = '';

        function searchTable() {
            filterTable();
        }

        function filterTable() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const kategoriFilter = document.getElementById('filterKategori').value.toLowerCase();
            const table = document.getElementById('kulinerTable');
            const rows = table.getElementsByTagName('tr');

            let visibleCount = 0;

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                if (row.classList.contains('empty-row')) continue;

                const cells = row.getElementsByTagName('td');
                const rowStatus = row.getAttribute('data-status');

                let matchSearch = false;
                let matchKategori = false;
                let matchStatus = false;

                // Search filter
                if (searchInput === '') {
                    matchSearch = true;
                } else {
                    for (let j = 0; j < cells.length; j++) {
                        if (cells[j].textContent.toLowerCase().indexOf(searchInput) > -1) {
                            matchSearch = true;
                            break;
                        }
                    }
                }

                // Kategori filter
                if (kategoriFilter === '') {
                    matchKategori = true;
                } else {
                    const kategoriCell = cells[2]; // kolom kategori
                    if (kategoriCell && kategoriCell.textContent.toLowerCase().indexOf(kategoriFilter) > -1) {
                        matchKategori = true;
                    }
                }

                // Status filter
                if (currentFilter === 'all') {
                    matchStatus = true;
                } else if (currentFilter === 'active' && rowStatus === 'active') {
                    matchStatus = true;
                } else if (currentFilter === 'inactive' && rowStatus === 'inactive') {
                    matchStatus = true;
                }

                // Show/hide row
                if (matchSearch && matchKategori && matchStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            showNoResultsMessage(visibleCount);
        }

        function showNoResultsMessage(visibleCount) {
            const table = document.getElementById('kulinerTable');
            let noResultsRow = document.getElementById('noResultsRow');

            if (visibleCount === 0) {
                if (!noResultsRow) {
                    const tbody = table.querySelector('tbody');
                    noResultsRow = document.createElement('tr');
                    noResultsRow.id = 'noResultsRow';
                    noResultsRow.innerHTML = `
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-search"></i>
                                <h4>Tidak Ada Hasil</h4>
                                <p>Tidak ditemukan data yang sesuai dengan pencarian atau filter Anda</p>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(noResultsRow);
                }
                noResultsRow.style.display = '';
            } else {
                if (noResultsRow) {
                    noResultsRow.style.display = 'none';
                }
            }
        }

        // Filter by Status
        function filterStatus(status) {
            currentFilter = status;

            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            event.target.closest('.filter-btn').classList.add('active');

            // Apply filter
            filterTable();
        }

        // Toggle Status with Confirmation
        function toggleStatus(checkbox, sentraName, currentStatus) {
            const newStatus = !currentStatus;
            const statusText = newStatus ? 'mengaktifkan' : 'menonaktifkan';
            const iconClass = newStatus ? 'success' : 'warning';

            Swal.fire({
                title: newStatus ? 'Aktifkan Tempat Kuliner?' : 'Nonaktifkan Tempat Kuliner?',
                html: `Yakin ingin ${statusText} <strong>"${sentraName}"</strong>?<br><br>
                       <small class="text-muted">${newStatus ?
                           '✅ Tempat kuliner akan tampil di aplikasi publik' :
                           '⚠️ Tempat kuliner akan disembunyikan dari aplikasi publik'
                       }</small>`,
                icon: iconClass,
                showCancelButton: true,
                confirmButtonColor: newStatus ? '#2e7d32' : '#ff9800',
                cancelButtonColor: '#9e9e9e',
                confirmButtonText: `<i class="bi bi-check-circle me-2"></i>Ya, ${statusText.charAt(0).toUpperCase() + statusText.slice(1)}!`,
                cancelButtonText: 'Batal',
                reverseButtons: true,
                backdrop: true,
                customClass: {
                    popup: 'rounded-4',
                    confirmButton: 'rounded-pill px-4',
                    cancelButton: 'rounded-pill px-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('loadingOverlay').classList.add('active');
                    checkbox.closest('form').submit();
                } else {
                    // Revert checkbox if cancelled
                    checkbox.checked = currentStatus;
                }
            });
        }

        // Confirm Delete with SweetAlert2
        function confirmDelete(button, sentraName) {
            Swal.fire({
                title: 'Hapus Data Kuliner?',
                html: `Yakin ingin menghapus <strong>"${sentraName}"</strong>?<br><br>
                       <small class="text-muted">⚠️ Data yang dihapus tidak dapat dikembalikan!</small><br>
                       <small class="text-muted">📸 Semua foto terkait juga akan dihapus.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f44336',
                cancelButtonColor: '#9e9e9e',
                confirmButtonText: '<i class="bi bi-trash me-2"></i>Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                backdrop: true,
                customClass: {
                    popup: 'rounded-4',
                    confirmButton: 'rounded-pill px-4',
                    cancelButton: 'rounded-pill px-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('loadingOverlay').classList.add('active');
                    button.closest('form').submit();
                }
            });
        }

        // Show loading on page transition
        document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href && !href.startsWith('#') && !href.startsWith('javascript:') && !this.classList
                    .contains('btn-close')) {
                    document.getElementById('loadingOverlay').classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
