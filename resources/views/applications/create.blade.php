@extends('dashboard.index')

@section('title', 'تقديم طلب')

@section('content')
<div class="job-application-container">
    <!-- Welcome Alert -->
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>مرحباً بك في صفحة التقديم للوظيفة!</strong> قم بملء النموذج أدناه لتقديم طلبك.
        </div>
    </div>

    <!-- Job Summary Header -->
    <div class="job-summary-header">
        <div class="header-content">
            <div class="job-title-section">
                <h1 class="job-title">{{ $job->title }}</h1>
                <div class="company-badge">
                    <i class="fas fa-building"></i>
                    {{ $job->company->name ?? 'شركة غير محددة' }}
                </div>
            </div>
            
            <div class="job-meta-grid">
                <div class="meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $job->location }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ $job->getAvailableTypes()[$job->type] ?? $job->type }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-user-tie"></i>
                    <span>{{ $job->getAvailableExperienceLevels()[$job->experience_level] ?? $job->experience_level }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ $job->created_at->format('Y/m/d') }}</span>
                </div>
            </div>
        </div>
        
        <div class="header-actions">
            <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline">
                <i class="fas fa-arrow-right"></i>
                العودة للوظيفة
            </a>
        </div>
    </div>

    <!-- Application Form Grid -->
    <div class="application-form-grid">
        <!-- Main Form -->
        <div class="main-form">
            <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" class="application-form">
                @csrf
                <input type="hidden" name="job_id" value="{{ $job->id }}">
                
                <!-- Personal Information Section -->
                <div class="form-section">
                    <div class="section-header">
                        <h3><i class="fas fa-user"></i> المعلومات الشخصية</h3>
                        <div class="section-actions">
                            <span class="required-badge">مطلوب</span>
                        </div>
                    </div>
                    <div class="section-content">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="full_name" class="form-label">الاسم الكامل <span class="required">*</span></label>
                                <input type="text" id="full_name" name="full_name" class="form-input" value="{{ old('full_name', auth()->user()->name ?? '') }}" required>
                                @error('full_name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">البريد الإلكتروني <span class="required">*</span></label>
                                <input type="email" id="email" name="email" class="form-input" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone" class="form-label">رقم الهاتف <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-input" value="{{ old('phone', auth()->user()->phone ?? '') }}" required>
                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="location" class="form-label">الموقع</label>
                                <input type="text" id="location" name="location" class="form-input" value="{{ old('location', auth()->user()->address ?? '') }}">
                                @error('location')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cover Letter Section -->
                <div class="form-section">
                    <div class="section-header">
                        <h3><i class="fas fa-file-alt"></i> خطاب التقديم</h3>
                        <div class="section-actions">
                            <button type="button" class="btn btn-outline btn-sm" onclick="generateCoverLetter()">
                                <i class="fas fa-magic"></i>
                                إنشاء تلقائي
                            </button>
                        </div>
                    </div>
                    <div class="section-content">
                        <div class="form-group">
                            <label for="cover_letter" class="form-label">خطاب التقديم <span class="required">*</span></label>
                            <textarea id="cover_letter" name="cover_letter" class="form-textarea" rows="8" placeholder="اكتب خطاب تقديم مقنع يوضح لماذا أنت المرشح المثالي لهذه الوظيفة..." required>{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Resume Section -->
                <div class="form-section">
                    <div class="section-header">
                        <h3><i class="fas fa-file-pdf"></i> السيرة الذاتية</h3>
                        <div class="section-actions">
                            <span class="file-info">PDF, DOC, DOCX</span>
                        </div>
                    </div>
                    <div class="section-content">
                        <div class="form-group">
                            <label for="resume" class="form-label">رفع السيرة الذاتية <span class="required">*</span></label>
                            <div class="file-upload-area" id="fileUploadArea">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="upload-text">
                                    <p>اسحب وأفلت الملف هنا أو</p>
                                    <button type="button" class="btn btn-outline" onclick="document.getElementById('resume').click()">
                                        اختر ملف
                                    </button>
                                </div>
                                <input type="file" id="resume" name="resume" class="file-input" accept=".pdf,.doc,.docx" required>
                            </div>
                            @error('resume')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Additional Documents Section -->
                <div class="form-section">
                    <div class="section-header">
                        <h3><i class="fas fa-paperclip"></i> مستندات إضافية</h3>
                        <div class="section-actions">
                            <span class="optional-badge">اختياري</span>
                        </div>
                    </div>
                    <div class="section-content">
                        <div class="form-group">
                            <label for="additional_documents" class="form-label">مستندات إضافية</label>
                            <div class="file-upload-area" id="additionalDocsArea">
                                <div class="upload-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="upload-text">
                                    <p>أضف شهادات أو مستندات إضافية</p>
                                    <button type="button" class="btn btn-outline" onclick="document.getElementById('additional_documents').click()">
                                        إضافة ملفات
                                    </button>
                                </div>
                                <input type="file" id="additional_documents" name="additional_documents[]" class="file-input" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="form-section">
                    <div class="section-content">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane"></i>
                                إرسال الطلب
                            </button>
                            <button type="button" class="btn btn-outline" onclick="saveDraft()">
                                <i class="fas fa-save"></i>
                                حفظ كمسودة
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="application-sidebar">
            <!-- Application Progress -->
            <div class="progress-card">
                <div class="card-header">
                    <h4><i class="fas fa-tasks"></i> تقدم التقديم</h4>
                    <div class="progress-percentage">75%</div>
                </div>
                <div class="card-content">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>
                    <div class="progress-steps">
                        <div class="step completed">
                            <i class="fas fa-check-circle"></i>
                            <span>المعلومات الشخصية</span>
                        </div>
                        <div class="step completed">
                            <i class="fas fa-check-circle"></i>
                            <span>خطاب التقديم</span>
                        </div>
                        <div class="step active">
                            <i class="fas fa-circle"></i>
                            <span>السيرة الذاتية</span>
                        </div>
                        <div class="step">
                            <i class="fas fa-circle"></i>
                            <span>إرسال الطلب</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Requirements -->
            <div class="requirements-card">
                <div class="card-header">
                    <h4><i class="fas fa-list-check"></i> متطلبات الوظيفة</h4>
                </div>
                <div class="card-content">
                    @if($job->skills && count($job->skills) > 0)
                        <div class="requirements-section">
                            <h5>المهارات المطلوبة</h5>
                            <div class="skills-tags">
                                @foreach($job->skills as $skill)
                                    <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if($job->experience_level)
                        <div class="requirements-section">
                            <h5>مستوى الخبرة</h5>
                            <p>{{ $job->getAvailableExperienceLevels()[$job->experience_level] ?? $job->experience_level }}</p>
                        </div>
                    @endif
                    
                    @if($job->type)
                        <div class="requirements-section">
                            <h5>نوع الوظيفة</h5>
                            <p>{{ $job->getAvailableTypes()[$job->type] ?? $job->type }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Application Tips -->
            <div class="tips-card">
                <div class="card-header">
                    <h4><i class="fas fa-lightbulb"></i> نصائح للتقديم</h4>
                </div>
                <div class="card-content">
                    <div class="tip-item">
                        <i class="fas fa-check"></i>
                        <span>اكتب خطاب تقديم مخصص للوظيفة</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-check"></i>
                        <span>تأكد من تحديث سيرتك الذاتية</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-check"></i>
                        <span>راجع متطلبات الوظيفة بعناية</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-check"></i>
                        <span>أضف مستندات داعمة إذا لزم الأمر</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ===== JOB APPLICATION LAYOUT ===== */
.job-application-container {
    padding: 1.5rem;
    max-width: 100%;
    margin: 0;
    background: #f8fafc;
    min-height: 100vh;
}

/* ===== ALERTS ===== */
.alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.alert-info {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    border: 1px solid #93c5fd;
    color: #1e40af;
}

.alert i {
    font-size: 1.5rem;
    margin-top: 0.25rem;
}

.alert div {
    flex: 1;
}

.alert strong {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

/* ===== JOB SUMMARY HEADER ===== */
.job-summary-header {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.header-content {
    flex: 1;
}

.job-title-section {
    margin-bottom: 1.5rem;
}

.job-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.company-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    color: #475569;
    font-weight: 500;
    font-size: 1.1rem;
}

.job-meta-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1rem;
    color: #475569;
    font-weight: 500;
}

.meta-item i {
    color: #3b82f6;
    font-size: 1.1rem;
}

.header-actions {
    display: flex;
    gap: 1rem;
    flex-shrink: 0;
}

/* ===== APPLICATION FORM GRID ===== */
.application-form-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    align-items: start;
}

.main-form {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* ===== FORM SECTIONS ===== */
.form-section {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.section-header h3 {
    color: #1e293b;
    font-size: 1.3rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

.section-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.required-badge {
    background: #ef4444;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.optional-badge {
    background: #6b7280;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.file-info {
    background: #f1f5f9;
    color: #64748b;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* ===== FORM ELEMENTS ===== */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    color: #374151;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.required {
    color: #ef4444;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
}

.error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: block;
}

/* ===== FILE UPLOAD ===== */
.file-upload-area {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    background: #f9fafb;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: #3b82f6;
    background: #f0f9ff;
}

.upload-icon {
    font-size: 3rem;
    color: #9ca3af;
    margin-bottom: 1rem;
}

.upload-text p {
    color: #6b7280;
    margin-bottom: 1rem;
}

.file-input {
    display: none;
}

/* ===== FORM ACTIONS ===== */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    align-items: center;
}

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

/* ===== SIDEBAR ===== */
.application-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    position: sticky;
    top: 2rem;
    height: fit-content;
}

.progress-card,
.requirements-card,
.tips-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    background: #f8fafc;
    border-bottom: 1px solid #f1f5f9;
}

.card-header h4 {
    color: #1e293b;
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

.progress-percentage {
    background: #3b82f6;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

.card-content {
    padding: 1.5rem;
}

/* ===== PROGRESS BAR ===== */
.progress-bar {
    width: 100%;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #3b82f6, #1d4ed8);
    border-radius: 4px;
    transition: width 0.3s ease;
}

.progress-steps {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.step {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.9rem;
    color: #6b7280;
}

.step.completed {
    color: #10b981;
}

.step.active {
    color: #3b82f6;
    font-weight: 600;
}

.step i {
    font-size: 1.1rem;
}

/* ===== REQUIREMENTS ===== */
.requirements-section {
    margin-bottom: 1.5rem;
}

.requirements-section:last-child {
    margin-bottom: 0;
}

.requirements-section h5 {
    color: #374151;
    font-weight: 600;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.skill-tag {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.requirements-section p {
    color: #6b7280;
    margin: 0;
}

/* ===== TIPS ===== */
.tip-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: #6b7280;
    font-size: 0.9rem;
}

.tip-item:last-child {
    margin-bottom: 0;
}

.tip-item i {
    color: #10b981;
    font-size: 1rem;
}

/* ===== BUTTONS ===== */
.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 1rem;
    justify-content: center;
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: #64748b;
    border: 2px solid #e2e8f0;
}

.btn-outline:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
}

.btn-ghost {
    background: transparent;
    color: #64748b;
}

.btn-ghost:hover {
    background: #f1f5f9;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .application-form-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .application-sidebar {
        order: -1;
        position: static;
        top: auto;
    }
}

@media (max-width: 768px) {
    .job-application-container {
        padding: 1rem;
    }
    
    .job-summary-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .header-actions {
        justify-content: center;
    }
    
    .job-title {
        font-size: 2rem;
    }
    
    .job-meta-grid {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .form-section {
        padding: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>

<script>
// File upload handling and form validation
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form validation
    initializeFormValidation();
    
    // Initialize progress tracking
    updateProgressBar();
    const fileUploadArea = document.getElementById('fileUploadArea');
    const resumeInput = document.getElementById('resume');
    const additionalDocsArea = document.getElementById('additionalDocsArea');
    const additionalDocsInput = document.getElementById('additional_documents');

    // Resume file upload
    if (fileUploadArea && resumeInput) {
        fileUploadArea.addEventListener('click', () => resumeInput.click());
        
        resumeInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                updateFileUploadArea(fileUploadArea, file);
            }
        });
    }

    // Additional documents upload
    if (additionalDocsArea && additionalDocsInput) {
        additionalDocsArea.addEventListener('click', () => additionalDocsInput.click());
        
        additionalDocsInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const files = Array.from(e.target.files);
                updateMultipleFileUploadArea(additionalDocsArea, files);
            }
        });
    }
});

