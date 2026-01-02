<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Tempat Kuliner - Kotabaru Tourism</title>
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
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            margin: 0 auto 2rem;
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
            margin-left: 4px;
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
            position: relative;
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
            transition: all 0.3s ease;
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
            color: white;
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

        .form-control,
        .form-select {
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
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

        .alert-info-custom {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border: none;
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 1.5rem;
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

        .table-operasional thead th {
            border: none;
            padding: 14px 10px;
            font-size: 13px;
            font-weight: 600;
        }

        .table-operasional tbody td {
            padding: 10px;
            vertical-align: middle;
        }

        .existing-photos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 1.5rem;
        }

        .photo-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .photo-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .photo-delete-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(211, 47, 47, 0.95);
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            z-index: 3;
        }

        .photo-delete-btn:hover {
            background: rgba(198, 40, 40, 1);
            transform: scale(1.1);
        }

        .file-upload-wrapper {
            position: relative;
            border: 3px dashed #2e7d32;
            border-radius: 15px;
            padding: 3rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, #f1f8f4 0%, #e8f5e9 100%);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-wrapper:hover {
            border-color: #1b5e20;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
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
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e8f5e9;
        }

        .error-summary {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            border: none;
            border-left: 5px solid #d32f2f;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 2rem;
        }

        .alert-sticky {
            position: sticky;
            top: 20px;
            z-index: 100;
            margin-bottom: 2rem;
        }

        .form-text.note {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="header-section">
        <div class="container">
            <h1><i class="bi bi-pencil-square me-2"></i>Edit Data Tempat Kuliner</h1>
            <p>Perbarui informasi kuliner: <strong>{{ $kuliner->nama_sentra }}</strong></p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            {{-- Error Summary --}}
            @if ($errors->has('lokasi'))
                <div class="error-summary alert-sticky">
                    <h5><i class="bi bi-exclamation-triangle-fill"></i> Peringatan Lokasi</h5>
                    <p><strong>{{ $errors->first('lokasi') }}</strong></p>
                </div>
            @endif

            @if ($errors->any() && !$errors->has('lokasi'))
                <div class="error-summary alert-sticky">
                    <h5><i class="bi bi-x-circle-fill"></i> Terdapat {{ $errors->count() }} Kesalahan</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('kuliner.update', $kuliner->id_kuliner) }}"
                enctype="multipart/form-data" id="kulinerForm">
                @csrf
                @method('PUT')

                <!-- 1. IDENTITAS USAHA -->
                <div class="section-title">
                    <i class="bi bi-building"></i> Identitas Usaha
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-shop"></i> Nama Sentra / Usaha <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_sentra"
                            class="form-control @error('nama_sentra') is-invalid @enderror"
                            value="{{ old('nama_sentra', $kuliner->nama_sentra) }}" required>
                        @error('nama_sentra')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-calendar-event"></i> Tahun Berdiri <span class="required">*</span>
                        </label>
                        <input type="number" name="tahun_berdiri"
                            class="form-control @error('tahun_berdiri') is-invalid @enderror"
                            value="{{ old('tahun_berdiri', $kuliner->tahun_berdiri) }}" min="1900"
                            max="{{ date('Y') }}" required>
                        @error('tahun_berdiri')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person"></i> Nama Pemilik <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_pemilik"
                            class="form-control @error('nama_pemilik') is-invalid @enderror"
                            value="{{ old('nama_pemilik', $kuliner->nama_pemilik) }}" required>
                        @error('nama_pemilik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-briefcase"></i> Kepemilikan <span class="required">*</span>
                        </label>
                        <select name="kepemilikan" class="form-control @error('kepemilikan') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Kepemilikan --</option>
                            @foreach (['Pribadi', 'Keluarga', 'Komunitas', 'Waralaba'] as $k)
                                <option value="{{ $k }}"
                                    {{ old('kepemilikan', $kuliner->kepemilikan) == $k ? 'selected' : '' }}>
                                    {{ $k }}</option>
                            @endforeach
                        </select>
                        @error('kepemilikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-geo-alt"></i> Alamat Lengkap <span class="required">*</span>
                    </label>
                    <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" rows="2"
                        required>{{ old('alamat_lengkap', $kuliner->alamat_lengkap) }}</textarea>
                    @error('alamat_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-telephone"></i> No. Telepon <span class="required">*</span>
                        </label>
                        <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                            value="{{ old('telepon', $kuliner->telepon) }}" required>
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-envelope"></i> Email <span class="required">*</span>
                        </label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $kuliner->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-file-text"></i> No. NIB <span class="required">*</span>
                        </label>
                        <input type="text" name="no_nib"
                            class="form-control @error('no_nib') is-invalid @enderror"
                            value="{{ old('no_nib', $kuliner->no_nib) }}" maxlength="13" required>
                        @error('no_nib')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-award"></i> Sertifikat (boleh lebih dari satu)
                    </label><br>
                    @php
                        $existingSertifikat = old('sertifikat_lain', $kuliner->sertifikat_lain ?? []);
                        $sertifikatText = '';
                        if (is_array($existingSertifikat)) {
                            foreach ($existingSertifikat as $key => $val) {
                                if (strpos($val, 'Lainnya:') === 0) {
                                    $sertifikatText = trim(str_replace('Lainnya:', '', $val));
                                    $existingSertifikat[$key] = 'Lainnya';
                                }
                            }
                        }
                    @endphp
                    @foreach (['PIRT', 'BPOM', 'Halal', 'NIB', 'Lainnya'] as $item)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="sertifikat_lain[]" value="{{ $item }}"
                                id="sertifikat_{{ $item }}" class="form-check-input sertifikat-check"
                                {{ in_array($item, $existingSertifikat) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="sertifikat_{{ $item }}">{{ $item }}</label>
                        </div>
                    @endforeach
                    <input type="text" id="sertifikat_text" name="sertifikat_text" class="form-control mt-2"
                        placeholder="Tulis sertifikat lainnya..."
                        style="display:{{ in_array('Lainnya', $existingSertifikat) ? 'block' : 'none' }}; max-width:400px;"
                        value="{{ old('sertifikat_text', $sertifikatText) }}">
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-people"></i> Jumlah Pegawai <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_pegawai"
                            class="form-control @error('jumlah_pegawai') is-invalid @enderror"
                            value="{{ old('jumlah_pegawai', $kuliner->jumlah_pegawai) }}" min="0" required>
                        @error('jumlah_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-grid"></i> Jumlah Kursi <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_kursi"
                            class="form-control @error('jumlah_kursi') is-invalid @enderror"
                            value="{{ old('jumlah_kursi', $kuliner->jumlah_kursi) }}" min="0" required>
                        @error('jumlah_kursi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-shop-window"></i> Jumlah Gerai <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_gerai"
                            class="form-control @error('jumlah_gerai') is-invalid @enderror"
                            value="{{ old('jumlah_gerai', $kuliner->jumlah_gerai) }}" min="0" required>
                        @error('jumlah_gerai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person-check"></i> Pelanggan/Hari <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_pelanggan_per_hari"
                            class="form-control @error('jumlah_pelanggan_per_hari') is-invalid @enderror"
                            value="{{ old('jumlah_pelanggan_per_hari', $kuliner->jumlah_pelanggan_per_hari) }}"
                            min="0" required>
                        @error('jumlah_pelanggan_per_hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- JAM OPERASIONAL -->
                <div class="section-title">
                    <i class="bi bi-clock"></i> Jam Operasional
                </div>

                <div class="alert-info-custom">
                    <strong><i class="bi bi-info-circle-fill me-2"></i>Petunjuk:</strong> Isi jam buka/tutup, centang
                    "Libur" jika tidak beroperasi
                </div>

                <div class="table-responsive">
                    <table class="table table-operasional text-center align-middle">
                        <thead>
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
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $i => $day)
                                @php
                                    $jamOp = $kuliner->jamOperasionalAdmin->where('hari', $day)->first();

                                    // ✅ PERBAIKAN: Handle format data dengan aman
                                    $jamBuka = '08:00';
                                    $jamTutup = '21:00';
                                    $jamSibukMulai = '';
                                    $jamSibukSelesai = '';
                                    $isLibur = false;

                                    if ($jamOp) {
                                        $isLibur = $jamOp->libur ?? false;

                                        // Handle jam_buka (support berbagai format)
                                        if (!empty($jamOp->jam_buka)) {
                                            if (is_object($jamOp->jam_buka)) {
                                                // Jika Carbon object
                                                $jamBuka = $jamOp->jam_buka->format('H:i');
                                            } elseif (is_string($jamOp->jam_buka)) {
                                                // Jika string (format H:i:s atau H:i)
                                                $jamBuka = substr($jamOp->jam_buka, 0, 5);
                                            }
                                        }

                                        // Handle jam_tutup
                                        if (!empty($jamOp->jam_tutup)) {
                                            if (is_object($jamOp->jam_tutup)) {
                                                $jamTutup = $jamOp->jam_tutup->format('H:i');
                                            } elseif (is_string($jamOp->jam_tutup)) {
                                                $jamTutup = substr($jamOp->jam_tutup, 0, 5);
                                            }
                                        }

                                        // Handle jam_sibuk_mulai
                                        if (!empty($jamOp->jam_sibuk_mulai)) {
                                            if (is_object($jamOp->jam_sibuk_mulai)) {
                                                $jamSibukMulai = $jamOp->jam_sibuk_mulai->format('H:i');
                                            } elseif (is_string($jamOp->jam_sibuk_mulai)) {
                                                $jamSibukMulai = substr($jamOp->jam_sibuk_mulai, 0, 5);
                                            }
                                        }

                                        // Handle jam_sibuk_selesai
                                        if (!empty($jamOp->jam_sibuk_selesai)) {
                                            if (is_object($jamOp->jam_sibuk_selesai)) {
                                                $jamSibukSelesai = $jamOp->jam_sibuk_selesai->format('H:i');
                                            } elseif (is_string($jamOp->jam_sibuk_selesai)) {
                                                $jamSibukSelesai = substr($jamOp->jam_sibuk_selesai, 0, 5);
                                            }
                                        }
                                    }

                                    // Support old() untuk validation error
                                    $jamBuka = old('jam_buka.' . $i, $jamBuka);
                                    $jamTutup = old('jam_tutup.' . $i, $jamTutup);
                                    $jamSibukMulai = old('jam_sibuk_mulai.' . $i, $jamSibukMulai);
                                    $jamSibukSelesai = old('jam_sibuk_selesai.' . $i, $jamSibukSelesai);
                                    $isLibur = old('libur.' . $i, $isLibur);
                                @endphp
                                <tr>
                                    <td><input type="text" name="hari[{{ $i }}]"
                                            class="form-control text-center" value="{{ $day }}" readonly>
                                    </td>
                                    <td><input type="time" name="jam_buka[{{ $i }}]"
                                            class="form-control" value="{{ $jamBuka }}"></td>
                                    <td><input type="time" name="jam_tutup[{{ $i }}]"
                                            class="form-control" value="{{ $jamTutup }}"></td>
                                    <td><input type="time" name="jam_sibuk_mulai[{{ $i }}]"
                                            class="form-control" value="{{ $jamSibukMulai }}"></td>
                                    <td><input type="time" name="jam_sibuk_selesai[{{ $i }}]"
                                            class="form-control" value="{{ $jamSibukSelesai }}"></td>
                                    <td><input type="checkbox" name="libur[{{ $i }}]"
                                            class="libur-checkbox" {{ $isLibur ? 'checked' : '' }}></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @error('jam_operasional')
                        <div class="alert alert-danger mt-2"><i class="bi bi-exclamation-triangle-fill"></i>
                            {{ $message }}</div>
                    @enderror
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="bi bi-person-badge"></i> Profil Pelanggan <span
                                class="required">*</span></label><br>
                        @php $profilPelanggan = old('profil_pelanggan', $kuliner->profil_pelanggan ?? []); @endphp
                        @foreach (['Lokal', 'Wisatawan', 'Pelajar/Mahasiswa', 'Pekerja'] as $p)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="profil_pelanggan[]" value="{{ $p }}"
                                    class="form-check-input" id="profil_{{ $p }}"
                                    {{ in_array($p, $profilPelanggan) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="profil_{{ $p }}">{{ $p }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="bi bi-credit-card"></i> Metode Pembayaran <span
                                class="required">*</span></label><br>
                        @php $metodePembayaran = old('metode_pembayaran', $kuliner->metode_pembayaran ?? []); @endphp
                        @foreach (['Tunai', 'Qris / Transfer'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="metode_pembayaran[]" value="{{ $m }}"
                                    class="form-check-input" id="metode_{{ $m }}"
                                    {{ in_array($m, $metodePembayaran) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="metode_{{ $m }}">{{ $m }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-cash-coin"></i> Pajak / Retribusi <span
                            class="required">*</span></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pajak_retribusi" value="Ya"
                            id="pajak_ya"
                            {{ old('pajak_retribusi', $kuliner->pajak_retribusi ? 'Ya' : 'Tidak') == 'Ya' ? 'checked' : '' }}
                            required>
                        <label class="form-check-label" for="pajak_ya">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pajak_retribusi" value="Tidak"
                            id="pajak_tidak"
                            {{ old('pajak_retribusi', $kuliner->pajak_retribusi ? 'Ya' : 'Tidak') == 'Tidak' ? 'checked' : '' }}>
                        <label class="form-check-label" for="pajak_tidak">Tidak</label>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 2. JENIS KULINER & KATEGORI -->
                <div class="section-title">
                    <i class="bi bi-card-list"></i> Jenis Kuliner & Kategori
                </div>

                <div class="mb-3">
                    <label class="form-label @error('kategori') text-danger @enderror">
                        <i class="bi bi-tags"></i> Kategori <span class="required">*</span>
                        <span class="counter-badge" id="selectedCount">0 dipilih</span>
                    </label>

                    @if ($kategori->isEmpty())
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <strong>Tidak Ada Kategori Aktif</strong>
                            <p class="mb-0">Belum ada kategori kuliner yang aktif.</p>
                        </div>
                    @else
                        @php
                            $selectedKategori = old('kategori', $kuliner->kategori->pluck('id_kategori')->toArray());
                        @endphp
                        <div class="kategori-container">
                            @foreach ($kategori as $kat)
                                <div class="kategori-item">
                                    <input type="checkbox" name="kategori[]" value="{{ $kat->id_kategori }}"
                                        id="kategori_{{ $kat->id_kategori }}" class="kategori-checkbox"
                                        {{ in_array($kat->id_kategori, $selectedKategori) ? 'checked' : '' }}>
                                    <label class="kategori-label" for="kategori_{{ $kat->id_kategori }}">
                                        {{ $kat->nama_kategori }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @error('kategori')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-star"></i> Menu Unggulan <span class="required">*</span>
                        </label>
                        <input type="text" name="menu_unggulan"
                            class="form-control @error('menu_unggulan') is-invalid @enderror"
                            value="{{ old('menu_unggulan', $kuliner->menu_unggulan) }}" required>
                        @error('menu_unggulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-basket"></i> Bahan Baku Utama <span class="required">*</span>
                        </label>
                        <input type="text" name="bahan_baku_utama"
                            class="form-control @error('bahan_baku_utama') is-invalid @enderror"
                            value="{{ old('bahan_baku_utama', $kuliner->bahan_baku_utama) }}" required>
                        @error('bahan_baku_utama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-truck"></i> Sumber Bahan Baku <span class="required">*</span>
                        </label>
                        <select name="sumber_bahan_baku"
                            class="form-control @error('sumber_bahan_baku') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            @foreach (['Lokal', 'Domestik / Luar Kota', 'Import / Luar Negeri', 'Campuran'] as $s)
                                <option value="{{ $s }}"
                                    {{ old('sumber_bahan_baku', $kuliner->sumber_bahan_baku) == $s ? 'selected' : '' }}>
                                    {{ $s }}</option>
                            @endforeach
                        </select>
                        @error('sumber_bahan_baku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="bi bi-calendar-check"></i> Menu Bersifat <span
                                class="required">*</span></label><br>
                        @php $menuBersifat = old('menu_bersifat', $kuliner->menu_bersifat ?? []); @endphp
                        @foreach (['Tetap', 'Musiman'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="menu_bersifat[]" value="{{ $m }}"
                                    class="form-check-input" id="menu_{{ $m }}"
                                    {{ in_array($m, $menuBersifat) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="menu_{{ $m }}">{{ $m }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 3. TEMPAT & FASILITAS -->
                <div class="section-title">
                    <i class="bi bi-shop"></i> Tempat & Fasilitas
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-building"></i> Bentuk Fisik <span class="required">*</span>
                        </label>
                        <select name="bentuk_fisik" class="form-control @error('bentuk_fisik') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Bentuk Fisik --</option>
                            @foreach (['Restoran', 'Warung', 'Kafe', 'Food Court', 'Jasa Boga (Katering)', 'Penyedia Makanan oleh Pedagang Keliling', 'Penyedia Makanan oleh Pedagang Tidak Keliling'] as $b)
                                <option value="{{ $b }}"
                                    {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == $b ? 'selected' : '' }}>
                                    {{ $b }}</option>
                            @endforeach
                        </select>
                        @error('bentuk_fisik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-house-door"></i> Status Bangunan <span class="required">*</span>
                        </label>
                        @php
                            $statusBangunan = old('status_bangunan', $kuliner->status_bangunan);
                            $statusBangunanLain = '';
                            if (strpos($statusBangunan, 'Lainnya:') === 0) {
                                $statusBangunanLain = trim(str_replace('Lainnya:', '', $statusBangunan));
                                $statusBangunan = 'Lainnya...';
                            }
                        @endphp
                        <select name="status_bangunan"
                            class="form-control @error('status_bangunan') is-invalid @enderror"
                            id="statusBangunanSelect" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach (['Milik Sendiri', 'Sewa', 'Pinjam Pakai', 'Lainnya...'] as $sb)
                                <option value="{{ $sb }}" {{ $statusBangunan == $sb ? 'selected' : '' }}>
                                    {{ $sb }}</option>
                            @endforeach
                        </select>
                        @error('status_bangunan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="text" id="status_bangunan_lain" name="status_bangunan_lain"
                            class="form-control mt-2" placeholder="Tulis status lain..."
                            style="display:{{ $statusBangunan == 'Lainnya...' ? 'block' : 'none' }};"
                            value="{{ old('status_bangunan_lain', $statusBangunanLain) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-wifi"></i> Fasilitas Pendukung <span
                            class="required">*</span></label><br>
                    @php $fasilitasPendukung = old('fasilitas_pendukung', $kuliner->fasilitas_pendukung ?? []); @endphp
                    @foreach (['Toilet', 'Wastafel', 'Parkir', 'Mushola', 'WiFi', 'Tempat Sampah'] as $f)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="fasilitas_pendukung[]" value="{{ $f }}"
                                class="form-check-input" id="fasilitas_{{ $f }}"
                                {{ in_array($f, $fasilitasPendukung) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="fasilitas_{{ $f }}">{{ $f }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="section-divider"></div>

                <!-- 4. PRAKTIK K3 & SANITASI -->
                <div class="section-title">
                    <i class="bi bi-shield-check"></i> Praktik K3 & Sanitasi
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="bi bi-clipboard-check"></i> Pelatihan K3 <span
                                class="required">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pelatihan_k3" value="Ya"
                                id="k3_ya"
                                {{ old('pelatihan_k3', $kuliner->pelatihan_k3 ? 'Ya' : 'Tidak') == 'Ya' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="k3_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pelatihan_k3" value="Tidak"
                                id="k3_tidak"
                                {{ old('pelatihan_k3', $kuliner->pelatihan_k3 ? 'Ya' : 'Tidak') == 'Tidak' ? 'checked' : '' }}>
                            <label class="form-check-label" for="k3_tidak">Tidak</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-people"></i> Jumlah Penjamah Makanan <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_penjamah_makanan"
                            class="form-control @error('jumlah_penjamah_makanan') is-invalid @enderror"
                            value="{{ old('jumlah_penjamah_makanan', $kuliner->jumlah_penjamah_makanan) }}"
                            min="0" required>
                        @error('jumlah_penjamah_makanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-shield-fill-check"></i> APD Penjamah Makanan <span
                            class="required">*</span></label><br>
                    @php $apdPenjamah = old('apd_penjamah_makanan', $kuliner->apd_penjamah_makanan ?? []); @endphp
                    @foreach (['Masker', 'Hairnet', 'Celemek', 'Sarung Tangan'] as $apd)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="apd_penjamah_makanan[]" value="{{ $apd }}"
                                class="form-check-input" id="apd_{{ $apd }}"
                                {{ in_array($apd, $apdPenjamah) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="apd_{{ $apd }}">{{ $apd }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="bi bi-droplet"></i> Sanitasi Alat Dapur <span
                                class="required">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prosedur_sanitasi_alat"
                                value="Tidak Melakukan" id="sanitasi_tidak"
                                {{ old('prosedur_sanitasi_alat', $kuliner->prosedur_sanitasi_alat ? 'Melakukan' : 'Tidak Melakukan') == 'Tidak Melakukan' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="sanitasi_tidak">Tidak Melakukan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prosedur_sanitasi_alat"
                                value="Melakukan" id="sanitasi_ya"
                                {{ old('prosedur_sanitasi_alat', $kuliner->prosedur_sanitasi_alat ? 'Melakukan' : 'Tidak Melakukan') == 'Melakukan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="sanitasi_ya">Melakukan</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-clock-history"></i> Frekuensi Sanitasi Alat <span
                                class="required">*</span>
                        </label>
                        <input type="text" name="frekuensi_sanitasi_alat"
                            class="form-control @error('frekuensi_sanitasi_alat') is-invalid @enderror"
                            value="{{ old('frekuensi_sanitasi_alat', $kuliner->frekuensi_sanitasi_alat) }}"
                            maxlength="14" required>
                        @error('frekuensi_sanitasi_alat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="bi bi-droplet"></i> Sanitasi Bahan Makanan <span
                                class="required">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prosedur_sanitasi_bahan"
                                value="Tidak Melakukan" id="sanitasi_bahan_tidak"
                                {{ old('prosedur_sanitasi_bahan', $kuliner->prosedur_sanitasi_bahan ? 'Melakukan' : 'Tidak Melakukan') == 'Tidak Melakukan' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="sanitasi_bahan_tidak">Tidak Melakukan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prosedur_sanitasi_bahan"
                                value="Melakukan" id="sanitasi_bahan_ya"
                                {{ old('prosedur_sanitasi_bahan', $kuliner->prosedur_sanitasi_bahan ? 'Melakukan' : 'Tidak Melakukan') == 'Melakukan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="sanitasi_bahan_ya">Melakukan</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-clock-history"></i> Frekuensi Sanitasi Bahan <span
                                class="required">*</span>
                        </label>
                        <input type="text" name="frekuensi_sanitasi_bahan"
                            class="form-control @error('frekuensi_sanitasi_bahan') is-invalid @enderror"
                            value="{{ old('frekuensi_sanitasi_bahan', $kuliner->frekuensi_sanitasi_bahan) }}"
                            maxlength="14" required>
                        @error('frekuensi_sanitasi_bahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-thermometer-snow"></i> Penyimpanan Bahan Mentah <span
                                class="required">*</span>
                        </label>
                        <select name="penyimpanan_mentah"
                            class="form-control @error('penyimpanan_mentah') is-invalid @enderror" required>
                            <option value="">-- Pilih Penyimpanan --</option>
                            @foreach (['Dengan Pendingin, Terpisah', 'Dengan Pendingin, Tidak Terpisah', 'Tanpa Pendingin, Terpisah', 'Tanpa Pendingin, Tidak Terpisah'] as $pm)
                                <option value="{{ $pm }}"
                                    {{ old('penyimpanan_mentah', $kuliner->penyimpanan_mentah) == $pm ? 'selected' : '' }}>
                                    {{ $pm }}</option>
                            @endforeach
                        </select>
                        @error('penyimpanan_mentah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-thermometer-snow"></i> Penyimpanan Bahan Matang <span
                                class="required">*</span>
                        </label>
                        <select name="penyimpanan_matang"
                            class="form-control @error('penyimpanan_matang') is-invalid @enderror" required>
                            <option value="">-- Pilih Penyimpanan --</option>
                            @foreach (['Dengan Pendingin, Terpisah', 'Dengan Pendingin, Tidak Terpisah', 'Tanpa Pendingin, Terpisah', 'Tanpa Pendingin, Tidak Terpisah'] as $pm)
                                <option value="{{ $pm }}"
                                    {{ old('penyimpanan_matang', $kuliner->penyimpanan_matang) == $pm ? 'selected' : '' }}>
                                    {{ $pm }}</option>
                            @endforeach
                        </select>
                        @error('penyimpanan_matang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label"><i class="bi bi-arrow-repeat"></i> Prinsip FIFO / FEFO <span
                                class="required">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fifo_fefo" value="Ya"
                                id="fifo_ya"
                                {{ old('fifo_fefo', $kuliner->fifo_fefo ? 'Ya' : 'Tidak') == 'Ya' ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="fifo_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fifo_fefo" value="Tidak"
                                id="fifo_tidak"
                                {{ old('fifo_fefo', $kuliner->fifo_fefo ? 'Ya' : 'Tidak') == 'Tidak' ? 'checked' : '' }}>
                            <label class="form-check-label" for="fifo_tidak">Tidak</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-trash"></i> Limbah Dapur <span class="required">*</span>
                        </label>
                        <select name="limbah_dapur" class="form-control @error('limbah_dapur') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Limbah --</option>
                            @foreach (['Dipisah', 'Tidak dipisah'] as $l)
                                <option value="{{ $l }}"
                                    {{ old('limbah_dapur', $kuliner->limbah_dapur) == $l ? 'selected' : '' }}>
                                    {{ $l }}</option>
                            @endforeach
                        </select>
                        @error('limbah_dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-wind"></i> Ventilasi Dapur <span class="required">*</span>
                        </label>
                        <select name="ventilasi_dapur"
                            class="form-control @error('ventilasi_dapur') is-invalid @enderror" required>
                            <option value="">-- Pilih Ventilasi --</option>
                            @foreach (['Alami', 'Buatan'] as $v)
                                <option value="{{ $v }}"
                                    {{ old('ventilasi_dapur', $kuliner->ventilasi_dapur) == $v ? 'selected' : '' }}>
                                    {{ $v }}</option>
                            @endforeach
                        </select>
                        @error('ventilasi_dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-house"></i> Dapur <span class="required">*</span>
                        </label>
                        <select name="dapur" class="form-control @error('dapur') is-invalid @enderror" required>
                            <option value="">-- Pilih Dapur --</option>
                            @foreach (['Ada, terpisah', 'Ada, tidak terpisah', 'Tidak ada'] as $d)
                                <option value="{{ $d }}"
                                    {{ old('dapur', $kuliner->dapur) == $d ? 'selected' : '' }}>{{ $d }}
                                </option>
                            @endforeach
                        </select>
                        @error('dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-water"></i> Sumber Air Cuci <span class="required">*</span>
                        </label>
                        <select name="sumber_air_cuci"
                            class="form-control @error('sumber_air_cuci') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            @foreach (['PDAM', 'Sumur', 'Air Isi Ulang'] as $a)
                                <option value="{{ $a }}"
                                    {{ old('sumber_air_cuci', $kuliner->sumber_air_cuci) == $a ? 'selected' : '' }}>
                                    {{ $a }}</option>
                            @endforeach
                        </select>
                        @error('sumber_air_cuci')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-water"></i> Sumber Air Masak <span class="required">*</span>
                        </label>
                        <select name="sumber_air_masak"
                            class="form-control @error('sumber_air_masak') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            @foreach (['PDAM', 'Sumur', 'Air Isi Ulang'] as $a)
                                <option value="{{ $a }}"
                                    {{ old('sumber_air_masak', $kuliner->sumber_air_masak) == $a ? 'selected' : '' }}>
                                    {{ $a }}</option>
                            @endforeach
                        </select>
                        @error('sumber_air_masak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-cup-straw"></i> Sumber Air Minum <span class="required">*</span>
                        </label>
                        <select name="sumber_air_minum"
                            class="form-control @error('sumber_air_minum') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            @foreach (['PDAM', 'Sumur', 'Air Isi Ulang'] as $a)
                                <option value="{{ $a }}"
                                    {{ old('sumber_air_minum', $kuliner->sumber_air_minum) == $a ? 'selected' : '' }}>
                                    {{ $a }}</option>
                            @endforeach
                        </select>
                        @error('sumber_air_minum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 5. KOORDINAT LOKASI -->
                <div class="section-title">
                    <i class="bi bi-geo-alt"></i> Koordinat Lokasi
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-arrow-left-right"></i> Longitude <span class="required">*</span>
                        </label>
                        <input type="text" name="longitude"
                            class="form-control @error('longitude') is-invalid @enderror"
                            value="{{ old('longitude', $kuliner->longitude) }}" step="any" required>
                        <small class="form-text note">Format: 116.8225 (gunakan titik sebagai pemisah desimal)</small>
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-arrow-up-down"></i> Latitude <span class="required">*</span>
                        </label>
                        <input type="text" name="latitude"
                            class="form-control @error('latitude') is-invalid @enderror"
                            value="{{ old('latitude', $kuliner->latitude) }}" step="any" required>
                        <small class="form-text note">Format: -3.3211 (gunakan titik sebagai pemisah desimal)</small>
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 6. FOTO KULINER -->
                <div class="section-title">
                    <i class="bi bi-camera"></i> Foto Kuliner
                </div>

                @if ($kuliner->foto->count() > 0)
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-images"></i> Foto Yang Sudah Ada
                            <span class="counter-badge">{{ $kuliner->foto->count() }} foto</span>
                        </label>
                        <div class="existing-photos">
                            @foreach ($kuliner->foto as $foto)
                                <div class="photo-item" id="photo_{{ $foto->id_foto_kuliner }}">
                                    <img src="{{ $foto->url_foto }}" alt="Foto {{ $kuliner->nama_sentra }}">
                                    <form action="{{ route('kuliner.foto.delete', $foto->id_foto_kuliner) }}"
                                        method="POST" class="delete-photo-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="photo-delete-btn"
                                            onclick="return confirm('Yakin hapus foto ini?')">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <small class="form-text note">
                            <i class="bi bi-info-circle"></i> Klik tombol X untuk menghapus foto. Minimal harus ada 1
                            foto tersisa.
                        </small>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="form-label">
                        <i class="bi bi-plus-circle"></i> Tambah Foto Baru (Opsional)
                    </label>
                    <div class="file-upload-wrapper" id="fileUploadWrapper">
                        <input type="file" name="foto[]" multiple accept="image/*" id="fileInput"
                            style="display:none;">
                        <div class="file-upload-icon">
                            <i class="bi bi-cloud-upload" style="font-size: 48px; color: #2e7d32;"></i>
                        </div>
                        <div class="file-upload-text"
                            style="font-size: 18px; font-weight: 600; color: #1b5e20; margin-top: 15px;">
                            Klik untuk upload foto atau drag & drop
                        </div>
                        <div class="file-upload-hint" style="font-size: 14px; color: #666; margin-top: 10px;">
                            Format: JPG, PNG, JPEG | Maksimal: 2MB per file
                        </div>
                    </div>
                    <div class="selected-files" id="selectedFiles"></div>
                </div>

                <!-- Action Buttons -->
                <div class="button-group">
                    <button type="submit" class="btn-submit" id="submitButton">
                        <i class="bi bi-check-circle-fill"></i> Update Data
                    </button>
                    <a href="{{ route('kuliner.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            'use strict';

            console.log('Script starting...');

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init);
            } else {
                init();
            }

            function init() {
                console.log('Initializing...');

                // 1. KATEGORI COUNTER
                try {
                    const kategoriCheckboxes = document.querySelectorAll('.kategori-checkbox');
                    const selectedCountBadge = document.getElementById('selectedCount');

                    function updateKategoriCount() {
                        const checkedCount = document.querySelectorAll('.kategori-checkbox:checked').length;
                        if (selectedCountBadge) {
                            selectedCountBadge.textContent = checkedCount + ' dipilih';
                        }
                    }

                    if (kategoriCheckboxes.length > 0) {
                        updateKategoriCount();
                        kategoriCheckboxes.forEach(function(checkbox) {
                            checkbox.addEventListener('change', updateKategoriCount);
                        });
                    }
                    console.log('Kategori counter OK');
                } catch (e) {
                    console.error('Kategori error:', e);
                }

                // 2. SERTIFIKAT LAINNYA
                try {
                    const sertifikatChecks = document.querySelectorAll(".sertifikat-check");
                    const sertifikatText = document.getElementById("sertifikat_text");

                    function toggleSertifikatText() {
                        let isOtherChecked = false;
                        sertifikatChecks.forEach(function(chk) {
                            if (chk.value === "Lainnya" && chk.checked) {
                                isOtherChecked = true;
                            }
                        });

                        if (sertifikatText) {
                            sertifikatText.style.display = isOtherChecked ? "block" : "none";
                            if (!isOtherChecked) {
                                sertifikatText.value = "";
                            }
                        }
                    }

                    if (sertifikatChecks.length > 0) {
                        toggleSertifikatText();
                        sertifikatChecks.forEach(function(checkbox) {
                            checkbox.addEventListener("change", toggleSertifikatText);
                        });
                    }
                    console.log('Sertifikat toggle OK');
                } catch (e) {
                    console.error('Sertifikat error:', e);
                }

                // 3. STATUS BANGUNAN LAINNYA
                try {
                    const statusSelect = document.getElementById("statusBangunanSelect");
                    const statusLain = document.getElementById("status_bangunan_lain");

                    function toggleStatusLain() {
                        if (statusSelect && statusLain) {
                            statusLain.style.display = (statusSelect.value === "Lainnya...") ? "block" : "none";
                            if (statusSelect.value !== "Lainnya...") {
                                statusLain.value = "";
                            }
                        }
                    }

                    if (statusSelect) {
                        toggleStatusLain();
                        statusSelect.addEventListener("change", toggleStatusLain);
                    }
                    console.log('Status bangunan OK');
                } catch (e) {
                    console.error('Status error:', e);
                }

                // 4. JAM OPERASIONAL LIBUR
                try {
                    const operasionalRows = document.querySelectorAll("table.table-operasional tbody tr");
                    console.log('Rows found:', operasionalRows.length);

                    operasionalRows.forEach(function(row) {
                        const checkbox = row.querySelector('.libur-checkbox');
                        const timeInputs = row.querySelectorAll('input[type="time"]');

                        if (!checkbox) return;

                        let defaultValues = [];
                        timeInputs.forEach(function(input) {
                            defaultValues.push(input.value || '');
                        });

                        function updateRowState() {
                            if (checkbox.checked) {
                                timeInputs.forEach(function(input) {
                                    input.value = '00:00';
                                    input.disabled = true;
                                    input.style.background = '#f5f5f5';
                                });
                                row.style.opacity = '0.5';
                            } else {
                                timeInputs.forEach(function(input, idx) {
                                    input.disabled = false;
                                    input.style.background = '';
                                    if (input.value === '00:00') {
                                        if (idx === 0) input.value = defaultValues[idx] || '08:00';
                                        else if (idx === 1) input.value = defaultValues[idx] || '21:00';
                                        else input.value = defaultValues[idx] || '';
                                    }
                                });
                                row.style.opacity = '1';
                            }
                        }

                        updateRowState();
                        checkbox.addEventListener("change", updateRowState);
                    });
                    console.log('Jam operasional OK');
                } catch (e) {
                    console.error('Jam operasional error:', e);
                }

                // 5. FORM SUBMIT VALIDATION
                try {
                    const form = document.getElementById('kulinerForm');
                    const submitButton = document.getElementById('submitButton');

                    if (!form) {
                        console.error('Form not found!');
                        return;
                    }

                    console.log('Form found:', form);
                    console.log('Submit button found:', submitButton);

                    // Fungsi validasi yang bisa dipanggil dari mana saja
                    function validateForm() {
                        console.log('🔍 Validating form...');

                        const tableRows = document.querySelectorAll('.table-operasional tbody tr');
                        let hasError = false;
                        let errorMsg = '';

                        tableRows.forEach(function(row, index) {
                            if (hasError) return;

                            const liburCheckbox = row.querySelector('.libur-checkbox');
                            const jamBukaInput = row.querySelector('input[name="jam_buka[' + index + ']"]');
                            const jamTutupInput = row.querySelector('input[name="jam_tutup[' + index + ']"]');
                            const hariInput = row.querySelector('input[name="hari[' + index + ']"]');

                            if (!jamBukaInput || !jamTutupInput || !hariInput) return;
                            if (liburCheckbox && liburCheckbox.checked) return;
                            if (jamBukaInput.disabled) return;

                            const jamBuka = jamBukaInput.value;
                            const jamTutup = jamTutupInput.value;
                            const hari = hariInput.value;

                            if (jamBuka === '00:00' && jamTutup === '00:00') return;

                            if (!jamBuka || !jamTutup) {
                                hasError = true;
                                errorMsg = 'Jam buka dan tutup pada hari ' + hari + ' harus diisi!';
                                return;
                            }

                            if (jamTutup <= jamBuka) {
                                hasError = true;
                                errorMsg = 'Jam tutup hari ' + hari + ' harus lebih besar dari jam buka!';
                                return;
                            }
                        });

                        return {
                            valid: !hasError,
                            error: errorMsg
                        };
                    }

                    // Handler 1: Form submit event (backup)
                    form.addEventListener('submit', function(e) {
                        console.log('🚀 SUBMIT EVENT TRIGGERED');

                        const validation = validateForm();

                        if (!validation.valid) {
                            e.preventDefault();
                            e.stopPropagation();
                            alert('⚠️ ' + validation.error);
                            return false;
                        }

                        console.log('✅ Form validation passed');
                        // Allow natural form submission
                    }, false);

                    // Handler 2: Button click event (primary)
                    if (submitButton) {
                        submitButton.addEventListener('click', function(e) {
                            console.log('🔴 BUTTON CLICKED');

                            // Prevent default untuk kontrol penuh
                            e.preventDefault();

                            const validation = validateForm();

                            if (!validation.valid) {
                                alert('⚠️ ' + validation.error);
                                return false;
                            }

                            console.log('✅ Validation passed - submitting form...');

                            // Submit form secara programmatic
                            form.submit();
                        }, false);
                    }

                    console.log('Form handler attached');
                } catch (e) {
                    console.error('Form error:', e);
                }
                try {
                    const form = document.getElementById('kulinerForm');
                    const submitButton = document.getElementById('submitButton');

                    if (!form) {
                        console.error('Form not found!');
                        return;
                    }

                    console.log('Form found:', form);
                    console.log('Submit button found:', submitButton);

                    // Fungsi validasi yang bisa dipanggil dari mana saja
                    function validateForm() {
                        console.log('🔍 Validating form...');

                        const tableRows = document.querySelectorAll('.table-operasional tbody tr');
                        let hasError = false;
                        let errorMsg = '';

                        tableRows.forEach(function(row, index) {
                            if (hasError) return;

                            const liburCheckbox = row.querySelector('.libur-checkbox');
                            const jamBukaInput = row.querySelector('input[name="jam_buka[' + index + ']"]');
                            const jamTutupInput = row.querySelector('input[name="jam_tutup[' + index + ']"]');
                            const hariInput = row.querySelector('input[name="hari[' + index + ']"]');

                            if (!jamBukaInput || !jamTutupInput || !hariInput) return;
                            if (liburCheckbox && liburCheckbox.checked) return;
                            if (jamBukaInput.disabled) return;

                            const jamBuka = jamBukaInput.value;
                            const jamTutup = jamTutupInput.value;
                            const hari = hariInput.value;

                            if (jamBuka === '00:00' && jamTutup === '00:00') return;

                            if (!jamBuka || !jamTutup) {
                                hasError = true;
                                errorMsg = 'Jam buka dan tutup pada hari ' + hari + ' harus diisi!';
                                return;
                            }

                            if (jamTutup <= jamBuka) {
                                hasError = true;
                                errorMsg = 'Jam tutup hari ' + hari + ' harus lebih besar dari jam buka!';
                                return;
                            }
                        });

                        return {
                            valid: !hasError,
                            error: errorMsg
                        };
                    }

                    // Handler 1: Form submit event (backup)
                    form.addEventListener('submit', function(e) {
                        console.log('🚀 SUBMIT EVENT TRIGGERED');

                        const validation = validateForm();

                        if (!validation.valid) {
                            e.preventDefault();
                            e.stopPropagation();
                            alert('⚠️ ' + validation.error);
                            return false;
                        }

                        console.log('✅ Form validation passed');
                        // Allow natural form submission
                    }, false);

                    // Handler 2: Button click event (primary)
                    if (submitButton) {
                        submitButton.addEventListener('click', function(e) {
                            console.log('🔴 BUTTON CLICKED');

                            // Prevent default untuk kontrol penuh
                            e.preventDefault();

                            const validation = validateForm();

                            if (!validation.valid) {
                                alert('⚠️ ' + validation.error);
                                return false;
                            }

                            console.log('✅ Validation passed - submitting form...');

                            // Submit form secara programmatic
                            form.submit();
                        }, false);
                    }

                    console.log('Form handler attached');
                } catch (e) {
                    console.error('Form error:', e);
                }

                // 6. FILE UPLOAD
                try {
                    const fileInput = document.getElementById('fileInput');
                    const selectedFilesContainer = document.getElementById('selectedFiles');
                    const uploadWrapper = document.getElementById('fileUploadWrapper');
                    let selectedFiles = [];

                    if (!uploadWrapper || !fileInput) return;

                    uploadWrapper.addEventListener('click', function() {
                        fileInput.click();
                    });

                    fileInput.addEventListener('change', function(e) {
                        handleFiles(e.target.files);
                    });

                    function handleFiles(files) {
                        Array.from(files).forEach(function(file) {
                            if (!file.type.match('image.*')) {
                                alert(file.name + ' bukan gambar!');
                                return;
                            }
                            if (file.size > 2097152) {
                                alert(file.name + ' terlalu besar!');
                                return;
                            }
                            selectedFiles.push(file);
                        });
                        displayFiles();
                        updateFileInput();
                    }

                    function displayFiles() {
                        if (!selectedFilesContainer) return;
                        selectedFilesContainer.innerHTML = '';
                        selectedFilesContainer.style.display = selectedFiles.length > 0 ? 'grid' : 'none';

                        selectedFiles.forEach(function(file, index) {
                            const div = document.createElement('div');
                            div.style.cssText =
                                'position:relative;border-radius:12px;overflow:hidden;background:white;';

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                div.innerHTML = '<img src="' + e.target.result +
                                    '" style="width:100%;height:150px;object-fit:cover">' +
                                    '<button type="button" onclick="window.removeFile(' + index +
                                    ')" style="position:absolute;top:8px;right:8px;background:#d32f2f;color:white;border:none;border-radius:50%;width:28px;height:28px;cursor:pointer">×</button>';
                            };
                            reader.readAsDataURL(file);
                            selectedFilesContainer.appendChild(div);
                        });
                    }

                    function updateFileInput() {
                        const dt = new DataTransfer();
                        selectedFiles.forEach(function(file) {
                            dt.items.add(file);
                        });
                        fileInput.files = dt.files;
                    }

                    window.removeFile = function(index) {
                        selectedFiles.splice(index, 1);
                        displayFiles();
                        updateFileInput();
                    };

                    console.log('File upload OK');
                } catch (e) {
                    console.error('File upload error:', e);
                }

                console.log('ALL COMPLETE!');

            }
        })();
    </script>
</body>

</html>
