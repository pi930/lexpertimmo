@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Nos prestations</h1>

    @auth
        <p class="text-success">Bienvenue {{ Auth::user()->name }} !</p>
    @else
        <p class="text-warning">Connectez-vous pour créer un devis personnalisé.</p>
    @endauth

    <div class="row">
        @foreach($prestations as $prestation)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $prestation->titre }}</h5>
                        <p class="card-text">{{ $prestation->description }}</p>
                        <p class="card-text"><strong>Prix :</strong> {{ $prestation->prix }} €</p>

                        @auth
                            <a href="{{ route('devis.genererApresLogin', ['prestation' => $prestation->id]) }}" class="btn btn-primary">Créer mon devis</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary">Se connecter pour créer un devis</a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection