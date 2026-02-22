@extends('layouts.app')

@section('content')
<div id="messages" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        {{-- Retour et titre --}}
        @if($admin)
    <a href="{{ route('admin.dashboard') }}">← Retour Admin</a>
@else
    <a href="{{ route('user.dashboard', ['id' => $user->id]) }}">← Retour utilisateur</a>
@endif

        {{-- Liste des messages --}}
        @forelse($messages as $message)
            <div class="mb-4 border-b pb-2">
                <p><strong>Sujet :</strong> {{ $message->sujet }}</p>
                <p><strong>Contenu :</strong> {{ $message->message }}</p>
                <p><strong>Envoyé le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>

                {{-- Bouton Répondre + Réponse affichée --}}
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('messages.reply', ['id' => $message->id]) }}">
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
                        <p><strong>Réponse de l’Administrateur :</strong> {{ $message->reponse }}</p>
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
