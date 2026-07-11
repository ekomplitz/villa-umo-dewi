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
        $lang = session('lang', 'id');
        return view('booking', compact('bungalows', 'lang'));
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'selected_bungalows' => 'required|string',
            'total_price' => 'required|integer|min:0',
            'duration' => 'required|integer|min:1',
            'lang' => 'nullable|string',
            'payment_status' => 'pending',
        ]);

        $selectedBungalows = explode(',', $validated['selected_bungalows']);

        $bungalows = BungalowSetting::whereIn('code', $selectedBungalows)->get();
        $totalPrice = 0;
        foreach ($bungalows as $bungalow) {
            $totalPrice += $bungalow->price * $validated['duration'];
        }

        $booking = Booking::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'duration' => $validated['duration'],
            'selected_bungalows' => json_encode($selectedBungalows),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $lang = $validated['lang'] ?? 'id';
        $message = $lang === 'id' 
            ? 'Booking berhasil! Terima kasih telah memesan di Villa Umo Dewi.' 
            : 'Booking successful! Thank you for booking at Villa Umo Dewi.';

        return redirect()->route('payment.index', ['bookingId' => $booking->id])
                     ->with('success', 'Booking berhasil dibuat! Silakan lanjutkan ke pembayaran.');
    }
}