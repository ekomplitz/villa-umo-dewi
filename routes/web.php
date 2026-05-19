<?php

use App\Http\Controllers\BookingController;
use Illuminate\Http\Request; // Tambahkan ini

Route::get('/', function () {
    return view('welcome');
});

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/set-language', function (Request $request) {
    session(['lang' => $request->lang]);
    return response()->json(['success' => true]);
})->name('set.language');