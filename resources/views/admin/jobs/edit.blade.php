@extends('dashboard.index')

@section('title', 'تعديل الوظيفة')

@section('content')
<div class="admin-job-edit-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="breadcrumb">
                <a href="{{ route('admin.jobs.index') }}" class="breadcrumb-link">
                    <i class="fas fa-arrow-right"></i>
                    الوظائف
                </a>
                <span class="breadcrumb-separator">/</span>
                <a href="{{ route('admin.jobs.show', 1) }}" class="breadcrumb-link">تفاصيل الوظيفة</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-current">تعديل</span>
            </div>
            <h1 class="page-title">تعديل الوظيفة</h1>
            <p class="page-subtitle">تعديل تفاصيل وظيفة: مطور ويب متقدم</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.jobs.show', 1) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right"></i>
                رجوع
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">تعديل تفاصيل الوظيفة</h3>
        </div>
        
        <form action="{{ route('admin.jobs.update', 1) }}" method="POST" class="edit-form">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4 class="section-title">المعلومات الأساسية</h4>
                    
                    <div class="form-group">
                        <label for="title" class="form-label">المسمى الوظيفي *</label>
                        <input type="text" id="title" name="title" value="مطور ويب متقدم" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="company_id" class="form-label">الشركة *</label>
                        <select id="company_id" name="company_id" class="form-select" required>
                            <option value="">اختر الشركة</option>
                            <option value="1" selected>شركة التقنية المتقدمة</option>
                            <option value="2">شركة البرمجيات الحديثة</option>
                            <option value="3">شركة الحلول الرقمية</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="location" class="form-label">الموقع *</label>
                        <input type="text" id="location" name="location" value="الرياض، المملكة العربية السعودية" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="job_type" class="form-label">نوع العمل *</label>
                        <select id="job_type" name="job_type" class="form-select" required>
                            <option value="full-time" selected>دوام كامل</option>
                            <option value="part-time">دوام جزئي</option>
                            <option value="contract">عقد مؤقت</option>
                            <option value="freelance">عمل حر</option>
                        </select>
                    </div>
                </div>

                <!-- Salary and Requirements -->
                <div class="form-section">
                    <h4 class="section-title">الراتب والمتطلبات</h4>
                    
                    <div class="form-group">
                        <label for="salary_min" class="form-label">الراتب الأدنى (ريال)</label>
                        <input type="number" id="salary_min" name="salary_min" value="15000" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="salary_max" class="form-label">الراتب الأقصى (ريال)</label>
                        <input type="number" id="salary_max" name="salary_max" value="25000" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="experience_min" class="form-label">الخبرة الأدنى (سنوات)</label>
                        <input type="number" id="experience_min" name="experience_min" value="3" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="experience_max" class="form-label">الخبرة الأقصى (سنوات)</label>
                        <input type="number" id="experience_max" name="experience_max" value="5" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="education" class="form-label">المؤهل العلمي</label>
                        <input type="text" id="education" name="education" value="بكالوريوس في تقنية المعلومات" class="form-input">
                    </div>
                </div>

                <!-- Job Description -->
                <div class="form-section full-width">
                    <h4 class="section-title">وصف الوظيفة</h4>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">الوصف العام *</label>
                        <textarea id="description" name="description" class="form-textarea" rows="4" required>نحن نبحث عن مطور ويب متقدم للانضمام إلى فريق التطوير لدينا. سيكون مسؤولاً عن تطوير تطبيقات الويب الحديثة باستخدام أحدث التقنيات.</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="responsibilities" class="form-label">المهام والمسؤوليات</label>
                        <textarea id="responsibilities" name="responsibilities" class="form-textarea" rows="6">• تطوير تطبيقات الويب باستخدام أحدث التقنيات
• العمل مع فريق التطوير لتحسين الأداء
• كتابة كود نظيف وقابل للصيانة
• المشاركة في مراجعات الكود
• حل المشاكل التقنية المعقدة</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="requirements" class="form-label">المتطلبات</label>
                        <textarea id="requirements" name="requirements" class="form-textarea" rows="6">• خبرة في PHP, Laravel, JavaScript
• خبرة في قواعد البيانات MySQL
• خبرة في Git وطرق التطوير الحديثة
• مهارات حل المشاكل والعمل الجماعي
• معرفة جيدة بـ HTML, CSS</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="benefits" class="form-label">المزايا</label>
                        <textarea id="benefits" name="benefits" class="form-textarea" rows="4">• تأمين صحي شامل
• إجازة سنوية مدفوعة
• فرص التطوير المهني
• بيئة عمل مرنة</textarea>
                    </div>
                </div>

                <!-- Additional Settings -->
                <div class="form-section">
                    <h4 class="section-title">إعدادات إضافية</h4>
                    
                    <div class="form-group">
                        <label for="status" class="form-label">حالة الوظيفة</label>
                        <select id="status" name="status" class="form-select">
                            <option value="active" selected>نشطة</option>
                            <option value="paused">معلقة</option>
                            <option value="closed">مغلقة</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="expiry_date" class="form-label">تاريخ انتهاء الصلاحية</label>
                        <input type="date" id="expiry_date" name="expiry_date" value="2024-02-15" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label for="is_featured" class="form-label">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" class="form-checkbox">
                            وظيفة مميزة
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="is_urgent" class="form-label">
                            <input type="checkbox" id="is_urgent" name="is_urgent" value="1" class="form-checkbox">
                            وظيفة عاجلة
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="history.back()">
                    <i class="fas fa-times"></i>
                    إلغاء
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Form validation and enhancement
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.edit-form');
    const salaryMin = document.getElementById('salary_min');
    const salaryMax = document.getElementById('salary_max');
    
    // Validate salary range
    salaryMax.addEventListener('change', function() {
        if (parseInt(salaryMin.value) > parseInt(salaryMax.value)) {
            alert('الراتب الأدنى لا يمكن أن يكون أكبر من الراتب الأقصى');
            salaryMax.value = salaryMin.value;
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            alert('يرجى ملء جميع الحقول المطلوبة');
        }
    });
});
</script>
@endsection
