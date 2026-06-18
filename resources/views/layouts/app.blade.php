<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dreamella Project')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --dream: #e11d48; --ink: #111827; --soft: #f8fafc; }
        body { background: #f6f7fb; color: var(--ink); }
        .navbar-brand { font-weight: 800; letter-spacing: .2px; }
        .btn-dream { background: var(--dream); border-color: var(--dream); color: #fff; }
        .btn-dream:hover { background: #be123c; border-color: #be123c; color: #fff; }
        .hero { background: linear-gradient(135deg, #111827 0%, #be123c 58%, #f59e0b 100%); color: #fff; }
        .event-poster { min-height: 180px; background: linear-gradient(135deg, #111827, #e11d48); color: #fff; display: grid; place-items: center; text-align: center; padding: 1rem; }
        .status-badge { text-transform: uppercase; letter-spacing: .04em; font-size: .72rem; }
        .admin-shell { min-height: calc(100vh - 57px); }
        .admin-nav a { color: #334155; text-decoration: none; display: block; padding: .65rem .85rem; border-radius: .5rem; }
        .admin-nav a:hover, .admin-nav a.active { background: #ffe4e6; color: #be123c; }
        .ticket-card { border: 2px dashed #e11d48; background: #fff; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Dreamella Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}">Event</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('transactions.index') }}">Transaksi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('my-tickets.index') }}">Tiket Saya</a></li>
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endif
                @endauth
            </ul>
            <div class="d-flex gap-2 align-items-center">
                @auth
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle"></i> Profil</a>
                    <form method="post" action="{{ route('logout') }}">@csrf <button class="btn btn-outline-danger btn-sm">Logout</button></form>
                @else
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-dream btn-sm" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

@if(session('success') || session('status') || $errors->any())
    <div class="container mt-3">
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('status')) <div class="alert alert-info">{{ session('status') }}</div> @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
    </div>
@endif

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('[data-proof-preview]').forEach((input) => {
        input.addEventListener('change', () => {
            const target = document.querySelector(input.dataset.proofPreview);
            if (target && input.files[0]) target.textContent = input.files[0].name;
        });
    });
</script>
</body>
</html>
