@extends('layouts.admin')

@section('title', 'Edit Jadwal')
@section('page-title', 'Edit Jadwal Donor')
@section('page-subtitle', 'Perbarui informasi jadwal donor')

@section('content')
<div class="page-header">
    <div><h1>✏️ Edit Jadwal Donor</h1></div>
    <a href="{{ route('admin.schedules') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card" style="max-width:650px;">
    @if($errors->any())
        <div class="alert alert-error">
            ❌
            <ul style="list-style:none;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}">
        @csrf
        @method('PUT')
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label" for="tanggal">Tanggal Donor <span style="color:var(--red-primary);">*</span></label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', $schedule->tanggal->toDateString()) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="waktu">Waktu Mulai <span style="color:var(--red-primary);">*</span></label>
                <input type="time" id="waktu" name="waktu" class="form-control" value="{{ old('waktu', substr($schedule->waktu,0,5)) }}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="lokasi">Lokasi <span style="color:var(--red-primary);">*</span></label>
            <input type="text" id="lokasi" name="lokasi" class="form-control" value="{{ old('lokasi', $schedule->lokasi) }}" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="kuota">Kuota Pendonor</label>
            <input type="number" id="kuota" name="kuota" class="form-control" value="{{ old('kuota', $schedule->kuota) }}" min="1" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="keterangan">Keterangan (Opsional)</label>
            <textarea id="keterangan" name="keterangan" class="form-control" rows="4">{{ old('keterangan', $schedule->keterangan) }}</textarea>
        </div>
        <div class="form-group">
            <div style="display:flex;align-items:center;gap:.75rem;">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                    {{ old('is_active', $schedule->is_active) ? 'checked' : '' }}
                    style="accent-color:var(--red-primary);width:18px;height:18px;">
                <label for="is_active" style="font-size:.9rem;cursor:pointer;">Aktifkan jadwal ini</label>
            </div>
        </div>
        <div style="display:flex;gap:.75rem;justify-content:flex-end;">
            <a href="{{ route('admin.schedules') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
