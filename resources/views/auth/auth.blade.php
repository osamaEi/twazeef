<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.company_login.page_title') }}</title>
    
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
        
        --shadow-light: 0 2px 10px rgba(0, 60, 109, 0.08);
        --shadow-medium: 0 4px 20px rgba(0, 60, 109, 0.12);
        --shadow-heavy: 0 8px 40px rgba(0, 60, 109, 0.15);
        
        --font-main: 'Neo Sans Arabic', 'Segoe UI', Tahoma, Arial, sans-serif;
        --border-radius: 24px;
        --border-radius-sm: 16px;
        
        --transition: all 0.3s ease;
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
        background: linear-gradient(135deg, #ffffff 0%, #f8fafe 100%);
        color: var(--grey-700); 
        line-height: 1.6; 
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        direction: rtl;
    }

    /* Header العلوي */
    .auth-header-top {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
        color: var(--pure-white);
        padding: 2rem 0;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        animation: slideDown 0.8s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .auth-header-top::before {
        content: '';
        position: absolute;
        top: 0;
        right: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        animation: headerScan 4s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes headerScan {
        0% { right: -100%; }
        50% { right: 100%; }
        100% { right: -100%; }
    }

    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .header-brand {
        flex: 1;
    }

    .header-brand-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .header-brand-description {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 400px;
    }

    .header-stats {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .header-stat {
        text-align: center;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius-sm);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: var(--transition);
        min-width: 80px;
    }

    .header-stat:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 0.15);
    }

    .header-stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        display: block;
    }

    .header-stat-label {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 500;
    }

    /* Main Container */
    .main-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 0 2rem 3rem;
    }

    .auth-form-container {
        background: var(--pure-white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-heavy);
        padding: 3rem;
        border: 1px solid rgba(0, 60, 109, 0.1);
        animation: fadeInUp 0.8s ease-out 0.3s both;
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

    .auth-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .auth-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--grey-900);
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .auth-subtitle {
        font-size: 1rem;
        color: var(--grey-500);
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s ease-out calc(0.5s + var(--delay, 0s)) both;
    }

    .form-group:nth-child(1) { --delay: 0.1s; }
    .form-group:nth-child(2) { --delay: 0.2s; }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--grey-700);
        margin-bottom: 0.75rem;
        font-size: 1rem;
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
        transition: var(--transition);
        background: var(--pure-white);
        color: var(--grey-700);
        outline: none;
        direction: rtl;
        text-align: right;
        box-shadow: var(--shadow-light);
    }

    .form-input:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 4px rgba(0, 60, 109, 0.1), var(--shadow-medium);
        transform: translateY(-2px);
    }

    .form-input-icon {
        position: absolute;
        top: 50%;
        right: 1.25rem;
        transform: translateY(-50%);
        color: var(--grey-400);
        font-size: 1.1rem;
        pointer-events: none;
        transition: var(--transition);
    }

    .form-input:focus ~ .form-input-icon {
        color: var(--primary-green);
        transform: translateY(-50%) scale(1.1);
    }

    .form-input.is-valid ~ .form-input-icon {
        color: var(--success-green);
    }

    .form-input.is-invalid ~ .form-input-icon {
        color: var(--accent-red);
    }

    .form-input.is-valid {
        border-color: var(--success-green);
        background: rgba(76, 175, 80, 0.05);
    }

    .form-input.is-invalid {
        border-color: var(--accent-red);
        background: rgba(211, 47, 47, 0.05);
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        left: 1.25rem;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--grey-400);
        font-size: 1.1rem;
        padding: 0.5rem;
        border-radius: 50%;
        transition: var(--transition);
    }

    .password-toggle:hover {
        color: var(--primary-green);
        background: rgba(0, 60, 109, 0.1);
        transform: translateY(-50%) scale(1.1);
    }

    .form-input:focus ~ .password-toggle {
        color: var(--primary-green);
    }

    .form-error-message {
        display: none;
        margin-top: 0.75rem;
        font-size: 0.9rem;
        color: var(--accent-red);
        font-weight: 500;
        text-align: right;
        padding: 0.5rem 0.75rem;
        background: rgba(211, 47, 47, 0.05);
        border-radius: var(--border-radius-sm);
        border-right: 3px solid var(--accent-red);
    }

    .form-input.is-invalid ~ .form-error-message {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
        animation: fadeInUp 0.6s ease-out 0.8s both;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        transition: var(--transition);
        padding: 0.5rem;
        border-radius: var(--border-radius-sm);
    }

    .remember-me:hover {
        background: var(--grey-50);
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-green);
        cursor: pointer;
    }

    .remember-me label {
        font-size: 0.95rem;
        color: var(--grey-600);
        cursor: pointer;
        font-weight: 500;
    }

    .forgot-password {
        color: var(--primary-green);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        transition: var(--transition);
        padding: 0.5rem;
        border-radius: var(--border-radius-sm);
    }

    .forgot-password:hover {
        background: rgba(0, 60, 109, 0.05);
        transform: translateY(-1px);
    }

    .form-actions {
        margin-top: 1rem;
        animation: fadeInUp 0.6s ease-out 1s both;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1.25rem 2rem;
        border-radius: var(--border-radius-sm);
        font-family: var(--font-main);
        font-weight: 600;
        font-size: 1.1rem;
        border: 2px solid transparent;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        width: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
        color: var(--pure-white);
        border-color: var(--primary-green);
        box-shadow: var(--shadow-medium);
    }

    .btn-primary:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: var(--shadow-heavy);
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
    }

    .login-link {
        text-align: center;
        margin-top: 2rem;
        color: var(--grey-600);
        animation: fadeIn 0.6s ease-out 1.2s both;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .login-link a {
        color: var(--primary-green);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        padding: 0.25rem 0.5rem;
        border-radius: var(--border-radius-sm);
    }

    .login-link a:hover {
        background: rgba(0, 60, 109, 0.05);
        transform: translateY(-1px);
    }

    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        margin-bottom: 2rem;
        border-radius: var(--border-radius-sm);
        font-size: 0.95rem;
        font-weight: 500;
        animation: slideDown 0.5s ease-out;
    }

    .alert-danger {
        background: rgba(211, 47, 47, 0.1);
        color: var(--accent-red);
        border: 1px solid rgba(211, 47, 47, 0.2);
        border-right: 4px solid var(--accent-red);
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

    /* Footer بسيط */
    .auth-footer {
        text-align: center;
        padding: 2rem;
        color: var(--grey-500);
        font-size: 0.9rem;
        animation: fadeIn 0.8s ease-out 1.4s both;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1.5rem;
            text-align: center;
        }

        .header-stats {
            gap: 1rem;
        }

        .header-stat {
            padding: 0.5rem;
            min-width: 60px;
        }

        .header-stat-value {
            font-size: 1.2rem;
        }

        .header-stat-label {
            font-size: 0.7rem;
        }

        .header-brand-title {
            font-size: 1.8rem;
        }

        .header-brand-description {
            font-size: 0.9rem;
        }

        .main-container {
            padding: 0 1rem 2rem;
        }

        .auth-form-container {
            padding: 2rem;
        }
    }

    @media (max-width: 480px) {
        .auth-header-top {
            padding: 1.5rem 0;
        }

        .header-content {
            padding: 0 1rem;
        }

        .header-stats {
            flex-wrap: wrap;
            justify-content: center;
        }

        .main-container {
            padding: 0 1rem 1.5rem;
        }

        .auth-form-container {
            padding: 1.5rem;
        }

        .auth-title {
            font-size: 1.8rem;
        }

        .form-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 1.5rem;
        }
    }
    </style>
