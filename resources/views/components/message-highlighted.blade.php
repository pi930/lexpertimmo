<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-6 rounded">
    <h3 class="font-bold text-lg mb-2">✅ Message envoyé</h3>
    <p><strong>Sujet :</strong> {{ $message->sujet }}</p>
    <p>{{ $message->message }}</p>
    <p class="text-sm text-gray-600 mt-2">
        Envoyé le {{ $message->created_at->format('d/m/Y H:i') }}
    </p>
    @if($message->user_id)
        <p class="text-sm text-gray-600 mt-2">
            — <a href="{{ route('admin.dashboard_user', $message->user_id) }}"
                 class="text-blue-600 hover:underline">Voir profil utilisateur</a>
        </p>
    @endif
</div>