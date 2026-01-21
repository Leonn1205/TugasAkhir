<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Tempat Kuliner - {{ $kuliner->nama_sentra }}</title>
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

        .alert-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 350px;
            max-width: 500px;
            animation: slideInRight 0.4s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
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

        .alert-sticky {
            position: sticky;
            top: 20px;
            z-index: 100;
            margin-bottom: 2rem;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
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
            display: flex;
            min-height: 50px;
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
            display: flex;
            padding: 12px 40px 12px 16px;
            font-weight: 500;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            width: 100%;
            height: 100%;
        }

        .kategori-item input[type="checkbox"]:checked + .kategori-label {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }

        .kategori-item input[type="checkbox"]:checked + .kategori-label::after {
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

        .form-control, .form-select {
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #d32f2f;
            background-color: #ffebee;
        }

        .invalid-feedback {
            display: block;
            color: #d32f2f;
            font-size: 13px;
            margin-top: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .invalid-feedback::before {
            content: "⚠";
            font-size: 14px;
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

        /* Foto Section */
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background: white;
        }

        .photo-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .photo-item .delete-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(211,47,47,0.95);
            color: white;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 3;
        }

        .photo-item .delete-btn:hover {
            background: rgba(211,47,47,1);
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

        .error-summary h5 {
            color: #d32f2f;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-summary ul {
            margin: 0;
            padding-left: 25px;
        }

        .error-summary li {
            color: #b71c1c;
            margin-bottom: 8px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header-section">
        <div class="container">
            <h1><i class="bi bi-pencil-square me-2"></i>Edit Data Tempat Kuliner</h1>
            <p>{{ $kuliner->nama_sentra }}</p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            {{-- Error Summary untuk Koordinat --}}
            @if ($errors->has('lokasi'))
                <div class="error-summary alert-sticky">
                    <h5>
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Peringatan Lokasi
                    </h5>
                    <p><strong>{{ $errors->first('lokasi') }}</strong></p>
                </div>
            @endif

            {{-- Error Summary Umum --}}
            @if ($errors->any() && !$errors->has('lokasi'))
                <div class="error-summary alert-sticky">
                    <h5>
                        <i class="bi bi-x-circle-fill"></i>
                        Terdapat {{ $errors->count() }} Kesalahan dalam Pengisian Form
                    </h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('kuliner.update', $kuliner->id_kuliner) }}" enctype="multipart/form-data" id="kulinerForm">
                @csrf
                @method('PUT')

                <!-- 1. IDENTITAS USAHA -->
                <div class="section-title">
                    <i class="bi bi-building"></i>
                    Identitas Usaha
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-shop"></i>
                            Nama Sentra / Usaha <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_sentra" class="form-control @error('nama_sentra') is-invalid @enderror"
                            value="{{ old('nama_sentra', $kuliner->nama_sentra) }}" required>
                        @error('nama_sentra')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-calendar-event"></i>
                            Tahun Berdiri <span class="required">*</span>
                        </label>
                        <input type="number" name="tahun_berdiri" class="form-control @error('tahun_berdiri') is-invalid @enderror"
                            min="1900" max="{{ date('Y') }}" value="{{ old('tahun_berdiri', $kuliner->tahun_berdiri) }}" required>
                        @error('tahun_berdiri')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person"></i>
                            Nama Pemilik <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror"
                            value="{{ old('nama_pemilik', $kuliner->nama_pemilik) }}" required>
                        @error('nama_pemilik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-briefcase"></i>
                            Kepemilikan <span class="required">*</span>
                        </label>
                        <select name="kepemilikan" class="form-control @error('kepemilikan') is-invalid @enderror" required>
                            <option value="">-- Pilih Kepemilikan --</option>
                            @foreach(['Pribadi', 'Keluarga', 'Komunitas', 'Waralaba'] as $k)
                                <option value="{{ $k }}" {{ old('kepemilikan', $kuliner->kepemilikan) == $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>
                        @error('kepemilikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-geo-alt"></i>
                        Alamat Lengkap <span class="required">*</span>
                    </label>
                    <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" rows="2" required>{{ old('alamat_lengkap', $kuliner->alamat_lengkap) }}</textarea>
                    @error('alamat_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-telephone"></i>
                            No. Telepon <span class="required">*</span>
                        </label>
                        <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                            value="{{ old('telepon', $kuliner->telepon) }}" required>
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-envelope"></i>
                            Email <span class="required">*</span>
                        </label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $kuliner->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-file-text"></i>
                            No. NIB <span class="required">*</span>
                        </label>
                        <input type="text" name="no_nib" class="form-control @error('no_nib') is-invalid @enderror"
                            value="{{ old('no_nib', $kuliner->no_nib) }}" maxlength="13" required>
                        @error('no_nib')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-award"></i>
                        Sertifikat (boleh lebih dari satu)
                    </label><br>
                    @php
                        $existingSertifikat = old('sertifikat_lain', $kuliner->sertifikat_lain ?? []);
                        $sertifikatOptions = ['PIRT', 'BPOM', 'Halal', 'NIB', 'Lainnya'];
                    @endphp
                    @foreach($sertifikatOptions as $item)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="sertifikat_lain[]" value="{{ $item }}"
                                id="sertifikat_{{ $item }}" class="form-check-input sertifikat-check"
                                {{ in_array($item, $existingSertifikat) || collect($existingSertifikat)->contains(fn($s) => str_starts_with($s, 'Lainnya:')) && $item == 'Lainnya' ? 'checked' : '' }}>
                            <label class="form-check-label" for="sertifikat_{{ $item }}">{{ $item }}</label>
                        </div>
                    @endforeach
                    @php
                        $lainnyaValue = collect($existingSertifikat)->first(fn($s) => str_starts_with($s, 'Lainnya:'));
                        $lainnyaText = $lainnyaValue ? str_replace('Lainnya: ', '', $lainnyaValue) : old('sertifikat_text', '');
                    @endphp
                    <input type="text" id="sertifikat_text" name="sertifikat_text"
                        class="form-control mt-2" placeholder="Tulis sertifikat lainnya..."
                        style="display:{{ $lainnyaValue || in_array('Lainnya', $existingSertifikat) ? 'block' : 'none' }}; max-width:400px;"
                        value="{{ $lainnyaText }}">
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-people"></i>
                            Jumlah Pegawai <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_pegawai" class="form-control @error('jumlah_pegawai') is-invalid @enderror"
                            min="0" value="{{ old('jumlah_pegawai', $kuliner->jumlah_pegawai) }}" required>
                        @error('jumlah_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-grid"></i>
                            Jumlah Kursi <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_kursi" class="form-control @error('jumlah_kursi') is-invalid @enderror"
                            min="0" value="{{ old('jumlah_kursi', $kuliner->jumlah_kursi) }}" required>
                        @error('jumlah_kursi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-shop-window"></i>
                            Jumlah Gerai <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_gerai" class="form-control @error('jumlah_gerai') is-invalid @enderror"
                            min="0" value="{{ old('jumlah_gerai', $kuliner->jumlah_gerai) }}" required>
                        @error('jumlah_gerai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person-check"></i>
                            Pelanggan/Hari <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_pelanggan_per_hari"
                            class="form-control @error('jumlah_pelanggan_per_hari') is-invalid @enderror"
                            min="0" value="{{ old('jumlah_pelanggan_per_hari', $kuliner->jumlah_pelanggan_per_hari) }}" required>
                        @error('jumlah_pelanggan_per_hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- JAM OPERASIONAL -->
                <div class="section-title">
                    <i class="bi bi-clock"></i>
                    Jam Operasional
                </div>

                <div class="alert-info-custom">
                    <strong><i class="bi bi-info-circle-fill me-2"></i>Petunjuk Pengisian:</strong>
                    <ul>
                        <li>Isi jam buka dan jam tutup untuk setiap hari</li>
                        <li>Jam sibuk bersifat opsional</li>
                        <li>Centang "Libur" bila tempat tidak beroperasi hari itu</li>
                    </ul>
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
                            @php
                                $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                $jamOp = $kuliner->jamOperasionalAdmin->keyBy('hari');
                            @endphp
                            @foreach($hariList as $i => $day)
                                @php
                                    $jadwal = $jamOp->get($day);
                                @endphp
                                <tr>
                                    <td><input type="text" name="hari[{{ $i }}]" class="form-control text-center" value="{{ $day }}" readonly></td>
                                    <td><input type="time" name="jam_buka[{{ $i }}]" class="form-control"
                                        value="{{ old('jam_buka.'.$i, $jadwal ? $jadwal->jam_buka?->format('H:i') : '08:00') }}"></td>
                                    <td><input type="time" name="jam_tutup[{{ $i }}]" class="form-control"
                                        value="{{ old('jam_tutup.'.$i, $jadwal ? $jadwal->jam_tutup?->format('H:i') : '21:00') }}"></td>
                                    <td><input type="time" name="jam_sibuk_mulai[{{ $i }}]" class="form-control"
                                        value="{{ old('jam_sibuk_mulai.'.$i, $jadwal && $jadwal->jam_sibuk_mulai ? $jadwal->jam_sibuk_mulai->format('H:i') : '') }}"></td>
                                    <td><input type="time" name="jam_sibuk_selesai[{{ $i }}]" class="form-control"
                                        value="{{ old('jam_sibuk_selesai.'.$i, $jadwal && $jadwal->jam_sibuk_selesai ? $jadwal->jam_sibuk_selesai->format('H:i') : '') }}"></td>
                                    <td><input type="checkbox" name="libur[{{ $i }}]" class="libur-checkbox"
                                        {{ (in_array($i, old('libur', [])) || ($jadwal && $jadwal->libur)) ? 'checked' : '' }}></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @error('jam_operasional')
                        <div class="alert-jam-operasional" style="background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%); border-left: 4px solid #c62828; border-radius: 12px; padding: 16px; margin-top: 1rem;">
                            <i class="bi bi-exclamation-triangle-fill" style="color: #c62828;"></i>
                            <strong>⚠️ Error Jam Operasional:</strong> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label @error('profil_pelanggan') text-danger @enderror">
                            <i class="bi bi-person-badge"></i>
                            Profil Pelanggan <span class="required">*</span>
                        </label><br>
                        @foreach(['Lokal', 'Wisatawan', 'Pelajar/Mahasiswa', 'Pekerja'] as $p)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="profil_pelanggan[]" value="{{ $p }}"
                                    class="form-check-input" id="profil_{{ $p }}"
                                    {{ in_array($p, old('profil_pelanggan', $kuliner->profil_pelanggan ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="profil_{{ $p }}">{{ $p }}</label>
                            </div>
                        @endforeach
                        @error('profil_pelanggan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label @error('metode_pembayaran') text-danger @enderror">
                            <i class="bi bi-credit-card"></i>
                            Metode Pembayaran <span class="required">*</span>
                        </label><br>
                        @foreach(['Tunai', 'Qris / Transfer'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="metode_pembayaran[]" value="{{ $m }}"
                                    class="form-check-input" id="metode_{{ $m }}"
                                    {{ in_array($m, old('metode_pembayaran', $kuliner->metode_pembayaran ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="metode_{{ $m }}">{{ $m }}</label>
                            </div>
                        @endforeach
                        @error('metode_pembayaran')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-cash-coin"></i>
                        Pajak / Retribusi <span class="required">*</span>
                    </label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pajak_retribusi" value="Ya" id="pajak_ya"
                            {{ old('pajak_retribusi', $kuliner->pajak_retribusi ? 'Ya' : 'Tidak') == 'Ya' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="pajak_ya">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pajak_retribusi" value="Tidak" id="pajak_tidak"
                            {{ old('pajak_retribusi', $kuliner->pajak_retribusi ? 'Ya' : 'Tidak') == 'Tidak' ? 'checked' : '' }}>
                        <label class="form-check-label" for="pajak_tidak">Tidak</label>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- KATEGORI & MENU -->
                <div class="section-title">
                    <i class="bi bi-card-list"></i>
                    Jenis Kuliner & Kategori
                </div>

                <div class="mb-3">
                    <label class="form-label @error('kategori') text-danger @enderror">
                        <i class="bi bi-tags"></i>
                        Kategori <span class="required">*</span>
                        <span class="counter-badge" id="selectedCount">0 dipilih</span>
                    </label>

                    @if($kategori->isEmpty())
                        <div class="empty-kategori">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <h5>Tidak Ada Kategori Aktif</h5>
                            <p>Belum ada kategori kuliner yang aktif.</p>
                        </div>
                    @else
                        <div class="kategori-container">
                            @php
                                $selectedKategori = old('kategori', $kuliner->kategori->pluck('id_kategori')->toArray());
                            @endphp
                            @foreach($kategori as $kat)
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
                            <i class="bi bi-star"></i>
                            Menu Unggulan <span class="required">*</span>
                        </label>
                        <input type="text" name="menu_unggulan" class="form-control @error('menu_unggulan') is-invalid @enderror"
                            value="{{ old('menu_unggulan', $kuliner->menu_unggulan) }}" required>
                        @error('menu_unggulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-basket"></i>
                            Bahan Baku Utama <span class="required">*</span>
                        </label>
                        <input type="text" name="bahan_baku_utama" class="form-control @error('bahan_baku_utama') is-invalid @enderror"
                            value="{{ old('bahan_baku_utama', $kuliner->bahan_baku_utama) }}" required>
                        @error('bahan_baku_utama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-truck"></i>
                            Sumber Bahan Baku <span class="required">*</span>
                        </label>
                        <select name="sumber_bahan_baku" class="form-control @error('sumber_bahan_baku') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            @foreach(['Lokal', 'Domestik / Luar Kota', 'Import / Luar Negeri', 'Campuran'] as $s)
                                <option value="{{ $s }}" {{ old('sumber_bahan_baku', $kuliner->sumber_bahan_baku) == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('sumber_bahan_baku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-calendar-check"></i>
                            Menu Bersifat <span class="required">*</span>
                        </label><br>
                        @foreach(['Tetap', 'Musiman'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="menu_bersifat[]" value="{{ $m }}"
                                    class="form-check-input" id="menu_{{ $m }}"
                                    {{ in_array($m, old('menu_bersifat', $kuliner->menu_bersifat ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="menu_{{ $m }}">{{ $m }}</label>
                            </div>
                        @endforeach
                        @error('menu_bersifat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- TEMPAT & FASILITAS -->
                <div class="section-title">
                    <i class="bi bi-shop"></i>
                    Tempat & Fasilitas
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-building"></i>
                            Bentuk Fisik <span class="required">*</span>
                        </label>
                        <select name="bentuk_fisik" class="form-control @error('bentuk_fisik') is-invalid @enderror" required>
                            <option value="">-- Pilih Bentuk Fisik --</option>
                            @foreach(['Restoran', 'Warung', 'Kafe', 'Food Court', 'Jasa Boga (Katering)', 'Penyedia Makanan oleh Pedagang Keliling', 'Penyedia Makanan oleh Pedagang Tidak Keliling'] as $b)
                                <option value="{{ $b }}" {{ old('bentuk_fisik', $kuliner->bentuk_fisik) == $b ? 'selected' : '' }}>{{ $b }}</option>
                            @endforeach
                        </select>
                        @error('bentuk_fisik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-house-door"></i>
                            Status Bangunan <span class="required">*</span>
                        </label>
                        @php
                            $currentStatus = old('status_bangunan', $kuliner->status_bangunan);
                            $isLainnya = !in_array($currentStatus, ['Milik Sendiri', 'Sewa', 'Pinjam Pakai']);
                            $displayStatus = $isLainnya ? 'Lainnya...' : $currentStatus;
                            $lainnyaText = $isLainnya ? str_replace('Lainnya: ', '', $currentStatus) : '';
                        @endphp
                        <select name="status_bangunan" class="form-control @error('status_bangunan') is-invalid @enderror" id="statusBangunanSelect" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach(['Milik Sendiri', 'Sewa', 'Pinjam Pakai', 'Lainnya...'] as $st)
                                <option value="{{ $st }}" {{ $displayStatus == $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                        @error('status_bangunan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="text" id="status_bangunan_lain" name="status_bangunan_lain"
                            class="form-control mt-2" placeholder="Tulis status lain..."
                            style="display:{{ $isLainnya ? 'block' : 'none' }};"
                            value="{{ old('status_bangunan_lain', $lainnyaText) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-wifi"></i>
                        Fasilitas Pendukung <span class="required">*</span>
                    </label><br>
                    @foreach(['Toilet', 'Wastafel', 'Parkir', 'Mushola', 'WiFi', 'Tempat Sampah'] as $f)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="fasilitas_pendukung[]" value="{{ $f }}"
                                class="form-check-input" id="fasilitas_{{ $f }}"
                                {{ in_array($f, old('fasilitas_pendukung', $kuliner->fasilitas_pendukung ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="fasilitas_{{ $f }}">{{ $f }}</label>
                        </div>
                    @endforeach
                    @error('fasilitas_pendukung')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="section-divider"></div>

                <!-- K3 & SANITASI (dipersingkat untuk space) -->
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

                <!-- KOORDINAT -->
                <div class="section-title">
                    <i class="bi bi-geo-alt"></i>
                    Koordinat Lokasi
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-arrow-left-right"></i>
                            Longitude <span class="required">*</span>
                        </label>
                        <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                            value="{{ old('longitude', $kuliner->longitude) }}" required>
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-arrow-up-down"></i>
                            Latitude <span class="required">*</span>
                        </label>
                        <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                            value="{{ old('latitude', $kuliner->latitude) }}" required>
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- FOTO -->
                <div class="section-title">
                    <i class="bi bi-camera"></i>
                    Foto Kuliner
                </div>

                @if($kuliner->foto->count() > 0)
                    <div class="existing-photos">
                        @foreach($kuliner->foto as $foto)
                            <div class="photo-item" id="photo-{{ $foto->id_foto_kuliner }}">
                                <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Foto">
                                <button type="button" class="delete-btn" onclick="deleteFoto({{ $foto->id_foto_kuliner }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mb-4">
                    <div class="file-upload-wrapper" id="fileUploadWrapper">
                        <input type="file" name="foto[]" multiple accept="image/*" id="fileInput" style="display:none;">
                        <div class="file-upload-icon">
                            <i class="bi bi-cloud-upload" style="font-size: 48px; color: #2e7d32;"></i>
                        </div>
                        <div class="file-upload-text" style="font-size: 18px; font-weight: 600; color: #1b5e20; margin-top: 15px;">
                            Klik untuk tambah foto baru
                        </div>
                        <div class="file-upload-hint" style="font-size: 14px; color: #666; margin-top: 10px;">
                            Format: JPG, PNG, JPEG | Maksimal: 2MB per file
                        </div>
                    </div>
                    <div class="selected-files" id="selectedFiles"></div>
                </div>

                <!-- Action Buttons -->
                <div class="button-group">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle-fill"></i>
                        Update Data
                    </button>
                    <a href="{{ route('kuliner.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- Form untuk delete foto -->
    <form id="deleteFotoForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Delete Foto Function
        function deleteFoto(idFoto) {
            if (confirm('Yakin ingin menghapus foto ini?')) {
                const form = document.getElementById('deleteFotoForm');
                form.action = `/dashboard/kuliner/foto/${idFoto}`;
                form.submit();
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            // Counter Kategori
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

            // Sertifikat Lainnya
            const sertifikatChecks = document.querySelectorAll(".sertifikat-check");
            const sertifikatText = document.getElementById("sertifikat_text");

            function toggleSertifikatText() {
                const isOtherChecked = Array.from(sertifikatChecks).some(chk =>
                    chk.value === "Lainnya" && chk.checked
                );
                if (sertifikatText) {
                    sertifikatText.style.display = isOtherChecked ? "block" : "none";
                    if (!isOtherChecked) sertifikatText.value = "";
                }
            }
            toggleSertifikatText();
            sertifikatChecks.forEach(checkbox => {
                checkbox.addEventListener("change", toggleSertifikatText);
            });

            // Status Bangunan Lainnya
            const statusSelect = document.getElementById("statusBangunanSelect");
            const statusLain = document.getElementById("status_bangunan_lain");

            function toggleStatusLain() {
                if (statusSelect && statusLain) {
                    if (statusSelect.value === "Lainnya...") {
                        statusLain.style.display = "block";
                    } else {
                        statusLain.style.display = "none";
                        statusLain.value = "";
                    }
                }
            }
            toggleStatusLain();
            if (statusSelect) {
                statusSelect.addEventListener("change", toggleStatusLain);
            }

            // Jam Operasional - Libur Checkbox
            const operasionalRows = document.querySelectorAll("table tbody tr");

            operasionalRows.forEach(row => {
                const checkbox = row.querySelector('.libur-checkbox');
                const timeInputs = row.querySelectorAll('input[type="time"]');
                if (!checkbox) return;

                const defaultValues = Array.from(timeInputs).map(input => input.value || '');

                if (checkbox.checked) {
                    timeInputs.forEach(input => {
                        input.value = '00:00';
                        input.readOnly = true;
                        input.style.background = '#f5f5f5';
                        input.style.cursor = 'not-allowed';
                        input.style.pointerEvents = 'none';
                    });
                    row.style.opacity = '0.5';
                }

                checkbox.addEventListener("change", () => {
                    if (checkbox.checked) {
                        timeInputs.forEach(input => {
                            input.value = '00:00';
                            input.readOnly = true;
                            input.style.background = '#f5f5f5';
                            input.style.cursor = 'not-allowed';
                            input.style.pointerEvents = 'none';
                        });
                        row.style.opacity = '0.5';
                    } else {
                        timeInputs.forEach((input, idx) => {
                            input.readOnly = false;
                            input.style.background = '';
                            input.style.cursor = '';
                            input.style.pointerEvents = '';
                            if (idx === 0) input.value = defaultValues[idx] || '08:00';
                            else if (idx === 1) input.value = defaultValues[idx] || '21:00';
                            else input.value = defaultValues[idx] || '';
                        });
                        row.style.opacity = '1';
                    }
                });
            });

            // Scroll to first error
            const firstError = document.querySelector('.is-invalid, .error-summary');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });

        // File Upload Handler (sama seperti create)
        const fileInput = document.getElementById('fileInput');
        const selectedFilesContainer = document.getElementById('selectedFiles');
        const uploadWrapper = document.getElementById('fileUploadWrapper');
        let selectedFiles = [];

        uploadWrapper.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', (e) => handleFiles(e.target.files));

        uploadWrapper.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.stopPropagation();
            uploadWrapper.style.borderColor = '#1b5e20';
        });

        uploadWrapper.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadWrapper.style.borderColor = '#2e7d32';
        });

        uploadWrapper.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            uploadWrapper.style.borderColor = '#2e7d32';
            handleFiles(e.dataTransfer.files);
        });

        function handleFiles(files) {
            const filesArray = Array.from(files);
            filesArray.forEach(file => {
                if (!file.type.match('image.*')) {
                    alert('❌ ' + file.name + ' bukan file gambar!');
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    alert('❌ ' + file.name + ' terlalu besar! Maksimal 2MB.');
                    return;
                }
                selectedFiles.push(file);
            });
            displayFiles();
            updateFileInput();
        }

        function displayFiles() {
            selectedFilesContainer.innerHTML = '';
            selectedFilesContainer.style.display = selectedFiles.length > 0 ? 'grid' : 'none';
            selectedFilesContainer.style.gridTemplateColumns = 'repeat(auto-fill, minmax(150px, 1fr))';
            selectedFilesContainer.style.gap = '15px';
            selectedFilesContainer.style.marginTop = '1.5rem';

            selectedFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.style.cssText = 'position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); background: white;';

                const reader = new FileReader();
                reader.onload = function(e) {
                    fileItem.innerHTML = `
                        <img src="${e.target.result}" alt="${file.name}" style="width:100%; height:150px; object-fit:cover;">
                        <button type="button" onclick="removeFile(${index})" style="position:absolute; top:8px; right:8px; background:rgba(211,47,47,0.95); color:white; border:none; border-radius:50%; width:28px; height:28px; cursor:pointer;">
                            <i class="bi bi-x"></i>
                        </button>
                        <div style="padding:10px; font-size:12px; text-align:center; background:#f8f9fa;">${file.name}</div>
                    `;
                };
                reader.readAsDataURL(file);
                selectedFilesContainer.appendChild(fileItem);
            });
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }

        window.removeFile = function(index) {
            selectedFiles.splice(index, 1);
            displayFiles();
            updateFileInput();
        };
    </script>
</body>
</html>
