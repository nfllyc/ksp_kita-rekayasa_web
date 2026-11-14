
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\LaporanController;

// Halaman utama diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Route Registrasi
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

// Route yang membutuhkan login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('anggota', AnggotaController::class)
    ->except(['show']);

    Route::resource('simpanan', SimpananController::class)
    ->except(['show']);

    Route::resource('pinjaman', PinjamanController::class)
    ->except(['show']);

    Route::get('/laporan/anggota', [LaporanController::class, 'anggota'])
    ->name('laporan.anggota');

Route::get('/laporan/simpanan', [LaporanController::class, 'simpanan'])
    ->name('laporan.simpanan');

Route::get('/laporan/pinjaman', [LaporanController::class, 'pinjaman'])
    ->name('laporan.pinjaman');
});

