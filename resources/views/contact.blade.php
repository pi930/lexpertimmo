@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Contactez Lexpertimmo</h2>

    <p class="mb-6">
        <strong>Adresse de l'agence :</strong><br>
        12 Rue des Frères Lumière<br>
        06400 Cannes, France
    </p>

    @if(session('success'))
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-red-600 font-bold mb-2">Nom :</label>
            <input type="text" id="nom" name="nom" value="Pierrard Dupont" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="rue" class="block text-red-600 font-bold mb-2">Rue :</label>
            <input type="text" id="rue" name="rue" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="ville" class="block text-red-600 font-bold mb-2">Ville :</label>
            <input type="text" id="ville" name="ville" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="code_postal" class="block text-red-600 font-bold mb-2">Code postal :</label>
            <input type="text" id="code_postal" name="code_postal" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="pays" class="block text-red-600 font-bold mb-2">Pays :</label>
            <input type="text" id="pays" name="pays" value="France" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-red-600 font-bold mb-2">Email :</label>
            <input type="email" id="email" name="email" value="pierrard@lexpertimmo.fr" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="telephone" class="block text-red-600 font-bold mb-2">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" value="+33 6 12 34 56 78" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="sujet" class="block text-red-600 font-bold mb-2">Sujet :</label>
            <input type="text" id="sujet" name="sujet" value="Demande d'information sur un bien immobilier" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-6">
            <label for="message" class="block text-red-600 font-bold mb-2">Message :</label>
            <textarea id="message" name="message" rows="5" class="w-full border rounded px-3 py-2">Bonjour, je suis intéressé par le bien situé à Cannes. Pourriez-vous m'envoyer plus d'informations ? Merci !</textarea>
        </div>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Envoyer</button>
    </form>

    @if(session('contact_id'))
        <div class="mt-4">
            <a href="{{ route('user.contact', ['id' => session('contact_id')]) }}" class="text-blue-600 hover:underline">
                Voir votre message envoyé
            </a>
        </div>
    @endif
</div>
@endsection