@props(['status', 'text' => null])

@php
    $statusClasses = [
        'active' => 'status-badge active',
        'pending' => 'status-badge pending',
        'approved' => 'status-badge active',
        'rejected' => 'status-badge pending',
        'under-review' => 'status-badge review',
        'paused' => 'status-badge warning',
        'closed' => 'status-badge inactive'
    ];
    
    $defaultText = [
        'active' => __('admin.status.active'),
        'pending' => __('admin.status.pending'),
        'approved' => __('admin.status.approved'),
        'rejected' => __('admin.status.rejected'),
        'under-review' => __('admin.status.under_review'),
        'paused' => __('admin.status.paused'),
        'closed' => __('admin.status.closed')
    ];
    
    $class = $statusClasses[$status] ?? 'status-badge default';
    $displayText = $text ?? ($defaultText[$status] ?? $status);
@endphp

<span class="{{ $class }}">
    {{ $displayText }}
</span>
