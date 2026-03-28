<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title ?? config('app.name', 'Aplikasi Kapal') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    @stack('styles')

    @php
        $pageTitle = trim($__env->yieldContent('page_title')) ?: ($title ?? 'Dashboard');
        $pageBreadcrumb = trim($__env->yieldContent('breadcrumb')) ?: $pageTitle;
        $currentPath = request()->path();

        function isActiveMenu($patterns = [])
        {
            foreach ((array) $patterns as $pattern) {
                if (request()->is($pattern)) {
                    return 'active';
                }
            }
            return '';
        }

        function pageIconByPath($path)
        {
            if ($path === '/' || request()->is('dashboard')) {
                return 'bi-grid-fill';
            }

            if (request()->is('profiling') || request()->is('profiling/*')) {
                return 'bi-people-fill';
            }

            if (request()->is('manifest') || request()->is('manifest/*')) {
                return 'bi-file-earmark-text-fill';
            }

            if (request()->is('pelaporan-kapal') || request()->is('pelaporan-kapal/*')) {
                return 'bi-file-earmark-bar-graph-fill';
            }

            return 'bi-grid-fill';
        }

        $pageIcon = pageIconByPath($currentPath);
    @endphp

    <style>
        :root {
            --brand-primary: #0f7bd9;
            --brand-primary-dark: #0a5db0;
            --brand-danger: #dc3545;
            --ink: #0f172a;
            --muted: #667085;
            --line: #e5e9f2;
            --bg: #ffffff;
            --soft: #f6f8fb;
            --primary-soft: #eaf3ff;
            --sidebar-w: 270px;
            --topbar-h: 60px;
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 10px;
            --shadow: 0 10px 28px rgba(15, 23, 42, .06);
            --shadow-soft: 0 6px 20px rgba(15, 23, 42, .05);

            --fs-base: 13px;
            --fs-sm: 12px;
            --fs-xs: 11px;
            --h1: 18px;
            --h2: 16px;
            --h3: 15px;
        }

        body.dark-mode {
            --ink: #f8fafc;
            --muted: #9fb0c6;
            --line: #2a3446;
            --bg: #1e293b;
            --soft: #0f172a;
            --primary-soft: #173b8f;
            --shadow: 0 10px 30px rgba(0,0,0,.25);
            --shadow-soft: 0 6px 20px rgba(0,0,0,.20);
        }

        html, body {
            min-height: 100%;
        }

        body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            font-size: var(--fs-base);
            line-height: 1.45;
            color: var(--ink);
            background: var(--soft);
            transition: background-color .3s, color .3s;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        h1, h2, h3, h4, h5, h6,
        .navbar, .btn, .form-control, .form-select,
        .table, .dropdown-menu, .modal-title, .badge, .input-group-text {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif !important;
        }

        h1 {
            font-size: var(--h1);
            font-weight: 700;
            margin-bottom: .75rem;
        }

        h2 {
            font-size: var(--h2);
            font-weight: 600;
            margin-bottom: .6rem;
        }

        h3 {
            font-size: var(--h3);
            font-weight: 600;
            margin-bottom: .5rem;
        }

        .btn {
            font-size: var(--fs-sm);
            border-radius: 10px;
            font-weight: 500;
        }

        .btn-primary {
            background: var(--brand-primary);
            border-color: var(--brand-primary);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: var(--brand-primary-dark);
            border-color: var(--brand-primary-dark);
        }

        .btn-outline-soft {
            background: #fff;
            border: 1px solid #d0d7e6;
            color: var(--ink);
            border-radius: 999px;
            padding-inline: 1rem;
        }

        .btn-outline-soft:hover {
            background: #f3f6fb;
            border-color: #c3cce3;
        }

        .btn-pill-primary {
            border-radius: 999px;
            background: var(--brand-primary);
            border-color: var(--brand-primary);
            color: #fff;
            font-size: var(--fs-sm);
            font-weight: 500;
            padding-inline: 1rem;
            box-shadow: 0 4px 12px rgba(15, 123, 217, .28);
        }

        .btn-pill-primary:hover {
            background: var(--brand-primary-dark);
            border-color: var(--brand-primary-dark);
        }

        .form-control,
        .form-select {
            font-size: var(--fs-sm);
            border-radius: 10px;
            border-color: var(--line);
            min-height: 40px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 .2rem rgba(15,123,217,.12);
        }

        .card {
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
            background: var(--bg);
        }

        .table-responsive {
            border-radius: var(--radius-sm);
            overflow: hidden;
        }

        #loader-wrapper {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(15,23,42,.25);
            backdrop-filter: blur(3px);
            z-index: 1100;
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s, visibility .25s;
        }

        #loader-box {
            background: var(--bg);
            border-radius: 16px;
            padding: 18px 22px;
            box-shadow: 0 10px 32px rgba(15,23,42,.25);
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 260px;
        }

        .loader-spinner {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 3px solid #d0d7e6;
            border-top-color: var(--brand-primary);
            animation: spinLoader .9s linear infinite;
        }

        @keyframes spinLoader {
            to { transform: rotate(360deg); }
        }

        .loader-text-main {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
        }

        .loader-text-sub {
            font-size: 11px;
            color: var(--muted);
        }

        #mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.35);
            z-index: 950;
            display: none;
        }

        body.sidebar-open #mobile-overlay {
            display: block;
        }

        .sidebar-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: #ffffff;
            border-right: 1px solid var(--line);
            overflow: hidden;
            z-index: 1000;
            transition: transform .28s ease, box-shadow .28s ease, background-color .3s;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            border-bottom: 1px solid var(--line);
            background: #fff;
            flex-shrink: 0;
        }

        .sidebar-brand img {
            max-height: 38px;
            width: auto;
            max-width: 145px;
            object-fit: contain;
            display: block;
        }

        .sidebar-menu-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 1rem .85rem;
        }

        .sidebar-nav {
            margin-bottom: 0;
        }

        .nav-heading {
            font-size: var(--fs-xs);
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            padding: .5rem .6rem .7rem;
            letter-spacing: .4px;
        }

        .sidebar-nav .nav-item {
            margin-bottom: 6px;
        }

        .sidebar-nav .nav-link {
            font-size: 13px;
            color: #334e6a;
            font-weight: 500;
            border-radius: 12px;
            padding: 11px 13px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: background-color .18s, color .18s, transform .18s;
        }

        .sidebar-nav .nav-link .bi {
            font-size: 1.05rem;
            color: #7a879a;
            transition: color .18s;
            min-width: 18px;
            text-align: center;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--primary-soft);
            color: var(--brand-primary);
            transform: translateX(2px);
        }

        .sidebar-nav .nav-link:hover .bi {
            color: var(--brand-primary);
        }

        .sidebar-nav .nav-link.active {
            background: #0a5db0;
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(10, 93, 176, 0.28);
        }

        .sidebar-nav .nav-link.active .bi {
            color: #ffffff;
        }

        .sidebar-footer {
            padding: .85rem;
            border-top: 1px solid var(--line);
            background: #fff;
            flex-shrink: 0;
        }

        .sidebar-footer .logout-link {
            width: 100%;
            font-size: 13px;
            color: var(--brand-danger);
            font-weight: 600;
            border-radius: 12px;
            padding: 11px 13px;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff5f5;
            border: 1px solid #ffd9dd;
            transition: .18s ease;
        }

        .sidebar-footer .logout-link .bi {
            font-size: 1.05rem;
            min-width: 18px;
            text-align: center;
        }

        .sidebar-footer .logout-link:hover {
            background: #ffecef;
            color: #bb2d3b;
            transform: translateY(-1px);
        }

        .page-content-wrapper {
            width: calc(100% - var(--sidebar-w));
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left .28s ease, width .28s ease;
        }

        .top-navbar {
            height: var(--topbar-h);
            background: var(--bg);
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 900;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 .85rem;
        }

        .left-cluster {
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .sidebar-toggler {
            display: none;
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid var(--line);
            align-items: center;
            justify-content: center;
            background: transparent;
        }

        .sidebar-toggler:hover {
            background: var(--primary-soft);
            border-color: transparent;
        }

        #global-search {
            width: 280px;
            max-width: 42vw;
            border: 1px solid var(--line);
            border-radius: 12px;
            height: 38px;
            padding: 0 12px 0 38px;
            font-size: var(--fs-sm);
            background: var(--bg);
            color: var(--ink);
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%23667085" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>');
            background-repeat: no-repeat;
            background-position: 12px center;
            background-size: 16px;
        }

        #global-search:focus {
            outline: 0;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 .2rem rgba(15,123,217,.15);
        }

        .nav-icons .nav-link,
        .topbar-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid var(--line);
            transition: background-color .2s, border-color .2s;
            margin-left: 6px;
            color: var(--ink);
            background: transparent;
        }

        .nav-icons .nav-link:hover,
        .topbar-icon-btn:hover {
            background: var(--primary-soft);
            border-color: transparent;
        }

        .nav-icons .bi {
            font-size: 18px;
            line-height: 1;
        }

        .profile-dropdown .nav-link {
            width: auto;
            min-width: 38px;
            padding: 4px 10px 4px 4px;
            border-radius: 999px;
            gap: 8px;
        }

        .profile-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .profile-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0f7bd9, #22c1c3);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 600;
            color: var(--ink);
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-menu {
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow);
            padding: .45rem 0;
            min-width: 220px;
            background: var(--bg);
        }

        .dropdown-header {
            font-size: var(--fs-sm);
            font-weight: 600;
            color: var(--ink);
            padding: .5rem 1rem;
        }

        .dropdown-item {
            padding: .6rem 1rem;
            display: flex;
            align-items: center;
            gap: .5rem;
            transition: background-color .15s, color .15s;
            color: var(--ink);
            font-size: var(--fs-sm);
        }

        .dropdown-item:hover {
            background: var(--primary-soft);
            color: var(--brand-primary);
        }

        .dropdown-item.logout-item {
            color: #dc3545;
        }

        .dropdown-item.logout-item:hover {
            background: #fff5f5;
            color: #dc3545;
        }

        .page-header-shell {
            margin-top: .35rem;
            margin-bottom: .75rem;
        }

        .page-header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            padding: .55rem 0 .75rem 0;
            border-bottom: 1px solid var(--line);
            flex-wrap: wrap;
        }

        .ph-left {
            display: flex;
            align-items: center;
            gap: .75rem;
            min-width: 0;
        }

        .ph-icon-circle {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            background: linear-gradient(135deg, #34d399, #0ea5e9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(59,130,246,.25);
            flex-shrink: 0;
        }

        .ph-icon-circle .bi {
            font-size: 1.1rem;
        }

        .ph-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--ink);
        }

        .ph-breadcrumb {
            font-size: var(--fs-sm);
            color: var(--muted);
        }

        .ph-breadcrumb a {
            color: var(--muted);
        }

        .ph-breadcrumb .sep {
            margin: 0 .35rem;
        }

        .ph-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: .5rem;
        }

        .content-container {
            padding-top: .35rem;
            padding-bottom: 1rem;
        }

        .site-footer {
            color: var(--muted);
            font-size: var(--fs-sm);
            padding: 0 1.5rem 1rem;
        }

        .search-hit {
            animation: searchFlash 1.2s ease-out 1;
            box-shadow: 0 0 0 3px rgba(56,189,248,.55);
            border-radius: 6px;
        }

        @keyframes searchFlash {
            0% { background-color: #fef3c7; }
            100% { background-color: transparent; }
        }

        @media (max-width: 991.98px) {
            .page-content-wrapper {
                width: 100%;
                margin-left: 0;
            }

            .sidebar-wrapper {
                transform: translateX(-100%);
                box-shadow: none;
            }

            body.sidebar-open .sidebar-wrapper {
                transform: translateX(0);
                box-shadow: 0 0 22px rgba(0,0,0,.18);
            }

            .sidebar-toggler {
                display: inline-flex;
            }

            #global-search {
                width: 190px;
                max-width: 55vw;
            }
        }

        @media (max-width: 767.98px) {
            .content-container {
                padding-left: .85rem;
                padding-right: .85rem;
            }

            .sidebar-brand img {
                max-height: 30px;
                max-width: 118px;
            }

            .profile-name {
                display: none;
            }
        }

        @media (max-width: 575.98px) {
            #global-search {
                width: 160px;
                max-width: 48vw;
            }

            .page-header-bar {
                align-items: flex-start;
            }

            .ph-actions {
                width: 100%;
            }
        }

        .sidebar-toggler:focus,
        .nav-icons .nav-link:focus,
        .sidebar-nav a:focus,
        #global-search:focus,
        .sidebar-footer button:focus {
            outline: 2px solid var(--brand-primary);
            outline-offset: 2px;
        }

        .swal2-popup.swal2-modal.swal-logout-popup {
            width: 25rem !important;
            padding: 1.25rem 1.25rem 1rem !important;
            border-radius: 16px !important;
        }

        .swal-logout-popup .swal2-icon {
            margin: .35rem auto .7rem !important;
            transform: scale(.82);
        }

        .swal-logout-popup .swal2-title {
            font-size: 1.6rem !important;
            margin: 0 0 .35rem !important;
        }

        .swal-logout-popup .swal2-html-container {
            font-size: .98rem !important;
            margin: 0 auto .9rem !important;
            line-height: 1.45 !important;
        }

        .swal-logout-popup .swal2-actions {
            margin-top: .25rem !important;
            gap: .45rem !important;
        }

        .swal-logout-popup .swal2-styled {
            font-size: .95rem !important;
            padding: .6rem 1rem !important;
            border-radius: 10px !important;
            min-width: 96px;
        }
    </style>
