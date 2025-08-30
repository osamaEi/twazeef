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

        /* التدرجات */
        --gradient-primary: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
        --gradient-light: linear-gradient(135deg, var(--primary-light) 0%, #00a366 100%);
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

    /* التهيئات الأساسية */
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



    /* الحاوي الرئيسي للنماذج */
    .auth-container {
        width: 100%;
        max-width: 1400px;
        background: var(--pure-white);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        display: none;
        min-height: 700px;
        opacity: 0;
        transform: scale(0.95);
        transition: var(--transition-medium);
        direction: rtl;
        flex-direction: row;
    }

    .auth-container.show {
        display: flex;
        opacity: 1;
        transform: scale(1);
    }

    /* اللوحة الجانبية */
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
        animation: slideInRight 0.6s ease-out 0.6s backwards;
    }

    .brand-description {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.7;
        max-width: 400px;
        animation: slideInRight 0.6s ease-out 0.8s backwards;
    }

    .brand-footer {
        position: relative;
        z-index: 2;
        animation: slideInRight 0.6s ease-out 1s backwards;
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

    /* تذييل النموذج */
    .auth-footer {
        margin-top: 2rem;
        text-align: center;
        padding: 1.5rem;
        background: var(--grey-50);
        border-radius: var(--border-radius-sm);
        border: 1px solid var(--grey-200);
    }

    .auth-footer p {
        margin-bottom: 0.5rem;
        color: var(--grey-600);
    }

    .auth-footer a {
        color: var(--primary-green);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition-fast);
    }

    .auth-footer a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* لوحة النموذج */
    .auth-form-panel {
        flex: 1.3;
        padding: 4rem 5rem;
        display: flex;
        flex-direction: column;
        position: relative;
        background: var(--pure-white);
        direction: rtl;
        overflow-y: auto;
        max-height: 100vh;
    }



    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
        animation: slideInUp 0.6s ease-out 0.4s backwards;
        padding-top: 1rem;
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

    /* نظام Tabs */
    .auth-tabs {
        display: flex;
        background: var(--grey-100);
        border-radius: var(--border-radius-sm);
        padding: 0.5rem;
        margin-bottom: 2rem;
        position: relative;
        animation: slideInUp 0.6s ease-out 0.6s backwards;
    }

    .auth-tab {
        flex: 1;
        padding: 1rem 2rem;
        background: transparent;
        border: none;
        border-radius: var(--border-radius-sm);
        font-family: var(--font-main);
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--grey-600);
        cursor: pointer;
        transition: var(--transition-fast);
        position: relative;
        z-index: 2;
    }

    .auth-tab.active {
        background: var(--pure-white);
        color: var(--primary-green);
        box-shadow: var(--shadow-sm);
        font-weight: 600;
    }

    .auth-tab:hover:not(.active) {
        color: var(--grey-700);
    }

    /* شريط التقدم */
    .progress-container {
        margin-bottom: 3rem;
        animation: slideInUp 0.6s ease-out 0.8s backwards;
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: var(--grey-200);
        border-radius: 4px;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: var(--gradient-primary);
        border-radius: 4px;
        width: 0%;
        transition: width 0.6s ease-out;
    }

    .steps-indicator {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 0.5rem;
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
        height: 3px;
        background: var(--grey-300);
        z-index: 1;
    }

    .step-item.completed:not(:last-child)::after {
        background: var(--primary-green);
    }

    .step-number {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--grey-300);
        color: var(--grey-500);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        position: relative;
        z-index: 2;
        transition: var(--transition-fast);
    }

    .step-item.active .step-number {
        background: var(--primary-green);
        color: var(--pure-white);
    }

    .step-item.completed .step-number {
        background: var(--primary-green);
        color: var(--pure-white);
    }

    .step-item.completed .step-number::before {
        content: '✓';
        font-size: 0.8rem;
    }

    .step-label {
        font-size: 0.85rem;
        color: var(--grey-500);
        text-align: center;
        transition: var(--transition-fast);
        font-weight: 500;
    }

    .step-item.active .step-label,
    .step-item.completed .step-label {
        color: var(--primary-green);
        font-weight: 600;
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

    /* النماذج */
    .auth-form {
        flex: 1;
        transition: var(--transition-medium);
        animation: slideInUp 0.6s ease-out 1s backwards;
        direction: rtl;
        display: block;
    }

    .auth-form.active {
        display: block;
    }

    .form-step {
        display: none;
        opacity: 0;
        transform: translateY(20px);
        transition: var(--transition-medium);
    }

    .form-step.active {
        display: block !important;
        opacity: 1;
        transform: translateY(0);
    }

    /* إظهار الخطوة الأولى افتراضياً */
    #step1 {
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

    .form-success-message {
        display: none;
        margin-top: 0.75rem;
        font-size: 0.9rem;
        color: var(--success-green);
        font-weight: 500;
        text-align: right;
    }

    .form-input.is-valid ~ .form-success-message {
        display: block;
    }

    /* قسم الشروط والأحكام */
    .terms-section {
        background: var(--primary-lightest);
        border: 2px solid var(--primary-lighter);
        border-radius: var(--border-radius-sm);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .terms-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        color: var(--primary-darker);
    }

    .terms-header i {
        font-size: 1.8rem;
        color: var(--primary-green);
    }

    .terms-header h3 {
        font-size: 1.4rem;
        font-weight: 700;
    }

    .terms-content {
        max-height: 200px;
        overflow-y: auto;
        background: var(--pure-white);
        border: 1px solid var(--primary-lighter);
        border-radius: var(--border-radius-sm);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        font-size: 1rem;
        line-height: 1.7;
        color: var(--grey-700);
    }

    .terms-content::-webkit-scrollbar {
        width: 8px;
    }

    .terms-content::-webkit-scrollbar-track {
        background: var(--grey-200);
        border-radius: 4px;
    }

    .terms-content::-webkit-scrollbar-thumb {
        background: var(--primary-green);
        border-radius: 4px;
    }

    .terms-item {
        margin-bottom: 1rem;
        padding-right: 1rem;
    }

    .terms-item:last-child {
        margin-bottom: 0;
    }

    .terms-item strong {
        color: var(--primary-darker);
    }

    .terms-checkbox-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .terms-checkbox-wrapper:hover {
        opacity: 0.8;
    }

    .terms-checkbox {
        width: 22px;
        height: 22px;
        border: 2px solid var(--grey-400);
        border-radius: 6px;
        position: relative;
        transition: var(--transition-fast);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .terms-checkbox.checked {
        background: var(--primary-green);
        border-color: var(--primary-green);
    }

    .terms-checkbox.checked::before {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: var(--pure-white);
        font-size: 14px;
        font-weight: 700;
    }

    .terms-checkbox-text {
        font-size: 1rem;
        line-height: 1.6;
        color: var(--grey-700);
    }

    .terms-checkbox-text a {
        color: var(--primary-green);
        font-weight: 600;
        text-decoration: none;
    }

    .terms-checkbox-text a:hover {
        text-decoration: underline;
    }

    /* تحسين مظهر قسم الشروط */
    .terms-section {
        box-shadow: var(--shadow-sm);
        transition: var(--transition-fast);
    }

    .terms-section:hover {
        box-shadow: var(--shadow-md);
    }

    .terms-content {
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* إرفاق الملفات */
    .file-upload-area {
        border: 2px dashed var(--grey-300);
        border-radius: var(--border-radius-sm);
        padding: 2.5rem;
        text-align: center;
        transition: var(--transition-fast);
        cursor: pointer;
        background: var(--grey-50);
        margin-bottom: 1rem;
    }

    .file-upload-area:hover {
        border-color: var(--primary-green);
        background: var(--primary-lightest);
    }

    .file-upload-area.dragover {
        border-color: var(--primary-green);
        background: var(--primary-lightest);
    }

    .file-upload-icon {
        font-size: 3rem;
        color: var(--grey-400);
        margin-bottom: 1.5rem;
    }

    .file-upload-text {
        font-size: 1.1rem;
        color: var(--grey-700);
        margin-bottom: 0.75rem;
        font-weight: 500;
    }

    .file-upload-hint {
        font-size: 0.9rem;
        color: var(--grey-500);
    }

    .file-input {
        display: none;
    }

    .uploaded-files-list {
        margin-top: 1rem;
    }

    .uploaded-file {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1rem;
        background: var(--primary-lightest);
        border-radius: var(--border-radius-sm);
        border: 1px solid var(--primary-lighter);
        margin-bottom: 0.75rem;
    }

    .uploaded-file:last-child {
        margin-bottom: 0;
    }

    .file-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-green);
        border-radius: var(--border-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pure-white);
        font-size: 1.2rem;
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
        font-size: 0.95rem;
    }

    .file-size {
        font-size: 0.85rem;
        color: var(--grey-500);
    }

    .file-remove {
        background: none;
        border: none;
        color: var(--accent-red);
        cursor: pointer;
        font-size: 1.2rem;
        padding: 0.5rem;
        border-radius: var(--border-radius-sm);
        transition: var(--transition-fast);
        flex-shrink: 0;
    }

    .file-remove:hover {
        background: rgba(211, 47, 47, 0.1);
    }

    /* الأزرار */
    .form-actions {
        display: flex;
        gap: 1.5rem;
        margin-top: 3rem;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-top: 1px solid var(--grey-200);
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
        min-width: 160px;
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
        transform: none;
    }

    .btn-primary:disabled:hover {
        transform: none;
        box-shadow: none;
    }

    .btn-secondary {
        background: var(--grey-100);
        color: var(--grey-700);
        border-color: var(--grey-300);
    }

    .btn-secondary:hover {
        background: var(--grey-200);
        transform: translateY(-1px);
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

    .spinner {
        display: none;
        position: absolute;
        width: 22px;
        height: 22px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: var(--pure-white);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* التحقق من رقم الهاتف */
    .verification-container {
        text-align: center;
        padding: 2rem 0;
    }

    .verification-icon {
        width: 100px;
        height: 100px;
        background: var(--primary-lighter);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        color: var(--primary-green);
        font-size: 2.5rem;
    }

    .verification-code-inputs {
        display: flex;
        gap: 1.25rem;
        justify-content: center;
        margin: 2.5rem 0;
        direction: ltr;
    }

    .code-input {
        width: 65px;
        height: 65px;
        border: 2px solid var(--grey-300);
        border-radius: var(--border-radius-sm);
        text-align: center;
        font-size: 1.6rem;
        font-weight: 600;
        color: var(--grey-700);
        background: var(--grey-50);
        transition: var(--transition-fast);
        direction: ltr;
    }

    .code-input:focus {
        border-color: var(--primary-green);
        background: var(--pure-white);
        box-shadow: 0 0 0 4px rgba(0, 109, 70, 0.1);
        outline: none;
    }

    .resend-code {
        color: var(--primary-green);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-fast);
        font-size: 1rem;
    }

    .resend-code:hover {
        color: var(--primary-dark);
    }

    .resend-code.disabled {
        color: var(--grey-400);
        cursor: not-allowed;
    }

    /* رسالة النجاح النهائية */
    .success-final-message {
        text-align: center;
        padding: 3rem 2rem;
        background: var(--primary-lightest);
        border-radius: var(--border-radius-lg);
        border: 2px solid var(--primary-lighter);
    }

    /* رسائل النجاح والخطأ */
    .success-message, .error-message {
        padding: 1.5rem;
        border-radius: var(--border-radius-sm);
        margin-bottom: 2rem;
        text-align: center;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        animation: slideInDown 0.5s ease-out;
    }

    .success-message {
        background: var(--success-green);
        color: var(--pure-white);
        border: 2px solid #45a049;
    }

    .error-message {
        background: var(--accent-red);
        color: var(--pure-white);
        border: 2px solid #b71c1c;
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

    .success-final-icon {
        width: 120px;
        height: 120px;
        background: var(--primary-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        color: var(--pure-white);
        font-size: 3.5rem;
        animation: successPop 0.6s ease-out;
    }

    @keyframes successPop {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .success-final-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-darker);
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .success-final-text {
        font-size: 1.3rem;
        color: var(--grey-600);
        line-height: 1.7;
        max-width: 500px;
        margin: 0 auto 2rem;
    }

    .success-final-details {
        background: var(--pure-white);
        border-radius: var(--border-radius-sm);
        padding: 2rem;
        margin: 2rem 0;
        border: 1px solid var(--primary-lighter);
    }

    .success-final-details h4 {
        color: var(--primary-darker);
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .success-final-details ul {
        list-style: none;
        padding: 0;
    }

    .success-final-details li {
        padding: 0.5rem 0;
        color: var(--grey-600);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .success-final-details li i {
        color: var(--primary-green);
        width: 20px;
    }

    /* شاشة التحميل */
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition-fast);
    }

    .loading-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .loading-spinner {
        width: 55px;
        height: 55px;
        border: 4px solid var(--grey-200);
        border-top-color: var(--primary-green);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    /* التصميم المتجاوب */
    @media (max-width: 1200px) {
        .auth-form-panel {
            padding: 3rem 4rem;
        }
        

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
            max-height: none;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        

    }

    @media (max-width: 768px) {
        body {
            padding: 1rem;
        }
        
        .auth-form-panel {
            padding: 2rem;
        }
        
        .verification-code-inputs {
            gap: 1rem;
        }
        
        .code-input {
            width: 55px;
            height: 55px;
            font-size: 1.4rem;
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
        


        .auth-tabs {
            flex-direction: column;
            gap: 0.5rem;
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
        
        .terms-content {
            max-height: 150px;
        }
    }
    </style>
</head>
<body>

    <div class="auth-container show">
        <!-- اللوحة الجانبية اليمنى - البانر الترويجي -->
        <div class="auth-brand-panel">
            <div class="brand-content">
                <h1 class="brand-title">منصة توافق ترحب بكم</h1>
                <p class="brand-description">
                    الانضمام إلى المنصة الرائدة للشراكة الاستراتيجية بين الموظفين والشركات، واكتشاف فرص وظيفية لا محدوده.
                </p>
            </div>
            
            <div class="brand-footer">
                <div class="brand-stats">
                    <div class="brand-stat">
                        <div class="brand-stat-value">99.7%</div>
                        <div class="brand-stat-label">معدل الرضا</div>
                    </div>
                    <div class="brand-stat">
                        <div class="brand-stat-value">24B</div>
                        <div class="brand-stat-label">ريال توظيف</div>
                    </div>
                    <div class="brand-stat">
                        <div class="brand-stat-value">+1200</div>
                        <div class="brand-stat-label">شركة مسجلة</div>
                    </div>
                </div>
                <div class="brand-copyright">
                    © 2025 منصة توافق في المملكة العربية السعودية - جميع الحقوق محفوظة
                </div>
            </div>
        </div>

        <!-- لوحة النموذج اليسرى -->
        <div class="auth-form-panel">
            
            <div class="auth-header">
                <h1>تسجيل حساب موظف جديد</h1>
                <p>انضم إلى منصة توافق وابدأ رحلتك المهنية</p>
            </div>

            <!-- رسالة النجاح -->
            @if(session('success'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- رسالة الخطأ -->
            @if(session('error'))
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- رسالة التحقق من الأخطاء -->
            @if($errors->any())
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    يرجى التأكد من صحة البيانات المدخلة
                </div>
            @endif

            <!-- شريط التقدم للتسجيل -->
            <div class="progress-container" id="progressContainer">
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
                
                <div class="steps-indicator">
                    <div class="step-item active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">الشروط</div>
                    </div>
                    <div class="step-item" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">بيانات الحساب</div>
                    </div>
                    <div class="step-item" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">البيانات الشخصية</div>
                    </div>
                    <div class="step-item" data-step="4">
                        <div class="step-number">4</div>
                        <div class="step-label">المستندات</div>
                    </div>
                    <div class="step-item" data-step="5">
                        <div class="step-number">5</div>
                        <div class="step-label">التحقق من الهاتف</div>
                    </div>
                    <div class="step-item" data-step="6">
                        <div class="step-number">6</div>
                        <div class="step-label">التحقق من البريد</div>
                    </div>
                </div>
            </div>

    <form class="auth-form" method="POST" action="{{ route('employee.register') }}" enctype="multipart/form-data" id="registerForm" novalidate>
        @csrf
        
        <!-- الخطوة الأولى: الشروط والأحكام -->
        <div class="form-step active" id="step1">
            <div class="terms-section">
                <div class="terms-header">
                    <i class="fas fa-file-contract"></i>
                    <h3>الشروط والأحكام</h3>
                </div>
                
                <div class="terms-content">
                    <div class="terms-item">
                        <strong>1. شروط الاستخدام:</strong>
                        بالموافقة على هذه الشروط، تقر بأنك تبلغ من العمر 18 عاماً على الأقل وأنك مؤهل قانونياً لاستخدام هذه المنصة.
                    </div>
                    
                    <div class="terms-item">
                        <strong>2. صحة البيانات:</strong>
                        تتعهد بتقديم معلومات صحيحة ودقيقة وكاملة عند التسجيل، وتحديث هذه المعلومات للحفاظ على دقتها.
                    </div>
                    
                    <div class="terms-item">
                        <strong>3. سرية المعلومات:</strong>
                        نحن ملتزمون بحماية خصوصيتك وسرية معلوماتك الشخصية وفقاً لسياسة الخصوصية المعتمدة.
                    </div>
                    
                    <div class="terms-item">
                        <strong>4. استخدام المنصة:</strong>
                        تتعهد باستخدام المنصة للأغراض المشروعة فقط وعدم انتهاك أي قوانين أو لوائح معمول بها.
                    </div>
                    
                    <div class="terms-item">
                        <strong>5. المسؤولية:</strong>
                        أنت مسؤول عن جميع الأنشطة التي تحدث تحت حسابك وعن الحفاظ على سرية بيانات تسجيل الدخول.
                    </div>
                    
                    <div class="terms-item">
                        <strong>6. التحديثات:</strong>
                        نحتفظ بالحق في تحديث هذه الشروط من وقت لآخر، وسيتم إشعارك بأي تغييرات جوهرية.
                    </div>
                </div>
                
                <div class="terms-checkbox-wrapper" id="termsCheckbox">
                    <div class="terms-checkbox" id="termsCheckboxInput"></div>
                    <div class="terms-checkbox-text">
                        أوافق على <a href="#" target="_blank">الشروط والأحكام</a> و <a href="#" target="_blank">سياسة الخصوصية</a> الخاصة بمنصة توافق
                    </div>
                </div>
            </div>

                         <div class="form-actions">
                 <button type="button" class="btn btn-secondary" id="testFormData">
                     <i class="fas fa-info-circle"></i>
                     اختبار البيانات
                 </button>
                 <button type="button" class="btn btn-primary" id="nextStep1" disabled>
                     <span class="btn-text">
                         التالي
                         <i class="fas fa-arrow-left"></i>
                     </span>
                 </button>
             </div>
        </div>

        <!-- الخطوة الثانية: بيانات الحساب -->
        <div class="form-step" id="step2">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required" for="email">البريد الإلكتروني</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" 
                               placeholder="البريد الإلكتروني" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">الرجاء إدخال بريد إلكتروني صحيح</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label required" for="phone">رقم الهاتف</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-phone"></i>
                        <input type="tel" id="phone" name="phone" class="form-input @error('phone') is-invalid @enderror" 
                               placeholder="+966 5X XXX XXXX" value="{{ old('phone') }}" required>
                    </div>
                    @error('phone')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">الرجاء إدخال رقم هاتف سعودي صحيح يبدأ بـ +966 5</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required" for="password">كلمة المرور</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" 
                               placeholder="8+ أحرف، أرقام، ورموز" required>
                        <button type="button" class="password-toggle" aria-label="إظهار/إخفاء كلمة المرور">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">كلمة المرور يجب أن تكون قوية (8+ أحرف، أرقام، ورموز)</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label required" for="password_confirmation">تأكيد كلمة المرور</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-check-double"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" 
                               placeholder="أعد إدخال كلمة المرور" required>
                        <button type="button" class="password-toggle" aria-label="إظهار/إخفاء كلمة المرور">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="form-error-message">كلمات المرور غير متطابقة</div>
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

        <!-- الخطوة الثالثة: البيانات الشخصية -->
        <div class="form-step" id="step3">
            <div class="form-row">
                                 <div class="form-group">
                     <label class="form-label required" for="first_name_ar">الاسم الأول (عربي)</label>
                     <div class="form-input-wrapper">
                         <i class="form-input-icon fas fa-user"></i>
                         <input type="text" id="first_name_ar" name="first_name_ar" class="form-input @error('first_name_ar') is-invalid @enderror" 
                                placeholder="الاسم الأول" value="{{ old('first_name_ar') }}" required>
                     </div>
                     @error('first_name_ar')
                         <div class="form-error-message">{{ $message }}</div>
                     @else
                         <div class="form-error-message">هذا الحقل مطلوب</div>
                     @enderror
                 </div>
                 
                 <div class="form-group">
                     <label class="form-label required" for="last_name_ar">اسم العائلة (عربي)</label>
                     <div class="form-input-wrapper">
                         <i class="form-input-icon fas fa-user"></i>
                         <input type="text" id="last_name_ar" name="last_name_ar" class="form-input @error('last_name_ar') is-invalid @enderror" 
                                placeholder="اسم العائلة" value="{{ old('last_name_ar') }}" required>
                     </div>
                     @error('last_name_ar')
                         <div class="form-error-message">{{ $message }}</div>
                     @else
                         <div class="form-error-message">هذا الحقل مطلوب</div>
                     @enderror
                 </div>
                
                                 <div class="form-group">
                     <label class="form-label required" for="first_name_en">الاسم الأول (إنجليزي)</label>
                     <div class="form-input-wrapper">
                         <i class="form-input-icon fas fa-user"></i>
                         <input type="text" id="first_name_en" name="first_name_en" class="form-input @error('first_name_en') is-invalid @enderror" 
                                placeholder="First Name" value="{{ old('first_name_en') }}" required>
                     </div>
                     @error('first_name_en')
                         <div class="form-error-message">{{ $message }}</div>
                     @else
                         <div class="form-error-message">هذا الحقل مطلوب</div>
                     @enderror
                 </div>
                 
                 <div class="form-group">
                     <label class="form-label required" for="last_name_en">اسم العائلة (إنجليزي)</label>
                     <div class="form-input-wrapper">
                         <i class="form-input-icon fas fa-user"></i>
                         <input type="text" id="last_name_en" name="last_name_en" class="form-input @error('last_name_en') is-invalid @enderror" 
                                placeholder="Last Name" value="{{ old('last_name_en') }}" required>
                     </div>
                     @error('last_name_en')
                         <div class="form-error-message">{{ $message }}</div>
                     @else
                         <div class="form-error-message">هذا الحقل مطلوب</div>
                     @enderror
                 </div>
             </div>
 
             <div class="form-row">
                 <div class="form-group">
                     <label class="form-label required" for="national_id">رقم الهوية الوطنية</label>
                     <div class="form-input-wrapper">
                         <i class="form-input-icon fas fa-id-card"></i>
                         <input type="text" id="national_id" name="national_id" class="form-input @error('national_id') is-invalid @enderror" 
                                placeholder="1234567890" maxlength="10" value="{{ old('national_id') }}" required>
                     </div>
                     @error('national_id')
                         <div class="form-error-message">{{ $message }}</div>
                     @else
                         <div class="form-error-message">الرجاء إدخال رقم هوية صحيح مكون من 10 أرقام</div>
                     @enderror
                 </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required" for="birth_date">تاريخ الميلاد</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-calendar"></i>
                        <input type="date" id="birth_date" name="birth_date" class="form-input @error('birth_date') is-invalid @enderror" 
                               value="{{ old('birth_date') }}" max="{{ now()->subYears(16)->format('Y-m-d') }}" required>
                    </div>
                    @error('birth_date')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">الرجاء اختيار تاريخ الميلاد (يجب أن تكون 16 سنة على الأقل)</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label required" for="gender">الجنس</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-venus-mars"></i>
                        <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="">اختار الجنس</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                    </div>
                    @error('gender')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">الرجاء اختيار الجنس</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required" for="marital_status">الحالة الاجتماعية</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-ring"></i>
                        <select id="marital_status" name="marital_status" class="form-select @error('marital_status') is-invalid @enderror" required>
                            <option value="">اختار الحالة الاجتماعية</option>
                            <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>أعزب</option>
                            <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>متزوج</option>
                            <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>مطلق</option>
                            <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>أرمل</option>
                        </select>
                    </div>
                    @error('marital_status')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">الرجاء اختيار الحالة الاجتماعية</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label required" for="education">المؤهل العلمي</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-graduation-cap"></i>
                        <select id="education" name="education" class="form-select @error('education') is-invalid @enderror" required>
                            <option value="">اختار المؤهل العلمي</option>
                            <option value="high-school" {{ old('education') == 'high-school' ? 'selected' : '' }}>ثانوية عامة</option>
                            <option value="diploma" {{ old('education') == 'diploma' ? 'selected' : '' }}>دبلوم</option>
                            <option value="bachelor" {{ old('education') == 'bachelor' ? 'selected' : '' }}>بكالوريوس</option>
                            <option value="master" {{ old('education') == 'master' ? 'selected' : '' }}>ماجستير</option>
                            <option value="phd" {{ old('education') == 'phd' ? 'selected' : '' }}>دكتوراه</option>
                        </select>
                    </div>
                    @error('education')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">الرجاء اختيار المؤهل العلمي</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required" for="specialization">التخصص</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-book"></i>
                        <input type="text" id="specialization" name="specialization" class="form-input @error('specialization') is-invalid @enderror" 
                               placeholder="مجال التخصص" value="{{ old('specialization') }}" required>
                    </div>
                    @error('specialization')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">هذا الحقل مطلوب</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="bio">نبذة مختصرة</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-info-circle"></i>
                        <textarea id="bio" name="bio" class="form-textarea @error('bio') is-invalid @enderror" 
                                  placeholder="نبذة مختصرة عنك وخبراتك..." rows="3">{{ old('bio') }}</textarea>
                    </div>
                    @error('bio')
                        <div class="form-error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row single">
                <div class="form-group">
                    <label class="form-label required" for="address">عنوان السكن</label>
                    <div class="form-input-wrapper">
                        <i class="form-input-icon fas fa-map-marker-alt"></i>
                        <textarea id="address" name="address" class="form-textarea @error('address') is-invalid @enderror" 
                                  placeholder="العنوان الكامل..." required>{{ old('address') }}</textarea>
                    </div>
                    @error('address')
                        <div class="form-error-message">{{ $message }}</div>
                    @else
                        <div class="form-error-message">هذا الحقل مطلوب</div>
                    @enderror
                </div>
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

        <!-- الخطوة الرابعة: المستندات -->
        <div class="form-step" id="step4">
            <!-- صورة الهوية الوطنية - مطلوب -->
            <div class="form-group">
                <label class="form-label required">صورة الهوية الوطنية</label>
                <div class="file-upload-area" data-upload="national_id_image">
                    <div class="file-upload-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="file-upload-text">اضغط لرفع صورة الهوية الوطنية</div>
                    <div class="file-upload-hint">PDF, JPG, PNG - الحد الأقصى 5 ميجابايت</div>
                    <input type="file" name="national_id_image" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="uploaded-files-list" id="nationalIdFiles"></div>
                @error('national_id_image')
                    <div class="form-error-message">{{ $message }}</div>
                @else
                    <div class="form-error-message">الرجاء رفع صورة الهوية الوطنية</div>
                @enderror
            </div>

            <!-- الشهادة العلمية - مطلوب -->
            <div class="form-group">
                <label class="form-label required">الشهادة العلمية</label>
                <div class="file-upload-area" data-upload="certificate_image">
                    <div class="file-upload-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="file-upload-text">اضغط لرفع الشهادة العلمية</div>
                    <div class="file-upload-hint">PDF, JPG, PNG - الحد الأقصى 5 ميجابايت</div>
                    <input type="file" name="certificate_image" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="uploaded-files-list" id="certificateFiles"></div>
                @error('certificate_image')
                    <div class="form-error-message">{{ $message }}</div>
                @else
                    <div class="form-error-message">الرجاء رفع الشهادة العلمية</div>
                @enderror
            </div>

            <!-- شهادة الخبرة - مطلوب -->
            <div class="form-group">
                <label class="form-label required">شهادة الخبرة</label>
                <div class="file-upload-area" data-upload="experience_certificate">
                    <div class="file-upload-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="file-upload-text">اضغط لرفع شهادة الخبرة</div>
                    <div class="file-upload-hint">PDF, JPG, PNG - الحد الأقصى 5 ميجابايت</div>
                    <input type="file" name="experience_certificate" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="uploaded-files-list" id="experienceFiles"></div>
                @error('experience_certificate')
                    <div class="form-error-message">{{ $message }}</div>
                @else
                    <div class="form-error-message">الرجاء رفع شهادة الخبرة</div>
                @enderror
            </div>

            <!-- السيرة الذاتية - اختياري -->
            <div class="form-group">
                <label class="form-label">السيرة الذاتية (اختياري)</label>
                <div class="file-upload-area" data-upload="cv">
                    <div class="file-upload-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="file-upload-text">اضغط لرفع السيرة الذاتية</div>
                    <div class="file-upload-hint">PDF, DOC, DOCX - الحد الأقصى 5 ميجابايت</div>
                    <input type="file" name="cv" class="file-input" accept=".pdf,.doc,.docx">
                </div>
                <div class="uploaded-files-list" id="cvFiles"></div>
                @error('cv')
                    <div class="form-error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" id="prevStep4">
                    <i class="fas fa-arrow-right"></i>
                    السابق
                </button>
                <button type="button" class="btn btn-primary" id="nextStep4">
                    <span class="btn-text">
                        التالي
                        <i class="fas fa-arrow-left"></i>
                    </span>
                </button>
            </div>
        </div>

        <!-- الخطوة الخامسة: التحقق من الهاتف -->
        <div class="form-step" id="step5">
            <div class="verification-container">
                <div class="verification-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>التحقق من رقم الهاتف</h3>
                <p>تم إرسال رمز التحقق إلى رقم الهاتف:</p>
                <strong id="phoneDisplay"></strong>
                
                <div class="verification-code-inputs">
                    <input type="text" class="code-input" maxlength="1" data-index="0">
                    <input type="text" class="code-input" maxlength="1" data-index="1">
                    <input type="text" class="code-input" maxlength="1" data-index="2">
                    <input type="text" class="code-input" maxlength="1" data-index="3">
                    <input type="text" class="code-input" maxlength="1" data-index="4">
                    <input type="text" class="code-input" maxlength="1" data-index="5">
                </div>
                
                <p>لم تستلم الرمز؟ <span class="resend-code" id="resendCode">إعادة الإرسال (<span id="resendTimer">60</span>)</span></p>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" id="prevStep5">
                    <i class="fas fa-arrow-right"></i>
                    السابق
                </button>
                <button type="button" class="btn btn-primary" id="verifyPhone">
                    <span class="spinner"></span>
                    <span class="btn-text">
                        تحقق من الرمز
                        <i class="fas fa-check"></i>
                    </span>
                </button>
            </div>
        </div>

        <!-- الخطوة السادسة: التحقق من البريد الإلكتروني -->
        <div class="form-step" id="step6">
            <div class="verification-container">
                <div class="verification-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>التحقق من البريد الإلكتروني</h3>
                <p>تم إرسال رابط التحقق إلى البريد الإلكتروني:</p>
                <strong id="emailDisplay"></strong>
                
                <div style="margin: 2rem 0;">
                    <p style="color: var(--grey-600); line-height: 1.6;">
                        يرجى فتح البريد الإلكتروني والنقر على رابط التحقق لإكمال عملية التسجيل.
                        قد يستغرق وصول البريد بضع دقائق.
                    </p>
                </div>
                
                <p>لم تستلم البريد؟ <span class="resend-code" id="resendEmail">إعادة الإرسال</span></p>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='mailto:'">
                    <i class="fas fa-envelope"></i>
                    فتح البريد
                </button>
                <button type="submit" class="btn btn-primary" id="submitRegistration">
                    <span class="spinner"></span>
                    <span class="btn-text">
                        إكمال التسجيل
                        <i class="fas fa-check"></i>
                    </span>
                </button>
            </div>
        </div>

        <!-- رسالة النجاح النهائية -->
        <div class="form-step" id="stepSuccess">
            <div class="success-final-message">
                <div class="success-final-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2 class="success-final-title">شكراً لك!</h2>
                <p class="success-final-text">
                    تم استلام طلب التسجيل بنجاح. سيتم مراجعة بياناتك والمستندات المرفقة.
                </p>
                
                <div class="success-final-details">
                    <h4>الخطوات التالية:</h4>
                    <ul>
                        <li><i class="fas fa-clock"></i> سيتم مراجعة طلبك خلال 24-48 ساعة</li>
                        <li><i class="fas fa-envelope"></i> ستصلك رسالة تأكيد عبر البريد الإلكتروني</li>
                        <li><i class="fas fa-phone"></i> قد نتواصل معك هاتفياً للتأكد من البيانات</li>
                        <li><i class="fas fa-user-check"></i> بعد الموافقة، ستتمكن من الوصول لحسابك</li>
                    </ul>
                </div>
                
                <p style="color: var(--primary-green); font-weight: 600; font-size: 1.1rem;">
                    رقم الطلب الخاص بك : SA-EMP-0000-12345
                </p>
            </div>
        </div>
    </form>

    <div class="auth-footer">
        <p>لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
        <p>أو <a href="{{ route('company.register') }}">تسجيل كشركة</a></p>
    </div>
        </div>
    </div>
<script>

document.addEventListener('DOMContentLoaded', function() {
    // === متغيرات الحالة ===
    let currentStep = 1;
    let resendTimer = 60;
    let resendInterval;
    let termsAccepted = false;
    let uploadedFiles = {
        national_id_image: [],
        certificate_image: [],
        experience_certificate: [],
        cv: []
    };

    // === إدارة خطوات التسجيل ===
    function updateProgress() {
        const progressFill = document.getElementById('progressFill');
        if (progressFill) {
            const progress = ((currentStep - 1) / 5) * 100;
            progressFill.style.width = progress + '%';
        }
        
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
        console.log('Switching to step:', stepNumber);
        
        // إخفاء جميع الخطوات
        document.querySelectorAll('.form-step').forEach(step => {
            step.classList.remove('active');
            step.style.display = 'none';
        });
        
        // إظهار الخطوة الحالية
        const targetStep = stepNumber === 7 ? 'stepSuccess' : `step${stepNumber}`;
        const targetElement = document.getElementById(targetStep);
        
        if (targetElement) {
            targetElement.classList.add('active');
            targetElement.style.display = 'block';
            console.log('Showing step:', targetStep);
        } else {
            console.error('Step element not found:', targetStep);
        }
        
        currentStep = stepNumber;
        
        if (stepNumber <= 6) {
            updateProgress();
        } else {
            // إخفاء شريط التقدم في شاشة النجاح
            const progressContainer = document.getElementById('progressContainer');
            if (progressContainer) {
                progressContainer.style.display = 'none';
            }
        }
    }

         // === اختبار بيانات النموذج ===
     document.getElementById('testFormData').addEventListener('click', () => {
         console.log('Testing form data...');
         console.log('Terms accepted:', termsAccepted);
         console.log('Current step:', currentStep);
         
         // اختبار الحقول المتاحة
         const testFields = ['email', 'phone', 'password', 'password_confirmation', 'first_name_ar', 'last_name_ar', 'first_name_en', 'last_name_en', 'national_id', 'birth_date', 'gender', 'marital_status', 'education', 'specialization', 'address'];
         testFields.forEach(fieldName => {
             const field = document.getElementById(fieldName);
             if (field) {
                 console.log(`${fieldName}: ${field.value}`);
             } else {
                 console.log(`${fieldName}: Field not found`);
             }
         });
         
         // اختبار الملفات المرفوعة
         console.log('Uploaded files:', uploadedFiles);
         
         // اختبار النموذج
         const form = document.getElementById('registerForm');
         if (form) {
             console.log('Form action:', form.action);
             console.log('Form method:', form.method);
             console.log('Form enctype:', form.enctype);
         }
     });

     // === إعداد قسم الشروط والأحكام ===
     function setupTermsSection() {
        const termsCheckbox = document.getElementById('termsCheckbox');
        const termsCheckboxInput = document.getElementById('termsCheckboxInput');
        const nextStep1Btn = document.getElementById('nextStep1');
        
        if (!termsCheckbox || !nextStep1Btn) {
            console.error('Terms section elements not found');
            return;
        }
        
        console.log('Setting up terms section');
        
        termsCheckbox.addEventListener('click', function() {
            termsAccepted = !termsAccepted;
            console.log('Terms accepted:', termsAccepted);
            
            if (termsAccepted) {
                if (termsCheckboxInput) termsCheckboxInput.classList.add('checked');
                nextStep1Btn.disabled = false;
                console.log('Next button enabled');
            } else {
                if (termsCheckboxInput) termsCheckboxInput.classList.remove('checked');
                nextStep1Btn.disabled = true;
                console.log('Next button disabled');
            }
        });
    }

    // === إدارة رفع الملفات ===
    function setupFileUpload() {
        const uploadAreas = document.querySelectorAll('.file-upload-area');
        
        uploadAreas.forEach(area => {
            const uploadType = area.getAttribute('data-upload');
            const fileInput = area.querySelector('.file-input');
            
            if (!uploadType || !fileInput) {
                console.error('File upload area missing required attributes');
                return;
            }
            
            area.addEventListener('click', () => fileInput.click());
            
            area.addEventListener('dragover', (e) => {
                e.preventDefault();
                area.classList.add('dragover');
            });
            
            area.addEventListener('dragleave', () => {
                area.classList.remove('dragover');
            });
            
            area.addEventListener('drop', (e) => {
                e.preventDefault();
                area.classList.remove('dragover');
                const files = Array.from(e.dataTransfer.files);
                if (files.length > 0) {
                    handleFileUpload(files[0], uploadType, fileInput);
                }
            });
            
            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    handleFileUpload(file, uploadType, fileInput);
                }
            });
        });
    }

    function handleFileUpload(file, uploadType, fileInput) {
        console.log('Handling file upload:', file.name, 'for type:', uploadType);
        
        if (file.size > 5 * 1024 * 1024) {
            alert(`حجم الملف ${file.name} يجب أن يكون أقل من 5 ميجابايت`);
            return;
        }
        
        // تحديث FileInput بالملف المختار
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
        
        const fileId = Date.now() + Math.random();
        uploadedFiles[uploadType] = [{
            id: fileId,
            file: file,
            name: file.name,
            size: file.size
        }];
        
        console.log('File uploaded successfully, displaying...');
        displayUploadedFile(uploadType);
    }

    function displayUploadedFile(uploadType) {
        // تحديد ID العنصر بناءً على نوع الملف
        let filesListId;
        switch(uploadType) {
            case 'national_id_image':
                filesListId = 'nationalIdFiles';
                break;
            case 'certificate_image':
                filesListId = 'certificateFiles';
                break;
            case 'experience_certificate':
                filesListId = 'experienceFiles';
                break;
            case 'cv':
                filesListId = 'cvFiles';
                break;
            default:
                console.error(`Unknown upload type: ${uploadType}`);
                return;
        }
        
        const filesList = document.getElementById(filesListId);
        
        if (!filesList) {
            console.error(`Files list element not found: ${filesListId}`);
            return;
        }
        
        const files = uploadedFiles[uploadType];
        filesList.innerHTML = '';
        
        if (files.length > 0) {
            const fileData = files[0];
            const fileElement = document.createElement('div');
            fileElement.className = 'uploaded-file';
            fileElement.innerHTML = `
                <div class="file-icon">
                    <i class="fas fa-file"></i>
                </div>
                <div class="file-info">
                    <div class="file-name">${fileData.name}</div>
                    <div class="file-size">${formatFileSize(fileData.size)}</div>
                </div>
                <button type="button" class="file-remove" onclick="removeFile('${uploadType}')">
                    <i class="fas fa-times"></i>
                </button>
            `;
            filesList.appendChild(fileElement);
        }
    }

    window.removeFile = function(uploadType) {
        uploadedFiles[uploadType] = [];
        displayUploadedFile(uploadType);
        
        // مسح قيمة input الملف
        const fileInput = document.querySelector(`[data-upload="${uploadType}"] .file-input`);
        if (fileInput) {
            fileInput.value = '';
        }
    };

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // === التحقق من صحة البيانات ===
    function validateField(field) {
        let isValid = true;
        const value = field.value.trim();
        
        field.classList.remove('is-invalid', 'is-valid');
        
        // التحقق من الحقول المطلوبة
        if (field.hasAttribute('required') && !value) {
            isValid = false;
        }
        
        // التحقق من البريد الإلكتروني
        if (field.type === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            isValid = false;
        }
        
        // التحقق من رقم الهاتف السعودي
        if (field.id === 'phone' && value) {
            const phoneRegex = /^\+966\s?5[0-9]{8}$/;
            if (!phoneRegex.test(value.replace(/\s/g, ''))) {
                isValid = false;
            }
        }
        
        // التحقق من رقم الهوية الوطنية
        if (field.id === 'national_id' && value) {
            if (!/^[0-9]{10}$/.test(value)) {
                isValid = false;
            }
        }
        
        // التحقق من قوة كلمة المرور
        if (field.id === 'password' && value) {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(value)) {
                isValid = false;
            }
        }
        
        // التحقق من تطابق كلمة المرور
        if (field.id === 'password_confirmation' && value) {
            const password = document.getElementById('password');
            if (password && value !== password.value) {
                isValid = false;
            }
        }
        
        // تطبيق الأنماط
        if (!isValid) {
            field.classList.add('is-invalid');
        } else if (value) {
            field.classList.add('is-valid');
        }
        
        return isValid;
    }

    function validateStep(stepNumber) {
        console.log('Validating step:', stepNumber);
        
        if (stepNumber === 1) {
            console.log('Step 1 validation - terms accepted:', termsAccepted);
            return termsAccepted;
        }
        
        const step = document.getElementById(`step${stepNumber}`);
        if (!step) {
            console.error(`Step ${stepNumber} not found`);
            return false;
        }
        
        const requiredFields = step.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        
        console.log('Required fields found:', requiredFields.length);
        
        requiredFields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });
        
        // التحقق من رفع الملفات المطلوبة في الخطوة 4
        if (stepNumber === 4) {
            const requiredUploads = ['national_id_image', 'certificate_image', 'experience_certificate'];
            requiredUploads.forEach(uploadType => {
                if (uploadedFiles[uploadType].length === 0) {
                    console.log(`Missing required file: ${uploadType}`);
                    isValid = false;
                }
            });
        }
        
        console.log('Step validation result:', isValid);
        return isValid;
    }

    // === إعداد التحقق من رقم الهاتف ===
    function setupPhoneVerification() {
        const codeInputs = document.querySelectorAll('.code-input');
        const resendCode = document.getElementById('resendCode');
        const resendTimerSpan = document.getElementById('resendTimer');
        
        if (codeInputs.length === 0) {
            console.error('Code inputs not found');
            return;
        }
        
        // إدارة إدخال رمز التحقق
        codeInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                if (value && index < codeInputs.length - 1) {
                    codeInputs[index + 1].focus();
                }
            });
            
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    codeInputs[index - 1].focus();
                }
            });
        });
        
        // إعداد مؤقت إعادة الإرسال
        function startResendTimer() {
            resendTimer = 60;
            if (resendCode) resendCode.classList.add('disabled');
            
            resendInterval = setInterval(() => {
                resendTimer--;
                if (resendTimerSpan) resendTimerSpan.textContent = resendTimer;
                
                if (resendTimer <= 0) {
                    clearInterval(resendInterval);
                    if (resendCode) {
                        resendCode.classList.remove('disabled');
                        resendCode.innerHTML = 'إعادة الإرسال';
                    }
                }
            }, 1000);
        }
        
        startResendTimer();
        
        if (resendCode) {
            resendCode.addEventListener('click', () => {
                if (!resendCode.classList.contains('disabled')) {
                    console.log('تم إرسال رمز جديد');
                    startResendTimer();
                }
            });
        }
    }

    // === إعداد أزرار التنقل بين الخطوات ===
    
    // الخطوة 1 - الشروط
    const nextStep1Btn = document.getElementById('nextStep1');
    if (nextStep1Btn) {
        nextStep1Btn.addEventListener('click', () => {
            console.log('Next Step 1 clicked');
            if (validateStep(1)) {
                console.log('Step 1 validation passed, moving to step 2');
                showStep(2);
            } else {
                console.log('Step 1 validation failed');
            }
        });
    }

    // الخطوة 2 - بيانات الحساب
    const prevStep2Btn = document.getElementById('prevStep2');
    const nextStep2Btn = document.getElementById('nextStep2');
    
    if (prevStep2Btn) {
        prevStep2Btn.addEventListener('click', () => showStep(1));
    }
    
    if (nextStep2Btn) {
        nextStep2Btn.addEventListener('click', () => {
            if (validateStep(2)) {
                showStep(3);
            }
        });
    }

    // الخطوة 3 - البيانات الشخصية
    const prevStep3Btn = document.getElementById('prevStep3');
    const nextStep3Btn = document.getElementById('nextStep3');
    
    if (prevStep3Btn) {
        prevStep3Btn.addEventListener('click', () => showStep(2));
    }
    
    if (nextStep3Btn) {
        nextStep3Btn.addEventListener('click', () => {
            if (validateStep(3)) {
                showStep(4);
            }
        });
    }

    // الخطوة 4 - المستندات
    const prevStep4Btn = document.getElementById('prevStep4');
    const nextStep4Btn = document.getElementById('nextStep4');
    
    if (prevStep4Btn) {
        prevStep4Btn.addEventListener('click', () => showStep(3));
    }
    
    if (nextStep4Btn) {
        nextStep4Btn.addEventListener('click', () => {
            if (validateStep(4)) {
                // عرض رقم الهاتف في خطوة التحقق
                const phoneNumber = document.getElementById('phone');
                const phoneDisplay = document.getElementById('phoneDisplay');
                if (phoneNumber && phoneDisplay) {
                    phoneDisplay.textContent = phoneNumber.value;
                }
                showStep(5);
                setupPhoneVerification();
            }
        });
    }

    // الخطوة 5 - التحقق من الهاتف
    const prevStep5Btn = document.getElementById('prevStep5');
    const verifyPhoneBtn = document.getElementById('verifyPhone');
    
    if (prevStep5Btn) {
        prevStep5Btn.addEventListener('click', () => showStep(4));
    }
    
    if (verifyPhoneBtn) {
        verifyPhoneBtn.addEventListener('click', () => {
            // التحقق من الرمز
            const codeInputs = document.querySelectorAll('.code-input');
            let code = '';
            codeInputs.forEach(input => code += input.value);
            
            if (code.length === 6) {
                const verifyButton = document.getElementById('verifyPhone');
                if (verifyButton) verifyButton.classList.add('loading');
                
                setTimeout(() => {
                    if (verifyButton) verifyButton.classList.remove('loading');
                    // عرض البريد الإلكتروني في خطوة التحقق
                    const email = document.getElementById('email');
                    const emailDisplay = document.getElementById('emailDisplay');
                    if (email && emailDisplay) {
                        emailDisplay.textContent = email.value;
                    }
                    showStep(6);
                }, 2000);
            } else {
                alert('الرجاء إدخال الرمز كاملاً');
            }
        });
    }

    // الخطوة 6 - التحقق من البريد الإلكتروني وإرسال النموذج
    const submitRegistrationBtn = document.getElementById('submitRegistration');
    if (submitRegistrationBtn) {
        submitRegistrationBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            const submitButton = document.getElementById('submitRegistration');
            const form = document.getElementById('registerForm');
            
            if (!form) {
                console.error('Form not found');
                alert('خطأ في النظام: النموذج غير موجود');
                return;
            }

            if (submitButton) submitButton.classList.add('loading');
            
            try {
                                 // التحقق من وجود جميع البيانات المطلوبة
                 const requiredFields = ['first_name_ar', 'last_name_ar', 'first_name_en', 'last_name_en', 
                                       'email', 'phone', 'password', 'password_confirmation', 
                                       'national_id', 'birth_date', 'gender', 'marital_status', 
                                       'education', 'specialization', 'address'];
                
                let missingFields = [];
                requiredFields.forEach(fieldName => {
                    const field = form.querySelector(`[name="${fieldName}"]`);
                    if (!field || !field.value.trim()) {
                        missingFields.push(fieldName);
                    }
                });
                
                // التحقق من الملفات المطلوبة
                const requiredFiles = ['national_id_image', 'certificate_image', 'experience_certificate'];
                requiredFiles.forEach(fileName => {
                    const fileInput = form.querySelector(`[name="${fileName}"]`);
                    if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                        missingFields.push(fileName);
                    }
                });
                
                if (missingFields.length > 0) {
                    console.error('Missing required fields:', missingFields);
                    alert('يرجى التأكد من ملء جميع البيانات المطلوبة ورفع جميع المستندات المطلوبة');
                    if (submitButton) submitButton.classList.remove('loading');
                    return;
                }
                
                // إرسال النموذج
                console.log('Submitting form to:', form.action);
                form.submit();
                
            } catch (error) {
                console.error('Error during submission:', error);
                alert('حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.');
                if (submitButton) submitButton.classList.remove('loading');
            }
        });
    }

    // === إعداد تبديل إظهار كلمة المرور ===
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const input = toggle.previousElementSibling;
            const icon = toggle.querySelector('i');
            
            if (input && icon) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        });
    });

    // === التحقق المباشر أثناء الكتابة ===
    document.querySelectorAll('input, select, textarea').forEach(field => {
        field.addEventListener('input', () => validateField(field));
        field.addEventListener('blur', () => validateField(field));
    });

    // === التحقق من تاريخ الميلاد ===
    const birthDateInput = document.getElementById('birth_date');
    if (birthDateInput) {
        birthDateInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            const minAge = new Date();
            minAge.setFullYear(today.getFullYear() - 16);
            
            if (selectedDate > minAge) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
                // Show custom error message
                let errorMsg = this.parentNode.querySelector('.form-error-message');
                if (errorMsg) {
                    errorMsg.textContent = 'يجب أن تكون 16 سنة على الأقل للتوظيف';
                    errorMsg.style.display = 'block';
                }
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                // Hide error message
                let errorMsg = this.parentNode.querySelector('.form-error-message');
                if (errorMsg) {
                    errorMsg.style.display = 'none';
                }
            }
        });
    }

    // === تنسيق رقم الهاتف تلقائياً ===
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.startsWith('966')) {
                value = value.substring(3);
            }
            
            if (value.startsWith('5') && value.length <= 9) {
                e.target.value = '+966 ' + value;
            } else if (value.length === 0) {
                e.target.value = '';
            }
        });
    }

    // === إعادة الإرسال للبريد الإلكتروني ===
    const resendEmailBtn = document.getElementById('resendEmail');
    if (resendEmailBtn) {
        resendEmailBtn.addEventListener('click', () => {
            console.log('تم إرسال بريد التحقق مرة أخرى');
        });
    }

    // === تهيئة النماذج والأحداث ===
    setupTermsSection();
    setupFileUpload();
    
    // تهيئة الخطوة الأولى والتقدم
    showStep(1);
    updateProgress();

    console.log('✅ تم تحميل صفحة تسجيل الموظف بنجاح');
});

</script>
</body>
</html>
