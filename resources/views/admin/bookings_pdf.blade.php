<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Booking Villa Umo Dewi</title>
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
            font-size: 10px;
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
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-badge {
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-confirmed {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }
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
        .id-badge {
            font-size: 8px;
            padding: 1px 6px;
            border-radius: 8px;
            display: inline-block;
        }
        .id-ktp { background-color: #dbeafe; color: #1e40af; }
        .id-passport { background-color: #d1fae5; color: #065f46; }
    </style>
</head>
<body>

<div class="header">
    <h1>Laporan Data Booking</h1>
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
            <th width="4%">#</th>
            <th width="12%">Nama</th>
            <th width="12%">Email</th>
            <th width="10%">Phone</th>
            <th width="8%">Tamu</th>
            <th width="10%">Identitas</th>
            <th width="8%">Check-in</th>
            <th width="8%">Check-out</th>
            <th width="8%">Bungalow</th>
            <th width="10%">Total</th>
            <th width="8%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $index => $booking)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-left">{{ $booking->first_name }} {{ $booking->last_name }}</td>
            <td>{{ $booking->email ?? '-' }}</td>
            <td>{{ $booking->phone }}</td>
            <td>{{ $booking->adults ?? 1 }} D, {{ $booking->children ?? 0 }} A</td>
            <td>
                <span class="id-badge {{ $booking->id_type == 'ktp' ? 'id-ktp' : 'id-passport' }}">
                    {{ $booking->id_type == 'ktp' ? 'KTP' : 'Passport' }}
                </span>
                <br><span style="font-size:8px;">{{ $booking->id_number ?? '-' }}</span>
            </td>
            <td class="text-nowrap">{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
            <td class="text-nowrap">{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td>
            <td>
                @php
                    $bungalows = json_decode($booking->selected_bungalows, true);
                    $bungalowNames = ['b1' => 'B1', 'b2' => 'B2', 'b3' => 'B3', 'b4' => 'B4'];
                    $names = [];
                    if (is_array($bungalows)) {
                        foreach ($bungalows as $b) {
                            $names[] = $bungalowNames[$b] ?? $b;
                        }
                    }
                    echo implode(', ', $names);
                @endphp
            </td>
            <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            <td>
                <span class="status-badge status-{{ $booking->status }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="11" style="text-align: center; padding: 20px; color: #999;">
                Tidak ada data booking
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