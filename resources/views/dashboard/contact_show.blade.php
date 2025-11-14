@extends('layouts.app')

@section('title', 'Message envoyé')

@section('content')
<div class="max-w-3xl mx-auto mt-8 bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">📨 Détail du message envoyé</h2>

    <div class="space-y-2 text-gray-700">
        <p><strong>Nom :</strong> {{ $contact->nom }}</p>
        <p><strong>Email :</strong> {{ $contact->email }}</p>
        <p><strong>Téléphone :</strong> {{ $contact->telephone ?? 'Non renseigné' }}</p>
        <p><strong>Adresse :</strong> {{ $contact->rue }}, {{ $contact->ville }} {{ $contact->code_postal }}, {{ $contact->pays }}</p>
        <p><strong>Sujet :</strong> {{ $contact->sujet ?? 'Sans sujet' }}</p>
        <p><strong>Message :</strong><br>{{ $contact->message ?? 'Aucun contenu' }}</p>
        <p><strong>Envoyé le :</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            ⬅ Retour au tableau de bord
        </a>
    </div>
</div>
@endsection