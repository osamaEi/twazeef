@extends('dashboard.index')

@section('title', __('admin.users.index.title'))

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>{{ __('admin.users.index.welcome_message') }}</strong> {{ __('admin.users.index.welcome_description') }}
        </div>
    </div>

    <!-- الإحصائيات الرئيسية -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $users->total() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $users->total() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.users.index.total_users') }}</div>
            <div class="stat-description">{{ __('admin.users.index.total_users_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $users->where('role', 'admin')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $users->where('role', 'admin')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.users.index.admins') }}</div>
            <div class="stat-description">{{ __('admin.users.index.admins_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $users->where('role', 'company')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $users->where('role', 'company')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.users.index.companies') }}</div>
            <div class="stat-description">{{ __('admin.users.index.companies_desc') }}</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+{{ $users->where('role', 'employee')->count() ?? 0 }}</span>
                </div>
            </div>
            <div class="stat-value">{{ $users->where('role', 'employee')->count() ?? 0 }}</div>
            <div class="stat-label">{{ __('admin.users.index.employees') }}</div>
            <div class="stat-description">{{ __('admin.users.index.employees_desc') }}</div>
        </div>
    </div>

    <!-- جدول المستخدمين -->
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-users"></i>
                {{ __('admin.users.index.users_list') }}
            </h3>
            <div class="table-actions">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    {{ __('admin.users.index.add_new_user') }}
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
            <table class="main-table" id="usersTable">
                <thead>
                    <tr>
                        <th>{{ __('admin.users.index.user') }}</th>
                        <th>{{ __('admin.users.index.email') }}</th>
                        <th>{{ __('admin.users.index.role') }}</th>
                        <th>{{ __('admin.users.index.status') }}</th>
                        <th>{{ __('admin.users.index.created_at') }}</th>
                        <th>{{ __('admin.users.index.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="user-row" data-role="{{ $user->role }}" data-status="{{ $user->email_verified_at ? 'active' : 'pending' }}">
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" 
                                             alt="{{ $user->name }}" 
                                             class="user-avatar-img">
                                    @else
                                        <div class="user-avatar-placeholder">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ $user->name }}</div>
                                    @if($user->phone)
                                        <div class="user-phone">{{ $user->phone }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="email-info">
                                <a href="mailto:{{ $user->email }}" class="user-email">{{ $user->email }}</a>
                                @if($user->email_verified_at)
                                    <span class="verification-badge">
                                        <i class="fas fa-check-circle"></i>
                                        {{ __('admin.users.index.active_status') }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="status-badge admin">
                                    <i class="fas fa-user-shield"></i>
                                    {{ __('admin.users.index.admin_role') }}
                                </span>
                            @elseif($user->role === 'company')
                                <span class="status-badge company">
                                    <i class="fas fa-building"></i>
                                    {{ __('admin.users.index.company_role') }}
                                </span>
                            @else
                                <span class="status-badge employee">
                                    <i class="fas fa-user-tie"></i>
                                    {{ __('admin.users.index.employee_role') }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($user->email_verified_at)
                                <span class="status-badge active">
                                    <i class="fas fa-check-circle"></i>
                                    {{ __('admin.users.index.active_status') }}
                                </span>
                            @else
                                <span class="status-badge review">
                                    <i class="fas fa-clock"></i>
                                    {{ __('admin.users.index.pending_status') }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="date-info">
                                <div class="date-main">{{ $user->created_at->format('Y-m-d') }}</div>
                                <div class="date-relative">{{ $user->created_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline btn-sm">
                                    <i class="fas fa-eye"></i>
                                    {{ __('admin.users.index.view') }}
                                </a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                    {{ __('admin.users.index.edit') }}
                                </a>
                                @if(!$user->email_verified_at)
                                    <button type="button" class="btn btn-primary btn-sm" onclick="verifyUser({{ $user->id }})">
                                        <i class="fas fa-check"></i>
                                        {{ __('admin.users.index.activate') }}
                                    </button>
                                @endif
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">
                                    <i class="fas fa-trash"></i>
                                    {{ __('admin.users.index.delete') }}
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <div class="empty-content">
                                <i class="fas fa-users fa-3x"></i>
                                <h4>{{ __('admin.users.index.no_users') }}</h4>
                                <p>{{ __('admin.users.index.start_adding') }}</p>
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    {{ __('admin.users.index.add_user') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="pagination-wrapper">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<!-- نموذج تأكيد الإجراء -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">{{ __('admin.users.index.confirm_action') }}</h3>
            <button class="close-btn" onclick="closeModal('confirmModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">{{ __('admin.users.index.confirm_action_message') }}</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('confirmModal')">{{ __('admin.users.index.cancel') }}</button>
            <button class="btn btn-primary" id="confirmAction">{{ __('admin.users.index.confirm') }}</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 تم تحميل صفحة إدارة المستخدمين بنجاح');

    // === تشغيل الأنيميشن ===
    startAnimations();
});

// === وظائف الإجراءات ===
function verifyUser(userId) {
    showConfirmModal(
        '{{ __("admin.users.index.verify_user_confirm") }}',
        () => executeUserAction('verify', userId)
    );
}

function deleteUser(userId) {
    showConfirmModal(
        '{{ __("admin.users.index.delete_user_confirm") }}',
        () => executeUserAction('delete', userId)
    );
}

function executeUserAction(action, userId) {
    console.log(`تنفيذ الإجراء: ${action}`, userId);
    
    if (action === 'verify') {
        // إرسال طلب تفعيل المستخدم
        fetch(`/admin/users/${userId}/verify`, {
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
                showSuccessMessage('{{ __("admin.users.index.verify_success") }}');
                setTimeout(() => location.reload(), 1500);
            } else {
                showSuccessMessage('{{ __("admin.users.index.verify_error") }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showSuccessMessage('{{ __("admin.users.index.verify_error") }}');
        });
    } else if (action === 'delete') {
        // إرسال طلب حذف المستخدم
        fetch(`/admin/users/${userId}`, {
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
                showSuccessMessage('{{ __("admin.users.index.delete_success") }}');
                setTimeout(() => location.reload(), 1500);
            } else {
                showSuccessMessage('{{ __("admin.users.index.delete_error") }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showSuccessMessage('{{ __("admin.users.index.delete_error") }}');
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

console.log('✅ تم تهيئة جميع مكونات صفحة إدارة المستخدمين بنجاح');
</script>
@endpush


