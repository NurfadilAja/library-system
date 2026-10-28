
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;

// Halaman dashboard
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);

// Route login hanya untuk pengguna yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

// Route logout hanya untuk pengguna yang sudah login
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Route buku hanya dapat diakses setelah login
Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
});

// Route kategori
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::post('/categories', [CategoryController::class, 'store'])
    ->name('categories.store');

// Route anggota
Route::get('/members', [MemberController::class, 'index']);
