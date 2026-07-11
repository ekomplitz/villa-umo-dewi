<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Reports - Admin Panel</title>
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
        
        /* ========== MODAL ========== */
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
            max-width: 600px;
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
        
        .modal-content .rating-stars { color: #f59e0b; font-size: 1.2rem; }
        
        .modal-content .report-message {
            background-color: rgba(0,0,0,0.05);
            padding: 16px;
            border-radius: 8px;
            margin: 12px 0;
            line-height: 1.8;
            white-space: pre-wrap;
            word-wrap: break-word;
            max-height: 300px;
            overflow-y: auto;
            font-size: 0.95rem;
        }
        .dark-mode .modal-content .report-message {
            background-color: rgba(0,0,0,0.2);
        }
        
        .modal-content .admin-reply {
            background-color: rgba(34,197,94,0.1);
            border-left: 4px solid #22c55e;
            padding: 12px 16px;
            border-radius: 4px;
            margin-top: 8px;
        }
        .dark-mode .modal-content .admin-reply {
            background-color: rgba(52,211,153,0.15);
            border-left-color: #34d399;
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-read { background-color: #dbeafe; color: #1e40af; }
        .status-replied { background-color: #d1fae5; color: #065f46; }
        
        .dark-mode .status-pending { background-color: #78350f; color: #fbbf24; }
        .dark-mode .status-read { background-color: #1e3a5f; color: #60a5fa; }
        .dark-mode .status-replied { background-color: #064e3b; color: #34d399; }
        
        .btn-reply {
            background-color: var(--primary-color);
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-reply:hover { background-color: var(--primary-hover); }
        .dark-mode .btn-reply {
            background-color: #DFD0B8;
            color: #153448;
        }
        .dark-mode .btn-reply:hover { background-color: #948979; }
        
        .btn-filter {
            padding: 6px 16px;
            border-radius: 20px;
            border: 2px solid var(--border-color);
            background-color: transparent;
            color: var(--text-body);
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .btn-filter:hover {
            border-color: var(--primary-color);
        }
        .btn-filter.active {
            background-color: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }
        .dark-mode .btn-filter.active {
            background-color: #DFD0B8;
            color: #153448;
            border-color: #DFD0B8;
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
        
        .form-textarea {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--bg-card);
            color: var(--text-body);
            font-size: 0.9rem;
            transition: all 0.3s;
            resize: vertical;
            min-height: 80px;
        }
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(157,102,56,0.15);
        }
        .dark-mode .form-textarea {
            background-color: #3C5B6F;
            color: #DFD0B8;
            border-color: #948979;
        }
        .dark-mode .form-textarea:focus {
            border-color: #DFD0B8;
            box-shadow: 0 0 0 3px rgba(223,208,184,0.15);
        }
        
        .form-select {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--bg-card);
            color: var(--text-body);
            font-size: 0.9rem;
            transition: all 0.3s;
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
            <a href="{{ route('admin.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-list mr-2"></i> Bookings
            </a>
            <a href="{{ route('admin.bungalow.settings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-bed mr-2"></i> Bungalow
            </a>
            <a href="{{ route('admin.offline.bookings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg">
                <i class="fas fa-user-plus mr-2"></i> Offline
            </a>
            <a href="{{ route('admin.reports') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.reports*') ? 'bg-white/10' : '' }}">
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
        <h1 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--text-body)">Kritik & Saran</h1>

        @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
        @endif

        <!-- ========== SEARCH & FILTER ========== -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <form method="GET" action="{{ route('admin.reports') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium mb-1" style="color: var(--text-card);">Cari Nama / Email</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nama atau email..." class="form-input">
                </div>
                
                <div class="min-w-[150px]">
                    <label class="block text-sm font-medium mb-1" style="color: var(--text-card);">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                        <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                    </select>
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="btn-reply" style="padding: 8px 20px;">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.reports') }}" class="btn-reply" style="background-color: var(--border-color); color: var(--text-body); padding: 8px 20px;">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- ========== TABLE ========== -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px]">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Rating</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Pesan</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">#{{ $loop->iteration + ($reports->currentPage() - 1) * $reports->perPage() }}</td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <span onclick="openReportModal({{ $report->id }})" 
                                      style="cursor:pointer; color: var(--primary-color); text-decoration: underline;"
                                      onmouseover="this.style.color='var(--primary-hover)'" 
                                      onmouseout="this.style.color='var(--primary-color)'">
                                    {{ $report->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $report->email }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="text-yellow-500">
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $report->rating) ★ @else ☆ @endif
                                    @endfor
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm max-w-[150px] truncate" title="{{ $report->message }}">
                                {{ Str::limit($report->message, 50) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="status-badge 
                                    @if($report->status == 'pending') status-pending
                                    @elseif($report->status == 'read') status-read
                                    @else status-replied @endif">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <button onclick="openReportModal({{ $report->id }})" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="deleteReport({{ $report->id }}, '{{ $report->name }}')" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $report->id }}" action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="px-6 py-6 text-center text-gray-500">Belum ada kritik & saran</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-4">
            {{ $reports->appends(request()->query())->links() }}
        </div>
        
        <!-- Info -->
        <div class="mt-2 text-sm" style="color: var(--text-card);">
            Menampilkan {{ $reports->firstItem() ?? 0 }} - {{ $reports->lastItem() ?? 0 }} dari {{ $reports->total() }} laporan
        </div>
    </div>
</div>

<!-- ========== MODAL DETAIL REPORT ========== -->
<div class="modal-overlay" id="reportModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeReportModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div id="modalBody">
            <div class="text-center py-8">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat data...</p>
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

    // ========== MODAL REPORT ==========
    function openReportModal(id) {
        const modal = document.getElementById('reportModal');
        const body = document.getElementById('modalBody');
        
        // Loading
        body.innerHTML = `
            <div class="text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-primary border-t-transparent"></div>
                <p class="mt-2">Memuat data...</p>
            </div>
        `;
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        // Fetch data via AJAX - PASTIKAN URL NYA BENAR
        fetch(`/admin/reports/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(report => {
                // Rating stars
                let stars = '';
                for (let i = 1; i <= 5; i++) {
                    stars += i <= report.rating ? '★' : '☆';
                }
                
                // Status badge
                let statusClass = 'status-pending';
                if (report.status === 'read') statusClass = 'status-read';
                if (report.status === 'replied') statusClass = 'status-replied';
                
                // Admin reply
                let replyHtml = '';
                if (report.admin_reply) {
                    replyHtml = `
                        <div class="admin-reply">
                            <p class="font-semibold text-sm" style="color: var(--primary-color);">
                                <i class="fas fa-reply mr-1"></i> Balasan Admin:
                            </p>
                            <p class="text-sm mt-1" style="white-space: pre-wrap; word-wrap: break-word;">${report.admin_reply}</p>
                        </div>
                    `;
                }
                
                // Format date
                const date = new Date(report.created_at);
                const formattedDate = date.toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                body.innerHTML = `
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-xl font-bold">${report.name}</h2>
                                <p class="text-sm" style="color: var(--text-card);"><i class="fas fa-envelope mr-1"></i> ${report.email}</p>
                            </div>
                            <span class="status-badge ${statusClass}">${report.status}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="text-sm font-semibold">Rating:</span>
                            <span class="rating-stars">${stars}</span>
                            <span class="text-sm" style="color: var(--text-card);">(${report.rating}/5)</span>
                        </div>
                        
                        <div>
                            <span class="text-sm font-semibold"><i class="fas fa-comment mr-1"></i> Pesan:</span>
                            <div class="report-message">${report.message}</div>
                        </div>
                        
                        <div class="text-xs" style="color: var(--text-card); margin-top: 8px;">
                            <i class="fas fa-clock mr-1"></i> Dikirim: ${formattedDate}
                        </div>
                        
                        ${replyHtml}
                        
                        <div class="mt-4 pt-4 border-t" style="border-color: var(--border-color);">
                            <form method="POST" action="/admin/reports/${report.id}" class="space-y-3">
                                @csrf
                                @method('PUT')
                                
                                <div>
                                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-body);">
                                        <i class="fas fa-tag mr-1"></i> Status
                                    </label>
                                    <select name="status" class="form-select" style="width:100%;">
                                        <option value="pending" ${report.status === 'pending' ? 'selected' : ''}>Pending</option>
                                        <option value="read" ${report.status === 'read' ? 'selected' : ''}>Read</option>
                                        <option value="replied" ${report.status === 'replied' ? 'selected' : ''}>Replied</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold mb-1" style="color: var(--text-body);">
                                        <i class="fas fa-reply mr-1"></i> Balasan Admin
                                    </label>
                                    <textarea name="admin_reply" rows="3" class="form-textarea" style="width:100%;" placeholder="Tulis balasan untuk pengguna...">${report.admin_reply || ''}</textarea>
                                    <p class="text-xs mt-1" style="color: var(--text-card);">
                                        <i class="fas fa-info-circle mr-1"></i> Balasan akan ditampilkan di sini setelah disimpan
                                    </p>
                                </div>
                                
                                <button type="submit" class="btn-reply" style="width:100%;padding:10px;">
                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Error:', error);
                body.innerHTML = `
                    <div class="text-center py-8">
                        <p class="text-red-600"><i class="fas fa-exclamation-circle mr-2"></i> Gagal memuat data. Silakan coba lagi.</p>
                        <p class="text-sm mt-2 text-gray-500">Error: ${error.message}</p>
                    </div>
                `;
            });
    }
    
    function closeReportModal() {
        document.getElementById('reportModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    
    document.getElementById('reportModal').addEventListener('click', function(e) {
        if (e.target === this) closeReportModal();
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeReportModal();
    });

    // ========== DELETE REPORT ==========
    function deleteReport(id, name) {
        if (confirm(`Yakin ingin menghapus laporan dari "${name}"?`)) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    }
</script>

</body>
</html>