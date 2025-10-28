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
<?php if($latestNotifications->count() > 0): ?>
    <div class="bg-white dark:bg-gray-800 shadow rounded p-4 mb-6">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">
            📢 Dernières notifications (<?php echo e($unreadCount); ?> non lues)
        </h3>

        


        <div class="text-end mt-2">
            <a href="<?php echo e(route('admin.notifications.index')); ?>" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Voir toutes les notifications</a>
        </div>
    </div>
<?php endif; ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🧑 Aperçu du compte : <?php echo e($user->nom ?? 'Nom inconnu'); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

           
<div id="coordonnees" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        <h3 class="text-lg font-bold mb-2">📇 Coordonnées</h3>

        
        <?php if (isset($component)) { $__componentOriginale85d715c6d361672dc0af03c8b6139b2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale85d715c6d361672dc0af03c8b6139b2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.coordonnees','data' => ['user' => $user,'isAdmin' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.coordonnees'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user),'isAdmin' => true]); ?>
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

        
        <p>Email : <?php echo e($user->email); ?></p>
        <p>Téléphone : <?php echo e($user->coordonnee->telephone ?? 'Non renseigné'); ?></p>
        <p>Adresse :
            <?php echo e($user->coordonnee->rue ?? ''); ?>

            <?php echo e($user->coordonnee->code_postal ?? ''); ?>

            <?php echo e($user->coordonnee->ville ?? ''); ?>

            <?php echo e($user->coordonnee->pays ?? ''); ?>

        </p>
    </div>
</div>

            
            <div id="messages" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📬 Messages</h3>
                    <?php if (isset($component)) { $__componentOriginald8fdfe67279b3edf8330459024ea1b19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8fdfe67279b3edf8330459024ea1b19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.messages','data' => ['messages' => $messages,'isAdmin' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.messages'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($messages),'isAdmin' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8fdfe67279b3edf8330459024ea1b19)): ?>
<?php $attributes = $__attributesOriginald8fdfe67279b3edf8330459024ea1b19; ?>
<?php unset($__attributesOriginald8fdfe67279b3edf8330459024ea1b19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8fdfe67279b3edf8330459024ea1b19)): ?>
<?php $component = $__componentOriginald8fdfe67279b3edf8330459024ea1b19; ?>
<?php unset($__componentOriginald8fdfe67279b3edf8330459024ea1b19); ?>
<?php endif; ?>
                </div>
            </div>

            
            <div id="devis" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📄 Devis</h3>
                    <?php echo $__env->make('dashboard.devis', ['devis' => $devis, 'isAdmin' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            
            <div id="rendezvous" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📅 Rendez-vous</h3>
                     <p class="text-gray-500 italic">Module en cours de développement…</p>
                   
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
<?php endif; ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\admin\dashboard_admin.blade.php ENDPATH**/ ?>