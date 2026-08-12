{{-- resources/views/admin/bungalow_settings.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Bungalow Settings - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- ===== FAVICON ===== -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='leaf' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%2333cc55'/%3E%3Cstop offset='100%25' style='stop-color:%23118833'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d='M50 5 C25 25 5 55 50 95 C95 55 75 25 50 5Z' fill='url(%23leaf)'/%3E%3Cpath d='M50 5 L50 75' stroke='%230d6b2e' stroke-width='2.5' fill='none'/%3E%3Cpath d='M50 25 L30 45' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 25 L70 45' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 45 L32 65' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 45 L68 65' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3C/svg%3E">
    
    <style>
        * { 
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif; 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        
        /* ================================================================ */
        /* ===== CSS VARIABLES - LIGHT MODE (Cream/Coklat) ===== */
        /* ================================================================ */
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
            --input-bg: #F3F4F4;
            --input-border: #EFE9E3;
            --shadow-color: rgba(0, 0, 0, 0.05);
        }
        
        /* ================================================================ */
        /* ===== CSS VARIABLES - DARK MODE (Biru Tua/Cream) ===== */
        /* ================================================================ */
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
            --input-bg: #3C5B6F;
            --input-border: #948979;
            --shadow-color: rgba(0, 0, 0, 0.3);
        }
        
        /* ================================================================ */
        /* ===== BODY ===== */
        /* ================================================================ */
        body {
            background-color: var(--bg-body);
            color: var(--text-body);
            transition: all 0.3s ease;
            min-height: 100vh;
        }
        
        /* ================================================================ */
        /* ===== SIDEBAR ===== */
        /* ================================================================ */
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
        
        /* ================================================================ */
        /* ===== THEME SWITCH ===== */
        /* ================================================================ */
        .theme-switch-track {
            width: 44px;
            height: 24px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            transition: all 0.3s;
            position: relative;
            cursor: pointer;
            flex-shrink: 0;
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
        
        /* ================================================================ */
        /* ===== CONTENT PANEL ===== */
        /* ================================================================ */
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
            box-shadow: 0 4px 6px var(--shadow-color);
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
        
        /* Dark mode text colors */
        .dark-mode .text-yellow-500 { color: #fbbf24 !important; }
        .dark-mode .text-blue-600 { color: #60a5fa !important; }
        .dark-mode .text-green-600 { color: #34d399 !important; }
        .dark-mode .text-green-700 { color: #6ee7b7 !important; }
        .dark-mode .text-purple-600 { color: #a78bfa !important; }
        .dark-mode .text-purple-700 { color: #8b5cf6 !important; }
        .dark-mode .text-red-600 { color: #f87171 !important; }
        .dark-mode .text-red-700 { color: #ef4444 !important; }
        
        /* ================================================================ */
        /* ===== FORM STYLES ===== */
        /* ================================================================ */
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
            border: 2px solid var(--input-border);
            border-radius: 8px;
            background-color: var(--input-bg);
            color: var(--text-body);
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(157, 102, 56, 0.15);
        }
        
        .dark-mode .form-input:focus, 
        .dark-mode .form-textarea:focus, 
        .dark-mode .form-select:focus {
            box-shadow: 0 0 0 3px rgba(223, 208, 184, 0.15);
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
        
        .dark-mode .btn-update {
            background-color: #DFD0B8;
            color: #153448;
        }
        
        .dark-mode .btn-update:hover {
            background-color: #948979;
        }
        
        /* ================================================================ */
        /* ===== ALERT SUCCESS ===== */
        /* ================================================================ */
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
        
        /* ================================================================ */
        /* ===== CARD ===== */
        /* ================================================================ */
        .bg-card {
            background-color: var(--bg-card) !important;
        }
        
        /* ================================================================ */
        /* ===== IMAGE PREVIEW ===== */
        /* ================================================================ */
        .image-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            gap: 6px;
            margin-top: 6px;
        }
        
        .image-preview-grid img {
            width: 100%;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid var(--border-color);
        }
        
        .remove-image-btn {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .remove-image-btn:hover {
            background: #dc2626;
        }
        
        .image-preview-item {
            position: relative;
            display: inline-block;
        }
        
        /* ================================================================ */
        /* ===== RESPONSIVE ===== */
        /* ================================================================ */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                width: 100% !important;
            }
            .flex-1 {
                padding: 16px;
            }
            .grid-cols-2 {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>

<body>

<div class="min-h-screen flex flex-col md:flex-row">
    <!-- ========== SIDEBAR ========== -->
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
            <a href="{{ route('admin.bungalow.settings') }}" class="block py-2 px-4 hover:bg-white/10 rounded-lg {{ request()->routeIs('admin.bungalow.settings') ? 'bg-white/10' : '' }}">
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

    <!-- ========== CONTENT ========== -->
    <div class="flex-1 p-4 md:p-8">
        <h1 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--text-body)">Pengaturan Bungalow</h1>

        @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
        @endif

        <p class="text-sm mb-6" style="color: var(--text-card)">
            <i class="fas fa-info-circle mr-1"></i> Perubahan harga, diskon, dan gambar akan langsung terlihat di halaman depan.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($bungalows as $bungalow)
            <div class="bg-card rounded-xl shadow-md p-6 border" style="border-color: var(--border-color);">
                <form method="POST" action="{{ route('admin.bungalow.update', $bungalow->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-bed text-2xl" style="color: var(--primary-color);"></i>
                            <span class="text-xl font-bold" style="color: var(--text-body)">{{ $bungalow->code }}</span>
                            <span class="text-xs px-2 py-0.5 rounded-full 
                                {{ $bungalow->status == 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $bungalow->status }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ $bungalow->name }}" class="form-input">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ $bungalow->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $bungalow->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi (Indonesia)</label>
                        <textarea name="description_id" rows="2" class="form-textarea">{{ $bungalow->description_id }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (English)</label>
                        <textarea name="description_en" rows="2" class="form-textarea">{{ $bungalow->description_en }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="mb-3">
                            <label class="form-label">Harga Normal (Rp)</label>
                            <input type="number" name="price" value="{{ $bungalow->price }}" class="form-input">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Diskon (Rp) <span class="text-xs" style="color: var(--text-card);">(opsional)</span></label>
                            <input type="number" name="discount_price" value="{{ $bungalow->discount_price }}" class="form-input" placeholder="Kosongkan jika tidak ada diskon">
                            @if($bungalow->has_discount)
                            <p class="text-xs text-green-600 mt-1">
                                <i class="fas fa-tag"></i> Aktif: Rp {{ number_format($bungalow->discount_price, 0, ',', '.') }}
                            </p>
                            @endif
                        </div>
                    </div>

                    <!-- Gambar Utama -->
                    <div class="mb-3">
                        <label class="form-label">Gambar Utama</label>
                        @if($bungalow->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $bungalow->image) }}" alt="{{ $bungalow->name }}" class="w-32 h-32 object-cover rounded">
                        </div>
                        @endif
                        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border rounded-lg" style="background-color: var(--bg-card); color: var(--text-body); border-color: var(--border-color);">
                        <p class="text-xs mt-1" style="color: var(--text-card);">Format: JPG, PNG. Maks: 2MB</p>
                    </div>

                    <!-- Multiple Images -->
                    <div class="mb-3">
                        <label class="form-label">Gambar Tambahan (Slider)</label>
                        
                        @if($bungalow->images && count($bungalow->images) > 0)
                        <div class="image-preview-grid mb-2">
                            @foreach($bungalow->images as $index => $img)
                            <div class="image-preview-item">
                                <img src="{{ asset('storage/' . $img) }}" alt="Image {{ $index + 1 }}">
                                <button type="button" class="remove-image-btn" onclick="removeImage({{ $bungalow->id }}, {{ $index }})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        <input type="file" name="images[]" accept="image/*" multiple class="w-full px-3 py-2 border rounded-lg" style="background-color: var(--bg-card); color: var(--text-body); border-color: var(--border-color);">
                        <p class="text-xs mt-1" style="color: var(--text-card);">Pilih multiple gambar (Ctrl+Click) untuk slider. Format: JPG, PNG. Maks: 2MB per file</p>
                    </div>

                    <button type="submit" class="btn-update">
                        <i class="fas fa-save mr-1"></i> Update Bungalow
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

    // ========== REMOVE IMAGE ==========
    function removeImage(bungalowId, imageIndex) {
        if (confirm('Yakin ingin menghapus gambar ini?')) {
            fetch(`/admin/bungalow/remove-image/${bungalowId}/${imageIndex}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal menghapus gambar');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        }
    }
</script>

</body>
</html>