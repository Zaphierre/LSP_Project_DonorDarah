@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
<div class="layout">
    <aside class="sidebar">
        <div class="card">
            <div style="text-align:center;margin-bottom:1.25rem;">
                <div style="width:64px;height:64px;border-radius:50%;background:var(--red-primary);display:flex;align-items:center;justify-content:center;font-size:1.75rem;margin:0 auto .75rem;">🩸</div>
                <p style="font-weight:700;font-size:.95rem;">{{ Auth::user()->name }}</p>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('donor.dashboard') }}" class="sidebar-link">🏠 Dashboard</a>
                <a href="{{ route('donor.schedules') }}" class="sidebar-link">📅 Jadwal Donor</a>
                <a href="{{ route('donor.announcements') }}" class="sidebar-link active">📢 Pengumuman</a>
            </nav>
        </div>
    </aside>

    <div class="content-area">
        <div class="page-header">
            <div>
                <h1>📢 Pengumuman</h1>
                <p>Informasi dan pemberitahuan terbaru dari tim DonorHub</p>
            </div>
        </div>

        @if($announcements->count() > 0)
            <div style="display:flex;flex-direction:column;gap:1rem;">
                @foreach($announcements as $a)
                    <div class="card" style="border-left:3px solid var(--red-primary);">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
                            <h2 style="font-size:1rem;font-weight:700;">{{ $a->judul }}</h2>
                            <span style="font-size:.8rem;color:var(--text-subtle);flex-shrink:0;">
                                📅 {{ \Carbon\Carbon::parse($a->tanggal_publish)->format('d M Y') }}
                            </span>
                        </div>
                        <hr class="divider">
                        <p style="line-height:1.8;color:var(--text-muted);font-size:.9rem;">{{ $a->isi }}</p>
                        <p style="font-size:.75rem;color:var(--text-subtle);margin-top:1rem;">
                            Dipublikasikan oleh: {{ $a->admin?->name ?? 'Admin' }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $announcements->links() }}
            </div>
        @else
            <div class="card" style="text-align:center;padding:3rem;">
                <p style="font-size:2.5rem;">📢</p>
                <p style="font-weight:700;margin:.75rem 0 .5rem;">Belum Ada Pengumuman</p>
                <p style="color:var(--text-muted);">Pantau terus halaman ini untuk informasi terbaru.</p>
            </div>
        @endif
    </div>
</div>
@endsection
