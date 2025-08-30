@extends('dashboard.index')

@section('title', __('admin.pending_registrations.title'))

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>{{ __('admin.pending_registrations.welcome_title') }}</strong> {{ __('admin.pending_registrations.welcome_message') }}
        </div>
    </div>

    <!-- الإحصائيات الرئيسية -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $stats['recent_registrations'] }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $stats['total_pending'] }}</div>
            <div class="stat-label">{{ __('admin.pending_registrations.stats.total_pending') }}</div>
            <div class="stat-description">{{ __('admin.pending_registrations.stats.total_pending_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $stats['pending_employees'] }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $stats['pending_employees'] }}</div>
            <div class="stat-label">{{ __('admin.pending_registrations.stats.pending_employees') }}</div>
            <div class="stat-description">{{ __('admin.pending_registrations.stats.pending_employees_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $stats['pending_companies'] }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $stats['pending_companies'] }}</div>
            <div class="stat-label">{{ __('admin.pending_registrations.stats.pending_companies') }}</div>
            <div class="stat-description">{{ __('admin.pending_registrations.stats.pending_companies_desc') }}</div>
        </div>
    </div>

    <!-- التبويبات -->
    <div class="tabs-container">
        <div class="tabs-header">
            <button class="tab-button active" data-tab="employees">
                <i class="fas fa-user-graduate"></i>
                {{ __('admin.pending_registrations.tabs.employees') }} ({{ $pendingEmployees->total() }})
            </button>
            <button class="tab-button" data-tab="companies">
                <i class="fas fa-building"></i>
                {{ __('admin.pending_registrations.tabs.companies') }} ({{ $pendingCompanies->total() }})
            </button>
        </div>

        <!-- تبويب الموظفين -->
        <div class="tab-content active" id="employees-tab">
            <div class="tab-header">
                <h3>{{ __('admin.pending_registrations.tabs.employees') }}</h3>
                <div class="tab-actions">
                    <button class="btn btn-primary" id="bulk-activate-employees" disabled>
                        <i class="fas fa-check"></i>
                        {{ __('admin.pending_registrations.actions.bulk_activate') }}
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select-all-employees">
                            </th>
                            <th>{{ __('admin.pending_registrations.table.name') }}</th>
                            <th>{{ __('admin.pending_registrations.table.email') }}</th>
                            <th>{{ __('admin.pending_registrations.table.phone') }}</th>
                            <th>{{ __('admin.pending_registrations.table.specialization') }}</th>
                            <th>{{ __('admin.pending_registrations.table.status') }}</th>
                            <th>{{ __('admin.pending_registrations.table.registration_date') }}</th>
                            <th>{{ __('admin.pending_registrations.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingEmployees as $employee)
                        <tr>
                            <td>
                                <input type="checkbox" class="employee-checkbox" value="{{ $employee->id }}">
                            </td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $employee->first_name_ar }} {{ $employee->last_name_ar }}</div>
                                        <div class="user-name-en">{{ $employee->first_name_en }} {{ $employee->last_name_en }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->specialization }}</td>
                            <td>
                                @if($employee->is_active)
                                    <span class="badge badge-success">{{ __('admin.pending_registrations.status.active') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('admin.pending_registrations.status.pending') }}</span>
                                @endif
                            </td>
                            <td>{{ $employee->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="action-buttons">
                                    @if(!$employee->is_active)
                                    <button class="btn btn-sm btn-success activate-user" data-user-id="{{ $employee->id }}" data-user-type="employee">
                                        <i class="fas fa-check"></i>
                                        {{ __('admin.pending_registrations.actions.activate') }}
                                    </button>
                                    @else
                                    <button class="btn btn-sm btn-warning deactivate-user" data-user-id="{{ $employee->id }}" data-user-type="employee">
                                        <i class="fas fa-times"></i>
                                        {{ __('admin.pending_registrations.actions.deactivate') }}
                                    </button>
                                    @endif
                                    <a href="{{ route('admin.pending-registrations.show', $employee) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                        {{ __('admin.pending_registrations.actions.view') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">{{ __('admin.pending_registrations.no_employees') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pendingEmployees->hasPages())
            <div class="pagination-container">
                {{ $pendingEmployees->links() }}
            </div>
            @endif
        </div>

        <!-- تبويب الشركات -->
        <div class="tab-content" id="companies-tab">
            <div class="tab-header">
                <h3>{{ __('admin.pending_registrations.tabs.companies') }}</h3>
                <div class="tab-actions">
                    <button class="btn btn-primary" id="bulk-activate-companies" disabled>
                        <i class="fas fa-check"></i>
                        {{ __('admin.pending_registrations.actions.bulk_activate') }}
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select-all-companies">
                            </th>
                            <th>{{ __('admin.pending_registrations.table.company_name') }}</th>
                            <th>{{ __('admin.pending_registrations.table.email') }}</th>
                            <th>{{ __('admin.pending_registrations.table.phone') }}</th>
                            <th>{{ __('admin.pending_registrations.table.sector') }}</th>
                            <th>{{ __('admin.pending_registrations.table.status') }}</th>
                            <th>{{ __('admin.pending_registrations.table.registration_date') }}</th>
                            <th>{{ __('admin.pending_registrations.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingCompanies as $company)
                        <tr>
                            <td>
                                <input type="checkbox" class="company-checkbox" value="{{ $company->id }}">
                            </td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div>
                                        <div class="user-name">{{ $company->company_name }}</div>
                                        <div class="user-name-en">{{ $company->first_name_en }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->phone }}</td>
                            <td>{{ $company->business_sector ?? __('admin.pending_registrations.not_specified') }}</td>
                            <td>
                                @if($company->is_active)
                                    <span class="badge badge-success">{{ __('admin.pending_registrations.status.active') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('admin.pending_registrations.status.pending') }}</span>
                                @endif
                            </td>
                            <td>{{ $company->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="action-buttons">
                                    @if(!$company->is_active)
                                    <button class="btn btn-sm btn-success activate-user" data-user-id="{{ $company->id }}" data-user-type="company">
                                        <i class="fas fa-check"></i>
                                        {{ __('admin.pending_registrations.actions.activate') }}
                                    </button>
                                    @else
                                    <button class="btn btn-sm btn-warning deactivate-user" data-user-id="{{ $company->id }}" data-user-type="company">
                                        <i class="fas fa-times"></i>
                                        {{ __('admin.pending_registrations.actions.deactivate') }}
                                    </button>
                                    @endif
                                    <a href="{{ route('admin.pending-registrations.show', $company) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                        {{ __('admin.pending_registrations.actions.view') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">{{ __('admin.pending_registrations.no_companies') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pendingCompanies->hasPages())
            <div class="pagination-container">
                {{ $pendingCompanies->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.tabs-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-top: 2rem;
}

.tabs-header {
    display: flex;
    border-bottom: 2px solid #e5e7eb;
    background: #f9fafb;
    border-radius: 12px 12px 0 0;
}

.tab-button {
    flex: 1;
    padding: 1rem 1.5rem;
    border: none;
    background: transparent;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    color: #6b7280;
    transition: all 0.3s ease;
    border-bottom: 3px solid transparent;
}

.tab-button:hover {
    background: #f3f4f6;
    color: #374151;
}

.tab-button.active {
    color: #003c6d;
    border-bottom-color: #003c6d;
    background: white;
}

.tab-content {
    display: none;
    padding: 2rem;
}

.tab-content.active {
    display: block;
}

.tab-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.tab-header h3 {
    margin: 0;
    color: #1f2937;
    font-size: 1.25rem;
}

.tab-actions {
    display: flex;
    gap: 1rem;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.data-table th,
.data-table td {
    padding: 1rem;
    text-align: right;
    border-bottom: 1px solid #e5e7eb;
}

.data-table th {
    background: #f9fafb;
    font-weight: 600;
    color: #374151;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: #003c6d;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.user-name {
    font-weight: 600;
    color: #1f2937;
}

.user-name-en {
    font-size: 0.875rem;
    color: #6b7280;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
}

.badge-success {
    background: #10b981;
    color: white;
}

.badge-warning {
    background: #f59e0b;
    color: white;
}

.btn-warning {
    background: #f59e0b;
    border-color: #f59e0b;
    color: white;
}

.btn-warning:hover {
    background: #d97706;
    border-color: #d97706;
    color: white;
}

.pagination-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

/* Bootstrap 4 Pagination Styling */
.pagination {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    direction: rtl;
}

.page-item {
    margin: 0;
}

.page-item:first-child .page-link {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.page-item:last-child .page-link {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-right: -1px;
    line-height: 1.25;
    color: #003c6d;
    background-color: #fff;
    border: 1px solid #dee2e6;
    text-decoration: none;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.page-link:hover {
    z-index: 2;
    color: #002a4f;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.page-link:focus {
    z-index: 3;
    color: #002a4f;
    background-color: #e9ecef;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 60, 109, 0.25);
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #003c6d;
    border-color: #003c6d;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border-color: #dee2e6;
}

.page-item .page-link {
    margin-right: 0;
    margin-left: -1px;
}

/* RTL specific adjustments */
.pagination {
    direction: rtl;
}

.page-item:first-child .page-link {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.page-item:last-child .page-link {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetTab = button.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            button.classList.add('active');
            document.getElementById(targetTab + '-tab').classList.add('active');
        });
    });

    // Checkbox functionality for employees
    const selectAllEmployees = document.getElementById('select-all-employees');
    const employeeCheckboxes = document.querySelectorAll('.employee-checkbox');
    const bulkActivateEmployees = document.getElementById('bulk-activate-employees');

    selectAllEmployees.addEventListener('change', () => {
        employeeCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllEmployees.checked;
        });
        updateBulkButtonState();
    });

    employeeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkButtonState);
    });

    // Checkbox functionality for companies
    const selectAllCompanies = document.getElementById('select-all-companies');
    const companyCheckboxes = document.querySelectorAll('.company-checkbox');
    const bulkActivateCompanies = document.getElementById('bulk-activate-companies');

    selectAllCompanies.addEventListener('change', () => {
        companyCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCompanies.checked;
        });
        updateBulkButtonState();
    });

    companyCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkButtonState);
    });

    function updateBulkButtonState() {
        const checkedEmployees = document.querySelectorAll('.employee-checkbox:checked').length;
        const checkedCompanies = document.querySelectorAll('.company-checkbox:checked').length;
        
        bulkActivateEmployees.disabled = checkedEmployees === 0;
        bulkActivateCompanies.disabled = checkedCompanies === 0;
    }

    // Individual activation
    document.querySelectorAll('.activate-user').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userType = this.getAttribute('data-user-type');
            
            if (confirm('{{ __("admin.pending_registrations.confirm.activate_single") }}')) {
                activateUser(userId);
            }
        });
    });

    // Individual deactivation
    document.querySelectorAll('.deactivate-user').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userType = this.getAttribute('data-user-type');
            
            if (confirm('{{ __("admin.pending_registrations.confirm.deactivate_single") }}')) {
                deactivateUser(userId);
            }
        });
    });

    // Bulk activation
    bulkActivateEmployees.addEventListener('click', () => {
        const checkedIds = Array.from(document.querySelectorAll('.employee-checkbox:checked'))
            .map(checkbox => checkbox.value);
        
        if (checkedIds.length > 0 && confirm('{{ __("admin.pending_registrations.confirm.activate_bulk") }}'.replace(':count', checkedIds.length))) {
            bulkActivateUsers(checkedIds);
        }
    });

    bulkActivateCompanies.addEventListener('click', () => {
        const checkedIds = Array.from(document.querySelectorAll('.company-checkbox:checked'))
            .map(checkbox => checkbox.value);
        
        if (checkedIds.length > 0 && confirm('{{ __("admin.pending_registrations.confirm.activate_bulk") }}'.replace(':count', checkedIds.length))) {
            bulkActivateUsers(checkedIds);
        }
    });

    function activateUser(userId) {
        const csrfToken = getCsrfToken();
        
        fetch(`/admin/pending-registrations/${userId}/activate`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('تم تفعيل الحساب بنجاح', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showNotification(data.message || 'حدث خطأ أثناء التفعيل', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء التفعيل', 'error');
        });
    }

    function deactivateUser(userId) {
        const csrfToken = getCsrfToken();
        
        fetch(`/admin/pending-registrations/${userId}/deactivate`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('تم إلغاء تفعيل الحساب بنجاح', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showNotification(data.message || 'حدث خطأ أثناء إلغاء التفعيل', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء إلغاء التفعيل', 'error');
        });
    }

    function bulkActivateUsers(userIds) {
        const csrfToken = getCsrfToken();
        
        fetch('/admin/pending-registrations/bulk-activate', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ user_ids: userIds }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showNotification(data.message || 'حدث خطأ أثناء التفعيل', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء التفعيل', 'error');
        });
    }

    function getCsrfToken() {
        // Try to get CSRF token from meta tag
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) {
            return metaTag.getAttribute('content');
        }
        
        // Fallback: try to get from cookie
        const token = document.cookie
            .split(';')
            .find(row => row.trim().startsWith('XSRF-TOKEN='));
        
        if (token) {
            return decodeURIComponent(token.split('=')[1]);
        }
        
        // Last fallback: return empty string (will cause server to reject)
        console.warn('CSRF token not found, request may be rejected by server');
        return '';
    }

    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        `;
        
        // Add to page
        document.body.appendChild(notification);
        
        // Show notification
        setTimeout(() => notification.classList.add('show'), 100);
        
        // Remove notification
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
});
</script>
@endsection
