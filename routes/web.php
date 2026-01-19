<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Smart Redirect: Admin goes to Admin Dashboard, Users go to User Dashboard
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->email === 'admin@lakid.kepri.prov.go.id') {
        return redirect()->route('admin.dashboard');
    }

    $user = Auth::user();
        // 1. Jika Login sebagai ADMIN UTAMA
        if ($user && $user->email === 'admin@lakid.kepri.prov.go.id') {
            return redirect()->route('admin.dashboard');
        }

        // 2. Jika Login sebagai PIMPINAN (KADIS)
        if ($user && $user->email === 'kadis@lakid.kepri.prov.go.id') {
            return redirect()->route('pimpinan.dashboard');
        }

        // 3. Jika User Biasa (Masyarakat)
        // Ambil data pengajuan milik user tersebut saja
        $pengajuans = \App\Models\Pengajuan::where('user_id', Auth::id())->latest()->get();

    return view('dashboard', compact('pengajuans'));
})->middleware(['auth', 'verified'])->name('dashboard');

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Use resource for cleaner routes, EXCEPT 'index' (digantikan dashboard)
    Route::resource('pengajuan', PengajuanController::class)->except(['index']);
    
    // Submit pengajuan (change Draft to Diajukan)
    Route::post('/pengajuan/{pengajuan}/submit', [PengajuanController::class, 'submit'])->name('pengajuan.submit');

    // Tambahkan Route Bantuan di sini
    Route::get('/bantuan', function () {
        return view('bantuan');
    })->name('bantuan');

    // Route Khusus Dashboard Pimpinan
    Route::get('/pimpinan-dashboard', [App\Http\Controllers\PimpinanController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('pimpinan.dashboard');

    // Route Export PDF (View Cetak)
    Route::get('/pimpinan/cetak', [App\Http\Controllers\PimpinanController::class, 'cetakPdf'])
        ->middleware(['auth', 'verified'])
        ->name('pimpinan.cetak');

    // Route Export Excel (CSV)
    Route::get('/pimpinan/excel', [App\Http\Controllers\PimpinanController::class, 'exportExcel'])
        ->middleware(['auth', 'verified'])
        ->name('pimpinan.excel');
});

// Admin Routes (Protected by isAdmin middleware)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pengajuan/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::patch('/admin/pengajuan/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
});

require __DIR__.'/auth.php';

// Halaman Statis Footer
Route::view('/kebijakan-privasi', 'privacy')->name('privacy');
Route::view('/syarat-ketentuan', 'terms')->name('terms');
