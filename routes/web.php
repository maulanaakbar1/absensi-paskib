<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PembinaController;
use App\Http\Controllers\Admin\EkstrakurikulerController;

Route::get('/', function () { 
    return redirect()->route('login'); 
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // --- KHUSUS ADMIN --
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Route Baru Pembina
        Route::get('/pembina', [PembinaController::class, 'index'])->name('admin.pembina.index');
        Route::post('/pembina', [PembinaController::class, 'store'])->name('admin.pembina.store');
        Route::put('/pembina/{id}', [PembinaController::class, 'update'])->name('admin.pembina.update');
        Route::delete('/pembina/{id}', [PembinaController::class, 'destroy'])->name('admin.pembina.destroy');

        Route::get('/ekskul', [EkstrakurikulerController::class, 'index'])->name('admin.ekskul.index');
        Route::post('/ekskul', [EkstrakurikulerController::class, 'store'])->name('admin.ekskul.store');
        Route::put('/ekskul/{id}', [EkstrakurikulerController::class, 'update'])->name('admin.ekskul.update');
        Route::delete('/ekskul/{id}', [EkstrakurikulerController::class, 'destroy'])->name('admin.ekskul.destroy');
    });

    // --- KHUSUS PEMBINA ---
    Route::middleware(['role:pembina'])->prefix('pembina')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('pembina.dashboard');

        

    });

    // --- KHUSUS SISWA ---
    Route::middleware(['role:siswa'])->prefix('siswa')->group(function () {
        Route::get('/dashboard', function () { 
            return view('siswa.dashboard'); 
        })->name('siswa.dashboard');
        
    });

});