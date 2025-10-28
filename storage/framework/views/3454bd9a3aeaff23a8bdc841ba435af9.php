<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📄 Devis reçus</h2>

    <?php if($isAdmin): ?>
        <?php if($devis->count()): ?>
            <table class="table-auto w-full border">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Objet</th>
                        <th class="px-4 py-2">Montant</th>
                        <th class="px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $devis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t hover:bg-gray-100 cursor-pointer"
                            onclick="window.location='<?php echo e(route('admin.dashboard.user', ['id' => $item->user_id])); ?>'">
                            <td class="px-4 py-2"><?php echo e($item->nom); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->email); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->objet); ?></td>
                            <td class="px-4 py-2"><?php echo e(number_format($item->montant, 2, ',', ' ')); ?> €</td>
                            <td class="px-4 py-2"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="mt-4">
                <?php echo e($devis->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-gray-500">Aucun devis pour le moment.</p>
        <?php endif; ?>
    <?php else: ?>
        <p class="text-red-500">Accès réservé à l’administrateur.</p>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\dashboard\devis.blade.php ENDPATH**/ ?>