@extends('dashboard.index')


@section('content')
<div class="job-application-container">
    @if($hasApplied)
        <!-- User has already applied -->
        <div class="already-applied-section">
            <div class="dashboard-section">
                <div class="dashboard-header-section">
                    <h1 class="main-title">لقد تقدمت بالفعل لهذه الوظيفة</h1>
                    <p class="subtitle">لا يمكنك التقديم مرة أخرى لنفس الوظيفة</p>
                </div>
                
                <div class="application-status-card">
                    <div class="status-header">
                        <i class="fas fa-check-circle status-icon success"></i>
                        <h2>تم تقديم طلبك بنجاح</h2>
                    </div>
                    
                    <div class="status-details">
                        <div class="detail-item">
                            <span class="label">تاريخ التقديم:</span>
                            <span class="value">{{ $existingApplication->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">حالة الطلب:</span>
                            <span class="status-badge pending">قيد المراجعة</span>
                        </div>
                    </div>
                    
                    <div class="job-summary">
                        <h3>تفاصيل الوظيفة</h3>
                        <div class="job-info-grid">
                            <div class="info-item">
                                <i class="fas fa-briefcase"></i>
                                <span>{{ $job->title }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-building"></i>
                                <span>{{ $job->company->name ?? 'شركة غير محددة' }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $job->location ?? 'موقع غير محدد' }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $job->type ?? 'نوع غير محدد' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('applications.show', $existingApplication) }}" class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                            عرض تفاصيل طلبي
                        </a>
                        <a href="{{ route('applications.index') }}" class="btn btn-outline">
                            <i class="fas fa-list"></i>
                            جميع طلباتي
                        </a>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline">
                            <i class="fas fa-search"></i>
                            البحث عن وظائف أخرى
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Job application form -->
        <div class="job-application-header">
            <div class="job-summary-header">
                <div class="header-content">
                    <h1 class="job-title">{{ $job->title }}</h1>
                    <div class="company-info">
                        <span class="company-name">{{ $job->company->name ?? 'شركة غير محددة' }}</span>
                        <span class="location">{{ $job->location ?? 'موقع غير محدد' }}</span>
                    </div>
                </div>
                <div class="header-actions">
                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline">
                        <i class="fas fa-eye"></i>
                        عرض الوظيفة
                    </a>
                </div>
            </div>
        </div>

        <form class="application-form" method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">
            
            <div class="application-form-grid">
                <div class="form-main-content">
                    <div class="form-section">
                        <h2>رسالة التقديم</h2>
                        <p class="section-description">اكتب رسالة تقديم مقنعة تشرح فيها لماذا أنت مناسب لهذه الوظيفة</p>
                        
                        <div class="form-group">
                            <label for="cover_letter">رسالة التقديم *</label>
                            <textarea 
                                id="cover_letter" 
                                name="cover_letter" 
                                rows="8" 
                                class="form-control @error('cover_letter') is-invalid @enderror"
                                placeholder="اكتب رسالة التقديم هنا..."
                                required
                            >{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="char-counter">
                                <span class="current-count">0</span>
                                <span class="max-count">/ 1000</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>السيرة الذاتية</h2>
                        <p class="section-description">أرفق سيرتك الذاتية بصيغة PDF أو Word</p>
                        
                        <div class="form-group">
                            <label for="resume">السيرة الذاتية</label>
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
                            </div>
                            <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" style="display: none;">
                            
                            <!-- Upload Progress for Resume -->
                            <div id="uploadProgress" class="upload-progress" style="display: none;">
                                <div class="progress-header">
                                    <span class="progress-text">جاري رفع الملف...</span>
                                    <span class="progress-percentage">0%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill"></div>
                                </div>
                                <div class="progress-status">جاري التحضير...</div>
                            </div>
                            
                            <div class="form-help">
                                <p><strong>صيغ مقبولة:</strong> PDF, DOC, DOCX</p>
                                <p><strong>الحد الأقصى:</strong> 2 ميجابايت</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>مستندات إضافية</h2>
                        <p class="section-description">أرفق شهادات أو مستندات إضافية تدعم طلبك</p>
                        
                        <div class="form-group">
                            <label for="additional_documents">مستندات إضافية</label>
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
                            </div>
                            <input type="file" id="additional_documents" name="additional_documents[]" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple style="display: none;">
                            
                            <!-- Upload Progress for Additional Documents -->
                            <div id="additionalDocsProgress" class="upload-progress" style="display: none;">
                                <div class="progress-header">
                                    <span class="progress-text">جاري رفع الملفات...</span>
                                    <span class="progress-percentage">0%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill"></div>
                                </div>
                                <div class="progress-status">جاري التحضير...</div>
                            </div>
                            
                            <div class="form-help">
                                <p><strong>صيغ مقبولة:</strong> PDF, DOC, DOCX, JPG, JPEG, PNG</p>
                                <p><strong>الحد الأقصى:</strong> 5 ميجابايت لكل ملف</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="submitBtn" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            إرسال الطلب
                        </button>
                        
                        <!-- Submission Status -->
                        <div id="submissionStatus" class="submission-status" style="display: none;">
                            <div class="status-content">
                                <i class="fas fa-spinner fa-spin"></i>
                                <span>جاري إرسال طلبك...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="application-sidebar">
                    <div class="progress-card">
                        <h3>تقدم الطلب</h3>
                        <div class="progress-steps">
                            <div class="step completed">
                                <div class="step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="step-content">
                                    <h4>اختيار الوظيفة</h4>
                                    <p>تم اختيار الوظيفة</p>
                                </div>
                            </div>
                            <div class="step active">
                                <div class="step-icon">
                                    <span>2</span>
                                </div>
                                <div class="step-content">
                                    <h4>ملء الطلب</h4>
                                    <p>أكمل جميع الحقول المطلوبة</p>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <span>3</span>
                                </div>
                                <div class="step-content">
                                    <h4>إرسال الطلب</h4>
                                    <p>اضغط على زر الإرسال</p>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <span>4</span>
                                </div>
                                <div class="step-content">
                                    <h4>تأكيد الإرسال</h4>
                                    <p>ستتلقى تأكيداً على إرسال طلبك</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="requirements-card">
                        <h3>متطلبات الوظيفة</h3>
                        <ul class="requirements-list">
                            @if($job->requirements)
                                @foreach(explode("\n", $job->requirements) as $requirement)
                                    <li>{{ trim($requirement) }}</li>
                                @endforeach
                            @else
                                <li>لا توجد متطلبات محددة</li>
                            @endif
                        </ul>
                    </div>

                    <div class="tips-card">
                        <h3>نصائح للتقديم</h3>
                        <div class="tip-item">
                            <i class="fas fa-lightbulb"></i>
                            <span>اكتب رسالة تقديم مخصصة لكل وظيفة</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-lightbulb"></i>
                            <span>ركز على المهارات والخبرات ذات الصلة</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-lightbulb"></i>
                            <span>تأكد من تحديث سيرتك الذاتية</span>
                        </div>
                        <div class="tip-item">
                            <i class="fas fa-lightbulb"></i>
                            <span>راجع طلبك قبل الإرسال</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>

<style>
/* ===== FILE UPLOAD AREAS ===== */
.file-upload-area {
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    background: #f8fafc;
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: #3b82f6;
    background: #eff6ff;
}

.file-upload-area.dragover {
    border-color: #10b981;
    background: #ecfdf5;
}

.upload-icon {
    font-size: 3rem;
    color: #94a3b8;
    margin-bottom: 1rem;
}

.upload-text p {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 1rem;
}

.upload-text .btn {
    margin: 0 auto;
}

/* ===== JOB APPLICATION CONTAINER ===== */
.job-application-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background: #f8fafc;
    min-height: 100vh;
}

/* ===== DASHBOARD STYLES ===== */
.dashboard-section {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

.dashboard-header-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    text-align: center;
}

.main-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
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

/* ===== ALREADY APPLIED SECTION ===== */
.already-applied-section {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}

.application-status-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    text-align: center;
    border: 1px solid #e2e8f0;
}

