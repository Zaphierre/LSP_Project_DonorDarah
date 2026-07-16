<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PendonorController;

// ── HALAMAN PUBLIK ─────────────────────────────────────────────────────────
Route::get('/', function () {
    $announcements = \App\Models\Announcement::where('is_active', true)
        ->orderBy('tanggal_publish', 'desc')
        ->take(5)
        ->get();

    $schedules = \App\Models\Schedule::where('is_active', true)
        ->where('tanggal', '>=', today())
        ->orderBy('tanggal')
        ->take(10)
        ->get();

    // Blood stock: count registered donors per blood type from pendonors table
    $bloodStockRaw = \DB::table('pendonors')
        ->select('golongan_darah', \DB::raw('count(*) as total'))
        ->groupBy('golongan_darah')
        ->pluck('total', 'golongan_darah')
        ->toArray();

    // Ensure all 4 types are present
    $bloodStock = array_merge(['A' => 0, 'B' => 0, 'AB' => 0, 'O' => 0], $bloodStockRaw);

    return view('welcome', compact('announcements', 'schedules', 'bloodStock'));
})->name('home');

// ── AUTENTIKASI ────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── PENDONOR ───────────────────────────────────────────────────────────────
Route::middleware(['auth'])->prefix('donor')->name('donor.')->group(function () {
    Route::get('/dashboard',         [PendonorController::class, 'index'])->name('dashboard');
    Route::get('/jadwal',            [PendonorController::class, 'schedules'])->name('schedules');
    Route::post('/daftar-jadwal',    [PendonorController::class, 'storeSchedule'])->name('schedule.store');
    Route::post('/upload-pembayaran',[PendonorController::class, 'uploadPayment'])->name('payment.upload');
    Route::get('/pengumuman',        [PendonorController::class, 'announcements'])->name('announcements');
});

// ── ADMIN ──────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Kelola Pendonor (verifikasi akun)
    Route::get('/pendonor',              [AdminController::class, 'listUsers'])->name('users.index');
    Route::post('/pendonor/{id}/verify', [AdminController::class, 'verifyUser'])->name('users.verify');

    // Kelola Pendaftaran Jadwal
    Route::get('/registrasi',              [AdminController::class, 'listRegistrations'])->name('registrations.index');
    Route::post('/registrasi/{id}/verify', [AdminController::class, 'verifyRegistration'])->name('registrations.verify');

    // Kelola Pembayaran
    Route::get('/pembayaran',              [AdminController::class, 'listPayments'])->name('payments.index');
    Route::post('/pembayaran/{id}/verify', [AdminController::class, 'verifyPayment'])->name('payments.verify');

    // Kelola Jadwal
    Route::get('/jadwal',              [AdminController::class, 'listSchedules'])->name('schedules');
    Route::get('/jadwal/tambah',       [AdminController::class, 'createSchedule'])->name('schedules.create');
    Route::post('/jadwal',             [AdminController::class, 'storeSchedule'])->name('schedules.store');
    Route::get('/jadwal/{id}/edit',    [AdminController::class, 'editSchedule'])->name('schedules.edit');
    Route::put('/jadwal/{id}',         [AdminController::class, 'updateSchedule'])->name('schedules.update');
    Route::delete('/jadwal/{id}',      [AdminController::class, 'destroySchedule'])->name('schedules.destroy');
    Route::post('/jadwal/{id}/toggle', [AdminController::class, 'toggleScheduleStatus'])->name('schedules.toggle');

    // Kelola Pengumuman
    Route::get('/pengumuman',          [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/pengumuman/tambah',   [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/pengumuman',         [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/pengumuman/{id}/edit',[AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/pengumuman/{id}',     [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/pengumuman/{id}',  [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});