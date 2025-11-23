<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Tempat Kuliner</title>
    <style>
        body {
            font-family: 'Inknut Antiqua', serif;
            background: url("{{ asset('images/bg-view.png') }}") no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007b5e;
            border-bottom: 3px solid #007b5e;
            padding-bottom: 8px;
        }

        h3 {
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 4px;
            margin-top: 25px;
        }

        .label {
            font-weight: bold;
            color: #444;
        }

        .section p {
            margin: 4px 0;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #007b5e;
            color: #fff;
        }

        .photos img {
            width: 160px;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            margin: 6px;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007b5e;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
            font-weight: bold;
        }

        .back-btn:hover {
            background-color: #005f48;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{ $kuliner->nama_sentra }}</h1>

        {{-- Identitas Usaha --}}
        <h3>Identitas Usaha</h3>
        <div class="section">
            <p><span class="label">Nama Usaha:</span> {{ $kuliner->nama_sentra ?? '-' }}</p>
            <p><span class="label">Tahun Berdiri:</span> {{ $kuliner->tahun_berdiri ?? '-' }}</p>
            <p><span class="label">Nama Pemilik:</span> {{ $kuliner->nama_pemilik ?? '-' }}</p>
            <p><span class="label">Status Kepemilikan:</span> {{ $kuliner->kepemilikan ?? '-' }}</p>
            <p><span class="label">Alamat Lengpat:</span> {{ $kuliner->alamat_lengkap ?? '-' }}</p>
            <p><span class="label">Nomor Telepon:</span> {{ $kuliner->telepon ?? '-' }}</p>
            <p><span class="label">Email:</span> {{ $kuliner->email ?? '-' }}</p>
            <p><span class="label">Jumlah Gerai:</span> {{ $kuliner->jumlah_gerai ?? '-' }}</p>


            @php
                $profil_pelanggan = json_decode($kuliner->profil_pelanggan, true);
                $profil_pelanggan = is_array($profil_pelanggan) ? $profil_pelanggan : [];
            @endphp
            <p><span class="label">Profil Pelanggan:</span> {{ implode(', ', $profil_pelanggan) ?: '-' }}</p>

            @php
                $metode_pembayaran = json_decode($kuliner->metode_pembayaran, true);
                $metode_pembayaran = is_array($metode_pembayaran) ? $metode_pembayaran : [];
            @endphp
            <p><span class="label">Metode Pembayaran:</span> {{ implode(', ', $metode_pembayaran) ?: '-' }}</p>
        </div>

        {{-- Jam Operasional --}}
        <h3>Jam Operasional</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Jam Sibuk Mulai</th>
                    <th>Jam Sibuk Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kuliner->jamOperasional as $jam)
                    <tr>
                        <td>{{ $jam->hari }}</td>
                        <td>{{ $jam->jam_buka ?? '-' }}</td>
                        <td>{{ $jam->jam_tutup ?? '-' }}</td>
                        <td>{{ $jam->jam_sibuk_mulai ?? '-' }}</td>
                        <td>{{ $jam->jam_sibuk_selesai ?? '-' }}</td>
                        <td>
                            @if (!$jam->jam_buka || $jam->jam_buka == '-' )
                                Libur
                            @else
                                Buka
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Jenis Kuliner --}}
        <h3>Jenis Kuliner</h3>
        <div class="section">
            @php
                $kategori = json_decode($kuliner->kategori, true);
                $kategori = is_array($kategori) ? $kategori : [];
            @endphp
            <p><span class="label">Kategori Utama:</span> {{ implode(', ', $kategori) ?: '-' }}</p>

            <p><span class="label">Menu Unggulan:</span> {{ $kuliner->menu_unggulan ?? '-' }}</p>
            <p><span class="label">Bahan Baku Utama:</span> {{ $kuliner->bahan_baku_utama ?? '-' }}</p>
            <p><span class="label">Sumber Bahan Baku:</span> {{ $kuliner->sumber_bahan_baku ?? '-' }}</p>

            @php
                $menu_bersifat = json_decode($kuliner->menu_bersifat, true);
                $menu_bersifat = is_array($menu_bersifat) ? $menu_bersifat : [];
            @endphp
            <p><span class="label">Menu Bersifat:</span> {{ implode(', ', $menu_bersifat) ?: '-' }}</p>
        </div>

        {{-- Tempat & Fasilitas --}}
        <h3>Tempat & Fasilitas</h3>
        <div class="section">
            <p><span class="label">Bentuk Fisik:</span> {{ $kuliner->bentuk_fisik ?? '-' }}</p>
            @php
                $fasilitas = is_array($kuliner->fasilitas_pendukung)
                    ? $kuliner->fasilitas_pendukung
                    : (json_decode($kuliner->fasilitas_pendukung, true) ?: []);
            @endphp

            <p><span class="label">Fasilitas Pendukung:</span>
                {{ implode(', ', $fasilitas) ?: '-' }}
            </p>
        </div>

        {{-- Foto --}}
        <h3>Foto</h3>
        <div class="photos">
            @foreach ($kuliner->foto as $foto)
                <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Foto {{ $kuliner->nama_usaha }}">
            @endforeach
        </div>

        <div style="text-align: center;">
            <a href="{{ route('home') }}" class="back-btn">Kembali Halaman Utama</a>
        </div>

    </div>
</body>

</html>
