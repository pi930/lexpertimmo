

<?php $__env->startSection('content'); ?>
<style>
    body {
        background: linear-gradient(to right, red, white, blue);
        min-height: 100vh;
        padding-bottom: 100px;
    }
    .table-title {
        margin-top: 2rem;
        font-size: 1.5rem;
        font-weight: bold;
    }
    table {
        background-color: white;
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 2rem;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
        border: 1px solid #ccc;
        padding: 0.75rem;
        text-align: center;
    }
    .prestations-section {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 3rem;
    }
    .prestations-section h3 {
        margin-bottom: 1rem;
    }
    .prestations-section .form-check {
        margin-bottom: 0.5rem;
    }
    .login-prompt {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #ffffffcc;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        font-size: 1rem;
    }
</style>

<div class="container">
    <h1 class="mb-4">Nos prestations</h1>

    <?php if(auth()->guard()->check()): ?>
        <p class="text-success">Bienvenue <?php echo e(Auth::user()->name); ?> !</p>
    <?php else: ?>
        <p class="text-warning">Connectez-vous pour créer un devis personnalisé.</p>
    <?php endif; ?>

    <div class="row">
        <?php $__currentLoopData = $prestations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prestation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($prestation->titre); ?></h5>
                        <p class="card-text"><?php echo e($prestation->description); ?></p>
                        <p class="card-text"><strong>Prix :</strong> <?php echo e($prestation->prix); ?> €</p>

                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('devis.genererApresLogin', ['prestation' => $prestation->id])); ?>" class="btn btn-primary">Créer mon devis</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-secondary">Se connecter pour créer un devis</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="table-title">Maison à vendre</div>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>< 50m²</th>
                <th>< 100m²</th>
                <th>< 150m²</th>
                <th>< 200m²</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Amiante, Surface, Termites, DPE, ELEC, ERP</td><td>290€ TTC</td><td>390€ TTC</td><td>470€ TTC</td><td>550€ TTC</td></tr>
            <tr><td>Gaz cuisson</td><td>+40€</td><td>+40€</td><td>+40€</td><td>+40€</td></tr>
            <tr><td>Gaz chaudière</td><td>+50€</td><td>+50€</td><td>+50€</td><td>+50€</td></tr>
            <tr><td>Plomb (maison < 1949)</td><td>+50€</td><td>+90€</td><td>+130€</td><td>+170€</td></tr>
            <tr><td>Zone non habitable < 50m²</td><td>+70€ TTC</td><td>+70€ TTC</td><td>+70€ TTC</td><td>+70€ TTC</td></tr>
            <tr><td>Zone non habitable < 100m²</td><td>+100€ TTC</td><td>+100€ TTC</td><td>+100€ TTC</td><td>+100€ TTC</td></tr>
            <tr><td>Zone non habitable < 150m²</td><td>+130€</td><td>+130€</td><td>+130€</td><td>+130€</td></tr>
            <tr><td>Zone non habitable < 200m²</td><td>+160€</td><td>+160€</td><td>+160€</td><td>+160€</td></tr>
        </tbody>
    </table>

    <div class="table-title">Maison à louer</div>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>< 50m²</th>
                <th>< 100m²</th>
                <th>< 150m²</th>
                <th>< 200m²</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Amiante, Surface, Termites, DPE, ELEC, ERP</td><td>269€ TTC</td><td>350€ TTC</td><td>450€ TTC</td><td>490€ TTC</td></tr>
            <tr><td>Gaz cuisson</td><td>+40€</td><td>+40€</td><td>+40€</td><td>+40€</td></tr>
            <tr><td>Gaz chaudière</td><td>+30€</td><td>+30€</td><td>+30€</td><td>+30€</td></tr>
            <tr><td>Plomb (maison < 1949)</td><td>+50€</td><td>+80€</td><td>+110€</td><td>+140€</td></tr>
            <tr><td>Zone non habitable < 50m²</td><td>+70€ TTC</td><td>+70€ TTC</td><td>+70€ TTC</td><td>+70€ TTC</td></tr>
            <tr><td>Zone non habitable < 100m²</td><td>+100€ TTC</td><td>+100€ TTC</td><td>+100€ TTC</td><td>+100€ TTC</td></tr>
            <tr><td>Zone non habitable < 150m²</td><td>+130€ TTC</td><td>+130€ TTC</td><td>+130€ TTC</td><td>+130€ TTC</td></tr>
            <tr><td>Zone non habitable < 200m²</td><td>+160€ TTC</td><td>+160€ TTC</td><td>+160€ TTC</td><td>+160€ TTC</td></tr>
        </tbody>
    </table>
</hr>
</hr>
</hr>

   <div class="prestations-section">
    <h3>Prestations</h3>
    <form method="POST" action="<?php echo e(route('devis.calculer')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Type de bien :</label><br>
            <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="typeBien" id="vente" value="vente" required>
                     <?php echo e(in_array('vente', old('options', [])) ? 'checked' : ''); ?>>

                <label class="form-check-label" for="vente">Maison à vendre</label>
            </div>
</hr>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="typeBien" id="location" value="location">
                 <?php echo e(in_array('location', old('options', [])) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="location">Maison à louer</label>
            </div>
        </div>
</hr>
        <div class="mb-3">
    <label class="form-label">Prestations supplémentaires :</label><br>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="gaz_cuisson" id="gaz_cuisson">
        <?php echo e(in_array('gaz_cuisson', old('options', [])) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="gaz_cuisson">Gaz cuisson</label>
</div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="gaz_chaudiere" id="gaz_chaudiere">
        <?php echo e(in_array('gaz_chaudiere', old('options', [])) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="gaz_chaudiere">Gaz chaudière</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="plomb" id="plomb">
          <?php echo e(in_array('plmob', old('options', [])) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="plomb">Plomb (maison < 1949)</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="zone_non_habitable_50" id="zone_non_habitable_50">
         <?php echo e(in_array('zone_non_habitable_50', old('options', [])) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="zone_non_habitable_50">Zone non habitable < 50m²</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="zone_non_habitable_100" id="zone_non_habitable_100">
        <?php echo e(in_array('zone_non_habitable_100', old('options', [])) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="zone_non_habitable_100">Zone non habitable < 100m²</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="zone_non_habitable_150" id="zone_non_habitable_150">
        <?php echo e(in_array('zone_non_habitable_150', old('options', [])) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="zone_non_habitable_150">Zone non habitable < 150m²</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="zone_non_habitable_200" id="zone_non_habitable_200">
         <?php echo e(in_array('zone_non_habitable_200', old('options', [])) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="zone_non_habitable_200">Zone non habitable < 200m²</label>
    </div>
</div>
</hr>

        <div class="mb-3">
            <label class="form-label">Surface :</label><br>
            <?php $__currentLoopData = ['<50m²','<100m²','<150m²','<200m²']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surface): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="surface" id="surface<?php echo e($loop->index); ?>" value="<?php echo e($surface); ?>" required>
                    <label class="form-check-label" for="surface<?php echo e($loop->index); ?>">Maison <?php echo e($surface); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
</hr>
</hr>

        <button type="submit" class="btn btn-primary">Calculer</button>
    
</div>
    </form>
</div>

    <?php if(auth()->guard()->guest()): ?>
        <div class="login-prompt">
            Connectez-vous pour recevoir le devis par email
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\prestations.blade.php ENDPATH**/ ?>