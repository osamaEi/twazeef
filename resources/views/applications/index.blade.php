@extends('dashboard.index')

@section('content')
<div class="applications-page">
    <!-- Enhanced Header Section -->
    <div class="enhanced-header">
        <div class="header-content">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-list-alt header-icon"></i>
                    طلبات التقديم
                </h1>
                <p class="page-subtitle">
                    @if(auth()->user()->role === 'company')
                        إدارة طلبات التقديم للوظائف المنشورة
                    @else
                        متابعة طلبات التقديم المرسلة
                    @endif
                </p>
            </div>
            <div class="header-actions">
                <button class="btn-with-icon" onclick="exportTable()">
                    <i class="fas fa-download"></i>
                    <span>تصدير البيانات</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview enhanced-stats">
        @if(auth()->user()->role === 'company')
            <div class="stat-card warning enhanced-stat">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $applications->where('status', 'pending')->count() }}</h3>
                    <p class="stat-label">قيد المراجعة</p>
                    <div class="stat-change neutral">
                        <i class="fas fa-clock"></i>
                        <span>بانتظار</span>
                    </div>
                </div>
            </div>
            
            <div class="stat-card success enhanced-stat">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $applications->where('status', 'shortlisted')->count() }}</h3>
                    <p class="stat-label">القائمة المختصرة</p>
                    <div class="stat-change positive">
                        <i class="fas fa-star"></i>
                        <span>مميز</span>
                    </div>
                </div>
            </div>

            <div class="stat-card info enhanced-stat">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ $applications->where('status', 'accepted')->count() }}</h3>
                    <p class="stat-label">مقبول</p>
                    <div class="stat-change positive">
                        <i class="fas fa-thumbs-up"></i>
                        <span>تم القبول</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Data Table Section -->
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                    <i class="fas fa-list-alt"></i>
                    طلبات التقديم
            </h3>
            <div class="table-actions">
                <button class="btn btn-primary" onclick="exportTable()">
                    <i class="fas fa-download"></i>
                    تصدير Excel
                    </button>
                <button class="btn btn-secondary" onclick="refreshTable()">
                    <i class="fas fa-sync-alt"></i>
                    تحديث
                    </button>
                </div>
            </div>
        <div class="table-content">
            <table class="main-table">
                <thead>
                    <tr>
                @if(auth()->user()->role === 'company')
                            <th>المتقدم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الهاتف</th>
                @endif
                        <th>الوظيفة</th>
                        <th>الشركة</th>
                        <th>الموقع</th>
                        <th>الحالة</th>
                        <th>تاريخ التقديم</th>
                        <th>خطاب التقديم</th>
                        <th>السيرة الذاتية</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr>
                            @if(auth()->user()->role === 'company')
                                <td>
                                    <div class="applicant-info">
                                        <div class="applicant-avatar">
                                            {{ strtoupper(substr($application->applicant->name, 0, 1)) }}
                                        </div>
                                        <span class="font-semibold">{{ $application->applicant->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $application->applicant->email }}</td>
                                <td>{{ $application->applicant->phone ?? 'غير محدد' }}</td>
                            @endif
                            <td class="font-semibold">{{ $application->job->title }}</td>
                            <td>{{ $application->job->company->name ?? 'غير محدد' }}</td>
                            <td>{{ $application->job->location ?? 'غير محدد' }}</td>
                            <td>
                                    @php
                                        $statusConfig = [
                                        'pending' => ['class' => 'pending', 'text' => 'قيد المراجعة'],
                                        'shortlisted' => ['class' => 'review', 'text' => 'القائمة المختصرة'],
                                        'interviewed' => ['class' => 'active', 'text' => 'تمت المقابلة'],
                                        'accepted' => ['class' => 'active', 'text' => 'مقبول'],
                                        'rejected' => ['class' => 'inactive', 'text' => 'مرفوض']
                                        ];
                                        $status = $statusConfig[$application->status ?? 'pending'] ?? $statusConfig['pending'];
                                    @endphp
                                <span class="status-badge {{ $status['class'] }}">{{ $status['text'] }}</span>
                            </td>
                            <td>{{ $application->applied_at ? $application->applied_at->format('Y/m/d') : $application->created_at->format('Y/m/d') }}</td>
                            <td>
                                @if($application->cover_letter)
                                    <span class="text-sm" title="{{ $application->cover_letter }}">
                                        {{ Str::limit($application->cover_letter, 30) }}
                                    </span>
                                @else
                                    <span class="text-muted">لا يوجد</span>
                                        @endif
                            </td>
                            <td>
                            @if($application->resume_path)
                                    <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-file-pdf"></i>
                                        عرض السيرة
                                    </a>
                                @else
                                    <span class="text-muted">لا يوجد</span>
                            @endif
                            </td>
                            <td>
                                <div class="flex gap-1">
                                    <a href="{{ route('applications.show', $application) }}" class="btn btn-outline">عرض</a>
                                    @if(auth()->user()->role === 'company')
                                        <a href="{{ route('jobs.applications.show', ['job' => $application->job, 'application' => $application]) }}" class="btn btn-secondary">إدارة</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
    </div>
