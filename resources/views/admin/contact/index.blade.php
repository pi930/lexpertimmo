@extends('layouts.admin') {{-- ou layouts.app si tu n’as pas encore de layout admin --}}

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">📬 Messages reçus via le formulaire de contact</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($messages->count())
        <table class="table table-bordered table-hover table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Sujet</th>
                    <th>Message</th>
                    <th>Envoyé le</th>
                    <th>Utilisateur</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->nom }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->telephone ?? '—' }}</td>
                        <td>
                            {{ $contact->rue }}<br>
                            {{ $contact->code_postal }} {{ $contact->ville }}<br>
                            {{ $contact->pays }}
                        </td>
                        <td>{{ $contact->sujet }}</td>
                        <td>{{ Str::limit($contact->message, 100) }}</td>
                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($contact->user_id)
                                <span class="badge bg-success">#{{ $contact->user_id }}</span>
                            @else
                                <span class="badge bg-secondary">Invité</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $messages->links() }}
        </div>
    @else
        <div class="alert alert-info">Aucun message reçu pour le moment.</div>
    @endif
</div>
@endsection