<?php $__env->startSection('title', 'Profil Saya - Dreamella'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-4">Profil Saya</h1>
                    <form method="post" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?> <?php echo method_field('put'); ?>
                        <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="name" value="<?php echo e(old('name', $user->name)); ?>" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" value="<?php echo e($user->email); ?>" disabled></div>
                        <div class="mb-3"><label class="form-label">Nomor Telepon</label><input class="form-control" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>"></div>
                        <div class="mb-3"><label class="form-label">Avatar</label><input class="form-control" type="file" name="avatar"></div>
                        <div class="mb-3"><label class="form-label">Password Baru</label><input class="form-control" type="password" name="password"></div>
                        <div class="mb-3"><label class="form-label">Konfirmasi Password Baru</label><input class="form-control" type="password" name="password_confirmation"></div>
                        <button class="btn btn-dream">Simpan Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/customer/profile.blade.php ENDPATH**/ ?>