</head>
<body>
    <div id="loader-wrapper">
        <div id="loader-box">
            <div class="loader-spinner"></div>
            <div>
                <div class="loader-text-main">Sedang memproses data…</div>
                <div class="loader-text-sub">Mohon tunggu, proses ini bisa memakan waktu.</div>
            </div>
        </div>
    </div>

    <div id="mobile-overlay"></div>

    @auth
    <nav class="sidebar-wrapper" aria-label="Sidebar navigasi">
        <div class="sidebar-brand">
            <a href="/dashboard">
                <img src="{{ asset('assets/logo/jasaraharja.png') }}" alt="Logo Aplikasi">
            </a>
        </div>

        <div class="sidebar-menu-scroll">
            <ul class="nav flex-column sidebar-nav">
                <li class="nav-heading">Main Menu</li>

                <li class="nav-item">
                    <a class="nav-link {{ isActiveMenu(['dashboard']) }}" href="/dashboard">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ isActiveMenu(['profiling', 'profiling/*']) }}" href="/profiling">
                        <i class="bi bi-people-fill"></i>
                        <span>Daftar Profiling</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ isActiveMenu(['manifest', 'manifest/*']) }}" href="/manifest">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span>Rekap Data Manifest</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ isActiveMenu(['pelaporan-kapal', 'pelaporan-kapal/*']) }}" href="/pelaporan-kapal">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        <span>Pelaporan Kapal</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <button type="button" class="logout-link" onclick="confirmLogout()">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </div>
    </nav>
    @endauth

    <div class="page-content-wrapper">
        @auth
        <nav class="top-navbar" aria-label="Topbar">
            <div class="left-cluster">
                <button class="sidebar-toggler" id="sidebar-toggler" aria-label="Buka tutup menu" aria-expanded="false" type="button">
                    <i class="bi bi-list"></i>
                </button>

                <div class="position-relative">
                    <input id="global-search" type="search" placeholder="Cari menu / konten…" autocomplete="off" />
                </div>
            </div>

            <div class="nav-icons d-flex align-items-center justify-content-end">
                <a class="nav-link" id="theme-toggle" role="button" aria-label="Ganti tema" aria-pressed="false" title="Tema" href="#">
                    <i class="bi bi-moon-stars-fill" id="theme-icon"></i>
                </a>

                <div class="dropdown profile-dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Akun" href="#" role="button">
                        <span class="profile-chip">
                            <span class="profile-avatar">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </span>
                            <span class="profile-name">{{ Auth::user()->name ?? 'User' }}</span>
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li>
                            <h6 class="dropdown-header">
                                <i class="bi bi-person-fill me-2"></i>{{ Auth::user()->name ?? 'User' }}
                            </h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/profile">
                                <i class="bi bi-person me-2"></i>Profil
                            </a>
                        </li>
                        <li>
                            <button class="dropdown-item logout-item" type="button" onclick="confirmLogout()">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endauth

        <main class="container-fluid content-container flex-grow-1">
            @auth
            <div class="page-header-shell">
                <div class="page-header-bar">
                    <div class="ph-left">
                        <div class="ph-icon-circle">
                            <i class="bi {{ $pageIcon }}"></i>
                        </div>
                        <div>
                            <div class="ph-title">{{ $pageTitle }}</div>
                            <div class="ph-breadcrumb">
                                <a href="/dashboard">Home</a>
                                <span class="sep">›</span>
                                <span>{{ $pageBreadcrumb }}</span>
                            </div>
                        </div>
                    </div>

                    @hasSection('page_actions')
                        <div class="ph-actions ms-auto">
                            @yield('page_actions')
                        </div>
                    @endif
                </div>
            </div>
            @endauth

            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            timer: 2500,
                            showConfirmButton: false,
                            icon: 'success',
                            title: @json(session('success'))
                        });
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                            icon: 'error',
                            title: @json(session('error'))
                        });
                    });
                </script>
            @endif

            @yield('content')
        </main>

        <div class="site-footer text-center mt-auto">
            © {{ date('Y') }} {{ config('app.name', 'Aplikasi Kapal') }}
        </div>
    </div>

    @auth
    <form id="logout-form" action="/logout" method="POST" class="d-none">
        @csrf
    </form>
    @endauth

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        (function initTheme() {
            const saved = localStorage.getItem('theme');
            if (saved === 'dark') {
                document.body.classList.add('dark-mode');
                setThemeIcon('dark');
            } else {
                setThemeIcon('light');
            }
        })();

        function setThemeIcon(mode) {
            const i = document.getElementById('theme-icon');
            const t = document.getElementById('theme-toggle');
            if (!i || !t) return;

            if (mode === 'dark') {
                i.className = 'bi bi-sun-fill';
                t.setAttribute('aria-pressed', 'true');
            } else {
                i.className = 'bi bi-moon-stars-fill';
                t.setAttribute('aria-pressed', 'false');
            }
        }

        const $body = $('body');
        const $overlay = $('#mobile-overlay');
        const mm = window.matchMedia('(max-width: 991.98px)');

        $('#sidebar-toggler').on('click', function (e) {
            e.preventDefault();
            const open = !$body.hasClass('sidebar-open');
            $body.toggleClass('sidebar-open', open);
            $(this).attr('aria-expanded', open ? 'true' : 'false');
        });

        $overlay.on('click', function () {
            $body.removeClass('sidebar-open');
            $('#sidebar-toggler').attr('aria-expanded', 'false');
        });

        window.addEventListener('resize', () => {
            if (!mm.matches) {
                $body.removeClass('sidebar-open');
                $('#sidebar-toggler').attr('aria-expanded', 'false');
            }
        });

        $('#theme-toggle').on('click', function (e) {
            e.preventDefault();
            $body.toggleClass('dark-mode');
            const mode = $body.hasClass('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('theme', mode);
            setThemeIcon(mode);
        });

        const loaderEl = document.getElementById('loader-wrapper');
        let loaderTimer = null;

        window.showLoader = function (delayMs = 0) {
            if (!loaderEl) return;
            if (loaderTimer) {
                clearTimeout(loaderTimer);
                loaderTimer = null;
            }

            if (delayMs <= 0) {
                loaderEl.style.visibility = 'visible';
                loaderEl.style.opacity = '1';
            } else {
                loaderTimer = setTimeout(() => {
                    loaderEl.style.visibility = 'visible';
                    loaderEl.style.opacity = '1';
                }, delayMs);
            }
        };

        window.hideLoader = function () {
            if (!loaderEl) return;
            if (loaderTimer) {
                clearTimeout(loaderTimer);
                loaderTimer = null;
            }
            loaderEl.style.opacity = '0';
            loaderEl.style.visibility = 'hidden';
        };

        window.toast = (msg, icon = 'info') => Swal.fire({
            toast: true,
            position: 'top-end',
            timer: 2500,
            showConfirmButton: false,
            icon,
            title: msg
        });

        function confirmLogout() {
            Swal.fire({
                title: 'Logout?',
                text: 'Anda yakin ingin keluar dari sistem?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, logout',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'swal-logout-popup'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }

        (function initGlobalContentSearch() {
            const $input = $('#global-search');
            if (!$input.length) return;

            function doSearch() {
                const q = ($input.val() || '').trim().toLowerCase();
                if (!q) return;

                const $root = $('.page-content-wrapper main');
                if (!$root.length) return;

                $root.find('.search-hit').removeClass('search-hit');

                const $targets = $root.find('h1,h2,h3,h4,h5,h6,th,td,label,p,span,a,button,li,div');
                let $found = null;

                $targets.each(function () {
                    const text = ($(this).text() || '').trim().toLowerCase();
                    if (text && text.indexOf(q) !== -1) {
                        $found = $(this);
                        return false;
                    }
                });

                if ($found && $found.length) {
                    $found.addClass('search-hit');
                    const offsetTop = $found.offset().top - 90;
                    $('html, body').animate({ scrollTop: offsetTop }, 400);
                } else {
                    toast('Konten tidak ditemukan.', 'info');
                }
            }

            $input.on('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    doSearch();
                }
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>