</div>

<style>
/* CSS Variables */
:root {
    /* الألوان الأساسية */
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

/* Enhanced Header */
.enhanced-header {
    background: var(--gradient-primary);
    border-radius: var(--border-radius-lg);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-lg);
}

.enhanced-header .page-title {
    color: var(--pure-white);
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    font-weight: 700;
    font-family: var(--font-main);
}

.enhanced-header .page-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    line-height: 1.6;
    font-family: var(--font-main);
}

.header-icon {
    margin-left: 1rem;
    font-size: 2rem;
    opacity: 0.9;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-with-icon {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: var(--pure-white);
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-md);
    transition: var(--transition-fast);
    cursor: pointer;
    font-family: var(--font-main);
}

.btn-with-icon:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

/* Enhanced Stats */
.enhanced-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.enhanced-stat {
    background: var(--pure-white);
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--grey-100);
    transition: var(--transition-fast);
    position: relative;
    overflow: hidden;
}

.enhanced-stat:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.enhanced-stat.primary::before { background: var(--gradient-primary); }
.enhanced-stat.warning::before { background: linear-gradient(135deg, var(--warning-orange), #fbbf24); }
.enhanced-stat.success::before { background: linear-gradient(135deg, var(--success-green), #34d399); }
.enhanced-stat.info::before { background: linear-gradient(135deg, var(--info-blue), #60a5fa); }

.enhanced-stat::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}

.stat-icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: var(--border-radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.enhanced-stat.primary .stat-icon { background: var(--primary-green); }
.enhanced-stat.warning .stat-icon { background: var(--warning-orange); }
.enhanced-stat.success .stat-icon { background: var(--success-green); }
.enhanced-stat.info .stat-icon { background: var(--info-blue); }

.stat-badge {
    background: var(--error-red);
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: bold;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--grey-800);
    font-family: var(--font-main);
}

.stat-label {
    color: var(--grey-700);
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-family: var(--font-main);
}

.stat-change {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.875rem;
    font-weight: 600;
    font-family: var(--font-main);
}

.stat-change.positive { color: var(--success-green); }
.stat-change.neutral { color: var(--warning-orange); }

/* Data Table Styles */
.data-table {
    background: var(--pure-white);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    margin-bottom: 2rem;
}

.table-header {
    background: var(--gradient-light);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--grey-300);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--pure-white);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
    font-family: var(--font-main);
}

.table-actions {
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.table-content {
    overflow-x: auto;
}

.main-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.main-table thead th {
    background: var(--primary-lighter);
    color: var(--grey-800);
    font-weight: 600;
    padding: 1rem 1.5rem;
    text-align: right;
    border-bottom: 2px solid var(--primary-light);
    font-size: 0.875rem;
    white-space: nowrap;
    font-family: var(--font-main);
}

.main-table tbody td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--grey-100);
    vertical-align: middle;
    font-size: 0.875rem;
    font-family: var(--font-main);
}

.main-table tbody tr:hover {
    background: var(--primary-lightest);
    transition: var(--transition-fast);
}

/* Table Cell Styles */
.applicant-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.applicant-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--gradient-primary);
    color: var(--pure-white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: bold;
    flex-shrink: 0;
    font-family: var(--font-main);
}

.font-semibold {
    font-weight: 600;
    color: var(--grey-800);
    font-family: var(--font-main);
}

.text-sm {
    font-size: 0.875rem;
    color: var(--grey-700);
    font-family: var(--font-main);
}

.text-muted {
    color: var(--grey-500);
    font-style: italic;
    font-family: var(--font-main);
}

.text-blue-600 {
    color: var(--info-blue);
}

.text-blue-600:hover {
    color: var(--primary-light);
}

/* Button Styles */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    text-decoration: none;
    transition: var(--transition-fast);
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    gap: 0.5rem;
    font-family: var(--font-main);
}

