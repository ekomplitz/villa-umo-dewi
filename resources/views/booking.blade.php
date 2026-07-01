<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Booking - Villa Umo Dewi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { 
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif; 
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --bg-body: #f0fdf4;
            --text-body: #14532d;
            --bg-card: #dcfce7;
            --text-card: #166534;
            --border-color: #86efac;
            --nav-bg: rgba(240, 253, 244, 0.95);
            --nav-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --primary-color: #22c55e;
            --primary-hover: #16a34a;
            --input-bg: #ffffff;
            --input-border: #86efac;
            --package-unselected-bg: #ffffff;
        }
        
        .dark-mode {
            --bg-body: #052e16;
            --text-body: #dcfce7;
            --bg-card: #064e3b;
            --text-card: #a7f3d0;
            --border-color: #166534;
            --nav-bg: rgba(5, 46, 22, 0.95);
            --nav-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            --primary-color: #059669;
            --primary-hover: #047857;
            --input-bg: #0a3b1e;
            --input-border: #10b981;
            --package-unselected-bg: #052e16;
        }
        
        body {
            background-color: var(--bg-body);
            color: var(--text-body);
            transition: all 0.3s ease;
            padding-top: 80px;
        }
        
        nav {
            background-color: var(--nav-bg);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: var(--nav-shadow);
            padding: 16px 32px;
        }

        nav .nav-links a,
        nav h1,
        nav h1 i,
        nav .menu-btn {
            color: var(--text-body);
            transition: color 0.3s ease;
            text-decoration: none;
        }
        
        nav .nav-links a:hover {
            color: var(--primary-color);
        }

        nav .lang-switch {
            background-color: rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        nav .lang-option {
            color: var(--text-body);
        }

        nav .lang-option.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .lang-switch {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            border-radius: 30px;
            padding: 3px;
            height: 32px;
            cursor: pointer;
        }
        
        .lang-option {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 0 8px;
            border-radius: 24px;
            transition: all 0.2s;
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            height: 26px;
        }
        
        .lang-option i {
            font-size: 11px;
        }

        .theme-switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 32px;
        }
        
        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .theme-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #86efac;
            transition: 0.3s;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 6px;
        }

        .theme-switch input:checked + .theme-slider {
            background-color: #059669;
        }
        
        .theme-slider i {
            font-size: 10px;
            color: white;
            z-index: 1;
        }
        
        .theme-slider:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
            z-index: 0;
        }
        
        .theme-switch input:checked + .theme-slider:before {
            transform: translateX(20px);
        }
        
        .nav-links { 
            display: flex; 
            align-items: center; 
            gap: 1.5rem; 
        }
        
        .menu-btn { 
            display: none; 
            font-size: 1.5rem; 
            cursor: pointer; 
            background: none; 
            border: none; 
            color: var(--text-body);
        }
        
        @media (max-width: 768px) {
            nav {
                padding: 12px 20px !important;
            }
            
            nav h1 {
                font-size: 1rem !important;
            }
            
            .nav-links {
                position: fixed;
                top: 60px;
                left: -100%;
                width: 70%;
                height: 100vh;
                background-color: var(--nav-bg);
                backdrop-filter: blur(20px);
                flex-direction: column;
                align-items: flex-start;
                padding: 2rem;
                transition: 0.3s ease;
                gap: 1.5rem;
                border-right: 1px solid var(--border-color);
                z-index: 999;
            }
            .nav-links.active { left: 0; }
            .menu-btn { display: block; }
            
            .lang-switch {
                height: 28px !important;
                padding: 2px !important;
            }
            
            .lang-option {
                padding: 0 6px !important;
                height: 24px !important;
                font-size: 10px !important;
            }

            .lang-option i {
                font-size: 10px !important;
            }
            
            .theme-switch {
                width: 48px !important;
                height: 28px !important;
            }
            
            .theme-slider:before {
                height: 20px !important;
                width: 20px !important;
                left: 4px !important;
                bottom: 4px !important;
            }
            
            .theme-switch input:checked + .theme-slider:before {
                transform: translateX(20px) !important;
            }

            .theme-slider i {
                font-size: 9px !important;
            }
        }

        @media (max-width: 480px) {
            .lang-option span {
                display: none !important;
            }
            
            .lang-option i {
                margin: 0 !important;
            }
        }
        
        .dark-mode input[type="date"] {
            color-scheme: dark;
            background-color: #0a3b1e;
            color: #dcfce7;
            border-color: #10b981;
        }
        
        .dark-mode input[type="date"]::-webkit-calendar-picker-indicator {
            filter: brightness(0) invert(1);
            cursor: pointer;
            opacity: 1;
        }
        
        .dark-mode input[type="date"]::-webkit-calendar-picker-indicator:hover {
            filter: brightness(0) invert(0.8);
        }
        
        .dark-mode .form-input {
            background-color: #0a3b1e;
            color: #dcfce7;
            border-color: #10b981;
        }
        
        .dark-mode .form-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.3);
        }
        
        .dark-mode .bungalow-card .room-icon {
            color: #ffffff !important;
        }
        .dark-mode .bungalow-card.selected .room-icon {
            color: #ffffff !important;
        }
        
        .form-card, .sidebar-bg {
            background-color: var(--bg-card);
            border-color: var(--border-color);
        }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-body);
        }
        .form-label i { margin-right: 8px; color: var(--primary-color); }
        .form-input, .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--input-border);
            border-radius: 12px;
            background-color: var(--input-bg);
            color: var(--text-body);
            transition: all 0.3s;
            font-size: 16px;
        }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        }
        
        .booking-btn {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .booking-btn:hover {
            background-color: var(--primary-hover);
            transform: scale(1.02);
        }
        
        .bungalow-card {
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid var(--border-color);
            background-color: var(--package-unselected-bg);
            border-radius: 12px;
        }
        .bungalow-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
        .bungalow-card.selected {
            border-color: var(--primary-color);
            background-color: var(--primary-color);
        }
        .bungalow-card.selected h3,
        .bungalow-card.selected p,
        .bungalow-card.selected .font-bold,
        .bungalow-card.selected .room-icon {
            color: white !important;
        }
        
        .alert-success {
            background-color: #22c55e;
            color: white;
        }
        .alert-error {
            background-color: #ef4444;
            color: white;
        }
        
        html { scroll-behavior: smooth; }
    </style>
</head>

<body>

<nav class="flex justify-between items-center px-8 py-5 border-b" style="border-color: var(--border-color)">
    <h1 class="text-xl font-bold cursor-pointer hover:text-green-600 transition flex items-center gap-2" onclick="window.location.href='{{ url('/') }}'">
        <i class="fas fa-leaf text-green-500"></i>
        Villa Umo Dewi
    </h1>

    <button class="menu-btn" id="menuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="nav-links" id="navLinks">
        <a href="{{ url('/') }}" data-home>Home</a>
        <a href="{{ url('/#villa-page') }}" data-villa>Villa</a>
        <a href="{{ route('booking') }}" data-booking class="text-green-600 font-semibold">Booking</a>
        <a href="{{ url('/#contact') }}" data-contact>Kontak</a>

        <div class="flex items-center gap-3">
            <div class="lang-switch" id="langSwitch">
                <div class="lang-option" data-lang="id">
                    <i class="fas fa-flag"></i>
                    <span>ID</span>
                </div>
                <div class="lang-option" data-lang="en">
                    <i class="fas fa-flag-usa"></i>
                    <span>EN</span>
                </div>
            </div>

            <label class="theme-switch">
                <input type="checkbox" id="themeToggle">
                <span class="theme-slider">
                    <i class="fas fa-sun"></i>
                    <i class="fas fa-moon"></i>
                </span>
            </label>
        </div>
    </div>
</nav>

@if(session('success'))
<div class="fixed top-24 right-4 z-50 animate-slide-in">
    <div class="alert-success px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
        <i class="fas fa-check-circle text-xl"></i>
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.parentElement.remove()" class="ml-4">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if($errors->any())
<div class="fixed top-24 right-4 z-50 animate-slide-in">
    <div class="alert-error px-6 py-4 rounded-xl shadow-lg">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-body)" data-booking-title>Booking Villa Umo Dewi</h1>
        <p class="text-lg" style="color: var(--text-card)" data-booking-desc>Isi form di bawah untuk memesan villa impianmu</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <div class="form-card rounded-2xl border p-8" style="border-color: var(--border-color)">
            <h2 class="text-2xl font-bold mb-6" style="color: var(--text-body)">
                <i class="fas fa-calendar-check" style="color: var(--primary-color)"></i> <span data-form-title>Informasi Booking</span>
            </h2>
            
            <form id="bookingForm" method="POST" action="{{ route('booking.store') }}">
                @csrf
                <input type="hidden" name="lang" id="langInput" value="{{ session('lang', 'id') }}">
                <input type="hidden" name="selected_bungalows" id="selectedBungalowsInput" value="">
                <input type="hidden" name="total_price" id="totalPriceInput" value="0">
                <input type="hidden" name="duration" id="durationInput" value="0">
                <input type="hidden" name="check_in" id="checkInHidden" value="">
                <input type="hidden" name="check_out" id="checkOutHidden" value="">

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i> <span data-label-name>Nama Lengkap</span> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="inputName" class="form-input" placeholder="Contoh: John Doe" value="{{ old('name') }}" required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i> Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="inputEmail" class="form-input" placeholder="contoh: email@domain.com" value="{{ old('email') }}" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone"></i> <span data-label-phone>No Handphone</span> <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="phone" id="inputPhone" class="form-input" placeholder="0812-3456-7890" value="{{ old('phone') }}" required>
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt"></i> <span data-label-dates>Tanggal Menginap</span> <span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3">
                        <div>
                            <label class="text-xs" style="color: var(--text-card)">Check-in</label>
                            <input type="date" id="checkIn" class="form-input" required>
                        </div>
                        <div>
                            <label class="text-xs" style="color: var(--text-card)">Check-out</label>
                            <input type="date" id="checkOut" class="form-input" required>
                        </div>
                    </div>
                    <p id="durationDisplay" class="text-xs mt-2" style="color: var(--primary-color)"></p>
                </div>
            </form>
        </div>
        
        <div>
            <!-- Pilih Bungalow - Dynamic dari Database -->
            <div class="sidebar-bg rounded-2xl border p-8 mb-6" style="border-color: var(--border-color)">
                <h2 class="text-2xl font-bold mb-6" style="color: var(--text-body)">
                    <i class="fas fa-bed" style="color: var(--primary-color)"></i> <span data-package-title>Pilih Bungalow</span>
                </h2>
                
                <div class="space-y-3" id="bungalowContainer">
                    @foreach($bungalows as $bungalow)
                    <div class="bungalow-card p-3" 
                        data-bungalow="{{ $bungalow->code }}" 
                        data-price="{{ $bungalow->price }}"
                        data-desc-id="{{ $bungalow->description_id }}"
                        data-desc-en="{{ $bungalow->description_en }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-bed room-icon" style="color: var(--primary-color); font-size: 16px;"></i>
                                    <h3 class="font-semibold text-base" style="color: var(--text-body)">{{ $bungalow->name }}</h3>
                                </div>
                                <p class="text-xs mt-1 bungalow-desc" style="color: var(--text-card)"></p>
                            </div>
                            <div class="text-right">
                                <div class="font-bold" style="color: var(--primary-color)">Rp {{ number_format($bungalow->price, 0, ',', '.') }}</div>
                                <div class="text-xs" style="color: var(--text-card)">/malam</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="sidebar-bg rounded-2xl border p-8 sticky top-24" style="border-color: var(--border-color)">
                <h2 class="text-2xl font-bold mb-6" style="color: var(--text-body)">
                    <i class="fas fa-receipt"></i> <span data-summary-title>Ringkasan</span>
                </h2>
                
                <div class="space-y-3 mb-6" id="summaryList">
                    <div class="text-center text-gray-500" id="emptySummary">Belum ada bungalow dipilih atau tanggal belum lengkap</div>
                </div>
                
                <div class="flex justify-between border-t pt-3 mt-3" style="border-color: var(--border-color)">
                    <span class="font-bold text-lg" style="color: var(--text-body)" data-total-title>Total Harga:</span>
                    <span id="totalPriceDisplay" class="font-bold text-2xl" style="color: var(--primary-color)">Rp 0</span>
                </div>
                
                <button type="submit" form="bookingForm" class="booking-btn mt-6">
                    <i class="fas fa-check-circle"></i> <span data-book-now>Booking Sekarang</span>
                </button>
                
                <p class="text-xs text-center mt-4" style="color: var(--text-card)" data-guarantee>
                    <i class="fas fa-lock"></i> Data Anda aman & terenkripsi
                </p>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-10 border-t" style="color: #6b7280; border-color: var(--border-color)">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex justify-between items-center flex-wrap gap-4 mb-6">
            <div class="flex gap-6 justify-center">
                <i class="fab fa-instagram text-2xl hover:text-green-500 cursor-pointer transition"></i>
                <i class="fab fa-facebook text-2xl hover:text-green-500 cursor-pointer transition"></i>
                <i class="fab fa-tiktok text-2xl hover:text-green-500 cursor-pointer transition"></i>
                <i class="fab fa-youtube text-2xl hover:text-green-500 cursor-pointer transition"></i>
            </div>
            <p class="text-sm" data-footer-copyright>© 2026 Villa Umo Dewi | Developed by Kelompok Cihuyy</p>
            <p class="text-xs" data-footer-address>Jl. Raya Umo Dewi No. 88, Bali, Indonesia</p>
        </div>
    </div>
