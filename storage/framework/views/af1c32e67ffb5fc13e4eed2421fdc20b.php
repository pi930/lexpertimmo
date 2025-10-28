<?PHP
@component('mail::message')
# Bonjour {{ $user->name }},

Merci d’avoir réalisé un devis chez **Lexpertimmobilier** 🏡  
Nous avons bien pris en compte votre demande.

📎 Vous trouverez votre devis en pièce jointe.

---

## 📅 Prochaine étape : planifiez votre rendez-vous

Pour aller plus loin, vous pouvez dès maintenant réserver un créneau avec notre équipe :

@component('mail::button', ['url' => $rendezvousUrl])
Prendre rendez-vous
@endcomponent

---

Nous restons à votre disposition pour toute question.  
À très bientôt sur **Lexpertimmobilier** !

**Cordialement,**  
L’équipe Lexpertimmobilier
@endcomponent ?><?php /**PATH C:\laragon\laragon\www\lexpertimmo\resources\views\emails\devis\cree.blade.php ENDPATH**/ ?>