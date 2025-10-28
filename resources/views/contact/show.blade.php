<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Message envoyé – Lexpertimmo</title>
</head>
<body>
  <h2>Message envoyé par {{ $contact->nom }}</h2>
  <p><strong>Email :</strong> {{ $contact->email }}</p>
  <p><strong>Téléphone :</strong> {{ $contact->telephone }}</p>
  <p><strong>Adresse :</strong> {{ $contact->rue }}, {{ $contact->code_postal }} {{ $contact->ville }}, {{ $contact->pays }}</p>
  <p><strong>Sujet :</strong> {{ $contact->sujet }}</p>
  <p><strong>Message :</strong><br>{{ $contact->message }}</p>

  <a href="{{ url()->previous() }}" style="color:#0033cc;">← Retour</a>
</body>
</html>