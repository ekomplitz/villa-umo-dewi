<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin Dashboard - Villa Umo Dewi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --purple: #8b5cf6;
            --red: #dc2626;
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
            --success: #34d399;
            --danger: #f87171;
            --warning: #fbbf24;
            --info: #60a5fa;
            --purple: #a78bfa;
            --red: #f87171;
        }
        
        body {
            background-color: var(--bg-body);
            color: var(--text-body);
            transition: all 0.3s ease;
            min-height: 100vh;
            height: 100vh;
            overflow: hidden;
        }
        
        .main-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        
        .content-area {
            flex: 1;
            padding: 20px 32px;
            overflow-y: auto;
            height: 100vh;
        }
        
        .sidebar {
            background-color: var(--sidebar-bg) !important;
            color: var(--sidebar-text) !important;
            flex-shrink: 0;
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
        
        .dark-mode .shadow-md { box-shadow: 0 4px 6px rgba(0,0,0,0.3); }
        
        .stat-card {
            background-color: var(--bg-card);
            border-radius: 12px;
            padding: 16px 20px;
            border: 1px solid var(--border-color);
            transition: all 0.3s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.06); }
        .dark-mode .stat-card:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .stat-icon.green { background-color: rgba(34,197,94,0.15); color: #22c55e; }
        .stat-icon.yellow { background-color: rgba(245,158,11,0.15); color: #f59e0b; }
        .stat-icon.blue { background-color: rgba(59,130,246,0.15); color: #3b82f6; }
        .stat-icon.purple { background-color: rgba(139,92,246,0.15); color: #8b5cf6; }
        .stat-icon.red { background-color: rgba(239,68,68,0.15); color: #ef4444; }
        .stat-icon.teal { background-color: rgba(20,184,166,0.15); color: #14b8a6; }
        .stat-icon.orange { background-color: rgba(249,115,22,0.15); color: #f97316; }
        
        .dark-mode .stat-icon.green { background-color: rgba(52,211,153,0.2); color: #34d399; }
        .dark-mode .stat-icon.yellow { background-color: rgba(251,191,36,0.2); color: #fbbf24; }
        .dark-mode .stat-icon.blue { background-color: rgba(96,165,250,0.2); color: #60a5fa; }
        .dark-mode .stat-icon.purple { background-color: rgba(167,139,250,0.2); color: #a78bfa; }
        .dark-mode .stat-icon.red { background-color: rgba(248,113,113,0.2); color: #f87171; }
        .dark-mode .stat-icon.teal { background-color: rgba(45,212,191,0.2); color: #2dd4bf; }
        .dark-mode .stat-icon.orange { background-color: rgba(251,146,60,0.2); color: #fb923c; }
        
        .stat-number { font-size: 1.5rem; font-weight: 700; line-height: 1.2; }
        .stat-label { font-size: 0.78rem; color: var(--text-card); }
        
        .divider { border-color: var(--border-color); }
        
        .quick-link {
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
        }
        .quick-link:hover { transform: translateY(-2px); }
        
        .dashboard-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-body);
        }
        
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .grid-online-offline {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        
        .grid-quick-links {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        
        @media (max-width: 1024px) {
            .grid-stats { grid-template-columns: repeat(3, 1fr); }
            .grid-online-offline { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            .grid-stats { grid-template-columns: repeat(2, 1fr); }
            .grid-quick-links { grid-template-columns: 1fr; }
            .content-area { padding: 16px; }
        }
        
        @media (max-width: 480px) {
            .grid-stats { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

<div class="main-container">
    <!-- SIDEBAR -->
    <div class="sidebar w-64 p-4 md:p-6 flex flex-col min-h-screen">
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
    <div class="content-area">
        <h1 class="dashboard-title">Dashboard</h1>

        <!-- ===== STATS ===== -->
        <div class="grid-stats">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="stat-icon blue"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <div class="stat-number" style="color: var(--text-body);">{{ $grandTotalBookings }}</div>
                        <div class="stat-label">Total Booking</div>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="stat-icon yellow"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="stat-number" style="color: var(--text-body);">{{ $grandPending }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <div class="stat-number" style="color: var(--text-body);">{{ $grandConfirmed }}</div>
                        <div class="stat-label">Confirmed</div>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="stat-icon red"><i class="fas fa-times-circle"></i></div>
                    <div>
                        <div class="stat-number" style="color: var(--text-body);">{{ $grandCancelled }}</div>
                        <div class="stat-label">Cancelled</div>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="stat-icon teal"><i class="fas fa-money-bill-wave"></i></div>
                    <div>
                        <div class="stat-number" style="color: var(--text-body);">Rp {{ number_format($grandRevenue, 0, ',', '.') }}</div>
                        <div class="stat-label">Revenue</div>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="stat-icon orange"><i class="fas fa-times"></i></div>
                    <div>
                        <div class="stat-number" style="color: var(--text-body);">Rp {{ number_format($grandCancelledRevenue, 0, ',', '.') }}</div>
                        <div class="stat-label">Total Cancelled</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== ONLINE & OFFLINE ===== -->
        <div class="grid-online-offline">
            <!-- ONLINE -->
            <div class="stat-card">
                <h3 class="font-bold text-sm mb-3" style="color: var(--text-body);">
                    <i class="fas fa-globe mr-2" style="color: var(--primary-color);"></i> Online
                </h3>
                <div class="grid grid-cols-5 gap-2 text-center">
                    <div><span class="stat-label">Total</span><div class="font-bold text-sm" style="color: var(--text-body);">{{ $totalBookings }}</div></div>
                    <div><span class="stat-label">Pending</span><div class="font-bold text-sm" style="color: var(--text-body);">{{ $pendingBookings }}</div></div>
                    <div><span class="stat-label">Confirmed</span><div class="font-bold text-sm" style="color: var(--text-body);">{{ $confirmedBookings }}</div></div>
                    <div><span class="stat-label">Cancelled</span><div class="font-bold text-sm" style="color: var(--text-body);">{{ $cancelledBookings }}</div></div>
                    <div><span class="stat-label">Revenue</span><div class="font-bold text-sm" style="color: var(--text-body);">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div></div>
                </div>
            </div>

            <!-- OFFLINE -->
            <div class="stat-card">
                <h3 class="font-bold text-sm mb-3" style="color: var(--text-body);">
                    <i class="fas fa-user-plus mr-2" style="color: var(--primary-color);"></i> Offline
                </h3>
                <div class="grid grid-cols-5 gap-2 text-center">
                    <div><span class="stat-label">Total</span><div class="font-bold text-sm" style="color: var(--text-body);">{{ $totalOffline }}</div></div>
                    <div><span class="stat-label">Pending</span><div class="font-bold text-sm" style="color: var(--text-body);">{{ $pendingOffline }}</div></div>
                    <div><span class="stat-label">Confirmed</span><div class="font-bold text-sm" style="color: var(--text-body);">{{ $confirmedOffline }}</div></div>
                    <div><span class="stat-label">Cancelled</span><div class="font-bold text-sm" style="color: var(--text-body);">{{ $cancelledOffline }}</div></div>
                    <div><span class="stat-label">Revenue</span><div class="font-bold text-sm" style="color: var(--text-body);">Rp {{ number_format($totalRevenueOffline, 0, ',', '.') }}</div></div>
                </div>
            </div>
        </div>

        <!-- ===== QUICK LINKS ===== -->
        <div class="grid-quick-links">
            <a href="{{ route('admin.bookings') }}" class="quick-link" style="background-color: #3b82f6; color: #fff;">
                <i class="fas fa-list text-xl block mb-1"></i>
                <span class="text-sm font-medium">Lihat Booking</span>
            </a>
            <a href="{{ route('admin.bungalow.settings') }}" class="quick-link" style="background-color: #22c55e; color: #fff;">
                <i class="fas fa-bed text-xl block mb-1"></i>
                <span class="text-sm font-medium">Atur Bungalow</span>
            </a>
            <a href="{{ route('admin.offline.bookings') }}" class="quick-link" style="background-color: #8b5cf6; color: #fff;">
                <i class="fas fa-user-plus text-xl block mb-1"></i>
                <span class="text-sm font-medium">Offline Booking</span>
            </a>
        </div>
    </div>
</div>

<script>
    // ========== THEME TOGGLE ==========
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