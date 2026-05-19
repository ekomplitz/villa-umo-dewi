<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking');
    }

    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'selected_bungalows' => 'required|string',
            'total_price' => 'required|integer|min:0',
            'duration' => 'required|integer|min:1',
            'lang' => 'nullable|string'
        ]);

        // Konversi selected_bungalows ke array
        $selectedBungalows = explode(',', $validated['selected_bungalows']);

        // Simpan ke database
        $booking = Booking::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'duration' => $validated['duration'],
            'selected_bungalows' => json_encode($selectedBungalows),
            'total_price' => $validated['total_price'],
            'status' => 'pending',
        ]);

        // Pesan sukses berdasarkan bahasa
        $lang = $validated['lang'] ?? 'id';
        $message = $lang === 'id' 
            ? 'Booking berhasil! Terima kasih telah memesan di Villa Umo Dewi.' 
            : 'Booking successful! Thank you for booking at Villa Umo Dewi.';

        return redirect()->back()->with('success', $message);
    }
}