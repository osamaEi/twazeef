<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - منصة توافق | الشراكة الاستراتيجية</title>
    
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏛️</text></svg>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
    :root {
        --primary-blue: #003c6d;
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
        --gradient-primary: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-light) 100%);
        --gradient-background: linear-gradient(135deg, #f8fafc 0%, #e8eff5 100%);
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
        position: relative;
    }

    /* Background patterns */
    body::before,
    body::after {
        content: '';
        position: fixed;
        width: 300px;
        height: 300px;
        opacity: 0.03;
        z-index: -1;
    }

    body::before {
        top: -150px;
        left: -150px;
        background: radial-gradient(circle, var(--primary-blue) 0%, transparent 70%);
    }

    body::after {
        bottom: -150px;
        right: -150px;
        background: radial-gradient(circle, var(--primary-blue) 0%, transparent 70%);
    }

    .main-container {
        width: 100%;
        max-width: 1200px;
        text-align: center;
        padding: 2rem;
    }

    /* Logo and Header */
    .logo-section {
        margin-bottom: 4rem;
    }

    .logo {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .logo-icon {
        width: 60px;
        height: 60px;
        background: var(--gradient-primary);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pure-white);
        font-size: 2rem;
        box-shadow: var(--shadow-md);
    }

    .logo-text {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-blue);
        line-height: 1.2;
    }

    .platform-subtitle {
        font-size: 1.5rem;
        color: var(--primary-light);
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .platform-description {
        font-size: 1.1rem;
        color: var(--grey-600);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Selection Cards */
    .selection-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        max-width: 900px;
        margin: 0 auto 4rem auto;
    }

    .selection-card {
        background: var(--pure-white);
        border-radius: var(--border-radius-md);
        padding: 3rem 2rem;
        text-align: center;
        box-shadow: var(--shadow-lg);
        border-top: 4px solid var(--primary-blue);
        transition: var(--transition-medium);
        position: relative;
        overflow: hidden;
    }

    .selection-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, transparent 0%, rgba(0, 60, 109, 0.02) 100%);
        pointer-events: none;
        transition: var(--transition-medium);
    }

    .selection-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }

    .selection-card:hover::before {
        background: linear-gradient(135deg, transparent 0%, rgba(0, 60, 109, 0.05) 100%);
    }

    .card-icon {
        width: 80px;
        height: 80px;
        background: var(--grey-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem auto;
        transition: var(--transition-medium);
    }

    .selection-card:hover .card-icon {
        background: var(--primary-lighter);
        transform: scale(1.1);
    }

    .card-icon i {
        font-size: 2.5rem;
        color: var(--primary-blue);
    }

    .card-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 1rem;
    }

    .card-description {
        font-size: 1rem;
        color: var(--grey-600);
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    .card-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: var(--gradient-primary);
        color: var(--pure-white);
        border: none;
        border-radius: var(--border-radius-sm);
        font-family: var(--font-main);
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: var(--transition-medium);
        cursor: pointer;
        min-width: 160px;
        justify-content: center;
    }

    .card-button:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .card-button i {
        font-size: 1.1rem;
    }

    /* Login Section */
    .login-section {
        text-align: center;
        padding-top: 2rem;
        border-top: 1px solid var(--grey-200);
        max-width: 400px;
        margin: 0 auto;
    }

    .login-text {
        color: var(--grey-600);
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .login-link {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition-fast);
        font-size: 1.1rem;
    }

    .login-link:hover {
        text-decoration: underline;
        color: var(--primary-dark);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }
        
        .main-container {
            padding: 1rem;
        }
        
        .logo-text {
            font-size: 2.5rem;
        }
        
        .platform-subtitle {
            font-size: 1.3rem;
        }
        
        .selection-container {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .selection-card {
            padding: 2rem 1.5rem;
        }
        
        .card-title {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 480px) {
        .logo {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .logo-text {
            font-size: 2rem;
        }
        
        .platform-subtitle {
            font-size: 1.2rem;
        }
        
        .selection-card {
            padding: 1.5rem 1rem;
        }
        
        .card-button {
            min-width: 140px;
            padding: 0.875rem 1.5rem;
        }
    }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Logo and Header Section -->
        <div class="logo-section">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="logo-text">منصة توافق</div>
            </div>
            
            <h1 class="platform-subtitle">الشراكة الاستراتيجية</h1>
            <p class="platform-description">
                المنصة الرسمية للتوظيف الاستراتيجية بين الشركات والأفراد
            </p>
        </div>

        <!-- Selection Cards -->
        <div class="selection-container">
            <!-- Company Card -->
            <div class="selection-card">
                <div class="card-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h2 class="card-title">للشركات</h2>
                <p class="card-description">
                    منصة خاصة بالشركات والجهات لنشر الوظائف والفرص المتاحة للكوادر المتميزة
                </p>
                <a href="{{ route('company.register') }}" class="card-button">
                    <i class="fas fa-arrow-left"></i>
                    دخول الشركات
                </a>
            </div>

            <!-- Individual Card -->
            <div class="selection-card">
                <div class="card-icon">
                    <i class="fas fa-user"></i>
                </div>
                <h2 class="card-title">للأفراد</h2>
                <p class="card-description">
                    منصة مخصصة للأفراد والباحثين عن عمل للتقديم على أفضل الفرص الوظيفية المتاحة
                </p>
                <a href="{{ route('employee.register') }}" class="card-button">
                    <i class="fas fa-arrow-left"></i>
                    دخول الأفراد
                </a>
            </div>
        </div>

        <!-- Login Section -->
        <div class="login-section">
            <p class="login-text">لديك حساب بالفعل؟</p>
            <a href="{{ route('login') }}" class="login-link">تسجيل الدخول</a>
        </div>
    </div>
</body>
</html>
