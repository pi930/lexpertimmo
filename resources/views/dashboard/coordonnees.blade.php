<<div class="space-y-6">
    <h2 class="text-2xl font-semibold">📍 Mes coordonnées</h2>

    @if($isAdmin)
 
        <h3 class="text-xl font-semibold mt-6">📋 Liste des utilisateurs</h3>
         <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">Retour admin</a>

        @if($coordonnees->count())
<table class="table-auto w-full border mt-4">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">rue</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Téléphone</th>
                         <th class="px-4 py-2">code_postale</th>
                        <th class="px-4 py-2">ville</th>
                         <th class="px-4 py-2">pâys</th>
                        <th class="px-4 py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coordonnees as $item)
                        <tr class="border-t hover:bg-gray-100 cursor-pointer"
                            onclick="window.location='{{ route('admin.dashboard.user', ['id' => $item->user_id]) }}'">
                            <td class="px-4 py-2">{{ $item->last_name }}</td>
                            <td class="px-4 py-2">{{ $item->rue }}</td>
                            <td class="px-4 py-2">{{ $item->email }}</td>
                            <td class="px-4 py-2">{{ $item->phone }}</td>
                            <td class="px-4 py-2">{{ $item->code_postale }}</td>
                               <td class="px-4 py-2">{{ $item->ville }}</td>
                                <td class="px-4 py-2">{{ $item->Pays }}</td>
                            <td class="px-4 py-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $coordonnees->links() }}
            </div>
       
       
        @endif

    @else
 
        <div class="bg-white dark:bg-gray-900 p-6 rounded shadow">
            <p><strong>Nom :</strong> {{ $user->last_name }}</p>
            <p><strong>rue:</strong> {{ $user->rue }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Téléphone :</strong> {{ $user->phone }}</p>
            <p><strong>Code postale :</strong> {{ $user->code_postale }}</p>
            <p><strong>Ville  :</strong> {{ $user->ville}}</p>
               <p><strong> Pays:</strong> {{ $user->Pays}}</p>
            <p><strong>Inscrit le :</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
        </div>
          <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary">Retour utilisateur</a>
    @endif
</div>