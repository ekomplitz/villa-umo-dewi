<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Bookings - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-green-800 text-white p-4 md:p-6 md:min-h-screen">
            <h2 class="text-2xl font-bold mb-6 md:mb-8 flex items-center justify-center md:justify-start">
                <i class="fas fa-leaf mr-2"></i>Admin Panel
            </h2>
            <nav class="flex flex-wrap md:flex-col gap-2">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 bg-green-700 rounded-lg">
                    <i class="fas fa-list mr-2"></i> Bookings
                </a>
                <a href="{{ route('admin.bungalow.settings') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
                    <i class="fas fa-bed mr-2"></i> Bungalow Settings
                </a>
                <a href="{{ route('admin.offline.bookings') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
                    <i class="fas fa-user-plus mr-2"></i> Offline Booking
                </a>
                <a href="{{ route('admin.logout') }}" class="block py-2 px-4 hover:bg-red-700 rounded-lg text-red-300 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1 p-4 md:p-8 overflow-x-hidden">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <h1 class="text-2xl md:text-3xl font-bold">Data Booking</h1>
                <a href="{{ route('admin.export') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm w-full md:w-auto text-center">
                    <i class="fas fa-file-export mr-2"></i> Export CSV
                </a>
            </div>

            <!-- Filter & Search -->
            <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                <form method="GET" class="flex flex-wrap gap-3">
                    <div class="flex-1 min-w-[120px]">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 w-full px-3 py-2 border rounded-lg text-sm">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[150px]">
                        <label class="block text-sm font-medium text-gray-700">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama/Email/Phone..." class="mt-1 w-full px-3 py-2 border rounded-lg text-sm">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                            <i class="fas fa-search mr-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.bookings') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 text-sm">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded text-sm">
                {{ session('success') }}
            </div>
            @endif

            <!-- Tabel Booking - Responsive -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[800px]">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">ID</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Nama</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Email</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Phone</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Check-in</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Check-out</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Bungalow</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Total</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Status</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-3 py-3 text-sm">#{{ $booking->id }}</td>
                                <td class="px-3 py-3 text-sm font-medium max-w-[120px] truncate" title="{{ $booking->name }}">
                                    {{ $booking->name }}
                                </td>
                                <td class="px-3 py-3 text-sm max-w-[150px] truncate" title="{{ $booking->email }}">
                                    {{ $booking->email }}
                                </td>
                                <td class="px-3 py-3 text-sm">{{ $booking->phone }}</td>
                                <td class="px-3 py-3 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
                                <td class="px-3 py-3 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td>
                                <td class="px-3 py-3 text-sm">
                                    @php
                                        $bungalows = json_decode($booking->selected_bungalows);
                                        $bungalowNames = ['b1' => 'B1', 'b2' => 'B2', 'b3' => 'B3', 'b4' => 'B4'];
                                        $names = [];
                                        if (is_array($bungalows)) {
                                            foreach ($bungalows as $b) {
                                                $names[] = $bungalowNames[$b] ?? $b;
                                            }
                                        }
                                    @endphp
                                    {{ implode(', ', $names) }}
                                </td>
                                <td class="px-3 py-3 text-sm font-bold whitespace-nowrap">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                <td class="px-3 py-3">
                                    <form action="{{ route('admin.updateStatus', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded text-xs font-semibold
                                            @if($booking->status == 'pending') bg-yellow-200 text-yellow-800
                                            @elseif($booking->status == 'confirmed') bg-green-200 text-green-800
                                            @else bg-red-200 text-red-800 @endif">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-3 py-3">
                                    <form action="{{ route('admin.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin hapus booking ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-6 text-center text-gray-500">
                                    Belum ada data booking
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-4 overflow-x-auto">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</body>
</html>