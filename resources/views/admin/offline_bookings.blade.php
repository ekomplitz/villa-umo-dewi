<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Offline Bookings - Admin</title>
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
                <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
                    <i class="fas fa-list mr-2"></i> Bookings
                </a>
                <a href="{{ route('admin.bungalow.settings') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
                    <i class="fas fa-bed mr-2"></i> Bungalow Settings
                </a>
                <a href="{{ route('admin.offline.bookings') }}" class="block py-2 px-4 bg-green-700 rounded-lg">
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
                <h1 class="text-2xl md:text-3xl font-bold">Booking Offline</h1>
                <button onclick="document.getElementById('offlineModal').classList.remove('hidden')" 
                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 w-full md:w-auto text-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Booking Offline
                </button>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
            @endif

            <!-- Tabel Offline Bookings -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[800px]">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">ID</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">Customer</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">Check-in</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">Check-out</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">Bungalow</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">Total</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">Payment</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">Status</th>
                                <th class="px-3 py-3 text-left text-xs font-semibold uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($offlineBookings as $offline)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-3 py-3 text-sm">#{{ $offline->id }}</td>
                                <td class="px-3 py-3 text-sm">
                                    <div class="font-medium">{{ $offline->customer_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $offline->customer_phone }}</div>
                                </td>
                                <td class="px-3 py-3 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($offline->check_in)->format('d/m/Y') }}</td>
                                <td class="px-3 py-3 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($offline->check_out)->format('d/m/Y') }}</td>
                                <td class="px-3 py-3 text-sm">
                                    @php
                                        $bungalowData = json_decode($offline->selected_bungalows, true);
                                        $bungalowNames = ['b1' => 'B1', 'b2' => 'B2', 'b3' => 'B3', 'b4' => 'B4'];
                                        $names = [];
                                        if (is_array($bungalowData)) {
                                            foreach ($bungalowData as $b) {
                                                $names[] = $bungalowNames[$b] ?? $b;
                                            }
                                        }
                                        echo implode(', ', $names);
                                    @endphp
                                </td>
                                <td class="px-3 py-3 text-sm font-bold whitespace-nowrap">Rp {{ number_format($offline->total_price, 0, ',', '.') }}</td>
                                <td class="px-3 py-3 text-sm">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($offline->payment_status == 'paid') bg-green-200 text-green-800
                                        @elseif($offline->payment_status == 'partial') bg-yellow-200 text-yellow-800
                                        @else bg-red-200 text-red-800 @endif">
                                        {{ $offline->payment_status }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-sm">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($offline->status == 'confirmed') bg-green-200 text-green-800
                                        @elseif($offline->status == 'cancelled') bg-red-200 text-red-800
                                        @else bg-yellow-200 text-yellow-800 @endif">
                                        {{ $offline->status }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <button onclick="openEditModal('{{ $offline->id }}', '{{ $offline->payment_status }}', '{{ $offline->status }}', '{{ addslashes($offline->notes) }}')" 
                                        class="text-blue-600 hover:text-blue-800 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.offline.destroy', $offline->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="inline">
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
                                <td colspan="9" class="px-6 py-6 text-center text-gray-500">
                                    Belum ada booking offline
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $offlineBookings->links() }}
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH OFFLINE -->
    <div id="offlineModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl p-6 max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4">Tambah Booking Offline</h2>
            <form method="POST" action="{{ route('admin.offline.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Nama Customer *</label>
                    <input type="text" name="customer_name" required class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">No HP *</label>
                    <input type="text" name="customer_phone" required class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="customer_email" class="w-full px-3 py-2 border rounded-lg">
                </div>

                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Check-in *</label>
                        <input type="date" name="check_in" required class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Check-out *</label>
                        <input type="date" name="check_out" required class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Pilih Bungalow *</label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        @foreach($bungalows as $bungalow)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="selected_bungalows[]" value="{{ $bungalow->code }}" class="bungalow-check">
                            <span class="text-sm">{{ $bungalow->code }} - Rp {{ number_format($bungalow->price, 0, ',', '.') }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Payment Status</label>
                    <select name="payment_status" class="w-full px-3 py-2 border rounded-lg">
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="partial">Partial</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="w-full px-3 py-2 border rounded-lg">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="notes" rows="2" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
                        Simpan
                    </button>
                    <button type="button" onclick="this.closest('#offlineModal').classList.add('hidden')" 
                        class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT OFFLINE -->
    <div id="editModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl p-6 max-w-lg w-full mx-4">
            <h2 class="text-2xl font-bold mb-4">Edit Booking Offline</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Payment Status</label>
                    <select name="payment_status" id="editPaymentStatus" class="w-full px-3 py-2 border rounded-lg">
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="partial">Partial</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="editStatus" class="w-full px-3 py-2 border rounded-lg">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="notes" id="editNotes" rows="2" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Update
                    </button>
                    <button type="button" onclick="this.closest('#editModal').classList.add('hidden')" 
                        class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, paymentStatus, status, notes) {
            document.getElementById('editForm').action = '/admin/offline-bookings/' + id;
            document.getElementById('editPaymentStatus').value = paymentStatus;
            document.getElementById('editStatus').value = status;
            document.getElementById('editNotes').value = notes || '';
            document.getElementById('editModal').classList.remove('hidden');
        }
    </script>
</body>
</html>