<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dreamella Project — Sistem Informasi Pembelian Tiket Online dengan pembayaran manual terpercaya.">
    <title>@yield('title', 'Dreamella Project')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ======= GLOBAL TOKENS ======= */
        :root {
            --dream:   #e11d48;
            --dream-2: #fb7185;
            --ink:     #111827;
            --soft:    #f8fafc;
            --nav-bg:  rgba(8,12,20,.88);
            --nav-border: rgba(255,255,255,.08);
            --clr-bg:       #080c14;
            --clr-surface:  #0f172a;
            --clr-card:     rgba(255,255,255,.055);
            --clr-border:   rgba(255,255,255,.10);
            --clr-primary:  #e11d48;
            --clr-primary2: #fb7185;
            --clr-gold:     #f59e0b;
            --clr-text:     #f1f5f9;
            --clr-muted:    #94a3b8;
            --radius-xl:    1.5rem;
            --radius-lg:    1rem;
            --radius-md:    .65rem;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: #080c14;
            color: #f1f5f9;
            -webkit-font-smoothing: antialiased;
        }

        body.inner-page,
        body.admin-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at 12% 8%, rgba(225,29,72,.22), transparent 34rem),
                radial-gradient(circle at 86% 12%, rgba(245,158,11,.13), transparent 30rem),
                linear-gradient(180deg, #080c14 0%, #0f172a 46%, #080c14 100%);
            color: var(--clr-text);
        }

        body.inner-page::before,
        body.admin-page::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image: radial-gradient(rgba(255,255,255,.055) 1px, transparent 1px);
            background-size: 38px 38px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,.85), rgba(0,0,0,.25));
            z-index: -1;
        }

        /* ======= NAVBAR ======= */
        .site-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--nav-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--nav-border);
            padding: .6rem 0;
            transition: background .3s ease;
        }

        .nav-brand {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -.02em;
            text-decoration: none;
            background: linear-gradient(135deg, #fff 0%, #fb7185 60%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .brand-dot {
            width: 8px; height: 8px;
            background: var(--dream);
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
            animation: brandPulse 2s ease-in-out infinite;
        }
        @keyframes brandPulse {
            0%,100%{ box-shadow: 0 0 0 0 rgba(225,29,72,.4); }
            50%    { box-shadow: 0 0 0 6px rgba(225,29,72,0); }
        }

        .nav-link-item {
            color: rgba(255,255,255,.7) !important;
            font-size: .88rem;
            font-weight: 500;
            padding: .45rem .8rem !important;
            border-radius: .5rem;
            transition: color .2s, background .2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: .4rem;
        }
        .nav-link-item:hover,
        .nav-link-item.active {
            color: #fff !important;
            background: rgba(255,255,255,.08);
        }

        .btn-nav-outline {
            padding: .4rem 1rem;
            border-radius: .6rem;
            border: 1px solid rgba(255,255,255,.18);
            color: rgba(255,255,255,.85);
            font-size: .83rem;
            font-weight: 600;
            text-decoration: none;
            background: transparent;
            cursor: pointer;
            transition: .25s;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }
        .btn-nav-outline:hover {
            background: rgba(255,255,255,.1);
            border-color: rgba(255,255,255,.3);
            color: #fff;
        }

        .btn-nav-primary {
            padding: .4rem 1.1rem;
            border-radius: .6rem;
            background: linear-gradient(135deg, var(--dream), #be123c);
            color: #fff;
            font-size: .83rem;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: .25s;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            box-shadow: 0 4px 14px rgba(225,29,72,.35);
        }
        .btn-nav-primary:hover {
            box-shadow: 0 6px 20px rgba(225,29,72,.55);
            transform: translateY(-1px);
            color: #fff;
        }

        /* Hamburger */
        .nav-toggler {
            border: 1px solid rgba(255,255,255,.15);
            border-radius: .5rem;
            padding: .35rem .55rem;
            background: rgba(255,255,255,.06);
            color: rgba(255,255,255,.8);
            cursor: pointer;
            line-height: 1;
        }
        .nav-toggler:focus { box-shadow: none; outline: none; }

        /* Non-home pages: light background */
        body.page-light {
            background: #f6f7fb;
            color: var(--ink);
        }
        body.page-light .site-nav {
            background: rgba(255,255,255,.92);
            border-bottom: 1px solid rgba(0,0,0,.08);
        }
        body.page-light .nav-brand {
            background: linear-gradient(135deg, #111827 0%, var(--dream) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        body.page-light .nav-link-item {
            color: #334155 !important;
        }
        body.page-light .nav-link-item:hover,
        body.page-light .nav-link-item.active {
            color: var(--dream) !important;
            background: rgba(225,29,72,.07);
        }
        body.page-light .btn-nav-outline {
            border-color: rgba(0,0,0,.15);
            color: #475569;
        }
        body.page-light .btn-nav-outline:hover {
            background: rgba(0,0,0,.05);
            color: var(--ink);
        }
        body.page-light .nav-toggler {
            border-color: rgba(0,0,0,.15);
            background: rgba(0,0,0,.04);
            color: #475569;
        }

        /* ======= ALERTS ======= */
        .alert-wrap {
            position: fixed;
            top: 4.5rem;
            right: 1rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: .5rem;
            max-width: 360px;
            width: 100%;
        }
        .alert-toast {
            padding: .85rem 1.25rem;
            border-radius: .75rem;
            font-size: .88rem;
            font-weight: 500;
            display: flex;
            align-items: flex-start;
            gap: .75rem;
            box-shadow: 0 8px 30px rgba(0,0,0,.2);
            backdrop-filter: blur(12px);
            animation: slideInRight .35s ease;
        }
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }
        .alert-toast.success { background: rgba(21,128,61,.9); border: 1px solid rgba(34,197,94,.3); color:#d1fae5; }
        .alert-toast.info    { background: rgba(29,78,216,.9); border: 1px solid rgba(99,102,241,.3); color:#e0e7ff; }
        .alert-toast.danger  { background: rgba(185,28,28,.9); border: 1px solid rgba(239,68,68,.3); color:#fee2e2; }
        .alert-toast .close-btn {
            margin-left: auto;
            cursor: pointer;
            opacity: .7;
            background: none;
            border: none;
            color: inherit;
            padding: 0;
            line-height: 1;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .alert-toast .close-btn:hover { opacity: 1; }

        /* ======= LEGACY STYLES (admin, forms, etc.) ======= */
        .btn-dream  {
            background: linear-gradient(135deg, var(--dream), #be123c);
            border-color: transparent;
            color: #fff;
            font-weight: 700;
            box-shadow: 0 8px 24px rgba(225,29,72,.28);
        }
        .btn-dream:hover {
            background: linear-gradient(135deg, #fb7185, #be123c);
            border-color: transparent;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 14px 34px rgba(225,29,72,.38);
        }
        .event-poster {
            min-height: 180px;
            background:
                linear-gradient(0deg, rgba(15,23,42,.92), rgba(15,23,42,.16)),
                linear-gradient(135deg, #111827, #e11d48 55%, #f59e0b);
            color: #fff;
            display: grid;
            place-items: center;
            text-align: center;
            padding: 1rem;
            font-weight: 800;
            letter-spacing: -.01em;
        }
        .status-badge { text-transform: uppercase; letter-spacing: .04em; font-size: .72rem; }
        .admin-shell  { min-height: calc(100vh - 57px); }
        .admin-nav a  { color: rgba(241,245,249,.72); text-decoration: none; display: flex; align-items: center; gap: .55rem; padding: .7rem .85rem; border-radius: .75rem; font-size: .9rem; font-weight: 600; }
        .admin-nav a:hover, .admin-nav a.active { background: rgba(225,29,72,.14); color: #fff; }
        .ticket-card  { border: 1px dashed rgba(251,113,133,.65); background: rgba(15,23,42,.78); }
        .table td, .table th { vertical-align: middle; }

        body.inner-page a:not(.btn):not(.nav-brand):not(.nav-link-item):not(.btn-nav-outline):not(.btn-nav-primary),
        body.admin-page a:not(.btn):not(.nav-brand):not(.nav-link-item):not(.btn-nav-outline):not(.btn-nav-primary) {
            color: var(--clr-primary2);
            text-decoration: none;
        }

        body.inner-page .container.py-5,
        body.admin-page main {
            position: relative;
            z-index: 1;
        }

        body.inner-page h1,
        body.inner-page h2,
        body.inner-page h3,
        body.admin-page h1,
        body.admin-page h2,
        body.admin-page h3 {
            color: #fff;
            letter-spacing: -.02em;
        }

        body.inner-page .text-muted,
        body.admin-page .text-muted,
        body.inner-page .small.text-muted,
        body.admin-page .small.text-muted {
            color: var(--clr-muted) !important;
        }

        body.inner-page .card,
        body.admin-page .card {
            background: rgba(15,23,42,.72);
            border: 1px solid var(--clr-border) !important;
            border-radius: var(--radius-xl);
            color: var(--clr-text);
            box-shadow: 0 18px 50px rgba(0,0,0,.30) !important;
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            overflow: hidden;
        }

        body.inner-page .card-body,
        body.admin-page .card-body {
            color: var(--clr-text);
        }

        body.inner-page .bg-white,
        body.admin-page .bg-white {
            background: rgba(15,23,42,.74) !important;
            border-color: var(--clr-border) !important;
            color: var(--clr-text) !important;
        }

        body.inner-page .border,
        body.admin-page .border,
        body.admin-page .border-end,
        body.inner-page .border-bottom,
        body.admin-page .border-bottom {
            border-color: var(--clr-border) !important;
        }

        body.inner-page .form-control,
        body.inner-page .form-select,
        body.admin-page .form-control,
        body.admin-page .form-select {
            background-color: rgba(2,6,23,.56);
            border: 1px solid rgba(148,163,184,.24);
            color: var(--clr-text);
            border-radius: .8rem;
        }

        body.inner-page .form-control:focus,
        body.inner-page .form-select:focus,
        body.admin-page .form-control:focus,
        body.admin-page .form-select:focus {
            background-color: rgba(2,6,23,.76);
            border-color: rgba(251,113,133,.72);
            color: #fff;
            box-shadow: 0 0 0 .2rem rgba(225,29,72,.18);
        }

        body.inner-page .form-control::placeholder,
        body.admin-page .form-control::placeholder {
            color: rgba(148,163,184,.72);
        }

        body.inner-page .form-label,
        body.admin-page .form-label,
        body.inner-page dt,
        body.admin-page dt {
            color: rgba(241,245,249,.82);
            font-weight: 700;
        }

        body.inner-page dd,
        body.admin-page dd {
            color: rgba(241,245,249,.78);
        }

        body.inner-page .table,
        body.admin-page .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--clr-text);
            --bs-table-border-color: rgba(255,255,255,.08);
            --bs-table-striped-bg: rgba(255,255,255,.035);
            --bs-table-hover-bg: rgba(225,29,72,.075);
            color: var(--clr-text);
            margin-bottom: 0;
        }

        body.inner-page .table thead th,
        body.admin-page .table thead th {
            color: rgba(241,245,249,.72);
            background: rgba(2,6,23,.28);
            border-bottom-color: rgba(255,255,255,.10);
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        body.inner-page .accordion-item,
        body.admin-page .accordion-item {
            background: rgba(15,23,42,.72);
            border-color: var(--clr-border);
            color: var(--clr-text);
        }

        body.inner-page .accordion-button,
        body.admin-page .accordion-button {
            background: rgba(2,6,23,.38);
            color: var(--clr-text);
        }

        body.inner-page .accordion-button:not(.collapsed),
        body.admin-page .accordion-button:not(.collapsed) {
            background: rgba(225,29,72,.16);
            color: #fff;
            box-shadow: none;
        }

        body.inner-page .progress,
        body.admin-page .progress {
            background: rgba(255,255,255,.08);
        }

        body.inner-page .alert,
        body.admin-page .alert {
            border-radius: var(--radius-lg);
            border: 1px solid var(--clr-border);
        }

        body.inner-page .page-link,
        body.admin-page .page-link {
            background: rgba(15,23,42,.76);
            border-color: var(--clr-border);
            color: var(--clr-primary2);
        }

        body.inner-page .active > .page-link,
        body.admin-page .active > .page-link {
            background: var(--dream);
            border-color: var(--dream);
            color: #fff;
        }

        body.inner-page .btn-outline-secondary,
        body.admin-page .btn-outline-secondary {
            border-color: rgba(148,163,184,.34);
            color: rgba(241,245,249,.82);
        }

        body.inner-page .btn-outline-secondary:hover,
        body.admin-page .btn-outline-secondary:hover {
            background: rgba(255,255,255,.08);
            border-color: rgba(241,245,249,.34);
            color: #fff;
        }

        .page-hero {
            position: relative;
            padding: 4.5rem 0 2.5rem;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(225,29,72,.22), transparent 70%);
            top: -110px;
            right: -70px;
            pointer-events: none;
        }

        .page-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .32rem .9rem;
            border-radius: 999px;
            background: rgba(225,29,72,.13);
            border: 1px solid rgba(225,29,72,.28);
            color: var(--clr-primary2);
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .09em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .page-title {
            font-size: clamp(2rem, 4vw, 3.25rem);
            font-weight: 900;
            line-height: 1.1;
        }

        .page-subtitle {
            color: var(--clr-muted);
            max-width: 620px;
            font-size: 1rem;
            line-height: 1.7;
        }

        .glass-panel {
            background: rgba(15,23,42,.72);
            border: 1px solid var(--clr-border);
            border-radius: var(--radius-xl);
            box-shadow: 0 18px 50px rgba(0,0,0,.30);
            backdrop-filter: blur(18px);
        }

        .section-card-grid .card {
            transition: .25s ease;
        }

        .section-card-grid .card:hover {
            transform: translateY(-5px);
            border-color: rgba(225,29,72,.34) !important;
            box-shadow: 0 24px 64px rgba(0,0,0,.36) !important;
        }

        body.admin-page .admin-shell {
            background: transparent;
        }

        body.admin-page .admin-sidebar {
            position: sticky;
            top: 4.3rem;
            height: calc(100vh - 4.3rem);
            background: rgba(15,23,42,.78) !important;
            border-right: 1px solid var(--clr-border) !important;
            backdrop-filter: blur(18px);
        }

        body.admin-page .admin-sidebar-title {
            color: #fff;
            font-weight: 900;
            letter-spacing: -.02em;
        }

        @media (max-width: 991px) {
            body.admin-page .admin-sidebar {
                position: relative;
                top: 0;
                height: auto;
            }
        }
    </style>

    @stack('styles')
</head>
@php
    $defaultBodyClass = request()->routeIs('admin.*') ? 'admin-page' : (request()->routeIs('home') ? 'home-page' : 'inner-page');
    $bodyClass = trim($__env->yieldContent('body_class', $defaultBodyClass));
@endphp
<body class="{{ $bodyClass }}">

<!-- ══════ NAVBAR ══════ -->
<nav class="site-nav" id="siteNav">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between gap-3">

            <!-- Brand -->
            <a class="nav-brand" href="{{ route('home') }}" id="nav-brand">
                <span class="brand-dot"></span>
                Dreamella Project
            </a>

            <!-- Mobile toggle -->
            <button class="nav-toggler d-lg-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list" style="font-size:1.3rem;"></i>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="mainNav">
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-1 gap-lg-1 mt-3 mt-lg-0 flex-grow-1">
                    <a class="nav-link-item" href="{{ route('events.index') }}" id="nav-events">
                        <i class="bi bi-calendar-event"></i> Event
                    </a>
                    @auth
                        <a class="nav-link-item" href="{{ route('transactions.index') }}" id="nav-transactions">
                            <i class="bi bi-receipt"></i> Transaksi
                        </a>
                        <a class="nav-link-item" href="{{ route('my-tickets.index') }}" id="nav-tickets">
                            <i class="bi bi-ticket-perforated"></i> Tiket Saya
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a class="nav-link-item" href="{{ route('admin.dashboard') }}" id="nav-admin">
                                <i class="bi bi-shield-check"></i> Admin
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Auth buttons -->
                <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-2 mt-3 mt-lg-0">
                    @auth
                        <a class="btn-nav-outline" href="{{ route('profile.edit') }}" id="nav-profile">
                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name }}
                        </a>
                        <form method="post" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button class="btn-nav-outline" id="nav-logout" style="border-color:rgba(225,29,72,.35);color:#fb7185;">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    @else
                        <a class="btn-nav-outline" href="{{ route('login') }}" id="nav-login">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </a>
                        <a class="btn-nav-primary" href="{{ route('register') }}" id="nav-register">
                            <i class="bi bi-person-plus-fill"></i> Daftar
                        </a>
                    @endauth
                </div>
            </div>

        </div>
    </div>
</nav>

<!-- ══════ TOAST ALERTS ══════ -->
@if(session('success') || session('status') || $errors->any())
<div class="alert-wrap" id="alertWrap">
    @if(session('success'))
    <div class="alert-toast success">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
        <button class="close-btn" onclick="this.closest('.alert-toast').remove()"><i class="bi bi-x-lg"></i></button>
    </div>
    @endif
    @if(session('status'))
    <div class="alert-toast info">
        <i class="bi bi-info-circle-fill"></i>
        <span>{{ session('status') }}</span>
        <button class="close-btn" onclick="this.closest('.alert-toast').remove()"><i class="bi bi-x-lg"></i></button>
    </div>
    @endif
    @if($errors->any())
    <div class="alert-toast danger">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>{{ $errors->first() }}@if($errors->count() > 1) &amp; {{ $errors->count()-1 }} kesalahan lainnya.@endif</span>
        <button class="close-btn" onclick="this.closest('.alert-toast').remove()"><i class="bi bi-x-lg"></i></button>
    </div>
    @endif
</div>
@endif

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-dismiss toasts after 5s
    setTimeout(() => {
        document.querySelectorAll('.alert-toast').forEach(el => {
            el.style.transition = 'opacity .4s, transform .4s';
            el.style.opacity = '0';
            el.style.transform = 'translateX(100%)';
            setTimeout(() => el.remove(), 400);
        });
    }, 5000);

    // File upload preview
    document.querySelectorAll('[data-proof-preview]').forEach((input) => {
        input.addEventListener('change', () => {
            const target = document.querySelector(input.dataset.proofPreview);
            if (target && input.files[0]) target.textContent = input.files[0].name;
        });
    });

    // Mark active nav link
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link-item').forEach(link => {
        if (link.getAttribute('href') && currentPath.startsWith(new URL(link.href).pathname) && link.getAttribute('href') !== '/') {
            link.classList.add('active');
        }
    });
</script>
@stack('scripts')
</body>
</html>
