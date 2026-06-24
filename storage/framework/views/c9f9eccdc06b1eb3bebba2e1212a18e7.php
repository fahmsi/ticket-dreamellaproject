<?php $__env->startSection('title', 'Kelola Event - Dreamella'); ?>
<?php $__env->startSection('admin'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Kelola Event</h1>
    <a class="btn btn-dream" href="<?php echo e(route('admin.events.create')); ?>"><i class="bi bi-plus-lg"></i> Event</a>
</div>
<form class="mb-3 d-flex gap-2" method="get"><input class="form-control" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari event"><button class="btn btn-outline-secondary">Cari</button></form>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Judul</th><th>Tanggal</th><th>Status</th><th>Tiket</th><th></th></tr></thead>
            <tbody>
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($event->title); ?></td><td><?php echo e($event->event_date->format('d M Y')); ?></td><td><?php echo $__env->make('partials.status', ['status' => $event->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td><td><?php echo e($event->tickets_count); ?></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="<?php echo e(route('admin.events.tickets', $event)); ?>">Tiket</a>
                        <a class="btn btn-sm btn-outline-secondary" href="<?php echo e(route('admin.events.edit', $event)); ?>">Edit</a>
                        <form class="d-inline" method="post" action="<?php echo e(route('admin.events.destroy', $event)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('delete'); ?><button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus event?')">Hapus</button></form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3"><?php echo e($events->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/admin/events/index.blade.php ENDPATH**/ ?>