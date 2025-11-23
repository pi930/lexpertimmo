<div>
    <div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">📍 Coordonnées</h2>

    @if(isset($user))
        <p><strong>Nom :</strong> {{ $user->last_name }}</p>
        <p><strong>Rue :</strong> {{ $user->rue }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
       {{-- <p><strong>Téléphone :</strong> {{ $user->phone }}</p>--}}
        <p><strong>Code postal :</strong> {{ $user->code_postale }}</p>
        <p><strong>Ville :</strong> {{ $user->ville }}</p>
        <p><strong>Pays :</strong> {{ $user->Pays }}</p>
        <p><strong>Inscrit le :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
    @else
        <p class="text-gray-500 italic">Aucune information utilisateur disponible.</p>
    @endif
</div>
</div>
