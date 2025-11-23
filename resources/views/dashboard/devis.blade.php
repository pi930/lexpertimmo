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
@foreach($devis as $item)
    <tr class="border-t hover:bg-gray-100">
        @if($admin)
            <td class="px-4 py-2">{{ $item->user->nom ?? '—' }}</td>
            <td class="px-4 py-2">{{ $item->user->email ?? '—' }}</td>
        @endif

        <td class="px-4 py-2">{{ $item->objet ?? '—' }}</td>
        <td class="px-4 py-2">{{ number_format($item->total_ttc, 2, ',', ' ') }} €</td>
        <td class="px-4 py-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
        <td class="px-4 py-2 space-x-4">
            <a href="{{ Storage::url($item->pdf_path) }}" target="_blank" class="text-blue-600 hover:underline">📄 Télécharger</a>

            <form action="{{ route('devis.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('🗑️ Supprimer ce devis ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline text-sm">🗑️ Supprimer</button>
            </form>
        </td>
    </tr>

    @if($item->devisLignes->count())
        <tr>
            <td colspan="{{ $admin? 6 : 4 }}" class="px-4 py-2 bg-gray-50">
                <ul class="list-disc pl-4 text-sm text-gray-700">
                    @foreach($item->devisLignes as $ligne)
                        <li>{{ $ligne->objet->nom ?? 'Option inconnue' }} — {{ number_format($ligne->prix, 2, ',', ' ') }} €</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        @else
    <p>Aucune ligne de devis n’a été trouvée.</p>
    @endif
@endforeach
</tbody>
        </table>

        <div class="mt-4">
            {{ $devis->links() }}
        </div>
    @else
        <p class="text-gray-500">Aucun devis pour le moment.</p>
    @endif
</div>
