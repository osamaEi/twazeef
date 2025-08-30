@extends('dashboard.index')

@section('title', 'الوظائف المعلقة')

@section('content')
<div class="company-jobs-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">الوظائف المعلقة</h1>
            <p class="page-subtitle">إدارة الوظائف المعلقة مؤقتاً</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                إضافة وظيفة جديدة
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-pause-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $jobs->total() }}</h3>
                <p class="stat-label">إجمالي الوظائف المعلقة</p>
                <div class="stat-change warning">
                    <i class="fas fa-pause"></i>
                    <span>معلق</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs List -->
    <div class="jobs-section">
        <div class="section-header">
            <h2 class="section-title">الوظائف المعلقة</h2>
            <div class="section-actions">
                <a href="{{ route('company.jobs.active') }}" class="btn btn-outline">الوظائف النشطة</a>
                <a href="{{ route('company.jobs.closed') }}" class="btn btn-outline">الوظائف المغلقة</a>
            </div>
        </div>

        <div class="jobs-grid">
            @forelse($jobs as $job)
                <div class="job-card">
                    <div class="job-header">
                        <h3 class="job-title">{{ $job->title }}</h3>
                        <span class="status-badge status-paused">معلق</span>
                    </div>
                    
                    <div class="job-meta">
                        <span class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $job->location }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-clock"></i>
                            {{ $job->type }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-users"></i>
                            {{ $job->applications_count }} طلب
                        </span>
                    </div>

                    <p class="job-description">{{ Str::limit($job->description, 150) }}</p>

                    <div class="job-skills">
                        @if($job->skills)
                            @foreach(array_slice($job->skills, 0, 3) as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                            @if(count($job->skills) > 3)
                                <span class="more-skills">+{{ count($job->skills) - 3 }}</span>
                            @endif
                        @endif
                    </div>

                    <div class="job-footer">
                        <div class="salary-info">
                            <span class="salary">{{ $job->salary_min }} - {{ $job->salary_max }} {{ $job->salary_currency }}</span>
                        </div>
                        <div class="job-actions">
                            <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-outline">تعديل</a>
                            <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-primary">عرض</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-pause-circle empty-icon"></i>
                    <p class="empty-text">لا توجد وظائف معلقة حالياً</p>
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary">إضافة وظيفة جديدة</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($jobs->hasPages())
            <div class="pagination-wrapper">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</div>

<style>
.company-jobs-page {
    padding: 2rem;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.page-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--warning-orange);
    margin: 0 0 0.5rem 0;
}

.page-subtitle {
    color: var(--grey-600);
    margin: 0;
}

.jobs-section {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--grey-800);
    margin: 0;
}

.section-actions {
    display: flex;
    gap: 1rem;
}

.jobs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
}

.job-card {
    border: 1px solid var(--grey-200);
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    background: white;
}

.job-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.job-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.job-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--grey-800);
    margin: 0;
    flex: 1;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-paused {
    background: #fef3c7;
    color: #92400e;
}

.job-meta {
    display: flex;
    gap: 1rem;
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

.job-description {
    color: var(--grey-600);
    margin-bottom: 1rem;
    line-height: 1.6;
}

.job-skills {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.skill-tag {
    background: var(--grey-100);
    color: var(--grey-700);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
}

.more-skills {
    background: var(--primary-green);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
}

.job-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.salary-info {
    font-weight: 600;
    color: var(--primary-green);
}

.job-actions {
    display: flex;
    gap: 0.5rem;
}

.empty-state {
    text-align: center;
    padding: 3rem;
    grid-column: 1 / -1;
}

.empty-icon {
    font-size: 3rem;
    color: var(--grey-400);
    margin-bottom: 1rem;
}

.empty-text {
    color: var(--grey-600);
    margin-bottom: 1.5rem;
}

.pagination-wrapper {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

@media (max-width: 768px) {
    .company-jobs-page {
        padding: 1rem;
    }
    
    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .jobs-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}
</style>
@endsection
