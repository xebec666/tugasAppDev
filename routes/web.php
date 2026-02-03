<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\resetPasswordController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');


// Forgot Password
Route::get('/forgot-password', [ResetPasswordController::class, 'showForgotForm'])->name('password.request');
// Proses cek email
Route::post('/forgot-password', [ResetPasswordController::class, 'checkEmail'])->name('password.check');
Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    // User Routes
    Route::get('/user/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    Route::put('/user/profile', [App\Http\Controllers\User\DashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/user/reviews', [App\Http\Controllers\User\ReviewController::class, 'store'])->name('user.reviews.store');
    
    // Transactions
    Route::get('/user/transactions', [App\Http\Controllers\User\TransactionController::class, 'index'])->name('user.transactions.index');
    Route::get('/user/transactions/create', [App\Http\Controllers\User\TransactionController::class, 'create'])->name('user.transactions.create');
    Route::post('/user/transactions', [App\Http\Controllers\User\TransactionController::class, 'store'])->name('user.transactions.store');
    Route::get('/user/transactions/{transaction}', [App\Http\Controllers\User\TransactionController::class, 'show'])->name('user.transactions.show');
    Route::get('/user/transactions/{transaction}/payment', [App\Http\Controllers\User\TransactionController::class, 'payment'])->name('user.transactions.payment');
    Route::post('/user/transactions/{transaction}/confirm-payment', [App\Http\Controllers\User\TransactionController::class, 'confirmPayment'])->name('user.transactions.confirm-payment');
    
    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/products', App\Http\Controllers\Admin\ProductController::class);
        Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

    // Profile Routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});
