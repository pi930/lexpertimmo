<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'user' => null,
    'admin' => false,
    'coordonnees' => null,
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
    'user' => null,
    'admin' => false,
    'coordonnees' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📍 Mes coordonnées</h2>

    <?php if($coordonnees): ?>
    <div class="bg-white p-6 rounded shadow">
        <p><strong>Nom :</strong> <?php echo e($coordonnees->last_name); ?></p>
        <p><strong>Rue :</strong> <?php echo e($coordonnees->rue); ?></p>
        <p><strong>Email :</strong> <?php echo e($coordonnees->email); ?></p>
        <p><strong>Téléphone :</strong> <?php echo e($coordonnees->telephone); ?></p>
        <p><strong>Code postal :</strong> <?php echo e($coordonnees->code_postale); ?></p>
        <p><strong>Ville :</strong> <?php echo e($coordonnees->ville); ?></p>
        <p><strong>Pays :</strong> <?php echo e($coordonnees->Pays); ?></p>
    </div>
<?php else: ?>
    <p class="text-gray-600">Aucune coordonnée enregistrée.</p>
<?php endif; ?>
</div>
<?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views/components/dashboard/coordonnees.blade.php ENDPATH**/ ?>