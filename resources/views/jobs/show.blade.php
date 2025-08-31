@extends('dashboard.index')

@section('title', $job->title . ' | شركة توافق للتوظيف')

@section('content')
<div class="dashboard-content">
    <!-- Page Header -->
    <div class="dashboard-header">
        <div class="header-left">
            <div>
                <h1 class="page-title">{{ $job->title }}</h1>
                <p class="page-subtitle">{{ $job->company->company_name ?? $job->company->name }}</p>
                <div class="breadcrumb">
                    <a href="{{ route('jobs.index') }}" class="breadcrumb-link">
                        <i class="fas fa-arrow-right"></i>
                        الوظائف المتاحة
                    </a>
                    <span class="breadcrumb-separator">/</span>
                    <span class="breadcrumb-current">{{ $job->title }}</span>
                </div>
            </div>
        </div>
        
        <div class="header-actions">
            @auth
                @if(auth()->user()->role === 'employee' && !$hasApplied)
                    <a href="{{ route('applications.create', $job) }}" class="header-btn primary-btn">
                        <i class="fas fa-paper-plane"></i>
                        <span>تقدم الآن</span>
                    </a>
                @elseif(auth()->user()->role === 'employee' && $hasApplied)
                    <div class="application-status">
                        <span class="status-badge status-applied">
                            <i class="fas fa-check-circle"></i>
                            تم التقديم
                        </span>
                        <small class="application-date">
                            {{ $userApplication->created_at->format('Y/m/d') }}
                        </small>
                    </div>
                @endif
                
                @if(auth()->user()->id === $job->company_id)
                    <a href="{{ route('jobs.edit', $job) }}" class="header-btn secondary-btn">
                        <i class="fas fa-edit"></i>
                        <span>تعديل الوظيفة</span>
                    </a>
                @endif
            @endauth
            
            <a href="{{ route('jobs.index') }}" class="header-btn outline-btn">
                <i class="fas fa-arrow-right"></i>
                <span>العودة للوظائف</span>
            </a>
        </div>
    </div>

    <!-- Job Details Container -->
    <div class="job-details-container">
        <!-- Main Job Content -->
        <div class="job-main-content">
            <!-- Job Header Card -->
            <div class="stat-card job-header-card">
                <div class="job-header-content">
                    <div class="job-title-section">
                        <h2 class="job-title">{{ $job->title }}</h2>
                        <div class="job-meta">
                            <span class="job-company">
                                <i class="fas fa-building"></i>
                                {{ $job->company->company_name ?? $job->company->name }}
                            </span>
                            <span class="job-location">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $job->location ?? 'غير محدد' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="job-status-section">
                        <div class="job-status">
                            @if($job->isActive())
                                <span class="status-badge status-active">
                                    <i class="fas fa-play-circle"></i>
                                    نشطة
                                </span>
                            @elseif($job->isPaused())
                                <span class="status-badge status-paused">
                                    <i class="fas fa-pause-circle"></i>
                                    معلقة
                                </span>
                            @elseif($job->isClosed())
                                <span class="status-badge status-closed">
                                    <i class="fas fa-times-circle"></i>
                                    مغلقة
                                </span>
                            @elseif($job->isDraft())
                                <span class="status-badge status-draft">
                                    <i class="fas fa-edit"></i>
                                    مسودة
                                </span>
                            @endif
                        </div>
                        
                        @if($job->expires_at)
                            <div class="job-expiry">
                                <i class="fas fa-clock"></i>
                                تنتهي في: {{ $job->expires_at->format('Y/m/d') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Job Quick Info Grid -->
            <div class="stats-grid job-info-grid">
                <div class="stat-card info-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-trend">نوع الوظيفة</div>
                    </div>
                    <div class="stat-value">{{ $job->formatted_type }}</div>
                </div>
                
                <div class="stat-card info-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-trend">مستوى الخبرة</div>
                    </div>
                    <div class="stat-value">{{ $job->formatted_experience }}</div>
                </div>
                
                <div class="stat-card info-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-trend">الراتب</div>
                    </div>
                    <div class="stat-value">{{ $job->formatted_salary }}</div>
                </div>
                
                <div class="stat-card info-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-trend">تاريخ النشر</div>
                    </div>
                    <div class="stat-value">{{ $job->created_at->format('Y/m/d') }}</div>
                </div>
            </div>

            <!-- Job Description Section -->
            <div class="section-container">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-align-right"></i>
                        وصف الوظيفة
                    </h3>
                </div>
                <div class="content-card">
                    <div class="job-description">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Required Skills Section -->
            @if($job->skills && count($job->skills) > 0)
            <div class="section-container">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-tools"></i>
                        المهارات المطلوبة
                    </h3>
                </div>
                <div class="content-card">
                    <div class="skills-container">
                        @foreach($job->skills as $skill)
                            <span class="skill-tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Benefits Section -->
            @if($job->benefits && count($job->benefits) > 0)
            <div class="section-container">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-gift"></i>
                        المزايا والعوائد
                    </h3>
                </div>
                <div class="content-card">
                    <div class="benefits-list">
                        @foreach($job->benefits as $benefit)
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $benefit }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Company Information Section -->
            <div class="section-container">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-building"></i>
                        معلومات الشركة
                    </h3>
                </div>
                <div class="content-card company-info-card">
                    <div class="company-header">
                        @if($job->company->logo)
                            <img src="{{ asset('storage/' . $job->company->logo) }}" alt="Company Logo" class="company-logo">
                        @else
                            <div class="company-logo-placeholder">
                                <i class="fas fa-building"></i>
                            </div>
                        @endif
                        <div class="company-details">
                            <h4>{{ $job->company->company_name ?? $job->company->name }}</h4>
                            @if($job->company->company_description)
                                <p>{{ $job->company->company_description }}</p>
                            @endif
                        </div>
                    </div>
                    
                    @if($job->company->company_website || $job->company->company_phone || $job->company->address)
                    <div class="company-contact">
                        @if($job->company->company_website)
                            <div class="contact-item">
                                <i class="fas fa-globe"></i>
                                <a href="{{ $job->company->company_website }}" target="_blank" rel="noopener">
                                    {{ $job->company->company_website }}
                                </a>
                            </div>
                        @endif
                        
                        @if($job->company->company_phone)
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $job->company->company_phone }}</span>
                            </div>
                        @endif
                        
                        @if($job->company->address)
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $job->company->address }}</span>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Job Sidebar -->
        <div class="job-sidebar">
            <!-- Application Status -->
            @auth
                @if(auth()->user()->role === 'employee')
                    <div class="stat-card sidebar-card">
                        <div class="stat-header">
                            <div class="stat-icon">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <h4 class="card-title">حالة التقديم</h4>
                        </div>
                        
                        @if($hasApplied)
                            <div class="application-status-card">
                                <div class="status-success">
                                    <i class="fas fa-check-circle"></i>
                                    <span>تم التقديم بنجاح</span>
                                </div>
                                <div class="application-details">
                                    <p><strong>تاريخ التقديم:</strong> {{ $userApplication->created_at->format('Y/m/d H:i') }}</p>
                                    @if($userApplication->status)
                                        <p><strong>الحالة:</strong> 
                                            <span class="status-badge status-{{ $userApplication->status }}">
                                                {{ $userApplication->getStatusText() }}
                                            </span>
                                        </p>
                                    @endif
                                </div>
                                <a href="{{ route('applications.show', $userApplication) }}" class="header-btn outline-btn">
                                    <i class="fas fa-eye"></i>
                                    <span>عرض الطلب</span>
                                </a>
                            </div>
                        @else
                            <div class="application-prompt">
                                <p>لم تتقدم لهذه الوظيفة بعد</p>
                                <a href="{{ route('applications.create', $job) }}" class="header-btn primary-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    <span>تقدم الآن</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            @endauth

            <!-- Job Actions -->
            <div class="stat-card sidebar-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h4 class="card-title">مشاركة الوظيفة</h4>
                </div>
                <div class="share-buttons">
                    <button class="share-btn share-whatsapp" onclick="shareToWhatsApp()">
                        <i class="fab fa-whatsapp"></i>
                        واتساب
                    </button>
                    <button class="share-btn share-telegram" onclick="shareToTelegram()">
                        <i class="fab fa-telegram"></i>
                        تيليجرام
                    </button>
                    <button class="share-btn share-copy" onclick="copyJobLink()">
                        <i class="fas fa-link"></i>
                        نسخ الرابط
                    </button>
                </div>
            </div>

            <!-- Similar Jobs -->
            @if(isset($similarJobs) && count($similarJobs) > 0)
            <div class="stat-card sidebar-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h4 class="card-title">وظائف مشابهة</h4>
                </div>
                <div class="similar-jobs">
                    @foreach($similarJobs->take(3) as $similarJob)
                        <div class="similar-job-item">
                            <h5>
                                <a href="{{ route('jobs.show', $similarJob) }}">{{ $similarJob->title }}</a>
                            </h5>
                            <p class="similar-job-company">{{ $similarJob->company->company_name ?? $similarJob->company->name }}</p>
                            <p class="similar-job-location">{{ $similarJob->location }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Application Form Modal (for non-authenticated users) -->
@guest
<div class="auth-prompt-modal" id="authPromptModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>تسجيل الدخول مطلوب</h3>
            <button class="modal-close" onclick="closeAuthModal()">×</button>
        </div>
        <div class="modal-body">
            <p>يجب تسجيل الدخول للتقديم على الوظائف</p>
            <div class="modal-actions">
                <a href="{{ route('login') }}" class="header-btn primary-btn">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="header-btn secondary-btn">إنشاء حساب</a>
            </div>
        </div>
    </div>
</div>
@endguest

@endsection

@push('scripts')
<script>
function shareToWhatsApp() {
    const text = `وظيفة: ${@json($job->title)}\nشركة: ${@json($job->company->company_name ?? $job->company->name)}\nالرابط: ${window.location.href}`;
    const url = `https://wa.me/?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
}

function shareToTelegram() {
    const text = `وظيفة: ${@json($job->title)}\nشركة: ${@json($job->company->company_name ?? $job->company->name)}\nالرابط: ${window.location.href}`;
    const url = `https://t.me/share/url?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
}

function copyJobLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        // Show success message
        const btn = event.target.closest('.share-btn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> تم النسخ';
        btn.classList.add('copied');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('copied');
        }, 2000);
    });
}

