<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inknut Antiqua', serif;
            background: url("{{ asset('images/bg-view.png') }}") no-repeat center center fixed;
            background-size: cover;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            margin: 40px auto;
        }

        .btn-submit {
            background-color: #1e3932;
            color: #fff;
            font-weight: bold;
            padding: 10px 30px;
            border-radius: 8px;
        }

        .btn-submit:hover {
            background-color: #2d5447;
        }
    </style>
</head>

<body>
    <div class="container">
        <h5 class="mt-4 text-center fw-bold">Kotabaru Tourism Data Center</h5>
        <h2 class="text-center fw-bold text-success mb-4">Edit Admin</h2>

        <div class="form-container shadow">
            <form method="POST" action="{{ route('superadmin.admin.update', $admin->id_user) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="Super Admin" {{ $admin->role === 'Super Admin' ? 'selected' : '' }}>Super Admin
                        </option>
                        <option value="Admin" {{ $admin->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-submit">Update</button>
                    <a href="{{ route('superadmin.admin.index') }}" class="btn btn-secondary ms-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
