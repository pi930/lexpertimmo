 

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">📬 Messages reçus via le formulaire de contact</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($messages->count()): ?>
        <table class="table table-bordered table-hover table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Sujet</th>
                    <th>Message</th>
                    <th>Envoyé le</th>
                    <th>Utilisateur</th>
                </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($msg->nom); ?></td>
        <td><?php echo e($msg->email); ?></td>
        <td><?php echo e($msg->sujet); ?></td>
        <td><?php echo e($msg->message); ?></td>
        <td><?php echo e($msg->created_at->format('d/m/Y H:i')); ?></td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            <?php echo e($messages->links()); ?>

        </div>
    <?php else: ?>
        <div class="alert alert-info">Aucun message reçu pour le moment.</div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\admin\contact\index.blade.php ENDPATH**/ ?>