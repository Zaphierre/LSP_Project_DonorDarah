@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')
@section('page-subtitle', 'Buat dan kelola pengumuman untuk pendonor')

@section('content')
<div class="page-header">
    <div><h1>📢 Daftar Pengumuman</h1></div>
    <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">➕ Tambah Pengumuman</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Isi (Preview)</th>
                    <th>Tgl. Publish</th>
                    <th>Status</th>
                    <th>Dibuat Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements as $a)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration + ($announcements->currentPage()-1)*$announcements->perPage() }}</td>
                    <td style="font-weight:600;max-width:200px;">{{ $a->judul }}</td>
                    <td style="font-size:.85rem;color:var(--text-muted);max-width:250px;">{{ Str::limit($a->isi, 80) }}</td>
                    <td style="font-size:.85rem;">{{ \Carbon\Carbon::parse($a->tanggal_publish)->format('d M Y') }}</td>
                    <td>
                        @if($a->is_active)
                            <span class="badge badge-aktif">✅ Aktif</span>
                        @else
                            <span class="badge badge-ditolak">❌ Nonaktif</span>
                        @endif
                    </td>
                    <td style="font-size:.85rem;color:var(--text-muted);">{{ $a->admin?->name ?? 'Admin' }}</td>
                    <td>
                        <div style="display:flex;gap:.4rem;">
                            <a href="{{ route('admin.announcements.edit', $a->id) }}" class="btn btn-secondary btn-sm">✏️ Edit</a>
                            <form method="POST" action="{{ route('admin.announcements.destroy', $a->id) }}" onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:2rem;color:var(--text-muted);">
                        Belum ada pengumuman. <a href="{{ route('admin.announcements.create') }}" style="color:var(--red-light);">Tambahkan sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:1rem;">{{ $announcements->links() }}</div>
</div>
@endsection
