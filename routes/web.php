<?php

use App\Http\Controllers\BarcodeCommandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonitorController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('barcode-command', BarcodeCommandController::class);

Route::get('monitor', MonitorController::class);

require __DIR__.'/auth.php';
