<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - منصة توافق | الشراكة الاستراتيجية</title>
    
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
        --gradient-background: linear-gradient(135deg, var(--primary-darkest) 0%, var(--primary-darker) 100%);
        --shadow-sm: 0 2px 8px rgba(0, 69, 109, 0.08);
        --shadow-md: 0 6px 20px rgba(0, 60, 109, 0.12);
        --shadow-lg: 0 12px 40px rgba(0, 65, 109, 0.15);
        --shadow-xl: 0 25px 65px rgba(0, 74, 109, 0.18);
        --font-main: 'Neo Sans Arabic', 'Segoe UI', Tahoma, Arial, sans-serif;
        --border-radius-sm: 12px;
        --border-radius-md: 20px;
        --border-radius-lg: 28px;
        --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-medium: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
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
        background: var(--gradient-background);
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
    }

    .auth-container {
        width: 100%;
        max-width: 1400px;
        background: var(--pure-white);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        min-height: 700px;
        display: flex;
    }

    .auth-brand-panel {
        flex: 1;
        background: var(--gradient-background);
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
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.05) 100%);
        pointer-events: none;
    }

    .brand-content {
        position: relative;
        z-index: 2;
    }

    .brand-title {
        font-size: 2.8rem;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 1.5rem;
        background: linear-gradient(45deg, #ffffff, rgba(255, 255, 255, 0.8));
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
    }

    .brand-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .brand-stat {
        text-align: center;
    }

    .brand-stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--pure-white);
        margin-bottom: 0.25rem;
    }

    .brand-stat-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .brand-copyright {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.6);
        text-align: center;
    }

    .auth-form-panel {
        flex: 1.3;
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
        width: 50px;
        height: 50px;
        background: var(--grey-100);
        border: 2px solid var(--grey-300);
        border-radius: 50%;
        color: var(--grey-700);
        font-size: 1.2rem;
        cursor: pointer;
        transition: var(--transition-fast);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        text-decoration: none;
    }

    .back-to-selection:hover {
        background: var(--primary-green);
        color: var(--pure-white);
        border-color: var(--primary-green);
        transform: scale(1.05);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .auth-title {
        font-size: 2.8rem;
        font-weight: 600;
        color: var(--grey-900);
        margin-bottom: 0.75rem;
        line-height: 1.2;
    }

    .auth-subtitle {
        font-size: 1.2rem;
        color: var(--grey-500);
        line-height: 1.6;
    }

    .form-group {
        position: relative;
        margin-bottom: 2rem;
    }

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
        border: 2px solid var(--grey-300);
        border-radius: var(--border-radius-sm);
        font-family: var(--font-main);
        font-size: 1.1rem;
        transition: var(--transition-fast);
        background: var(--grey-50);
        color: var(--grey-700);
        outline: none;
        direction: rtl;
        text-align: right;
    }

    .form-input:focus {
        border-color: var(--primary-green);
        background: var(--pure-white);
        box-shadow: 0 0 0 4px rgba(0, 109, 70, 0.1);
    }

    .form-input.is-valid {
        border-color: var(--success-green);
        background: #f8fff9;
    }

    .form-input.is-invalid {
        border-color: var(--accent-red);
        background: #fff8f8;
    }

    .form-input-icon {
        position: absolute;
        top: 50%;
        right: 1.25rem;
        transform: translateY(-50%);
        color: var(--grey-500);
        font-size: 1.1rem;
        pointer-events: none;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        left: 1.25rem;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--grey-500);
        font-size: 1.1rem;
        padding: 0.5rem;
        border-radius: var(--border-radius-sm);
        transition: var(--transition-fast);
    }

    .password-toggle:hover {
        color: var(--primary-green);
        background: rgba(0, 109, 70, 0.05);
    }

    .form-error-message {
        display: none;
        margin-top: 0.75rem;
        font-size: 0.9rem;
        color: var(--accent-red);
        font-weight: 500;
        text-align: right;
    }

    .form-input.is-invalid ~ .form-error-message {
        display: block;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-green);
    }

    .remember-me label {
        font-size: 0.95rem;
        color: var(--grey-600);
        cursor: pointer;
    }

    .forgot-password {
        color: var(--primary-green);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        transition: var(--transition-fast);
    }

    .forgot-password:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .form-actions {
        margin-top: 2rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1.25rem 2.5rem;
        border-radius: var(--border-radius-sm);
        font-family: var(--font-main);
        font-weight: 500;
        font-size: 1.1rem;
        border: 2px solid transparent;
        cursor: pointer;
        transition: var(--transition-medium);
        text-decoration: none;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .btn-primary {
        background: var(--gradient-primary);
        color: var(--pure-white);
        border-color: var(--primary-green);
    }

    .btn-primary:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        background: var(--primary-dark);
    }

    .btn-primary:disabled {
        background: var(--grey-400);
        border-color: var(--grey-400);
        cursor: not-allowed;
        opacity: 0.7;
    }

    .divider {
        text-align: center;
        margin: 2rem 0;
        position: relative;
        color: var(--grey-500);
        font-size: 0.9rem;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        right: 0;
        left: 0;
        height: 1px;
        background: var(--grey-300);
        z-index: 1;
    }

    .divider span {
        background: var(--pure-white);
        padding: 0 1rem;
        position: relative;
        z-index: 2;
    }

    .register-options {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .register-option {
        flex: 1;
        min-width: 200px;
    }

    .btn-secondary {
        background: var(--grey-100);
        color: var(--grey-700);
        border-color: var(--grey-300);
        width: 100%;
    }

    .btn-secondary:hover {
        background: var(--grey-200);
        transform: translateY(-1px);
    }

    .login-link {
        text-align: center;
        margin-top: 2rem;
        color: var(--grey-600);
    }

    .login-link a {
        color: var(--primary-green);
        text-decoration: none;
        font-weight: 600;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 992px) {
        .auth-container {
            flex-direction: column;
            min-height: auto;
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
        
        .form-options {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .register-options {
            flex-direction: column;
        }
        
        .register-option {
            min-width: auto;
        }
    }

    @media (max-width: 480px) {
        .auth-container {
            border-radius: 0;
            min-height: 100vh;
        }
        
        .auth-form-panel {
            padding: 1.5rem;
        }
        
        .auth-title {
            font-size: 2.2rem;
        }
    }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- اللوحة الجانبية -->
        <div class="auth-brand-panel">
            <div class="brand-content">
                <h2 class="brand-title">منصة توافق ترحب بكم</h2>
                <p class="brand-description">
                    انضم إلى المنصة الرائدة للشراكة الاستراتيجية بين الموظفين والشركات، واكتشف فرص وظيفية لا محدودة.
                </p>
            </div>
            
            <div class="brand-footer">
                <div class="brand-stats">
                    <div class="brand-stat">
                        <div class="brand-stat-value">1200+</div>
                        <div class="brand-stat-label">شركة مسجلة</div>
                    </div>
                    <div class="brand-stat">
                        <div class="brand-stat-value">24B</div>
                        <div class="brand-stat-label">ريال توظيف</div>
                    </div>
                    <div class="brand-stat">
                        <div class="brand-stat-value">99.7%</div>
                        <div class="brand-stat-label">معدل الرضا</div>
                    </div>
                </div>
                <div class="brand-copyright">
                    &copy; 2025 منصة توافق في المملكة العربية السعودية - جميع الحقوق محفوظة
                </div>
            </div>
        </div>

        <!-- لوحة النموذج -->
        <div class="auth-form-panel">
            <!-- زر العودة للاختيار -->
            <a href="{{ route('welcome') }}" class="back-to-selection" aria-label="العودة للصفحة الرئيسية">
                <i class="fas fa-arrow-right"></i>
            </a>

            <div class="auth-header">
                <h1 class="auth-title">تسجيل الدخول</h1>
                <p class="auth-subtitle">مرحباً بك مرة أخرى في منصة توافق</p>
            </div>

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                
                <div class="form-group">
                    <label class="form-label required" for="email">البريد الإلكتروني</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <div class="form-error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label required" for="password">كلمة المرور</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" placeholder="كلمة المرور" required>
                        <button type="button" class="password-toggle" aria-label="إظهار/إخفاء كلمة المرور">
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
                        <label for="remember">تذكرني</label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i>
                        تسجيل الدخول
                    </button>
                </div>
            </form>

            <div class="divider">
                <span>أو</span>
            </div>

            <div class="register-options">
                <div class="register-option">
                    <a href="{{ route('employee.register') }}" class="btn btn-secondary">
                        <i class="fas fa-user-plus"></i>
                        تسجيل حساب جديد للأفراد
                    </a>
                </div>
                
                <div class="register-option">
                    <a href="{{ route('company.register') }}" class="btn btn-secondary">
                        <i class="fas fa-building"></i>
                        تسجيل حساب جديد للشركات
                    </a>
                </div>
            </div>

            <div class="login-link">
                <p>لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // تبديل إظهار كلمة المرور
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const input = toggle.previousElementSibling;
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
    });
    </script>
</body>
</html>
