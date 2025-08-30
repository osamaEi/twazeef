@extends('dashboard.index')

@section('title', 'الطلبات المرفوضة')

@section('content')
<div class="admin-applicants-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">الطلبات المرفوضة</h1>
            <p class="page-subtitle">عرض وإدارة الطلبات المرفوضة في المنصة</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" placeholder="البحث في الطلبات المرفوضة..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="filter-dropdown">
                <select class="filter-select">
                    <option value="">جميع أسباب الرفض</option>
                    <option value="qualifications">عدم توفر المؤهلات</option>
                    <option value="experience">قلة الخبرة</option>
                    <option value="salary">عدم توافق الراتب</option>
                    <option value="other">أسباب أخرى</option>
                </select>
            </div>
            <div class="filter-dropdown">
                <select class="filter-select">
                    <option value="">جميع الوظائف</option>
                    <option value="1">مطور ويب متقدم</option>
                    <option value="2">مصمم جرافيك</option>
                    <option value="3">مدير تسويق</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon rejected">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">23</h3>
                <p class="stat-label">إجمالي المرفوضين</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-times"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">8</h3>
                <p class="stat-label">مرفوض هذا الشهر</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">12.5%</h3>
                <p class="stat-label">معدل الرفض</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">2.1</h3>
                <p class="stat-label">متوسط وقت المراجعة (أيام)</p>
            </div>
        </div>
    </div>

    <!-- Rejection Analysis -->
    <div class="success-metrics-section">
        <div class="section-header">
            <h3>تحليل أسباب الرفض</h3>
            <p>إحصائيات مفصلة حول أسباب رفض الطلبات</p>
        </div>
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-icon" style="background: linear-gradient(135deg, #f44336, #ef5350);">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="metric-number">12</div>
                <div class="metric-label">عدم توفر المؤهلات</div>
                <span class="metric-change positive">52%</span>
            </div>
            <div class="metric-card">
                <div class="metric-icon" style="background: linear-gradient(135deg, #ff9800, #ffa726);">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="metric-number">6</div>
                <div class="metric-label">قلة الخبرة</div>
                <span class="metric-change positive">26%</span>
            </div>
            <div class="metric-card">
                <div class="metric-icon" style="background: linear-gradient(135deg, #9c27b0, #ab47bc);">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="metric-number">3</div>
                <div class="metric-label">عدم توافق الراتب</div>
                <span class="metric-change positive">13%</span>
            </div>
            <div class="metric-card">
                <div class="metric-icon" style="background: linear-gradient(135deg, #607d8b, #78909c);">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <div class="metric-number">2</div>
                <div class="metric-label">أسباب أخرى</div>
                <span class="metric-change positive">9%</span>
            </div>
        </div>
    </div>

    <!-- Rejected Applications Table -->
    <div class="content-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-times-circle"></i>
                الطلبات المرفوضة
            </h3>
            <div class="card-actions">
                <button class="btn btn-secondary">
                    <i class="fas fa-download"></i>
                    تصدير
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-chart-bar"></i>
                    تقرير مفصل
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
                        <th>سبب الرفض</th>
                        <th>تاريخ الرفض</th>
                        <th>المراجع</th>
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
                                    @if($i % 3 == 0)
                                        ف.أ
                                    @elseif($i % 3 == 1)
                                        م.ع
                                    @else
                                        أ.س
                                    @endif
                                </div>
                                <div class="applicant-details">
                                    <h4 class="applicant-name">
                                        @if($i % 3 == 0)
                                            فاطمة أحمد سالم
                                        @elseif($i % 3 == 1)
                                            محمد عبدالله علي
                                        @else
                                            أحمد سالم محمد
                                        @endif
                                    </h4>
                                    <p class="applicant-email">
                                        @if($i % 3 == 0)
                                            fatima@example.com
                                        @elseif($i % 3 == 1)
                                            mohammed@example.com
                                        @else
                                            ahmed@example.com
                                        @endif
                                    </p>
                                    <p class="applicant-phone">+966 50 123 4567</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="job-info">
                                <h4 class="job-title">
                                    @if($i % 3 == 0)
                                        مديرة موارد بشرية
                                    @elseif($i % 3 == 1)
                                        مطور ويب متقدم
                                    @else
                                        محاسب مالي
                                    @endif
                                </h4>
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
                            @if($i % 3 == 0)
                                <span class="status-badge" style="background: linear-gradient(135deg, #f44336, #ef5350);">عدم توفر المؤهلات</span>
                            @elseif($i % 3 == 1)
                                <span class="status-badge" style="background: linear-gradient(135deg, #ff9800, #ffa726);">قلة الخبرة</span>
                            @else
                                <span class="status-badge" style="background: linear-gradient(135deg, #9c27b0, #ab47bc);">عدم توافق الراتب</span>
                            @endif
                        </td>
                        <td>
                            <span class="date">2024/01/{{ 15 + $i }}</span>
                        </td>
                        <td>
                            <span class="applicant-name">أ. سارة أحمد</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.applicants.show', $i) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-sm btn-warning" onclick="reconsiderApplication({{ $i }})">
                                    <i class="fas fa-undo"></i>
                                </button>
                                <button class="btn btn-sm btn-success" onclick="addToCandidates({{ $i }})">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-secondary" onclick="exportApplication({{ $i }})">
                                    <i class="fas fa-download"></i>
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
                <span>عرض 1-10 من 23 نتيجة</span>
            </div>
            <div class="pagination">
                <a href="#" class="page-link prev">
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
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
function reconsiderApplication(id) {
    if (confirm('هل تريد إعادة النظر في هذا الطلب؟ سيتم إعادته إلى قائمة المراجعة.')) {
        // Send AJAX request to reconsider application
        console.log('Reconsidering application:', id);
        alert('تم إعادة الطلب إلى قائمة المراجعة بنجاح');
        // Update UI to show status change
        updateApplicationStatus(id, 'under-review');
    }
}

function addToCandidates(id) {
    if (confirm('هل تريد إضافة هذا المتقدم إلى قاعدة بيانات المرشحين؟')) {
        // Send AJAX request to add to candidates
        console.log('Adding to candidates:', id);
        alert('تم إضافة المتقدم إلى قاعدة البيانات بنجاح');
    }
}

function exportApplication(id) {
    // Export application data
    console.log('Exporting application:', id);
    alert('تم تصدير بيانات الطلب بنجاح');
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
    const rejectedCount = document.querySelectorAll('.status-badge').length;
    // Update the stats display
    console.log('Updated rejected count:', rejectedCount);
}
</script>
@endsection
