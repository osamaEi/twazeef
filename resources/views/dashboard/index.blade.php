<!DOCTYPE html>
@php $currentLocale = app()->getLocale(); @endphp
<html lang="{{ $currentLocale }}" dir="{{ $currentLocale === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ __('dashboard.meta_description') }}">
    <meta name="author" content="{{ __('dashboard.meta_author') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ __('dashboard.page_title') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>💼</text></svg>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if($currentLocale === 'ar')
        <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @endif
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/profile.css') }}">
    
    <!-- RTL/LTR Specific Styles -->
    <style>
        @if($currentLocale === 'ar')
            /* RTL Styles */
            .dashboard-layout { direction: rtl; }
            .sidebar { right: 0; left: auto; transform: translateX(0); }
            .main-content { margin-right: 280px; margin-left: 0; }
            .top-nav { right: 280px; left: 0; }
            .sidebar-nav .nav-item .nav-link { text-align: right; }
            .sidebar-nav .nav-item .nav-link i { margin-left: 12px; margin-right: 0; }
            .sidebar-nav .nav-item .nav-link .nav-badge { margin-left: auto; margin-right: 0; }
            .sidebar-header .sidebar-logo-text { text-align: right; }
            .entity-badge { text-align: right; }
            @media (max-width: 768px) {
                .main-content { margin-right: 0; }
                .top-nav { right: 0; }
                .sidebar { transform: translateX(100%); }
                .sidebar.active { transform: translateX(0); }
            }
        @else
            /* LTR Styles */
            .dashboard-layout { direction: ltr; }
            .sidebar { left: 0; right: auto; transform: translateX(0); }
            .main-content { margin-left: 280px; margin-right: 0; }
            .top-nav { left: 280px; right: 0; }
            .sidebar-nav .nav-item .nav-link { text-align: left; }
            .sidebar-nav .nav-item .nav-link i { margin-right: 12px; margin-left: 0; }
            .sidebar-nav .nav-item .nav-link .nav-badge { margin-right: auto; margin-left: 0; }
            .sidebar-header .sidebar-logo-text { text-align: left; }
            .entity-badge { text-align: left; }
            @media (max-width: 768px) {
                .main-content { margin-left: 0; }
                .top-nav { left: 0; }
                .sidebar { transform: translateX(-100%); }
                .sidebar.active { transform: translateX(0); }
            }
        @endif
        /* Common Styles */
        .sidebar { position: fixed; top: 0; height: 100vh; width: 280px; background: #fff; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); z-index: 1000; transition: transform 0.3s ease; }
        .main-content { transition: margin 0.3s ease; }
        .top-nav { position: fixed; top: 0; height: 70px; background: #fff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); z-index: 999; transition: all 0.3s ease; }
        .page-content-wrapper { padding: 90px 20px 20px; }
    </style>
</head>
<body class="dashboard-layout">
    <!-- Sidebar -->
    @include('dashboard.body.side_nav')
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        @include('dashboard.body.top_nav')
        
        <!-- Page Content -->
        <div class="page-content-wrapper">
            @yield('content')
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('assets/dashboard.js') }}"></script>
</body>
</html>