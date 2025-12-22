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
<?php $component = App\View\Components\Dashboard\Coordonnees::resolve(['user' => $user,'admin' => $admin] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
           <?php if (isset($component)) { $__componentOriginalcb418d915e679345752d3a85ae886be7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb418d915e679345752d3a85ae886be7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.devis','data' => ['devis' => $devis,'admin' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.devis'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['devis' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($devis),'admin' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
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


<?php if($rendezvous->isEmpty()): ?>
    
    <?php if(empty($propositions)): ?>
        <form action="<?php echo e(route('user.rendezvous.propositions')); ?>" method="GET">
            <button type="submit" class="btn btn-success">
                Prendre rendez-vous
            </button>
        </form>
    <?php else: ?>
        <h3>Choisissez un rendez-vous :</h3>
        <?php $__currentLoopData = $propositions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form action="<?php echo e(route('rendezvous.reserver')); ?>" method="POST" class="mb-2">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="zone" value="<?php echo e($rdv['zone']); ?>">
                <input type="hidden" name="date" value="<?php echo e($rdv['date']); ?>">
                <input type="hidden" name="travail_heure" value="<?php echo e($rdv['travail_heure']); ?>">
                <input type="hidden" name="rue" value="<?php echo e($rdv['rue']); ?>">
                <input type="hidden" name="code_postal" value="<?php echo e($rdv['code_postal']); ?>">
                <input type="hidden" name="ville" value="<?php echo e($rdv['ville']); ?>">
                <button type="submit" class="btn btn-primary">
                    <?php echo e($rdv['ville']); ?> — <?php echo e($rdv['date']->format('d/m/Y H:i')); ?>

                </button>
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php else: ?>
    
    <h3>Mes rendez-vous :</h3>
    <ul class="list-group">
        <?php $__currentLoopData = $rendezvous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>Zone :</strong> <?php echo e($rdv->zone); ?> <br>
                    <strong>Date :</strong> <?php echo e($rdv->date->format('d/m/Y H:i')); ?> <br>
                    <strong>Durée :</strong> <?php echo e($rdv->travail_heure); ?> heure(s) <br>
                    <strong>Adresse :</strong> <?php echo e($rdv->rue); ?>, <?php echo e($rdv->code_postal); ?> <?php echo e($rdv->ville); ?>

                </div>
                <div>
                    <form action="<?php echo e(route('rendezvous.supprimer', $rdv->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">
                            Supprimer
                        </button>
                    </form>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/pierrard/Documents/lexpertimmo/resources/views/Admin/dashboard_user.blade.php ENDPATH**/ ?>