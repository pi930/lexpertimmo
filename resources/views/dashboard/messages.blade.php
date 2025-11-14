@extends('layouts.app')

@section('content')
<div id="messages" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        {{-- Retour et titre --}}
        @if(isset($user))
            <a href="{{ route('IsAdmin.dashboard_IsAdmin') }}" class="btn btn-outline-dark mb-4">← Retour IsAdmin</a>
            <h3 class="text-xl font-bold mb-4">📨 Messages de {{ $user->last_name }}</h3>
        @else
            <a href="{{ route('IsAdmin.dashboard_user') }}" class="btn btn-outline-primary mb-4">← Retour utilisateur</a>
            <h3 class="text-xl font-bold mb-4">📬 Vos messages</h3>
        @endif

        {{-- Liste des messages --}}
        @forelse($messages as $message)
            <div class="mb-4 border-b pb-2">
                <p><strong>Sujet :</strong> {{ $message->sujet }}</p>
                <p><strong>Contenu :</strong> {{ $message->message }}</p>
                <p><strong>Envoyé le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>

                {{-- Bouton Répondre + Réponse affichée --}}
                @if(Auth::user()->role === 'IsAdmin')
                    <a href="{{ route('IsAdmin.contact.reply', ['id' => $message->id]) }}"
                       class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        ✉️ Répondre
                    </a>

                    @if($message->reponse)
                        <div class="mt-2 p-3 bg-gray-50 border rounded">
                            <p><strong>Réponse :</strong> {{ $message->reponse }}</p>
                        </div>
                    @endif
                @elseif($message->reponse)
                    <div class="mt-2 p-3 bg-green-50 border rounded">
                        <p><strong>Réponse de l’IsAdministrateur :</strong> {{ $message->reponse }}</p>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500">Aucun message pour le moment.</p>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection