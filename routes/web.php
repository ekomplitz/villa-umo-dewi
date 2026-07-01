<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;

// Halaman Home
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/set-language', function (Request $request) {
    session(['lang' => $request->lang]);
    return response()->json(['success' => true]);
})->name('set.language');

Route::get('/booking/prices', [BookingController::class, 'getPrices'])->name('booking.prices');

// ADMIN LOGIN
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ADMIN PANEL
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::put('/bookings/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::delete('/bookings/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/bookings/export', [AdminController::class, 'export'])->name('admin.export');

    Route::get('/bungalow-settings', [AdminController::class, 'bungalowSettings'])->name('admin.bungalow.settings');
    Route::put('/bungalow-settings/{id}', [AdminController::class, 'updateBungalow'])->name('admin.bungalow.update');

    Route::get('/offline-bookings', [AdminController::class, 'offlineBookings'])->name('admin.offline.bookings');
    Route::post('/offline-bookings', [AdminController::class, 'storeOffline'])->name('admin.offline.store');
    Route::put('/offline-bookings/{id}', [AdminController::class, 'updateOffline'])->name('admin.offline.update');
    Route::delete('/offline-bookings/{id}', [AdminController::class, 'destroyOffline'])->name('admin.offline.destroy');
});