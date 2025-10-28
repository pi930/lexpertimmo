<<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📍 Mes coordonnées</h2>

    <?php if($isAdmin): ?>
 
        <h3 class="text-xl font-semibold mt-6">📋 Liste des utilisateurs</h3>
         <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-dark">Retour admin</a>

        <?php if($coordonnees->count()): ?>
<table class="table-auto w-full border mt-4">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">rue</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Téléphone</th>
                         <th class="px-4 py-2">code_postale</th>
                        <th class="px-4 py-2">ville</th>
                         <th class="px-4 py-2">pâys</th>
                        <th class="px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $coordonnees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t hover:bg-gray-100 cursor-pointer"
                            onclick="window.location='<?php echo e(route('admin.dashboard.user', ['id' => $item->user_id])); ?>'">
                            <td class="px-4 py-2"><?php echo e($item->last_name); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->rue); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->email); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->phone); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->code_postale); ?></td>
                               <td class="px-4 py-2"><?php echo e($item->ville); ?></td>
                                <td class="px-4 py-2"><?php echo e($item->Pays); ?></td>
                            <td class="px-4 py-2"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="mt-4">
                <?php echo e($coordonnees->links()); ?>

            </div>
       
       
        <?php endif; ?>

    <?php else: ?>
 
        <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
            <p><strong>Nom :</strong> <?php echo e($user->last_name); ?></p>
            <p><strong>rue:</strong> <?php echo e($user->rue); ?></p>
            <p><strong>Email :</strong> <?php echo e($user->email); ?></p>
            <p><strong>Téléphone :</strong> <?php echo e($user->phone); ?></p>
            <p><strong>Code postale :</strong> <?php echo e($user->code_postale); ?></p>
            <p><strong>Ville  :</strong> <?php echo e($user->ville); ?></p>
               <p><strong> Pays:</strong> <?php echo e($user->Pays); ?></p>
            <p><strong>Inscrit le :</strong> <?php echo e($user->created_at->format('d/m/Y H:i')); ?></p>
        </div>
          <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-outline-primary">Retour utilisateur</a>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\dashboard\coordonnees.blade.php ENDPATH**/ ?>