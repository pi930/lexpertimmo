<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Message envoyé – Lexpertimmo</title>
</head>
<body>
  <h2>Message envoyé par <?php echo e($contact->nom); ?></h2>
  <p><strong>Email :</strong> <?php echo e($contact->email); ?></p>
  <p><strong>Téléphone :</strong> <?php echo e($contact->telephone); ?></p>
  <p><strong>Adresse :</strong> <?php echo e($contact->rue); ?>, <?php echo e($contact->code_postal); ?> <?php echo e($contact->ville); ?>, <?php echo e($contact->pays); ?></p>
  <p><strong>Sujet :</strong> <?php echo e($contact->sujet); ?></p>
  <p><strong>Message :</strong><br><?php echo e($contact->message); ?></p>

  <a href="<?php echo e(url()->previous()); ?>" style="color:#0033cc;">← Retour</a>
</body>
</html><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\contact\show.blade.php ENDPATH**/ ?>