@extends('dashboard.index')

@section('content')
<div class="dashboard-content">
    <!-- Page Header -->
    <div class="section-header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="section-title">
                    <i class="fas fa-user-circle"></i>
                    {{ __('Employee Profile') }}
                </h1>
                <p class="section-subtitle">{{ __('Manage your personal and professional information') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="header-btn" title="{{ __('Edit Profile') }}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="header-btn" title="{{ __('Export CV') }}">
                    <i class="fas fa-download"></i>
                </button>
                <button class="header-btn" title="{{ __('Share Profile') }}">
                    <i class="fas fa-share-alt"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Hero Section -->
    <div class="stat-card mb-6">
        <div class="flex items-center gap-6">
            <div class="stat-icon" style="width: 80px; height: 80px; font-size: 2rem;">
                <i class="fas fa-user"></i>
            </div>
            <div class="flex-1">
                <h2 class="stat-value mb-2">{{ $user->name ?? __('Not Set') }}</h2>
                <p class="stat-label mb-3">{{ $user->specialization ?? __('Professional') }}</p>
                <div class="flex items-center gap-4 text-sm text-gray-600">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-primary-green"></i>
                        {{ $user->address ?? __('Location not set') }}
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-envelope text-primary-green"></i>
                        {{ $user->email }}
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-phone text-primary-green"></i>
                        {{ $user->phone ?? __('Phone not set') }}
                    </span>
                </div>
            </div>
            <div class="text-center">
                <div class="stat-trend" style="font-size: 1rem; padding: 0.8rem 1.5rem;">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ __('Profile Complete') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="stats-grid mb-6">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    {{ __('Education') }}
                </div>
            </div>
            <div class="stat-value">{{ $user->education ?? __('Not Set') }}</div>
            <div class="stat-label">{{ __('Educational Background') }}</div>
            <div class="stat-description">{{ __('Your academic qualifications and degrees') }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    {{ __('Experience') }}
                </div>
            </div>
            <div class="stat-value">{{ __('Available') }}</div>
            <div class="stat-label">{{ __('Work Experience') }}</div>
            <div class="stat-description">{{ __('Your professional work history and expertise') }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    {{ $user->skills && is_array($user->skills) ? count($user->skills) : 0 }}
                </div>
            </div>
            <div class="stat-value">{{ __('Skills') }}</div>
            <div class="stat-label">{{ __('Professional Skills') }}</div>
            <div class="stat-description">{{ __('Your technical and soft skills') }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    {{ __('3') }}
                </div>
            </div>
            <div class="stat-value">{{ __('Documents') }}</div>
            <div class="stat-label">{{ __('Uploaded Files') }}</div>
            <div class="stat-description">{{ __('CV, certificates, and other documents') }}</div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column - Personal Information -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Personal Information Card -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-user"></i>
                        {{ __('Personal Information') }}
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 p-3 bg-grey-50 rounded-lg">
                            <div class="w-3 h-3 bg-primary-green rounded-full"></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">{{ __('Full Name') }}</label>
                                <p class="text-gray-900 font-medium">{{ $user->name ?? __('Not set') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-grey-50 rounded-lg">
                            <div class="w-3 h-3 bg-success-green rounded-full"></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">{{ __('Arabic Name') }}</label>
                                <p class="text-gray-900 font-medium">{{ $user->first_name_ar ?? __('Not set') }} {{ $user->last_name_ar ?? '' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-grey-50 rounded-lg">
                            <div class="w-3 h-3 bg-info-blue rounded-full"></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">{{ __('English Name') }}</label>
                                <p class="text-gray-900 font-medium">{{ $user->first_name_en ?? __('Not set') }} {{ $user->last_name_en ?? '' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-grey-50 rounded-lg">
                            <div class="w-3 h-3 bg-warning-orange rounded-full"></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">{{ __('National ID') }}</label>
                                <p class="text-gray-900 font-medium">{{ $user->national_id ?? __('Not set') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 p-3 bg-grey-50 rounded-lg">
                            <div class="w-3 h-3 bg-error-red rounded-full"></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">{{ __('Birth Date') }}</label>
                                <p class="text-gray-900 font-medium">{{ $user->birth_date ?? __('Not set') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-grey-50 rounded-lg">
                            <div class="w-3 h-3 bg-primary-light rounded-full"></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">{{ __('Gender') }}</label>
                                <p class="text-gray-900 font-medium">{{ $user->gender ?? __('Not set') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-grey-50 rounded-lg">
                            <div class="w-3 h-3 bg-primary-lighter rounded-full"></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">{{ __('Marital Status') }}</label>
                                <p class="text-gray-900 font-medium">{{ $user->marital_status ?? __('Not set') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-grey-50 rounded-lg">
                            <div class="w-3 h-3 bg-primary-lightest rounded-full"></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">{{ __('Phone') }}</label>
                                <p class="text-gray-900 font-medium">{{ $user->phone ?? __('Not set') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Information Card -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-briefcase"></i>
                        {{ __('Professional Information') }}
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="p-4 bg-primary-lightest rounded-lg border-l-4 border-primary-green">
                            <label class="block text-sm font-medium text-gray-600 mb-2">{{ __('Education') }}</label>
                            <p class="text-gray-900 font-medium">{{ $user->education ?? __('Not set') }}</p>
                        </div>
                        
                        <div class="p-4 bg-primary-lightest rounded-lg border-l-4 border-success-green">
                            <label class="block text-sm font-medium text-gray-600 mb-2">{{ __('Specialization') }}</label>
                            <p class="text-gray-900 font-medium">{{ $user->specialization ?? __('Not set') }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="p-4 bg-primary-lightest rounded-lg border-l-4 border-info-blue">
                            <label class="block text-sm font-medium text-gray-600 mb-2">{{ __('Experience Certificate') }}</label>
                            @if($user->experience_certificate)
                                <a href="{{ asset('storage/' . $user->experience_certificate) }}" target="_blank" class="inline-flex items-center px-3 py-1 bg-info-blue text-white rounded-full text-sm font-medium hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-eye mr-2"></i>
                                    {{ __('View Certificate') }}
                                </a>
                            @else
                                <span class="text-gray-500 text-sm">{{ __('Not uploaded') }}</span>
                            @endif
                        </div>
                        
                        <div class="p-4 bg-primary-lightest rounded-lg border-l-4 border-warning-orange">
                            <label class="block text-sm font-medium text-gray-600 mb-2">{{ __('Address') }}</label>
                            <p class="text-gray-900 font-medium">{{ $user->address ?? __('Not set') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-star"></i>
                        {{ __('Skills & Expertise') }}
                    </div>
                </div>
                <div class="p-4">
                    @if($user->skills && is_array($user->skills) && count($user->skills) > 0)
                        <div class="flex flex-wrap gap-3">
                            @foreach($user->skills as $skill)
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-primary-lightest text-primary-green border border-primary-lighter">
                                    <i class="fas fa-check-circle mr-2 text-success-green"></i>
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-lightbulb text-gray-300 text-4xl mb-4"></i>
                            <p class="text-gray-500">{{ __('No skills listed yet') }}</p>
                            <button class="mt-3 text-primary-green hover:text-primary-dark font-medium">
                                {{ __('Add Skills') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bio Section -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-quote-left"></i>
                        {{ __('Professional Bio') }}
                    </div>
                </div>
                <div class="p-4">
                    @if($user->bio)
                        <p class="text-gray-700 leading-relaxed">{{ $user->bio }}</p>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-edit text-gray-300 text-4xl mb-4"></i>
                            <p class="text-gray-500">{{ __('No bio provided yet') }}</p>
                            <button class="mt-3 text-primary-green hover:text-primary-dark font-medium">
                                {{ __('Write Bio') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Documents & Actions -->
        <div class="space-y-6">
            
            <!-- Documents Card -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-file-alt"></i>
                        {{ __('Documents') }}
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border-l-4 border-red-500">
                        <div class="flex items-center">
                            <i class="fas fa-file-pdf text-red-500 text-xl mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">{{ __('CV') }}</p>
                                <p class="text-sm text-gray-600">{{ __('Professional Resume') }}</p>
                            </div>
                        </div>
                        @if($user->cv)
                            <a href="{{ asset('storage/' . $user->cv) }}" target="_blank" class="px-3 py-1 bg-primary-green text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors">
                                <i class="fas fa-eye mr-2"></i>
                                {{ __('View') }}
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">{{ __('Not uploaded') }}</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                        <div class="flex items-center">
                            <i class="fas fa-id-card text-green-500 text-xl mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">{{ __('National ID') }}</p>
                                <p class="text-sm text-gray-600">{{ __('Identity Document') }}</p>
                            </div>
                        </div>
                        @if($user->national_id_image)
                            <a href="{{ asset('storage/' . $user->national_id_image) }}" target="_blank" class="px-3 py-1 bg-primary-green text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors">
                                <i class="fas fa-eye mr-2"></i>
                                {{ __('View') }}
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">{{ __('Not uploaded') }}</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                        <div class="flex items-center">
                            <i class="fas fa-certificate text-blue-500 text-xl mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-900">{{ __('Certificate') }}</p>
                                <p class="text-sm text-gray-600">{{ __('Experience Certificate') }}</p>
                            </div>
                        </div>
                        @if($user->certificate_image)
                            <a href="{{ asset('storage/' . $user->certificate_image) }}" target="_blank" class="px-3 py-1 bg-primary-green text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors">
                                <i class="fas fa-eye mr-2"></i>
                                {{ __('View') }}
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">{{ __('Not uploaded') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-bolt"></i>
                        {{ __('Quick Actions') }}
                    </div>
                </div>
                <div class="space-y-3">
                    <button class="w-full flex items-center justify-center px-4 py-3 bg-primary-green text-white rounded-lg hover:bg-primary-dark transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        {{ __('Edit Profile') }}
                    </button>
                    <button class="w-full flex items-center justify-center px-4 py-3 bg-success-green text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        {{ __('Add Skills') }}
                    </button>
                    <button class="w-full flex items-center justify-center px-4 py-3 bg-info-blue text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-upload mr-2"></i>
                        {{ __('Upload Documents') }}
                    </button>
                    <button class="w-full flex items-center justify-center px-4 py-3 bg-warning-orange text-white rounded-lg hover:bg-orange-700 transition-colors">
                        <i class="fas fa-share mr-2"></i>
                        {{ __('Share Profile') }}
                    </button>
                </div>
            </div>

            <!-- Profile Completion Card -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-chart-line"></i>
                        {{ __('Profile Completion') }}
                    </div>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">{{ __('Completion Rate') }}</span>
                            <span class="text-sm font-medium text-gray-900">85%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-primary-green to-primary-light h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">{{ __('Personal Info') }}</span>
                            <span class="text-success-green">✓</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">{{ __('Professional Info') }}</span>
                            <span class="text-success-green">✓</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">{{ __('Skills') }}</span>
                            <span class="text-warning-orange">⚠</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">{{ __('Documents') }}</span>
                            <span class="text-error-red">✗</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Information -->
    @include('profile.partials.status-info', ['user' => $user, 'columns' => 4, 'showLastUpdated' => true])
    
    <!-- Profile Actions -->
    @include('profile.partials.profile-actions')
</div>

@endsection
