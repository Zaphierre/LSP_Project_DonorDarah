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
            box-shadow: 0 2px 12px rgba(0,0,0,.08), 0 1px 3px rgba(0,0,0,.06);
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
        tbody td { padding: .85rem 1rem; border-bottom: 1px solid var(--border); vertical-align: middle; color: var(--text); }
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
            box-shadow: 0 2px 12px rgba(0,0,0,.08), 0 1px 3px rgba(0,0,0,.06);
            transition: box-shadow .2s, transform .2s;
        }
        .stat-card:hover {
            box-shadow: 0 8px 28px rgba(0,0,0,.12);
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
            border-top: 1px solid var(--border);
            background: #fff;
            margin-top: auto;
        }

        /* ── Footer responsive grid ─────────────────────────────────── */
        @media(max-width: 768px) {
            footer > div:first-child {
                grid-template-columns: 1fr !important;
            }
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
        <a href="{{ route('home') }}" class="navbar-brand" style="gap:.6rem;">
            <svg width="38" height="38" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="23" cy="23" r="23" fill="#CC0000"/>
                <rect x="19" y="11" width="8" height="24" rx="4" fill="white"/>
                <rect x="11" y="19" width="24" height="8" rx="4" fill="white"/>
            </svg>
            <div style="line-height:1.1;">
                <div style="font-size:.95rem;font-weight:800;color:#CC0000;letter-spacing:-.01em;">PMI Kota Palembang</div>
                <div style="font-size:.68rem;font-weight:500;color:#64748B;">Palang Merah Indonesia</div>
            </div>
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

    {{-- Footer (Upgraded — matches Landing Page style) --}}
    <footer style="background:#fff;border-top:1px solid #E2E8F0;margin-top:auto;">
        <div style="max-width:1280px;margin:0 auto;padding:2.5rem 1.5rem 1.5rem;display:grid;grid-template-columns:1.5fr 1fr 1fr;gap:2rem;">

            {{-- Brand & Contact --}}
            <div>
                <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.75rem;text-decoration:none;margin-bottom:1rem;">
                    <svg width="38" height="38" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="23" cy="23" r="23" fill="#CC0000"/>
                        <rect x="19" y="11" width="8" height="24" rx="4" fill="white"/>
                        <rect x="11" y="19" width="24" height="8" rx="4" fill="white"/>
                    </svg>
                    <div>
                        <div style="font-size:.95rem;font-weight:800;color:#CC0000;">PMI Kota Palembang</div>
                        <div style="font-size:.7rem;color:#64748B;">Palang Merah Indonesia</div>
                    </div>
                </a>
                <p style="font-size:.8rem;color:#64748B;line-height:1.7;margin-bottom:.75rem;">
                    Sistem pendaftaran jadwal donor darah online PMI Kota Palembang.
                </p>
                <div style="font-size:.8rem;color:#64748B;display:flex;flex-direction:column;gap:.4rem;">
                    <span>📍 Jl. Merdeka No. 1, Ilir Timur I, Palembang</span>
                    <span>📞 (0711) 123-456</span>
                    <span>📧 info@pmi-palembang.org</span>
                    <span>🕐 Senin–Sabtu: 08.00–16.00 WIB</span>
                </div>
            </div>

            {{-- Navigasi --}}
            <div>
                <p style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#0F172A;margin-bottom:.85rem;">Navigasi</p>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:.5rem;">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <li><a href="{{ route('admin.dashboard') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;" onmouseover="this.style.color='#CC0000'" onmouseout="this.style.color='#64748B'">Dashboard Admin</a></li>
                        @else
                            <li><a href="{{ route('donor.dashboard') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;" onmouseover="this.style.color='#CC0000'" onmouseout="this.style.color='#64748B'">Dashboard</a></li>
                            <li><a href="{{ route('donor.schedules') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;" onmouseover="this.style.color='#CC0000'" onmouseout="this.style.color='#64748B'">Jadwal Donor</a></li>
                            <li><a href="{{ route('donor.announcements') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;" onmouseover="this.style.color='#CC0000'" onmouseout="this.style.color='#64748B'">Pengumuman</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('home') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;" onmouseover="this.style.color='#CC0000'" onmouseout="this.style.color='#64748B'">Beranda</a></li>
                        <li><a href="{{ route('login') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;" onmouseover="this.style.color='#CC0000'" onmouseout="this.style.color='#64748B'">Login Pendonor</a></li>
                        <li><a href="{{ route('register') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;" onmouseover="this.style.color='#CC0000'" onmouseout="this.style.color='#64748B'">Daftar Pendonor</a></li>
                    @endauth
                </ul>
            </div>

            {{-- Kontak & Darurat --}}
            <div>
                <p style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#0F172A;margin-bottom:.85rem;">Layanan Darurat</p>
                <a href="tel:118"
                   style="display:inline-flex;align-items:center;gap:.5rem;background:#CC0000;color:#fff;font-weight:700;font-size:.85rem;padding:.5rem 1rem;border-radius:8px;text-decoration:none;margin-bottom:1rem;transition:background .2s;"
                   onmouseover="this.style.background='#990000'" onmouseout="this.style.background='#CC0000'">🚑 Ambulans: 118</a>
                <p style="font-size:.75rem;color:#64748B;margin-top:.5rem;">Layanan 24 jam · Gratis untuk warga Palembang</p>
                {{-- Social links --}}
                <div style="display:flex;gap:.5rem;margin-top:1rem;">
                    <a href="#" title="Facebook" style="width:36px;height:36px;border-radius:8px;background:#f1f5f9;border:1px solid #E2E8F0;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#FFF5F5';this.style.borderColor='#FCA5A5'" onmouseout="this.style.background='#f1f5f9';this.style.borderColor='#E2E8F0'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" title="Instagram" style="width:36px;height:36px;border-radius:8px;background:#f1f5f9;border:1px solid #E2E8F0;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#FFF5F5';this.style.borderColor='#FCA5A5'" onmouseout="this.style.background='#f1f5f9';this.style.borderColor='#E2E8F0'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="url(#ig2)"><defs><linearGradient id="ig2" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" style="stop-color:#f09433"/><stop offset="100%" style="stop-color:#bc1888"/></linearGradient></defs><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" title="WhatsApp" style="width:36px;height:36px;border-radius:8px;background:#f1f5f9;border:1px solid #E2E8F0;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#FFF5F5';this.style.borderColor='#FCA5A5'" onmouseout="this.style.background='#f1f5f9';this.style.borderColor='#E2E8F0'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#25D366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div style="border-top:1px solid #E2E8F0;padding:1rem 1.5rem;max-width:1280px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
            <span style="font-size:.78rem;color:#64748B;">© {{ date('Y') }} PMI Kota Palembang. Semua hak dilindungi.</span>
            <span style="font-size:.78rem;color:#64748B;">Setetes darah, sejuta harapan 🩸</span>
        </div>
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
