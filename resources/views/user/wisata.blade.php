<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Tempat Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.92);
            border-radius: 15px;
            padding: 25px 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #1e3932;
            font-weight: bold;
            border-bottom: 3px solid #1e3932;
            padding-bottom: 8px;
        }

        h3 {
            color: #2c2c2c;
            border-bottom: 2px solid #ddd;
            padding-bottom: 4px;
            margin-top: 25px;
        }

        .label {
            font-weight: bold;
            color: #444;
        }

        .photos img {
            width: 160px;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            margin: 6px;
        }

        .btn-back {
            background: #1e3932;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
        }

        .btn-back:hover {
            background: #2d5447;
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
            background-color: #1e3932;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>{{ $wisata->nama_wisata }}</h1>

        {{-- Identitas Wisata --}}
        <h3>Informasi Umum</h3>
        <div class="section">
            <p><span class="label">Nama Tempat Wisata:</span> {{ $wisata->nama_wisata ?? '-' }}</p>
            <p><span class="label">Kategori Wisata:</span> {{ $wisata->kategori->nama_kategori ?? '-' }}</p>
            <p><span class="label">Deskripsi:</span> {{ $wisata->deskripsi ?? '-' }}</p>
            <p><span class="label">Sejarah:</span> {{ $wisata->sejarah ?? '-' }}</p>
            <p><span class="label">Narasi:</span> {{ $wisata->narasi ?? '-' }}</p>
        </div>

        {{-- Jam Operasional --}}
        <h3>Jam Operasional</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wisata->jamOperasional as $jam)
                    <tr>
                        <td>{{ $jam->hari }}</td>
                        <td>{{ $jam->jam_buka ?? '-' }}</td>
                        <td>{{ $jam->jam_tutup ?? '-' }}</td>
                        <td>
                            @if (($jam->jam_buka == '00:00' && $jam->jam_tutup == '00:00') || !$jam->jam_buka)
                                Libur
                            @else
                                Buka
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada data jam operasional</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Foto --}}
        <h3>Foto Wisata</h3>
        <div class="photos">
            @forelse ($wisata->foto as $foto)
                <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Foto {{ $wisata->nama_wisata }}">
            @empty
                <p>Belum ada foto untuk tempat wisata ini.</p>
            @endforelse
        </div>

        {{-- Tombol Kembali --}}
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-back">← Kembali Halaman Utama</a>
        </div>
    </div>

</body>

</html>
