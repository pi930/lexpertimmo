<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['devis', 'admin' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['devis', 'admin' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📄 Mes devis</h2>

    <?php if($admin): ?>
        <p class="text-sm text-blue-600">[Vue Admin]</p>
    <?php else: ?>
        <p class="text-sm text-green-600">[Vue utilisateur]</p>
    <?php endif; ?>

    <?php if($devis && $devis->count()): ?>
        <table class="table-auto w-full border mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Montant</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">PDF</th>
                    <?php if($admin): ?>
                        <th class="px-4 py-2">Utilisateur</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $devis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2"><?php echo e($item->objet ?? '—'); ?></td>
                        <td class="px-4 py-2"><?php echo e(number_format($item->total_ttc, 2, ',', ' ')); ?> €</td>
                        <td class="px-4 py-2"><?php echo e($item->statut ?? '—'); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                        <td class="px-4 py-2">
                            <a href="<?php echo e(Storage::url($item->pdf_path)); ?>" target="_blank" class="text-blue-600 hover:underline">📄 Télécharger</a>
                        </td>
                        <?php if($admin): ?>
                            <td class="px-4 py-2"><?php echo e($item->user->nom ?? '—'); ?></td>
                        <?php endif; ?>
                    </tr>

                    <?php if($item->devisLignes->count()): ?>
                        <tr>
                            <td colspan="<?php echo e($admin ? 6 : 5); ?>" class="px-4 py-2 bg-gray-50">
                                <ul class="list-disc pl-4 text-sm text-gray-700">
                                    <?php $__currentLoopData = $item->devisLignes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ligne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <?php echo e($ligne->objet->nom ?? 'Option inconnue'); ?> — <?php echo e(number_format($ligne->prix, 2, ',', ' ')); ?> €
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="mt-4">
            <?php echo e($devis->links()); ?>

        </div>
    <?php else: ?>
        <p class="text-gray-500">Aucun devis enregistré.</p>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/components/dashboard/devis.blade.php ENDPATH**/ ?>