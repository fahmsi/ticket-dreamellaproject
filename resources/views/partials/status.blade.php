@php
    $map = [
        'pending_payment' => 'warning',
        'waiting_verification' => 'info',
        'paid' => 'success',
        'rejected' => 'danger',
        'cancelled' => 'secondary',
        'expired' => 'dark',
        'uploaded' => 'info',
        'verified' => 'success',
        'active' => 'success',
        'inactive' => 'secondary',
        'used' => 'dark',
        'published' => 'success',
        'draft' => 'secondary',
        'closed' => 'danger',
    ];
@endphp
<span class="badge text-bg-{{ $map[$status] ?? 'secondary' }} status-badge">{{ str_replace('_', ' ', $status) }}</span>
