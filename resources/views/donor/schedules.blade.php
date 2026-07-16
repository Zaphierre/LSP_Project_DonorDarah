@extends('layouts.app')

@section('title', 'Jadwal Donor')

@push('styles')
<style>
/* ── Schedule card — light theme, h-full flex-col ── */
.schedule-card {
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 1.1rem 1.25rem;
    position: relative;
    overflow: hidden;
    transition: box-shadow .25s, transform .25s;
    box-shadow: 0 2px 10px rgba(0,0,0,.08), 0 1px 3px rgba(0,0,0,.05);
    /* Poin 3: equal height + push button to bottom */
    display: flex;
    flex-direction: column;
    height: 100%;
}
.schedule-card:hover {
    box-shadow: 0 10px 36px rgba(204,0,0,0.14);
    transform: translateY(-3px);
}
.schedule-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #CC0000, #FF4444);
}
.schedule-card.registered {
    border-color: #A7F3D0;
    background: #F0FFF8;
}
.schedule-date   { font-size:1rem; font-weight:800; color:#CC0000; margin-bottom:.25rem; }
.schedule-time   { font-size:.82rem; color:#64748B; margin-bottom:.35rem; }
.schedule-location { font-size:.85rem; color:#374151; font-weight:600; margin-bottom:.5rem; }
/* Poin 3: flex-grow on note so it pushes button down */
.schedule-note {
    font-size:.8rem; color:#64748B;
    line-height:1.55;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    flex-grow: 1;
    margin-bottom:.6rem;
}
.schedule-spacer { flex-grow: 1; } /* fallback spacer if no note */
.quota-bar-wrap  { display:flex; align-items:center; gap:.5rem; margin-bottom:.75rem; }
.quota-text      { font-size:.76rem; color:#64748B; white-space:nowrap; font-weight:600; }
.quota-bar-bg    { flex:1; height:6px; background:#F1F5F9; border-radius:99px; overflow:hidden; }
.quota-bar-fill  { height:100%; border-radius:99px; transition:width .3s; }
.registered-badge { position:absolute; top:.65rem; right:.65rem; }

/* ── Filter bar ── */
.filter-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: .75rem;
    background: #fff;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    padding: .85rem 1rem;
    margin-bottom: 1.25rem;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
}
.filter-group { display:flex; flex-direction:column; gap:.3rem; }
.filter-group label { font-size:.75rem; font-weight:600; color:#64748B; }
.filter-group input[type="date"] {
    border:1.5px solid #E2E8F0; border-radius:8px;
    padding:.45rem .75rem; font-size:.85rem;
    font-family:inherit; color:#0F172A;
    transition:border-color .2s;
    background:#F8FAFC;
}
.filter-group input[type="date"]:focus { outline:none; border-color:#CC0000; box-shadow:0 0 0 3px rgba(204,0,0,.1); }
</style>
@endpush

@section('content')
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

        {{-- Poin 1: Filter inline horizontal --}}
        <form method="GET" action="{{ route('donor.schedules') }}" data-aos="fade-up">
            <div class="filter-bar">
                <div class="filter-group">
                    <label for="dari">📆 Dari</label>
                    <input type="date" id="dari" name="dari"
                           value="{{ request('dari') }}"
                           min="{{ today()->toDateString() }}">
                </div>
                <div class="filter-group">
                    <label for="hingga">📆 Hingga</label>
                    <input type="date" id="hingga" name="hingga"
                           value="{{ request('hingga') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-sm" style="height:fit-content;">
                    🔍 Terapkan
                </button>
                @if(request()->hasAny(['dari','hingga']))
                    <a href="{{ route('donor.schedules') }}" class="btn btn-secondary btn-sm" style="height:fit-content;">
                        ✕ Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- Account not verified warning --}}
        @if(!Auth::user()->isAktif())
            <div class="alert alert-warning" data-aos="fade-down">
                ⚠️ Akun Anda belum diverifikasi. Anda tidak dapat mendaftar jadwal sebelum akun diaktifkan oleh admin.
            </div>
        @endif

        {{-- Schedule Cards Grid --}}
        @if($schedules->count() > 0)
            {{-- Poin 3: align-items:stretch agar semua card sama tinggi --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(270px,1fr));gap:1rem;align-items:stretch;">
                @foreach($schedules as $i => $s)
                    @php
                        $sisa       = $s->sisaKuota();
                        $pct        = $s->kuota > 0 ? min(100, ($s->kuota - $sisa) / $s->kuota * 100) : 100;
                        $registered = in_array($s->id, $registeredScheduleIds);
                        $barColor   = $pct > 80 ? '#EF4444' : ($pct > 50 ? '#F59E0B' : '#CC0000');
                        $delay      = ($i % 3) * 80;
                    @endphp

                    <div data-aos="zoom-in" data-aos-delay="{{ $delay }}" style="display:flex;">
                        <div class="schedule-card {{ $registered ? 'registered' : '' }}" style="flex:1;">

                            @if($registered)
                                <div class="registered-badge">
                                    <span class="badge badge-diterima">✅ Sudah Daftar</span>
                                </div>
                            @endif

                            {{-- Banner gambar jika ada --}}
                            @if($s->gambar)
                                <img src="{{ Storage::url($s->gambar) }}"
                                     alt="Banner"
                                     style="width:calc(100% + 2.5rem);margin:-1.1rem -1.25rem 0.85rem;
                                            aspect-ratio:16/9;object-fit:cover;border-radius:11px 11px 0 0;">
                            @endif

                            <p class="schedule-date">
                                {{ \Carbon\Carbon::parse($s->tanggal)->translatedFormat('d F Y') }}
                            </p>
                            <p class="schedule-time">⏰ {{ substr($s->waktu,0,5) }} WIB</p>
                            <p class="schedule-location">📍 {{ $s->lokasi }}</p>

                            {{-- Biaya --}}
                            @if($s->biaya > 0)
                                <p style="font-size:.8rem;font-weight:700;color:#CC0000;margin-bottom:.4rem;">
                                    💰 Rp {{ number_format($s->biaya,0,',','.') }}
                                </p>
                            @else
                                <p style="font-size:.8rem;font-weight:600;color:#10B981;margin-bottom:.4rem;">💚 Gratis</p>
                            @endif

                            {{-- Note — flex-grow pushes button down --}}
                            @if($s->keterangan)
                                <p class="schedule-note">{{ $s->keterangan }}</p>
                            @else
                                <div class="schedule-spacer"></div>
                            @endif

                            {{-- Quota bar --}}
                            <div class="quota-bar-wrap">
                                <span class="quota-text">Kuota: {{ $sisa }}/{{ $s->kuota }}</span>
                                <div class="quota-bar-bg">
                                    <div class="quota-bar-fill" style="width:{{ $pct }}%;background:{{ $barColor }};"></div>
                                </div>
                            </div>

                            {{-- Action Button — always at bottom --}}
                            @if(!$registered && Auth::user()->isAktif() && $sisa > 0)
                                <form method="POST" action="{{ route('donor.schedule.store') }}"
                                      onsubmit="return confirm('Konfirmasi pendaftaran jadwal ini?')">
                                    @csrf
                                    <input type="hidden" name="schedule_id" value="{{ $s->id }}">
                                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:auto;">
                                        🩸 Daftar Jadwal Ini
                                    </button>
                                </form>
                            @elseif($sisa <= 0 && !$registered)
                                <button class="btn btn-secondary"
                                        style="width:100%;justify-content:center;opacity:.6;cursor:not-allowed;margin-top:auto;" disabled>
                                    Kuota Penuh
                                </button>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <div class="card" style="text-align:center;padding:3rem;" data-aos="fade-up">
                <p style="font-size:2.5rem;margin-bottom:.75rem;">📅</p>
                <p style="font-weight:800;font-size:1.1rem;color:var(--text);margin-bottom:.5rem;">
                    Tidak Ada Jadwal Tersedia
                </p>
                <p style="color:var(--text-muted);">
                    @if(request()->hasAny(['dari','hingga']))
                        Tidak ada jadwal pada rentang tanggal tersebut. <a href="{{ route('donor.schedules') }}" style="color:#CC0000;">Reset filter</a>
                    @else
                        Saat ini belum ada jadwal donor yang dibuka. Silakan cek kembali nanti.
                    @endif
                </p>
            </div>
        @endif

    </div>
</div>
@endsection
