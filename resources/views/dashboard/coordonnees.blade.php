<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📍 Mes coordonnées</h2>

    @if($admin)
        <h3 class="text-xl font-semibold mt-6">📋 Liste des utilisateurs</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">Retour Admin</a>

        @if($coordonnees && $coordonnees->count())
            <table class="table-auto w-full border mt-4">
                <thead>…</thead>
                <tbody>
                    @foreach($coordonnees as $item)
                        <tr>
                            <td>{{ $item->nom}}</td>
                            <td>{{ $item->rue }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->telephone }}</td>
                            <td>{{ $item->code_postal }}</td>
                            <td>{{ $item->ville }}</td>
                            <td>{{ $item->pays }}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $coordonnees->links() }}
            </div>
        @endif
  @else
    <div class="bg-white p-6 rounded shadow">
        <p><strong>Nom :</strong> {{ $coordonnees->nom ?? $user->nom }}</p>
        <p><strong>Rue :</strong> {{ $coordonnees->rue ?? '—' }}</p>
        <p><strong>Email :</strong> {{ $coordonnees->email ?? $user->email }}</p>
        <p><strong>Téléphone :</strong> {{ $coordonnees->telephone ?? '—' }}</p>
        <p><strong>Code postale :</strong> {{ $coordonnees->code_postal ?? '—' }}</p>
        <p><strong>Ville :</strong> {{ $coordonnees->ville ?? '—' }}</p>
        <p><strong>Pays :</strong> {{ $coordonnees->pays ?? '—' }}</p>
        <p><strong>Inscrit le :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
    </div>

    {{-- Boutons Ajouter / Modifier --}}
    @if(Route::has('user.coordonnees.edit'))
        @if($coordonnees)
            <a href="{{ route('user.coordonnees.edit', $user->id) }}"
               class="btn btn-primary mt-3">
                ✏️ Modifier mes coordonnées
            </a>
        @else
            <a href="{{ route('user.coordonnees.edit', $user->id) }}"
               class="btn btn-success mt-3">
                ➕ Ajouter mes coordonnées
            </a>
        @endif
    @endif

    <a href="{{ route('user.dashboard', ['id' => $user->id]) }}" class="btn btn-outline-primary mt-3">
        Retour utilisateur
    </a>
@endif
</div>
