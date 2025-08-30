@extends('dashboard.index')

@section('title', 'البحث عن مرشحين')

@section('content')
<div class="company-candidates-search-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">البحث عن مرشحين</h1>
            <p class="page-subtitle">ابحث عن مرشحين مناسبين بناءً على المهارات والموقع</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('company.candidates.index') }}" class="btn btn-outline">قاعدة المرشحين</a>
        </div>
    </div>

    <!-- Search Form -->
    <div class="search-section">
        <div class="search-form">
            <form method="GET" action="{{ route('company.candidates.search') }}">
                <div class="form-row">
                    <div class="form-group">
                        <label for="skills">المهارات المطلوبة</label>
                        <input type="text" name="skills" id="skills" class="form-control" 
                               value="{{ request('skills') }}" 
                               placeholder="مثال: PHP, Laravel, MySQL">
                        <small class="form-help">افصل بين المهارات بفاصلة</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="location">الموقع</label>
                        <input type="text" name="location" id="location" class="form-control" 
                               value="{{ request('location') }}" 
                               placeholder="مثال: الرياض، جدة">
                    </div>
                    
                    <div class="form-group">
                        <label for="experience">مستوى الخبرة</label>
                        <select name="experience" id="experience" class="form-control">
                            <option value="">جميع المستويات</option>
                            <option value="entry" {{ request('experience') == 'entry' ? 'selected' : '' }}>مبتدئ</option>
                            <option value="mid" {{ request('experience') == 'mid' ? 'selected' : '' }}>متوسط</option>
                            <option value="senior" {{ request('experience') == 'senior' ? 'selected' : '' }}>خبير</option>
                            <option value="executive" {{ request('experience') == 'executive' ? 'selected' : '' }}>تنفيذي</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        بحث
                    </button>
                    <a href="{{ route('company.candidates.search') }}" class="btn btn-outline">إعادة تعيين</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Results -->
    <div class="search-results">
        <div class="results-header">
            <h2>نتائج البحث</h2>
            <p class="results-count">{{ $candidates->total() }} مرشح</p>
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
                    <i class="fas fa-search empty-icon"></i>
                    <p class="empty-text">لا يوجد مرشحين يطابقون معايير البحث</p>
                    <p class="empty-suggestion">جرب تعديل معايير البحث أو إزالة بعض الفلاتر</p>
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
.company-candidates-search-page {
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

.search-section {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.search-form {
    max-width: 800px;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: var(--grey-700);
    margin-bottom: 0.5rem;
}

.form-control {
    padding: 0.75rem;
    border: 1px solid var(--grey-300);
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-green);
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
}

.form-help {
    font-size: 0.8rem;
    color: var(--grey-500);
    margin-top: 0.25rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-start;
}

.search-results {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--grey-200);
}

.results-header h2 {
    margin: 0;
    color: var(--grey-800);
    font-size: 1.5rem;
}

.results-count {
    margin: 0;
    color: var(--grey-600);
    font-size: 0.9rem;
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
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.empty-suggestion {
    color: var(--grey-500);
    margin: 0;
    font-size: 0.9rem;
}

.pagination-wrapper {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

@media (max-width: 768px) {
    .company-candidates-search-page {
        padding: 1rem;
    }
    
    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        justify-content: center;
    }
    
    .candidates-grid {
        grid-template-columns: 1fr;
    }
    
    .results-header {
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
