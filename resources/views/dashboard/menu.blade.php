@props(['active', 'unreadCount', 'isAdmin'])

<div class="flex">
    {{-- Menu latéral --}}
    <aside class="w-64 bg-white border-r p-4">
        <ul class="space-y-4">
            <li>
                <a href="?section=messages" class="{{ $active === 'messages' ? 'font-bold text-blue-600' : 'text-gray-700' }}">
                    📬 Messages
                    @if($unreadCount > 0)
                        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="?section=coordonnees" class="{{ $active === 'coordonnees' ? 'font-bold text-blue-600' : 'text-gray-700' }}">
                    👤 Coordonnées
                </a>
            </li>
            <li>
                <a href="?section=devis" class="{{ $active === 'devis' ? 'font-bold text-blue-600' : 'text-gray-700' }}">
                    📄 Devis
                </a>
            </li>
        </ul>
    </aside>

    {{-- Contenu dynamique --}}
    <main class="flex-1 p-6">
        @if($active === 'messages')
            <x-dashboard.messages :isAdmin="$isAdmin" />
        @elseif($active === 'coordonnees')
            <x-dashboard.coordonnees :isAdmin="$isAdmin" />
        @elseif($active === 'devis')
            <x-dashboard.devis :isAdmin="$isAdmin" />
        @else
            <p class="text-gray-500">Sélectionnez une section dans le menu.</p>
        @endif
    </main>
</div>
