@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')
@section('page-title', 'Verifikasi Pembayaran')
@section('page-subtitle', 'Konfirmasi bukti pembayaran dari pendonor')

@section('content')
<div class="page-header">
    <div><h1>💳 Daftar Pembayaran</h1></div>
    <span style="font-size:.875rem;color:var(--text-muted);">Total: {{ $payments->total() }}</span>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pendonor</th>
                    <th>Jadwal</th>
                    <th>Biaya</th>
                    <th>Bukti Transfer</th>
                    <th>Tgl. Upload</th>
                    <th>Status</th>
                    <th>Catatan Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $p)
                <tr>
                    <td style="color:var(--text-muted);">{{ $loop->iteration + ($payments->currentPage()-1)*$payments->perPage() }}</td>
                    <td>
                        <p style="font-weight:600;">{{ $p->registration->user->pendonor?->nama_lengkap ?? $p->registration->user->name }}</p>
                        <p style="font-size:.75rem;color:var(--text-muted);">{{ $p->registration->user->email }}</p>
                    </td>
                    <td style="font-size:.85rem;">
                        <strong>{{ \Carbon\Carbon::parse($p->registration->schedule->tanggal)->format('d M Y') }}</strong>
                    </td>
                    <td style="font-weight:600;white-space:nowrap;">
                        @php $biaya = $p->registration->schedule->biaya ?? 0; @endphp
                        @if($biaya > 0)
                            Rp {{ number_format($biaya, 0, ',', '.') }}
                        @else
                            <span class="badge badge-diterima">Gratis</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $ext = pathinfo($p->bukti_transfer, PATHINFO_EXTENSION);
                            $url = Storage::url($p->bukti_transfer);
                        @endphp
                        @if(in_array(strtolower($ext), ['jpg','jpeg','png','webp']))
                            <img src="{{ $url }}"
                                 alt="Bukti"
                                 onclick="openImgModal('{{ $url }}')"
                                 style="width:60px;height:60px;object-fit:cover;border-radius:8px;
                                        cursor:pointer;border:1px solid var(--border);
                                        transition:transform .2s,box-shadow .2s;"
                                 onmouseover="this.style.transform='scale(1.08)';this.style.boxShadow='0 4px 12px rgba(0,0,0,.15)'"
                                 onmouseout="this.style.transform='';this.style.boxShadow=''"
                                 title="Klik untuk perbesar">
                        @else
                            <a href="{{ $url }}" target="_blank" class="btn btn-secondary btn-sm">📄 Lihat PDF</a>
                        @endif
                    </td>
                    <td style="font-size:.8rem;color:var(--text-muted);">{{ $p->created_at->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                    <td style="font-size:.8rem;color:var(--text-muted);max-width:150px;">{{ $p->catatan_admin ?? '—' }}</td>
                    <td>
                        @if($p->status === 'pending')
                        <form method="POST" action="{{ route('admin.payments.verify', $p->id) }}" style="display:flex;gap:.4rem;flex-wrap:wrap;">
                            @csrf
                            <button name="action" value="diterima" class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi pembayaran ini?')">✅ Terima</button>
                            <button name="action" value="ditolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran ini?')">❌ Tolak</button>
                        </form>
                        @else
                            <span style="font-size:.8rem;color:var(--text-subtle);">Sudah diproses</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center;padding:2rem;color:var(--text-muted);">Belum ada data pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:1rem;">{{ $payments->links() }}</div>
</div>
@endsection
