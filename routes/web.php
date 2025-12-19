<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneratorController;

// Halaman Depan (Login)
Route::get('/', function () {
    return view('welcome'); 
})->name('login');

// --- AUTHENTICATION ROUTES ---
Route::get('/auth/github', [AuthController::class, 'redirect'])->name('auth.github');
Route::get('/auth/github/callback', [AuthController::class, 'callback']);

// Route Logout (Cukup satu kali saja di sini)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- DASHBOARD & APP ROUTES (Perlu Login) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Generate Readme
    Route::get('/generate/{owner}/{repo}', [GeneratorController::class, 'generate'])->name('generate.readme');

    // Commit Readme
    Route::post('/commit-readme', [GeneratorController::class, 'commit'])->name('commit.readme');
});

Route::get('/migrate-db', function() {
    \Illuminate\Support\Facades\Artisan::call('migrate --force');
    return 'Database Berhasil Dimigrasi! 🚀';
});