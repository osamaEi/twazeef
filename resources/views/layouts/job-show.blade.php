<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'تفاصيل الوظيفة | منصة توافق')</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏛️</text></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    @vite(['resources/css/app.css'])
    
    <style>
    /* --- 1. المتغيرات العامة والألوان --- */
    :root {
        /* الألوان الأساسية */
        --primary-green: #003c6d;
        --primary-light: #005085;
        --primary-lighter: #e8eff5;
        --primary-lightest: #f4f9fa;
        --primary-dark: #003655;
        --primary-darker: #003858;
        --primary-darkest: #00182b;

        /* تدرجات رمادية محايدة */
        --grey-900: #1a1a1a;
        --grey-800: #2c2c2c;
        --grey-700: #424242;
        --grey-500: #757575;
        --grey-300: #e0e0e0;
        --grey-100: #f5f5f5;
        --grey-50: #fafafa;
        --pure-white: #FFFFFF;

        /* التدرجات فقط */
        --gradient-primary: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
        --gradient-light: linear-gradient(135deg, var(--primary-light) 0%, #0067a3 100%);
        --gradient-dark: linear-gradient(135deg, var(--primary-darker) 0%, var(--primary-dark) 100%);
        
        --shadow-sm: 0 2px 8px rgba(0, 69, 109, 0.08);
        --shadow-md: 0 6px 20px rgba(0, 60, 109, 0.12);
        --shadow-lg: 0 12px 40px rgba(0, 65, 109, 0.15);
        --shadow-xl: 0 25px 65px rgba(0, 74, 109, 0.18);

        /* الخطوط */
        --font-main: 'Neo Sans Arabic', sans-serif;

        /* المتغيرات التقنية */
        --container-width: 1400px;
        --border-radius-sm: 12px;
        --border-radius-md: 20px;
        --border-radius-lg: 28px;
        --nav-height: 90px;
        --top-bar-height: 45px;
        
        /* الانتقالات */
        --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-medium: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        --transition-slow: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* --- 2. التهيئات الأساسية --- */
    *, *::before, *::after { 
        margin: 0; 
        padding: 0; 
        box-sizing: border-box; 
    }

    html { 
        scroll-behavior: smooth; 
        overflow-x: hidden; 
        font-size: 16px;
    }

    body { 
        font-family: var(--font-main); 
        background-color: var(--pure-white); 
        color: var(--grey-700); 
        line-height: 1.7; 
        font-size: 16px; 
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-feature-settings: "kern" 1, "liga" 1;
    }

    ::selection { 
        background-color: var(--primary-green); 
        color: var(--pure-white); 
    }

    ::-webkit-scrollbar { 
        width: 6px; 
        background: var(--grey-100); 
    }

    ::-webkit-scrollbar-thumb { 
        background: var(--gradient-primary); 
        border-radius: 6px;
        border: 2px solid var(--grey-100);
    }

    ::-webkit-scrollbar-thumb:hover { 
        background: var(--primary-dark); 
    }

    a { 
        text-decoration: none; 
        color: var(--primary-green); 
        transition: var(--transition-fast); 
    }

    a:hover { 
        color: var(--primary-dark); 
    }

    h1, h2, h3, h4, h5, h6 { 
        font-family: var(--font-main);
        font-weight: 500; 
        color: var(--primary-darker); 
        line-height: 1.3; 
        margin-bottom: 1rem;
        font-feature-settings: "kern" 1;
    }

    .container { 
        max-width: var(--container-width); 
        margin: 0 auto; 
        padding: 0 1.5rem;
        position: relative;
        width: 100%;
    }

    /* --- 3. الشريط العلوي --- */
    .gov-top-bar {
        background: rgb(245, 245, 245);
        backdrop-filter: blur(20px);
        font-size: 13px;
        padding: 8px 0;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1001;
        font-weight: 400;
    }

    .gov-top-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
        font-size: 14px;
        font-weight: 500;
    }

    .gov-left-info {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .gov-official-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--grey-700);
    }

    .gov-flag-icon {
        width: 20px;
        height: 15px;
        border-radius: 2px;
        border: 1px solid var(--grey-300);
    }

    .gov-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--grey-500);
    }

    .gov-date i {
        color: #000000;
        font-size: 16px;
    }

    .gov-date-mobile {
        display: none;
    }

    .beta-badge {
        background: #dfdfdf;
        color: #000000;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
    }

    /* --- 4. شريط التنقل --- */
    #navbar {
        position: fixed;
        top: 50px;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 1.2rem 0;
        background: rgb(255, 255, 255);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(0, 109, 70, 0.1);
        transition: var(--transition-medium);
    }

    #navbar.scrolled {
        padding: 1rem 0;
        background: rgba(255, 255, 255, 0.99);
        box-shadow: var(--shadow-md);
    }

    .nav-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--primary-darker);
        text-decoration: none;
    }

    .nav-menu {
        display: flex;
        align-items: center;
        gap: 2.5rem;
        list-style: none;
    }

    .nav-link {
        color: var(--grey-700);
        font-weight: 500;
        font-size: 1.1rem;
        padding: 0.75rem 0;
        position: relative;
        text-decoration: none;
        transition: var(--transition-fast);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 0;
        height: 3px;
        background: var(--gradient-primary);
        border-radius: 2px;
        transition: var(--transition-fast);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--primary-green);
        transform: translateY(-2px);
    }

    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        font-size: 2rem;
        color: var(--primary-green);
        cursor: pointer;
        z-index: 1002;
        padding: 0.5rem;
        border-radius: 8px;
        transition: var(--transition-fast);
    }

    .mobile-menu-btn:hover {
        background: rgba(0, 109, 70, 0.1);
    }

    /* --- 5. محتوى الصفحة --- */
    .page-content {
        padding-top: 140px;
        min-height: 100vh;
        background: var(--grey-50);
    }

    /* --- 6. عرض المشروع الرئيسي --- */
    .project-hero {
        background: var(--pure-white);
        padding: 3rem 0;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .project-hero-content {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 3rem;
        align-items: center;
    }

    .project-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-lg);
    }

    .project-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .project-category {
        background: var(--primary-lighter);
        color: var(--primary-green);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .project-id {
        color: var(--grey-500);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .project-title {
        font-size: 2.5rem;
        color: var(--primary-darker);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .project-summary {
        font-size: 1.2rem;
        color: var(--grey-700);
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .project-highlights {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .highlight-item {
        background: var(--grey-50);
        padding: 1.5rem;
        border-radius: var(--border-radius-md);
        text-align: center;
        border-top: 3px solid var(--primary-green);
    }

    .highlight-value {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--primary-green);
        margin-bottom: 0.5rem;
    }

    .highlight-label {
        font-size: 0.9rem;
        color: var(--grey-500);
        font-weight: 500;
    }

    /* --- 7. المحتوى الرئيسي --- */
    .main-content {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
        align-items: flex-start;
    }

    /* --- 8. منطقة التبويبات المحسنة --- */
    .tabs-section {
        background: var(--pure-white);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }

    .tabs-nav {
        display: flex;
        border-bottom: 1px solid var(--grey-100);
        background: var(--grey-50);
        padding: 0.5rem;
        gap: 0.5rem;
    }

    .tab-btn {
        flex: 1;
        padding: 1rem 1.5rem;
        background: transparent;
        border: none;
        font-family: var(--font-main);
        font-size: 1rem;
        font-weight: 500;
        color: var(--grey-500);
        cursor: pointer;
        transition: var(--transition-medium);
        position: relative;
        border-radius: var(--border-radius-sm);
        overflow: hidden;
    }

    .tab-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--gradient-primary);
        opacity: 0;
        transition: var(--transition-medium);
        z-index: 0;
    }

    .tab-btn span {
        position: relative;
        z-index: 1;
        transition: var(--transition-medium);
    }

    .tab-btn:hover:not(.active) {
        color: var(--primary-green);
        background: rgba(0, 65, 109, 0.08);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 60, 109, 0.15);
    }

    .tab-btn.active {
        color: var(--pure-white);
        background: var(--gradient-primary);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(0, 60, 109, 0.25);
    }

    .tab-btn:active {
        transform: translateY(0);
        transition: transform 0.1s ease;
    }

    .tab-btn.active::before {
        opacity: 1;
    }

    .tab-content {
        display: none;
        padding: 2.5rem;
        line-height: 1.7;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    .tab-content.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
        animation: fadeInUp 0.3s ease-out forwards;
    }

    .tab-content.fadeOut {
        opacity: 0;
        transform: translateY(-10px);
        animation: fadeOutDown 0.2s ease-in forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOutDown {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    .tab-content h3 {
        color: var(--primary-darker);
        margin-bottom: 1.5rem;
        font-size: 1.3rem;
    }

    .tab-content p {
        margin-bottom: 1.5rem;
    }

    .tab-content ul {
        list-style: none;
        padding-right: 1rem;
    }

    .tab-content li {
        margin-bottom: 1rem;
        padding-right: 1.5rem;
        position: relative;
    }

    .tab-content li::before {
        content: '\f058';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        color: var(--primary-green);
        position: absolute;
        right: 0;
        top: 0.2rem;
    }

    /* --- 9. الشريط الجانبي --- */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        position: sticky;
        top: 160px;
    }

    .sidebar-card {
        background: var(--pure-white);
        border-radius: var(--border-radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border-top: 4px solid var(--primary-green);
    }

    .sidebar-card h3 {
        color: var(--primary-darker);
        margin-bottom: 1.5rem;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.2rem 0;
        border-bottom: 1px solid var(--grey-100);
        transition: var(--transition-fast);
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-item:hover {
        background: var(--primary-lightest);
        margin: 0 -1rem;
        padding: 1.2rem 1rem;
        border-radius: var(--border-radius-sm);
    }

    .info-label {
        font-weight: 500;
        color: var(--grey-500);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .info-label i {
        color: var(--primary-green);
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }

    .info-value {
        font-weight: 600;
        color: var(--primary-darker);
    }

    .target-audience {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .audience-tag {
        background: var(--primary-lighter);
        color: var(--primary-green);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-lighter);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-green);
        flex-shrink: 0;
    }

    .contact-details {
        flex: 1;
    }

    .contact-label {
        font-size: 0.9rem;
        color: var(--grey-500);
        margin-bottom: 0.2rem;
    }

    .contact-value {
        font-weight: 600;
        color: var(--primary-darker);
    }

    /* --- 10. أزرار محسنة وعصرية --- */
    .apply-btn {
        width: 100%;
        padding: 1.8rem 1.5rem;
        background: var(--gradient-primary);
        color: var(--pure-white);
        border: none;
        border-radius: var(--border-radius-md);
        font-family: var(--font-main);
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-medium);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        box-shadow: 0 8px 25px rgba(0, 109, 70, 0.2);
        position: relative;
        overflow: hidden;
    }

    .apply-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease-in-out;
    }

    .apply-btn:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 15px 40px rgba(0, 109, 70, 0.3);
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-green) 100%);
    }

    .apply-btn:hover::before {
        left: 100%;
    }

    .apply-btn:active {
        transform: translateY(-2px) scale(1.01);
        transition: transform 0.1s ease;
    }

    .apply-btn i {
        font-size: 1.2rem;
        transition: var(--transition-fast);
    }

    .apply-btn:hover i {
        transform: rotate(15deg) scale(1.1);
    }

    /* تحسين الأزرار العامة */
    .btn-secondary {
        background: rgba(0, 109, 70, 0.1);
        color: var(--primary-green);
        border: 2px solid var(--primary-lighter);
        padding: 1rem 2rem;
        border-radius: var(--border-radius-md);
        font-family: var(--font-main);
        font-weight: 600;
        transition: var(--transition-medium);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .btn-secondary:hover {
        background: var(--primary-green);
        color: var(--pure-white);
        border-color: var(--primary-green);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 109, 70, 0.2);
    }

    /* --- 11. بطاقة التقدم --- */
    .progress-card {
        background: linear-gradient(135deg, var(--primary-lighter) 0%, #f0f9f5 100%);
        border: 2px solid var(--primary-light);
    }

    .progress-info {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .applications-count {
        font-size: 2rem;
        font-weight: 600;
        color: var(--primary-green);
        margin-bottom: 0.5rem;
    }

    .applications-label {
        color: var(--grey-500);
        font-weight: 500;
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: var(--pure-white);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .progress-fill {
        height: 100%;
        background: var(--gradient-primary);
        width: 65%;
        border-radius: 4px;
        transition: width 1s ease-out;
    }

    .progress-text {
        font-size: 0.9rem;
        color: var(--grey-500);
        text-align: center;
    }

    /* --- 12. الفوتر --- */
    footer {
        background: var(--primary-darkest);
        color: var(--pure-white);
        padding: 80px 0 0;
        margin-top: 4rem;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 3rem;
        margin-bottom: 3rem;
    }

    .footer-section h3 {
        color: var(--pure-white);
        margin-bottom: 1.5rem;
        font-size: 1.2rem;
    }

    .footer-links {
        list-style: none;
        display: grid;
        gap: 0.75rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: var(--transition-fast);
        text-decoration: none;
        font-size: 1rem;
    }

    .footer-links a:hover {
        color: var(--pure-white);
        transform: translateX(-5px);
    }

    .footer-bottom {
        border-top: 2px solid var(--primary-green);
        padding: 2rem 0;
        text-align: center;
        background: rgba(0, 0, 0, 0.2);
    }

    /* --- التجاوبية --- */
    @media (max-width: 992px) {
        .project-hero-content {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .main-content {
            grid-template-columns: 1fr;
        }

        .sidebar {
            position: static;
            margin-top: 2rem;
        }

        .project-highlights {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .gov-top-bar { position: relative; }
        #navbar { top: 0; }
        .page-content { padding-top: 100px; }
        
        .gov-top-content { 
            flex-direction: column; 
            gap: 0.5rem; 
            text-align: center; 
        }
        
        .gov-left-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
        }
        
        .gov-official-badge {
            width: 100%;
            justify-content: center;
        }
        
        .gov-left-info > .gov-date {
            display: none !important;
        }
        
        .gov-top-content > .beta-badge {
            display: none !important;
        }
        
        .gov-date-mobile {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 0.5rem;
        }
        
        .gov-date-mobile .gov-date {
            display: flex !important;
            align-items: center;
            gap: 0.5rem;
            color: var(--grey-500);
        }
        
        .gov-date-mobile .beta-badge {
            display: block !important;
            margin: 0;
        }
        
        .mobile-menu-btn { display: block; }
        
        .nav-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            max-width: 350px;
            height: 100vh;
            background: var(--pure-white);
            flex-direction: column;
            padding: 6rem 2rem 2rem;
            align-items: flex-start;
            gap: 2rem;
            box-shadow: -10px 0 30px rgba(0,0,0,0.1);
            transition: right 0.4s ease-in-out;
            z-index: 999;
        }
        
        .nav-menu.active { right: 0; }
        
        .tabs-nav {
            flex-direction: column;
        }
        
        .project-title {
            font-size: 2rem;
        }
        
        .project-highlights {
            grid-template-columns: 1fr;
        }
        
        .sidebar-card {
            padding: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .project-hero {
            padding: 2rem 0;
        }
        
        .sidebar-card {
            padding: 1rem;
        }
        
        .tab-content {
            padding: 1.5rem;
        }
    }
    </style>
</head>

<body>
    <!-- الشريط العلوي -->
    <div class="gov-top-bar">
        <div class="gov-top-content">
            <div class="gov-left-info">
                <div class="gov-official-badge">
                    <div class="gov-flag">
                        <img width="32" height="23" decoding="async" data-nimg="1" style="margin-right: -10px;margin-top: 5px;" src="https://my.gov.sa/_next/static/media/icon_saudi.b4b403e4.svg">
                    </div>
                    <span>موقع رسمي لمنصة توافق للبحث عن الوظائف في المملكة العربية والسعودية</span>
                </div>
                <div class="gov-date">
                    <i class="far fa-calendar-alt"></i>
                    <span>{{ now()->locale('ar')->isoFormat('dddd، D MMMM Y') }}</span>
                </div>
                <div class="gov-date-mobile">
                    <div class="gov-date">
                        <i class="far fa-calendar-alt"></i>
                        <span>{{ now()->locale('ar')->isoFormat('dddd، D MMMM Y') }}</span>
                    </div>
                    <div class="beta-badge">
                        نسخة تجريبية
                    </div>
                </div>
            </div>
            <div class="beta-badge">
                نسخة تجريبية
            </div>
        </div>
    </div>

    <!-- شريط التنقل -->
    <header id="navbar">
        <div class="container nav-container">
            <a href="{{ route('welcome') }}" class="nav-logo">
                <img src="{{ asset('elaf.png') }}" width="300" alt="منصة توافق">
            </a>
            
            <nav class="nav-menu" id="navMenu">
                <a href="{{ route('welcome') }}" class="nav-link">الرئيسية</a>
                <a href="#services" class="nav-link">الخدمات</a>
                <a href="#golden-opportunities" class="nav-link">الفرص الوظيفية</a>
                <a href="#success-stories" class="nav-link">النماذج الملهمة</a>
                <a href="#dashboard" class="nav-link">المؤشرات</a>
            </nav>

            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="القائمة">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main class="page-content">
        @yield('content')
    </main>

    <!-- الفوتر -->
    @include('components.footer')

    <!-- زر العودة للأعلى -->
    <button id="scrollTopBtn" style="position: fixed; bottom: 2rem; left: 2rem; width: 55px; height: 55px; background: var(--gradient-primary); color: var(--pure-white); border: none; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; cursor: pointer; z-index: 999; box-shadow: var(--shadow-lg); opacity: 0; visibility: hidden; transform: translateY(20px); transition: var(--transition-medium);" 
            onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            onmouseover="this.style.transform='translateY(0) scale(1.05)'" 
            onmouseout="this.style.transform='translateY(0) scale(1)'">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // === إدارة شريط التنقل ===
        const navbar = document.getElementById('navbar');
        const navMenu = document.getElementById('navMenu');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.querySelectorAll('.nav-link');
        const scrollTopBtn = document.getElementById('scrollTopBtn');

        // تأثير التمرير على شريط التنقل
        function handleNavbarScroll() {
            const isScrolled = window.scrollY > 100;
            if (navbar) navbar.classList.toggle('scrolled', isScrolled);
            if (scrollTopBtn) {
                if (isScrolled) {
                    scrollTopBtn.style.opacity = '1';
                    scrollTopBtn.style.visibility = 'visible';
                    scrollTopBtn.style.transform = 'translateY(0)';
                } else {
                    scrollTopBtn.style.opacity = '0';
                    scrollTopBtn.style.visibility = 'hidden';
                    scrollTopBtn.style.transform = 'translateY(20px)';
                }
            }
        }

        // استمع لحدث التمرير
        let ticking = false;
        function optimizedScroll() {
            if (!ticking) {
                requestAnimationFrame(() => {
                    handleNavbarScroll();
                    ticking = false;
                });
                ticking = true;
            }
        }
        window.addEventListener('scroll', optimizedScroll, { passive: true });

        // قائمة الهاتف المحمول
        if (mobileMenuBtn && navMenu) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                navMenu.classList.toggle('active');
                const icon = mobileMenuBtn.querySelector('i');
                if (icon) {
                    if (navMenu.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            });
        }

        // إغلاق القائمة
        function closeMenu() {
            if (navMenu && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                const icon = mobileMenuBtn?.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        }

        // إغلاق القائمة عند النقر على رابط أو خارج القائمة
        navLinks.forEach(link => link.addEventListener('click', closeMenu));
        document.addEventListener('click', (e) => {
            if (navMenu && !navMenu.contains(e.target) && !mobileMenuBtn?.contains(e.target)) {
                closeMenu();
            }
        });

        // === نظام التبويبات مع انيميشنز ===
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        function switchTab(targetTab) {
            // إخفاء المحتوى الحالي بانيميشن
            const currentActive = document.querySelector('.tab-content.active');
            if (currentActive) {
                currentActive.classList.add('fadeOut');
                
                setTimeout(() => {
                    // إزالة النشاط من جميع التبويبات والمحتوى
                    tabBtns.forEach(tab => tab.classList.remove('active'));
                    tabContents.forEach(content => {
                        content.classList.remove('active', 'fadeOut');
                    });
                    
                    // تفعيل التبويب الجديد
                    targetTab.classList.add('active');
                    const targetId = targetTab.dataset.tab;
                    const targetContent = document.getElementById(targetId);
                    if (targetContent) {
                        targetContent.classList.add('active');
                    }
                }, 200);
            } else {
                // الحالة الأولى بدون انيميشن إخفاء
                tabBtns.forEach(tab => tab.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                targetTab.classList.add('active');
                const targetId = targetTab.dataset.tab;
                const targetContent = document.getElementById(targetId);
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            }
        }

        // إضافة مستمعي الأحداث للتبويبات
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (!btn.classList.contains('active')) {
                    switchTab(btn);
                }
            });
        });

        // تفعيل التبويب الأول افتراضياً
        if (tabBtns.length > 0 && tabContents.length > 0) {
            const firstTab = tabBtns[0];
            const firstContent = tabContents[0];
            
            if (firstTab && firstContent) {
                firstTab.classList.add('active');
                firstContent.classList.add('active');
            }
        }

        // === وظائف التفاعل ===
        window.applyForProject = function() {
            const button = event.target;
            const originalText = button.innerHTML;
            
            // تأثير التحميل
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري المعالجة...';
            button.disabled = true;
            
            // محاكاة العملية
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-check"></i> تم إرسال الطلب بنجاح';
                button.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    button.style.background = '';
                }, 3000);
            }, 2000);
        };

        console.log('🎯 تم تحميل صفحة المشروع بنجاح');
    });
    </script>
</body>
</html>
