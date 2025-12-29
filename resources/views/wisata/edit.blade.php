<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Tempat Wisata - Kotabaru Tourism</title>
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

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9998;
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
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
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

        .header-section {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
            background: linear-gradient(135deg, rgba(27, 94, 32, 0.95) 0%, rgba(46, 125, 50, 0.95) 100%);
            color: white;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .header-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 25px;
            max-width: 1000px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .section-divider {
            border-bottom: 2px solid #e8f5e9;
            margin: 2.5rem 0;
            position: relative;
        }

        .section-divider::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, #2e7d32 0%, #66bb6a 100%);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-label {
            font-weight: 600;
            color: #2e7d32;
            margin-bottom: 0.5rem;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label .required {
            color: #d32f2f;
        }

        .form-control {
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .kategori-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
            margin-top: 1rem;
        }

        .kategori-item {
            background: #f5f5f5;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0;
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
        }

        .kategori-item:hover {
            background: #e8f5e9;
            border-color: #66bb6a;
            transform: translateY(-2px);
        }

        .kategori-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .kategori-label {
            display: block;
            padding: 12px 40px 12px 16px;
            font-weight: 500;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            position: relative;
        }

        .kategori-item input[type="checkbox"]:checked+.kategori-label {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .kategori-item input[type="checkbox"]:checked+.kategori-label::after {
            content: '\F26E';
            font-family: 'bootstrap-icons';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
        }

        .empty-kategori {
            text-align: center;
            padding: 3rem 2rem;
            background: #fff3cd;
            border: 2px dashed #ffc107;
            border-radius: 12px;
        }

        .empty-kategori i {
            font-size: 48px;
            color: #ff9800;
            margin-bottom: 1rem;
        }

        .table-operasional {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table-operasional thead {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
        }

        .table-operasional th {
            font-weight: 600;
            font-size: 14px;
            padding: 14px 10px;
            border: none;
        }

        .table-operasional td {
            padding: 10px;
            vertical-align: middle;
            border-color: #e8f5e9;
        }

        .table-operasional input[type="time"] {
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 13px;
            width: 100%;
        }

        .table-operasional input[type="time"]:disabled {
            background: #f5f5f5;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .libur-checkbox {
            width: 22px;
            height: 22px;
            cursor: pointer;
            accent-color: #d32f2f;
        }

        .alert-info-custom {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 1.5rem;
        }

        .alert-warning-custom {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            border-left: 4px solid #ff9800;
            border-radius: 12px;
            padding: 12px 16px;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #e65100;
        }

        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 1rem;
        }

        .photo-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: white;
        }

        .photo-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .photo-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }

        .photo-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(46, 125, 50, 0.95);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .photo-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 40px 10px 10px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .photo-item:hover .photo-actions {
            opacity: 1;
        }

        .btn-delete-photo {
            background: linear-gradient(135deg, #d32f2f 0%, #f44336 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            justify-content: center;
            width: 100%;
            box-shadow: 0 2px 8px rgba(211, 47, 47, 0.3);
        }

        .btn-delete-photo:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.4);
        }

        .btn-delete-photo i {
            font-size: 14px;
        }

        .file-upload-wrapper {
            border: 2px dashed #c8e6c9;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            background: #f1f8f4;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .file-upload-wrapper:hover {
            border-color: #66bb6a;
            background: #e8f5e9;
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .btn-submit {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            font-weight: 600;
            padding: 14px 40px;
            border-radius: 50px;
            border: none;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
        }

        .btn-cancel {
            background: white;
            color: #666;
            font-weight: 600;
            padding: 14px 40px;
            border-radius: 50px;
            border: 2px solid #e0e0e0;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #f5f5f5;
            transform: translateY(-2px);
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
        }

        .counter-badge {
            background: #ffd54f;
            color: #1b5e20;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
            }

            .photo-gallery {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            }
        }
    </style>
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div style="color: #1b5e20; font-weight: 600;">Mengupdate data...</div>
        </div>
    </div>

    <div class="header-section">
        <div class="container">
            <h1><i class="bi bi-pencil-square me-2"></i>Edit Tempat Wisata</h1>
            <p>Update informasi wisata untuk Kotabaru Tourism Data Center</p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <form method="POST" action="{{ route('wisata.update', $wisata->id_wisata) }}" enctype="multipart/form-data"
                id="editForm">
                @csrf
                @method('PUT')

                <div class="section-title">
                    <i class="bi bi-info-circle-fill"></i>
                    Informasi Dasar
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-geo-alt-fill"></i>
                        Nama Tempat Wisata
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="nama_wisata" class="form-control" value="{{ $wisata->nama_wisata }}"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-tags-fill"></i>
                        Kategori Wisata
                        <span class="required">*</span>
                        <span class="counter-badge" id="selectedCount">0 dipilih</span>
                    </label>

                    @if ($kategori->isEmpty())
                        <div class="empty-kategori">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <h5>Tidak Ada Kategori Aktif</h5>
                            <p>Hubungi administrator untuk mengaktifkan kategori.</p>
                        </div>
                    @else
                        <div class="kategori-container">
                            @foreach ($kategori as $k)
                                <div class="kategori-item">
                                    <input type="checkbox" name="kategori[]" value="{{ $k->id_kategori }}"
                                        id="kat_{{ $k->id_kategori }}" class="kategori-checkbox"
                                        {{ in_array($k->id_kategori, $wisata->kategori->pluck('id_kategori')->toArray()) ? 'checked' : '' }}>
                                    <label class="kategori-label" for="kat_{{ $k->id_kategori }}">
                                        {{ $k->nama_kategori }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-map-fill"></i>
                    Lokasi & Koordinat
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-house-fill"></i>
                        Alamat Lengkap
                        <span class="required">*</span>
                    </label>
                    <textarea name="alamat_lengkap" class="form-control" rows="3" required>{{ old('alamat_lengkap', $wisata->alamat_lengkap) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">
                            <i class="bi bi-arrow-left-right"></i>
                            Longitude
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="longitude" class="form-control"
                            value="{{ old('longitude', $wisata->longitude) }}" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">
                            <i class="bi bi-arrow-up-down"></i>
                            Latitude
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="latitude" class="form-control"
                            value="{{ old('latitude', $wisata->latitude) }}" required>
                    </div>
                </div>

                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-file-text-fill"></i>
                    Deskripsi & Informasi
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-card-text"></i>
                        Deskripsi Wisata
                        <span class="required">*</span>
                    </label>
                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ $wisata->deskripsi }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-clock-history"></i>
                        Sejarah Wisata
                        <span class="required">*</span>
                    </label>
                    <textarea name="sejarah" class="form-control" rows="4" required>{{ $wisata->sejarah }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-mic-fill"></i>
                        Narasi Audio
                        <span class="required">*</span>
                    </label>
                    <textarea name="narasi" class="form-control" rows="3" required>{{ $wisata->narasi }}</textarea>
                </div>

                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-clock-fill"></i>
                    Jam Operasional
                </div>

                <div class="alert-info-custom">
                    <strong><i class="bi bi-info-circle-fill me-2"></i>Petunjuk:</strong>
                    <ul style="margin: 8px 0 0 20px; color: #1976d2;">
                        <li>Sesuaikan jam buka dan tutup</li>
                        <li>Centang "Libur" jika tidak buka</li>
                    </ul>
                </div>

                <div class="table-responsive">
                    <table class="table table-operasional">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Hari</th>
                                <th style="width: 30%;">Jam Buka</th>
                                <th style="width: 30%;">Jam Tutup</th>
                                <th style="width: 15%;" class="text-center">Libur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                $jamOps = $wisata->jamOperasionalAdmin->keyBy('hari');
                            @endphp
                            @foreach ($days as $day)
                                @php
                                    $jamData = $jamOps[$day] ?? null;
                                    $isLibur = $jamData ? $jamData->libur : false;

                                    if ($jamData && !$isLibur) {
                                        $jamBuka = $jamData->jam_buka ? $jamData->jam_buka->format('H:i') : '08:00';
                                        $jamTutup = $jamData->jam_tutup ? $jamData->jam_tutup->format('H:i') : '17:00';
                                    } else {
                                        $jamBuka = '08:00';
                                        $jamTutup = '17:00';
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <input type="hidden" name="hari[]" value="{{ $day }}">
                                        <span style="font-weight: 600; color: #1b5e20;">{{ $day }}</span>
                                    </td>
                                    <td>
                                        <input type="time" name="jam_buka[]" class="jam-buka-input"
                                            value="{{ $jamBuka }}" {{ $isLibur ? 'disabled' : '' }}>
                                    </td>
                                    <td>
                                        <input type="time" name="jam_tutup[]" class="jam-tutup-input"
                                            value="{{ $jamTutup }}" {{ $isLibur ? 'disabled' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input class="libur-checkbox" type="checkbox" name="libur[]"
                                            value="{{ $loop->index }}" {{ $isLibur ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="section-divider"></div>

                <div class="section-title">
                    <i class="bi bi-images"></i>
                    Kelola Foto
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-image-fill"></i>
                        Foto Saat Ini
                        <span class="counter-badge">{{ $wisata->foto->count() }} foto</span>
                    </label>

                    @if ($wisata->foto->count() > 0)
                        <div class="photo-gallery">
                            @foreach ($wisata->foto as $index => $f)
                                <div class="photo-item" data-photo-id="{{ $f->id_foto }}">
                                    <img src="{{ asset('storage/' . $f->path_foto) }}"
                                        alt="Foto {{ $wisata->nama_wisata }}">
                                    <div class="photo-badge">Foto {{ $index + 1 }}</div>

                                    @if ($wisata->foto->count() > 1)
                                        <div class="photo-actions">
                                            <form action="{{ route('wisata.foto.delete', $f->id_foto) }}"
                                                  method="POST"
                                                  class="delete-photo-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="btn-delete-photo"
                                                        onclick="confirmDeletePhoto(this, '{{ $wisata->nama_wisata }}', {{ $wisata->foto->count() }})">
                                                    <i class="bi bi-trash-fill"></i>
                                                    Hapus Foto
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @if ($wisata->foto->count() === 1)
                            <div class="alert-warning-custom">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Ini adalah foto terakhir. Minimal harus ada <strong>1 foto</strong>.</span>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Belum ada foto
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-cloud-upload"></i>
                        Upload Foto Baru (Opsional)
                    </label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="foto[]" multiple accept="image/*" id="fileInput">
                        <div style="font-size: 48px; color: #2e7d32; margin-bottom: 10px;">
                            <i class="bi bi-cloud-upload"></i>
                        </div>
                        <div style="color: #1b5e20; font-weight: 500;">
                            Klik untuk upload atau drag & drop
                        </div>
                        <div style="color: #666; font-size: 12px;">
                            Format: JPG, PNG, JPEG | Max: 2MB per file
                        </div>
                    </div>
                    <div id="selectedFiles"></div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Update Data
                    </button>
                    <a href="{{ route('wisata.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle me-2"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Jam Operasional Handler
            const rows = document.querySelectorAll(".table-operasional tbody tr");
            rows.forEach((row) => {
                const liburCheckbox = row.querySelector(".libur-checkbox");
                const bukaInput = row.querySelector(".jam-buka-input");
                const tutupInput = row.querySelector(".jam-tutup-input");

                const toggleDisabled = (isLibur) => {
                    bukaInput.disabled = isLibur;
                    tutupInput.disabled = isLibur;
                    row.style.opacity = isLibur ? '0.5' : '1';

                    if (isLibur) {
                        bukaInput.value = '00:00';
                        tutupInput.value = '00:00';
                    }
                };

                toggleDisabled(liburCheckbox.checked);

                liburCheckbox.addEventListener("change", function() {
                    toggleDisabled(this.checked);
                    if (!this.checked && bukaInput.value === '00:00') {
                        bukaInput.value = '08:00';
                        tutupInput.value = '17:00';
                    }
                });
            });

            // Kategori Counter
            const kategoriCheckboxes = document.querySelectorAll('.kategori-checkbox');
            const selectedCountBadge = document.getElementById('selectedCount');

            function updateKategoriCount() {
                const checkedCount = document.querySelectorAll('.kategori-checkbox:checked').length;
                if (selectedCountBadge) {
                    selectedCountBadge.textContent = `${checkedCount} dipilih`;
                }
            }

            updateKategoriCount();
            kategoriCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateKategoriCount);
            });

            // Form Validation
            const form = document.getElementById('editForm');
            const loadingOverlay = document.getElementById('loadingOverlay');

            form.addEventListener('submit', function(e) {
                const hasKategori = kategoriCheckboxes.length > 0;
                const kategoriChecked = document.querySelectorAll('.kategori-checkbox:checked').length;

                if (hasKategori && kategoriChecked === 0) {
                    e.preventDefault();
                    alert('❌ Pilih minimal 1 kategori wisata!');
                    return false;
                }

                loadingOverlay.classList.add('active');
            });
        });

        // Confirm Delete Photo
        function confirmDeletePhoto(button, wisataName, totalPhotos) {
            if (totalPhotos <= 1) {
                Swal.fire({
                    title: 'Tidak Dapat Menghapus!',
                    html: `Ini adalah foto terakhir dari <strong>"${wisataName}"</strong>.<br><br>
                           <small class="text-muted">💡 Minimal harus ada <strong>1 foto</strong> untuk setiap tempat wisata.</small>`,
                    icon: 'error',
                    confirmButtonColor: '#2e7d32',
                    confirmButtonText: 'Mengerti',
                    customClass: {
                        popup: 'rounded-4',
                        confirmButton: 'rounded-pill px-4'
                    }
                });
                return;
            }

            Swal.fire({
                title: 'Hapus Foto Ini?',
                html: `Yakin ingin menghapus foto dari <strong>"${wisataName}"</strong>?<br><br>
                       <small class="text-muted">⚠️ Foto yang dihapus tidak dapat dikembalikan!</small><br>
                       <small class="text-muted">📊 Sisa foto setelah dihapus: <strong>${totalPhotos - 1} foto</strong></small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d32f2f',
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

        // File Input Preview
        const fileInput = document.getElementById('fileInput');
        const selectedFilesDiv = document.getElementById('selectedFiles');

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                let fileList = '<div style="margin-top: 1rem; padding: 1rem; background: white; border-radius: 12px; border: 2px solid #e8f5e9;">';
                fileList += '<strong style="color: #1b5e20;"><i class="bi bi-files me-2"></i>File yang dipilih:</strong><ul style="margin: 0.5rem 0 0 1.5rem; color: #333;">';

                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    const fileSize = (file.size / 1024).toFixed(1);
                    fileList += `<li>${file.name} <span style="color: #666; font-size: 12px;">(${fileSize} KB)</span></li>`;
                }

                fileList += '</ul></div>';
                selectedFilesDiv.innerHTML = fileList;
            } else {
                selectedFilesDiv.innerHTML = '';
            }
        });
    </script>
</body>

</html>