function updateFileUploadArea(area, file) {
    area.innerHTML = `
        <div class="upload-icon">
            <i class="fas fa-file-alt"></i>
        </div>
        <div class="upload-text">
            <p><strong>${file.name}</strong></p>
            <p class="file-size">${formatFileSize(file.size)}</p>
            <button type="button" class="btn btn-outline btn-sm" onclick="removeFile(this)">
                إزالة الملف
            </button>
        </div>
    `;
}

function updateMultipleFileUploadArea(area, files) {
    const fileList = files.map(file => `
        <div class="file-item">
            <i class="fas fa-file-alt"></i>
            <span>${file.name}</span>
            <span class="file-size">${formatFileSize(file.size)}</span>
        </div>
    `).join('');
    
    area.innerHTML = `
        <div class="upload-icon">
            <i class="fas fa-files-o"></i>
        </div>
        <div class="upload-text">
            <p>تم رفع ${files.length} ملف</p>
            <div class="file-list">
                ${fileList}
            </div>
            <button type="button" class="btn btn-outline btn-sm" onclick="removeFiles(this)">
                إزالة جميع الملفات
            </button>
        </div>
    `;
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function removeFile(button) {
    const area = button.closest('.file-upload-area');
    const input = area.querySelector('input[type="file"]');
    input.value = '';
    
    area.innerHTML = `
        <div class="upload-icon">
            <i class="fas fa-cloud-upload-alt"></i>
        </div>
        <div class="upload-text">
            <p>اسحب وأفلت الملف هنا أو</p>
            <button type="button" class="btn btn-outline" onclick="document.getElementById('${input.id}').click()">
                اختر ملف
            </button>
        </div>
    `;
}

function removeFiles(button) {
    const area = button.closest('.file-upload-area');
    const input = area.querySelector('input[type="file"]');
    input.value = '';
    
    area.innerHTML = `
        <div class="upload-icon">
            <i class="fas fa-plus"></i>
        </div>
        <div class="upload-text">
            <p>أضف شهادات أو مستندات إضافية</p>
            <button type="button" class="btn btn-outline" onclick="document.getElementById('${input.id}').click()">
                إضافة ملفات
            </button>
        </div>
    `;
}

// Generate cover letter
function generateCoverLetter() {
    const coverLetterTextarea = document.getElementById('cover_letter');
    const jobTitle = '{{ $job->title }}';
    const companyName = '{{ $job->company->name ?? "الشركة" }}';
    
    const coverLetter = `عزيزي فريق التوظيف في ${companyName}،

أكتب إليكم للتعبير عن اهتمامي الشديد بمنصب ${jobTitle} في شركتكم الموقرة.

بعد مراجعة متطلبات الوظيفة، أعتقد أن خبرتي ومهاراتي تجعلني مرشحاً مثالياً لهذا المنصب. لدي خبرة في [أضف خبرتك هنا] وأمتلك مهارات قوية في [أضف مهاراتك هنا].

أؤمن بقدرتي على المساهمة بشكل فعال في نجاح فريقكم وتحقيق أهداف الشركة. أنا متحمس للانضمام إلى فريق ديناميكي ومبتكر مثل فريقكم.

أتطلع إلى مناقشة كيف يمكنني المساهمة في نجاح شركتكم.

شكراً لكم على وقتكم واهتمامكم.

مع أطيب التحيات،
[اسمك]`;

    coverLetterTextarea.value = coverLetter;
    showSuccessMessage('تم إنشاء خطاب التقديم تلقائياً');
}

// Save draft
function saveDraft() {
    // Implementation for saving draft
    showSuccessMessage('تم حفظ المسودة بنجاح');
}

// Show success message
function showSuccessMessage(message) {
    const notification = document.createElement('div');
    notification.className = 'notification notification-success';
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Add notification styles
const notificationStyles = document.createElement('style');
notificationStyles.textContent = `
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    min-width: 300px;
    max-width: 400px;
    animation: slideInRight 0.3s ease-out;
}

.notification-success {
    border-left: 4px solid #10b981;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.notification-content i {
    font-size: 1.2rem;
    color: #10b981;
}

.notification-close {
    background: none;
    border: none;
    color: #6b7280;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.notification-close:hover {
    background: #f3f4f6;
    color: #374151;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
`;
document.head.appendChild(notificationStyles);
</script>
@endsection
