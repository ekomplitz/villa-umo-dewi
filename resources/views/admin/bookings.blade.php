<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin Bookings - Villa Umo Dewi</title>
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
        .hover\:bg-gray-50:hover { background-color: var(--bg-card) !important; }
        
        .dark-mode .shadow-md { box-shadow: 0 4px 6px rgba(0,0,0,0.3); }
        .dark-mode .text-yellow-500 { color: #fbbf24 !important; }
        .dark-mode .text-blue-600 { color: #60a5fa !important; }
        .dark-mode .text-green-600 { color: #34d399 !important; }
        .dark-mode .text-green-700 { color: #6ee7b7 !important; }
        .dark-mode .text-purple-600 { color: #a78bfa !important; }
        .dark-mode .text-purple-700 { color: #8b5cf6 !important; }
        .dark-mode .text-red-600 { color: #f87171 !important; }
        .dark-mode .text-red-700 { color: #ef4444 !important; }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            border-left: 4px solid #28a745;
        }
        .dark-mode .alert-success {
            background-color: rgba(52,211,153,0.2);
            color: #6ee7b7;
            border-left-color: #34d399;
        }
        
        .form-input {
            padding: 8px 12px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--bg-card);
            color: var(--text-body);
            font-size: 0.9rem;
            transition: all 0.3s;
            width: 100%;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(157,102,56,0.15);
        }
        .dark-mode .form-input {
            background-color: #3C5B6F;
            color: #DFD0B8;
            border-color: #948979;
        }
        .dark-mode .form-input:focus {
            border-color: #DFD0B8;
            box-shadow: 0 0 0 3px rgba(223,208,184,0.15);
        }
        
        .form-select {
            padding: 8px 12px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--bg-card);
            color: var(--text-body);
            font-size: 0.9rem;
            transition: all 0.3s;
            width: 100%;
        }
        .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(157,102,56,0.15);
        }
        .dark-mode .form-select {
            background-color: #3C5B6F;
            color: #DFD0B8;
            border-color: #948979;
        }
        .dark-mode .form-select:focus {
            border-color: #DFD0B8;
            box-shadow: 0 0 0 3px rgba(223,208,184,0.15);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-primary:hover { background-color: var(--primary-hover); }
        .dark-mode .btn-primary {
            background-color: #DFD0B8;
            color: #153448;
        }
        .dark-mode .btn-primary:hover { background-color: #948979; }
        
        .btn-success {
            background-color: #22c55e;
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-success:hover { background-color: #16a34a; }
        .dark-mode .btn-success {
            background-color: #34d399;
            color: #153448;
        }
        .dark-mode .btn-success:hover { background-color: #6ee7b7; }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-confirmed { background-color: #dbeafe; color: #1e40af; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        
        .dark-mode .status-pending { background-color: #78350f; color: #fbbf24; }
        .dark-mode .status-confirmed { background-color: #1e3a5f; color: #60a5fa; }
        .dark-mode .status-cancelled { background-color: #7f1d1d; color: #f87171; }
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        
        .modal-content {
            background-color: var(--bg-card);
            color: var(--text-body);
            border-radius: 16px;
            padding: 32px;
            max-width: 500px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
        }
        .dark-mode .modal-content {
            background-color: #3C5B6F;
            color: #DFD0B8;
        }
        
        .modal-close {
            position: sticky;
            top: 0;
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
            background: none;
            border: none;
            color: var(--text-body);
        }
        .dark-mode .modal-close { color: #DFD0B8; }
        
        .pagination .page-link {
            color: var(--text-body);
            background-color: var(--bg-card);
            border-color: var(--border-color);
        }
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }
        .dark-mode .pagination .page-link {
            background-color: #3C5B6F;
            color: #DFD0B8;
            border-color: #948979;
        }
        .dark-mode .pagination .page-item.active .page-link {
            background-color: #DFD0B8;
            color: #153448;
            border-color: #DFD0B8;
        }
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
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-chart-line mr-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.bookings*') ? 'bg-white/10' : '' }}">
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
        <div class="flex flex-wrap justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-bold" style="color: var(--text-body);">
                <i class="fas fa-list mr-2"></i> Booking Management
            </h1>
            <a href="{{ route('admin.export') }}" class="btn-success">
                <i class="fas fa-file-export mr-1"></i> Export CSV
            </a>
        </div>

        @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
        @endif

        <!-- SEARCH & FILTER -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <form method="GET" action="{{ route('admin.bookings') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium mb-1" style="color: var(--text-card);">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nama, email, atau telepon..." class="form-input">
                </div>
                
                <div class="min-w-[150px]">
                    <label class="block text-sm font-medium mb-1" style="color: var(--text-card);">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.bookings') }}" class="btn-primary" style="background-color: var(--border-color); color: var(--text-body);">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px]">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Phone</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Check In</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Check Out</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Bungalow</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Total</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">#{{ $loop->iteration + ($bookings->currentPage() - 1) * $bookings->perPage() }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $booking->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $booking->email }}</td>
                            <td class="px-4 py-3 text-sm">{{ $booking->phone }}</td>
                            <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $booking->selected_bungalows }}</td>
                            <td class="px-4 py-3 text-sm font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="status-badge 
                                    @if($booking->status == 'pending') status-pending
                                    @elseif($booking->status == 'confirmed') status-confirmed
                                    @else status-cancelled @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <button onclick="openUpdateModal({{ $booking->id }}, '{{ $booking->status }}')" 
                                        class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteBooking({{ $booking->id }}, '{{ $booking->name }}')" 
                                        class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $booking->id }}" 
                                      action="{{ route('admin.destroy', $booking->id) }}" 
                                      method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-6 py-6 text-center text-gray-500">
                                Belum ada booking
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAGINATION -->
        <div class="mt-4">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
        
        <div class="mt-2 text-sm" style="color: var(--text-card);">
            Menampilkan {{ $bookings->firstItem() ?? 0 }} - {{ $bookings->lastItem() ?? 0 }} dari {{ $bookings->total() }} booking
        </div>
    </div>
</div>

<!-- MODAL UPDATE STATUS -->
<div class="modal-overlay" id="updateModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeUpdateModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <h3 class="text-xl font-bold mb-4">Update Status Booking</h3>
        
        <form id="updateForm" method="POST" action="">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1" style="color: var(--text-body);">Status</label>
                <select name="status" class="form-select">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            
            <button type="submit" class="btn-primary w-full py-2">
                <i class="fas fa-save mr-1"></i> Update Status
            </button>
        </form>
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

    // MODAL UPDATE
    function openUpdateModal(id, currentStatus) {
        const modal = document.getElementById('updateModal');
        const form = document.getElementById('updateForm');
        const select = form.querySelector('select[name="status"]');
        
        form.action = '/admin/bookings/' + id + '/status';
        select.value = currentStatus;
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeUpdateModal() {
        document.getElementById('updateModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    
    document.getElementById('updateModal').addEventListener('click', function(e) {
        if (e.target === this) closeUpdateModal();
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeUpdateModal();
    });

    // DELETE BOOKING
    function deleteBooking(id, name) {
        if (confirm('Yakin ingin menghapus booking dari "' + name + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

</body>
</html>