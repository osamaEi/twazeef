@extends('dashboard.index')

@section('content')
    {{-- ========================================
         STATISTICS CARDS SECTION
         ======================================== --}}
    <div class="stats-grid">
        {{-- Total Users Card --}}
        <div class="stat-card stat-primary">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total_users'] }}</h3>
                <p class="stat-label">إجمالي المستخدمين</p>
            </div>
        </div>
        
        {{-- Total Jobs Card --}}
        <div class="stat-card stat-success">
            <div class="stat-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total_jobs'] }}</h3>
                <p class="stat-label">إجمالي الوظائف</p>
            </div>
        </div>
        
        {{-- Active Jobs Card --}}
        <div class="stat-card stat-warning">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['active_jobs'] }}</h3>
                <p class="stat-label">الوظائف النشطة</p>
            </div>
        </div>
        
        {{-- Total Applications Card --}}
        <div class="stat-card stat-info">
            <div class="stat-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['total_applications'] }}</h3>
                <p class="stat-label">إجمالي الطلبات</p>
            </div>
        </div>
        
        {{-- Pending Applications Card --}}
        <div class="stat-card stat-danger">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $stats['pending_applications'] }}</h3>
                <p class="stat-label">الطلبات المعلقة</p>
            </div>
        </div>
    </div>

    {{-- ========================================
         DASHBOARD SECTIONS
         ======================================== --}}

@endsection
