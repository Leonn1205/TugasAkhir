<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Tempat Kuliner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inknut Antiqua', serif;
            background: url("{{ asset('images/bg-view.png') }}") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85rem;
            border-radius: 8px;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-warning {
            background-color: #f0ad4e;
            border: none;
        }

        .btn-danger {
            background-color: #d9534f;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>

<body class="bg-light p-4">
    <div class="container">
        <h2 class="mb-4">Daftar Tempat Kuliner</h2>

        <div class="mb-3 d-flex justify-content-between">
            @php $role = auth()->user()->role; @endphp
            @if ($role === 'Super Admin')
                <a href="{{ route('dashboard.superadmin') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
            @elseif ($role === 'Admin')
                <a href="{{ route('dashboard.admin') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
            @endif
            <a href="{{ route('kuliner.create') }}" class="btn btn-success">+ Tambah Data</a>
        </div>
        <a href="{{ route('export.excel', ['tipe' => 'kuliner']) }}" class="btn btn-success">Export Excel</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Sentra</th>
                    <th>Lokasi</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kuliner as $index => $k)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k->nama_sentra }}</td>
                        <td>{{ $k->alamat_lengkap }}</td>
                        <td>{{ $k->latitude }}</td>
                        <td>{{ $k->longitude }}</td>
                        <td class="text-center" style="white-space: nowrap;">
                            <div class="d-flex justify-content-center gap-2 flex-nowrap">
                                <a href="{{ route('kuliner.show', $k->id_kuliner) }}"
                                    class="btn btn-info btn-sm shadow-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="{{ route('kuliner.edit', $k->id_kuliner) }}"
                                    class="btn btn-warning btn-sm shadow-sm text-white">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('kuliner.destroy', $k->id_kuliner) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
