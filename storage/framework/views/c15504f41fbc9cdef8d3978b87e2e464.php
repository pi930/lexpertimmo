<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📍 Mes coordonnées</h2>

    <?php if($admin): ?>
        <h3 class="text-xl font-semibold mt-6">📋 Liste des utilisateurs</h3>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-dark">Retour Admin</a>

        <?php if($coordonnees && $coordonnees->count()): ?>
            <table class="table-auto w-full border mt-4">
                <thead>…</thead>
                <tbody>
                    <?php $__currentLoopData = $coordonnees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->last_name); ?></td>
                            <td><?php echo e($item->rue); ?></td>
                            <td><?php echo e($item->email); ?></td>
                            <td><?php echo e($item->telephone); ?></td>
                            <td><?php echo e($item->code_postale); ?></td>
                            <td><?php echo e($item->ville); ?></td>
                            <td><?php echo e($item->Pays); ?></td>
                            <td><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="mt-4">
                <?php echo e($coordonnees->links()); ?>

            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="bg-white p-6 rounded shadow">
            <p><strong>Nom :</strong> <?php echo e($coordonnees->last_name ?? $user->last_name); ?></p>
            <p><strong>Rue :</strong> <?php echo e($coordonnees->rue ?? '—'); ?></p>
            <p><strong>Email :</strong> <?php echo e($coordonnees->email ?? $user->email); ?></p>
            <p><strong>Téléphone :</strong> <?php echo e($coordonnees->telephone ?? '—'); ?></p>
            <p><strong>Code postale :</strong> <?php echo e($coordonnees->code_postale ?? '—'); ?></p>
            <p><strong>Ville :</strong> <?php echo e($coordonnees->ville ?? '—'); ?></p>
            <p><strong>Pays :</strong> <?php echo e($coordonnees->Pays ?? '—'); ?></p>
            <p><strong>Inscrit le :</strong> <?php echo e($user->created_at->format('d/m/Y H:i')); ?></p>
        </div>
        <a href="<?php echo e(route('user.dashboard', ['id' => $user->id])); ?>" class="btn btn-outline-primary">Retour utilisateur</a>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/dashboard/coordonnees.blade.php ENDPATH**/ ?>