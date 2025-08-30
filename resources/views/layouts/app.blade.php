<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="لوحة إدارة الوظائف - شركة توافق للتوظيف">
    <meta name="author" content="شركة توافق للتوظيف">
    
    <title>لوحة إدارة الوظائف | شركة توافق للتوظيف</title>
    
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>💼</text></svg>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard.css') }}">
</head>

<body>
    <div class="dashboard-layout">
        <!-- Sidebar Navigation -->
        @include('dashboard.body.side_nav')
        
        <!-- Main Content Area -->
        <main class="main-content">
            <!-- Top Navigation Header -->
            @include('dashboard.body.top_nav')
         
            
            <!-- Page Content -->
            
            <div class="page-content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/dashboard.js') }}"></script>
</body>
</html>