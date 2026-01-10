<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Admin - Kotabaru Tourism</title>
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
            display: flex;
            align-items: center;
            padding: 20px 0;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(27, 94, 32, 0.1);
            z-index: -1;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .site-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .site-title i {
            font-size: 28px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(27, 94, 32, 0.15);
            backdrop-filter: blur(10px);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #e8f5e9;
        }

        .form-title {
            font-size: 26px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .form-title i {
            font-size: 28px;
        }

        .form-description {
            color: #666;
            font-size: 14px;
        }

        .form-label {
            font-weight: 600;
            color: #1b5e20;
            margin-bottom: 0.5rem;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-label i {
            font-size: 16px;
            color: #2e7d32;
        }

        .form-label .required {
            color: #d32f2f;
            font-size: 12px;
        }

        .form-label .optional {
            color: #999;
            font-size: 12px;
            font-weight: 400;
        }

        .form-control,
        .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.15);
            background: #f8fdf9;
        }

        .form-control::placeholder {
            color: #aaa;
            font-size: 13px;
        }

        .mb-3 {
            margin-bottom: 1.5rem !important;
        }

        .password-input-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            padding: 5px;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #2e7d32;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid #e8f5e9;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-submit {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(27, 94, 32, 0.3);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27, 94, 32, 0.4);
            color: white;
        }

        .btn-cancel {
            background: #f5f5f5;
            color: #555;
            border: 2px solid #e0e0e0;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
            color: #333;
            transform: translateY(-2px);
        }

        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-size: 13px;
            color: #1565c0;
            display: flex;
            align-items: start;
            gap: 10px;
        }

        .info-box i {
            font-size: 16px;
            margin-top: 2px;
        }

        .password-hint {
            font-size: 12px;
            color: #666;
            margin-top: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .form-container {
                padding: 1.5rem;
            }

            .form-title {
                font-size: 22px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Input validation states */
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #d32f2f;
        }

        .form-control.is-valid,
        .form-select.is-valid {
            border-color: #2e7d32;
        }

        .invalid-feedback {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 0.25rem;
        }

        /* Password strength indicator */
        .password-strength {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength-weak {
            width: 33%;
            background: #d32f2f;
        }

        .password-strength-medium {
            width: 66%;
            background: #f57c00;
        }

        .password-strength-strong {
            width: 100%;
            background: #2e7d32;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <div class="site-title">
                <i class="bi bi-building"></i>
                <span>Kotabaru Tourism Data Center</span>
            </div>
        </div>

        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">
                    <i class="bi bi-pencil-square"></i>
                    Edit Data Admin
                </h2>
                <p class="form-description">Perbarui informasi akun administrator</p>
            </div>

            <form method="POST" action="{{ route('superadmin.admin.update', $admin->id_user) }}" id="editAdminForm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="username" class="form-label">
                        <i class="bi bi-person"></i>
                        Username
                        <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        name="username"
                        id="username"
                        class="form-control"
                        value="{{ $admin->username }}"
                        placeholder="Masukkan username"
                        required
                        autocomplete="username">
                    <div class="invalid-feedback">Username harus diisi</div>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">
                        <i class="bi bi-shield-check"></i>
                        Role
                        <span class="required">*</span>
                    </label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="Super Admin" {{ $admin->role === 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="Admin" {{ $admin->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <div class="invalid-feedback">Role harus dipilih</div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-check-circle"></i>
                        Update
                    </button>
                    <a href="{{ route('superadmin.admin.index') }}" class="btn btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strength-bar');

        passwordInput.addEventListener('input', function() {
            const password = this.value;

            if (password.length === 0) {
                strengthBar.className = 'password-strength-bar';
                strengthBar.style.width = '0';
                return;
            }

            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            strengthBar.className = 'password-strength-bar';

            if (strength <= 2) {
                strengthBar.classList.add('password-strength-weak');
            } else if (strength === 3) {
                strengthBar.classList.add('password-strength-medium');
            } else {
                strengthBar.classList.add('password-strength-strong');
            }
        });

        // Password match validation
        const passwordConfirm = document.getElementById('password_confirmation');
        const matchError = document.getElementById('password-match-error');

        passwordConfirm.addEventListener('input', function() {
            const password = passwordInput.value;

            // Only validate if both fields have values
            if (this.value !== '' && password !== '') {
                if (this.value !== password) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                    matchError.style.display = 'block';
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                    matchError.style.display = 'none';
                }
            } else {
                this.classList.remove('is-invalid', 'is-valid');
                matchError.style.display = 'none';
            }
        });

        // Form validation
        document.getElementById('editAdminForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirmation').value;

            // Only validate password match if password is being changed
            if (password !== '' || passwordConfirm !== '') {
                if (password !== passwordConfirm) {
                    e.preventDefault();
                    passwordConfirm.classList.add('is-invalid');
                    matchError.style.display = 'block';
                    alert('Password dan konfirmasi password tidak cocok!');
                    return false;
                }
            }
        });
    </script>
</body>

</html>
