@extends('dashboard.index')

@section('content')
<style>

/* Profile Pages Styling */
:root {
    --primary-green: #003c6d;
    --primary-light: #005085;
    --primary-lighter: #e8eff5;
    --primary-lightest: #f4f9fa;
    --primary-dark: #003655;
    --primary-darker: #003858;
    --primary-darkest: #00182b;

    /* تدرجات رمادية */
    --grey-900: #1a1a1a;
    --grey-800: #2c2c2c;
    --grey-700: #424242;
    --grey-500: #757575;
    --grey-300: #e0e0e0;
    --grey-100: #f5f5f5;
    --grey-50: #fafafa;
    --pure-white: #FFFFFF;

    /* ألوان إضافية */
    --success-green: #10b981;
    --warning-orange: #f59e0b;
    --error-red: #ef4444;
    --info-blue: #3b82f6;

    /* التدرجات */
    --gradient-primary: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
    --gradient-light: linear-gradient(135deg, var(--primary-light) 0%, #0067a3 100%);
    --gradient-dark: linear-gradient(135deg, var(--primary-darker) 0%, var(--primary-dark) 100%);

    /* الظلال */
    --shadow-sm: 0 2px 8px rgba(0, 69, 109, 0.08);
    --shadow-md: 0 6px 20px rgba(0, 60, 109, 0.12);
    --shadow-lg: 0 12px 40px rgba(0, 65, 109, 0.15);
    --shadow-xl: 0 25px 65px rgba(0, 74, 109, 0.18);

    /* الخطوط */
    --font-main: 'Neo Sans Arabic', sans-serif;

    /* المتغيرات التقنية */
    --sidebar-width: 340px;
    --header-height: 90px;
    --border-radius-sm: 12px;
    --border-radius-md: 20px;
    --border-radius-lg: 28px;

    /* الانتقالات */
    --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    --transition-medium: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
    --transition-slow: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
}


/* Base Profile Page Styles */
.profile-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background: var(--gray-50);
    min-height: 100vh;
}

/* Enhanced Header Section */
.enhanced-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    border-radius: var(--border-radius-xl);
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
    box-shadow: var(--shadow-xl);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.profile-hero {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.profile-avatar-wrapper {
    position: relative;
}

.profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    color: var(--primary-dark);
    border: 4px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-status-indicator {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid white;
}

.profile-status-indicator.online {
    background: var(--success-color);
}

.profile-status-indicator.offline {
    background: var(--gray-400);
}

.profile-info h1 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
}

.profile-title {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0 0 1rem 0;
}

.profile-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    opacity: 0.8;
}

.header-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: var(--border-radius);
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
}

.action-btn.primary {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.action-btn.primary:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.action-btn.secondary {
    background: transparent;
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.action-btn.secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

/* Profile Completion Card */
.completion-card {
    background: white;
    border-radius: var(--border-radius-lg);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
}

.completion-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.completion-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0;
}

.completion-subtitle {
    color: var(--gray-600);
    margin: 0.25rem 0 0 0;
}

.completion-score {
    position: relative;
}

.score-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: conic-gradient(var(--primary-color) 0deg, var(--primary-color) calc(var(--percentage) * 3.6deg), var(--gray-200) calc(var(--percentage) * 3.6deg), var(--gray-200) 360deg);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.score-circle::before {
    content: '';
    position: absolute;
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
}

.score-text {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--gray-800);
    z-index: 1;
}

.completion-progress {
    margin-top: 1.5rem;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: var(--gray-200);
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 1rem;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary-color), var(--success-color));
    border-radius: 4px;
    transition: width 0.8s ease-in-out;
}

.progress-indicators {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1rem;
}

.indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--gray-600);
}

.indicator.completed {
    color: var(--success-color);
}

.indicator.incomplete {
    color: var(--gray-400);
}

/* Tabbed Content Section */
.profile-tabs-container {
    background: white;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.tabs-navigation {
    display: flex;
    background: var(--gray-50);
    border-bottom: 1px solid var(--gray-200);
    overflow-x: auto;
}

.tab-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 1.5rem;
    background: none;
    border: none;
    color: var(--gray-600);
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    white-space: nowrap;
    min-width: 120px;
    justify-content: center;
}

.tab-btn:hover {
    color: var(--primary-color);
    background: rgba(59, 130, 246, 0.05);
}

.tab-btn.active {
    color: var(--primary-color);
    background: white;
    border-bottom: 2px solid var(--primary-color);
}

.tab-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-left: auto;
}

.tab-indicator.complete {
    background: var(--success-color);
}

.tab-indicator.incomplete {
    background: var(--warning-color);
}

.tabs-content {
    padding: 2rem;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.tab-header {
    margin-bottom: 2rem;
    text-align: center;
}

.tab-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0 0 0.5rem 0;
}

.tab-description {
    color: var(--gray-600);
    margin: 0;
}

/* Content Grid */
.content-grid {
    display: grid;
    gap: 2rem;
}

