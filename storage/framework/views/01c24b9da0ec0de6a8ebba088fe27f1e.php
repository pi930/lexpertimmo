<div>
    <div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">📍 Coordonnées</h2>

    <?php if(isset($user)): ?>
        <p><strong>Nom :</strong> <?php echo e($user->last_name); ?></p>
        <p><strong>Rue :</strong> <?php echo e($user->rue); ?></p>
        <p><strong>Email :</strong> <?php echo e($user->email); ?></p>
       
        <p><strong>Code postal :</strong> <?php echo e($user->code_postale); ?></p>
        <p><strong>Ville :</strong> <?php echo e($user->ville); ?></p>
        <p><strong>Pays :</strong> <?php echo e($user->Pays); ?></p>
        <p><strong>Inscrit le :</strong> <?php echo e($user->created_at->format('d/m/Y H:i')); ?></p>
    <?php else: ?>
        <p class="text-gray-500 italic">Aucune information utilisateur disponible.</p>
    <?php endif; ?>
</div>
</div>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/components/dashboard/coordonnees.blade.php ENDPATH**/ ?>