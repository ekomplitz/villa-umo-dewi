{{-- resources/views/admin/bookings.blade.php --}}
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
            --bg-about: #F3F4F4;
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
            --bg-about: #3C5B6F;
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
            min-height: 100vh;
        }
        .sidebar a { 
            color: var(--sidebar-text) !important; 
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar a i {
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar a:hover { background-color: rgba(255,255,255,0.1) !important; }
        .sidebar a.active { background-color: rgba(255,255,255,0.15) !important; }
        .sidebar .border-t { border-color: rgba(255,255,255,0.15) !important; }
        .sidebar h2 { 
            color: var(--sidebar-text) !important; 
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar h2 i {
            flex-shrink: 0;
        }
        .sidebar .text-white\/70 { color: rgba(255,255,255,0.7) !important; }
        
        .theme-switch-track {
            width: 44px;
            height: 24px;
            background-color: rgba(255,255,255,0.3);
            border-radius: 30px;
            transition: all 0.3s;
            position: relative;
            cursor: pointer;
            flex-shrink: 0;
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
            white-space: nowrap;
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
            white-space: nowrap;
        }
        .btn-success:hover { background-color: #16a34a; }
        .dark-mode .btn-success {
            background-color: #34d399;
            color: #153448;
        }
        .dark-mode .btn-success:hover { background-color: #6ee7b7; }
        
        .btn-danger {
            background-color: #dc2626;
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            white-space: nowrap;
        }
        .btn-danger:hover { background-color: #b91c1c; }
        .dark-mode .btn-danger {
            background-color: #ef4444;
            color: #fff;
        }
        .dark-mode .btn-danger:hover { background-color: #dc2626; }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-confirmed { background-color: #dbeafe; color: #1e40af; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .status-paid { background-color: #d1fae5; color: #065f46; }
        .status-partial { background-color: #fef3c7; color: #92400e; }
        
        .dark-mode .status-pending { background-color: #78350f; color: #fbbf24; }
        .dark-mode .status-confirmed { background-color: #1e3a5f; color: #60a5fa; }
        .dark-mode .status-cancelled { background-color: #7f1d1d; color: #f87171; }
        .dark-mode .status-paid { background-color: #064e3b; color: #34d399; }
        .dark-mode .status-partial { background-color: #78350f; color: #fbbf24; }
        
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
            backdrop-filter: blur(4px);
        }
        .modal-overlay.active { display: flex; }
        
        .modal-content {
            background-color: var(--bg-card);
            color: var(--text-body);
            border-radius: 16px;
            padding: 32px;
            max-width: 750px;
            width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }
        @keyframes modalSlideIn {
            from {
                transform: translateY(-30px) scale(0.95);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
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
            padding: 4px 8px;
            border-radius: 8px;
            transition: all 0.3s;
            z-index: 10;
        }
        .modal-close:hover {
            background-color: rgba(0,0,0,0.05);
        }
        .dark-mode .modal-close:hover {
            background-color: rgba(255,255,255,0.05);
        }
        
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
        
        .id-badge {
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 0.65rem;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }
        .id-ktp { background-color: #dbeafe; color: #1e40af; }
        .id-passport { background-color: #d1fae5; color: #065f46; }
        .dark-mode .id-ktp { background-color: #1e3a5f; color: #60a5fa; }
        .dark-mode .id-passport { background-color: #064e3b; color: #34d399; }

        /* Detail Modal Styles */
        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 6px 0;
        }
        .detail-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-card);
            opacity: 0.7;
        }
        .detail-value {
            font-size: 0.9rem;
            color: var(--text-body);
        }

        .guest-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: 8px;
            margin: 4px 0;
            background-color: rgba(157,102,56,0.06);
        }
        .dark-mode .guest-item {
            background-color: rgba(223,208,184,0.06);
        }
        .guest-number {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            background-color: var(--primary-color);
            color: #fff;
            flex-shrink: 0;
        }
        .dark-mode .guest-number {
            background-color: #DFD0B8;
            color: #153448;
        }

        .clickable-name {
            cursor: pointer;
            color: var(--primary-color);
            transition: all 0.3s;
        }
        .clickable-name:hover {
            text-decoration: underline;
            color: var(--primary-hover);
        }

        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            border: 0.25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }
        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }

        /* Icon receipt color fix for dark mode */
        .dark-mode .fa-receipt {
            color: #153448 !important;
        }

        /* ===== TABLE STYLES ===== */
        .table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .table-wrapper table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            min-width: 1000px;
        }
        
        /* Column widths - lebih proporsional */
        .col-no { width: 4%; }
        .col-nama { width: 20%; }
        .col-email { width: 10%; }
        .col-phone { width: 10%; }
        .col-detail { width: 10%; }
        .col-checkin { width: 8%; }
        .col-checkout { width: 8%; }
        .col-bungalow { width: 7%; }
        .col-total { width: 9%; }
        .col-status { width: 7%; }
        .col-aksi { width: 7%; }

        .table-wrapper th,
        .table-wrapper td {
            padding: 10px 6px;
            text-align: left;
            vertical-align: middle;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .table-wrapper th {
            font-size: 0.7rem;
            font-weight: 600;
            background-color: var(--border-color);
            color: var(--text-body);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .table-wrapper td {
            font-size: 0.82rem;
            border-bottom: 1px solid var(--border-color);
        }

        /* Fix sidebar icons */
        .sidebar .flex.items-center {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .col-nama { width: 18%; }
            .col-email { width: 8%; }
            .col-phone { width: 8%; }
            .col-detail { width: 10%; }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                width: 100% !important;
            }
            .table-wrapper table {
                min-width: 800px;
            }
        }
    </style>
</head>

<body>

<div class="min-h-screen flex flex-col md:flex-row">
    <!-- SIDEBAR -->
    <div class="w-full md:w-64 flex-shrink-0">
        <div class="sidebar w-full p-4 md:p-6 md:min-h-screen flex flex-col">
            <h2 class="text-2xl font-bold mb-6 md:mb-8">
                <i class="fas fa-leaf"></i>
                <span>Admin Panel</span>
            </h2>
            
            <nav class="flex flex-wrap md:flex-col gap-2 flex-1">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.bookings*') ? 'bg-white/10' : '' }}">
                    <i class="fas fa-list"></i>
                    <span>Bookings</span>
                </a>
                <a href="{{ route('admin.bungalow.settings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-bed"></i>
                    <span>Bungalow</span>
                </a>
                <a href="{{ route('admin.offline.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-user-plus"></i>
                    <span>Offline</span>
                </a>
                <a href="{{ route('admin.reports') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-flag"></i>
                    <span>Reports</span>
                </a>
                <a href="{{ route('admin.galleries') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
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
                <a href="/logout" class="block w-full text-center py-2 px-4 bg-red-600 hover:bg-red-700 rounded-lg text-white transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-4 md:p-8 min-w-0">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <h1 class="text-2xl md:text-3xl font-bold" style="color: var(--text-body);">
                <i class="fas fa-list mr-2"></i> Booking Management
            </h1>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.bookings.export-pdf', request()->query()) }}" class="btn-danger">
                    <i class="fas fa-file-pdf mr-1"></i> Export PDF
                </a>
                <a href="{{ route('admin.export', request()->query()) }}" class="btn-success">
                    <i class="fas fa-file-export mr-1"></i> Export CSV
                </a>
            </div>
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
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th class="col-no">#</th>
                            <th class="col-nama">Nama Tamu</th>
                            <th class="col-email">Email</th>
                            <th class="col-phone">Phone</th>
                            <th class="col-detail">Detail</th>
                            <th class="col-checkin">Check In</th>
                            <th class="col-checkout">Check Out</th>
                            <th class="col-bungalow">Bungalow</th>
                            <th class="col-total">Total</th>
                            <th class="col-status">Status</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        @php
                            $customerName = trim(($booking->first_name ?? '') . ' ' . ($booking->last_name ?? ''));
                            if (empty($customerName)) {
                                $customerName = 'Customer';
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
                            $bungalows = json_decode($booking->selected_bungalows, true) ?? [];
                            if (is_string($bungalows)) {
                                $bungalows = json_decode($bungalows, true) ?? [];
                            }
                            if (!is_array($bungalows)) {
                                $bungalows = [];
                            }
                            $bungalowNames = ['b1' => 'B1', 'b2' => 'B2', 'b3' => 'B3', 'b4' => 'B4'];
                            $bungalowList = [];
                            foreach ($bungalows as $b) {
                                $bungalowList[] = $bungalowNames[$b] ?? strtoupper($b);
                            }
                        @endphp
                        <tr>
                            <td class="col-no">#{{ $loop->iteration + ($bookings->currentPage() - 1) * $bookings->perPage() }}</td>
                            <td class="col-nama">
                                <div class="font-bold text-sm" style="color: var(--text-body);">
                                    <span class="clickable-name" onclick="openDetailModal({{ $booking->id }}, 'online')">
                                        {{ $customerName }}
                                    </span>
                                </div>
                                @if(count($guestNames) > 0)
                                    @foreach($guestNames as $guest)
                                    <div class="text-sm" style="color: var(--text-card); padding-left: 12px;">
                                        • {{ $guest }}
                                    </div>
                                    @endforeach
                                @endif
                            </td>
                            <td class="col-email">{{ $booking->email ?? '-' }}</td>
                            <td class="col-phone">{{ $booking->phone }}</td>
                            <td class="col-detail">
                                <div>
                                    <span class="text-xs">{{ $booking->adults ?? 1 }} Dewasa</span>
                                    @if(($booking->children ?? 0) > 0)
                                        <span class="text-xs">, {{ $booking->children }} Anak</span>
                                    @endif
                                </div>
                                <div class="mt-1">
                                    <span class="id-badge {{ $booking->id_type == 'ktp' ? 'id-ktp' : 'id-passport' }}">
                                        {{ $booking->id_type == 'ktp' ? 'KTP' : 'Passport' }}
                                    </span>
                                    <span class="text-xs block">{{ $booking->id_number ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="col-checkin">{{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') }}</td>
                            <td class="col-checkout">{{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') }}</td>
                            <td class="col-bungalow">{{ implode(', ', $bungalowList) ?: '-' }}</td>
                            <td class="col-total font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="col-status">
                                <span class="status-badge 
                                    @if($booking->status == 'pending') status-pending
                                    @elseif($booking->status == 'confirmed') status-confirmed
                                    @else status-cancelled @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="col-aksi">
                                <button onclick="openDetailModal({{ $booking->id }}, 'online')" 
                                        class="text-blue-600 hover:text-blue-800 mr-1" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="openUpdateModal({{ $booking->id }}, '{{ $booking->status }}')" 
                                        class="text-green-600 hover:text-green-800 mr-1" title="Update Status">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteBooking({{ $booking->id }}, '{{ $booking->first_name }}')" 
                                        class="text-red-600 hover:text-red-800" title="Hapus">
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
                            <td colspan="11" class="text-center py-8">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-inbox text-4xl mb-3" style="color: var(--text-card); opacity: 0.5;"></i>
                                    <p class="text-gray-500" style="color: var(--text-card);">Belum ada booking</p>
                                </div>
                            </td>
                        </tr>
                        @endempty
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

<!-- ========== MODAL UPDATE STATUS ========== -->
<div class="modal-overlay" id="updateModal">
    <div class="modal-content" style="max-width: 450px;">
        <button class="modal-close" onclick="closeUpdateModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: var(--primary-color);">
                <i class="fas fa-edit text-sm" style="color: var(--bg-body);"></i>
            </div>
            <h3 class="text-xl font-bold" style="color: var(--text-body);">Update Status Booking</h3>
        </div>
        
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

<!-- ========== MODAL DETAIL BOOKING ========== -->
<div class="modal-overlay" id="detailModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeDetailModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: var(--primary-color);">
                <i class="fas fa-receipt text-sm" style="color: var(--bg-body);"></i>
            </div>
            <h3 class="text-xl font-bold" id="detailModalTitle" style="color: var(--text-body);">Detail Booking Online</h3>
        </div>
        
        <div id="detailBody">
            <div class="text-center py-8">
                <div class="spinner-border" style="color: var(--primary-color);"></div>
                <p class="mt-2" style="color: var(--text-card);">Memuat data booking...</p>
            </div>
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

    // ========== MODAL UPDATE ==========
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

    // ========== CLOSE MODAL FUNCTIONS ==========
    function closeDetailModal() {
        document.getElementById('detailModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // ========== MODAL DETAIL ==========
    function openDetailModal(id, type) {
        const modal = document.getElementById('detailModal');
        const body = document.getElementById('detailBody');
        const title = document.getElementById('detailModalTitle');
        
        title.textContent = type === 'online' ? 'Detail Booking Online' : 'Detail Booking Offline';
        
        body.innerHTML = `
            <div class="text-center py-8">
                <div class="spinner-border" style="color: var(--primary-color);"></div>
                <p class="mt-2" style="color: var(--text-card);">Memuat data booking...</p>
            </div>
        `;
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        const url = type === 'online' 
            ? '/admin/bookings/' + id + '/detail' 
            : '/admin/offline-bookings/' + id + '/detail';
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(response => {
            if (!response.success) {
                throw new Error(response.message || 'Gagal memuat data');
            }
            
            const data = response.data;
            
            // Bungalow names mapping
            const bungalowNames = {
                'b1': 'B1',
                'b2': 'B2', 
                'b3': 'B3',
                'b4': 'B4'
            };
            
            let bungalows = data.selected_bungalows || [];
            if (typeof bungalows === 'string') {
                try {
                    bungalows = JSON.parse(bungalows);
                } catch(e) {
                    bungalows = [];
                }
            }
            const bungalowList = bungalows.map(b => bungalowNames[b] || b).join(', ');
            
            // Build guests HTML
            let guestsHtml = '';
            if (data.guests && data.guests.length > 0) {
                guestsHtml = `
                    <div class="mt-4 pt-4 border-t" style="border-color: var(--border-color);">
                        <h4 class="font-semibold text-sm mb-3" style="color: var(--text-body);">
                            <i class="fas fa-users mr-2"></i> Daftar Tamu (${data.guests.length} orang)
                        </h4>
                        <div class="space-y-2">
                `;
                data.guests.forEach((guest, index) => {
                    const name = (guest.first_name || '') + ' ' + (guest.last_name || '');
                    if (name.trim()) {
                        guestsHtml += `
                            <div class="guest-item">
                                <span class="guest-number">${index + 1}</span>
                                <span class="text-sm">${name.trim()}</span>
                            </div>
                        `;
                    }
                });
                guestsHtml += `
                        </div>
                    </div>
                `;
            }
            
            // Build detail rows
            let detailHtml = `
                <div class="grid grid-cols-2 gap-3">
                    <div class="detail-item">
                        <span class="detail-label">Nama Lengkap</span>
                        <span class="detail-value font-medium">${data.first_name || '-'} ${data.last_name || ''}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">${data.email || data.customer_email || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">No HP</span>
                        <span class="detail-value">${data.phone || data.customer_phone || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Dewasa / Anak</span>
                        <span class="detail-value">${data.adults || 1} Dewasa, ${data.children || 0} Anak</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Identitas</span>
                        <span class="detail-value">
                            <span class="id-badge ${data.id_type == 'ktp' ? 'id-ktp' : 'id-passport'}">
                                ${data.id_type == 'ktp' ? 'KTP' : 'Passport'}
                            </span>
                            <span class="text-xs block mt-1">${data.id_number || '-'}</span>
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Durasi</span>
                        <span class="detail-value">${data.duration || 0} malam</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3 mt-3 pt-3 border-t" style="border-color: var(--border-color);">
                    <div class="detail-item">
                        <span class="detail-label">Check-in</span>
                        <span class="detail-value">${data.check_in ? new Date(data.check_in).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) : '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Check-out</span>
                        <span class="detail-value">${data.check_out ? new Date(data.check_out).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) : '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Bungalow</span>
                        <span class="detail-value font-medium">${bungalowList || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Total Harga</span>
                        <span class="detail-value font-bold" style="color: var(--primary-color);">
                            Rp ${Number(data.total_price).toLocaleString('id-ID')}
                        </span>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3 mt-3 pt-3 border-t" style="border-color: var(--border-color);">
                    <div class="detail-item">
                        <span class="detail-label">Status Booking</span>
                        <span class="detail-value">
                            <span class="status-badge 
                                ${data.status == 'pending' ? 'status-pending' : 
                                  data.status == 'confirmed' ? 'status-confirmed' : 
                                  'status-cancelled'}">
                                ${data.status ? data.status.charAt(0).toUpperCase() + data.status.slice(1) : '-'}
                            </span>
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status Pembayaran</span>
                        <span class="detail-value">
                            <span class="status-badge 
                                ${data.payment_status == 'paid' ? 'status-paid' : 
                                  data.payment_status == 'partial' ? 'status-partial' : 
                                  'status-pending'}">
                                ${data.payment_status ? data.payment_status.charAt(0).toUpperCase() + data.payment_status.slice(1) : '-'}
                            </span>
                        </span>
                    </div>
                    ${data.order_id ? `
                    <div class="detail-item">
                        <span class="detail-label">Order ID</span>
                        <span class="detail-value text-xs">${data.order_id}</span>
                    </div>
                    ` : ''}
                    ${data.booked_by ? `
                    <div class="detail-item">
                        <span class="detail-label">Dibuat Oleh</span>
                        <span class="detail-value">${data.booked_by}</span>
                    </div>
                    ` : ''}
                </div>
                
                ${data.notes ? `
                <div class="mt-3 pt-3 border-t" style="border-color: var(--border-color);">
                    <div class="detail-item">
                        <span class="detail-label">Catatan</span>
                        <span class="detail-value text-sm">${data.notes}</span>
                    </div>
                </div>
                ` : ''}
                
                <div class="mt-3 pt-3 border-t" style="border-color: var(--border-color);">
                    <div class="detail-item">
                        <span class="detail-label">Tanggal Booking</span>
                        <span class="detail-value text-sm">${data.created_at || '-'}</span>
                    </div>
                </div>
                
                ${guestsHtml}
            `;
            
            body.innerHTML = detailHtml;
        })
        .catch(error => {
            console.error('Error:', error);
            body.innerHTML = `
                <div class="text-center py-8">
                    <div class="text-red-500 text-4xl mb-3">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <p class="text-red-600 font-medium">Gagal memuat data</p>
                    <p class="text-sm mt-1" style="color: var(--text-card);">${error.message || 'Silakan coba lagi'}</p>
                    <button onclick="openDetailModal(${id}, '${type}')" 
                            class="mt-4 btn-primary text-sm py-1 px-4">
                        <i class="fas fa-redo mr-1"></i> Coba Lagi
                    </button>
                </div>
            `;
        });
    }
    
    // ========== DELETE BOOKING ==========
    function deleteBooking(id, name) {
        if (confirm('Yakin ingin menghapus booking dari "' + name + '"?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // ========== CLOSE MODAL ON ESC KEY ==========
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDetailModal();
            closeUpdateModal();
            document.body.style.overflow = '';
        }
    });

    // ========== DISABLE CLICK OUTSIDE ==========
    // Tidak ada event listener untuk klik di luar modal
    // Modal hanya bisa ditutup dengan tombol close atau ESC
</script>

</body>
</html>