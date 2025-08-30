@extends('dashboard.index')

@section('title', __('admin.users.show.title'))

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>{{ __('admin.users.show.welcome_message') }}</strong> {{ __('admin.users.show.welcome_description') }}
        </div>
    </div>

    <!-- معلومات المستخدم -->
    <div class="dashboard-section mb-4">
        <div class="section-header-card">
            <h3 class="section-title-card">
                <i class="fas fa-user"></i>
                {{ __('admin.users.show.user_details') }}: {{ $user->name }}
            </h3>
            <div class="section-actions">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i>
                    {{ __('admin.users.show.edit_user') }}
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    {{ __('admin.users.show.back_to_list') }}
                </a>
            </div>
        </div>
        <div class="section-content">
            <div class="user-profile-grid">
                <!-- معلومات المستخدم الأساسية -->
                <div class="user-info-section">
                    <div class="info-card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fas fa-info-circle"></i>
                                {{ __('admin.users.show.basic_info') }}
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="info-grid">
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.full_name') }}</label>
                                    <div class="info-value">{{ $user->name }}</div>
                                </div>
                                
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.email') }}</label>
                                    <div class="info-value">
                                        {{ $user->email }}
                                        @if($user->email_verified_at)
                                            <span class="verification-badge verified">
                                                <i class="fas fa-check-circle"></i>
                                                {{ __('admin.users.show.verified') }}
                                            </span>
                                        @else
                                            <span class="verification-badge unverified">
                                                <i class="fas fa-times-circle"></i>
                                                {{ __('admin.users.show.unverified') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.role') }}</label>
                                    <div class="info-value">
                                        @if($user->role === 'admin')
                                            <span class="role-badge admin">
                                                <i class="fas fa-user-shield"></i>
                                                {{ __('admin.users.show.roles.admin') }}
                                            </span>
                                        @elseif($user->role === 'company')
                                            <span class="role-badge company">
                                                <i class="fas fa-building"></i>
                                                {{ __('admin.users.show.roles.company') }}
                                            </span>
                                        @else
                                            <span class="role-badge employee">
                                                <i class="fas fa-user-tie"></i>
                                                {{ __('admin.users.show.roles.employee') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.status') }}</label>
                                    <div class="info-value">
                                        @if($user->email_verified_at)
                                            <span class="status-badge active">
                                                <i class="fas fa-check-circle"></i>
                                                {{ __('admin.users.show.statuses.active') }}
                                            </span>
                                        @else
                                            <span class="status-badge review">
                                                <i class="fas fa-clock"></i>
                                                {{ __('admin.users.show.statuses.pending') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($user->phone)
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.phone') }}</label>
                                    <div class="info-value">
                                        <a href="tel:{{ $user->phone }}" class="phone-link">
                                            <i class="fas fa-phone"></i>
                                            {{ $user->phone }}
                                        </a>
                                    </div>
                                </div>
                                @endif
                                
                                @if($user->address)
                                <div class="info-group full-width">
                                    <label class="info-label">{{ __('admin.users.show.address') }}</label>
                                    <div class="info-value">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $user->address }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- معلومات النظام -->
                    <div class="info-card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fas fa-clock"></i>
                                {{ __('admin.users.show.system_info') }}
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="info-grid">
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.created_at') }}</label>
                                    <div class="info-value">
                                        <div class="date-info">
                                            <div class="date-main">{{ $user->created_at->format('Y-m-d') }}</div>
                                            <div class="date-relative">{{ $user->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.updated_at') }}</label>
                                    <div class="info-value">
                                        <div class="date-info">
                                            <div class="date-main">{{ $user->updated_at->format('Y-m-d') }}</div>
                                            <div class="date-relative">{{ $user->updated_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($user->email_verified_at)
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.email_verified_at') }}</label>
                                    <div class="info-value">
                                        <div class="date-info">
                                            <div class="date-main">{{ $user->email_verified_at->format('Y-m-d') }}</div>
                                            <div class="date-relative">{{ $user->email_verified_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="info-group">
                                    <label class="info-label">{{ __('admin.users.show.user_id') }}</label>
                                    <div class="info-value user-id">{{ $user->id }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- الشريط الجانبي -->
                <div class="user-sidebar">
                    <!-- صورة المستخدم -->
                    <div class="profile-card">
                        <div class="profile-avatar">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" 
                                     alt="{{ $user->name }}" 
                                     class="avatar-image">
                            @else
                                <div class="avatar-placeholder">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <div class="profile-info">
                            <h5 class="profile-name">{{ $user->name }}</h5>
                            <p class="profile-email">{{ $user->email }}</p>
                            <div class="profile-role">
                                @if($user->role === 'admin')
                                    <span class="role-tag admin">{{ __('admin.users.show.roles.admin') }}</span>
                                @elseif($user->role === 'company')
                                    <span class="role-tag company">{{ __('admin.users.show.roles.company') }}</span>
                                @else
                                    <span class="role-tag employee">{{ __('admin.users.show.roles.employee') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- إجراءات سريعة -->
                    <div class="actions-card">
                        <h5 class="actions-title">{{ __('admin.users.show.quick_actions') }}</h5>
                        <div class="actions-list">
                            <a href="{{ route('admin.users.edit', $user) }}" class="action-btn edit">
                                <i class="fas fa-edit"></i>
                                {{ __('admin.users.show.edit_user') }}
                            </a>
                            
                            @if($user->role === 'company')
                            <a href="#" class="action-btn view">
                                <i class="fas fa-building"></i>
                                {{ __('admin.users.show.view_company_info') }}
                            </a>
                            @endif
                            
                            @if($user->role === 'employee')
                            <a href="#" class="action-btn view">
                                <i class="fas fa-file-alt"></i>
                                {{ __('admin.users.show.view_resume') }}
                            </a>
                            @endif
                            
                            @if(!$user->email_verified_at)
                            <button onclick="verifyUser({{ $user->id }})" class="action-btn verify">
                                <i class="fas fa-check"></i>
                                {{ __('admin.users.show.verify_user') }}
                            </button>
                            @endif
                            
                            <button onclick="confirmDelete()" class="action-btn delete">
                                <i class="fas fa-trash"></i>
                                {{ __('admin.users.show.delete_user') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- نموذج حذف المستخدم -->
<form id="deleteForm" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<!-- نموذج تأكيد الإجراء -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">{{ __('admin.users.show.confirm_delete_title') }}</h3>
            <button class="close-btn" onclick="closeModal('confirmModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p>{{ __('admin.users.show.confirm_delete_message') }}</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('confirmModal')">{{ __('admin.users.show.cancel') }}</button>
            <button class="btn btn-danger" onclick="executeDelete()">{{ __('admin.users.show.confirm_delete') }}</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 تم تحميل صفحة عرض المستخدم بنجاح');
    
    // === تشغيل الأنيميشن ===
    startAnimations();
});

// === وظائف الإجراءات ===
function verifyUser(userId) {
    showConfirmModal(
        '{{ __("admin.users.show.confirm_verify_message") }}',
        () => executeUserAction('verify', userId)
    );
}

function confirmDelete() {
    showConfirmModal(
        '{{ __("admin.users.show.confirm_delete_message") }}',
        () => executeDelete()
    );
}

function executeDelete() {
    document.getElementById('deleteForm').submit();
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
                showSuccessMessage('{{ __("admin.users.show.verify_success") }}');
                setTimeout(() => location.reload(), 1500);
            } else {
                showSuccessMessage('{{ __("admin.users.show.verify_error") }}');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showSuccessMessage('{{ __("admin.users.show.verify_error") }}');
        });
    }
}

// === وظائف مساعدة ===
function showConfirmModal(message, onConfirm) {
    const modal = document.getElementById('confirmModal');
    const messageEl = modal.querySelector('.modal-body p');
    const confirmBtn = modal.querySelector('.modal-footer .btn-danger');
    
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
    const animatedElements = document.querySelectorAll('.info-card, .profile-card, .actions-card');
    
    animatedElements.forEach((element, index) => {
        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

// === إضافة أنيميشن الموجة ===
const actionButtons = document.querySelectorAll('.action-btn');
actionButtons.forEach(button => {
    button.addEventListener('click', function (e) {
        if (!this.disabled) {
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
    
    .info-card, .profile-card, .actions-card {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }
    
    .user-profile-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
    }
    
    .info-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    
    .card-header {
        background: var(--primary-lightest);
        padding: 1.5rem;
        border-bottom: 1px solid var(--primary-light);
    }
    
    .card-title {
        font-size: 1.125rem;
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
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .info-group.full-width {
        grid-column: 1 / -1;
    }
    
    .info-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        font-size: 1rem;
        color: #1f2937;
        font-weight: 500;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .verification-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 600;
        margin-right: 0.5rem;
    }
    
    .verification-badge.verified {
        background: #d1fae5;
        color: #059669;
    }
    
    .verification-badge.unverified {
        background: #fef3c7;
        color: #d97706;
    }
    
    .role-badge, .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
    }
    
    .role-badge.admin, .status-badge.active {
        background: var(--primary-green);
    }
    
    .role-badge.company {
        background: #10b981;
    }
    
    .role-badge.employee {
        background: #3b82f6;
    }
    
    .status-badge.review {
        background: #f59e0b;
    }
    
    .phone-link {
        color: var(--primary-green);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .phone-link:hover {
        text-decoration: underline;
    }
    
    .date-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .date-main {
        font-weight: 500;
        color: #1f2937;
    }
    
    .date-relative {
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    .user-id {
        font-family: monospace;
        font-size: 0.875rem;
        background: #f3f4f6;
        color: #374151;
    }
    
    .user-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .profile-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        text-align: center;
    }
    
    .profile-avatar {
        margin-bottom: 1.5rem;
    }
    
    .avatar-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--primary-light);
    }
    
    .avatar-placeholder {
        width: 100px;
        height: 100px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0 auto;
        border: 4px solid var(--primary-light);
    }
    
    .profile-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .profile-email {
        color: #6b7280;
        margin-bottom: 1rem;
    }
    
    .profile-role {
        margin-top: 1rem;
    }
    
    .role-tag {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
    }
    
    .actions-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }
    
    .actions-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .actions-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        width: 100%;
        text-align: right;
        position: relative;
        overflow: hidden;
    }
    
    .action-btn.edit {
        background: var(--primary-light);
        color: var(--primary-green);
    }
    
    .action-btn.edit:hover {
        background: var(--primary-green);
        color: white;
    }
    
    .action-btn.view {
        background: #e0f2fe;
        color: #0284c7;
    }
    
    .action-btn.view:hover {
        background: #0284c7;
        color: white;
    }
    
    .action-btn.verify {
        background: #d1fae5;
        color: #059669;
    }
    
    .action-btn.verify:hover {
        background: #059669;
        color: white;
    }
    
    .action-btn.delete {
        background: #fef2f2;
        color: #dc2626;
    }
    
    .action-btn.delete:hover {
        background: #dc2626;
        color: white;
    }
    
    @media (max-width: 1024px) {
        .user-profile-grid {
            grid-template-columns: 1fr;
        }
        
        .user-sidebar {
            order: -1;
        }
    }
`;
document.head.appendChild(style);

console.log('✅ تم تهيئة جميع مكونات صفحة عرض المستخدم بنجاح');
</script>
@endpush
