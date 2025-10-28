<x-app-layout>
    @include('dashboard.menu')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧑 Tableau de bord utilisateur
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Coordonnées --}}
            <div id="coordonnees" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📍 Vos coordonnées</h3>
                    <x-dashboard.coordonnees :coordonnees="$coordonnees" :isAdmin="false" :user="$user" />
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
                    @include('dashboard.devis', ['devis' => $devis, 'isAdmin' => false])
                </div>
            </div>

            {{-- Rendez-vous --}}
            <div id="rendezvous" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">📅 Vos rendez-vous</h3>
                    @forelse($rendezvous as $rdv)
                        <div class="mb-4 border-b pb-2">
                            <p><strong>Date :</strong> {{ $rdv->date->format('d/m/Y H:i') }}</p>
                            <p><strong>Objet :</strong> {{ $rdv->objet }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">Aucun rendez-vous prévu.</p>
                    @endforelse
                </div>
            </div>

            {{-- Diagnostic final --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">🧪 Diagnostic final</h3>
                    @if($diagnostic)
                        <p><strong>Résumé :</strong> {{ $diagnostic->resume }}</p>
                        <p><strong>Évaluation :</strong> {{ $diagnostic->evaluation }}</p>
                        <p><strong>Date :</strong> {{ $diagnostic->created_at->format('d/m/Y') }}</p>
                    @else
                        <p class="text-gray-500">Aucun diagnostic disponible.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>