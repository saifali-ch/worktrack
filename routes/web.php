<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MagicLinkController;
use App\Livewire\Auth\Login;
use App\Livewire\Worker\Home;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)->name('login');

    Route::controller(AuthController::class)->group(function () {
        Route::get('/admin', 'showLoginForm')->name('admin.login');
        Route::post('/admin', 'login');

        Route::post('/forgot-password', 'sendPasswordResetLink')->name('password.email');
        Route::get('/reset-password/{token}', 'showResetPasswordForm')->name('password.reset');
        Route::post('/reset-password', 'resetPassword')->name('password.update');
    });
});

Route::controller(MagicLinkController::class)->group(function () {
    Route::get('login/{user}', 'authenticate')->name('magiclink.authenticate');
    Route::post('logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::view('profile', 'worker.profile')->name('worker.profile');
    Route::get('dashboard', Home::class)->name('worker.dashboard');

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('invoices/download/{invoice}', 'download')->name('invoices.download');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', Home::class)->name('admin.dashboard');
});
