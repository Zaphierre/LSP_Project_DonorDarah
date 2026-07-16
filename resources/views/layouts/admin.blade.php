<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — PMI Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --red-primary:#CC0000; --red-dark:#990000; --red-50:#FFF5F5;
            --bg:#F8FAFC; --bg-card:#fff; --bg-card2:#F8FAFC; --border:#E2E8F0;
            --text:#0F172A; --text-muted:#64748B; --text-subtle:#94A3B8;
            --success:#10b981; --warning:#f59e0b; --danger:#ef4444; --info:#3b82f6;
            --sidebar-w:260px; --radius:12px;
            --shadow:0 2px 12px rgba(0,0,0,.07),0 1px 3px rgba(0,0,0,.04);
        }
        html{scroll-behavior:smooth;}
        body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;}
        .admin-sidebar{width:var(--sidebar-w);min-height:100vh;background:#fff;border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;left:0;z-index:50;}
        .admin-sidebar-brand{padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.6rem;text-decoration:none;}
        .admin-sidebar-badge{font-size:.6rem;background:rgba(204,0,0,.1);color:var(--red-primary);border:1px solid rgba(204,0,0,.2);border-radius:4px;padding:.15rem .45rem;font-weight:700;margin-left:auto;}
        .sidebar-section{padding:.85rem 1.25rem .3rem;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text-subtle);}
        .admin-nav-link{display:flex;align-items:center;gap:.65rem;margin:.1rem .75rem;padding:.65rem .85rem;border-radius:10px;color:var(--text-muted);text-decoration:none;font-size:.875rem;font-weight:500;transition:all .2s;}
        .admin-nav-link:hover{color:var(--red-primary);background:var(--red-50);}
        .admin-nav-link.active{color:var(--red-primary);background:rgba(204,0,0,.08);font-weight:600;}
        .admin-nav-icon{font-size:1rem;}
        .sidebar-bottom{margin-top:auto;padding:1rem;border-top:1px solid var(--border);}
        .sidebar-user{display:flex;align-items:center;gap:.75rem;margin-bottom:.75rem;}
        .sidebar-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#CC0000,#FF4444);display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0;}
        .sidebar-user-info p:first-child{font-size:.85rem;font-weight:600;color:var(--text);}
        .sidebar-user-info p:last-child{font-size:.75rem;color:var(--text-muted);}
        .admin-main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}
        .admin-topbar{padding:.85rem 1.75rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;background:#fff;position:sticky;top:0;z-index:40;box-shadow:0 1px 4px rgba(0,0,0,.05);}
        .admin-topbar h1{font-size:1.1rem;font-weight:700;color:var(--text);}
        .admin-topbar p{font-size:.8rem;color:var(--text-muted);margin-top:.1rem;}
        .admin-content{padding:1.75rem;flex:1;}
        .card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;box-shadow:var(--shadow);}
        .card-header{margin-bottom:1.25rem;padding-bottom:1rem;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;}
        .card-header h2{font-size:1rem;font-weight:700;color:var(--text);}
        .card-header p{font-size:.8rem;color:var(--text-muted);margin-top:.2rem;}
        .btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.2rem;border-radius:8px;font-weight:600;font-size:.875rem;text-decoration:none;border:none;cursor:pointer;transition:all .2s;}
        .btn-primary{background:var(--red-primary);color:#fff;}
        .btn-primary:hover{background:var(--red-dark);transform:translateY(-1px);box-shadow:0 4px 12px rgba(204,0,0,.3);}
        .btn-secondary{background:#F1F5F9;color:var(--text);border:1px solid var(--border);}
        .btn-secondary:hover{background:#E2E8F0;}
        .btn-success{background:var(--success);color:#fff;}
        .btn-success:hover{filter:brightness(1.05);}
        .btn-danger{background:var(--danger);color:#fff;}
        .btn-danger:hover{filter:brightness(1.05);}
        .btn-warning{background:var(--warning);color:#fff;}
        .btn-sm{padding:.35rem .75rem;font-size:.8rem;}
        .btn-lg{padding:.75rem 1.75rem;font-size:1rem;}
        .badge{display:inline-flex;align-items:center;padding:.25rem .65rem;border-radius:99px;font-size:.75rem;font-weight:600;}
        .badge-pending{background:rgba(245,158,11,.1);color:#B45309;border:1px solid rgba(245,158,11,.25);}
        .badge-diterima{background:rgba(16,185,129,.1);color:#065F46;border:1px solid rgba(16,185,129,.25);}
        .badge-ditolak{background:rgba(239,68,68,.1);color:#991B1B;border:1px solid rgba(239,68,68,.25);}
        .badge-aktif{background:rgba(16,185,129,.1);color:#065F46;border:1px solid rgba(16,185,129,.25);}
        .badge-nonaktif{background:rgba(148,163,184,.12);color:#475569;border:1px solid rgba(148,163,184,.3);}
        .badge-admin{background:rgba(204,0,0,.1);color:var(--red-primary);border:1px solid rgba(204,0,0,.2);}
        .alert{padding:.85rem 1.25rem;border-radius:10px;font-size:.875rem;margin-bottom:1.25rem;display:flex;align-items:flex-start;gap:.75rem;}
        .alert-success{background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.25);color:#065F46;}
        .alert-error{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);color:#991B1B;}
        .alert-warning{background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.25);color:#92400E;}
        .form-group{margin-bottom:1.25rem;}
        .form-label{display:block;font-size:.875rem;font-weight:600;margin-bottom:.45rem;color:var(--text);}
        .form-control{width:100%;background:#fff;border:1.5px solid var(--border);border-radius:8px;color:var(--text);padding:.65rem 1rem;font-size:.9rem;font-family:inherit;transition:all .2s;}
        .form-control::placeholder{color:var(--text-subtle);}
        .form-control:focus{outline:none;border-color:var(--red-primary);box-shadow:0 0 0 3px rgba(204,0,0,.12);}
        .form-control:disabled,.form-control[readonly]{background:#F8FAFC;color:var(--text-muted);cursor:not-allowed;}
        select.form-control{cursor:pointer;}
        textarea.form-control{resize:vertical;min-height:100px;}
        .table-wrap{overflow-x:auto;}
        table{width:100%;border-collapse:collapse;font-size:.875rem;}
        thead th{background:#F8FAFC;padding:.75rem 1rem;text-align:left;font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;color:var(--text-muted);border-bottom:1px solid var(--border);font-weight:700;}
        tbody td{padding:.85rem 1rem;border-bottom:1px solid var(--border);vertical-align:middle;color:var(--text);}
        tbody tr:hover{background:#FFF5F5;}
        tbody tr:last-child td{border-bottom:none;}
        .grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:1.25rem;}
        .grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem;}
        .grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem;}
        @media(max-width:768px){.grid-2,.grid-3,.grid-4{grid-template-columns:1fr;}}
        .stat-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:1.25rem;display:flex;align-items:center;gap:1rem;box-shadow:var(--shadow);transition:box-shadow .2s,transform .2s;}
        .stat-card:hover{box-shadow:0 8px 28px rgba(0,0,0,.1);transform:translateY(-2px);}
        .stat-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;}
        .stat-icon.red{background:rgba(204,0,0,.1);}
        .stat-icon.green{background:rgba(16,185,129,.12);}
        .stat-icon.blue{background:rgba(59,130,246,.12);}
        .stat-icon.yellow{background:rgba(245,158,11,.12);}
        .stat-value{font-size:1.8rem;font-weight:800;line-height:1;color:var(--text);}
        .stat-label{font-size:.8rem;color:var(--text-muted);margin-top:.25rem;font-weight:500;}
        .page-header{margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;}
        .page-header h1{font-size:1.4rem;font-weight:800;color:var(--text);}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.2rem;}
        hr.divider{border:none;border-top:1px solid var(--border);margin:1.5rem 0;}
        /* Image Modal */
        #img-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);backdrop-filter:blur(4px);z-index:9999;align-items:center;justify-content:center;}
        #img-modal-overlay.open{display:flex;}
        #img-modal-overlay img{max-width:90vw;max-height:88vh;object-fit:contain;border-radius:8px;box-shadow:0 24px 80px rgba(0,0,0,.5);}
        #img-modal-close{position:absolute;top:1rem;right:1rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;font-size:1.1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s;}
        #img-modal-close:hover{background:rgba(255,255,255,.25);}
        @media(max-width:900px){.admin-sidebar{transform:translateX(-100%);}.admin-main{margin-left:0;}}
    </style>
    @stack('styles')
</head>
<body>
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand">
            <svg width="32" height="32" viewBox="0 0 46 46" fill="none">
                <circle cx="23" cy="23" r="23" fill="#CC0000"/>
                <rect x="19" y="11" width="8" height="24" rx="4" fill="white"/>
                <rect x="11" y="19" width="24" height="8" rx="4" fill="white"/>
            </svg>
            <div style="line-height:1.15;">
                <div style="font-size:.88rem;font-weight:800;color:#CC0000;">PMI Palembang</div>
                <div style="font-size:.62rem;color:#64748B;">Panel Admin</div>
            </div>
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
    <div class="admin-main">
        <div class="admin-topbar">
            <div>
                <h1>@yield('page-title','Dashboard')</h1>
                <p>@yield('page-subtitle','Panel administrasi PMI Kota Palembang')</p>
            </div>
            <span class="badge badge-admin">Admin</span>
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
    <div id="img-modal-overlay" onclick="if(event.target===this)closeImgModal()">
        <button id="img-modal-close" onclick="closeImgModal()">✕</button>
        <img id="img-modal-src" src="" alt="Bukti Transfer">
    </div>
    <script>
    function openImgModal(url){
        document.getElementById('img-modal-src').src=url;
        document.getElementById('img-modal-overlay').classList.add('open');
        document.body.style.overflow='hidden';
    }
    function closeImgModal(){
        document.getElementById('img-modal-overlay').classList.remove('open');
        document.getElementById('img-modal-src').src='';
        document.body.style.overflow='';
    }
    document.addEventListener('keydown',function(e){if(e.key==='Escape')closeImgModal();});
    </script>
    @stack('scripts')
</body>
</html>
