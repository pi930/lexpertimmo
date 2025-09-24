<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @auth
        @if(Auth::user()->role === 'admin')
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('admin.messages') }}" style="
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #0033cc;
                    color: white;
                    border-radius: 5px;
                    text-decoration: none;
                    font-weight: bold;
                ">
                    📬 Voir les messages reçus
                </a>
            </div>
        @endif
    @endauth

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
