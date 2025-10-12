<<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Tableau de bord admin') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @include('dashboard.menu')

      {{-- Tu peux afficher les mêmes modules ou des modules spécifiques admin --}}
      @include('dashboard.messages') {{-- Vue des messages reçus --}}
      @include('dashboard.devis')    {{-- Vue des devis utilisateurs --}}
    </div>
  </div>
</x-app-layout>