function closeAuthModal() {
    document.getElementById('authPromptModal').style.display = 'none';
}

// Show auth modal for non-authenticated users when they try to apply
document.addEventListener('DOMContentLoaded', function() {
    @guest
    // Auto-show modal after a delay
    setTimeout(() => {
        document.getElementById('authPromptModal').style.display = 'flex';
    }, 3000);
    @endguest
});
</script>
@endpush

@push('styles')
<style>
/* Job Show Page Dashboard Integration Styles */
.job-details-container {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 2rem;
    margin-top: 2rem;
}

.job-main-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* Job Header Card */
.job-header-card {
    background: var(--gradient-primary);
    color: var(--pure-white);
    border-top: none;
    position: relative;
    overflow: hidden;
}

.job-header-card::before {
    background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.1) 100%);
}

.job-header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.job-title-section .job-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 1rem 0;
    line-height: 1.3;
    color: var(--pure-white);
}

.job-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.job-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    opacity: 0.9;
    color: var(--pure-white);
}

.job-status-section {
    text-align: center;
    min-width: 150px;
}

.job-status .status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.8rem;
    background: rgba(255, 255, 255, 0.2);
    color: var(--pure-white);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.job-expiry {
    font-size: 0.85rem;
    opacity: 0.8;
    color: var(--pure-white);
}

