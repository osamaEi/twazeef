@extends('dashboard.index')

@section('title', 'تقدمات الوظيفة: ' . $job->title)

@section('content')
<!-- CSRF Token for AJAX requests -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="dashboard-content">
    <!-- Welcome Alert -->
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>مرحباً بك في صفحة تقدمات الوظيفة!</strong> يمكنك مراجعة وإدارة جميع التقدمات المقدمة لهذه الوظيفة.
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i><span>+{{ $applications->total() }}</span></div>
            </div>
            <div class="stat-value">{{ $applications->total() }}</div>
            <div class="stat-label">إجمالي التقدمات</div>
            <div class="stat-description">جميع التقدمات المقدمة للوظيفة</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i><span>+{{ $applications->where('status', 'pending')->count() }}</span></div>
            </div>
            <div class="stat-value">{{ $applications->where('status', 'pending')->count() }}</div>
            <div class="stat-label">في الانتظار</div>
            <div class="stat-description">تقدمات تحتاج للمراجعة</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon"><i class="fas fa-star"></i></div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i><span>+{{ $applications->where('status', 'shortlisted')->count() }}</span></div>
            </div>
            <div class="stat-value">{{ $applications->where('status', 'shortlisted')->count() }}</div>
            <div class="stat-label">قائمة مختصرة</div>
            <div class="stat-description">مرشحين مختارين للمقابلة</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-trend"><i class="fas fa-arrow-up"></i><span>+{{ $applications->where('status', 'accepted')->count() }}</span></div>
            </div>
            <div class="stat-value">{{ $applications->where('status', 'accepted')->count() }}</div>
            <div class="stat-label">مقبولين</div>
            <div class="stat-description">مرشحين تم قبولهم</div>
        </div>
    </div>

  

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <button class="filter-tab active" data-status="all">
            <i class="fas fa-list"></i>
            جميع التقدمات
            <span class="tab-count">{{ $applications->total() }}</span>
        </button>
        <button class="filter-tab" data-status="pending">
            <i class="fas fa-clock"></i>
            في الانتظار
            <span class="tab-count">{{ $applications->where('status', 'pending')->count() }}</span>
        </button>
        <button class="filter-tab" data-status="shortlisted">
            <i class="fas fa-star"></i>
            قائمة مختصرة
            <span class="tab-count">{{ $applications->where('status', 'shortlisted')->count() }}</span>
        </button>
        <button class="filter-tab" data-status="accepted">
            <i class="fas fa-check-circle"></i>
            مقبولين
            <span class="tab-count">{{ $applications->where('status', 'accepted')->count() }}</span>
        </button>
    </div>

    <!-- Search and Filters -->
    <div class="search-filters">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="البحث في التقدمات...">
        </div>
        <div class="filter-controls">
            <select id="statusFilter" class="filter-select">
                <option value="">جميع الحالات</option>
                <option value="pending">في الانتظار</option>
                <option value="reviewed">تمت المراجعة</option>
                <option value="shortlisted">قائمة مختصرة</option>
                <option value="interviewed">تمت المقابلة</option>
                <option value="accepted">مقبول</option>
                <option value="rejected">مرفوض</option>
            </select>
            <button class="btn btn-outline" onclick="resetFilters()">
                <i class="fas fa-undo"></i>
                إعادة تعيين
            </button>
        </div>
    </div>

    <!-- Applications Data Table -->
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-users"></i>
                قائمة التقدمات
            </h3>
            <div class="table-actions">
                <button class="btn btn-primary" onclick="exportApplications()">
                    <i class="fas fa-download"></i>
                    تصدير الكل
                </button>
                <button class="btn btn-secondary" onclick="refreshTable()">
                    <i class="fas fa-refresh"></i>
                    تحديث
                </button>
            </div>
        </div>
        
        <div class="table-content">
            @forelse($applications as $application)
                <div class="table-row application-row" data-status="{{ $application->status }}">
                    <div class="row-content">
                        <div class="row-main">
                            <div class="row-avatar">
                                <div class="avatar-initials">{{ substr($application->applicant->name, 0, 2) }}</div>
                                <div class="avatar-flag">👤</div>
                            </div>
                            <div class="row-info">
                                <div class="row-title">{{ $application->applicant->name }}</div>
                                <div class="row-subtitle">{{ $application->applicant->email }}</div>
                                <div class="row-meta">
                                    <span><i class="fas fa-calendar"></i> {{ $application->created_at->diffForHumans() }}</span>
                                    @if($application->applicant->phone)
                                        <span><i class="fas fa-phone"></i> {{ $application->applicant->phone }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row-status">
                            <span class="status-badge status-{{ $application->status }}">
                                @switch($application->status)
                                    @case('pending')
                                        في الانتظار
                                        @break
                                    @case('reviewed')
                                        تمت المراجعة
                                        @break
                                    @case('shortlisted')
                                        قائمة مختصرة
                                        @break
                                    @case('interviewed')
                                        تمت المقابلة
                                        @break
                                    @case('accepted')
                                        مقبول
                                        @break
                                    @case('rejected')
                                        مرفوض
                                        @break
                                    @default
                                        {{ $application->status }}
                                @endswitch
                            </span>
                        </div>
                        
                        <div class="row-actions">
                            <a href="{{ route('jobs.applications.show', ['job' => $job, 'application' => $application]) }}" class="btn btn-outline btn-sm">
                                <i class="fas fa-eye"></i>
                                عرض
                            </a>
                            
                            <div class="status-actions">
                                @if($application->status === 'pending')
                                    <button class="btn btn-success btn-sm" onclick="updateStatus('{{ $application->id }}', 'shortlisted')">
                                        <i class="fas fa-star"></i>
                                        مختصر
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="updateStatus('{{ $application->id }}', 'rejected')">
                                        <i class="fas fa-times"></i>
                                        رفض
                                    </button>
                                @elseif($application->status === 'shortlisted')
                                    <button class="btn btn-info btn-sm" onclick="updateStatus('{{ $application->id }}', 'interviewed')">
                                        <i class="fas fa-handshake"></i>
                                        مقابلة
                                    </button>
                                @elseif($application->status === 'interviewed')
                                    <button class="btn btn-success btn-sm" onclick="updateStatus('{{ $application->id }}', 'accepted')">
                                        <i class="fas fa-check"></i>
                                        قبول
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="updateStatus('{{ $application->id }}', 'rejected')">
                                        <i class="fas fa-times"></i>
                                        رفض
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if($application->cover_letter || $application->applicant->skills)
                        <div class="row-details">
                            @if($application->cover_letter)
                                <div class="detail-section">
                                    <h4>رسالة التقديم:</h4>
                                    <p>{{ Str::limit($application->cover_letter, 200) }}</p>
                                    @if(strlen($application->cover_letter) > 200)
                                        <button class="btn btn-link btn-sm show-more" data-content="{{ $application->cover_letter }}">
                                            عرض المزيد
                                        </button>
                                    @endif
                                </div>
                            @endif
                            
                            @if($application->applicant->skills)
                                <div class="detail-section">
                                    <h4>المهارات:</h4>
                                    <div class="skills-tags">
                                        @foreach(array_slice($application->applicant->skills, 0, 6) as $skill)
                                            <span class="skill-tag">{{ $skill }}</span>
                                        @endforeach
                                        @if(count($application->applicant->skills) > 6)
                                            <span class="skill-tag more-skills">+{{ count($application->applicant->skills) - 6 }} المزيد</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-content">
                        <i class="fas fa-users fa-3x"></i>
                        <h4>لا توجد تقدمات بعد</h4>
                        <p>لم يتقدم أحد لهذه الوظيفة بعد</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if($applications->hasPages())
        <div class="pagination-wrapper">
            {{ $applications->links() }}
        </div>
    @endif
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>تأكيد الإجراء</h3>
            <button class="modal-close" onclick="closeModal('confirmModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p id="confirmMessage"></p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('confirmModal')">إلغاء</button>
            <button class="btn btn-primary" id="confirmButton">تأكيد</button>
        </div>
    </div>
</div>

<style>
/* Dashboard Styles */
.dashboard-content {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

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

/* Stats Grid */
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

/* Quick Opportunities */
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

/* Filter Tabs */
.filter-tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.filter-tab {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.5rem;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    color: #64748b;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 160px;
    justify-content: center;
}

.filter-tab:hover {
    border-color: #cbd5e1;
    color: #475569;
}

.filter-tab.active {
    background: #3b82f6;
    border-color: #3b82f6;
    color: white;
}

.tab-count {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Search and Filters */
.search-filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    align-items: center;
}

.search-box {
    position: relative;
    flex: 1;
    min-width: 300px;
}

.search-box input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}

.filter-controls {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.filter-select {
    padding: 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    background: white;
    min-width: 150px;
}

.btn {
    padding: 1rem 1.5rem;
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

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
}

.btn-secondary {
    background: #64748b;
    color: white;
}

.btn-secondary:hover {
    background: #475569;
}

.btn-sm {
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
}

/* Data Table */
.data-table {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    border-bottom: 1px solid #f1f5f9;
    background: #f8fafc;
}

.table-title {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.table-actions {
    display: flex;
    gap: 1rem;
}

.table-content {
    padding: 0;
}

.table-row {
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.3s ease;
}

.table-row:hover {
    background: #f8fafc;
}

.row-content {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 2rem;
}

.row-main {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex: 1;
}

.row-avatar {
    position: relative;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 1.2rem;
}

.avatar-flag {
    position: absolute;
    bottom: -5px;
    right: -5px;
    font-size: 1rem;
}

.row-info {
    flex: 1;
}

.row-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.row-subtitle {
    color: #64748b;
    margin-bottom: 0.5rem;
}

.row-meta {
    display: flex;
    gap: 1.5rem;
    font-size: 0.9rem;
    color: #94a3b8;
}

.row-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.row-status {
    min-width: 120px;
}

.row-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    min-width: 200px;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
    display: inline-block;
    min-width: 100px;
}

.status-pending { background: #fef3c7; color: #92400e; }
.status-reviewed { background: #e0e7ff; color: #3730a3; }
.status-shortlisted { background: #dbeafe; color: #1e40af; }
.status-interviewed { background: #d1fae5; color: #065f46; }
.status-accepted { background: #d1fae5; color: #065f46; }
.status-rejected { background: #fee2e2; color: #991b1b; }

.status-actions {
    display: flex;
    gap: 0.5rem;
}

.row-details {
    padding: 0 2rem 2rem 2rem;
    background: #f8fafc;
    border-top: 1px solid #f1f5f9;
}

.detail-section {
    margin-bottom: 1.5rem;
}

.detail-section:last-child {
    margin-bottom: 0;
}

.detail-section h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.75rem;
}

.detail-section p {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 0.75rem;
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.skill-tag {
    background: #e0e7ff;
    color: #3730a3;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.more-skills {
    background: #f1f5f9;
    color: #64748b;
}

.btn-link {
    background: transparent;
    color: #3b82f6;
    text-decoration: underline;
    padding: 0;
}

.btn-link:hover {
    color: #2563eb;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-content i {
    color: #cbd5e1;
    margin-bottom: 1.5rem;
}

.empty-content h4 {
    font-size: 1.5rem;
    color: #64748b;
    margin-bottom: 0.5rem;
}

.empty-content p {
    color: #94a3b8;
    font-size: 1.1rem;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
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
@media (max-width: 768px) {
    .dashboard-content {
        padding: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-opportunities {
        grid-template-columns: 1fr;
    }
    
    .filter-tabs {
        justify-content: center;
    }
    
    .search-filters {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-box {
        min-width: auto;
    }
    
    .table-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .row-content {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .row-main {
        flex-direction: column;
        text-align: center;
    }
    
    .row-actions {
        justify-content: center;
        min-width: auto;
    }
    
    .status-actions {
        justify-content: center;
    }
}
</style>

<script>
// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    
    // Filter tabs
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const status = this.getAttribute('data-status');
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            filterApplications(status);
        });
    });
    
    // Search functionality
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            searchApplications(query);
        });
    }
    
    // Status filter
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            filterApplications(this.value);
        });
    }
});

