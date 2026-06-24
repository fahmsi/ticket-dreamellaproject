<?php $__env->startSection('title', 'Form Event - Dreamella'); ?>
<?php $__env->startSection('admin'); ?>
<h1 class="h3 mb-4"><?php echo e($event->exists ? 'Edit Event' : 'Tambah Event'); ?></h1>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="post" action="<?php echo e($event->exists ? route('admin.events.update', $event) : route('admin.events.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?> <?php if($event->exists): ?> <?php echo method_field('put'); ?> <?php endif; ?>
            <div class="row g-3">
                <div class="col-md-8"><label class="form-label">Judul</label><input class="form-control" name="title" value="<?php echo e(old('title', $event->title)); ?>" required></div>
                <div class="col-md-4"><label class="form-label">Kategori</label><input class="form-control" name="category" value="<?php echo e(old('category', $event->category)); ?>"></div>
                <div class="col-12"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description" rows="5" required><?php echo e(old('description', $event->description)); ?></textarea></div>
                <div class="col-md-4"><label class="form-label">Tanggal</label><input class="form-control" type="date" name="event_date" value="<?php echo e(old('event_date', $event->event_date?->format('Y-m-d'))); ?>" required></div>
                <div class="col-md-4"><label class="form-label">Jam</label><input class="form-control" type="time" name="event_time" value="<?php echo e(old('event_time', $event->event_time)); ?>"></div>
                <div class="col-md-4"><label class="form-label">Status</label><select class="form-select" name="status"><?php $__currentLoopData = ['draft','published','closed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option <?php if(old('status', $event->status ?: 'draft') === $status): echo 'selected'; endif; ?>><?php echo e($status); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
                <div class="col-md-8"><label class="form-label">Lokasi</label><input class="form-control" name="location" value="<?php echo e(old('location', $event->location)); ?>" required></div>
                <div class="col-md-4"><label class="form-label">Poster</label><input class="form-control" type="file" name="poster"></div>
            </div>
            <button class="btn btn-dream mt-4">Simpan</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/admin/events/form.blade.php ENDPATH**/ ?>