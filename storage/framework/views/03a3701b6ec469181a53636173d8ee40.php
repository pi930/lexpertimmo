

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Modifier mes coordonnées</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('coordonnees.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?php echo e(old('nom', $coordonnees->nom ?? '')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="rue" class="form-label">Rue</label>
            <input type="text" name="rue" id="rue" class="form-control" value="<?php echo e(old('rue', $coordonnees->rue ?? '')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="code_postal" class="form-label">Code postal</label>
            <input type="text" name="code_postal" id="code_postal" class="form-control" value="<?php echo e(old('code_postal', $coordonnees->code_postal ?? '')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" name="ville" id="ville" class="form-control" value="<?php echo e(old('ville', $coordonnees->ville ?? '')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="pays" class="form-label">Pays</label>
            <input type="text" name="pays" id="pays" class="form-control" value="<?php echo e(old('pays', $coordonnees->pays ?? '')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="<?php echo e(old('telephone', $coordonnees->telephone ?? '')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email', $coordonnees->email ?? '')); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\dashboard\coordonnees_form.blade.php ENDPATH**/ ?>