<?php $__env->startComponent('mail::message'); ?>
# Bonjour <?php echo new \Illuminate\Support\EncodedHtmlString($user->nom); ?>


Merci pour votre demande de devis. Vous trouverez ci-joint votre document PDF.

<?php $__env->startComponent('mail::button', ['url' => $dashboardUrl ?? '#' ]); ?>
Accéder à votre espace client
<?php echo $__env->renderComponent(); ?>

Cordialement,<br>
L’équipe Lexpertimmobilier
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/pierrard/Documents/lexpertimmo/resources/views/emails/devis/cree.blade.php ENDPATH**/ ?>