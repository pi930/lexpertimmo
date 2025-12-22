
<div class="section">
    <strong>Client :</strong> <?php echo e($user->nom); ?><br>
    <strong>Email :</strong> <?php echo e($user->email); ?>

    <strong>Total TTC :</strong> <?php echo e(number_format($prixTotal, 2, ',', ' ')); ?> €
</div>

<div class="section">
    <strong>Prestations :</strong>
    <table>
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Prix (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $prestations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prestation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($prestation['nom'] ?? 'Non spécifié'); ?></td>
                    <td><?php echo e(number_format($prestation['prix'], 2, ',', ' ')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /home/pierrard/Documents/lexpertimmo/resources/views/devis/template.blade.php ENDPATH**/ ?>