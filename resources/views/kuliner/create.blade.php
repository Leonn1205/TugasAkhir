<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Tempat Kuliner - Kotabaru Tourism</title>
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

        .form-text.note {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-top: 5px;
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
    </style>
</head>

<body>
    <div class="header-section">
        <div class="container">
            <h1><i class="bi bi-plus-circle-fill me-2"></i>Tambah Data Tempat Kuliner</h1>
            <p>Lengkapi data kuliner baru untuk Kotabaru Tourism Data Center</p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <form method="POST" action="{{ route('kuliner.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- 1. IDENTITAS USAHA -->
                <div class="section-title">
                    <i class="bi bi-building"></i>
                    Identitas Usaha
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-shop"></i>
                            Nama Sentra / Usaha
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_sentra"
                            class="form-control @error('nama_sentra') is-invalid @enderror"
                            placeholder="Contoh: Warung Sari Laut Kotabaru" value="{{ old('nama_sentra') }}" required>
                        @error('nama_sentra')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-calendar-event"></i>
                            Tahun Berdiri <span class="required">*</span>
                        </label>
                        <input type="number" name="tahun_berdiri"
                            class="form-control @error('tahun_berdiri') is-invalid @enderror" min="1900"
                            max="{{ date('Y') }}" placeholder="2020" value="{{ old('tahun_berdiri') }}" required>
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
                        <input type="text" name="nama_pemilik"
                            class="form-control @error('nama_pemilik') is-invalid @enderror"
                            placeholder="Contoh: Budi Santoso" value="{{ old('nama_pemilik') }}" required>
                        @error('nama_pemilik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-briefcase"></i>
                            Kepemilikan <span class="required">*</span>
                        </label>
                        <select name="kepemilikan" class="form-control @error('kepemilikan') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Kepemilikan --</option>
                            <option value="Pribadi" {{ old('kepemilikan') == 'Pribadi' ? 'selected' : '' }}>Pribadi
                            </option>
                            <option value="Keluarga" {{ old('kepemilikan') == 'Keluarga' ? 'selected' : '' }}>Keluarga
                            </option>
                            <option value="Komunitas" {{ old('kepemilikan') == 'Komunitas' ? 'selected' : '' }}>
                                Komunitas</option>
                            <option value="Waralaba" {{ old('kepemilikan') == 'Waralaba' ? 'selected' : '' }}>Waralaba
                            </option>
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
                    <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" rows="2"
                        placeholder="Jl. Veteran No.12, Kotabaru, Kalimantan Selatan" required>{{ old('alamat_lengkap') }}</textarea>
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
                            placeholder="081234567890" value="{{ old('telepon') }}" required>
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
                            placeholder="contoh@email.com" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-file-text"></i>
                            No. NIB <span class="required">*</span>
                        </label>
                        <input type="text" name="no_nib"
                            class="form-control @error('no_nib') is-invalid @enderror" placeholder="9120001380361"
                            value="{{ old('no_nib') }}" maxlength="13" required>
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
                    @foreach (['PIRT', 'BPOM', 'Halal', 'NIB', 'Lainnya'] as $item)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="sertifikat_lain[]" value="{{ $item }}"
                                id="sertifikat_{{ $item }}" class="form-check-input sertifikat-check"
                                {{ in_array($item, old('sertifikat_lain', [])) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="sertifikat_{{ $item }}">{{ $item }}</label>
                        </div>
                    @endforeach
                    <input type="text" id="sertifikat_text" name="sertifikat_text" class="form-control mt-2"
                        placeholder="Tulis sertifikat lainnya..." style="display:none; max-width:400px;"
                        value="{{ old('sertifikat_text') }}">
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-people"></i>
                            Jumlah Pegawai <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_pegawai"
                            class="form-control @error('jumlah_pegawai') is-invalid @enderror" min="0"
                            placeholder="25" value="{{ old('jumlah_pegawai') }}" required>
                        @error('jumlah_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-grid"></i>
                            Jumlah Kursi <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_kursi"
                            class="form-control @error('jumlah_kursi') is-invalid @enderror" min="0"
                            placeholder="25" value="{{ old('jumlah_kursi') }}" required>
                        @error('jumlah_kursi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            <i class="bi bi-shop-window"></i>
                            Jumlah Gerai <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_gerai"
                            class="form-control @error('jumlah_gerai') is-invalid @enderror" min="0"
                            placeholder="1" value="{{ old('jumlah_gerai') }}" required>
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
                            min="0" placeholder="50" value="{{ old('jumlah_pelanggan_per_hari') }}" required>
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
                        <li>Isi jam buka dan jam tutup</li>
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
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $i => $day)
                                <tr>
                                    <td><input type="text" name="hari[{{ $i }}]"
                                            class="form-control text-center" value="{{ $day }}" readonly>
                                    </td>
                                    <td><input type="time" name="jam_buka[{{ $i }}]"
                                            class="form-control" value="{{ old('jam_buka.' . $i, '08:00') }}"></td>
                                    <td><input type="time" name="jam_tutup[{{ $i }}]"
                                            class="form-control" value="{{ old('jam_tutup.' . $i, '21:00') }}"></td>
                                    <td><input type="time" name="jam_sibuk_mulai[{{ $i }}]"
                                            class="form-control" value="{{ old('jam_sibuk_mulai.' . $i) }}"></td>
                                    <td><input type="time" name="jam_sibuk_selesai[{{ $i }}]"
                                            class="form-control" value="{{ old('jam_sibuk_selesai.' . $i) }}"></td>
                                    <td><input type="checkbox" name="libur[{{ $i }}]"
                                            class="libur-checkbox"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person-badge"></i>
                            Profil Pelanggan <span class="required">*</span>
                        </label><br>
                        @foreach (['Lokal', 'Wisatawan', 'Pelajar/Mahasiswa', 'Pekerja'] as $p)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="profil_pelanggan[]" value="{{ $p }}"
                                    class="form-check-input" id="profil_{{ $p }}"
                                    {{ in_array($p, old('profil_pelanggan', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="profil_{{ $p }}">{{ $p }}</label>
                            </div>
                        @endforeach
                        @error('profil_pelanggan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-credit-card"></i>
                            Metode Pembayaran <span class="required">*</span>
                        </label><br>
                        @foreach (['Tunai', 'Qris / Transfer'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="metode_pembayaran[]" value="{{ $m }}"
                                    class="form-check-input" id="metode_{{ $m }}"
                                    {{ in_array($m, old('metode_pembayaran', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="metode_{{ $m }}">{{ $m }}</label>
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
                        <input class="form-check-input" type="radio" name="pajak_retribusi" value="Ya"
                            id="pajak_ya" {{ old('pajak_retribusi') == 'Ya' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="pajak_ya">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pajak_retribusi" value="Tidak"
                            id="pajak_tidak" {{ old('pajak_retribusi') == 'Tidak' ? 'checked' : '' }}>
                        <label class="form-check-label" for="pajak_tidak">Tidak</label>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 2. JENIS KULINER -->
                <div class="section-title">
                    <i class="bi bi-card-list"></i>
                    Jenis Kuliner
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-tags"></i>
                        Kategori <span class="required">*</span>
                    </label><br>
                    @foreach (['Tradisional/Domestik', 'Modern/Luar Negeri', 'Street Food', 'Lainnya'] as $kategori)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="kategori[]" value="{{ $kategori }}"
                                class="form-check-input kategori-check" id="kategori_{{ $kategori }}"
                                {{ in_array($kategori, old('kategori', [])) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="kategori_{{ $kategori }}">{{ $kategori }}</label>
                        </div>
                    @endforeach
                    <input type="text" id="kategori_lain" name="kategori_lain" class="form-control mt-2"
                        placeholder="Tulis kategori lain..." style="display:none; max-width:400px;"
                        value="{{ old('kategori_lain') }}">
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
                        <input type="text" name="menu_unggulan"
                            class="form-control @error('menu_unggulan') is-invalid @enderror"
                            placeholder="Soto Banjar Spesial" value="{{ old('menu_unggulan') }}" required>
                        @error('menu_unggulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-basket"></i>
                            Bahan Baku Utama <span class="required">*</span>
                        </label>
                        <input type="text" name="bahan_baku_utama"
                            class="form-control @error('bahan_baku_utama') is-invalid @enderror"
                            placeholder="Daging ayam, rempah lokal" value="{{ old('bahan_baku_utama') }}" required>
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
                        <select name="sumber_bahan_baku"
                            class="form-control @error('sumber_bahan_baku') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            <option value="Lokal" {{ old('sumber_bahan_baku') == 'Lokal' ? 'selected' : '' }}>Lokal
                            </option>
                            <option value="Domestik / Luar Kota"
                                {{ old('sumber_bahan_baku') == 'Domestik / Luar Kota' ? 'selected' : '' }}>Domestik /
                                Luar Kota</option>
                            <option value="Import / Luar Negeri"
                                {{ old('sumber_bahan_baku') == 'Import / Luar Negeri' ? 'selected' : '' }}>Import /
                                Luar Negeri</option>
                            <option value="Campuran" {{ old('sumber_bahan_baku') == 'Campuran' ? 'selected' : '' }}>
                                Campuran</option>
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
                        @foreach (['Tetap', 'Musiman'] as $m)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="menu_bersifat[]" value="{{ $m }}"
                                    class="form-check-input" id="menu_{{ $m }}"
                                    {{ in_array($m, old('menu_bersifat', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="menu_{{ $m }}">{{ $m }}</label>
                            </div>
                        @endforeach
                        @error('menu_bersifat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 3. TEMPAT & FASILITAS -->
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
                        <select name="bentuk_fisik" class="form-control @error('bentuk_fisik') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Bentuk Fisik --</option>
                            <option value="Restoran" {{ old('bentuk_fisik') == 'Restoran' ? 'selected' : '' }}>
                                Restoran</option>
                            <option value="Warung" {{ old('bentuk_fisik') == 'Warung' ? 'selected' : '' }}>Warung
                            </option>
                            <option value="Kafe" {{ old('bentuk_fisik') == 'Kafe' ? 'selected' : '' }}>Kafe</option>
                            <option value="Food Court" {{ old('bentuk_fisik') == 'Food Court' ? 'selected' : '' }}>
                                Food Court</option>
                            <option value="Jasa Boga (Katering)"
                                {{ old('bentuk_fisik') == 'Jasa Boga (Katering)' ? 'selected' : '' }}>Jasa Boga
                                (Katering)</option>
                            <option value="Penyedia Makanan oleh Pedagang Keliling"
                                {{ old('bentuk_fisik') == 'Penyedia Makanan oleh Pedagang Keliling' ? 'selected' : '' }}>
                                Penyedia Makanan oleh Pedagang Keliling</option>
                            <option value="Penyedia Makanan oleh Pedagang Tidak Keliling"
                                {{ old('bentuk_fisik') == 'Penyedia Makanan oleh Pedagang Tidak Keliling' ? 'selected' : '' }}>
                                Penyedia Makanan oleh Pedagang Tidak Keliling</option>
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
                        <select name="status_bangunan"
                            class="form-control @error('status_bangunan') is-invalid @enderror" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Milik Sendiri"
                                {{ old('status_bangunan') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri
                            </option>
                            <option value="Sewa" {{ old('status_bangunan') == 'Sewa' ? 'selected' : '' }}>Sewa
                            </option>
                            <option value="Pinjam Pakai"
                                {{ old('status_bangunan') == 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
                            <option value="Lainnya..." {{ old('status_bangunan') == 'Lainnya...' ? 'selected' : '' }}>
                                Lainnya...</option>
                        </select>
                        <input type="text" id="status_bangunan_lain" name="status_bangunan_lain"
                            class="form-control mt-2" placeholder="Tulis status lain..." style="display:none;"
                            value="{{ old('status_bangunan_lain') }}">
                        @error('status_bangunan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-wifi"></i>
                        Fasilitas Pendukung <span class="required">*</span>
                    </label><br>
                    @foreach (['Toilet', 'Wastafel', 'Parkir', 'Mushola', 'WiFi', 'Tempat Sampah'] as $f)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="fasilitas_pendukung[]" value="{{ $f }}"
                                class="form-check-input" id="fasilitas_{{ $f }}"
                                {{ in_array($f, old('fasilitas_pendukung', [])) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="fasilitas_{{ $f }}">{{ $f }}</label>
                        </div>
                    @endforeach
                    @error('fasilitas_pendukung')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="section-divider"></div>

                <!-- 4. PRAKTIK K3 & SANITASI -->
                <div class="section-title">
                    <i class="bi bi-shield-check"></i>
                    Praktik K3 & Sanitasi
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-clipboard-check"></i>
                            Pelatihan K3 <span class="required">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pelatihan_k3" value="Ya"
                                id="k3_ya" {{ old('pelatihan_k3') == 'Ya' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="k3_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pelatihan_k3" value="Tidak"
                                id="k3_tidak" {{ old('pelatihan_k3') == 'Tidak' ? 'checked' : '' }}>
                            <label class="form-check-label" for="k3_tidak">Tidak</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-people"></i>
                            Jumlah Penjamah Makanan <span class="required">*</span>
                        </label>
                        <input type="number" name="jumlah_penjamah_makanan"
                            class="form-control @error('jumlah_penjamah_makanan') is-invalid @enderror"
                            placeholder="3" value="{{ old('jumlah_penjamah_makanan') }}" required>
                        @error('jumlah_penjamah_makanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-shield-fill-check"></i>
                        APD Penjamah Makanan <span class="required">*</span>
                    </label><br>
                    @foreach (['Masker', 'Hairnet', 'Celemek', 'Sarung Tangan'] as $apd)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="apd_penjamah_makanan[]" value="{{ $apd }}"
                                class="form-check-input" id="apd_{{ $apd }}"
                                {{ in_array($apd, old('apd_penjamah_makanan', [])) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="apd_{{ $apd }}">{{ $apd }}</label>
                        </div>
                    @endforeach
                    @error('apd_penjamah_makanan')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-droplet"></i>
                            Sanitasi Alat Dapur <span class="required">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prosedur_sanitasi_alat"
                                value="Tidak Melakukan" id="sanitasi_tidak"
                                {{ old('prosedur_sanitasi_alat') == 'Tidak Melakukan' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="sanitasi_tidak">Tidak Melakukan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prosedur_sanitasi_alat"
                                value="Melakukan" id="sanitasi_ya"
                                {{ old('prosedur_sanitasi_alat') == 'Melakukan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="sanitasi_ya">Melakukan</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-clock-history"></i>
                            Frekuensi Sanitasi Alat <span class="required">*</span>
                        </label>
                        <input type="text" name="frekuensi_sanitasi_alat"
                            class="form-control @error('frekuensi_sanitasi_alat') is-invalid @enderror"
                            placeholder="2 kali sehari atau -" value="{{ old('frekuensi_sanitasi_alat') }}"
                            required>
                        @error('frekuensi_sanitasi_alat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-droplet"></i>
                            Sanitasi Bahan Makanan <span class="required">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prosedur_sanitasi_bahan"
                                value="Tidak Melakukan" id="sanitasi_bahan_tidak"
                                {{ old('prosedur_sanitasi_bahan') == 'Tidak Melakukan' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="sanitasi_bahan_tidak">Tidak Melakukan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prosedur_sanitasi_bahan"
                                value="Melakukan" id="sanitasi_bahan_ya"
                                {{ old('prosedur_sanitasi_bahan') == 'Melakukan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="sanitasi_bahan_ya">Melakukan</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-clock-history"></i>
                            Frekuensi Sanitasi Bahan <span class="required">*</span>
                        </label>
                        <input type="text" name="frekuensi_sanitasi_bahan"
                            class="form-control @error('frekuensi_sanitasi_bahan') is-invalid @enderror"
                            placeholder="2 kali sehari atau -" value="{{ old('frekuensi_sanitasi_bahan') }}"
                            required>
                        @error('frekuensi_sanitasi_bahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-thermometer-snow"></i>
                            Penyimpanan Bahan Mentah <span class="required">*</span>
                        </label>
                        <select name="penyimpanan_mentah"
                            class="form-control @error('penyimpanan_mentah') is-invalid @enderror" required>
                            <option value="">-- Pilih Penyimpanan --</option>
                            <option value="Dengan Pendingin, Terpisah"
                                {{ old('penyimpanan_mentah') == 'Dengan Pendingin, Terpisah' ? 'selected' : '' }}>
                                Dengan Pendingin, Terpisah</option>
                            <option value="Dengan Pendingin, Tidak Terpisah"
                                {{ old('penyimpanan_mentah') == 'Dengan Pendingin, Tidak Terpisah' ? 'selected' : '' }}>
                                Dengan Pendingin, Tidak Terpisah</option>
                            <option value="Tanpa Pendingin, Terpisah"
                                {{ old('penyimpanan_mentah') == 'Tanpa Pendingin, Terpisah' ? 'selected' : '' }}>Tanpa
                                Pendingin, Terpisah</option>
                            <option value="Tanpa Pendingin, Tidak Terpisah"
                                {{ old('penyimpanan_mentah') == 'Tanpa Pendingin, Tidak Terpisah' ? 'selected' : '' }}>
                                Tanpa Pendingin, Tidak Terpisah</option>
                        </select>
                        @error('penyimpanan_mentah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-thermometer-snow"></i>
                            Penyimpanan Bahan Matang <span class="required">*</span>
                        </label>
                        <select name="penyimpanan_matang"
                            class="form-control @error('penyimpanan_matang') is-invalid @enderror" required>
                            <option value="">-- Pilih Penyimpanan --</option>
                            <option value="Dengan Pendingin, Terpisah"
                                {{ old('penyimpanan_matang') == 'Dengan Pendingin, Terpisah' ? 'selected' : '' }}>
                                Dengan Pendingin, Terpisah</option>
                            <option value="Dengan Pendingin, Tidak Terpisah"
                                {{ old('penyimpanan_matang') == 'Dengan Pendingin, Tidak Terpisah' ? 'selected' : '' }}>
                                Dengan Pendingin, Tidak Terpisah</option>
                            <option value="Tanpa Pendingin, Terpisah"
                                {{ old('penyimpanan_matang') == 'Tanpa Pendingin, Terpisah' ? 'selected' : '' }}>Tanpa
                                Pendingin, Terpisah</option>
                            <option value="Tanpa Pendingin, Tidak Terpisah"
                                {{ old('penyimpanan_matang') == 'Tanpa Pendingin, Tidak Terpisah' ? 'selected' : '' }}>
                                Tanpa Pendingin, Tidak Terpisah</option>
                        </select>
                        @error('penyimpanan_matang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-arrow-repeat"></i>
                            Prinsip FIFO / FEFO <span class="required">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fifo_fefo" value="Ya"
                                id="fifo_ya" {{ old('fifo_fefo') == 'Ya' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="fifo_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="fifo_fefo" value="Tidak"
                                id="fifo_tidak" {{ old('fifo_fefo') == 'Tidak' ? 'checked' : '' }}>
                            <label class="form-check-label" for="fifo_tidak">Tidak</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-trash"></i>
                            Limbah Dapur <span class="required">*</span>
                        </label>
                        <select name="limbah_dapur" class="form-control @error('limbah_dapur') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Limbah --</option>
                            <option value="Dipisah" {{ old('limbah_dapur') == 'Dipisah' ? 'selected' : '' }}>Dipisah
                            </option>
                            <option value="Tidak dipisah"
                                {{ old('limbah_dapur') == 'Tidak dipisah' ? 'selected' : '' }}>Tidak dipisah</option>
                        </select>
                        @error('limbah_dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-wind"></i>
                            Ventilasi Dapur <span class="required">*</span>
                        </label>
                        <select name="ventilasi_dapur"
                            class="form-control @error('ventilasi_dapur') is-invalid @enderror" required>
                            <option value="">-- Pilih Ventilasi --</option>
                            <option value="Alami" {{ old('ventilasi_dapur') == 'Alami' ? 'selected' : '' }}>Alami
                            </option>
                            <option value="Buatan" {{ old('ventilasi_dapur') == 'Buatan' ? 'selected' : '' }}>Buatan
                            </option>
                        </select>
                        @error('ventilasi_dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-house"></i>
                            Dapur <span class="required">*</span>
                        </label>
                        <select name="dapur" class="form-control @error('dapur') is-invalid @enderror" required>
                            <option value="">-- Pilih Dapur --</option>
                            <option value="Ada, terpisah" {{ old('dapur') == 'Ada, terpisah' ? 'selected' : '' }}>
                                Ada, terpisah</option>
                            <option value="Ada, tidak terpisah"
                                {{ old('dapur') == 'Ada, tidak terpisah' ? 'selected' : '' }}>Ada, tidak terpisah
                            </option>
                            <option value="Tidak ada" {{ old('dapur') == 'Tidak ada' ? 'selected' : '' }}>Tidak ada
                            </option>
                        </select>
                        @error('dapur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-water"></i>
                            Sumber Air Cuci <span class="required">*</span>
                        </label>
                        <select name="sumber_air_cuci"
                            class="form-control @error('sumber_air_cuci') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            <option value="PDAM" {{ old('sumber_air_cuci') == 'PDAM' ? 'selected' : '' }}>PDAM
                            </option>
                            <option value="Sumur" {{ old('sumber_air_cuci') == 'Sumur' ? 'selected' : '' }}>Sumur
                            </option>
                            <option value="Air Isi Ulang"
                                {{ old('sumber_air_cuci') == 'Air Isi Ulang' ? 'selected' : '' }}>Air Isi Ulang
                            </option>
                        </select>
                        @error('sumber_air_cuci')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-water"></i>
                            Sumber Air Masak <span class="required">*</span>
                        </label>
                        <select name="sumber_air_masak"
                            class="form-control @error('sumber_air_masak') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            <option value="PDAM" {{ old('sumber_air_masak') == 'PDAM' ? 'selected' : '' }}>PDAM
                            </option>
                            <option value="Sumur" {{ old('sumber_air_masak') == 'Sumur' ? 'selected' : '' }}>Sumur
                            </option>
                            <option value="Air Isi Ulang"
                                {{ old('sumber_air_masak') == 'Air Isi Ulang' ? 'selected' : '' }}>Air Isi Ulang
                            </option>
                        </select>
                        @error('sumber_air_masak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">
                            <i class="bi bi-cup-straw"></i>
                            Sumber Air Minum <span class="required">*</span>
                        </label>
                        <select name="sumber_air_minum"
                            class="form-control @error('sumber_air_minum') is-invalid @enderror" required>
                            <option value="">-- Pilih Sumber --</option>
                            <option value="PDAM" {{ old('sumber_air_minum') == 'PDAM' ? 'selected' : '' }}>PDAM
                            </option>
                            <option value="Sumur" {{ old('sumber_air_minum') == 'Sumur' ? 'selected' : '' }}>Sumur
                            </option>
                            <option value="Air Isi Ulang"
                                {{ old('sumber_air_minum') == 'Air Isi Ulang' ? 'selected' : '' }}>Air Isi Ulang
                            </option>
                        </select>
                        @error('sumber_air_minum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 5. KOORDINAT -->
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
                        <input type="text" name="longitude"
                            class="form-control @error('longitude') is-invalid @enderror" placeholder="116.8225"
                            value="{{ old('longitude') }}" required>
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-arrow-up-down"></i>
                            Latitude <span class="required">*</span>
                        </label>
                        <input type="text" name="latitude"
                            class="form-control @error('latitude') is-invalid @enderror" placeholder="-3.3211"
                            value="{{ old('latitude') }}" required>
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- 6. FOTO -->
                <div class="section-title">
                    <i class="bi bi-camera"></i>
                    Foto Kuliner
                </div>

                <div class="mb-4">
                    <div class="file-upload-wrapper">
                        <input type="file" name="foto[]" multiple accept="image/*" id="fileInput">
                        <div class="file-upload-icon">
                            <i class="bi bi-cloud-upload"></i>
                        </div>
                        <div class="file-upload-text">
                            Klik untuk upload foto atau drag & drop
                        </div>
                        <div class="file-upload-hint">
                            Format: JPG, PNG, JPEG | Maksimal: 2MB per file | Bisa multiple
                        </div>
                    </div>
                    @error('foto')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="selected-files" id="selectedFiles"></div>
                </div>

                <!-- Action Buttons -->
                <div class="button-group">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Data
                    </button>
                    <a href="{{ route('kuliner.index') }}" class="btn-cancel">
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
            // Sertifikat "Lainnya"
            const sertifikatChecks = document.querySelectorAll(".sertifikat-check");
            const sertifikatText = document.getElementById("sertifikat_text");

            // Check on page load (untuk old value saat error)
            if (sertifikatText) {
                const isOtherChecked = Array.from(sertifikatChecks).some(chk => chk.value === "Lainnya" && chk
                    .checked);
                sertifikatText.style.display = isOtherChecked ? "block" : "none";
            }

            sertifikatChecks.forEach(c => {
                c.addEventListener("change", () => {
                    const isOtherChecked = Array.from(sertifikatChecks).some(chk => chk.value ===
                        "Lainnya" && chk.checked);
                    sertifikatText.style.display = isOtherChecked ? "block" : "none";
                    if (!isOtherChecked) sertifikatText.value = "";
                });
            });

            // Kategori "Lainnya"
            const kategoriChecks = document.querySelectorAll(".kategori-check");
            const kategoriLain = document.getElementById("kategori_lain");

            // Check on page load (untuk old value saat error)
            if (kategoriLain) {
                const isOtherChecked = Array.from(kategoriChecks).some(chk => chk.value === "Lainnya" && chk
                    .checked);
                kategoriLain.style.display = isOtherChecked ? "block" : "none";
            }

            kategoriChecks.forEach(c => {
                c.addEventListener("change", () => {
                    const isOtherChecked = Array.from(kategoriChecks).some(chk => chk.value ===
                        "Lainnya" && chk.checked);
                    kategoriLain.style.display = isOtherChecked ? "block" : "none";
                    if (!isOtherChecked) kategoriLain.value = "";
                });
            });

            // Status Bangunan "Lainnya"
            const statusSelect = document.querySelector('select[name="status_bangunan"]');
            const statusLain = document.getElementById("status_bangunan_lain");

            // Check on page load (untuk old value saat error)
            if (statusSelect && statusLain) {
                if (statusSelect.value === "Lainnya...") {
                    statusLain.style.display = "block";
                }
            }

            if (statusSelect) {
                statusSelect.addEventListener("change", () => {
                    if (statusSelect.value === "Lainnya...") {
                        statusLain.style.display = "block";
                    } else {
                        statusLain.style.display = "none";
                        statusLain.value = "";
                    }
                });
            }

            // Jam Operasional - Libur Checkbox
            const rows = document.querySelectorAll("table tbody tr");

            rows.forEach(row => {
                const checkbox = row.querySelector('.libur-checkbox');
                const timeInputs = row.querySelectorAll('input[type="time"]');
                if (!checkbox) return;

                const defaultValues = Array.from(timeInputs).map(input => input.value);

                // Check on page load (untuk old value saat error)
                if (checkbox.checked) {
                    timeInputs.forEach(input => {
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
                            // Restore default values hanya jika kosong
                            if (!input.value) {
                                input.value = defaultValues[idx] || "";
                            }
                        });
                        row.style.opacity = '1';
                    }
                });
            });

            // File Upload Handler
            const fileInput = document.getElementById('fileInput');
            const selectedFilesContainer = document.getElementById('selectedFiles');
            const uploadWrapper = document.querySelector('.file-upload-wrapper');
            let selectedFiles = [];

            fileInput.addEventListener('change', function(e) {
                handleFiles(e.target.files);
            });

            uploadWrapper.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadWrapper.style.borderColor = '#1b5e20';
                uploadWrapper.style.background = 'linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%)';
            });

            uploadWrapper.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadWrapper.style.borderColor = '#2e7d32';
                uploadWrapper.style.background = 'linear-gradient(135deg, #f1f8f4 0%, #e8f5e9 100%)';
            });

            uploadWrapper.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadWrapper.style.borderColor = '#2e7d32';
                uploadWrapper.style.background = 'linear-gradient(135deg, #f1f8f4 0%, #e8f5e9 100%)';
                handleFiles(e.dataTransfer.files);
            });

            function handleFiles(files) {
                const filesArray = Array.from(files);
                let hasError = false;

                filesArray.forEach(file => {
                    if (!file.type.match('image.*')) {
                        alert('❌ ' + file.name + ' bukan file gambar!');
                        hasError = true;
                        return;
                    }

                    if (file.size > 2 * 1024 * 1024) {
                        alert('❌ ' + file.name + ' terlalu besar! Maksimal 2MB per file.');
                        hasError = true;
                        return;
                    }

                    selectedFiles.push(file);
                });

                if (!hasError) {
                    displayFiles();
                    updateFileInput();
                }
            }

            function displayFiles() {
                selectedFilesContainer.innerHTML = '';
                selectedFilesContainer.style.display = selectedFiles.length > 0 ? 'grid' : 'none';
                selectedFilesContainer.style.gridTemplateColumns = 'repeat(auto-fill, minmax(150px, 1fr))';
                selectedFilesContainer.style.gap = '15px';
                selectedFilesContainer.style.marginTop = '1.5rem';

                selectedFiles.forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.style.cssText = `
                        position: relative;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                        background: white;
                        transition: all 0.3s ease;
                    `;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        fileItem.innerHTML = `
                            <img src="${e.target.result}" alt="${file.name}" style="width:100%; height:150px; object-fit:cover; display:block;">
                            <div style="position:absolute; bottom:40px; left:8px; background:rgba(46,125,50,0.9); color:white; padding:4px 8px; border-radius:8px; font-size:11px; font-weight:600;">
                                ${formatFileSize(file.size)}
                            </div>
                            <button type="button" onclick="removeFile(${index})" style="position:absolute; top:8px; right:8px; background:rgba(211,47,47,0.95); color:white; border:none; border-radius:50%; width:28px; height:28px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:16px; transition:all 0.3s ease; z-index:3;">
                                <i class="bi bi-x"></i>
                            </button>
                            <div style="padding:10px; font-size:12px; color:#333; text-align:center; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; background:#f8f9fa;" title="${file.name}">
                                ${file.name}
                            </div>
                        `;
                    };
                    reader.readAsDataURL(file);
                    selectedFilesContainer.appendChild(fileItem);
                });
            }

            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });
                fileInput.files = dataTransfer.files;
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
            }

            window.removeFile = function(index) {
                selectedFiles.splice(index, 1);
                displayFiles();
                updateFileInput();
            };
        });
    </script>
</body>

</html>
