<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\PimpinanController; // Hapus atau Comment
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Halaman Statis Footer (Publik)
Route::view('/kebijakan-privasi', 'privacy')->name('privacy');
Route::view('/syarat-ketentuan', 'terms')->name('terms');

// Dashboard Utama
Route::get('/dashboard', [PengajuanController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group Auth (User yang sudah login)
Route::middleware('auth')->group(function () {
    // 1. Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. Pengajuan (Resource)
    Route::resource('pengajuan', PengajuanController::class)->except(['index']);
    
    // 3. Pusat Bantuan
    Route::get('/bantuan', function () {
        return view('bantuan');
    })->name('bantuan');

    // 4. Menu Pimpinan (DIHAPUS)
    // Route::get('/pimpinan-dashboard', [PimpinanController::class, 'index'])->name('pimpinan.dashboard');
    // Route::get('/pimpinan/cetak', [PimpinanController::class, 'cetakPdf'])->name('pimpinan.cetak');
    // Route::get('/pimpinan/excel', [PimpinanController::class, 'exportExcel'])->name('pimpinan.excel');
});

// Group Admin (Hanya Admin)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pengajuan/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::patch('/admin/pengajuan/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');

    Route::get('/admin/arsip', [ArchiveController::class, 'index'])->name('admin.archives.index');
    Route::post('/admin/arsip', [ArchiveController::class, 'store'])->name('admin.archives.store');
    Route::delete('/admin/arsip/{id}', [ArchiveController::class, 'destroy'])->name('admin.archives.destroy');
});

require __DIR__.'/auth.php';

// Halaman Statis Footer
Route::view('/kebijakan-privasi', 'privacy')->name('privacy');
Route::view('/syarat-ketentuan', 'terms')->name('terms');
