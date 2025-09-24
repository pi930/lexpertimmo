<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Messages reçus – Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background-color: #f9f9f9;
      color: #333;
    }

    h2 {
      color: #0033cc;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #0033cc;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .back {
      margin-top: 20px;
      display: inline-block;
      background-color: #cc0000;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
    }

    .back:hover {
      background-color: #a80000;
    }
  </style>
</head>
<body>

  <h2>📬 Messages reçus</h2>

  <table>
    <thead>
      <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Adresse</th>
        <th>Ville</th>
        <th>Pays</th>
        <th>Sujet</th>
        <th>Message</th>
        <th>Reçu le</th>
      </tr>
    </thead>
    <tbody>
      @foreach($contacts as $contact)
      <tr>
        <td>{{ $contact->nom }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->telephone }}</td>
        <td>{{ $contact->rue }} {{ $contact->code_postal }}</td>
        <td>{{ $contact->ville }}</td>
        <td>{{ $contact->pays }}</td>
        <td>{{ $contact->sujet }}</td>
        <td>{{ $contact->message }}</td>
        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <a href="/contact" class="back">← Retour au formulaire</a>

</body>
</html>