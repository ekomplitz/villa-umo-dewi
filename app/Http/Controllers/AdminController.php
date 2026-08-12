<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BungalowSetting;
use App\Models\OfflineBooking;
use App\Models\Report;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    // Dashboard
    public function index()
    {
        // ===== ONLINE BOOKINGS =====
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');
        $totalCancelledRevenue = Booking::where('status', 'cancelled')->sum('total_price');
        
        // ===== OFFLINE BOOKINGS =====
        $totalOffline = OfflineBooking::count();
        $pendingOffline = OfflineBooking::where('status', 'pending')->count();
        $confirmedOffline = OfflineBooking::where('status', 'confirmed')->count();
        $cancelledOffline = OfflineBooking::where('status', 'cancelled')->count();
        $totalRevenueOffline = OfflineBooking::where('status', 'confirmed')->sum('total_price');
        $totalCancelledRevenueOffline = OfflineBooking::where('status', 'cancelled')->sum('total_price');

        // ===== TOTAL GABUNGAN =====
        $grandTotalBookings = $totalBookings + $totalOffline;
        $grandPending = $pendingBookings + $pendingOffline;
        $grandConfirmed = $confirmedBookings + $confirmedOffline;
        $grandCancelled = $cancelledBookings + $cancelledOffline;
        $grandRevenue = $totalRevenue + $totalRevenueOffline;
        $grandCancelledRevenue = $totalCancelledRevenue + $totalCancelledRevenueOffline;

        return view('admin.dashboard', compact(
            'totalBookings', 'pendingBookings', 'confirmedBookings', 'cancelledBookings',
            'totalRevenue', 'totalCancelledRevenue', 'totalOffline', 'pendingOffline', 
            'confirmedOffline', 'cancelledOffline', 'totalRevenueOffline', 'totalCancelledRevenueOffline',
            'grandTotalBookings', 'grandPending', 'grandConfirmed', 'grandCancelled', 
            'grandRevenue', 'grandCancelledRevenue'
        ));
    }

    // Bookings
    public function bookings(Request $request)
    {
        $query = Booking::orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
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

    public function export(Request $request)
    {
        $query = Booking::orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->get();
        
        $filename = 'bookings';
        if ($request->status) {
            $filename .= '_' . $request->status;
        }
        $filename .= '_' . date('Y-m-d') . '.csv';

        return response()->stream(
            function() use ($bookings) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, [
                    'ID', 'Nama Depan', 'Nama Belakang', 'Email', 'Phone', 
                    'Check-in', 'Check-out', 'Durasi', 'Bungalow', 
                    'Total Harga', 'Status', 'Tanggal Booking'
                ]);
                foreach ($bookings as $booking) {
                    $bungalows = json_decode($booking->selected_bungalows, true);
                    $bungalowNames = ['b1' => 'B1', 'b2' => 'B2', 'b3' => 'B3', 'b4' => 'B4'];
                    $names = [];
                    if (is_array($bungalows)) {
                        foreach ($bungalows as $b) {
                            $names[] = $bungalowNames[$b] ?? $b;
                        }
                    }
                    
                    fputcsv($handle, [
                        $booking->id,
                        $booking->first_name,
                        $booking->last_name ?? '',
                        $booking->email,
                        $booking->phone,
                        $booking->check_in,
                        $booking->check_out,
                        $booking->duration . ' malam',
                        implode(', ', $names),
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
            'discount_price' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'status' => $request->status,
        ];

        // Upload gambar utama
        if ($request->hasFile('image')) {
            if ($bungalow->image && file_exists(storage_path('app/public/' . $bungalow->image))) {
                unlink(storage_path('app/public/' . $bungalow->image));
            }
            $image = $request->file('image');
            $filename = time() . '_main_' . $image->getClientOriginalName();
            $path = $image->storeAs('bungalows', $filename, 'public');
            $data['image'] = $path;
        }

        // Upload multiple images
        if ($request->hasFile('images')) {
            $newImages = [];
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('bungalows', $filename, 'public');
                $newImages[] = $path;
            }
            
            // Gabungkan dengan gambar yang sudah ada jika ada
            $existingImages = $bungalow->images ?? [];
            $data['images'] = array_merge($existingImages, $newImages);
        }

        $bungalow->update($data);

        return redirect()->back()->with('success', 'Bungalow berhasil diupdate!');
    }

    // Offline Bookings
    public function offlineBookings(Request $request)
    {
        $query = OfflineBooking::orderBy('created_at', 'desc');

        // SEARCH - Perbaiki dengan field yang benar
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('customer_phone', 'like', '%' . $search . '%')
                ->orWhere('customer_email', 'like', '%' . $search . '%');
            });
        }

        // FILTER STATUS
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // FILTER PAYMENT STATUS
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'country_code' => 'required|string|max:10',
            'customer_email' => 'nullable|email|max:255',
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'required|integer|min:0|max:5',
            'id_type' => 'required|in:ktp,passport',
            'id_number' => 'required|string|max:50',
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

        // Auto format phone: jika diawali 0 dan country_code +62, hapus 0
        $phone = $request->customer_phone;
        // Hapus semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if ($request->country_code == '+62' && substr($phone, 0, 1) == '0') {
            $phone = substr($phone, 1);
        }
        $fullPhone = $request->country_code . $phone;

        $bungalows = BungalowSetting::whereIn('code', $request->selected_bungalows)->get();

        $totalPrice = 0;
        foreach ($bungalows as $bungalow) {
            $totalPrice += $bungalow->price * $duration;
        }

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

        $offline = OfflineBooking::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'customer_phone' => $fullPhone,
            'country_code' => $request->country_code,
            'customer_email' => $request->customer_email,
            'adults' => $request->adults,
            'children' => $request->children,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'duration' => $duration,
            'selected_bungalows' => json_encode($request->selected_bungalows),
            'total_price' => $totalPrice,
            'notes' => $request->notes,
            'payment_status' => $request->payment_status,
            'status' => $request->status,
            'booked_by' => 'Admin',
            'guests' => json_encode($guests),
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

    // ===== OFFLINE EXPORT CSV =====
    public function exportOffline(Request $request)
    {
        $query = OfflineBooking::orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('customer_phone', 'like', '%' . $request->search . '%')
                ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->get();
        
        $filename = 'offline_bookings';
        if ($request->status) {
            $filename .= '_' . $request->status;
        }
        $filename .= '_' . date('Y-m-d') . '.csv';

        return response()->stream(
            function() use ($bookings) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, [
                    'ID', 'Nama', 'Phone', 'Email', 'Check-in', 'Check-out',
                    'Durasi', 'Bungalow', 'Total Harga', 'Payment Status', 'Status', 'Booked By', 'Tanggal Booking'
                ]);
                foreach ($bookings as $booking) {
                    $bungalows = json_decode($booking->selected_bungalows, true);
                    $bungalowNames = ['b1' => 'B1', 'b2' => 'B2', 'b3' => 'B3', 'b4' => 'B4'];
                    $names = [];
                    if (is_array($bungalows)) {
                        foreach ($bungalows as $b) {
                            $names[] = $bungalowNames[$b] ?? $b;
                        }
                    }
                    
                    fputcsv($handle, [
                        $booking->id,
                        $booking->full_name,
                        $booking->customer_phone,
                        $booking->customer_email ?? '-',
                        $booking->check_in,
                        $booking->check_out,
                        $booking->duration . ' malam',
                        implode(', ', $names),
                        'Rp ' . number_format($booking->total_price, 0, ',', '.'),
                        $booking->payment_status,
                        $booking->status,
                        $booking->booked_by ?? 'Admin',
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

    public function exportPDF(Request $request)
    {
        $query = Booking::orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->get();

        $data = [
            'bookings' => $bookings,
            'total' => $bookings->count(),
            'totalRevenue' => $bookings->sum('total_price'),
            'date' => now()->format('d/m/Y H:i'),
            'status' => $request->status ?? 'Semua Status'
        ];

        $pdf = Pdf::loadView('admin.bookings_pdf', $data);
        $pdf->setPaper('A4', 'landscape');

        $filename = 'bookings';
        if ($request->status) {
            $filename .= '_' . $request->status;
        }
        $filename .= '_' . date('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    public function exportOfflinePDF(Request $request)
    {
        $query = OfflineBooking::orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('customer_phone', 'like', '%' . $request->search . '%')
                ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->get();

        $data = [
            'bookings' => $bookings,
            'total' => $bookings->count(),
            'totalRevenue' => $bookings->sum('total_price'),
            'date' => now()->format('d/m/Y H:i'),
            'status' => $request->status ?? 'Semua Status'
        ];

        $pdf = Pdf::loadView('admin.offline_bookings_pdf', $data);
        $pdf->setPaper('A4', 'landscape');

        $filename = 'offline_bookings';
        if ($request->status) {
            $filename .= '_' . $request->status;
        }
        $filename .= '_' . date('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    public function getBookingDetail($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            // Parse guests
            $guests = json_decode($booking->guests, true) ?? [];
            
            // Parse selected bungalows
            $selectedBungalows = json_decode($booking->selected_bungalows, true) ?? [];
            if (is_string($selectedBungalows)) {
                $selectedBungalows = json_decode($selectedBungalows, true) ?? [];
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $booking->id,
                    'first_name' => $booking->first_name,
                    'last_name' => $booking->last_name,
                    'email' => $booking->email,
                    'phone' => $booking->phone,
                    'adults' => $booking->adults,
                    'children' => $booking->children,
                    'id_type' => $booking->id_type,
                    'id_number' => $booking->id_number,
                    'check_in' => $booking->check_in,
                    'check_out' => $booking->check_out,
                    'duration' => $booking->duration,
                    'selected_bungalows' => $selectedBungalows,
                    'total_price' => $booking->total_price,
                    'status' => $booking->status,
                    'payment_status' => $booking->payment_status,
                    'created_at' => $booking->created_at->format('d/m/Y H:i'),
                    'guests' => $guests,
                    'order_id' => $booking->order_id ?? null,
                    'transaction_id' => $booking->transaction_id ?? null,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOfflineBookingDetail($id)
    {
        try {
            $booking = OfflineBooking::findOrFail($id);
            
            // Parse guests
            $guests = json_decode($booking->guests, true) ?? [];
            
            // Parse selected bungalows
            $selectedBungalows = json_decode($booking->selected_bungalows, true) ?? [];
            if (is_string($selectedBungalows)) {
                $selectedBungalows = json_decode($selectedBungalows, true) ?? [];
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $booking->id,
                    'first_name' => $booking->first_name,
                    'last_name' => $booking->last_name,
                    'customer_phone' => $booking->customer_phone,
                    'customer_email' => $booking->customer_email,
                    'country_code' => $booking->country_code,
                    'adults' => $booking->adults,
                    'children' => $booking->children,
                    'id_type' => $booking->id_type,
                    'id_number' => $booking->id_number,
                    'check_in' => $booking->check_in,
                    'check_out' => $booking->check_out,
                    'duration' => $booking->duration,
                    'selected_bungalows' => $selectedBungalows,
                    'total_price' => $booking->total_price,
                    'payment_status' => $booking->payment_status,
                    'status' => $booking->status,
                    'notes' => $booking->notes,
                    'booked_by' => $booking->booked_by,
                    'created_at' => $booking->created_at->format('d/m/Y H:i'),
                    'guests' => $guests,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeImage($id, $index)
    {
        $bungalow = BungalowSetting::findOrFail($id);
        $images = $bungalow->images ?? [];
        
        if (isset($images[$index])) {
            // Hapus file dari storage
            $filePath = $images[$index];
            if (file_exists(storage_path('app/public/' . $filePath))) {
                unlink(storage_path('app/public/' . $filePath));
            }
            
            // Hapus dari array
            array_splice($images, $index, 1);
            $bungalow->images = $images;
            $bungalow->save();
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }
}