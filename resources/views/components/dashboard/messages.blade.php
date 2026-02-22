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

    @if($admin)
        @if($messages->count())
            <table class="table-auto w-full border">
                <thead class="bg-gray-100">
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
                    @foreach($messages as $message)
    <div class="mb-4 border-b pb-2">
        <p><strong>Sujet :</strong> {{ $message->sujet }}</p>
        <p><strong>Contenu :</strong> {{ $message->message }}</p>
        <p><strong>Envoyé le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>

        {{-- Bouton Répondre pour admin --}}
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('messages.reply', ['id' => $message->id]) }}"
               class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                ✉️ Répondre
            </a>

            @if($message->reponse)
                <div class="mt-2 p-3 bg-gray-50 border rounded">
                    <p><strong>Réponse :</strong> {{ $message->reponse }}</p>
                </div>
            @endif

        {{-- Pour l'utilisateur : afficher seulement la réponse --}}
        @elseif($message->reponse)
            <div class="mt-2 p-3 bg-green-50 border rounded">
                <p><strong>Réponse de l’Administrateur :</strong> {{ $message->reponse }}</p>
            </div>
        @endif
    </div>
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
        <em>Message de {{ $message->user->nom ?? $message->nom }}</em><br>
        <p>{{ $message->message }}</p>
        <small>Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}</small>

        {{-- Affichage de la réponse admin si elle existe --}}
        @if(!empty($message->reponse))
            <div class="mt-2 p-2 bg-green-100 text-green-800 rounded">
                <strong>Réponse de l’admin :</strong><br>
                {{ $message->reponse }}
            </div>
        @endif
    </div>
@empty
    <p class="text-gray-500">Vous n’avez pas encore envoyé de message.</p>
@endforelse
        <div class="mt-4">{{ $messages->links() }}</div>
    @endif
</div>
