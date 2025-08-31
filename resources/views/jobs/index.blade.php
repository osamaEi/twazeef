@extends('dashboard.index')

@section('title', 'الوظائف المتاحة | شركة توافق للتوظيف')

@section('content')
<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">الوظائف المتاحة</h1>
        <p class="page-subtitle">ابحث عن الوظائف المناسبة وتقدم لها</p>
    </div>
    
    @auth
        @if(auth()->user()->isCompany())
            <div class="header-actions">
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    إضافة وظيفة جديدة
                </a>
            </div>
        @endif
    @endauth
</div>

<!-- Search and Filters -->
<div class="search-section">
    <form method="GET" action="{{ route('jobs.index') }}" class="search-form">
        <div class="search-row">
            <div class="search-field">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" placeholder="ابحث عن وظيفة..." value="{{ request('search') }}" 
                       class="search-input">
            </div>
            
            <div class="filter-group">
                <select name="type" class="filter-select">
                    <option value="">جميع الأنواع</option>
                    @foreach(App\Models\Job::getAvailableTypes() as $value => $label)
                        <option value="{{ $value }}" {{ request('type') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                
                <select name="experience" class="filter-select">
                    <option value="">جميع المستويات</option>
                    @foreach(App\Models\Job::getAvailableExperienceLevels() as $value => $label)
                        <option value="{{ $value }}" {{ request('experience') === $value ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-filter"></i>
                    تصفية
                </button>
                
                @if(request('search') || request('type') || request('experience'))
                    <a href="{{ route('jobs.index') }}" class="btn btn-outline">
                        <i class="fas fa-times"></i>
                        مسح الفلاتر
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

<!-- Active Filters Display -->
@if(request('search') || request('type') || request('experience'))
    <div class="active-filters">
        <h4>الفلاتر النشطة:</h4>
        <div class="filter-tags">
            @if(request('search'))
                <span class="filter-tag">
                    البحث: "{{ request('search') }}"
                    <a href="{{ route('jobs.index', array_merge(request()->except('search'), ['search' => ''])) }}" class="remove-filter">×</a>
                </span>
            @endif
            @if(request('type'))
                <span class="filter-tag">
                    النوع: {{ App\Models\Job::getAvailableTypes()[request('type')] }}
                    <a href="{{ route('jobs.index', request()->except('type')) }}" class="remove-filter">×</a>
                </span>
            @endif
            @if(request('experience'))
                <span class="filter-tag">
                    الخبرة: {{ request('experience') }}
                    <a href="{{ route('jobs.index', request()->except('experience')) }}" class="remove-filter">×</a>
                </span>
            @endif
        </div>
    </div>
@endif

<!-- Results Count -->
<div class="results-count">
    <p>تم العثور على <strong>{{ $jobs->total() }}</strong> وظيفة</p>
</div>

<!-- Jobs Table -->
<div class="data-table">
    <div class="table-header">
        <h3 class="table-title">
            <i class="fas fa-briefcase"></i>
            الوظائف المتاحة
        </h3>
        <div class="table-actions">
            @auth
                @if(auth()->user()->isCompany())
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        إنشاء وظيفة جديدة
                    </a>
                @endif
            @endauth
            <button class="btn btn-secondary">
                <i class="fas fa-download"></i>
                تصدير Excel
            </button>
        </div>
    </div>
    
    <div class="table-content">
        @if($jobs->count() > 0)
            <table class="main-table">
                <thead>
                    <tr>
                        <th>المسمى الوظيفي</th>
                        <th>الشركة</th>
                        <th>الموقع</th>
                        <th>الراتب المقترح</th>
                        <th>تاريخ النشر</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td class="font-semibold">
                                <a href="{{ route('jobs.show', $job) }}" class="job-title-link">
                                    {{ $job->title }}
                                </a>
                            </td>
                            <td>{{ $job->company->name }}</td>
                            <td>{{ $job->location }}</td>
                            <td class="font-bold text-green">
                                @if($job->salary_min || $job->salary_max)
                                    @if($job->salary_min && $job->salary_max)
                                        {{ $job->salary_min }} - {{ $job->salary_max }} {{ $job->salary_currency }}
                                    @elseif($job->salary_min)
                                        من {{ $job->salary_min }} {{ $job->salary_currency }}
                                    @else
                                        حتى {{ $job->salary_max }} {{ $job->salary_currency }}
                                    @endif
                                @else
                                    <span class="text-gray">غير محدد</span>
                                @endif
                            </td>
                            <td>{{ $job->created_at->format('Y-m-d') }}</td>
                            <td>
                                <span class="status-badge status-{{ $job->status }}">
                                    {{ $job->status === 'active' ? 'نشطة' : 'معلق' }}
                                </span>
                            </td>
                                                    <td>
                            <div class="flex gap-1">
                                <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline">عرض</a>
                                @auth
                                    @if(auth()->user()->isEmployee())
                                        <a href="{{ route('applications.create', $job) }}" class="btn btn-primary">تقدم الآن</a>
                                    @endif
                                    @if(auth()->user()->isCompany() && $job->company_id === auth()->user()->id)
                                        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-secondary">تعديل</a>
                                        <a href="{{ route('jobs.applications.index', $job) }}" class="btn btn-info">المتقدمين</a>
                                    @endif
                                @endauth
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="empty-title">لم يتم العثور على وظائف</h3>
                <p class="empty-text">جرب تعديل معايير البحث أو تحقق لاحقاً</p>
            </div>
        @endif
    </div>
</div>

<!-- Pagination -->
@if($jobs->hasPages())
    <div class="pagination-container">
        {{ $jobs->links() }}
    </div>
@endif

<style>
/* Unified Color Scheme - Same as Employee Dashboard */
:root {
    --primary-color: #003c6d;
    --primary-light: #005085;
    --primary-lighter: #e8eff5;
    --primary-dark: #002a4a;
    --accent-color: #003c6d;
    --text-primary: #2c3e50;
    --text-secondary: #6c757d;
    --text-light: #95a5a6;
    --background-light: #f8f9fa;
    --background-white: #ffffff;
    --border-color: #e9ecef;
    --shadow-light: 0 2px 10px rgba(0, 60, 109, 0.1);
    --shadow-medium: 0 4px 20px rgba(0, 60, 109, 0.15);
    --shadow-heavy: 0 8px 30px rgba(0, 60, 109, 0.2);
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    border-radius: 16px;
    padding: 3rem 2rem;
    margin-bottom: 2rem;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.header-content p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.header-actions .btn {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
}

.header-actions .btn:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Search Section */
.search-section {
    background: var(--background-white);
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-light);
}

.search-form {
    width: 100%;
}

.search-row {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.search-field {
    flex: 1;
    position: relative;
}

.search-icon {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
}

.search-input {
    width: 100%;
    padding: 1rem 3rem 1rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(0, 60, 109, 0.1);
}

.filter-group {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.filter-select {
    padding: 1rem;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    background: var(--background-white);
    font-size: 0.9rem;
    min-width: 150px;
}

/* Active Filters */
.active-filters {
    background: var(--primary-lighter);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid var(--primary-light);
}

.active-filters h4 {
    color: var(--primary-color);
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.filter-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.filter-tag {
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.remove-filter {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.2rem;
    line-height: 1;
}

.remove-filter:hover {
    color: var(--primary-lighter);
}

/* Results Count */
.results-count {
    background: var(--background-white);
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-light);
    border-left: 4px solid var(--primary-color);
}

.results-count p {
    margin: 0;
    color: var(--text-secondary);
    font-size: 1rem;
}

.results-count strong {
    color: var(--primary-color);
}

/* Data Table */
.data-table {
    background: var(--background-white);
    border-radius: 16px;
    box-shadow: var(--shadow-light);
    overflow: hidden;
    margin-bottom: 2rem;
}

.table-header {
    background: var(--primary-lighter);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.table-actions {
    display: flex;
    gap: 1rem;
}

.table-content {
    padding: 0;
}

.main-table {
    width: 100%;
    border-collapse: collapse;
}

.main-table th {
    background: var(--background-light);
    padding: 1rem 1.5rem;
    text-align: right;
    font-weight: 600;
    color: var(--text-primary);
    border-bottom: 1px solid var(--border-color);
    font-size: 0.9rem;
}

.main-table td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
}

.main-table tbody tr:hover {
    background: var(--background-light);
}

.job-title-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.job-title-link:hover {
    color: var(--primary-light);
}

.font-semibold {
    font-weight: 600;
}

.font-bold {
    font-weight: 700;
}

.text-green {
    color: #28a745;
}

.text-gray {
    color: var(--text-light);
}

.text-center {
    text-align: center;
}

.flex {
    display: flex;
}

.gap-1 {
    gap: 0.25rem;
}

/* Status Badges */
.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
    min-width: 80px;
    display: inline-block;
}

.status-active {
    background: #d4edda;
    color: #155724;
}

.status-paused {
    background: #fff3cd;
    color: #856404;
}

.status-pending {
    background: #f8d7da;
    color: #721c24;
}

/* Buttons */
.btn {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-light);
    transform: translateY(-1px);
}

.btn-secondary {
    background: var(--text-light);
    color: white;
}

.btn-secondary:hover {
    background: var(--text-secondary);
    transform: translateY(-1px);
}

.btn-outline {
    background: transparent;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
}

.btn-outline:hover {
    background: var(--primary-color);
    color: white;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--background-white);
    border-radius: 12px;
    box-shadow: var(--shadow-light);
}

.empty-icon {
    font-size: 4rem;
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.empty-title {
    font-size: 1.5rem;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.empty-text {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
        padding: 2rem 1rem;
    }
    
    .header-content h1 {
        font-size: 2rem;
    }
    
    .search-row {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        flex-direction: column;
        align-items: stretch;
    }
    
    .table-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .table-actions {
        justify-content: center;
    }
    
    .main-table {
        font-size: 0.8rem;
    }
    
    .main-table th,
    .main-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .main-table th:nth-child(3),
    .main-table td:nth-child(3) {
        display: none;
    }
}
</style>
@endsection
