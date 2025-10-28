<nav class="bg-gray-800 text-white px-6 py-3 flex justify-between items-center shadow">
    <div class="flex space-x-6">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard_admin') }}" class="hover:underline">🏠 Tableau de bord</a>
        @else
            <a href="{{ route('dashboard.user') }}" class="hover:underline">🏠 Tableau de bord</a>
        @endif

        <a href="#coordonnees" class="hover:underline">📇 Coordonnées</a>
        <a href="#messages" class="hover:underline">📬 Messages</a>
        <a href="#devis" class="hover:underline">📄 Devis</a>
        <a href="#rendezvous" class="hover:underline">📅 Rendez-vous</a>
    </div>

    <div class="flex items-center space-x-4">
        <span class="text-sm">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-red-300 hover:text-red-500 text-sm">Déconnexion</button>
        </form>
    </div>
</nav>