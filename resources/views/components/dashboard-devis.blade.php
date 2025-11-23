<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📄 Devis reçus</h2>

    @if($devis->count())
        <table class="table-auto w-full border">
            <thead class="bg-gray-100">
                <tr>
                    @if($admin)
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                    @endif
                    <th class="px-4 py-2">Objet</th>
                    <th class="px-4 py-2">Montant TTC</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devis as $d)
                    <tr class="border-t">
                        @if($admin)
                            <td class="px-4 py-2">{{ $d->user->name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $d->user->email ?? '—' }}</td>
                        @endif
                        <td class="px-4 py-2">{{ $d->objet }}</td>
                        <td class="px-4 py-2">{{ number_format($d->montant_ttc, 2, ',', ' ') }} €</td>
                        <td class="px-4 py-2">{{ $d->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('devis.show', $d->id) }}" class="text-blue-600 underline">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $devis->links() }}
        </div>
    @else
        <p class="text-gray-600">Aucun devis pour le moment.</p>
    @endif
</div>
