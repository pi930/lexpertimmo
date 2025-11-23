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
<?php $__currentLoopData = $devis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="border-t hover:bg-gray-100">
        <?php if($admin): ?>
            <td class="px-4 py-2"><?php echo e($item->user->nom ?? '—'); ?></td>
            <td class="px-4 py-2"><?php echo e($item->user->email ?? '—'); ?></td>
        <?php endif; ?>

        <td class="px-4 py-2"><?php echo e($item->objet ?? '—'); ?></td>
        <td class="px-4 py-2"><?php echo e(number_format($item->total_ttc, 2, ',', ' ')); ?> €</td>
        <td class="px-4 py-2"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
        <td class="px-4 py-2 space-x-4">
            <a href="<?php echo e(Storage::url($item->pdf_path)); ?>" target="_blank" class="text-blue-600 hover:underline">📄 Télécharger</a>

            <form action="<?php echo e(route('devis.destroy', $item->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('🗑️ Supprimer ce devis ?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="text-red-600 hover:underline text-sm">🗑️ Supprimer</button>
            </form>
        </td>
    </tr>

    <?php if($item->devisLignes->count()): ?>
        <tr>
            <td colspan="<?php echo e($admin? 6 : 4); ?>" class="px-4 py-2 bg-gray-50">
                <ul class="list-disc pl-4 text-sm text-gray-700">
                    <?php $__currentLoopData = $item->devisLignes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ligne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($ligne->objet->nom ?? 'Option inconnue'); ?> — <?php echo e(number_format($ligne->prix, 2, ',', ' ')); ?> €</li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </td>
        </tr>
        <?php else: ?>
    <p>Aucune ligne de devis n’a été trouvée.</p>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
        </table>

        <div class="mt-4">
            <?php echo e($devis->links()); ?>

        </div>
    <?php else: ?>
        <p class="text-gray-500">Aucun devis pour le moment.</p>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/dashboard/devis.blade.php ENDPATH**/ ?>