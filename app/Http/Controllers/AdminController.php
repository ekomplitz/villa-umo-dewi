<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BungalowSetting;
use App\Models\OfflineBooking;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');
        
        $totalOffline = OfflineBooking::count();
        $totalRevenueOffline = OfflineBooking::where('status', 'confirmed')->sum('total_price');

        return view('admin.dashboard', compact(
            'totalBookings', 'pendingBookings', 'confirmedBookings',
            'totalRevenue', 'totalOffline', 'totalRevenueOffline'
        ));
    }

    // Bookings
    public function bookings(Request $request)
    {
        $query = Booking::orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->paginate(10);
        return view('admin.bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Status booking berhasil diupdate!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking berhasil dihapus!');
    }

    public function export()
    {
        $bookings = Booking::all();
        $filename = 'bookings_' . date('Y-m-d') . '.csv';

        return response()->stream(
            function() use ($bookings) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, [
                    'ID', 'Nama', 'Email', 'Phone', 'Check-in', 'Check-out',
                    'Durasi', 'Bungalow', 'Total Harga', 'Status', 'Tanggal Booking'
                ]);
                foreach ($bookings as $booking) {
                    fputcsv($handle, [
                        $booking->id,
                        $booking->name,
                        $booking->email,
                        $booking->phone,
                        $booking->check_in,
                        $booking->check_out,
                        $booking->duration . ' malam',
                        $booking->selected_bungalows,
                        'Rp ' . number_format($booking->total_price, 0, ',', '.'),
                        $booking->status,
                        $booking->created_at->format('d/m/Y H:i')
                    ]);
                }
                fclose($handle);
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }

    // Bungalow Settings
    public function bungalowSettings()
    {
        $bungalows = BungalowSetting::all();
        return view('admin.bungalow_settings', compact('bungalows'));
    }

    public function updateBungalow(Request $request, $id)
    {
        $bungalow = BungalowSetting::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description_id' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $bungalow->update([
            'name' => $request->name,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Bungalow berhasil diupdate!');
    }

    // Offline Bookings
    public function offlineBookings(Request $request)
    {
        $query = OfflineBooking::orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }

        $offlineBookings = $query->paginate(10);
        $bungalows = BungalowSetting::where('status', 'active')->get();
        return view('admin.offline_bookings', compact('offlineBookings', 'bungalows'));
    }

    public function storeOffline(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'selected_bungalows' => 'required|array|min:1',
            'notes' => 'nullable|string',
            'payment_status' => 'required|in:pending,paid,partial',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $checkIn = new \DateTime($request->check_in);
        $checkOut = new \DateTime($request->check_out);
        $duration = $checkIn->diff($checkOut)->days;

        $bungalows = BungalowSetting::whereIn('code', $request->selected_bungalows)->get();

        $totalPrice = 0;
        foreach ($bungalows as $bungalow) {
            $totalPrice += $bungalow->price * $duration;
        }

        $offline = OfflineBooking::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'duration' => $duration,
            'selected_bungalows' => json_encode($request->selected_bungalows),
            'total_price' => $totalPrice,
            'notes' => $request->notes,
            'payment_status' => $request->payment_status,
            'status' => $request->status,
            'booked_by' => 'Admin',
        ]);

        return redirect()->back()->with('success', 'Booking offline berhasil ditambahkan!');
    }

    public function updateOffline(Request $request, $id)
    {
        $offline = OfflineBooking::findOrFail($id);
        
        $request->validate([
            'payment_status' => 'required|in:pending,paid,partial',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $offline->update([
            'payment_status' => $request->payment_status,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Booking offline berhasil diupdate!');
    }

    public function destroyOffline($id)
    {
        $offline = OfflineBooking::findOrFail($id);
        $offline->delete();

        return redirect()->back()->with('success', 'Booking offline berhasil dihapus!');
    }

    // Reports
    public function adminIndex(Request $request)
    {
        $query = Report::orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $reports = $query->paginate(20)->appends($request->query());
        return view('admin.reports', compact('reports'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,read,replied',
            'admin_reply' => 'nullable|string',
        ]);
        
        $report->update([
            'status' => $request->status,
            'admin_reply' => $request->admin_reply,
        ]);
        
        return redirect()->back()->with('success', 'Report berhasil diupdate!');
    }

    public function getReportDetail($id)
    {
        $report = Report::findOrFail($id);
        return response()->json($report);
    }

    public function destroyReport($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        
        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }
}