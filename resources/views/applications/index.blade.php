@extends('dashboard.index')

@section('title', 'طلبات التقديم')

@section('content')
<div class="applications-page">
    <!-- Enhanced Header Section -->
    <div class="page-header enhanced-header">
        <div class="header-content">
            <div class="header-main">
                <h1 class="page-title">
                    @if(auth()->user()->role === 'company')
                        <i class="fas fa-users-cog header-icon"></i>
                        طلبات التقديم
                    @else
                        <i class="fas fa-file-alt header-icon"></i>
                        طلباتي
                    @endif
                </h1>
                <p class="page-subtitle">
                    @if(auth()->user()->role === 'company')
                        إدارة ومراجعة طلبات التقديم من الباحثين عن عمل
                    @else
                        تتبع حالة طلبات التقديم الخاصة بك
                    @endif
                </p>
            </div>
            @if(auth()->user()->role === 'employee')
                <div class="header-actions">
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-with-icon">
                        <i class="fas fa-search"></i>
                        <span>تصفح الوظائف</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced Stats Overview -->
    <div class="stats-overview enhanced-stats">
        <div class="stat-card primary enhanced-stat">
            <div class="stat-icon-wrapper">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-badge">{{ $applications->total() }}</div>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $applications->total() }}</h3>
                <p class="stat-label">
                    @if(auth()->user()->role === 'company')
                        إجمالي الطلبات
                    @else
                        إجمالي طلباتي
                    @endif
                </p>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>نشط</span>
                </div>
            </div>
        </div>
        
        <!-- Additional Stats for Companies -->
        @if(auth()->user()->role === 'company')
            <div class="stat-card secondary enhanced-stat">
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
                    <p class="stat-label">في القائمة المختصرة</p>
                    <div class="stat-change positive">
                        <i class="fas fa-star"></i>
                        <span>مميز</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Enhanced Applications List -->
    <div class="applications-section enhanced-section">
        <div class="section-header enhanced-header">
            <div class="section-title-wrapper">
                <h2 class="section-title">
                    <i class="fas fa-list-alt"></i>
                    @if(auth()->user()->role === 'company')
                        طلبات التقديم
                    @else
                        طلباتي
                    @endif
                </h2>
                <p class="section-subtitle">
                    @if(auth()->user()->role === 'company')
                        مراجعة وإدارة جميع الطلبات
                    @else
                        تتبع تقدم طلباتك
                    @endif
                </p>
            </div>
            <div class="section-actions">
                <div class="view-toggle">
                    <button class="toggle-btn active" data-view="grid">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="toggle-btn" data-view="list">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        @if($applications->count() > 0)
            <div class="applications-grid enhanced-grid" id="applications-view">
                @foreach($applications as $application)
                    <div class="application-card enhanced-card" data-status="{{ $application->status ?? 'pending' }}">
                        <div class="card-header enhanced-header">
                            <div class="status-indicator {{ $application->status ?? 'pending' }}"></div>
                            <h3 class="application-title">{{ $application->job->title }}</h3>
                            @php
                                $statusColors = [
                                    'pending' => 'status-pending',
                                    'shortlisted' => 'status-shortlisted',
                                    'interviewed' => 'status-interviewed',
                                    'accepted' => 'status-accepted',
                                    'rejected' => 'status-rejected'
                                ];
                                $statusClass = $statusColors[$application->status ?? 'pending'] ?? 'status-pending';
                                $statusText = [
                                    'pending' => 'قيد المراجعة',
                                    'shortlisted' => 'في القائمة المختصرة',
                                    'interviewed' => 'تمت المقابلة',
                                    'accepted' => 'مقبول',
                                    'rejected' => 'مرفوض'
                                ];
                                $statusLabel = $statusText[$application->status ?? 'pending'] ?? 'قيد المراجعة';
                            @endphp
                            <span class="status-badge {{ $statusClass }} enhanced-badge">
                                <span class="badge-dot"></span>
                                {{ $statusLabel }}
                            </span>
                        </div>
                        
                        @if(auth()->user()->role === 'company')
                            <div class="applicant-info enhanced-info">
                                <div class="applicant-avatar enhanced-avatar">
                                    <span>{{ strtoupper(substr($application->applicant->name, 0, 1)) }}</span>
                                </div>
                                <div class="applicant-details">
                                    <h4 class="applicant-name">{{ $application->applicant->name }}</h4>
                                    <p class="applicant-email">{{ $application->applicant->email }}</p>
                                    @if($application->applicant->phone)
                                        <p class="applicant-phone">
                                            <i class="fas fa-phone"></i>
                                            {{ $application->applicant->phone }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <div class="application-meta enhanced-meta">
                            <div class="meta-item">
                                <i class="fas fa-building meta-icon"></i>
                                <span class="meta-text">{{ $application->job->company->name ?? 'غير محدد' }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt meta-icon"></i>
                                <span class="meta-text">{{ $application->job->location ?? 'غير محدد' }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt meta-icon"></i>
                                <span class="meta-text">{{ $application->applied_at ? $application->applied_at->format('Y/m/d') : 'غير محدد' }}</span>
                            </div>
                        </div>

                        <div class="application-content enhanced-content">
                            <div class="content-header">
                                <i class="fas fa-envelope content-icon"></i>
                                <span class="content-label">خطاب التقديم</span>
                            </div>
                            <p class="cover-letter-preview">{{ Str::limit($application->cover_letter, 120) }}</p>
                        </div>

                        @if($application->resume_path)
                            <div class="resume-info enhanced-resume">
                                <div class="resume-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="resume-details">
                                    <span class="resume-label">تم رفع السيرة الذاتية</span>
                                    <span class="resume-date">{{ $application->created_at->format('Y/m/d') }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="application-footer enhanced-footer">
                            <div class="application-actions">
                                <a href="{{ route('applications.show', $application) }}" class="btn btn-primary btn-sm enhanced-btn">
                                    <i class="fas fa-eye"></i>
                                    <span>عرض</span>
                                </a>
                                @if(auth()->user()->role === 'company')
                                    <a href="{{ route('jobs.applications.show', ['job' => $application->job, 'application' => $application]) }}" class="btn btn-outline btn-sm enhanced-btn">
                                        <i class="fas fa-cog"></i>
                                        <span>إدارة</span>
                                    </a>
                                @endif
                            </div>
                            <div class="application-timestamp">
                                <i class="fas fa-clock"></i>
                                <span>{{ $application->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            @if($applications->hasPages())
                <div class="pagination-wrapper enhanced-pagination">
                    {{ $applications->links() }}
                </div>
            @endif
        @else
            <!-- Enhanced Empty State -->
            <div class="empty-state enhanced-empty">
                <div class="empty-icon-wrapper">
                    <i class="fas fa-file-alt empty-icon"></i>
                    <div class="empty-ripple"></div>
                </div>
                <h3 class="empty-title">
                    @if(auth()->user()->role === 'company')
                        لا توجد طلبات تقديم بعد
                    @else
                        لم تقم بتقديم أي طلبات بعد
                    @endif
                </h3>
                <p class="empty-description">
                    @if(auth()->user()->role === 'company')
                        ستظهر طلبات التقديم من الباحثين عن عمل هنا بمجرد بدء التقديم على وظائفك.
                    @else
                        ابدأ في التقديم على الوظائف لرؤية طلباتك هنا. سيتم عرض سجل التقديم الخاص بك في هذه اللوحة.
                    @endif
                </p>
                @if(auth()->user()->role === 'employee')
                    <div class="empty-actions">
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-large">
                            <i class="fas fa-search"></i>
                            <span>تصفح الوظائف المتاحة</span>
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
/* Enhanced Styles */
.enhanced-header {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
    border-radius: var(--border-radius-lg);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-lg);
}

.enhanced-header .page-title {
    color: white;
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.enhanced-header .page-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
}

.header-icon {
    margin-left: 1rem;
    font-size: 2rem;
    opacity: 0.8;
}

.enhanced-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.enhanced-stat {
    background: white;
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--grey-100);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.enhanced-stat:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.enhanced-stat::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-green), var(--primary-light));
}

.stat-icon-wrapper {
    position: relative;
    display: inline-block;
}

.stat-badge {
    position: absolute;
    top: -8px;
    right: -8px;
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
}

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
}

.section-title-wrapper {
    display: flex;
    flex-direction: column;
}

.section-subtitle {
    color: var(--grey-600);
    margin-top: 0.25rem;
}

.view-toggle {
    display: flex;
    gap: 0.5rem;
}

.toggle-btn {
    background: white;
    border: 1px solid var(--grey-300);
    padding: 0.5rem;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: all 0.2s ease;
}

.toggle-btn.active {
    background: var(--primary-green);
    color: white;
    border-color: var(--primary-green);
}

.enhanced-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}

