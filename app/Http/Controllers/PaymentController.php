<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function index($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        
        // Setup Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        
        return view('payment', compact('booking'));
    }

    public function createTransaction($bookingId, Request $request)
    {
        $booking = Booking::findOrFail($bookingId);
        
        // Setup Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $orderId = 'ORDER-' . $booking->id . '-' . time();

        // Pastikan email valid
        $email = filter_var($booking->email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Jika email tidak valid, gunakan default
            $email = 'guest@villamodewi.com';
        }

        // Prepare transaction details
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->name,
                'email' => $email,
                'phone' => $booking->phone,
            ],
            'item_details' => $this->getItemDetails($booking),
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            
            $booking->order_id = $orderId;
            $booking->save();
            
            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notification = new Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;

        $orderParts = explode('-', $orderId);
        $bookingId = $orderParts[1] ?? null;

        if ($bookingId) {
            $booking = Booking::find($bookingId);
            if ($booking) {
                if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                    $booking->payment_status = 'paid';
                    $booking->status = 'confirmed';
                } elseif ($transactionStatus == 'pending') {
                    $booking->payment_status = 'pending';
                } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                    $booking->payment_status = 'failed';
                }
                $booking->save();
            }
        }

        return response()->json(['status' => 'OK']);
    }

    private function getItemDetails($booking)
    {
        $items = [];
        
        // Parse bungalows
        $bungalows = json_decode($booking->selected_bungalows, true);
        $bungalowNames = ['b1' => 'Bungalow 1', 'b2' => 'Bungalow 2', 'b3' => 'Bungalow 3', 'b4' => 'Bungalow 4'];
        
        if (is_array($bungalows) && count($bungalows) > 0) {
            $pricePerNight = $booking->total_price / ($booking->duration * count($bungalows));
            
            foreach ($bungalows as $bungalow) {
                $items[] = [
                    'id' => $bungalow,
                    'price' => (int) $pricePerNight,
                    'quantity' => (int) $booking->duration,
                    'name' => $bungalowNames[$bungalow] ?? $bungalow,
                ];
            }
        } else {
            // Fallback if no bungalows parsed
            $items[] = [
                'id' => 'villa-booking',
                'price' => (int) $booking->total_price,
                'quantity' => 1,
                'name' => 'Villa Booking',
            ];
        }

        return $items;
    }

    public function success()
    {
        return view('payment_success');
    }

    public function failed()
    {
        return view('payment_failed');
    }
}