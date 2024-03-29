<?php

use App\Http\Controllers\MagicLinkController;
use App\Livewire\Auth\Login;
use App\Livewire\Worker\Home;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)->name('login');
});

Route::controller(MagicLinkController::class)->group(function () {
    Route::get('login/{user}', 'authenticate')->name('magiclink.authenticate');
    Route::post('logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::view('profile', 'worker.profile')->name('worker.profile');
    Route::get('dashboard', Home::class)->name('worker.dashboard');
});
