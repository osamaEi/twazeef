@extends('dashboard.index')

@section('title', __('admin.companies.index.title'))

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>{{ __('admin.companies.index.welcome_message') }}</strong> {{ __('admin.companies.index.welcome_description') }}
        </div>
    </div>

    <!-- الإحصائيات الرئيسية -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $companies->total() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $companies->total() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.companies.index.total_companies') }}</div>
            <div class="stat-description">{{ __('admin.companies.index.total_companies_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $approvedCompanies->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $approvedCompanies->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.companies.index.approved_companies') }}</div>
            <div class="stat-description">{{ __('admin.companies.index.approved_companies_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $underReviewCompanies->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $underReviewCompanies->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.companies.index.pending_companies') }}</div>
            <div class="stat-description">{{ __('admin.companies.index.pending_companies_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $companies->where('created_at', '>=', now()->startOfMonth())->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $companies->where('created_at', '>=', now()->startOfMonth())->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.companies.index.this_month') }}</div>
            <div class="stat-description">{{ __('admin.companies.index.this_month_desc') }}</div>
        </div>
    </div>

    <!-- الفرص السريعة -->


    <!-- تبويبات الفلترة -->
  

    <!-- البحث والفلترة -->
<div class="search-filters">

        
        
       
    </div>

    <!-- جدول الشركات -->
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-building"></i>
                {{ __('admin.companies.index.companies_list') }}
            </h3>
            <div class="table-actions">
                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    {{ __('admin.companies.index.add_new_company') }}
                </a>
              
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="table-content">
            <table class="main-table" id="companiesTable">
                <thead>
                    <tr>
                        <th>{{ __('admin.companies.index.company') }}</th>
                        <th>{{ __('admin.companies.index.contact_info') }}</th>
                        <th>{{ __('admin.companies.index.status') }}</th>
                        <th>{{ __('admin.companies.index.created_at') }}</th>
                        <th>{{ __('admin.companies.index.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr class="company-row" data-status="{{ $company->is_approved ? 'approved' : 'pending' }}">
                        <td>
                            <div class="company-info">
                                <div class="company-avatar">
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" 
                                             alt="{{ $company->name }}" 
                                             class="company-logo"
                                             onerror="this.src='{{ asset('assets/images/default-company.png') }}'">
                                    @else
                                        <div class="company-avatar-placeholder">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="company-details">
                                    <div class="company-name">{{ $company->name }}</div>
                                    @if($company->company_name)
                                        <div class="company-title">{{ $company->company_name }}</div>
                                    @endif
                                    @if($company->website)
                                        <a href="{{ $company->website }}" target="_blank" class="company-website">
                                            <i class="fas fa-external-link-alt"></i>
                                            {{ $company->website }}
                                        </a>
                                    @endif
                                    @if($company->description)
                                        <div class="company-description">{{ Str::limit($company->description, 60) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                                </div>
                                @if($company->phone)
                                    <div class="contact-item">
                                        <i class="fas fa-phone"></i>
                                        <a href="tel:{{ $company->phone }}">{{ $company->phone }}</a>
                                    </div>
                                @endif
                                @if($company->address)
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ Str::limit($company->address, 40) }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($company->is_approved)
                                <span class="status-badge active">{{ __('admin.companies.index.approved') }}</span>
                            @else
                                <span class="status-badge review">{{ __('admin.companies.index.pending') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="date-info">
                                <div class="date-main">{{ $company->created_at->format('Y-m-d') }}</div>
                                <div class="date-relative">{{ $company->created_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-outline btn-sm">
                                    <i class="fas fa-eye"></i>
                                    {{ __('admin.companies.index.view') }}
                                </a>
                                <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                    {{ __('admin.companies.index.edit') }}
                                </a>
                                @if(!$company->is_approved)
                                    <button type="button" class="btn btn-primary btn-sm" onclick="approveCompany({{ $company->id }})">
                                        <i class="fas fa-check"></i>
                                        {{ __('admin.companies.index.approve') }}
                                    </button>
                                @endif
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteCompany({{ $company->id }})">
                                    <i class="fas fa-trash"></i>
                                    {{ __('admin.companies.index.delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <div class="empty-content">
                                <i class="fas fa-building fa-3x"></i>
                                <h4>{{ __('admin.companies.index.no_companies') }}</h4>
                                <p>{{ __('admin.companies.index.start_adding') }}</p>
                                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    {{ __('admin.companies.index.add_company') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            @if($companies->hasPages())
                <div class="pagination-wrapper">
                    {{ $companies->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- نموذج تأكيد الإجراء -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">{{ __('admin.companies.index.confirm_action') }}</h3>
            <button class="close-btn" onclick="closeModal('confirmModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">{{ __('admin.companies.index.confirm_action_message') }}</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('confirmModal')">{{ __('admin.companies.index.cancel') }}</button>
            <button class="btn btn-primary" id="confirmAction">{{ __('admin.companies.index.confirm') }}</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 تم تحميل صفحة إدارة الشركات بنجاح');

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
    const rows = document.querySelectorAll('#companiesTable tbody tr:not(.empty-state)');
    
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
    const rows = document.querySelectorAll('#companiesTable tbody tr:not(.empty-state)');
    
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
    const rows = document.querySelectorAll('#companiesTable tbody tr:not(.empty-state)');
    rows.forEach(row => {
        row.style.display = '';
        row.style.background = '';
    });
}

// === وظائف الإجراءات ===
function approveCompany(companyId) {
    showConfirmModal(
        '{{ __("admin.companies.index.confirm_approve_message") }}',
        () => executeCompanyAction('approve', companyId)
    );
}

function deleteCompany(companyId) {
    showConfirmModal(
        '{{ __("admin.companies.index.confirm_delete_message") }}',
        () => executeCompanyAction('delete', companyId)
    );
}

function executeCompanyAction(action, companyId) {
    console.log(`تنفيذ الإجراء: ${action}`, companyId);
    
    if (action === 'approve') {
        // إرسال طلب اعتماد الشركة
        fetch(`/admin/companies/${companyId}/approve`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal('confirmModal');
                showSuccessMessage('{{ __("admin.companies.index.approve_success") }}');
                setTimeout(() => location.reload(), 1500);
            } else {
                showSuccessMessage('{{ __("admin.companies.index.approve_error") }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showSuccessMessage('{{ __("admin.companies.index.approve_error") }}');
        });
    } else if (action === 'delete') {
        // إرسال طلب حذف الشركة
        fetch(`/admin/companies/${companyId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal('confirmModal');
                showSuccessMessage('{{ __("admin.companies.index.delete_success") }}');
                setTimeout(() => location.reload(), 1500);
            } else {
                showSuccessMessage('{{ __("admin.companies.index.delete_error") }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showSuccessMessage('{{ __("admin.companies.index.delete_error") }}');
        });
    }
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

function scrollToPendingCompanies() {
    const pendingTab = document.querySelector('[data-status="pending"]');
    if (pendingTab) {
        pendingTab.click();
        const table = document.getElementById('companiesTable');
        if (table) {
            table.scrollIntoView({ behavior: 'smooth' });
        }
    }
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    showAllRows();
    
    // إعادة تعيين التبويب النشط
    filterTabs.forEach(t => t.classList.remove('active'));
    document.querySelector('[data-status="all"]').classList.add('active');
    
    showSuccessMessage('{{ __("admin.companies.index.reset_filters") }}');
}

function refreshTable() {
    location.reload();
}

function exportCompanies() {
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("admin.companies.index.exporting") }}...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> {{ __("admin.companies.index.exported") }}';
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            showSuccessMessage('{{ __("admin.companies.index.export_success") }}');
        }, 1500);
    }, 3000);
}

function showCompanyReports() {
    showSuccessMessage('{{ __("admin.companies.index.reports_coming_soon") }}');
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

console.log('✅ تم تهيئة جميع مكونات صفحة إدارة الشركات بنجاح');
</script>
@endpush
