<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori Kuliner - Kotabaru Tourism</title>
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

        /* Alert Error */
        .alert-error-custom {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            border: none;
            border-left: 4px solid #f44336;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
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

        .alert-error-custom i {
            font-size: 24px;
            color: #f44336;
            margin-top: 2px;
        }

        .alert-success-custom .alert-content,
        .alert-error-custom .alert-content {
            flex: 1;
            font-weight: 500;
        }

        .alert-success-custom .alert-content {
            color: #1b5e20;
        }

        .alert-error-custom .alert-content {
            color: #c62828;
        }

        .alert-error-custom .alert-content ul {
            margin: 0.5rem 0 0 0;
            padding-left: 1.2rem;
        }

        .alert-error-custom .alert-content li {
            margin-bottom: 0.25rem;
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

        /* Stats Card */
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
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
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .stat-info h3 {
            font-size: 32px;
            font-weight: 700;
            color: #1b5e20;
            margin: 0;
        }

        .stat-info p {
            font-size: 13px;
            color: #666;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Additional Stats */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .mini-stat {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mini-stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .mini-stat-icon.active {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #2e7d32;
        }

        .mini-stat-icon.inactive {
            background: linear-gradient(135deg, #fafafa 0%, #e0e0e0 100%);
            color: #757575;
        }

        .mini-stat-info h4 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .mini-stat-info h4.active-count {
            color: #2e7d32;
        }

        .mini-stat-info h4.inactive-count {
            color: #757575;
        }

        .mini-stat-info p {
            font-size: 11px;
            color: #999;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
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

        /* Badge Kategori */
        .badge-category {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Status Badge */
        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #2e7d32;
        }

        .status-inactive {
            background: linear-gradient(135deg, #fafafa 0%, #e0e0e0 100%);
            color: #757575;
        }

        /* Usage Badge */
        .usage-badge {
            background: #f5f5f5;
            color: #666;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .btn-toggle {
            background: #2196f3;
            color: white;
        }

        .btn-toggle:hover {
            background: #1976d2;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
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

        /* Responsive */
        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 28px;
            }

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .stat-card {
                flex-direction: column;
                text-align: center;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
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
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div style="color: #1b5e20; font-weight: 600;">Memuat data...</div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="header-section">
        <div class="container text-center">
            <h1><i class="bi bi-tags-fill me-2"></i>Daftar Kategori Kuliner</h1>
            <p>Kelola kategori sentra kuliner Kotabaru Tourism Data Center</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="main-container">

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

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="alert-error-custom">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div class="alert-content">
                        <strong>Terjadi Kesalahan!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Toolbar -->
            <div class="toolbar">
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
                <a href="{{ route('kategori-kuliner.create') }}" class="btn-custom btn-add">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Kategori
                </a>
            </div>

            <!-- Stats Row -->
            <div class="stats-row">
                <!-- Total Kategori -->
                <div class="stat-card" style="grid-column: span 2;">
                    <div class="stat-icon">
                        <i class="bi bi-collection-fill"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $kategori->count() }}</h3>
                        <p>Total Kategori Kuliner</p>
                    </div>
                </div>

                <!-- Kategori Aktif -->
                <div class="mini-stat">
                    <div class="mini-stat-icon active">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="mini-stat-info">
                        <h4 class="active-count">{{ $kategori->where('status', true)->count() }}</h4>
                        <p>Kategori Aktif</p>
                    </div>
                </div>

                <!-- Kategori Nonaktif -->
                <div class="mini-stat">
                    <div class="mini-stat-icon inactive">
                        <i class="bi bi-dash-circle-fill"></i>
                    </div>
                    <div class="mini-stat-info">
                        <h4 class="inactive-count">{{ $kategori->where('status', false)->count() }}</h4>
                        <p>Kategori Nonaktif</p>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 40%;">Nama Kategori</th>
                                <th style="width: 20%;" class="text-center">Digunakan</th>
                                <th style="width: 15%;" class="text-center">Status</th>
                                <th style="width: 20%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategori as $index => $kat)
                                <tr>
                                    <td class="text-center"><strong>{{ $index + 1 }}</strong></td>
                                    <td>
                                        <div class="badge-category">
                                            <i class="bi bi-bookmark-fill"></i>
                                            {{ $kat->nama_kategori }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $usageCount = $kat->tempatKuliner()->count();
                                        @endphp
                                        @if ($usageCount > 0)
                                            <span class="usage-badge">
                                                <i class="bi bi-shop"></i>
                                                {{ $usageCount }} tempat
                                            </span>
                                        @else
                                            <span class="text-muted" style="font-size: 12px;">
                                                <i class="bi bi-dash-circle"></i> Belum digunakan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($kat->status)
                                            <span class="status-badge status-active">
                                                <i class="bi bi-check-circle-fill"></i>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="status-badge status-inactive">
                                                <i class="bi bi-dash-circle-fill"></i>
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <form
                                                action="{{ route('kategori-kuliner.toggle-status', $kat->id_kategori) }}"
                                                method="POST" style="display:inline;" class="toggle-form">
                                                @csrf
                                                <button type="button" class="btn-action btn-toggle"
                                                    onclick="confirmToggle(this, '{{ $kat->nama_kategori }}', {{ $kat->status ? 'true' : 'false' }})">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                    {{ $kat->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <i class="bi bi-inbox"></i>
                                            <h4>Belum Ada Kategori</h4>
                                            <p>Mulai tambahkan kategori kuliner dengan klik tombol "Tambah Kategori" di
                                                atas</p>
                                            <a href="{{ route('kategori-kuliner.create') }}"
                                                class="btn-custom btn-add">
                                                <i class="bi bi-plus-circle"></i>
                                                Tambah Kategori Sekarang
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
        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-success-custom, .alert-error-custom');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Confirm Toggle Status
        function confirmToggle(button, kategoriNama, isActive) {
            const action = isActive ? 'nonaktifkan' : 'aktifkan';
            const actionCap = isActive ? 'Nonaktifkan' : 'Aktifkan';

            Swal.fire({
                title: `${actionCap} Kategori?`,
                html: `Yakin ingin ${action} kategori <strong>"${kategoriNama}"</strong>?<br><br>
                       <small class="text-muted">${isActive
                           ? '⚠️ Kategori yang dinonaktifkan tidak akan muncul di:<br>• Form tambah/edit tempat kuliner<br>• Halaman index kuliner<br>• Detail kuliner public<br>• API public'
                           : '✅ Kategori yang diaktifkan akan muncul kembali di form input dan tampilan public.'}</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2196f3',
                cancelButtonColor: '#9e9e9e',
                confirmButtonText: `<i class="bi bi-arrow-repeat me-2"></i>Ya, ${actionCap}!`,
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

        // Handle form submissions
        document.querySelectorAll('form:not(.delete-form):not(.toggle-form)').forEach(form => {
            form.addEventListener('submit', function() {
                document.getElementById('loadingOverlay').classList.add('active');
            });
        });
    </script>
</body>

</html>
