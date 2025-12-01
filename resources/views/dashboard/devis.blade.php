<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📄 Devis reçus</h2>

    {{-- ✅ Messages flash --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('devis_link'))
        <a href="{{ session('devis_link') }}" 
           class="text-blue-600 hover:underline" target="_blank">
           📄 Voir le devis
        </a>
    @endif

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
                        <td class="px-4 py-2">{{ $item->objet }}</td>
                        <td class="px-4 py-2">{{ number_format($item->total_ttc, 2, ',', ' ') }} €</td>
                        <td class="px-4 py-2">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('devis.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('🗑️ Supprimer ce devis ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">🗑️ Supprimer</button>
                            </form>
                        </td>
                    </tr>

                    @if($item->devisLignes->count())
                        <tr>
                            <td colspan="{{ $admin ? 6 : 4 }}" class="px-4 py-2 bg-gray-50">
                                <ul class="list-disc pl-4 text-sm text-gray-700">
                                    @foreach($item->devisLignes as $ligne)
                                        <li>
    {{ $ligne->objet->nom ?? $ligne->designation ?? 'Option inconnue' }}
    — {{ number_format($ligne->total_ttc, 2, ',', ' ') }} €
</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="{{ $admin ? 6 : 4 }}" class="px-4 py-2 text-gray-500">
                                Aucune ligne de devis n’a été trouvée.
                            </td>
                        </tr>
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
