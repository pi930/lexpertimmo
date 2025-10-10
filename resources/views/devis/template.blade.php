{{-- resources/views/devis/template.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Devis</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; font-size: 24px; margin-bottom: 20px; }
        .section { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">Votre devis personnalisé</div>

    <div class="section">
        <strong>Total TTC :</strong> {{ number_format($TTC, 2, ',', ' ') }} €
    </div>

    <div class="section">
        <strong>Prestations :</strong>
        <table>
            <thead>
                <tr>
                    <th>Désignation</th>
                    <th>Prix (€)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestations as $prestation)
                    <tr>
                        <td>{{ $prestation['nom'] ?? 'Non spécifié' }}</td>
                        <td>{{ number_format($prixTotal, 2, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h2>Résumé du devis</h2>
<p><strong>Type de bien :</strong> {{ $typeBien ?? 'Non spécifié' }}</p>
<p><strong>Surface :</strong> {{ $surface ?? 'Non spécifiée' }}</p>
</body>
</html>