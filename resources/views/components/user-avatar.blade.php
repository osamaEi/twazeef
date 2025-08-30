@props(['user', 'size' => 'md', 'showName' => false, 'showRole' => false])

@php
    $sizeClasses = [
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
        'xl' => 'w-16 h-16 text-xl'
    ];
    
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $userName = $user->name ?? 'User';
    $initials = substr($userName, 0, 2);
@endphp

<div class="flex items-center gap-3">
    <div class="user-avatar {{ $sizeClass }}">
        @if($user->profile_photo_url)
            <img src="{{ $user->profile_photo_url }}" 
                 alt="{{ $userName }}" 
                 class="avatar-image">
        @else
            <span class="avatar-initials">{{ $initials }}</span>
        @endif
    </div>
    
    @if($showName || $showRole)
        <div class="user-info">
            @if($showName)
                <div class="user-name">{{ $userName }}</div>
            @endif
            @if($showRole && $user->role)
                <div class="user-role">
                    @switch($user->role)
                        @case('admin')
                            {{ __('topnav.admin_role') }}
                            @break
                        @case('company')
                            {{ __('topnav.company_role') }}
                            @break
                        @default
                            {{ __('topnav.employee_role') }}
                    @endswitch
                </div>
            @endif
        </div>
    @endif
</div>
