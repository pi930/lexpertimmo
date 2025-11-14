@extends('layouts.app')

@section('content')

    {{-- Boutons de navigation --}}
    <div class="mb-6 flex gap-4 flex-wrap px-6">
        <a href="#coordonnees" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-sm">📍 Coordonnées</a>
        <a href="#messages" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-sm">📬 Messages</a>
        <a href="#devis" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-sm">📄 Devis</a>
        <a href="#rendezvous" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-100 text-sm">📅 Rendez-vous</a>
    </div>

    {{-- Message de succès --}}
    <div class="bg-white shadow rounded">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">📬 Messages</h2>
                </div>
                <div class="px-6 py-4">
                    <x-dashboard.messages :messages="$messages" :IsAdmin="true" />
                </div>
            </div>

    {{-- Coordonnées --}}
    <div id="coordonnees" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-2">📍 Vos coordonnées</h3>
            @if($coordonnees)
                <x-dashboard.coordonnees :coordonnees="$coordonnees" :IsAdmin="false" :user="$user" />
            @else
                <p class="text-gray-500">Aucune coordonnée enregistrée.</p>
                <a href="{{ route('coordonnees.form') }}" class="text-blue-600 underline">➕ Ajouter vos coordonnées</a>
            @endif
        </div>
    </div>

    {{-- Messages --}}
    <div id="messages" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-2">📬 Vos messages</h3>
            @forelse($messages as $message)
                <div class="mb-4 border-b pb-2">
                    <p><strong>Sujet :</strong> {{ $message->sujet }}</p>
                    <p><strong>Contenu :</strong> {{ $message->contenu }}</p>
                    <p><strong>Envoyé le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
                    <a href="{{ route('dashboard.messages') }}" class="text-blue-600 underline">📬 Voir mes messages</a>
                </div>
            @empty
                <p class="text-gray-500">Aucun message pour le moment.</p>
            @endforelse
        </div>
    </div>

    {{-- Devis --}}
    <div id="devis" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-2">📄 Vos devis</h3>
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                    {{ session('success') }}
                    @if(session('devis_link'))
                        <br>
                        <a href="{{ session('devis_link') }}" target="_blank" class="text-blue-600 underline">📄 Voir le devis</a>
                    @endif
                </div>
            @endif
            <x-dashboard-devis :devis="$devis" :IsAdmin="$IsAdmin" />
        </div>
    </div>

    {{-- Rendez-vous --}}
    <div id="rendezvous" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-2">📅 Vos rendez-vous</h3>
            @isset($rendezvous)
                @forelse($rendezvous as $rdv)
                    <div class="mb-4 border-b pb-2">
                        <p><strong>Date :</strong> {{ $rdv->date->format('d/m/Y H:i') }}</p>
                        <p><strong>Objet :</strong> {{ $rdv->objet }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Aucun rendez-vous prévu.</p>
                @endforelse
            @else
                <p class="text-gray-500">Les rendez-vous ne sont pas encore disponibles.</p>
            @endisset
        </div>
    </div>

@endsection