</head>
<body>
    <!-- Header العلوي -->
    <div class="auth-header-top">
        <div class="header-content">
            <div class="header-brand">
                <h2 class="header-brand-title">{{ __('auth.company_login.brand_title') }}</h2>
                <p class="header-brand-description">
                    {{ __('auth.company_login.brand_description') }}
                </p>
            </div>
            
            <div class="header-stats">
                <div class="header-stat">
                    <span class="header-stat-value">1200+</span>
                    <div class="header-stat-label">{{ __('auth.company_login.stats.companies') }}</div>
                </div>
                <div class="header-stat">
                    <span class="header-stat-value">24B</span>
                    <div class="header-stat-label">{{ __('auth.company_login.stats.employment') }}</div>
                </div>
                <div class="header-stat">
                    <span class="header-stat-value">99.7%</span>
                    <div class="header-stat-label">{{ __('auth.company_login.stats.satisfaction') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="auth-form-container">
            <div class="auth-header">
                <h1 class="auth-title">{{ __('auth.company_login.title') }}</h1>
                <p class="auth-subtitle">{{ __('auth.company_login.subtitle') }}</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
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

            <form method="POST" action="{{ route('company.login') }}" novalidate>
                @csrf
                
                <div class="form-group">
                    <label class="form-label required" for="email">{{ __('auth.company_login.email_label') }}</label>
                    <div class="form-input-wrapper">
                        <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" placeholder="{{ __('auth.company_login.email_placeholder') }}" value="{{ old('email') }}" required autofocus>
                        <i class="form-input-icon fas fa-envelope"></i>
                    </div>
                    @error('email')
                        <div class="form-error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required" for="password">{{ __('auth.company_login.password_label') }}</label>
                    <div class="form-input-wrapper">
                        <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" placeholder="{{ __('auth.company_login.password_placeholder') }}" required>
                        <i class="form-input-icon fas fa-lock"></i>
                        <button type="button" class="password-toggle" aria-label="{{ __('auth.company_login.password_toggle_label') }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="form-error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{ __('auth.company_login.remember_me') }}</label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            {{ __('auth.company_login.forgot_password') }}
                        </a>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        {{ __('auth.company_login.submit_button') }}
                    </button>
                </div>
            </form>

            <div class="login-link">
                <p>ليس لديك حساب؟ <a href="{{ route('company.register') }}">إنشاء حساب</a></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="auth-footer">
        {{ __('auth.company_login.copyright') }}
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // تبديل إظهار كلمة المرور
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const input = toggle.previousElementSibling.previousElementSibling;
                const icon = toggle.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

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
                        icon.style.color = 'var(--grey-400)';
                        icon.style.transform = 'translateY(-50%) scale(1)';
                    }
                });
            }
        });

        // Debug: Add form submission logging
        const loginForm = document.querySelector('form[action*="company/login"]');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                console.log('Company login form submitted');
                console.log('Form action:', this.action);
                console.log('Form method:', this.method);
                
                const formData = new FormData(this);
                console.log('Form data:');
                for (let [key, value] of formData.entries()) {
                    if (key !== 'password') {
                        console.log(key + ':', value);
                    } else {
                        console.log(key + ':', '[HIDDEN]');
                    }
                }
            });
        }
    });
    </script>
</body>
</html>