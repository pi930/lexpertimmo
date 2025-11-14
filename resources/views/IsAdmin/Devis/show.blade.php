@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">📄 Détail du devis #{{ $devis->id }}</h1>

    <div class="mb-4">
        @if($IsAdmin)
    <p><strong>Client :</strong> {{ $devis->user->name }} ({{ $devis->user->email }})</p>
@endif
        <p><strong>Date de création :</strong> {{ $devis->created_at->format('d/m/Y à H:i') }}</p>
        <p><strong>Objet :</strong> {{ $devis->objet }}</p>
        <p><strong>Status :</strong> <span class="text-blue-600">{{ ucfirst($devis->status) }}</span></p>
        <p><strong>Montant total TTC :</strong> {{ number_format($devis->total_ttc, 2, ',', ' ') }} €</p>
    </div>

    @if($devis->pdf_path)
        <div class="mb-6">
            <a href="{{ Storage::url($devis->pdf_path) }}" target="_blank" class="text-blue-600 underline">
                📎 Télécharger le devis PDF
            </a>
        </div>
    @endif

    <h2 class="text-xl font-semibold mb-2">🧾 Prestations incluses</h2>
    <ul class="list-disc ms-6 mb-6">
        @forelse($devis->devisLignes as $ligne)
            <li>
                {{ $ligne->objet->nom ?? 'Option inconnue' }} —
                {{ number_format($ligne->prix, 2, ',', ' ') }} €
            </li>
        @empty
            <li>Aucune prestation enregistrée.</li>
        @endforelse
    </ul>

    <a href="{{ route('devis.index') }}" class="text-sm text-gray-600 hover:text-blue-600 underline">
        ⬅️ Retour à la liste des devis
    </a>
</div>
@endsection