@extends('dashboard.index')

@section('title', 'الطلبات المقبولة')

@section('content')
<div class="admin-applicants-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">الطلبات المقبولة</h1>
            <p class="page-subtitle">عرض وإدارة الطلبات المقبولة في المنصة</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" placeholder="البحث في الطلبات المقبولة..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="filter-dropdown">
                <select class="filter-select">
                    <option value="">جميع الوظائف</option>
                    <option value="1">مطور ويب متقدم</option>
                    <option value="2">مصمم جرافيك</option>
                    <option value="3">مدير تسويق</option>
                </select>
            </div>
            <div class="filter-dropdown">
                <select class="filter-select">
                    <option value="">جميع الشركات</option>
                    <option value="1">شركة التقنية المتقدمة</option>
                    <option value="2">شركة البرمجيات الحديثة</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon approved">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">89</h3>
                <p class="stat-label">إجمالي المقبولين</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon this-month">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">23</h3>
                <p class="stat-label">مقبول هذا الشهر</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon this-week">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">7</h3>
                <p class="stat-label">مقبول هذا الأسبوع</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon avg-time">
                <i class="fas fa-stopwatch"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">1.8</h3>
                <p class="stat-label">متوسط وقت المراجعة (أيام)</p>
            </div>
        </div>
    </div>

    <!-- Success Metrics -->
    <div class="success-metrics-section">
        <div class="section-header">
            <h3>مؤشرات النجاح</h3>
            <p>إحصائيات حول الطلبات المقبولة</p>
        </div>
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="metric-content">
                    <h4 class="metric-number">78%</h4>
                    <p class="metric-label">معدل القبول</p>
                    <span class="metric-change positive">+5%</span>
                </div>
            </div>
            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="metric-content">
                    <h4 class="metric-number">45</h4>
                    <p class="metric-label">متقدم جديد</p>
                    <span class="metric-change positive">+12</span>
                </div>
            </div>
            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="metric-content">
                    <h4 class="metric-number">12</h4>
                    <p class="metric-label">شركة نشطة</p>
                    <span class="metric-change positive">+2</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Approved Applications Table -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">الطلبات المقبولة</h3>
            <div class="card-actions">
                <button class="btn btn-secondary">
                    <i class="fas fa-download"></i>
                    تصدير
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-envelope"></i>
                    إرسال إشعارات
                </button>
            </div>
        </div>
        
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="select-all-checkbox">
                        </th>
                        <th>المتقدم</th>
                        <th>الوظيفة</th>
                        <th>الشركة</th>
                        <th>تاريخ القبول</th>
                        <th>وقت المراجعة</th>
                        <th>الحالة الحالية</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 10; $i++)
                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $i }}">
                        </td>
                        <td>
                            <div class="applicant-info">
                                <div class="applicant-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="applicant-details">
                                    <h4 class="applicant-name">أحمد محمد علي</h4>
                                    <p class="applicant-email">ahmed@example.com</p>
                                    <p class="applicant-phone">+966 50 123 4567</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="job-info">
                                <h4 class="job-title">مطور ويب متقدم</h4>
                                <span class="job-location">الرياض</span>
                            </div>
                        </td>
                        <td>
                            <div class="company-info">
                                <img src="{{ asset('assets/company-logo.png') }}" alt="Company Logo" class="company-logo">
                                <span class="company-name">شركة التقنية المتقدمة</span>
                            </div>
                        </td>
                        <td>
                            <span class="date">2024/01/22</span>
                        </td>
                        <td>
                            <span class="review-time">2 أيام</span>
                        </td>
                        <td>
                            <span class="status-badge approved">مقبول</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.applicants.show', $i) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-success" onclick="sendNotification({{ $i }})">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" onclick="scheduleInterview({{ $i }})">
                                    <i class="fas fa-calendar"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="revokeApproval({{ $i }})">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <div class="pagination-info">
                <span>عرض 1-10 من 89 نتيجة</span>
            </div>
            <div class="pagination">
                <a href="#" class="page-link prev">
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link">4</a>
                <a href="#" class="page-link">5</a>
                <a href="#" class="page-link next">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Bulk selection functionality
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.querySelector('.select-all-checkbox');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    
    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
});

// Application actions
function sendNotification(id) {
    if (confirm('هل تريد إرسال إشعار للمتقدم بقبول طلبه؟')) {
        // Send AJAX request to send notification
        console.log('Sending notification for application:', id);
        alert('تم إرسال الإشعار بنجاح');
    }
}

function scheduleInterview(id) {
    const interviewDate = prompt('أدخل موعد المقابلة (YYYY-MM-DD HH:MM):');
    if (interviewDate) {
        // Send AJAX request to schedule interview
        console.log('Scheduling interview for application:', id, 'Date:', interviewDate);
        alert('تم تحديد موعد المقابلة بنجاح');
    }
}

function revokeApproval(id) {
    if (confirm('هل أنت متأكد من إلغاء قبول هذا الطلب؟ سيتم إعادته إلى قائمة المراجعة.')) {
        // Send AJAX request to revoke approval
        console.log('Revoking approval for application:', id);
        alert('تم إلغاء القبول وإعادة الطلب إلى المراجعة');
        // Update UI to show status change
        updateApplicationStatus(id, 'under-review');
    }
}

function updateApplicationStatus(id, status) {
    // This function would update the UI after status change
    const row = document.querySelector(`tr[data-id="${id}"]`);
    if (row) {
        // Update status badge
        const statusBadge = row.querySelector('.status-badge');
        if (statusBadge) {
            statusBadge.className = `status-badge ${status}`;
            statusBadge.textContent = status === 'under-review' ? 'قيد المراجعة' : 'مقبول';
        }
        // Update stats
        updateStats();
    }
}

function updateStats() {
    // Update the stats cards after status changes
    const approvedCount = document.querySelectorAll('.status-badge.approved').length;
    // Update the stats display
    console.log('Updated approved count:', approvedCount);
}
</script>
@endsection
