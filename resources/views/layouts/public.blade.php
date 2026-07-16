<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PMI Kota Palembang — Platform Donor Darah resmi PMI Kota Palembang. Donor darah, selamatkan jiwa.">
    <title>@yield('title', 'Beranda') — PMI Kota Palembang</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <!-- Vite Assets (Tailwind CSS + JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Mobile nav active state */
        #mobile-menu .nav-link.active {
            color: #CC0000 !important;
            background: #FFF5F5 !important;
        }
    </style>

    @stack('styles')
</head>
{{-- Light theme body: white background, dark text --}}
<body class="font-sans bg-white text-gray-900 min-h-screen flex flex-col overflow-x-hidden">

{{-- ─────────────────────────────────────────────────────────────────
     SPLASH SCREEN (Full-Screen Red Cover)
     ─────────────────────────────────────────────────────────────────
     Phase 1: Entire screen is red (#CC0000) with logo + text centered
     Phase 2: After ~2.5s, wave animation sweeps the red out downward
     JS adds .splash-exit class → CSS animation plays → adds .done
     ──────────────────────────────────────────────────────────────── --}}
<div id="splash" role="presentation" aria-hidden="true"
     class="fixed inset-0 z-[9999] flex items-center justify-center bg-[#CC0000] overflow-hidden">

    {{-- ── Center Content: Logo + Text ── --}}
    <div class="relative z-10 flex flex-col items-center gap-5 text-center px-6">

        {{-- PMI Logo (white cross on white circle) --}}
        {{-- CUSTOM ANIMATION: logoAppear → scale + fade in at 0.5s delay --}}
        <div id="splash-logo"
             class="opacity-0 [animation:logoAppear_0.6s_cubic-bezier(0.34,1.56,0.64,1)_0.5s_forwards]
                    [filter:drop-shadow(0_8px_32px_rgba(255,255,255,0.35))]">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="50" fill="white"/>
                <rect x="42" y="22" width="16" height="56" rx="8" fill="#CC0000"/>
                <rect x="22" y="42" width="56" height="16" rx="8" fill="#CC0000"/>
            </svg>
        </div>

        {{-- "Donor Darah" text --}}
        {{-- CUSTOM ANIMATION: textAppear → slide up + fade at 1.1s, textFadeOut at 2.1s --}}
        <div id="splash-text"
             class="opacity-0 [animation:textAppear_0.6s_ease_1.1s_forwards,textFadeOut_0.5s_ease_2.1s_forwards]">
            <p class="text-white text-[clamp(2.2rem,7vw,4.5rem)] font-black tracking-[-0.03em] leading-none">
                Donor Darah
            </p>
            <p class="text-white/80 text-[clamp(0.85rem,2.5vw,1.1rem)] font-semibold tracking-[0.25em] uppercase mt-2">
                PMI Kota Palembang
            </p>
        </div>
    </div>

    {{-- ── Bottom Wave SVG (exits with the screen) ── --}}
    {{-- This wave creates the organic "draining" exit visual --}}
    <div id="splash-wave-bottom"
         class="absolute bottom-0 left-0 w-full pointer-events-none opacity-30">
        <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
             style="width:100%;display:block;">
            <path d="M0,40 C360,80 720,0 1080,40 C1260,60 1380,20 1440,40 L1440,80 L0,80 Z"
                  fill="rgba(255,255,255,0.2)"/>
        </svg>
    </div>
</div>

{{-- ─── HEADER ──────────────────────────────────────────────────
     Light Theme: White background, red brand, dark text
     Becomes more opaque + gets shadow on scroll (via JS .scrolled class)
     ──────────────────────────────────────────────────────────── --}}
<header class="sticky top-0 z-[1000] bg-white/90 backdrop-blur-xl border-b border-gray-100
               transition-[background,box-shadow,border-color] duration-300"
        id="site-header">
    <div class="max-w-[1400px] mx-auto px-8 py-3 flex items-center justify-between gap-4">

        {{-- Left: Logos --}}
        <div class="flex items-center gap-4 no-underline shrink-0">

            {{-- PMI Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-[0.6rem] no-underline">
                <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23" cy="23" r="23" fill="#CC0000"/>
                    <rect x="19" y="11" width="8" height="24" rx="4" fill="white"/>
                    <rect x="11" y="19" width="24" height="8" rx="4" fill="white"/>
                </svg>
                <div class="leading-[1.1]">
                    <div class="text-[0.95rem] font-extrabold text-[#CC0000] tracking-[-0.01em]">PMI Kota Palembang</div>
                    <div class="text-[0.7rem] font-medium text-gray-500">Palang Merah Indonesia</div>
                </div>
            </a>

            {{-- Logo Divider --}}
            <div class="w-px h-10 bg-gray-200"></div>

            {{-- Pemkot Logo --}}
            <a href="#" title="Pemerintah Kota Palembang">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="8" fill="#f1f5f9"/>
                    <rect x="4" y="28" width="32" height="4" rx="2" fill="#c8a84b"/>
                    <rect x="8" y="10" width="4" height="20" rx="2" fill="#c8a84b"/>
                    <rect x="18" y="8" width="4" height="22" rx="2" fill="#c8a84b"/>
                    <rect x="28" y="10" width="4" height="20" rx="2" fill="#c8a84b"/>
                    <path d="M6 14 L20 6 L34 14 Z" fill="#c8a84b"/>
                </svg>
            </a>
        </div>

        {{-- ──────────────────────────────────────────────────────
             DESKTOP NAV with Sliding Indicator
             #nav-indicator is the red pill that moves behind links.
             JS (below) positions + animates it on hover/active.
             ────────────────────────────────────────────────────── --}}
        <nav class="hidden md:flex items-center gap-1" id="desktop-nav" aria-label="Navigasi utama">

            {{-- CUSTOM ANIMATION: Sliding red indicator pill --}}
            {{-- This div moves via JS: left + width CSS properties with CSS transition --}}
            <div id="nav-indicator"></div>

            <a href="{{ route('home') }}"
               class="nav-link text-gray-700 no-underline text-[0.875rem] font-semibold px-[0.9rem] py-2 rounded-lg transition-colors duration-200 whitespace-nowrap hover:text-[#CC0000] {{ request()->is('/') ? 'active' : '' }}"
               id="nav-beranda">Beranda</a>
            <a href="#profil"
               class="nav-link text-gray-700 no-underline text-[0.875rem] font-semibold px-[0.9rem] py-2 rounded-lg transition-colors duration-200 whitespace-nowrap hover:text-[#CC0000]"
               id="nav-profil">Profil</a>
            <a href="#berita"
               class="nav-link text-gray-700 no-underline text-[0.875rem] font-semibold px-[0.9rem] py-2 rounded-lg transition-colors duration-200 whitespace-nowrap hover:text-[#CC0000]"
               id="nav-berita">Berita</a>
            <a href="#relawan"
               class="nav-link text-gray-700 no-underline text-[0.875rem] font-semibold px-[0.9rem] py-2 rounded-lg transition-colors duration-200 whitespace-nowrap hover:text-[#CC0000]"
               id="nav-relawan">Relawan</a>
            <a href="#pendidikan"
               class="nav-link text-gray-700 no-underline text-[0.875rem] font-semibold px-[0.9rem] py-2 rounded-lg transition-colors duration-200 whitespace-nowrap hover:text-[#CC0000]"
               id="nav-pendidikan">Pendidikan</a>
            <a href="#kontak"
               class="nav-link text-gray-700 no-underline text-[0.875rem] font-semibold px-[0.9rem] py-2 rounded-lg transition-colors duration-200 whitespace-nowrap hover:text-[#CC0000]"
               id="nav-kontak">Kontak</a>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-2 ml-3 pl-3 border-l border-gray-200">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]">Dashboard</a>
                    @else
                        <a href="{{ route('donor.dashboard') }}"
                           class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-transparent text-[#CC0000] border-[1.5px] border-[#CC0000]/30 hover:bg-[#CC0000]/5 hover:border-[#CC0000]/50">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-gray-600 border-[1.5px] border-gray-200 hover:bg-red-50 hover:text-[#CC0000] hover:border-red-200">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-transparent text-[#CC0000] border-[1.5px] border-[#CC0000]/30 hover:bg-[#CC0000]/5 hover:border-[#CC0000]/60"
                       id="btn-login">Masuk</a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center justify-center gap-[0.4rem] px-[0.9rem] py-[0.4rem] rounded-lg font-bold text-[0.8rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]"
                       id="btn-daftar">Daftar</a>
                @endauth
            </div>
        </nav>

        {{-- Hamburger (mobile) --}}
        <button class="hamburger flex md:hidden flex-col gap-[5px] cursor-pointer p-2 rounded-lg border border-gray-200 bg-transparent transition-[background] duration-200 hover:bg-red-50"
                id="hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
            <span class="block w-[22px] h-[2px] bg-[#CC0000] rounded-[2px] transition-[transform,opacity] duration-300"></span>
            <span class="block w-[22px] h-[2px] bg-[#CC0000] rounded-[2px] transition-[transform,opacity] duration-300"></span>
            <span class="block w-[22px] h-[2px] bg-[#CC0000] rounded-[2px] transition-[transform,opacity] duration-300"></span>
        </button>
    </div>

    {{-- Mobile Menu — Light Theme --}}
    <div class="mobile-menu hidden flex-col gap-1 px-5 md:px-8 pb-6 pt-3 border-t border-gray-100 bg-white shadow-lg"
         id="mobile-menu" role="navigation" aria-label="Navigasi mobile">
        <a href="{{ route('home') }}"
           class="nav-link text-gray-800 no-underline text-base font-semibold px-4 py-3 rounded-lg transition-[color,background] duration-200 whitespace-nowrap hover:text-[#CC0000] hover:bg-red-50 {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
        <a href="#profil" class="nav-link text-gray-800 no-underline text-base font-semibold px-4 py-3 rounded-lg transition-[color,background] duration-200 whitespace-nowrap hover:text-[#CC0000] hover:bg-red-50">Profil</a>
        <a href="#berita" class="nav-link text-gray-800 no-underline text-base font-semibold px-4 py-3 rounded-lg transition-[color,background] duration-200 whitespace-nowrap hover:text-[#CC0000] hover:bg-red-50">Berita</a>
        <a href="#relawan" class="nav-link text-gray-800 no-underline text-base font-semibold px-4 py-3 rounded-lg transition-[color,background] duration-200 whitespace-nowrap hover:text-[#CC0000] hover:bg-red-50">Relawan</a>
        <a href="#pendidikan" class="nav-link text-gray-800 no-underline text-base font-semibold px-4 py-3 rounded-lg transition-[color,background] duration-200 whitespace-nowrap hover:text-[#CC0000] hover:bg-red-50">Pendidikan</a>
        <a href="#kontak" class="nav-link text-gray-800 no-underline text-base font-semibold px-4 py-3 rounded-lg transition-[color,background] duration-200 whitespace-nowrap hover:text-[#CC0000] hover:bg-red-50">Kontak</a>

        {{-- Mobile Auth --}}
        <div class="flex flex-col items-stretch gap-2 mt-2 pt-3 border-t border-gray-100">
            @auth
                <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('donor.dashboard') }}"
                   class="inline-flex items-center justify-center gap-[0.4rem] px-[1.3rem] py-[0.55rem] rounded-lg font-bold text-[0.875rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-[0.4rem] px-[1.3rem] py-[0.55rem] rounded-lg font-bold text-[0.875rem] cursor-pointer transition-all duration-200 whitespace-nowrap bg-transparent text-gray-700 border-[1.5px] border-gray-200 hover:bg-red-50 hover:text-[#CC0000] hover:border-red-200">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center gap-[0.4rem] px-[1.3rem] py-[0.55rem] rounded-lg font-bold text-[0.875rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-transparent text-[#CC0000] border-[1.5px] border-[#CC0000]/30 hover:bg-red-50">Masuk</a>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center gap-[0.4rem] px-[1.3rem] py-[0.55rem] rounded-lg font-bold text-[0.875rem] cursor-pointer transition-all duration-200 whitespace-nowrap no-underline bg-[#CC0000] text-white hover:bg-[#990000] hover:-translate-y-px hover:shadow-[0_8px_32px_rgba(204,0,0,0.25)]">Daftar</a>
            @endauth
        </div>
    </div>
</header>

{{-- ─── FLASH MESSAGES ──────────────────────────────────────── --}}
@if(session('success') || session('error'))
<div class="max-w-[1280px] mx-auto px-8 md:px-5 pt-4">
    @if(session('success'))
        <div class="px-5 py-[0.85rem] rounded-[10px] bg-emerald-50 border border-emerald-200 text-emerald-700 text-[0.875rem] mb-3">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="px-5 py-[0.85rem] rounded-[10px] bg-red-50 border border-red-200 text-red-700 text-[0.875rem] mb-3">❌ {{ session('error') }}</div>
    @endif
</div>
@endif

{{-- ─── PAGE CONTENT ────────────────────────────────────────── --}}
<main class="flex-1">
    @yield('content')
</main>

{{-- ─── FOOTER — Light Theme ────────────────────────────────── --}}
<footer class="bg-white border-t border-gray-100 mt-20" id="kontak">

    {{-- Footer Main Grid --}}
    <div class="max-w-[1280px] mx-auto px-8 pt-16 pb-12 md:px-5 md:pt-12 md:pb-8
                grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr] gap-8 lg:gap-12">

        {{-- Brand & Contact --}}
        <div data-aos="fade-up">
            <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5 no-underline">
                <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="22" cy="22" r="22" fill="#CC0000"/>
                    <rect x="18" y="10" width="8" height="24" rx="4" fill="white"/>
                    <rect x="10" y="18" width="24" height="8" rx="4" fill="white"/>
                </svg>
                <div>
                    <div class="text-[1.1rem] font-extrabold text-[#CC0000]">PMI Kota Palembang</div>
                    <div class="text-[0.75rem] text-gray-500">Palang Merah Indonesia</div>
                </div>
            </a>
            <p class="text-[0.875rem] text-gray-600 leading-[1.7] mb-6">
                Palang Merah Indonesia Kota Palembang berkomitmen melayani masyarakat melalui pelayanan donor darah, bantuan kemanusiaan, dan pemberdayaan relawan.
            </p>

            <div class="flex items-start gap-[0.6rem] text-[0.85rem] text-gray-600 mb-3 leading-[1.5]">
                <span class="text-base shrink-0 mt-[0.05rem]">📍</span>
                <span>Jl. Merdeka No. 1, Ilir Timur I, Kota Palembang, Sumatera Selatan 30111</span>
            </div>
            <div class="flex items-start gap-[0.6rem] text-[0.85rem] text-gray-600 mb-3 leading-[1.5]">
                <span class="text-base shrink-0 mt-[0.05rem]">📞</span>
                <span>(0711) 123-456</span>
            </div>
            <div class="flex items-start gap-[0.6rem] text-[0.85rem] text-gray-600 mb-3 leading-[1.5]">
                <span class="text-base shrink-0 mt-[0.05rem]">📧</span>
                <span>info@pmi-palembang.org</span>
            </div>
            <div class="flex items-start gap-[0.6rem] text-[0.85rem] text-gray-600 mb-3 leading-[1.5]">
                <span class="text-base shrink-0 mt-[0.05rem]">🕐</span>
                <span>Senin–Sabtu: 08.00–16.00 WIB</span>
            </div>
        </div>

        {{-- Tentang Kami --}}
        <div data-aos="fade-up" data-aos-delay="100">
            <p class="text-[0.8rem] font-bold uppercase tracking-[0.12em] text-gray-900 mb-5">Tentang Kami</p>
            <ul class="list-none flex flex-col gap-[0.6rem]">
                <li><a href="#profil" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Profil PMI Palembang</a></li>
                <li><a href="#relawan" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Jadilah Relawan</a></li>
                <li><a href="#pendidikan" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Program Pendidikan</a></li>
                <li><a href="#berita" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Berita &amp; Kegiatan</a></li>
                <li><a href="{{ route('login') }}" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Login Pendonor</a></li>
                <li><a href="{{ route('register') }}" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Daftar Pendonor</a></li>
            </ul>
        </div>

        {{-- Layanan --}}
        <div data-aos="fade-up" data-aos-delay="150">
            <p class="text-[0.8rem] font-bold uppercase tracking-[0.12em] text-gray-900 mb-5">Layanan</p>
            <ul class="list-none flex flex-col gap-[0.6rem]">
                <li><a href="#jadwal" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Jadwal Donor Darah</a></li>
                <li><a href="#stok-darah" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Stok Darah</a></li>
                <li><a href="#" onclick="openModal('modal-donasi')" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Tentang Donasi</a></li>
                <li><a href="#" onclick="openModal('modal-cara')" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Cara Donasi</a></li>
                <li><a href="#" onclick="openModal('modal-kebijakan')" class="text-[0.875rem] text-gray-600 no-underline transition-colors duration-200 hover:text-[#CC0000]">Kebijakan Donasi</a></li>
                <li><a href="tel:118" class="text-[0.875rem] text-[#CC0000] font-bold no-underline transition-colors duration-200 hover:text-[#990000]">🚑 Ambulans: 118</a></li>
            </ul>
        </div>

        {{-- Media Sosial --}}
        <div id="profil" data-aos="fade-up" data-aos-delay="200">
            <p class="text-[0.8rem] font-bold uppercase tracking-[0.12em] text-gray-900 mb-5">Ikuti Kami</p>
            <p class="text-[0.875rem] text-gray-600 mb-5 leading-[1.6]">
                Dapatkan informasi terkini seputar kegiatan PMI Kota Palembang di media sosial kami.
            </p>
            <div class="flex gap-3 flex-wrap">
                <a href="#" class="w-11 h-11 rounded-[12px] bg-gray-50 border border-gray-200 flex items-center justify-center no-underline transition-all duration-200 text-[1.25rem] hover:bg-red-50 hover:border-red-200 hover:-translate-y-[2px]"
                   title="Facebook PMI Palembang" id="social-fb">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" class="w-11 h-11 rounded-[12px] bg-gray-50 border border-gray-200 flex items-center justify-center no-underline transition-all duration-200 text-[1.25rem] hover:bg-red-50 hover:border-red-200 hover:-translate-y-[2px]"
                   title="Instagram PMI Palembang" id="social-ig">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="url(#ig-grad)">
                        <defs><linearGradient id="ig-grad" x1="0%" y1="100%" x2="100%" y2="0%"><stop offset="0%" style="stop-color:#f09433"/><stop offset="25%" style="stop-color:#e6683c"/><stop offset="50%" style="stop-color:#dc2743"/><stop offset="75%" style="stop-color:#cc2366"/><stop offset="100%" style="stop-color:#bc1888"/></linearGradient></defs>
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                </a>
                <a href="#" class="w-11 h-11 rounded-[12px] bg-gray-50 border border-gray-200 flex items-center justify-center no-underline transition-all duration-200 hover:bg-red-50 hover:border-red-200 hover:-translate-y-[2px]"
                   title="Twitter/X PMI Palembang" id="social-tw">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#0f172a"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.261 5.635 5.903-5.635zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" class="w-11 h-11 rounded-[12px] bg-gray-50 border border-gray-200 flex items-center justify-center no-underline transition-all duration-200 hover:bg-red-50 hover:border-red-200 hover:-translate-y-[2px]"
                   title="YouTube PMI Palembang" id="social-yt">
                    <svg width="22" height="16" viewBox="0 0 24 17" fill="#FF0000"><path d="M23.495 2.205a3.02 3.02 0 00-2.122-2.136C19.505 0 12 0 12 0S4.495 0 2.627.069A3.02 3.02 0 00.505 2.205 31.247 31.247 0 000 8.5a31.247 31.247 0 00.505 6.295 3.02 3.02 0 002.122 2.136C4.495 17 12 17 12 17s7.505 0 9.373-.069a3.02 3.02 0 002.122-2.136A31.247 31.247 0 0024 8.5a31.247 31.247 0 00-.505-6.295zM9.545 12.068V4.932L15.818 8.5l-6.273 3.568z"/></svg>
                </a>
                <a href="#" class="w-11 h-11 rounded-[12px] bg-gray-50 border border-gray-200 flex items-center justify-center no-underline transition-all duration-200 hover:bg-red-50 hover:border-red-200 hover:-translate-y-[2px]"
                   title="WhatsApp PMI Palembang" id="social-wa">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#25D366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Footer Bottom --}}
    <div class="border-t border-gray-100 px-8 py-5 md:px-5 md:py-4 max-w-[1280px] mx-auto
                flex items-center justify-between md:flex-col md:text-center text-[0.8rem] text-gray-500 gap-4 flex-wrap">
        <span>© {{ date('Y') }} PMI Kota Palembang. Semua hak dilindungi.</span>
        <span>Setetes darah, sejuta harapan 🩸</span>
    </div>
</footer>

{{-- ─── MODAL OVERLAYS ──────────────────────────────────────── --}}
@yield('modals')

{{-- ─── AOS LIBRARY ─────────────────────────────────────────── --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    // ══════════════════════════════════════════════════════════════
    // AOS Init — Animate On Scroll
    // ══════════════════════════════════════════════════════════════
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60,
        });
    });

    // ══════════════════════════════════════════════════════════════
    // SPLASH SCREEN — Full-Screen Red Cover with Wave Exit
    // ══════════════════════════════════════════════════════════════
    // Phase 1: Red screen covers everything (initial state)
    // Phase 2: Logo + text animate in
    // Phase 3: After 2.8s, add .splash-exit → CSS clip-path animation
    // Phase 4: After animation, add .done to fully hide
    (function () {
        const splash = document.getElementById('splash');

        // Only show splash once per session
        if (sessionStorage.getItem('splashShown')) {
            splash.style.display = 'none';
            return;
        }
        sessionStorage.setItem('splashShown', Date.now());

        // CUSTOM ANIMATION: Wave exit — red cover slides down out of view
        // CSS .splash-exit uses clip-path animation to create the wave sweep
        setTimeout(function () {
            splash.classList.add('splash-exit');
            // After CSS animation ends (~900ms), fully hide
            setTimeout(function () {
                splash.classList.add('done');
                setTimeout(function () {
                    splash.style.display = 'none';
                }, 400);
            }, 900);
        }, 2800);
    })();

    // ══════════════════════════════════════════════════════════════
    // STICKY HEADER — Light theme scroll state
    // Adds .scrolled class → CSS applies bg-white/98 + shadow
    // ══════════════════════════════════════════════════════════════
    window.addEventListener('scroll', function () {
        const header = document.getElementById('site-header');
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // ══════════════════════════════════════════════════════════════
    // NAVBAR SLIDING INDICATOR — Custom Interaction Animation
    // The #nav-indicator element is an absolutely-positioned red pill
    // that moves behind whichever nav link is active or being hovered.
    // JS measures each link's offsetLeft + offsetWidth and sets
    // indicator's left + width, CSS transition handles the smooth slide.
    // ══════════════════════════════════════════════════════════════
    (function () {
        const nav = document.getElementById('desktop-nav');
        const indicator = document.getElementById('nav-indicator');
        if (!nav || !indicator) return;

        const navLinks = nav.querySelectorAll('.nav-link');

        // Move indicator to a given element
        function moveIndicator(el) {
            const navRect = nav.getBoundingClientRect();
            const elRect  = el.getBoundingClientRect();
            indicator.style.left  = (elRect.left - navRect.left) + 'px';
            indicator.style.width = elRect.width + 'px';
            indicator.classList.add('visible');
        }

        // Position indicator on active link at page load
        const activeLink = nav.querySelector('.nav-link.active');
        if (activeLink) {
            // Small delay to ensure layout is complete
            setTimeout(function () { moveIndicator(activeLink); }, 50);
        }

        // Move indicator on hover
        navLinks.forEach(function (link) {
            link.addEventListener('mouseenter', function () {
                moveIndicator(this);
            });
        });

        // Return indicator to active link on mouse leave
        nav.addEventListener('mouseleave', function () {
            const active = nav.querySelector('.nav-link.active');
            if (active) {
                moveIndicator(active);
            } else {
                indicator.classList.remove('visible');
            }
        });

        // Move indicator on click and mark as active
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                navLinks.forEach(function (l) { l.classList.remove('active'); });
                this.classList.add('active');
                moveIndicator(this);
            });
        });
    })();

    // ══════════════════════════════════════════════════════════════
    // HAMBURGER MENU
    // ══════════════════════════════════════════════════════════════
    const hamburger   = document.getElementById('hamburger-btn');
    const mobileMenu  = document.getElementById('mobile-menu');

    hamburger.addEventListener('click', function () {
        const isOpen = mobileMenu.classList.contains('open');
        mobileMenu.classList.toggle('open');
        hamburger.classList.toggle('open');
        hamburger.setAttribute('aria-expanded', !isOpen);
    });

    mobileMenu.querySelectorAll('.nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            // Update active class on mobile nav
            mobileMenu.querySelectorAll('.nav-link').forEach(function (l) {
                l.classList.remove('active', 'text-[#CC0000]', 'bg-red-50');
            });
            this.classList.add('active');

            // Sync desktop nav active state
            const href = this.getAttribute('href');
            document.querySelectorAll('#desktop-nav .nav-link').forEach(function (dl) {
                dl.classList.remove('active');
                if (dl.getAttribute('href') === href) {
                    dl.classList.add('active');
                }
            });

            mobileMenu.classList.remove('open');
            hamburger.classList.remove('open');
            hamburger.setAttribute('aria-expanded', 'false');
        });
    });

    // ── Also sync desktop nav clicks → mobile nav ──────────────────
    document.querySelectorAll('#desktop-nav .nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            const href = this.getAttribute('href');
            mobileMenu.querySelectorAll('.nav-link').forEach(function (ml) {
                ml.classList.remove('active');
                if (ml.getAttribute('href') === href) {
                    ml.classList.add('active');
                }
            });
        });
    });

    // ── IntersectionObserver: auto-update active on scroll ─────────
    (function () {
        const sections = ['beranda', 'stok-darah', 'jadwal', 'berita', 'relawan', 'pendidikan', 'kontak'];
        const allNavLinks = document.querySelectorAll('.nav-link[href^="#"]');
        if (!allNavLinks.length) return;

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    allNavLinks.forEach(function (link) {
                        const target = link.getAttribute('href').replace('#', '');
                        if (target === id) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            });
        }, { threshold: 0.4, rootMargin: '-80px 0px -40% 0px' });

        sections.forEach(function (id) {
            const el = document.getElementById(id);
            if (el) observer.observe(el);
        });
    })();

    // ══════════════════════════════════════════════════════════════
    // MODAL FUNCTIONS
    // ══════════════════════════════════════════════════════════════
    function openModal(id) {
        const overlay = document.getElementById(id);
        if (overlay) {
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        return false;
    }

    function closeModal(id) {
        const overlay = document.getElementById(id);
        if (overlay) {
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(function (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.open').forEach(function (overlay) {
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>
