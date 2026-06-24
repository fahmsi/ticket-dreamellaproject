<?php $__env->startSection('title', 'Admin Dashboard - Dreamella'); ?>
<?php $__env->startSection('admin'); ?>
<h1 class="h3 mb-4">Dashboard</h1>
<div class="row g-3 mb-4">
    <?php $__currentLoopData = [
        'Total Event' => $stats['events'],
        'Total Transaksi' => $stats['transactions'],
        'Tiket Terjual' => $stats['tickets_sold'],
        'Pendapatan' => 'Rp '.number_format($stats['revenue'], 0, ',', '.'),
        'Menunggu Verifikasi' => $stats['waiting'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md"><div class="card border-0 shadow-sm"><div class="card-body"><div class="small text-muted"><?php echo e($label); ?></div><div class="h4 mb-0"><?php echo e($value); ?></div></div></div></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h2 class="h5">Transaksi Terbaru</h2>
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Kode</th><th>Pelanggan</th><th>Event</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                <?php $__currentLoopData = $latestTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr><td><?php echo e($transaction->code); ?></td><td><?php echo e($transaction->user->name); ?></td><td><?php echo e($transaction->event()?->title); ?></td><td>Rp <?php echo e(number_format($transaction->total_amount, 0, ',', '.')); ?></td><td><?php echo $__env->make('partials.status', ['status' => $transaction->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td></tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card border-0 shadow-sm mt-4">
    <div class="card-body">
        <h2 class="h5">Grafik Penjualan per Event</h2>
        <?php ($maxRevenue = max(1, $salesByEvent->max('revenue') ?? 1)); ?>
        <?php $__empty_1 = true; $__currentLoopData = $salesByEvent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventTitle => $sales): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="mb-3">
                <div class="d-flex justify-content-between small mb-1">
                    <span class="fw-semibold"><?php echo e($eventTitle); ?></span>
                    <span><?php echo e($sales['tickets']); ?> tiket - Rp <?php echo e(number_format($sales['revenue'], 0, ',', '.')); ?></span>
                </div>
                <div class="progress" style="height: 12px">
                    <div class="progress-bar bg-danger" style="width: <?php echo e(max(6, ($sales['revenue'] / $maxRevenue) * 100)); ?>%"></div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-muted">Belum ada transaksi paid untuk ditampilkan.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>