function filterApplications(status) {
    const rows = document.querySelectorAll('.application-row');
    rows.forEach(row => {
        if (!status || status === 'all') {
            row.style.display = '';
        } else {
            const rowStatus = row.getAttribute('data-status');
            row.style.display = rowStatus === status ? '' : 'none';
        }
    });
}

function searchApplications(query) {
    const rows = document.querySelectorAll('.application-row');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    filterApplications('all');
    document.querySelector('[data-status="all"]').classList.add('active');
    document.querySelectorAll('[data-status]').forEach(tab => {
        if (tab.getAttribute('data-status') !== 'all') {
            tab.classList.remove('active');
        }
    });
}

function updateStatus(applicationId, status) {
    const message = `هل أنت متأكد من تغيير حالة التقديم إلى "${getStatusText(status)}"؟`;
    showConfirmModal(message, () => {
        updateApplicationStatus(applicationId, status);
    });
}

function getStatusText(status) {
    const statusTexts = {
        'pending': 'في الانتظار',
        'shortlisted': 'قائمة مختصرة',
        'interviewed': 'تمت المقابلة',
        'accepted': 'مقبول',
        'rejected': 'مرفوض'
    };
    return statusTexts[status] || status;
}

function updateApplicationStatus(applicationId, status) {
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحديث...';
    button.disabled = true;

    fetch(`/applications/${applicationId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateStatusBadge(applicationId, data.new_status, data.status_text);
            updateStatusActions(applicationId, data.new_status);
            showSuccessMessage(data.message);
            location.reload(); // Refresh to update counts
        } else {
            showErrorMessage(data.message || 'حدث خطأ أثناء تحديث الحالة');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorMessage('حدث خطأ أثناء تحديث الحالة');
    })
    .finally(() => {
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

function updateStatusBadge(applicationId, newStatus, statusText) {
    const applicationCard = document.querySelector(`[data-application-id="${applicationId}"]`);
    if (applicationCard) {
        const statusBadge = applicationCard.querySelector('.status-badge');
        if (statusBadge) {
            statusBadge.className = `status-badge status-${newStatus}`;
            statusBadge.textContent = statusText;
        }
    }
}

function updateStatusActions(applicationId, newStatus) {
    const applicationCard = document.querySelector(`[data-application-id="${applicationId}"]`);
    if (applicationCard) {
        const statusActions = applicationCard.querySelector('.status-actions');
        if (statusActions) {
            statusActions.innerHTML = generateStatusButtons(applicationId, newStatus);
        }
    }
}

function generateStatusButtons(applicationId, status) {
    let buttons = '';
    
    switch(status) {
        case 'pending':
            buttons = `
                <button class="btn btn-success btn-sm" onclick="updateStatus('${applicationId}', 'shortlisted')">
                    <i class="fas fa-star"></i>
                    مختصر
                </button>
                <button class="btn btn-danger btn-sm" onclick="updateStatus('${applicationId}', 'rejected')">
                    <i class="fas fa-times"></i>
                    رفض
                </button>
            `;
            break;
        case 'shortlisted':
            buttons = `
                <button class="btn btn-info btn-sm" onclick="updateStatus('${applicationId}', 'interviewed')">
                    <i class="fas fa-handshake"></i>
                    مقابلة
                </button>
            `;
            break;
        case 'interviewed':
            buttons = `
                <button class="btn btn-success btn-sm" onclick="updateStatus('${applicationId}', 'accepted')">
                    <i class="fas fa-check"></i>
                    قبول
                </button>
                <button class="btn btn-danger btn-sm" onclick="updateStatus('${applicationId}', 'rejected')">
                    <i class="fas fa-times"></i>
                    رفض
                </button>
            `;
            break;
    }
    
    return buttons;
}

function showConfirmModal(message, onConfirm) {
    const modal = document.getElementById('confirmModal');
    const confirmMessage = document.getElementById('confirmMessage');
    const confirmButton = document.getElementById('confirmButton');
    
    confirmMessage.textContent = message;
    confirmButton.onclick = onConfirm;
    
    modal.style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
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

// Utility functions
function scrollToApplications() {
    document.querySelector('.data-table').scrollIntoView({ behavior: 'smooth' });
}

function exportApplications() {
    // Implementation for exporting applications
    showSuccessMessage('سيتم تصدير التقدمات قريباً');
}

function showAnalytics() {
    // Implementation for showing analytics
    showSuccessMessage('سيتم عرض التحليلات قريباً');
}

function backToJob() {
    window.location.href = "{{ route('jobs.show', $job) }}";
}

function refreshTable() {
    location.reload();
}

// Show more content functionality
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('show-more')) {
        const content = e.target.dataset.content;
        const paragraph = e.target.previousElementSibling;
        paragraph.textContent = content;
        e.target.style.display = 'none';
    }
});

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>
@endsection
