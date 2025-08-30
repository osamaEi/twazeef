@extends('dashboard.index')

@section('title', __('admin.jobs.show.title'))

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>{{ __('admin.jobs.show.welcome_message') }}</strong> {{ __('admin.jobs.show.welcome_description') }}
        </div>
    </div>

    <!-- معلومات الوظيفة الرئيسية -->
    <div class="job-header-section">
        <div class="job-header-card">
            <div class="job-header-content">
                <div class="job-title-section">
                    <h1 class="job-title">{{ $job->title }}</h1>
                    <div class="job-meta">
                        <span class="company-name">
                            <i class="fas fa-building"></i>
                            {{ $job->company->name ?? __('admin.jobs.show.not_specified') }}
                        </span>
                        @if($job->location)
                        <span class="job-location">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $job->location }}
                        </span>
                        @endif
                        @if($job->salary_range)
                        <span class="job-salary">
                            <i class="fas fa-money-bill-wave"></i>
                            {{ $job->salary_range }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="job-status-section">
                    @if($job->status === 'active')
                        <span class="status-badge active">
                            <i class="fas fa-eye"></i>
                            {{ __('admin.jobs.show.status_active') }}
                        </span>
                    @elseif($job->status === 'paused')
                        <span class="status-badge paused">
                            <i class="fas fa-pause-circle"></i>
                            {{ __('admin.jobs.show.status_paused') }}
                        </span>
                    @elseif($job->status === 'closed')
                        <span class="status-badge closed">
                            <i class="fas fa-archive"></i>
                            {{ __('admin.jobs.show.status_closed') }}
                        </span>
                    @else
                        <span class="status-badge draft">
                            <i class="fas fa-edit"></i>
                            {{ __('admin.jobs.show.status_draft') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="job-header-actions">
                <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    {{ __('admin.jobs.show.edit_job') }}
                </a>
                @if($job->status === 'active')
                    <button class="btn btn-secondary" onclick="pauseJob({{ $job->id }})">
                        <i class="fas fa-pause"></i>
                        {{ __('admin.jobs.show.pause_job') }}
                    </button>
                @elseif($job->status === 'paused')
                    <button class="btn btn-success" onclick="activateJob({{ $job->id }})">
                        <i class="fas fa-play"></i>
                        {{ __('admin.jobs.show.activate_job') }}
                    </button>
                @endif
                <button class="btn btn-danger" onclick="deleteJob({{ $job->id }})">
                    <i class="fas fa-trash"></i>
                    {{ __('admin.jobs.show.delete_job') }}
                </button>
            </div>
        </div>
    </div>

    <!-- الإحصائيات السريعة -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $job->applications_count ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $job->applications_count ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.jobs.show.total_applicants') }}</div>
            <div class="stat-description">{{ __('admin.jobs.show.total_applicants_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $pendingApplications ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $pendingApplications ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.jobs.show.pending_applications') }}</div>
            <div class="stat-description">{{ __('admin.jobs.show.pending_applications_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $acceptedApplications ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $acceptedApplications ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.jobs.show.accepted_applications') }}</div>
            <div class="stat-description">{{ __('admin.jobs.show.accepted_applications_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>{{ $job->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $job->created_at->format('d') }}</div>
            <div class="stat-label">{{ __('admin.jobs.show.days_published') }}</div>
            <div class="stat-description">{{ __('admin.jobs.show.days_published_desc') }}</div>
        </div>
    </div>

    <!-- الفرص السريعة -->
    <div class="quick-opportunities">
        <div class="opportunity-card primary" onclick="window.location.href='{{ route('admin.applicants.index') }}?job_id={{ $job->id }}'">
            <div class="opportunity-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="opportunity-content">
                <h4>{{ __('admin.jobs.show.view_applicants') }}</h4>
                <p>{{ __('admin.jobs.show.view_applicants_desc') }}</p>
            </div>
        </div>
        
        <div class="opportunity-card secondary" onclick="window.location.href='{{ route('admin.companies.show', $job->company->id ?? 1) }}'">
            <div class="opportunity-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="opportunity-content">
                <h4>{{ __('admin.jobs.show.view_company') }}</h4>
                <p>{{ __('admin.jobs.show.view_company_desc') }}</p>
            </div>
        </div>
        
        <div class="opportunity-card tertiary" onclick="exportJobData()">
            <div class="opportunity-icon">
                <i class="fas fa-download"></i>
            </div>
            <div class="opportunity-content">
                <h4>{{ __('admin.jobs.show.export_data') }}</h4>
                <p>{{ __('admin.jobs.show.export_data_desc') }}</p>
            </div>
        </div>
        
        <div class="opportunity-card quaternary" onclick="showJobAnalytics()">
            <div class="opportunity-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="opportunity-content">
                <h4>{{ __('admin.jobs.show.view_analytics') }}</h4>
                <p>{{ __('admin.jobs.show.view_analytics_desc') }}</p>
            </div>
        </div>
    </div>

    <!-- تفاصيل الوظيفة -->
    <div class="job-details-section">
        <div class="details-grid">
            <!-- تفاصيل الوظيفة الأساسية -->
            <div class="details-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        {{ __('admin.jobs.show.basic_details') }}
                    </h3>
                </div>
                <div class="card-content">
                    <div class="details-list">
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.job_title') }}</label>
                            <div class="detail-value">{{ $job->title }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.company') }}</label>
                            <div class="detail-value">
                                @if($job->company)
                                    <a href="{{ route('admin.companies.show', $job->company->id) }}" class="company-link">
                                        <i class="fas fa-building"></i>
                                        {{ $job->company->name }}
                                    </a>
                                @else
                                    <span class="text-muted">{{ __('admin.jobs.show.not_specified') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        @if($job->location)
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.location') }}</label>
                            <div class="detail-value">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $job->location }}
                            </div>
                        </div>
                        @endif
                        
                        @if($job->job_type)
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.job_type') }}</label>
                            <div class="detail-value">{{ $job->job_type }}</div>
                        </div>
                        @endif
                        
                        @if($job->salary_range)
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.salary') }}</label>
                            <div class="detail-value">
                                <i class="fas fa-money-bill-wave"></i>
                                {{ $job->salary_range }}
                            </div>
                        </div>
                        @endif
                        
                        @if($job->experience_level)
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.experience') }}</label>
                            <div class="detail-value">{{ $job->experience_level }}</div>
                        </div>
                        @endif
                        
                        @if($job->education_level)
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.education') }}</label>
                            <div class="detail-value">{{ $job->education_level }}</div>
                        </div>
                        @endif
                        
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.published_at') }}</label>
                            <div class="detail-value">
                                <div class="date-info">
                                    <div class="date-main">{{ $job->created_at->format('Y-m-d') }}</div>
                                    <div class="date-relative">{{ $job->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                        
                        @if($job->expires_at)
                        <div class="detail-item">
                            <label class="detail-label">{{ __('admin.jobs.show.expires_at') }}</label>
                            <div class="detail-value">
                                <div class="date-info">
                                    <div class="date-main">{{ $job->expires_at->format('Y-m-d') }}</div>
                                    <div class="date-relative">{{ $job->expires_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- وصف الوظيفة -->
            <div class="details-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt"></i>
                        {{ __('admin.jobs.show.job_description') }}
                    </h3>
                </div>
                <div class="card-content">
                    @if($job->description)
                        <div class="description-content">
                            {!! $job->description !!}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-file-alt fa-2x"></i>
                            <p>{{ __('admin.jobs.show.no_description') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- المتطلبات -->
            @if($job->requirements)
            <div class="details-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list-check"></i>
                        {{ __('admin.jobs.show.requirements') }}
                    </h3>
                </div>
                <div class="card-content">
                    <div class="requirements-content">
                        {!! $job->requirements !!}
                    </div>
                </div>
            </div>
            @endif
            
            <!-- المزايا -->
            @if($job->benefits)
            <div class="details-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-gift"></i>
                        {{ __('admin.jobs.show.benefits') }}
                    </h3>
                </div>
                <div class="card-content">
                    <div class="benefits-content">
                        {{-- {!! $job->benefits !!} --}}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>


    <!-- أحدث الطلبات -->
    <div class="recent-applications-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-clock"></i>
                {{ __('admin.jobs.show.recent_applications') }}
            </h3>
        </div>
        
        <div class="applications-list">
            @forelse($recentApplications ?? [] as $application)
            <div class="application-card">
                <div class="applicant-info">
                    <div class="applicant-avatar">
                        @if($application->user->avatar)
                            <img src="{{ asset('storage/' . $application->user->avatar) }}" 
                                 alt="{{ $application->user->name }}" 
                                 class="avatar-image">
                        @else
                            <div class="avatar-placeholder">
                                {{ substr($application->user->name, 0, 2) }}
                            </div>
                        @endif
                    </div>
                    <div class="applicant-details">
                        <h5 class="applicant-name">{{ $application->user->name }}</h5>
                        <p class="applicant-email">{{ $application->user->email }}</p>
                        <div class="application-date">
                            <i class="fas fa-calendar"></i>
                            {{ $application->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                <div class="application-status">
                    @if($application->status === 'pending')
                        <span class="status-badge pending">{{ __('admin.jobs.show.status_pending') }}</span>
                    @elseif($application->status === 'accepted')
                        <span class="status-badge accepted">{{ __('admin.jobs.show.status_accepted') }}</span>
                    @elseif($application->status === 'rejected')
                        <span class="status-badge rejected">{{ __('admin.jobs.show.status_rejected') }}</span>
                    @endif
                </div>
                <div class="application-actions">
                    <a href="{{ route('admin.applicants.show', $application->id) }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-eye"></i>
                        {{ __('admin.jobs.show.view') }}
                    </a>
                </div>
            </div>
            @empty
            <div class="empty-applications">
                <i class="fas fa-users fa-3x"></i>
                <h4>{{ __('admin.jobs.show.no_applications') }}</h4>
                <p>{{ __('admin.jobs.show.no_applications_desc') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- نموذج تأكيد الإجراء -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">{{ __('admin.jobs.show.confirm_action') }}</h3>
            <button class="close-btn" onclick="closeModal('confirmModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">{{ __('admin.jobs.show.confirm_action_message') }}</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('confirmModal')">{{ __('admin.jobs.show.cancel') }}</button>
            <button class="btn btn-primary" id="confirmAction">{{ __('admin.jobs.show.confirm') }}</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 تم تحميل صفحة عرض الوظيفة بنجاح');
    
    // === تشغيل الأنيميشن ===
    startAnimations();
});

// === وظائف الإجراءات ===
function pauseJob(jobId) {
    showConfirmModal(
        '{{ __("admin.jobs.show.confirm_pause_message") }}',
        () => executeJobAction('pause', jobId)
    );
}

function activateJob(jobId) {
    showConfirmModal(
        '{{ __("admin.jobs.show.confirm_activate_message") }}',
        () => executeJobAction('activate', jobId)
    );
}

function deleteJob(jobId) {
    showConfirmModal(
        '{{ __("admin.jobs.show.confirm_delete_message") }}',
        () => executeJobAction('delete', jobId)
    );
}

function executeJobAction(action, jobId) {
    console.log(`تنفيذ الإجراء: ${action}`, jobId);
    
    // محاكاة عملية AJAX
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("admin.jobs.show.processing") }}...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> {{ __("admin.jobs.show.success") }}';
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            closeModal('confirmModal');
            showSuccessMessage(`{{ __("admin.jobs.show.action_success") }}`);
        }, 1500);
    }, 2000);
}

// === وظائف مساعدة ===
function showConfirmModal(message, onConfirm) {
    const modal = document.getElementById('confirmModal');
    const messageEl = document.getElementById('confirmMessage');
    const confirmBtn = document.getElementById('confirmAction');
    
    messageEl.textContent = message;
    confirmBtn.onclick = onConfirm;
    
    modal.classList.add('active');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
}

function showSuccessMessage(message) {
    const notification = document.createElement('div');
    notification.className = 'alert alert-success';
    notification.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <div><strong>${message}</strong></div>
    `;
    notification.style.cssText = `
        position: fixed;
        top: 2rem;
        right: 2rem;
        z-index: 10000;
        max-width: 400px;
        animation: slideIn 0.5s ease-out;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 4000);
}

function exportJobData() {
    showSuccessMessage('{{ __("admin.jobs.show.export_coming_soon") }}');
}

function showJobAnalytics() {
    showSuccessMessage('{{ __("admin.jobs.show.analytics_coming_soon") }}');
}

// === الأنيميشن ===
function startAnimations() {
    const animatedElements = document.querySelectorAll('.animate-slide-in, .animate-fade-in');
    
    animatedElements.forEach((element, index) => {
        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

// === إضافة أنيميشن الموجة ===
const actionButtons = document.querySelectorAll('.btn');
actionButtons.forEach(button => {
    button.addEventListener('click', function (e) {
        if (!this.disabled && !this.querySelector('.fa-spinner')) {
            createRippleEffect(e, this);
        }
    });
});

function createRippleEffect(e, element) {
    const ripple = document.createElement('span');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;

    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple 0.6s ease-out;
        pointer-events: none;
    `;

    element.style.position = 'relative';
    element.style.overflow = 'hidden';
    element.appendChild(ripple);

    setTimeout(() => {
        ripple.remove();
    }, 600);
}

// === إضافة CSS للأنيميشن ===
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(1);
            opacity: 0;
        }
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-slide-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }
    
    .animate-fade-in {
        opacity: 0;
        transition: opacity 0.8s ease-out;
    }
    
    .job-header-section {
        margin-bottom: 2rem;
    }
    
    .job-header-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .job-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-green);
        margin-bottom: 0.5rem;
    }
    
    .job-meta {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    
    .job-meta span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.875rem;
    }
    
    .job-status-section {
        display: flex;
        gap: 1rem;
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .status-badge.active {
        background: var(--primary-green);
    }
    
    .status-badge.paused {
        background: #f59e0b;
    }
    
    .status-badge.closed {
        background: #6b7280;
    }
    
    .status-badge.draft {
        background: #3b82f6;
    }
    
    .job-header-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .details-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .card-header {
        background: var(--primary-lightest);
        padding: 1.5rem;
        border-bottom: 1px solid var(--primary-light);
    }
    
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-green);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .card-content {
        padding: 1.5rem;
    }
    
    .details-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 0.5rem;
    }
    
    .detail-label {
        font-weight: 600;
        color: #6b7280;
        min-width: 120px;
    }
    
    .detail-value {
        color: #1f2937;
        font-weight: 500;
        text-align: left;
    }
    
    .company-link {
        color: var(--primary-green);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .company-link:hover {
        text-decoration: underline;
    }
    
    .date-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        text-align: left;
    }
    
    .date-main {
        font-weight: 500;
        color: #1f2937;
    }
    
    .date-relative {
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    .description-content {
        line-height: 1.6;
        color: #374151;
    }
    
    .requirements-content, .benefits-content {
        line-height: 1.6;
        color: #374151;
    }
    
    .empty-state {
        text-align: center;
        color: #6b7280;
        padding: 2rem;
    }
    
    .applicants-section {
        margin-bottom: 2rem;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .applicants-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }
    
    .applicant-stat-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.2s ease;
    }
    
    .applicant-stat-card:hover {
        transform: translateY(-2px);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }
    
    .stat-icon.total { background: var(--primary-green); }
    .stat-icon.pending { background: #f59e0b; }
    .stat-icon.accepted { background: #10b981; }
    .stat-icon.rejected { background: #ef4444; }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .recent-applications-section {
        margin-bottom: 2rem;
    }
    
    .applications-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .application-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        transition: transform 0.2s ease;
    }
    
    .application-card:hover {
        transform: translateY(-2px);
    }
    
    .applicant-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
    }
    
    .applicant-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
    }
    
    .avatar-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .avatar-placeholder {
        width: 100%;
        height: 100%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.25rem;
    }
    
    .applicant-details {
        flex: 1;
    }
    
    .applicant-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 0.25rem 0;
    }
    
    .applicant-email {
        color: #6b7280;
        margin: 0 0 0.5rem 0;
    }
    
    .application-date {
        font-size: 0.875rem;
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .application-status {
        display: flex;
        align-items: center;
    }
    
    .status-badge.pending {
        background: #f59e0b;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-badge.accepted {
        background: #10b981;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-badge.rejected {
        background: #ef4444;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .application-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    .empty-applications {
        text-align: center;
        color: #6b7280;
        padding: 3rem;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .empty-applications h4 {
        margin: 1rem 0 0.5rem 0;
        color: #374151;
    }
    
    .empty-applications p {
        margin: 0;
        color: #6b7280;
    }
    
    @media (max-width: 768px) {
        .job-header-card {
            flex-direction: column;
            text-align: center;
        }
        
        .job-meta {
            justify-content: center;
        }
        
        .details-grid {
            grid-template-columns: 1fr;
        }
        
        .applicants-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .application-card {
            flex-direction: column;
            text-align: center;
        }
        
        .applicant-info {
            flex-direction: column;
            text-align: center;
        }
    }
`;
document.head.appendChild(style);

console.log('✅ تم تهيئة جميع مكونات صفحة عرض الوظيفة بنجاح');
</script>
@endpush
