@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')
@section('page-title', 'Tambah Pengumuman')
@section('page-subtitle', 'Buat pengumuman baru untuk pendonor')

@section('content')
<div class="page-header">
    <div><h1>➕ Tambah Pengumuman</h1></div>
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card" style="max-width:700px;">
    @if($errors->any())
        <div class="alert alert-error">
            ❌
            <ul style="list-style:none;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.announcements.store') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="judul">Judul Pengumuman <span style="color:var(--red-primary);">*</span></label>
            <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul') }}" placeholder="Masukkan judul pengumuman" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="isi">Isi Pengumuman <span style="color:var(--red-primary);">*</span></label>
            <textarea id="isi" name="isi" class="form-control" rows="8" placeholder="Tulis isi pengumuman di sini..." required>{{ old('isi') }}</textarea>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label" for="tanggal_publish">Tanggal Publish <span style="color:var(--red-primary);">*</span></label>
                <input type="date" id="tanggal_publish" name="tanggal_publish" class="form-control" value="{{ old('tanggal_publish', today()->toDateString()) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <div style="display:flex;align-items:center;gap:.75rem;padding:.65rem 0;">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} style="accent-color:var(--red-primary);width:18px;height:18px;">
                    <label for="is_active" style="font-size:.9rem;cursor:pointer;">Aktifkan pengumuman ini</label>
                </div>
            </div>
        </div>
        <div style="display:flex;gap:.75rem;justify-content:flex-end;">
            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">📢 Publikasikan</button>
        </div>
    </form>
</div>
@endsection
