<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📄 Devis reçus</h2>

    <?php if($devis->count()): ?>
        <table class="table-auto w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <?php if($admin): ?>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                    <?php endif; ?>
                    <th class="px-4 py-2">Objet</th>
                    <th class="px-4 py-2">Montant TTC</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $devis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t">
                        <?php if($admin): ?>
                            <td class="px-4 py-2"><?php echo e($d->user->name ?? '—'); ?></td>
                            <td class="px-4 py-2"><?php echo e($d->user->email ?? '—'); ?></td>
                        <?php endif; ?>
                        <td class="px-4 py-2"><?php echo e($d->objet); ?></td>
                        <td class="px-4 py-2"><?php echo e(number_format($d->montant_ttc, 2, ',', ' ')); ?> €</td>
                        <td class="px-4 py-2"><?php echo e($d->created_at->format('d/m/Y')); ?></td>
                        <td class="px-4 py-2">
                            <a href="<?php echo e(route('devis.show', $d->id)); ?>" class="text-blue-600 underline">Voir</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="mt-4">
            <?php echo e($devis->links()); ?>

        </div>
    <?php else: ?>
        <p class="text-gray-600">Aucun devis pour le moment.</p>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/components/dashboard-devis.blade.php ENDPATH**/ ?>