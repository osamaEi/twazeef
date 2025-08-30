@extends('dashboard.index')

@section('title', __('admin.jobs.index.title'))

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>{{ __('admin.jobs.index.welcome_message') }}</strong> {{ __('admin.jobs.index.welcome_description') }}
        </div>
    </div>

    <!-- الإحصائيات الرئيسية -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $jobs->total() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $jobs->total() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.jobs.index.total_jobs') }}</div>
            <div class="stat-description">{{ __('admin.jobs.index.total_jobs_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $jobs->where('status', 'active')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $jobs->where('status', 'active')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.jobs.index.active_jobs') }}</div>
            <div class="stat-description">{{ __('admin.jobs.index.active_jobs_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-pause-circle"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-down"></i>
                    <span>{{ $jobs->where('status', 'paused')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $jobs->where('status', 'paused')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.jobs.index.paused_jobs') }}</div>
            <div class="stat-description">{{ __('admin.jobs.index.paused_jobs_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-down"></i>
                    <span>{{ $jobs->where('status', 'closed')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $jobs->where('status', 'closed')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.jobs.index.closed_jobs') }}</div>
            <div class="stat-description">{{ __('admin.jobs.index.closed_jobs_desc') }}</div>
        </div>
    </div>

    <!-- الفرص السريعة -->
    <div class="quick-opportunities">
        <div class="opportunity-card primary" onclick="window.location.href='{{ route('jobs.create') }}'">
            <div class="opportunity-icon">
                <i class="fas fa-plus"></i>
            </div>
            <div class="opportunity-content">
                <h4>{{ __('admin.jobs.index.create_job') }}</h4>
                <p>{{ __('admin.jobs.index.create_job_desc') }}</p>
            </div>
        </div>
        
        <div class="opportunity-card secondary" onclick="scrollToApplications()">
            <div class="opportunity-icon">
                <i class="fas fa-search"></i>
            </div>
            <div class="opportunity-content">
                <h4>{{ __('admin.jobs.index.review_applications') }}</h4>
                <p>{{ __('admin.jobs.index.review_applications_desc') }}</p>
            </div>
        </div>
        
        <div class="opportunity-card tertiary" onclick="exportJobs()">
            <div class="opportunity-icon">
                <i class="fas fa-download"></i>
            </div>
            <div class="opportunity-content">
                <h4>{{ __('admin.jobs.index.export_data') }}</h4>
                <p>{{ __('admin.jobs.index.export_data_desc') }}</p>
            </div>
        </div>
        
        <div class="opportunity-card quaternary" onclick="showJobReports()">
            <div class="opportunity-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="opportunity-content">
                <h4>{{ __('admin.jobs.index.view_reports') }}</h4>
                <p>{{ __('admin.jobs.index.view_reports_desc') }}</p>
            </div>
        </div>
    </div>

    <!-- تبويبات الفلترة -->
    <div class="filter-tabs">
        <button class="filter-tab active" data-status="all">
            <i class="fas fa-list"></i>
            {{ __('admin.jobs.index.all_jobs') }}
            <span class="tab-count">{{ $jobs->total() ?? 0 }}</span>
        </button>
        <button class="filter-tab" data-status="active">
            <i class="fas fa-eye"></i>
            {{ __('admin.jobs.index.active') }}
            <span class="tab-count">{{ $jobs->where('status', 'active')->count() ?? 0 }}</span>
        </button>
        <button class="filter-tab" data-status="paused">
            <i class="fas fa-pause-circle"></i>
            {{ __('admin.jobs.index.paused') }}
            <span class="tab-count">{{ $jobs->where('status', 'paused')->count() ?? 0 }}</span>
        </button>
        <button class="filter-tab" data-status="closed">
            <i class="fas fa-archive"></i>
            {{ __('admin.jobs.index.closed') }}
            <span class="tab-count">{{ $jobs->where('status', 'closed')->count() ?? 0 }}</span>
        </button>
    </div>

    <!-- البحث والفلترة -->
    <div class="search-filters">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="{{ __('admin.jobs.index.search_placeholder') }}">
        </div>
        
        <div class="filter-controls">
            <select id="statusFilter" class="filter-select">
                <option value="">{{ __('admin.jobs.index.all_statuses') }}</option>
                <option value="active">{{ __('admin.jobs.index.active') }}</option>
                <option value="paused">{{ __('admin.jobs.index.paused') }}</option>
                <option value="closed">{{ __('admin.jobs.index.closed') }}</option>
            </select>
            
            <button class="btn btn-outline" onclick="resetFilters()">
                <i class="fas fa-undo"></i>
                {{ __('admin.jobs.index.reset_filters') }}
            </button>
        </div>
    </div>

    <!-- جدول الوظائف -->
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-briefcase"></i>
                {{ __('admin.jobs.index.jobs_list') }}
            </h3>
            <div class="table-actions">
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    {{ __('admin.jobs.index.add_new_job') }}
                </a>
                <button class="btn btn-secondary" onclick="exportJobs()">
                    <i class="fas fa-download"></i>
                    {{ __('admin.jobs.index.export_excel') }}
                </button>
                <button class="btn btn-outline" onclick="refreshTable()">
                    <i class="fas fa-refresh"></i>
                    {{ __('admin.jobs.index.refresh') }}
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="table-content">
            <table class="main-table" id="jobsTable">
                <thead>
                    <tr>
                        <th>{{ __('admin.jobs.index.job') }}</th>
                        <th>{{ __('admin.jobs.index.company') }}</th>
                        <th>{{ __('admin.jobs.index.status') }}</th>
                        <th>{{ __('admin.jobs.index.applicants_count') }}</th>
                        <th>{{ __('admin.jobs.index.created_at') }}</th>
                        <th>{{ __('admin.jobs.index.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs ?? [] as $job)
                    <tr class="job-row" data-status="{{ $job->status }}">
                        <td>
                            <div class="job-info">
                                <div class="job-title">{{ $job->title }}</div>
                                @if($job->location)
                                    <div class="job-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $job->location }}
                                    </div>
                                @endif
                                @if($job->description)
                                    <div class="job-description">{{ Str::limit($job->description, 60) }}</div>
                                @endif
                                @if($job->salary_range)
                                    <div class="job-salary">
                                        <i class="fas fa-money-bill-wave"></i>
                                        {{ $job->salary_range }}
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="company-info">
                                <div class="company-avatar">
                                    @if($job->company && $job->company->logo)
                                        <img src="{{ asset('storage/' . $job->company->logo) }}" 
                                             alt="{{ $job->company->name }}" 
                                             class="company-logo">
                                    @else
                                        <div class="company-avatar-placeholder">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="company-details">
                                    <div class="company-name">{{ $job->company->name ?? __('admin.jobs.index.not_specified') }}</div>
                                    @if($job->company && $job->company->company_name)
                                        <div class="company-title">{{ $job->company->company_name }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($job->status === 'active')
                                <span class="status-badge active">{{ __('admin.jobs.index.active') }}</span>
                            @elseif($job->status === 'paused')
                                <span class="status-badge review">{{ __('admin.jobs.index.paused') }}</span>
                            @elseif($job->status === 'closed')
                                <span class="status-badge pending">{{ __('admin.jobs.index.closed') }}</span>
                            @else
                                <span class="status-badge pending">{{ __('admin.jobs.index.draft') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="applicants-info">
                                <div class="applicants-count">{{ $job->applications_count ?? 0 }}</div>
                                <div class="applicants-label">{{ __('admin.jobs.index.applicant') }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="date-info">
                                <div class="date-main">{{ $job->created_at->format('Y-m-d') }}</div>
                                <div class="date-relative">{{ $job->created_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.jobs.show', $job) }}" class="btn btn-outline btn-sm">
                                    <i class="fas fa-eye"></i>
                                    {{ __('admin.jobs.index.view') }}
                                </a>
                                <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                    {{ __('admin.jobs.index.edit') }}
                                </a>
                                @if($job->status === 'active')
                                    <button type="button" class="btn btn-warning btn-sm" onclick="pauseJob({{ $job->id }})">
                                        <i class="fas fa-pause"></i>
                                        {{ __('admin.jobs.index.pause') }}
                                    </button>
                                @elseif($job->status === 'paused')
                                    <button type="button" class="btn btn-success btn-sm" onclick="activateJob({{ $job->id }})">
                                        <i class="fas fa-play"></i>
                                        {{ __('admin.jobs.index.activate') }}
                                    </button>
                                @endif
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteJob({{ $job->id }})">
                                    <i class="fas fa-trash"></i>
                                    {{ __('admin.jobs.index.delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <div class="empty-content">
                                <i class="fas fa-briefcase fa-3x"></i>
                                <h4>{{ __('admin.jobs.index.no_jobs') }}</h4>
                                <p>{{ __('admin.jobs.index.start_adding') }}</p>
                                <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    {{ __('admin.jobs.index.add_job') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            @if(isset($jobs) && $jobs->hasPages())
                <div class="pagination-wrapper">
                    {{ $jobs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- نموذج تأكيد الإجراء -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">{{ __('admin.jobs.index.confirm_action') }}</h3>
            <button class="close-btn" onclick="closeModal('confirmModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">{{ __('admin.jobs.index.confirm_action_message') }}</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('confirmModal')">{{ __('admin.jobs.index.cancel') }}</button>
            <button class="btn btn-primary" id="confirmAction">{{ __('admin.jobs.index.confirm') }}</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 تم تحميل صفحة إدارة الوظائف بنجاح');

    // === تهيئة التبويبات ===
    const filterTabs = document.querySelectorAll('.filter-tab');
    
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const status = this.getAttribute('data-status');
            
            // إزالة الفئة النشطة من جميع التبويبات
            filterTabs.forEach(t => t.classList.remove('active'));
            
            // إضافة الفئة النشطة للتبويب المحدد
            this.classList.add('active');
            
            // فلترة الجدول
            filterTableByStatus(status);
            
            console.log('تم التبديل إلى التبويب:', status);
        });
    });

    // === البحث المباشر ===
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            if (query.length > 2) {
                performLiveSearch(query);
            } else if (query.length === 0) {
                showAllRows();
            }
        });

        searchInput.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });

        searchInput.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    }

    // === تصفية الحالة ===
    const statusFilter = document.getElementById('statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            filterTableByStatus(this.value);
        });
    }

    // === تشغيل الأنيميشن ===
    startAnimations();
});

// === وظائف البحث والتصفية ===
function filterTableByStatus(status) {
    const rows = document.querySelectorAll('#jobsTable tbody tr:not(.empty-state)');
    
    rows.forEach(row => {
        if (!status || status === 'all') {
            row.style.display = '';
            return;
        }
        
        const rowStatus = row.getAttribute('data-status');
        if (rowStatus === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function performLiveSearch(query) {
    const rows = document.querySelectorAll('#jobsTable tbody tr:not(.empty-state)');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(query)) {
            row.style.display = '';
            row.style.background = 'var(--primary-lightest)';
            setTimeout(() => {
                row.style.background = '';
            }, 2000);
        } else {
            row.style.display = 'none';
        }
    });
}

function showAllRows() {
    const rows = document.querySelectorAll('#jobsTable tbody tr:not(.empty-state)');
    rows.forEach(row => {
        row.style.display = '';
        row.style.background = '';
    });
}

// === وظائف الإجراءات ===
function pauseJob(jobId) {
    showConfirmModal(
        '{{ __("admin.jobs.index.confirm_pause_message") }}',
        () => executeJobAction('pause', jobId)
    );
}

function activateJob(jobId) {
    showConfirmModal(
        '{{ __("admin.jobs.index.confirm_activate_message") }}',
        () => executeJobAction('activate', jobId)
    );
}

function deleteJob(jobId) {
    showConfirmModal(
        '{{ __("admin.jobs.index.confirm_delete_message") }}',
        () => executeJobAction('delete', jobId)
    );
}

function executeJobAction(action, jobId) {
    console.log(`تنفيذ الإجراء: ${action}`, jobId);
    
    // محاكاة عملية AJAX
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("admin.jobs.index.processing") }}...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> {{ __("admin.jobs.index.success") }}';
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            closeModal('confirmModal');
            showSuccessMessage(`{{ __("admin.jobs.index.action_success") }}`);
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

function scrollToApplications() {
    showSuccessMessage('{{ __("admin.jobs.index.applications_coming_soon") }}');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    showAllRows();
    
    // إعادة تعيين التبويب النشط
    filterTabs.forEach(t => t.classList.remove('active'));
    document.querySelector('[data-status="all"]').classList.add('active');
    
    showSuccessMessage('{{ __("admin.jobs.index.reset_filters") }}');
}

function refreshTable() {
    location.reload();
}

function exportJobs() {
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("admin.jobs.index.exporting") }}...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> {{ __("admin.jobs.index.exported") }}';
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            showSuccessMessage('{{ __("admin.jobs.index.export_success") }}');
        }, 1500);
    }, 3000);
}

function showJobReports() {
    showSuccessMessage('{{ __("admin.jobs.index.reports_coming_soon") }}');
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
`;
document.head.appendChild(style);

console.log('✅ تم تهيئة جميع مكونات صفحة إدارة الوظائف بنجاح');
</script>
@endpush
