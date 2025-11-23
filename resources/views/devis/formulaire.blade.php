@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">🧮 Calculer un devis</h1>

    <form method="POST" action="{{ route('devis.calculer') }}">
        @csrf

        <label class="block mb-2">Type de bien :</label>
        <select name="typeBien" class="w-full mb-4 border rounded p-2" required>
            <option value="vente">Vente</option>
            <option value="location">Location</option>
        </select>

        <label class="block mb-2">Surface :</label>
        <select name="surface" class="w-full mb-4 border rounded p-2" required>
            <option value="<50m²">Moins de 50m²</option>
            <option value="<100m²">Moins de 100m²</option>
            <option value="<150m²">Moins de 150m²</option>
            <option value="<200m²">Moins de 200m²</option>
        </select>

        <label class="block mb-2">Options :</label>
        <div class="mb-4">
            <label><input type="checkbox" name="options[]" value="gaz_cuisson"> Gaz cuisson</label><br>
            <label><input type="checkbox" name="options[]" value="gaz_chaudiere"> Gaz chaudière</label><br>
            <label><input type="checkbox" name="options[]" value="plomb"> Plomb</label><br>
            <label><input type="checkbox" name="options[]" value="zone_non_habitable_50"> Zone non habitable &lt;50m²</label>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Calculer
        </button>
    </form>
</div>
@endsection