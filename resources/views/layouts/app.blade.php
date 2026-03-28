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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

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

            if (request()->is('operator/profiling') || request()->is('operator/profiling/*')) {
                return 'bi-people-fill';
            }

            if (request()->is('operator/manifest') || request()->is('operator/manifest/*')) {
                return 'bi-file-earmark-text-fill';
            }

            if (request()->is('operator/pelaporan-kapal') || request()->is('operator/pelaporan-kapal/*')) {
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
            --brand-warning: #f59e0b;
            --brand-info: #0ea5e9;
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

        .form-control,
        .form-select {
            font-size: var(--fs-sm);
            border-radius: 10px;
            border-color: var(--line);
            min-height: 42px;
            background: var(--bg);
            color: var(--ink);
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
            overflow-x: hidden;
            overflow-y: visible;
            width: 100%;
        }

        .content-card {
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: var(--shadow-soft);
            background: var(--bg);
            overflow: hidden;
        }

        .content-card .card-body {
            padding: 1rem 1rem;
        }

        .form-page-card {
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: var(--shadow-soft);
            background: var(--bg);
        }

        .form-page-card .card-body {
            padding: 1.25rem;
        }

        .app-table {
            margin: 0;
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0;
            table-layout: auto;
        }

        .app-table thead th {
            background: #f8fafc !important;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .3px;
            border-bottom: 1px solid #e2e8f0 !important;
            border-top: 0 !important;
            padding: 14px 12px;
            white-space: nowrap;
            vertical-align: middle;
        }

        .app-table tbody td {
            font-size: 13px;
            color: #0f172a;
            padding: 14px 12px;
            border-bottom: 1px solid #eef2f7 !important;
            vertical-align: middle;
            background: #fff;
            white-space: normal;
            word-break: break-word;
        }

        .app-table tbody tr:hover td {
            background: #f8fbff;
        }

        .table-empty-state {
            text-align: center;
            color: var(--muted);
            padding: 18px 10px 4px;
            font-size: 13px;
        }

        .table-action-col,
        .table-action-cell {
            position: static;
            right: auto;
            z-index: auto;
            background: #fff !important;
            width: 138px;
            min-width: 138px;
            max-width: 138px;
            box-shadow: none;
        }

        .app-table thead .table-action-col {
            background: #f8fafc !important;
        }

        .table-action-wrap {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .table-action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .table-action-btn i {
            font-size: 13px;
        }

        .table-control-col,
        .app-table td.dtr-control {
            width: 42px;
            min-width: 42px;
            max-width: 42px;
            text-align: center;
        }

        .app-table td.dtr-control {
            cursor: pointer;
        }

        .app-table td.dtr-control::before {
            content: '+';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--brand-primary);
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            line-height: 1;
        }

        .app-table tr.parent td.dtr-control::before {
            content: '−';
            background: var(--brand-danger);
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
            display: none !important;
        }

        .dtr-details {
            width: 100%;
        }

        .dtr-details li {
            padding: 8px 0 !important;
            border-bottom: 1px dashed #e2e8f0;
        }

        .dtr-title {
            font-weight: 700;
            color: #475569;
            min-width: 150px;
            display: inline-block;
            margin-right: 10px;
        }

        .dtr-data {
            color: #0f172a;
        }

        .dataTables_wrapper {
            width: 100%;
            overflow-x: hidden;
        }

        .dataTables_wrapper .row {
            --bs-gutter-x: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #dbe3ee;
            border-radius: 10px;
            padding: 8px 12px;
            margin-left: 8px;
            max-width: 100%;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dbe3ee;
            border-radius: 10px;
            padding: 6px 30px 6px 10px;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 12px;
        }

        .page-item.active .page-link {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }

        .page-link {
            color: var(--brand-primary);
        }

        .page-link:focus {
            box-shadow: 0 0 0 .15rem rgba(15,123,217,.18);
        }

        .app-page {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .page-form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-top: 1rem;
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

            .table-action-col,
            .table-action-cell {
                width: 118px;
                min-width: 118px;
                max-width: 118px;
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

            .content-card .card-body,
            .form-page-card .card-body {
                padding: .95rem;
            }

            .app-table {
                min-width: 100%;
            }

            .app-table thead th,
            .app-table tbody td {
                font-size: 12px;
                padding: 12px 10px;
                white-space: normal;
                word-break: break-word;
            }

            .table-action-col,
            .table-action-cell {
                width: 112px;
                min-width: 112px;
                max-width: 112px;
            }

            .table-action-btn {
                width: 30px;
                height: 30px;
            }

            .dataTables_wrapper .row:first-child,
            .dataTables_wrapper .row:last-child {
                row-gap: 12px;
            }

            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                text-align: left !important;
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
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/logo/jasaraharja.png') }}" alt="Logo Aplikasi">
            </a>
        </div>

        <div class="sidebar-menu-scroll">
            <ul class="nav flex-column sidebar-nav">
                <li class="nav-heading">Main Menu</li>

                <li class="nav-item">
                    <a class="nav-link {{ isActiveMenu(['dashboard']) }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ isActiveMenu(['operator/profiling', 'operator/profiling/*']) }}"
                       href="{{ route('operator.profiling.index') }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Daftar Profiling</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ isActiveMenu(['operator/manifest', 'operator/manifest/*']) }}"
                       href="{{ route('operator.manifest.index') }}">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span>Rekap Data Manifest</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ isActiveMenu(['operator/pelaporan-kapal', 'operator/pelaporan-kapal/*']) }}"
                       href="{{ route('operator.pelaporan-kapal.index') }}">
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
                            <a class="dropdown-item" href="#">
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
                                <a href="{{ route('dashboard') }}">Home</a>
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

            @yield('content')
        </main>

        <div class="site-footer text-center mt-auto">
            © {{ date('Y') }} {{ config('app.name', 'Aplikasi Kapal') }}
        </div>
    </div>

    @auth
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    @endauth

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

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

        window.toast = function (msg, icon = 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: msg,
                showConfirmButton: false,
                timer: 2600,
                timerProgressBar: true
            });
        };

        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function () {
                toast(@json(session('success')), 'success');
            });
        @endif

        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function () {
                toast(@json(session('error')), 'error');
            });
        @endif

        function confirmDelete(form, title = 'Hapus data ini?', text = 'Data yang dihapus tidak bisa dikembalikan.') {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => Swal.showLoading()
                    });
                    form.submit();
                }
            });
        }

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

        window.initAppDataTable = function(selector, options = {}) {
            const $table = $(selector);
            if (!$table.length) return null;

            const hasRows = $table.find('tbody tr').length > 0;
            if (!hasRows) return null;

            if ($.fn.DataTable.isDataTable(selector)) {
                $table.DataTable().destroy();
            }

            const defaultOptions = {
                responsive: {
                    details: {
                        type: 'column',
                        target: 0
                    }
                },
                autoWidth: false,
                scrollX: false,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    }
                }
            };

            return $table.DataTable($.extend(true, {}, defaultOptions, options));
        };

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