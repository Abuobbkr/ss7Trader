<?php

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

    return '✅ All caches cleared and optimized successfully!';
});


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('dashboard');



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
});

require __DIR__ . '/auth.php';
require __DIR__ . '/frontend.php';
