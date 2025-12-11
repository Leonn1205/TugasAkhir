<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Kotabaru Tourism</title>
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
            height: 100vh;
            background: url("{{ asset('images/bg-login.png') }}") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(27, 94, 32, 0.4) 0%, rgba(46, 125, 50, 0.3) 100%);
            backdrop-filter: blur(3px);
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            padding: 0 20px;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 3rem 2.5rem;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.3);
        }

        .login-logo i {
            font-size: 40px;
            color: white;
        }

        .login-header h3 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
            margin: 0;
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

        .form-label i {
            color: #66bb6a;
            font-size: 16px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid #c8e6c9;
            border-radius: 12px;
            padding: 14px 50px 14px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #388e3c;
            box-shadow: 0 0 0 0.2rem rgba(56, 142, 60, 0.15);
            outline: none;
            background: white;
        }

        .form-control::placeholder {
            color: #aaa;
            font-size: 14px;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #66bb6a;
            font-size: 20px;
            pointer-events: none;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #66bb6a;
            font-size: 20px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #2e7d32;
        }

        .btn-login {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            font-weight: 600;
            padding: 14px;
            border-radius: 12px;
            border: none;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
            background: linear-gradient(135deg, #388e3c 0%, #43a047 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            margin-right: 8px;
        }

        /* Alert Styling */
        .alert-custom {
            border: none;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 1.5rem;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            color: #c62828;
            border-left: 4px solid #d32f2f;
        }

        .alert-danger-custom i {
            font-size: 22px;
            color: #d32f2f;
        }

        .alert-success-custom {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #2e7d32;
            border-left: 4px solid #388e3c;
        }

        .alert-success-custom i {
            font-size: 22px;
            color: #388e3c;
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid #e8f5e9;
        }

        .login-footer p {
            color: #666;
            font-size: 13px;
            margin: 0;
        }

        .login-footer a {
            color: #2e7d32;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        /* Loading State */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-login .spinner-border {
            width: 18px;
            height: 18px;
            border-width: 2px;
            margin-right: 8px;
        }

        /* Validation Feedback */
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

        .invalid-feedback i {
            margin-right: 5px;
        }

        /* Remember Me */
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #c8e6c9;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }

        .form-check-label {
            font-size: 14px;
            color: #666;
            cursor: pointer;
        }

        .forgot-password {
            font-size: 14px;
            color: #2e7d32;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-header h3 {
                font-size: 24px;
            }

            .form-control {
                padding: 12px 45px 12px 14px;
            }
        }

        /* Decorative Elements */
        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            pointer-events: none;
        }

        .circle-1 {
            width: 200px;
            height: 200px;
            background: #2e7d32;
            top: -100px;
            right: -100px;
        }

        .circle-2 {
            width: 150px;
            height: 150px;
            background: #ffd54f;
            bottom: -75px;
            left: -75px;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <div class="login-container">
        <div class="login-card">
            <!-- Decorative Circles -->
            <div class="decorative-circle circle-1"></div>
            <div class="decorative-circle circle-2"></div>

            <!-- Header -->
            <div class="login-header">
                <div class="login-logo">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h3>Login Admin</h3>
                <p>Kotabaru Tourism Data Center</p>
            </div>

            <!-- Alert Messages -->
            @if($errors->any())
                <div class="alert alert-danger-custom alert-custom" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        <strong>Login Gagal!</strong><br>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success-custom alert-custom" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>
                        <strong>Berhasil!</strong><br>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Username Field -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-person-fill"></i>
                        Username
                    </label>
                    <div class="input-group-custom">
                        <input type="text"
                               name="username"
                               class="form-control @error('username') is-invalid @enderror"
                               placeholder="Masukkan username"
                               value="{{ old('username') }}"
                               required
                               autofocus>
                        <i class="bi bi-person-circle input-icon"></i>
                    </div>
                    @error('username')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-lock-fill"></i>
                        Password
                    </label>
                    <div class="input-group-custom">
                        <input type="password"
                               name="password"
                               id="passwordInput"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password"
                               required>
                        <i class="bi bi-eye-slash-fill password-toggle"
                           id="togglePassword"
                           onclick="togglePasswordVisibility()"></i>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-login" id="loginButton">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p>&copy; 2025 Kotabaru Tourism Data Center</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password Visibility
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash-fill');
                toggleIcon.classList.add('bi-eye-fill');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-fill');
                toggleIcon.classList.add('bi-eye-slash-fill');
            }
        }

        // Form Submit with Loading State
        const loginForm = document.getElementById('loginForm');
        const loginButton = document.getElementById('loginButton');

        loginForm.addEventListener('submit', function() {
            loginButton.classList.add('loading');
            loginButton.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status"></span>
                Memproses...
            `;
        });

        // Remove validation error on input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                const feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.style.display = 'none';
                }
            });
        });

        // Auto-hide success alert after 5 seconds
        setTimeout(function() {
            const successAlert = document.querySelector('.alert-success-custom');
            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s ease';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }
        }, 5000);

        // Enter key submit
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                loginForm.submit();
            }
        });
    </script>
</body>
</html>
