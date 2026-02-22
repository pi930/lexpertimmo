@extends('layouts.app')

@section('title', 'Message envoyé – Lexpertimmo')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        Message envoyé par {{ $contact->nom }}
    </h2>

    <p><strong>Email :</strong> {{ $contact->email }}</p>

    <p><strong>Adresse :</strong>
        {{ $contact->rue }},
        {{ $contact->code_postal }}
        {{ $contact->ville }},
        {{ $contact->pays }}
    </p>

    <p><strong>Sujet :</strong> {{ $contact->sujet }}</p>

    <p><strong>Message :</strong><br>{{ $contact->message }}</p>

    @if($contact->reponse)
        <div class="mt-4 p-4 bg-green-100 text-green-800 rounded">
            <strong>Réponse de l’admin :</strong><br>
            {{ $contact->reponse }}
        </div>
    @endif

    <a href="{{ url()->previous() }}" class="inline-block mt-4 text-blue-600 hover:underline">← Retour</a>
</div>
@endsection

