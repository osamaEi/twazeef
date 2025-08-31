@extends('dashboard.index')

@section('title', 'لوحة تحكم الشركة')

@section('content')

{{-- 
    The inline style below is redundant if you are using the dashboard.css theme variables and classes.
    Consider using a utility class or referencing the CSS variable directly in your stylesheet.
    If you want to keep a custom class, you can use the CSS variable for consistency:
--}}

<style>
.primary-green {
    background-color: var(--primary-green) !important;
    color: var(--pure-white) !important;
}
</style>
<div class="company-dashboard-page primary-green">
    <!-- Header Section -->
    <div class="page-header primary-green">
        <div class="header-content primary-green">
            <h1 class="page-title primary-green">مرحباً، {{ $company->company_name ?? $company->name }}</h1>
        </div>
   
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview primary-green">
        <div class="stat-card primary-green">
            <div class="stat-icon primary-green">
                <i class="fas fa-briefcase primary-green"></i>
            </div>
            <div class="stat-content primary-green">
                <h3 class="stat-number primary-green">{{ $totalJobs }}</h3>
                <p class="stat-label primary-green">إجمالي الوظائف</p>
                <div class="stat-change positive primary-green">
                    <i class="fas fa-chart-line primary-green"></i>
                    <span class="primary-green">جميع الوظائف</span>
                </div>
            </div>
        </div>

        <div class="stat-card primary-green">
            <div class="stat-icon primary-green">
                <i class="fas fa-eye primary-green"></i>
            </div>
            <div class="stat-content primary-green">
                <h3 class="stat-number primary-green">{{ $activeJobs }}</h3>
                <p class="stat-label primary-green">الوظائف النشطة</p>
                <div class="stat-change positive primary-green">
                    <i class="fas fa-arrow-up primary-green"></i>
                    <span class="primary-green">مفتوحة للتقديم</span>
                </div>
            </div>
        </div>

        <div class="stat-card primary-green">
            <div class="stat-icon primary-green">
                <i class="fas fa-file-alt primary-green"></i>
            </div>
            <div class="stat-content primary-green">
                <h3 class="stat-number primary-green">{{ $totalApplications }}</h3>
                <p class="stat-label primary-green">إجمالي الطلبات</p>
                <div class="stat-change positive primary-green">
                    <i class="fas fa-users primary-green"></i>
                    <span class="primary-green">جميع المتقدمين</span>
                </div>
            </div>
        </div>

        <div class="stat-card warning primary-green">
            <div class="stat-icon primary-green">
                <i class="fas fa-clock primary-green"></i>
            </div>
            <div class="stat-content primary-green">
                <h3 class="stat-number primary-green">{{ $pendingApplications }}</h3>
                <p class="stat-label primary-green">طلبات قيد المراجعة</p>
                <div class="stat-change neutral primary-green">
                    <i class="fas fa-hourglass-half primary-green"></i>
                    <span class="primary-green">تتطلب مراجعة</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="dashboard-content primary-green">
        <!-- Recent Jobs -->
        <div class="content-section primary-green">
            <div class="section-header primary-green">
                <h2 class="section-title primary-green">أحدث الوظائف</h2>
                <div class="section-actions primary-green">
                    <a href="{{ route('company.jobs.active') }}" class="btn btn-outline primary-green">عرض جميع الوظائف</a>
                </div>
            </div>

            <div class="jobs-grid primary-green">
                @forelse($recentJobs as $job)
                    <div class="job-card primary-green">
                        <div class="job-header primary-green">
                            <h3 class="job-title primary-green">{{ $job->title }}</h3>
                            <span class="status-badge status-{{ $job->status }} primary-green">
                                @if($job->status === 'active')
                                    نشط
                                @elseif($job->status === 'paused')
                                    معلق
                                @else
                                    مغلق
                                @endif
                            </span>
                        </div>
                        
                        <div class="job-meta primary-green">
                            <span class="meta-item primary-green">
                                <i class="fas fa-map-marker-alt primary-green"></i>
                                {{ $job->location }}
                            </span>
                            <span class="meta-item primary-green">
                                <i class="fas fa-clock primary-green"></i>
                                {{ $job->type }}
                            </span>
                            <span class="meta-item primary-green">
                                <i class="fas fa-users primary-green"></i>
                                {{ $job->applications_count }} طلب
                            </span>
                        </div>

                        <p class="job-description primary-green">{{ Str::limit($job->description, 120) }}</p>

                        <div class="job-footer primary-green">
                            <div class="salary-primary primary-green">
                                <span class="salary primary-green">{{ $job->salary_min }} - {{ $job->salary_max }} {{ $job->salary_currency }}</span>
                            </div>
                            <div class="job-actions primary-green">
                                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-outline primary-green">تعديل</a>
                                <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-primary primary-green">عرض</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state primary-green">
                        <i class="fas fa-briefcase empty-icon primary-green"></i>
                        <p class="empty-text primary-green">لا توجد وظائف حالياً</p>
                        <a href="{{ route('jobs.create') }}" class="btn btn-primary primary-green">إضافة أول وظيفة</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="content-section primary-green">
            <div class="section-header primary-green">
                <h2 class="section-title primary-green">أحدث طلبات التقديم</h2>
                <div class="section-actions primary-green">
                    <a href="{{ route('company.applications.index') }}" class="btn btn-outline primary-green">عرض جميع الطلبات</a>
                </div>
            </div>

            <div class="applications-grid primary-green">
                @forelse($recentApplications as $application)
                    <div class="application-card primary-green">
                        <div class="application-header primary-green">
                            <div class="applicant-primary primary-green">
                                <div class="applicant-avatar primary-green">
                                    <i class="fas fa-user primary-green"></i>
                                </div>
                                <div class="applicant-details primary-green">
                                    <h3 class="applicant-name primary-green">{{ $application->applicant->name }}</h3>
                                    <p class="applicant-email primary-green">{{ $application->applicant->email }}</p>
                                </div>
                            </div>
                            <span class="status-badge status-{{ $application->status }} primary-green">
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
                        
                        <div class="job-primary primary-green">
                            <h4 class="job-title primary-green">{{ $application->job->title }}</h4>
                            <div class="job-meta primary-green">
                                <span class="meta-item primary-green">
                                    <i class="fas fa-map-marker-alt primary-green"></i>
                                    {{ $application->job->location }}
                                </span>
                                <span class="meta-item primary-green">
                                    <i class="fas fa-clock primary-green"></i>
                                    {{ $application->job->type }}
                                </span>
                            </div>
                        </div>

                        <div class="application-content primary-green">
                            <p class="cover-letter primary-green">{{ Str::limit($application->cover_letter, 150) }}</p>
                        </div>

                        <div class="application-meta primary-green">
                            <span class="meta-item primary-green">
                                <i class="fas fa-calendar primary-green"></i>
                                {{ $application->created_at->format('Y-m-d') }}
                            </span>
                            @if($application->resume_path)
                                <span class="meta-item primary-green">
                                    <i class="fas fa-file-pdf primary-green"></i>
                                    <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="primary-green">السيرة الذاتية</a>
                                </span>
                            @endif
                        </div>

                        <div class="application-footer primary-green">
                            <div class="application-actions primary-green">
                                <button class="btn btn-sm btn-outline primary-green" onclick="viewApplication({{ $application->id }})">عرض</button>
                                <button class="btn btn-sm btn-primary primary-green" onclick="updateStatus({{ $application->id }})">تحديث الحالة</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state primary-green">
                        <i class="fas fa-file-alt empty-icon primary-green"></i>
                        <p class="empty-text primary-green">لا توجد طلبات تقديم حالياً</p>
                        <p class="empty-subtext primary-green">ستظهر هنا طلبات التقديم الجديدة للوظائف</p>
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
