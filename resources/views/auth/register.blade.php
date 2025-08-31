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
        --transition-slow: all 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
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
        background: #f4faff;
        font-family: var(--font-main); 
        color: var(--grey-700); 
        line-height: 1.6; 
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        direction: rtl;
        position: relative;
        opacity: 0;
        animation: pageLoad 1.2s cubic-bezier(0.25, 0.8, 0.25, 1) forwards;
    }

    @keyframes pageLoad {
        0% {
            opacity: 0;
            transform: scale(0.95);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes floating {
        0%, 100% {
            transform: translateY(0px) scale(1);
            opacity: 0.04;
        }
        50% {
            transform: translateY(-30px) scale(1.1);
            opacity: 0.06;
        }
    }

    .main-container {
        width: 100%;
        text-align: center;
        padding: 2rem;
        opacity: 0;
        transform: translateY(50px);
        animation: containerSlideIn 1s cubic-bezier(0.25, 0.8, 0.25, 1) 0.3s forwards;
    }

    @keyframes containerSlideIn {
        0% {
            opacity: 0;
            transform: translateY(50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Logo and Header with enhanced animations */
    .logo-section {
        margin-bottom: 4rem;
        opacity: 0;
        transform: translateY(30px);
        animation: logoSlideIn 1s cubic-bezier(0.25, 0.8, 0.25, 1) 0.6s forwards;
    }

    @keyframes logoSlideIn {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
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
        position: relative;
        overflow: hidden;
        animation: logoIconPulse 2s ease-in-out infinite;
    }

    @keyframes logoIconPulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: var(--shadow-md);
        }
        50% {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }
    }

    .logo-icon::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.2) 50%, transparent 70%);
        transform: rotate(45deg);
        animation: logoShine 3s ease-in-out infinite;
    }

    @keyframes logoShine {
        0% {
            transform: rotate(45deg) translateX(-100%);
        }
        50% {
            transform: rotate(45deg) translateX(0%);
        }
        100% {
            transform: rotate(45deg) translateX(100%);
        }
    }

    .logo-text {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-blue);
        line-height: 1.2;
        background: linear-gradient(45deg, var(--primary-blue), var(--primary-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: textShimmer 4s ease-in-out infinite;
    }

    @keyframes textShimmer {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .platform-subtitle {
        font-size: 1.5rem;
        color: var(--primary-light);
        margin-bottom: 1rem;
        font-weight: 600;
        opacity: 0;
        transform: translateY(20px);
        animation: subtitleSlideIn 1s cubic-bezier(0.25, 0.8, 0.25, 1) 0.9s forwards;
    }

    @keyframes subtitleSlideIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .platform-description {
        font-size: 1.1rem;
        color: var(--grey-600);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
        opacity: 0;
        transform: translateY(20px);
        animation: descriptionSlideIn 1s cubic-bezier(0.25, 0.8, 0.25, 1) 1.1s forwards;
    }

    @keyframes descriptionSlideIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Selection Cards with staggered animations */
    .selection-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        max-width: 900px;
        margin: 0 auto 4rem auto;
    }

    .selection-card {
        background: #fff;
        border-radius: var(--border-radius-md);
        padding: 3rem 2rem;
        text-align: center;
        box-shadow: var(--shadow-lg);
        border-top: 4px solid var(--primary-blue);
        transition: var(--transition-slow);
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(60px) scale(0.9);
        animation-fill-mode: forwards;
    }

    .selection-card:nth-child(1) {
        animation: cardSlideIn 1s cubic-bezier(0.25, 0.8, 0.25, 1) 1.3s forwards;
    }

    .selection-card:nth-child(2) {
        animation: cardSlideIn 1s cubic-bezier(0.25, 0.8, 0.25, 1) 1.5s forwards;
    }

    @keyframes cardSlideIn {
        0% {
            opacity: 0;
            transform: translateY(60px) scale(0.9);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
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
        transition: var(--transition-slow);
    }

    .selection-card::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent 40%, rgba(255,255,255,0.1) 50%, transparent 60%);
        transform: rotate(45deg) translateX(-100%);
        transition: var(--transition-slow);
        pointer-events: none;
    }

    .selection-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: var(--shadow-xl);
        border-top-color: var(--primary-light);
    }

    .selection-card:hover::before {
        background: linear-gradient(135deg, transparent 0%, rgba(0, 60, 109, 0.08) 100%);
    }

    .selection-card:hover::after {
        transform: rotate(45deg) translateX(100%);
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
        transition: var(--transition-slow);
        position: relative;
        animation: iconFloat 3s ease-in-out infinite;
    }

    @keyframes iconFloat {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-5px);
        }
    }

    .selection-card:hover .card-icon {
        background: var(--primary-lighter);
        transform: scale(1.15) translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .card-icon i {
        font-size: 2.5rem;
        color: var(--primary-blue);
        transition: var(--transition-medium);
    }

    .selection-card:hover .card-icon i {
        color: var(--primary-dark);
        transform: scale(1.1);
    }

    .card-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 1rem;
        transition: var(--transition-medium);
    }

    .selection-card:hover .card-title {
        color: var(--primary-dark);
        transform: translateY(-2px);
    }

    .card-description {
        font-size: 1rem;
        color: var(--grey-600);
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
        transition: var(--transition-medium);
    }

    .selection-card:hover .card-description {
        color: var(--grey-700);
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
        transition: var(--transition-slow);
        cursor: pointer;
        min-width: 160px;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .card-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: var(--transition-medium);
    }

    .card-button:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .card-button:hover::before {
        width: 300px;
        height: 300px;
    }

    .card-button:active {
        transform: translateY(-1px);
    }

    .card-button i {
        font-size: 1.1rem;
        transition: var(--transition-medium);
    }

    .card-button:hover i {
        transform: translateX(-3px);
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

        .selection-card:nth-child(1) {
            animation-delay: 1.3s;
        }

        .selection-card:nth-child(2) {
            animation-delay: 1.6s;
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

    /* Loading animation for page transitions */
    .page-transition {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--gradient-primary);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.5s ease;
    }

    .page-transition.active {
        opacity: 1;
        pointer-events: all;
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
</head>
<body>
    <div class="page-transition" id="pageTransition">
        <div class="loading-spinner"></div>
    </div>

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
                المنصة الرسمية للتوظيف الاستراتيجي بين الشركات والأفراد
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
                <a href="{{ route('company.login') }}" class="card-button">
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
                <a href="{{ route('login') }}" class="card-button">
                    <i class="fas fa-arrow-left"></i>
                    دخول الأفراد
                </a>
            </div>
        </div>
    </div>

    <script>
        // Handle smooth page transitions
        function handleNavigation(event) {
            event.preventDefault();
            const link = event.currentTarget;
            const href = link.getAttribute('href');
            
            // Show transition overlay
            const transition = document.getElementById('pageTransition');
            transition.classList.add('active');
            
            // Navigate after animation
            setTimeout(() => {
                window.location.href = href;
            }, 800);
        }

        // Add enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.selection-card');
            
            cards.forEach((card, index) => {
                // Add mouse move effect
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / 10;
                    const rotateY = -(x - centerX) / 10;
                    
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-12px) scale(1.02)`;
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0) scale(1)';
                });

                // Add click ripple effect
                card.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    ripple.style.cssText = `
                        position: absolute;
                        background: rgba(0, 60, 109, 0.1);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        if (this.contains(ripple)) {
                            this.removeChild(ripple);
                        }
                    }, 600);
                });
            });

            // Add CSS for ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });

        // Parallax effect for background elements
        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            const bgBefore = document.querySelector('body::before');
            const bgAfter = document.querySelector('body::after');
            
            document.documentElement.style.setProperty('--mouse-x', mouseX);
            document.documentElement.style.setProperty('--mouse-y', mouseY);
        });

        // Add scroll-triggered animations for mobile
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.selection-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>