.info-section {
    background: var(--gray-50);
    border-radius: var(--border-radius);
    padding: 1.5rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.info-item {
    background: white;
    padding: 1rem;
    border-radius: var(--border-radius);
    border: 1px solid var(--gray-200);
}

.info-item.full-width {
    grid-column: 1 / -1;
}

.info-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-600);
    margin-bottom: 0.5rem;
}

.info-value {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
}

.value-text {
    font-weight: 500;
    color: var(--gray-800);
}

.edit-btn {
    background: none;
    border: none;
    color: var(--primary-color);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition);
}

.edit-btn:hover {
    background: var(--primary-light);
}

.verified-badge, .unverified-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.verified-badge {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-color);
}

.unverified-badge {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error-color);
}

/* Info Cards */
.info-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: white;
    padding: 1.5rem;
    border-radius: var(--border-radius);
    border: 1px solid var(--gray-200);
    margin-bottom: 1rem;
}

.card-icon {
    width: 50px;
    height: 50px;
    background: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 1.25rem;
}

.card-content {
    flex: 1;
}

.card-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0 0 0.25rem 0;
}

.card-value {
    color: var(--gray-600);
    margin: 0 0 0.75rem 0;
}

.card-action {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    cursor: pointer;
    transition: var(--transition);
}

.card-action:hover {
    background: var(--primary-dark);
}

/* Certificate Card */
.certificate-card {
    background: white;
    border-radius: var(--border-radius);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.certificate-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--gray-50);
}

.certificate-icon {
    width: 50px;
    height: 50px;
    background: var(--warning-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.certificate-info h4 {
    margin: 0 0 0.25rem 0;
    color: var(--gray-800);
}

.certificate-status {
    margin: 0;
}

.status-uploaded {
    color: var(--success-color);
    font-weight: 500;
}

.status-missing {
    color: var(--gray-500);
}

.certificate-actions {
    padding: 1rem 1.5rem;
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.btn-view, .btn-replace, .btn-upload {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-view {
    background: var(--primary-color);
    color: white;
}

.btn-view:hover {
    background: var(--primary-dark);
}

.btn-replace {
    background: var(--warning-color);
    color: white;
}

.btn-replace:hover {
    background: #d97706;
}

.btn-upload {
    background: var(--success-color);
    color: white;
}

.btn-upload:hover {
    background: #059669;
}

/* Status Grid */
.status-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.status-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: white;
    border-radius: var(--border-radius);
    border: 1px solid var(--gray-200);
}

.status-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.status-indicator.active {
    background: var(--success-color);
}

.status-indicator.inactive {
    background: var(--error-color);
}

.status-indicator.verified {
    background: var(--success-color);
}

.status-indicator.unverified {
    background: var(--warning-color);
}

.status-info {
    display: flex;
    flex-direction: column;
}

.status-label {
    font-size: 0.875rem;
    color: var(--gray-600);
}

.status-value {
    font-weight: 500;
    color: var(--gray-800);
}

/* Skills Section */
.skills-section {
    background: var(--gray-50);
    border-radius: var(--border-radius);
    padding: 1.5rem;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.add-skill-btn {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.add-skill-btn:hover {
    background: var(--primary-dark);
}

.skills-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.skill-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: white;
    border: 1px solid var(--primary-color);
    border-radius: 20px;
    color: var(--primary-color);
    font-size: 0.875rem;
    transition: var(--transition);
}

.skill-tag:hover {
    background: var(--primary-color);
    color: white;
}

.skill-remove {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0;
    font-size: 0.75rem;
    opacity: 0.7;
    transition: var(--transition);
}

.skill-remove:hover {
    opacity: 1;
}

.empty-skills, .empty-bio {
    text-align: center;
    padding: 2rem;
    color: var(--gray-500);
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.3;
}

.empty-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
}

.empty-description {
    margin: 0 0 1.5rem 0;
    line-height: 1.5;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius);
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

/* Bio Section */
.bio-section {
    background: var(--gray-50);
    border-radius: var(--border-radius);
    padding: 1.5rem;
}

.edit-bio-btn {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius);
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.edit-bio-btn:hover {
    background: var(--primary-dark);
}

.bio-content {
    background: white;
    padding: 1.5rem;
    border-radius: var(--border-radius);
    border: 1px solid var(--gray-200);
}

.bio-text {
    line-height: 1.6;
    color: var(--gray-700);
    margin-bottom: 1rem;
}

.bio-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.875rem;
    color: var(--gray-500);
}

/* Documents Grid */
.documents-grid {
    display: grid;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.document-card {
    background: white;
    border-radius: var(--border-radius);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.document-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--gray-50);
}

.document-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.cv-card .document-icon {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error-color);
}

.id-card .document-icon {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-color);
}

.certificate-card .document-icon {
    background: rgba(59, 130, 246, 0.1);
    color: var(--primary-color);
}

.document-info h4 {
    margin: 0 0 0.25rem 0;
    color: var(--gray-800);
}

