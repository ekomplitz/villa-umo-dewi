<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Villa Umo Dewi - Villa dengan Pemandangan Sawah</title>
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
            --bg-about: #dcfce7;
            --nav-bg: rgba(240, 253, 244, 0.95);
            --nav-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --primary-color: #22c55e;
            --primary-hover: #16a34a;
            --available-color: #22c55e;
            --occupied-color: #ef4444;
        }
        
        .dark-mode {
            --bg-body: #052e16;
            --text-body: #dcfce7;
            --bg-card: #064e3b;
            --text-card: #a7f3d0;
            --border-color: #166534;
            --bg-about: #064e3b;
            --nav-bg: rgba(5, 46, 22, 0.95);
            --nav-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            --primary-color: #059669;
            --primary-hover: #047857;
            --available-color: #22c55e;
            --occupied-color: #ef4444;
        }
        
        body {
            background-color: var(--bg-body);
            color: var(--text-body);
            transition: all 0.3s ease;
            overflow-x: hidden;
            padding-top: 0 !important; /* Menghapus padding-top default dari Tailwind */
        }
        
        /* ========== NAVBAR - SOLID (TIDAK TRANSPARAN) ========== */
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
            border-bottom: 1px solid var(--border-color);
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
        
        /* ========== SWITCHER ========== */
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
            
            nav .nav-links a,
            nav h1,
            nav h1 i,
            nav .menu-btn {
                color: var(--text-body) !important;
                text-shadow: none !important;
            }
            
            nav .lang-switch {
                background-color: rgba(0, 0, 0, 0.05);
                border-color: var(--border-color);
            }
            
            nav .lang-option {
                color: var(--text-body);
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
            
            .hero-content h2 {
                font-size: 1.4rem !important;
            }
            
            .hero-content p {
                font-size: 0.8rem !important;
            }
            
            .btn-primary {
                padding: 8px 20px !important;
                font-size: 0.8rem !important;
            }
        }

        @media (max-width: 480px) {
            .lang-option span {
                display: none !important;
            }
            
            .lang-option i {
                margin: 0 !important;
            }
            
            .hero-content h2 {
                font-size: 1.2rem !important;
            }
            
            .hero-content p {
                font-size: 0.7rem !important;
            }
            
            .btn-primary {
                padding: 6px 16px !important;
                font-size: 0.7rem !important;
            }
        }

        /* ========== HERO SECTION ========== */
        html {
            scroll-behavior: smooth;
        }

        section[id] {
            scroll-margin-top: 80px;
        }

        #home {
            scroll-margin-top: 0;
        }

        .hero-section {
            position: relative;
            height: 100vh !important;
            min-height: 100vh !important;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-top: 0 !important;
            padding-top: 0 !important;
            background-color: #000;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: opacity 1s ease-in-out;
            z-index: 0;
        }
        
        .hero-background.active { opacity: 1; }
        .hero-background:not(.active) { opacity: 0; }

        .hero-content {
            position: relative;
            z-index: 1;
            width: 100%;
            padding: 0 20px;
        }

        .hero-content > div {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
            border-radius: 28px;
            padding: 32px 40px;
        }
        
        .hero-content h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: white;
            line-height: 1.2;
        }
        
        .hero-content p {
            font-size: 1rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 20px;
            line-height: 1.5;
        }
        
        .bg-nav-btn {
            position: absolute;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 2;
        }
        
        .bg-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: white;
            cursor: pointer;
            transition: all 0.3s;
            opacity: 0.6;
        }
        
        .bg-dot.active {
            opacity: 1;
            width: 28px;
            border-radius: 10px;
            background-color: var(--primary-color);
        }
        
        .scroll-indicator {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            cursor: pointer;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(10px); }
        }
        
        /* ========== CARD STYLES ========== */
        .card-bg {
            background-color: var(--bg-card);
            border-color: var(--border-color);
        }
        
        .card-text { color: var(--text-card); }
        
        .feature-icon {
            font-size: 32px;
            margin-bottom: 12px;
            color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            display: inline-block;
            border-radius: 12px;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: scale(1.05);
        }
        
        .status-badge {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 6px;
        }
        
        .status-badge.available { background-color: var(--available-color); }
        .status-badge.occupied { background-color: var(--occupied-color); }
        
        .room-card {
            transition: transform 0.3s;
        }
        
        .room-card:hover {
            transform: scale(1.03);
        }

        .text-justify {
            text-align: justify;
        }
    </style>
