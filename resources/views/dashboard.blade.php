<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📬 Messages reçus</h2>

    @if(Auth::user()->is_admin)
        @include('admin.Dashboard_user')

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
                        <tr class="border-t hover:bg-gray-100 cursor-pointer"
                            onclick="window.location='{{ route('admin.dashboard.user', ['id' => $contact->user_id]) }}'">
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
                                    <button type="submit" class="text-sm text-red-600 hover:underline"
                                            onclick="return confirm('Supprimer ce message ?')">Supprimer</button>
                                </form>

                                <a href="{{ route('messages.reply', $contact->id) }}" class="text-sm text-blue-600 hover:underline">Répondre</a>
                            </td>
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
        <h3 class="text-xl font-semibold">📨 Mes messages</h3>

        @if($messages->count())
            <ul class="space-y-4">
                @foreach($messages as $msg)
                    <li class="border p-4 rounded shadow-sm bg-white dark:bg-gray-900">
                        <p><strong>Sujet :</strong> {{ $msg->sujet }}</p>
                        <p><strong>Message :</strong> {{ $msg->message }}</p>
                        <p class="text-sm text-gray-500 mt-2">Envoyé le {{ $msg->created_at->format('d/m/Y H:i') }}</p>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        @else
            <p class="text-gray-500">Vous n’avez pas encore envoyé de message.</p>
        @endif
    @endif
</div>