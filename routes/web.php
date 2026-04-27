<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () { return view('welcome'); });

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // --- KHUSUS ADMIN ---
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () { 
            return view('admin.dashboard'); 
        })->name('admin.dashboard');
        
    });

    // --- KHUSUS PEMBINA ---
    Route::middleware(['role:pembina'])->prefix('pembina')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
    });

    // --- KHUSUS SISWA ---
    Route::middleware(['role:siswa'])->prefix('siswa')->group(function () {
        Route::get('/dashboard', function () { 
            return view('siswa.dashboard'); 
        })->name('siswa.dashboard');
        
    });

});