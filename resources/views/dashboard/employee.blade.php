@extends('dashboard.index')

@section('title', 'لوحة الموظف')

@section('content')
<div class="admin-dashboard">
    <!-- Header Section -->
    <div class="dashboard-header-section">
        <div class="header-content">
            <h1 class="main-title">لوحة إدارة الموظف</h1>
            <p class="subtitle">مرحباً بك في لوحة متابعة طلبات التوظيف</p>
        </div>
        <div class="header-actions">
            <div class="date-display">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ now()->format('Y/m/d') }}</span>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total_applications'] }}</h3>
                <p class="stat-label">إجمالي الطلبات</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['pending_applications'] }}</h3>
                <p class="stat-label">معلق</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['shortlisted_applications'] }}</h3>
                <p class="stat-label">في القائمة المختصرة</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['accepted_applications'] }}</h3>
                <p class="stat-label">مقبول</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions Grid -->
    <div class="quick-actions-section">
        <h2 class="section-title">إجراءات سريعة</h2>
        <div class="actions-grid">
            <div class="action-card">
                <div class="action-header">
                    <div class="action-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>البحث عن الوظائف</h3>
                </div>
                <div class="action-links">
                    <a href="{{ route('jobs.index') }}" class="action-link">
                        <i class="fas fa-search"></i>
                        <span>تصفح الوظائف المتاحة</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-heart"></i>
                        <span>الوظائف المحفوظة</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-bell"></i>
                        <span>تنبيهات الوظائف</span>
                    </a>
                </div>
            </div>

            <div class="action-card">
                <div class="action-header">
                    <div class="action-icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h3>طلبات التقديم</h3>
                </div>
                <div class="action-links">
                    <a href="{{ route('applications.index') }}" class="action-link">
                        <i class="fas fa-eye"></i>
                        <span>عرض جميع الطلبات</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-clock"></i>
                        <span>قيد المراجعة</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-check-circle"></i>
                        <span>الطلبات المقبولة</span>
                    </a>
                </div>
            </div>

            <div class="action-card">
                <div class="action-header">
                    <div class="action-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>الملف الشخصي</h3>
                </div>
                <div class="action-links">
                    <a href="{{ route('employee.profile') }}" class="action-link">
                        <i class="fas fa-user-edit"></i>
                        <span>تعديل الملف الشخصي</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-graduation-cap"></i>
                        <span>الدورات التدريبية</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-certificate"></i>
                        <span>الشهادات</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Sections -->
    <div class="dashboard-sections">
        <!-- My Applications -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">طلباتي المقدمة</h2>
                <a href="{{ route('applications.index') }}" class="section-link">عرض الكل</a>
            </div>
            
            <div class="section-content">
                @forelse($applications as $application)
                    <div class="application-item">
                        <div class="application-info">
                            <h4 class="application-title">{{ $application->job->title }}</h4>
                            <p class="company-name">{{ $application->job->company->name }}</p>
                            <div class="application-meta">
                                <span class="meta-item">{{ $application->applied_at->format('M d, Y') }}</span>
                                <span class="meta-separator">•</span>
                                <span class="meta-item">{{ $application->job->location }}</span>
                                <span class="meta-separator">•</span>
                                <span class="meta-item">{{ $application->job->type }}</span>
                            </div>
                            <p class="cover-letter-preview">{{ Str::limit($application->cover_letter, 120) }}</p>
                        </div>
                        
                        <div class="application-actions">
                            <span class="status-badge status-{{ $application->status }}">
                                @switch($application->status)
                                    @case('pending')
                                        معلق
                                        @break
                                    @case('reviewed')
                                        تم المراجعة
                                        @break
                                    @case('shortlisted')
                                        في القائمة المختصرة
                                        @break
                                    @case('interviewed')
                                        تمت المقابلة
                                        @break
                                    @case('accepted')
                                        مقبول
                                        @break
                                    @case('rejected')
                                        مرفوض
                                        @break
                                    @default
                                        {{ ucfirst($application->status) }}
                                @endswitch
                            </span>
                            <a href="{{ route('applications.show', $application) }}" class="btn btn-sm btn-outline">عرض</a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list empty-icon"></i>
                        <p class="empty-text">لم تتقدم لأي وظائف بعد</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary">تصفح الوظائف المتاحة</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Available Jobs -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">الوظائف المتاحة</h2>
                <a href="{{ route('jobs.index') }}" class="section-link">عرض الكل</a>
            </div>
            
            <div class="section-content">
                @forelse($available_jobs as $job)
                    <div class="job-item">
                        <div class="job-info">
                            <h4 class="job-title">{{ $job->title }}</h4>
                            <p class="company-name">{{ $job->company->name }}</p>
                            <div class="job-meta">
                                <span class="meta-item"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                                <span class="meta-item"><i class="fas fa-clock"></i> {{ $job->type }}</span>
                                <span class="meta-item"><i class="fas fa-user-tie"></i> {{ $job->experience_level }}</span>
                            </div>
                            @if($job->salary_min || $job->salary_max)
                                <div class="salary-info">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>
                                        @if($job->salary_min && $job->salary_max)
                                            {{ $job->salary_min }} - {{ $job->salary_max }} {{ $job->salary_currency }}
                                        @elseif($job->salary_min)
                                            من {{ $job->salary_min }} {{ $job->salary_currency }}
                                        @else
                                            حتى {{ $job->salary_max }} {{ $job->salary_currency }}
                                        @endif
                                    </span>
                                </div>
                            @endif
                            <p class="job-description">{{ Str::limit($job->description, 100) }}</p>
                            
                            @if($job->skills)
                                <div class="skills-tags">
                                    @foreach(array_slice($job->skills, 0, 3) as $skill)
                                        <span class="skill-tag">{{ $skill }}</span>
                                    @endforeach
                                    @if(count($job->skills) > 3)
                                        <span class="skill-tag more-skills">+{{ count($job->skills) - 3 }} المزيد</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        
                        <div class="job-actions">
                            <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-outline">عرض التفاصيل</a>
                            @if(auth()->user()->applications()->where('job_id', $job->id)->exists())
                                <span class="btn btn-sm btn-success disabled">تم التقديم</span>
                            @else
                                @if($job && $job->id)
                                    <a href="{{ route('applications.create', $job) }}" class="btn btn-sm btn-primary">تقدم الآن</a>
                                @else
                                    <span class="btn btn-sm btn-secondary disabled">خطأ في تحميل الوظيفة</span>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-briefcase empty-icon"></i>
                        <p class="empty-text">لا توجد وظائف متاحة حالياً</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
