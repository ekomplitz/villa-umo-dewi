<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Bungalow Settings - Admin</title>
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
        
        /* ========== SIDEBAR ========== */
        .sidebar {
            background-color: var(--sidebar-bg) !important;
            color: var(--sidebar-text) !important;
        }
        
        .sidebar a {
            color: var(--sidebar-text) !important;
        }
        
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.15) !important;
        }
        
        .sidebar .border-t {
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        
        .sidebar h2 {
            color: var(--sidebar-text) !important;
        }
        
        .sidebar .text-white\/70 {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        
        /* ========== SWITCH MODE PUTIH ========== */
        .theme-switch-track {
            width: 44px;
            height: 24px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            transition: all 0.3s;
            position: relative;
            cursor: pointer;
        }
        
        .theme-switch-track.active {
            background-color: rgba(255, 255, 255, 0.6);
        }
        
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
        
        .theme-switch-track.active .theme-switch-thumb {
            transform: translateX(20px);
        }
        
        /* ========== CONTENT PANEL ========== */
        .bg-white {
            background-color: var(--bg-card) !important;
        }
        
        .text-gray-500, .text-gray-600, .text-gray-700 {
            color: var(--text-card) !important;
        }
        
        .border-gray-200, .border-t {
            border-color: var(--border-color) !important;
        }
        
        .shadow-md {
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .bg-gray-100 {
            background-color: var(--bg-body) !important;
        }
        
        .bg-gray-200 {
            background-color: var(--border-color) !important;
        }
        
        .hover\:bg-gray-50:hover {
            background-color: var(--bg-card) !important;
        }
        
        .dark-mode .shadow-md {
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }
        
        .dark-mode .text-yellow-500 { color: #fbbf24 !important; }
        .dark-mode .text-blue-600 { color: #60a5fa !important; }
        .dark-mode .text-green-600 { color: #34d399 !important; }
        .dark-mode .text-green-700 { color: #6ee7b7 !important; }
        .dark-mode .text-purple-600 { color: #a78bfa !important; }
        .dark-mode .text-purple-700 { color: #8b5cf6 !important; }
        
        /* ========== FORM STYLES ========== */
        .form-label {
            display: block;
            margin-bottom: 0.3rem;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-body);
        }
        
        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--bg-card);
            color: var(--text-body);
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(157, 102, 56, 0.15);
        }
        
        .form-textarea {
            resize: vertical;
            min-height: 60px;
        }
        
        .btn-update {
            width: 100%;
            padding: 8px;
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-update:hover {
            background-color: var(--primary-hover);
            transform: scale(1.02);
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 4px solid #28a745;
        }
        
        .dark-mode .alert-success {
            background-color: rgba(52, 211, 153, 0.2);
            color: #6ee7b7;
            border-left-color: #34d399;
        }
        
        .dark-mode .form-input, 
        .dark-mode .form-textarea, 
        .dark-mode .form-select {
            background-color: #3C5B6F;
            color: #DFD0B8;
            border-color: #948979;
        }
        
        .dark-mode .form-input:focus, 
        .dark-mode .form-textarea:focus, 
        .dark-mode .form-select:focus {
            border-color: #DFD0B8;
            box-shadow: 0 0 0 3px rgba(223, 208, 184, 0.15);
        }
        
        .dark-mode .form-label {
            color: #DFD0B8;
        }
        
        .bg-card {
            background-color: var(--bg-card) !important;
        }
    </style>
</head>

<body>

<div class="min-h-screen flex flex-col md:flex-row">
    <!-- SIDEBAR - Light: Brown, Dark: Biru Tua -->
    <div class="sidebar w-full md:w-64 p-4 md:p-6 md:min-h-screen flex flex-col">
        <h2 class="text-2xl font-bold mb-6 md:mb-8 flex items-center justify-center md:justify-start">
            <i class="fas fa-leaf mr-2"></i>Admin Panel
        </h2>
        
        <nav class="flex flex-wrap md:flex-col gap-2 flex-1">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : '' }}">
                <i class="fas fa-chart-line mr-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.bookings') ? 'bg-white/10' : '' }}">
                <i class="fas fa-list mr-2"></i> Bookings
            </a>
            <a href="{{ route('admin.bungalow.settings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.bungalow.settings') ? 'bg-white/10' : '' }}">
                <i class="fas fa-bed mr-2"></i> Bungalow
            </a>
            <a href="{{ route('admin.offline.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.offline.bookings') ? 'bg-white/10' : '' }}">
                <i class="fas fa-user-plus mr-2"></i> Offline
            </a>
            <a href="{{ route('admin.reports') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.reports') ? 'bg-white/10' : '' }}">
                <i class="fas fa-flag mr-2"></i> Reports
            </a>
            <a href="{{ route('admin.galleries') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.galleries') ? 'bg-white/10' : '' }}">
                <i class="fas fa-images mr-2"></i> Gallery
            </a>
        </nav>

        <!-- DARK/LIGHT MODE SWITCH (PUTIH) + LOGOUT -->
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

    <!-- ========== CONTENT ========== -->
    <div class="flex-1 p-4 md:p-8">
        <h1 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--text-body)">Pengaturan Bungalow</h1>

        @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
        @endif

        <p class="text-sm mb-6" style="color: var(--text-card)">
            <i class="fas fa-info-circle mr-1"></i> Perubahan harga dan deskripsi akan langsung terlihat di halaman booking.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($bungalows as $bungalow)
            <div class="bg-card rounded-xl shadow-md p-4 border" style="border-color: var(--border-color);">
                <form method="POST" action="{{ route('admin.bungalow.update', $bungalow->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex items-center gap-2 mb-3">
                        <i class="fas fa-bed text-xl" style="color: var(--primary-color);"></i>
                        <span class="text-lg font-bold" style="color: var(--text-body)">{{ $bungalow->code }}</span>
                        <span class="text-xs px-2 py-0.5 rounded-full 
                            {{ $bungalow->status == 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $bungalow->status }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" value="{{ $bungalow->name }}" class="form-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi (Indonesia)</label>
                        <textarea name="description_id" rows="2" class="form-textarea">{{ $bungalow->description_id }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (English)</label>
                        <textarea name="description_en" rows="2" class="form-textarea">{{ $bungalow->description_en }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ $bungalow->price }}" class="form-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ $bungalow->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $bungalow->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-update">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // ========== ADMIN THEME TOGGLE ==========
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
    
    // ========== INITIALIZE ==========
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