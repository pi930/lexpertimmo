<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📬 Messages reçus</h2>

    @if($isAdmin)
        @if($messages->count())
            <table class="table-auto w-full border">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Sujet</th>
                        <th class="px-4 py-2">Message</th>
                        <th class="px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $contact)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $contact->nom }}</td>
                            <td class="px-4 py-2">{{ $contact->email }}</td>
                            <td class="px-4 py-2">{{ $contact->sujet }}</td>
                            <td class="px-4 py-2">{{ Str::limit($contact->message, 80) }}</td>
                            <td class="px-4 py-2">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucun message pour le moment.</p>
        @endif
    @else
        <p class="text-red-500">Accès réservé à l’administrateur.</p>
    @endif
</div>
