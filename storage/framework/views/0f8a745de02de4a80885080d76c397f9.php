<nav class="bg-gray-800 text-white px-6 py-3 flex justify-between items-center shadow">
    <div class="flex space-x-6">
        <?php if(Auth::user()->role === 'admin'): ?>
            <a href="<?php echo e(route('admin.dashboard_admin')); ?>" class="hover:underline">🏠 Tableau de bord</a>
        <?php else: ?>
            <a href="<?php echo e(route('dashboard.user')); ?>" class="hover:underline">🏠 Tableau de bord</a>
        <?php endif; ?>

        <a href="#coordonnees" class="hover:underline">📇 Coordonnées</a>
        <a href="#messages" class="hover:underline">📬 Messages</a>
        <a href="#devis" class="hover:underline">📄 Devis</a>
        <a href="#rendezvous" class="hover:underline">📅 Rendez-vous</a>
    </div>

    <div class="flex items-center space-x-4">
        <span class="text-sm"><?php echo e(Auth::user()->name); ?></span>
        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
            <?php echo csrf_field(); ?>
            <button type="submit" class="text-red-300 hover:text-red-500 text-sm">Déconnexion</button>
        </form>
    </div>
</nav><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/dashboard/menu.blade.php ENDPATH**/ ?>