<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    
    

    
    <div class="bg-white p-4 rounded shadow text-center">
        <p class="text-sm text-gray-500">Messages</p>
        <p class="text-xl font-bold text-blue-600"><?php echo e($messages->count()); ?></p>
    </div>

    
    <div class="bg-white p-4 rounded shadow text-center">
        <p class="text-sm text-gray-500">Devis</p>
        <p class="text-xl font-bold text-green-600"><?php echo e($devis->count()); ?></p>
    </div>

    
    <div class="bg-white p-4 rounded shadow text-center">
        <p class="text-sm text-gray-500">Rendez-vous</p>
        <p class="text-xl font-bold text-purple-600"><?php echo e($rendezvous->count() ?? 0); ?></p>
    </div>
</div>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/components/dashboard/summary.blade.php ENDPATH**/ ?>