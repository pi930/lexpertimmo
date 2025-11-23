{{-- resources/views/devis/template.blade.php --}}
<div class="section">
    <strong>Client :</strong> {{ $user->name }}<br>
    <strong>Email :</strong> {{ $user->email }}
    <strong>Total TTC :</strong> {{ number_format($prixTotal, 2, ',', ' ') }} €
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
                    <td>{{ number_format($prestation['prix'], 2, ',', ' ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
