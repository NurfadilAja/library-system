<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;

// Route login hanya untuk tamu (belum login)
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

// Route yang dapat diakses oleh pengguna yang sudah login (admin dan petugas)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Buku (CRUD)
    Route::resource('books', BookController::class);

    // Kategori (CRUD)
    Route::resource('categories', CategoryController::class);

    // Anggota (CRUD)
    Route::resource('members', MemberController::class);

    // Transaksi Peminjaman & Pengembalian
    Route::get('/borrowings', [BorrowingController::class, 'index'])
        ->name('borrowings.index');
    Route::get('/borrowings/create', [BorrowingController::class, 'create'])
        ->name('borrowings.create');
    Route::post('/borrowings', [BorrowingController::class, 'store'])
        ->name('borrowings.store');
    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
        ->name('borrowings.return');
});

// Route pengelolaan pengguna hanya untuk admin (menggunakan Gate can:manage-users)
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::resource('users', UserController::class);
});
