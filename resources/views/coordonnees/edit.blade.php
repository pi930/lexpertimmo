@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">
        {{ $coordonnees ? 'Modifier mes coordonnées' : 'Ajouter mes coordonnées' }}
    </h2>


<form action="{{ isset($coordonnees) && $coordonnees ? route('coordonnees.update', $coordonnees->id) : route('coordonnees.store') }}" method="POST">
    @csrf

    @if(!empty($coordonnees) && $coordonnees->id)
    @method('PUT')
@endif



    <label class="block mb-2">Nom</label>
    <input type="text" name="nom" class="w-full border p-2 mb-4"
           value="{{ old('nom', $coordonnees->nom ?? '') }}">

    <label class="block mb-2">Rue</label>
    <input type="text" name="rue" class="w-full border p-2 mb-4"
           value="{{ old('rue', $coordonnees->rue ?? '') }}">

    <label class="block mb-2">Téléphone</label>
    <input type="text" name="telephone" class="w-full border p-2 mb-4"
           value="{{ old('telephone', $coordonnees->telephone ?? '') }}">

    <label class="block mb-2">Ville</label>
    <input type="text" name="ville" class="w-full border p-2 mb-4"
           value="{{ old('ville', $coordonnees->ville ?? '') }}">

    <label class="block mb-2">Code postal</label>
    <input type="text" name="code_postal" class="w-full border p-2 mb-4"
           value="{{ old('code_postal', $coordonnees->code_postal ?? '') }}">

    <label class="block mb-2">Pays</label>
    <input type="text" name="pays" class="w-full border p-2 mb-4"
           value="{{ old('pays', $coordonnees->pays ?? '') }}">

    <label class="block mb-2">Email</label>
    <input type="email" name="email" class="w-full border p-2 mb-4"
           value="{{ old('email', $coordonnees->email ?? '') }}">

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
    Enregistrer
</button>
</form>


</div>
@endsection
