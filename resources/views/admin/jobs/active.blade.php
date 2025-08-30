@extends('dashboard.index')

@section('title', 'الوظائف النشطة')

@section('content')
<div class="admin-jobs-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">الوظائف النشطة</h1>
            <p class="page-subtitle">عرض وإدارة الوظائف النشطة في المنصة</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" placeholder="البحث في الوظائف النشطة..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="filter-dropdown">
                <select class="filter-select">
                    <option value="">جميع التصنيفات</option>
                    <option value="technology">تقنية المعلومات</option>
                    <option value="marketing">التسويق</option>
                    <option value="sales">المبيعات</option>
                    <option value="engineering">الهندسة</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon active">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">67</h3>
                <p class="stat-label">الوظائف النشطة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon applicants">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">1,234</h3>
                <p class="stat-label">إجمالي المتقدمين</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon companies">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">45</h3>
                <p class="stat-label">الشركات الناشرة</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon views">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">8,567</h3>
                <p class="stat-label">إجمالي المشاهدات</p>
            </div>
        </div>
    </div>

    <!-- Active Jobs Table -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">الوظائف النشطة</h3>
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
                        <th>عدد المتقدمين</th>
                        <th>تاريخ النشر</th>
                        <th>تاريخ انتهاء الصلاحية</th>
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
                            <span class="applicants-count">24</span>
                        </td>
                        <td>
                            <span class="date">2024/01/15</span>
                        </td>
                        <td>
                            <span class="expiry-date">2024/02/15</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.jobs.show', 1) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-warning" onclick="pauseJob(1)">
                                    <i class="fas fa-pause"></i>
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
                <span>عرض 1-10 من 67 نتيجة</span>
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
function pauseJob(jobId) {
    if (confirm('هل أنت متأكد من إيقاف هذه الوظيفة مؤقتاً؟')) {
        // Send AJAX request to pause job
        console.log('Pausing job:', jobId);
    }
}

function closeJob(jobId) {
    if (confirm('هل أنت متأكد من إغلاق هذه الوظيفة؟')) {
        // Send AJAX request to close job
        console.log('Closing job:', jobId);
    }
}
</script>
@endsection
