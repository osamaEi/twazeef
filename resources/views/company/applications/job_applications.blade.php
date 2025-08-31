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
                <div class="table-row application-row" data-status="{{ $application->status }}" data-application-id="{{ $application->id }}">
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
                                    @if($application->resume_path)
                                        <span><i class="fas fa-file-pdf"></i> <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="cv-link">عرض السيرة الذاتية</a></span>
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
                            <button class="btn btn-outline btn-sm" onclick="toggleApplicationDetails('{{ $application->id }}')">
                                <i class="fas fa-eye"></i>
                                عرض التفاصيل
                            </button>
                            
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
                    
                    <!-- Application Details Section -->
                    <div class="row-details" id="details-{{ $application->id }}" style="display: none;">
                        <div class="details-grid">
                            <!-- Personal Information -->
                            <div class="detail-section">
                                <h4><i class="fas fa-user"></i> المعلومات الشخصية</h4>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <span class="info-label">الاسم الكامل:</span>
                                        <span class="info-value">{{ $application->applicant->name }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">البريد الإلكتروني:</span>
                                        <span class="info-value">{{ $application->applicant->email }}</span>
                                    </div>
                                    @if($application->applicant->phone)
                                    <div class="info-item">
                                        <span class="info-label">رقم الهاتف:</span>
                                        <span class="info-value">{{ $application->applicant->phone }}</span>
                                    </div>
                                    @endif
                                    @if($application->applicant->address)
                                    <div class="info-item">
                                        <span class="info-label">العنوان:</span>
                                        <span class="info-value">{{ $application->applicant->address }}</span>
                                    </div>
                                    @endif
                                    <div class="info-item">
                                        <span class="info-label">تاريخ التقديم:</span>
                                        <span class="info-value">{{ $application->created_at->format('Y/m/d H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Skills Section -->
                            @if($application->applicant->skills && count($application->applicant->skills) > 0)
                            <div class="detail-section">
                                <h4><i class="fas fa-tools"></i> المهارات</h4>
                                <div class="skills-tags">
                                    @foreach($application->applicant->skills as $skill)
                                        <span class="skill-tag">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Cover Letter Section -->
                            @if($application->cover_letter)
                            <div class="detail-section">
                                <h4><i class="fas fa-envelope"></i> رسالة التقديم</h4>
                                <div class="cover-letter-content">
                                    <p>{{ $application->cover_letter }}</p>
                                </div>
                            </div>
                            @endif

                            <!-- CV/Resume Section -->
                            @if($application->resume_path)
                            <div class="detail-section">
                                <h4><i class="fas fa-file-pdf"></i> السيرة الذاتية</h4>
                                <div class="cv-section">
                                    <div class="cv-preview">
                                        <i class="fas fa-file-pdf fa-3x"></i>
                                        <p>تم رفع السيرة الذاتية</p>
                                    </div>
                                    <div class="cv-actions">
                                        <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                            عرض السيرة الذاتية
                                        </a>
                                        <a href="{{ asset('storage/' . $application->resume_path) }}" download class="btn btn-outline btn-sm">
                                            <i class="fas fa-download"></i>
                                            تحميل السيرة الذاتية
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Company Information (if available) -->
                            @if($application->applicant->company_name)
                            <div class="detail-section">
                                <h4><i class="fas fa-building"></i> معلومات الشركة</h4>
                                <div class="info-grid">
                                    @if($application->applicant->company_name)
                                    <div class="info-item">
                                        <span class="info-label">اسم الشركة:</span>
                                        <span class="info-value">{{ $application->applicant->company_name }}</span>
                                    </div>
                                    @endif
                                    @if($application->applicant->company_position)
                                    <div class="info-item">
                                        <span class="info-label">المنصب الحالي:</span>
                                        <span class="info-value">{{ $application->applicant->company_position }}</span>
                                    </div>
                                    @endif
                                    @if($application->applicant->company_website)
                                    <div class="info-item">
                                        <span class="info-label">موقع الشركة:</span>
                                        <span class="info-value">
                                            <a href="{{ $application->applicant->company_website }}" target="_blank">{{ $application->applicant->company_website }}</a>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Notes Section -->
                            @if($application->notes)
                            <div class="detail-section">
                                <h4><i class="fas fa-sticky-note"></i> ملاحظات</h4>
                                <div class="notes-content">
                                    <p>{{ $application->notes }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
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

    <!-- Success/Error Toast Notifications -->
    <div class="toast-container" id="toastContainer">
        <div class="toast success" id="successToast">
            <div class="toast-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast-content">
                <h4 class="toast-title">نجح!</h4>
                <p class="toast-message">تم تحديث حالة التقديم بنجاح</p>
            </div>
            <button class="toast-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="toast error" id="errorToast">
            <div class="toast-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="toast-content">
                <h4 class="toast-title">خطأ!</h4>
                <p class="toast-message">حدث خطأ أثناء تحديث الحالة</p>
            </div>
            <button class="toast-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>تأكيد الإجراء</h3>
                <span class="close" onclick="closeModal('confirmModal')">&times;</span>
            </div>
            <div class="modal-body">
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('confirmModal')">إلغاء</button>
                <button id="confirmButton" class="btn btn-primary">تأكيد</button>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>تحديث حالة التقديم</h3>
                <span class="close" onclick="closeModal('statusModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="statusForm">
                    @csrf
                    <input type="hidden" id="applicationId" name="application_id">
                    <div class="form-group">
                        <label for="newStatus">الحالة الجديدة:</label>
                        <select id="newStatus" name="status" class="form-select" required>
                            <option value="pending">في الانتظار</option>
                            <option value="shortlisted">قائمة مختصرة</option>
                            <option value="interviewed">تمت المقابلة</option>
                            <option value="accepted">مقبول</option>
                            <option value="rejected">مرفوض</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">ملاحظات (اختياري):</label>
                        <textarea id="notes" name="notes" class="form-textarea" rows="3" placeholder="أضف ملاحظات حول هذا التقديم..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('statusModal')">إلغاء</button>
                <button class="btn btn-primary" onclick="submitStatusUpdate()">تحديث الحالة</button>
            </div>
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
    background: linear-gradient(135deg, #e8eff5 0%, #d4e7f0 100%);
    border: 1px solid #005085;
    color: #003c6d;
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
    box-shadow: 0 4px 20px rgba(0, 60, 109, 0.08);
    border: 1px solid #e8eff5;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 60, 109, 0.12);
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
    background: linear-gradient(135deg, #003c6d 0%, #005085 100%);
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
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stat-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #424242;
    margin-bottom: 0.5rem;
}

.stat-description {
    font-size: 0.9rem;
    color: #757575;
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
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    color: #757575;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 160px;
    justify-content: center;
}

.filter-tab:hover {
    border-color: #c0c0c0;
    color: #424242;
}

.filter-tab.active {
    background: #003c6d;
    border-color: #003c6d;
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
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    border-color: #003c6d;
    box-shadow: 0 0 0 3px rgba(0, 60, 109, 0.1);
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #757575;
}

.filter-controls {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.filter-select {
    padding: 1rem;
    border: 2px solid #e0e0e0;
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
    color: #757575;
    border: 2px solid #e0e0e0;
}

.btn-outline:hover {
    background: #f5f5f5;
    border-color: #c0c0c0;
}

.btn-primary {
    background: #003c6d;
    color: white;
}

.btn-primary:hover {
    background: #005085;
}

.btn-secondary {
    background: #757575;
    color: white;
}

.btn-secondary:hover {
    background: #424242;
}

.btn-sm {
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
}

/* Data Table */
.data-table {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 60, 109, 0.08);
    border: 1px solid #e8eff5;
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    border-bottom: 1px solid #e8eff5;
    background: #f4f9fa;
}

.table-title {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.5rem;
    font-weight: 600;
    color: #1a1a1a;
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
    border-bottom: 1px solid #e8eff5;
    transition: all 0.3s ease;
}

.table-row:hover {
    background: #f4f9fa;
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
    background: linear-gradient(135deg, #003c6d 0%, #005085 100%);
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
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.row-subtitle {
    color: #757575;
    margin-bottom: 0.5rem;
}

.row-meta {
    display: flex;
    gap: 1.5rem;
    font-size: 0.9rem;
    color: #757575;
    flex-wrap: wrap;
}

.row-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.cv-link {
    color: #003c6d;
    text-decoration: none;
    font-weight: 500;
}

.cv-link:hover {
    text-decoration: underline;
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

/* Enhanced Row Details */
.row-details {
    padding: 2rem;
    background: #f4f9fa;
    border-top: 1px solid #e8eff5;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.detail-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 60, 109, 0.05);
    border: 1px solid #e8eff5;
}

.detail-section h4 {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #e8eff5;
}

.detail-section h4 i {
    color: #003c6d;
}

.info-grid {
    display: grid;
    gap: 0.75rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: #f4f9fa;
    border-radius: 8px;
    border: 1px solid #e8eff5;
}

.info-label {
    font-weight: 600;
    color: #424242;
    min-width: 120px;
}

.info-value {
    color: #1a1a1a;
    text-align: left;
    flex: 1;
}

.info-value a {
    color: #003c6d;
    text-decoration: none;
}

.info-value a:hover {
    text-decoration: underline;
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.skill-tag {
    background: #e8eff5;
    color: #003c6d;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.cover-letter-content {
    background: #f4f9fa;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid #e8eff5;
}

.cover-letter-content p {
    color: #1a1a1a;
    line-height: 1.6;
    margin: 0;
    white-space: pre-wrap;
}

.cv-section {
    text-align: center;
}

.cv-preview {
    background: #f4f9fa;
    padding: 2rem;
    border-radius: 8px;
    border: 2px dashed #c0c0c0;
    margin-bottom: 1rem;
}

.cv-preview i {
    color: #ef4444;
    margin-bottom: 0.5rem;
}

.cv-preview p {
    color: #757575;
    margin: 0;
    font-weight: 500;
}

.cv-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.notes-content {
    background: #fef3c7;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid #fbbf24;
}

.notes-content p {
    color: #92400e;
    line-height: 1.6;
    margin: 0;
    white-space: pre-wrap;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-content i {
    color: #c0c0c0;
    margin-bottom: 1.5rem;
}

.empty-content h4 {
    font-size: 1.5rem;
    color: #757575;
    margin-bottom: 0.5rem;
}

.empty-content p {
    color: #757575;
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
    color: #1a1a1a;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #757575;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: #f5f5f5;
    color: #424242;
}

.modal-body {
    margin-bottom: 2rem;
}

.modal-body p {
    color: #757575;
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
    
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .info-label {
        min-width: auto;
    }
    
    .cv-actions {
        flex-direction: column;
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

function toggleApplicationDetails(applicationId) {
    const detailsSection = document.getElementById(`details-${applicationId}`);
    const button = event.target;
    
    if (detailsSection.style.display === 'none') {
        detailsSection.style.display = 'block';
        button.innerHTML = '<i class="fas fa-eye-slash"></i> إخفاء التفاصيل';
        button.classList.add('btn-primary');
        button.classList.remove('btn-outline');
    } else {
        detailsSection.style.display = 'none';
        button.innerHTML = '<i class="fas fa-eye"></i> عرض التفاصيل';
        button.classList.remove('btn-primary');
        button.classList.add('btn-outline');
    }
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
            // Update the counts in the filter tabs
            updateFilterCounts();
            // Don't reload the page, just update the UI
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

// Add function to update filter counts
function updateFilterCounts() {
    const rows = document.querySelectorAll('.application-row');
    const counts = {
        all: rows.length,
        pending: 0,
        shortlisted: 0,
        interviewed: 0,
        accepted: 0,
        rejected: 0
    };
    
    rows.forEach(row => {
        const status = row.getAttribute('data-status');
        if (status && counts.hasOwnProperty(status)) {
            counts[status]++;
        }
    });
    
    // Update tab counts
    Object.keys(counts).forEach(status => {
        const tab = document.querySelector(`[data-status="${status}"] .tab-count`);
        if (tab) {
            tab.textContent = counts[status];
        }
    });
    
    // Update stats grid
    const totalApplications = document.querySelector('.stats-grid .stat-card:nth-child(1) .stat-value');
    if (totalApplications) {
        totalApplications.textContent = counts.all;
    }
    
    const pendingApplications = document.querySelector('.stats-grid .stat-card:nth-child(2) .stat-value');
    if (pendingApplications) {
        pendingApplications.textContent = counts.pending;
    }
    
    const shortlistedApplications = document.querySelector('.stats-grid .stat-card:nth-child(3) .stat-value');
    if (shortlistedApplications) {
        shortlistedApplications.textContent = counts.shortlisted;
    }
    
    const acceptedApplications = document.querySelector('.stats-grid .stat-card:nth-child(4) .stat-value');
    if (acceptedApplications) {
        acceptedApplications.textContent = counts.accepted;
    }
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

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>
@endsection