</head>

<body>

<nav class="flex justify-between items-center px-8 py-5" id="mainNav">
    <h1 class="text-xl font-bold cursor-pointer transition flex items-center gap-2" onclick="scrollToTop()">
        <i class="fas fa-leaf"></i>
        Villa Umo Dewi
    </h1>

    <button class="menu-btn" id="menuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="nav-links" id="navLinks">
        <a href="#home" data-home>Home</a>
        <a href="#villa-page" data-villa>Villa</a>
        <a href="{{ route('booking') }}" data-booking>Booking</a>
        <a href="#contact" data-contact>Kontak</a>

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

<!-- HERO SECTION -->
<section id="home" class="hero-section">
    <div class="hero-background active" style="background-image: url('{{ asset('images/image_1.jpg') }}')"></div>
    <div class="hero-background" style="background-image: url('{{ asset('images/image_2.jpg') }}')"></div>
    <div class="hero-background" style="background-image: url('{{ asset('images/image_3.jpg') }}')"></div>
    <div class="hero-background" style="background-image: url('{{ asset('images/image_4.jpg') }}')"></div>
    <div class="hero-background" style="background-image: url('{{ asset('images/image_5.jpg') }}')"></div>

    <div class="hero-content text-center">
        <div>
            <h2 data-hero-title></h2>
            <p data-hero-desc></p>
            <a href="{{ route('booking') }}" data-btn class="btn-primary px-6 py-3 text-white inline-block shadow-lg"></a>
        </div>
    </div>
    
    <div class="bg-nav-btn">
        <div class="bg-dot active" data-bg-index="0"></div>
        <div class="bg-dot" data-bg-index="1"></div>
        <div class="bg-dot" data-bg-index="2"></div>
        <div class="bg-dot" data-bg-index="3"></div>
        <div class="bg-dot" data-bg-index="4"></div>
    </div>
    
    <div class="scroll-indicator" onclick="scrollToVillaPage()">
        <i class="fas fa-chevron-down text-white text-xl md:text-2xl"></i>
    </div>
</section>

