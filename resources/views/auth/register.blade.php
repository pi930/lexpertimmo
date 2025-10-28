<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📝 Inscription utilisateur</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nom -->
        <div>
            <label for="nom" class="block text-sm font-medium">Nom</label>
            <input id="nom" name="nom" type="text" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input id="email" name="email" type="email" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Mot de passe -->
        <div>
            <label for="password" class="block text-sm font-medium">Mot de passe</label>
            <input id="password" name="password" type="password" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Confirmation -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium">Confirmer le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Rue -->
        <div>
            <label for="rue" class="block text-sm font-medium">Rue</label>
            <input id="rue" name="rue" type="text" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Code postal -->
        <div>
            <label for="code_postale" class="block text-sm font-medium">Code postal</label>
            <input id="code_postale" name="code_postale" type="text" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Ville -->
        <div>
            <label for="ville" class="block text-sm font-medium">Ville</label>
            <input id="ville" name="ville" type="text" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Pays -->
        <div>
            <label for="pays" class="block text-sm font-medium">Pays</label>
            <input id="pays" name="pays" type="text" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Téléphone -->
        <div>
            <label for="telephone" class="block text-sm font-medium">Téléphone</label>
            <input id="telephone" name="telephone" type="text" required class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Bouton -->
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                S’inscrire
            </button>
        </div>
    </form>
</div>