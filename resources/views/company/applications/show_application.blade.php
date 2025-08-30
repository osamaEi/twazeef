@extends('dashboard.index')

@section('title', 'تفاصيل المتقدم: ' . $application->applicant->name)

@section('content')
<!-- CSRF Token for AJAX requests -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">تفاصيل المتقدم</h1>
        <p class="page-subtitle">{{ $application->applicant->name }}</p>
        <div class="job-meta">
            <span class="meta-item">
                <i class="fas fa-briefcase"></i>
                {{ $job->title }}
            </span>
            <span class="meta-item">
                <i class="fas fa-building"></i>
                {{ $job->company->name }}
            </span>
            <span class="meta-item">
                <i class="fas fa-calendar-alt"></i>
                تم التقديم {{ $application->created_at->format('Y/m/d') }}
            </span>
        </div>
    </div>
    
    <div class="header-actions">
        <a href="{{ route('jobs.applications.index', $job) }}" class="btn btn-outline">
            <i class="fas fa-arrow-right"></i>
            العودة للتقدمات
        </a>
    </div>
</div>

<div class="application-details-container">
    <!-- Applicant Information -->
    <div class="applicant-section">
        <div class="section-header">
            <h2><i class="fas fa-user"></i> معلومات المتقدم</h2>
        </div>
        
        <div class="applicant-card">
            <div class="applicant-avatar-large">
                <i class="fas fa-user"></i>
            </div>
            
            <div class="applicant-info-detailed">
                <div class="info-row">
                    <div class="info-group">
                        <label>الاسم:</label>
                        <span>{{ $application->applicant->name }}</span>
                    </div>
                    <div class="info-group">
                        <label>البريد الإلكتروني:</label>
                        <span>{{ $application->applicant->email }}</span>
                    </div>
                </div>
                
                @if($application->applicant->phone)
                <div class="info-row">
                    <div class="info-group">
                        <label>رقم الهاتف:</label>
                        <span>{{ $application->applicant->phone }}</span>
                    </div>
                </div>
                @endif
                
                @if($application->applicant->location)
                <div class="info-row">
                    <div class="info-group">
                        <label>الموقع:</label>
                        <span>{{ $application->applicant->location }}</span>
                    </div>
                </div>
                @endif
                
                @if($application->applicant->experience_years)
                <div class="info-row">
                    <div class="info-group">
                        <label>سنوات الخبرة:</label>
                        <span>{{ $application->applicant->experience_years }} سنوات</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Application Status -->
    <div class="status-section">
        <div class="section-header">
            <h2><i class="fas fa-info-circle"></i> حالة التقديم</h2>
        </div>
        
        <div class="status-card">
            <div class="current-status">
                <label>الحالة الحالية:</label>
                <span class="status-badge status-{{ $application->status }}">
                    @switch($application->status)
                        @case('pending')
                            في الانتظار
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
            
            <div class="status-actions">
                <h3>تغيير الحالة:</h3>
                <div class="status-buttons">
                    @if($application->status === 'pending')
                        <button class="btn btn-success" onclick="updateStatus('{{ $application->id }}', 'shortlisted')">
                            <i class="fas fa-star"></i>
                            إضافة للقائمة المختصرة
                        </button>
                        <button class="btn btn-danger" onclick="updateStatus('{{ $application->id }}', 'rejected')">
                            <i class="fas fa-times"></i>
                            رفض
                        </button>
                    @elseif($application->status === 'shortlisted')
                        <button class="btn btn-info" onclick="updateStatus('{{ $application->id }}', 'interviewed')">
                            <i class="fas fa-handshake"></i>
                            جدولة مقابلة
                        </button>
                        <button class="btn btn-warning" onclick="updateStatus('{{ $application->id }}', 'pending')">
                            <i class="fas fa-undo"></i>
                            إعادة للانتظار
                        </button>
                    @elseif($application->status === 'interviewed')
                        <button class="btn btn-success" onclick="updateStatus('{{ $application->id }}', 'accepted')">
                            <i class="fas fa-check"></i>
                            قبول
                        </button>
                        <button class="btn btn-danger" onclick="updateStatus('{{ $application->id }}', 'rejected')">
                            <i class="fas fa-times"></i>
                            رفض
                        </button>
                        <button class="btn btn-warning" onclick="updateStatus('{{ $application->id }}', 'shortlisted')">
                            <i class="fas fa-undo"></i>
                            إعادة للقائمة المختصرة
                        </button>
                    @elseif($application->status === 'accepted')
                        <button class="btn btn-warning" onclick="updateStatus('{{ $application->id }}', 'interviewed')">
                            <i class="fas fa-undo"></i>
                            إعادة للمقابلة
                        </button>
                        <button class="btn btn-danger" onclick="updateStatus('{{ $application->id }}', 'rejected')">
                            <i class="fas fa-times"></i>
                            رفض
                        </button>
                    @elseif($application->status === 'rejected')
                        <button class="btn btn-warning" onclick="updateStatus('{{ $application->id }}', 'pending')">
                            <i class="fas fa-undo"></i>
                            إعادة للانتظار
                        </button>
                        <button class="btn btn-info" onclick="updateStatus('{{ $application->id }}', 'shortlisted')">
                            <i class="fas fa-star"></i>
                            إضافة للقائمة المختصرة
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Cover Letter -->
    @if($application->cover_letter)
    <div class="cover-letter-section">
        <div class="section-header">
            <h2><i class="fas fa-envelope"></i> رسالة التقديم</h2>
        </div>
        
        <div class="cover-letter-card">
            <div class="cover-letter-content">
                {!! nl2br(e($application->cover_letter)) !!}
            </div>
        </div>
    </div>
    @endif

    <!-- Skills -->
    @if($application->applicant->skills && count($application->applicant->skills) > 0)
    <div class="skills-section">
        <div class="section-header">
            <h2><i class="fas fa-tools"></i> المهارات</h2>
        </div>
        
        <div class="skills-card">
            <div class="skills-tags">
                @foreach($application->applicant->skills as $skill)
                    <span class="skill-tag">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Resume -->
    @if($application->resume_path)
    <div class="resume-section">
        <div class="section-header">
            <h2><i class="fas fa-file-pdf"></i> السيرة الذاتية</h2>
        </div>
        
        <div class="resume-card">
            <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="btn btn-primary">
                <i class="fas fa-download"></i>
                تحميل السيرة الذاتية
            </a>
        </div>
    </div>
    @endif

    <!-- Application Timeline -->
    <div class="timeline-section">
        <div class="section-header">
            <h2><i class="fas fa-history"></i> سجل التقديم</h2>
        </div>
        
        <div class="timeline-card">
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="timeline-content">
                    <h4>تم التقديم</h4>
                    <p>{{ $application->created_at->format('Y/m/d H:i') }}</p>
                </div>
            </div>
            
            @if($application->status !== 'pending')
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="timeline-content">
                    <h4>تمت المراجعة</h4>
                    <p>{{ $application->updated_at->format('Y/m/d H:i') }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>



<style>
.page-header {
    background: var(--gradient-primary);
    border-radius: var(--border-radius-lg);
    padding: 3rem 2rem;
    margin-bottom: 2rem;
    color: var(--pure-white);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.header-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.header-content p {
    font-size: 1.3rem;
    opacity: 0.9;
    margin-bottom: 1rem;
}

.job-meta {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    opacity: 0.9;
}

.header-actions .btn {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: var(--pure-white);
}

.header-actions .btn:hover {
    background: rgba(255, 255, 255, 0.3);
}

.application-details-container {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.section-header {
    margin-bottom: 1rem;
}

.section-header h2 {
    color: var(--primary-green);
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.applicant-card {
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
    display: flex;
    gap: 2rem;
    align-items: flex-start;
}

.applicant-avatar-large {
    width: 100px;
    height: 100px;
    background: var(--primary-lightest);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--primary-green);
    flex-shrink: 0;
}

.applicant-info-detailed {
    flex: 1;
}

.info-row {
    display: flex;
    gap: 2rem;
    margin-bottom: 1rem;
}

.info-group {
    flex: 1;
}

.info-group label {
    display: block;
    color: var(--grey-600);
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
    font-weight: 500;
}

.info-group span {
    color: var(--grey-800);
    font-size: 1rem;
    font-weight: 600;
}

.status-card {
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
}

.current-status {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--grey-100);
}

.current-status label {
    color: var(--grey-700);
    font-size: 1.1rem;
    font-weight: 600;
}

.status-badge {
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-shortlisted { background: #d1ecf1; color: #0c5460; }
.status-interviewed { background: #d4edda; color: #155724; }
.status-accepted { background: #d4edda; color: #155724; }
.status-rejected { background: #f8d7da; color: #721c24; }

.status-actions h3 {
    color: var(--grey-700);
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.status-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.cover-letter-card,
.skills-card,
.resume-card,
.timeline-card {
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
}

.cover-letter-content {
    color: var(--grey-700);
    line-height: 1.8;
    font-size: 1rem;
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.skill-tag {
    background: var(--primary-lightest);
    color: var(--primary-green);
    padding: 0.75rem 1.25rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 500;
}

.timeline-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-green);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--pure-white);
    flex-shrink: 0;
}

.timeline-content h4 {
    color: var(--grey-800);
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
}

.timeline-content p {
    color: var(--grey-600);
    margin: 0;
    font-size: 0.9rem;
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
    background: var(--primary-green);
    color: var(--pure-white);
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.btn-success {
    background: var(--success-green);
    color: var(--pure-white);
}

.btn-success:hover {
    background: var(--success-dark);
    transform: translateY(-2px);
}

.btn-danger {
    background: var(--danger-red);
    color: var(--pure-white);
}

.btn-danger:hover {
    background: var(--danger-dark);
    transform: translateY(-2px);
}

.btn-info {
    background: var(--info-blue);
    color: var(--pure-white);
}

.btn-info:hover {
    background: var(--info-dark);
    transform: translateY(-2px);
}

.btn-warning {
    background: #fbbf24;
    color: var(--grey-800);
}

.btn-warning:hover {
    background: #f59e0b;
    transform: translateY(-2px);
}

/* Notification Styles */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    min-width: 300px;
    max-width: 400px;
    animation: slideInRight 0.3s ease-out;
}

.notification-success {
    border-left: 4px solid #10b981;
}

.notification-error {
    border-left: 4px solid #ef4444;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.notification-content i {
    font-size: 1.2rem;
}

.notification-success .notification-content i {
    color: #10b981;
}

.notification-error .notification-content i {
    color: #ef4444;
}

.notification-close {
    background: none;
    border: none;
    color: #6b7280;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.notification-close:hover {
    background: #f3f4f6;
    color: #374151;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Loading spinner */
.fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
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
    
    .job-meta {
        justify-content: center;
    }
    
    .applicant-card {
        flex-direction: column;
        text-align: center;
    }
    
    .info-row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .status-buttons {
        flex-direction: column;
    }
    
    .btn {
        justify-content: center;
    }
}
</style>

<script>
function updateStatus(applicationId, status) {
    if (confirm('هل أنت متأكد من تغيير حالة التقديم؟')) {
        // Show loading state
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحديث...';
        button.disabled = true;

        // Make AJAX request
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
                // Update status badge
                updateStatusBadge(data.new_status, data.status_text);
                
                // Update status actions
                updateStatusActions(data.new_status);
                
                // Update timeline
                updateTimeline(data.updated_at);
                
                // Show success message
                showNotification(data.message, 'success');
            } else {
                showNotification(data.message || 'حدث خطأ أثناء تحديث الحالة', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء تحديث الحالة', 'error');
        })
        .finally(() => {
            // Restore button state
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }
}

function updateStatusBadge(newStatus, statusText) {
    const statusBadge = document.querySelector('.status-badge');
    if (statusBadge) {
        statusBadge.className = `status-badge status-${newStatus}`;
        statusBadge.textContent = statusText;
    }
}

function updateStatusActions(newStatus) {
    const statusActions = document.querySelector('.status-actions');
    if (statusActions) {
        statusActions.innerHTML = generateStatusButtons(newStatus);
    }
}

function generateStatusButtons(status) {
    let buttons = '';
    
    switch(status) {
        case 'pending':
            buttons = `
                <button class="btn btn-success" onclick="updateStatus('{{ $application->id }}', 'shortlisted')">
                    <i class="fas fa-star"></i>
                    إضافة للقائمة المختصرة
                </button>
                <button class="btn btn-danger" onclick="updateStatus('{{ $application->id }}', 'rejected')">
                    <i class="fas fa-times"></i>
                    رفض
                </button>
            `;
            break;
        case 'shortlisted':
            buttons = `
                <button class="btn btn-info" onclick="updateStatus('{{ $application->id }}', 'interviewed')">
                    <i class="fas fa-handshake"></i>
                    جدولة مقابلة
                </button>
                <button class="btn btn-warning" onclick="updateStatus('{{ $application->id }}', 'pending')">
                    <i class="fas fa-undo"></i>
                    إعادة للانتظار
                </button>
            `;
            break;
        case 'interviewed':
            buttons = `
                <button class="btn btn-success" onclick="updateStatus('{{ $application->id }}', 'accepted')">
                    <i class="fas fa-check"></i>
                    قبول
                </button>
                <button class="btn btn-danger" onclick="updateStatus('{{ $application->id }}', 'rejected')">
                    <i class="fas fa-times"></i>
                    رفض
                </button>
                <button class="btn btn-warning" onclick="updateStatus('{{ $application->id }}', 'shortlisted')">
                    <i class="fas fa-undo"></i>
                    إعادة للقائمة المختصرة
                </button>
            `;
            break;
        case 'accepted':
            buttons = `
                <button class="btn btn-warning" onclick="updateStatus('{{ $application->id }}', 'interviewed')">
                    <i class="fas fa-undo"></i>
                    إعادة للمقابلة
                </button>
                <button class="btn btn-danger" onclick="updateStatus('{{ $application->id }}', 'rejected')">
                    <i class="fas fa-times"></i>
                    رفض
                </button>
            `;
            break;
        case 'rejected':
            buttons = `
                <button class="btn btn-warning" onclick="updateStatus('{{ $application->id }}', 'pending')">
                    <i class="fas fa-undo"></i>
                    إعادة للانتظار
                </button>
                <button class="btn btn-info" onclick="updateStatus('{{ $application->id }}', 'shortlisted')">
                    <i class="fas fa-star"></i>
                    إضافة للقائمة المختصرة
                </button>
            `;
            break;
    }
    
    return `<h3>تغيير الحالة:</h3><div class="status-buttons">${buttons}</div>`;
}

function updateTimeline(updatedAt) {
    const timelineCard = document.querySelector('.timeline-card');
    if (timelineCard) {
        // Remove existing review timeline item if exists
        const existingReview = timelineCard.querySelector('.timeline-item.review-item');
        if (existingReview) {
            existingReview.remove();
        }
        
        // Add new review timeline item
        const newReviewItem = document.createElement('div');
        newReviewItem.className = 'timeline-item review-item';
        newReviewItem.innerHTML = `
            <div class="timeline-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="timeline-content">
                <h4>تمت المراجعة</h4>
                <p>${updatedAt}</p>
            </div>
        `;
        
        timelineCard.appendChild(newReviewItem);
    }
}

function showNotification(message, type) {
    // Create notification element
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
    
    // Add to page
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}
</script>
@endsection
