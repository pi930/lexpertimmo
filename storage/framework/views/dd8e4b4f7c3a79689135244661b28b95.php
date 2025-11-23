

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">📄 Détail du devis #<?php echo e($devis->id); ?></h1>

    <div class="mb-4">
        <?php if($admin): ?>
    <p><strong>Client :</strong> <?php echo e($devis->user->name); ?> (<?php echo e($devis->user->email); ?>)</p>
<?php endif; ?>
        <p><strong>Date de création :</strong> <?php echo e($devis->created_at->format('d/m/Y à H:i')); ?></p>
        <p><strong>Objet :</strong> <?php echo e($devis->objet); ?></p>
        <p><strong>Status :</strong> <span class="text-blue-600"><?php echo e(ucfirst($devis->status)); ?></span></p>
        <p><strong>Montant total TTC :</strong> <?php echo e(number_format($devis->total_ttc, 2, ',', ' ')); ?> €</p>
    </div>

    <?php if($devis->pdf_path): ?>
        <div class="mb-6">
            <a href="<?php echo e(Storage::url($devis->pdf_path)); ?>" target="_blank" class="text-blue-600 underline">
                📎 Télécharger le devis PDF
            </a>
        </div>
    <?php endif; ?>

    <h2 class="text-xl font-semibold mb-2">🧾 Prestations incluses</h2>
    <ul class="list-disc ms-6 mb-6">
        <?php $__empty_1 = true; $__currentLoopData = $devis->devisLignes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ligne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li>
                <?php echo e($ligne->objet->nom ?? 'Option inconnue'); ?> —
                <?php echo e(number_format($ligne->prix, 2, ',', ' ')); ?> €
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>Aucune prestation enregistrée.</li>
        <?php endif; ?>
    </ul>

    <a href="<?php echo e(route('devis.index')); ?>" class="text-sm text-gray-600 hover:text-blue-600 underline">
        ⬅️ Retour à la liste des devis
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/Admin/devis/show.blade.php ENDPATH**/ ?>