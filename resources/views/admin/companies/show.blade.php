@extends('dashboard.index')

@section('title', 'تفاصيل الشركة')

@section('content')
<div class="container mx-auto">
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-building"></i>
                تفاصيل الشركة: {{ $company->name }}
            </h3>
            <div class="table-actions">
                <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i>
                    تعديل
                </a>
                <a href="{{ route('admin.companies.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>

        <div class="table-content">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- معلومات الشركة الأساسية -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h4 class="text-xl font-bold text-gray-800 mb-6 border-b border-gray-200 pb-3">
                            <i class="fas fa-info-circle text-primary-green ml-2"></i>
                            المعلومات الأساسية
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="info-group">
                                <label class="info-label">اسم الشركة</label>
                                <div class="info-value">{{ $company->name }}</div>
                            </div>
                            
                            <div class="info-group">
                                <label class="info-label">نوع الشركة</label>
                                <div class="info-value">
                                    @switch($company->type)
                                        @case('technology')
                                            <span class="type-badge technology">تقنية</span>
                                            @break
                                        @case('finance')
                                            <span class="type-badge finance">مالية</span>
                                            @break
                                        @case('healthcare')
                                            <span class="type-badge healthcare">رعاية صحية</span>
                                            @break
                                        @case('education')
                                            <span class="type-badge education">تعليم</span>
                                            @break
                                        @case('retail')
                                            <span class="type-badge retail">بيع بالتجزئة</span>
                                            @break
                                        @case('manufacturing')
                                            <span class="type-badge manufacturing">تصنيع</span>
                                            @break
                                        @default
                                            <span class="type-badge other">أخرى</span>
                                    @endswitch
                                </div>
                            </div>
                            
                            <div class="info-group">
                                <label class="info-label">البريد الإلكتروني</label>
                                <div class="info-value">
                                    <a href="mailto:{{ $company->email }}" class="text-primary-green hover:underline">
                                        {{ $company->email }}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="info-group">
                                <label class="info-label">رقم الهاتف</label>
                                <div class="info-value">
                                    <a href="tel:{{ $company->phone }}" class="text-primary-green hover:underline">
                                        {{ $company->phone }}
                                    </a>
                                </div>
                            </div>
                            
                            @if($company->website)
                            <div class="info-group">
                                <label class="info-label">الموقع الإلكتروني</label>
                                <div class="info-value">
                                    <a href="{{ $company->website }}" target="_blank" class="text-primary-green hover:underline">
                                        {{ $company->website }}
                                        <i class="fas fa-external-link-alt mr-2 text-sm"></i>
                                    </a>
                                </div>
                            </div>
                            @endif
                            
                            @if($company->employee_count)
                            <div class="info-group">
                                <label class="info-label">عدد الموظفين</label>
                                <div class="info-value">{{ $company->employee_count }}</div>
                            </div>
                            @endif
                            
                            @if($company->address)
                            <div class="info-group md:col-span-2">
                                <label class="info-label">العنوان</label>
                                <div class="info-value">{{ $company->address }}</div>
                            </div>
                            @endif
                            
                            @if($company->description)
                            <div class="info-group md:col-span-2">
                                <label class="info-label">وصف الشركة</label>
                                <div class="info-value">{{ $company->description }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- معلومات إضافية -->
                    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                        <h4 class="text-xl font-bold text-gray-800 mb-6 border-b border-gray-200 pb-3">
                            <i class="fas fa-clock text-primary-green ml-2"></i>
                            معلومات النظام
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="info-group">
                                <label class="info-label">تاريخ الإنشاء</label>
                                <div class="info-value">{{ $company->created_at->format('Y-m-d H:i:s') }}</div>
                            </div>
                            
                            <div class="info-group">
                                <label class="info-label">آخر تحديث</label>
                                <div class="info-value">{{ $company->updated_at->format('Y-m-d H:i:s') }}</div>
                            </div>
                            
                            <div class="info-group">
                                <label class="info-label">معرف الشركة</label>
                                <div class="info-value font-mono text-sm">{{ $company->id }}</div>
                            </div>
                            
                            <div class="info-group">
                                <label class="info-label">الحالة</label>
                                <div class="info-value">
                                    @if($company->status === 'active' || !$company->status)
                                        <span class="status-badge active">مفعلة</span>
                                    @elseif($company->status === 'pending')
                                        <span class="status-badge pending">قيد المراجعة</span>
                                    @else
                                        <span class="status-badge inactive">معطلة</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- الشريط الجانبي -->
                <div class="lg:col-span-1">
                    <!-- شعار الشركة -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <div class="text-center">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="شعار {{ $company->name }}" 
                                     class="company-logo-large mx-auto">
                            @else
                                <div class="company-logo-placeholder">
                                    <i class="fas fa-building text-4xl text-gray-400"></i>
                                </div>
                            @endif
                            <h5 class="text-lg font-semibold text-gray-800 mt-3">{{ $company->name }}</h5>
                            <p class="text-gray-500">{{ $company->type ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                    
                    <!-- إجراءات سريعة -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h5 class="font-semibold text-gray-800 mb-4">إجراءات سريعة</h5>
                        <div class="space-y-3">
                            <a href="{{ route('admin.companies.edit', $company) }}" class="quick-action-btn edit">
                                <i class="fas fa-edit"></i>
                                تعديل الشركة
                            </a>
                            
                            <a href="#" class="quick-action-btn view">
                                <i class="fas fa-briefcase"></i>
                                عرض الوظائف
                            </a>
                            
                            <a href="#" class="quick-action-btn view">
                                <i class="fas fa-users"></i>
                                عرض الموظفين
                            </a>
                            
                            <button onclick="confirmDelete()" class="quick-action-btn delete w-full">
                                <i class="fas fa-trash"></i>
                                حذف الشركة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- نموذج حذف الشركة -->
<form id="deleteForm" action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete() {
    if (confirm('هل أنت متأكد من حذف هذه الشركة؟ هذا الإجراء لا يمكن التراجع عنه.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>

<style>
.info-group {
    margin-bottom: 1.5rem;
}

.info-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--grey-600);
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-size: 1rem;
    color: var(--grey-800);
    font-weight: 500;
    padding: 0.75rem;
    background: var(--grey-50);
    border-radius: 0.5rem;
    border: 1px solid var(--grey-200);
}

.type-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: white;
}

.type-badge.technology {
    background: #3b82f6;
}

.type-badge.finance {
    background: #10b981;
}

.type-badge.healthcare {
    background: #ef4444;
}

.type-badge.education {
    background: #8b5cf6;
}

.type-badge.retail {
    background: #f59e0b;
}

.type-badge.manufacturing {
    background: #6b7280;
}

.type-badge.other {
    background: #9ca3af;
}

.status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: white;
}

.status-badge.active {
    background: #10b981;
}

.status-badge.pending {
    background: #f59e0b;
}

.status-badge.inactive {
    background: #ef4444;
}

.company-logo-large {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 1rem;
    border: 3px solid var(--grey-100);
    box-shadow: var(--shadow-md);
}

.company-logo-placeholder {
    width: 120px;
    height: 120px;
    background: var(--grey-100);
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    border: 3px solid var(--grey-200);
}

.quick-action-btn {
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
}

.quick-action-btn.edit {
    background: var(--primary-lighter);
    color: var(--primary-green);
}

.quick-action-btn.edit:hover {
    background: var(--primary-green);
    color: white;
}

.quick-action-btn.view {
    background: #e0f2fe;
    color: #0284c7;
}

.quick-action-btn.view:hover {
    background: #0284c7;
    color: white;
}

.quick-action-btn.delete {
    background: #fef2f2;
    color: #dc2626;
}

.quick-action-btn.delete:hover {
    background: #dc2626;
    color: white;
}

.grid {
    display: grid;
}

.grid-cols-1 {
    grid-template-columns: repeat(1, minmax(0, 1fr));
}

@media (min-width: 1024px) {
    .lg\:grid-cols-3 {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
    
    .lg\:col-span-2 {
        grid-column: span 2 / span 2;
    }
    
    .lg\:col-span-1 {
        grid-column: span 1 / span 1;
    }
}

@media (min-width: 768px) {
    .md\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

.gap-6 {
    gap: 1.5rem;
}

.mt-6 {
    margin-top: 1.5rem;
}

.mb-6 {
    margin-bottom: 1.5rem;
}

.mb-4 {
    margin-bottom: 1rem;
}

.mb-3 {
    margin-bottom: 0.75rem;
}

.ml-2 {
    margin-right: 0.5rem;
}

.mr-2 {
    margin-right: 0.5rem;
}

.space-y-3 > * + * {
    margin-top: 0.75rem;
}

.text-xl {
    font-size: 1.25rem;
}

.text-lg {
    font-size: 1.125rem;
}

.text-4xl {
    font-size: 2.25rem;
}

.font-bold {
    font-weight: 700;
}

.font-semibold {
    font-weight: 600;
}

.text-gray-800 {
    color: #1f2937;
}

.text-gray-500 {
    color: #6b7280;
}

.text-gray-600 {
    color: #4b5563;
}

.text-gray-400 {
    color: #9ca3af;
}

.border-b {
    border-bottom-width: 1px;
}

.border-gray-200 {
    border-color: #e5e7eb;
}

.pb-3 {
    padding-bottom: 0.75rem;
}

.p-6 {
    padding: 1.5rem;
}

.rounded-lg {
    border-radius: 0.5rem;
}

.shadow-md {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.font-mono {
    font-family: ui-monospace, SFMono-Regular, "SF Mono", Consolas, "Liberation Mono", Menlo, monospace;
}

.text-sm {
    font-size: 0.875rem;
}

.hidden {
    display: none;
}

.text-primary-green {
    color: var(--primary-green);
}

.hover\:underline:hover {
    text-decoration: underline;
}

.target-blank {
    target: _blank;
}
</style>
@endsection
