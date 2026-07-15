@extends('layouts.app')

@section('title', 'Jadwal Donor')

@push('styles')
<style>
/* ── Schedule card — light theme ── */
.schedule-card {
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
    transition: box-shadow .25s, transform .25s;
    box-shadow: 0 1px 8px rgba(0,0,0,.05);
}
.schedule-card:hover {
    box-shadow: 0 8px 32px rgba(204,0,0,0.12);
    transform: translateY(-3px);
}
/* Red top gradient bar */
.schedule-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #CC0000, #FF4444);
}
/* Registered state border */
.schedule-card.registered {
    border-color: #A7F3D0;
    background: #FAFFFE;
}

/* Date display */
.schedule-date {
    font-size: 1.05rem;
    font-weight: 800;
    color: #CC0000;
    margin-bottom: .35rem;
}
.schedule-time {
    font-size: .85rem;
    color: #64748B;
    margin-bottom: .45rem;
}
.schedule-location {
    font-size: .875rem;
    color: #374151;
    font-weight: 500;
    margin-bottom: .65rem;
}
.schedule-note {
    font-size: .85rem;
    color: #64748B;
    margin-bottom: .65rem;
    line-height: 1.6;
}

/* Quota bar */
.quota-bar-wrap {
    display: flex; align-items: center; gap: .6rem;
    margin-bottom: 1rem;
}
.quota-text { font-size: .8rem; color: #64748B; white-space: nowrap; }
.quota-bar-bg {
    flex: 1;
    height: 7px;
    background: #F1F5F9;
    border-radius: 99px;
    overflow: hidden;
}
.quota-bar-fill {
    height: 100%;
    border-radius: 99px;
    transition: width .3s;
}

/* Registered badge (absolute top-right) */
.registered-badge {
    position: absolute;
    top: .75rem; right: .75rem;
}
</style>
@endpush

@section('content')

{{-- Layout --}}
<div class="layout">

    {{-- ── Sidebar ── --}}
    <aside class="sidebar" data-aos="fade-right" data-aos-duration="500">
        <div class="card" style="text-align:center;">
            <div style="width:64px;height:64px;border-radius:50%;
                        background:linear-gradient(135deg,#CC0000,#FF4444);
                        display:flex;align-items:center;justify-content:center;
                        font-size:1.75rem;margin:0 auto .85rem;
                        box-shadow:0 6px 20px rgba(204,0,0,.25);">🩸</div>
            <p style="font-weight:700;font-size:.95rem;color:var(--text);">{{ Auth::user()->name }}</p>
            <div style="margin-top:.5rem;">
                @if(Auth::user()->status === 'aktif')
                    <span class="badge badge-aktif">✅ Akun Aktif</span>
                @else
                    <span class="badge badge-pending">⏳ Menunggu Verifikasi</span>
                @endif
            </div>
            <hr class="divider" style="margin:1.25rem 0;">
            <nav class="sidebar-nav" style="text-align:left;">
                <a href="{{ route('donor.dashboard') }}" class="sidebar-link">🏠 Dashboard</a>
                <a href="{{ route('donor.schedules') }}" class="sidebar-link active">📅 Jadwal Donor</a>
                <a href="{{ route('donor.announcements') }}" class="sidebar-link">📢 Pengumuman</a>
            </nav>
        </div>
    </aside>

    {{-- ── Content Area ── --}}
    <div class="content-area">
        <div class="page-header" data-aos="fade-up">
            <div>
                <h1>📅 Jadwal Donor Tersedia</h1>
                <p>Pilih jadwal yang sesuai dengan waktu Anda</p>
            </div>
        </div>

        {{-- Account not verified warning --}}
        @if(!Auth::user()->isAktif())
            <div class="alert alert-warning" data-aos="fade-down">
                ⚠️ Akun Anda belum diverifikasi. Anda tidak dapat mendaftar jadwal sebelum akun diaktifkan oleh admin.
            </div>
        @endif

        {{-- Schedule Cards Grid --}}
        @if($schedules->count() > 0)
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">
                @foreach($schedules as $i => $s)
                    @php
                        $sisa       = $s->sisaKuota();
                        $pct        = $s->kuota > 0 ? min(100, ($s->kuota - $sisa) / $s->kuota * 100) : 100;
                        $registered = in_array($s->id, $registeredScheduleIds);
                        $barColor   = $pct > 80 ? '#EF4444' : ($pct > 50 ? '#F59E0B' : '#CC0000');
                        $delay      = ($i % 3) * 80;
                    @endphp

                    {{-- AOS: staggered zoom-in per card --}}
                    <div class="schedule-card {{ $registered ? 'registered' : '' }}"
                         data-aos="zoom-in" data-aos-delay="{{ $delay }}">

                        {{-- Registered badge --}}
                        @if($registered)
                            <div class="registered-badge">
                                <span class="badge badge-diterima">✅ Sudah Daftar</span>
                            </div>
                        @endif

                        {{-- Date --}}
                        <p class="schedule-date">
                            {{ \Carbon\Carbon::parse($s->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p class="schedule-time">⏰ {{ substr($s->waktu,0,5) }} WIB</p>
                        <p class="schedule-location">📍 {{ $s->lokasi }}</p>

                        @if($s->keterangan)
                            <p class="schedule-note">{{ $s->keterangan }}</p>
                        @endif

                        {{-- Quota progress bar --}}
                        <div class="quota-bar-wrap">
                            <span class="quota-text">Kuota: {{ $sisa }}/{{ $s->kuota }}</span>
                            <div class="quota-bar-bg">
                                <div class="quota-bar-fill"
                                     style="width:{{ $pct }}%;background:{{ $barColor }};"></div>
                            </div>
                        </div>

                        {{-- Action Button --}}
                        @if(!$registered && Auth::user()->isAktif() && $sisa > 0)
                            <form method="POST" action="{{ route('donor.schedule.store') }}"
                                  onsubmit="return confirm('Konfirmasi pendaftaran jadwal ini?')">
                                @csrf
                                <input type="hidden" name="schedule_id" value="{{ $s->id }}">
                                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                                    🩸 Daftar Jadwal Ini
                                </button>
                            </form>
                        @elseif($sisa <= 0 && !$registered)
                            <button class="btn btn-secondary"
                                    style="width:100%;justify-content:center;opacity:.6;cursor:not-allowed;" disabled>
                                Kuota Penuh
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>

        @else
            {{-- Empty state --}}
            <div class="card" style="text-align:center;padding:3rem;" data-aos="fade-up">
                <p style="font-size:2.5rem;margin-bottom:.75rem;">📅</p>
                <p style="font-weight:800;font-size:1.1rem;color:var(--text);margin-bottom:.5rem;">
                    Tidak Ada Jadwal Tersedia
                </p>
                <p style="color:var(--text-muted);">
                    Saat ini belum ada jadwal donor yang dibuka. Silakan cek kembali nanti.
                </p>
            </div>
        @endif

    </div>{{-- /content-area --}}
</div>{{-- /layout --}}

@endsection
