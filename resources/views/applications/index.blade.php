@extends('dashboard.index')


@section('content')
<div class="applications-page">
    <!-- Enhanced Header Section -->
 

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

    <!-- Tabbed Applications Section -->
    <div class="applications-section enhanced-section">
        <div class="section-header">
            <div class="section-title-wrapper">
                <h2 class="section-title">
                    <i class="fas fa-list-alt"></i>
                    طلبات التقديم
                </h2>
            </div>
            <div class="section-actions">
                <div class="view-toggle">
                    <button class="toggle-btn active" data-view="grid" title="عرض الشبكة">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="toggle-btn" data-view="list" title="عرض القائمة">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="tabs-container">
            <nav class="tabs-nav">
                <button class="tab-btn active" data-status="all">
                    <i class="fas fa-layer-group"></i>
                    <span>جميع الطلبات</span>
                    <span class="tab-count">{{ $applications->count() }}</span>
                </button>
                
                @if(auth()->user()->role === 'company')
                    <button class="tab-btn" data-status="pending">
                        <i class="fas fa-clock"></i>
                        <span>قيد المراجعة</span>
                        <span class="tab-count">{{ $applications->where('status', 'pending')->count() }}</span>
                    </button>
                    
                    <button class="tab-btn" data-status="shortlisted">
                        <i class="fas fa-star"></i>
                        <span>القائمة المختصرة</span>
                        <span class="tab-count">{{ $applications->where('status', 'shortlisted')->count() }}</span>
                    </button>
                    
                    <button class="tab-btn" data-status="interviewed">
                        <i class="fas fa-user-tie"></i>
                        <span>تمت المقابلة</span>
                        <span class="tab-count">{{ $applications->where('status', 'interviewed')->count() }}</span>
                    </button>
                    
                    <button class="tab-btn" data-status="accepted">
                        <i class="fas fa-check-circle"></i>
                        <span>مقبول</span>
                        <span class="tab-count">{{ $applications->where('status', 'accepted')->count() }}</span>
                    </button>
                    
                    <button class="tab-btn" data-status="rejected">
                        <i class="fas fa-times-circle"></i>
                        <span>مرفوض</span>
                        <span class="tab-count">{{ $applications->where('status', 'rejected')->count() }}</span>
                    </button>
                @else
                    <button class="tab-btn" data-status="pending">
                        <i class="fas fa-hourglass-half"></i>
                        <span>قيد المراجعة</span>
                        <span class="tab-count">{{ $applications->where('status', 'pending')->count() }}</span>
                    </button>
                    
                    <button class="tab-btn" data-status="accepted">
                        <i class="fas fa-check-circle"></i>
                        <span>مقبولة</span>
                        <span class="tab-count">{{ $applications->where('status', 'accepted')->count() }}</span>
                    </button>
                    
                    <button class="tab-btn" data-status="rejected">
                        <i class="fas fa-times-circle"></i>
                        <span>مرفوضة</span>
                        <span class="tab-count">{{ $applications->where('status', 'rejected')->count() }}</span>
                    </button>
                @endif
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="tabs-content">
            @if($applications->count() > 0)
                <div class="applications-grid enhanced-grid" id="applications-view">
                    @foreach($applications as $application)
                        <div class="application-card enhanced-card" data-status="{{ $application->status ?? 'pending' }}">
                            <div class="card-header">
                                <div class="status-indicator {{ $application->status ?? 'pending' }}"></div>
                                <div class="card-title-section">
                                    <h3 class="application-title">{{ $application->job->title }}</h3>
                                    @php
                                        $statusConfig = [
                                            'pending' => ['class' => 'status-pending', 'text' => 'قيد المراجعة', 'icon' => 'fas fa-clock'],
                                            'shortlisted' => ['class' => 'status-shortlisted', 'text' => 'القائمة المختصرة', 'icon' => 'fas fa-star'],
                                            'interviewed' => ['class' => 'status-interviewed', 'text' => 'تمت المقابلة', 'icon' => 'fas fa-user-tie'],
                                            'accepted' => ['class' => 'status-accepted', 'text' => 'مقبول', 'icon' => 'fas fa-check-circle'],
                                            'rejected' => ['class' => 'status-rejected', 'text' => 'مرفوض', 'icon' => 'fas fa-times-circle']
                                        ];
                                        $status = $statusConfig[$application->status ?? 'pending'] ?? $statusConfig['pending'];
                                    @endphp
                                    <span class="status-badge {{ $status['class'] }} enhanced-badge">
                                        <i class="{{ $status['icon'] }}"></i>
                                        {{ $status['text'] }}
                                    </span>
                                </div>
                            </div>
                            
                            @if(auth()->user()->role === 'company')
                                <div class="applicant-info enhanced-info">
                                    <div class="applicant-avatar enhanced-avatar">
                                        <span>{{ strtoupper(substr($application->applicant->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="applicant-details">
                                        <h4 class="applicant-name">{{ $application->applicant->name }}</h4>
                                        <p class="applicant-email">
                                            <i class="fas fa-envelope"></i>
                                            {{ $application->applicant->email }}
                                        </p>
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
                                    <span class="meta-text">{{ $application->applied_at ? $application->applied_at->format('Y/m/d') : $application->created_at->format('Y/m/d') }}</span>
                                </div>
                            </div>

                            @if($application->cover_letter)
                                <div class="application-content enhanced-content">
                                    <div class="content-header">
                                        <i class="fas fa-envelope-open content-icon"></i>
                                        <span class="content-label">خطاب التقديم</span>
                                    </div>
                                    <p class="cover-letter-preview">{{ Str::limit($application->cover_letter, 120) }}</p>
                                </div>
                            @endif

                            @if($application->resume_path)
                                <div class="resume-info enhanced-resume">
                                    <div class="resume-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="resume-details">
                                        <span class="resume-label">السيرة الذاتية مرفقة</span>
                                        <span class="resume-date">{{ $application->created_at->format('Y/m/d') }}</span>
                                    </div>
                                    <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="resume-download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            @endif

                            <div class="application-footer enhanced-footer">
                                <div class="application-actions">
                                    <a href="{{ route('applications.show', $application) }}" class="btn btn-primary btn-sm enhanced-btn">
                                        <i class="fas fa-eye"></i>
                                        <span>عرض التفاصيل</span>
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

                <!-- Pagination -->
                @if($applications->hasPages())
                    <div class="pagination-wrapper enhanced-pagination">
                        {{ $applications->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="empty-state enhanced-empty">
                    <div class="empty-icon-wrapper">
                        <i class="fas fa-inbox empty-icon"></i>
                        <div class="empty-ripple"></div>
                    </div>
                    <h3 class="empty-title">لا توجد طلبات في هذا التصنيف</h3>
                    <p class="empty-description">
                        @if(auth()->user()->role === 'company')
                            لا توجد طلبات تقديم في هذا التصنيف حالياً.
                        @else
                            لم تقم بتقديم طلبات في هذا التصنيف بعد.
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
</div>

<style>

/* Enhanced Header */
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
    font-weight: 700;
}

.enhanced-header .page-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    line-height: 1.6;
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
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-md);
    transition: all 0.3s ease;
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

.enhanced-stat.primary::before { background: linear-gradient(135deg, var(--primary-green), var(--primary-light)); }
.enhanced-stat.warning::before { background: linear-gradient(135deg, var(--warning-orange), #ff8c42); }
.enhanced-stat.success::before { background: linear-gradient(135deg, var(--success-green), #34ce57); }
.enhanced-stat.info::before { background: linear-gradient(135deg, var(--info-blue), #20c997); }

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
}

.stat-label {
    color: var(--grey-600);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.stat-change {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.stat-change.positive { color: var(--success-green); }
.stat-change.neutral { color: var(--warning-orange); }

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
    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const applicationsGrid = document.getElementById('applications-view');
    const applicationCards = document.querySelectorAll('.application-card');
    
    // View toggle functionality
    const toggleBtns = document.querySelectorAll('.toggle-btn');
    
    toggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            toggleBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const view = this.dataset.view;
            if (view === 'list') {
                applicationsGrid.classList.add('list-view');
            } else {
                applicationsGrid.classList.remove('list-view');
            }
        });
    });
    
    // Tab switching functionality
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all tabs
            tabBtns.forEach(tab => tab.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
            
            const status = this.dataset.status;
            
            // Add loading state
            applicationsGrid.classList.add('loading');
            
            setTimeout(() => {
                // Filter cards based on status
                applicationCards.forEach(card => {
                    if (status === 'all' || card.dataset.status === status) {
                        card.style.display = 'block';
                        card.classList.add('fade-in');
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('fade-in');
                    }
                });
                
                // Remove loading state
                applicationsGrid.classList.remove('loading');
                
                // Update empty state visibility
                const visibleCards = Array.from(applicationCards).filter(card => card.style.display !== 'none');
                const emptyState = document.querySelector('.enhanced-empty');
                
                if (visibleCards.length === 0 && emptyState) {
                    emptyState.style.display = 'block';
                } else if (emptyState) {
                    emptyState.style.display = 'none';
                }
            }, 300);
        });
    });
    
    // Enhanced card hover effects
    applicationCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = 'var(--shadow-lg)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'var(--shadow-sm)';
        });
    });
    
    // Smooth scrolling for pagination
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            
            // Add loading state
            applicationsGrid.classList.add('loading');
            
            // Simulate loading delay (replace with actual AJAX call)
            setTimeout(() => {
                window.location.href = href;
            }, 500);
        });
    });
    
    // Search functionality (if search input exists)
    const searchInput = document.querySelector('#applications-search');
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const searchTerm = this.value.toLowerCase().trim();
            
            searchTimeout = setTimeout(() => {
                applicationCards.forEach(card => {
                    const title = card.querySelector('.application-title').textContent.toLowerCase();
                    const company = card.querySelector('.meta-text').textContent.toLowerCase();
                    const applicantName = card.querySelector('.applicant-name')?.textContent.toLowerCase() || '';
                    
                    if (title.includes(searchTerm) || company.includes(searchTerm) || applicantName.includes(searchTerm)) {
                        card.style.display = 'block';
                        card.classList.add('fade-in');
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('fade-in');
                    }
                });
            }, 300);
        });
    }
    
    // Auto-refresh functionality (optional)
    const autoRefresh = () => {
        const tabCounts = document.querySelectorAll('.tab-count');
        
        // Simulate count updates (replace with actual AJAX call)
        tabCounts.forEach(count => {
            const currentCount = parseInt(count.textContent);
            // Update logic here
        });
    };
    
    // Refresh every 30 seconds (optional)
    // setInterval(autoRefresh, 30000);
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.altKey) {
            const activeTabIndex = Array.from(tabBtns).findIndex(tab => tab.classList.contains('active'));
            
            switch(e.key) {
                case 'ArrowLeft':
                case 'ArrowRight':
                    e.preventDefault();
                    const direction = e.key === 'ArrowLeft' ? -1 : 1;
                    const nextIndex = (activeTabIndex + direction + tabBtns.length) % tabBtns.length;
                    tabBtns[nextIndex].click();
                    tabBtns[nextIndex].focus();
                    break;
            }
        }
    });
    
    // Initialize tooltips (if using a tooltip library)
    const initTooltips = () => {
        const tooltipElements = document.querySelectorAll('[title]');
        tooltipElements.forEach(element => {
            // Initialize tooltip library here if needed
        });
    };
    
    initTooltips();
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
    
    animateCount: (element, target, duration = 1000) => {
        const start = parseInt(element.textContent) || 0;
        const increment = (target - start) / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if ((increment > 0 && current >= target) || (increment < 0 && current <= target)) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 16);
    },
    
    showNotification: (message, type = 'info') => {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
};
</script>
@endsection