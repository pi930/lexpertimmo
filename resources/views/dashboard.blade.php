<div class="space-y-8 px-6 py-8 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-[#0033cc]">📬 Messages reçus</h2>

    @if(Auth::user()->is_admin)
        @include('admin.Dashboard_user')

        @if($messages->count())
            <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                <table class="min-w-full table-auto bg-white dark:bg-gray-900">
                    <thead class="bg-[#f5f8ff] dark:bg-gray-800 text-[#0033cc]">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Nom</th>
                            <th class="px-6 py-3 text-left font-semibold">Email</th>
                            <th class="px-6 py-3 text-left font-semibold">Sujet</th>
                            <th class="px-6 py-3 text-left font-semibold">Message</th>
                            <th class="px-6 py-3 text-left font-semibold">Date</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $contact)
                            <tr class="border-t hover:bg-[#f0f4ff] dark:hover:bg-gray-800 transition"
                                onclick="window.location='{{ route('admin.dashboard.user', ['id' => $contact->user_id]) }}'">
                                <td class="px-6 py-4">{{ $contact->nom }}</td>
                                <td class="px-6 py-4">{{ $contact->email }}</td>
                                <td class="px-6 py-4">{{ $contact->sujet }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">{{ Str::limit($contact->message, 80) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 space-x-3">
                                    <a href="{{ route('messages.edit', $contact->id) }}" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">✏️ Modifier</a>
                                    <form action="{{ route('messages.destroy', $contact->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium"
                                            onclick="return confirm('Supprimer ce message ?')">🗑️ Supprimer</button>
                                    </form>
                                    <a href="{{ route('messages.reply', $contact->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">📩 Répondre</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $messages->links() }}
            </div>
        @else
            <p class="text-gray-500 italic">Aucun message pour le moment.</p>
        @endif

    @else
        <h3 class="text-2xl font-semibold text-[#cc0000]">📨 Mes messages</h3>

        @if($messages->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($messages as $msg)
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm">
                        <h4 class="text-lg font-semibold text-[#0033cc] mb-2">{{ $msg->sujet }}</h4>
                        <p class="text-gray-700 dark:text-gray-300">{{ $msg->message }}</p>
                        <p class="text-sm text-gray-500 mt-4">Envoyé le {{ $msg->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $messages->links() }}
            </div>
        @else
            <p class="text-gray-500 italic">Vous n’avez pas encore envoyé de message.</p>
        @endif
    @endif
</div>