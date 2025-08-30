@extends('dashboard.index')

@section('title', 'تعديل الطلب')

@section('content')
<div class="application-edit-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">تعديل الطلب</h1>
            <p class="page-subtitle">تحديث معلومات طلب التقديم</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('applications.show', $application) }}" class="btn btn-outline">
                <i class="fas fa-arrow-right"></i>
                العودة للطلب
            </a>
        </div>
    </div>

    <!-- Job Summary Card -->
    <div class="info-card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-briefcase"></i>
                معلومات الوظيفة
            </h2>
        </div>
        <div class="card-content">
            <div class="info-grid">
                <div class="info-item">
                    <label class="info-label">عنوان الوظيفة</label>
                    <p class="info-value">{{ $application->job->title }}</p>
                </div>
                <div class="info-item">
                    <label class="info-label">الشركة</label>
                    <p class="info-value">{{ $application->job->company->name ?? 'غير محدد' }}</p>
                </div>
                <div class="info-item">
                    <label class="info-label">الموقع</label>
                    <p class="info-value">{{ $application->job->location ?? 'غير محدد' }}</p>
                </div>
                <div class="info-item">
                    <label class="info-label">نوع الوظيفة</label>
                    <p class="info-value">{{ $application->job->type ?? 'غير محدد' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Form Card -->
    <div class="info-card">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-edit"></i>
                نموذج التعديل
            </h2>
        </div>
        <div class="card-content">
            <form action="{{ route('applications.update', $application) }}" method="POST" enctype="multipart/form-data" class="application-form">
                @csrf
                @method('PUT')

                <!-- Cover Letter Section -->
                <div class="form-section">
                    <label for="cover_letter" class="form-label">
                        خطاب التقديم <span class="required">*</span>
                    </label>
                    <textarea 
                        id="cover_letter" 
                        name="cover_letter" 
                        rows="10" 
                        class="form-textarea @error('cover_letter') error @enderror"
                        placeholder="اكتب خطاب تقديم مقنع يوضح لماذا أنت أفضل مرشح لهذه الوظيفة. اذكر خبرتك ذات الصلة ومهاراتك ولماذا تهتم بهذا الدور..."
                        required
                    >{{ old('cover_letter', $application->cover_letter) }}</textarea>
                    @error('cover_letter')
                        <p class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <div class="form-help">
                        <div class="help-text">
                            <i class="fas fa-info-circle"></i>
                            الحد الأدنى 100 حرف مطلوب
                        </div>
                        <div class="char-counter">
                            <span id="char-count" class="counter">0</span> حرف
                        </div>
                    </div>
                </div>

                <!-- Current Resume Section -->
                @if($application->resume_path)
                    <div class="form-section">
                        <label class="form-label">السيرة الذاتية الحالية</label>
                        <div class="current-resume">
                            <div class="resume-info">
                                <div class="resume-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="resume-details">
                                    <p class="resume-name">السيرة الذاتية الحالية</p>
                                    <p class="resume-date">تم الرفع في {{ $application->created_at->format('Y/m/d') }}</p>
                                </div>
                            </div>
                            <a href="{{ Storage::url($application->resume_path) }}" 
                               target="_blank"
                               class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                عرض
                            </a>
                        </div>
                    </div>
                @endif

                <!-- New Resume Upload Section -->
                <div class="form-section">
                    <label for="resume" class="form-label">
                        @if($application->resume_path)
                            استبدال السيرة الذاتية <span class="optional">(اختياري)</span>
                        @else
                            السيرة الذاتية <span class="optional">(اختياري)</span>
                        @endif
                    </label>
                    <div class="file-upload-area">
                        <div class="upload-content">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <div class="upload-text">
                                <label for="resume" class="upload-label">
                                    <span>رفع ملف</span>
                                    <input 
                                        id="resume" 
                                        name="resume" 
                                        type="file" 
                                        accept=".pdf,.doc,.docx"
                                        class="file-input"
                                    >
                                </label>
                                <p>أو اسحب وأفلت</p>
                            </div>
                            <p class="upload-info">
                                PDF, DOC, DOCX حتى 2 ميجابايت
                                @if($application->resume_path)
                                    <br>اتركه فارغاً للاحتفاظ بالسيرة الذاتية الحالية
                                @endif
                            </p>
                        </div>
                    </div>
                    @error('resume')
                        <p class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Application Status Info -->
                <div class="form-section status-info">
                    <div class="info-box">
                        <div class="info-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="info-content">
                            <h4 class="info-title">حالة الطلب</h4>
                            <p class="info-text">
                                الحالة الحالية: 
                                <span class="status-highlight">
                                    @php
                                        $statusText = [
                                            'pending' => 'قيد المراجعة',
                                            'shortlisted' => 'في القائمة المختصرة',
                                            'interviewed' => 'تمت المقابلة',
                                            'accepted' => 'مقبول',
                                            'rejected' => 'مرفوض'
                                        ];
                                        echo $statusText[$application->status ?? 'pending'] ?? 'قيد المراجعة';
                                    @endphp
                                </span>
                            </p>
                            <p class="info-note">
                                ملاحظة: تعديل طلبك لن يغير حالة المراجعة. الشركات سترى المعلومات المحدثة.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="form-actions">
                    <a href="{{ route('applications.show', $application) }}" class="btn btn-outline">
                        إلغاء
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        تحديث الطلب
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Editing Guidelines Card -->
    <div class="info-card guidelines-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-exclamation-triangle"></i>
                إرشادات التعديل
            </h3>
        </div>
        <div class="card-content">
            <div class="guidelines-list">
                <ul class="guidelines-items">
                    <li class="guideline-item">
                        <i class="fas fa-check"></i>
                        <span>يمكنك تعديل الطلبات التي لا تزال قيد المراجعة فقط</span>
                    </li>
                    <li class="guideline-item">
                        <i class="fas fa-check"></i>
                        <span>بمجرد مراجعة الطلب، قد يكون التعديل محدوداً</span>
                    </li>
                    <li class="guideline-item">
                        <i class="fas fa-check"></i>
                        <span>التغييرات في طلبك ستكون مرئية لأصحاب العمل</span>
                    </li>
                    <li class="guideline-item">
                        <i class="fas fa-check"></i>
                        <span>فكر بعناية قبل إجراء التغييرات لتجنب الالتباس</span>
                    </li>
                    <li class="guideline-item">
                        <i class="fas fa-check"></i>
                        <span>تاريخ طلبك والطوابع الزمنية محفوظة</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Character counter for cover letter
    const coverLetter = document.getElementById('cover_letter');
    const charCount = document.getElementById('char-count');
    const minRequired = 100;
    
    function updateCharCount() {
        const count = coverLetter.value.length;
        charCount.textContent = count;
        
        if (count < minRequired) {
            charCount.className = 'counter error';
        } else {
            charCount.className = 'counter success';
        }
    }
    
    coverLetter.addEventListener('input', updateCharCount);
    updateCharCount(); // Initialize count
    
    // File upload preview
    const resumeInput = document.getElementById('resume');
    const uploadArea = resumeInput.closest('.file-upload-area');
    
    resumeInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            uploadArea.innerHTML = `
                <div class="file-preview">
                    <div class="file-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="file-details">
                        <p class="file-name">${file.name}</p>
                        <p class="file-size">${(file.size / 1024 / 1024).toFixed(2)} ميجابايت</p>
                    </div>
                    <button type="button" onclick="resetFileInput()" class="btn btn-sm btn-outline">
                        إزالة الملف
                    </button>
                </div>
            `;
        }
    });
    
    function resetFileInput() {
        resumeInput.value = '';
        uploadArea.innerHTML = `
            <div class="upload-content">
                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                <div class="upload-text">
                    <label for="resume" class="upload-label">
                        <span>رفع ملف</span>
                        <input id="resume" name="resume" type="file" accept=".pdf,.doc,.docx" class="file-input">
                    </label>
                    <p>أو اسحب وأفلت</p>
                </div>
                <p class="upload-info">
                    PDF, DOC, DOCX حتى 2 ميجابايت
                    @if($application->resume_path)
                        <br>اتركه فارغاً للاحتفاظ بالسيرة الذاتية الحالية
                    @endif
                </p>
            </div>
        `;
    }
</script>
@endpush
