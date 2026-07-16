@extends('layouts.app')

@section('title', 'Dashboard Pendonor')

@push('styles')
<style>
/* ── Dashboard-specific overrides for light theme ── */

/* Profile avatar circle */
.profile-avatar {
    width: 68px; height: 68px;
    border-radius: 50%;
    background: linear-gradient(135deg, #CC0000, #FF4444);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.85rem;
    margin: 0 auto .85rem;
    box-shadow: 0 6px 20px rgba(204,0,0,0.25);
}

/* Sidebar user name */
.sidebar-user-name {
    font-weight: 700;
    font-size: .95rem;
    color: var(--text);
    text-align: center;
}
.sidebar-user-email {
    font-size: .78rem;
    color: var(--text-muted);
    text-align: center;
    margin-top: .2rem;
}
.sidebar-user-badge {
    text-align: center;
    margin-top: .6rem;
}

/* Stat card left border accent */
.stat-card-accent {
    position: relative;
    overflow: hidden;
}
.stat-card-accent::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    border-radius: 3px 0 0 3px;
}
.stat-card-accent.red-accent::before   { background: #CC0000; }
.stat-card-accent.green-accent::before { background: #10B981; }
.stat-card-accent.yellow-accent::before{ background: #F59E0B; }

/* Table - light theme overrides */
.light-table thead th {
    background: #F8FAFC;
    color: #64748B;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .06em;
}
.light-table tbody tr:hover { background: #FFF5F5; }

/* Announcement item */
.announcement-item {
    border-bottom: 1px solid var(--border-light);
    padding: .85rem 0;
    display: flex;
    gap: .85rem;
    align-items: flex-start;
}
.announcement-item:last-child { border-bottom: none; }
.announcement-pin { color: #CC0000; margin-top: .1rem; flex-shrink: 0; }

/* Empty state */
.empty-state {
    text-align: center;
    padding: 2.5rem 1rem;
}
.empty-state .empty-icon { font-size: 2.5rem; margin-bottom: .75rem; display: block; }
.empty-state p { color: var(--text-muted); font-size: .9rem; }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════════════════════
     DONOR DASHBOARD — Light Theme
     Layout: sidebar (left) + content area (right)
     ══════════════════════════════════════════════════════════════ --}}
<div class="layout">

    {{-- ── Sidebar ──────────────────────────────────────────────── --}}
    <aside class="sidebar" data-aos="fade-right" data-aos-duration="500">
        <div class="card" style="text-align:center;">

            {{-- Profile Avatar --}}
            <div class="profile-avatar">🩸</div>

            {{-- User Info --}}
            <p class="sidebar-user-name">{{ Auth::user()->name }}</p>
            <p class="sidebar-user-email">{{ Auth::user()->email }}</p>

            {{-- Account Status Badge --}}
            <div class="sidebar-user-badge">
                @if(Auth::user()->status === 'aktif')
                    <span class="badge badge-aktif">✅ Akun Aktif</span>
                @elseif(Auth::user()->status === 'pending')
                    <span class="badge badge-pending">⏳ Menunggu Verifikasi</span>
                @else
                    <span class="badge badge-ditolak">❌ Akun Ditolak</span>
                @endif
            </div>

            {{-- Divider --}}
            <hr class="divider" style="margin: 1.25rem 0;">

            {{-- Sidebar Navigation --}}
            <nav class="sidebar-nav" style="text-align:left;">
                <a href="{{ route('donor.dashboard') }}"
                   class="sidebar-link {{ request()->is('donor/dashboard') ? 'active' : '' }}">
                    <span class="sidebar-icon">🏠</span> Dashboard
                </a>
                <a href="{{ route('donor.schedules') }}"
                   class="sidebar-link {{ request()->is('donor/jadwal') ? 'active' : '' }}">
                    <span class="sidebar-icon">📅</span> Jadwal Donor
                </a>
                <a href="{{ route('donor.announcements') }}"
                   class="sidebar-link {{ request()->is('donor/pengumuman') ? 'active' : '' }}">
                    <span class="sidebar-icon">📢</span> Pengumuman
                </a>
            </nav>
        </div>
    </aside>

    {{-- ── Content Area ─────────────────────────────────────────── --}}
    <div class="content-area">

        {{-- Account Status Warnings --}}
        @if(Auth::user()->status === 'pending')
            <div class="alert alert-warning" data-aos="fade-down">
                ⏳ <strong>Akun Anda sedang menunggu verifikasi admin.</strong>
                Setelah diverifikasi, Anda dapat mendaftar jadwal donor.
            </div>
        @elseif(Auth::user()->status === 'ditolak')
            <div class="alert alert-error" data-aos="fade-down">
                ❌ <strong>Akun Anda ditolak oleh admin.</strong>
                Silakan hubungi admin untuk informasi lebih lanjut.
            </div>
        @endif

        {{-- Page Header --}}
        <div class="page-header" data-aos="fade-up">
            <div>
                <h1>Dashboard Pendonor</h1>
                <p>Selamat datang, <strong>{{ $pendonor?->nama_lengkap ?? Auth::user()->name }}</strong>! 👋</p>
            </div>
            @if(Auth::user()->isAktif())
                <a href="{{ route('donor.schedules') }}" class="btn btn-primary">
                    🩸 Daftar Jadwal
                </a>
            @endif
        </div>

        <!-- {{-- ── Stat Cards ─────────────────────────────────────────── --}}
        {{-- AOS: each card fades up with staggered delay --}}
        <div class="grid-3" style="margin-bottom:1.75rem;">

            {{-- Total Pendaftaran --}}
            <div class="stat-card stat-card-accent red-accent" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-icon red">📋</div>
                <div>
                    <div class="stat-value" style="color:#CC0000;">{{ $registrations->count() }}</div>
                    <div class="stat-label">Total Pendaftaran</div>
                </div>
            </div>

            {{-- Jadwal Diterima --}}
            <div class="stat-card stat-card-accent green-accent" data-aos="fade-up" data-aos-delay="80">
                <div class="stat-icon green">✅</div>
                <div>
                    <div class="stat-value" style="color:#059669;">{{ $registrations->where('status','diterima')->count() }}</div>
                    <div class="stat-label">Jadwal Diterima</div>
                </div>
            </div>

            {{-- Menunggu Verifikasi --}}
            <div class="stat-card stat-card-accent yellow-accent" data-aos="fade-up" data-aos-delay="160">
                <div class="stat-icon yellow">⏳</div>
                <div>
                    <div class="stat-value" style="color:#D97706;">{{ $registrations->where('status','pending')->count() }}</div>
                    <div class="stat-label">Menunggu Verifikasi</div>
                </div>
            </div>
        </div> -->

        {{-- ── Profil Pendonor ─────────────────────────────────────── --}}
        @if($pendonor)
        <div class="card" style="margin-bottom:1.5rem;" data-aos="fade-up" data-aos-delay="50">
            <div class="card-header">
                <h2>👤 Profil Pendonor</h2>
            </div>
            <div class="grid-2">
                <div>
                    <p style="font-size:.8rem;color:var(--text-muted);font-weight:500;margin-bottom:.25rem;">Nama Lengkap</p>
                    <p style="font-weight:700;color:var(--text);">{{ $pendonor->nama_lengkap }}</p>
                </div>
                <div>
                    <p style="font-size:.8rem;color:var(--text-muted);font-weight:500;margin-bottom:.25rem;">Golongan Darah</p>
                    <p style="font-weight:700;font-size:1.1rem;color:#CC0000;">{{ $pendonor->golongan_darah }}</p>
                </div>
                <div>
                    <p style="font-size:.8rem;color:var(--text-muted);font-weight:500;margin-bottom:.25rem;">Jenis Kelamin</p>
                    <p style="font-weight:600;color:var(--text);">{{ $pendonor->jenis_kelamin }}</p>
                </div>
                <div>
                    <p style="font-size:.8rem;color:var(--text-muted);font-weight:500;margin-bottom:.25rem;">No. HP</p>
                    <p style="font-weight:600;color:var(--text);">{{ $pendonor->no_hp }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- ── Riwayat Pendaftaran ──────────────────────────────────── --}}
        <div class="card" style="margin-bottom:1.5rem;" data-aos="fade-up" data-aos-delay="80">
            <div class="card-header">
                <h2>📋 Riwayat Pendaftaran Jadwal</h2>
                <p>Status pendaftaran jadwal donor Anda</p>
            </div>

            @if($registrations->count() > 0)
                <div class="table-wrap">
                    <table class="light-table">
                        <thead>
                            <tr>
                                <th>Jadwal</th>
                                <th>Lokasi</th>
                                <th>Status Daftar</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $reg)
                            <tr>
                                <td>
                                    <strong style="color:var(--text);">
                                        {{ \Carbon\Carbon::parse($reg->schedule->tanggal)->format('d M Y') }}
                                    </strong><br>
                                    <span style="font-size:.8rem;color:var(--text-muted);">
                                        {{ substr($reg->schedule->waktu,0,5) }} WIB
                                    </span>
                                </td>
                                <td style="font-size:.875rem;color:var(--text);">{{ $reg->schedule->lokasi }}</td>
                                <td>
                                    <span class="badge badge-{{ $reg->status }}">{{ ucfirst($reg->status) }}</span>
                                </td>
                                <td>
                                    @if($reg->payment)
                                        <span class="badge badge-{{ $reg->payment->status }}">{{ ucfirst($reg->payment->status) }}</span>
                                    @elseif($reg->status === 'diterima')
                                        <span class="badge badge-pending">Belum Upload</span>
                                    @else
                                        <span style="color:var(--text-subtle);font-size:.8rem;">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($reg->status === 'diterima' && !$reg->payment)
                                        @if(($reg->schedule->biaya ?? 0) > 0)
                                            <button onclick="openPaymentModal({{ $reg->id }}, {{ $reg->schedule->biaya }})"
                                                    class="btn btn-primary btn-sm">💳 Upload Bukti</button>
                                        @else
                                            <span class="badge badge-diterima">✅ Gratis</span>
                                        @endif
                                    @endif
                                    @if($reg->catatan)
                                        <span style="font-size:.75rem;color:var(--text-muted);display:block;margin-top:.25rem;">
                                            💬 {{ $reg->catatan }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <span class="empty-icon">📋</span>
                    <p>Belum ada pendaftaran jadwal.</p>
                    @if(Auth::user()->isAktif())
                        <a href="{{ route('donor.schedules') }}" class="btn btn-primary" style="margin-top:1rem;">
                            Daftar Sekarang
                        </a>
                    @endif
                </div>
            @endif
        </div>

        {{-- ── Pengumuman Terbaru ───────────────────────────────────── --}}
        @if($announcements->count() > 0)
        <div class="card" data-aos="fade-up" data-aos-delay="120">
            <div class="card-header">
                <h2>📢 Pengumuman Terbaru</h2>
            </div>
            @foreach($announcements as $a)
                <div class="announcement-item">
                    <span class="announcement-pin">📌</span>
                    <div>
                        <p style="font-weight:700;font-size:.9rem;color:var(--text);">{{ $a->judul }}</p>
                        <p style="font-size:.85rem;color:var(--text-muted);margin-top:.25rem;line-height:1.6;">
                            {{ Str::limit($a->isi, 120) }}
                        </p>
                        <p style="font-size:.75rem;color:var(--text-subtle);margin-top:.35rem;">
                            {{ \Carbon\Carbon::parse($a->tanggal_publish)->format('d M Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

    </div>{{-- /content-area --}}
</div>{{-- /layout --}}

{{-- ── Payment Modal ──────────────────────────────────────────── --}}
{{-- Light theme modal with white card --}}
<div id="paymentModal"
     style="display:none;position:fixed;inset:0;background:rgba(15,23,42,.5);
            backdrop-filter:blur(4px);z-index:999;align-items:center;justify-content:center;">
    <div class="card" style="width:100%;max-width:480px;box-shadow:0 20px 60px rgba(0,0,0,.2);"
         data-aos="zoom-in">
        <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
            <h2>💳 Upload Bukti Pembayaran</h2>
            <button onclick="closePaymentModal()"
                    style="background:none;border:none;color:var(--text-muted);cursor:pointer;
                           font-size:1.25rem;padding:.25rem;border-radius:6px;transition:background .2s;"
                    onmouseenter="this.style.background='#F1F5F9'"
                    onmouseleave="this.style.background='none'">✕</button>
        </div>
        <form method="POST" action="{{ route('donor.payment.upload') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="registration_id" id="modalRegId">
            {{-- Poin 6: Nominal read-only, diambil dari biaya jadwal --}}
            <div class="form-group">
                <label class="form-label">Biaya Pendaftaran</label>
                <div id="modalNominalDisplay"
                     style="padding:.65rem 1rem;background:#F8FAFC;border:1.5px solid #E2E8F0;
                            border-radius:8px;font-size:.95rem;font-weight:700;color:#0F172A;">
                    Rp 0
                </div>
                <p style="font-size:.75rem;color:var(--text-muted);margin-top:.3rem;">
                    Nominal ditetapkan oleh admin dan tidak dapat diubah.
                </p>
            </div>
            <div class="form-group">
                <label class="form-label">Bukti Transfer <span style="color:var(--red-primary);">*</span></label>
                <input type="file" name="bukti_transfer" class="form-control"
                       accept=".jpg,.jpeg,.png,.pdf" required>
                <p style="font-size:.75rem;color:var(--text-muted);margin-top:.3rem;">Format: JPG, PNG, atau PDF. Maks 2MB.</p>
            </div>
            <div style="display:flex;gap:.75rem;">
                <button type="button" onclick="closePaymentModal()"
                        class="btn btn-secondary" style="flex:1;">Batal</button>
                <button type="submit" class="btn btn-primary" style="flex:1;">Upload Sekarang</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openPaymentModal(regId, biaya) {
    document.getElementById('modalRegId').value = regId;
    const formatted = biaya > 0
        ? 'Rp ' + Number(biaya).toLocaleString('id-ID')
        : 'Gratis';
    document.getElementById('modalNominalDisplay').textContent = formatted;
    document.getElementById('paymentModal').style.display = 'flex';
}
function closePaymentModal() {
    document.getElementById('paymentModal').style.display = 'none';
}
document.getElementById('paymentModal').addEventListener('click', function(e) {
    if (e.target === this) closePaymentModal();
});
</script>
@endpush
