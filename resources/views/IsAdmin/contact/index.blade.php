@extends('layouts.IsAdmin') {{-- ou layouts.app si tu n’as pas encore de layout IsAdmin --}}

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
              @foreach($messages as $msg)
    <tr>
        <td>{{ $msg->nom }}</td>
        <td>{{ $msg->email }}</td>
        <td>{{ $msg->sujet }}</td>
        <td>{{ $msg->message }}</td>
        <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
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