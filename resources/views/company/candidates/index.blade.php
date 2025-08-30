@extends('dashboard.index')

@section('title', 'قاعدة المرشحين')

@section('content')
<div class="company-candidates-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">قاعدة المرشحين</h1>
            <p class="page-subtitle">استكشف المرشحين الذين تقدموا لوظائفك</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('company.candidates.search') }}" class="btn btn-primary">
                <i class="fas fa-search"></i>
                البحث عن مرشحين
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $candidates->total() }}</h3>
                <p class="stat-label">إجمالي المرشحين</p>
            </div>
        </div>
    </div>

    <!-- Candidates List -->
    <div class="candidates-section">
        <div class="section-header">
            <h2 class="section-title">المرشحين</h2>
            <div class="section-actions">
                <a href="{{ route('company.candidates.favorites') }}" class="btn btn-outline">المفضلين</a>
                <a href="{{ route('company.candidates.search') }}" class="btn btn-outline">البحث</a>
            </div>
        </div>

        <div class="candidates-grid">
            @forelse($candidates as $candidate)
                <div class="candidate-card">
                    <div class="candidate-header">
                        <div class="candidate-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="candidate-info">
                            <h3 class="candidate-name">{{ $candidate->name }}</h3>
                            <p class="candidate-email">{{ $candidate->email }}</p>
                            @if($candidate->phone)
                                <p class="candidate-phone">{{ $candidate->phone }}</p>
                            @endif
                        </div>
                        <div class="candidate-actions">
                            <button class="btn btn-sm btn-outline" onclick="viewCandidate({{ $candidate->id }})">عرض</button>
                            <button class="btn btn-sm btn-primary" onclick="addToFavorites({{ $candidate->id }})">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    
                    @if($candidate->bio)
                        <div class="candidate-bio">
                            <p>{{ Str::limit($candidate->bio, 150) }}</p>
                        </div>
                    @endif

                    @if($candidate->skills && count($candidate->skills) > 0)
                        <div class="candidate-skills">
                            <h4>المهارات:</h4>
                            <div class="skills-list">
                                @foreach(array_slice($candidate->skills, 0, 5) as $skill)
                                    <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                                @if(count($candidate->skills) > 5)
                                    <span class="more-skills">+{{ count($candidate->skills) - 5 }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="applications-info">
                        <h4>الوظائف المتقدم لها:</h4>
                        <div class="applications-list">
                            @forelse($candidate->applications as $application)
                                <div class="application-item">
                                    <span class="job-title">{{ $application->job->title }}</span>
                                    {{-- <span class="status-badge status-{{ $application->status }}">{{ $application->getStatusText() }}</span> --}}
                                </div>
                            @empty
                                <p class="no-applications">لا توجد طلبات</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="candidate-footer">
                        <div class="contact-info">
                            <a href="mailto:{{ $candidate->email }}" class="btn btn-sm btn-outline">
                                <i class="fas fa-envelope"></i>
                                إرسال بريد
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-user-tie empty-icon"></i>
                    <p class="empty-text">لا يوجد مرشحين حالياً</p>
                    <a href="{{ route('company.candidates.search') }}" class="btn btn-primary">البحث عن مرشحين</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($candidates->hasPages())
            <div class="pagination-wrapper">
                {{ $candidates->links() }}
            </div>
        @endif
    </div>
</div>

<style>
.company-candidates-page {
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
    color: var(--primary-green);
    margin: 0 0 0.5rem 0;
}

.page-subtitle {
    color: var(--grey-600);
    margin: 0;
}

.candidates-section {
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

.candidates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
    gap: 1.5rem;
}

.candidate-card {
    border: 1px solid var(--grey-200);
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    background: white;
}

.candidate-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.candidate-header {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.candidate-avatar {
    width: 60px;
    height: 60px;
    background: var(--primary-green);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.candidate-info {
    flex: 1;
}

.candidate-name {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--grey-800);
    margin: 0 0 0.25rem 0;
}

.candidate-email {
    color: var(--grey-600);
    margin: 0 0 0.25rem 0;
    font-size: 0.9rem;
}

.candidate-phone {
    color: var(--grey-600);
    margin: 0;
    font-size: 0.9rem;
}

.candidate-actions {
    display: flex;
    gap: 0.5rem;
    flex-shrink: 0;
}

.candidate-bio {
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: var(--grey-50);
    border-radius: 8px;
}

.candidate-bio p {
    margin: 0;
    color: var(--grey-600);
    line-height: 1.6;
}

.candidate-skills {
    margin-bottom: 1.5rem;
}

.candidate-skills h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--grey-800);
    margin: 0 0 0.75rem 0;
}

.skills-list {
    display: flex;
    gap: 0.5rem;
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

.applications-info {
    margin-bottom: 1.5rem;
}

.applications-info h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--grey-800);
    margin: 0 0 0.75rem 0;
}

.applications-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.application-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: var(--grey-50);
    border-radius: 8px;
}

.job-title {
    font-size: 0.9rem;
    color: var(--grey-700);
    font-weight: 500;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-pending { background: #fef3c7; color: #92400e; }
.status-reviewed { background: #dbeafe; color: #1e40af; }
.status-shortlisted { background: #dcfce7; color: #166534; }
.status-interviewed { background: #e0e7ff; color: #3730a3; }
.status-accepted { background: #dcfce7; color: #166534; }
.status-rejected { background: #fee2e2; color: #991b1b; }

.no-applications {
    color: var(--grey-500);
    font-style: italic;
    margin: 0;
    text-align: center;
    padding: 1rem;
}

.candidate-footer {
    display: flex;
    justify-content: flex-end;
    border-top: 1px solid var(--grey-200);
    padding-top: 1rem;
}

.contact-info {
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
    .company-candidates-page {
        padding: 1rem;
    }
    
    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .candidates-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .candidate-header {
        flex-direction: column;
        text-align: center;
    }
    
    .candidate-actions {
        justify-content: center;
        margin-top: 1rem;
    }
}
</style>

<script>
function viewCandidate(candidateId) {
    // This would open a detailed view of the candidate
    console.log('Viewing candidate:', candidateId);
}

function addToFavorites(candidateId) {
    // This would add the candidate to favorites
    console.log('Adding to favorites:', candidateId);
    // You can implement AJAX call here to add to favorites
}
</script>
@endsection
