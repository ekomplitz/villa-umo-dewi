<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Villa Umo Dewi - Villa dengan Pemandangan Sawah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    <!-- ===== FAVICON ===== -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='leaf' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%2333cc55'/%3E%3Cstop offset='100%25' style='stop-color:%23118833'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d='M50 5 C25 25 5 55 50 95 C95 55 75 25 50 5Z' fill='url(%23leaf)'/%3E%3Cpath d='M50 5 L50 75' stroke='%230d6b2e' stroke-width='2.5' fill='none'/%3E%3Cpath d='M50 25 L30 45' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 25 L70 45' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 45 L32 65' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 45 L68 65' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3C/svg%3E">
    <!-- Fallback -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E🍃%3C/text%3E%3C/svg%3E">
    
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
            --footer-bg: #3C5B6F;
            --footer-text: #DFD0B8;
        }
        
        body {
            background-color: var(--bg-body);
            color: var(--text-body);
            transition: all 0.3s ease;
            overflow-x: hidden;
            padding-top: 0 !important;
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

        /* ========== HERO ========== */
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
            background-color: #9D6638;
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
            background-color: rgba(157, 102, 56, 0.7);
            backdrop-filter: blur(4px);
            border-radius: 28px;
            padding: 32px 40px;
            border: 1px solid rgba(239, 233, 227, 0.2);
        }
        
        .hero-content h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #EFE9E3;
            line-height: 1.2;
        }
        
        .hero-content p {
            font-size: 1rem;
            color: #EFE9E3;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .hero-content .btn-primary {
            background: #EFE9E3;
            color: #9D6638;
            padding: 12px 28px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .hero-content .btn-primary:hover {
            background: #F3F4F4;
            transform: scale(1.05);
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
            background-color: #EFE9E3;
            cursor: pointer;
            transition: all 0.3s;
            opacity: 0.6;
        }
        
        .bg-dot.active {
            opacity: 1;
            width: 28px;
            border-radius: 10px;
            background-color: #9D6638;
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
        
        .scroll-indicator i {
            color: #EFE9E3;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(10px); }
        }

        .dark-mode .hero-content > div {
            background-color: rgba(21, 52, 72, 0.7);
            border-color: rgba(223, 208, 184, 0.2);
        }

        .dark-mode .hero-content h2 {
            color: #DFD0B8;
        }

        .dark-mode .hero-content p {
            color: #DFD0B8;
        }

        .dark-mode .hero-content .btn-primary {
            background: #DFD0B8;
            color: #153448;
        }

        .dark-mode .bg-dot {
            background-color: #DFD0B8;
        }

        .dark-mode .bg-dot.active {
            background-color: #948979;
        }

        .dark-mode .scroll-indicator i {
            color: #DFD0B8;
        }

        /* ========== CARDS ========== */
        .card-bg {
            background-color: var(--bg-card);
            border-color: var(--border-color);
            border: 1px solid var(--border-color);
        }
        
        .card-text { 
            color: var(--text-card); 
        }
        
        .feature-icon {
            font-size: 32px;
            margin-bottom: 12px;
            color: #9D6638;
        }

        .dark-mode .feature-icon {
            color: #DFD0B8;
        }
        
        .btn-primary {
            background-color: #9D6638;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            display: inline-block;
            border-radius: 12px;
            font-weight: 600;
            color: #fff;
            padding: 14px 40px;
        }
        
        .btn-primary:hover {
            background-color: #7A4F2A;
            transform: scale(1.05);
        }
        
        .dark-mode .btn-primary {
            background-color: #DFD0B8;
            color: #153448;
        }

        .dark-mode .btn-primary:hover {
            background-color: #948979;
        }

        .room-card {
            transition: transform 0.3s;
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
        }
        
        .room-card:hover {
            transform: scale(1.03);
        }

        .status-badge {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 6px;
        }
        
        .status-badge.available { background-color: #22c55e; }
        .status-badge.occupied { background-color: #ef4444; }
        
        .status-label {
            font-weight: 600;
        }

        /* ========== MAPS & RUTE WRAPPER ========== */
        .maps-wrapper {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        @media (min-width: 768px) {
            .maps-wrapper {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 32px;
                align-items: stretch;
            }
        }

        .map-container {
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid var(--border-color);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 400px;
            background-color: #e5e7eb;
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* ========== RUTE CARD ========== */
        .route-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 28px 32px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .route-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-body);
        }

        .route-card .route-desc {
            font-size: 1rem;
            color: var(--text-card);
            margin-bottom: 24px;
            line-height: 1.8;
        }

        .route-step {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }

        .route-step .step-number {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #9D6638;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .route-step .step-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-body);
            margin-bottom: 4px;
        }

        .route-step .step-content p {
            font-size: 0.95rem;
            color: var(--text-card);
            line-height: 1.6;
        }

        .route-divider {
            border: 0;
            height: 1px;
            background: var(--border-color);
            margin: 20px 0;
            margin-top: auto;
        }

        .route-time {
            font-size: 1rem;
            color: var(--text-card);
            margin-top: 12px;
        }

        .route-time i {
            color: var(--primary-color);
            margin-right: 10px;
        }

        .dark-mode .route-step .step-number {
            background-color: #DFD0B8;
            color: #153448;
        }

        .dark-mode .route-divider {
            background: var(--border-color);
        }

        /* Mobile */
        @media (max-width: 768px) {
            .map-container {
                min-height: 300px;
                height: 300px;
            }
            
            .route-card {
                padding: 20px 24px;
            }
            
            .route-card h3 {
                font-size: 1.25rem;
            }
        }

        /* ========== FOOTER ========== */
        .footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            transition: all 0.3s ease;
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
    </style>
</head>

<body>

<!-- ========== SIDEBAR ========== -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar" id="sidebar">
    <button class="sidebar-close" id="sidebarClose">
        <i class="fas fa-times"></i>
    </button>

    <div class="sidebar-logo">
        <span>Villa Umo Dewi</span>
    </div>

    <div class="sidebar-links">
        <a href="{{ route('home') }}" data-page="home" class="active">
            <i class="fas fa-home"></i> Home
        </a>
        <a href="{{ route('booking') }}" data-page="booking">
            <i class="fas fa-calendar-check"></i> Booking
        </a>
        <a href="{{ route('report') }}" data-page="report">
            <i class="fas fa-flag"></i> Report
        </a>
        <a href="{{ route('gallery') }}" data-page="gallery">
            <i class="fas fa-images"></i> Gallery
        </a>
    </div>

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
            <h1 onclick="scrollToTop()">Villa Umo Dewi</h1>
        </div>

        <div class="nav-right">
            <a href="{{ route('booking') }}" class="btn-book-now-nav">
                <i class="fas fa-calendar-check"></i><span data-i18n="book_now">Book Now</span>
            </a>
        </div>
    </div>
</nav>

<!-- ========== HERO ========== -->
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
            <a href="{{ route('booking') }}" data-btn class="btn-primary"></a>
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

<!-- ========== VILLA PAGE ========== -->
<section id="villa-page" class="py-16 px-6 md:px-12" style="background-color: var(--bg-body)">
    <div class="max-w-6xl mx-auto">
        <!-- ABOUT VILLA -->
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

        <!-- BUNGALOW -->
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
                        style="background-color: var(--bg-card); border: 2px solid {{ $bungalow->status == 'active' ? '#22c55e' : '#ef4444' }};"
                        data-bungalow="{{ $bungalow->code }}"
                        data-desc-id="{{ $bungalow->description_id }}"
                        data-desc-en="{{ $bungalow->description_en }}"
                        data-status="{{ $bungalow->status }}">
                        @php
                            // Cek apakah gambar ada
                            $imagePath = $bungalow->image ? asset('storage/' . $bungalow->image) : asset('images/image_4.jpg');
                        @endphp
                        <img src="{{ $imagePath }}" 
                            class="w-full h-48 object-cover" 
                            alt="{{ $bungalow->name }}"
                            onerror="this.src='{{ asset('images/image_4.jpg') }}'">
                        <div class="p-4 text-center">
                            <i class="fas fa-bed text-2xl mb-2 room-icon" 
                            style="color: {{ $bungalow->status == 'active' ? '#22c55e' : '#ef4444' }}"></i>
                            
                            <h3 class="font-bold text-lg" style="color: var(--text-body)">{{ $bungalow->name }}</h3>
                            
                            <p class="text-sm mt-1 bungalow-desc" style="color: var(--text-card)"></p>
                            
                            <p class="font-bold mt-2" style="color: var(--primary-color)">
                                Rp {{ number_format($bungalow->price, 0, ',', '.') }}
                                <span class="text-sm font-normal price-night-label" style="color: var(--primary-color)">/malam</span>
                            </p>
                            
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <span class="status-badge {{ $bungalow->status == 'active' ? 'available' : 'occupied' }}"></span>
                                <span class="room-status-text text-sm font-semibold status-label" 
                                    style="color: {{ $bungalow->status == 'active' ? '#22c55e' : '#ef4444' }}"
                                    data-status="{{ $bungalow->status }}">
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
                        style="background-color: var(--bg-card); border: 2px solid #22c55e;">
                        <img src="{{ asset('images/image_4.jpg') }}" class="w-full h-48 object-cover" alt="{{ $bungalow['name'] }}">
                        <div class="p-4 text-center">
                            <i class="fas fa-bed text-2xl mb-2 room-icon" style="color: #22c55e"></i>
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
                            <p class="font-bold mt-2" style="color: var(--primary-color)">Rp {{ number_format($bungalow['price'], 0, ',', '.') }}<span class="text-sm font-normal price-night-label" style="color: var(--primary-color)">/malam</span></p>
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <span class="status-badge available"></span>
                                <span class="room-status-text text-sm font-semibold status-label" style="color: #22c55e" data-status="active">Tersedia</span>
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

        <!-- FEATURES -->
        <div class="grid md:grid-cols-4 gap-6 py-8">
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
            <div class="card-bg p-6 rounded-2xl border card-text text-center transform transition hover:scale-105">
                <i class="fas fa-wifi feature-icon"></i>
                <h3 class="text-xl font-semibold mb-2" style="color: var(--text-body)" data-feature4-title></h3>
                <p data-feature4-desc></p>
            </div>
        </div>

        <!-- MAPS & RUTE -->
        <div class="mt-12">
            <div class="text-center mb-6">
                <i class="fas fa-map-marked-alt text-3xl mb-2" style="color: var(--primary-color)"></i>
                <h2 class="text-2xl font-bold" style="color: var(--text-body)" data-map-title>Rute Perjalanan</h2>
                <p class="text-sm" style="color: var(--text-card)" data-map-desc>Menuju Villa Umo Dewi</p>
            </div>

            <div class="maps-wrapper">
                <!-- MAP -->
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126247.59591881638!2d114.98126983906249!3d-8.573160199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd230cec883c3b1%3A0xd9316dbf6ac4e259!2sUmo%20Dewi%20-%20Two-Bedroom%20Villa!5e0!3m2!1sen!2sus!4v1783588304119!5m2!1sen!2sus"                      allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- RUTE INFO -->
                <div class="route-card">
                    <h3 data-route-title>Getting to Villa</h3>
                    <p class="route-desc" data-route-desc>Finding peace requires a little effort, but the final view that awaits you will repay all the fatigue of the journey.</p>

                    <div class="route-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4 data-route-step1-title>Ngurah Rai Airport to Villa</h4>
                            <p data-route-step1-desc>Approximately 1.5 hours drive from Ngurah Rai Airport to Villa Umo Dewi.</p>
                        </div>
                    </div>

                    <div class="route-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4 data-route-step2-title>Countryside Route</h4>
                            <p data-route-step2-desc>Pass through beautiful countryside roads with green rice field views along the way.</p>
                        </div>
                    </div>

                    <div class="route-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4 data-route-step3-title>Arrive at Villa</h4>
                            <p data-route-step3-desc>Upon arrival at the villa, you will be greeted with a peaceful atmosphere and stunning natural views.</p>
                        </div>
                    </div>

                    <hr class="route-divider">

                    <p class="route-time">
                        <i class="fas fa-clock"></i>
                        <span data-route-duration>Estimated time: 1.5 - 2 hours</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- <!-- PROMO -->
        <div class="mt-12 text-center rounded-3xl p-8" style="background-color: var(--bg-about)">
            <div class="max-w-3xl mx-auto">
                <i class="fas fa-tags text-4xl mb-4" style="color: var(--primary-color)"></i>
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--text-body)" data-promo-title></h2>
                <p class="card-text max-w-2xl mx-auto mb-8 text-base md:text-lg" data-promo-desc></p>
                <a href="{{ route('booking') }}" class="btn-primary inline-block shadow-lg">
                    <i class="fas fa-calendar-check mr-2"></i> <span data-villa-book-now></span>
                </a>
            </div>
        </div> --}}
    </div>
</section>

<!-- ========== FOOTER (3 KOLOM) ========== -->
<footer class="footer py-16">
    <div class="max-w-7xl mx-auto px-6">

        <!-- 3 KOLOM - Semua di tengah -->
        <div class="grid md:grid-cols-3 gap-12">

            <!-- KOLOM 1: Nama + Deskripsi (Rata Kiri) -->
            <div class="text-center md:text-left">
                <h3 class="text-4xl font-bold mb-4" data-footer-name>
                    Villa Umo Dewi
                </h3>
                <p class="leading-relaxed opacity-80 max-w-sm mx-auto md:mx-0" data-footer-desc>
                    Nikmati pengalaman menginap yang tak terlupakan di tengah hamparan sawah yang asri.
                </p>
            </div>

            <!-- KOLOM 2: LEGAL (Tengah) -->
            <div class="text-center">
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

            <!-- KOLOM 3: FOLLOW US (Tengah) -->
            <div class="text-center">
                <h4 class="uppercase tracking-widest text-sm mb-4 font-semibold">
                    FOLLOW US
                </h4>
                <div class="flex justify-center gap-4">
                    <a href="https://www.facebook.com/profile.php?id=61592067392836" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/umodewi_" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/@umodewi" class="social-icon">
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

    if (menuBtn) {
        menuBtn.addEventListener('click', openSidebar);
    }

    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

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
    
    // ========== UPDATE BUNGALOW DESCRIPTIONS ==========
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
            // promoTitle: "🎉 Promo Spesial Akhir Tahun! 🎉",
            // promoDesc: "Dapatkan diskon 30% untuk booking 3 malam atau lebih! Jangan sampai kelewatan, promo terbatas!",
            aboutTitle: "Tentang Villa Umo Dewi",
            aboutDesc: "Villa Umo Dewi adalah villa yang terletak di tengah hamparan sawah yang asri. Nikmati udara segar, pemandangan hijau, dan suara alam yang menenangkan. Cocok buat staycation bareng keluarga, teman, atau pasangan 💚",
            addressTitle: "Alamat",
            addressDesc: "Desa Wisata Umo Dewi, Kec. Tegallalang, Gianyar, Bali",
            hoursTitle: "Jam Operasional",
            hoursDesc: "Check-in: 14.00 WITA | Check-out: 12.00 WITA",
            footerCopyright: "© 2026 Villa Umo Dewi. All rights reserved.",
            footerAddress: "Jl. Raya Umo Dewi No. 88, Bali, Indonesia",
            footerPrivacy: "Privacy Policy",
            footerTerms: "Terms of Service",
            footerContact: "Contact Us",
            footerPress: "Press Kit",
            villa_page_title: "Villa Umo Dewi",
            villa_page_desc: "Nikmati pengalaman menginap yang tak terlupakan di tengah hamparan sawah yang asri, dikelilingi keindahan alam Bali.",
            villa_desc_text: "Villa Umo Dewi menawarkan pengalaman menginap unik dengan konsep modern yang menyatu sempurna dengan alam. Terletak di tengah hamparan sawah hijau, villa ini dirancang untuk kenyamanan maksimal. Arsitektur memadukan elemen tradisional Bali dengan desain kontemporer, menciptakan suasana harmonis yang menenangkan.",
            villa_desc_text2: "Setiap detail diperhatikan dengan seksama, dari pemilihan material alami hingga tata letak ruangan yang mengoptimalkan sirkulasi udara dan pencahayaan alami. Desain open-plan memungkinkan udara segar mengalir bebas, sementara jendela besar membingkai pemandangan sawah yang menakjubkan.",
            villa_rooms_title: "Kamar yang Tersedia",
            villa_rooms_desc: "Status kamar dapat berubah sewaktu-waktu",
            villa_book_now: "Booking Sekarang",
            available: "Tersedia",
            unavailable: "Tidak Tersedia",
            per_night: "/malam",
            unavailable_status: "Tidak Tersedia",
            available_status: "Tersedia",
            map_title: "Rute Perjalanan",
            map_desc: "Menuju Villa Umo Dewi",
            route_title: "Menuju Villa",
            route_desc: "Menemukan ketenangan membutuhkan sedikit usaha, namun pemandangan akhir yang menanti Anda akan melunasi seluruh lelah perjalanan.",
            route_step1_title: "Bandara Ngurah Rai ke Villa",
            route_step1_desc: "Perjalanan darat sekitar 1,5 jam dari Bandara Ngurah Rai menuju Villa Umo Dewi.",
            route_step2_title: "Jalur Pedesaan",
            route_step2_desc: "Melintasi jalan pedesaan yang asri dengan pemandangan sawah hijau di sepanjang perjalanan.",
            route_step3_title: "Tiba di Villa",
            route_step3_desc: "Setibanya di villa, Anda akan disambut dengan suasana tenang dan pemandangan alam yang menakjubkan.",
            route_duration: "Estimasi waktu: 1,5 - 2 jam",
            footer_name: "Villa Umo Dewi",
            footer_follow: "Follow Us",
            footer_country: "Indonesia",
            footer_desc: "Nikmati pengalaman menginap yang tak terlupakan di tengah hamparan sawah yang asri.",
            feature4Title: "Free WiFi",
            feature4Desc: "Nikmati akses internet cepat dan gratis selama menginap, cocok untuk workcation.",
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
            // promoTitle: "🎉 Special Year-End Promo! 🎉",
            // promoDesc: "Get 30% discount for booking 3 nights or more! Don't miss out, limited promo!",
            aboutTitle: "About Villa Umo Dewi",
            aboutDesc: "Villa Umo Dewi is a villa located in the middle of lush rice fields. Enjoy fresh air, green views, and calming natural sounds. Perfect for a staycation with family, friends, or your partner 💚",
            addressTitle: "Address",
            addressDesc: "Umo Dewi Tourism Village, Tegallalang District, Gianyar, Bali",
            hoursTitle: "Operating Hours",
            hoursDesc: "Check-in: 02:00 PM WITA | Check-out: 12:00 PM WITA",
            footerCopyright: "© 2026 Villa Umo Dewi. All rights reserved.",
            footerAddress: "Jl. Raya Umo Dewi No. 88, Bali, Indonesia",
            footerPrivacy: "Privacy Policy",
            footerTerms: "Terms of Service",
            footerContact: "Contact Us",
            footerPress: "Press Kit",
            villa_page_title: "Villa Umo Dewi",
            villa_page_desc: "Enjoy an unforgettable stay in the middle of lush rice fields, surrounded by the natural beauty of Bali.",
            villa_desc_text: "Villa Umo Dewi offers a unique stay experience with a modern concept that blends perfectly with nature. Located in the middle of green rice fields, this villa is designed to provide maximum comfort for all guests. The architecture combines traditional Balinese elements with contemporary design, creating a harmonious atmosphere that soothes the soul.",
            villa_desc_text2: "Every detail is carefully considered, from the selection of natural materials to the room layout that optimizes air circulation and natural lighting. The open-plan design allows fresh air to flow freely, while large windows frame stunning views of the surrounding rice paddies.",
            villa_rooms_title: "Available Rooms",
            villa_rooms_desc: "Room status may change at any time",
            villa_book_now: "Book Now",
            available: "Available",
            unavailable: "Unavailable",
            per_night: "/night",
            unavailable_status: "Unavailable",
            available_status: "Available",
            map_title: "Travel Route",
            map_desc: "Getting to Villa Umo Dewi",
            route_title: "Getting to Villa",
            route_desc: "Finding peace requires a little effort, but the final view that awaits you will repay all the fatigue of the journey.",
            route_step1_title: "Ngurah Rai Airport to Villa",
            route_step1_desc: "Approximately 1.5 hours drive from Ngurah Rai Airport to Villa Umo Dewi.",
            route_step2_title: "Countryside Route",
            route_step2_desc: "Pass through beautiful countryside roads with green rice field views along the way.",
            route_step3_title: "Arrive at Villa",
            route_step3_desc: "Upon arrival at the villa, you will be greeted with a peaceful atmosphere and stunning natural views.",
            route_duration: "Estimated time: 1.5 - 2 hours",
            footer_name: "Villa Umo Dewi",
            footer_follow: "Follow Us",
            footer_country: "Indonesia",
            footer_desc: "Enjoy an unforgettable stay in the middle of lush rice fields, surrounded by the natural beauty of Bali.",
            feature4Title: "Free WiFi",
            feature4Desc: "Enjoy fast and free internet access during your stay, perfect for workcation.",
        }
    };
    
    // ========== APPLY LANGUAGE ==========
    function applyLang(lang) {
        const t = translations[lang];
        if (!t) return;
        
        const elements = {
            '[data-home]': 'home',
            '[data-villa]': 'villa',
            '[data-booking]': 'booking',
            '[data-contact]': 'contact',
            '[data-hero-title]': 'heroTitle',
            '[data-hero-desc]': 'heroDesc',
            '[data-btn]': 'btn',
            '[data-feature1-title]': 'feature1Title',
            '[data-feature1-desc]': 'feature1Desc',
            '[data-feature2-title]': 'feature2Title',
            '[data-feature2-desc]': 'feature2Desc',
            '[data-feature3-title]': 'feature3Title',
            '[data-feature3-desc]': 'feature3Desc',
            '[data-gallery-title]': 'galleryTitle',
            '[data-gallery-desc]': 'galleryDesc',
            '[data-about-title]': 'aboutTitle',
            '[data-about-desc]': 'aboutDesc',
            '[data-address-title]': 'addressTitle',
            '[data-address-desc]': 'addressDesc',
            '[data-hours-title]': 'hoursTitle',
            '[data-hours-desc]': 'hoursDesc',
            '[data-footer-copyright]': 'footerCopyright',
            '[data-footer-address]': 'footerAddress',
            '[data-footer-privacy]': 'footerPrivacy',
            '[data-footer-terms]': 'footerTerms',
            '[data-footer-contact]': 'footerContact',
            '[data-footer-press]': 'footerPress',
            '[data-villa-page-title]': 'villa_page_title',
            '[data-villa-page-desc]': 'villa_page_desc',
            '[data-villa-desc-text]': 'villa_desc_text',
            '[data-villa-desc-text2]': 'villa_desc_text2',
            '[data-villa-rooms-title]': 'villa_rooms_title',
            '[data-villa-rooms-desc]': 'villa_rooms_desc',
            '[data-villa-book-now]': 'villa_book_now',
            '[data-map-title]': 'map_title',
            '[data-map-desc]': 'map_desc',
            '[data-route-title]': 'route_title',
            '[data-route-desc]': 'route_desc',
            '[data-route-step1-title]': 'route_step1_title',
            '[data-route-step1-desc]': 'route_step1_desc',
            '[data-route-step2-title]': 'route_step2_title',
            '[data-route-step2-desc]': 'route_step2_desc',
            '[data-route-step3-title]': 'route_step3_title',
            '[data-route-step3-desc]': 'route_step3_desc',
            '[data-route-duration]': 'route_duration',
            '[data-footer-name]': 'footer_name',
            '[data-footer-follow]': 'footer_follow',
            '[data-footer-country]': 'footer_country',
            '[data-footer-desc]': 'footer_desc',
            '[data-feature4-title]': 'feature4Title',
            '[data-feature4-desc]': 'feature4Desc',
        };
        
        for (const [selector, key] of Object.entries(elements)) {
            const el = document.querySelector(selector);
            if (el) el.innerText = t[key];
        }
        
        const promoTitle = document.querySelector('[data-promo-title]');
        if (promoTitle) promoTitle.innerHTML = t.promoTitle;
        
        const promoDesc = document.querySelector('[data-promo-desc]');
        if (promoDesc) promoDesc.innerHTML = t.promoDesc;
        
        document.querySelectorAll('.price-night-label').forEach(el => {
            el.innerText = t.per_night;
        });
        
        document.querySelectorAll('.status-label').forEach(el => {
            const status = el.dataset.status;
            if (status === 'active') {
                el.innerText = t.available_status;
            } else {
                el.innerText = t.unavailable_status;
            }
        });

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
    
    // ========== ANCHOR LINKS ==========
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
                if (sidebar && sidebar.classList.contains('active')) {
                    closeSidebar();
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
    
    // ========== THEME TOGGLE EVENT ==========
    document.querySelectorAll('.theme-switch input[type="checkbox"]').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const isDark = this.checked;
            document.querySelectorAll('.theme-switch input[type="checkbox"]').forEach(t => {
                if (t !== this) t.checked = isDark;
            });
            setTheme(isDark ? 'dark' : 'light');
        });
    });
    
    // ========== INITIALIZE ==========
    window.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
        
        const savedLang = localStorage.getItem('lang') || 'id';
        setLang(savedLang);
        
        updateLangUI(savedLang);
    });
</script>

</body>
</html>