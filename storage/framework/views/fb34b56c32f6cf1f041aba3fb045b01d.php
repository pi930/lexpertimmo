<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📬 Messages reçus</h2>

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($admin): ?>
        <?php if($messages->count()): ?>
            <table class="table-auto w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Sujet</th>
                        <th class="px-4 py-2">Message</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2"><?php echo e($contact->nom); ?></td>
                            <td class="px-4 py-2"><?php echo e($contact->email); ?></td>
                            <td class="px-4 py-2"><?php echo e($contact->sujet); ?></td>
                            <td class="px-4 py-2"><?php echo e(Str::limit($contact->message, 80)); ?></td>
                            <td class="px-4 py-2"><?php echo e($contact->created_at->format('d/m/Y H:i')); ?></td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="<?php echo e(route('contact.edit', $contact->id)); ?>" class="text-sm text-yellow-600 hover:underline">Modifier</a>
                                <form action="<?php echo e(route('messages.destroy', $contact->id)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-sm text-red-600 hover:underline" onclick="return confirm('Supprimer ce message ?')">Supprimer</button>
                                </form>
                                <a href="<?php echo e(route('messages.reply', $contact->id)); ?>" class="text-sm text-blue-600 hover:underline">Répondre</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="bg-blue-100 text-blue-800 p-4 rounded">
    Composant messages chargé avec succès.
</div>
            <div class="mt-4"><?php echo e($messages->links()); ?></div>
        <?php else: ?>
            <p class="text-gray-500">Aucun message pour le moment.</p>
        <?php endif; ?>
    <?php else: ?>
<?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="border rounded p-4 mb-3 bg-white shadow-sm">
        <strong><?php echo e($message->nom); ?></strong> (<?php echo e($message->email); ?>)<br>
        <em>Message de <?php echo e($message->user->name ?? $message->nom); ?></em><br>
        <p><?php echo e($message->message); ?></p>
        <small>Reçu le <?php echo e($message->created_at->format('d/m/Y à H:i')); ?></small>

        
        <?php if(!empty($message->reponse)): ?>
            <div class="mt-2 p-2 bg-green-100 text-green-800 rounded">
                <strong>Réponse de l’admin :</strong><br>
                <?php echo e($message->reponse); ?>

            </div>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p class="text-gray-500">Vous n’avez pas encore envoyé de message.</p>
<?php endif; ?>
        <div class="mt-4"><?php echo e($messages->links()); ?></div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/components/dashboard/messages.blade.php ENDPATH**/ ?>