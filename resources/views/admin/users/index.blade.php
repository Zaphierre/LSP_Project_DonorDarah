@extends('layouts.admin')

@section('title', 'Verifikasi Akun')
@section('page-title', 'Verifikasi Akun Pendonor')
@section('page-subtitle', 'Kelola dan verifikasi pendaftaran akun pendonor')

@section('content')
<div class="page-header">
    <div><h1>👥 Daftar Pendonor</h1></div>
    <div style="display:flex;gap:.5rem;align-items:center;">
        <span style="font-size:.875rem;color:var(--text-muted);">Total: {{ $users->total() }} pendonor</span>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Gol. Darah</th>
                    <th>No. HP</th>
                    <th>Tgl. Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}</td>
                    <td>
                        <p style="font-weight:600;">{{ $u->pendonor?->nama_lengkap ?? $u->name }}</p>
                        <p style="font-size:.75rem;color:var(--text-muted);">{{ $u->pendonor?->jenis_kelamin }}</p>
                    </td>
                    <td style="font-size:.85rem;">{{ $u->email }}</td>
                    <td><span style="font-weight:700;color:var(--red-light);font-size:1rem;">{{ $u->pendonor?->golongan_darah ?? '—' }}</span></td>
                    <td style="font-size:.85rem;">{{ $u->pendonor?->no_hp ?? '—' }}</td>
                    <td style="font-size:.8rem;color:var(--text-muted);">{{ $u->created_at->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $u->status }}">{{ ucfirst($u->status) }}</span></td>
                    <td>
                        @if($u->status === 'pending')
                            <form method="POST" action="{{ route('admin.users.verify', $u->id) }}" style="display:flex;gap:.4rem;">
                                @csrf
                                <button name="action" value="aktif" class="btn btn-success btn-sm" onclick="return confirm('Aktifkan akun ini?')">✅ Aktifkan</button>
                                <button name="action" value="ditolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak akun ini?')">❌ Tolak</button>
                            </form>
                        @elseif($u->status === 'aktif')
                            <form method="POST" action="{{ route('admin.users.verify', $u->id) }}">
                                @csrf
                                <button name="action" value="ditolak" class="btn btn-danger btn-sm" onclick="return confirm('Nonaktifkan akun ini?')">🚫 Nonaktifkan</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.users.verify', $u->id) }}">
                                @csrf
                                <button name="action" value="aktif" class="btn btn-success btn-sm" onclick="return confirm('Aktifkan kembali akun ini?')">↩️ Aktifkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:2rem;color:var(--text-muted);">Belum ada data pendonor.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:1rem;">{{ $users->links() }}</div>
</div>
@endsection
