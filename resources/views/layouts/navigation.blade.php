<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                   <a href="{{ Auth::user()->role === 'admin' ? route('dashboard.admin') : route('user.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
     <div class="hidden sm:flex sm:items-center sm:ms-6">
        <div x-data="{ openNotif: false }" class="relative me-4">
            <!-- Bouton cloche -->
            <button @click="openNotif = !openNotif"
                    :aria-expanded="openNotif"
                    aria-controls="notifDropdown"
                    class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5 me-1 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                @if($unreadCount > 0)
                    <span class="absolute top-0 start-6 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                        {{ $unreadCount }}
                    </span>
                @endif
            </button>

            <!-- Dropdown notifications -->
            <div id="notifDropdown"
                 x-show="openNotif"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click.away="openNotif = false"
                 class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-50"
            >
             @if(Auth::check() && Auth::user()->role === 'admin')
    <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-600">
        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Notifications</h4>

        @forelse($latestNotifications as $notif)
            <a href="{{ $notif->url ?? '#' }}" class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                {{ $notif->content }}
                @if(!$notif->read)
                    <span class="inline-block ms-2 px-2 py-0.5 text-xs bg-yellow-400 text-black rounded">Non lu</span>
                @endif
            </a>
        @empty
            <p class="text-sm text-gray-500 dark:text-gray-400">Aucune notification</p>
        @endforelse

        <div class="mt-2 text-end">
            <a href="{{ route('admin.notifications.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">Voir toutes les notifications</a>
        </div>
    </div>
@endif
            </div>
        </div>
    </div>
   

    <!-- Profil utilisateur -->
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                @if(Auth::check())
    <div>{{ Auth::user()->name }}</div>
      @endif
      @guest
    <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
        <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">Connexion</a>
        <a href="{{ route('register') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">Inscription</a>
        <a href="{{ route('contact.form') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">Contact</a>
    </div>
@endguest
                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('coordonnees.show')">
    Mes coordonnées
</x-dropdown-link>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
 <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    @if(Auth::check() && Auth::user()->role === 'admin')
    <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-600">
        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Notifications</h4>
        @forelse($latestNotifications as $notif)
            <a href="{{ $notif->url ?? '#' }}" class="block px-2 py-1 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                {{ $notif->content }}
                @if(!$notif->read)
                    <span class="inline-block ms-2 px-2 py-0.5 text-xs bg-yellow-400 text-black rounded">Non lu</span>
                @endif
            </a>
        @empty
            <p class="text-sm text-gray-500 dark:text-gray-400">Aucune notification</p>
        @endforelse
        <div class="mt-2 text-end">
            <a href="{{ route('admin.notifications.index') }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline">Voir toutes les notifications</a>
        </div>
    </div>
@endif
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link 
    :href="Auth::user()->is_admin ? route('dashboard.admin') : route('dashboard.user')" 
    :active="request()->routeIs('dashboard.admin') || request()->routeIs('dashboard.user')">
    {{ __('Dashboard') }}
</x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                 @auth
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @auth
               <x-dropdown-link :href="route('coordonnees.show')">
    Mes coordonnées
</x-dropdown-link>
@endauth
            </div>
        </div>
    </div>
</nav>