<!-- VILLA PAGE -->
<section id="villa-page" class="py-16 px-6 md:px-12" style="background-color: var(--bg-body)">
    <div class="max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-start mb-16">
            <div class="rounded-3xl overflow-hidden shadow-2xl">
                <img src="{{ asset('images/about_villa.jpg') }}" alt="Villa Umo Dewi" class="w-full h-[400px] md:h-[500px] object-cover">
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-4" style="color: var(--text-body)" data-villa-page-title></h1>
                <p class="text-lg mb-6 leading-relaxed text-justify" style="color: var(--text-card)" data-villa-page-desc></p>
                <div class="space-y-4">
                    <p class="leading-relaxed text-justify" style="color: var(--text-card)" data-villa-desc-text></p>
                    <p class="leading-relaxed text-justify" style="color: var(--text-card)" data-villa-desc-text2></p>
                </div>
            </div>
        </div>

        <!-- BUNGALOW SECTION - Dynamic dari Database -->
        <div class="mb-16">
            <div class="text-center mb-8">
                <i class="fas fa-bed text-3xl mb-2" style="color: var(--primary-color)"></i>
                <h2 class="text-3xl font-bold" style="color: var(--text-body)" data-villa-rooms-title></h2>
                <p class="mt-2" style="color: var(--text-card)" data-villa-rooms-desc></p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" id="roomsContainer">
                @if(isset($bungalows) && $bungalows->count() > 0)
                    @foreach($bungalows as $bungalow)
                    <div class="room-card rounded-2xl overflow-hidden shadow-lg transition duration-300 hover:scale-105" 
                        style="background-color: var(--bg-card)"
                        data-bungalow="{{ $bungalow->code }}"
                        data-desc-id="{{ $bungalow->description_id }}"
                        data-desc-en="{{ $bungalow->description_en }}">
                        <img src="{{ asset('images/image_4.jpg') }}" class="w-full h-48 object-cover" alt="{{ $bungalow->name }}">
                        <div class="p-4 text-center">
                            <i class="fas fa-bed text-2xl mb-2 room-icon" style="color: {{ $bungalow->status == 'active' ? 'var(--primary-color)' : 'var(--occupied-color)' }}"></i>
                            <h3 class="font-bold text-lg" style="color: var(--text-body)">{{ $bungalow->name }}</h3>
                            <p class="text-sm mt-1 bungalow-desc" style="color: var(--text-card)"></p>
                            <p class="font-bold mt-2" style="color: var(--primary-color)">Rp {{ number_format($bungalow->price, 0, ',', '.') }}<span class="text-sm font-normal">/malam</span></p>
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <span class="status-badge {{ $bungalow->status == 'active' ? 'available' : 'occupied' }}"></span>
                                <span class="room-status-text text-sm font-semibold" 
                                    style="color: {{ $bungalow->status == 'active' ? 'var(--available-color)' : 'var(--occupied-color)' }}">
                                    {{ $bungalow->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    @php
                        $fallbackBungalows = [
                            ['name' => 'Bungalow 1', 'description_id' => 'Kamar dengan view sawah', 'description_en' => 'Spacious room with rice field view', 'price' => 250000, 'status' => 'active'],
                            ['name' => 'Bungalow 2', 'description_id' => 'Cocok untuk keluarga', 'description_en' => 'Perfect for family', 'price' => 250000, 'status' => 'active'],
                            ['name' => 'Bungalow 3', 'description_id' => 'Kamar dengan balkon', 'description_en' => 'Premium room with balcony', 'price' => 500000, 'status' => 'active'],
                            ['name' => 'Bungalow 4', 'description_id' => 'Kamar standar nyaman', 'description_en' => 'Comfortable economy room', 'price' => 500000, 'status' => 'active'],
                        ];
                    @endphp
                    @foreach($fallbackBungalows as $bungalow)
                    <div class="room-card rounded-2xl overflow-hidden shadow-lg transition duration-300 hover:scale-105" 
                         style="background-color: var(--bg-card)">
                        <img src="{{ asset('images/image_4.jpg') }}" class="w-full h-48 object-cover" alt="{{ $bungalow['name'] }}">
                        <div class="p-4 text-center">
                            <i class="fas fa-bed text-2xl mb-2 room-icon" style="color: var(--primary-color)"></i>
                            <h3 class="font-bold text-lg" style="color: var(--text-body)">{{ $bungalow['name'] }}</h3>
                            <p class="text-sm mt-1" style="color: var(--text-card)">
                                @php
                                    $lang = session('lang', 'id');
                                @endphp
                                @if($lang == 'en')
                                    {{ $bungalow['description_en'] }}
                                @else
                                    {{ $bungalow['description_id'] }}
                                @endif
                            </p>
                            <p class="font-bold mt-2" style="color: var(--primary-color)">Rp {{ number_format($bungalow['price'], 0, ',', '.') }}<span class="text-sm font-normal">/malam</span></p>
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <span class="status-badge available"></span>
                                <span class="room-status-text text-sm font-semibold" style="color: var(--available-color)">Tersedia</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            
            <div class="flex justify-center gap-6 mt-6">
                <div class="flex items-center gap-2">
                    <span class="status-badge available"></span>
                    <span class="text-sm" style="color: var(--text-card)">Tersedia / Available</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="status-badge occupied"></span>
                    <span class="text-sm" style="color: var(--text-card)">Tidak Tersedia / Unavailable</span>
                </div>
            </div>
        </div>

        <!-- FEATURES SECTION - 3 CARD -->
        <div class="grid md:grid-cols-3 gap-6 py-8">
            <div class="card-bg p-6 rounded-2xl border card-text text-center transform transition hover:scale-105">
                <i class="fas fa-tree feature-icon"></i>
                <h3 class="text-xl font-semibold mb-2" style="color: var(--text-body)" data-feature1-title></h3>
                <p data-feature1-desc></p>
            </div>
            <div class="card-bg p-6 rounded-2xl border card-text text-center transform transition hover:scale-105">
                <i class="fas fa-bed feature-icon"></i>
                <h3 class="text-xl font-semibold mb-2" style="color: var(--text-body)" data-feature2-title></h3>
                <p data-feature2-desc></p>
            </div>
            <div class="card-bg p-6 rounded-2xl border card-text text-center transform transition hover:scale-105">
                <i class="fas fa-utensils feature-icon"></i>
                <h3 class="text-xl font-semibold mb-2" style="color: var(--text-body)" data-feature3-title></h3>
                <p data-feature3-desc></p>
            </div>
        </div>

        <div class="text-center pt-8">
            <a href="{{ route('booking') }}" class="btn-primary px-8 py-3 rounded-xl text-white inline-block shadow-lg font-semibold">
                <i class="fas fa-calendar-check mr-2"></i> <span data-villa-book-now></span>
            </a>
        </div>
    </div>
</section>

<!-- GALLERY SECTION -->
<section class="px-6 md:px-10 py-16">
    <div class="text-center mb-12">
        <i class="fas fa-camera text-4xl mb-3" style="color: var(--primary-color)"></i>
        <h2 class="text-3xl font-bold" style="color: var(--text-body)" data-gallery-title></h2>
        <p class="card-text mt-2" data-gallery-desc></p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 md:gap-4">
        <div class="rounded-2xl overflow-hidden h-48 md:h-64 shadow-lg hover:scale-105 transition duration-300">
            <img src="{{ asset('images/image_1.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="rounded-2xl overflow-hidden h-48 md:h-64 shadow-lg hover:scale-105 transition duration-300">
            <img src="{{ asset('images/image_2.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="rounded-2xl overflow-hidden h-48 md:h-64 shadow-lg hover:scale-105 transition duration-300">
            <img src="{{ asset('images/image_3.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="rounded-2xl overflow-hidden h-48 md:h-64 shadow-lg hover:scale-105 transition duration-300">
            <img src="{{ asset('images/image_4.jpg') }}" class="w-full h-full object-cover">
        </div>
        <div class="rounded-2xl overflow-hidden h-48 md:h-64 shadow-lg hover:scale-105 transition duration-300">
            <img src="{{ asset('images/image_5.jpg') }}" class="w-full h-full object-cover">
        </div>
    </div>
</section>

<!-- PROMO SECTION -->
<section class="px-6 md:px-10 py-16 text-center rounded-3xl mx-4 md:mx-6" style="background-color: var(--bg-about)">
    <div class="max-w-4xl mx-auto">
        <i class="fas fa-tags text-4xl mb-4" style="color: var(--primary-color)"></i>
        <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--text-body)" data-promo-title></h2>
        <p class="card-text max-w-2xl mx-auto mb-6 text-base md:text-lg" data-promo-desc></p>
        <div class="flex justify-center gap-3 md:gap-4 flex-wrap">
            <div class="bg-green-500 text-white px-4 md:px-6 py-3 rounded-xl inline-flex items-center gap-2 shadow-lg">
                <i class="fab fa-whatsapp fa-xl"></i>
                <span>+62 812-3456-7890</span>
            </div>
            <div class="bg-pink-500 text-white px-4 md:px-6 py-3 rounded-xl inline-flex items-center gap-2 shadow-lg">
                <i class="fab fa-instagram fa-xl"></i>
                <span>@villaumodewi</span>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section id="contact" class="px-6 md:px-10 py-16 text-center">
    <div class="max-w-4xl mx-auto">
        <i class="fas fa-leaf text-4xl mb-4" style="color: var(--primary-color)"></i>
        <h2 class="text-3xl font-bold mb-4" style="color: var(--text-body)" data-about-title></h2>
        <p class="card-text max-w-3xl mx-auto text-base md:text-lg leading-relaxed" data-about-desc></p>
        
        <div class="grid md:grid-cols-2 gap-6 mt-12 text-left">
            <div class="card-bg p-6 rounded-2xl border">
                <i class="fas fa-map-marker-alt text-green-500 text-2xl mb-3"></i>
                <h3 class="font-bold text-lg mb-2" data-address-title></h3>
                <p class="card-text" data-address-desc></p>
            </div>
            <div class="card-bg p-6 rounded-2xl border">
                <i class="fas fa-clock text-green-500 text-2xl mb-3"></i>
                <h3 class="font-bold text-lg mb-2" data-hours-title></h3>
                <p class="card-text" data-hours-desc></p>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="text-center py-10 border-t" style="color: #6b7280; border-color: var(--border-color)">
    <div class="max-w-6xl mx-auto px-4 md:px-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <div class="flex gap-5 justify-center">
                <i class="fab fa-instagram text-xl md:text-2xl hover:text-green-500 cursor-pointer transition"></i>
                <i class="fab fa-facebook text-xl md:text-2xl hover:text-green-500 cursor-pointer transition"></i>
                <i class="fab fa-tiktok text-xl md:text-2xl hover:text-green-500 cursor-pointer transition"></i>
            </div>
            <p class="text-sm" data-footer-copyright></p>
            <p class="text-xs" data-footer-address></p>
        </div>
    </div>
</footer>

<script>
    // ========== SCROLL FUNCTIONS ==========
    function scrollToTop() { 
        window.scrollTo({ top: 0, behavior: 'smooth' }); 
    }
    
    function scrollToVillaPage() { 
        const element = document.getElementById('villa-page');
        const offset = 80;
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;
        window.scrollTo({ top: offsetPosition, behavior: "smooth" });
    }
    
    // ========== SLIDESHOW ==========
    let currentBgIndex = 0;
    const backgrounds = document.querySelectorAll('.hero-background');
    const bgDots = document.querySelectorAll('.bg-dot');
    let slideshowInterval;
    
    function changeBackground(index) {
        backgrounds.forEach(bg => bg.classList.remove('active'));
        bgDots.forEach(dot => dot.classList.remove('active'));
        backgrounds[index].classList.add('active');
        bgDots[index].classList.add('active');
        currentBgIndex = index;
    }
    
    function nextBackground() {
        let nextIndex = (currentBgIndex + 1) % backgrounds.length;
        changeBackground(nextIndex);
    }
    
    function startSlideshow() {
        if (slideshowInterval) clearInterval(slideshowInterval);
        slideshowInterval = setInterval(nextBackground, 5000);
    }
    
    if (bgDots.length > 0) {
        bgDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                clearInterval(slideshowInterval);
                changeBackground(index);
                startSlideshow();
            });
        });
    }
    startSlideshow();
    
    // ========== FULL HEIGHT HERO ==========
    function setHeroFullHeight() {
        const hero = document.querySelector('.hero-section');
        if (hero) {
            const windowHeight = window.innerHeight;
            hero.style.height = windowHeight + 'px';
            hero.style.minHeight = windowHeight + 'px';
            hero.style.maxHeight = windowHeight + 'px';
        }
    }
    
    window.addEventListener('load', setHeroFullHeight);
    window.addEventListener('resize', setHeroFullHeight);
    window.addEventListener('orientationchange', function() {
        setTimeout(setHeroFullHeight, 100);
    });
    
    // ========== THEME ==========
    function setTheme(theme) {
        const html = document.documentElement;
        if (theme === 'dark') html.classList.add('dark-mode');
        else html.classList.remove('dark-mode');
        localStorage.setItem('theme', theme);
        const toggle = document.getElementById('themeToggle');
        if (toggle) toggle.checked = (theme === 'dark');
    }
    
    function toggleTheme() {
        const isDark = document.documentElement.classList.contains('dark-mode');
        setTheme(isDark ? 'light' : 'dark');
    }
    
    // ========== FUNGSI UPDATE BUNGALOW DESKRIPSI ==========
    function updateBungalowDescriptions(lang) {
        document.querySelectorAll('.room-card').forEach(card => {
            const descEl = card.querySelector('.bungalow-desc');
            if (descEl) {
                const descId = card.dataset.descId || '';
                const descEn = card.dataset.descEn || '';
                descEl.innerText = lang === 'en' ? descEn : descId;
            }
        });
    }
    
    // ========== TRANSLATIONS ==========
    const translations = {
        id: {
            home: "Home",
            villa: "Villa",
            booking: "Booking",
            contact: "Kontak",
            heroTitle: "Nikmatin Staycation di Villa Umo Dewi",
            heroDesc: "Tempat santai di tengah sawah, view cakep, vibes tenang. Cocok buat kabur dari realita hidup yang kadang toxic!",
            btn: "Booking Sekarang",
            feature1Title: "View Sawah Natural",
            feature1Desc: "Pemandangan hamparan sawah hijau yang menenangkan jiwa, cocok buat healing dari penatnya kota.",
            feature2Title: "Fasilitas Lengkap",
            feature2Desc: "Kasur empuk, AC dingin, dan suasana pedesaan yang bikin kamu males pulang ke kota.",
            feature3Title: "Kuliner Lokal",
            feature3Desc: "Nikmati masakan khas desa dengan bahan segar dari sawah sekitar villa.",
            galleryTitle: "Galeri Villa",
            galleryDesc: "Suasana asli villa dan pemandangan sawah sekitarnya",
            promoTitle: "🎉 Promo Spesial Akhir Tahun! 🎉",
            promoDesc: "Dapatkan diskon 30% untuk booking 3 malam atau lebih! Jangan sampai kelewatan, promo terbatas!",
            aboutTitle: "Tentang Villa Umo Dewi",
            aboutDesc: "Villa Umo Dewi adalah villa yang terletak di tengah hamparan sawah yang asri. Nikmati udara segar, pemandangan hijau, dan suara alam yang menenangkan. Cocok buat staycation bareng keluarga, teman, atau pasangan 💚",
            addressTitle: "Alamat",
            addressDesc: "Desa Wisata Umo Dewi, Kec. Tegallalang, Gianyar, Bali",
            hoursTitle: "Jam Operasional",
            hoursDesc: "Check-in: 14.00 WITA | Check-out: 12.00 WITA",
            footerCopyright: "© 2026 Villa Umo Dewi | Developed by Kelompok Cihuyy",
            footerAddress: "Jl. Raya Umo Dewi No. 88, Bali, Indonesia",
            villa_page_title: "Villa Umo Dewi",
            villa_page_desc: "Nikmati pengalaman menginap yang tak terlupakan di tengah hamparan sawah yang asri, dikelilingi keindahan alam Bali.",
            villa_desc_text: "Villa Umo Dewi menawarkan pengalaman menginap unik dengan konsep modern yang menyatu sempurna dengan alam. Terletak di tengah hamparan sawah hijau, villa ini dirancang untuk kenyamanan maksimal. Arsitektur memadukan elemen tradisional Bali dengan desain kontemporer, menciptakan suasana harmonis yang menenangkan.",
            villa_desc_text2: "Setiap detail diperhatikan dengan seksama, dari pemilihan material alami hingga tata letak ruangan yang mengoptimalkan sirkulasi udara dan pencahayaan alami. Desain open-plan memungkinkan udara segar mengalir bebas, sementara jendela besar membingkai pemandangan sawah yang menakjubkan.",
            villa_rooms_title: "Kamar yang Tersedia",
            villa_rooms_desc: "Status kamar dapat berubah sewaktu-waktu",
            villa_book_now: "Booking Sekarang",
        },
        en: {
            home: "Home",
            villa: "Villa",
            booking: "Booking",
            contact: "Contact",
            heroTitle: "Enjoy Your Stay at Villa Umo Dewi",
            heroDesc: "Relax in the middle of rice fields, beautiful view, calm vibes. Perfect escape from your toxic reality!",
            btn: "Book Now",
            feature1Title: "Natural Rice Field View",
            feature1Desc: "Green rice field views that soothe your soul, perfect for healing from city fatigue.",
            feature2Title: "Complete Facilities",
            feature2Desc: "Comfortable beds, cool AC, and a village atmosphere that makes you want to stay forever.",
            feature3Title: "Local Cuisine",
            feature3Desc: "Enjoy authentic village cuisine with fresh ingredients from the surrounding rice fields.",
            galleryTitle: "Villa Gallery",
            galleryDesc: "Real atmosphere of the villa and surrounding rice field views",
            promoTitle: "🎉 Special Year-End Promo! 🎉",
            promoDesc: "Get 30% discount for booking 3 nights or more! Don't miss out, limited promo!",
            aboutTitle: "About Villa Umo Dewi",
            aboutDesc: "Villa Umo Dewi is a villa located in the middle of lush rice fields. Enjoy fresh air, green views, and calming natural sounds. Perfect for a staycation with family, friends, or your partner 💚",
            addressTitle: "Address",
            addressDesc: "Umo Dewi Tourism Village, Tegallalang District, Gianyar, Bali",
            hoursTitle: "Operating Hours",
            hoursDesc: "Check-in: 02:00 PM WITA | Check-out: 12:00 PM WITA",
            footerCopyright: "© 2026 Villa Umo Dewi | Developed by Kelompok Cihuyy",
            footerAddress: "Jl. Raya Umo Dewi No. 88, Bali, Indonesia",
            villa_page_title: "Villa Umo Dewi",
            villa_page_desc: "Enjoy an unforgettable stay in the middle of lush rice fields, surrounded by the natural beauty of Bali.",
            villa_desc_text: "Villa Umo Dewi offers a unique stay experience with a modern concept that blends perfectly with nature. Located in the middle of green rice fields, this villa is designed to provide maximum comfort for all guests. The architecture combines traditional Balinese elements with contemporary design, creating a harmonious atmosphere that soothes the soul.",
            villa_desc_text2: "Every detail is carefully considered, from the selection of natural materials to the room layout that optimizes air circulation and natural lighting. The open-plan design allows fresh air to flow freely, while large windows frame stunning views of the surrounding rice paddies.",
            villa_rooms_title: "Available Rooms",
            villa_rooms_desc: "Room status may change at any time",
            villa_book_now: "Book Now",
        }
    };
    
    // ========== APPLY LANGUAGE ==========
    function applyLang(lang) {
        const t = translations[lang];
        if (!t) return;
        
        document.querySelector('[data-home]').innerText = t.home;
        document.querySelector('[data-villa]').innerText = t.villa;
        document.querySelector('[data-booking]').innerText = t.booking;
        document.querySelector('[data-contact]').innerText = t.contact;
        document.querySelector('[data-hero-title]').innerText = t.heroTitle;
        document.querySelector('[data-hero-desc]').innerText = t.heroDesc;
        document.querySelector('[data-btn]').innerText = t.btn;
        document.querySelector('[data-feature1-title]').innerText = t.feature1Title;
        document.querySelector('[data-feature1-desc]').innerText = t.feature1Desc;
        document.querySelector('[data-feature2-title]').innerText = t.feature2Title;
        document.querySelector('[data-feature2-desc]').innerText = t.feature2Desc;
        document.querySelector('[data-feature3-title]').innerText = t.feature3Title;
        document.querySelector('[data-feature3-desc]').innerText = t.feature3Desc;
        document.querySelector('[data-gallery-title]').innerText = t.galleryTitle;
        document.querySelector('[data-gallery-desc]').innerText = t.galleryDesc;
        document.querySelector('[data-promo-title]').innerHTML = t.promoTitle;
        document.querySelector('[data-promo-desc]').innerHTML = t.promoDesc;
        document.querySelector('[data-about-title]').innerText = t.aboutTitle;
        document.querySelector('[data-about-desc]').innerText = t.aboutDesc;
        document.querySelector('[data-address-title]').innerText = t.addressTitle;
        document.querySelector('[data-address-desc]').innerText = t.addressDesc;
        document.querySelector('[data-hours-title]').innerText = t.hoursTitle;
        document.querySelector('[data-hours-desc]').innerText = t.hoursDesc;
        document.querySelector('[data-footer-copyright]').innerText = t.footerCopyright;
        document.querySelector('[data-footer-address]').innerText = t.footerAddress;
        document.querySelector('[data-villa-page-title]').innerText = t.villa_page_title;
        document.querySelector('[data-villa-page-desc]').innerText = t.villa_page_desc;
        document.querySelector('[data-villa-desc-text]').innerText = t.villa_desc_text;
        document.querySelector('[data-villa-desc-text2]').innerText = t.villa_desc_text2;
        document.querySelector('[data-villa-rooms-title]').innerText = t.villa_rooms_title;
        document.querySelector('[data-villa-rooms-desc]').innerText = t.villa_rooms_desc;
        document.querySelector('[data-villa-book-now]').innerText = t.villa_book_now;
        
        // Update deskripsi bungalow
        updateBungalowDescriptions(lang);
    }
    
    // ========== LANGUAGE UI ==========
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
        applyLang(lang);
        updateLangUI(lang);
    }
    
    // ========== MOBILE MENU ==========
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
    
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navLinksElem.classList.remove('active');
            if (menuBtn) {
                const icon = menuBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - offset;
                window.scrollTo({ top: offsetPosition, behavior: "smooth" });
                if (navLinksElem) navLinksElem.classList.remove('active');
                if (menuBtn) {
                    const icon = menuBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    });
    
    // ========== NAVBAR SCROLL ==========
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });
    
    // ========== INITIALIZE ==========
    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
        
        const savedLang = localStorage.getItem('lang') || 'id';
        setLang(savedLang);
        
        const toggle = document.getElementById('themeToggle');
        if (toggle) toggle.addEventListener('change', toggleTheme);
        
        document.querySelectorAll('.lang-option').forEach(option => {
            option.addEventListener('click', () => setLang(option.dataset.lang));
        });
    });
</script>

</body>
</html>