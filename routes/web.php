<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PaymentController; // <-- PASTIKAN INI ADA
use Illuminate\Support\Facades\Route;

// ========== HALAMAN UTAMA ==========
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// ========== BOOKING ==========
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/prices', [BookingController::class, 'getPrices'])->name('booking.prices');

// ========== REPORT ==========
Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::post('/report', [ReportController::class, 'store'])->name('report.store');

// ========== GALLERY ==========
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// ========== LANGUAGE ==========
Route::post('/set-language', function (Request $request) {
    session(['lang' => $request->lang]);
    return response()->json(['success' => true]);
})->name('set.language');

// ========== PAYMENT PAGES (SIMPLE) ==========
Route::get('/payment-success', function () {
    return view('payment_success');
})->name('payment.success');

Route::get('/payment-failed', function () {
    return view('payment_failed');
})->name('payment.failed');

Route::get('/payment/{bookingId}', function ($bookingId) {
    $booking = App\Models\Booking::findOrFail($bookingId);
    return view('payment', compact('booking'));
})->name('payment.index');

Route::post('/payment/create/{bookingId}', function ($bookingId) {
    $booking = App\Models\Booking::findOrFail($bookingId);
    
    // Setup Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;
    
    $orderId = 'ORDER-' . $booking->id . '-' . time();
    
    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => (int) $booking->total_price,
        ],
        'customer_details' => [
            'first_name' => $booking->name,
            'email' => $booking->email,
            'phone' => $booking->phone,
        ],
        'item_details' => [
            [
                'id' => 'booking-' . $booking->id,
                'price' => (int) $booking->total_price,
                'quantity' => 1,
                'name' => 'Villa Booking',
            ]
        ],
    ];
    
    try {
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $booking->order_id = $orderId;
        $booking->save();
        
        return response()->json([
            'snap_token' => $snapToken,
            'order_id' => $orderId,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->name('payment.create');

Route::post('/payment/callback', function () {
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    
    $notification = new \Midtrans\Notification();
    
    $orderId = $notification->order_id;
    $transactionStatus = $notification->transaction_status;
    
    $orderParts = explode('-', $orderId);
    $bookingId = $orderParts[1] ?? null;
    
    if ($bookingId) {
        $booking = App\Models\Booking::find($bookingId);
        if ($booking) {
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                $booking->payment_status = 'paid';
                $booking->status = 'confirmed';
            } elseif ($transactionStatus == 'pending') {
                $booking->payment_status = 'pending';
            } else {
                $booking->payment_status = 'failed';
            }
            $booking->save();
        }
    }
    
    return response()->json(['status' => 'OK']);
})->name('payment.callback');

// ========== ADMIN LOGIN ==========
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ========== ADMIN PANEL ==========
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::put('/bookings/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::delete('/bookings/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/bookings/export', [AdminController::class, 'export'])->name('admin.export');

    Route::get('/bungalow-settings', [AdminController::class, 'bungalowSettings'])->name('admin.bungalow.settings');
    Route::put('/bungalow-settings/{id}', [AdminController::class, 'updateBungalow'])->name('admin.bungalow.update');

    Route::get('/offline-bookings', [AdminController::class, 'offlineBookings'])->name('admin.offline.bookings');
    Route::post('/offline-bookings', [AdminController::class, 'storeOffline'])->name('admin.offline.store');
    Route::put('/offline-bookings/{id}', [AdminController::class, 'updateOffline'])->name('admin.offline.update');
    Route::delete('/offline-bookings/{id}', [AdminController::class, 'destroyOffline'])->name('admin.offline.destroy');

    Route::get('/reports', [AdminController::class, 'adminIndex'])->name('admin.reports');
    Route::get('/reports/{id}', [AdminController::class, 'getReportDetail'])->name('admin.reports.detail');
    Route::put('/reports/{id}', [AdminController::class, 'adminUpdate'])->name('admin.reports.update');
    Route::delete('/reports/{id}', [AdminController::class, 'destroyReport'])->name('admin.reports.destroy');

    Route::get('/galleries', [GalleryController::class, 'adminIndex'])->name('admin.galleries');
    Route::post('/galleries', [GalleryController::class, 'adminStore'])->name('admin.galleries.store');
    Route::delete('/galleries/{id}', [GalleryController::class, 'adminDestroy'])->name('admin.galleries.destroy');
});