@extends('dashboard.index')

@section('title', 'تفاصيل الطلب')

@section('content')
<div class="application-details-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-main">
                <h1 class="page-title">
                    <i class="fas fa-file-alt"></i>
                    تفاصيل الطلب
                </h1>
                <p class="page-subtitle">مراجعة وإدارة معلومات الطلب</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('applications.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    العودة للطلبات
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-content">
                <p>{{ session('success') }}</p>
            </div>
            <button class="alert-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="application-details-grid">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Job Information Card -->
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
                            <div class="item-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="item-content">
                                <label class="info-label">عنوان الوظيفة</label>
                                <p class="info-value">{{ $application->job->title }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="item-content">
                                <label class="info-label">الشركة</label>
                                <p class="info-value">{{ $application->job->company->name ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="item-content">
                                <label class="info-label">الموقع</label>
                                <p class="info-value">{{ $application->job->location ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="item-content">
                                <label class="info-label">نوع الوظيفة</label>
                                <p class="info-value">{{ $application->job->type ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>
                    @if($application->job->description)
                        <div class="description-section">
                            <div class="section-header">
                                <i class="fas fa-align-left"></i>
                                <label class="info-label">وصف الوظيفة</label>
                            </div>
                            <div class="description-content">
                                <p>{{ Str::limit($application->job->description, 300) }}</p>
                                <div class="description-more">
                                    <a href="{{ route('jobs.show', $application->job) }}" class="btn btn-link">
                                        <i class="fas fa-external-link-alt"></i>
                                        عرض الوظيفة كاملة
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Cover Letter Card -->
            <div class="info-card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-envelope"></i>
                        خطاب التقديم
                    </h2>
                </div>
                <div class="card-content">
                    <div class="cover-letter-content">
                        <div class="content-header">
                            <i class="fas fa-quote-left"></i>
                            <span class="content-label">رسالة المتقدم</span>
                        </div>
                        <div class="letter-text">
                            <p>{{ $application->cover_letter }}</p>
                        </div>
                        <div class="content-footer">
                            <div class="text-stats">
                                <span class="stat-item">
                                    <i class="fas fa-font"></i>
                                    {{ strlen($application->cover_letter) }} حرف
                                </span>
                                <span class="stat-item">
                                    <i class="fas fa-paragraph"></i>
                                    {{ count(explode("\n", $application->cover_letter)) }} فقرة
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resume Card -->
            @if($application->resume_path)
                <div class="info-card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-file-pdf"></i>
                            السيرة الذاتية
                        </h2>
                    </div>
                    <div class="card-content">
                        <div class="resume-section">
                            <div class="resume-info">
                                <div class="resume-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="resume-details">
                                    <h3 class="resume-name">ملف السيرة الذاتية</h3>
                                    <p class="resume-type">مستند PDF</p>
                                    <p class="resume-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        تم الرفع في {{ $application->created_at->format('Y/m/d') }}
                                    </p>
                                </div>
                            </div>
                            <div class="resume-actions">
                                <a href="{{ Storage::url($application->resume_path) }}" 
                                   target="_blank"
                                   class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                    عرض
                                </a>
                                <a href="{{ Storage::url($application->resume_path) }}" 
                                   download
                                   class="btn btn-outline">
                                    <i class="fas fa-download"></i>
                                    تحميل
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Application Status Card -->
            <div class="info-card status-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        حالة الطلب
                    </h3>
                </div>
                <div class="card-content">
                    <div class="status-section">
                        @php
                            $statusColors = [
                                'pending' => 'status-pending',
                                'shortlisted' => 'status-shortlisted',
                                'interviewed' => 'status-interviewed',
                                'accepted' => 'status-accepted',
                                'rejected' => 'status-rejected'
                            ];
                            $statusClass = $statusColors[$application->status ?? 'pending'] ?? 'status-pending';
                            $statusText = [
                                'pending' => 'قيد المراجعة',
                                'shortlisted' => 'في القائمة المختصرة',
                                'interviewed' => 'تمت المقابلة',
                                'accepted' => 'مقبول',
                                'rejected' => 'مرفوض'
                            ];
                            $statusLabel = $statusText[$application->status ?? 'pending'] ?? 'قيد المراجعة';
                        @endphp
                        <div class="current-status">
                            <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                        </div>
                        
                        @if(auth()->user()->role === 'company')
                            <form action="{{ route('applications.status.update', $application) }}" method="POST" class="status-form">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="status" class="form-label">تحديث الحالة</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>قيد المراجعة</option>
                                        <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>في القائمة المختصرة</option>
                                        <option value="interviewed" {{ $application->status === 'interviewed' ? 'selected' : '' }}>تمت المقابلة</option>
                                        <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>مقبول</option>
                                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-full">
                                    <i class="fas fa-save"></i>
                                    تحديث الحالة
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Application Details Card -->
            <div class="info-card details-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clipboard-list"></i>
                        تفاصيل الطلب
                    </h3>
                </div>
                <div class="card-content">
                    <div class="details-list">
                        <div class="detail-item">
                            <div class="item-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="item-content">
                                <label class="detail-label">تاريخ التقديم</label>
                                <p class="detail-value">
                                    @if($application->applied_at)
                                        {{ $application->applied_at->format('Y/m/d') }}
                                    @else
                                        <span class="text-muted">غير محدد</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="item-icon">
                                <i class="fas fa-hashtag"></i>
                            </div>
                            <div class="item-content">
                                <label class="detail-label">رقم الطلب</label>
                                <p class="detail-value">#{{ $application->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applicant Information Card (for companies) -->
            @if(auth()->user()->role === 'company')
                <div class="info-card applicant-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user"></i>
                            معلومات المتقدم
                        </h3>
                    </div>
                    <div class="card-content">
                        <div class="applicant-section">
                            <div class="applicant-profile">
                                <div class="applicant-avatar">
                                    <span>{{ strtoupper(substr($application->applicant->name, 0, 1)) }}</span>
                                </div>
                                <div class="applicant-details">
                                    <h4 class="applicant-name">{{ $application->applicant->name }}</h4>
                                    <p class="applicant-email">{{ $application->applicant->email }}</p>
                                </div>
                            </div>
                            
                            <div class="applicant-info">
                                @if($application->applicant->phone)
                                    <div class="info-item">
                                        <div class="item-icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="item-content">
                                            <label class="info-label">رقم الهاتف</label>
                                            <p class="info-value">{{ $application->applicant->phone }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($application->applicant->skills)
                                    <div class="info-item">
                                        <div class="item-icon">
                                            <i class="fas fa-tools"></i>
                                        </div>
                                        <div class="item-content">
                                            <label class="info-label">المهارات</label>
                                            <div class="skills-tags">
                                                @foreach(explode(',', $application->applicant->skills) as $skill)
                                                    <span class="skill-tag">{{ trim($skill) }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Simple Enhanced Styles */
.page-header {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-light) 100%);
    border-radius: var(--border-radius-lg);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
}

.page-title {
    color: white;
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
}

.alert {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border-radius: var(--border-radius-md);
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: var(--shadow-sm);
}

.alert-close {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.alert-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

.application-details-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.info-card {
    background: white;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    border: 1px solid var(--grey-200);
    margin-bottom: 1.5rem;
}

.card-header {
    background: var(--grey-50);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--grey-200);
}

.card-title {
    color: var(--grey-800);
    font-size: 1.25rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-content {
    padding: 2rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: var(--grey-50);
    border-radius: var(--border-radius-md);
    border: 1px solid var(--grey-200);
}

.item-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-green);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.item-content {
    flex: 1;
}

.info-label, .detail-label {
    display: block;
    font-size: 0.875rem;
    color: var(--grey-600);
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.info-value, .detail-value {
    font-size: 1.1rem;
    color: var(--grey-800);
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.description-section {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--grey-200);
}

.section-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: var(--grey-600);
    font-size: 1rem;
}

.description-content {
    background: var(--grey-50);
    padding: 1.5rem;
    border-radius: var(--border-radius-md);
    border: 1px solid var(--grey-200);
}

.description-more {
    margin-top: 1rem;
    text-align: center;
}

.btn-link {
    color: var(--primary-green);
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
}

.btn-link:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.cover-letter-content {
    background: var(--grey-50);
    padding: 1.5rem;
    border-radius: var(--border-radius-md);
    border: 1px solid var(--grey-200);
}

.content-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: var(--grey-600);
    font-size: 1rem;
}

.letter-text {
    line-height: 1.8;
    color: var(--grey-800);
    margin-bottom: 1.5rem;
}

.content-footer {
    border-top: 1px solid var(--grey-200);
    padding-top: 1rem;
}

.text-stats {
    display: flex;
    gap: 2rem;
    justify-content: center;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--grey-600);
    font-size: 0.875rem;
}

.resume-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.resume-info {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.resume-icon {
    width: 60px;
    height: 60px;
    background: var(--error-red);
    color: white;
    border-radius: var(--border-radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.resume-details h3 {
    margin-bottom: 0.5rem;
    color: var(--grey-800);
}

.resume-type {
    color: var(--grey-600);
    margin-bottom: 0.5rem;
}

.resume-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--grey-500);
    font-size: 0.875rem;
}

.resume-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.status-card {
    border-left: 4px solid var(--primary-green);
}

.current-status {
    text-align: center;
    margin-bottom: 2rem;
}

.status-badge {
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    font-size: 1rem;
    font-weight: 600;
}

.status-form {
    margin-top: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.75rem;
    font-weight: 600;
    color: var(--grey-700);
}

.form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--grey-300);
    border-radius: var(--border-radius-md);
    background: white;
    font-size: 1rem;
    transition: all 0.2s ease;
}

.form-select:focus {
    outline: none;
    border-color: var(--primary-green);
    box-shadow: 0 0 0 3px rgba(0, 60, 109, 0.1);
}

.btn-full {
    width: 100%;
    justify-content: center;
}

.details-card {
    border-left: 4px solid var(--info-blue);
}

.details-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.applicant-card {
    border-left: 4px solid var(--warning-orange);
}

.applicant-profile {
    text-align: center;
    margin-bottom: 2rem;
}

.applicant-avatar {
    width: 80px;
    height: 80px;
    background: var(--primary-green);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    margin: 0 auto 1rem;
}

.applicant-name {
    font-size: 1.25rem;
    color: var(--grey-800);
    margin-bottom: 0.5rem;
}

.applicant-email {
    color: var(--grey-600);
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.skill-tag {
    background: var(--primary-lightest);
    color: var(--primary-green);
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.875rem;
    font-weight: 600;
    border: 1px solid var(--primary-light);
}

/* Status Colors */
.status-pending { background: #fef3c7; color: #92400e; }
.status-shortlisted { background: #dbeafe; color: #1e40af; }
.status-interviewed { background: #e0e7ff; color: #3730a3; }
.status-accepted { background: #d1fae5; color: #065f46; }
.status-rejected { background: #fee2e2; color: #991b1b; }

/* Responsive Design */
@media (max-width: 1024px) {
    .application-details-grid {
        grid-template-columns: 1fr;
    }
    
    .resume-section {
        flex-direction: column;
        text-align: center;
    }
    
    .resume-actions {
        flex-direction: row;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
    }
    
    .card-content {
        padding: 1.5rem;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .text-stats {
        flex-direction: column;
        gap: 1rem;
    }
}
</style>
@endsection