/* Unified Color Scheme */
:root {
    --primary-color: #003c6d;
    --primary-light: #005085;
    --primary-lighter: #e8eff5;
    --primary-dark: #002a4a;
    --accent-color: #003c6d;
    --text-primary: #2c3e50;
    --text-secondary: #6c757d;
    --text-light: #95a5a6;
    --background-light: #f8f9fa;
    --background-white: #ffffff;
    --border-color: #e9ecef;
    --shadow-light: 0 2px 10px rgba(0, 60, 109, 0.1);
    --shadow-medium: 0 4px 20px rgba(0, 60, 109, 0.15);
    --shadow-heavy: 0 8px 30px rgba(0, 60, 109, 0.2);
}

/* Header Styles */
.dashboard-header-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    color: white;
    padding: 2rem;
    border-radius: 16px;
    margin-bottom: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.main-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.date-display {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1rem;
    border-radius: 12px;
    font-size: 1rem;
}

/* Stats Overview */
.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--background-white);
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: var(--shadow-light);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 2px solid transparent;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
    border-color: var(--primary-color);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-weight: 500;
}

/* Quick Actions */
.quick-actions-section {
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.action-card {
    background: var(--background-white);
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: var(--shadow-light);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 2px solid transparent;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
    border-color: var(--primary-color);
}

.action-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.action-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.action-card h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary-color);
    margin: 0;
}

.action-links {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.action-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    text-decoration: none;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.action-link:hover {
    background: var(--primary-lighter);
    color: var(--primary-color);
    transform: translateX(5px);
}

/* Dashboard Sections */
.dashboard-sections {
    display: grid;
    gap: 2rem;
}

.dashboard-section {
    background: var(--background-white);
    border-radius: 16px;
    box-shadow: var(--shadow-light);
    overflow: hidden;
}

.section-header {
    background: var(--primary-lighter);
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border-color);
}

.section-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--primary-color);
    margin: 0;
}

.section-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.section-link:hover {
    color: var(--primary-light);
}

.section-content {
    padding: 1.5rem;
}

/* Application Items */
.application-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.application-item:hover {
    border-color: var(--primary-color);
    box-shadow: var(--shadow-light);
}

.application-item:last-child {
    margin-bottom: 0;
}

.application-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.company-name {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.application-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.meta-item {
    color: var(--text-light);
    font-size: 0.8rem;
}

.meta-separator {
    color: var(--text-light);
}

.cover-letter-preview {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.4;
}

.application-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: flex-end;
}

/* Job Items */
.job-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.job-item:hover {
    border-color: var(--primary-color);
    box-shadow: var(--shadow-light);
}

.job-item:last-child {
    margin-bottom: 0;
}

.job-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.job-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.meta-item {
    color: var(--text-light);
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.salary-info {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.job-description {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 0.5rem;
}

.skills-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.skill-tag {
    background: var(--primary-lighter);
    color: var(--primary-color);
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 500;
}

.more-skills {
    background: var(--background-light);
    color: var(--text-secondary);
}

.job-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: flex-end;
}

/* Status Badges */
.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    text-align: center;
    min-width: 100px;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-reviewed {
    background: #d1ecf1;
    color: #0c5460;
}

.status-shortlisted {
    background: #d4edda;
    color: #155724;
}

.status-interviewed {
    background: #cce5ff;
    color: #004085;
}

.status-accepted {
    background: #d4edda;
    color: #155724;
}

.status-rejected {
    background: #f8d7da;
    color: #721c24;
}

/* Buttons */
.btn {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-light);
    transform: translateY(-1px);
}

.btn-outline {
    background: transparent;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
}

.btn-outline:hover {
    background: var(--primary-color);
    color: white;
}

.btn-success {
    background: #d4edda;
    color: #155724;
}

.btn-secondary {
    background: var(--text-light);
    color: white;
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--text-secondary);
}

.empty-icon {
    font-size: 3rem;
    color: var(--text-light);
    margin-bottom: 1rem;
}

.empty-text {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-header-section {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .main-title {
        font-size: 2rem;
    }
    
    .stats-overview {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .application-item,
    .job-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .application-actions,
    .job-actions {
        align-items: flex-start;
        width: 100%;
    }
}
</style>
@endsection
