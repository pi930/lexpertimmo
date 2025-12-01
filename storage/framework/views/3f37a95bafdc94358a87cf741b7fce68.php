

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">📄 Résultat du devis</h1>

    <p><strong>Type de bien :</strong> <?php echo e($typeBien); ?></p>
    <p><strong>Surface :</strong> <?php echo e($surface); ?></p>
    <p><strong>Options sélectionnées :</strong></p>
    <ul class="list-disc ms-6">
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($option); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <p class="mt-4 text-lg"><strong>Prix total TTC :</strong> <?php echo e(number_format($prixTotal, 2, ',', ' ')); ?> €</p>

    <form method="POST" action="<?php echo e(route('devis.generer')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-primary mt-6">✅ Valider et générer le devis PDF</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/devis/resultat.blade.php ENDPATH**/ ?>