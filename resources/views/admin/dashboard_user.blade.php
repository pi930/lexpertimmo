<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Aperçu du compte : ') }} {{ $user->name }}
    </h2>
  </x-slot>

  <div class="py-12 space-y-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      {{-- Coordonnées --}}
      @include('dashboard.coordonnees', ['coordonnees' => $coordonnees])

      {{-- Messages --}}
      @include('dashboard.messages', ['messages' => $messages])

      {{-- Devis --}}
      @include('dashboard.devis', ['devis' => $devis])

      {{-- Rendez-vous --}}
      @include('dashboard.rendezvous', ['rendezvous' => $rendezvous])
    </div>
  </div>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
  <a href="{{ route('admin.dashboard') }}"
     class="inline-block bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
    ← Retour au tableau de bord admin
  </a>
</div>
</x-app-layout>