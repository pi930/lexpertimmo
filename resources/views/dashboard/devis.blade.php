@props(['isAdmin'])

<h2 class="text-xl font-bold mb-4">📄 Devis</h2>

@forelse($devis as $d)
    <div class="flex items-center justify-between mb-4 border-b pb-2">
        @if($isAdmin)
            <form method="POST" action="{{ route('devis.supprimer', $d->id) }}">
                @csrf
                @method('DELETE')
                <button class="text-red-500 mr-2">🗑️</button>
            </form>
        @endif

        <div>
            <p><strong>{{ $d->created_at->format('d/m/Y') }}</strong> — {{ $d->total_ttc }} €</p>
            <a href="{{ Storage::url($d->pdf_path) }}" class="text-blue-600 hover:underline">Télécharger PDF</a>
        </div>
    </div>
@empty
    <p>Aucun devis disponible.</p>
@endforelse
