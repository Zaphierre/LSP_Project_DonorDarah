@extends('layouts.admin')
@section('title', 'Edit Jadwal')
@section('page-title', 'Edit Jadwal Donor')
@section('page-subtitle', 'Perbarui informasi jadwal donor')

@section('content')
<div class="page-header">
    <div><h1>✏️ Edit Jadwal Donor</h1></div>
    <a href="{{ route('admin.schedules') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card" style="max-width:720px;">
    @if($errors->any())
        <div class="alert alert-error">❌
            <ul style="list-style:none;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}" id="scheduleForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="gambar_b64" id="gambar_b64">

        <div class="grid-2">
            <div class="form-group">
                <label class="form-label" for="tanggal">Tanggal Donor <span style="color:var(--red-primary);">*</span></label>
                <input type="date" id="tanggal" name="tanggal" class="form-control"
                       value="{{ old('tanggal', $schedule->tanggal->toDateString()) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="waktu">Waktu Mulai <span style="color:var(--red-primary);">*</span></label>
                <input type="time" id="waktu" name="waktu" class="form-control"
                       value="{{ old('waktu', substr($schedule->waktu,0,5)) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="lokasi">Lokasi <span style="color:var(--red-primary);">*</span></label>
            @php
                $lokasiList    = config('locations', []);
                $currentLokasi = old('lokasi', $schedule->lokasi);
                $isKnown       = in_array($currentLokasi, $lokasiList);
            @endphp
            <select id="lokasi" name="lokasi" class="form-control" required
                    onchange="checkOtherLokasi(this)">
                <option value="">&mdash; Pilih Lokasi &mdash;</option>
                @foreach($lokasiList as $loc)
                    <option value="{{ $loc }}" {{ $currentLokasi === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                @endforeach
                <option value="__other__" {{ (!$isKnown && $currentLokasi) ? 'selected' : '' }}>✏️ Lainnya (ketik manual)…</option>
            </select>
            <input type="text" id="lokasi_manual" name="lokasi_manual" class="form-control"
                   placeholder="Tulis nama lokasi lengkap…"
                   value="{{ !$isKnown ? $currentLokasi : '' }}"
                   style="margin-top:.5rem;display:{{ (!$isKnown && $currentLokasi) ? 'block' : 'none' }};">
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label class="form-label" for="kuota">Kuota Pendonor <span style="color:var(--red-primary);">*</span></label>
                <input type="number" id="kuota" name="kuota" class="form-control"
                       value="{{ old('kuota', $schedule->kuota) }}" min="1" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="biaya">Biaya Pendaftaran (Rp)</label>
                <input type="number" id="biaya" name="biaya" class="form-control"
                       value="{{ old('biaya', $schedule->biaya ?? 0) }}" min="0" placeholder="0 = Gratis">
                <p style="font-size:.75rem;color:var(--text-muted);margin-top:.3rem;">Isi 0 jika pendaftaran gratis.</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="keterangan">Keterangan (Opsional)</label>
            <textarea id="keterangan" name="keterangan" class="form-control" rows="3">{{ old('keterangan', $schedule->keterangan) }}</textarea>
        </div>

        {{-- ── Gambar Banner ── --}}
        <div class="form-group">
            <label class="form-label">Gambar Banner</label>

            {{-- Existing image --}}
            @if($schedule->gambar)
                <div style="margin-bottom:.75rem;">
                    <p style="font-size:.8rem;color:var(--text-muted);margin-bottom:.4rem;">Gambar saat ini:</p>
                    <img src="{{ Storage::url($schedule->gambar) }}"
                         style="width:100%;max-width:320px;aspect-ratio:16/9;object-fit:cover;border-radius:10px;border:1px solid var(--border);">
                </div>
            @endif

            <input type="file" id="gambar_file" accept="image/*" class="form-control" style="margin-bottom:.75rem;">
            <p style="font-size:.75rem;color:var(--text-muted);margin-bottom:.75rem;">Unggah gambar baru untuk mengganti yang lama (rasio 16:9).</p>

            <div id="crop-area" style="display:none;">
                <div style="position:relative;max-height:360px;overflow:hidden;background:#F1F5F9;border-radius:10px;border:1px solid var(--border);margin-bottom:.75rem;">
                    <img id="crop-img" src="" style="display:block;max-width:100%;">
                </div>
                <div style="display:flex;gap:.5rem;margin-bottom:.75rem;">
                    <button type="button" id="do-crop" class="btn btn-primary btn-sm">✂️ Terapkan Crop</button>
                    <button type="button" id="cancel-crop" class="btn btn-secondary btn-sm">✕ Batal</button>
                </div>
            </div>
            <div id="preview-area" style="display:none;margin-top:.5rem;">
                <p style="font-size:.8rem;font-weight:600;color:var(--text);margin-bottom:.4rem;">Preview Baru:</p>
                <img id="preview-img" src="" style="width:100%;max-width:400px;aspect-ratio:16/9;object-fit:cover;border-radius:10px;border:1px solid var(--border);">
            </div>
        </div>

        <div class="form-group">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       {{ old('is_active', $schedule->is_active) ? 'checked' : '' }}
                       style="accent-color:var(--red-primary);width:18px;height:18px;cursor:pointer;">
                <label for="is_active" style="font-size:.9rem;cursor:pointer;font-weight:500;">Aktifkan jadwal ini (tampil ke pendonor)</label>
            </div>
        </div>

        <div style="display:flex;gap:.75rem;justify-content:flex-end;">
            <a href="{{ route('admin.schedules') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script>
let cropper = null;
const fileInput   = document.getElementById('gambar_file');
const cropArea    = document.getElementById('crop-area');
const previewArea = document.getElementById('preview-area');
const cropImg     = document.getElementById('crop-img');
const previewImg  = document.getElementById('preview-img');
const b64Input    = document.getElementById('gambar_b64');

fileInput.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        cropImg.src = e.target.result;
        cropArea.style.display = 'block';
        previewArea.style.display = 'none';
        b64Input.value = '';
        if (cropper) { cropper.destroy(); }
        cropper = new Cropper(cropImg, {
            aspectRatio: 16/9, viewMode: 2, dragMode: 'move', autoCropArea: 1,
        });
    };
    reader.readAsDataURL(file);
});
document.getElementById('do-crop').addEventListener('click', function() {
    if (!cropper) return;
    const canvas = cropper.getCroppedCanvas({ width: 1280, height: 720 });
    const dataUrl = canvas.toDataURL('image/jpeg', 0.85);
    b64Input.value = dataUrl;
    previewImg.src = dataUrl;
    previewArea.style.display = 'block';
    cropArea.style.display = 'none';
    cropper.destroy(); cropper = null;
});
document.getElementById('cancel-crop').addEventListener('click', function() {
    cropArea.style.display = 'none';
    if (cropper) { cropper.destroy(); cropper = null; }
    fileInput.value = '';
});
function checkOtherLokasi(sel) {
    const manual = document.getElementById('lokasi_manual');
    if (sel.value === '__other__') {
        manual.style.display = 'block';
        manual.required = true;
        sel.removeAttribute('required');
    } else {
        manual.style.display = 'none';
        manual.required = false;
        sel.required = true;
    }
}
</script>
@endpush
