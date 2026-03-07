@props([
    'user' => null,
    'admin' => false,
    'coordonnees' => null,
])

<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📍 Mes coordonnées</h2>

    @if($coordonnees)
        <div class="bg-white p-6 rounded shadow">
            <p><strong>Nom :</strong> {{ $coordonnees->nom }}</p>
<p><strong>Rue :</strong> {{ $coordonnees->rue }}</p>
<p><strong>Email :</strong> {{ $coordonnees->email }}</p>
<p><strong>Téléphone :</strong> {{ $coordonnees->telephone }}</p>
<p><strong>Code postal :</strong> {{ $coordonnees->code_postal }}</p>
<p><strong>Ville :</strong> {{ $coordonnees->ville }}</p>
<p><strong>Pays :</strong> {{ $coordonnees->pays }}</p>
        </div>

        {{-- Bouton modifier --}}
        <a href="{{ route('coordonnees.form') }}" class="btn btn-primary mt-3">
    ✏️ Modifier mes coordonnées
</a>

    @else
        <div class="bg-white p-6 rounded shadow">
            <p><strong>Nom :</strong> {{ $user->nom }}</p>
            <p><strong>Rue :</strong> —</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Téléphone :</strong> —</p>
            <p><strong>Code postal :</strong> —</p>
            <p><strong>Ville :</strong> —</p>
            <p><strong>Pays :</strong> —</p>
        </div>

        {{-- Bouton ajouter --}}
<a href="{{ route('coordonnees.form') }}" class="btn btn-primary mt-3">
    ➕ Ajouter mes coordonnées
</a>

    @endif
</div>

