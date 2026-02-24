<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\AspirasiController as AdminAspirasiController;
use App\Http\Controllers\Student\AspirasiController as StudentAspirasiController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// API route untuk check NIS
Route::get('/api/check-nis/{nis}', [StudentAspirasiController::class, 'checkNis'])->name('api.check-nis');



// Routes untuk Student/Siswa (Tanpa Login)
Route::prefix('aspirasi')->name('student.aspirasi.')->group(function () {
    Route::get('/', [StudentAspirasiController::class, 'index'])->name('index');
    Route::get('/create', [StudentAspirasiController::class, 'create'])->name('create');
    Route::post('/store', [StudentAspirasiController::class, 'store'])->name('store');
    Route::get('/success', [StudentAspirasiController::class, 'success'])->name('success');
    Route::get('/status', [StudentAspirasiController::class, 'status'])->name('status');
    Route::match(['get', 'post'], '/check-status', [StudentAspirasiController::class, 'checkStatus'])->name('check-status');
});

// Routes untuk Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    // Protected admin routes
    Route::middleware('auth.admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Kategori management
        Route::resource('kategori', KategoriController::class);
        
        // Siswa management
        Route::resource('siswa', SiswaController::class);
        
        // Aspirasi management
        Route::prefix('aspirasi')->name('aspirasi.')->group(function () {
            Route::get('/', [AdminAspirasiController::class, 'index'])->name('index');
            Route::get('/{inputAspirasi}', [AdminAspirasiController::class, 'show'])->name('show');
            Route::put('/{inputAspirasi}/status', [AdminAspirasiController::class, 'updateStatus'])->name('update-status');
            Route::delete('/{inputAspirasi}', [AdminAspirasiController::class, 'destroy'])->name('destroy');
        });
    });
});


