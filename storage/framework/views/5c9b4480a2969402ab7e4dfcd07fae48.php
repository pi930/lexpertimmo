

<?php $__env->startSection('content'); ?>
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">✏️ Modifier le message</h2>

    <form action="<?php echo e(route('messages.update', $contact->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label class="block text-gray-700">Sujet</label>
            <input type="text" name="sujet" value="<?php echo e(old('sujet', $contact->sujet)); ?>"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Message</label>
            <textarea name="message" rows="5"
                      class="w-full border rounded px-3 py-2"><?php echo e(old('message', $contact->message)); ?></textarea>
        </div>

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            💾 Enregistrer
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/contact/edit.blade.php ENDPATH**/ ?>