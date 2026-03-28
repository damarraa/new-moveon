<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MoveOn') }} - Register Internal</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">

    <style>
        :root {
            --brand-red: #e31e24;
            --brand-blue: #0f7bd9;
            --brand-navy: #0B2447;
            --primary: var(--brand-blue);
            --danger: #dc3545;
            --success: #198754;
            --ink: #0f172a;
            --muted: #667085;
            --line: #e5e9f2;
            --bg: #ffffff;
            --soft: #f8fafc;
            --radius-lg: 12px;
            --radius-md: 8px;
            --radius-sm: 6px;
            --shadow: 0 8px 32px rgba(15, 23, 42, 0.08);

            --fs-base: 14px;
            --fs-sm: 13px;
            --fs-xs: 12px;
            --h1: 22px;
            --h2: 20px;
            --h3: 18px;
            --h4: 16px;
            --h5: 14px;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
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

        .register-page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            justify-content: center;
        }

        .register-wrapper {
            width: 100%;
            min-height: 100vh;
            background: var(--bg);
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
        }

        .register-image {
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

        .register-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.18), transparent);
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
            max-width: 500px;
        }

        .app-logo {
            width: 160px;
            max-width: 100%;
            margin-bottom: 1rem;
            object-fit: contain;
        }

        .image-content h3 {
            font-weight: 700;
            margin-bottom: 0.9rem;
            font-size: 26px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .image-content p {
            font-size: 15px;
            opacity: 0.96;
            line-height: 1.7;
            margin-bottom: 1.3rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
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
            color: rgba(255,255,255,0.96);
            display: flex;
            align-items: center;
            font-size: 13.5px;
            text-align: left;
            background: rgba(255,255,255,0.12);
            border-radius: var(--radius-sm);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.25);
        }

        .feature-list li i {
            margin-right: 0.55rem;
            width: 20px;
            text-align: center;
        }

        .register-form {
            width: 41.666667%;
            padding: 1.5rem 2.75rem;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .register-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--brand-blue), var(--brand-red));
        }

        .register-form-inner {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        .form-header {
            margin-bottom: 1.2rem;
        }

        .form-header h2 {
            color: var(--ink);
            font-weight: 700;
            margin-bottom: 0.45rem;
            font-size: var(--h2);
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

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-left: -10px;
            margin-right: -10px;
        }

        .col-md-6, .col-12 {
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: 1rem;
        }

        .col-12 {
            width: 100%;
        }

        .col-md-6 {
            width: 50%;
        }

        .form-label {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.4rem;
            font-size: var(--fs-sm);
            display: block;
        }

        .required::after {
            content: '*';
            color: var(--danger);
            margin-left: 4px;
        }

        .form-control, .form-select {
            width: 100%;
            border: 2px solid var(--line);
            border-radius: var(--radius-sm);
            padding: 0.7rem 0.875rem;
            font-size: var(--fs-sm);
            transition: all 0.3s ease;
            background: var(--bg);
            font-family: inherit;
            outline: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 123, 217, 0.1);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 2.6rem;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            padding: 0.25rem;
            width: 32px;
            height: 32px;
        }

        .btn-register {
            background: #0B2447;
            border: none;
            border-radius: var(--radius-sm);
            padding: 0.9rem 1.25rem;
            font-weight: 600;
            font-size: var(--h5);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(11, 36, 71, 0.28);
        }

        .btn-register:hover {
            background: #12315f;
        }

        .btn-link-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1.5px solid var(--line);
            border-radius: var(--radius-sm);
            color: var(--ink);
            background: #fff;
            font-weight: 600;
            margin-top: 0.75rem;
        }

        .btn-link-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .input-error {
            display: block;
            color: var(--danger);
            font-size: var(--fs-xs);
            margin-top: 0.35rem;
        }

        .alert {
            padding: 0.875rem 1rem;
            font-size: var(--fs-sm);
            border-radius: var(--radius-sm);
            border: 1px solid;
            border-left: 4px solid;
            margin-bottom: 1rem;
        }

        .alert-danger {
            border-color: #f5c6cb;
            border-left-color: var(--danger);
            background: #f8d7da;
            color: #842029;
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

        @media (max-width: 992px) {
            .register-image,
            .register-form {
                width: 100%;
            }

            .register-image {
                min-height: 260px;
            }

            .register-form {
                padding: 2rem;
                min-height: auto;
            }

            .register-form-inner {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .col-md-6 {
                width: 100%;
            }

            .feature-list {
                grid-template-columns: 1fr;
            }

            .register-form {
                padding: 1.5rem 1.25rem;
            }

            .feature-list {
                display: none;
            }
        }
    </style>
</head>
<body>


    <div class="register-page-wrapper">
        <div class="register-wrapper">

            <div class="register-image">
                <div class="image-content">
                    <img src="{{ asset('assets/logo/jasaraharja1.png') }}" alt="MoveOn" class="app-logo">

                    <h3>Registrasi Internal</h3>
                    <p>Halaman pendaftaran untuk user internal perusahaan dan super admin pada sistem MoveOn.</p>

                    <ul class="feature-list">
                        <li><i class="fas fa-user"></i> Data Pegawai</li>
                        <li><i class="fas fa-envelope"></i> Login Email</li>
                        <li><i class="fas fa-id-badge"></i> Jabatan User</li>
                        <li><i class="fas fa-map"></i> Wilayah Kerja</li>
                        <li><i class="fas fa-user-shield"></i> Role Internal</li>
                        <li><i class="fas fa-desktop"></i> Tampilan Modern</li>
                    </ul>
                </div>
            </div>

            <div class="register-form">
                <div class="register-form-inner">
                    <div class="form-header">
                        <h2>Daftar <span class="brand-text">Internal</span></h2>
                        <p>Silakan lengkapi data pendaftaran internal perusahaan</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Ups, ada data yang belum benar:</strong>
                            <ul style="margin:8px 0 0 18px; padding:0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/register/internal') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="form-label required">Nama</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label required">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan email">
                                @error('email')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label required">Nomor HP</label>
                                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Masukkan nomor HP">
                                @error('phone')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="jabatan" class="form-label required">Jabatan</label>
                                <input type="text" id="jabatan" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" placeholder="Masukkan jabatan">
                                @error('jabatan')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="wilayah" class="form-label required">Wilayah</label>
                                <input type="text" id="wilayah" name="wilayah" class="form-control @error('wilayah') is-invalid @enderror" value="{{ old('wilayah') }}" placeholder="Masukkan wilayah">
                                @error('wilayah')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="loket_samsat" class="form-label required">Loket Samsat</label>
                                <input type="text" id="loket_samsat" name="loket_samsat" class="form-control @error('loket_samsat') is-invalid @enderror" value="{{ old('loket_samsat') }}" placeholder="Masukkan loket samsat">
                                @error('loket_samsat')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="role" class="form-label required">Role</label>
                                <select id="role" name="role" class="form-select @error('role') is-invalid @enderror">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="internal" {{ old('role') == 'internal' ? 'selected' : '' }}>Internal</option>
                                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                                @error('role')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label required">Password</label>
                                <div class="password-wrapper">
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
                                    <button type="button" class="password-toggle" data-target="password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="input-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label required">Konfirmasi Password</label>
                                <div class="password-wrapper">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi password">
                                    <button type="button" class="password-toggle" data-target="password_confirmation">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-register">
                            <i class="fas fa-user-plus" style="margin-right:8px;"></i>
                            Daftar Sebagai Internal
                        </button>

                        <a href="{{ url('/register/operator') }}" class="btn-link-secondary">
                            <i class="fas fa-building" style="margin-right:8px;"></i>
                            Pindah ke Register Operator
                        </a>

                        <div class="register-text">
                            Sudah punya akun?
                            <a href="{{ url('/login') }}">Login</a>
                        </div>

                        <div class="footer-text">
                            &copy; {{ date('Y') }} MoveOn - Registrasi Internal
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.password-toggle').forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (!input) return;

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>