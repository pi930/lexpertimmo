<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php echo $__env->make('dashboard.menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧑 Tableau de bord utilisateur
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div id="coordonnees" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📍 Vos coordonnées</h3>
                    <?php if (isset($component)) { $__componentOriginale85d715c6d361672dc0af03c8b6139b2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale85d715c6d361672dc0af03c8b6139b2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.coordonnees','data' => ['coordonnees' => $coordonnees,'isAdmin' => false,'user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.coordonnees'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['coordonnees' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($coordonnees),'isAdmin' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale85d715c6d361672dc0af03c8b6139b2)): ?>
<?php $attributes = $__attributesOriginale85d715c6d361672dc0af03c8b6139b2; ?>
<?php unset($__attributesOriginale85d715c6d361672dc0af03c8b6139b2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale85d715c6d361672dc0af03c8b6139b2)): ?>
<?php $component = $__componentOriginale85d715c6d361672dc0af03c8b6139b2; ?>
<?php unset($__componentOriginale85d715c6d361672dc0af03c8b6139b2); ?>
<?php endif; ?>
                </div>
            </div>

            
            <div id="messages" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📬 Vos messages</h3>
                    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mb-4 border-b pb-2">
                            <p><strong>Sujet :</strong> <?php echo e($message->sujet); ?></p>
                            <p><strong>Contenu :</strong> <?php echo e($message->contenu); ?></p>
                            <p><strong>Envoyé le :</strong> <?php echo e($message->created_at->format('d/m/Y H:i')); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-500">Aucun message pour le moment.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div id="devis" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📄 Vos devis</h3>
                    <?php echo $__env->make('dashboard.devis', ['devis' => $devis, 'isAdmin' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            
            <div id="rendezvous" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📅 Vos rendez-vous</h3>
                    <?php $__empty_1 = true; $__currentLoopData = $rendezvous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mb-4 border-b pb-2">
                            <p><strong>Date :</strong> <?php echo e($rdv->date->format('d/m/Y H:i')); ?></p>
                            <p><strong>Objet :</strong> <?php echo e($rdv->objet); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-500">Aucun rendez-vous prévu.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">🧪 Diagnostic final</h3>
                    <?php if($diagnostic): ?>
                        <p><strong>Résumé :</strong> <?php echo e($diagnostic->resume); ?></p>
                        <p><strong>Évaluation :</strong> <?php echo e($diagnostic->evaluation); ?></p>
                        <p><strong>Date :</strong> <?php echo e($diagnostic->created_at->format('d/m/Y')); ?></p>
                    <?php else: ?>
                        <p class="text-gray-500">Aucun diagnostic disponible.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\admin\dashboard_user.blade.php ENDPATH**/ ?>