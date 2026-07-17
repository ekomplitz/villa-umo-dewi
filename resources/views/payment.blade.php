<!DOCTYPE html>
<html lang="{{ session('lang', 'id') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Payment - Villa Umo Dewi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    
    <!-- Midtrans Snap -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
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
            --sidebar-bg: rgba(243, 244, 244, 0.98);
            --sidebar-text: #9D6638;
            --nav-bg: rgba(243, 244, 244, 0.1);
            --nav-border: rgba(157, 102, 56, 0.08);
            --nav-text: #9D6638;
            --input-bg: #F3F4F4;
            --input-border: #EFE9E3;
            --footer-bg: #9D6638;
            --footer-text: #EFE9E3;
            --success-color: #22c55e;
            --warning-color: #f59e0b;
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
            --sidebar-bg: rgba(21, 52, 72, 0.98);
            --sidebar-text: #DFD0B8;
            --nav-bg: rgba(21, 52, 72, 0.1);
            --nav-border: rgba(223, 208, 184, 0.08);
            --nav-text: #DFD0B8;
            --input-bg: #3C5B6F;
            --input-border: #948979;
            --footer-bg: #0F2A4A;
            --footer-text: #DFD0B8;
            --success-color: #34d399;
            --warning-color: #fbbf24;
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

        /* ========== PAYMENT STYLES ========== */
        .payment-card {
            background-color: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
        }

        .payment-card .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .payment-card .card-header i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .payment-card .card-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-body);
        }

        .payment-method {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            background-color: var(--bg-card);
        }

        .payment-method:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .payment-method.selected {
            border-color: var(--primary-color);
            background-color: var(--primary-color);
        }

        .payment-method.selected .method-icon,
        .payment-method.selected .method-name,
        .payment-method.selected .method-desc {
            color: #fff !important;
        }

        .dark-mode .payment-method.selected {
            background-color: #DFD0B8;
        }

        .dark-mode .payment-method.selected .method-icon,
        .dark-mode .payment-method.selected .method-name,
        .dark-mode .payment-method.selected .method-desc {
            color: #153448 !important;
        }

        .payment-method .method-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background-color: rgba(157, 102, 56, 0.1);
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .dark-mode .payment-method .method-icon {
            background-color: rgba(223, 208, 184, 0.1);
            color: #DFD0B8;
        }

        .payment-method .method-name {
            font-weight: 600;
            color: var(--text-body);
        }

        .payment-method .method-desc {
            font-size: 0.8rem;
            color: var(--text-card);
            opacity: 0.8;
        }

        .payment-method .method-desc {
            color: #9D6638;
            opacity: 0.7;
        }

        .dark-mode .payment-method .method-desc {
            color: #DFD0B8;
            opacity: 0.7;
        }

        .payment-method.selected .method-desc {
            color: #fff !important;
            opacity: 1 !important;
        }

        .dark-mode .payment-method.selected .method-desc {
            color: #153448 !important;
            opacity: 1 !important;
        }

        .payment-method .ml-auto {
            margin-left: auto;
        }

        .payment-method .ml-auto i {
            font-size: 1.1rem;
        }

        .payment-method .ml-auto .fa-circle {
            color: var(--border-color);
        }

        .payment-method.selected .ml-auto .fa-check-circle {
            color: #fff !important;
        }

        .dark-mode .payment-method.selected .ml-auto .fa-check-circle {
            color: #153448 !important;
        }

        /* Border di dark mode - lebih terang */
        .dark-mode .payment-card {
            border-color: #948979;
        }

        .dark-mode .payment-method {
            border-color: #948979;
        }

        .btn-pay {
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

        .btn-pay:hover {
            background-color: #7A4F2A;
            transform: scale(1.02);
        }

        .dark-mode .btn-pay {
            background-color: #DFD0B8;
            color: #153448;
        }

        .dark-mode .btn-pay:hover {
            background-color: #948979;
        }

        .btn-pay:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
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

        /* ========== NOTIFICATION ========== */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            padding: 16px 24px;
            border-radius: 12px;
            color: #fff;
            font-weight: 500;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            animation: slideInRight 0.3s ease;
            max-width: 400px;
        }

        .notification.warning {
            background: #f59e0b;
        }

        .notification.success {
            background: #22c55e;
        }

        .notification.error {
            background: #ef4444;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
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
        <a href="{{ route('report') }}" data-page="report"><i class="fas fa-flag"></i> <span data-i18n="report">Report</span></a>
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
<div class="max-w-5xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold mb-4" style="color: var(--text-body)" data-i18n="payment_title">Pembayaran</h1>
        <p class="text-lg" style="color: var(--text-card)" data-i18n="payment_desc">Lengkapi pembayaran untuk menyelesaikan booking Anda</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- LEFT: Payment Methods -->
        <div class="md:col-span-2">
            <div class="payment-card mb-6">
                <div class="card-header">
                    <i class="fas fa-credit-card"></i>
                    <h3 data-i18n="payment_method_title">Metode Pembayaran</h3>
                </div>
                
                <div class="space-y-3">
                    <!-- Credit Card -->
                    <div class="payment-method selected" data-method="credit_card" onclick="selectMethod('credit_card')">
                        <div class="method-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div>
                            <div class="method-name" data-i18n="method_cc">Kartu Kredit</div>
                            <div class="method-desc" data-i18n="method_cc_desc">Visa, Mastercard, JCB</div>
                        </div>
                        <div class="ml-auto">
                            <i class="fas fa-check-circle" style="color: var(--success-color);"></i>
                        </div>
                    </div>

                    <!-- Bank Transfer -->
                    <div class="payment-method" data-method="bank_transfer" onclick="selectMethod('bank_transfer')">
                        <div class="method-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div>
                            <div class="method-name" data-i18n="method_bank">Transfer Bank</div>
                            <div class="method-desc" data-i18n="method_bank_desc">BCA, Mandiri, BNI, BRI</div>
                        </div>
                        <div class="ml-auto">
                            <i class="fas fa-circle" style="color: var(--border-color);"></i>
                        </div>
                    </div>

                    <!-- QRIS -->
                    <div class="payment-method" data-method="qris" onclick="selectMethod('qris')">
                        <div class="method-icon">
                            <i class="fas fa-qrcode"></i>
                        </div>
                        <div>
                            <div class="method-name" data-i18n="method_qris">QRIS</div>
                            <div class="method-desc" data-i18n="method_qris_desc">Scan QR Code dengan aplikasi e-wallet</div>
                        </div>
                        <div class="ml-auto">
                            <i class="fas fa-circle" style="color: var(--border-color);"></i>
                        </div>
                    </div>

                    <!-- E-Wallet -->
                    <div class="payment-method" data-method="ewallet" onclick="selectMethod('ewallet')">
                        <div class="method-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div>
                            <div class="method-name" data-i18n="method_ewallet">E-Wallet</div>
                            <div class="method-desc" data-i18n="method_ewallet_desc">GoPay, OVO, DANA, ShopeePay</div>
                        </div>
                        <div class="ml-auto">
                            <i class="fas fa-circle" style="color: var(--border-color);"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="payment-card" id="paymentInfo">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i>
                    <h3 id="paymentInfoTitle" data-i18n="payment_info_title">Info Pembayaran</h3>
                </div>
                <div id="paymentInfoContent">
                    <p style="color: var(--text-card);" data-i18n="payment_info_cc">
                        <i class="fas fa-lock mr-2"></i>
                        Pembayaran diproses dengan aman melalui Midtrans. Anda akan diarahkan ke halaman pembayaran.
                    </p>
                </div>
            </div>
        </div>

        <!-- RIGHT: Summary -->
        <div>
            <div class="payment-card sticky top-24">
                <div class="card-header">
                    <i class="fas fa-receipt"></i>
                    <h3 data-i18n="summary_title">Ringkasan Booking</h3>
                </div>

                <div class="space-y-2">
                    <div class="summary-item">
                        <span style="color: var(--text-card);" data-i18n="summary_name">Nama</span>
                        <span style="color: var(--text-body); font-weight: 500;">{{ $booking->name ?? '-' }}</span>
                    </div>
                    <div class="summary-item">
                        <span style="color: var(--text-card);" data-i18n="summary_email">Email</span>
                        <span style="color: var(--text-body); font-weight: 500;">{{ $booking->email ?? '-' }}</span>
                    </div>
                    <div class="summary-item">
                        <span style="color: var(--text-card);" data-i18n="summary_phone">No HP</span>
                        <span style="color: var(--text-body); font-weight: 500;">{{ $booking->phone ?? '-' }}</span>
                    </div>
                    <div class="summary-item">
                        <span style="color: var(--text-card);" data-i18n="summary_checkin">Check-in</span>
                        <span style="color: var(--text-body); font-weight: 500;">{{ isset($booking->check_in) ? \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y') : '-' }}</span>
                    </div>
                    <div class="summary-item">
                        <span style="color: var(--text-card);" data-i18n="summary_checkout">Check-out</span>
                        <span style="color: var(--text-body); font-weight: 500;">{{ isset($booking->check_out) ? \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y') : '-' }}</span>
                    </div>
                    <div class="summary-item">
                        <span style="color: var(--text-card);" data-i18n="summary_duration">Durasi</span>
                        <span style="color: var(--text-body); font-weight: 500;">{{ $booking->duration ?? 0 }} <span data-i18n="summary_nights">malam</span></span>
                    </div>
                    <div class="summary-item">
                        <span style="color: var(--text-card);" data-i18n="summary_bungalow">Bungalow</span>
                        <span style="color: var(--text-body); font-weight: 500;">{{ $booking->selected_bungalows ?? '-' }}</span>
                    </div>
                </div>

                <div class="border-t mt-4 pt-4" style="border-color: var(--border-color);">
                    <div class="flex justify-between items-center">
                        <span style="color: var(--text-body); font-weight: 600;" data-i18n="total_label">Total Pembayaran</span>
                        <span class="summary-total">Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button onclick="processPayment()" class="btn-pay mt-6" id="payButton">
                    <i class="fas fa-check-circle"></i> <span data-i18n="pay_now">Bayar Sekarang</span>
                </button>

                <p class="text-xs text-center mt-4" style="color: var(--text-card);" data-i18n="payment_guarantee">
                    <i class="fas fa-lock"></i> Pembayaran aman & terenkripsi
                </p>
            </div>
        </div>
    </div>
</div>

<!-- ========== FOOTER (3 KOLOM) ========== -->
<footer class="footer py-16">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid md:grid-cols-3 gap-12">
            <div>
                <h3 class="text-4xl font-bold mb-4" data-footer-name>Villa Umo Dewi</h3>
                <p class="leading-relaxed opacity-80 max-w-sm" data-footer-desc>
                    Nikmati pengalaman menginap yang tak terlupakan di tengah hamparan sawah yang asri.
                </p>
            </div>

            <div>
                <h4 class="uppercase tracking-widest text-sm mb-4 font-semibold">LEGAL</h4>
                <div class="flex flex-col gap-3 opacity-80">
                    <a href="#" data-footer-privacy>Privacy Policy</a>
                    <a href="#" data-footer-terms>Terms of Service</a>
                    <a href="#" data-footer-contact>Contact Us</a>
                    <a href="#" data-footer-press>Press Kit</a>
                </div>
            </div>

            <div>
                <h4 class="uppercase tracking-widest text-sm mb-4 font-semibold">FOLLOW US</h4>
                <div class="flex gap-4">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 my-10"></div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="opacity-70 text-sm" data-footer-copyright>© 2026 Villa Umo Dewi. All rights reserved.</p>
            <p class="opacity-60 text-sm" data-footer-country>Indonesia</p>
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
    function updateActiveMenu() {
        const currentPage = window.location.pathname.split('/')[1] || '';
        const pageMap = { '': 'home', 'booking': 'booking', 'report': 'report', 'gallery': 'gallery' };
        const activePage = pageMap[currentPage] || 'home';
        document.querySelectorAll('.sidebar-links a').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.page === activePage) {
                link.classList.add('active');
            }
        });
    }

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
            payment_title: "Pembayaran",
            payment_desc: "Lengkapi pembayaran untuk menyelesaikan booking Anda",
            payment_method_title: "Metode Pembayaran",
            method_cc: "Kartu Kredit",
            method_cc_desc: "Visa, Mastercard, JCB",
            method_bank: "Transfer Bank",
            method_bank_desc: "BCA, Mandiri, BNI, BRI",
            method_qris: "QRIS",
            method_qris_desc: "Scan QR Code dengan aplikasi e-wallet",
            method_ewallet: "E-Wallet",
            method_ewallet_desc: "GoPay, OVO, DANA, ShopeePay",
            payment_info_title: "Info Pembayaran",
            payment_info_cc: "Pembayaran diproses dengan aman melalui Midtrans. Anda akan diarahkan ke halaman pembayaran.",
            payment_info_bank: "Silakan transfer ke rekening berikut: BCA 123-456-7890 a/n Villa Umo Dewi. Konfirmasi setelah transfer.",
            payment_info_qris: "Scan QR Code melalui aplikasi e-wallet Anda (GoPay, OVO, DANA, ShopeePay).",
            payment_info_ewallet: "Pilih e-wallet favorit Anda (GoPay, OVO, DANA, ShopeePay) untuk melakukan pembayaran.",
            summary_title: "Ringkasan Booking",
            summary_name: "Nama",
            summary_email: "Email",
            summary_phone: "No HP",
            summary_checkin: "Check-in",
            summary_checkout: "Check-out",
            summary_duration: "Durasi",
            summary_nights: "malam",
            summary_bungalow: "Bungalow",
            total_label: "Total Pembayaran",
            pay_now: "Bayar Sekarang",
            payment_guarantee: "Pembayaran aman & terenkripsi",
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
            payment_title: "Payment",
            payment_desc: "Complete payment to finalize your booking",
            payment_method_title: "Payment Method",
            method_cc: "Credit Card",
            method_cc_desc: "Visa, Mastercard, JCB",
            method_bank: "Bank Transfer",
            method_bank_desc: "BCA, Mandiri, BNI, BRI",
            method_qris: "QRIS",
            method_qris_desc: "Scan QR Code with e-wallet app",
            method_ewallet: "E-Wallet",
            method_ewallet_desc: "GoPay, OVO, DANA, ShopeePay",
            payment_info_title: "Payment Info",
            payment_info_cc: "Payment is processed securely via Midtrans. You will be redirected to the payment page.",
            payment_info_bank: "Please transfer to the following account: BCA 123-456-7890 a/n Villa Umo Dewi. Confirm after transfer.",
            payment_info_qris: "Scan QR Code through your e-wallet app (GoPay, OVO, DANA, ShopeePay).",
            payment_info_ewallet: "Choose your favorite e-wallet (GoPay, OVO, DANA, ShopeePay) to make payment.",
            summary_title: "Booking Summary",
            summary_name: "Name",
            summary_email: "Email",
            summary_phone: "Phone",
            summary_checkin: "Check-in",
            summary_checkout: "Check-out",
            summary_duration: "Duration",
            summary_nights: "nights",
            summary_bungalow: "Bungalow",
            total_label: "Total Payment",
            pay_now: "Pay Now",
            payment_guarantee: "Payment is safe & encrypted",
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

    // ========== UPDATE PAYMENT INFO ==========
    function updatePaymentInfo(method, t) {
        const infoContent = document.getElementById('paymentInfoContent');
        const infoTitle = document.getElementById('paymentInfoTitle');
        
        const messages = {
            'credit_card': { title: t.payment_info_title, content: t.payment_info_cc },
            'bank_transfer': { title: t.payment_info_title, content: t.payment_info_bank },
            'qris': { title: t.payment_info_title, content: t.payment_info_qris },
            'ewallet': { title: t.payment_info_title, content: t.payment_info_ewallet }
        };
        
        const msg = messages[method] || messages['credit_card'];
        if (infoTitle) infoTitle.textContent = msg.title;
        if (infoContent) {
            infoContent.innerHTML = `<p style="color: var(--text-card);">${msg.content}</p>`;
        }
    }

    // ========== PAYMENT METHOD SELECTION ==========
    function selectMethod(method) {
        // Reset semua payment method
        document.querySelectorAll('.payment-method').forEach(el => {
            el.classList.remove('selected');
            const icon = el.querySelector('.ml-auto i');
            if (icon) {
                icon.className = 'fas fa-circle';
                icon.style.color = 'var(--border-color)';
            }
        });

        // Pilih method yang diklik
        const selected = document.querySelector(`.payment-method[data-method="${method}"]`);
        if (selected) {
            selected.classList.add('selected');
            const icon = selected.querySelector('.ml-auto i');
            if (icon) {
                icon.className = 'fas fa-check-circle';
                icon.style.color = 'var(--success-color)';
            }
        }

        // Update payment info dengan bahasa saat ini
        const savedLang = localStorage.getItem('lang') || 'id';
        const t = translations[savedLang] || translations.id;
        updatePaymentInfo(method, t);
    }

    // ========== APPLY LANGUAGE ==========
    function applyLang(lang) {
        const t = translations[lang];
        if (!t) return;
        
        // Update semua elemen dengan data-i18n
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.dataset.i18n;
            if (t[key] !== undefined) {
                el.innerHTML = t[key];
            }
        });
        
        // Update footer elements
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
        
        // Update payment info based on selected method
        const selectedMethod = document.querySelector('.payment-method.selected');
        if (selectedMethod) {
            const method = selectedMethod.dataset.method;
            updatePaymentInfo(method, t);
        }
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

    // ========== MIDTRANS PAYMENT ==========
    function processPayment() {
        const payButton = document.getElementById('payButton');
        const originalText = payButton.innerHTML;
        payButton.disabled = true;
        
        const savedLang = localStorage.getItem('lang') || 'id';
        const t = translations[savedLang] || translations.id;
        payButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + (savedLang === 'id' ? 'Memproses...' : 'Processing...');

        const bookingId = {{ $booking->id }};
        
        fetch('/payment/create/' + bookingId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        // ✅ Pembayaran berhasil
                        window.location.href = '/payment-success';
                    },
                    onPending: function(result) {
                        // ⏳ Pembayaran pending (contoh: transfer bank)
                        // PENTING: JANGAN REDIRECT KE SUCCESS!
                        // Tampilkan notifikasi bahwa pembayaran pending
                        const msg = savedLang === 'id' 
                            ? 'Pembayaran sedang diproses. Silakan selesaikan transfer dan tunggu konfirmasi.' 
                            : 'Payment is pending. Please complete the transfer and wait for confirmation.';
                        alert(msg);
                        
                        // Kembalikan tombol ke keadaan semula
                        payButton.disabled = false;
                        payButton.innerHTML = originalText;
                        
                        // Atau redirect ke halaman pending (opsional)
                        // window.location.href = '/payment-pending';
                    },
                    onError: function(result) {
                        // ❌ Pembayaran gagal
                        window.location.href = '/payment-failed';
                    },
                    onClose: function() {
                        // ❌ User menutup popup (klik X) - TETAP DI HALAMAN PAYMENT
                        payButton.disabled = false;
                        payButton.innerHTML = originalText;
                        
                        const msg = savedLang === 'id' 
                            ? 'Pembayaran dibatalkan. Silakan selesaikan pembayaran untuk mengkonfirmasi booking.' 
                            : 'Payment cancelled. Please complete payment to confirm your booking.';
                        alert(msg);
                    }
                });
            } else {
                alert(savedLang === 'id' ? 'Gagal memproses pembayaran: ' + (data.error || 'Unknown error') : 'Payment failed: ' + (data.error || 'Unknown error'));
                payButton.disabled = false;
                payButton.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(savedLang === 'id' ? 'Terjadi kesalahan. Silakan coba lagi.' : 'An error occurred. Please try again.');
            payButton.disabled = false;
            payButton.innerHTML = originalText;
        });
    }

    // ========== INITIALIZE ==========
    document.addEventListener('DOMContentLoaded', function() {
        // Theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
        
        // Language
        const savedLang = localStorage.getItem('lang') || 'id';
        setLang(savedLang);
        
        // Active menu
        updateActiveMenu();
        
        // Default select credit card
        selectMethod('credit_card');
    });
</script>

</body>
</html>