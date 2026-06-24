<?php $__env->startSection('title', 'Tiket Saya - Dreamella'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h1 class="h3 mb-4">Tiket Saya</h1>
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-lg-4">
                <div class="card ticket-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between"><?php echo $__env->make('partials.status', ['status' => $ticket->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <span class="small text-muted"><?php echo e($ticket->ticket->name); ?></span></div>
                        <h2 class="h5 mt-3"><?php echo e($ticket->event->title); ?></h2>
                        <p class="small text-muted mb-2"><?php echo e($ticket->event->event_date->format('d M Y')); ?> - <?php echo e($ticket->event->location); ?></p>
                        <div class="fw-bold small"><?php echo e($ticket->ticket_code); ?></div>
                        <a class="btn btn-dream w-100 mt-3" href="<?php echo e(route('my-tickets.show', $ticket->ticket_code)); ?>">Lihat Tiket</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12"><div class="alert alert-info">Tiket akan muncul setelah pembayaran diverifikasi admin.</div></div>
        <?php endif; ?>
    </div>
    <div class="mt-3"><?php echo e($tickets->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/customer/tickets/index.blade.php ENDPATH**/ ?>