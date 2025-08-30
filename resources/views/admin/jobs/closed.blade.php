@extends('dashboard.index')

@section('title', 'الوظائف المغلقة')

@section('content')
<div class="admin-jobs-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">الوظائف المغلقة</h1>
            <p class="page-subtitle">عرض الوظائف المغلقة نهائياً في المنصة</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" placeholder="البحث في الوظائف المغلقة..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="filter-dropdown">
                <select class="filter-select">
                    <option value="">جميع أسباب الإغلاق</option>
                    <option value="filled">تم شغل الوظيفة</option>
                    <option value="expired">انتهت الصلاحية</option>
                    <option value="company-request">طلب من الشركة</option>
                    <option value="admin-close">إغلاق من الإدارة</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon closed">
                <i class="fas fa-archive"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">10</h3>
                <p class="stat-label">الوظائف المغلقة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon filled">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">6</h3>
                <p class="stat-label">تم شغل الوظيفة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon expired">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">3</h3>
                <p class="stat-label">انتهت الصلاحية</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon total-applicants">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">156</h3>
                <p class="stat-label">إجمالي المتقدمين</p>
            </div>
        </div>
    </div>

    <!-- Closed Jobs Table -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">الوظائف المغلقة</h3>
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
                        <th>الوظيفة</th>
                        <th>الشركة</th>
                        <th>سبب الإغلاق</th>
                        <th>تاريخ الإغلاق</th>
                        <th>عدد المتقدمين</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 10; $i++)
                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox">
                        </td>
                        <td>
                            <div class="job-info">
                                <h4 class="job-title">مطور ويب متقدم</h4>
                                <p class="job-location">الرياض، المملكة العربية السعودية</p>
                                <span class="job-category">تقنية المعلومات</span>
                            </div>
                        </td>
                        <td>
                            <div class="company-info">
                                <img src="{{ asset('assets/company-logo.png') }}" alt="Company Logo" class="company-logo">
                                <span class="company-name">شركة التقنية المتقدمة</span>
                            </div>
                        </td>
                        <td>
                            <span class="close-reason filled">تم شغل الوظيفة</span>
                        </td>
                        <td>
                            <span class="close-date">2024/01/05</span>
                        </td>
                        <td>
                            <span class="applicants-count">32</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.jobs.show', 1) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-warning" onclick="restoreJob(1)">
                                    <i class="fas fa-undo"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteJob(1)">
                                    <i class="fas fa-trash"></i>
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
                <span>عرض 1-10 من 10 نتيجة</span>
            </div>
            <div class="pagination">
                <a href="#" class="page-link active">1</a>
            </div>
        </div>
    </div>
</div>

<script>
function restoreJob(jobId) {
    if (confirm('هل أنت متأكد من استعادة هذه الوظيفة؟')) {
        // Send AJAX request to restore job
        console.log('Restoring job:', jobId);
    }
}

function deleteJob(jobId) {
    if (confirm('هل أنت متأكد من حذف هذه الوظيفة نهائياً؟ هذا الإجراء لا يمكن التراجع عنه.')) {
        // Send AJAX request to delete job
        console.log('Deleting job:', jobId);
    }
}
</script>
@endsection
