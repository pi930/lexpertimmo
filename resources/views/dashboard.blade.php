{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
{{-- Dashboard --}}
<div class="bg-white shadow rounded">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">
            🏠 Tableau de bord
        </h2>
    </div>

    <div class="px-6 py-4">
        {{-- Vérification du rôle --}}
        @if(Auth::user()->role === 'Admin')
            {{-- Section Admin --}}
            <h3 class="text-lg font-bold text-red-600">👑 Espace Administrateur</h3>

            {{-- Exemple : liste de tous les devis --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Montant TTC</th>
                        <th>Heures de travail</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($devisList as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ number_format($d->total_ttc, 2, ',', ' ') }} €</td>
                            <td>{{ $d->heures_travail ?? '0' }} h</td>
                            <td>{{ $d->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @else
            {{-- Section User --}}
            <h3 class="text-lg font-bold text-blue-600">👤 Espace Utilisateur</h3>

            {{-- Exemple : devis de l’utilisateur connecté --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Montant TTC</th>
                        <th>Heures de travail</th>
                        <th>Date</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userDevis as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ number_format($d->total_ttc, 2, ',', ' ') }} €</td>
                            <td>{{ $d->heures_travail ?? '0' }} h</td>
                            <td>{{ $d->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($d->pdf_path)
                                    <a href="{{ Storage::url($d->pdf_path) }}" target="_blank" class="text-blue-600 underline">
                                        📄 Télécharger
                                    </a>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</x-app-layout>
