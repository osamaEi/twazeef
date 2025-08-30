@extends('dashboard.index')

@section('title', 'جميع الطلبات')

@section('content')
<div class="company-applications-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">جميع طلبات التقديم</h1>
            <p class="page-subtitle">إدارة جميع طلبات التقديم للوظائف</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('company.applications.pending') }}" class="btn btn-warning">قيد المراجعة</a>
            <a href="{{ route('company.applications.shortlisted') }}" class="btn btn-info">القائمة المختصرة</a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $applications->total() }}</h3>
                <p class="stat-label">إجمالي الطلبات</p>
            </div>
        </div>
    </div>

    <!-- Applications List -->
    <div class="applications-section">
        <div class="section-header">
            <h2 class="section-title">جميع الطلبات</h2>
            <div class="section-actions">
                <a href="{{ route('company.applications.pending') }}" class="btn btn-outline">قيد المراجعة</a>
                <a href="{{ route('company.applications.shortlisted') }}" class="btn btn-outline">القائمة المختصرة</a>
                <a href="{{ route('company.applications.interviewed') }}" class="btn btn-outline">تمت المقابلة</a>
                <a href="{{ route('company.applications.accepted') }}" class="btn btn-outline">مقبول</a>
                <a href="{{ route('company.applications.rejected') }}" class="btn btn-outline">مرفوض</a>
            </div>
        </div>

        <div class="applications-grid">
            @forelse($applications as $application)
                <div class="application-card">
                    <div class="application-header">
                        <div class="applicant-info">
                            <div class="applicant-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="applicant-details">
                                <h3 class="applicant-name">{{ $application->applicant->name }}</h3>
                                <p class="applicant-email">{{ $application->applicant->email }}</p>
                            </div>
                        </div>
                        {{-- <span class="status-badge status-{{ $application->status }}">{{ $application->getStatusText() }}</span> --}}
                    </div>
                    
                    <div class="job-info">
                        <h4 class="job-title">{{ $application->job->title }}</h4>
                        <div class="job-meta">
                            <span class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $application->job->location }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock"></i>
                                {{ $application->job->type }}
                            </span>
                        </div>
                    </div>

                    <div class="application-content">
                        <p class="cover-letter">{{ Str::limit($application->cover_letter, 200) }}</p>
                    </div>

                    <div class="application-meta">
                        <span class="meta-item">
                            <i class="fas fa-calendar"></i>
                            {{ $application->applied_at->format('Y-m-d') }}
                        </span>
                        @if($application->resume_path)
                            <span class="meta-item">
                                <i class="fas fa-file-pdf"></i>
                                <a href="{{ Storage::url($application->resume_path) }}" target="_blank">السيرة الذاتية</a>
                            </span>
                        @endif
                    </div>

                    <div class="application-footer">
                        <div class="application-actions">
                            <button class="btn btn-sm btn-outline" onclick="viewApplication({{ $application->id }})">عرض</button>
                            <button class="btn btn-sm btn-primary" onclick="updateStatus({{ $application->id }})">تحديث الحالة</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-file-alt empty-icon"></i>
                    <p class="empty-text">لا توجد طلبات تقديم حالياً</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($applications->hasPages())
            <div class="pagination-wrapper">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>تحديث حالة الطلب</h3>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form id="statusForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="status">الحالة الجديدة</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending">قيد المراجعة</option>
                        <option value="reviewed">تمت المراجعة</option>
                        <option value="shortlisted">في القائمة المختصرة</option>
                        <option value="interviewed">تمت المقابلة</option>
                        <option value="accepted">مقبول</option>
                        <option value="rejected">مرفوض</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notes">ملاحظات</label>
                    <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="أضف ملاحظاتك هنا..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <button type="button" class="btn btn-outline" onclick="closeModal()">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.company-applications-page {
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

.applications-section {
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
    gap: 0.5rem;
    flex-wrap: wrap;
}

.applications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
    gap: 1.5rem;
}

.application-card {
    border: 1px solid var(--grey-200);
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    background: white;
}

.application-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.application-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.applicant-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.applicant-avatar {
    width: 50px;
    height: 50px;
    background: var(--primary-green);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.applicant-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--grey-800);
    margin: 0 0 0.25rem 0;
}

.applicant-email {
    color: var(--grey-600);
    margin: 0;
    font-size: 0.9rem;
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

.job-info {
    margin-bottom: 1rem;
    padding: 1rem;
    background: var(--grey-50);
    border-radius: 8px;
}

.job-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--grey-800);
    margin: 0 0 0.5rem 0;
}

.job-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--grey-600);
    font-size: 0.9rem;
}

.application-content {
    margin-bottom: 1rem;
}

.cover-letter {
    color: var(--grey-600);
    line-height: 1.6;
    margin: 0;
}

.application-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.application-footer {
    display: flex;
    justify-content: flex-end;
}

.application-actions {
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

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--grey-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    color: var(--grey-800);
}

.close {
    color: var(--grey-400);
    font-size: 1.5rem;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: var(--grey-600);
}

.modal-body {
    padding: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--grey-700);
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--grey-300);
    border-radius: 8px;
    font-size: 1rem;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-green);
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

@media (max-width: 768px) {
    .company-applications-page {
        padding: 1rem;
    }
    
    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .applications-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .section-actions {
        justify-content: center;
    }
}
</style>

<script>
function updateStatus(applicationId) {
    const modal = document.getElementById('statusModal');
    const form = document.getElementById('statusForm');
    const action = `/applications/${applicationId}/status`;
    
    form.action = action;
    modal.style.display = 'block';
}

function closeModal() {
    const modal = document.getElementById('statusModal');
    modal.style.display = 'none';
}

function viewApplication(applicationId) {
    window.location.href = `/applications/${applicationId}`;
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('statusModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Close modal when clicking close button
document.querySelector('.close').onclick = function() {
    closeModal();
}
</script>
@endsection
