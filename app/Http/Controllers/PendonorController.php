<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Registration;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendonorController extends Controller
{
    // ── Dashboard ──────────────────────────────────────────────────────────

    public function index()
    {
        $user          = Auth::user();
        $pendonor      = $user->pendonor;
        $registrations = Registration::with(['schedule', 'payment'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
        $announcements = Announcement::where('is_active', true)
            ->orderBy('tanggal_publish', 'desc')
            ->take(5)
            ->get();

        return view('donor.dashboard', compact('user', 'pendonor', 'registrations', 'announcements'));
    }

    // ── Lihat Jadwal ───────────────────────────────────────────────────────

    public function schedules()
    {
        $user      = Auth::user();
        $schedules = Schedule::where('is_active', true)
            ->where('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->get();

        // Cek jadwal yang sudah didaftar user ini
        $registeredScheduleIds = Registration::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'diterima'])
            ->pluck('schedule_id')
            ->toArray();

        return view('donor.schedules', compact('schedules', 'registeredScheduleIds'));
    }

    // ── Daftar Jadwal ─────────────────────────────────────────────────────

    public function storeSchedule(Request $request)
    {
        $user = Auth::user();

        // Cek apakah akun sudah aktif
        if (!$user->isAktif()) {
            return back()->with('error', 'Akun Anda belum diverifikasi oleh admin.');
        }

        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);

        // Cek kuota
        if ($schedule->sisaKuota() <= 0) {
            return back()->with('error', 'Maaf, kuota jadwal ini sudah penuh.');
        }

        // Cek apakah sudah terdaftar
        $existing = Registration::where('user_id', $user->id)
            ->where('schedule_id', $request->schedule_id)
            ->whereIn('status', ['pending', 'diterima'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah terdaftar pada jadwal ini.');
        }

        Registration::create([
            'user_id'     => $user->id,
            'schedule_id' => $request->schedule_id,
            'status'      => 'pending',
        ]);

        return redirect()->route('donor.dashboard')
            ->with('success', 'Pendaftaran jadwal berhasil! Menunggu verifikasi admin.');
    }

    // ── Upload Bukti Pembayaran ────────────────────────────────────────────

    public function uploadPayment(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'bukti_transfer'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'nominal'         => 'nullable|numeric|min:0',
        ], [
            'bukti_transfer.mimes' => 'File harus berupa gambar (jpg/png) atau PDF.',
            'bukti_transfer.max'   => 'Ukuran file maksimal 2MB.',
        ]);

        $user         = Auth::user();
        $registration = Registration::where('id', $request->registration_id)
            ->where('user_id', $user->id)
            ->where('status', 'diterima')
            ->firstOrFail();

        // Hapus pembayaran lama jika ada
        if ($registration->payment) {
            Storage::disk('public')->delete($registration->payment->bukti_transfer);
            $registration->payment->delete();
        }

        $path = $request->file('bukti_transfer')->store('payments', 'public');

        Payment::create([
            'registration_id' => $registration->id,
            'bukti_transfer'  => $path,
            'nominal'         => $request->nominal,
            'status'          => 'pending',
        ]);

        return redirect()->route('donor.dashboard')
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
    }

    // ── Pengumuman ─────────────────────────────────────────────────────────

    public function announcements()
    {
        $announcements = Announcement::where('is_active', true)
            ->orderBy('tanggal_publish', 'desc')
            ->paginate(10);

        return view('donor.announcements', compact('announcements'));
    }
}
