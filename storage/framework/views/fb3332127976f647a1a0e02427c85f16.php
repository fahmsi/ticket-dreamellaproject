<?php $__env->startSection('title', $event->title.' - Dreamella'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="event-poster rounded-3 h-100"><?php echo e($event->title); ?></div>
        </div>
        <div class="col-lg-7">
            <div class="d-flex gap-2 mb-3"><?php echo $__env->make('partials.status', ['status' => $event->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <span class="badge text-bg-light"><?php echo e($event->category); ?></span></div>
            <h1 class="h2"><?php echo e($event->title); ?></h1>
            <p class="text-muted"><?php echo e($event->description); ?></p>
            <div class="row g-3 mb-4">
                <div class="col-md-6"><div class="p-3 bg-white rounded border"><strong>Tanggal</strong><br><?php echo e($event->event_date->format('d M Y')); ?> <?php echo e($event->event_time); ?></div></div>
                <div class="col-md-6"><div class="p-3 bg-white rounded border"><strong>Lokasi</strong><br><?php echo e($event->location); ?></div></div>
            </div>
            <h2 class="h5">Pilih Jenis Tiket</h2>
            <div class="vstack gap-3">
                <?php $__currentLoopData = $event->tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <form class="card border-0 shadow-sm" method="get" action="<?php echo e(route('checkout.show', $event)); ?>">
                        <div class="card-body row g-3 align-items-center">
                            <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">
                            <div class="col-md-5">
                                <div class="fw-bold"><?php echo e($ticket->name); ?></div>
                                <div class="small text-muted"><?php echo e($ticket->description); ?></div>
                            </div>
                            <div class="col-md-3">
                                <div class="fw-bold">Rp <?php echo e(number_format($ticket->price, 0, ',', '.')); ?></div>
                                <div class="small text-muted">Stok <?php echo e($ticket->availableSeats()); ?></div>
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" type="number" name="quantity" min="1" max="<?php echo e(max(1, $ticket->availableSeats())); ?>" value="1">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-dream w-100" <?php if($ticket->status !== 'active' || $ticket->availableSeats() < 1): echo 'disabled'; endif; ?>>Beli</button>
                            </div>
                        </div>
                    </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/events/show.blade.php ENDPATH**/ ?>