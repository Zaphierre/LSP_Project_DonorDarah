<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem pendaftaran jadwal donor darah online - mudah, cepat, dan terorganisir">
    <title>@yield('title', 'DonorHub') — Sistem Donor Darah</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        /* ══════════════════════════════════════════════════════════
           CSS VARIABLES — Light Theme (White & Red)
           Previously dark (#0f172a). Now clean white + red accents.
           ══════════════════════════════════════════════════════════ */
        :root {
            --red-primary:  #CC0000;
            --red-dark:     #990000;
            --red-light:    #EF4444;
            --red-50:       #FFF5F5;
            --red-100:      #FED7D7;

            /* Light theme backgrounds */
            --bg:           #F8FAFC;
            --bg-card:      #FFFFFF;
            --bg-card2:     #F1F5F9;

            /* Light theme borders */
            --border:       #E2E8F0;
            --border-light: #F1F5F9;

            /* Light theme text */
            --text:         #0F172A;
            --text-muted:   #64748B;
            --text-subtle:  #94A3B8;

            /* Status colors */
            --success:  #10B981;
            --warning:  #F59E0B;
            --danger:   #EF4444;
            --info:     #3B82F6;

            --radius: 12px;
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar (Light Theme) ──────────────────────────────────── */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            padding: .9rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text);
        }

        /* PMI logo mark in navbar */
        .navbar-brand .brand-logo {
            width: 36px; height: 36px;
            background: var(--red-primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .navbar-brand .brand-logo svg { display: block; }

        /* Pulsing live dot */
        .navbar-brand .dot {
            width: 8px; height: 8px;
            background: var(--red-primary);
            border-radius: 50%;
            animation: dotPulse 1.8s infinite;
            flex-shrink: 0;
        }

        @keyframes dotPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(204, 62, 62, .4); }
            50%       { box-shadow: 0 0 0 7px rgba(204, 62, 62, 0); }
        }

        .nav-links { display: flex; align-items: center; gap: .5rem; }

        .nav-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            padding: .5rem .85rem;
            border-radius: 8px;
            transition: all .2s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--red-primary);
            background: var(--red-50);
        }

        /* ── Buttons ────────────────────────────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .55rem 1.2rem; border-radius: 8px;
            font-weight: 600; font-size: .875rem;
            text-decoration: none; border: none;
            cursor: pointer; transition: all .2s;
            font-family: inherit;
        }
        .btn-primary  { background: var(--red-primary); color: #fff; }
        .btn-primary:hover { background: var(--red-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(204,0,0,.3); }
        .btn-secondary { background: var(--bg-card2); color: var(--text); border: 1px solid var(--border); }
        .btn-secondary:hover { background: var(--border); }
        .btn-success  { background: var(--success); color: #fff; }
        .btn-success:hover  { filter: brightness(1.1); }
        .btn-danger   { background: var(--danger);  color: #fff; }
        .btn-danger:hover   { filter: brightness(1.1); }
        .btn-warning  { background: var(--warning); color: #1a1a1a; }
        .btn-sm { padding: .35rem .75rem; font-size: .8rem; }
        .btn-lg { padding: .75rem 1.75rem; font-size: 1rem; }

        /* ── Main Content ──────────────────────────────────────────── */
        .main { flex: 1; padding: 2rem 1.5rem; max-width: 1280px; margin: 0 auto; width: 100%; }

        /* ── Cards (Light Theme) ───────────────────────────────────── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: 0 1px 8px rgba(0,0,0,.06);
        }
        .card-header { margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border); }
        .card-header h2 { font-size: 1.1rem; font-weight: 700; color: var(--text); }
        .card-header p  { font-size: .85rem; color: var(--text-muted); margin-top: .25rem; }

        /* ── Badges ─────────────────────────────────────────────────── */
        .badge { display: inline-flex; align-items: center; padding: .25rem .65rem; border-radius: 99px; font-size: .75rem; font-weight: 600; }
        .badge-pending  { background: rgba(245,158,11,.12); color: #B45309; }
        .badge-diterima { background: rgba(16,185,129,.12); color: #065F46; }
        .badge-ditolak  { background: rgba(239,68,68,.12);  color: #991B1B; }
        .badge-aktif    { background: rgba(16,185,129,.12); color: #065F46; }
        .badge-admin    { background: rgba(59,130,246,.12); color: #1E40AF; }

        /* ── Alerts ─────────────────────────────────────────────────── */
        .alert { padding: .85rem 1.25rem; border-radius: 10px; font-size: .875rem; margin-bottom: 1.25rem; display: flex; align-items: flex-start; gap: .75rem; }
        .alert-success { background: rgba(16,185,129,.08);  border: 1px solid rgba(16,185,129,.25); color: #065F46; }
        .alert-error   { background: rgba(239,68,68,.08);   border: 1px solid rgba(239,68,68,.25);  color: #991B1B; }
        .alert-warning { background: rgba(245,158,11,.08);  border: 1px solid rgba(245,158,11,.25); color: #92400E; }
        .alert-info    { background: rgba(59,130,246,.08);  border: 1px solid rgba(59,130,246,.25); color: #1E40AF; }

        /* ── Forms (Light Theme) ───────────────────────────────────── */
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: .875rem; font-weight: 600; margin-bottom: .45rem; color: var(--text); }
        .form-control {
            width: 100%;
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            padding: .65rem 1rem;
            font-size: .9rem;
            font-family: inherit;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control::placeholder { color: var(--text-subtle); }
        .form-control:focus { outline: none; border-color: var(--red-primary); box-shadow: 0 0 0 3px rgba(204,0,0,.12); }
        .form-error { color: var(--danger); font-size: .8rem; margin-top: .3rem; }
        select.form-control { cursor: pointer; background-color: #fff; }
        textarea.form-control { resize: vertical; min-height: 100px; }

        /* ── Tables (Light Theme) ──────────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        thead th {
            background: var(--bg);
            padding: .75rem 1rem;
            text-align: left;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            font-weight: 700;
        }
        tbody td { padding: .85rem 1rem; border-bottom: 1px solid var(--border-light); vertical-align: middle; color: var(--text); }
        tbody tr:hover { background: var(--bg-card2); }
        tbody tr:last-child td { border-bottom: none; }

        /* ── Grid ───────────────────────────────────────────────────── */
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; }

        @media(max-width:768px) {
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .nav-links { gap: .25rem; }
            .nav-link { padding: .4rem .6rem; font-size: .8rem; }
        }

        /* ── Sidebar Layout ─────────────────────────────────────────── */
        .layout { display: flex; gap: 1.5rem; align-items: flex-start; }
        .sidebar { width: 240px; flex-shrink: 0; }
        .sidebar-nav { display: flex; flex-direction: column; gap: .25rem; }
        .sidebar-link {
            display: flex; align-items: center; gap: .65rem;
            padding: .65rem 1rem; border-radius: 10px;
            color: var(--text-muted); text-decoration: none;
            font-size: .875rem; font-weight: 500;
            transition: all .2s;
        }
        .sidebar-link:hover {
            color: var(--red-primary);
            background: var(--red-50);
        }
        .sidebar-link.active {
            color: var(--red-primary);
            background: rgba(204, 0, 0, 0.08);
            font-weight: 600;
        }
        .sidebar-icon { font-size: 1rem; }
        .content-area { flex: 1; min-width: 0; }

        @media(max-width:900px) {
            .layout { flex-direction: column; }
            .sidebar { width: 100%; }
            .sidebar-nav { flex-direction: row; flex-wrap: wrap; }
        }

        /* ── Stat Cards (Light Theme) ──────────────────────────────── */
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            display: flex; align-items: center; gap: 1rem;
            box-shadow: 0 1px 8px rgba(0,0,0,.05);
            transition: box-shadow .2s, transform .2s;
        }
        .stat-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,.1);
            transform: translateY(-2px);
        }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; flex-shrink: 0;
        }
        .stat-icon.red    { background: rgba(204, 0, 0, 0.10);   }
        .stat-icon.green  { background: rgba(16,185,129,.12);     }
        .stat-icon.blue   { background: rgba(59,130,246,.12);     }
        .stat-icon.yellow { background: rgba(245,158,11,.12);     }
        .stat-value { font-size: 2rem; font-weight: 800; line-height: 1; color: var(--text); }
        .stat-label { font-size: .8rem; color: var(--text-muted); margin-top: .3rem; font-weight: 500; }

        /* ── Footer (Light Theme) ──────────────────────────────────── */
        footer {
            text-align: center;
            padding: 1.5rem;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: .8rem;
            background: #fff;
            margin-top: auto;
        }

        /* ── Page Header ────────────────────────────────────────────── */
        .page-header {
            margin-bottom: 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
        }
        .page-header h1 { font-size: 1.5rem; font-weight: 800; color: var(--text); }
        .page-header p  { font-size: .875rem; color: var(--text-muted); margin-top: .25rem; }

        /* ── Pagination ─────────────────────────────────────────────── */
        .pagination { display: flex; gap: .4rem; margin-top: 1.25rem; justify-content: center; }
        .pagination a, .pagination span {
            padding: .4rem .75rem; border-radius: 8px;
            font-size: .85rem; text-decoration: none;
            border: 1px solid var(--border);
            color: var(--text-muted);
            background: #fff;
        }
        .pagination .active span { background: var(--red-primary); border-color: var(--red-primary); color: #fff; }

        /* ── Divider ────────────────────────────────────────────────── */
        hr.divider { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }

        /* ── Profile avatar ring ────────────────────────────────────── */
        .avatar-ring {
            ring: 3px solid rgba(204,0,0,.2);
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- ── Navbar (Light Theme) ─────────────────────────────────────── --}}
    <nav class="navbar">
        {{-- Brand --}}
        <a href="{{ route('home') }}" class="navbar-brand">
            <div class="brand-logo">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <rect x="9" y="2" width="4" height="18" rx="2" fill="white"/>
                    <rect x="2" y="9" width="18" height="4" rx="2" fill="white"/>
                </svg>
            </div>
            <span>DonorHub</span>
            <span class="dot" title="Online"></span>
        </a>

        {{-- Nav Links --}}
        <div class="nav-links">
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">Dashboard Admin</a>
                @else
                    <a href="{{ route('donor.dashboard') }}" class="nav-link {{ request()->is('donor/dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('donor.schedules') }}" class="nav-link {{ request()->is('donor/jadwal') ? 'active' : '' }}">Jadwal</a>
                    <a href="{{ route('donor.announcements') }}" class="nav-link {{ request()->is('donor/pengumuman') ? 'active' : '' }}">Pengumuman</a>
                @endif
                <span style="color:var(--text-muted);font-size:.8rem;padding:.5rem .75rem;font-weight:500;">
                    {{ Auth::user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Keluar</button>
                </form>
            @else
                <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
            @endauth
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;width:100%;">
        @if(session('success'))
            <div class="alert alert-success" style="margin-top:1rem;">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error" style="margin-top:1rem;">❌ {{ session('error') }}</div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning" style="margin-top:1rem;">⚠️ {{ session('warning') }}</div>
        @endif
    </div>

    {{-- Content --}}
    <main class="main">
        @yield('content')
    </main>

    {{-- Footer (Light Theme) --}}
    <footer>
        <p style="display:flex;align-items:center;justify-content:center;gap:.5rem;">
            <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                <circle cx="10" cy="10" r="10" fill="#CC0000"/>
                <rect x="8.5" y="4" width="3" height="12" rx="1.5" fill="white"/>
                <rect x="4" y="8.5" width="12" height="3" rx="1.5" fill="white"/>
            </svg>
            © {{ date('Y') }} DonorHub — Sistem Pendaftaran Jadwal Donor Darah. Setetes darah, sejuta harapan. 🩸
        </p>
    </footer>

    {{-- AOS Library --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 650,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50,
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
