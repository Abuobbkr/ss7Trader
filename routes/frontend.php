<?php

use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\FreeSignalController;
use App\Http\Controllers\frontend\SignalController;
use Illuminate\Support\Facades\Route;

Route::middleware('subscriber.auth')->group(function () {
    Route::get('subscriber/signals', [SignalController::class, 'index'])->name('frontend.signal.index');
});
Route::get('/', [FreeSignalController::class, 'index'])->name('frontend.free.signal.index');
Route::post('subscriber/login', [AuthController::class, 'login'])->name('subscriber.login.post');


Route::get("/subscriber/login", [AuthController::class, 'showLoginForm'])->name('subscriber.login');
Route::get('/signals/filter', [SignalController::class, 'filter'])->name('signals.filter');

Route::post('subscriber/logout', function () {
    session()->forget('subscriber_user_id');
    return redirect()->route('subscriber.login');
})->name('subscriber.logout');