.document-description {
    margin: 0;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.document-status {
    margin-left: auto;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-badge.uploaded {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-color);
}

.status-badge.missing {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error-color);
}

.document-actions {
    padding: 1rem 1.5rem;
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.btn-action {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-action.view {
    background: var(--primary-color);
    color: white;
}

.btn-action.view:hover {
    background: var(--primary-dark);
}

.btn-action.download {
    background: var(--success-color);
    color: white;
}

.btn-action.download:hover {
    background: #059669;
}

.btn-action.replace {
    background: var(--warning-color);
    color: white;
}

.btn-action.replace:hover {
    background: #d97706;
}

.btn-action.upload {
    background: var(--success-color);
    color: white;
}

.btn-action.upload:hover {
    background: #059669;
}

.btn-action.upload.primary {
    background: var(--primary-color);
}

.btn-action.upload.primary:hover {
    background: var(--primary-dark);
}

/* Documents Summary */
.documents-summary {
    margin-top: 2rem;
}

.summary-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: var(--gray-50);
    padding: 1.5rem;
    border-radius: var(--border-radius);
    border: 1px solid var(--gray-200);
}

.summary-icon {
    width: 50px;
    height: 50px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.summary-content h4 {
    margin: 0 0 0.5rem 0;
    color: var(--gray-800);
}

.summary-stats {
    color: var(--gray-600);
    margin: 0 0 0.75rem 0;
}

.summary-progress .progress-bar {
    width: 200px;
    height: 6px;
}

/* Settings Sections */
.settings-sections {
    display: grid;
    gap: 2rem;
}

.settings-card {
    background: white;
    border-radius: var(--border-radius);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.settings-card.danger-zone {
    border-color: var(--error-color);
}

.settings-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--gray-50);
    border-bottom: 1px solid var(--gray-200);
}

.settings-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.settings-card:not(.danger-zone) .settings-icon {
    background: var(--primary-light);
    color: var(--primary-color);
}

.danger-zone .settings-icon {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error-color);
}

.settings-info h3 {
    margin: 0 0 0.25rem 0;
    color: var(--gray-800);
}

.settings-description {
    margin: 0;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.settings-form {
    padding: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 500;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
}

.form-input, .form-textarea, .form-select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--gray-300);
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    transition: var(--transition);
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
}

.form-file {
    padding: 0.5rem;
}

.form-help {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: var(--gray-500);
    display: flex;
    justify-content: space-between;
}

.char-count.error {
    color: var(--error-color);
}

.form-error {
    color: var(--error-color);
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.btn-save, .btn-delete {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: var(--border-radius);
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-save {
    background: var(--success-color);
    color: white;
}

.btn-save:hover {
    background: #059669;
}

.btn-delete {
    background: var(--error-color);
    color: white;
}

.btn-delete:hover {
    background: #dc2626;
}

.btn-secondary {
    background: var(--gray-300);
    color: var(--gray-700);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius);
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
}

.btn-secondary:hover {
    background: var(--gray-400);
}

.danger-actions {
    padding: 1.5rem;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: var(--transition);
}

.modal-overlay.active {
    opacity: 1;
    visibility: visible;
}

.modal-container {
    background: white;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-xl);
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    transform: scale(0.9);
    transition: var(--transition);
}

.modal-overlay.active .modal-container {
    transform: scale(1);
}

.modal-container.large {
    max-width: 700px;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid var(--gray-200);
}

.modal-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-800);
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--gray-400);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition);
}

.modal-close:hover {
    color: var(--gray-600);
    background: var(--gray-100);
}

.modal-body {
    padding: 1.5rem;
}

