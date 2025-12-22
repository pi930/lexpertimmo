@extends('layouts.app')

@section('content')
    @if(auth()->user()->role === 'Admin')
    <div class="bg-white shadow rounded mb-6">
        <div class="px-6 py-4 flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                <p class="text-sm text-gray-600">{{ $user->email }}</p>
            </div>
            <a href="{{ route('user.dashboard', ['id' => $user->id]) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                🧭 Accéder au tableau de bord
            </a>
        </div>
    </div>
@endif

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
                    <x-dashboard.messages :messages="$messages" :admin="true" />
                </div>
            </div>

    {{-- Coordonnées --}}
    <div id="coordonnees" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-2">📍 Vos coordonnées</h3>
            @if($coordonnees)
            <x-dashboard.coordonnees :user="$user" :admin="$admin" :coordonnees="$coordonnees" />
            @else
                <p class="text-gray-500">Aucune coordonnée enregistrée.</p>
                <a href="{{ route('coordonnees.form') }}" class="text-blue-600 underline">➕ Ajouter vos coordonnées</a>
            @endif
        </div>
    </div>

<div class="bg-white shadow rounded">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">📬 Mes messages</h2>
    </div>
    <div class="px-6 py-4">
        <x-dashboard.messages :messages="$messages" :admin="false" />
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
           <x-dashboard.devis :devis="$devis" :admin="false" />
        </div>
    </div>

{{-- Rendez-vous --}}
@if($rendezvous->isEmpty())
    {{-- Si aucun rendez-vous existant --}}
    @if(empty($propositions))
        <form action="{{ route('user.rendezvous.propositions') }}" method="GET">
            <button type="submit" class="btn btn-success">
                Prendre rendez-vous
            </button>
        </form>
    @else
        <h3>Choisissez un rendez-vous :</h3>
        @foreach($propositions as $rdv)
            <form action="{{ route('rendezvous.reserver') }}" method="POST" class="mb-2">
                @csrf
                <input type="hidden" name="zone" value="{{ $rdv['zone'] }}">
                <input type="hidden" name="date" value="{{ $rdv['date'] }}">
                <input type="hidden" name="travail_heure" value="{{ $rdv['travail_heure'] }}">
                <input type="hidden" name="rue" value="{{ $rdv['rue'] }}">
                <input type="hidden" name="code_postal" value="{{ $rdv['code_postal'] }}">
                <input type="hidden" name="ville" value="{{ $rdv['ville'] }}">
                <button type="submit" class="btn btn-primary">
                    {{ $rdv['ville'] }} — {{ $rdv['date']->format('d/m/Y H:i') }}
                </button>
            </form>
        @endforeach
    @endif
@else
    {{-- Si l’utilisateur a déjà des rendez-vous --}}
    <h3>Mes rendez-vous :</h3>
    <ul class="list-group">
        @foreach($rendezvous as $rdv)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>Zone :</strong> {{ $rdv->zone }} <br>
                    <strong>Date :</strong> {{ $rdv->date->format('d/m/Y H:i') }} <br>
                    <strong>Durée :</strong> {{ $rdv->travail_heure }} heure(s) <br>
                    <strong>Adresse :</strong> {{ $rdv->rue }}, {{ $rdv->code_postal }} {{ $rdv->ville }}
                </div>
                <div>
                    <form action="{{ route('rendezvous.supprimer', $rdv->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Supprimer
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endif


@endsection
