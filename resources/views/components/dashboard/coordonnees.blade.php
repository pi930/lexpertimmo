@props([
    'user' => null,
    'admin' => false,
    'coordonnees' => null,
])
<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📍 Mes coordonnées</h2>

    @if($coordonnees)
    <div class="bg-white p-6 rounded shadow">
        <p><strong>Nom :</strong> {{ $coordonnees->last_name }}</p>
        <p><strong>Rue :</strong> {{ $coordonnees->rue }}</p>
        <p><strong>Email :</strong> {{ $coordonnees->email }}</p>
        <p><strong>Téléphone :</strong> {{ $coordonnees->telephone }}</p>
        <p><strong>Code postal :</strong> {{ $coordonnees->code_postale }}</p>
        <p><strong>Ville :</strong> {{ $coordonnees->ville }}</p>
        <p><strong>Pays :</strong> {{ $coordonnees->Pays }}</p>
    </div>
@else
    <p class="text-gray-600">Aucune coordonnée enregistrée.</p>
@endif
</div>