/* Job Info Grid */
.job-info-grid {
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
}

.info-card {
    text-align: center;
    border-top: 4px solid var(--primary-green);
}

.info-card .stat-value {
    font-size: 1.5rem;
    color: var(--primary-green);
}

/* Section Containers */
.section-container {
    margin-bottom: 2rem;
}

.content-card {
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--grey-100);
}

.job-description {
    line-height: 1.8;
    color: var(--grey-700);
    font-size: 1rem;
}

.skills-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
}

.skill-tag {
    background: var(--primary-lightest);
    color: var(--primary-green);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    border: 1px solid var(--primary-lighter);
    font-weight: 500;
}

.benefits-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--grey-700);
    padding: 0.5rem 0;
}

.benefit-item i {
    color: var(--success-green);
    font-size: 1.1rem;
    width: 20px;
}

/* Company Info Card */
.company-info-card {
    background: var(--primary-lightest);
    border: 1px solid var(--primary-lighter);
}

.company-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.company-logo {
    width: 80px;
    height: 80px;
    border-radius: var(--border-radius-sm);
    object-fit: cover;
    border: 3px solid var(--pure-white);
    box-shadow: var(--shadow-sm);
}

.company-logo-placeholder {
    width: 80px;
    height: 80px;
    background: var(--primary-lighter);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--primary-green);
    border: 3px solid var(--pure-white);
}

.company-details h4 {
    margin: 0 0 0.5rem 0;
    color: var(--primary-darker);
    font-size: 1.3rem;
    font-weight: 700;
}

.company-details p {
    margin: 0;
    color: var(--grey-600);
    line-height: 1.6;
}

