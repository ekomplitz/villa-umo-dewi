{{-- resources/views/admin/offline_bookings_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Offline Booking - Villa Umo Dewi</title>
    <style>
        * {
            font-family: 'Times New Roman', Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #9D6638;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 22px;
            color: #9D6638;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header p {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 11px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 2px 8px 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }
        th {
            background-color: #9D6638;
            color: white;
            padding: 6px 4px;
            text-align: center;
            border: 1px solid #9D6638;
            font-weight: bold;
        }
        td {
            padding: 5px 4px;
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-badge {
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: bold;
            display: inline-block;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-confirmed { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .payment-paid { background-color: #d1fae5; color: #065f46; }
        .payment-pending { background-color: #fef3c7; color: #92400e; }
        .payment-partial { background-color: #fef3c7; color: #92400e; }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .summary {
            margin-top: 15px;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 6px;
            font-size: 11px;
            display: flex;
            justify-content: space-between;
        }
        .summary span {
            font-weight: bold;
            color: #9D6638;
        }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .text-nowrap { white-space: nowrap; }
        .guest-name {
            font-size: 8px;
            color: #666;
            padding-left: 10px;
        }
        .customer-name {
            font-weight: bold;
            color: #9D6638;
            font-size: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Laporan Offline Booking</h1>
    <p>Villa Umo Dewi - Bali</p>
    <p style="font-size: 9px; margin-top: 2px;">Dicetak: {{ $date }}</p>
</div>

<div class="info">
    <table>
        <tr>
            <td><strong>Total Booking:</strong> {{ $total }}</td>
            <td class="text-right"><strong>Total Pendapatan:</strong> Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Status:</strong>
                @php
                    $pending = $bookings->where('status', 'pending')->count();
                    $confirmed = $bookings->where('status', 'confirmed')->count();
                    $cancelled = $bookings->where('status', 'cancelled')->count();
                @endphp
                Pending: {{ $pending }} | Confirmed: {{ $confirmed }} | Cancelled: {{ $cancelled }}
            </td>
        </tr>
    </table>
</div>

<table>
    <thead>
        <tr>
            <th width="3%">#</th>
            <th width="15%">Nama Tamu</th>
            <th width="10%">Phone</th>
            <th width="8%">Check-in</th>
            <th width="8%">Check-out</th>
            <th width="6%">Durasi</th>
            <th width="8%">Bungalow</th>
            <th width="8%">Total</th>
            <th width="8%">Payment</th>
            <th width="8%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $index => $booking)
        @php
            $customerName = trim(($booking->first_name ?? '') . ' ' . ($booking->last_name ?? ''));
            if (empty($customerName)) {
                $customerName = $booking->customer_name ?? 'Customer';
            }
            $guestList = json_decode($booking->guests, true) ?? [];
            $guestNames = [];
            foreach ($guestList as $g) {
                $firstName = $g['first_name'] ?? '';
                $lastName = $g['last_name'] ?? '';
                if ($firstName || $lastName) {
                    $guestNames[] = trim($firstName . ' ' . $lastName);
                }
            }
            $bungalows = json_decode($booking->selected_bungalows, true);
            if (is_string($bungalows)) {
                $bungalows = json_decode($bungalows, true) ?? [];
            }
            if (!is_array($bungalows)) {
                $bungalows = [];
            }
            $bungalowNames = ['b1' => 'B1', 'b2' => 'B2', 'b3' => 'B3', 'b4' => 'B4'];
            $names = [];
            foreach ($bungalows as $b) {
                $names[] = $bungalowNames[$b] ?? strtoupper($b);
            }
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-left">
                <div class="customer-name">{{ $customerName }}</div>
                @if(count($guestNames) > 0)
                    @foreach($guestNames as $guest)
                    <div class="guest-name">• {{ $guest }}</div>
                    @endforeach
                @endif
            </td>
            <td>{{ $booking->customer_phone ?? '-' }}</td>
            <td class="text-nowrap">{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
            <td class="text-nowrap">{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td>
            <td>{{ $booking->duration ?? 0 }} malam</td>
            <td>{{ implode(', ', $names) ?: '-' }}</td>
            <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
            <td>
                <span class="status-badge payment-{{ $booking->payment_status ?? 'pending' }}">
                    {{ ucfirst($booking->payment_status ?? 'Pending') }}
                </span>
            </td>
            <td>
                <span class="status-badge status-{{ $booking->status ?? 'pending' }}">
                    {{ ucfirst($booking->status ?? 'Pending') }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" style="text-align: center; padding: 20px; color: #999;">
                Tidak ada data offline booking
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="summary">
    <div><strong>Total Booking:</strong> <span>{{ $total }}</span></div>
    <div><strong>Total Pendapatan:</strong> <span>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span></div>
</div>

<div class="footer">
    © {{ date('Y') }} Villa Umo Dewi | Laporan ini dicetak secara otomatis dari sistem.
</div>

</body>
</html>