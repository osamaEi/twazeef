@extends('dashboard.index')

@section('title', __('admin.applicants.index.title'))

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>{{ __('admin.applicants.index.welcome_message') }}</strong> {{ __('admin.applicants.index.welcome_description') }}
        </div>
    </div>

    <!-- الإحصائيات الرئيسية -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $applications->total() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $applications->total() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.applicants.index.total_applications') }}</div>
            <div class="stat-description">{{ __('admin.applicants.index.total_applications_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $applications->where('status', 'under-review')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $applications->where('status', 'under-review')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.applicants.index.under_review') }}</div>
            <div class="stat-description">{{ __('admin.applicants.index.under_review_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $applications->where('status', 'approved')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $applications->where('status', 'approved')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.applicants.index.approved') }}</div>
            <div class="stat-description">{{ __('admin.applicants.index.approved_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-down"></i>
                    <span>{{ $applications->where('status', 'rejected')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $applications->where('status', 'rejected')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.applicants.index.rejected') }}</div>
            <div class="stat-description">{{ __('admin.applicants.index.rejected_desc') }}</div>
        </div>
    </div>

   



    <!-- جدول الطلبات -->
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-file-alt"></i>
                {{ __('admin.applicants.index.applications_list') }}
            </h3>
            <div class="table-actions">
                <button class="btn btn-primary" onclick="exportAllApplications()">
                    <i class="fas fa-download"></i>
                    {{ __('admin.applicants.index.export_all') }}
                </button>
                <button class="btn btn-secondary" onclick="refreshTable()">
                    <i class="fas fa-refresh"></i>
                    {{ __('admin.applicants.index.refresh') }}
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
            <table class="main-table" id="applicationsTable">
                <thead>
                    <tr>
                        <th width="50">
                            <input type="checkbox" class="select-all-checkbox" id="selectAllTable">
                        </th>
                        <th>{{ __('admin.applicants.index.applicant') }}</th>
                        <th>{{ __('admin.applicants.index.job') }}</th>
                        <th>{{ __('admin.applicants.index.company') }}</th>
                        <th>{{ __('admin.applicants.index.status') }}</th>
                        <th>{{ __('admin.applicants.index.application_date') }}</th>
                        <th>{{ __('admin.applicants.index.last_updated') }}</th>
                        <th>{{ __('admin.applicants.index.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications ?? [] as $application)
                    <tr class="application-row" data-status="{{ $application->status }}">
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $application->id }}">
                        </td>
                        <td>
                            <div class="applicant-info">
                                <div class="applicant-avatar">
                                    @if($application->user && $application->user->profile_photo)
                                        <img src="{{ asset('storage/' . $application->user->profile_photo) }}" 
                                             alt="{{ $application->user->name }}" 
                                             class="applicant-photo">
                                    @else
                                        <div class="applicant-avatar-placeholder">
                                            {{ substr($application->user->name ?? 'م', 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="applicant-details">
                                    <div class="applicant-name">{{ $application->user->name ?? __('admin.applicants.index.not_specified') }}</div>
                                    <div class="applicant-email">{{ $application->user->email ?? __('admin.applicants.index.not_specified') }}</div>
                                    @if($application->user && $application->user->phone)
                                        <div class="applicant-phone">{{ $application->user->phone }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="job-info">
                                <div class="job-title">{{ $application->job->title ?? __('admin.applicants.index.not_specified') }}</div>
                                @if($application->job && $application->job->location)
                                    <div class="job-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $application->job->location }}
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="company-info">
                                <div class="company-avatar">
                                    @if($application->job && $application->job->company && $application->job->company->logo)
                                        <img src="{{ asset('storage/' . $application->job->company->logo) }}" 
                                             alt="{{ $application->job->company->name }}" 
                                             class="company-logo">
                                    @else
                                        <div class="company-avatar-placeholder">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="company-details">
                                    <div class="company-name">{{ $application->job->company->name ?? __('admin.applicants.index.not_specified') }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($application->status === 'under-review')
                                <span class="status-badge review">{{ __('admin.applicants.index.status_under_review') }}</span>
                            @elseif($application->status === 'approved')
                                <span class="status-badge active">{{ __('admin.applicants.index.status_approved') }}</span>
                            @elseif($application->status === 'rejected')
                                <span class="status-badge pending">{{ __('admin.applicants.index.status_rejected') }}</span>
                            @else
                                <span class="status-badge pending">{{ __('admin.applicants.index.status_pending') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="date-info">
                                <div class="date-main">{{ $application->created_at->format('Y-m-d') }}</div>
                                <div class="date-relative">{{ $application->created_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="date-info">
                                <div class="date-main">{{ $application->updated_at->format('Y-m-d') }}</div>
                                <div class="date-relative">{{ $application->updated_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.applicants.show', $application) }}" class="btn btn-outline btn-sm">
                                    <i class="fas fa-eye"></i>
                                    {{ __('admin.applicants.index.view') }}
                                </a>
                                @if($application->status === 'under-review')
                                    <button type="button" class="btn btn-primary btn-sm" onclick="approveApplication({{ $application->id }})">
                                        <i class="fas fa-check"></i>
                                        {{ __('admin.applicants.index.approve') }}
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="rejectApplication({{ $application->id }})">
                                        <i class="fas fa-times"></i>
                                        {{ __('admin.applicants.index.reject') }}
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <div class="empty-content">
                                <i class="fas fa-file-alt fa-3x"></i>
                                <h4>{{ __('admin.applicants.index.no_applications') }}</h4>
                                <p>{{ __('admin.applicants.index.no_applications_desc') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            @if(isset($applications) && $applications->hasPages())
                <div class="pagination-wrapper">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- نموذج تأكيد الإجراء -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">{{ __('admin.applicants.index.confirm_action') }}</h3>
            <button class="close-btn" onclick="closeModal('confirmModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">{{ __('admin.applicants.index.confirm_action_message') }}</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('confirmModal')">{{ __('admin.applicants.index.cancel') }}</button>
            <button class="btn btn-primary" id="confirmAction">{{ __('admin.applicants.index.confirm') }}</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 تم تحميل صفحة إدارة المتقدمين بنجاح');

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

    // === تصفية الوظيفة ===
    const jobFilter = document.getElementById('jobFilter');
    if (jobFilter) {
        jobFilter.addEventListener('change', function() {
            filterTableByJob(this.value);
        });
    }

    // === تهيئة الإجراءات الجماعية ===
    initializeBulkActions();

    // === تشغيل الأنيميشن ===
    startAnimations();
});

// === وظائف البحث والتصفية ===
function filterTableByStatus(status) {
    const rows = document.querySelectorAll('#applicationsTable tbody tr:not(.empty-state)');
    
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

function filterTableByJob(jobId) {
    if (!jobId) {
        showAllRows();
        return;
    }
    
    // يمكن إضافة منطق تصفية أكثر تعقيداً هنا
    console.log('تصفية حسب الوظيفة:', jobId);
}

function performLiveSearch(query) {
    const rows = document.querySelectorAll('#applicationsTable tbody tr:not(.empty-state)');
    
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
    const rows = document.querySelectorAll('#applicationsTable tbody tr:not(.empty-state)');
    rows.forEach(row => {
        row.style.display = '';
        row.style.background = '';
    });
}

// === الإجراءات الجماعية ===
function initializeBulkActions() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const selectAllTableCheckbox = document.getElementById('selectAllTable');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const selectedCountSpan = document.querySelector('.selected-count');
    const bulkActionButtons = document.querySelectorAll('.bulk-actions-right button');
    
    if (!selectAllCheckbox || !selectAllTableCheckbox) return;
    
    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        selectAllTableCheckbox.checked = this.checked;
        updateBulkActions();
    });

    selectAllTableCheckbox.addEventListener('change', function() {
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        selectAllCheckbox.checked = this.checked;
        updateBulkActions();
    });
    
    // Individual checkbox change
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateBulkActions();
        });
    });
    
    function updateBulkActions() {
        const selectedCount = document.querySelectorAll('.row-checkbox:checked').length;
        if (selectedCountSpan) {
            selectedCountSpan.textContent = '{{ __("admin.applicants.index.selected_count") }}'.replace('{count}', selectedCount);
        }
        
        bulkActionButtons.forEach(button => {
            button.disabled = selectedCount === 0;
        });
        
        // Update select all checkboxes
        if (selectedCount === 0) {
            selectAllCheckbox.checked = false;
            selectAllTableCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
            selectAllTableCheckbox.indeterminate = false;
        } else if (selectedCount === rowCheckboxes.length) {
            selectAllCheckbox.checked = true;
            selectAllTableCheckbox.checked = true;
            selectAllCheckbox.indeterminate = false;
            selectAllTableCheckbox.indeterminate = false;
        } else {
            selectAllCheckbox.checked = false;
            selectAllTableCheckbox.checked = false;
            selectAllCheckbox.indeterminate = true;
            selectAllTableCheckbox.indeterminate = true;
        }
    }
}

// === وظائف الإجراءات ===
function bulkApprove() {
    const selectedIds = getSelectedIds();
    if (selectedIds.length > 0) {
        showConfirmModal(
            '{{ __("admin.applicants.index.confirm_bulk_approve") }}'.replace('{count}', selectedIds.length),
            () => executeBulkAction('approve', selectedIds)
        );
    }
}

function bulkReject() {
    const selectedIds = getSelectedIds();
    if (selectedIds.length > 0) {
        showConfirmModal(
            '{{ __("admin.applicants.index.confirm_bulk_reject") }}'.replace('{count}', selectedIds.length),
            () => executeBulkAction('reject', selectedIds)
        );
    }
}

function bulkExport() {
    const selectedIds = getSelectedIds();
    if (selectedIds.length > 0) {
        console.log('تصدير العناصر المحددة:', selectedIds);
        showSuccessMessage('{{ __("admin.applicants.index.export_started") }}');
    }
}

function getSelectedIds() {
    const selectedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
    return Array.from(selectedCheckboxes).map(cb => cb.value);
}

function executeBulkAction(action, ids) {
    console.log(`تنفيذ الإجراء الجماعي: ${action}`, ids);
    
    // محاكاة عملية AJAX
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("admin.applicants.index.processing") }}...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> {{ __("admin.applicants.index.success") }}';
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            closeModal('confirmModal');
            showSuccessMessage(`{{ __("admin.applicants.index.bulk_action_success") }}`.replace('{action}', action === 'approve' ? '{{ __("admin.applicants.index.approve") }}' : '{{ __("admin.applicants.index.reject") }}').replace('{count}', ids.length));
        }, 1500);
    }, 2000);
}

// === الإجراءات الفردية ===
function approveApplication(id) {
    showConfirmModal(
        '{{ __("admin.applicants.index.confirm_approve_message") }}',
        () => executeApplicationAction('approve', id)
    );
}

function rejectApplication(id) {
    showConfirmModal(
        '{{ __("admin.applicants.index.confirm_reject_message") }}',
        () => executeApplicationAction('reject', id)
    );
}

function executeApplicationAction(action, id) {
    console.log(`تنفيذ الإجراء: ${action}`, id);
    
    // محاكاة عملية AJAX
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("admin.applicants.index.processing") }}...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> {{ __("admin.applicants.index.success") }}';
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            closeModal('confirmModal');
            showSuccessMessage(`{{ __("admin.applicants.index.action_success") }}`.replace('{action}', action === 'approve' ? '{{ __("admin.applicants.index.approve") }}' : '{{ __("admin.applicants.index.reject") }}'));
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

function scrollToTable() {
    const table = document.querySelector('.data-table');
    if (table) {
        table.scrollIntoView({ behavior: 'smooth' });
    }
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('jobFilter').value = '';
    showAllRows();
    
    // إعادة تعيين التبويب النشط
    filterTabs.forEach(t => t.classList.remove('active'));
    document.querySelector('[data-status="all"]').classList.add('active');
    
    showSuccessMessage('{{ __("admin.applicants.index.reset_filters") }}');
}

function refreshTable() {
    location.reload();
}

function exportAllApplications() {
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("admin.applicants.index.exporting") }}...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> {{ __("admin.applicants.index.exported") }}';
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            showSuccessMessage('{{ __("admin.applicants.index.export_success") }}');
        }, 1500);
    }, 3000);
}

function showReports() {
    showSuccessMessage('{{ __("admin.applicants.index.reports_coming_soon") }}');
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

console.log('✅ تم تهيئة جميع مكونات صفحة إدارة المتقدمين بنجاح');
</script>
@endpush
