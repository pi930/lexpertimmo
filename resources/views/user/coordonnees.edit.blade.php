@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Modifier mes coordonnées</h2>

    <form action="{{ route('user.coordonnees.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Adresse</label>
        <input type="text" name="adresse" class="w-full border p-2 mb-4"
               value="{{ old('adresse', $coordonnees->adresse ?? '') }}">

        <label class="block mb-2">Téléphone</label>
        <input type="text" name="telephone" class="w-full border p-2 mb-4"
               value="{{ old('telephone', $coordonnees->telephone ?? '') }}">

        <label class="block mb-2">Ville</label>
        <input type="text" name="ville" class="w-full border p-2 mb-4"
               value="{{ old('ville', $coordonnees->ville ?? '') }}">

        <label class="block mb-2">Code postal</label>
        <input type="text" name="code_postal" class="w-full border p-2 mb-4"
               value="{{ old('code_postal', $coordonnees->code_postal ?? '') }}">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Enregistrer
        </button>
    </form>

</div>
@endsection

