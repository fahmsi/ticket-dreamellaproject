<?php
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
?>
<span class="badge text-bg-<?php echo e($map[$status] ?? 'secondary'); ?> status-badge"><?php echo e(str_replace('_', ' ', $status)); ?></span>
<?php /**PATH C:\Herd\ticket\resources\views/partials/status.blade.php ENDPATH**/ ?>