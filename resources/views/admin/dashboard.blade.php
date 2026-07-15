@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan aktivitas sistem donor darah')

@section('content')
{{-- Stats Grid --}}
<div class="grid-4" style="margin-bottom:1.75rem;">
    <div class="stat-card">
        <div class="stat-icon red">🩸</div>
        <div>
            <div class="stat-value">{{ $stats['total_pendonor'] }}</div>
            <div class="stat-label">Total Pendonor</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow">⏳</div>
        <div>
            <div class="stat-value">{{ $stats['pending_akun'] }}</div>
            <div class="stat-label">Akun Pending</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">📋</div>
        <div>
            <div class="stat-value">{{ $stats['total_registrasi'] }}</div>
            <div class="stat-label">Total Pendaftaran</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">💳</div>
        <div>
            <div class="stat-value">{{ $stats['pending_payment'] }}</div>
            <div class="stat-label">Pembayaran Pending</div>
        </div>
    </div>
</div>

<div class="grid-2" style="gap:1.5rem;">
    {{-- Pendonor Pending --}}
    <div class="card">
        <div class="card-header">
            <div>
                <h2>👥 Akun Pending Verifikasi</h2>
                <p>{{ $stats['pending_akun'] }} menunggu persetujuan</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        @if($pendonor_pending->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Golongan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendonor_pending as $u)
                        <tr>
                            <td>
                                <p style="font-weight:600;font-size:.875rem;">{{ $u->pendonor?->nama_lengkap ?? $u->name }}</p>
                                <p style="font-size:.75rem;color:var(--text-muted);">{{ $u->email }}</p>
                            </td>
                            <td><span style="font-weight:700;color:var(--red-light);">{{ $u->pendonor?->golongan_darah ?? '—' }}</span></td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.verify', $u->id) }}" style="display:flex;gap:.4rem;">
                                    @csrf
                                    <button name="action" value="aktif" class="btn btn-success btn-sm" onclick="return confirm('Aktifkan akun ini?')">✅</button>
                                    <button name="action" value="ditolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak akun ini?')">❌</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align:center;padding:2rem;color:var(--text-muted);">
                <p>🎉 Tidak ada akun pending.</p>
            </div>
        @endif
    </div>

    {{-- Registrasi Pending --}}
    <div class="card">
        <div class="card-header">
            <div>
                <h2>📋 Pendaftaran Jadwal Pending</h2>
                <p>{{ $stats['pending_registrasi'] }} menunggu persetujuan</p>
            </div>
            <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        @if($registrasi_pending->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Pendonor</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrasi_pending as $reg)
                        <tr>
                            <td style="font-size:.875rem;font-weight:600;">{{ $reg->user->pendonor?->nama_lengkap ?? $reg->user->name }}</td>
                            <td style="font-size:.8rem;color:var(--text-muted);">{{ \Carbon\Carbon::parse($reg->schedule->tanggal)->format('d M Y') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.registrations.verify', $reg->id) }}" style="display:flex;gap:.4rem;">
                                    @csrf
                                    <button name="action" value="diterima" class="btn btn-success btn-sm" onclick="return confirm('Terima pendaftaran ini?')">✅</button>
                                    <button name="action" value="ditolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pendaftaran ini?')">❌</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align:center;padding:2rem;color:var(--text-muted);">
                <p>🎉 Tidak ada pendaftaran pending.</p>
            </div>
        @endif
    </div>

    {{-- Pembayaran Pending --}}
    <div class="card" style="grid-column:1/-1;">
        <div class="card-header">
            <div>
                <h2>💳 Pembayaran Pending Konfirmasi</h2>
                <p>{{ $stats['pending_payment'] }} pembayaran belum dikonfirmasi</p>
            </div>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        @if($payment_pending->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Pendonor</th>
                            <th>Jadwal</th>
                            <th>Nominal</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payment_pending as $p)
                        <tr>
                            <td style="font-size:.875rem;font-weight:600;">{{ $p->registration->user->pendonor?->nama_lengkap ?? $p->registration->user->name }}</td>
                            <td style="font-size:.8rem;color:var(--text-muted);">{{ \Carbon\Carbon::parse($p->registration->schedule->tanggal)->format('d M Y') }}</td>
                            <td style="font-weight:700;">{{ $p->nominal ? 'Rp ' . number_format($p->nominal,0,',','.') : '—' }}</td>
                            <td>
                                <a href="{{ Storage::url($p->bukti_transfer) }}" target="_blank" class="btn btn-secondary btn-sm">🖼️ Lihat</a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.payments.verify', $p->id) }}" style="display:flex;gap:.4rem;">
                                    @csrf
                                    <button name="action" value="diterima" class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi pembayaran ini?')">✅ Terima</button>
                                    <button name="action" value="ditolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran ini?')">❌ Tolak</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align:center;padding:2rem;color:var(--text-muted);">
                <p>🎉 Tidak ada pembayaran pending.</p>
            </div>
        @endif
    </div>
</div>
@endsection
