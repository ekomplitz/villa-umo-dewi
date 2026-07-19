<!DOCTYPE html>
<html lang="{{ session('lang', 'id') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    
    @php
        $lang = session('lang', 'id');
        $metaTitle      = $lang === 'en'
            ? 'Villa Booking - Villa Umo Dewi'
            : 'Booking Villa - Villa Umo Dewi';
        $metaDesc       = $lang === 'en'
            ? 'Book your stay at Villa Umo Dewi easily. Check availability and villa rental prices now.'
            : 'Booking penginapan di Villa Umo Dewi dengan mudah. Cek ketersediaan dan harga sewa villa kami sekarang.';
        $metaKeywords   = $lang === 'en'
            ? 'book villa, villa rental Bali, villa umo dewi reservation, check villa availability, Tabanan Bali'
            : 'booking villa, sewa villa bali, reservasi villa umo dewi, cek ketersediaan villa, Tabanan Bali';
        $ogLocale       = $lang === 'en' ? 'en_US' : 'id_ID';
    @endphp

    <!-- SEO Meta Tags -->
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="author" content="Villa Umo Dewi">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Hreflang (Multilingual) -->
    <link rel="alternate" hreflang="id" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    <meta property="og:image" content="{{ asset('images/villa-umo-dewi-tampak-depan.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="{{ $ogLocale }}">
    <meta property="og:site_name" content="Villa Umo Dewi">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDesc }}">
    <meta name="twitter:image" content="{{ asset('images/villa-umo-dewi-tampak-depan.jpg') }}">
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
    
    /* ========== WARNA LIGHT MODE ========== */
    :root {
        --bg-body: #EFE9E3;
        --text-body: #9D6638;
        --bg-card: #F3F4F4;
        --text-card: #9D6638;
        --border-color: #EFE9E3;
        --bg-about: #F3F4F4;
        --primary-color: #9D6638;
        --primary-hover: #7A4F2A;
        --available-color: #22c55e;
        --occupied-color: #ef4444;
        --text-white: #9D6638;
        --sidebar-bg: rgba(243, 244, 244, 0.98);
        --sidebar-text: #9D6638;
        --hero-overlay: rgba(157, 102, 56, 0.6);
        --nav-bg: rgba(243, 244, 244, 0.1);
        --nav-border: rgba(157, 102, 56, 0.08);
        --nav-text: #9D6638;
        --input-bg: #F3F4F4;
        --input-border: #EFE9E3;
        --package-unselected-bg: #F3F4F4;
        --footer-bg: #9D6638;
        --footer-text: #EFE9E3;
    }
    
    /* ========== WARNA DARK MODE ========== */
    .dark-mode {
        --bg-body: #153448;
        --text-body: #DFD0B8;
        --bg-card: #3C5B6F;
        --text-card: #DFD0B8;
        --border-color: #948979;
        --bg-about: #3C5B6F;
        --primary-color: #DFD0B8;
        --primary-hover: #948979;
        --available-color: #22c55e;
        --occupied-color: #ef4444;
        --text-white: #DFD0B8;
        --sidebar-bg: rgba(21, 52, 72, 0.98);
        --sidebar-text: #DFD0B8;
        --hero-overlay: rgba(21, 52, 72, 0.6);
        --nav-bg: rgba(21, 52, 72, 0.1);
        --nav-border: rgba(223, 208, 184, 0.08);
        --nav-text: #DFD0B8;
        --input-bg: #3C5B6F;
        --input-border: #948979;
        --package-unselected-bg: #3C5B6F;
        --footer-bg: #3C5B6F;
        --footer-text: #DFD0B8;
    }
    
    body {
        background-color: var(--bg-body);
        color: var(--text-body);
        transition: all 0.3s ease;
        padding-top: 80px;
        overflow-x: hidden;
    }

    /* ========== SIDEBAR OVERLAY ========== */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    /* ========== SIDEBAR ========== */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 320px;
        height: 100vh;
        background-color: var(--sidebar-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        z-index: 1000;
        padding: 30px 24px;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 30px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        overflow-x: hidden;
        transform: translateX(-100%);
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(157, 102, 56, 0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #9D6638;
        border-radius: 10px;
    }

    .dark-mode .sidebar::-webkit-scrollbar-track {
        background: rgba(223, 208, 184, 0.1);
    }

    .dark-mode .sidebar::-webkit-scrollbar-thumb {
        background: #DFD0B8;
    }

    .sidebar-close {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 1.5rem;
        color: var(--sidebar-text);
        cursor: pointer;
        background: none;
        border: none;
        transition: transform 0.3s ease;
        z-index: 10;
    }

    .sidebar-close:hover {
        transform: rotate(90deg);
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(157, 102, 56, 0.15);
    }

    .sidebar-logo span {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--sidebar-text);
        letter-spacing: 0.5px;
    }

    .dark-mode .sidebar-logo {
        border-bottom: 1px solid rgba(223, 208, 184, 0.15);
    }

    /* ========== SIDEBAR LINKS ========== */
    .sidebar-links {
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex: 1;
    }

    .sidebar-links a {
        color: var(--sidebar-text);
        text-decoration: none;
        font-size: 1.05rem;
        font-weight: 500;
        padding: 12px 16px;
        border-radius: 12px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: 0.3px;
    }

    .sidebar-links a i {
        width: 24px;
        font-size: 1.1rem;
        color: #9D6638;
    }

    .sidebar-links a:hover {
        background-color: rgba(157, 102, 56, 0.1);
        color: #9D6638;
    }

    .sidebar-links a.active {
        background-color: rgba(157, 102, 56, 0.15);
        color: #9D6638;
    }

    .dark-mode .sidebar-links a i {
        color: #DFD0B8;
    }

    .dark-mode .sidebar-links a:hover {
        background-color: rgba(223, 208, 184, 0.1);
        color: #DFD0B8;
    }

    .dark-mode .sidebar-links a.active {
        background-color: rgba(223, 208, 184, 0.15);
        color: #DFD0B8;
    }

    /* ========== SIDEBAR SWITCHERS ========== */
    .sidebar-switchers {
        display: flex;
        gap: 12px;
        padding: 16px 0;
        border-top: 1px solid rgba(157, 102, 56, 0.1);
        margin-top: 16px;
        align-items: center;
    }

    .dark-mode .sidebar-switchers {
        border-top: 1px solid rgba(223, 208, 184, 0.1);
    }

    .sidebar-switchers .lang-switch {
        background-color: rgba(157, 102, 56, 0.06);
        border: 1px solid rgba(157, 102, 56, 0.1);
        border-radius: 30px;
        padding: 3px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        gap: 2px;
        cursor: pointer;
    }

    .dark-mode .sidebar-switchers .lang-switch {
        background-color: rgba(223, 208, 184, 0.06);
        border: 1px solid rgba(223, 208, 184, 0.1);
    }

    .sidebar-switchers .lang-switch .lang-option {
        color: var(--sidebar-text);
        padding: 0 10px;
        border-radius: 24px;
        height: 28px;
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sidebar-switchers .lang-switch .lang-option.active {
        background-color: #9D6638;
        color: #fff;
    }

    .dark-mode .sidebar-switchers .lang-switch .lang-option.active {
        background-color: #DFD0B8;
        color: #153448;
    }

    /* ===== THEME SWITCH - UKURAN SAMA DENGAN LANGUAGE ===== */
    .sidebar-switchers .theme-switch {
        position: relative;
        display: inline-block;
        width: 56px;
        height: 34px;
    }

    .sidebar-switchers .theme-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .sidebar-switchers .theme-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(157, 102, 56, 0.3);
        transition: 0.3s ease;
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 6px;
        border: 1px solid rgba(157, 102, 56, 0.1);
    }

    .sidebar-switchers .theme-switch input:checked + .theme-slider {
        background-color: rgba(157, 102, 56, 0.5);
    }

    .dark-mode .sidebar-switchers .theme-slider {
        background-color: rgba(223, 208, 184, 0.3);
        border: 1px solid rgba(223, 208, 184, 0.1);
    }

    .dark-mode .sidebar-switchers .theme-switch input:checked + .theme-slider {
        background-color: rgba(223, 208, 184, 0.5);
    }

    .sidebar-switchers .theme-slider i {
        font-size: 15px;
        color: white;
        z-index: 1;
    }

    .sidebar-switchers .theme-slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.3s ease;
        border-radius: 50%;
        z-index: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .sidebar-switchers .theme-switch input:checked + .theme-slider:before {
        transform: translateX(24px);
    }

    @media (max-width: 480px) {
        .sidebar {
            width: 280px;
            padding: 20px 16px;
        }
        .sidebar-logo span {
            font-size: 1.1rem;
        }
        .sidebar-links a {
            font-size: 0.95rem;
            padding: 10px 14px;
        }
    }

    /* ========== MAIN NAVBAR ========== */
    nav {
        background-color: var(--nav-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
        transition: all 0.4s ease;
        border-bottom: 1px solid var(--nav-border);
        padding: 16px 32px;
    }

    nav.scrolled {
        background-color: var(--nav-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
    }

    .nav-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
    }

    .nav-left {
        display: flex;
        align-items: center;
        gap: 16px;
        flex: 1;
    }

    .menu-btn {
        color: var(--nav-text);
        font-size: 1.5rem;
        cursor: pointer;
        background: none;
        border: none;
        transition: all 0.3s ease;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .menu-btn:hover {
        color: var(--primary-color);
    }

    .nav-center {
        flex: 2;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav-center h1 {
        color: var(--nav-text);
        font-weight: 600;
        font-size: 1.15rem;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .nav-center h1:hover {
        color: var(--primary-color);
    }

    .nav-right {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .btn-book-now-nav {
        background: #9D6638;
        color: #fff;
        padding: 10px 28px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(157, 102, 56, 0.25);
        white-space: nowrap;
    }

    .btn-book-now-nav:hover {
        background: #7A4F2A;
        transform: translateY(-2px);
    }

    .dark-mode .btn-book-now-nav {
        background: #DFD0B8;
        color: #153448;
    }

    .dark-mode .btn-book-now-nav:hover {
        background: #948979;
    }

    @media (max-width: 768px) {
        nav {
            padding: 12px 16px;
        }
        .nav-center h1 {
            font-size: 0.9rem;
            letter-spacing: 1px;
        }
        .btn-book-now-nav {
            padding: 8px 16px;
            font-size: 0.75rem;
        }
        .btn-book-now-nav span {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .nav-center h1 {
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        .btn-book-now-nav {
            padding: 6px 12px;
            font-size: 0.7rem;
        }
        .menu-btn {
            font-size: 1.2rem;
        }
    }

    .dark-mode nav {
        border-bottom: 1px solid rgba(223, 208, 184, 0.08);
    }

    .dark-mode .menu-btn {
        color: #DFD0B8;
    }

    .dark-mode .menu-btn:hover {
        color: #948979;
    }

    .dark-mode .nav-center h1 {
        color: #DFD0B8;
    }

    .dark-mode .nav-center h1:hover {
        color: #948979;
    }

    /* ========== FORM STYLES ========== */
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
        box-shadow: 0 0 0 3px rgba(157, 102, 56, 0.2);
    }
    
    .booking-btn {
        width: 100%;
        padding: 14px;
        background-color: #9D6638;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    .booking-btn:hover {
        background-color: #7A4F2A;
        transform: scale(1.02);
    }

    .dark-mode .booking-btn {
        background-color: #DFD0B8;
        color: #153448;
    }
    .dark-mode .booking-btn:hover {
        background-color: #948979;
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
        color: #fff !important;
    }

    .dark-mode .bungalow-card.selected {
        background-color: #DFD0B8;
    }
    .dark-mode .bungalow-card.selected h3,
    .dark-mode .bungalow-card.selected p,
    .dark-mode .bungalow-card.selected .font-bold,
    .dark-mode .bungalow-card.selected .room-icon {
        color: #153448 !important;
    }

    .bungalow-card.inactive {
        opacity: 0.6;
        border-color: #ef4444 !important;
        cursor: not-allowed;
    }

    /* ========== BUNGALOW BOOKED ========== */
    .bungalow-card.booked {
        border-color: #ef4444 !important;
        opacity: 0.7;
        cursor: not-allowed;
    }

    .bungalow-card.booked .room-icon {
        color: #ef4444 !important;
    }

    .bungalow-card.booked:hover {
        transform: none !important;
        border-color: #ef4444 !important;
    }
    
    .alert-success {
        background-color: #9D6638;
        color: #fff;
        padding: 12px 16px;
        border-radius: 8px;
    }
    .alert-error {
        background-color: #ef4444;
        color: white;
        padding: 12px 16px;
        border-radius: 8px;
    }

    /* Dark mode date picker */
    .dark-mode input[type="date"] {
        color-scheme: dark;
        background-color: #3C5B6F;
        color: #DFD0B8;
        border-color: #948979;
    }
    
    .dark-mode input[type="date"]::-webkit-calendar-picker-indicator {
        filter: brightness(0) invert(1);
        cursor: pointer;
        opacity: 1;
    }
    
    .dark-mode input[type="date"]::-webkit-calendar-picker-indicator:hover {
        filter: brightness(0) invert(0.8);
    }

    /* ========== FOOTER ========== */
    .footer {
        background-color: var(--footer-bg);
        color: var(--footer-text);
        transition: all 0.3s ease;
        margin-top: 60px;
    }

    .footer a {
        color: var(--footer-text);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .footer a:hover {
        opacity: 0.7;
    }

    .dark-mode .footer a:hover {
        opacity: 0.7;
    }

    .footer .border-t {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    .dark-mode .footer .border-t {
        border-color: rgba(255, 255, 255, 0.05) !important;
    }

    .footer .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.08);
        transition: all 0.3s ease;
        color: var(--footer-text);
        text-decoration: none;
        font-size: 1.1rem;
    }

    .footer .social-icon:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    .dark-mode .footer .social-icon {
        background-color: rgba(255, 255, 255, 0.05);
    }

    .dark-mode .footer .social-icon:hover {
        background-color: rgba(255, 255, 255, 0.15);
    }
    
    html { scroll-behavior: smooth; }
</style>
</head>

<body>

<!-- ========== SIDEBAR OVERLAY ========== -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ========== SIDEBAR ========== -->
<div class="sidebar" id="sidebar">
    <button class="sidebar-close" id="sidebarClose">
        <i class="fas fa-times"></i>
    </button>

    <div class="sidebar-logo">
        <span>Villa Umo Dewi</span>
    </div>

    <div class="sidebar-links">
        <a href="{{ route('home') }}" data-page="home">
            <i class="fas fa-home"></i> Home
        </a>
        <a href="{{ route('booking') }}" data-page="booking" class="active">
            <i class="fas fa-calendar-check"></i> Booking
        </a>
        <a href="{{ route('report') }}" data-page="report">
            <i class="fas fa-flag"></i> Report
        </a>
        <a href="{{ route('gallery') }}" data-page="gallery">
            <i class="fas fa-images"></i> Gallery
        </a>
    </div>

    <!-- SIDEBAR SWITCHERS -->
    <div class="sidebar-switchers">
        <div class="lang-switch" id="langSwitchSidebar">
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
            <input type="checkbox" id="themeToggleSidebar">
            <span class="theme-slider">
                <i class="fas fa-sun"></i>
                <i class="fas fa-moon"></i>
            </span>
        </label>
    </div>
</div>

<!-- ========== NAVBAR ========== -->
<nav id="mainNav">
    <div class="nav-container">
        <div class="nav-left">
            <button class="menu-btn" id="menuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="nav-center">
            <h1 onclick="window.location.href='{{ url('/') }}'">Villa Umo Dewi</h1>
        </div>

        <div class="nav-right">
            <a href="{{ route('booking') }}" class="btn-book-now-nav">
                <i class="fas fa-calendar-check"></i><span data-i18n="book_now">Book Now</span>
            </a>
        </div>
    </div>
</nav>

<!-- ========== NOTIFICATIONS ========== -->
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

<!-- ========== CONTENT ========== -->
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-body)" data-booking-title>Booking Villa Umo Dewi</h1>
        <p class="text-lg" style="color: var(--text-card)" data-booking-desc>Isi form di bawah untuk memesan villa impianmu</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- ========== FORM ========== -->
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
        
        <!-- ========== BUNGALOW SELECTION ========== -->
        <div>
            <div class="sidebar-bg rounded-2xl border p-8 mb-6" style="border-color: var(--border-color)">
                <h2 class="text-2xl font-bold mb-6" style="color: var(--text-body)">
                    <i class="fas fa-bed" style="color: var(--primary-color)"></i> <span data-package-title>Pilih Bungalow</span>
                </h2>
                
                <div class="space-y-3" id="bungalowContainer">
                    @foreach($bungalows as $bungalow)
                    <div class="bungalow-card p-3 {{ $bungalow->status == 'inactive' ? 'inactive' : '' }}" 
                        data-bungalow="{{ $bungalow->code }}" 
                        data-price="{{ $bungalow->price }}"
                        data-desc-id="{{ $bungalow->description_id }}"
                        data-desc-en="{{ $bungalow->description_en }}"
                        data-status="{{ $bungalow->status }}">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-bed room-icon" 
                                    style="color: {{ $bungalow->status == 'active' ? 'var(--primary-color)' : '#ef4444' }}; font-size: 16px;"></i>
                                    <h3 class="font-semibold text-base" style="color: var(--text-body)">{{ $bungalow->name }}</h3>
                                    <!-- Status Default (Tersedia / Tidak Tersedia) -->
                                    <span class="status-default text-xs px-2 py-0.5 rounded-full" 
                                        style="background: {{ $bungalow->status == 'active' ? '#22c55e' : '#ef4444' }}; color: #fff;">
                                        {{ $bungalow->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </div>
                                <p class="text-xs mt-1 bungalow-desc" style="color: var(--text-card)"></p>
                            </div>
                            <div class="text-right">
                                <div class="font-bold" style="color: var(--primary-color)">Rp {{ number_format($bungalow->price, 0, ',', '.') }}</div>
                                <div class="text-xs price-night-label" style="color: var(--text-card)">/malam</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- ========== SUMMARY ========== -->
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

<!-- ========== FOOTER (3 KOLOM) ========== -->
<footer class="footer py-16">
    <div class="max-w-7xl mx-auto px-6">

        <!-- 3 KOLOM -->
        <div class="grid md:grid-cols-3 gap-12">

            <!-- KOLOM 1: Nama + Deskripsi -->
            <div>
                <h3 class="text-4xl font-bold mb-4" data-footer-name>
                    Villa Umo Dewi
                </h3>
                <p class="leading-relaxed opacity-80 max-w-sm" data-footer-desc>
                    Nikmati pengalaman menginap yang tak terlupakan di tengah hamparan sawah yang asri.
                </p>
            </div>

            <!-- KOLOM 2: LEGAL -->
            <div>
                <h4 class="uppercase tracking-widest text-sm mb-4 font-semibold">
                    LEGAL
                </h4>
                <div class="flex flex-col gap-3 opacity-80">
                    <a href="#" data-footer-privacy>Privacy Policy</a>
                    <a href="#" data-footer-terms>Terms of Service</a>
                    <a href="#" data-footer-contact>Contact Us</a>
                    <a href="#" data-footer-press>Press Kit</a>
                </div>
            </div>

            <!-- KOLOM 3: FOLLOW US -->
            <div>
                <h4 class="uppercase tracking-widest text-sm mb-4 font-semibold">
                    FOLLOW US
                </h4>
                <div class="flex gap-4">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- DIVIDER -->
        <div class="border-t border-white/10 my-10"></div>

        <!-- BOTTOM: Copyright + Indonesia -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="opacity-70 text-sm" data-footer-copyright>
                © 2026 Villa Umo Dewi. All rights reserved.
            </p>
            <p class="opacity-60 text-sm" data-footer-country>
                Indonesia
            </p>
        </div>

    </div>
</footer>

<script>
    // ========== SIDEBAR ==========
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const sidebarClose = document.getElementById('sidebarClose');

    function openSidebar() {
        sidebar.classList.add('active');
        sidebarOverlay.classList.add('active');
        document.body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        document.body.classList.remove('sidebar-open');
    }

    menuBtn.addEventListener('click', openSidebar);
    sidebarClose.addEventListener('click', closeSidebar);
    sidebarOverlay.addEventListener('click', closeSidebar);

    document.querySelectorAll('.sidebar-links a').forEach(link => {
        link.addEventListener('click', closeSidebar);
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar.classList.contains('active')) {
            closeSidebar();
        }
    });

    // ========== SIDEBAR ACTIVE MENU ==========
    document.addEventListener('DOMContentLoaded', function() {
        const currentPage = window.location.pathname.split('/')[1] || '';
        const pageMap = {
            '': 'home',
            'booking': 'booking',
            'report': 'report',
            'gallery': 'gallery'
        };
        const activePage = pageMap[currentPage] || 'home';
        
        document.querySelectorAll('.sidebar-links a').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.page === activePage) {
                link.classList.add('active');
            }
        });
    });

    // ========== DATE PICKER ==========
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
            // Reset selected bungalows when date changes
            resetSelectedBungalows();
        });
    }
    
    if (checkOut) {
        checkOut.addEventListener('change', function() {
            if (checkOutHidden) checkOutHidden.value = this.value;
            calculateDuration();
            // Reset selected bungalows when date changes
            resetSelectedBungalows();
        });
    }

    // ========== RESET SELECTED BUNGALOWS ==========
    function resetSelectedBungalows() {
        selectedBungalows = [];
        document.querySelectorAll('.bungalow-card.selected').forEach(card => {
            card.classList.remove('selected');
        });
        updateSummary();
        // Re-check availability for all bungalows
        checkAllBungalowsAvailability();
    }

    // ========== CHECK ALL BUNGALOWS AVAILABILITY ==========
    async function checkAllBungalowsAvailability() {
        const checkInVal = document.getElementById('checkIn').value;
        const checkOutVal = document.getElementById('checkOut').value;
        
        if (!checkInVal || !checkOutVal) {
            // Jika belum pilih tanggal, tampilkan status default
            document.querySelectorAll('.bungalow-card').forEach(card => {
                const bookedBadge = card.querySelector('.status-booked');
                if (bookedBadge) bookedBadge.remove();
                card.classList.remove('booked');
                
                const statusBadge = card.querySelector('.status-default');
                if (statusBadge) {
                    statusBadge.style.display = 'inline-block';
                }
            });
            return;
        }

        document.querySelectorAll('.bungalow-card').forEach(async (card) => {
            // Skip jika bungalow inactive
            if (card.classList.contains('inactive')) return;
            
            const bungalowCode = card.dataset.bungalow;
            const isAvailable = await checkBungalowAvailability(bungalowCode);
            
            // Hapus badge booked lama
            const oldBookedBadge = card.querySelector('.status-booked');
            if (oldBookedBadge) oldBookedBadge.remove();
            
            // Sembunyikan status default
            const statusBadge = card.querySelector('.status-default');
            
            if (!isAvailable) {
                card.classList.add('booked');
                if (statusBadge) statusBadge.style.display = 'none';
                
                // Tambahkan badge "Booked"
                const badge = document.createElement('span');
                badge.className = 'status-booked text-xs px-2 py-0.5 rounded-full ml-2';
                badge.style.cssText = 'background: #ef4444; color: #fff;';
                badge.textContent = currentLang === 'id' ? 'Dipesan' : 'Booked';
                card.querySelector('.flex.items-center.gap-2').appendChild(badge);
            } else {
                card.classList.remove('booked');
                if (statusBadge) {
                    statusBadge.style.display = 'inline-block';
                    // Update teks status default sesuai bahasa
                    const isActive = card.dataset.status === 'active';
                    statusBadge.textContent = isActive ? (currentLang === 'id' ? 'Tersedia' : 'Available') : (currentLang === 'id' ? 'Tidak Tersedia' : 'Unavailable');
                    statusBadge.style.background = isActive ? '#22c55e' : '#ef4444';
                }
            }
        });
    }

    // ========== CHECK BUNGALOW AVAILABILITY ==========
    async function checkBungalowAvailability(bungalowCode) {
        const checkInVal = document.getElementById('checkIn').value;
        const checkOutVal = document.getElementById('checkOut').value;
        
        if (!checkInVal || !checkOutVal) {
            return true;
        }

        try {
            const response = await fetch(`/booking/check-availability?bungalow_code=${bungalowCode}&check_in=${checkInVal}&check_out=${checkOutVal}`);
            const data = await response.json();
            return data.available;
        } catch (error) {
            console.error('Error checking availability:', error);
            return true;
        }
    }

    // ========== BOOKING FORM VALIDATION ==========
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const email = document.getElementById('inputEmail').value;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        if (!emailRegex.test(email)) {
            e.preventDefault();
            const msg = currentLang === 'id' ? 'Email tidak valid. Contoh: nama@domain.com' : 'Invalid email. Example: name@domain.com';
            alert(msg);
            return false;
        }
    });
        
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

    // ========== LOAD PRICES ==========
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

    loadPrices();
    
    // ========== BUNGALOW NAMES & DESCRIPTIONS ==========
    const bungalowNames = {
        @foreach($bungalows as $bungalow)
        '{{ $bungalow->code }}': { 
            id: '{{ addslashes($bungalow->name) }}', 
            en: '{{ addslashes($bungalow->name) }}',
            desc_id: '{{ addslashes($bungalow->description_id) }}',
            desc_en: '{{ addslashes($bungalow->description_en) }}'
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
            summaryList.innerHTML = `<div class="text-center text-gray-500" id="emptySummary">${currentLang === 'id' ? 'Belum ada bungalow dipilih atau tanggal belum lengkap' : 'No bungalow selected or dates incomplete'}</div>`;
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
            const perNight = currentLang === 'id' ? 'malam' : 'nights';
            html += `
                <div class="flex justify-between items-center" data-bungalow="${bungalow}">
                    <div>
                        <span style="color: var(--text-card)">${name}</span>
                        <div class="text-xs" style="color: var(--primary-color)">${formatPrice(pricePerNight)} × ${duration} ${perNight}</div>
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
    
    // ========== BUNGALOW SELECTION ==========
    const bungalowCards = document.querySelectorAll('.bungalow-card');
    bungalowCards.forEach(card => {
        card.addEventListener('click', async (e) => {
            if (card.classList.contains('inactive')) {
                const msg = currentLang === 'id' ? 'Maaf, bungalow ini sedang tidak tersedia.' : 'Sorry, this bungalow is currently unavailable.';
                alert(msg);
                return;
            }
            
            if (card.classList.contains('booked')) {
                const msg = currentLang === 'id' ? 'Maaf, bungalow ini sudah dipesan untuk tanggal tersebut.' : 'Sorry, this bungalow is already booked for those dates.';
                alert(msg);
                return;
            }
            
            if (e.target.closest('.fa-times-circle')) return;
            
            const bungalowId = card.dataset.bungalow;
            const index = selectedBungalows.indexOf(bungalowId);
            
            // Cek ketersediaan sebelum menambah
            if (index === -1) {
                const isAvailable = await checkBungalowAvailability(bungalowId);
                if (!isAvailable) {
                    const msg = currentLang === 'id' ? 'Maaf, bungalow ini sudah dipesan untuk tanggal tersebut.' : 'Sorry, this bungalow is already booked for those dates.';
                    alert(msg);
                    // Update status card
                    card.classList.add('booked');
                    const statusBadge = card.querySelector('.status-default');
                    if (statusBadge) statusBadge.style.display = 'none';
                    
                    const badge = document.createElement('span');
                    badge.className = 'status-booked text-xs px-2 py-0.5 rounded-full ml-2';
                    badge.style.cssText = 'background: #ef4444; color: #fff;';
                    badge.textContent = currentLang === 'id' ? 'Dipesan' : 'Booked';
                    card.querySelector('.flex.items-center.gap-2').appendChild(badge);
                    return;
                }
                selectedBungalows.push(bungalowId);
                card.classList.add('selected');
            } else {
                selectedBungalows.splice(index, 1);
                card.classList.remove('selected');
            }
            
            updateSummary();
        });
    });
    
    // ========== THEME ==========
    function setTheme(theme) {
        const html = document.documentElement;
        if (theme === 'dark') {
            html.classList.add('dark-mode');
        } else {
            html.classList.remove('dark-mode');
        }
        localStorage.setItem('theme', theme);
        
        document.querySelectorAll('.theme-switch input[type="checkbox"]').forEach(toggle => {
            if (toggle) toggle.checked = (theme === 'dark');
        });
    }
    
    // ========== TRANSLATIONS ==========
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
            nav_home: "Home",
            nav_villa: "Villa",
            nav_booking: "Booking",
            nav_contact: "Kontak",
            unavailable_msg: "Maaf, bungalow ini sedang tidak tersedia.",
            available: "Tersedia",
            unavailable: "Tidak Tersedia",
            per_night: "/malam",
            price_format: "id",
            footer_name: "Villa Umo Dewi",
            footer_desc: "Nikmati pengalaman menginap yang tak terlupakan di tengah hamparan sawah yang asri, dikelilingi keindahan alam Bali.",
            footerPrivacy: "Privacy Policy",
            footerTerms: "Terms of Service",
            footerContact: "Contact Us",
            footerPress: "Press Kit",
            footerCopyright: "© 2026 Villa Umo Dewi. All rights reserved.",
            footer_country: "Indonesia",
            booked: "Dipesan"
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
            nav_home: "Home",
            nav_villa: "Villa",
            nav_booking: "Booking",
            nav_contact: "Contact",
            unavailable_msg: "Sorry, this bungalow is currently unavailable.",
            available: "Available",
            unavailable: "Unavailable",
            per_night: "/night",
            price_format: "en",
            footer_name: "Villa Umo Dewi",
            footer_desc: "Enjoy an unforgettable stay in the middle of lush rice fields, surrounded by the natural beauty of Bali.",
            footerPrivacy: "Privacy Policy",
            footerTerms: "Terms of Service",
            footerContact: "Contact Us",
            footerPress: "Press Kit",
            footerCopyright: "© 2026 Villa Umo Dewi. All rights reserved.",
            footer_country: "Indonesia",
            booked: "Booked"
        }
    };
    
    // ========== APPLY LANGUAGE ==========
    function applyLang(lang) {
        const t = translations[lang];
        if (!t) return;
        
        const elements = {
            '[data-booking-title]': 'booking_title',
            '[data-booking-desc]': 'booking_desc',
            '[data-label-name]': 'label_name',
            '[data-label-phone]': 'label_phone',
            '[data-label-dates]': 'label_dates',
            '[data-package-title]': 'package_title',
            '[data-summary-title]': 'summary_title',
            '[data-total-title]': 'total_title',
            '[data-home]': 'nav_home',
            '[data-villa]': 'nav_villa',
            '[data-booking]': 'nav_booking',
            '[data-contact]': 'nav_contact',
            // FOOTER
            '[data-footer-name]': 'footer_name',
            '[data-footer-desc]': 'footer_desc',
            '[data-footer-privacy]': 'footerPrivacy',
            '[data-footer-terms]': 'footerTerms',
            '[data-footer-contact]': 'footerContact',
            '[data-footer-press]': 'footerPress',
            '[data-footer-copyright]': 'footerCopyright',
            '[data-footer-country]': 'footer_country'
        };
        
        for (const [selector, key] of Object.entries(elements)) {
            const el = document.querySelector(selector);
            if (el) el.innerText = t[key];
        }
        
        document.querySelector('[data-form-title]').innerHTML = `<i class="fas fa-calendar-check" style="color: var(--primary-color)"></i> ${t.form_title}`;
        document.querySelector('[data-package-title]').innerHTML = `<i class="fas fa-bed" style="color: var(--primary-color)"></i> ${t.package_title}`;
        document.querySelector('[data-summary-title]').innerHTML = `<i class="fas fa-receipt"></i> ${t.summary_title}`;
        document.querySelector('[data-book-now]').innerHTML = `<i class="fas fa-check-circle"></i> ${t.book_now}`;
        document.querySelector('[data-guarantee]').innerHTML = t.guarantee;
        
        document.querySelectorAll('.price-night-label').forEach(el => {
            el.innerText = t.per_night;
        });
        
        document.querySelectorAll('.status-unavailable').forEach(el => {
            el.innerText = t.unavailable;
        });
        
        // Update booked badges
        document.querySelectorAll('.status-booked').forEach(el => {
            el.textContent = t.booked;
        });
        
        updateBungalowDescriptions(lang);
        calculateDuration();
        updateSummary();
    }
    
    // ========== UPDATE LANGUAGE UI ==========
    function updateLangUI(lang) {
        document.querySelectorAll('.lang-option').forEach(option => {
            if (option.dataset.lang === lang) {
                option.classList.add('active');
            } else {
                option.classList.remove('active');
            }
        });
    }
    
    // ========== SET LANGUAGE ==========
    function setLang(lang) {
        localStorage.setItem('lang', lang);
        currentLang = lang;
        applyLang(lang);
        updateLangUI(lang);
        // Re-check availability after language change
        checkAllBungalowsAvailability();
    }
    
    // ========== BOOKING FORM ==========
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function() {
            document.getElementById('langInput').value = currentLang;
        });
    }
    
    // ========== THEME TOGGLE ==========
    document.querySelectorAll('.theme-switch input[type="checkbox"]').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const isDark = this.checked;
            document.querySelectorAll('.theme-switch input[type="checkbox"]').forEach(t => {
                if (t !== this) t.checked = isDark;
            });
            setTheme(isDark ? 'dark' : 'light');
        });
    });
    
    // ========== SYNC LANGUAGE ==========
    document.querySelectorAll('.lang-option').forEach(option => {
        option.addEventListener('click', function() {
            const lang = this.dataset.lang;
            document.querySelectorAll('.lang-option').forEach(el => {
                el.classList.remove('active');
            });
            document.querySelectorAll(`.lang-option[data-lang="${lang}"]`).forEach(el => {
                el.classList.add('active');
            });
            setLang(lang);
        });
    });
    
    // ========== INITIALIZE ==========
    window.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
        
        const savedLang = localStorage.getItem('lang') || 'id';
        currentLang = savedLang;
        applyLang(savedLang);
        updateLangUI(savedLang);
        
        // Pastikan semua lang-option sesuai dengan bahasa yang disimpan
        document.querySelectorAll('.lang-option').forEach(el => {
            if (el.dataset.lang === savedLang) {
                el.classList.add('active');
            } else {
                el.classList.remove('active');
            }
        });
        
        // Check availability for all bungalows when page loads
        setTimeout(checkAllBungalowsAvailability, 500);
    });
</script>

</body>
</html>
