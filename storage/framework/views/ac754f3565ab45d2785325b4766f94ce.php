<h2>Répondre à <?php echo e($user->name); ?></h2>
<p>Message original : <?php echo e($message->contenu); ?></p>

<form action="<?php echo e(route('send.reply', $message->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="contact_id" value="<?php echo e($message->id); ?>">
    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
    <input type="hidden" name="admin" value="<?php echo e($admin); ?>">

    <textarea name="reponse" class="w-full border p-2" rows="5" placeholder="Votre réponse..."></textarea>
    <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2">Envoyer</button>
</form><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/contact/reply.blade.php ENDPATH**/ ?>