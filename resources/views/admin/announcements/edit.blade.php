@extends('layouts.admin')
@section('title', 'Edit Pengumuman')
@section('page-title', 'Edit Pengumuman')
@section('page-subtitle', 'Perbarui isi pengumuman')

@section('content')
<div class="page-header">
    <div><h1>✏️ Edit Pengumuman</h1></div>
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card" style="max-width:700px;">
    @if($errors->any())
        <div class="alert alert-error">❌
            <ul style="list-style:none;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.announcements.update', $announcement->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label" for="judul">Judul <span style="color:var(--red-primary);">*</span></label>
            <input type="text" id="judul" name="judul" class="form-control"
                   value="{{ old('judul', $announcement->judul) }}" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="isi">Isi Pengumuman <span style="color:var(--red-primary);">*</span></label>
            <textarea id="isi" name="isi" class="form-control" rows="8" required>{{ old('isi', $announcement->isi) }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="gambar">Gambar Banner (Opsional)</label>
            @if($announcement->gambar)
                <div style="margin-bottom:.6rem;">
                    <p style="font-size:.78rem;color:var(--text-muted);margin-bottom:.35rem;">Gambar saat ini:</p>
                    <img src="{{ Storage::url($announcement->gambar) }}"
                         style="width:100%;max-width:320px;aspect-ratio:16/9;object-fit:cover;border-radius:8px;border:1px solid var(--border);"
                         alt="Banner">
                </div>
            @endif
            <input type="file" id="gambar" name="gambar" class="form-control"
                   accept="image/jpg,image/jpeg,image/png,image/webp"
                   onchange="previewImg(this,'img-preview')">
            <p style="font-size:.75rem;color:var(--text-muted);margin-top:.3rem;">Upload baru untuk mengganti. JPG/PNG/WEBP, maks 5MB.</p>
            <img id="img-preview" src="" alt=""
                 style="display:none;margin-top:.6rem;width:100%;max-width:380px;aspect-ratio:16/9;object-fit:cover;border-radius:8px;border:1px solid var(--border);">
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label" for="tanggal_publish">Tanggal Publish</label>
                <input type="date" id="tanggal_publish" name="tanggal_publish" class="form-control"
                       value="{{ old('tanggal_publish', $announcement->tanggal_publish->toDateString()) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <div style="display:flex;align-items:center;gap:.75rem;padding:.65rem 0;">
                    <input type="checkbox" id="is_active" name="is_active" value="1"
                           {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}
                           style="accent-color:var(--red-primary);width:18px;height:18px;">
                    <label for="is_active" style="font-size:.9rem;cursor:pointer;">Aktifkan pengumuman ini</label>
                </div>
            </div>
        </div>
        <div style="display:flex;gap:.75rem;justify-content:flex-end;">
            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImg(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    } else { preview.src = ''; preview.style.display = 'none'; }
}
</script>
@endpush