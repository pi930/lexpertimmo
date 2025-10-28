@props(['devis', 'isAdmin' => false])

<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📄 Mes devis</h2>
    @if($isAdmin)
    <p class="text-sm text-blue-600">[Vue admin]</p>
@else
    <p class="text-sm text-green-600">[Vue utilisateur]</p>
@endif

    @if($devis && $devis->count())
        <table class="table-auto w-full border mt-4">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Montant</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Date</th>
                    @if($isAdmin)
                        <th class="px-4 py-2">Utilisateur</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($devis as $item)
                    <tr class="border-t hover:bg-gray-100 cursor-pointer">
                        <td class="px-4 py-2">{{ $item->type }}</td>
                        <td class="px-4 py-2">{{ $item->montant }} €</td>
                        <td class="px-4 py-2">{{ $item->statut }}</td>
                        <td class="px-4 py-2">{{ $item->created_at->format('d/m/Y') }}</td>
                        @if($isAdmin)
                            <td class="px-4 py-2">{{ $item->user->nom ?? '—' }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $devis->links() }}
        </div>
    @else
        <p class="text-gray-500">Aucun devis enregistré.</p>
    @endif
</div>