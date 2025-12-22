@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">📄 Résultat du devis</h1>

    <p><strong>Type de bien :</strong> {{ $typeBien }}</p>
    <p><strong>Surface :</strong> {{ $surface }}</p>

    <p><strong>Options sélectionnées :</strong></p>
    <ul class="list-disc ms-6">
        @foreach($options as $option)
            <li>{{ $option }}</li>
        @endforeach
    </ul>

    {{-- ⭐ Prestations obligatoires --}}
    <h3 class="mt-6 text-xl font-semibold">Prestations obligatoires incluses</h3>
    <ul class="list-disc ms-6">
        @foreach($prestationsObligatoires as $p)
            <li>{{ $p }}</li>
        @endforeach
    </ul>

    {{-- ⭐ Prix total --}}
    <p class="mt-4 text-lg">
        <strong>Prix total TTC :</strong>
        {{ number_format($prixTotal, 2, ',', ' ') }} €
    </p>

    <form method="POST" action="{{ route('devis.generer') }}">
        @csrf
        <button type="submit" class="btn btn-primary mt-6">
            ✅ Valider et générer le devis PDF
        </button>
    </form>
</div>
@endsection

