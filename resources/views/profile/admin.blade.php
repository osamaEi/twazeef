@extends('dashboard.index')

@section('content')
@include('profile.partials.profile-header', [
    'title' => __('Admin Profile'),
    'subtitle' => __('Manage your administrative account and settings')
])

<!-- Profile Information -->
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-xl">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Profile Information') }}</h3>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->name ?? 'Not set' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Role') }}</label>
                <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->role) }}</p>
            </div>
        </div>
    </div>
</div>

@include('profile.partials.status-info', ['user' => $user, 'columns' => 3])
@include('profile.partials.profile-actions')

@endsection
