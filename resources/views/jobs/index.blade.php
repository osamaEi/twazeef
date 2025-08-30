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
                            {{ $label }}
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
                    الخبرة: {{ App\Models\Job::getAvailableExperienceLevels()[request('experience')] }}
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

<!-- Jobs List -->
<div class="jobs-container">
    @forelse($jobs as $job)
        <div class="job-card">
            <div class="job-header">
                <div class="job-title-section">
                    <h3 class="job-title">
                        <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                    </h3>
                    <p class="company-name">{{ $job->company->name }}</p>
                </div>
                
                <div class="job-status">
                    <span class="status-badge status-{{ $job->status }}">
                        {{ $job->status === 'active' ? 'نشط' : 'معلق' }}
                    </span>
                </div>
            </div>
            
            <div class="job-details">
                <div class="job-meta">
                    <span class="meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $job->location }}
                    </span>
                    <span class="meta-item">
                        <i class="fas fa-clock"></i>
                        {{ $job->type === 'full-time' ? 'دوام كامل' : ($job->type === 'part-time' ? 'دوام جزئي' : ($job->type === 'contract' ? 'عقد مؤقت' : 'عمل حر')) }}
                    </span>
                    <span class="meta-item">
                        <i class="fas fa-user-tie"></i>
                        {{ $job->experience_level === 'entry' ? 'مبتدئ' : ($job->experience_level === 'mid' ? 'متوسط' : ($job->experience_level === 'senior' ? 'خبير' : 'تنفيذي')) }}
                    </span>
                </div>
                
                <p class="job-description">{{ Str::limit($job->description, 200) }}</p>
                
                @if($job->salary_min || $job->salary_max)
                    <div class="salary-section">
                        <i class="fas fa-money-bill-wave"></i>
                        <span class="salary-text">
                            @if($job->salary_min && $job->salary_max)
                                {{ $job->salary_min }} - {{ $job->salary_max }} {{ $job->salary_currency }}
                            @elseif($job->salary_min)
                                من {{ $job->salary_min }} {{ $job->salary_currency }}
                            @else
                                حتى {{ $job->salary_max }} {{ $job->salary_currency }}
                            @endif
                        </span>
                    </div>
                @endif

                @if($job->skills)
                    <div class="skills-section">
                        <h4 class="skills-title">المهارات المطلوبة:</h4>
                        <div class="skills-tags">
                            @foreach(array_slice($job->skills, 0, 5) as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                            @if(count($job->skills) > 5)
                                <span class="skill-tag more-skills">+{{ count($job->skills) - 5 }} المزيد</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="job-footer">
                <div class="job-info">
                    <span class="posted-date">
                        <i class="fas fa-calendar-alt"></i>
                        تم النشر {{ $job->created_at->diffForHumans() }}
                    </span>
                </div>
                
                <div class="job-actions">
                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-outline">
                        <i class="fas fa-eye"></i>
                        عرض التفاصيل
                    </a>
                    
                    @auth
                        @if(auth()->user()->isEmployee())
                            <a href="{{ route('applications.create',  $job) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                تقدم الآن
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="empty-title">لم يتم العثور على وظائف</h3>
            <p class="empty-text">جرب تعديل معايير البحث أو تحقق لاحقاً</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($jobs->hasPages())
    <div class="pagination-container">
        {{ $jobs->links() }}
    </div>
@endif

<style>
.page-header {
    background: var(--gradient-primary);
    border-radius: var(--border-radius-lg);
    padding: 3rem 2rem;
    margin-bottom: 2rem;
    color: var(--pure-white);
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
    color: var(--pure-white);
}

.header-actions .btn:hover {
    background: rgba(255, 255, 255, 0.3);
}

.search-section {
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-sm);
}

.active-filters {
    background: var(--primary-lightest);
    border-radius: var(--border-radius-md);
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid var(--primary-light);
}

