@props(['devis', 'admin' => false])

<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📄 Mes devis</h2>

    @if($admin)
        <p class="text-sm text-blue-600">[Vue Admin]</p>
    @else
        <p class="text-sm text-green-600">[Vue utilisateur]</p>
    @endif

    @if($devis && $devis->count())
        <table class="table-auto w-full border mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Montant</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">PDF</th>
                    @if($admin)
                        <th class="px-4 py-2">Utilisateur</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($devis as $item)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $item->objet ?? '—' }}</td>
                        <td class="px-4 py-2">{{ number_format($item->total_ttc, 2, ',', ' ') }} €</td>
                        <td class="px-4 py-2">{{ $item->statut ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ Storage::url($item->pdf_path) }}" target="_blank" class="text-blue-600 hover:underline">📄 Télécharger</a>
                        </td>
                        @if($admin)
                            <td class="px-4 py-2">{{ $item->user->nom ?? '—' }}</td>
                        @endif
                    </tr>

                    @if($item->devisLignes->count())
                        <tr>
                            <td colspan="{{ $admin ? 6 : 5 }}" class="px-4 py-2 bg-gray-50">
                                <ul class="list-disc pl-4 text-sm text-gray-700">
                                    @foreach($item->devisLignes as $ligne)
                                        <li>
                                            {{ $ligne->objet->nom ?? 'Option inconnue' }} — {{ number_format($ligne->prix, 2, ',', ' ') }} €
                                        </li>
                                    @endforeach
                                </ul>
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
        <p class="text-gray-500">Aucun devis enregistré.</p>
    @endif
</div>