.btn-primary {
    background: var(--primary-green);
    color: var(--pure-white);
    border: 1px solid var(--primary-green);
}

.btn-primary:hover {
    background: var(--primary-light);
    border-color: var(--primary-light);
    transform: translateY(-1px);
}

.btn-secondary {
    background: var(--grey-700);
    color: var(--pure-white);
    border: 1px solid var(--grey-700);
}

.btn-secondary:hover {
    background: var(--grey-800);
    border-color: var(--grey-800);
    transform: translateY(-1px);
}

.btn-outline {
    background: transparent;
    color: var(--grey-700);
    border: 1px solid var(--grey-300);
}

.btn-outline:hover {
    background: var(--grey-100);
    border-color: var(--primary-light);
    color: var(--primary-green);
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
    white-space: nowrap;
    font-family: var(--font-main);
}

.status-badge.active {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-green);
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.status-badge.pending {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning-orange);
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.status-badge.review {
    background: rgba(59, 130, 246, 0.1);
    color: var(--info-blue);
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.status-badge.inactive {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error-red);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

/* Flex Utilities */
.flex {
    display: flex;
}

.gap-1 {
    gap: 0.25rem;
}

/* Responsive Table */
@media (max-width: 768px) {
    .table-header {
        flex-direction: column;
        gap: 1rem;
        padding: 1rem;
        text-align: center;
    }
    
    .table-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .main-table {
        font-size: 0.75rem;
    }
    
    .main-table thead th,
    .main-table tbody td {
        padding: 0.75rem 0.5rem;
    }
    
    .applicant-info {
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
    }
    
    .flex.gap-1 {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
    }
}

/* Enhanced Section */
.enhanced-section {
    background: white;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.section-header {
    background: linear-gradient(135deg, var(--grey-50) 0%, var(--primary-lightest) 100%);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--grey-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--grey-800);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.view-toggle {
    display: flex;
    gap: 0.25rem;
    background: white;
    padding: 0.25rem;
    border-radius: var(--border-radius-sm);
    border: 1px solid var(--grey-200);
}

.toggle-btn {
    background: transparent;
    border: none;
    padding: 0.5rem;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: all 0.2s ease;
    color: var(--grey-600);
}

.toggle-btn.active {
    background: var(--primary-green);
    color: white;
}

/* Tabs Styling */
.tabs-container {
    border-bottom: 1px solid var(--grey-200);
    background: var(--grey-50);
}

.tabs-nav {
    display: flex;
    padding: 0 2rem;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.tabs-nav::-webkit-scrollbar {
    display: none;
}

.tab-btn {
    background: transparent;
    border: none;
    padding: 1rem 1.5rem;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
    color: var(--grey-600);
    position: relative;
}

.tab-btn:hover {
    background: rgba(45, 90, 61, 0.05);
    color: var(--primary-green);
}

.tab-btn.active {
    color: var(--primary-green);
    border-bottom-color: var(--primary-green);
    background: white;
}

.tab-count {
    background: var(--grey-200);
    color: var(--grey-600);
    padding: 0.25rem 0.5rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 700;
    min-width: 1.5rem;
    text-align: center;
}

.tab-btn.active .tab-count {
    background: var(--primary-green);
    color: white;
}

/* Applications Grid */
.enhanced-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}

.enhanced-grid.list-view {
    grid-template-columns: 1fr;
}

.enhanced-card {
    background: white;
    border: 1px solid var(--grey-200);
    border-radius: var(--border-radius-md);
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
    box-shadow: var(--shadow-sm);
}

.enhanced-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-light);
}