.company-contact {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--primary-lighter);
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    color: var(--grey-600);
}

.contact-item i {
    color: var(--primary-green);
    width: 16px;
}

.contact-item a {
    color: var(--primary-green);
    text-decoration: none;
    font-weight: 500;
}

.contact-item a:hover {
    text-decoration: underline;
}

/* Sidebar Styles */
.job-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.sidebar-card {
    border-top: 4px solid var(--primary-green);
}

.card-title {
    color: var(--primary-darker);
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.application-status-card {
    text-align: center;
    margin-top: 1rem;
}

.status-success {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: var(--success-green);
    font-weight: 600;
    margin-bottom: 1rem;
}

.status-success i {
    font-size: 1.3rem;
}

.application-details {
    margin-bottom: 1.5rem;
    text-align: right;
}

.application-details p {
    margin: 0.5rem 0;
    color: var(--grey-600);
    font-size: 0.9rem;
}

.application-prompt {
    text-align: center;
    margin-top: 1rem;
}

.application-prompt p {
    margin-bottom: 1.5rem;
    color: var(--grey-600);
}

.share-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
    margin-top: 1rem;
}

.share-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    padding: 0.8rem;
    border: none;
    border-radius: var(--border-radius-sm);
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition-fast);
    color: var(--pure-white);
}

.share-whatsapp {
    background: #25d366;
}

.share-telegram {
    background: #0088cc;
}

.share-copy {
    background: var(--grey-500);
}

.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.share-btn.copied {
    background: var(--success-green);
}

.similar-jobs {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1rem;
}

.similar-job-item {
    padding: 1rem;
    background: var(--grey-50);
    border-radius: var(--border-radius-sm);
    border: 1px solid var(--grey-100);
    transition: var(--transition-fast);
}

.similar-job-item:hover {
    background: var(--primary-lightest);
    border-color: var(--primary-lighter);
}

.similar-job-item h5 {
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
}

.similar-job-item h5 a {
    color: var(--primary-green);
    text-decoration: none;
    font-weight: 600;
}

.similar-job-item h5 a:hover {
    text-decoration: underline;
}

.similar-job-company {
    margin: 0 0 0.3rem 0;
    font-size: 0.9rem;
    color: var(--grey-600);
    font-weight: 500;
}

.similar-job-location {
    margin: 0;
    font-size: 0.85rem;
    color: var(--grey-500);
}

/* Application Status Badge */
.application-status {
    text-align: center;
}

.status-applied {
    background: rgba(16, 185, 129, 0.2);
    color: var(--success-green);
    border: 1px solid rgba(16, 185, 129, 0.3);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 0.5rem;
}

.application-date {
    display: block;
    color: var(--grey-500);
    font-size: 0.85rem;
}

/* Modal Styles */
.auth-prompt-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 10000;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    max-width: 450px;
    width: 90%;
    box-shadow: var(--shadow-xl);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--grey-100);
}

.modal-header h3 {
    margin: 0;
    color: var(--primary-darker);
    font-size: 1.3rem;
    font-weight: 700;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--grey-500);
    cursor: pointer;
    padding: 0;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: var(--transition-fast);
}

.modal-close:hover {
    background: var(--grey-100);
    color: var(--grey-700);
}

.modal-body {
    padding: 2rem;
    text-align: center;
}

.modal-body p {
    margin: 0 0 2rem 0;
    color: var(--grey-600);
    line-height: 1.6;
    font-size: 1rem;
}

.modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .job-details-container {
        grid-template-columns: 1fr;
    }
    
    .job-sidebar {
        order: -1;
    }
}

@media (max-width: 768px) {
    .job-header-content {
        flex-direction: column;
        gap: 1rem;
    }
    
    .job-title {
        font-size: 1.8rem;
    }
    
    .job-status-section {
        text-align: center;
        min-width: auto;
    }
    
    .job-meta {
        flex-direction: column;
        gap: 0.8rem;
    }
    
    .company-header {
        flex-direction: column;
        text-align: center;
    }
    
    .modal-actions {
        flex-direction: column;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 0.5rem;
    }
}

/* RTL Specific Adjustments */
[dir="rtl"] .job-header-content {
    flex-direction: row-reverse;
}

[dir="rtl"] .company-header {
    flex-direction: row-reverse;
}

@media (max-width: 768px) {
    [dir="rtl"] .job-header-content {
        flex-direction: column;
    }
    
    [dir="rtl"] .company-header {
        flex-direction: column;
    }
}
</style>
@endpush
