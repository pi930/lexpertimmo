<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'notifications' => [],
    'unreadCount' => 0,
    'link' => route('admin.notifications.index'),
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'notifications' => [],
    'unreadCount' => 0,
    'link' => route('admin.notifications.index'),
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>;

<div x-data="{ openNotif: false }" class="relative">
    <!-- Bouton cloche -->
    <button @click="openNotif = !openNotif"
            :aria-expanded="openNotif"
            aria-controls="notifDropdown"
            class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
        <svg class="w-5 h-5 me-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <?php if($unreadCount > 0): ?>
            <span class="absolute top-0 start-6 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                <?php echo e($unreadCount); ?>

            </span>
        <?php endif; ?>
    </button>

    <!-- Dropdown -->
    <div id="notifDropdown"
         x-show="openNotif"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.away="openNotif = false"
         class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-md shadow-lg z-50"
    >
        <div class="px-4 py-2 border-t border-gray-200">
            <h4 class="text-sm font-semibold text-gray-700 mb-2">Notifications</h4>

            <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e($notif->url ?? '#'); ?>" class="block px-2 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded">
                    <?php echo e($notif->content); ?>

                    <?php if(!$notif->read): ?>
                        <span class="inline-block ms-2 px-2 py-0.5 text-xs bg-yellow-400 text-black rounded">Non lu</span>
                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-gray-500">Aucune notification</p>
            <?php endif; ?>

            <div class="mt-2 text-end">
                <a href="<?php echo e($link); ?>" class="text-xs text-blue-600 hover:underline">Voir toutes les notifications</a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/components/dashboard/notifications.blade.php ENDPATH**/ ?>