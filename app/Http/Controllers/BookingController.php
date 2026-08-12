<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BungalowSetting;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bungalows = BungalowSetting::all();
        return view('booking', compact('bungalows'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'required|integer|min:0|max:5',
            'id_type' => 'required|in:ktp,passport',
            'id_number' => 'required|string|max:50',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'selected_bungalows' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        // Simpan data tamu (guests) sebagai JSON
        $guests = [];
        $guestCount = $request->guest_count ?? 1;
        for ($i = 0; $i < $guestCount; $i++) {
            if (isset($request->guests[$i])) {
                $guests[] = [
                    'first_name' => $request->guests[$i]['first_name'] ?? '',
                    'last_name' => $request->guests[$i]['last_name'] ?? '',
                ];
            }
        }

        $booking = Booking::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adults' => $request->adults,
            'children' => $request->children,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'duration' => $request->duration,
            'selected_bungalows' => $request->selected_bungalows,
            'total_price' => $request->total_price,
            'status' => 'pending',
            'payment_status' => 'pending',
            'guests' => json_encode($guests),
        ]);

        return redirect()->route('payment.index', ['bookingId' => $booking->id])
                        ->with('success', 'Booking berhasil dibuat! Silakan lanjutkan ke pembayaran.');
    }

    public function getPrices()
    {
        $bungalows = BungalowSetting::where('status', 'active')->get();
        $prices = [];
        foreach ($bungalows as $bungalow) {
            $prices[$bungalow->code] = $bungalow->price;
        }
        return response()->json($prices);
    }

    public function checkAvailability(Request $request)
    {
        $bungalowCode = $request->bungalow_code;
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        $isBooked = Booking::where('selected_bungalows', 'LIKE', '%"' . $bungalowCode . '"%')
            ->orWhere('selected_bungalows', 'LIKE', '%' . $bungalowCode . '%')
            ->where(function($query) use ($checkIn, $checkOut) {
                $query->where('check_in', '<', $checkOut)
                      ->where('check_out', '>', $checkIn);
            })
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        return response()->json([
            'available' => !$isBooked,
            'bungalow_code' => $bungalowCode,
            'check_in' => $checkIn,
            'check_out' => $checkOut
        ]);
    }
}