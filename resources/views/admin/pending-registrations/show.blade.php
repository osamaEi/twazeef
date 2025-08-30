@extends('dashboard.index')

@section('title', 'تفاصيل المستخدم - إدارة التسجيلات')

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>تفاصيل المستخدم!</strong> يمكنك مراجعة تفاصيل المستخدم وتفعيل حسابه.
        </div>
    </div>

    <!-- معلومات المستخدم -->
    <div class="user-details-section">
        <div class="section-header">
            <h3>تفاصيل المستخدم</h3>
            <div class="section-actions">
                @if(!$user->is_active)
                <button class="btn btn-success" id="activate-user">
                    <i class="fas fa-check"></i>
                    تفعيل الحساب
                </button>
                @else
                <button class="btn btn-warning" id="deactivate-user">
                    <i class="fas fa-times"></i>
                    إلغاء التفعيل
                </button>
                @endif
                <a href="{{ route('admin.pending-registrations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    العودة للرئيسية
                </a>
            </div>
        </div>

        <div class="user-info-grid">
            <!-- المعلومات الأساسية -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fas fa-user"></i>
                    <h4>المعلومات الأساسية</h4>
                </div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">الاسم:</span>
                        <span class="info-value">{{ $user->first_name_ar }} {{ $user->last_name_ar }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الاسم بالإنجليزية:</span>
                        <span class="info-value">{{ $user->first_name_en }} {{ $user->last_name_en }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">البريد الإلكتروني:</span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">رقم الهاتف:</span>
                        <span class="info-value">{{ $user->phone }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">نوع الحساب:</span>
                        <span class="info-value">
                            @if($user->role === 'employee')
                                <span class="badge badge-primary">موظف</span>
                            @elseif($user->role === 'company')
                                <span class="badge badge-info">شركة</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">حالة التفعيل:</span>
                        <span class="info-value">
                            @if($user->is_active)
                                <span class="badge badge-success">مفعل</span>
                            @else
                                <span class="badge badge-warning">غير مفعل</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">تاريخ التسجيل:</span>
                        <span class="info-value">{{ $user->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>

            @if($user->role === 'employee')
            <!-- معلومات الموظف -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fas fa-user-graduate"></i>
                    <h4>معلومات الموظف</h4>
                </div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">رقم الهوية:</span>
                        <span class="info-value">{{ $user->national_id }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">تاريخ الميلاد:</span>
                        <span class="info-value">{{ $user->birth_date }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الجنس:</span>
                        <span class="info-value">
                            @if($user->gender === 'male')
                                ذكر
                            @else
                                أنثى
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الحالة الاجتماعية:</span>
                        <span class="info-value">
                            @switch($user->marital_status)
                                @case('single')
                                    أعزب
                                    @break
                                @case('married')
                                    متزوج
                                    @break
                                @case('divorced')
                                    مطلق
                                    @break
                                @case('widowed')
                                    أرمل
                                    @break
                                @default
                                    غير محدد
                            @endswitch
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">المؤهل العلمي:</span>
                        <span class="info-value">
                            @switch($user->education)
                                @case('high-school')
                                    ثانوية عامة
                                    @break
                                @case('diploma')
                                    دبلوم
                                    @break
                                @case('bachelor')
                                    بكالوريوس
                                    @break
                                @case('master')
                                    ماجستير
                                    @break
                                @case('phd')
                                    دكتوراه
                                    @break
                                @default
                                    غير محدد
                            @endswitch
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">التخصص:</span>
                        <span class="info-value">{{ $user->specialization }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">السيرة الذاتية:</span>
                        <span class="info-value">{{ $user->bio }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">العنوان:</span>
                        <span class="info-value">{{ $user->address }}</span>
                    </div>
                </div>
            </div>
            @endif

            @if($user->role === 'company')
            <!-- معلومات الشركة -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fas fa-building"></i>
                    <h4>معلومات الشركة</h4>
                </div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">اسم الشركة:</span>
                        <span class="info-value">{{ $user->company_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">نوع الكيان:</span>
                        <span class="info-value">
                            @switch($user->entity_type)
                                @case('company')
                                    شركة
                                    @break
                                @case('establishment')
                                    مؤسسة
                                    @break
                                @case('office')
                                    مكتب
                                    @break
                                @case('individual')
                                    فرد
                                    @break
                                @default
                                    غير محدد
                            @endswitch
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">عدد الموظفين:</span>
                        <span class="info-value">
                            @switch($user->employee_count)
                                @case('1-10')
                                    1-10 موظفين
                                    @break
                                @case('11-50')
                                    11-50 موظف
                                    @break
                                @case('51-200')
                                    51-200 موظف
                                    @break
                                @case('201-500')
                                    201-500 موظف
                                    @break
                                @case('500+')
                                    500+ موظف
                                    @break
                                @default
                                    غير محدد
                            @endswitch
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الوصف:</span>
                        <span class="info-value">{{ $user->description }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">العنوان:</span>
                        <span class="info-value">{{ $user->address }}</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- المستندات المرفقة -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fas fa-file-alt"></i>
                    <h4>المستندات المرفقة</h4>
                </div>
                <div class="card-content">
                    @if($user->role === 'employee')
                    <div class="info-row">
                        <span class="info-label">صورة الهوية:</span>
                        <span class="info-value">
                            @if($user->national_id_image)
                                <a href="{{ asset('storage/' . $user->national_id_image) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </a>
                            @else
                                <span class="text-muted">غير مرفق</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الشهادة العلمية:</span>
                        <span class="info-value">
                            @if($user->certificate_image)
                                <a href="{{ asset('storage/' . $user->certificate_image) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </a>
                            @else
                                <span class="text-muted">غير مرفق</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">شهادة الخبرة:</span>
                        <span class="info-value">
                            @if($user->experience_certificate)
                                <a href="{{ asset('storage/' . $user->experience_certificate) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </a>
                            @else
                                <span class="text-muted">غير مرفق</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">السيرة الذاتية:</span>
                        <span class="info-value">
                            @if($user->cv)
                                <a href="{{ asset('storage/' . $user->cv) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </a>
                            @else
                                <span class="text-muted">غير مرفق</span>
                            @endif
                        </span>
                    </div>
                    @endif

                    @if($user->role === 'company')
                    <div class="info-row">
                        <span class="info-label">الرخصة التجارية:</span>
                        <span class="info-value">
                            @if($user->commercial_license)
                                <a href="{{ asset('storage/' . $user->commercial_license) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </a>
                            @else
                                <span class="text-muted">غير مرفق</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">الشهادة الضريبية:</span>
                        <span class="info-value">
                            @if($user->tax_certificate)
                                <a href="{{ asset('storage/' . $user->tax_certificate) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </a>
                            @else
                                <span class="text-muted">غير مرفق</span>
                            @endif
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.user-details-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-top: 2rem;
    padding: 2rem;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e5e7eb;
}

.section-header h3 {
    margin: 0;
    color: #1f2937;
    font-size: 1.5rem;
}

.section-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.user-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.info-card {
    background: #f9fafb;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

.card-header {
    background: #003c6d;
    color: white;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-header h4 {
    margin: 0;
    font-size: 1.1rem;
}

.card-content {
    padding: 1.5rem;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e5e7eb;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #374151;
    min-width: 120px;
}

.info-value {
    color: #1f2937;
    text-align: left;
    flex: 1;
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

.badge-primary {
    background: #3b82f6;
    color: white;
}

.badge-info {
    background: #06b6d4;
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

.text-muted {
    color: #6b7280;
    font-style: italic;
}

.btn-sm {
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Activate user functionality
    const activateButton = document.getElementById('activate-user');
    
    if (activateButton) {
        activateButton.addEventListener('click', function() {
            if (confirm('هل أنت متأكد من تفعيل هذا الحساب؟')) {
                activateUser();
            }
        });
    }

    // Deactivate user functionality
    const deactivateButton = document.getElementById('deactivate-user');
    
    if (deactivateButton) {
        deactivateButton.addEventListener('click', function() {
            if (confirm('هل أنت متأكد من إلغاء تفعيل هذا الحساب؟')) {
                deactivateUser();
            }
        });
    }

    function activateUser() {
        const userId = '{{ $user->id }}';
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

    function deactivateUser() {
        const userId = '{{ $user->id }}';
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
