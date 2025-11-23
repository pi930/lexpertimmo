@component('mail::message')
# Bonjour {{ $user->name }}

Merci pour votre demande de devis. Vous trouverez ci-joint votre document PDF.

@component('mail::button', ['url' => $dashboardUrl ?? '#' ])
Accéder à votre espace client
@endcomponent

Cordialement,<br>
L’équipe Lexpertimmobilier
@endcomponent
