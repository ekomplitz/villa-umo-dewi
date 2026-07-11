<!DOCTYPE html>
<html lang="{{ session('lang', 'id') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - Villa Umo Dewi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        .success-card {
            background: white;
            border-radius: 24px;
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #d1fae5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .success-icon i {
            font-size: 40px;
            color: #22c55e;
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
        .btn-booking {
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
        .btn-booking:hover {
            background: #9D6638;
            color: white;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2" data-i18n="payment_success_title">Pembayaran Berhasil!</h1>
        <p class="text-gray-600 mb-2" data-i18n="payment_success_desc">Terima kasih telah melakukan pembayaran.</p>
        <p class="text-gray-500 text-sm mb-6" data-i18n="payment_success_confirm">Booking Anda telah dikonfirmasi. Kami akan mengirimkan detail booking ke email Anda.</p>
        
        <a href="{{ route('home') }}" class="btn-home">
            <i class="fas fa-home mr-2"></i> <span data-i18n="back_home">Kembali ke Home</span>
        </a>
        <br>
        <a href="{{ route('booking') }}" class="btn-booking">
            <i class="fas fa-calendar-check mr-2"></i> <span data-i18n="booking_again">Booking Lagi</span>
        </a>
    </div>

    <script>
        const translations = {
            id: {
                payment_success_title: "Pembayaran Berhasil!",
                payment_success_desc: "Terima kasih telah melakukan pembayaran.",
                payment_success_confirm: "Booking Anda telah dikonfirmasi. Kami akan mengirimkan detail booking ke email Anda.",
                back_home: "Kembali ke Home",
                booking_again: "Booking Lagi"
            },
            en: {
                payment_success_title: "Payment Successful!",
                payment_success_desc: "Thank you for your payment.",
                payment_success_confirm: "Your booking has been confirmed. We will send the booking details to your email.",
                back_home: "Back to Home",
                booking_again: "Book Again"
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