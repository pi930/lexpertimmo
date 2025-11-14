<div class="border p-4 rounded shadow">
    <h2 class="text-lg font-bold mb-2">Devis #{{ $devis->id }}</h2>
    <p><strong>Client :</strong> {{ $devis->user->name }}</p>
    <p><strong>Date :</strong> {{ $devis->created_at->format('d/m/Y') }}</p>

    <ul class="mt-2">
        @foreach($devis->devisLignes as $ligne)
            <li>
                {{ $ligne->designation }} - {{ $ligne->quantite }} × {{ $ligne->prix_unitaire_ht }}€ HT
            </li>
        @endforeach
    </ul>
</div><div>
    <!-- We must ship. - Taylor Otwell -->
</div>