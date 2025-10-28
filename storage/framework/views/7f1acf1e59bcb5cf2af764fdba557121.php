<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-6 rounded">
    <h3 class="font-bold text-lg mb-2">✅ Message envoyé</h3>
    <p><strong>Sujet :</strong> <?php echo e($message->sujet); ?></p>
    <p><?php echo e($message->message); ?></p>
    <p class="text-sm text-gray-600 mt-2">
        Envoyé le <?php echo e($message->created_at->format('d/m/Y H:i')); ?>

    </p>
    <?php if($message->user_id): ?>
        <p class="text-sm text-gray-600 mt-2">
            — <a href="<?php echo e(route('admin.dashboard_user', $message->user_id)); ?>"
                 class="text-blue-600 hover:underline">Voir profil utilisateur</a>
        </p>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\components\message-highlighted.blade.php ENDPATH**/ ?>