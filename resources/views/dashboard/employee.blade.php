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
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total_applications'] }}</h3>
                <p class="stat-label">إجمالي الطلبات</p>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $stats['pending_applications'] }}</span>
                </div>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['pending_applications'] }}</h3>
                <p class="stat-label">معلق</p>
                <div class="stat-change warning">
                    <i class="fas fa-clock"></i>
                    <span>قيد المراجعة</span>
                </div>
            </div>
        </div>

        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['shortlisted_applications'] }}</h3>
                <p class="stat-label">في القائمة المختصرة</p>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>مختار</span>
                </div>
            </div>
        </div>

        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['accepted_applications'] }}</h3>
                <p class="stat-label">مقبول</p>
                <div class="stat-change positive">
                    <i class="fas fa-check"></i>
                    <span>مقبول</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Grid -->
    <div class="quick-actions-section">
        <h2 class="section-title">إجراءات سريعة</h2>
        <div class="actions-grid">
            <div class="action-card">
                <div class="action-header">
                    <div class="action-icon jobs">
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
                    <div class="action-icon applications">
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
                    <div class="action-icon profile">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>الملف الشخصي</h3>
                </div>
                <div class="action-links">
                    <a href="{{ route('profile.edit') }}" class="action-link">
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
                            {{-- <a href="{{ route('applications.create', ['job_id' => $job->id]) }}" class="btn btn-sm btn-primary">تقدم الآن</a> --}}
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
@endsection
