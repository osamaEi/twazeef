@extends('dashboard.index')

@section('title', 'تفاصيل الطلب')

@section('content')
<div class="admin-dashboard">
    <!-- Header Section -->
    <div class="dashboard-header-section">
        <div class="header-content">
            <h1 class="main-title">
                <i class="fas fa-file-alt"></i>
                تفاصيل الطلب
            </h1>
            <p class="subtitle">مراجعة وإدارة معلومات الطلب</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('applications.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-right"></i>
                العودة للطلبات
            </a>
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

    <div class="dashboard-sections">
        <!-- Main Content -->
        <div class="dashboard-section main-content-section">
            <!-- Job Information Card -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-briefcase"></i>
                        معلومات الوظيفة
                    </h2>
                </div>
                <div class="section-content">
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
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="item-content">
                                <label class="info-label">مستوى الخبرة</label>
                                <p class="info-value">{{ $application->job->experience_level ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                        @if($application->job->salary_min || $application->job->salary_max)
                        <div class="info-item">
                            <div class="item-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="item-content">
                                <label class="info-label">الراتب</label>
                                <p class="info-value">
                                    @if($application->job->salary_min && $application->job->salary_max)
                                        {{ $application->job->salary_min }} - {{ $application->job->salary_max }} {{ $application->job->salary_currency }}
                                    @elseif($application->job->salary_min)
                                        من {{ $application->job->salary_min }} {{ $application->job->salary_currency }}
                                    @else
                                        حتى {{ $application->job->salary_max }} {{ $application->job->salary_currency }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    @if($application->job->description)
                        <div class="description-section">
                            <div class="section-header">
                                <h3 class="section-title">
                                    <i class="fas fa-align-left"></i>
                                    وصف الوظيفة
                                </h3>
                            </div>
                            <div class="description-content">
                                <p>{{ Str::limit($application->job->description, 300) }}</p>
                                <div class="description-more">
                                    <a href="{{ route('jobs.show', $application->job) }}" class="btn btn-primary">
                                        <i class="fas fa-external-link-alt"></i>
                                        عرض الوظيفة كاملة
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($application->job->skills)
                        <div class="skills-section">
                            <div class="section-header">
                                <h3 class="section-title">
                                    <i class="fas fa-tools"></i>
                                    المهارات المطلوبة
                                </h3>
                            </div>
                            <div class="skills-tags">
                                @foreach($application->job->skills as $skill)
                                    <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Cover Letter Card -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-envelope"></i>
                        خطاب التقديم
                    </h2>
                </div>
                <div class="section-content">
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
                <div class="dashboard-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-file-pdf"></i>
                            السيرة الذاتية
                        </h2>
                    </div>
                    <div class="section-content">
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
        <div class="dashboard-sidebar">
            <!-- Application Status Card -->
            <div class="dashboard-section status-card">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        حالة الطلب
                    </h3>
                </div>
                <div class="section-content">
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
            <div class="dashboard-section details-card">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-clipboard-list"></i>
                        تفاصيل الطلب
                    </h3>
                </div>
                <div class="section-content">
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
                <div class="dashboard-section applicant-card">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-user"></i>
                            معلومات المتقدم
                        </h3>
                    </div>
                    <div class="section-content">
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
                                                @foreach($application->applicant->skills as $skill)
                                                    <span class="skill-tag">{{ $skill }}</span>
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
/* Dashboard-specific styles */
.dashboard-sections {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.dashboard-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.main-content-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Alert Styles */
.alert {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.alert-icon {
    margin-left: 0.75rem;
}

.alert-content {
    flex: 1;
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

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.info-item:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.item-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.1rem;
}

.item-content {
    flex: 1;
}

.info-label, .detail-label {
    display: block;
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.5rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.info-value, .detail-value {
    font-size: 1.125rem;
    color: #1e293b;
    font-weight: 600;
    margin: 0;
}

/* Description Section */
.description-section {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
}

.description-content {
    background: #f8fafc;
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.description-more {
    margin-top: 1.5rem;
    text-align: center;
}

/* Skills Section */
.skills-section {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 1rem;
}

.skill-tag {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #1e40af;
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.875rem;
    font-weight: 600;
    border: 1px solid #93c5fd;
    transition: all 0.2s ease;
}

.skill-tag:hover {
    background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
    transform: translateY(-1px);
}

/* Cover Letter */
.cover-letter-content {
    background: #f8fafc;
    padding: 2rem;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.content-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    color: #64748b;
    font-size: 1rem;
    font-weight: 600;
}

.letter-text {
    line-height: 1.8;
    color: #334155;
    margin-bottom: 2rem;
    font-size: 1.05rem;
}

.content-footer {
    border-top: 1px solid #e2e8f0;
    padding-top: 1.5rem;
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
    color: #64748b;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Resume Section */
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
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.resume-details h3 {
    margin-bottom: 0.5rem;
    color: #1e293b;
    font-size: 1.125rem;
}

.resume-type {
    color: #64748b;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.resume-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #94a3b8;
    font-size: 0.875rem;
}

.resume-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

/* Status Card */
.status-card {
    border-left: 4px solid #10b981;
}

.current-status {
    text-align: center;
    margin-bottom: 2rem;
}

.status-badge {
    padding: 1rem 2rem;
    border-radius: 2rem;
    font-size: 1rem;
    font-weight: 600;
    display: inline-block;
}

/* Status Colors */
.status-pending { background: #fef3c7; color: #92400e; }
.status-shortlisted { background: #dbeafe; color: #1e40af; }
.status-interviewed { background: #e0e7ff; color: #3730a3; }
.status-accepted { background: #d1fae5; color: #065f46; }
.status-rejected { background: #fee2e2; color: #991b1b; }

/* Form Styles */
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
    color: #374151;
    font-size: 0.875rem;
}

.form-select {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #d1d5db;
    border-radius: 8px;
    background: white;
    font-size: 1rem;
    transition: all 0.2s ease;
    color: #374151;
}

.form-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.btn-full {
    width: 100%;
    justify-content: center;
}

/* Details Card */
.details-card {
    border-left: 4px solid #3b82f6;
}

.details-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

/* Applicant Card */
.applicant-card {
    border-left: 4px solid #f59e0b;
}

.applicant-profile {
    text-align: center;
    margin-bottom: 2rem;
}

.applicant-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.applicant-email {
    color: #64748b;
    font-size: 0.875rem;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .dashboard-sections {
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
    .info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .text-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .resume-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .resume-actions .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