.enhanced-card {
    background: white;
    border: 1px solid var(--grey-200);
    border-radius: var(--border-radius-md);
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.enhanced-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-light);
}

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

.card-header {
    padding: 1.5rem 1.5rem 1rem;
    border-bottom: 1px solid var(--grey-100);
    background: linear-gradient(135deg, var(--grey-50) 0%, white 100%);
}

.enhanced-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.badge-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
}

.enhanced-info {
    padding: 1rem 1.5rem;
    background: var(--grey-50);
    border-bottom: 1px solid var(--grey-100);
}

.enhanced-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-green), var(--primary-light));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
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
}

.meta-icon {
    color: var(--primary-green);
    width: 16px;
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
}

.content-icon {
    color: var(--primary-green);
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
}

.resume-label {
    font-weight: 600;
    color: var(--grey-800);
}

.resume-date {
    font-size: 0.875rem;
    color: var(--grey-500);
}

.enhanced-footer {
    padding: 1rem 1.5rem;
    background: var(--grey-50);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.enhanced-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    transition: all 0.2s ease;
}

.application-timestamp {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--grey-500);
    font-size: 0.875rem;
}

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
}

.enhanced-pagination {
    padding: 2rem;
    border-top: 1px solid var(--grey-200);
    background: var(--grey-50);
}

/* Responsive Design */
@media (max-width: 768px) {
    .enhanced-grid {
        grid-template-columns: 1fr;
        padding: 1rem;
    }
    
    .enhanced-header {
        padding: 1.5rem;
    }
    
    .enhanced-stats {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// View Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtns = document.querySelectorAll('.toggle-btn');
    const applicationsView = document.getElementById('applications-view');
    
    toggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            toggleBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const view = this.dataset.view;
            if (view === 'list') {
                applicationsView.classList.add('list-view');
            } else {
                applicationsView.classList.remove('list-view');
            }
        });
    });
});

// Add hover effects and animations
document.querySelectorAll('.enhanced-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});
</script>
@endsection
