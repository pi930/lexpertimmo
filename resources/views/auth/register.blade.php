<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

<!-- Nom -->
<x-input-label for="nom" :value="__('Nom')" />
<x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom')" required />
<x-input-error :messages="$errors->get('nom')" class="mt-2 text-red-600" />

<!-- Email -->
<x-input-label for="email" :value="__('Email')" />
<x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
<x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />

<!-- Mot de passe -->
<x-input-label for="password" :value="__('Mot de passe')" />
<x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
<x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />

<!-- Confirmation mot de passe -->
<x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
<x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
<!-- Pas besoin d’erreur ici car elle est incluse dans 'password' -->

<!-- Rue -->
<x-input-label for="rue" :value="__('Rue')" />
<x-text-input id="rue" name="rue" type="text" class="mt-1 block w-full" :value="old('rue')" required />
<x-input-error :messages="$errors->get('rue')" class="mt-2 text-red-600" />

<!-- Code postal -->
<x-input-label for="code_postal" :value="__('Code postal')" />
<x-text-input id="code_postal" name="code_postal" type="text" class="mt-1 block w-full" :value="old('code_postal')" required />
<x-input-error :messages="$errors->get('code_postal')" class="mt-2 text-red-600" />

<!-- Ville -->
<x-input-label for="ville" :value="__('Ville')" />
<x-text-input id="ville" name="ville" type="text" class="mt-1 block w-full" :value="old('ville')" required />
<x-input-error :messages="$errors->get('ville')" class="mt-2 text-red-600" />

<!-- Pays -->
<x-input-label for="pays" :value="__('Pays')" />
<x-text-input id="pays" name="pays" type="text" class="mt-1 block w-full" :value="old('pays')" required />
<x-input-error :messages="$errors->get('pays')" class="mt-2 text-red-600" />

<!-- Téléphone -->
<x-input-label for="phone" :value="__('Téléphone')" />
<x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required />
<x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-600" />

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
