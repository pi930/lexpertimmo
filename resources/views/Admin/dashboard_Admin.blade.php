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

            {{-- Devis --}}
   <div class="bg-white shadow rounded">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">
            📄 Devis
        </h2>
      <x-dashboard.devis :devis="$devis" :admin="$admin" />
    </div>
</div>
    <div class="px-6 py-4">
        {{-- ✅ Message de succès après création du devis --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
                @if(session('devis_link'))
                    <br>
                    <a href="{{ session('devis_link') }}" target="_blank" class="text-blue-600 underline">
                        📄 Voir le devis
                    </a>
                @endif
            </div>
        @endif

        @include('dashboard.devis', ['devis' => $devis, 'admin' => true])
    </div>
</div>


            {{-- Rendez-vous --}}
            <div class="bg-white shadow rounded">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">📅 Rendez-vous</h2>
                </div>
                <div class="px-6 py-4 text-gray-500 italic">
                    Module en cours de développement…
                </div>
            </div>

        </div>
    </div>
@endsection
