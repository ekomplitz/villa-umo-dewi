<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin Dashboard - Villa Umo Dewi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- ===== FAVICON ===== -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='leaf' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%2333cc55'/%3E%3Cstop offset='100%25' style='stop-color:%23118833'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d='M50 5 C25 25 5 55 50 95 C95 55 75 25 50 5Z' fill='url(%23leaf)'/%3E%3Cpath d='M50 5 L50 75' stroke='%230d6b2e' stroke-width='2.5' fill='none'/%3E%3Cpath d='M50 25 L30 45' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 25 L70 45' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 45 L32 65' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 45 L68 65' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3C/svg%3E">
    <!-- Fallback -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E🍃%3C/text%3E%3C/svg%3E">

    <style>
        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            --bg-body: #EFE9E3;
            --text-body: #9D6638;
            --bg-card: #F3F4F4;
            --text-card: #9D6638;
            --border-color: #EFE9E3;
            --primary-color: #9D6638;
            --primary-hover: #7A4F2A;
            --sidebar-bg: #9D6638;
            --sidebar-text: #EFE9E3;
        }
        
        .dark-mode {
            --bg-body: #153448;
            --text-body: #DFD0B8;
            --bg-card: #3C5B6F;
            --text-card: #DFD0B8;
            --border-color: #948979;
            --primary-color: #DFD0B8;
            --primary-hover: #948979;
            --sidebar-bg: #0F2A4A;
            --sidebar-text: #FFFFFF;
        }
        
        body {
            background-color: var(--bg-body);
            color: var(--text-body);
            transition: all 0.3s ease;
            min-height: 100vh;
        }
        
        .sidebar {
            background-color: var(--sidebar-bg) !important;
            color: var(--sidebar-text) !important;
        }
        .sidebar a { color: var(--sidebar-text) !important; }
        .sidebar a:hover { background-color: rgba(255,255,255,0.1) !important; }
        .sidebar a.active { background-color: rgba(255,255,255,0.15) !important; }
        .sidebar .border-t { border-color: rgba(255,255,255,0.15) !important; }
        .sidebar h2 { color: var(--sidebar-text) !important; }
        .sidebar .text-white\/70 { color: rgba(255,255,255,0.7) !important; }
        
        .theme-switch-track {
            width: 44px;
            height: 24px;
            background-color: rgba(255,255,255,0.3);
            border-radius: 30px;
            transition: all 0.3s;
            position: relative;
            cursor: pointer;
        }
        .theme-switch-track.active { background-color: rgba(255,255,255,0.6); }
        .theme-switch-thumb {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            background-color: #FFFFFF;
            border-radius: 50%;
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .theme-switch-track.active .theme-switch-thumb { transform: translateX(20px); }
        
        .bg-white { background-color: var(--bg-card) !important; }
        .text-gray-500, .text-gray-600, .text-gray-700 { color: var(--text-card) !important; }
        .border-gray-200, .border-t { border-color: var(--border-color) !important; }
        .shadow-md { box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .bg-gray-100 { background-color: var(--bg-body) !important; }
        .bg-gray-200 { background-color: var(--border-color) !important; }
        
        .dark-mode .shadow-md { box-shadow: 0 4px 6px rgba(0,0,0,0.3); }
        .dark-mode .text-blue-600 { color: #60a5fa !important; }
        .dark-mode .text-yellow-500 { color: #fbbf24 !important; }
        .dark-mode .text-green-600 { color: #34d399 !important; }
        .dark-mode .text-green-700 { color: #6ee7b7 !important; }
        .dark-mode .text-purple-600 { color: #a78bfa !important; }
        .dark-mode .text-purple-700 { color: #8b5cf6 !important; }
    </style>
</head>

<body>

<div class="min-h-screen flex flex-col md:flex-row">
    <!-- SIDEBAR -->
    <div class="sidebar w-full md:w-64 p-4 md:p-6 md:min-h-screen flex flex-col">
        <h2 class="text-2xl font-bold mb-6 md:mb-8 flex items-center justify-center md:justify-start">
            <i class="fas fa-leaf mr-2"></i>Admin Panel
        </h2>
        
        <nav class="flex flex-wrap md:flex-col gap-2 flex-1">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : '' }}">
                <i class="fas fa-chart-line mr-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-list mr-2"></i> Bookings
            </a>
            <a href="{{ route('admin.bungalow.settings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-bed mr-2"></i> Bungalow
            </a>
            <a href="{{ route('admin.offline.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-user-plus mr-2"></i> Offline
            </a>
            <a href="{{ route('admin.reports') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-flag mr-2"></i> Reports
            </a>
            <a href="{{ route('admin.galleries') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-images mr-2"></i> Gallery
            </a>
        </nav>

        <div class="mt-auto pt-4 border-t border-white/15">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-white/70">
                    <i class="fas fa-sun mr-2"></i> Mode
                </span>
                <div class="theme-switch-track" id="adminThemeTrack" onclick="toggleAdminTheme()">
                    <div class="theme-switch-thumb"></div>
                </div>
            </div>
            <a href="{{ route('admin.logout') }}" class="block w-full text-center py-2 px-4 bg-red-600 hover:bg-red-700 rounded-lg text-white transition">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-4 md:p-8">
        <h1 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--text-body);">Dashboard</h1>

        <!-- STATS -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                <div class="text-2xl md:text-3xl font-bold text-blue-600">{{ $totalBookings }}</div>
                <div class="text-sm text-gray-500">Total Booking</div>
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
                <div class="text-sm text-gray-500">Revenue</div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                <div class="text-2xl md:text-3xl font-bold text-purple-600">{{ $totalOffline ?? 0 }}</div>
                <div class="text-sm text-gray-500">Offline Booking</div>
            </div>
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
                <div class="text-2xl md:text-3xl font-bold text-purple-700">Rp {{ number_format($totalRevenueOffline ?? 0, 0, ',', '.') }}</div>
                <div class="text-sm text-gray-500">Revenue Offline</div>
            </div>
        </div>

        <!-- QUICK LINKS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.bookings') }}" class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 text-center transition">
                <i class="fas fa-list text-2xl block mb-2"></i> Lihat Booking
            </a>
            <a href="{{ route('admin.bungalow.settings') }}" class="bg-green-600 text-white p-4 rounded-lg hover:bg-green-700 text-center transition">
                <i class="fas fa-bed text-2xl block mb-2"></i> Atur Bungalow
            </a>
            <a href="{{ route('admin.offline.bookings') }}" class="bg-purple-600 text-white p-4 rounded-lg hover:bg-purple-700 text-center transition">
                <i class="fas fa-user-plus text-2xl block mb-2"></i> Offline Booking
            </a>
        </div>
    </div>
</div>

<script>
    // THEME TOGGLE
    function toggleAdminTheme() {
        const isDark = document.documentElement.classList.contains('dark-mode');
        const track = document.getElementById('adminThemeTrack');
        
        if (isDark) {
            document.documentElement.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
            track.classList.remove('active');
        } else {
            document.documentElement.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
            track.classList.add('active');
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        const track = document.getElementById('adminThemeTrack');
        
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark-mode');
            if (track) track.classList.add('active');
        }
    });
</script>

</body>
</html>
