<!DOCTYPE html>
<html lang="{{ session('lang', 'id') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Kritik & Saran - Villa Umo Dewi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    
    <style>
        * { 
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif; 
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
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
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
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

        /* ========== NAVBAR ========== */
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
        
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--input-border);
            border-radius: 12px;
            background-color: var(--input-bg);
            color: var(--text-body);
            transition: all 0.3s;
            font-size: 16px;
            resize: vertical;
            min-height: 180px;
        }
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(157, 102, 56, 0.2);
        }
        
        .btn-primary {
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
        .btn-primary:hover {
            background-color: #7A4F2A;
            transform: scale(1.02);
        }

        .dark-mode .btn-primary {
            background-color: #DFD0B8;
            color: #153448;
        }
        .dark-mode .btn-primary:hover {
            background-color: #948979;
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
            background-color: rgba(52,211,153,0.2);
            color: #6ee7b7;
            border-left-color: #34d399;
        }

        /* Rating Stars */
        .rating-star {
            cursor: pointer;
            color: #ddd;
            transition: all 0.2s;
            user-select: none;
            font-size: 2rem;
        }

        .rating-star.active {
            color: #f59e0b;
        }

        .rating-star:hover {
            transform: scale(1.2);
        }

        .dark-mode .form-textarea {
            background-color: #3C5B6F;
            color: #DFD0B8;
            border-color: #948979;
        }

        .dark-mode .form-textarea:focus {
            border-color: #DFD0B8;
            box-shadow: 0 0 0 3px rgba(223, 208, 184, 0.2);
        }

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

<!-- SIDEBAR OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <button class="sidebar-close" id="sidebarClose"><i class="fas fa-times"></i></button>
    <div class="sidebar-logo"><span>Villa Umo Dewi</span></div>
    <div class="sidebar-links">
        <a href="{{ route('home') }}" data-page="home"><i class="fas fa-home"></i> <span data-i18n="home">Home</span></a>
        <a href="{{ route('booking') }}" data-page="booking"><i class="fas fa-calendar-check"></i> <span data-i18n="booking">Booking</span></a>
        <a href="{{ route('report') }}" data-page="report" class="active"><i class="fas fa-flag"></i> <span data-i18n="report">Report</span></a>
        <a href="{{ route('gallery') }}" data-page="gallery"><i class="fas fa-images"></i> <span data-i18n="gallery">Gallery</span></a>
    </div>
    <div class="sidebar-switchers">
        <div class="lang-switch" id="langSwitchSidebar">
            <div class="lang-option" data-lang="id"><i class="fas fa-flag"></i><span>ID</span></div>
            <div class="lang-option" data-lang="en"><i class="fas fa-flag-usa"></i><span>EN</span></div>
        </div>
        <label class="theme-switch">
            <input type="checkbox" id="themeToggleSidebar">
            <span class="theme-slider"><i class="fas fa-sun"></i><i class="fas fa-moon"></i></span>
        </label>
    </div>
</div>

<!-- NAVBAR -->
<nav id="mainNav">
    <div class="nav-container">
        <div class="nav-left">
            <button class="menu-btn" id="menuBtn"><i class="fas fa-bars"></i></button>
        </div>
        <div class="nav-center">
            <h1 onclick="window.location.href='{{ route('home') }}'">Villa Umo Dewi</h1>
        </div>
        <div class="nav-right">
            <a href="{{ route('booking') }}" class="btn-book-now-nav">
                <i class="fas fa-calendar-check"></i><span data-i18n="book_now">Book Now</span>
            </a>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div style="padding-top:80px;max-width:800px;margin:0 auto;padding-left:20px;padding-right:20px;padding-bottom:60px;">
    <h1 style="font-size:2.5rem;font-weight:700;margin-bottom:8px;color:var(--text-body);" data-i18n="feedback_title">Kritik & Saran</h1>
    <p style="color:var(--text-card);margin-bottom:30px;" data-i18n="feedback_description">
        Kami sangat menghargai masukan dari Anda untuk terus meningkatkan kualitas Villa Umo Dewi.
    </p>

    @if(session('success'))
    <div class="alert-success">
        <i class="fas fa-check-circle"></i> <span data-i18n="feedback_success">Kritik & saran berhasil dikirim! Terima kasih atas masukannya.</span>
    </div>
    @endif

    <div style="background:var(--bg-card);border-radius:20px;padding:30px;border:1px solid var(--border-color);">
        <form method="POST" action="{{ route('report.store') }}">
            @csrf

            <div style="margin-bottom:20px;">
                <label class="form-label"><i class="fas fa-user"></i> <span data-i18n="name">Nama</span> <span style="color:red;">*</span></label>
                <input type="text" name="name" class="form-input" placeholder="{{ session('lang') == 'en' ? 'Enter your name' : 'Masukkan nama Anda' }}" required>
            </div>

            <div style="margin-bottom:20px;">
                <label class="form-label"><i class="fas fa-envelope"></i> <span data-i18n="email">Email</span> <span style="color:red;">*</span></label>
                <input type="email" name="email" class="form-input" placeholder="{{ session('lang') == 'en' ? 'Enter your email' : 'Masukkan email Anda' }}" required>
            </div>

            <div style="margin-bottom:20px;">
                <label class="form-label"><i class="fas fa-star"></i> <span data-i18n="rating">Rating</span> <span style="color:red;">*</span></label>
                <div style="display:flex;gap:8px;font-size:2rem;" id="ratingStars">
                    <span class="rating-star" data-value="1">★</span>
                    <span class="rating-star" data-value="2">★</span>
                    <span class="rating-star" data-value="3">★</span>
                    <span class="rating-star" data-value="4">★</span>
                    <span class="rating-star" data-value="5">★</span>
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="5">
                <span style="font-size:0.9rem;color:var(--text-card);" data-i18n="rating_hint">Klik bintang untuk memberi rating</span>
            </div>

            <div style="margin-bottom:20px;">
                <label class="form-label"><i class="fas fa-comment"></i> <span data-i18n="message">Pesan</span> <span style="color:red;">*</span></label>
                <textarea name="message" class="form-textarea" rows="6" placeholder="{{ session('lang') == 'en' ? 'Write your feedback...' : 'Tulis kritik & saran Anda...' }}" required></textarea>
            </div>

            <button type="submit" class="btn-primary">
                <i class="fas fa-paper-plane"></i> <span data-i18n="submit">Kirim Kritik & Saran</span>
            </button>
        </form>
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

    function openSidebar() { sidebar.classList.add('active'); sidebarOverlay.classList.add('active'); document.body.classList.add('sidebar-open'); }
    function closeSidebar() { sidebar.classList.remove('active'); sidebarOverlay.classList.remove('active'); document.body.classList.remove('sidebar-open'); }

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
        const pageMap = { '': 'home', 'booking': 'booking', 'report': 'report', 'gallery': 'gallery' };
        const activePage = pageMap[currentPage] || 'home';
        document.querySelectorAll('.sidebar-links a').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.page === activePage) {
                link.classList.add('active');
            }
        });
    });

    // ========== RATING STARS ==========
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('ratingInput');

    stars.forEach(s => s.classList.add('active'));

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = parseInt(this.dataset.value);
            ratingInput.value = value;
            stars.forEach(s => {
                s.classList.toggle('active', parseInt(s.dataset.value) <= value);
            });
        });
        
        star.addEventListener('mouseenter', function() {
            const value = parseInt(this.dataset.value);
            stars.forEach(s => {
                s.style.color = parseInt(s.dataset.value) <= value ? '#f59e0b' : '#ddd';
            });
        });
        
        star.addEventListener('mouseleave', function() {
            const currentRating = parseInt(ratingInput.value) || 0;
            stars.forEach(s => {
                s.style.color = parseInt(s.dataset.value) <= currentRating ? '#f59e0b' : '#ddd';
            });
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
        
        document.querySelectorAll('.theme-switch input[type="checkbox"]').forEach(t => { 
            t.checked = (theme === 'dark'); 
        });
    }

    document.querySelectorAll('.theme-switch input[type="checkbox"]').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const isDark = this.checked;
            document.querySelectorAll('.theme-switch input[type="checkbox"]').forEach(t => { 
                t.checked = isDark; 
            });
            setTheme(isDark ? 'dark' : 'light');
        });
    });

    // ========== TRANSLATIONS ==========
    const translations = {
        id: {
            home: "Home",
            booking: "Booking",
            report: "Report",
            gallery: "Gallery",
            book_now: "Book Now",
            feedback_title: "Kritik & Saran",
            feedback_description: "Kami sangat menghargai masukan dari Anda untuk terus meningkatkan kualitas Villa Umo Dewi.",
            feedback_success: "Kritik & saran berhasil dikirim! Terima kasih atas masukannya.",
            name: "Nama",
            email: "Email",
            rating: "Rating",
            rating_hint: "Klik bintang untuk memberi rating",
            message: "Pesan",
            submit: "Kirim Kritik & Saran",
            // FOOTER
            footer_name: "Villa Umo Dewi",
            footer_desc: "Nikmati pengalaman menginap yang tak terlupakan di tengah hamparan sawah yang asri, dikelilingi keindahan alam Bali.",
            footerPrivacy: "Privacy Policy",
            footerTerms: "Terms of Service",
            footerContact: "Contact Us",
            footerPress: "Press Kit",
            footerCopyright: "© 2026 Villa Umo Dewi. All rights reserved.",
            footer_country: "Indonesia"
        },
        en: {
            home: "Home",
            booking: "Booking",
            report: "Report",
            gallery: "Gallery",
            book_now: "Book Now",
            feedback_title: "Feedback & Suggestions",
            feedback_description: "We greatly appreciate your feedback to continuously improve the quality of Villa Umo Dewi.",
            feedback_success: "Feedback submitted successfully! Thank you for your input.",
            name: "Name",
            email: "Email",
            rating: "Rating",
            rating_hint: "Click the stars to rate",
            message: "Message",
            submit: "Submit Feedback",
            // FOOTER
            footer_name: "Villa Umo Dewi",
            footer_desc: "Enjoy an unforgettable stay in the middle of lush rice fields, surrounded by the natural beauty of Bali.",
            footerPrivacy: "Privacy Policy",
            footerTerms: "Terms of Service",
            footerContact: "Contact Us",
            footerPress: "Press Kit",
            footerCopyright: "© 2026 Villa Umo Dewi. All rights reserved.",
            footer_country: "Indonesia"
        }
    };

    // ========== APPLY LANGUAGE ==========
    function applyLang(lang) {
        const t = translations[lang];
        if (!t) return;
        
        // Update all elements with data-i18n
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.dataset.i18n;
            if (t[key]) {
                el.textContent = t[key];
            }
        });
        
        // Update footer elements with data attributes
        const footerElements = {
            '[data-footer-name]': 'footer_name',
            '[data-footer-desc]': 'footer_desc',
            '[data-footer-privacy]': 'footerPrivacy',
            '[data-footer-terms]': 'footerTerms',
            '[data-footer-contact]': 'footerContact',
            '[data-footer-press]': 'footerPress',
            '[data-footer-copyright]': 'footerCopyright',
            '[data-footer-country]': 'footer_country'
        };
        
        for (const [selector, key] of Object.entries(footerElements)) {
            const el = document.querySelector(selector);
            if (el) el.textContent = t[key];
        }

        // Update placeholders
        const nameInput = document.querySelector('input[name="name"]');
        const emailInput = document.querySelector('input[name="email"]');
        const messageTextarea = document.querySelector('textarea[name="message"]');
        
        if (nameInput) nameInput.placeholder = lang === 'en' ? 'Enter your name' : 'Masukkan nama Anda';
        if (emailInput) emailInput.placeholder = lang === 'en' ? 'Enter your email' : 'Masukkan email Anda';
        if (messageTextarea) messageTextarea.placeholder = lang === 'en' ? 'Write your feedback...' : 'Tulis kritik & saran Anda...';
    }

    // ========== LANGUAGE ==========
    function setLang(lang) {
        localStorage.setItem('lang', lang);
        document.querySelectorAll('.lang-option').forEach(el => {
            el.classList.remove('active');
            if (el.dataset.lang === lang) { el.classList.add('active'); }
        });
        
        document.documentElement.lang = lang;
        applyLang(lang);
        
        fetch('{{ route("set.language") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ lang: lang })
        });
    }

    document.querySelectorAll('.lang-option').forEach(option => {
        option.addEventListener('click', function() {
            setLang(this.dataset.lang);
        });
    });

    // ========== INITIALIZE ==========
    window.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
        
        const savedLang = localStorage.getItem('lang') || 'id';
        setLang(savedLang);
    });
</script>

</body>
</html>