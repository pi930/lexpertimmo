@extends('layouts.app')

@section('content')

    {{-- Barre transversale de résumé --}}
    <div class="bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <x-dashboard.summary
    :messages="$messages"
    :devis="$devisList"
    :rendezvous="$rendezvousBloques"
/>

            </div>
        </div>
    </div>

    {{-- Formulaire de recherche utilisateur (redirige vers user.dashboard) --}}
    <form action="{{ route('user.find') }}" method="POST" class="space-y-4 mb-6">
        @csrf

        <input type="text" name="nom" placeholder="Nom" class="border p-2 w-full">
        <input type="email" name="email" placeholder="Email" class="border p-2 w-full">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Accéder au tableau de bord
        </button>
    </form>

    {{-- Contenu principal admin (global) --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Messages globaux --}}
            <div class="bg-white shadow rounded">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">📬 Messages</h2>
                </div>
                <div class="px-6 py-4">
                    <x-dashboard.messages :messages="$messages" :admin="true" />
                </div>
            </div>

            {{-- Devis globaux --}}
            <x-dashboard.devis :devis="$devisList" :admin="true" />

            {{-- Rendez-vous bloqués --}}
            <h3>Liste des rendez-vous bloqués :</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rue</th>
                        <th>Code Postal</th>
                        <th>Ville</th>
                        <th>Zone</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rendezvousBloques as $rdv)
                        <tr>
                            <td>{{ $rdv->user->nom ?? 'Non assigné' }}</td>
                            <td>{{ $rdv->user->email ?? 'Non assigné' }}</td>
                            <td>{{ $rdv->rue ?? 'N/A' }}</td>
                            <td>{{ $rdv->code_postal ?? 'N/A' }}</td>
                            <td>{{ $rdv->ville ?? 'N/A' }}</td>
                            <td>{{ $rdv->zone }}</td>
                            <td>{{ $rdv->date->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.rendezvous.edit', $rdv->id) }}">
                                    Modifier
                                </a>

                                <form action="{{ route('rendezvous.supprimer', $rdv->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Libérer par Admin</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