.active-filters h4 {
    color: var(--primary-green);
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.filter-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.filter-tag {
    background: var(--primary-green);
    color: var(--pure-white);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.remove-filter {
    color: var(--pure-white);
    text-decoration: none;
    font-weight: bold;
    font-size: 1.2rem;
    line-height: 1;
}

.remove-filter:hover {
    color: var(--primary-lightest);
}

.results-count {
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
    border-left: 4px solid var(--primary-green);
}

.results-count p {
    margin: 0;
    color: var(--grey-700);
    font-size: 1rem;
}

.results-count strong {
    color: var(--primary-green);
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
    color: var(--grey-500);
}

.search-input {
    width: 100%;
    padding: 1rem 3rem 1rem 1rem;
    border: 2px solid var(--grey-300);
    border-radius: var(--border-radius-sm);
    font-size: 1rem;
    transition: var(--transition-fast);
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-green);
    box-shadow: 0 0 0 3px rgba(0, 60, 109, 0.1);
}

.filter-group {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.filter-select {
    padding: 1rem;
    border: 2px solid var(--grey-300);
    border-radius: var(--border-radius-sm);
    background: var(--pure-white);
    font-size: 0.9rem;
    min-width: 150px;
}

.jobs-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.job-card {
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
    transition: var(--transition-fast);
    border: 1px solid var(--grey-100);
}

.job-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary-lightest);
}

.job-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.job-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--grey-800);
    margin: 0 0 0.5rem 0;
}

.job-title a {
    color: inherit;
    text-decoration: none;
    transition: var(--transition-fast);
}

.job-title a:hover {
    color: var(--primary-green);
}

.company-name {
    color: var(--primary-green);
    font-weight: 500;
    font-size: 1.1rem;
    margin: 0;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-active { background: #d4edda; color: #155724; }
.status-paused { background: #fff3cd; color: #856404; }
.status-closed { background: #f8d7da; color: #721c24; }

.job-details {
    margin-bottom: 1.5rem;
}

.job-meta {
    display: flex;
    gap: 2rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--grey-600);
    font-size: 0.9rem;
}

.meta-item i {
    color: var(--primary-green);
    width: 16px;
}

.job-description {
    color: var(--grey-700);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.salary-section {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    padding: 1rem;
    background: var(--primary-lightest);
    border-radius: var(--border-radius-sm);
}

.salary-section i {
    color: var(--success-green);
    font-size: 1.1rem;
}

.salary-text {
    color: var(--primary-green);
    font-weight: 600;
    font-size: 1rem;
}

.skills-section {
    margin-bottom: 1rem;
}

.skills-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--grey-700);
    margin-bottom: 0.5rem;
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.skill-tag {
    background: var(--primary-lightest);
    color: var(--primary-green);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.more-skills {
    background: var(--grey-200);
    color: var(--grey-600);
}

.job-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1.5rem;
    border-top: 1px solid var(--grey-100);
}

.posted-date {
    color: var(--grey-500);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.job-actions {
    display: flex;
    gap: 1rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: var(--border-radius-sm);
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition-fast);
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-primary {
    background: var(--gradient-primary);
    color: var(--pure-white);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-outline {
    background: transparent;
    color: var(--primary-green);
    border: 2px solid var(--primary-green);
}

.btn-outline:hover {
    background: var(--primary-green);
    color: var(--pure-white);
}

.btn-secondary {
    background: var(--grey-100);
    color: var(--grey-700);
    border: 1px solid var(--grey-300);
}

.btn-secondary:hover {
    background: var(--grey-200);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-sm);
}

.empty-icon {
    font-size: 4rem;
    color: var(--grey-400);
    margin-bottom: 1.5rem;
}

.empty-title {
    font-size: 1.5rem;
    color: var(--grey-600);
    margin-bottom: 0.5rem;
}

.empty-text {
    color: var(--grey-500);
    font-size: 1.1rem;
}

.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
}

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
    
    .job-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .job-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .job-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .job-actions {
        justify-content: center;
    }
}
</style>
@endsection
