<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.forgot_password.page_title') }}</title>
    
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏛️</text></svg>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
    :root {
        --primary-green: #003c6d;
        --primary-light: #005085;
        --primary-lighter: #e8eff5;
        --primary-lightest: #f4f9fa;
        --primary-dark: #003655;
        --primary-darker: #003858;
        --primary-darkest: #00182b;
        --grey-900: #1a1a1a;
        --grey-800: #2c2c2c;
        --grey-700: #424242;
        --grey-600: #616161;
        --grey-500: #757575;
        --grey-400: #9e9e9e;
        --grey-300: #e0e0e0;
        --grey-200: #eeeeee;
        --grey-100: #f5f5f5;
        --grey-50: #fafafa;
        --pure-white: #FFFFFF;
        --accent-red: #d32f2f;
        --accent-orange: #ff9800;
        --success-green: #4caf50;
        --gradient-primary: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
        --gradient-background: linear-gradient(135deg, rgba(0, 60, 109, 0.03) 0%, rgba(0, 80, 133, 0.08) 100%);
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 15px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 8px 30px rgba(0, 60, 109, 0.08);
        --shadow-xl: 0 15px 60px rgba(0, 60, 109, 0.12);
        --font-main: 'Neo Sans Arabic', 'Segoe UI', Tahoma, Arial, sans-serif;
        --border-radius-sm: 16px;
        --border-radius-md: 24px;
        --border-radius-lg: 32px;
        --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-medium: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        --transition-smooth: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }

    *, *::before, *::after { 
        margin: 0; 
        padding: 0; 
        box-sizing: border-box; 
    }

    html { 
        scroll-behavior: smooth; 
        overflow-x: hidden; 
        font-size: 16px;
        direction: rtl;
    }

    body { 
        font-family: var(--font-main); 
        background: linear-gradient(135deg, #ffffff 0%, #f8fafe 50%, #ffffff 100%);
        color: var(--grey-700); 
        line-height: 1.6; 
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        direction: rtl;
        position: relative;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 20%, rgba(0, 60, 109, 0.05) 0%, transparent 70%),
                    radial-gradient(circle at 80% 80%, rgba(0, 80, 133, 0.08) 0%, transparent 70%);
        pointer-events: none;
        z-index: -1;
    }

    .auth-container {
        width: 100%;
        max-width: 1200px;
        background: var(--pure-white);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        min-height: 680px;
        display: flex;
        border: 1px solid rgba(0, 60, 109, 0.08);
        backdrop-filter: blur(20px);
        animation: containerFadeIn 0.8s ease-out;
    }

    @keyframes containerFadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .auth-brand-panel {
        flex: 1;
        background: var(--gradient-primary);
        color: var(--pure-white);
        padding: 4rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .auth-brand-panel::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: floatAnimation 6s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes floatAnimation {
        0%, 100% {
            transform: translate(0, 0) rotate(0deg);
        }
        50% {
            transform: translate(-20px, -20px) rotate(180deg);
        }
    }

    .brand-content {
        position: relative;
        z-index: 2;
        animation: slideInRight 0.8s ease-out 0.2s both;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .brand-title {
        font-size: 2.8rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        background: linear-gradient(45deg, #ffffff, rgba(255, 255, 255, 0.9));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .brand-description {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.7;
        max-width: 400px;
    }

    .brand-footer {
        position: relative;
        z-index: 2;
        animation: slideInRight 0.8s ease-out 0.4s both;
    }

    .brand-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .brand-stat {
        text-align: center;
        transition: var(--transition-smooth);
    }

    .brand-stat:hover {
        transform: translateY(-5px);
    }

    .brand-stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--pure-white);
        margin-bottom: 0.25rem;
    }

    .brand-stat-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .brand-copyright {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.7);
        text-align: center;
    }

    .auth-form-panel {
        flex: 1.2;
        padding: 4rem 5rem;
        display: flex;
        flex-direction: column;
        position: relative;
        background: var(--pure-white);
        direction: rtl;
        overflow-y: auto;
    }

    .back-to-selection {
        position: absolute;
        top: 2rem;
        right: 2rem;
        width: 48px;
        height: 48px;
        background: var(--pure-white);
        border: 2px solid var(--grey-200);
        border-radius: 50%;
        color: var(--grey-600);
        font-size: 1.1rem;
        cursor: pointer;
        transition: var(--transition-smooth);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
    }

    .back-to-selection:hover {
        background: var(--primary-green);
        color: var(--pure-white);
        border-color: var(--primary-green);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInUp 0.6s ease-out 0.3s both;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .auth-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--grey-900);
        margin-bottom: 0.75rem;
        line-height: 1.2;
        background: linear-gradient(135deg, var(--grey-900) 0%, var(--grey-700) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .auth-subtitle {
        font-size: 1.2rem;
        color: var(--grey-500);
        line-height: 1.6;
    }

    .form-group {
        position: relative;
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s ease-out calc(0.4s + var(--delay, 0s)) both;
    }

    .form-group:nth-child(1) { --delay: 0.1s; }
    .form-group:nth-child(2) { --delay: 0.2s; }
    .form-group:nth-child(3) { --delay: 0.3s; }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--grey-700);
        margin-bottom: 0.75rem;
        font-size: 1rem;
        transition: var(--transition-fast);
    }

    .form-label.required::after {
        content: '*';
        color: var(--accent-red);
        margin-right: 0.25rem;
    }

    .form-input-wrapper {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 1.25rem 3.5rem 1.25rem 1.25rem;
        border: 2px solid var(--grey-200);
        border-radius: var(--border-radius-sm);
        font-family: var(--font-main);
        font-size: 1.1rem;
        transition: var(--transition-smooth);
        background: var(--pure-white);
        color: var(--grey-700);
        outline: none;
        direction: rtl;
        text-align: right;
        box-shadow: var(--shadow-sm);
    }

    .form-input:focus {
        border-color: var(--primary-green);
        background: var(--pure-white);
        box-shadow: 0 0 0 4px rgba(0, 60, 109, 0.08), var(--shadow-md);
        transform: translateY(-2px);
    }

    .form-input-icon {
        position: absolute;
        top: 50%;
        right: 1.25rem;
        transform: translateY(-50%);
        color: #666666;
        font-size: 1.1rem;
        pointer-events: none;
        transition: var(--transition-smooth);
        z-index: 10;
    }

    /* عند التركيز على الحقل - باستخدام sibling selector */
    .form-input:focus ~ .form-input-icon {
        color: var(--primary-green) !important;
        transform: translateY(-50%) scale(1.1);
    }

    /* حالات validation */
    .form-input.is-valid ~ .form-input-icon {
        color: var(--success-green) !important;
    }

    .form-input.is-invalid ~ .form-input-icon {
        color: var(--accent-red) !important;
    }

    .form-input.is-valid {
        border-color: var(--success-green);
        background: #f8fff9;
    }

    .form-input.is-invalid {
        border-color: var(--accent-red);
        background: #fff8f8;
    }

    .form-error-message {
        display: none;
        margin-top: 0.75rem;
        font-size: 0.9rem;
        color: var(--accent-red);
        font-weight: 500;
        text-align: right;
        animation: slideInUp 0.3s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-input.is-invalid ~ .form-error-message {
        display: block;
    }

    .form-actions {
        margin-top: 2rem;
        animation: fadeInUp 0.6s ease-out 0.8s both;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1.25rem 2.5rem;
        border-radius: var(--border-radius-sm);
        font-family: var(--font-main);
        font-weight: 600;
        font-size: 1.1rem;
        border: 2px solid transparent;
        cursor: pointer;
        transition: var(--transition-smooth);
        text-decoration: none;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        right: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: var(--transition-medium);
    }

    .btn:hover::before {
        right: 100%;
    }

    .btn-primary {
        background: var(--gradient-primary);
        color: var(--pure-white);
        border-color: var(--primary-green);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-green) 100%);
    }

    .btn-primary:active {
        transform: translateY(-1px);
    }

    .btn-primary:disabled {
        background: var(--grey-400);
        border-color: var(--grey-400);
        cursor: not-allowed;
        opacity: 0.7;
        transform: none;
        box-shadow: var(--shadow-sm);
    }

    .back-to-login {
        text-align: center;
        margin-top: 2rem;
        color: var(--grey-600);
        animation: fadeIn 0.6s ease-out 1.1s both;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .back-to-login a {
        color: var(--primary-green);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition-fast);
        padding: 0.25rem 0.5rem;
        border-radius: var(--border-radius-sm);
    }

    .back-to-login a:hover {
        background: rgba(0, 60, 109, 0.05);
        transform: translateY(-1px);
    }

    /* Alert Styles */
    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        margin-bottom: 2rem;
        border-radius: var(--border-radius-sm);
        font-size: 0.95rem;
        font-weight: 500;
        animation: slideInDown 0.5s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background: rgba(76, 175, 80, 0.1);
        color: var(--success-green);
        border: 1px solid rgba(76, 175, 80, 0.2);
    }

    .alert-danger {
        background: rgba(211, 47, 47, 0.1);
        color: var(--accent-red);
        border: 1px solid rgba(211, 47, 47, 0.2);
    }

    .alert ul {
        list-style: none;
        margin: 0;
    }

    .alert li {
        margin-bottom: 0.25rem;
    }

    .alert li:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 992px) {
        .auth-container {
            flex-direction: column;
            min-height: auto;
            max-width: 500px;
        }
        
        .auth-brand-panel {
            display: none;
        }
        
        .auth-form-panel {
            padding: 3rem;
        }
    }

    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }
        
        .auth-form-panel {
            padding: 2rem;
        }
    }

    @media (max-width: 480px) {
        .auth-container {
            border-radius: var(--border-radius-md);
            min-height: calc(100vh - 2rem);
        }
        
        .auth-form-panel {
            padding: 1.5rem;
        }
        
        .auth-title {
            font-size: 2.2rem;
        }
        
        .back-to-selection {
            top: 1rem;
            right: 1rem;
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }

    /* Custom Scrollbar */
    .auth-form-panel::-webkit-scrollbar {
        width: 6px;
    }

    .auth-form-panel::-webkit-scrollbar-track {
        background: var(--grey-100);
        border-radius: 3px;
    }

    .auth-form-panel::-webkit-scrollbar-thumb {
        background: var(--grey-300);
        border-radius: 3px;
        transition: var(--transition-fast);
    }

    .auth-form-panel::-webkit-scrollbar-thumb:hover {
        background: var(--grey-400);
    }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- اللوحة الجانبية -->
        <div class="auth-brand-panel">
            <div class="brand-content">
                <h2 class="brand-title">{{ __('auth.forgot_password.brand_title') }}</h2>
                <p class="brand-description">
                    {{ __('auth.forgot_password.brand_description') }}
                </p>
            </div>
            
            <div class="brand-footer">
                <div class="brand-stats">
                    <div class="brand-stat">
                        <div class="brand-stat-value">1200+</div>
                        <div class="brand-stat-label">{{ __('auth.forgot_password.stats.companies') }}</div>
                    </div>
                    <div class="brand-stat">
                        <div class="brand-stat-value">24B</div>
                        <div class="brand-stat-label">{{ __('auth.forgot_password.stats.employment') }}</div>
                    </div>
                    <div class="brand-stat">
                        <div class="brand-stat-value">99.7%</div>
                        <div class="brand-stat-label">{{ __('auth.forgot_password.stats.satisfaction') }}</div>
                    </div>
                </div>
                <div class="brand-copyright">
                    {{ __('auth.forgot_password.copyright') }}
                </div>
            </div>
        </div>

        <!-- لوحة النموذج -->
        <div class="auth-form-panel">

            <div class="auth-header">
                <h1 class="auth-title">{{ __('auth.forgot_password.title') }}</h1>
                <p class="auth-subtitle">{{ __('auth.forgot_password.subtitle') }}</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" novalidate>
                @csrf
                
                <div class="form-group">
                    <label class="form-label required" for="email">{{ __('auth.forgot_password.email_label') }}</label>
                    <div class="form-input-wrapper">
                        <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" placeholder="{{ __('auth.forgot_password.email_placeholder') }}" value="{{ old('email') }}" required autofocus>
                        <i class="form-input-icon fas fa-envelope"></i>
                    </div>
                    @error('email')
                        <div class="form-error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        {{ __('auth.forgot_password.submit_button') }}
                    </button>
                </div>
            </form>

            <div class="back-to-login">
                <p>{{ __('auth.forgot_password.back_to_login_text') }} <a href="{{ route('login') }}">{{ __('auth.forgot_password.back_to_login_link') }}</a></p>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // تحسين تفاعل الأيقونات مع الحقول
        document.querySelectorAll('.form-input').forEach(input => {
            const wrapper = input.closest('.form-input-wrapper');
            const icon = wrapper.querySelector('.form-input-icon');
            
            if (icon) {
                // عند التركيز
                input.addEventListener('focus', () => {
                    icon.style.color = 'var(--primary-green)';
                    icon.style.transform = 'translateY(-50%) scale(1.1)';
                });
                
                // عند فقدان التركيز
                input.addEventListener('blur', () => {
                    if (!input.classList.contains('is-valid') && !input.classList.contains('is-invalid')) {
                        icon.style.color = '#666666';
                        icon.style.transform = 'translateY(-50%) scale(1)';
                    }
                });
            }
        });
    });
    </script>
</body>
</html>