div class="space-y-6">
    <h2 class="text-2xl font-semibold">📍 Coordonnées des utilisateurs</h2>

    @if($isAdmin)
        @if($coordonnees->count())
            <table class="table-auto w-full border">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Téléphone</th>
                        <th class="px-4 py-2">Adresse</th>
                        <th class="px-4 py-2">Ville</th>
                        <th class="px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coordonnees as $item)
                        <tr class="border-t hover:bg-gray-100 cursor-pointer"
                            onclick="window.location='{{ route('admin.dashboard.user', ['id' => $item->user_id]) }}'">
                            <td class="px-4 py-2">{{ $item->nom }}</td>
                            <td class="px-4 py-2">{{ $item->email }}</td>
                            <td class="px-4 py-2">{{ $item->telephone }}</td>
                            <td class="px-4 py-2">{{ $item->rue }} {{ $item->code_postal }}</td>
                            <td class="px-4 py-2">{{ $item->ville }}</td>
                            <td class="px-4 py-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $coordonnees->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucune coordonnée enregistrée.</p>
        @endif
    @else
        <p class="text-red-500">Accès réservé à l’administrateur.</p>
    @endif
</div>
