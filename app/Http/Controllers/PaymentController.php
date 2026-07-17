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
        
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        
        return view('payment', compact('booking'));
    }

    public function createTransaction($bookingId, Request $request)
    {
        $booking = Booking::findOrFail($bookingId);
        
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $orderId = 'ORDER-' . $booking->id . '-' . time();

        $email = $booking->email;
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = 'guest@villamodewi.com';
        }

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->name ?? 'Guest',
                'email' => $email,
                'phone' => $booking->phone ?? '081234567890',
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

    private function getItemDetails($booking)
    {
        $items = [];
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