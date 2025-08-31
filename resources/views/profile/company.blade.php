@extends('dashboard.index')

@section('content')
@include('profile.partials.profile-header', [
    'title' => __('Company Profile'),
    'subtitle' => __('Manage your company information and settings')
])

<!-- Company Information -->
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-4xl">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Company Information') }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Basic Information -->
            <div class="space-y-4">
                <h4 class="font-medium text-gray-700">{{ __('Basic Information') }}</h4>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Company Name') }}</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->company_name ?? 'Not set' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Phone') }}</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->phone ?? 'Not set' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Website') }}</label>
                    <p class="mt-1 text-sm text-gray-900">
                        @if($user->website)
                            <a href="{{ $user->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">{{ $user->website }}</a>
                        @else
                            Not set
                        @endif
                    </p>
                </div>
            </div>
            
            <!-- Company Details -->
            <div class="space-y-4">
                <h4 class="font-medium text-gray-700">{{ __('Company Details') }}</h4>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Entity Type') }}</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->entity_type ?? 'Not set' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('License Number') }}</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->license_number ?? 'Not set' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Establishment Date') }}</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->establishment_date ?? 'Not set' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Business Sector') }}</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->business_sector ?? 'Not set' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Description -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700">{{ __('Company Description') }}</label>
            <p class="mt-1 text-sm text-gray-900">{{ $user->description ?? 'No description provided' }}</p>
        </div>
    </div>
</div>

@include('profile.partials.status-info', ['user' => $user, 'columns' => 3])
@include('profile.partials.profile-actions')

@endsection