</footer>

<script>
    // Set min date to today
    const today = new Date().toISOString().split('T')[0];
    const checkIn = document.getElementById('checkIn');
    const checkOut = document.getElementById('checkOut');
    const checkInHidden = document.getElementById('checkInHidden');
    const checkOutHidden = document.getElementById('checkOutHidden');
    
    if (checkIn) checkIn.min = today;
    if (checkOut) checkOut.min = today;
    
    if (checkIn) {
        checkIn.addEventListener('change', function() {
            if (checkOut) {
                checkOut.min = this.value;
                if (checkOut.value && checkOut.value <= this.value) {
                    checkOut.value = '';
                }
            }
            if (checkInHidden) checkInHidden.value = this.value;
            calculateDuration();
        });
    }
    
    if (checkOut) {
        checkOut.addEventListener('change', function() {
            if (checkOutHidden) checkOutHidden.value = this.value;
            calculateDuration();
        });
    }
    
    function calculateDuration() {
        if (checkIn && checkOut && checkIn.value && checkOut.value) {
            const start = new Date(checkIn.value);
            const end = new Date(checkOut.value);
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            const durationDisplay = document.getElementById('durationDisplay');
            const durationInput = document.getElementById('durationInput');
            
            if (diffDays > 0) {
                const text = currentLang === 'id' ? `${diffDays} malam` : `${diffDays} nights`;
                if (durationDisplay) durationDisplay.innerHTML = `<i class="fas fa-clock"></i> Durasi: ${text}`;
                if (durationInput) durationInput.value = diffDays;
            } else {
                if (durationDisplay) durationDisplay.innerHTML = '';
                if (durationInput) durationInput.value = 0;
            }
            
            updateSummary();
        } else {
            const durationInput = document.getElementById('durationInput');
            if (durationInput) durationInput.value = 0;
            updateSummary();
        }
    }
    
    let currentLang = 'id';
    let selectedBungalows = [];
    let bungalowPrices = {};

    // Ambil harga dari database via AJAX
    function loadPrices() {
        fetch('{{ route("booking.prices") }}')
            .then(response => response.json())
            .then(data => {
                bungalowPrices = data;
                updateSummary();
            })
            .catch(error => {
                console.error('Error loading prices:', error);
            });
    }

    // Panggil saat halaman dimuat
    loadPrices();
    
    // ========== BUNGALOW NAMES & DESCRIPTIONS ==========
    const bungalowNames = {
        @foreach($bungalows as $bungalow)
        '{{ $bungalow->code }}': { 
            id: '{{ $bungalow->name }}', 
            en: '{{ $bungalow->name }}',
            desc_id: '{{ $bungalow->description_id }}',
            desc_en: '{{ $bungalow->description_en }}'
        },
        @endforeach
    };
    
    // ========== UPDATE BUNGALOW DESCRIPTIONS ==========
    function updateBungalowDescriptions(lang) {
        document.querySelectorAll('.bungalow-card').forEach(card => {
            const descEl = card.querySelector('.bungalow-desc');
            if (descEl) {
                const descId = card.dataset.descId || '';
                const descEn = card.dataset.descEn || '';
                descEl.innerText = lang === 'en' ? descEn : descId;
            }
        });
    }
    
    function formatPrice(price) {
        if (currentLang === 'id') {
            return 'Rp ' + price.toLocaleString('id-ID');
        } else {
            if (price >= 1000000) {
                return 'Rp ' + (price / 1000000).toFixed(1) + 'M';
            }
            return 'Rp ' + (price / 1000).toFixed(0) + 'K';
        }
    }
    
    function updateSummary() {
        const summaryList = document.getElementById('summaryList');
        const totalPriceDisplay = document.getElementById('totalPriceDisplay');
        const totalPriceInput = document.getElementById('totalPriceInput');
        const selectedBungalowsInput = document.getElementById('selectedBungalowsInput');
        const duration = parseInt(document.getElementById('durationInput')?.value || 0);
        
        let total = 0;
        
        if (selectedBungalows.length === 0 || duration === 0) {
            summaryList.innerHTML = '<div class="text-center text-gray-500" id="emptySummary">Belum ada bungalow dipilih atau tanggal belum lengkap</div>';
            totalPriceDisplay.innerHTML = formatPrice(0);
            totalPriceInput.value = 0;
            selectedBungalowsInput.value = '';
            return;
        }
        
        let html = '';
        selectedBungalows.forEach(bungalow => {
            const pricePerNight = bungalowPrices[bungalow] || 0;
            const subtotal = pricePerNight * duration;
            total += subtotal;
            const name = currentLang === 'id' ? (bungalowNames[bungalow]?.id || bungalow) : (bungalowNames[bungalow]?.en || bungalow);
            html += `
                <div class="flex justify-between items-center" data-bungalow="${bungalow}">
                    <div>
                        <span style="color: var(--text-card)">${name}</span>
                        <div class="text-xs" style="color: var(--primary-color)">${formatPrice(pricePerNight)} × ${duration} malam</div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="font-semibold" style="color: var(--text-body)">${formatPrice(subtotal)}</span>
                        <button type="button" onclick="removeBungalow('${bungalow}')" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                </div>
            `;
        });
        
        summaryList.innerHTML = html;
        totalPriceDisplay.innerHTML = formatPrice(total);
        totalPriceInput.value = total;
        selectedBungalowsInput.value = selectedBungalows.join(',');
    }
    
    function removeBungalow(bungalowId) {
        const index = selectedBungalows.indexOf(bungalowId);
        if (index !== -1) {
            selectedBungalows.splice(index, 1);
            const card = document.querySelector(`.bungalow-card[data-bungalow="${bungalowId}"]`);
            if (card) card.classList.remove('selected');
            updateSummary();
        }
    }
    
    const bungalowCards = document.querySelectorAll('.bungalow-card');
    bungalowCards.forEach(card => {
        card.addEventListener('click', (e) => {
            if (e.target.closest('.fa-times-circle')) return;
            
            const bungalowId = card.dataset.bungalow;
            const index = selectedBungalows.indexOf(bungalowId);
            
            if (index === -1) {
                selectedBungalows.push(bungalowId);
                card.classList.add('selected');
            } else {
                selectedBungalows.splice(index, 1);
                card.classList.remove('selected');
            }
            
            updateSummary();
        });
    });
    
    function setTheme(theme) {
        const html = document.documentElement;
        if (theme === 'dark') {
            html.classList.add('dark-mode');
        } else {
            html.classList.remove('dark-mode');
        }
        localStorage.setItem('theme', theme);
        const toggle = document.getElementById('themeToggle');
        if (toggle) toggle.checked = (theme === 'dark');
    }
    
    function toggleTheme() {
        const isDark = document.documentElement.classList.contains('dark-mode');
        setTheme(isDark ? 'light' : 'dark');
    }
    
    const translations = {
        id: {
            booking_title: "Booking Villa Umo Dewi",
            booking_desc: "Isi form di bawah untuk memesan villa impianmu",
            form_title: "Informasi Booking",
            label_name: "Nama Lengkap",
            label_phone: "No Handphone",
            label_dates: "Tanggal Menginap",
            package_title: "Pilih Bungalow",
            summary_title: "Ringkasan",
            total_title: "Total Harga:",
            book_now: "Booking Sekarang",
            guarantee: '<i class="fas fa-lock"></i> Data Anda aman & terenkripsi',
            footer_copyright: "© 2026 Villa Umo Dewi | Developed by Kelompok Cihuyy",
            footer_address: "Jl. Raya Umo Dewi No. 88, Bali, Indonesia",
            nav_home: "Home",
            nav_villa: "Villa",
            nav_booking: "Booking",
            nav_contact: "Kontak"
        },
        en: {
            booking_title: "Book Villa Umo Dewi",
            booking_desc: "Fill out the form below to book your dream villa",
            form_title: "Booking Information",
            label_name: "Full Name",
            label_phone: "Phone Number",
            label_dates: "Stay Dates",
            package_title: "Select Bungalow",
            summary_title: "Summary",
            total_title: "Total Price:",
            book_now: "Book Now",
            guarantee: '<i class="fas fa-lock"></i> Your data is safe & encrypted',
            footer_copyright: "© 2026 Villa Umo Dewi | Developed by Kelompok Cihuyy",
            footer_address: "Jl. Raya Umo Dewi No. 88, Bali, Indonesia",
            nav_home: "Home",
            nav_villa: "Villa",
            nav_booking: "Booking",
            nav_contact: "Contact"
        }
    };
    
    function applyLang(lang) {
        const t = translations[lang];
        if (!t) return;
        
        document.querySelector('[data-booking-title]').innerText = t.booking_title;
        document.querySelector('[data-booking-desc]').innerText = t.booking_desc;
        document.querySelector('[data-form-title]').innerHTML = `<i class="fas fa-calendar-check" style="color: var(--primary-color)"></i> ${t.form_title}`;
        document.querySelector('[data-label-name]').innerText = t.label_name;
        document.querySelector('[data-label-phone]').innerText = t.label_phone;
        document.querySelector('[data-label-dates]').innerText = t.label_dates;
        document.querySelector('[data-package-title]').innerHTML = `<i class="fas fa-bed" style="color: var(--primary-color)"></i> ${t.package_title}`;
        document.querySelector('[data-summary-title]').innerHTML = `<i class="fas fa-receipt"></i> ${t.summary_title}`;
        document.querySelector('[data-total-title]').innerText = t.total_title;
        document.querySelector('[data-book-now]').innerHTML = `<i class="fas fa-check-circle"></i> ${t.book_now}`;
        document.querySelector('[data-guarantee]').innerHTML = t.guarantee;
        document.querySelector('[data-footer-copyright]').innerText = t.footer_copyright;
        document.querySelector('[data-footer-address]').innerText = t.footer_address;
        document.querySelector('[data-home]').innerText = t.nav_home;
        document.querySelector('[data-villa]').innerText = t.nav_villa;
        document.querySelector('[data-booking]').innerText = t.nav_booking;
        document.querySelector('[data-contact]').innerText = t.nav_contact;
        
        // Update deskripsi bungalow
        updateBungalowDescriptions(lang);
        
        calculateDuration();
        updateSummary();
    }
    
    function updateLangUI(lang) {
        document.querySelectorAll('.lang-option').forEach(option => {
            if (option.dataset.lang === lang) {
                option.classList.add('active');
            } else {
                option.classList.remove('active');
            }
        });
    }
    
    function setLang(lang) {
        localStorage.setItem('lang', lang);
        currentLang = lang;
        applyLang(lang);
        updateLangUI(lang);
    }
    
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function() {
            document.getElementById('langInput').value = currentLang;
        });
    }
    
    const menuBtn = document.getElementById('menuBtn');
    const navLinksElem = document.getElementById('navLinks');
    if (menuBtn) {
        menuBtn.addEventListener('click', () => {
            navLinksElem.classList.toggle('active');
            const icon = menuBtn.querySelector('i');
            if (navLinksElem.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
    
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navLinksElem.classList.remove('active');
            if (menuBtn) {
                const icon = menuBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    });
    
    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
        
        const savedLang = localStorage.getItem('lang') || 'id';
        setLang(savedLang);
        
        const toggle = document.getElementById('themeToggle');
        if (toggle) toggle.addEventListener('change', toggleTheme);
        
        const langOptions = document.querySelectorAll('.lang-option');
        langOptions.forEach(option => {
            option.addEventListener('click', () => setLang(option.dataset.lang));
        });
    });
</script>

</body>
</html>