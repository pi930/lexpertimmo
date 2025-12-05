@extends('layouts.app')

@section('content')

    {{-- Barre transversale de résumé --}}
    <div class="bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <x-dashboard.summary
                    :messages="$messages"
                    :devis="$devis"
                    :rendezvous="$rendezvous"
                />
            </div>
        </div>
    </div>

    {{-- Contenu principal --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Coordonnées --}}
            <div class="bg-white shadow rounded">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">📇 Coordonnées</h2>
                </div>
                <div class="px-6 py-4">
                    <x-dashboard.coordonnees :user="$user" :admin="true" :coordonnees="$coordonnees" />
                </div>
            </div>
            
            {{-- 🔗 Bouton vers le dashboard utilisateur --}}
<div class="bg-white shadow rounded">
    <div class="px-6 py-4 flex items-center justify-between">
        <div>
            <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
            <p class="text-sm text-gray-600">{{ $user->email }}</p>
        </div>
       <a href="{{ route('user.dashboard_user', ['id' => $user->id]) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            🧭 Accéder au tableau de bord
        </a>
    </div>
</div>

            {{-- Messages --}}
            <div class="bg-white shadow rounded">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">📬 Messages</h2>
                </div>
                <div class="px-6 py-4">
                    <x-dashboard.messages :messages="$messages" :admin="true" />
                </div>
            </div>

<x-dashboard.devis :devis="$devisList" :admin="true" />

 <h3>Liste des rendez-vous bloqués :</h3>
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Rue</th>
            <th>Code Postal</th>
            <th>Ville</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rendezvousBloques as $rdv)
            <tr>
    <td>{{ $rdv->user->name ?? 'Non assigné' }}</td>
    <td>{{ $rdv->user->email ?? 'Non assigné' }}</td>
    <td>{{ $rdv->rue ?? 'N/A' }}</td>
    <td>{{ $rdv->code_postal ?? 'N/A' }}</td>
    <td>{{ $rdv->ville ?? 'N/A' }}</td>
    <td>{{ $rdv->zone ?? 'N/A' }}</td> {{-- 👈 ajout de la zone --}}
    <td>{{ $rdv->date->format('d/m/Y H:i') }}</td>

                    <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('admin.rendezvous.supprimer', $rdv->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>
@endsection
