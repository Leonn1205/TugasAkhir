<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Tempat Kuliner - Kotabaru Tourism</title>
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

        /* Alert Notifications */
        .alert-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 350px;
            max-width: 500px;
            animation: slideInRight 0.4s ease;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .alert-custom {
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            border: none;
            backdrop-filter: blur(10px);
        }

        .alert-success-custom {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, #c62828 0%, #d32f2f 100%);
            color: white;
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

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        .form-section {
            border-left: 4px solid #2e7d32;
            padding-left: 15px;
            margin-bottom: 2.5rem;
        }

        .form-section h5 {
            color: #1b5e20;
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section h6 {
            color: #2e7d32;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 16px;
        }

        label {
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 14px;
            display: block;
        }

        .form-control,
        .form-select {
            border: 2px solid #c8e6c9;
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #d32f2f;
            background-color: #ffebee;
        }

        .invalid-feedback {
            display: block;
            color: #d32f2f;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid #c8e6c9;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }

        .form-check-label {
            font-size: 14px;
            color: #333;
            cursor: pointer;
            margin-left: 5px;
        }

        .form-check-inline {
            margin-right: 1.5rem;
        }

        .form-text.note {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-top: 5px;
        }

        .alert-info {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: none;
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 1.5rem;
        }

        .alert-info ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .alert-info li {
            color: #1565c0;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 12px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            border-bottom: 1px solid #e8f5e9;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f1f8f4;
        }

        .table tbody td {
            padding: 10px;
            vertical-align: middle;
        }

        .table-sm input {
            font-size: 13px;
            padding: 6px 10px;
        }

        .sub-section-header {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            border-left: 4px solid #2e7d32;
        }

        .sub-section-header h6 {
            margin: 0;
            color: #1b5e20;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group-card {
            background: #fafcfb;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 1rem;
            border: 1px solid #e8f5e9;
        }

        hr {
            border: none;
            border-top: 2px solid #e8f5e9;
            margin: 1.5rem 0;
        }

        .btn-custom {
            padding: 12px 30px;
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

        .btn-submit {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
            color: white;
        }

        .btn-cancel {
            background: white;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .btn-cancel:hover {
            background: #f5f5f5;
            border-color: #ccc;
            transform: translateY(-2px);
            color: #666;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
        }

        .foto-preview {
            display: inline-block;
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .foto-preview img {
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .foto-preview img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 28px;
            }

            .form-container {
                padding: 1.5rem;
            }

            .form-section {
                padding-left: 10px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .form-check-inline {
                display: block;
                margin-bottom: 10px;
            }

            .table-responsive {
                font-size: 12px;
            }
        }

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

        input[type="file"] {
            padding: 10px;
            border: 2px dashed #c8e6c9;
            border-radius: 10px;
            background: #f1f8f4;
        }

        input[type="file"]:hover {
            border-color: #388e3c;
            background: #e8f5e9;
        }
    </style>
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div style="color: #1b5e20; font-weight: 600;">Menyimpan data...</div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
    <div class="alert-notification">
        <div class="alert alert-success-custom alert-custom alert-dismissible fade show">
            <i class="bi bi-check-circle-fill"></i>
            <div class="alert-content">
                <div style="font-weight: 600;">Berhasil!</div>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="alert-notification">
        <div class="alert alert-danger-custom alert-custom alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div class="alert-content">
                <div style="font-weight: 600;">Terjadi Kesalahan!</div>
                <div>Terdapat {{ $errors->count() }} kesalahan pada form. Periksa kembali inputan Anda.</div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <div class="header-section">
        <div class="container text-center">
            <h1><i class="bi bi-pencil-square me-2"></i>Edit Data Tempat Kuliner</h1>
            <p>Kotabaru Tourism Data Center - Formulir Edit Sentra Kuliner</p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <form action="{{ route('kuliner.update', $kuliner->id_kuliner) }}" method="POST"
                enctype="multipart/form-data" id="kulinerForm">
                @csrf
                @method('PUT')

                <!-- 1. IDENTITAS USAHA -->
                <div class="form-section">
                    <h5><i class="bi bi-building"></i> 1. Identitas Usaha</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Sentra / Usaha <span style="color: #d32f2f;">*</span></label>
                            <input type="text" name="nama_sentra" class="form-control @error('nama_sentra') is-invalid @enderror"
                                value="{{ old('nama_sentra', $kuliner->nama_sentra) }}" required>
                            @error('nama_sentra')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control @error('tahun_berdiri') is-invalid @enderror"
                                min="1900" max="{{ date('Y') }}"
                                value="{{ old('tahun_berdiri', $kuliner->tahun_berdiri) }}">
                            @error('tahun_berdiri')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text note">Tahun harus antara 1900 - {{ date('Y') }}</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror"
                                value="{{ old('nama_pemilik', $kuliner->nama_pemilik) }}">
                            @error('nama_pemilik')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Kepemilikan</label>
                            <select name="kepemilikan" class="form-control @error('kepemilikan') is-invalid @enderror">
                                <option value="">-- Pilih Status Kepemilikan --</option>
                                @foreach (['Pribadi', 'Keluarga', 'Komunitas', 'Waralaba'] as $kep)
                                    <option value="{{ $kep }}"
                                        {{ old('kepemilikan', $kuliner->kepemilikan) == $kep ? 'selected' : '' }}>
                                        {{ $kep }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kepemilikan')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Alamat Lengkap <span style="color: #d32f2f;">*</span></label>
                        <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" rows="2" required>{{ old('alamat_lengkap', $kuliner->alamat_lengkap) }}</textarea>
                        @error('alamat_lengkap')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>No. Telepon</label>
                            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                                maxlength="12" placeholder="081234567890"
                                value="{{ old('telepon', $kuliner->telepon) }}">
                            @error('telepon')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text note">Maksimal 12 karakter</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="contoh@email.com"
                                value="{{ old('email', $kuliner->email) }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>No. NIB</label>
                            <input type="text" name="no_nib" class="form-control @error('no_nib') is-invalid @enderror"
                                maxlength="13" pattern="[0-9]{13}" placeholder="9120001380361"
                                value="{{ old('no_nib', $kuliner->no_nib) }}">
                            @error('no_nib')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text note">Harus 13 digit angka</small>
                        </div>
                    </div>

                    @php
                        $sertifikatData = is_array($kuliner->sertifikat_lain)
                            ? $kuliner->sertifikat_lain
                            : json_decode($kuliner->sertifikat_lain ?? '[]', true);

                        $sertifikatLainText = '';
                        foreach ($sertifikatData as $item) {
                            if (str_starts_with($item, 'Lainnya:')) {
                                $sertifikatLainText = trim(substr($item, 8));
                            }
                        }
                    @endphp

                    <div class="mb-3">
                        <label>Sertifikat (boleh lebih dari satu)</label><br>
                        @foreach (['PIRT', 'BPOM', 'Halal', 'NIB', 'Lainnya'] as $item)
                            @php
                                $checked = in_array($item, $sertifikatData) || ($item === 'Lainnya' && $sertifikatLainText) ? 'checked' : '';
                            @endphp
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="sertifikat_lain[]" value="{{ $item }}"
                                    id="sertifikat_{{ $item }}" class="form-check-input sertifikat-check"
                                    {{ $checked }}>
                                <label class="form-check-label" for="sertifikat_{{ $item }}">{{ $item }}</label>
                            </div>
                        @endforeach

                        <input type="text" id="sertifikat_lain_text" name="sertifikat_lain_text"
                            class="form-control mt-2" value="{{ $sertifikatLainText }}"
                            placeholder="Tulis sertifikat lainnya..."
                            style="display: {{ $sertifikatLainText ? 'block' : 'none' }}; max-width:300px;">
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Pegawai</label>
                            <input type="number" name="jumlah_pegawai" class="form-control @error('jumlah_pegawai') is-invalid @enderror"
                                min="0" placeholder="25"
                                value="{{ old('jumlah_pegawai', $kuliner->jumlah_pegawai) }}">
                            @error('jumlah_pegawai')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Kursi</label>
                            <input type="number" name="jumlah_kursi" class="form-control @error('jumlah_kursi') is-invalid @enderror"
                                min="0" placeholder="25"
                                value="{{ old('jumlah_kursi', $kuliner->jumlah_kursi) }}">
                            @error('jumlah_kursi')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jumlah Gerai</label>
                            <input type="number" name="jumlah_gerai" class="form-control @error('jumlah_gerai') is-invalid @enderror"
                                min="0" placeholder="1"
                                value="{{ old('jumlah_gerai', $kuliner->jumlah_gerai) }}">
                            @error('jumlah_gerai')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Pelanggan/Hari</label>
                            <input type="number" name="jumlah_pelanggan_per_hari" class="form-control @error('jumlah_pelanggan_per_hari') is-invalid @enderror"
                                min="0" placeholder="50"
                                value="{{ old('jumlah_pelanggan_per_hari', $kuliner->jumlah_pelanggan_per_hari) }}">
                            @error('jumlah_pelanggan_per_hari')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    @php
                        $jam = $kuliner->jamOperasional->keyBy('hari');
                    @endphp
                    <hr>
                    <h6 class="fw-bold text-success mt-4 mb-3"><i class="bi bi-clock"></i> Jam Operasional & Jam Sibuk</h6>
                    <div class="alert-info">
                        <ul class="mb-0">
                            <li>Isi jam buka, jam tutup, dan jam sibuk jika ada</li>
                            <li>Centang "Libur" bila tempat tidak beroperasi hari itu</li>
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam Buka</th>
                                    <th>Jam Tutup</th>
                                    <th>Jam Sibuk Mulai</th>
                                    <th>Jam Sibuk Selesai</th>
                                    <th>Libur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $i => $hari)
                                    @php $data = $jam[$hari] ?? null; @endphp
                                    <tr>
                                        <td><input type="text" name="hari[{{ $i }}]"
                                                class="form-control text-center form-control-sm"
                                                value="{{ $hari }}" readonly></td>
                                        <td><input type="time" name="jam_buka[{{ $i }}]"
                                                class="form-control form-control-sm jam-input"
                                                value="{{ old('jam_buka.' . $i, $data->jam_buka ?? '08:00') }}"></td>
                                        <td><input type="time" name="jam_tutup[{{ $i }}]"
                                                class="form-control form-control-sm jam-input"
                                                value="{{ old('jam_tutup.' . $i, $data->jam_tutup ?? '21:00') }}">
                                        </td>
                                        <td><input type="time" name="jam_sibuk_mulai[{{ $i }}]"
                                                class="form-control form-control-sm jam-input"
                                                value="{{ old('jam_sibuk_mulai.' . $i, $data->jam_sibuk_mulai ?? '') }}">
                                        </td>
                                        <td><input type="time" name="jam_sibuk_selesai[{{ $i }}]"
                                                class="form-control form-control-sm jam-input"
                                                value="{{ old('jam_sibuk_selesai.' . $i, $data->jam_sibuk_selesai ?? '') }}">
                                        </td>
                                        <td><input type="checkbox" name="libur[{{ $i }}]"
                                                class="form-check-input libur-checkbox"
                                                {{ empty($data->jam_buka) ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        @php
                            $profil = json_decode($kuliner->profil_pelanggan ?? '[]', true);
                        @endphp
                        <div class="col-md-6 mb-3">
                            <label>Profil Pelanggan</label><br>
                            @foreach (['Lokal', 'Wisatawan', 'Pelajar/Mahasiswa', 'Pekerja'] as $p)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="profil_pelanggan[]" value="{{ $p }}"
                                        class="form-check-input" id="profil_{{ $p }}"
                                        {{ in_array($p, old('profil_pelanggan', $profil)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="profil_{{ $p }}">{{ $p }}</label>
                                </div>
                            @endforeach
                        </div>

                        @php
                            $metode = json_decode($kuliner->metode_pembayaran ?? '[]', true);
                        @endphp
                        <div class="col-md-6 mb-3">
                            <label>Metode Pembayaran</label><br>
                            @foreach (['Tunai', 'QRIS / Transfer'] as $m)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="metode_pembayaran[]" value="{{ $m }}"
                                        class="form-check-input" id="metode_{{ $m }}"
                                        {{ in_array($m, old('metode_pembayaran', $metode)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="metode_{{ $m }}">{{ $m }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Pajak / Retribusi</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pajak_retribusi" value="1"
                                id="pajak_ya"
                                {{ old('pajak_retribusi', $kuliner->pajak_retribusi) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="pajak_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pajak_retribusi" value="0"
                                id="pajak_tidak"
                                {{ old('pajak_retribusi', $kuliner->pajak_retribusi) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="pajak_tidak">Tidak</label>
                        </div>
                    </div>
                </div>

                <!-- 2. JENIS KULINER -->
                <div class="form-section">
                    <h5><i class="bi bi-card-list"></i> 2. Jenis Kuliner</h5>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Kategori</label><br>
                            @php
                                $kategoriData = json_decode($kuliner->kategori ?? '[]', true) ?? [];
                                $kategoriLain = '';
                                foreach ($kategoriData as $item) {
                                    if (str_starts_with($item, 'Lainnya:')) {
                                        $kategoriLain = trim(substr($item, 8));
                                        break;
                                    }
                                }
                            @endphp

                            @foreach (['Tradisional/Domestik', 'Modern/Luar Negeri', 'Street Food', 'Lainnya'] as $kategori)
                                @php
                                    $checked = in_array($kategori, $kategoriData) || ($kategori === 'Lainnya' && $kategoriLain) ? 'checked' : '';
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="kategori[]" value="{{ $kategori }}"
                                        class="form-check-input kategori-check" id="kategori_{{ $kategori }}"
                                        {{ $checked }}>
                                    <label class="form-check-label" for="kategori_{{ $kategori }}">{{ $kategori }}</label>
                                </div>
                            @endforeach

                            <input type="text" id="kategori_lain" name="kategori_lain"
                                value="{{ $kategoriLain }}" class="form-control mt-2"
                                placeholder="Tulis kategori lain..."
                                style="{{ $kategoriLain ? '' : 'display:none;' }} max-width:400px;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Menu Unggulan</label>
                            <input type="text" name="menu_unggulan" class="form-control @error('menu_unggulan') is-invalid @enderror"
                                placeholder="Contoh: Soto Banjar Spesial"
                                value="{{ old('menu_unggulan', $kuliner->menu_unggulan) }}">
                            @error('menu_unggulan')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Bahan Baku Utama</label>
                            <input type="text" name="bahan_baku_utama" class="form-control @error('bahan_baku_utama') is-invalid @enderror"
                                placeholder="Contoh: Daging ayam, rempah lokal"
                                value="{{ old('bahan_baku_utama', $kuliner->bahan_baku_utama) }}">
                            @error('bahan_baku_utama')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                            <small class="form-text note">Bisa sesuaikan dengan menu unggulan</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Sumber Bahan Baku</label>
                            <select name="sumber_bahan_baku" class="form-control @error('sumber_bahan_baku') is-invalid @enderror">
                                <option value="">-- Pilih Sumber Bahan Baku --</option>
                                @foreach (['Lokal', 'Domestik/Luar Kota', 'Import/Luar Negeri', 'Campuran'] as $sumber)
                                    <option value="{{ $sumber }}"
                                        {{ old('sumber_bahan_baku', $kuliner->sumber_bahan_baku) == $sumber ? 'selected' : '' }}>
                                        {{ $sumber }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sumber_bahan_baku')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Menu Bersifat</label><br>
                            @foreach (['Tetap', 'Musiman'] as $m)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="menu_bersifat[]" value="{{ $m }}"
                                        class="form-check-input" id="menu_{{ $m }}"
                                        {{ in_array($m, json_decode($kuliner->menu_bersifat ?? '[]', true) ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="menu_{{ $m }}">{{ $m }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 3. TEMPAT & FASILITAS -->
                <div class="form-section">
                    <h5><i class="bi bi-shop"></i> 3. Tempat & Fasilitas</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Bentuk Fisik</label>
                            <select name="bentuk_fisik" class="form-control @error('bentuk_fisik') is-invalid @enderror">
                                <option value="">-- Pilih Bentuk Fisik --</option>
                                <option value="Restoran" {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == 'Restoran' ? 'selected' : '' }}>Restoran</option>
                                <option value="Warung" {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == 'Warung' ? 'selected' : '' }}>Warung</option>
                                <option value="Kafe" {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == 'Kafe' ? 'selected' : '' }}>Kafe</option>
                                <option value="Foodcourt" {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == 'Foodcourt' ? 'selected' : '' }}>Foodcourt</option>
                                <option value="Jasa Boga (Katering)" {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == 'Jasa Boga (Katering)' ? 'selected' : '' }}>Jasa Boga (Katering)</option>
                                <option value="Penyedia Makanan oleh Pedagang Keliling" {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == 'Penyedia Makanan oleh Pedagang Keliling' ? 'selected' : '' }}>Penyedia Makanan oleh Pedagang Keliling</option>
                                <option value="Penyedia Makanan oleh Pedagang Tidak Keliling" {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == 'Penyedia Makanan oleh Pedagang Tidak Keliling' ? 'selected' : '' }}>Penyedia Makanan oleh Pedagang Tidak Keliling</option>
                            </select>
                            @error('bentuk_fisik')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status Bangunan</label>
                            <select name="status_bangunan" id="status_bangunan" class="form-control @error('status_bangunan') is-invalid @enderror">
                                <option value="">-- Pilih Status Bangunan --</option>
                                <option value="Milik Sendiri" {{ old('status_bangunan', $kuliner->status_bangunan) == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Sewa" {{ old('status_bangunan', $kuliner->status_bangunan) == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                <option value="Pinjam Pakai" {{ old('status_bangunan', $kuliner->status_bangunan) == 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
                                <option value="Lainnya" {{ str_starts_with($kuliner->status_bangunan, 'Lainnya:') || old('status_bangunan') == 'Lainnya' ? 'selected' : '' }}>Lainnya...</option>
                            </select>
                            @error('status_bangunan')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror

                            <input type="text" id="status_lain" name="status_lain" class="form-control mt-2 @error('status_lain') is-invalid @enderror"
                                placeholder="Tulis status lain..."
                                value="{{ old('status_lain', str_starts_with($kuliner->status_bangunan, 'Lainnya:') ? substr($kuliner->status_bangunan, 9) : '') }}"
                                style="{{ str_starts_with($kuliner->status_bangunan, 'Lainnya:') || old('status_bangunan') == 'Lainnya' ? '' : 'display:none;' }} max-width:400px;">
                            @error('status_lain')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Fasilitas Pendukung</label><br>
                        @php
                            $fasilitas = is_string($kuliner->fasilitas_pendukung) ? json_decode($kuliner->fasilitas_pendukung, true) : $kuliner->fasilitas_pendukung;
                            $fasilitas = is_array($fasilitas) ? $fasilitas : [];
                        @endphp
                        @foreach (['Toilet', 'Wastafel', 'Parkir', 'Mushola', 'WiFi', 'Tempat Sampah'] as $f)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="fasilitas_pendukung[]" value="{{ $f }}"
                                    class="form-check-input" id="fasilitas_{{ $f }}"
                                    {{ in_array($f, old('fasilitas_pendukung', $fasilitas)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="fasilitas_{{ $f }}">{{ $f }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4. PRAKTIK K3 & SANITASI -->
                <div class="form-section">
                    <h5><i class="bi bi-shield-check"></i> 4. Praktik K3 & Sanitasi</h5>

                    <div class="sub-section-header">
                        <h6><i class="bi bi-people-fill"></i> Pelatihan & Penjamah Makanan</h6>
                    </div>
                    <div class="form-group-card">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Pelatihan K3</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pelatihan_k3" value="1" id="k3_ya"
                                        {{ old('pelatihan_k3', $kuliner->pelatihan_k3) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="k3_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pelatihan_k3" value="0" id="k3_tidak"
                                        {{ old('pelatihan_k3', $kuliner->pelatihan_k3) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="k3_tidak">Tidak</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jumlah Penjamah Makanan</label>
                                <input type="number" name="jumlah_penjamah_makanan" class="form-control @error('jumlah_penjamah_makanan') is-invalid @enderror"
                                    min="0" placeholder="3"
                                    value="{{ old('jumlah_penjamah_makanan', $kuliner->jumlah_penjamah_makanan) }}">
                                @error('jumlah_penjamah_makanan')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="d-block mb-2">Alat Pelindung Diri Penjamah Makanan</label>
                            @php
                                $apdPenjamah = json_decode($kuliner->apd_penjamah_makanan, true) ?? [];
                            @endphp
                            <div class="d-flex flex-wrap" style="gap: 1rem;">
                                @foreach (['Masker', 'Hairnet', 'Celemek', 'Sarung Tangan'] as $apd)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="apd_penjamah_makanan[]" value="{{ $apd }}"
                                            class="form-check-input" id="apd_{{ $apd }}"
                                            {{ in_array($apd, old('apd_penjamah_makanan', $apdPenjamah)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="apd_{{ $apd }}">{{ $apd }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="sub-section-header">
                        <h6><i class="bi bi-droplet-fill"></i> Prosedur Sanitasi</h6>
                    </div>
                    <div class="form-group-card">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Sanitasi Alat Dapur</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="prosedur_sanitasi_alat"
                                        id="sanitasi_tidak" value="0"
                                        {{ old('prosedur_sanitasi_alat', $kuliner->prosedur_sanitasi_alat) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sanitasi_tidak">Tidak Melakukan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="prosedur_sanitasi_alat"
                                        id="sanitasi_ya" value="1"
                                        {{ old('prosedur_sanitasi_alat', $kuliner->prosedur_sanitasi_alat) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sanitasi_ya">Melakukan</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Frekuensi Sanitasi Alat</label>
                                <input type="text" name="frekuensi_sanitasi_alat" class="form-control @error('frekuensi_sanitasi_alat') is-invalid @enderror"
                                    placeholder="2 kali sehari"
                                    value="{{ old('frekuensi_sanitasi_alat', $kuliner->frekuensi_sanitasi_alat) }}">
                                @error('frekuensi_sanitasi_alat')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text note">Jika tidak melakukan harap isi dengan tanda "-"</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Sanitasi Bahan Makanan</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="prosedur_sanitasi_bahan"
                                        id="sanitasi_bahan_tidak" value="0"
                                        {{ old('prosedur_sanitasi_bahan', $kuliner->prosedur_sanitasi_bahan) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sanitasi_bahan_tidak">Tidak Melakukan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="prosedur_sanitasi_bahan"
                                        id="sanitasi_bahan_ya" value="1"
                                        {{ old('prosedur_sanitasi_bahan', $kuliner->prosedur_sanitasi_bahan) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sanitasi_bahan_ya">Melakukan</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Frekuensi Sanitasi Bahan</label>
                                <input type="text" name="frekuensi_sanitasi_bahan" class="form-control @error('frekuensi_sanitasi_bahan') is-invalid @enderror"
                                    placeholder="2 kali sehari"
                                    value="{{ old('frekuensi_sanitasi_bahan', $kuliner->frekuensi_sanitasi_bahan) }}">
                                @error('frekuensi_sanitasi_bahan')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text note">Jika tidak melakukan harap isi dengan tanda "-"</small>
                            </div>
                        </div>
                    </div>

                    <div class="sub-section-header">
                        <h6><i class="bi bi-box-seam"></i> Penyimpanan & Pengelolaan Bahan</h6>
                    </div>
                    <div class="form-group-card">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Penyimpanan Bahan Mentah</label>
                                <select name="penyimpanan_mentah" class="form-control @error('penyimpanan_mentah') is-invalid @enderror">
                                    <option value="">-- Pilih Penyimpanan --</option>
                                    @foreach (['Dengan Pendingin, Terpisah', 'Dengan Pendingin, Tidak Terpisah', 'Tanpa Pendingin, Terpisah', 'Tanpa Pendingin, Tidak Terpisah'] as $opt)
                                        <option value="{{ $opt }}"
                                            {{ old('penyimpanan_mentah', $kuliner->penyimpanan_mentah) == $opt ? 'selected' : '' }}>
                                            {{ $opt }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penyimpanan_mentah')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Penyimpanan Bahan Matang</label>
                                <select name="penyimpanan_matang" class="form-control @error('penyimpanan_matang') is-invalid @enderror">
                                    <option value="">-- Pilih Penyimpanan --</option>
                                    @foreach (['Dengan Pendingin, Terpisah', 'Dengan Pendingin, Tidak Terpisah', 'Tanpa Pendingin, Terpisah', 'Tanpa Pendingin, Tidak Terpisah'] as $opt)
                                        <option value="{{ $opt }}"
                                            {{ old('penyimpanan_matang', $kuliner->penyimpanan_matang) == $opt ? 'selected' : '' }}>
                                            {{ $opt }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penyimpanan_matang')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Prinsip FIFO / FEFO</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="fifo_fefo" value="1" id="fifo_ya"
                                        {{ old('fifo_fefo', $kuliner->fifo_fefo) == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fifo_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="fifo_fefo" value="0" id="fifo_tidak"
                                        {{ old('fifo_fefo', $kuliner->fifo_fefo) == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fifo_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sub-section-header">
                        <h6><i class="bi bi-house-door-fill"></i> Fasilitas & Kondisi Dapur</h6>
                    </div>
                    <div class="form-group-card">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Limbah Dapur</label>
                                <select name="limbah_dapur" class="form-control @error('limbah_dapur') is-invalid @enderror">
                                    <option value="">-- Pilih Limbah Dapur --</option>
                                    @foreach (['Dipisah', 'Tidak Dipisah'] as $opt)
                                        <option value="{{ $opt }}"
                                            {{ old('limbah_dapur', $kuliner->limbah_dapur) == $opt ? 'selected' : '' }}>
                                            {{ $opt }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('limbah_dapur')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Ventilasi Dapur</label>
                                <select name="ventilasi_dapur" class="form-control @error('ventilasi_dapur') is-invalid @enderror">
                                    <option value="">-- Pilih Ventilasi --</option>
                                    @foreach (['Alami', 'Buatan'] as $opt)
                                        <option value="{{ $opt }}"
                                            {{ old('ventilasi_dapur', $kuliner->ventilasi_dapur) == $opt ? 'selected' : '' }}>
                                            {{ $opt }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ventilasi_dapur')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Dapur</label>
                                <select name="dapur" class="form-control @error('dapur') is-invalid @enderror">
                                    <option value="">-- Pilih Dapur --</option>
                                    @foreach (['Ada, terpisah', 'Ada, tidak terpisah', 'Tidak ada'] as $opt)
                                        <option value="{{ $opt }}"
                                            {{ old('dapur', $kuliner->dapur) == $opt ? 'selected' : '' }}>
                                            {{ $opt }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dapur')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="sub-section-header">
                        <h6><i class="bi bi-droplet-half"></i> Sumber Air</h6>
                    </div>
                    <div class="form-group-card">
                        <div class="row">
                            @foreach (['sumber_air_cuci' => 'Sumber Air Cuci', 'sumber_air_masak' => 'Sumber Air Masak', 'sumber_air_minum' => 'Sumber Air Minum'] as $name => $label)
                                <div class="col-md-4 mb-3">
                                    <label>{{ $label }}</label>
                                    <select name="{{ $name }}" class="form-control @error($name) is-invalid @enderror">
                                        <option value="">-- Pilih Sumber Air --</option>
                                        @foreach (['PDAM', 'Sumur', 'Air Isi Ulang'] as $opt)
                                            <option value="{{ $opt }}"
                                                {{ old($name, $kuliner->$name) == $opt ? 'selected' : '' }}>
                                                {{ $opt }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error($name)
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 5. KOORDINAT -->
                <div class="form-section">
                    <h5><i class="bi bi-geo-alt"></i> 5. Koordinat Lokasi</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Longitude <span style="color: #d32f2f;">*</span></label>
                            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                                placeholder="116.8225"
                                value="{{ old('longitude', $kuliner->longitude) }}" required>
                            @error('longitude')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Latitude <span style="color: #d32f2f;">*</span></label>
                            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                                placeholder="-3.3211"
                                value="{{ old('latitude', $kuliner->latitude) }}" required>
                            @error('latitude')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 6. FOTO -->
                <div class="form-section">
                    <h5><i class="bi bi-camera"></i> 6. Foto Kuliner</h5>
                    <div class="mb-3">
                        <label>Foto Saat Ini</label><br>
                        @if($kuliner->foto->count() > 0)
                            @foreach ($kuliner->foto as $f)
                                <div class="foto-preview">
                                    <img src="{{ asset('storage/' . $f->path_foto) }}"
                                        alt="Foto {{ $kuliner->nama_sentra }}" width="100">
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted"><i class="bi bi-image"></i> Belum ada foto</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label>Upload Foto Baru (Opsional)</label>
                        <input type="file" name="foto[]" class="form-control @error('foto') is-invalid @enderror @error('foto.*') is-invalid @enderror" multiple accept="image/*">
                        @error('foto')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        @error('foto.*')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        <small class="form-text note">Format: JPG, PNG, JPEG | Maksimal: 2MB per file | Foto lama tidak akan terhapus</small>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="submit" class="btn-custom btn-submit">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('kuliner.index') }}" class="btn-custom btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert-notification .alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // SERTIFIKAT "LAINNYA"
            const sertifikatChecks = document.querySelectorAll(".sertifikat-check");
            const sertifikatLainText = document.getElementById("sertifikat_lain_text");
            if (sertifikatChecks.length && sertifikatLainText) {
                sertifikatChecks.forEach(c => {
                    c.addEventListener("change", () => {
                        const isOtherChecked = Array.from(sertifikatChecks)
                            .some(chk => chk.value === "Lainnya" && chk.checked);
                        sertifikatLainText.style.display = isOtherChecked ? "block" : "none";
                        if (!isOtherChecked) sertifikatLainText.value = "";
                    });
                });
            }

            // KATEGORI "LAINNYA"
            const kategoriChecks = document.querySelectorAll(".kategori-check");
            const kategoriLainText = document.getElementById("kategori_lain");
            if (kategoriChecks.length && kategoriLainText) {
                kategoriChecks.forEach(c => {
                    c.addEventListener("change", () => {
                        const isOtherChecked = Array.from(kategoriChecks)
                            .some(chk => chk.value === "Lainnya" && chk.checked);
                        kategoriLainText.style.display = isOtherChecked ? "block" : "none";
                        if (!isOtherChecked) kategoriLainText.value = "";
                    });
                });
            }

            // STATUS BANGUNAN "LAINNYA"
            const statusSelect = document.querySelector('select[name="status_bangunan"]');
            const statusLainInput = document.getElementById("status_lain");
            if (statusSelect && statusLainInput) {
                statusSelect.addEventListener("change", () => {
                    if (statusSelect.value === "Lainnya") {
                        statusLainInput.style.display = "block";
                    } else {
                        statusLainInput.style.display = "none";
                        statusLainInput.value = "";
                    }
                });
            }

            // JAM OPERASIONAL: Checkbox "Libur"
            const rows = document.querySelectorAll("table tbody tr");
            rows.forEach(row => {
                const checkbox = row.querySelector('.libur-checkbox');
                const timeInputs = row.querySelectorAll('.jam-input');
                if (!checkbox || !timeInputs.length) return;

                const defaultValues = Array.from(timeInputs).map(input => input.value);

                if (checkbox.checked) {
                    timeInputs.forEach(input => {
                        input.value = "";
                        input.disabled = true;
                    });
                    row.style.opacity = '0.5';
                }

                checkbox.addEventListener("change", () => {
                    if (checkbox.checked) {
                        timeInputs.forEach(input => {
                            input.value = "";
                            input.disabled = true;
                        });
                        row.style.opacity = '0.5';
                    } else {
                        timeInputs.forEach((input, idx) => {
                            input.disabled = false;
                            input.value = defaultValues[idx] || "";
                        });
                        row.style.opacity = '1';
                    }
                });
            });

            // Show loading on form submit
            document.getElementById('kulinerForm').addEventListener('submit', function() {
                document.getElementById('loadingOverlay').classList.add('active');
            });
        });
    </script>
</body>
</html>
