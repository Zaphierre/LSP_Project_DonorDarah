@extends('layouts.admin')

@section('title', 'Kelola Jadwal')
@section('page-title', 'Kelola Jadwal Donor')
@section('page-subtitle', 'Tambah dan kelola jadwal donor darah')

@section('content')
<div class="page-header">
    <div><h1>🗓️ Daftar Jadwal Donor</h1></div>
    <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">➕ Tambah Jadwal</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal & Waktu</th>
                    <th>Lokasi</th>
                    <th>Kuota</th>
                    <th>Sisa Kuota</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $s)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration + ($schedules->currentPage()-1)*$schedules->perPage() }}</td>
                    <td>
                        <strong>{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</strong><br>
                        <span style="font-size:.8rem;color:var(--text-muted);">{{ substr($s->waktu,0,5) }} WIB</span>
                    </td>
                    <td style="max-width:220px;font-size:.875rem;">{{ $s->lokasi }}</td>
                    <td style="text-align:center;font-weight:700;">{{ $s->kuota }}</td>
                    <td style="text-align:center;">
                        @php $sisa = $s->sisaKuota(); @endphp
                        <span style="font-weight:700;color:{{ $sisa <= 0 ? 'var(--danger)' : ($sisa <= 5 ? 'var(--warning)' : 'var(--success)') }};">
                            {{ $sisa }}
                        </span>
                    </td>
                    <td>
                        @if($s->is_active)
                            <span class="badge badge-aktif">✅ Aktif</span>
                        @else
                            <span class="badge badge-ditolak">❌ Nonaktif</span>
                        @endif
                    </td>
                    <td style="font-size:.8rem;color:var(--text-muted);max-width:150px;">{{ Str::limit($s->keterangan, 60) ?? '—' }}</td>
                    <td>
                        <div style="display:flex;gap:.4rem;">
                            <a href="{{ route('admin.schedules.edit', $s->id) }}" class="btn btn-secondary btn-sm">✏️ Edit</a>
                            <form method="POST" action="{{ route('admin.schedules.destroy', $s->id) }}" onsubmit="return confirm('Hapus jadwal ini? Data pendaftaran terkait juga akan terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:2rem;color:var(--text-muted);">
                        Belum ada jadwal. <a href="{{ route('admin.schedules.create') }}" style="color:var(--red-light);">Tambahkan sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:1rem;">{{ $schedules->links() }}</div>
</div>
@endsection
