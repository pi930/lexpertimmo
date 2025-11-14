<nav class="bg-white border-b border-gray-200 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        
        <!-- Menu principal -->
        <div class="flex flex-wrap md:flex-nowrap space-x-4 md:space-x-6 items-center font-semibold text-sm text-gray-800">
        <a href="{{ Auth::user()->dashboardLink() }}"
   class="px-3 py-2 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 hover:text-blue-900 transition">
    🏠 Tableau de bord
</a>

            <a href="#messages"
               class="px-3 py-2 rounded bg-red-100 text-red-600 hover:bg-red-200 hover:text-red-800 transition">
                📬 Messages
            </a>

            <a href="#coordonnees"
               class="px-3 py-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 transition">
                📇 Coordonnées
            </a>

            <a href="#devis"
               class="px-3 py-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 transition">
                📄 Devis
            </a>

            {{-- <a href="#rendezvous" class="px-3 py-2 rounded bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 transition">📅 Rendez-vous</a> --}}
            {{-- <a href="#diagnostique" class="px-3 py-2 rounded bg-red-100 text-red-600 hover:bg-red-200 hover:text-red-800 transition">🩺 Diagnostique</a> --}}
        </div>

        <!-- Zone utilisateur -->
        <div class="flex items-center space-x-4 text-sm">
            @if(Auth::user()->role === 'IsAdmin')
                <x-dashboard.notifications :notifications="$latestNotifications" :unreadCount="$unreadCount" />
            @endif

            <span class="text-gray-700 font-medium">
                👤 {{ Auth::user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                        class="px-3 py-2 rounded bg-red-100 text-red-500 hover:bg-red-200 hover:text-red-700 font-semibold transition">
                    🔓 Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>