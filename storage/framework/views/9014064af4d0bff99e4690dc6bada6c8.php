

<?php $__env->startSection('content'); ?>
    <?php if(auth()->user()->role === 'Admin'): ?>
    <div class="bg-white shadow rounded mb-6">
        <div class="px-6 py-4 flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold text-gray-800"><?php echo e($user->name); ?></p>
                <p class="text-sm text-gray-600"><?php echo e($user->email); ?></p>
            </div>
            <a href="<?php echo e(route('user.dashboard', ['id' => $user->id])); ?>"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                🧭 Accéder au tableau de bord
            </a>
        </div>
    </div>
<?php endif; ?>

    
    <div class="mb-6 flex gap-4 flex-wrap px-6">
        <a href="#coordonnees" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-sm">📍 Coordonnées</a>
        <a href="#messages" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-sm">📬 Messages</a>
        <a href="#devis" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-sm">📄 Devis</a>
        <a href="#rendezvous" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-sm">📅 Rendez-vous</a>
    </div>

    
    <div class="bg-white shadow rounded">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">📬 Messages</h2>
                </div>
                <div class="px-6 py-4">
                    <?php if (isset($component)) { $__componentOriginald8fdfe67279b3edf8330459024ea1b19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8fdfe67279b3edf8330459024ea1b19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.messages','data' => ['messages' => $messages,'admin' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.messages'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($messages),'admin' => true]); ?>
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

    
    <div id="coordonnees" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-2">📍 Vos coordonnées</h3>
            <?php if($coordonnees): ?>
            <?php if (isset($component)) { $__componentOriginal05a669ed05f24666dd8637b726a0bf72 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal05a669ed05f24666dd8637b726a0bf72 = $attributes; } ?>
<?php $component = App\View\Components\Dashboard\Coordonnees::resolve(['user' => $user,'admin' => auth()->user()->role === 'Admin'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.coordonnees'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Dashboard\Coordonnees::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal05a669ed05f24666dd8637b726a0bf72)): ?>
<?php $attributes = $__attributesOriginal05a669ed05f24666dd8637b726a0bf72; ?>
<?php unset($__attributesOriginal05a669ed05f24666dd8637b726a0bf72); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal05a669ed05f24666dd8637b726a0bf72)): ?>
<?php $component = $__componentOriginal05a669ed05f24666dd8637b726a0bf72; ?>
<?php unset($__componentOriginal05a669ed05f24666dd8637b726a0bf72); ?>
<?php endif; ?>
            <?php else: ?>
                <p class="text-gray-500">Aucune coordonnée enregistrée.</p>
                <a href="<?php echo e(route('coordonnees.form')); ?>" class="text-blue-600 underline">➕ Ajouter vos coordonnées</a>
            <?php endif; ?>
        </div>
    </div>

<div class="bg-white shadow rounded">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">📬 Mes messages</h2>
    </div>
    <div class="px-6 py-4">
        <?php if (isset($component)) { $__componentOriginald8fdfe67279b3edf8330459024ea1b19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8fdfe67279b3edf8330459024ea1b19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.messages','data' => ['messages' => $messages,'admin' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.messages'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($messages),'admin' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
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
            <h3 class="text-lg font-bold mb-2">📄 Vos devis</h3>
            <?php if(session('success')): ?>
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                    <?php echo e(session('success')); ?>

                    <?php if(session('devis_link')): ?>
                        <br>
                        <a href="<?php echo e(session('devis_link')); ?>" target="_blank" class="text-blue-600 underline">📄 Voir le devis</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
           <?php if (isset($component)) { $__componentOriginal1f5eef111affca8eb88c4f9cedef9ed2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f5eef111affca8eb88c4f9cedef9ed2 = $attributes; } ?>
<?php $component = App\View\Components\DashboardDevis::resolve(['devis' => $devis,'admin' => auth()->user()->role === 'Admin'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-devis'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\DashboardDevis::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f5eef111affca8eb88c4f9cedef9ed2)): ?>
<?php $attributes = $__attributesOriginal1f5eef111affca8eb88c4f9cedef9ed2; ?>
<?php unset($__attributesOriginal1f5eef111affca8eb88c4f9cedef9ed2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f5eef111affca8eb88c4f9cedef9ed2)): ?>
<?php $component = $__componentOriginal1f5eef111affca8eb88c4f9cedef9ed2; ?>
<?php unset($__componentOriginal1f5eef111affca8eb88c4f9cedef9ed2); ?>
<?php endif; ?>
        </div>
    </div>

    
    <div id="rendezvous" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-2">📅 Vos rendez-vous</h3>
            <?php if(isset($rendezvous)): ?>
                <?php $__empty_1 = true; $__currentLoopData = $rendezvous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="mb-4 border-b pb-2">
                        <p><strong>Date :</strong> <?php echo e($rdv->date->format('d/m/Y H:i')); ?></p>
                        <p><strong>Objet :</strong> <?php echo e($rdv->objet); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500">Aucun rendez-vous prévu.</p>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-gray-500">Les rendez-vous ne sont pas encore disponibles.</p>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/Admin/dashboard_user.blade.php ENDPATH**/ ?>