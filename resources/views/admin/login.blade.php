<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin Login - Villa Umo Dewi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- ===== FAVICON ===== -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='leaf' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%2333cc55'/%3E%3Cstop offset='100%25' style='stop-color:%23118833'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d='M50 5 C25 25 5 55 50 95 C95 55 75 25 50 5Z' fill='url(%23leaf)'/%3E%3Cpath d='M50 5 L50 75' stroke='%230d6b2e' stroke-width='2.5' fill='none'/%3E%3Cpath d='M50 25 L30 45' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 25 L70 45' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 45 L32 65' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3Cpath d='M50 45 L68 65' stroke='%230d6b2e' stroke-width='2' fill='none'/%3E%3C/svg%3E">
    <!-- Fallback -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E🍃%3C/text%3E%3C/svg%3E">

    <style>
        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            --text-body: #9D6638;
            --bg-card: rgba(243, 244, 244, 0.92);
            --border-color: #EFE9E3;
            --primary-color: #9D6638;
            --primary-hover: #7A4F2A;
        }
        
        .dark-mode {
            --text-body: #DFD0B8;
            --bg-card: rgba(21, 52, 72, 0.92);
            --border-color: #948979;
            --primary-color: #DFD0B8;
            --primary-hover: #948979;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #9D6638;
            overflow: hidden;
        }
        
        /* ========== BACKGROUND GAMBAR DENGAN BLUR ========== */
        .login-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background-image: url('{{ asset('images/pemandangan-sawah-villa-umo-dewi-1.jpg') }}');
            background-size: cover;
            background-position: center;
            filter: blur(8px);
            transform: scale(1.05);
        }
        
        .login-bg::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }
        
        .login-container {
            position: relative;
            z-index: 1;
            background-color: var(--bg-card);
            backdrop-filter: blur(20px);
            padding: 40px 36px;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .login-container .logo {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .login-container .logo i {
            font-size: 48px;
            color: #9D6638;
            display: block;
            margin-bottom: 12px;
        }
        
        .login-container .logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-body);
            letter-spacing: 1px;
        }
        
        .login-container .logo p {
            font-size: 0.9rem;
            color: var(--text-body);
            opacity: 0.7;
            margin-top: 4px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-body);
            margin-bottom: 6px;
        }
        
        .form-group label i {
            margin-right: 8px;
            color: #9D6638;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.5);
            color: var(--text-body);
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #9D6638;
            box-shadow: 0 0 0 3px rgba(157, 102, 56, 0.2);
        }
        
        .dark-mode .form-group input {
            background-color: rgba(255, 255, 255, 0.08);
            color: #DFD0B8;
        }
        
        .dark-mode .form-group input::placeholder {
            color: rgba(223, 208, 184, 0.5);
        }
        
        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: #9D6638;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: #7A4F2A;
            transform: scale(1.02);
        }
        
        .dark-mode .btn-login {
            background-color: #DFD0B8;
            color: #153448;
        }
        
        .dark-mode .btn-login:hover {
            background-color: #948979;
        }
        
        .dark-mode .login-container .logo i {
            color: #DFD0B8;
        }
        
        .dark-mode .form-group label i {
            color: #DFD0B8;
        }
        
        .dark-mode .form-group input:focus {
            border-color: #DFD0B8;
            box-shadow: 0 0 0 3px rgba(223, 208, 184, 0.2);
        }
        
        .dark-mode .login-container {
            border-color: rgba(223, 208, 184, 0.15);
        }
        
        .error-msg {
            background-color: rgba(239, 68, 68, 0.15);
            border-left: 4px solid #ef4444;
            color: #ef4444;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 0.9rem;
        }
        
        .dark-mode .error-msg {
            background-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: var(--text-body);
            opacity: 0.6;
        }
    </style>
</head>

<body>

<!-- ========== BACKGROUND GAMBAR DENGAN BLUR ========== -->
<div class="login-bg"></div>

<!-- ========== LOGIN CONTAINER ========== -->
<div class="login-container">
    <div class="logo">
        <i class="fas fa-leaf"></i>
        <h1>Villa Umo Dewi</h1>
        <p>Admin Panel</p>
    </div>

    @if(session('error'))
    <div class="error-msg">
        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="error-msg">
        <i class="fas fa-exclamation-circle mr-2"></i> {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="form-group">
            <label><i class="fas fa-user"></i>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}" required>
        </div>

        <div class="form-group">
            <label><i class="fas fa-lock"></i>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn-login">
            <i class="fas fa-sign-in-alt mr-2"></i> Login
        </button>
    </form>

    <div class="login-footer">
        <p>Username: <strong>admin</strong> | Password: <strong>admin123</strong></p>
    </div>
</div>

<script>
    // ========== THEME TOGGLE ==========
    // Cek localStorage untuk tema
    const savedTheme = localStorage.getItem('theme') || 'light';
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark-mode');
    }

    // Tambahkan toggle theme di pojok (optional)
    const toggleBtn = document.createElement('button');
    toggleBtn.innerHTML = '<i class="fas fa-moon"></i>';
    toggleBtn.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50%;
        width: 44px;
        height: 44px;
        font-size: 1.2rem;
        cursor: pointer;
        color: white;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    `;
    
    toggleBtn.addEventListener('mouseenter', () => {
        toggleBtn.style.transform = 'scale(1.1)';
    });
    toggleBtn.addEventListener('mouseleave', () => {
        toggleBtn.style.transform = 'scale(1)';
    });
    
    toggleBtn.addEventListener('click', () => {
        const isDark = document.documentElement.classList.contains('dark-mode');
        if (isDark) {
            document.documentElement.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
            toggleBtn.innerHTML = '<i class="fas fa-moon"></i>';
        } else {
            document.documentElement.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
            toggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
        }
    });
    
    document.body.appendChild(toggleBtn);
</script>

</body>
</html>
