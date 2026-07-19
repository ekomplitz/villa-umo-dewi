<!DOCTYPE html>
<html lang="{{ session('lang', 'id') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Gagal - Villa Umo Dewi</title>
    <!-- Tidak diindeks oleh mesin pencari (halaman transaksi privat) -->
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    
    <style>
        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        body {
            background: linear-gradient(135deg, #EFE9E3 0%, #d4c9c0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .failed-card {
            background: white;
            border-radius: 24px;
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        }
        .failed-icon {
            width: 80px;
            height: 80px;
            background: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .failed-icon i {
            font-size: 40px;
            color: #ef4444;
        }
        .btn-home {
            display: inline-block;
            background: #9D6638;
            color: white;
            padding: 12px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 16px;
        }
        .btn-home:hover {
            background: #7A4F2A;
            transform: scale(1.02);
        }
        .btn-retry {
            display: inline-block;
            background: transparent;
            color: #9D6638;
            padding: 12px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            border: 2px solid #9D6638;
            transition: all 0.3s;
            margin-top: 8px;
        }
        .btn-retry:hover {
            background: #9D6638;
            color: white;
        }
    </style>
</head>
<body>
    <div class="failed-card">
        <div class="failed-icon">
            <i class="fas fa-times-circle"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2" data-i18n="payment_failed_title">Pembayaran Gagal</h1>
        <p class="text-gray-600 mb-2" data-i18n="payment_failed_desc">Maaf, pembayaran Anda gagal diproses.</p>
        <p class="text-gray-500 text-sm mb-6" data-i18n="payment_failed_retry">Silakan coba lagi atau gunakan metode pembayaran lain.</p>
        
        <a href="javascript:history.back()" class="btn-retry">
            <i class="fas fa-undo mr-2"></i> <span data-i18n="retry">Coba Lagi</span>
        </a>
        <br>
        <a href="{{ route('home') }}" class="btn-home">
            <i class="fas fa-home mr-2"></i> <span data-i18n="back_home">Kembali ke Home</span>
        </a>
    </div>

    <script>
        const translations = {
            id: {
                payment_failed_title: "Pembayaran Gagal",
                payment_failed_desc: "Maaf, pembayaran Anda gagal diproses.",
                payment_failed_retry: "Silakan coba lagi atau gunakan metode pembayaran lain.",
                retry: "Coba Lagi",
                back_home: "Kembali ke Home"
            },
            en: {
                payment_failed_title: "Payment Failed",
                payment_failed_desc: "Sorry, your payment could not be processed.",
                payment_failed_retry: "Please try again or use another payment method.",
                retry: "Try Again",
                back_home: "Back to Home"
            }
        };

        function applyLang(lang) {
            const t = translations[lang] || translations.id;
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.dataset.i18n;
                if (t[key]) el.textContent = t[key];
            });
        }

        const savedLang = localStorage.getItem('lang') || 'id';
        applyLang(savedLang);
    </script>
</body>
</html>
