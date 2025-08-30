@extends('dashboard.index')

@section('title', 'لوحة الشركة')

@section('content')
<div class="admin-dashboard">
    <!-- Header Section -->
    <div class="dashboard-header-section">
        <div class="header-content">
            <h1 class="main-title">لوحة إدارة الشركة</h1>
            <p class="subtitle">مرحباً بك في لوحة إدارة الوظائف والطلبات</p>
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
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total_jobs'] }}</h3>
                <p class="stat-label">إجمالي الوظائف</p>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $stats['active_jobs'] }}</span>
                </div>
            </div>
        </div>

        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['active_jobs'] }}</h3>
                <p class="stat-label">الوظائف النشطة</p>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>نشط</span>
                </div>
            </div>
        </div>

        <div class="stat-card warning">
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

        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['pending_applications'] }}</h3>
                <p class="stat-label">الطلبات المعلقة</p>
                <div class="stat-change warning">
                    <i class="fas fa-clock"></i>
                    <span>قيد المراجعة</span>
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
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h3>إدارة الوظائف</h3>
                </div>
                <div class="action-links">
                    <a href="{{ route('jobs.create') }}" class="action-link">
                        <i class="fas fa-plus"></i>
                        <span>إضافة وظيفة جديدة</span>
                    </a>
                    <a href="{{ route('jobs.index') }}" class="action-link">
                        <i class="fas fa-list"></i>
                        <span>عرض جميع الوظائف</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-archive"></i>
                        <span>الوظائف المغلقة</span>
                    </a>
                </div>
            </div>

            <div class="action-card">
                <div class="action-header">
                    <div class="action-icon applications">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>إدارة الطلبات</h3>
                </div>
                <div class="action-links">
                    <a href="{{ route('applications.index') }}" class="action-link">
                        <i class="fas fa-eye"></i>
                        <span>عرض جميع الطلبات</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-check-circle"></i>
                        <span>الطلبات المعتمدة</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-clock"></i>
                        <span>قيد المراجعة</span>
                    </a>
                </div>
            </div>

            <div class="action-card">
                <div class="action-header">
                    <div class="action-icon candidates">
                    <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>إدارة المرشحين</h3>
                </div>
                <div class="action-links">
                    <a href="#" class="action-link">
                        <i class="fas fa-users"></i>
                        <span>قاعدة المرشحين</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-star"></i>
                        <span>المرشحين المفضلين</span>
                    </a>
                    <a href="#" class="action-link">
                        <i class="fas fa-chart-bar"></i>
                        <span>إحصائيات التوظيف</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Sections -->
    <div class="dashboard-sections">
        <!-- Recent Jobs -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">وظائفك المنشورة</h2>
                <a href="{{ route('jobs.index') }}" class="section-link">عرض الكل</a>
            </div>
            
            <div class="section-content">
                @forelse($jobs as $job)
                    <div class="job-item">
                        <div class="job-info">
                            <h4 class="job-title">{{ $job->title }}</h4>
                            <div class="job-meta">
                                <span class="meta-item"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                                <span class="meta-item"><i class="fas fa-clock"></i> {{ $job->type }}</span>
                                <span class="meta-item"><i class="fas fa-users"></i> {{ $job->applications_count }} طلب</span>
                            </div>
                            <p class="job-description">{{ Str::limit($job->description, 100) }}</p>
                        </div>
                        
                        <div class="job-actions">
                            <span class="status-badge status-{{ $job->status }}">
                                {{ $job->status === 'active' ? 'نشط' : 'معلق' }}
                            </span>
                            <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-outline">تعديل</a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-briefcase empty-icon"></i>
                        <p class="empty-text">لم تقم بنشر أي وظائف بعد</p>
                        <a href="{{ route('jobs.create') }}" class="btn btn-primary">إضافة أول وظيفة</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2 class="section-title">أحدث الطلبات</h2>
                <a href="{{ route('applications.index') }}" class="section-link">عرض الكل</a>
            </div>
            
            <div class="section-content">
                @forelse($recent_applications as $application)
                    <div class="application-item">
                        <div class="application-info">
                            <h4 class="application-title">{{ $application->job->title }}</h4>
                            <p class="applicant-name">مقدم الطلب: {{ $application->applicant->name }}</p>
                            <div class="application-meta">
                                <span class="meta-item">{{ $application->applied_at->format('M d, Y') }}</span>
                                <span class="meta-separator">•</span>
                                <span class="meta-item">{{ Str::limit($application->cover_letter, 80) }}</span>
                            </div>
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
                        <p class="empty-text">لا توجد طلبات بعد</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
