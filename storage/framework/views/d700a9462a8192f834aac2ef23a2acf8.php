

<?php $__env->startSection('content'); ?>

    
    <div class="bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php if (isset($component)) { $__componentOriginal5affe3deeb53f993a902a480219b8102 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5affe3deeb53f993a902a480219b8102 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.summary','data' => ['messages' => $messages,'devis' => $devis,'rendezvous' => $rendezvous]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($messages),'devis' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($devis),'rendezvous' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rendezvous)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5affe3deeb53f993a902a480219b8102)): ?>
<?php $attributes = $__attributesOriginal5affe3deeb53f993a902a480219b8102; ?>
<?php unset($__attributesOriginal5affe3deeb53f993a902a480219b8102); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5affe3deeb53f993a902a480219b8102)): ?>
<?php $component = $__componentOriginal5affe3deeb53f993a902a480219b8102; ?>
<?php unset($__componentOriginal5affe3deeb53f993a902a480219b8102); ?>
<?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            
            <div class="bg-white shadow rounded">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">📇 Coordonnées</h2>
                </div>
                <div class="px-6 py-4">
                    <?php if (isset($component)) { $__componentOriginal05a669ed05f24666dd8637b726a0bf72 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal05a669ed05f24666dd8637b726a0bf72 = $attributes; } ?>
<?php $component = App\View\Components\Dashboard\Coordonnees::resolve(['user' => $user,'admin' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.coordonnees'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Dashboard\Coordonnees::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['coordonnees' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($coordonnees)]); ?>
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
                </div>
            </div>
            
            
<div class="bg-white shadow rounded">
    <div class="px-6 py-4 flex items-center justify-between">
        <div>
            <p class="text-lg font-semibold text-gray-800"><?php echo e($user->name); ?></p>
            <p class="text-sm text-gray-600"><?php echo e($user->email); ?></p>
        </div>
       <a href="<?php echo e(route('user.dashboard_user', ['id' => $user->id])); ?>"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            🧭 Accéder au tableau de bord
        </a>
    </div>
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

            
   <div class="bg-white shadow rounded">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">
            📄 Devis
        </h2>
      <?php if (isset($component)) { $__componentOriginalcb418d915e679345752d3a85ae886be7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb418d915e679345752d3a85ae886be7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.devis','data' => ['devis' => $devis,'admin' => $admin]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.devis'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['devis' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($devis),'admin' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($admin)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcb418d915e679345752d3a85ae886be7)): ?>
<?php $attributes = $__attributesOriginalcb418d915e679345752d3a85ae886be7; ?>
<?php unset($__attributesOriginalcb418d915e679345752d3a85ae886be7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcb418d915e679345752d3a85ae886be7)): ?>
<?php $component = $__componentOriginalcb418d915e679345752d3a85ae886be7; ?>
<?php unset($__componentOriginalcb418d915e679345752d3a85ae886be7); ?>
<?php endif; ?>
    </div>
</div>
    <div class="px-6 py-4">
        
        <?php if(session('success')): ?>
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                <?php echo e(session('success')); ?>

                <?php if(session('devis_link')): ?>
                    <br>
                    <a href="<?php echo e(session('devis_link')); ?>" target="_blank" class="text-blue-600 underline">
                        📄 Voir le devis
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php echo $__env->make('dashboard.devis', ['devis' => $devis, 'admin' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>


            
            <div class="bg-white shadow rounded">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">📅 Rendez-vous</h2>
                </div>
                <div class="px-6 py-4 text-gray-500 italic">
                    Module en cours de développement…
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/Admin/dashboard_Admin.blade.php ENDPATH**/ ?>