@extends('dashboard.index')

@section('title', 'الوظائف المعلقة')

@section('content')
<div class="admin-jobs-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">الوظائف المعلقة</h1>
            <p class="page-subtitle">عرض وإدارة الوظائف المعلقة مؤقتاً في المنصة</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" placeholder="البحث في الوظائف المعلقة..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="filter-dropdown">
                <select class="filter-select">
                    <option value="">جميع أسباب الإيقاف</option>
                    <option value="company-request">طلب من الشركة</option>
                    <option value="admin-pause">إيقاف من الإدارة</option>
                    <option value="expired">انتهت الصلاحية</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon paused">
                <i class="fas fa-pause-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">12</h3>
                <p class="stat-label">الوظائف المعلقة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon company-request">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">8</h3>
                <p class="stat-label">طلب من الشركة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon admin-pause">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">3</h3>
                <p class="stat-label">إيقاف من الإدارة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon expired">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">1</h3>
                <p class="stat-label">انتهت الصلاحية</p>
            </div>
        </div>
    </div>

    <!-- Paused Jobs Table -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">الوظائف المعلقة</h3>
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
                        <th>سبب الإيقاف</th>
                        <th>تاريخ الإيقاف</th>
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
                            <span class="pause-reason company-request">طلب من الشركة</span>
                        </td>
                        <td>
                            <span class="pause-date">2024/01/10</span>
                        </td>
                        <td>
                            <span class="applicants-count">18</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.jobs.show', 1) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-success" onclick="activateJob(1)">
                                    <i class="fas fa-play"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="closeJob(1)">
                                    <i class="fas fa-times"></i>
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
                <span>عرض 1-10 من 12 نتيجة</span>
            </div>
            <div class="pagination">
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
            </div>
        </div>
    </div>
</div>

<script>
function activateJob(jobId) {
    if (confirm('هل أنت متأكد من إعادة تفعيل هذه الوظيفة؟')) {
        // Send AJAX request to activate job
        console.log('Activating job:', jobId);
    }
}

function closeJob(jobId) {
    if (confirm('هل أنت متأكد من إغلاق هذه الوظيفة نهائياً؟')) {
        // Send AJAX request to close job
        console.log('Closing job:', jobId);
    }
}
</script>
@endsection
