<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Admin - Kotabaru Tourism</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

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

        /* Search Bar */
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
            width: 100%;
        }

        .table-custom thead {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            display: table-header-group !important;
        }

        .table-custom thead tr {
            display: table-row !important;
        }

        .table-custom thead th {
            font-weight: 600;
            font-size: 14px;
            padding: 16px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff !important;
            background: transparent;
            display: table-cell !important;
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

        /* Role Badge */
        .role-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-super-admin {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .role-admin {
            background: linear-gradient(135deg, #0277bd 0%, #0288d1 100%);
            color: white;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 6px;
            justify-content: center;
            flex-wrap: nowrap;
            white-space: nowrap;
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

            .action-buttons {
                gap: 4px;
            }

            .btn-action {
                padding: 6px 10px;
                font-size: 11px;
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
            <h1><i class="bi bi-people-fill me-2"></i>Manajemen Admin</h1>
            <p>Kelola akun administrator sistem Kotabaru Tourism Data Center</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="main-container">

            <!-- Toolbar -->
            <div class="toolbar">
                <div class="toolbar-left">
                    <a href="{{ route('dashboard.superadmin') }}" class="btn-custom btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Dashboard
                    </a>
                </div>
                <div class="toolbar-right">
                    <a href="{{ route('superadmin.admin.create') }}" class="btn-custom btn-add">
                        <i class="bi bi-person-plus-fill"></i>
                        Tambah Admin
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

            <!-- Stats Card -->
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ count($admins) }}</h3>
                    <p>Total Administrator</p>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="search-filter-bar">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari username atau role..." onkeyup="searchTable()">
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-custom" id="adminTable">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 35%;">Username</th>
                                <th style="width: 25%;">Role</th>
                                <th style="width: 30%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $index => $admin)
                                <tr>
                                    <td class="text-center"><strong>{{ $index + 1 }}</strong></td>
                                    <td>
                                        <strong style="color: #1b5e20;">{{ $admin->username }}</strong>
                                    </td>
                                    <td class="text-center">
                                        <span class="role-badge {{ $admin->role === 'Super Admin' ? 'role-super-admin' : 'role-admin' }}">
                                            {{ $admin->role }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('superadmin.admin.edit', $admin->id_user) }}" class="btn-action btn-edit">
                                                <i class="bi bi-pencil-fill"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('superadmin.admin.delete', $admin->id_user) }}" method="POST" style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action btn-delete" onclick="confirmDelete(this, '{{ $admin->username }}')">
                                                    <i class="bi bi-trash-fill"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row">
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="bi bi-person-x"></i>
                                            <h4>Belum Ada Data Admin</h4>
                                            <p>Mulai tambahkan data admin dengan klik tombol "Tambah Admin" di atas</p>
                                            <a href="{{ route('superadmin.admin.create') }}" class="btn-custom btn-add">
                                                <i class="bi bi-person-plus-fill"></i>
                                                Tambah Admin Sekarang
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

        // Search Table
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('adminTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                if (row.classList.contains('empty-row')) continue;

                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        }

        // Confirm Delete with SweetAlert2
        function confirmDelete(button, username) {
            Swal.fire({
                title: 'Hapus Admin?',
                html: `Yakin ingin menghapus admin <strong>"${username}"</strong>?<br><br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan!</small>`,
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
                if (!this.getAttribute('href').startsWith('#') && !this.classList.contains('btn-close')) {
                    document.getElementById('loadingOverlay').classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
