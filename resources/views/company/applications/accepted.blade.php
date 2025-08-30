@extends('layouts.dashboard')

@section('title', 'الطلبات المقبولة')

@section('content')
<div class="dashboard-container">
    @include('dashboard.body.header')
    
    <div class="dashboard-body">
        @include('dashboard.body.side_nav')
        
        <div class="main-content">
            <div class="content-header">
                <h1>الطلبات المقبولة</h1>
                <p>إدارة الطلبات التي تم قبولها بنجاح</p>
            </div>

            <!-- Stats Overview -->
            <div class="stats-overview">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->where('status', 'accepted')->count() }}</h3>
                        <p>إجمالي الطلبات</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->where('status', 'accepted')->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                        <p>هذا الأسبوع</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->where('status', 'accepted')->where('created_at', '>=', now()->subDays(30))->count() }}</h3>
                        <p>هذا الشهر</p>
                    </div>
                </div>
            </div>

            <!-- Applications List -->
            <div class="applications-section">
                <div class="section-header">
                    <h2>الطلبات المقبولة</h2>
                    <div class="header-actions">
                        <button class="btn btn-primary" onclick="exportAccepted()">
                            <i class="fas fa-download"></i>
                            تصدير القائمة
                        </button>
                        <button class="btn btn-success" onclick="sendOfferLetters()">
                            <i class="fas fa-envelope"></i>
                            إرسال خطابات العرض
                        </button>
                    </div>
                </div>

                @php
                    $acceptedApplications = \App\Models\Application::whereHas('job', function($query) { 
                        $query->where('company_id', auth()->id()); 
                    })->where('status', 'accepted')->with(['job', 'applicant'])->latest()->paginate(20);
                @endphp

                @if($acceptedApplications->count() > 0)
                    <div class="applications-grid">
                        @foreach($acceptedApplications as $application)
                            <div class="application-card">
                                <div class="application-header">
                                    <div class="applicant-info">
                                        <div class="applicant-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="applicant-details">
                                            <h4>{{ $application->applicant->name }}</h4>
                                            <p>{{ $application->applicant->email }}</p>
                                            <span class="status-badge status-accepted">
                                                <i class="fas fa-check-circle"></i>
                                                مقبول
                                            </span>
                                        </div>
                                    </div>
                                    <div class="application-date">
                                        <span>{{ $application->created_at->format('Y-m-d') }}</span>
                                    </div>
                                </div>

                                <div class="job-info">
                                    <h5>{{ $application->job->title }}</h5>
                                    <p>{{ $application->job->company_name }}</p>
                                    <div class="job-meta">
                                        <span><i class="fas fa-map-marker-alt"></i> {{ $application->job->location }}</span>
                                        <span><i class="fas fa-clock"></i> {{ $application->job->type }}</span>
                                        <span><i class="fas fa-money-bill-wave"></i> {{ $application->job->salary }}</span>
                                    </div>
                                </div>

                                @if($application->cover_letter)
                                    <div class="cover-letter">
                                        <h6>رسالة التقديم:</h6>
                                        <p>{{ Str::limit($application->cover_letter, 150) }}</p>
                                    </div>
                                @endif

                                @if($application->notes)
                                    <div class="acceptance-notes">
                                        <h6>ملاحظات القبول:</h6>
                                        <p>{{ Str::limit($application->notes, 150) }}</p>
                                    </div>
                                @endif

                                <div class="application-actions">
                                    <button class="btn btn-sm btn-primary" onclick="viewApplication({{ $application->id }})">
                                        <i class="fas fa-eye"></i>
                                        عرض التفاصيل
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="sendOfferLetter({{ $application->id }})">
                                        <i class="fas fa-envelope"></i>
                                        خطاب العرض
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="updateStatus({{ $application->id }}, 'interviewed')">
                                        <i class="fas fa-undo"></i>
                                        إعادة للمقابلة
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="updateStatus({{ $application->id }}, 'rejected')">
                                        <i class="fas fa-times-circle"></i>
                                        رفض
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $acceptedApplications->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>لا توجد طلبات مقبولة</h3>
                        <p>لم يتم قبول أي طلبات بعد</p>
                    </div>
                @endif
            </div>
        </div>
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
            <form id="statusForm">
                <input type="hidden" id="applicationId" name="application_id">
                <div class="form-group">
                    <label for="newStatus">الحالة الجديدة:</label>
                    <select id="newStatus" name="status" class="form-control" required>
                        <option value="interviewed">تمت المقابلة</option>
                        <option value="accepted">مقبول</option>
                        <option value="rejected">مرفوض</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="statusNotes">ملاحظات:</label>
                    <textarea id="statusNotes" name="notes" class="form-control" rows="3" placeholder="أضف ملاحظات حول التغيير..."></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal()">إلغاء</button>
            <button type="button" class="btn btn-primary" onclick="submitStatusUpdate()">تحديث الحالة</button>
        </div>
    </div>
</div>

<script>
function viewApplication(id) {
    // Redirect to application details page
    window.location.href = `/company/applications/${id}`;
}

function updateStatus(id, status) {
    document.getElementById('applicationId').value = id;
    document.getElementById('newStatus').value = status;
    document.getElementById('statusModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('statusModal').style.display = 'none';
}

function submitStatusUpdate() {
    const formData = new FormData(document.getElementById('statusForm'));
    
    fetch('/company/applications/update-status', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            application_id: formData.get('application_id'),
            status: formData.get('status'),
            notes: formData.get('notes')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal();
            location.reload();
        } else {
            alert('حدث خطأ أثناء تحديث الحالة');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء تحديث الحالة');
    });
}

function sendOfferLetter(id) {
    // Send offer letter functionality
    alert('سيتم إضافة ميزة إرسال خطابات العرض قريباً');
}

function sendOfferLetters() {
    // Send offer letters to all accepted applications
    alert('سيتم إضافة ميزة إرسال خطابات العرض لجميع الطلبات المقبولة قريباً');
}

function exportAccepted() {
    // Export functionality
    alert('سيتم إضافة ميزة التصدير قريباً');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('statusModal');
    if (event.target == modal) {
        closeModal();
    }
}

// Close modal when clicking close button
document.querySelector('.close').onclick = closeModal;
</script>
@endsection
