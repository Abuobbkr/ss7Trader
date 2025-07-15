<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Artisan;

Route::get('/all/clear', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');
    Artisan::call('optimize');

    return 'All caches cleared and optimized successfully!';
});

Route::get('/all/storage/link', function () {
    Artisan::call('storage:link');

    return 'All storage linked and optimized successfully!';
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



    Route::prefix('signals')->group(function () {
        Route::get('/', [SignalController::class, 'index'])->name('signals.index');
        Route::get('/getData', [SignalController::class, 'getData'])->name('signals.getData');
        Route::post('/', [SignalController::class, 'store'])->name('signals.store');
        Route::get('/{id}/edit', [SignalController::class, 'edit'])->name('signals.edit');
        Route::put('/{id}', [SignalController::class, 'update'])->name('signals.update');
        Route::delete('/{id}', [SignalController::class, 'destroy'])->name('signals.destroy');
    });

    Route::prefix('subscribers')->group(function () {
        Route::get('/', [SubscriberController::class, 'index'])->name('subscribers.index');
        Route::get('/getData', [SubscriberController::class, 'getData'])->name('subscribers.getData');
        Route::post('/', [SubscriberController::class, 'store'])->name('subscribers.store');
        Route::get('/{id}/edit', [SubscriberController::class, 'edit'])->name('subscribers.edit');
        Route::put('/{id}', [SubscriberController::class, 'update'])->name('subscribers.update');
        Route::delete('/{id}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');
    });


    Route::prefix('assets')->group(function () {
        Route::get('/', [AssetController::class, 'index'])->name('assets.index');
        Route::get('/getData', [AssetController::class, 'getData'])->name('assets.getData');
        Route::post('/', [AssetController::class, 'store'])->name('assets.store');
        Route::get('/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
        Route::put('/{id}', [AssetController::class, 'update'])->name('assets.update');
        Route::delete('/{id}', [AssetController::class, 'destroy'])->name('assets.destroy');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/frontend.php';
