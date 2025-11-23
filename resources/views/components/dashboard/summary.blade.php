<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    {{-- Notifications --}}
    {{--<div class="bg-white p-4 rounded shadow text-center">
        <p class="text-sm text-gray-500">Notifications non lues</p>
        <p class="text-xl font-bold text-yellow-600">{{ $unreadCount }}</p>
    </div>--}}

    {{-- Messages --}}
    <div class="bg-white p-4 rounded shadow text-center">
        <p class="text-sm text-gray-500">Messages</p>
        <p class="text-xl font-bold text-blue-600">{{ $messages->count() }}</p>
    </div>

    {{-- Devis --}}
    <div class="bg-white p-4 rounded shadow text-center">
        <p class="text-sm text-gray-500">Devis</p>
        <p class="text-xl font-bold text-green-600">{{ $devis->count() }}</p>
    </div>

    {{-- Rendez-vous --}}
    <div class="bg-white p-4 rounded shadow text-center">
        <p class="text-sm text-gray-500">Rendez-vous</p>
        <p class="text-xl font-bold text-purple-600">{{ $rendezvous->count() ?? 0 }}</p>
    </div>
</div>
