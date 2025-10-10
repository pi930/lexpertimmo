@props(['isAdmin'])

<h2 class="text-xl font-bold mb-4">👤 Coordonnées</h2>

<table class="table-auto w-full mb-6">
    <tr><td>Nom</td><td>{{ Auth::user()->name }}</td></tr>
    <tr><td>Email</td><td>{{ Auth::user()->email }}</td></tr>
    <tr><td>Téléphone</td><td>{{ Auth::user()->telephone ?? 'Non renseigné' }}</td></tr>
    @if($isAdmin)
        <tr><td>Mot de passe</td><td>••••••••</td></tr>
    @endif
</table>
