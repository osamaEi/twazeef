@extends('dashboard.index')

@section('title', 'الطلبات قيد المراجعة')

@section('content')
<div class="admin-applicants-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">الطلبات قيد المراجعة</h1>
            <p class="page-subtitle">عرض وإدارة الطلبات التي تحتاج إلى مراجعة</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" placeholder="البحث في الطلبات..." class="search-input">
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
            <div class="stat-icon under-review">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">45</h3>
                <p class="stat-label">قيد المراجعة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">23</h3>
                <p class="stat-label">في انتظار المراجعة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon reviewing">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">12</h3>
                <p class="stat-label">قيد المراجعة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon avg-time">
                <i class="fas fa-stopwatch"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">2.3</h3>
                <p class="stat-label">متوسط وقت المراجعة (أيام)</p>
            </div>
        </div>
    </div>

    <!-- Priority Queue -->
    <div class="priority-queue-section">
        <div class="section-header">
            <h3>قائمة الأولوية</h3>
            <p>الطلبات التي تحتاج إلى مراجعة عاجلة</p>
        </div>
        <div class="priority-cards">
            @for($i = 1; $i <= 3; $i++)
            <div class="priority-card urgent">
                <div class="priority-badge">عاجل</div>
                <div class="applicant-info">
                    <div class="applicant-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="applicant-details">
                        <h4 class="applicant-name">أحمد محمد علي</h4>
                        <p class="applicant-title">مطور ويب متقدم</p>
                        <p class="company-name">شركة التقنية المتقدمة</p>
                    </div>
                </div>
                <div class="priority-info">
                    <span class="waiting-time">في الانتظار منذ 3 أيام</span>
                    <div class="priority-actions">
                        <button class="btn btn-sm btn-success" onclick="approveApplication({{ $i }})">
                            <i class="fas fa-check"></i>
                            قبول
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="rejectApplication({{ $i }})">
                            <i class="fas fa-times"></i>
                            رفض
                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Under Review Applications Table -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">الطلبات قيد المراجعة</h3>
            <div class="card-actions">
                <button class="btn btn-secondary">
                    <i class="fas fa-download"></i>
                    تصدير
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
                        <th>تاريخ التقديم</th>
                        <th>وقت الانتظار</th>
                        <th>أولوية المراجعة</th>
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
                            <span class="date">2024/01/20</span>
                        </td>
                        <td>
                            <span class="waiting-time {{ $i <= 3 ? 'urgent' : 'normal' }}">
                                {{ $i <= 3 ? '3 أيام' : '1 يوم' }}
                            </span>
                        </td>
                        <td>
                            <span class="priority-badge {{ $i <= 3 ? 'high' : 'normal' }}">
                                {{ $i <= 3 ? 'عالية' : 'عادية' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.applicants.show', $i) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-success" onclick="approveApplication({{ $i }})">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="rejectApplication({{ $i }})">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" onclick="requestMoreInfo({{ $i }})">
                                    <i class="fas fa-question"></i>
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
                <span>عرض 1-10 من 45 نتيجة</span>
            </div>
            <div class="pagination">
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link">4</a>
                <a href="#" class="page-link">5</a>
            </div>
        </div>
    </div>
</div>

<script>
// Priority queue functionality
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
function approveApplication(id) {
    if (confirm('هل أنت متأكد من قبول هذا الطلب؟')) {
        // Send AJAX request to approve application
        console.log('Approving application:', id);
        // Update UI to show approved status
        updateApplicationStatus(id, 'approved');
    }
}

function rejectApplication(id) {
    if (confirm('هل أنت متأكد من رفض هذا الطلب؟')) {
        // Send AJAX request to reject application
        console.log('Rejecting application:', id);
        // Update UI to show rejected status
        updateApplicationStatus(id, 'rejected');
    }
}

function requestMoreInfo(id) {
    const info = prompt('أي معلومات إضافية تحتاجها من المتقدم؟');
    if (info) {
        // Send AJAX request to request more info
        console.log('Requesting more info for application:', id, 'Info:', info);
        alert('تم إرسال طلب المعلومات الإضافية بنجاح');
    }
}

function updateApplicationStatus(id, status) {
    // This function would update the UI after status change
    const row = document.querySelector(`tr[data-id="${id}"]`);
    if (row) {
        // Update status badge and remove from table
        row.remove();
        // Update stats
        updateStats();
    }
}

function updateStats() {
    // Update the stats cards after status changes
    const underReviewCount = document.querySelectorAll('.status-badge.under-review').length;
    // Update the stats display
    console.log('Updated under review count:', underReviewCount);
}
</script>
@endsection
