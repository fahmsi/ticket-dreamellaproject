<?php $__env->startSection('title', 'Login - Dreamella'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h4 mb-4">Login</h1>
                    <form method="post" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="form-check"><input class="form-check-input" type="checkbox" name="remember"> <span class="form-check-label">Ingat saya</span></label>
                            <a href="<?php echo e(route('password.request')); ?>">Lupa password?</a>
                        </div>
                        <button class="btn btn-dream w-100">Login</button>
                    </form>
                    <p class="mt-3 mb-0 text-center">Belum punya akun? <a href="<?php echo e(route('register')); ?>">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/auth/login.blade.php ENDPATH**/ ?>