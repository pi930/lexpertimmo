@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">✉️ Répondre au message</h2>

    <div class="mb-6">
        <p><strong>De :</strong> {{ $message->nom }} ({{ $message->email }})</p>
        <p><strong>Sujet :</strong> {{ $message->sujet }}</p>
        <p><strong>Message :</strong> {{ $message->message }}</p>
        <p><strong>Reçu le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <form action="{{ route('IsAdmin.contact.send', ['id' => $message->id]) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="reponse" class="block text-sm font-medium text-gray-700">Votre réponse :</label>
            <textarea name="reponse" id="reponse" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('reponse') }}</textarea>
            @error('reponse')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            📤 Envoyer la réponse
        </button>
        <a href="{{ route('IsAdmin.dashboard.user.messages', ['id' => $message->user_id]) }}" class="ml-4 text-blue-600 hover:underline">
            ← Retour aux messages
        </a>
    </form>
</div>
@endsection