/* Toast Notifications */
.toast-container {
    position: fixed;
    top: 2rem;
    right: 2rem;
    z-index: 1001;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.toast {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    min-width: 300px;
    transform: translateX(100%);
    transition: var(--transition);
}

.toast.show {
    transform: translateX(0);
}

.toast.success {
    border-left: 4px solid var(--success-color);
}

.toast.error {
    border-left: 4px solid var(--error-color);
}

.toast-icon {
    font-size: 1.25rem;
}

.toast.success .toast-icon {
    color: var(--success-color);
}

.toast.error .toast-icon {
    color: var(--error-color);
}

.toast-content {
    flex: 1;
}

.toast-title {
    margin: 0 0 0.25rem 0;
    font-weight: 600;
    color: var(--gray-800);
}

.toast-message {
    margin: 0;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.toast-close {
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition);
}

.toast-close:hover {
    color: var(--gray-600);
    background: var(--gray-100);
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-page {
        padding: 1rem;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .profile-hero {
        flex-direction: column;
        text-align: center;
    }
    
    .header-actions {
        justify-content: center;
    }
    
    .completion-header {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .tabs-navigation {
        flex-wrap: wrap;
    }
    
    .tab-btn {
        min-width: auto;
        flex: 1;
        justify-content: center;
    }
    
    .tabs-content {
        padding: 1rem;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .document-actions {
        flex-direction: column;
    }
    
    .btn-action {
        width: 100%;
        justify-content: center;
    }
    
    .modal-container {
        width: 95%;
        margin: 1rem;
    }
    
    .toast-container {
        left: 1rem;
        right: 1rem;
    }
    
    .toast {
        min-width: auto;
    }
}

@media (max-width: 480px) {
    .profile-page {
        padding: 0.5rem;
    }
    
    .enhanced-header {
        padding: 1rem;
    }
    
    .profile-avatar {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .profile-info h1 {
        font-size: 1.5rem;
    }
    
    .completion-card {
        padding: 1rem;
    }
    
    .tabs-content {
        padding: 0.5rem;
    }
    
    .info-section {
        padding: 1rem;
    }
    
    .modal-body {
        padding: 1rem;
    }
}

/* Print Styles */
@media print {
    .profile-page {
        background: white;
        padding: 0;
    }
    
    .enhanced-header {
        background: white !important;
        color: black !important;
        box-shadow: none;
    }
    
    .action-btn, .edit-btn, .modal-overlay, .toast-container {
        display: none !important;
    }
    
    .tab-pane {
        display: block !important;
        page-break-inside: avoid;
    }
    
    .tabs-navigation {
        display: none !important;
    }
}

</style>
<div class="profile-page">
    <!-- Enhanced Header Section -->
    <div class="page-header enhanced-header">
        <div class="header-content">
            <div class="profile-hero">
                <div class="profile-avatar-wrapper">
                    <div class="profile-avatar">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}">
                        @else
                            <span>{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="profile-status-indicator {{ $user->is_active ? 'online' : 'offline' }}"></div>
                </div>
                <div class="profile-info">
                    <h1 class="profile-name">{{ $user->name ?? __('User Name') }}</h1>
                    <p class="profile-title">{{ $user->specialization ?? __('Professional') }}</p>
                    <div class="profile-meta">
                        <span class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $user->address ?? __('Location not set') }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            {{ __('Member since') }} {{ $user->created_at->format('M Y') }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-shield-check"></i>
                            {{ $user->email_verified_at ? __('Verified') : __('Unverified') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="header-actions">
                <button class="action-btn primary" data-action="edit">
                    <i class="fas fa-edit"></i>
                    <span>{{ __('Edit Profile') }}</span>
                </button>
                <button class="action-btn secondary" data-action="download">
                    <i class="fas fa-download"></i>
                    <span>{{ __('Export CV') }}</span>
                </button>
                <button class="action-btn secondary" data-action="share">
                    <i class="fas fa-share-alt"></i>
                    <span>{{ __('Share') }}</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Completion Progress -->
    @php
        $completionData = [
            'personal' => !empty($user->name) && !empty($user->email) && !empty($user->phone),
            'professional' => !empty($user->education) && !empty($user->specialization),
            'skills' => !empty($user->skills) && is_array($user->skills) && count($user->skills) > 0,
            'documents' => !empty($user->cv) || !empty($user->national_id_image) || !empty($user->certificate_image)
        ];
        $completedSections = array_sum($completionData);
        $totalSections = count($completionData);
        $completionPercentage = round(($completedSections / $totalSections) * 100);
    @endphp

    <div class="completion-card">
        <div class="completion-header">
            <div class="completion-info">
                <h3 class="completion-title">{{ __('Profile Completion') }}</h3>
                <p class="completion-subtitle">{{ $completedSections }}/{{ $totalSections }} {{ __('sections completed') }}</p>
            </div>
            <div class="completion-score">
                <div class="score-circle" data-percentage="{{ $completionPercentage }}">
                    <span class="score-text">{{ $completionPercentage }}%</span>
                </div>
            </div>
        </div>
        <div class="completion-progress">
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $completionPercentage }}%"></div>
            </div>
            <div class="progress-indicators">
                <div class="indicator {{ $completionData['personal'] ? 'completed' : 'incomplete' }}">
                    <i class="fas {{ $completionData['personal'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                    <span>{{ __('Personal') }}</span>
                </div>
                <div class="indicator {{ $completionData['professional'] ? 'completed' : 'incomplete' }}">
                    <i class="fas {{ $completionData['professional'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                    <span>{{ __('Professional') }}</span>
                </div>
                <div class="indicator {{ $completionData['skills'] ? 'completed' : 'incomplete' }}">
                    <i class="fas {{ $completionData['skills'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                    <span>{{ __('Skills') }}</span>
                </div>
                <div class="indicator {{ $completionData['documents'] ? 'completed' : 'incomplete' }}">
                    <i class="fas {{ $completionData['documents'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                    <span>{{ __('Documents') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabbed Content Section -->
    <div class="profile-tabs-container">
        <div class="tabs-navigation">
            <button class="tab-btn active" data-tab="personal">
                <i class="fas fa-user"></i>
                <span>{{ __('Personal Info') }}</span>
                <div class="tab-indicator {{ $completionData['personal'] ? 'complete' : 'incomplete' }}"></div>
            </button>
            <button class="tab-btn" data-tab="professional">
                <i class="fas fa-briefcase"></i>
                <span>{{ __('Professional') }}</span>
                <div class="tab-indicator {{ $completionData['professional'] ? 'complete' : 'incomplete' }}"></div>
            </button>
            <button class="tab-btn" data-tab="skills">
                <i class="fas fa-star"></i>
                <span>{{ __('Skills & Bio') }}</span>
                <div class="tab-indicator {{ $completionData['skills'] ? 'complete' : 'incomplete' }}"></div>
            </button>
            <button class="tab-btn" data-tab="documents">
                <i class="fas fa-file-alt"></i>
                <span>{{ __('Documents') }}</span>
                <div class="tab-indicator {{ $completionData['documents'] ? 'complete' : 'incomplete' }}"></div>
            </button>
            <button class="tab-btn" data-tab="settings">
                <i class="fas fa-cog"></i>
                <span>{{ __('Settings') }}</span>
            </button>
        </div>

        <div class="tabs-content">
            <!-- Personal Information Tab -->
            <div class="tab-pane active" id="personal-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Personal Information') }}</h2>
                    <p class="tab-description">{{ __('Manage your personal details and contact information') }}</p>
                </div>

                <div class="content-grid">
                    <div class="info-section">
                        <h3 class="section-title">{{ __('Basic Information') }}</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label class="info-label">{{ __('Full Name') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->name ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Email Address') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->email }}</span>
                                    @if($user->email_verified_at)
                                        <span class="verified-badge"><i class="fas fa-check-circle"></i> {{ __('Verified') }}</span>
                                    @else
                                        <span class="unverified-badge"><i class="fas fa-exclamation-circle"></i> {{ __('Unverified') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Phone Number') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->phone ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('National ID') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->national_id ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">{{ __('Personal Details') }}</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label class="info-label">{{ __('Date of Birth') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->birth_date ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Gender') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->gender ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Marital Status') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->marital_status ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Address') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->address ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">{{ __('Language Preferences') }}</h3>
                        <div class="info-grid">
                            <div class="info-item full-width">
                                <label class="info-label">{{ __('Arabic Name') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->first_name_ar ?? __('Not set') }} {{ $user->last_name_ar ?? '' }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item full-width">
                                <label class="info-label">{{ __('English Name') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->first_name_en ?? __('Not set') }} {{ $user->last_name_en ?? '' }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Information Tab -->
            <div class="tab-pane" id="professional-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Professional Information') }}</h2>
                    <p class="tab-description">{{ __('Manage your professional background and qualifications') }}</p>
                </div>

                <div class="content-grid">
                    <div class="info-section">
                        <h3 class="section-title">{{ __('Education & Qualifications') }}</h3>
                        <div class="info-card">
                            <div class="card-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">{{ __('Education Level') }}</h4>
                                <p class="card-value">{{ $user->education ?? __('Not specified') }}</p>
                                <button class="card-action">{{ __('Update Education') }}</button>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="card-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">{{ __('Specialization') }}</h4>
                                <p class="card-value">{{ $user->specialization ?? __('Not specified') }}</p>
                                <button class="card-action">{{ __('Update Specialization') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">{{ __('Experience & Certification') }}</h3>
                        <div class="certificate-card">
                            <div class="certificate-header">
                                <i class="fas fa-award certificate-icon"></i>
                                <div class="certificate-info">
                                    <h4 class="certificate-title">{{ __('Experience Certificate') }}</h4>
                                    <p class="certificate-status">
                                        @if($user->experience_certificate)
                                            <span class="status-uploaded">{{ __('Certificate uploaded') }}</span>
                                        @else
                                            <span class="status-missing">{{ __('No certificate uploaded') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="certificate-actions">
                                @if($user->experience_certificate)
                                    <a href="{{ asset('storage/' . $user->experience_certificate) }}" target="_blank" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                        {{ __('View Certificate') }}
                                    </a>
                                    <button class="btn-replace">{{ __('Replace') }}</button>
                                @else
                                    <button class="btn-upload">{{ __('Upload Certificate') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">{{ __('Account Status') }}</h3>
                        <div class="status-grid">
                            <div class="status-item">
                                <div class="status-indicator {{ $user->is_active ? 'active' : 'inactive' }}"></div>
                                <div class="status-info">
                                    <span class="status-label">{{ __('Account Status') }}</span>
                                    <span class="status-value">{{ $user->is_active ? __('Active') : __('Inactive') }}</span>
                                </div>
                            </div>
                            <div class="status-item">
                                <div class="status-indicator {{ $user->email_verified_at ? 'verified' : 'unverified' }}"></div>
                                <div class="status-info">
                                    <span class="status-label">{{ __('Email Status') }}</span>
                                    <span class="status-value">{{ $user->email_verified_at ? __('Verified') : __('Not Verified') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills & Bio Tab -->
            <div class="tab-pane" id="skills-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Skills & Biography') }}</h2>
                    <p class="tab-description">{{ __('Showcase your skills and tell your professional story') }}</p>
                </div>

                <div class="content-grid">
                    <div class="skills-section">
                        <div class="section-header">
                            <h3 class="section-title">{{ __('Professional Skills') }}</h3>
                            <button class="add-skill-btn">
                                <i class="fas fa-plus"></i>
                                {{ __('Add Skill') }}
                            </button>
                        </div>
                        
                        @if($user->skills && is_array($user->skills) && count($user->skills) > 0)
                            <div class="skills-grid">
                                @foreach($user->skills as $index => $skill)
                                    <div class="skill-tag" data-skill="{{ $skill }}">
                                        <span class="skill-name">{{ $skill }}</span>
                                        <button class="skill-remove" data-index="{{ $index }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-skills">
                                <div class="empty-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h4 class="empty-title">{{ __('No skills added yet') }}</h4>
                                <p class="empty-description">{{ __('Add your professional skills to showcase your expertise to potential employers.') }}</p>
                                <button class="btn-primary add-first-skill">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Add Your First Skill') }}
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="bio-section">
                        <div class="section-header">
                            <h3 class="section-title">{{ __('Professional Biography') }}</h3>
                            <button class="edit-bio-btn">
                                <i class="fas fa-edit"></i>
                                {{ __('Edit Bio') }}
                            </button>
                        </div>
                        
                        @if($user->bio)
                            <div class="bio-content">
                                <div class="bio-text">{{ $user->bio }}</div>
                                <div class="bio-meta">
                                    <span class="bio-length">{{ strlen($user->bio) }} {{ __('characters') }}</span>
                                    <span class="bio-updated">{{ __('Last updated') }}: {{ $user->updated_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        @else
                            <div class="empty-bio">
                                <div class="empty-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <h4 class="empty-title">{{ __('No biography written yet') }}</h4>
                                <p class="empty-description">{{ __('Write a compelling professional biography to introduce yourself to potential employers.') }}</p>
                                <button class="btn-primary write-bio-btn">
                                    <i class="fas fa-pen"></i>
                                    {{ __('Write Your Bio') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
            <div class="tab-pane" id="documents-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Documents & Files') }}</h2>
                    <p class="tab-description">{{ __('Manage your professional documents and certificates') }}</p>
                </div>

                <div class="documents-grid">
                    <div class="document-card cv-card">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-info">
                                <h4 class="document-title">{{ __('Curriculum Vitae (CV)') }}</h4>
                                <p class="document-description">{{ __('Your professional resume') }}</p>
                            </div>
                            <div class="document-status">
                                @if($user->cv)
                                    <span class="status-badge uploaded">{{ __('Uploaded') }}</span>
                                @else
                                    <span class="status-badge missing">{{ __('Missing') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="document-actions">
                            @if($user->cv)
                                <a href="{{ asset('storage/' . $user->cv) }}" target="_blank" class="btn-action view">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}
                                </a>
                                <button class="btn-action download">
                                    <i class="fas fa-download"></i>
                                    {{ __('Download') }}
                                </button>
                                <button class="btn-action replace">
                                    <i class="fas fa-sync"></i>
                                    {{ __('Replace') }}
                                </button>
                            @else
                                <button class="btn-action upload primary">
                                    <i class="fas fa-upload"></i>
                                    {{ __('Upload CV') }}
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="document-card id-card">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div class="document-info">
                                <h4 class="document-title">{{ __('National ID') }}</h4>
                                <p class="document-description">{{ __('Identity verification document') }}</p>
                            </div>
                            <div class="document-status">
                                @if($user->national_id_image)
                                    <span class="status-badge uploaded">{{ __('Uploaded') }}</span>
                                @else
                                    <span class="status-badge missing">{{ __('Missing') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="document-actions">
                            @if($user->national_id_image)
                                <a href="{{ asset('storage/' . $user->national_id_image) }}" target="_blank" class="btn-action view">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}
                                </a>
                                <button class="btn-action download">
                                    <i class="fas fa-download"></i>
                                    {{ __('Download') }}
                                </button>
                                <button class="btn-action replace">
                                    <i class="fas fa-sync"></i>
                                    {{ __('Replace') }}
                                </button>
                            @else
                                <button class="btn-action upload primary">
                                    <i class="fas fa-upload"></i>
                                    {{ __('Upload ID') }}
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="document-card certificate-card">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="document-info">
                                <h4 class="document-title">{{ __('Certificates') }}</h4>
                                <p class="document-description">{{ __('Professional certificates and qualifications') }}</p>
                            </div>
                            <div class="document-status">
                                @if($user->certificate_image)
                                    <span class="status-badge uploaded">{{ __('Uploaded') }}</span>
                                @else
                                    <span class="status-badge missing">{{ __('Missing') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="document-actions">
                            @if($user->certificate_image)
                                <a href="{{ asset('storage/' . $user->certificate_image) }}" target="_blank" class="btn-action view">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}
                                </a>
                                <button class="btn-action download">
                                    <i class="fas fa-download"></i>
                                    {{ __('Download') }}
                                </button>
                                <button class="btn-action replace">
                                    <i class="fas fa-sync"></i>
                                    {{ __('Replace') }}
                                </button>
                            @else
                                <button class="btn-action upload primary">
                                    <i class="fas fa-upload"></i>
                                    {{ __('Upload Certificate') }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="documents-summary">
                    <div class="summary-card">
                        <div class="summary-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="summary-content">
                            <h4 class="summary-title">{{ __('Documents Overview') }}</h4>
                            @php
                                $uploadedDocs = 0;
                                if($user->cv) $uploadedDocs++;
                                if($user->national_id_image) $uploadedDocs++;
                                if($user->certificate_image) $uploadedDocs++;
                                $totalDocs = 3;
                            @endphp
                            <p class="summary-stats">{{ $uploadedDocs }}/{{ $totalDocs }} {{ __('documents uploaded') }}</p>
                            <div class="summary-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ ($uploadedDocs / $totalDocs) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="tab-pane" id="settings-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Account Settings') }}</h2>
                    <p class="tab-description">{{ __('Manage your account preferences and security settings') }}</p>
                </div>

                <div class="settings-sections">
                    <!-- Profile Settings -->
                    <div class="settings-card">
                        <div class="settings-header">
                            <div class="settings-icon">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <div class="settings-info">
                                <h3 class="settings-title">{{ __('Profile Information') }}</h3>
                                <p class="settings-description">{{ __('Update your account\'s profile information and email address') }}</p>
                            </div>
                        </div>
                        <form method="post" action="{{ route('profile.update') }}" class="settings-form">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-save">
                                    <i class="fas fa-save"></i>
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Password Settings -->
                    <div class="settings-card">
                        <div class="settings-header">
                            <div class="settings-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="settings-info">
                                <h3 class="settings-title">{{ __('Password Security') }}</h3>
                                <p class="settings-description">{{ __('Ensure your account is using a long, random password to stay secure') }}</p>
                            </div>
                        </div>
                        <form method="post" action="{{ route('password.update') }}" class="settings-form">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                                <input id="current_password" name="current_password" type="password" class="form-input">
                                @error('current_password', 'updatePassword')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">{{ __('New Password') }}</label>
                                <input id="password" name="password" type="password" class="form-input">
                                @error('password', 'updatePassword')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-input">
                                @error('password_confirmation', 'updatePassword')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-save">
                                    <i class="fas fa-save"></i>
                                    {{ __('Update Password') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Account Deletion -->
                    <div class="settings-card danger-zone">
                        <div class="settings-header">
                            <div class="settings-icon">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            <div class="settings-info">
                                <h3 class="settings-title">{{ __('Delete Account') }}</h3>
                                <p class="settings-description">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
                            </div>
                        </div>
                        <div class="danger-actions">
                            <button type="button" class="btn-delete" data-action="delete-account">
                                <i class="fas fa-trash"></i>
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Forms -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('Edit Information') }}</h3>
                <button class="modal-close" data-action="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="edit-form" id="editForm">
                    <div class="form-group">
                        <label class="form-label">{{ __('Field Label') }}</label>
                        <input type="text" class="form-input" id="editField" name="field_value">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" data-action="close-modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn-primary">{{ __('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Add Skill -->
    <div class="modal-overlay" id="skillModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('Add New Skill') }}</h3>
                <button class="modal-close" data-action="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="skill-form" id="skillForm">
                    <div class="form-group">
                        <label for="skillName" class="form-label">{{ __('Skill Name') }}</label>
                        <input type="text" class="form-input" id="skillName" name="skill_name" placeholder="{{ __('e.g., JavaScript, Project Management') }}" required>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" data-action="close-modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn-primary">{{ __('Add Skill') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Bio Editor -->
    <div class="modal-overlay" id="bioModal">
        <div class="modal-container large">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('Edit Biography') }}</h3>
                <button class="modal-close" data-action="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="bio-form" id="bioForm">
                    <div class="form-group">
                        <label for="bioText" class="form-label">{{ __('Professional Biography') }}</label>
                        <textarea class="form-textarea" id="bioText" name="bio_text" rows="6" placeholder="{{ __('Tell your professional story...') }}">{{ $user->bio ?? '' }}</textarea>
                        <div class="form-help">
                            <span class="char-count">{{ __('0 characters') }}</span>
                            <span class="char-limit">{{ __('Maximum 500 characters') }}</span>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" data-action="close-modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn-primary">{{ __('Save Biography') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Document Upload -->
    <div class="modal-overlay" id="uploadModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('Upload Document') }}</h3>
                <button class="modal-close" data-action="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="upload-form" id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="documentFile" class="form-label">{{ __('Select File') }}</label>
                        <input type="file" class="form-file" id="documentFile" name="document_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                        <div class="form-help">
                            <p>{{ __('Supported formats: PDF, DOC, DOCX, JPG, JPEG, PNG') }}</p>
                            <p>{{ __('Maximum file size: 5MB') }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="documentType" class="form-label">{{ __('Document Type') }}</label>
                        <select class="form-select" id="documentType" name="document_type" required>
                            <option value="">{{ __('Select document type') }}</option>
                            <option value="cv">{{ __('Curriculum Vitae (CV)') }}</option>
                            <option value="national_id">{{ __('National ID') }}</option>
                            <option value="certificate">{{ __('Certificate') }}</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" data-action="close-modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn-primary">{{ __('Upload Document') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success/Error Toast Notifications -->

</div>

<!-- JavaScript for Profile Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab Navigation
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            // Remove active class from all tabs and panes
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding pane
            this.classList.add('active');
            document.getElementById(targetTab + '-tab').classList.add('active');
        });
    });

    // Modal Management
    const modals = document.querySelectorAll('.modal-overlay');
    const modalCloseBtns = document.querySelectorAll('[data-action="close-modal"]');
    
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    
    modalCloseBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.modal-overlay');
            closeModal(modal.id);
        });
    });
    
    // Close modal when clicking outside
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });

    // Edit Buttons
    const editBtns = document.querySelectorAll('.edit-btn');
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const infoItem = this.closest('.info-item');
            const label = infoItem.querySelector('.info-label').textContent;
            const currentValue = infoItem.querySelector('.value-text').textContent;
            
            document.querySelector('#editModal .modal-title').textContent = `Edit ${label}`;
            document.querySelector('#editField').value = currentValue;
            document.querySelector('#editField').name = label.toLowerCase().replace(/\s+/g, '_');
            
            openModal('editModal');
        });
    });

    // Add Skill Button
    const addSkillBtns = document.querySelectorAll('.add-skill-btn, .add-first-skill');
    addSkillBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            openModal('skillModal');
        });
    });

    // Edit Bio Button
    const editBioBtns = document.querySelectorAll('.edit-bio-btn, .write-bio-btn');
    editBioBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            openModal('bioModal');
        });
    });

    // Document Upload Buttons
    const uploadBtns = document.querySelectorAll('.btn-upload');
    uploadBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const documentCard = this.closest('.document-card');
            const documentType = documentCard.classList.contains('cv-card') ? 'cv' : 
                               documentCard.classList.contains('id-card') ? 'national_id' : 'certificate';
            
            document.querySelector('#documentType').value = documentType;
            openModal('uploadModal');
        });
    });

    // Character Count for Bio
    const bioTextarea = document.getElementById('bioText');
    const charCount = document.querySelector('.char-count');
    if (bioTextarea && charCount) {
        bioTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length} characters`;
            
            if (length > 500) {
                this.classList.add('error');
                charCount.classList.add('error');
            } else {
                this.classList.remove('error');
                charCount.classList.remove('error');
            }
        });
    }

    // Form Submissions
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success toast (in real app, this would handle actual form submission)
            showToast('success', 'Your changes have been saved successfully.');
            
            // Close modal if it's open
            const modal = this.closest('.modal-overlay');
            if (modal) {
                closeModal(modal.id);
            }
        });
    });

    // Toast Notifications
    function showToast(type, message) {
        const toast = document.getElementById(type + 'Toast');
        const messageEl = toast.querySelector('.toast-message');
        
        messageEl.textContent = message;
        toast.classList.add('show');
        
        setTimeout(() => {
            toast.classList.remove('show');
        }, 5000);
    }

    // Toast Close Buttons
    const toastCloseBtns = document.querySelectorAll('.toast-close');
    toastCloseBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const toast = this.closest('.toast');
            toast.classList.remove('show');
        });
    });

    // Profile Completion Animation
    const scoreCircle = document.querySelector('.score-circle');
    if (scoreCircle) {
        const percentage = scoreCircle.dataset.percentage;
        const circumference = 2 * Math.PI * 45; // Assuming radius of 45
        
        scoreCircle.style.setProperty('--circumference', circumference);
        scoreCircle.style.setProperty('--percentage', percentage);
    }

    // Action Buttons
    const actionBtns = document.querySelectorAll('.action-btn');
    actionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.dataset.action;
            
            switch(action) {
                case 'edit':
                    // Switch to personal info tab
                    document.querySelector('[data-tab="personal"]').click();
                    break;
                case 'download':
                    // Handle CV download
                    if ('{{ $user->cv }}') {
                        window.open('{{ asset("storage/" . $user->cv) }}', '_blank');
                    } else {
                        showToast('error', 'No CV available for download.');
                    }
                    break;
                case 'share':
                    // Handle profile sharing
                    if (navigator.share) {
                        navigator.share({
                            title: '{{ $user->name }} - Professional Profile',
                            url: window.location.href
                        });
                    } else {
                        // Fallback: copy to clipboard
                        navigator.clipboard.writeText(window.location.href);
                        showToast('success', 'Profile link copied to clipboard!');
                    }
                    break;
            }
        });
    });
});
</script>

@endsection