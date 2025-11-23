@extends('layouts.app')

@section('title', 'Message envoyé – Lexpertimmo')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        Message envoyé par {{ $contact->nom }}
    </h2>

    <p><strong>Email :</strong> {{ $contact->email }}</p>
    {{-- <p><strong>Téléphone :</strong> {{ $contact->telephone }}</p> --}}
    <p><strong>Adresse :</strong> {{ $contact->rue }}, {{ $contact->code_postal }} {{ $contact->ville }}, {{ $contact->pays }}</p>
    <p><strong>Sujet :</strong> {{ $contact->sujet }}</p>
    <p><strong>Message :</strong><br>{{ $contact->message }}</p>

    <a href="{{ url()->previous() }}" class="inline-block mt-4 text-blue-600 hover:underline">← Retour</a>
</div>
@endsection
