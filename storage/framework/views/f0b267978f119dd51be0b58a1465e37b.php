<?php $__env->startSection('title', 'Daftar Event - Dreamella'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Daftar Event</h1>
            <p class="text-muted mb-0">Cari event Dreamella Project yang tersedia.</p>
        </div>
        <form class="d-flex flex-wrap gap-2" method="get">
            <input class="form-control" name="q" placeholder="Cari event" value="<?php echo e(request('q')); ?>">
            <select class="form-select" name="category">
                <option value="">Semua kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category); ?>" <?php if(request('category') === $category): echo 'selected'; endif; ?>><?php echo e($category); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input class="form-control" type="date" name="date" value="<?php echo e(request('date')); ?>">
            <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="event-poster"><?php echo e($event->title); ?></div>
                    <div class="card-body">
                        <?php ($soldOut = $event->tickets->sum('sold_count') >= $event->tickets->sum('quota')); ?>
                        <span class="badge text-bg-<?php echo e($soldOut ? 'danger' : 'success'); ?>"><?php echo e($soldOut ? 'Sold Out' : 'Available'); ?></span>
                        <h2 class="h5 mt-3"><?php echo e($event->title); ?></h2>
                        <p class="small text-muted mb-1"><?php echo e($event->event_date->format('d M Y')); ?> <?php echo e($event->event_time); ?></p>
                        <p class="small text-muted"><?php echo e($event->location); ?></p>
                        <div class="fw-bold mb-3">Mulai Rp <?php echo e(number_format($event->minimumPrice(), 0, ',', '.')); ?></div>
                        <a class="btn btn-dream w-100" href="<?php echo e(route('events.show', $event)); ?>">Beli Tiket</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12"><div class="alert alert-info">Event tidak ditemukan.</div></div>
        <?php endif; ?>
    </div>
    <div class="mt-4"><?php echo e($events->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/events/index.blade.php ENDPATH**/ ?>