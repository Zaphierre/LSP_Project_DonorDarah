<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ── Dashboard ──────────────────────────────────────────────────────────

    public function index()
    {
        $stats = [
            'total_pendonor'        => User::where('role', 'pendonor')->count(),
            'pending_akun'          => User::where('role', 'pendonor')->where('status', 'pending')->count(),
            'total_registrasi'      => Registration::count(),
            'pending_registrasi'    => Registration::where('status', 'pending')->count(),
            'total_payment'         => Payment::count(),
            'pending_payment'       => Payment::where('status', 'pending')->count(),
            'total_pengumuman'      => Announcement::count(),
            'total_jadwal'          => Schedule::count(),
        ];

        $pendonor_pending   = User::where('role', 'pendonor')->where('status', 'pending')->with('pendonor')->latest()->take(5)->get();
        $registrasi_pending = Registration::where('status', 'pending')->with(['user.pendonor', 'schedule'])->latest()->take(5)->get();
        $payment_pending    = Payment::where('status', 'pending')->with(['registration.user.pendonor', 'registration.schedule'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'pendonor_pending', 'registrasi_pending', 'payment_pending'));
    }

    // ── Verifikasi Akun ────────────────────────────────────────────────────

    public function listUsers()
    {
        $users = User::where('role', 'pendonor')->with('pendonor')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function verifyUser(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:aktif,ditolak',
        ]);

        $user = User::findOrFail($id);
        $user->update(['status' => $request->action]);

        $msg = $request->action === 'aktif' ? 'Akun pendonor berhasil diaktifkan.' : 'Akun pendonor ditolak.';
        return back()->with('success', $msg);
    }

    // ── Verifikasi Pendaftaran Jadwal ──────────────────────────────────────

    public function listRegistrations()
    {
        $registrations = Registration::with(['user.pendonor', 'schedule'])->latest()->paginate(15);
        return view('admin.registrations.index', compact('registrations'));
    }

    public function verifyRegistration(Request $request, $id)
    {
        $request->validate([
            'action'  => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string|max:500',
        ]);

        $registration = Registration::findOrFail($id);
        $registration->update([
            'status'  => $request->action,
            'catatan' => $request->catatan,
        ]);

        $msg = $request->action === 'diterima' ? 'Pendaftaran jadwal diterima.' : 'Pendaftaran jadwal ditolak.';
        return back()->with('success', $msg);
    }

    // ── Verifikasi Pembayaran ──────────────────────────────────────────────

    public function listPayments()
    {
        $payments = Payment::with(['registration.user.pendonor', 'registration.schedule'])->latest()->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    public function verifyPayment(Request $request, $id)
    {
        $request->validate([
            'action'        => 'required|in:diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update([
            'status'        => $request->action,
            'catatan_admin' => $request->catatan_admin,
        ]);

        $msg = $request->action === 'diterima' ? 'Pembayaran dikonfirmasi.' : 'Pembayaran ditolak.';
        return back()->with('success', $msg);
    }

    // ── Kelola Jadwal ──────────────────────────────────────────────────────

    public function listSchedules()
    {
        $schedules = Schedule::latest()->paginate(15);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function createSchedule()
    {
        return view('admin.schedules.create');
    }

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'tanggal'     => 'required|date|after_or_equal:today',
            'waktu'       => 'required',
            'lokasi'      => 'required|string|max:255',
            'kuota'       => 'required|integer|min:1',
            'keterangan'  => 'nullable|string',
        ]);

        Schedule::create($request->all());
        return redirect()->route('admin.schedules')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function editSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.edit', compact('schedule'));
    }

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'waktu'      => 'required',
            'lokasi'     => 'required|string|max:255',
            'kuota'      => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'is_active'  => 'boolean',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());
        return redirect()->route('admin.schedules')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroySchedule($id)
    {
        Schedule::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
