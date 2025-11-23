<nav class="bg-white border-b border-gray-200 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        
        <!-- Menu principal -->
        <div class="flex flex-wrap md:flex-nowrap space-x-4 md:space-x-6 items-center font-semibold text-sm text-gray-800">
            <a href="<?php echo e(Auth::user()->dashboardLink()); ?>"
               class="px-3 py-2 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 hover:text-blue-900 transition">
                🏠 Tableau de bord
            </a>

            <a href="#messages"
               class="px-3 py-2 rounded bg-red-100 text-red-600 hover:bg-red-200 hover:text-red-800 transition">
                📬 Messages
            </a>

            <a href="#coordonnees"
               class="px-3 py-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 transition">
                📇 Coordonnées
            </a>

            <a href="#devis"
               class="px-3 py-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 transition">
                📄 Devis
            </a>
        </div>

        <!-- Zone utilisateur -->
        <div class="flex items-center space-x-4 text-sm">
            <?php if(Auth::user()->role === 'Admin'): ?>
                <?php if (isset($component)) { $__componentOriginal8bd4bbe52b77f502d098d26b3cc8fa73 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8bd4bbe52b77f502d098d26b3cc8fa73 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.notifications','data' => ['notifications' => $latestNotifications]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.notifications'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['notifications' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($latestNotifications)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8bd4bbe52b77f502d098d26b3cc8fa73)): ?>
<?php $attributes = $__attributesOriginal8bd4bbe52b77f502d098d26b3cc8fa73; ?>
<?php unset($__attributesOriginal8bd4bbe52b77f502d098d26b3cc8fa73); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8bd4bbe52b77f502d098d26b3cc8fa73)): ?>
<?php $component = $__componentOriginal8bd4bbe52b77f502d098d26b3cc8fa73; ?>
<?php unset($__componentOriginal8bd4bbe52b77f502d098d26b3cc8fa73); ?>
<?php endif; ?>
            <?php endif; ?>

            <span class="text-gray-700 font-medium">
                👤 <?php echo e(Auth::user()->name); ?>

            </span>

            <!-- Retour accueil -->
            <a href="<?php echo e(route('home')); ?>"
               class="px-3 py-2 rounded bg-green-100 text-green-700 hover:bg-green-200 hover:text-green-900 transition">
                🏠 Retour à l’accueil
            </a>

            <!-- Déconnexion -->
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit"
                        class="px-3 py-2 rounded bg-red-100 text-red-500 hover:bg-red-200 hover:text-red-700 font-semibold transition">
                    🔓 Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/dashboard/menu.blade.php ENDPATH**/ ?>