/* Status Indicators */
.status-indicator {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}

.status-indicator.pending { background: var(--warning-orange); }
.status-indicator.shortlisted { background: var(--info-blue); }
.status-indicator.interviewed { background: var(--primary-green); }
.status-indicator.accepted { background: var(--success-green); }
.status-indicator.rejected { background: var(--error-red); }

/* Card Components */
.card-header {
    padding: 1.5rem 1.5rem 1rem;
    border-bottom: 1px solid var(--grey-100);
    background: linear-gradient(135deg, var(--grey-50) 0%, white 100%);
}

.card-title-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
}

.application-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--grey-800);
    margin: 0;
    line-height: 1.4;
}

.enhanced-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.875rem;
    font-weight: 600;
    white-space: nowrap;
}

.status-pending { background: rgba(253, 126, 20, 0.1); color: var(--warning-orange); }
.status-shortlisted { background: rgba(23, 162, 184, 0.1); color: var(--info-blue); }
.status-interviewed { background: rgba(45, 90, 61, 0.1); color: var(--primary-green); }
.status-accepted { background: rgba(40, 167, 69, 0.1); color: var(--success-green); }
.status-rejected { background: rgba(220, 53, 69, 0.1); color: var(--error-red); }

.enhanced-info {
    padding: 1rem 1.5rem;
    background: var(--grey-50);
    border-bottom: 1px solid var(--grey-100);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.enhanced-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-green), var(--primary-light));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    font-weight: bold;
    flex-shrink: 0;
}

.applicant-details h4 {
    margin: 0 0 0.25rem;
    font-weight: 600;
    color: var(--grey-800);
}

.applicant-details p {
    margin: 0.25rem 0;
    font-size: 0.875rem;
    color: var(--grey-600);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.enhanced-meta {
    padding: 1rem 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.875rem;
    color: var(--grey-600);
}

.meta-icon {
    color: var(--primary-green);
    width: 16px;
    flex-shrink: 0;
}

.enhanced-content {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--grey-100);
}

.content-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    color: var(--grey-600);
    font-size: 0.875rem;
    font-weight: 600;
}

.content-icon {
    color: var(--primary-green);
}

.cover-letter-preview {
    color: var(--grey-700);
    line-height: 1.6;
    margin: 0;
}

.enhanced-resume {
    padding: 1rem 1.5rem;
    background: var(--grey-50);
    border-bottom: 1px solid var(--grey-100);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.resume-icon {
    color: var(--error-red);
    font-size: 1.25rem;
}

.resume-details {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.resume-label {
    font-weight: 600;
    color: var(--grey-800);
    font-size: 0.875rem;
}

.resume-date {
    font-size: 0.75rem;
    color: var(--grey-500);
}

.resume-download {
    background: var(--primary-green);
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.2s ease;
}

.resume-download:hover {
    background: var(--primary-light);
    transform: scale(1.1);
}

.enhanced-footer {
    padding: 1rem 1.5rem;
    background: var(--grey-50);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.application-actions {
    display: flex;
    gap: 0.75rem;
}

.enhanced-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: var(--primary-green);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-light);
    transform: translateY(-1px);
}

.btn-outline {
    background: transparent;
    color: var(--grey-600);
    border: 1px solid var(--grey-300);
}

.btn-outline:hover {
    background: var(--grey-100);
    border-color: var(--grey-400);
}

.application-timestamp {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--grey-500);
    font-size: 0.75rem;
}

