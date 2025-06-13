<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QrAdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\User\AbsensiController;

// Route login
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('dashboard.admin')
            : redirect()->route('dashboard.user');
    }
    return view('login');
});

Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => view('layouts.admin'));

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');

    // Jadwal
    Route::get('/admin/jadwal', fn() => view('admin.jadwal'));
    Route::get('/admin/jadwal/tambah', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/admin/jadwal/tambah', [JadwalController::class, 'store'])->name('jadwal.store');

    // QR Absensi
    Route::get('/admin/absensi', [QrAdminController::class, 'form'])->name('qr.form');
    Route::post('/admin/absensi', [QrAdminController::class, 'store'])->name('qr.store');
    Route::get('/scan-qr/{id}', fn($id) => "QR berhasil discan. ID: " . $id)->name('absen.scan');

    // Laporan Jadwal
    Route::get('/admin/laporan/laporan-jadwal', [JadwalController::class, 'laporan'])->name('jadwal.laporan');
    Route::delete('/admin/laporan/laporan-jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
    Route::get('/jadwal/export', [JadwalController::class, 'export'])->name('jadwal.export');


    // Laporan Absensi
    Route::get('/admin/laporan/laporan-absensi', [LaporanController::class, 'index'])->name('laporan.absensi');
    Route::get('/laporan-absensi/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.absensi.export.excel');


    // Manajemen Users
    Route::get('/admin/users', [UserController::class, 'create'])->name('users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');

    // Laporan Users
    Route::get('/admin/laporan/laporan-users', [UserController::class, 'laporan'])->name('user.laporan');
    Route::delete('/admin/laporan/laporan-users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/laporan-user/export', [UserController::class, 'export'])->name('user.export');
});

// USER only
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', fn() => view('layouts.user'));
    Route::get('/user/dashboard', fn() => view('user.dashboard'))->name('dashboard.user');
    Route::get('/user/jadwal', [JadwalController::class, 'laporanUser'])->name('user.jadwal');
    Route::get('/user/absensi', [AbsensiController::class, 'form'])->name('user.absen.form');
    Route::post('/user/absensi', [AbsensiController::class, 'submit'])->name('user.absen.submit');
});
