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
                    <th class="px-4 py-2">#</th>
                    <?php if($admin): ?>
                        <th class="px-4 py-2">Utilisateur</th>
                        <th class="px-4 py-2">Heures de travail</th>
                    <?php endif; ?>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Montant TTC</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">PDF</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $devis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2"><?php echo e($item->id); ?></td>

                        <?php if($admin): ?>
                            <td class="px-4 py-2"><?php echo e($item->user->nom?? '—'); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->heures_travail ?? '—'); ?> h</td>
                        <?php endif; ?>

                        <!-- Type (nom des lignes du devis) -->
                        <td class="px-4 py-2">
                            <?php if($item->devisLignes->count()): ?>
                                <ul class="list-disc pl-4">
                                    <?php $__currentLoopData = $item->devisLignes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ligne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($ligne->objet->nom ?? $ligne->designation ?? 'Option inconnue'); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>

                        <!-- Montant TTC -->
                        <td class="px-4 py-2">
                            <?php if($item->devisLignes->count()): ?>
                                <ul class="list-disc pl-4">
                                    <?php $__currentLoopData = $item->devisLignes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ligne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e(number_format($ligne->total_ttc, 2, ',', ' ')); ?> €</li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <?php echo e(number_format($item->total_ttc, 2, ',', ' ')); ?> €
                            <?php endif; ?>
                        </td>

                        <td class="px-4 py-2"><?php echo e($item->statut ?? '—'); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                        <td class="px-4 py-2">
                            <?php if($item->pdf_path): ?>
                                <a href="<?php echo e(route('devis.download', $item->id)); ?>" target="_blank" class="text-blue-600 hover:underline">
                                    📄 Télécharger
                                </a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2">
    <form action="<?php echo e(route('devis.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Supprimer ce devis ?')">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button class="text-red-600 hover:underline">🗑️ Supprimer</button>
    </form>
</td>

                    </tr>

                    <!-- Détails supplémentaires sous le devis -->
                    <?php if($item->devisLignes->count()): ?>
                        <tr>
                            <td colspan="<?php echo e($admin ? 7 : 5); ?>" class="px-4 py-2 bg-gray-50">
                                <ul class="list-disc pl-4 text-sm text-gray-700">
                                    <?php $__currentLoopData = $item->devisLignes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ligne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <?php echo e($ligne->objet->nom ?? $ligne->designation ?? 'Option inconnue'); ?>

                                            — <?php echo e(number_format($ligne->total_ttc, 2, ',', ' ')); ?> €
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
</div><?php /**PATH /home/pierrard/Documents/lexpertimmo/resources/views/components/dashboard/devis.blade.php ENDPATH**/ ?>