<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — DonorHub Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --red-primary: #e53e3e; --red-dark: #c53030; --red-light: #fc8181;
            --bg: #0f172a; --bg-card: #1e293b; --bg-card2: #273347; --border: #334155;
            --text: #f1f5f9; --text-muted: #94a3b8; --text-subtle: #64748b;
            --success: #10b981; --warning: #f59e0b; --danger: #ef4444; --info: #3b82f6;
            --sidebar-w: 260px; --radius: 12px; --shadow: 0 4px 24px rgba(0,0,0,.4);
        }
        html { scroll-behavior: smooth; }
        body { font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; display:flex; }

        /* ── Sidebar ─────────────────────────────────── */
        .admin-sidebar {
            width: var(--sidebar-w); min-height:100vh; background:var(--bg-card);
            border-right:1px solid var(--border); display:flex; flex-direction:column;
            position:fixed; top:0; left:0; z-index:50;
        }
        .admin-sidebar-brand {
            padding:1.5rem; border-bottom:1px solid var(--border);
            display:flex; align-items:center; gap:.6rem;
            font-weight:800; font-size:1.15rem; text-decoration:none; color:var(--text);
        }
        .admin-sidebar-brand .dot { width:10px;height:10px;background:var(--red-primary);border-radius:50%; animation:pulse 1.8s infinite; }
        @keyframes pulse { 0%,100%{box-shadow:0 0 0 0 rgba(229,62,62,.4);} 50%{box-shadow:0 0 0 8px rgba(229,62,62,0);} }
        .admin-sidebar-badge { font-size:.65rem;background:rgba(229,62,62,.15);color:var(--red-light);border:1px solid rgba(229,62,62,.3);border-radius:4px;padding:.15rem .4rem;font-weight:700; }
        .sidebar-section { padding:.75rem 1rem .4rem; font-size:.65rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--text-subtle); }
        .admin-nav-link {
            display:flex; align-items:center; gap:.65rem; margin:.15rem .75rem;
            padding:.65rem .85rem; border-radius:10px; color:var(--text-muted);
            text-decoration:none; font-size:.875rem; font-weight:500; transition:all .2s;
        }
        .admin-nav-link:hover { color:var(--text); background:var(--bg-card2); }
        .admin-nav-link.active { color:var(--red-light); background:rgba(229,62,62,.1); }
        .admin-nav-icon { font-size:1rem; }
        .sidebar-bottom { margin-top:auto; padding:1rem; border-top:1px solid var(--border); }
        .sidebar-user { display:flex; align-items:center; gap:.75rem; margin-bottom:.75rem; }
        .sidebar-avatar { width:36px;height:36px;border-radius:50%;background:var(--red-primary);display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0; }
        .sidebar-user-info p:first-child { font-size:.85rem;font-weight:600; }
        .sidebar-user-info p:last-child  { font-size:.75rem;color:var(--text-muted); }

        /* ── Main Content ─────────────────────────────── */
        .admin-main { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; min-height:100vh; }
        .admin-topbar {
            padding:.9rem 1.75rem; border-bottom:1px solid var(--border);
            display:flex; align-items:center; justify-content:space-between;
            background:rgba(15,23,42,.9); backdrop-filter:blur(16px); position:sticky; top:0; z-index:40;
        }
        .admin-topbar h1 { font-size:1.1rem; font-weight:700; }
        .admin-topbar p  { font-size:.8rem; color:var(--text-muted); margin-top:.1rem; }
        .admin-content { padding:1.75rem; flex:1; }

        /* ── Cards & Buttons ────────────────────────── */
        .card { background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius); padding:1.5rem; }
        .card-header { margin-bottom:1.25rem; padding-bottom:1rem; border-bottom:1px solid var(--border); display:flex;justify-content:space-between;align-items:center; }
        .card-header h2 { font-size:1rem; font-weight:700; }
        .card-header p  { font-size:.8rem; color:var(--text-muted); margin-top:.2rem; }
        .btn { display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.2rem;border-radius:8px;font-weight:600;font-size:.875rem;text-decoration:none;border:none;cursor:pointer;transition:all .2s; }
        .btn-primary { background:var(--red-primary); color:#fff; }
        .btn-primary:hover { background:var(--red-dark); transform:translateY(-1px); box-shadow:0 4px 12px rgba(229,62,62,.4); }
        .btn-secondary { background:var(--bg-card2); color:var(--text); border:1px solid var(--border); }
        .btn-secondary:hover { background:var(--border); }
        .btn-success { background:var(--success); color:#fff; }
        .btn-success:hover { filter:brightness(1.1); }
        .btn-danger { background:var(--danger); color:#fff; }
        .btn-danger:hover { filter:brightness(1.1); }
        .btn-warning { background:var(--warning); color:#1a1a1a; }
        .btn-sm { padding:.35rem .75rem; font-size:.8rem; }
        .btn-lg { padding:.75rem 1.75rem; font-size:1rem; }

        /* ── Badges ──────────────────────────────────── */
        .badge { display:inline-flex;align-items:center;padding:.25rem .65rem;border-radius:99px;font-size:.75rem;font-weight:600; }
        .badge-pending  { background:rgba(245,158,11,.15); color:var(--warning); }
        .badge-diterima { background:rgba(16,185,129,.15); color:var(--success); }
        .badge-ditolak  { background:rgba(239,68,68,.15);  color:var(--danger);  }
        .badge-aktif    { background:rgba(16,185,129,.15); color:var(--success); }
        .badge-admin    { background:rgba(59,130,246,.15); color:var(--info);    }

        /* ── Alerts ──────────────────────────────────── */
        .alert { padding:.85rem 1.25rem; border-radius:10px; font-size:.875rem; margin-bottom:1.25rem; display:flex;align-items:flex-start;gap:.75rem; }
        .alert-success { background:rgba(16,185,129,.12); border:1px solid rgba(16,185,129,.3); color:#6ee7b7; }
        .alert-error   { background:rgba(239,68,68,.12);  border:1px solid rgba(239,68,68,.3);  color:#fca5a5; }

        /* ── Forms ──────────────────────────────────── */
        .form-group { margin-bottom:1.25rem; }
        .form-label { display:block; font-size:.875rem; font-weight:600; margin-bottom:.45rem; color:var(--text-muted); }
        .form-control {
            width:100%; background:var(--bg); border:1.5px solid var(--border); border-radius:8px;
            color:var(--text); padding:.65rem 1rem; font-size:.9rem; font-family:inherit; transition:all .2s;
        }
        .form-control:focus { outline:none; border-color:var(--red-primary); box-shadow:0 0 0 3px rgba(229,62,62,.2); }
        select.form-control { cursor:pointer; }
        textarea.form-control { resize:vertical; min-height:100px; }

        /* ── Tables ─────────────────────────────────── */
        .table-wrap { overflow-x:auto; }
        table { width:100%; border-collapse:collapse; font-size:.875rem; }
        thead th { background:var(--bg); padding:.75rem 1rem; text-align:left; font-size:.75rem; text-transform:uppercase; letter-spacing:.05em; color:var(--text-muted); border-bottom:1px solid var(--border); }
        tbody td { padding:.85rem 1rem; border-bottom:1px solid var(--border); vertical-align:middle; }
        tbody tr:hover { background:var(--bg-card2); }
        tbody tr:last-child td { border-bottom:none; }

        /* ── Grid ─────────────────────────────────────── */
        .grid-2 { display:grid; grid-template-columns:repeat(2,1fr); gap:1.25rem; }
        .grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:1.25rem; }
        .grid-4 { display:grid; grid-template-columns:repeat(4,1fr); gap:1.25rem; }
        @media(max-width:768px) { .grid-2,.grid-3,.grid-4 { grid-template-columns:1fr; } }

        /* ── Stat Cards ─────────────────────────────── */
        .stat-card { background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius); padding:1.25rem; display:flex;align-items:center;gap:1rem; }
        .stat-icon { width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0; }
        .stat-icon.red    { background:rgba(229,62,62,.15);   }
        .stat-icon.green  { background:rgba(16,185,129,.15);  }
        .stat-icon.blue   { background:rgba(59,130,246,.15);  }
        .stat-icon.yellow { background:rgba(245,158,11,.15);  }
        .stat-value { font-size:1.8rem; font-weight:800; line-height:1; }
        .stat-label { font-size:.8rem; color:var(--text-muted); margin-top:.25rem; }

        /* ── Page Header ─────────────────────────────── */
        .page-header { margin-bottom:1.75rem; display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem; }
        .page-header h1 { font-size:1.4rem; font-weight:800; }
        .page-header p  { font-size:.85rem; color:var(--text-muted); margin-top:.2rem; }

        /* ── Misc ────────────────────────────────────── */
        hr.divider { border:none; border-top:1px solid var(--border); margin:1.5rem 0; }

        @media(max-width:900px) {
            .admin-sidebar { transform:translateX(-100%); }
            .admin-main { margin-left:0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Admin Sidebar --}}
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand">
            <span class="dot"></span>
            DonorHub
            <span class="admin-sidebar-badge">ADMIN</span>
        </a>

        <div class="sidebar-section">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <span class="admin-nav-icon">📊</span> Dashboard
        </a>

        <div class="sidebar-section">Verifikasi</div>
        <a href="{{ route('admin.users.index') }}" class="admin-nav-link {{ request()->is('admin/pendonor*') ? 'active' : '' }}">
            <span class="admin-nav-icon">👥</span> Verifikasi Akun
        </a>
        <a href="{{ route('admin.registrations.index') }}" class="admin-nav-link {{ request()->is('admin/registrasi*') ? 'active' : '' }}">
            <span class="admin-nav-icon">📋</span> Verifikasi Jadwal
        </a>
        <a href="{{ route('admin.payments.index') }}" class="admin-nav-link {{ request()->is('admin/pembayaran*') ? 'active' : '' }}">
            <span class="admin-nav-icon">💳</span> Verifikasi Pembayaran
        </a>

        <div class="sidebar-section">Kelola</div>
        <a href="{{ route('admin.schedules') }}" class="admin-nav-link {{ request()->is('admin/jadwal*') ? 'active' : '' }}">
            <span class="admin-nav-icon">🗓️</span> Kelola Jadwal
        </a>
        <a href="{{ route('admin.announcements.index') }}" class="admin-nav-link {{ request()->is('admin/pengumuman*') ? 'active' : '' }}">
            <span class="admin-nav-icon">📢</span> Pengumuman
        </a>

        <div class="sidebar-bottom">
            <div class="sidebar-user">
                <div class="sidebar-avatar">👤</div>
                <div class="sidebar-user-info">
                    <p>{{ Auth::user()->name }}</p>
                    <p>Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm" style="width:100%;justify-content:center;">🚪 Logout</button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="admin-main">
        <div class="admin-topbar">
            <div>
                <h1>@yield('page-title', 'Dashboard')</h1>
                <p>@yield('page-subtitle', 'Panel administrasi DonorHub')</p>
            </div>
            <div style="display:flex;gap:.5rem;align-items:center;">
                <span class="badge badge-admin">Admin</span>
            </div>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
