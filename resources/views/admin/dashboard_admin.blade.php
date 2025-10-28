<x-app-layout>
    @include('dashboard.menu')
@if($latestNotifications->count() > 0)
    <div class="bg-white dark:bg-gray-800 shadow rounded p-4 mb-6">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">
            📢 Dernières notifications ({{ $unreadCount }} non lues)
        </h3>

        {{--@foreach($latestNotifications as $notif)
            <div class="mb-3 p-3 rounded {{ $notif->read ? 'bg-gray-100 dark:bg-gray-700' : 'bg-yellow-100 dark:bg-yellow-700' }}">
                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $notif->content }}</p>
                @if($notif->url)
                    <a href="{{ $notif->url }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">Voir plus</a>
                @endif
                @if(!$notif->read)
                    <span class="inline-block ms-2 px-2 py-0.5 text-xs bg-yellow-400 text-black rounded">Non lu</span>
                @endif
            </div>
        @endforeach --}}


        <div class="text-end mt-2">
            <a href="{{ route('admin.notifications.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Voir toutes les notifications</a>
        </div>
    </div>
@endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🧑 Aperçu du compte : {{ $user->nom ?? 'Nom inconnu' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

           {{-- Coordonnées --}}
<div id="coordonnees" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        <h3 class="text-lg font-bold mb-2">📇 Coordonnées</h3>

        {{-- Composant Blade refactoré --}}
        <x-dashboard.coordonnees :user="$user" :isAdmin="true" />

        {{-- Informations complémentaires --}}
        <p>Email : {{ $user->email }}</p>
        <p>Téléphone : {{ $user->coordonnee->telephone ?? 'Non renseigné' }}</p>
        <p>Adresse :
            {{ $user->coordonnee->rue ?? '' }}
            {{ $user->coordonnee->code_postal ?? '' }}
            {{ $user->coordonnee->ville ?? '' }}
            {{ $user->coordonnee->pays ?? '' }}
        </p>
    </div>
</div>

            {{-- Messages --}}
            <div id="messages" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📬 Messages</h3>
                    <x-dashboard.messages :messages="$messages" :isAdmin="true" />
                </div>
            </div>

            {{-- Devis --}}
            <div id="devis" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📄 Devis</h3>
                    @include('dashboard.devis', ['devis' => $devis, 'isAdmin' => true])
                </div>
            </div>

            {{-- Rendez-vous --}}
            <div id="rendezvous" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📅 Rendez-vous</h3>
                     <p class="text-gray-500 italic">Module en cours de développement…</p>
                   {{-- @include('dashboard.rendezvous', ['rendezvous' => $rendezvous]) --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>