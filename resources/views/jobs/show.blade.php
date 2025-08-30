@extends('dashboard.index')

@section('title', $job->title)

@section('content')
<div class="job-details-container">
    <!-- Welcome Alert -->
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>مرحباً بك في صفحة تفاصيل الوظيفة!</strong> يمكنك مراجعة جميع المعلومات والتفاصيل المتعلقة بهذه الوظيفة.
        </div>
    </div>

    <!-- Job Header -->
    <div class="job-header">
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
            @if(auth()->check() && auth()->id() === $job->company_id)
                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                    تعديل الوظيفة
                </a>
                <button class="btn btn-danger" onclick="deleteJob()">
                    <i class="fas fa-trash"></i>
                    حذف الوظيفة
                </button>
            @else
                <a href="{{ route('applications.create', $job) }}" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i>
                    تقدم للوظيفة
                </a>
            @endif
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i><span>+1</span></div>
            </div>
            <div class="stat-value">1</div>
            <div class="stat-label">وظيفة متاحة</div>
            <div class="stat-description">وظيفة نشطة ومتاحة للتقديم</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i><span>+{{ $job->applications->count() }}</span></div>
            </div>
            <div class="stat-value">{{ $job->applications->count() }}</div>
            <div class="stat-label">مقدم</div>
            <div class="stat-description">عدد المتقدمين للوظيفة</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon"><i class="fas fa-eye"></i></div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i><span>+{{ $job->views ?? 0 }}</span></div>
            </div>
            <div class="stat-value">{{ $job->views ?? 0 }}</div>
            <div class="stat-label">مشاهدات</div>
            <div class="stat-description">عدد مرات مشاهدة الوظيفة</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon"><i class="fas fa-calendar"></i></div>
                <div class="stat-trend"><i class="fas fa-clock"></i><span>{{ $job->expires_at ? $job->expires_at->diffForHumans() : 'غير محدد' }}</span></div>
            </div>
            <div class="stat-value">{{ $job->expires_at ? $job->expires_at->format('d/m') : '∞' }}</div>
            <div class="stat-label">تاريخ الانتهاء</div>
            <div class="stat-description">آخر موعد للتقديم</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-opportunities">
        @if(auth()->check() && auth()->id() === $job->company_id)
            <div class="opportunity-card primary" onclick="editJob()">
                <div class="opportunity-icon"><i class="fas fa-edit"></i></div>
                <div class="opportunity-content">
                    <h4>تعديل الوظيفة</h4>
                    <p>قم بتعديل تفاصيل ومتطلبات الوظيفة</p>
                </div>
            </div>
            
            <div class="opportunity-card secondary" onclick="viewApplications()">
                <div class="opportunity-icon"><i class="fas fa-users"></i></div>
                <div class="opportunity-content">
                    <h4>عرض التقديمات</h4>
                    <p>راجع جميع التقديمات المقدمة للوظيفة</p>
                </div>
            </div>
            
            <div class="opportunity-card tertiary" onclick="manageJob()">
                <div class="opportunity-icon"><i class="fas fa-cog"></i></div>
                <div class="opportunity-content">
                    <h4>إدارة الوظيفة</h4>
                    <p>أوقف أو أعد تفعيل الوظيفة</p>
                </div>
            </div>
            
            <div class="opportunity-card quaternary" onclick="shareJob()">
                <div class="opportunity-icon"><i class="fas fa-share-alt"></i></div>
                <div class="opportunity-content">
                    <h4>مشاركة الوظيفة</h4>
                    <p>شارك الوظيفة على وسائل التواصل</p>
                </div>
            </div>
        @else
            <div class="opportunity-card primary" onclick="applyForJob()">
                <div class="opportunity-icon"><i class="fas fa-paper-plane"></i></div>
                <div class="opportunity-content">
                    <h4>تقدم للوظيفة</h4>
                    <p>أرسل طلب التقديم لهذه الوظيفة</p>
                </div>
            </div>
            
            <div class="opportunity-card secondary" onclick="saveJob()">
                <div class="opportunity-icon"><i class="fas fa-bookmark"></i></div>
                <div class="opportunity-content">
                    <h4>حفظ الوظيفة</h4>
                    <p>احفظ الوظيفة للمراجعة لاحقاً</p>
                </div>
            </div>
            
            <div class="opportunity-card tertiary" onclick="contactCompany()">
                <div class="opportunity-icon"><i class="fas fa-envelope"></i></div>
                <div class="opportunity-content">
                    <h4>تواصل مع الشركة</h4>
                    <p>أرسل رسالة مباشرة للشركة</p>
                </div>
            </div>
            
            <div class="opportunity-card quaternary" onclick="shareJob()">
                <div class="opportunity-icon"><i class="fas fa-share-alt"></i></div>
                <div class="opportunity-content">
                    <h4>مشاركة الوظيفة</h4>
                    <p>شارك الوظيفة مع أصدقائك</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Job Content Grid -->
    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Job Description Section -->
            <div class="content-section">
                <div class="section-header">
                    <h3><i class="fas fa-file-alt"></i> وصف الوظيفة</h3>
                    <div class="section-actions">
                        <button class="btn btn-outline btn-sm" onclick="copyDescription()">
                            <i class="fas fa-copy"></i>
                            نسخ
                        </button>
                    </div>
                </div>
                <div class="section-content">
                    {!! nl2br(e($job->description)) !!}
                </div>
            </div>

            <!-- Skills Section -->
            @if($job->skills && count($job->skills) > 0)
            <div class="content-section">
                <div class="section-header">
                    <h3><i class="fas fa-tools"></i> المهارات المطلوبة</h3>
                    <div class="section-actions">
                        <span class="skills-count">{{ count($job->skills) }} مهارة</span>
                    </div>
                </div>
                <div class="section-content">
                    <div class="skills-tags">
                        @foreach($job->skills as $skill)
                            <span class="skill-tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Benefits Section -->
            @if($job->benefits && count($job->benefits) > 0)
            <div class="content-section">
                <div class="section-header">
                    <h3><i class="fas fa-gift"></i> المزايا والعوائد</h3>
                    <div class="section-actions">
                        <span class="benefits-count">{{ count($job->benefits) }} ميزة</span>
                    </div>
                </div>
                <div class="section-content">
                    <div class="benefits-list">
                        @foreach($job->benefits as $benefit)
                            <div class="benefit-item">
                                <i class="fas fa-check-circle"></i>
                                {{ $benefit }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Job Status Banner -->
            <div class="status-banner status-{{ $job->status }}">
                <div class="banner-icon">
                    @switch($job->status)
                        @case('active')
                            <i class="fas fa-check-circle"></i>
                            @break
                        @case('paused')
                            <i class="fas fa-pause-circle"></i>
                            @break
                        @case('closed')
                            <i class="fas fa-times-circle"></i>
                            @break
                        @case('draft')
                            <i class="fas fa-edit"></i>
                            @break
                        @default
                            <i class="fas fa-info-circle"></i>
                    @endswitch
                </div>
                <div class="banner-content">
                    <div class="banner-title">
                        {{ $job->getAvailableStatuses()[$job->status] ?? $job->status }}
                    </div>
                    <div class="banner-subtitle">
                        @switch($job->status)
                            @case('active')
                                الوظيفة متاحة للتقديم
                                @break
                            @case('paused')
                                الوظيفة متوقفة مؤقتاً
                                @break
                            @case('closed')
                                الوظيفة مغلقة
                                @break
                            @case('draft')
                                مسودة قيد التطوير
                                @break
                            @default
                                حالة غير محددة
                        @endswitch
                    </div>
                </div>
            </div>

            <!-- Job Details Card -->
            <div class="info-card">
                <div class="card-header">
                    <h4><i class="fas fa-info-circle"></i> تفاصيل الوظيفة</h4>
                    <button class="btn btn-outline btn-sm" onclick="toggleDetails()">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="card-content" id="detailsContent">
                    <div class="info-list">
                        <div class="info-item">
                            <span class="label">نوع الوظيفة:</span>
                            <span class="value">{{ $job->getAvailableTypes()[$job->type] ?? $job->type }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">مستوى الخبرة:</span>
                            <span class="value">{{ $job->getAvailableExperienceLevels()[$job->experience_level] ?? $job->experience_level }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">الموقع:</span>
                            <span class="value">{{ $job->location }}</span>
                        </div>
                        @if($job->salary_min || $job->salary_max)
                        <div class="info-item">
                            <span class="label">الراتب:</span>
                            <span class="value">
                                @if($job->salary_min && $job->salary_max)
                                    {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} {{ $job->salary_currency }}
                                @elseif($job->salary_min)
                                    {{ number_format($job->salary_min) }} {{ $job->salary_currency }} فأكثر
                                @elseif($job->salary_max)
                                    حتى {{ number_format($job->salary_max) }} {{ $job->salary_currency }}
                                @endif
                            </span>
                        </div>
                        @endif
                        @if($job->expires_at)
                        <div class="info-item">
                            <span class="label">تاريخ انتهاء الصلاحية:</span>
                            <span class="value">{{ $job->expires_at->format('Y/m/d') }}</span>
                        </div>
                        @endif
                        <div class="info-item">
                            <span class="label">تاريخ النشر:</span>
                            <span class="value">{{ $job->created_at->format('Y/m/d') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Info Card -->
            <div class="info-card">
                <div class="card-header">
                    <h4><i class="fas fa-building"></i> معلومات الشركة</h4>
                    <button class="btn btn-outline btn-sm" onclick="viewCompany()">
                        <i class="fas fa-external-link-alt"></i>
                    </button>
                </div>
                <div class="card-content">
                    <div class="company-info">
                        <div class="company-avatar">
                            @if($job->company->logo)
                                <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="company-logo">
                            @else
                                <div class="company-initials">{{ substr($job->company->name ?? 'ش', 0, 1) }}</div>
                            @endif
                        </div>
                        <div class="company-details">
                            <div class="company-name">{{ $job->company->name ?? 'شركة غير محددة' }}</div>
                            @if($job->company->email)
                            <div class="company-email">
                                <i class="fas fa-envelope"></i>
                                {{ $job->company->email }}
                            </div>
                            @endif
                            @if($job->company->phone)
                            <div class="company-phone">
                                <i class="fas fa-phone"></i>
                                {{ $job->company->phone }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications Count (for company users) -->
            @if(auth()->check() && auth()->id() === $job->company_id)
            <div class="info-card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> التقديمات</h4>
                    <div class="applications-badge">{{ $job->applications->count() }}</div>
                </div>
                <div class="card-content">
                    <div class="applications-info">
                        <div class="applications-count">
                            <span class="count">{{ $job->applications->count() }}</span>
                            <span class="label">مقدم</span>
                        </div>
                        @if($job->applications->count() > 0)
                            <a href="{{ route('jobs.applications.index', $job) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i>
                                عرض التقديمات
                            </a>
                        @else
                            <div class="no-applications">
                                <i class="fas fa-inbox"></i>
                                <p>لا توجد تقديمات بعد</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>تأكيد الحذف</h3>
            <button class="modal-close" onclick="closeModal('deleteModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>هل أنت متأكد من حذف هذه الوظيفة؟ لا يمكن التراجع عن هذا الإجراء.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('deleteModal')">إلغاء</button>
            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">حذف الوظيفة</button>
            </form>
        </div>
    </div>
</div>

<style>
/* ===== JOB DETAILS LAYOUT ===== */
.job-details-container {
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

/* ===== JOB HEADER ===== */
.job-header {
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

/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #10b981;
    font-weight: 500;
}

.stat-value {
    font-size: 3rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stat-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.5rem;
}

.stat-description {
    font-size: 0.9rem;
    color: #64748b;
    line-height: 1.5;
}

/* ===== QUICK OPPORTUNITIES ===== */
.quick-opportunities {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.opportunity-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.opportunity-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.opportunity-card.primary {
    border-left: 4px solid #3b82f6;
}

.opportunity-card.secondary {
    border-left: 4px solid #8b5cf6;
}

.opportunity-card.tertiary {
    border-left: 4px solid #10b981;
}

.opportunity-card.quaternary {
    border-left: 4px solid #f59e0b;
}

.opportunity-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

.opportunity-content h4 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.opportunity-content p {
    color: #64748b;
    line-height: 1.5;
    margin: 0;
}

/* ===== CONTENT GRID ===== */
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
    align-items: start;
    margin: 0;
    padding: 0;
    width: 100%;
}

.main-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    min-width: 0; /* Prevents overflow */
    margin: 0;
    padding: 0;
    width: 100%;
}

.content-section {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 0;
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

.skills-count,
.benefits-count {
    background: #f1f5f9;
    color: #64748b;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.section-content {
    line-height: 1.6;
    color: #475569;
}

/* ===== SKILLS & BENEFITS ===== */
.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.skill-tag {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.skill-tag:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
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
    color: #475569;
    font-size: 1rem;
}

.benefit-item i {
    color: #10b981;
    font-size: 1.2rem;
}

/* ===== SIDEBAR ===== */
.sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    position: sticky;
    top: 2rem;
    height: fit-content;
    min-width: 0; /* Prevents overflow */
    margin: 0;
    padding: 0;
    width: 100%;
}

/* ===== STATUS BANNER ===== */
.status-banner {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 16px;
    color: white;
    font-weight: 500;
    width: 100%;
    box-sizing: border-box;
}

.status-banner.status-active {
    background: linear-gradient(135deg, #10b981, #059669);
}

.status-banner.status-paused {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.status-banner.status-closed {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.status-banner.status-draft {
    background: linear-gradient(135deg, #6b7280, #4b5563);
}

.banner-icon {
    font-size: 2rem;
}

.banner-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.banner-subtitle {
    font-size: 0.9rem;
    opacity: 0.9;
}

.info-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
    overflow: hidden;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 0;
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

.applications-badge {
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

.info-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item .label {
    color: #64748b;
    font-weight: 500;
}

.info-item .value {
    color: #1e293b;
    font-weight: 600;
    text-align: left;
}

.company-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.company-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.company-logo {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.company-initials {
    color: white;
    font-weight: 600;
}

.company-details {
    flex: 1;
}

.company-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.company-email,
.company-phone {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.applications-info {
    text-align: center;
}

.applications-count {
    margin-bottom: 1.5rem;
}

.applications-count .count {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: #3b82f6;
    line-height: 1;
}

.applications-count .label {
    color: #64748b;
    font-size: 1rem;
    font-weight: 500;
}

.no-applications {
    text-align: center;
    color: #94a3b8;
}

.no-applications i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.no-applications p {
    margin: 0;
    font-size: 0.9rem;
}

/* Buttons */
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

.btn-danger {
    background: #ef4444;
    color: white;
}

.btn-danger:hover {
    background: #dc2626;
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

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 16px;
    padding: 2rem;
    min-width: 400px;
    max-width: 500px;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.modal-header h3 {
    margin: 0;
    color: #1e293b;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #94a3b8;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: #f1f5f9;
    color: #64748b;
}

.modal-body {
    margin-bottom: 2rem;
}

.modal-body p {
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

.modal-footer {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.btn-secondary {
    background: #64748b;
    color: white;
}

.btn-secondary:hover {
    background: #475569;
}

/* Animations */
.animate-slide-in {
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .sidebar {
        order: -1;
        position: static;
        top: auto;
        margin: 0;
    }
    
    .main-content {
        order: 1;
        margin: 0;
    }
}

@media (max-width: 768px) {
    .job-details-container {
        padding: 1rem;
    }
    
    .job-header {
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
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .quick-opportunities {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .section-header {
        flex-direction: column;
        gap: 0.75rem;
        align-items: stretch;
    }
    
    .content-section {
        padding: 1rem;
        margin-bottom: 0;
    }
    
    .info-card {
        margin: 0;
        margin-bottom: 0;
    }
    
    .content-grid {
        gap: 0.5rem;
        margin-left: 0;
        padding-left: 0;
    }
}
</style>

<script>
// Utility functions
function editJob() {
    window.location.href = "{{ route('jobs.edit', $job) }}";
}

function viewApplications() {
    window.location.href = "{{ route('jobs.applications.index', $job) }}";
}

function manageJob() {
    // Implementation for job management
    showSuccessMessage('سيتم إضافة إدارة الوظيفة قريباً');
}

function shareJob() {
    // Implementation for sharing job
    if (navigator.share) {
        navigator.share({
            title: '{{ $job->title }}',
            text: '{{ $job->company->name ?? "شركة" }} تبحث عن {{ $job->title }}',
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        navigator.clipboard.writeText(window.location.href).then(() => {
            showSuccessMessage('تم نسخ رابط الوظيفة');
        });
    }
}

function applyForJob() {
    window.location.href = "{{ route('applications.create', $job) }}";
}

function saveJob() {
    // Implementation for saving job
    showSuccessMessage('تم حفظ الوظيفة بنجاح');
}

function contactCompany() {
    // Implementation for contacting company
    showSuccessMessage('سيتم إضافة التواصل مع الشركة قريباً');
}

function copyDescription() {
    const description = `{{ $job->description }}`;
    navigator.clipboard.writeText(description).then(() => {
        showSuccessMessage('تم نسخ وصف الوظيفة');
    });
}

function viewCompany() {
    // Implementation for viewing company profile
    showSuccessMessage('سيتم إضافة عرض ملف الشركة قريباً');
}

function toggleDetails() {
    const content = document.getElementById('detailsContent');
    const button = event.target;
    const icon = button.querySelector('i');
    
    if (content.style.display === 'none') {
        content.style.display = 'block';
        icon.className = 'fas fa-chevron-up';
    } else {
        content.style.display = 'none';
        icon.className = 'fas fa-chevron-down';
    }
}

function deleteJob() {
    showModal('deleteModal');
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function showModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function showSuccessMessage(message) {
    showNotification(message, 'success');
}

function showErrorMessage(message) {
    showNotification(message, 'error');
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
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

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
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

.notification-error {
    border-left: 4px solid #ef4444;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.notification-content i {
    font-size: 1.2rem;
}

.notification-success .notification-content i {
    color: #10b981;
}

.notification-error .notification-content i {
    color: #ef4444;
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
