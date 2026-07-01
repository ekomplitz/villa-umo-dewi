<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin Panel - Villa Umo Dewi</title>
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
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 bg-green-700 rounded-lg">
                    <i class="fas fa-chart-line mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 hover:bg-green-700 rounded-lg">
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
        <div class="flex-1 p-4 md:p-8">
            <h1 class="text-2xl md:text-3xl font-bold mb-6">Dashboard</h1>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                    <div class="text-2xl md:text-3xl font-bold text-blue-600">{{ $totalBookings }}</div>
                    <div class="text-sm text-gray-500">Total Online Booking</div>
                </div>
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                    <div class="text-2xl md:text-3xl font-bold text-yellow-500">{{ $pendingBookings }}</div>
                    <div class="text-sm text-gray-500">Pending</div>
                </div>
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                    <div class="text-2xl md:text-3xl font-bold text-green-600">{{ $confirmedBookings }}</div>
                    <div class="text-sm text-gray-500">Confirmed</div>
                </div>
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                    <div class="text-2xl md:text-3xl font-bold text-green-700">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    <div class="text-sm text-gray-500">Revenue Online</div>
                </div>
            </div>

            <!-- Offline Stats -->
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                    <div class="text-2xl md:text-3xl font-bold text-purple-600">{{ $totalOffline ?? 0 }}</div>
                    <div class="text-sm text-gray-500">Total Offline Booking</div>
                </div>
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                    <div class="text-2xl md:text-3xl font-bold text-purple-700">Rp {{ number_format($totalRevenueOffline ?? 0, 0, ',', '.') }}</div>
                    <div class="text-sm text-gray-500">Revenue Offline</div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.bookings') }}" class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 text-center">
                    <i class="fas fa-list text-2xl block mb-2"></i>
                    Lihat Semua Booking
                </a>
                <a href="{{ route('admin.bungalow.settings') }}" class="bg-green-600 text-white p-4 rounded-lg hover:bg-green-700 text-center">
                    <i class="fas fa-bed text-2xl block mb-2"></i>
                    Atur Bungalow
                </a>
                <a href="{{ route('admin.offline.bookings') }}" class="bg-purple-600 text-white p-4 rounded-lg hover:bg-purple-700 text-center">
                    <i class="fas fa-user-plus text-2xl block mb-2"></i>
                    Booking Offline
                </a>
            </div>
        </div>
    </div>
</body>
</html>