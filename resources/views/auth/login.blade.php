@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<style>
/* ── Auth page wrapper — light gradient background ── */
.auth-page {
    min-height: calc(100vh - 130px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, #fff5f5 0%, #ffffff 50%, #fef2f2 100%);
}

/* ── Auth card — white, soft shadow ── */
.auth-card {
    width: 100%;
    max-width: 460px;
    background: #ffffff;
    border: 1px solid #fee2e2;
    border-radius: 20px;
    padding: 2.75rem 2.5rem;
    box-shadow: 0 8px 40px rgba(204, 0, 0, 0.08), 0 2px 12px rgba(0,0,0,0.06);
}

/* ── Card top accent bar ── */
.auth-card::before {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #CC0000, #FF4444);
    border-radius: 2px;
    margin: 0 auto 2rem;
}

/* ── Logo / Header area ── */
.auth-logo {
    text-align: center;
    margin-bottom: 2rem;
}
.auth-logo .pmi-icon {
    width: 72px; height: 72px;
    background: #CC0000;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem;
    box-shadow: 0 8px 24px rgba(204,0,0,0.25);
}
.auth-logo h1 {
    font-size: 1.6rem;
    font-weight: 800;
    color: #0F172A;
    letter-spacing: -0.02em;
}
.auth-logo p {
    color: #64748B;
    font-size: .9rem;
    margin-top: .35rem;
}

/* ── Form override for light theme ── */
.auth-form-label {
    display: block;
    font-size: .875rem;
    font-weight: 600;
    margin-bottom: .45rem;
    color: #374151;
}
.auth-form-control {
    width: 100%;
    background: #F9FAFB;
    border: 1.5px solid #E5E7EB;
    border-radius: 10px;
    color: #0F172A;
    padding: .7rem 1rem;
    font-size: .9rem;
    font-family: inherit;
    transition: border-color .2s, box-shadow .2s;
    outline: none;
}
.auth-form-control::placeholder { color: #9CA3AF; }
.auth-form-control:focus {
    border-color: #CC0000;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(204,0,0,0.1);
}

/* ── Submit button ── */
.auth-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    padding: .8rem 1.5rem;
    background: #CC0000;
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background .2s, transform .15s, box-shadow .2s;
    font-family: inherit;
    margin-top: .5rem;
}
.auth-btn:hover {
    background: #990000;
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(204,0,0,0.3);
}
.auth-btn:active { transform: translateY(0); }

/* ── Footer link ── */
.auth-footer {
    text-align: center;
    margin-top: 1.75rem;
    font-size: .875rem;
    color: #64748B;
}
.auth-footer a {
    color: #CC0000;
    text-decoration: none;
    font-weight: 700;
}
.auth-footer a:hover { text-decoration: underline; }

/* ── Remember me + checkbox ── */
.auth-remember {
    display: flex;
    align-items: center;
    gap: .6rem;
    margin-bottom: 1.25rem;
}
.auth-remember input[type="checkbox"] {
    width: 16px; height: 16px;
    accent-color: #CC0000;
    cursor: pointer;
}
.auth-remember label {
    font-size: .875rem;
    color: #64748B;
    cursor: pointer;
}

/* ── Divider ── */
.auth-divider {
    display: flex; align-items: center; gap: 1rem;
    color: #9CA3AF; font-size: .8rem; margin: 1.5rem 0;
}
.auth-divider::before, .auth-divider::after {
    content: ''; flex: 1; height: 1px; background: #E5E7EB;
}

/* ── Info box ── */
.auth-info-box {
    background: #FFF5F5;
    border: 1px solid #FEE2E2;
    border-radius: 10px;
    padding: .85rem 1rem;
    font-size: .8rem;
    color: #64748B;
}
</style>
@endpush

@section('content')
{{-- AOS: fade-up on the whole card --}}
<div class="auth-page">
    <div class="auth-card" data-aos="fade-up" data-aos-duration="600">

        {{-- Logo & Title --}}
        <div class="auth-logo">
            <div class="pmi-icon">
                {{-- PMI Cross SVG --}}
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                    <rect x="15" y="5" width="6" height="26" rx="3" fill="white"/>
                    <rect x="5" y="15" width="26" height="6" rx="3" fill="white"/>
                </svg>
            </div>
            <h1>Selamat Datang</h1>
            <p>Masuk untuk mengakses akun pendonor Anda</p>
        </div>

        {{-- Error Alert --}}
        @if($errors->any())
            <div class="alert alert-error" data-aos="fade-in">
                ❌ {{ $errors->first() }}
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login.post') }}" id="loginForm">
            @csrf

            {{-- Email --}}
            <div class="form-group" data-aos="fade-up" data-aos-delay="50">
                <label class="auth-form-label" for="email">Alamat Email</label>
                <input type="email" id="email" name="email"
                       class="auth-form-control"
                       value="{{ old('email') }}"
                       placeholder="nama@email.com"
                       required autofocus>
            </div>

            {{-- Password --}}
            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label class="auth-form-label" for="password">Password</label>
                <input type="password" id="password" name="password"
                       class="auth-form-control"
                       placeholder="••••••••"
                       required>
            </div>

            {{-- Remember Me --}}
            <div class="auth-remember" data-aos="fade-up" data-aos-delay="130">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya di perangkat ini</label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="auth-btn" data-aos="fade-up" data-aos-delay="160">
                🩸 Masuk ke Akun
            </button>
        </form>

        {{-- Footer --}}
        <div class="auth-footer" data-aos="fade-up" data-aos-delay="200">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>

    </div>
</div>
@endsection