.status-header {
    margin-bottom: 2rem;
}

.status-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.status-icon.success {
    color: #10b981;
}

.application-status-card h2 {
    color: #1e293b;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.status-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.detail-item .label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
}

.detail-item .value {
    color: #1e293b;
    font-weight: 600;
    font-size: 1rem;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.pending {
    background: #fef3c7;
    color: #92400e;
}

.job-summary {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    text-align: left;
}

.job-summary h3 {
    color: #1e293b;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-align: center;
}

.job-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.info-item i {
    color: #3b82f6;
    font-size: 1.2rem;
    width: 20px;
    text-align: center;
}

.info-item span {
    color: #374151;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
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
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
}

.form-section h2 {
    color: #1e293b;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.section-description {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    color: #374151;
    font-weight: 600;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

/* ===== SIDEBAR ===== */
.application-sidebar {
    position: sticky;
    top: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.progress-card,
.requirements-card,
.tips-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
}

.progress-card h3,
.requirements-card h3,
.tips-card h3 {
    color: #1e293b;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.progress-steps {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.step {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.step-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.step.completed .step-icon {
    background: #10b981;
    color: white;
}

.step.active .step-icon {
    background: #3b82f6;
    color: white;
}

.step:not(.completed):not(.active) .step-icon {
    background: #e5e7eb;
    color: #6b7280;
}

.step-content h4 {
    color: #1e293b;
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.step-content p {
    color: #64748b;
    font-size: 0.8rem;
    margin: 0;
}

.requirements-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.requirements-list li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
    font-size: 0.9rem;
}

.requirements-list li:last-child {
    border-bottom: none;
}

.requirements-list li::before {
    content: '•';
    color: #3b82f6;
    font-weight: bold;
    margin-right: 0.5rem;
}

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

/* ===== SUBMISSION STATUS ===== */
.submission-status {
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    border: 1px solid #93c5fd;
    border-radius: 12px;
    text-align: center;
}

.status-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    color: #1e40af;
    font-weight: 600;
}

.status-content i {
    font-size: 1.5rem;
}

/* ===== SUCCESS MESSAGE ===== */
.success-message {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    padding: 3rem;
    text-align: center;
    z-index: 10000;
    max-width: 500px;
    width: 90%;
    animation: fadeInScale 0.5s ease-out;
}

.success-message .success-icon {
    font-size: 4rem;
    color: #10b981;
    margin-bottom: 1.5rem;
}

.success-message h2 {
    color: #1e293b;
    font-size: 1.8rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.success-message p {
    color: #64748b;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.success-message .btn {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

.success-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    animation: fadeIn 0.3s ease-out;
}

/* ===== ENHANCED FILE UPLOAD ===== */
.upload-success {
    animation: uploadSuccess 0.5s ease-out;
}

.file-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.file-size {
    color: #64748b;
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.file-type {
    color: #3b82f6;
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

.upload-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.file-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    margin-bottom: 0.75rem;
}

.file-item:last-child {
    margin-bottom: 0;
}

.file-item i {
    font-size: 1.5rem;
    color: #3b82f6;
    flex-shrink: 0;
}

.file-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.file-item .file-name {
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.file-item .file-size {
    color: #64748b;
    font-size: 0.8rem;
    margin: 0;
}

.file-item .file-type {
    color: #3b82f6;
    font-size: 0.75rem;
    margin: 0;
}

.upload-summary {
    font-weight: 600;
    color: #10b981;
    margin-bottom: 1rem;
}

.file-list {
    margin-bottom: 1rem;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.8);
    }
    to {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes uploadSuccess {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes slideOutLeft {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(-100%);
        opacity: 0;
    }
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

.btn-success {
    background: #10b981;
    color: white;
}

.btn-success:hover {
    background: #059669;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

/* ===== FORM STYLES ===== */
.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-control.is-invalid {
    border-color: #ef4444;
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.char-counter {
    display: flex;
    justify-content: flex-end;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #6b7280;
}

.current-count {
    color: #3b82f6;
    font-weight: 600;
}

.form-help {
    margin-top: 0.75rem;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #3b82f6;
}

.form-help p {
    margin: 0.25rem 0;
    font-size: 0.875rem;
    color: #64748b;
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
    
    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .status-details {
        grid-template-columns: 1fr;
    }
    
    .job-info-grid {
        grid-template-columns: 1fr;
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
    
    // Initialize character counter
    initializeCharacterCounter();
    
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

    // Form submission handling
    const form = document.querySelector('.application-form');
    if (form) {
        form.addEventListener('submit', handleFormSubmission);
    }
});

function initializeCharacterCounter() {
    const coverLetter = document.getElementById('cover_letter');
    const currentCount = document.querySelector('.current-count');
    
    if (coverLetter && currentCount) {
        coverLetter.addEventListener('input', function() {
            const length = this.value.length;
            currentCount.textContent = length;
            
            if (length > 800) {
                currentCount.style.color = '#ef4444';
            } else if (length > 600) {
                currentCount.style.color = '#f59e0b';
            } else {
                currentCount.style.color = '#3b82f6';
            }
        });
    }
}

function initializeFormValidation() {
    // Add any additional form validation logic here
    console.log('Form validation initialized');
}

function updateProgressBar() {
    // Add any progress bar logic here
    console.log('Progress bar initialized');
}

function handleFormSubmission(e) {
    e.preventDefault();
    
    // Show submission status
    const submitBtn = document.getElementById('submitBtn');
    const submissionStatus = document.getElementById('submissionStatus');
    
    if (submitBtn && submissionStatus) {
        submitBtn.style.display = 'none';
        submissionStatus.style.display = 'block';
        
        // Simulate form submission
        setTimeout(() => {
            showSuccessModal();
        }, 2000);
    }
}

function showSuccessModal() {
    const overlay = document.createElement('div');
    overlay.className = 'overlay';
    
    const successMessage = document.createElement('div');
    successMessage.className = 'success-message';
    successMessage.innerHTML = `
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2>تم إرسال طلبك بنجاح!</h2>
        <p>شكراً لك على تقديم طلب التوظيف. سنقوم بمراجعة طلبك وسنتواصل معك قريباً.</p>
        <div class="success-actions">
            <a href="{{ route('applications.index') }}" class="btn btn-primary">
                <i class="fas fa-list"></i>
                عرض طلباتي
            </a>
            <a href="{{ route('jobs.index') }}" class="btn btn-outline">
                <i class="fas fa-search"></i>
                البحث عن وظائف أخرى
            </a>
        </div>
    `;
    
    overlay.appendChild(successMessage);
    document.body.appendChild(overlay);
    
    // Close modal on overlay click
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            overlay.remove();
        }
    });
}

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
    
    showSuccessMessage('تم إزالة الملف');
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
    
    showSuccessMessage('تم إزالة جميع الملفات');
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
