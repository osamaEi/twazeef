@extends('dashboard.index')

@section('title', 'لوحة تحكم الشركة')

@section('content')
<div class="company-dashboard-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">مرحباً، {{ $company->company_name ?? $company->name }}</h1>
        </div>
   
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $totalJobs }}</h3>
                <p class="stat-label">إجمالي الوظائف</p>
                <div class="stat-change positive">
                    <i class="fas fa-chart-line"></i>
                    <span>جميع الوظائف</span>
                </div>
            </div>
        </div>

        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $activeJobs }}</h3>
                <p class="stat-label">الوظائف النشطة</p>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>مفتوحة للتقديم</span>
                </div>
            </div>
        </div>

        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $totalApplications }}</h3>
                <p class="stat-label">إجمالي الطلبات</p>
                <div class="stat-change positive">
                    <i class="fas fa-users"></i>
                    <span>جميع المتقدمين</span>
                </div>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $pendingApplications }}</h3>
                <p class="stat-label">طلبات قيد المراجعة</p>
                <div class="stat-change neutral">
                    <i class="fas fa-hourglass-half"></i>
                    <span>تتطلب مراجعة</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="dashboard-content">
        <!-- Recent Jobs -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">أحدث الوظائف</h2>
                <div class="section-actions">
                    <a href="{{ route('company.jobs.active') }}" class="btn btn-outline">عرض جميع الوظائف</a>
                </div>
            </div>

            <div class="jobs-grid">
                @forelse($recentJobs as $job)
                    <div class="job-card">
                        <div class="job-header">
                            <h3 class="job-title">{{ $job->title }}</h3>
                            <span class="status-badge status-{{ $job->status }}">
                                @if($job->status === 'active')
                                    نشط
                                @elseif($job->status === 'paused')
                                    معلق
                                @else
                                    مغلق
                                @endif
                            </span>
                        </div>
                        
                        <div class="job-meta">
                            <span class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $job->location }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock"></i>
                                {{ $job->type }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-users"></i>
                                {{ $job->applications_count }} طلب
                            </span>
                        </div>

                        <p class="job-description">{{ Str::limit($job->description, 120) }}</p>

                        <div class="job-footer">
                            <div class="salary-info">
                                <span class="salary">{{ $job->salary_min }} - {{ $job->salary_max }} {{ $job->salary_currency }}</span>
                            </div>
                            <div class="job-actions">
                                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-outline">تعديل</a>
                                <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-primary">عرض</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-briefcase empty-icon"></i>
                        <p class="empty-text">لا توجد وظائف حالياً</p>
                        <a href="{{ route('jobs.create') }}" class="btn btn-primary">إضافة أول وظيفة</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">أحدث طلبات التقديم</h2>
                <div class="section-actions">
                    <a href="{{ route('company.applications.index') }}" class="btn btn-outline">عرض جميع الطلبات</a>
                </div>
            </div>

            <div class="applications-grid">
                @forelse($recentApplications as $application)
                    <div class="application-card">
                        <div class="application-header">
                            <div class="applicant-info">
                                <div class="applicant-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="applicant-details">
                                    <h3 class="applicant-name">{{ $application->applicant->name }}</h3>
                                    <p class="applicant-email">{{ $application->applicant->email }}</p>
                                </div>
                            </div>
                            <span class="status-badge status-{{ $application->status }}">
                                @if($application->status === 'pending')
                                    قيد المراجعة
                                @elseif($application->status === 'shortlisted')
                                    مختصر
                                @elseif($application->status === 'interviewed')
                                    تمت المقابلة
                                @elseif($application->status === 'accepted')
                                    مقبول
                                @elseif($application->status === 'rejected')
                                    مرفوض
                                @else
                                    {{ $application->status }}
                                @endif
                            </span>
                        </div>
                        
                        <div class="job-info">
                            <h4 class="job-title">{{ $application->job->title }}</h4>
                            <div class="job-meta">
                                <span class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $application->job->location }}
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    {{ $application->job->type }}
                                </span>
                            </div>
                        </div>

                        <div class="application-content">
                            <p class="cover-letter">{{ Str::limit($application->cover_letter, 150) }}</p>
                        </div>

                        <div class="application-meta">
                            <span class="meta-item">
                                <i class="fas fa-calendar"></i>
                                {{ $application->created_at->format('Y-m-d') }}
                            </span>
                            @if($application->resume_path)
                                <span class="meta-item">
                                    <i class="fas fa-file-pdf"></i>
                                    <a href="{{ Storage::url($application->resume_path) }}" target="_blank">السيرة الذاتية</a>
                                </span>
                            @endif
                        </div>

                        <div class="application-footer">
                            <div class="application-actions">
                                <button class="btn btn-sm btn-outline" onclick="viewApplication({{ $application->id }})">عرض</button>
                                <button class="btn btn-sm btn-primary" onclick="updateStatus({{ $application->id }})">تحديث الحالة</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-file-alt empty-icon"></i>
                        <p class="empty-text">لا توجد طلبات تقديم حالياً</p>
                        <p class="empty-subtext">ستظهر هنا طلبات التقديم الجديدة للوظائف</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
function viewApplication(applicationId) {
    // TODO: Implement application view modal or redirect
    console.log('View application:', applicationId);
}

function updateStatus(applicationId) {
    // TODO: Implement status update modal
    console.log('Update status for application:', applicationId);
}
</script>
@endsection