/* Empty State */
.enhanced-empty {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 2rem;
}

.empty-icon {
    font-size: 4rem;
    color: var(--grey-300);
    position: relative;
    z-index: 2;
}

.empty-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120px;
    height: 120px;
    border: 3px solid var(--grey-200);
    border-radius: 50%;
    animation: ripple 2s infinite;
}

@keyframes ripple {
    0% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0;
    }
}

.empty-title {
    font-size: 1.5rem;
    color: var(--grey-800);
    margin-bottom: 1rem;
    font-weight: 600;
}

.empty-description {
    color: var(--grey-600);
    max-width: 500px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

.empty-actions {
    margin-top: 2rem;
}

.btn-large {
    padding: 1rem 2rem;
    font-size: 1.1rem;
    border-radius: var(--border-radius-md);
}

/* Pagination */
.enhanced-pagination {
    padding: 2rem;
    border-top: 1px solid var(--grey-200);
    background: var(--grey-50);
    display: flex;
    justify-content: center;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .enhanced-grid {
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    }
}

@media (max-width: 768px) {
    .enhanced-grid {
        grid-template-columns: 1fr;
        padding: 1rem;
        gap: 1rem;
    }
    
    .enhanced-header {
        padding: 1.5rem;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .enhanced-stats {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        padding: 1rem;
    }
    
    .tabs-nav {
        padding: 0 1rem;
    }
    
    .tab-btn {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
    }
    
    .card-title-section {
        flex-direction: column;
        gap: 0.75rem;
        align-items: flex-start;
    }
    
    .application-actions {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .enhanced-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
}

@media (max-width: 480px) {
    .enhanced-header .page-title {
        font-size: 2rem;
    }
    
    .tabs-nav {
        flex-direction: column;
    }
    
    .tab-btn {
        border-bottom: none;
        border-left: 3px solid transparent;
        justify-content: flex-start;
    }
    
    .tab-btn.active {
        border-left-color: var(--primary-green);
        border-bottom-color: transparent;
    }
}

/* Animation Classes */
.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.slide-in {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from { transform: translateX(-100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* Loading States */
.loading {
    opacity: 0.6;
    pointer-events: none;
    position: relative;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    border: 2px solid var(--grey-300);
    border-top: 2px solid var(--primary-green);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: translate(-50%, -50%) rotate(360deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('.main-table');
    const tableBody = table.querySelector('tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));
    
    // Custom functions
    window.refreshTable = function() {
        // Reload the page to refresh data
        window.location.reload();
    };

    window.exportTable = function() {
        // Export functionality
        const headers = [];
        const headerCells = table.querySelectorAll('thead th');
        
        // Get headers from table
        headerCells.forEach(cell => {
            if (cell.textContent.trim() !== '') {
                headers.push(cell.textContent.trim());
            }
        });
        
        // Prepare data for export
        const exportData = [headers];
        rows.forEach(row => {
            const rowData = [];
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                // Skip action column (last column)
                if (index !== cells.length - 1) {
                    const cellText = cell.textContent.trim();
                    rowData.push(cellText);
                }
            });
            exportData.push(rowData);
        });
        
        // Convert to CSV
        const csvContent = exportData.map(row => 
            row.map(cell => `"${cell.replace(/"/g, '""')}"`).join(',')
        ).join('\n');
        
        // Add BOM for proper Arabic text encoding
        const BOM = '\uFEFF';
        const blob = new Blob([BOM + csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        
        link.setAttribute('href', url);
        link.setAttribute('download', 'applications_' + new Date().toISOString().split('T')[0] + '.csv');
        link.style.visibility = 'hidden';
        
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        showNotification('تم تصدير البيانات بنجاح', 'success');
    };

    // Enhanced row hover effects
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'var(--primary-lightest)';
            this.style.transform = 'scale(1.01)';
            this.style.transition = 'all 0.2s ease';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
            this.style.transform = '';
        });
    });
    
    // Status badge click to filter
    const statusBadges = document.querySelectorAll('.status-badge');
    statusBadges.forEach(badge => {
        badge.addEventListener('click', function() {
            const statusText = this.textContent.trim();
            filterTableByStatus(statusText);
            showNotification('تم تصفية البيانات حسب الحالة: ' + statusText, 'info');
        });
    });

    // Applicant name click to filter (for companies)
    @if(auth()->user()->role === 'company')
    const applicantNames = document.querySelectorAll('.applicant-info span');
    applicantNames.forEach(name => {
        name.addEventListener('click', function() {
            const applicantName = this.textContent.trim();
            filterTableByApplicant(applicantName);
            showNotification('تم تصفية البيانات حسب المتقدم: ' + applicantName, 'info');
        });
    });
    @endif

    // Job title click to filter
    const jobTitles = document.querySelectorAll('td.font-semibold');
    jobTitles.forEach(title => {
        title.addEventListener('click', function() {
            const jobTitle = this.textContent.trim();
            filterTableByJob(jobTitle);
            showNotification('تم تصفية البيانات حسب الوظيفة: ' + jobTitle, 'info');
        });
    });
    
    // Filter functions
    function filterTableByStatus(status) {
        rows.forEach(row => {
            const statusCell = row.querySelector('.status-badge');
            if (statusCell && statusCell.textContent.trim() === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function filterTableByApplicant(applicantName) {
        rows.forEach(row => {
            const applicantCell = row.querySelector('.applicant-info span');
            if (applicantCell && applicantCell.textContent.trim() === applicantName) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function filterTableByJob(jobTitle) {
        rows.forEach(row => {
            const jobCell = row.querySelector('td.font-semibold');
            if (jobCell && jobCell.textContent.trim() === jobTitle) {
                row.style.display = '';
                    } else {
                row.style.display = 'none';
            }
        });
    }

    function clearAllFilters() {
        rows.forEach(row => {
            row.style.display = '';
        });
        showNotification('تم مسح جميع المرشحات', 'info');
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + R to refresh
        if (e.ctrlKey && e.keyCode === 82) {
                    e.preventDefault();
            refreshTable();
        }
        
        // Escape to clear all filters
        if (e.keyCode === 27) {
            clearAllFilters();
        }
    });

    // Auto-refresh every 5 minutes (optional)
    // setInterval(refreshTable, 300000);

    // Initialize tooltips
        const tooltipElements = document.querySelectorAll('[title]');
        tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            // Simple tooltip implementation
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = this.getAttribute('title');
            tooltip.style.cssText = `
                position: absolute;
                background: var(--grey-800);
                color: var(--pure-white);
                padding: 0.5rem;
                border-radius: var(--border-radius-sm);
                font-size: 0.75rem;
                z-index: 1000;
                pointer-events: none;
                opacity: 0;
                transition: var(--transition-fast);
                font-family: var(--font-main);
            `;
            
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + 'px';
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
            
            setTimeout(() => {
                tooltip.style.opacity = '1';
            }, 10);
            
            this.addEventListener('mouseleave', function() {
                tooltip.style.opacity = '0';
                setTimeout(() => {
                    if (document.body.contains(tooltip)) {
                        document.body.removeChild(tooltip);
                    }
                }, 200);
            }, { once: true });
        });
    });
});

// Utility functions
const utils = {
    debounce: (func, delay) => {
        let timeoutId;
        return (...args) => {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(null, args), delay);
        };
    },
    
    showNotification: (message, type = 'info') => {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        `;
        
        // Add notification styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? 'var(--success-green)' : type === 'error' ? 'var(--error-red)' : 'var(--info-blue)'};
            color: var(--pure-white);
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-lg);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transform: translateX(100%);
            transition: var(--transition-fast);
            font-family: var(--font-main);
            font-weight: 500;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                document.body.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
};
</script>
@endsection