@extends('layouts.admin')

@section('title', 'Verifikasi Pendaftaran Jadwal')
@section('page-title', 'Verifikasi Pendaftaran Jadwal')
@section('page-subtitle', 'Kelola pendaftaran jadwal donor dari pendonor')

@section('content')
<div class="page-header">
    <div><h1>📋 Daftar Pendaftaran Jadwal</h1></div>
    <span style="font-size:.875rem;color:var(--text-muted);">Total: {{ $registrations->total() }}</span>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pendonor</th>
                    <th>Jadwal</th>
                    <th>Lokasi</th>
                    <th>Tgl. Daftar</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $reg)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration + ($registrations->currentPage()-1)*$registrations->perPage() }}</td>
                    <td>
                        <p style="font-weight:600;">{{ $reg->user->pendonor?->nama_lengkap ?? $reg->user->name }}</p>
                        <p style="font-size:.75rem;color:var(--red-light);">Gol. {{ $reg->user->pendonor?->golongan_darah ?? '—' }}</p>
                    </td>
                    <td>
                        <strong>{{ \Carbon\Carbon::parse($reg->schedule->tanggal)->format('d M Y') }}</strong><br>
                        <span style="font-size:.75rem;color:var(--text-muted);">{{ substr($reg->schedule->waktu,0,5) }} WIB</span>
                    </td>
                    <td style="font-size:.85rem;max-width:180px;">{{ $reg->schedule->lokasi }}</td>
                    <td style="font-size:.8rem;color:var(--text-muted);">{{ $reg->created_at->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $reg->status }}">{{ ucfirst($reg->status) }}</span></td>
                    <td style="font-size:.8rem;color:var(--text-muted);max-width:150px;">{{ $reg->catatan ?? '—' }}</td>
                    <td>
                        @if($reg->status === 'pending')
                        <form method="POST" action="{{ route('admin.registrations.verify', $reg->id) }}" style="display:flex;gap:.4rem;flex-wrap:wrap;">
                            @csrf
                            <button name="action" value="diterima" class="btn btn-success btn-sm" onclick="return confirm('Terima pendaftaran ini?')">✅ Terima</button>
                            <button name="action" value="ditolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pendaftaran ini?')">❌ Tolak</button>
                        </form>
                        @else
                            <span style="font-size:.8rem;color:var(--text-subtle);">Sudah diproses</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:2rem;color:var(--text-muted);">Belum ada pendaftaran jadwal.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:1rem;">{{ $registrations->links() }}</div>
</div>
@endsection
