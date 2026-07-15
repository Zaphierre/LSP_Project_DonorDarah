@extends('layouts.app')

@section('title', 'Daftar Akun')

@push('styles')
<style>
/* ── Auth page wrapper — light gradient background ── */
.auth-page {
    min-height: calc(100vh - 130px);
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, #fff5f5 0%, #ffffff 50%, #fef2f2 100%);
}

/* ── Auth card — white, soft shadow ── */
.auth-card {
    width: 100%;
    max-width: 640px;
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

/* ── Section title divider ── */
.section-title {
    font-size: .75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: #CC0000;
    margin: 1.75rem 0 1rem;
    display: flex; align-items: center; gap: .6rem;
}
.section-title::after {
    content: '';
    flex: 1;
    height: 1.5px;
    background: linear-gradient(90deg, rgba(204,0,0,0.2), transparent);
    border-radius: 1px;
}

/* ── Form overrides for light theme ── */
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
select.auth-form-control { cursor: pointer; }
textarea.auth-form-control { resize: vertical; min-height: 90px; }

/* ── Submit button ── */
.auth-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    padding: .85rem 1.5rem;
    background: #CC0000;
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background .2s, transform .15s, box-shadow .2s;
    font-family: inherit;
    margin-top: .75rem;
}
.auth-btn:hover {
    background: #990000;
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(204,0,0,0.3);
}

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
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-card" data-aos="fade-up" data-aos-duration="600">

        {{-- Logo & Title --}}
        <div class="auth-logo">
            <div class="pmi-icon">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                    <rect x="15" y="5" width="6" height="26" rx="3" fill="white"/>
                    <rect x="5" y="15" width="26" height="6" rx="3" fill="white"/>
                </svg>
            </div>
            <h1>Daftar Sebagai Pendonor</h1>
            <p>Bergabunglah dan selamatkan nyawa bersama kami 🩸</p>
        </div>

        {{-- Errors --}}
        @if($errors->any())
            <div class="alert alert-error" data-aos="fade-in">
                ❌
                <ul style="list-style:none;margin:0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" id="registerForm">
            @csrf

            {{-- ── Section: Info Akun ── --}}
            <div class="section-title" data-aos="fade-right">📋 Informasi Akun</div>

            <div class="grid-2" data-aos="fade-up" data-aos-delay="50">
                <div class="form-group">
                    <label class="auth-form-label" for="name">Username</label>
                    <input type="text" id="name" name="name" class="auth-form-control"
                           value="{{ old('name') }}" placeholder="username" required>
                </div>
                <div class="form-group">
                    <label class="auth-form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="auth-form-control"
                           value="{{ old('email') }}" placeholder="nama@email.com" required>
                </div>
                <div class="form-group">
                    <label class="auth-form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="auth-form-control"
                           placeholder="Min. 8 karakter" required>
                </div>
                <div class="form-group">
                    <label class="auth-form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="auth-form-control" placeholder="Ulangi password" required>
                </div>
            </div>

            {{-- ── Section: Data Pendonor ── --}}
            <div class="section-title" data-aos="fade-right" data-aos-delay="80">🏥 Data Pendonor</div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label class="auth-form-label" for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="auth-form-control"
                       value="{{ old('nama_lengkap') }}" placeholder="Nama sesuai KTP" required>
            </div>

            <div class="grid-3" data-aos="fade-up" data-aos-delay="130">
                <div class="form-group">
                    <label class="auth-form-label" for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="auth-form-control"
                           value="{{ old('tanggal_lahir') }}" required>
                </div>
                <div class="form-group">
                    <label class="auth-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="auth-form-control" required>
                        <option value="">— Pilih —</option>
                        <option value="Laki-laki"  {{ old('jenis_kelamin') === 'Laki-laki'  ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan"  {{ old('jenis_kelamin') === 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="auth-form-label" for="golongan_darah">Golongan Darah</label>
                    <select id="golongan_darah" name="golongan_darah" class="auth-form-control" required>
                        <option value="">— Pilih —</option>
                        @foreach(['A','B','AB','O'] as $gol)
                            <option value="{{ $gol }}" {{ old('golongan_darah') === $gol ? 'selected' : '' }}>{{ $gol }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="160">
                <label class="auth-form-label" for="no_hp">No. Handphone</label>
                <input type="text" id="no_hp" name="no_hp" class="auth-form-control"
                       value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="180">
                <label class="auth-form-label" for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" class="auth-form-control" rows="3"
                    placeholder="Jl. Contoh No. 1, Kelurahan, Kecamatan, Kota" required>{{ old('alamat') }}</textarea>
            </div>

            {{-- Submit --}}
            <button type="submit" class="auth-btn" data-aos="zoom-in" data-aos-delay="200">
                🩸 Daftar Sekarang
            </button>
        </form>

        {{-- Footer --}}
        <div class="auth-footer" data-aos="fade-up" data-aos-delay="230">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
</div>
@endsection
