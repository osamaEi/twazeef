<!-- Status Information -->
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-4xl">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Account Status') }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-{{ $columns ?? 3 }} gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Email Verified') }}</label>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                </span>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Member Since') }}</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
            </div>
            
            @if(isset($showLastUpdated) && $showLastUpdated)
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Last Updated') }}</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('M d, Y') }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
