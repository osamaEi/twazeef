@extends('dashboard.index')

@section('title', 'نظرة عامة على التقارير')

@section('content')
<div class="company-reports-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">نظرة عامة على التقارير</h1>
            <p class="page-subtitle">إحصائيات شاملة عن نشاط الشركة</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('company.reports.export') }}" class="btn btn-primary">
                <i class="fas fa-download"></i>
                تصدير التقارير
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total_jobs'] }}</h3>
                <p class="stat-label">إجمالي الوظائف</p>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>نشط</span>
                </div>
            </div>
        </div>

        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['active_jobs'] }}</h3>
                <p class="stat-label">الوظائف النشطة</p>
                <div class="stat-change positive">
                    <i class="fas fa-check"></i>
                    <span>مفتوح</span>
                </div>
            </div>
        </div>

        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total_applications'] }}</h3>
                <p class="stat-label">إجمالي الطلبات</p>
                <div class="stat-change positive">
                    <i class="fas fa-users"></i>
                    <span>متقدمين</span>
                </div>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['pending_applications'] }}</h3>
                <p class="stat-label">طلبات قيد المراجعة</p>
                <div class="stat-change warning">
                    <i class="fas fa-clock"></i>
                    <span>بانتظار</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <div class="chart-row">
            <div class="chart-card">
                <div class="chart-header">
                    <h3>توزيع الوظائف حسب الحالة</h3>
                </div>
                <div class="chart-content">
                    <div class="pie-chart">
                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-color active"></span>
                                <span>نشط ({{ $stats['active_jobs'] }})</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color paused"></span>
                                <span>معلق ({{ $stats['total_jobs'] - $stats['active_jobs'] }})</span>
                            </div>
                        </div>
                        <div class="chart-visual">
                            <div class="pie-slice active" style="--percentage: {{ ($stats['active_jobs'] / max($stats['total_jobs'], 1)) * 100 }}%"></div>
                            <div class="pie-slice paused" style="--percentage: {{ (($stats['total_jobs'] - $stats['active_jobs']) / max($stats['total_jobs'], 1)) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h3>توزيع الطلبات حسب الحالة</h3>
                </div>
                <div class="chart-content">
                    <div class="bar-chart">
                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-color pending"></span>
                                <span>قيد المراجعة</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color shortlisted"></span>
                                <span>القائمة المختصرة</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color accepted"></span>
                                <span>مقبول</span>
                            </div>
                        </div>
                        <div class="chart-visual">
                            <div class="bar-container">
                                <div class="bar pending" style="height: {{ ($stats['pending_applications'] / max($stats['total_applications'], 1)) * 200 }}px"></div>
                                <span class="bar-label">{{ $stats['pending_applications'] }}</span>
                            </div>
                            <div class="bar-container">
                                <div class="bar shortlisted" style="height: {{ (($stats['total_applications'] - $stats['pending_applications']) / max($stats['total_applications'], 1)) * 200 }}px"></div>
                                <span class="bar-label">{{ $stats['total_applications'] - $stats['pending_applications'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div class="section-header">
            <h2>إجراءات سريعة</h2>
        </div>
        <div class="actions-grid">
            <a href="{{ route('company.reports.jobs') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3>تقرير الوظائف</h3>
                <p>عرض تقرير مفصل عن جميع الوظائف</p>
            </a>
            
            <a href="{{ route('company.reports.applications') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>تقرير الطلبات</h3>
                <p>عرض تقرير مفصل عن جميع الطلبات</p>
            </a>
            
            <a href="{{ route('company.candidates.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>قاعدة المرشحين</h3>
                <p>استكشف المرشحين المتقدمين</p>
            </a>
            
            <a href="{{ route('jobs.create') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <h3>إضافة وظيفة جديدة</h3>
                <p>إنشاء وظيفة جديدة لجذب المزيد من المرشحين</p>
            </a>
        </div>
    </div>
</div>

<style>
.company-reports-page {
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

.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-card.primary { border-left: 4px solid var(--primary-green); }
.stat-card.success { border-left: 4px solid #10b981; }
.stat-card.info { border-left: 4px solid #3b82f6; }
.stat-card.warning { border-left: 4px solid #f59e0b; }

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-card.primary .stat-icon { background: var(--primary-green); }
.stat-card.success .stat-icon { background: #10b981; }
.stat-card.info .stat-icon { background: #3b82f6; }
.stat-card.warning .stat-icon { background: #f59e0b; }

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--grey-800);
    margin: 0 0 0.25rem 0;
}

.stat-label {
    color: var(--grey-600);
    margin: 0 0 0.5rem 0;
    font-size: 0.9rem;
}

.stat-change {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    font-weight: 500;
}

.stat-change.positive { color: #10b981; }
.stat-change.warning { color: #f59e0b; }

.charts-section {
    margin-bottom: 2rem;
}

.chart-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}

.chart-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.chart-header h3 {
    margin: 0 0 1rem 0;
    color: var(--grey-800);
    font-size: 1.2rem;
}

.chart-content {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.chart-legend {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--grey-700);
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 50%;
}

.legend-color.active { background: var(--primary-green); }
.legend-color.paused { background: #f59e0b; }
.legend-color.pending { background: #f59e0b; }
.legend-color.shortlisted { background: #10b981; }
.legend-color.accepted { background: #10b981; }

.chart-visual {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.pie-chart {
    position: relative;
    width: 120px;
    height: 120px;
}

.pie-slice {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    clip-path: polygon(50% 50%, 50% 0%, 100% 0%, 100% 100%, 0% 100%, 0% 0%, 50% 0%);
}

.pie-slice.active {
    background: conic-gradient(var(--primary-green) 0deg calc(var(--percentage) * 3.6deg), transparent calc(var(--percentage) * 3.6deg) 360deg);
}

.pie-slice.paused {
    background: conic-gradient(#f59e0b) calc(var(--percentage) * 3.6deg) 360deg, transparent 0deg calc(var(--percentage) * 3.6deg);
}

.bar-chart {
    display: flex;
    align-items: flex-end;
    gap: 2rem;
    height: 200px;
}

.bar-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.bar {
    width: 40px;
    border-radius: 4px 4px 0 0;
    transition: height 0.3s ease;
}

.bar.pending { background: #f59e0b; }
.bar.shortlisted { background: #10b981; }
.bar.accepted { background: var(--primary-green); }

.bar-label {
    font-size: 0.8rem;
    color: var(--grey-600);
    font-weight: 500;
}

.quick-actions {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.section-header h2 {
    margin: 0 0 1.5rem 0;
    color: var(--grey-800);
    font-size: 1.5rem;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.action-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 2rem 1.5rem;
    border: 1px solid var(--grey-200);
    border-radius: 12px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.action-card:hover {
    border-color: var(--primary-green);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.action-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-green);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.action-card h3 {
    margin: 0 0 0.5rem 0;
    color: var(--grey-800);
    font-size: 1.1rem;
}

.action-card p {
    margin: 0;
    color: var(--grey-600);
    font-size: 0.9rem;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .company-reports-page {
        padding: 1rem;
    }
    
    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .stats-overview {
        grid-template-columns: 1fr;
    }
    
    .chart-row {
        grid-template-columns: 1fr;
    }
    
    .chart-content {
        flex-direction: column;
        gap: 1rem;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
