<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📬 Messages reçus</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

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
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $contact)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $contact->nom }}</td>
                            <td class="px-4 py-2">{{ $contact->email }}</td>
                            <td class="px-4 py-2">{{ $contact->sujet }}</td>
                            <td class="px-4 py-2">{{ Str::limit($contact->message, 80) }}</td>
                            <td class="px-4 py-2">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('messages.edit', $contact->id) }}" class="text-sm text-yellow-600 hover:underline">Modifier</a>
                                <form action="{{ route('messages.destroy', $contact->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline" onclick="return confirm('Supprimer ce message ?')">Supprimer</button>
                                </form>
                                <a href="{{ route('messages.reply', $contact->id) }}" class="text-sm text-blue-600 hover:underline">Répondre</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="bg-blue-100 text-blue-800 p-4 rounded">
    Composant messages chargé avec succès.
</div>
            <div class="mt-4">{{ $messages->links() }}</div>
        @else
            <p class="text-gray-500">Aucun message pour le moment.</p>
        @endif
    @else
        @forelse($messages as $message)
            <div class="border rounded p-4 mb-3 bg-white shadow-sm">
                <strong>{{ $message->nom }}</strong> ({{ $message->email }})<br>
                <em>{{ $message->sujet }}</em><br>
                <p>{{ $message->message }}</p>
                <small>Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}</small>
            </div>
        @empty
            <p class="text-gray-500">Vous n’avez pas encore envoyé de message.</p>
        @endforelse
        <div class="mt-4">{{ $messages->links() }}</div>
    @endif
</div>