<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تسجيل الشركات - منصة توافق</title>
    
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏛️</text></svg>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>

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
        --grey-600: #616161;
        --grey-500: #757575;
        --grey-400: #9e9e9e;
        --grey-300: #e0e0e0;
        --grey-200: #eeeeee;
        --grey-100: #f5f5f5;
        --grey-50: #fafafa;
        --pure-white: #FFFFFF;

        /* ألوان حالة */
        --accent-red: #d32f2f;
        --accent-orange: #ff9800;
        --success-green: #4caf50;
        --info-blue: #2196f3;
        --warning-yellow: #ffc107;

        /* التدرجات */
        --gradient-primary: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
        --gradient-light: linear-gradient(135deg, var(--primary-light) 0%, #0067a3 100%);
        --gradient-background: linear-gradient(135deg, var(--primary-darkest) 0%, var(--primary-darker) 100%);
        
        /* الظلال */
        --shadow-sm: 0 2px 8px rgba(0, 69, 109, 0.08);
        --shadow-md: 0 6px 20px rgba(0, 60, 109, 0.12);
        --shadow-lg: 0 12px 40px rgba(0, 65, 109, 0.15);
        --shadow-xl: 0 25px 65px rgba(0, 74, 109, 0.18);

        /* الخطوط */
        --font-main: 'Neo Sans Arabic', 'Segoe UI', Tahoma, Arial, sans-serif;

        /* المتغيرات التقنية */
        --border-radius-sm: 12px;
        --border-radius-md: 20px;
        --border-radius-lg: 28px;
        
        /* الانتقالات */
        --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-medium: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        --transition-slow: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* === التهيئات الأساسية مع دعم RTL كامل === */
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
        background: linear-gradient(135deg, #fafafa 0%, #f0f9f6 100%);
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

    ::selection { 
        background-color: var(--primary-green); 
        color: var(--pure-white); 
    }

    /* === الحاوي الرئيسي === */
    .main-container {
        width: 100%;
        max-width: 1200px;
        background: var(--pure-white);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        position: relative;
        min-height: 800px;
        display: flex;
        flex-direction: column;
        animation: slideInScale 1s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideInScale {
        0% {
            opacity: 0;
            transform: scale(0.95) translateY(40px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* === رأس الصفحة === */
    .page-header {
        background: var(--gradient-background);
        color: var(--pure-white);
        padding: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 40%),
            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .header-logo {
        margin-bottom: 2rem;
        animation: fadeInUp 0.8s ease-out;
    }

    .header-title {
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        font-weight: 700;
        margin-bottom: 1rem;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .header-subtitle {
        font-size: clamp(1.1rem, 2.5vw, 1.4rem);
        color: rgba(255, 255, 255, 0.9);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
        animation: fadeInUp 0.8s ease-out 0.4s both;
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

    /* === محتوى الصفحة === */
    .page-content {
        flex: 1;
        padding: 3rem 4rem;
        position: relative;
    }

    /* === صفحة الشروط والأحكام === */
    .terms-section {
        display: block;
        animation: slideInUp 0.6s ease-out 0.6s both;
    }

    .terms-section.hidden {
        display: none;
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--grey-900);
        margin-bottom: 2rem;
        text-align: center;
    }

    .terms-content {
        background: var(--primary-lightest);
        border: 2px solid var(--primary-lighter);
        border-radius: var(--border-radius-md);
        padding: 2.5rem;
        margin-bottom: 3rem;
        max-height: 450px;
        overflow-y: auto;
        direction: rtl;
    }

    .terms-content h3 {
        color: var(--primary-darker);
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-lighter);
    }

    .terms-content p {
        margin-bottom: 1.5rem;
        line-height: 1.8;
        font-size: 1.05rem;
        color: var(--grey-700);
    }

    .terms-content ul {
        margin: 1.5rem 0;
        padding-right: 2rem;
    }

    .terms-content li {
        margin-bottom: 0.75rem;
        line-height: 1.7;
        font-size: 1.05rem;
        color: var(--grey-700);
    }

    .terms-content li strong {
        color: var(--primary-darker);
        font-weight: 600;
    }

    .terms-checkbox {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 2rem;
        background: var(--pure-white);
        border: 2px solid var(--grey-300);
        border-radius: var(--border-radius-sm);
        transition: var(--transition-fast);
    }

    .terms-checkbox:hover {
        border-color: var(--primary-green);
        background: var(--primary-lightest);
    }

    .custom-checkbox {
        width: 24px;
        height: 24px;
        border: 2px solid var(--grey-400);
        border-radius: 6px;
        position: relative;
        transition: var(--transition-fast);
        flex-shrink: 0;
        margin-top: 0.25rem;
    }

    .custom-checkbox input {
        opacity: 0;
        position: absolute;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .custom-checkbox input:checked + .checkmark {
        background: var(--primary-green);
        border-color: var(--primary-green);
    }

    .custom-checkbox input:checked + .checkmark::after {
        opacity: 1;
        transform: translate(-50%, -50%) rotate(45deg) scale(1);
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 6px;
        transition: var(--transition-fast);
    }

    .checkmark::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(45deg) scale(0);
        width: 8px;
        height: 12px;
        border: solid var(--pure-white);
        border-width: 0 3px 3px 0;
        opacity: 0;
        transition: var(--transition-fast);
    }

    .checkbox-label {
        font-size: 1.1rem;
        line-height: 1.7;
        color: var(--grey-700);
        font-weight: 500;
        cursor: pointer;
    }

    .checkbox-label strong {
        color: var(--primary-darker);
        font-weight: 600;
    }

    /* === نموذج التسجيل === */
    .registration-section {
        display: none;
        animation: slideInUp 0.6s ease-out;
    }

    .registration-section.active {
        display: block;
    }

    /* === شريط التقدم === */
    .progress-container {
        margin-bottom: 3rem;
        animation: slideInUp 0.6s ease-out 0.2s both;
    }

    .progress-bar {
        width: 100%;
        height: 10px;
        background: var(--grey-200);
        border-radius: 5px;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: var(--gradient-primary);
        border-radius: 5px;
        width: 0%;
        transition: width 0.6s ease-out;
    }

    .steps-indicator {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        flex: 1;
        position: relative;
    }

    .step-item:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 18px;
        right: 50%;
        width: 100%;
        height: 4px;
        background: var(--grey-300);
        z-index: 1;
    }

    .step-item.completed:not(:last-child)::after {
        background: var(--primary-green);
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--grey-300);
        color: var(--grey-500);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        position: relative;
        z-index: 2;
        transition: var(--transition-fast);
    }

    .step-item.active .step-number {
        background: var(--primary-green);
        color: var(--pure-white);
        transform: scale(1.1);
    }

    .step-item.completed .step-number {
        background: var(--primary-green);
        color: var(--pure-white);
    }

    .step-item.completed .step-number::before {
        content: '✓';
        font-size: 1rem;
    }

    .step-label {
        font-size: 1rem;
        color: var(--grey-500);
        text-align: center;
        transition: var(--transition-fast);
        font-weight: 500;
        max-width: 120px;
    }

    .step-item.active .step-label,
    .step-item.completed .step-label {
        color: var(--primary-green);
        font-weight: 600;
    }

    /* === خطوات النموذج === */
    .form-step {
        display: none;
        opacity: 0;
        transform: translateY(20px);
        transition: var(--transition-medium);
    }

    .form-step.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .form-row.single {
        grid-template-columns: 1fr;
    }

    .form-row.triple {
        grid-template-columns: 1fr 1fr 1fr;
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
        font-weight: 700;
    }

    .form-input-wrapper {
        position: relative;
    }

    .form-input,
    .form-select,
    .form-textarea {
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
        resize: none;
        direction: rtl;
        text-align: right;
    }

    .form-textarea {
        min-height: 140px;
        padding-top: 1.25rem;
        padding-bottom: 1.25rem;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
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
        transition: var(--transition-fast);
    }

    .form-input:focus + .form-input-icon {
        color: var(--primary-green);
    }

    .form-error-message {
        display: none;
        margin-top: 0.75rem;
        font-size: 0.95rem;
        color: var(--accent-red);
        font-weight: 500;
        text-align: right;
    }

    .form-input.is-invalid ~ .form-error-message {
        display: block;
    }

    .form-success-message {
        display: none;
        margin-top: 0.75rem;
        font-size: 0.95rem;
        color: var(--success-green);
        font-weight: 500;
        text-align: right;
    }

    .form-input.is-valid ~ .form-success-message {
        display: block;
    }

    /* === رفع الملفات === */
    .file-upload-area {
        border: 3px dashed var(--grey-300);
        border-radius: var(--border-radius-sm);
        padding: 3rem;
        text-align: center;
        transition: var(--transition-fast);
        cursor: pointer;
        background: var(--grey-50);
        position: relative;
        overflow: hidden;
    }

    .file-upload-area:hover {
        border-color: var(--primary-green);
        background: var(--primary-lightest);
    }

    .file-upload-area.dragover {
        border-color: var(--primary-green);
        background: var(--primary-lightest);
        border-style: solid;
    }

    .file-upload-icon {
        font-size: 3.5rem;
        color: var(--grey-400);
        margin-bottom: 1.5rem;
        transition: var(--transition-fast);
    }

    .file-upload-area:hover .file-upload-icon {
        color: var(--primary-green);
        transform: scale(1.1);
    }

    .file-upload-text {
        font-size: 1.2rem;
        color: var(--grey-700);
        margin-bottom: 0.75rem;
        font-weight: 600;
    }

    .file-upload-hint {
        font-size: 1rem;
        color: var(--grey-500);
        line-height: 1.5;
    }

    .file-input {
        display: none;
    }

    .uploaded-files {
        margin-top: 1.5rem;
    }

    .uploaded-file {
        display: none;
        margin-bottom: 1rem;
        padding: 1.5rem;
        background: var(--primary-lightest);
        border-radius: var(--border-radius-sm);
        border: 2px solid var(--primary-lighter);
        animation: slideInUp 0.4s ease-out;
    }

    .uploaded-file.show {
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .file-icon {
        width: 50px;
        height: 50px;
        background: var(--primary-green);
        border-radius: var(--border-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pure-white);
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .file-info {
        flex: 1;
        text-align: right;
    }

    .file-name {
        font-weight: 600;
        color: var(--grey-700);
        margin-bottom: 0.25rem;
        font-size: 1.05rem;
    }

    .file-size {
        font-size: 0.95rem;
        color: var(--grey-500);
    }

    .file-remove {
        background: none;
        border: none;
        color: var(--accent-red);
        cursor: pointer;
        font-size: 1.4rem;
        padding: 0.75rem;
        border-radius: var(--border-radius-sm);
        transition: var(--transition-fast);
    }

    .file-remove:hover {
        background: rgba(211, 47, 47, 0.1);
        transform: scale(1.1);
    }

    /* === الأزرار === */
    /* تنسيق رسائل التنبيه */
    .alert {
        padding: 16px;
        margin: 20px 0;
        border-radius: 8px;
        border: 1px solid;
    }
    
    .alert-danger {
        background-color: #fef2f2;
        border-color: #fecaca;
        color: #dc2626;
    }
    
    .alert-success {
        background-color: #f0fdf4;
        border-color: #bbf7d0;
        color: #16a34a;
    }
    
    .alert ul {
        margin: 8px 0 0 0;
        padding-left: 20px;
    }
    
    .alert li {
        margin-bottom: 4px;
    }

    .form-actions {
        display: flex;
        gap: 1.5rem;
        margin-top: 3rem;
        justify-content: space-between;
        align-items: center;
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
        transition: var(--transition-medium);
        text-decoration: none;
        position: relative;
        overflow: hidden;
        min-width: 180px;
    }

    .btn-primary {
        background: var(--gradient-primary);
        color: var(--pure-white);
        border-color: var(--primary-green);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        background: var(--primary-dark);
    }

    .btn-primary:active {
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: var(--grey-100);
        color: var(--grey-700);
        border-color: var(--grey-300);
    }

    .btn-secondary:hover {
        background: var(--grey-200);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .btn-outline {
        background: transparent;
        color: var(--primary-green);
        border-color: var(--primary-green);
    }

    .btn-outline:hover {
        background: var(--primary-green);
        color: var(--pure-white);
    }

    .btn.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn.loading .btn-text {
        opacity: 0;
    }

    .btn.loading .spinner {
        display: block;
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    .spinner {
        display: none;
        position: absolute;
        width: 24px;
        height: 24px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top-color: var(--pure-white);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* === رسائل التأكيد === */
    .confirmation-section {
        display: none;
        text-align: center;
        padding: 3rem 2rem;
        animation: slideInUp 0.6s ease-out;
    }

    .confirmation-section.active {
        display: block;
    }

    .confirmation-icon {
        width: 120px;
        height: 120px;
        background: var(--primary-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        animation: successPop 0.6s ease-out 0.3s both;
    }

    .confirmation-icon i {
        font-size: 4rem;
        color: var(--pure-white);
    }

    @keyframes successPop {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .confirmation-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--grey-900);
        margin-bottom: 1.5rem;
        animation: slideInUp 0.5s ease-out 0.5s both;
    }

    .confirmation-message {
        font-size: 1.3rem;
        color: var(--grey-600);
        line-height: 1.7;
        margin-bottom: 3rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        animation: slideInUp 0.5s ease-out 0.7s both;
    }

    .confirmation-details {
        background: var(--primary-lightest);
        border: 2px solid var(--primary-lighter);
        border-radius: var(--border-radius-md);
        padding: 2.5rem;
        text-align: right;
        margin-bottom: 3rem;
        animation: slideInUp 0.5s ease-out 0.9s both;
    }

    .confirmation-details h3 {
        color: var(--primary-darker);
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .confirmation-details p {
        margin-bottom: 1rem;
        line-height: 1.7;
        font-size: 1.05rem;
        color: var(--grey-700);
    }

    .confirmation-details strong {
        color: var(--primary-darker);
        font-weight: 600;
    }

    /* === التصميم المتجاوب === */
    @media (max-width: 1200px) {
        .page-content {
            padding: 2.5rem 3rem;
        }
    }

    @media (max-width: 992px) {
        .main-container {
            margin: 1rem;
        }
        
        .page-header {
            padding: 2.5rem 2rem;
        }
        
        .page-content {
            padding: 2rem;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .form-row.triple {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }
        
        .page-header {
            padding: 2rem 1.5rem;
        }
        
        .page-content {
            padding: 1.5rem;
        }
        
        .terms-content {
            padding: 1.5rem;
            max-height: 350px;
        }
        
        .steps-indicator {
            padding: 0;
        }
        
        .step-label {
            display: none;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn {
            width: 100%;
        }
        
        .file-upload-area {
            padding: 2rem;
        }
        
        .file-upload-icon {
            font-size: 3rem;
        }
    }

    @media (max-width: 480px) {
        .main-container {
            border-radius: var(--border-radius-sm);
            margin: 0.5rem;
        }
        
        .page-header {
            padding: 1.5rem 1rem;
        }
        
        .page-content {
            padding: 1rem;
        }
        
        .header-title {
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .confirmation-title {
            font-size: 2rem;
        }
        
        .confirmation-icon {
            width: 100px;
            height: 100px;
        }
        
        .confirmation-icon i {
            font-size: 3.5rem;
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- رأس الصفحة -->
        <header class="page-header">
            <div class="header-content">
                <div class="header-logo">
                    <img src="elaf.png" width="300" alt="منصة توافق">
                </div>
                <h1 class="header-title">تسجيل الجهات والشركات</h1>
                <p class="header-subtitle">
                    الانضمام إلى المنصة الحكومية الرسمية للشراكة الاستراتيجية بين الموظف والشركة
                </p>
            </div>
        </header>

        <!-- محتوى الصفحة -->
        <main class="page-content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- قسم الشروط والأحكام -->
<section class="terms-section" id="termsSection">
    <h2 class="section-title">الشروط والأحكام للتسجيل</h2>
    
    <div class="terms-content">
        <h3><i class="fas fa-info-circle"></i> شروط التسجيل الأساسية</h3>
        <p>
            يحق فقط للشركات والمؤسسات المرخصة رسمياً التسجيل في منصة التوظيف 
            وفقاً للشروط والمعايير المحددة في هذه الوثيقة.
        </p>

        <h3><i class="fas fa-building"></i> الجهات المخولة بالتسجيل</h3>
        <ul>
            <li><strong>الشركات الخاصة:</strong> الشركات المرخصة والمسجلة رسمياً لدى الجهات المختصة</li>
            <li><strong>الشركات المساهمة أو المحدودة:</strong> بمختلف أشكالها القانونية شريطة توفر السجل التجاري والترخيص</li>
            <li><strong>المؤسسات الفردية:</strong> الحاصلة على سجل تجاري ورخصة مزاولة نشاط</li>
        </ul>

        <h3><i class="fas fa-file-contract"></i> المستندات المطلوبة</h3>
        <ul>
            <li><strong>للشركات والمؤسسات:</strong> السجل التجاري، رخصة النشاط، عقد التأسيس (إن وجد)، البيانات الضريبية</li>
            <li><strong>لجميع الجهات:</strong> صورة هوية الممثل المفوض، وكتاب التفويض الرسمي</li>
        </ul>

        <h3><i class="fas fa-shield-alt"></i> التزامات الجهة المسجلة</h3>
        <p>
            تلتزم الشركة المسجلة بتقديم معلومات دقيقة وحديثة حول الوظائف والفرص المتاحة، 
            والاستجابة لطلبات واستفسارات الباحثين عن عمل ضمن الإطار الزمني المحدد.
        </p>

        <h3><i class="fas fa-gavel"></i> الأحكام العامة</h3>
        <ul>
            <li>جميع البيانات المدخلة تخضع للمراجعة والتدقيق من قبل فريق المنصة</li>
            <li>يتم تفعيل الحساب خلال 3-5 أيام عمل بعد مراجعة المستندات</li>
            <li>الشركة مسؤولة عن دقة وحداثة المعلومات المنشورة على المنصة</li>
            <li>يحق لإدارة المنصة إيقاف أو إلغاء أي حساب يخالف الشروط المحددة</li>
            <li>جميع التعاملات والمراسلات تتم باللغتين العربية والإنجليزية</li>
        </ul>

        <h3><i class="fas fa-handshake"></i> أهداف المنصة</h3>
        <p>
            تهدف هذه المنصة إلى ربط الشركات بالكوادر البشرية المؤهلة، 
            وتسهيل عملية التوظيف وإيجاد فرص عمل مناسبة تسهم في دعم سوق العمل 
            وتعزيز التنمية الاقتصادية.
        </p>
    </div>

    <div class="terms-checkbox">
        <div class="custom-checkbox">
            <input type="checkbox" id="acceptTerms">
            <div class="checkmark"></div>
        </div>
        <label for="acceptTerms" class="checkbox-label">
            أقر بأنني قد قرأت وفهمت جميع الشروط والأحكام المذكورة أعلاه، 
            <strong>وأوافق على الالتزام بها بالكامل</strong>، وأتعهد بتقديم معلومات صحيحة ودقيقة، 
            وأفهم أن أي مخالفة لهذه الشروط قد تؤدي إلى إيقاف أو إلغاء حسابي على المنصة.
        </label>
    </div>

    <div class="form-actions">
        <div></div>
        <button type="button" class="btn btn-primary" id="proceedBtn" disabled>
            <span class="btn-text">
                متابعة التسجيل
                <i class="fas fa-arrow-left"></i>
            </span>
        </button>
    </div>
</section>


            <!-- قسم التسجيل -->
            <section class="registration-section" id="registrationSection">
                <!-- شريط التقدم -->
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    
                    <div class="steps-indicator">
                        <div class="step-item active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-label">بيانات الجهة</div>
                        </div>
                        <div class="step-item" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-label">بيانات المسؤول</div>
                        </div>
                        <div class="step-item" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-label">المستندات</div>
                        </div>
                        <div class="step-item" data-step="4">
                            <div class="step-number">4</div>
                            <div class="step-label">المراجعة</div>
                        </div>
                    </div>
                </div>

                <form id="registrationForm" method="POST" action="{{ route('company.register') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    
                    <!-- الخطوة الأولى: بيانات الجهة -->
                    <div class="form-step active" id="step1">
                        <h2 class="section-title">بيانات الجهة الأساسية</h2>
                        
                        <div class="form-row single">
                            <div class="form-group">
                                <label class="form-label required" for="entityType">نوع الجهة</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-building"></i>
                                    <select id="entityType" name="entityType" class="form-select" required>
                                        <option value="">اختر نوع الشركة</option>
                                        <option value="private-company">شركة خاصة</option>
                                        <option value="limited-company">شركة محدودة المسؤولية</option>
                                        <option value="joint-stock-company">شركة مساهمة</option>
                                        <option value="individual-establishment">مؤسسة فردية</option>
                                    </select>
                                </div>
                                <div class="form-error-message">الرجاء اختيار نوع الجهة</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="entityNameAr">اسم الجهة (عربي)</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-signature"></i>
                                    <input type="text" id="entityNameAr" name="entityNameAr" class="form-input" 
                                           placeholder="الاسم الكامل للجهة باللغة العربية" required>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="entityNameEn">اسم الجهة (إنجليزي)</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-signature"></i>
                                    <input type="text" id="entityNameEn" name="entityNameEn" class="form-input" 
                                           placeholder="Full Entity Name in English" required>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="licenseNumber">رقم الترخيص/التأسيس</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-certificate"></i>
                                    <input type="text" id="licenseNumber" name="licenseNumber" class="form-input" 
                                           placeholder="رقم الترخيص أو قرار التأسيس" required>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="establishmentDate">تاريخ التأسيس</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-calendar"></i>
                                    <input type="date" id="establishmentDate" name="establishmentDate" class="form-input" required>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="businessSector">القطاع</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-industry"></i>
                                    <select id="businessSector" name="businessSector" class="form-select" required>
                                        <option value="">اختر القطاع</option>
                                        <option value="energy">الطاقة والنفط والغاز</option>
                                        <option value="construction">البناء والتشييد</option>
                                        <option value="manufacturing">التصنيع</option>
                                        <option value="agriculture">الزراعة والغذاء</option>
                                        <option value="transportation">النقل واللوجستيات</option>
                                        <option value="telecommunications">الاتصالات وتقنية المعلومات</option>
                                        <option value="healthcare">الرعاية الصحية</option>
                                        <option value="education">التعليم والتدريب</option>
                                        <option value="tourism">السياحة والضيافة</option>
                                        <option value="finance">الخدمات المالية والمصرفية</option>
                                        <option value="real-estate">العقارات والتطوير العقاري</option>
                                        <option value="mining">التعدين والثروات المعدنية</option>
                                        <option value="water">المياه والصرف الصحي</option>
                                        <option value="environment">البيئة والطاقة المتجددة</option>
                                        <option value="other">أخرى</option>
                                    </select>
                                </div>
                                <div class="form-error-message">الرجاء اختيار القطاع</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="employeeCount">عدد الموظفين</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-users"></i>
                                    <select id="employeeCount" name="employeeCount" class="form-select" required>
                                        <option value="">اختر الفئة</option>
                                        <option value="1-50">1 - 50 موظف</option>
                                        <option value="51-200">51 - 200 موظف</option>
                                        <option value="201-500">201 - 500 موظف</option>
                                        <option value="501-1000">501 - 1000 موظف</option>
                                        <option value="1000+">أكثر من 1000 موظف</option>
                                    </select>
                                </div>
                                <div class="form-error-message">الرجاء اختيار فئة عدد الموظفين</div>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label class="form-label required" for="entityAddress">عنوان المقر الرئيسي</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-map-marker-alt"></i>
                                    <textarea id="entityAddress" name="entityAddress" class="form-textarea" 
                                              placeholder="العنوان الكامل للمقر الرئيسي..." required></textarea>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="entityPhone">الهاتف الرسمي</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-phone"></i>
                                    <input type="tel" id="entityPhone" name="entityPhone" class="form-input" 
                                           placeholder="+966 XX XXX XXXX" required>
                                </div>
                                <div class="form-error-message">الرجاء إدخال رقم هاتف صحيح</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="entityEmail">البريد الإلكتروني الرسمي</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-envelope"></i>
                                    <input type="email" id="entityEmail" name="entityEmail" class="form-input" 
                                           placeholder="info@entity.com.sa" required>
                                </div>
                                <div class="form-error-message">الرجاء إدخال بريد إلكتروني صحيح</div>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label class="form-label" for="entityDescription">نبذة عن الجهة ونشاطها</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-info-circle"></i>
                                    <textarea id="entityDescription" name="entityDescription" class="form-textarea" 
                                              placeholder="وصف مختصر عن الجهة ونشاطاتها الأساسية..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div></div>
                            <button type="button" class="btn btn-primary" id="nextStep1">
                                <span class="btn-text">
                                    التالي
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- الخطوة الثانية: بيانات المسؤول المخول -->
                    <div class="form-step" id="step2">
                        <h2 class="section-title">بيانات المسؤول المخول</h2>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="responsibleName">الاسم الكامل</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-user"></i>
                                    <input type="text" id="responsibleName" name="responsibleName" class="form-input" 
                                           placeholder="الاسم الثلاثي كاملاً" required>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="responsiblePosition">المنصب/الوظيفة</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-briefcase"></i>
                                    <input type="text" id="responsiblePosition" name="responsiblePosition" class="form-input" 
                                           placeholder="المنصب أو الوظيفة الحالية" required>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="responsibleID">رقم الهوية الشخصية</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-id-card"></i>
                                    <input type="text" id="responsibleID" name="responsibleID" class="form-input" 
                                           placeholder="رقم الهوية الشخصية" required>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="responsiblePhone">رقم الهاتف المحمول</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-mobile-alt"></i>
                                    <input type="tel" id="responsiblePhone" name="responsiblePhone" class="form-input" 
                                           placeholder="+966 9XX XXX XXX" required>
                                </div>
                                <div class="form-error-message">الرجاء إدخال رقم هاتف محمول صحيح</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="responsibleEmail">البريد الإلكتروني الشخصي</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-at"></i>
                                    <input type="email" id="responsibleEmail" name="responsibleEmail" class="form-input" 
                                           placeholder="البريد الإلكتروني الشخصي" required>
                                </div>
                                <div class="form-error-message">الرجاء إدخال بريد إلكتروني صحيح</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="responsibleDepartment">القسم/الإدارة</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-sitemap"></i>
                                    <input type="text" id="responsibleDepartment" name="responsibleDepartment" class="form-input" 
                                           placeholder="القسم أو الإدارة التابع لها" required>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label class="form-label required" for="authorizationScope">نطاق التفويض</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-key"></i>
                                    <textarea id="authorizationScope" name="authorizationScope" class="form-textarea" 
                                              placeholder="وصف الصلاحيات المفوضة للمسؤول في إدارة الحساب..." required></textarea>
                                </div>
                                <div class="form-error-message">هذا الحقل مطلوب</div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" id="prevStep2">
                                <i class="fas fa-arrow-right"></i>
                                السابق
                            </button>
                            <button type="button" class="btn btn-primary" id="nextStep2">
                                <span class="btn-text">
                                    التالي
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- الخطوة الثالثة: المستندات المطلوبة -->
                    <div class="form-step" id="step3">
                        <h2 class="section-title">المستندات المطلوبة</h2>
                        
                        <!-- الترخيص أو قرار التأسيس -->
                        <div class="form-group">
                            <label class="form-label required">الترخيص أو قرار التأسيس</label>
                            <div class="file-upload-area" id="licenseUpload">
                                <div class="file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="file-upload-text">اضغط لرفع الترخيص أو قرار التأسيس</div>
                                <div class="file-upload-hint">PDF, JPG, PNG - الحد الأقصى 10 ميجابايت</div>
                                <input type="file" id="licenseFile" name="licenseFile" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                            </div>
                            <div class="uploaded-files">
                                <div class="uploaded-file" id="licenseFileDisplay">
                                    <div class="file-icon"><i class="fas fa-file-pdf"></i></div>
                                    <div class="file-info">
                                        <div class="file-name" id="licenseFileName"></div>
                                        <div class="file-size" id="licenseFileSize"></div>
                                    </div>
                                    <button type="button" class="file-remove" id="licenseFileRemove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-error-message">الرجاء رفع الترخيص أو قرار التأسيس</div>
                        </div>

                        <!-- كتاب التفويض -->
                        <div class="form-group">
                            <label class="form-label required">كتاب التفويض الرسمي</label>
                            <div class="file-upload-area" id="authorizationUpload">
                                <div class="file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="file-upload-text">اضغط لرفع كتاب التفويض</div>
                                <div class="file-upload-hint">PDF, JPG, PNG - الحد الأقصى 10 ميجابايت</div>
                                <input type="file" id="authorizationFile" name="authorizationFile" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                            </div>
                            <div class="uploaded-files">
                                <div class="uploaded-file" id="authorizationFileDisplay">
                                    <div class="file-icon"><i class="fas fa-file-pdf"></i></div>
                                    <div class="file-info">
                                        <div class="file-name" id="authorizationFileName"></div>
                                        <div class="file-size" id="authorizationFileSize"></div>
                                    </div>
                                    <button type="button" class="file-remove" id="authorizationFileRemove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-error-message">الرجاء رفع كتاب التفويض الرسمي</div>
                        </div>

                        <!-- صورة هوية المسؤول -->
                        <div class="form-group">
                            <label class="form-label required">صورة هوية المسؤول المخول</label>
                            <div class="file-upload-area" id="idUpload">
                                <div class="file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="file-upload-text">اضغط لرفع صورة الهوية الشخصية</div>
                                <div class="file-upload-hint">JPG, PNG - الحد الأقصى 5 ميجابايت</div>
                                <input type="file" id="idFile" name="idFile" class="file-input" accept=".jpg,.jpeg,.png" required>
                            </div>
                            <div class="uploaded-files">
                                <div class="uploaded-file" id="idFileDisplay">
                                    <div class="file-icon"><i class="fas fa-file-image"></i></div>
                                    <div class="file-info">
                                        <div class="file-name" id="idFileName"></div>
                                        <div class="file-size" id="idFileSize"></div>
                                    </div>
                                    <button type="button" class="file-remove" id="idFileRemove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-error-message">الرجاء رفع صورة الهوية الشخصية</div>
                        </div>

                        <!-- مستندات إضافية (اختيارية) -->
                        <div class="form-group">
                            <label class="form-label">مستندات إضافية (اختيارية)</label>
                            <div class="file-upload-area" id="additionalUpload">
                                <div class="file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="file-upload-text">رفع مستندات إضافية (إن وجدت)</div>
                                <div class="file-upload-hint">PDF, JPG, PNG - يمكن رفع عدة ملفات - الحد الأقصى 10 ميجابايت لكل ملف</div>
                                <input type="file" id="additionalFiles" name="additionalFiles[]" class="file-input" accept=".pdf,.jpg,.jpeg,.png" multiple>
                            </div>
                            <div class="uploaded-files" id="additionalFilesDisplay"></div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" id="prevStep3">
                                <i class="fas fa-arrow-right"></i>
                                السابق
                            </button>
                            <button type="button" class="btn btn-primary" id="nextStep3">
                                <span class="btn-text">
                                    التالي
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- الخطوة الرابعة: كلمة المرور والمراجعة -->
                    <div class="form-step" id="step4">
                        <h2 class="section-title">كلمة المرور ومراجعة البيانات</h2>
                        
                        <!-- كلمة المرور -->
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label required" for="password">كلمة المرور</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-lock"></i>
                                    <input type="password" id="password" name="password" class="form-input" 
                                           placeholder="8+ أحرف، أرقام، ورموز" required>
                                </div>
                                <div class="form-error-message">كلمة المرور يجب أن تكون قوية (8+ أحرف، أرقام، ورموز)</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="password_confirmation">تأكيد كلمة المرور</label>
                                <div class="form-input-wrapper">
                                    <i class="form-input-icon fas fa-check-double"></i>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" 
                                           placeholder="أعد إدخال كلمة المرور" required>
                                </div>
                                <div class="form-error-message">كلمات المرور غير متطابقة</div>
                            </div>
                        </div>

                        <!-- مراجعة البيانات -->
                        <div class="confirmation-details">
                            <h3>ملخص البيانات المدخلة</h3>
                            <div id="reviewContent">
                                <!-- سيتم ملء هذا القسم بـ JavaScript -->
                            </div>
                        </div>

                        <div class="terms-checkbox">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="finalConfirmation">
                                <div class="checkmark"></div>
                            </div>
                            <label for="finalConfirmation" class="checkbox-label">
                                <strong>أقر بصحة جميع البيانات المدخلة أعلاه</strong>، وأتعهد بأنها دقيقة وحديثة، 
                                وأفهم أن تقديم معلومات خاطئة قد يؤدي إلى رفض الطلب أو إلغاء الحساب.
                            </label>
                        </div>

                                                 <div class="form-actions">
                             <button type="button" class="btn btn-secondary" id="prevStep4">
                                 <i class="fas fa-arrow-right"></i>
                                 السابق
                             </button>
                             <button type="button" class="btn btn-outline" id="testFormData" style="margin: 0 10px;">
                                 <i class="fas fa-eye"></i>
                                 اختبار البيانات
                             </button>
                             <button type="submit" class="btn btn-primary" id="submitForm" disabled>
                                 <span class="spinner"></span>
                                 <span class="btn-text">
                                     <i class="fas fa-paper-plane"></i>
                                     إرسال طلب التسجيل
                                 </span>
                             </button>
                         </div>
                    </div>
                </form>
            </section>

            <!-- قسم التأكيد -->
            <section class="confirmation-section" id="confirmationSection">
                <div class="confirmation-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="confirmation-title">تم إرسال طلبكم بنجاح!</h2>
                <p class="confirmation-message">
                    شكراً لكم على تسجيلكم في منصة توافق. تم استلام طلبكم وسيقوم فريقنا بمراجعة 
                    البيانات والمستندات المرفقة خلال 3-5 أيام عمل.
                </p>
                
                <div class="confirmation-details">
                    <h3>الخطوات التالية</h3>
                    <p><strong>المراجعة:</strong> سيتم مراجعة جميع البيانات والمستندات المقدمة من قبل فريق متخصص</p>
                    <p><strong>التحقق:</strong> قد نتواصل معكم للحصول على معلومات إضافية أو توضيحات إن لزم الأمر</p>
                    <p><strong>التفعيل:</strong> بعد الموافقة، سيتم تفعيل حسابكم وإرسال بيانات الدخول عبر البريد الإلكتروني</p>
                    <p><strong>البدء:</strong> ستتمكنون من الدخول إلى المنصة ونشر الفرص الاستثمارية والمشاريع</p>
                    
                    <p style="margin-top: 2rem; color: var(--primary-darker); font-weight: 600;">
                        رقم الطلب: <strong>REG-SYR-2025-001234</strong>
                    </p>
                </div>

                <div class="form-actions" style="justify-content: center;">
                    <button type="button" class="btn btn-outline" onclick="window.location.href='/'">
                        <i class="fas fa-home"></i>
                        العودة للصفحة الرئيسية
                    </button>
                </div>
            </section>
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // === عناصر DOM ===
        const termsSection = document.getElementById('termsSection');
        const registrationSection = document.getElementById('registrationSection');
        const confirmationSection = document.getElementById('confirmationSection');
        const acceptTermsCheckbox = document.getElementById('acceptTerms');
        const proceedBtn = document.getElementById('proceedBtn');
        const finalConfirmationCheckbox = document.getElementById('finalConfirmation');
        const submitFormBtn = document.getElementById('submitForm');
        const progressFill = document.getElementById('progressFill');

        // === متغيرات الحالة ===
        let currentStep = 1;

        // === تفعيل زر المتابعة عند الموافقة على الشروط ===
        acceptTermsCheckbox.addEventListener('change', function() {
            proceedBtn.disabled = !this.checked;
        });

        // === الانتقال من الشروط إلى التسجيل ===
        proceedBtn.addEventListener('click', function() {
            termsSection.classList.add('hidden');
            registrationSection.classList.add('active');
            updateProgress();
        });

        // === تفعيل زر الإرسال عند التأكيد النهائي ===
        finalConfirmationCheckbox.addEventListener('change', function() {
            submitFormBtn.disabled = !this.checked;
        });
        
        // === التحقق من صحة النموذج قبل الإرسال ===
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            console.log('Form submission started');
            
            const entityType = document.getElementById('entityType').value;
            console.log('Entity Type:', entityType);
            
            if (!entityType) {
                e.preventDefault();
                alert('الرجاء اختيار نوع الجهة');
                document.getElementById('entityType').focus();
                return false;
            }
            
            // التحقق من الملفات المطلوبة
            const licenseFile = document.getElementById('licenseFile').files.length;
            const authorizationFile = document.getElementById('authorizationFile').files.length;
            const idFile = document.getElementById('idFile').files.length;
            
            console.log('Files:', { licenseFile, authorizationFile, idFile });
            
            if (!licenseFile || !authorizationFile || !idFile) {
                e.preventDefault();
                alert('الرجاء رفع جميع الملفات المطلوبة');
                return false;
            }
            
            console.log('Form validation passed, submitting...');
        });
        
        // === التحقق من صحة كلمة المرور ===
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const passwordConfirmation = this.value;
            
            if (passwordConfirmation && password !== passwordConfirmation) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            } else if (passwordConfirmation && password === passwordConfirmation) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-invalid', 'is-valid');
            }
        });

        // === وظائف إدارة الخطوات ===
        function updateProgress() {
            const progress = ((currentStep - 1) / 3) * 100;
            progressFill.style.width = progress + '%';
            
            // تحديث مؤشرات الخطوات
            document.querySelectorAll('.step-item').forEach((step, index) => {
                const stepNumber = index + 1;
                step.classList.remove('active', 'completed');
                
                if (stepNumber < currentStep) {
                    step.classList.add('completed');
                } else if (stepNumber === currentStep) {
                    step.classList.add('active');
                }
            });
        }

        function showStep(stepNumber) {
            // إخفاء جميع الخطوات
            document.querySelectorAll('.form-step').forEach(step => {
                step.classList.remove('active');
            });
            
            // إظهار الخطوة الحالية
            document.getElementById(`step${stepNumber}`).classList.add('active');
            currentStep = stepNumber;
            updateProgress();
        }







        // === إعداد رفع الملفات ===
        function setupFileUpload(uploadAreaId, fileInputId, displayId, fileNameId, fileSizeId, removeId) {
            const uploadArea = document.getElementById(uploadAreaId);
            const fileInput = document.getElementById(fileInputId);
            const fileDisplay = document.getElementById(displayId);
            const fileName = document.getElementById(fileNameId);
            const fileSize = document.getElementById(fileSizeId);
            const removeBtn = document.getElementById(removeId);
            
            uploadArea.addEventListener('click', () => fileInput.click());
            
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });
            
            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('dragover');
            });
            
            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileSelect(files[0]);
                }
            });
            
            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    handleFileSelect(e.target.files[0]);
                }
            });
            
            removeBtn.addEventListener('click', () => {
                fileInput.value = '';
                fileDisplay.classList.remove('show');
            });
            
            function handleFileSelect(file) {
                const maxSize = fileInput.id.includes('additional') || fileInput.id.includes('license') || fileInput.id.includes('authorization') ? 10 * 1024 * 1024 : 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert(`حجم الملف يجب أن يكون أقل من ${maxSize / (1024 * 1024)} ميجابايت`);
                    return;
                }
                
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                fileDisplay.classList.add('show');
                
                // إخفاء رسالة الخطأ
                const errorMsg = fileInput.closest('.form-group').querySelector('.form-error-message');
                if (errorMsg) errorMsg.style.display = 'none';
            }
        }

        // === إعداد رفع الملفات المتعددة ===
        function setupMultipleFileUpload() {
            const uploadArea = document.getElementById('additionalUpload');
            const fileInput = document.getElementById('additionalFiles');
            const filesDisplay = document.getElementById('additionalFilesDisplay');
            
            uploadArea.addEventListener('click', () => fileInput.click());
            
            fileInput.addEventListener('change', (e) => {
                Array.from(e.target.files).forEach(file => {
                    if (file.size <= 10 * 1024 * 1024) {
                        addFileToDisplay(file, filesDisplay);
                    } else {
                        alert(`حجم الملف ${file.name} كبير جداً. الحد الأقصى 10 ميجابايت.`);
                    }
                });
            });
            
            function addFileToDisplay(file, container) {
                const fileDiv = document.createElement('div');
                fileDiv.className = 'uploaded-file show';
                fileDiv.innerHTML = `
                    <div class="file-icon"><i class="fas fa-file"></i></div>
                    <div class="file-info">
                        <div class="file-name">${file.name}</div>
                        <div class="file-size">${formatFileSize(file.size)}</div>
                    </div>
                    <button type="button" class="file-remove">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                fileDiv.querySelector('.file-remove').addEventListener('click', () => {
                    fileDiv.remove();
                });
                
                container.appendChild(fileDiv);
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // === إعداد أزرار التنقل ===
        document.getElementById('nextStep1').addEventListener('click', () => {
            showStep(2);
        });

        document.getElementById('prevStep2').addEventListener('click', () => {
            showStep(1);
        });

        document.getElementById('nextStep2').addEventListener('click', () => {
            showStep(3);
        });

        document.getElementById('prevStep3').addEventListener('click', () => {
            showStep(2);
        });

        document.getElementById('nextStep3').addEventListener('click', () => {
            generateReview();
            showStep(4);
        });

        document.getElementById('prevStep4').addEventListener('click', () => {
            showStep(3);
        });

        // === إنشاء ملخص المراجعة ===
        function generateReview() {
            const reviewContent = document.getElementById('reviewContent');
            const formData = {
                entityType: document.getElementById('entityType').value,
                entityNameAr: document.getElementById('entityNameAr').value,
                entityNameEn: document.getElementById('entityNameEn').value,
                licenseNumber: document.getElementById('licenseNumber').value,
                businessSector: document.getElementById('businessSector').value,
                entityPhone: document.getElementById('entityPhone').value,
                entityEmail: document.getElementById('entityEmail').value,
                responsibleName: document.getElementById('responsibleName').value,
                responsiblePosition: document.getElementById('responsiblePosition').value,
                responsibleEmail: document.getElementById('responsibleEmail').value,
                responsiblePhone: document.getElementById('responsiblePhone').value
            };

            const entityTypeText = {
                'ministry': 'وزارة حكومية',
                'government-authority': 'هيئة حكومية', 
                'government-company': 'شركة حكومية',
                'mixed-company': 'شركة مختلطة',
                'private-company': 'شركة خاصة',
                'public-institution': 'مؤسسة عامة'
            };

            reviewContent.innerHTML = `
                <p><strong>نوع الجهة:</strong> ${entityTypeText[formData.entityType] || formData.entityType}</p>
                <p><strong>اسم الجهة:</strong> ${formData.entityNameAr} | ${formData.entityNameEn}</p>
                <p><strong>رقم الترخيص:</strong> ${formData.licenseNumber}</p>
                <p><strong>القطاع:</strong> ${formData.businessSector}</p>
                <p><strong>الهاتف الرسمي:</strong> ${formData.entityPhone}</p>
                <p><strong>البريد الإلكتروني:</strong> ${formData.entityEmail}</p>
                <hr style="margin: 1.5rem 0; border: 1px solid var(--grey-300);">
                <p><strong>المسؤول المخول:</strong> ${formData.responsibleName}</p>
                <p><strong>المنصب:</strong> ${formData.responsiblePosition}</p>
                <p><strong>البريد الشخصي:</strong> ${formData.responsibleEmail}</p>
                <p><strong>الهاتف المحمول:</strong> ${formData.responsiblePhone}</p>
            `;
        }

        // === إرسال النموذج ===
        // Form will submit traditionally without JavaScript
        // The controller will handle the response and redirect appropriately

        // === تنسيق أرقام الهاتف ===
        document.getElementById('entityPhone').addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('966')) {
                value = value.substring(3);
            }
            if (value.length <= 9) {
                e.target.value = '+966 ' + value;
            }
        });

        document.getElementById('responsiblePhone').addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('966')) {
                value = value.substring(3);
            }
            if (value.length <= 9) {
                e.target.value = '+966 ' + value;
            }
        });

        // === إعداد رفع الملفات ===
        setupFileUpload('licenseUpload', 'licenseFile', 'licenseFileDisplay', 'licenseFileName', 'licenseFileSize', 'licenseFileRemove');
        setupFileUpload('authorizationUpload', 'authorizationFile', 'authorizationFileDisplay', 'authorizationFileName', 'authorizationFileSize', 'authorizationFileRemove');
        setupFileUpload('idUpload', 'idFile', 'idFileDisplay', 'idFileName', 'idFileSize', 'idFileRemove');
        setupMultipleFileUpload();
        
        // === اختبار بيانات النموذج ===
        document.getElementById('testFormData').addEventListener('click', function() {
            const formData = new FormData(document.getElementById('registrationForm'));
            console.log('=== اختبار بيانات النموذج ===');
            console.log('Entity Type:', formData.get('entityType'));
            console.log('Entity Name Ar:', formData.get('entityNameAr'));
            console.log('Entity Name En:', formData.get('entityNameEn'));
            console.log('License Number:', formData.get('licenseNumber'));
            console.log('Business Sector:', formData.get('businessSector'));
            console.log('Entity Phone:', formData.get('entityPhone'));
            console.log('Entity Email:', formData.get('entityEmail'));
            console.log('Responsible Name:', formData.get('responsibleName'));
            console.log('Responsible Position:', formData.get('responsiblePosition'));
            console.log('Responsible Email:', formData.get('responsibleEmail'));
            console.log('Responsible Phone:', formData.get('responsiblePhone'));
            console.log('Password:', formData.get('password'));
            console.log('Password Confirmation:', formData.get('password_confirmation'));
            
            // Check files
            const licenseFile = document.getElementById('licenseFile').files[0];
            const authorizationFile = document.getElementById('authorizationFile').files[0];
            const idFile = document.getElementById('idFile').files[0];
            
            console.log('License File:', licenseFile ? licenseFile.name : 'No file');
            console.log('Authorization File:', authorizationFile ? authorizationFile.name : 'No file');
            console.log('ID File:', idFile ? idFile.name : 'No file');
            
            console.log('=== نهاية الاختبار ===');
        });

        console.log('✅ تم تحميل صفحة تسجيل الشركات بنجاح');
    });
    </script>
</body>
</html>