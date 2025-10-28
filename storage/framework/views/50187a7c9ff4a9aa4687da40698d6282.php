

<?php $__env->startSection('content'); ?>
<h2>Notifications</h2>

<?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card mb-3 <?php echo e($notification->read ? 'bg-light' : 'bg-warning'); ?>">
        <div class="card-body">
            <p><?php echo e($notification->content); ?></p>

            <?php if($notification->url): ?>
                <a href="<?php echo e($notification->url); ?>" class="btn btn-sm btn-primary">Voir le compte</a>
            <?php endif; ?>

            <?php if(!$notification->read): ?>
                <form action="<?php echo e(route('admin.notifications.read', $notification->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn btn-sm btn-success">Marquer comme lu</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e($notifications->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\admin\Notifications\index.blade.php ENDPATH**/ ?>