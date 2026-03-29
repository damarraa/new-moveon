<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MoveOn') }} - Login</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <style>
        :root {
            --brand-red: #e31e24;
            --brand-blue: #0f7bd9;
            --brand-navy: #0B2447;
            --primary: var(--brand-blue);
            --danger: var(--brand-red);
            --success: #198754;
            --ink: #0f172a;
            --muted: #667085;
            --line: #e5e9f2;
            --bg: #ffffff;
            --soft: #f6f8fb;
            --primary-soft: #eaf3ff;
            --radius-lg: 12px;
            --radius-md: 8px;
            --radius-sm: 6px;
            --shadow: 0 8px 32px rgba(15, 23, 42, 0.08);
            --shadow-hover: 0 12px 40px rgba(15, 23, 42, 0.12);

            --fs-base: 14px;
            --fs-sm: 13px;
            --fs-xs: 12px;
            --h1: 22px;
            --h2: 20px;
            --h3: 18px;
            --h4: 16px;
            --h5: 14px;
            --h6: 13px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            font-size: var(--fs-base);
            line-height: 1.5;
            color: var(--ink);
            background: #f8fafc;
            min-height: 100vh;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        .login-page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            justify-content: center;
            padding: 0;
        }

        .login-wrapper {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            background: var(--bg);
            overflow: hidden;
            border: none;
            box-shadow: none;
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            animation: slideUpFade 0.6s ease-out;
        }

        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-image {
            width: 58.333333%;
            background-image:
                linear-gradient(135deg, rgba(15, 123, 217, 0.6) 0%, rgba(30, 41, 59, 0.8) 100%),
                url('{{ asset('assets/logo/login.jpg') }}');
            background-size: cover, 100% 100%;
            background-repeat: no-repeat, no-repeat;
            background-position: center, center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 1.5rem;
            overflow: hidden;
        }

        .login-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.18), transparent);
            transform: rotate(45deg);
            animation: shimmer 8s infinite linear;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .image-content {
            text-align: center;
            color: #fff;
            z-index: 2;
            width: 100%;
            position: relative;
            max-width: 460px;
        }

        .app-logo {
            width: 160px;
            max-width: 100%;
            margin-bottom: 1rem;
            filter: none;
            transition: transform 0.3s ease;
            object-fit: contain;
        }

        .app-logo:hover {
            transform: scale(1.05);
        }

        .image-content h3 {
            font-weight: 700;
            margin-bottom: 0.9rem;
            font-size: 26px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.5px;
        }

        .image-content p {
            font-size: 15px;
            opacity: 0.96;
            line-height: 1.7;
            margin-bottom: 1.3rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.7rem;
        }

        .feature-list li {
            padding: 0.55rem 0.8rem;
            color: rgba(255, 255, 255, 0.96);
            display: flex;
            align-items: center;
            justify-content: flex-start;
            font-size: 13.5px;
            text-align: left;
            background: rgba(255, 255, 255, 0.12);
            border-radius: var(--radius-sm);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            transition: all 0.3s ease;
        }

        .feature-list li:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .feature-list li i {
            color: rgba(255, 255, 255, 0.98);
            margin-right: 0.55rem;
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-list li:hover i {
            transform: scale(1.1);
        }

        .login-form {
            width: 41.666667%;
            padding: 1.5rem 2.75rem;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: stretch;
            position: relative;
        }

        .login-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--brand-blue), var(--brand-red));
        }

        .login-form-inner {
            width: 100%;
            max-width: 460px;
            margin: 0 auto;
        }

        .form-header {
            text-align: left;
            margin-bottom: 1.2rem;
        }

        .form-header h2 {
            color: var(--ink);
            font-weight: 700;
            margin-bottom: 0.45rem;
            font-size: var(--h2);
            letter-spacing: -0.5px;
        }

        .form-header p {
            color: var(--muted);
            font-size: var(--h5);
            margin-bottom: 0;
        }

        .brand-text {
            background: linear-gradient(135deg, var(--brand-blue), var(--brand-red));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.4rem;
            font-size: var(--fs-sm);
            display: flex;
            align-items: center;
        }

        .form-label::after {
            content: '*';
            color: var(--danger);
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            border: 2px solid var(--line);
            border-radius: var(--radius-sm);
            padding: 0.7rem 0.875rem;
            font-size: var(--fs-sm);
            transition: all 0.3s ease;
            background: var(--bg);
            font-family: 'Poppins', sans-serif;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 123, 217, 0.1);
            transform: translateY(-1px);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 2.6rem;
        }

        .password-wrapper>.password-toggle {
            position: absolute !important;
            top: 50% !important;
            right: 10px !important;
            left: auto !important;
            bottom: auto !important;
            transform: translateY(-50%) !important;
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0.25rem;
            border-radius: var(--radius-sm);
            font-size: var(--fs-sm);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-wrapper>.password-toggle:hover {
            color: var(--primary);
            background: var(--soft);
            transform: translateY(-50%) scale(1.05) !important;
        }

        .btn-login {
            background: #0B2447;
            border: none;
            border-radius: var(--radius-sm);
            padding: 0.9rem 1.25rem;
            font-weight: 600;
            font-size: var(--h5);
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(11, 36, 71, 0.28);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover {
            background: #12315f;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(11, 36, 71, 0.35);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.9;
            cursor: not-allowed;
        }

        .input-error {
            display: block;
            color: #dc3545;
            font-size: var(--fs-xs);
            margin-top: 0.35rem;
        }

        .alert {
            padding: 0.875rem 1rem;
            font-size: var(--fs-sm);
            border-radius: var(--radius-sm);
            border: 1px solid;
            border-left: 4px solid;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .alert-danger {
            border-color: #f5c6cb;
            border-left-color: var(--danger);
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #842029;
        }

        .alert-success {
            border-color: #badbcc;
            border-left-color: #198754;
            background: linear-gradient(135deg, #d1e7dd, #badbcc);
            color: #0f5132;
        }

        .is-valid {
            border-color: #198754 !important;
            box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1) !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
        }

        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-radius: 50%;
            border-top: 2px solid #ffffff;
            border-right: 2px solid #ffffff;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .btn-login,
        .password-toggle {
            position: relative;
            overflow: hidden;
        }

        .register-text {
            margin-top: 1rem;
            text-align: center;
            font-size: 13px;
            color: #667085;
        }

        .register-text a {
            color: #0f7bd9;
            font-weight: 600;
        }

        .footer-text {
            font-size: var(--fs-xs);
            color: var(--muted);
            text-align: center;
            margin-top: 1.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid var(--line);
        }

        .feature-hint {
            font-size: var(--fs-xs);
            color: var(--muted);
            margin-top: 0.35rem;
        }

        @media (max-width: 992px) {

            .login-image,
            .login-form {
                width: 100%;
            }

            .login-image {
                min-height: 260px;
                padding: 1.25rem;
            }

            .login-form {
                padding: 2rem 2rem;
                min-height: auto;
                justify-content: flex-start;
            }

            .login-form-inner {
                max-width: 480px;
                margin-top: 1rem;
            }

            .app-logo {
                width: 130px;
            }

            .feature-list {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
        }

        @media (max-width: 768px) {
            .login-wrapper {
                min-height: 100vh;
            }

            .login-image {
                min-height: 220px;
                padding: 1.1rem;
            }

            .login-form {
                padding: 1.75rem 1.5rem;
                min-height: auto;
            }

            .login-form-inner {
                max-width: 100%;
                margin-top: 0.5rem;
            }

            .image-content h3 {
                font-size: 22px;
            }

            .app-logo {
                width: 110px;
            }

            .feature-list {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .login-form {
                padding: 1.5rem 1.25rem;
            }

            .form-header h2 {
                font-size: var(--h3);
            }

            .btn-login {
                padding: 0.75rem 1rem;
                font-size: var(--fs-sm);
            }

            .app-logo {
                width: 96px;
            }
        }
    </style>
</head>

<body>
    <div class="login-page-wrapper">
        <div class="login-wrapper">

            <div class="login-image">
                <div class="image-content">
                    <img src="{{ asset('assets/logo/jasaraharja1.png') }}" alt="MoveOn" class="app-logo">

                    <h3>MoveOn System</h3>
                    <p>Portal terintegrasi untuk login akun dan pengelolaan data pengguna secara aman dan sederhana.</p>

                    <ul class="feature-list">
                        <li><i class="fas fa-right-to-bracket"></i> Login Aman</li>
                        <li><i class="fas fa-user-plus"></i> Registrasi User</li>
                        <li><i class="fas fa-shield-alt"></i> Hak Akses Terkontrol</li>
                        <li><i class="fas fa-lock"></i> Password Terlindungi</li>
                        <li><i class="fas fa-database"></i> Data Tersimpan</li>
                        <li><i class="fas fa-desktop"></i> Tampilan Modern</li>
                    </ul>
                </div>
            </div>

            <div class="login-form">
                <div class="login-form-inner">
                    <div class="form-header">
                        <h2>Masuk ke <span class="brand-text">MoveOn</span></h2>
                        <p>Silakan masuk dengan email atau nomor telepon Anda</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-circle-check" style="margin-right:8px;"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any() && !$errors->has('login') && !$errors->has('password'))
                        <div class="alert alert-danger">
                            <i class="fas fa-circle-exclamation" style="margin-right:8px;"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}" id="loginForm">
                        @csrf

                        <div class="mb-3">
                            <label for="login" class="form-label">
                                <i class="fas fa-user" style="margin-right:8px;"></i>Email / Nomor Telepon
                            </label>
                            <input id="login" type="text"
                                class="form-control @error('login') is-invalid @enderror" name="login"
                                value="{{ old('login') }}" required autofocus
                                placeholder="Masukkan email atau nomor telepon">
                            <div class="feature-hint">Gunakan email atau nomor telepon yang terdaftar.</div>
                            @error('login')
                                <span class="input-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock" style="margin-right:8px;"></i>Password
                            </label>

                            <div class="password-wrapper">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="Masukkan password">
                                <button type="button" class="password-toggle" id="togglePassword"
                                    aria-label="Toggle password visibility">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            @error('password')
                                <span class="input-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn-login" id="loginButton">
                                <i class="fas fa-sign-in-alt" style="margin-right:8px;"></i>
                                Login
                            </button>
                        </div>
                    </form>

                    <div class="register-text">
                        Kembali ke halaman utama?
                        <a href="{{ url('/') }}">Ke Beranda</a>
                    </div>

                    <div class="footer-text">
                        <div>
                            <i class="fas fa-shield-alt"></i>
                            <span>Sistem Aman &middot; Data Terlindungi</span>
                        </div>
                        <div>
                            &copy; {{ date('Y') }} MoveOn
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginInput = document.getElementById('login');
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const form = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                        this.setAttribute('aria-label', 'Sembunyikan password');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                        this.setAttribute('aria-label', 'Tampilkan password');
                    }
                });
            }

            if (form && loginButton && loginInput && passwordInput) {
                form.addEventListener('submit', function() {
                    const login = loginInput.value.trim();
                    const pwd = passwordInput.value.trim();

                    if (!login || !pwd) {
                        return;
                    }

                    loginButton.disabled = true;
                    loginButton.classList.add('btn-loading');
                });
            }

            const inputs = document.querySelectorAll('input[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    this.classList.remove('is-valid', 'is-invalid');

                    if (this.value.trim() === '') {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.add('is-valid');
                    }
                });

                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            if (loginInput) {
                setTimeout(() => loginInput.focus(), 400);
            }

            document.addEventListener('click', function(e) {
                const target = e.target.closest('.btn-login, .password-toggle');
                if (!target) return;

                const rect = target.getBoundingClientRect();
                const ripple = document.createElement('span');
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                target.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });
    </script>
</body>

</html>
