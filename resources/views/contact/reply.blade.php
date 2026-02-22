@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">📨 Répondre à {{ $user->nom ?? 'Utilisateur' }}</h2>

    <p class="mb-4">
        <strong>Message original :</strong><br>
        {{ $message->message }}
    </p>

    <form action="{{ route('send.reply', $message->id) }}" method="POST">
        @csrf

        <textarea name="reponse" class="w-full border p-2 rounded" rows="5" placeholder="Votre réponse..."></textarea>

        <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Envoyer la réponse
        </button>
    </form>
</div>
@endsection
