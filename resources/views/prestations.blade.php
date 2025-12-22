@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #0055A4, #ffffff, #EF4135); /* Bleu, blanc, rouge */
        min-height: 100vh;
        padding-bottom: 100px;
    }
    .table-title {
        margin-top: 2rem;
        font-size: 1.5rem;
        font-weight: bold;
        color: #0055A4;
        border-bottom: 2px solid #EF4135;
        padding-bottom: 0.5rem;
    }
    table {
        background-color: white;
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 2rem;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th {
        background-color: #0055A4;
        color: white;
    }
    td {
        border: 1px solid #ccc;
        padding: 0.75rem;
        text-align: center;
    }
    .card {
        border: 1px solid #EF4135;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .card-title {
        color: #0055A4;
    }
    .btn-primary {
        background-color: #0055A4;
        border-color: #0055A4;
    }
    .btn-outline-secondary {
        border-color: #EF4135;
        color: #EF4135;
    }
    .btn-outline-secondary:hover {
        background-color: #EF4135;
        color: white;
    }
    .prestations-section {
        background-color: #ffffffdd;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.15);
        margin-bottom: 3rem;
        border-left: 6px solid #0055A4;
    }
    .login-prompt {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #EF4135cc;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        font-size: 1rem;
    }
</style>

<div class="container">
    <h1 class="mb-4 text-center text-white">Nos prestations</h1>

    @auth
        <p class="text-success">Bienvenue {{ Auth::user()->nom }} !</p>
    @else
        <p class="text-warning">Connectez-vous pour créer un devis personnalisé.</p>
    @endauth
    
    @if($user)
        pour {{ $user->nom }}
    @else
        (visiteur)
    @endif
</h1>

    <div class="row">
        @foreach($prestations as $prestation)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $prestation->titre }}</h5>
                        <p class="card-text">{{ $prestation->description }}</p>
                        <p class="card-text"><strong>Prix :</strong> {{ $prestation->prix }} €</p>

                        @auth
                            <a href="{{ route('devis.generer', ['prestation' => $prestation->id]) }}" class="btn btn-primary">Créer mon devis</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary">Se connecter pour créer un devis</a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="table-title">Maison à vendre</div>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>< 50m²</th>
                <th>< 100m²</th>
                <th>< 150m²</th>
                <th>< 200m²</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Amiante, Surface, Termites, DPE, ELEC, ERP</td><td>290€ TTC</td><td>390€ TTC</td><td>470€ TTC</td><td>550€ TTC</td></tr>
            <tr><td>Gaz cuisson</td><td>+40€</td><td>+40€</td><td>+40€</td><td>+40€</td></tr>
            <tr><td>Gaz chaudière</td><td>+50€</td><td>+50€</td><td>+50€</td><td>+50€</td></tr>
            <tr><td>Plomb (maison < 1949)</td><td>+50€</td><td>+90€</td><td>+130€</td><td>+170€</td></tr>
            <tr><td>Zone non habitable < 50m²</td><td>+70€ TTC</td><td>+70€ TTC</td><td>+70€ TTC</td><td>+70€ TTC</td></tr>
            <tr><td>Zone non habitable < 100m²</td><td>+100€ TTC</td><td>+100€ TTC</td><td>+100€ TTC</td><td>+100€ TTC</td></tr>
            <tr><td>Zone non habitable < 150m²</td><td>+130€</td><td>+130€</td><td>+130€</td><td>+130€</td></tr>
            <tr><td>Zone non habitable < 200m²</td><td>+160€</td><td>+160€</td><td>+160€</td><td>+160€</td></tr>
        </tbody>
    </table>

    <div class="table-title">Maison à louer</div>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>< 50m²</th>
                <th>< 100m²</th>
                <th>< 150m²</th>
                <th>< 200m²</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Amiante, Surface, Termites, DPE, ELEC, ERP</td><td>269€ TTC</td><td>350€ TTC</td><td>450€ TTC</td><td>490€ TTC</td></tr>
            <tr><td>Gaz cuisson</td><td>+40€</td><td>+40€</td><td>+40€</td><td>+40€</td></tr>
            <tr><td>Gaz chaudière</td><td>+30€</td><td>+30€</td><td>+30€</td><td>+30€</td></tr>
            <tr><td>Plomb (maison < 1949)</td><td>+50€</td><td>+80€</td><td>+110€</td><td>+140€</td></tr>
            <tr><td>Zone non habitable < 50m²</td><td>+70€ TTC</td><td>+70€ TTC</td><td>+70€ TTC</td><td>+70€ TTC</td></tr>
            <tr><td>Zone non habitable < 100m²</td><td>+100€ TTC</td><td>+100€ TTC</td><td>+100€ TTC</td><td>+100€ TTC</td></tr>
            <tr><td>Zone non habitable < 150m²</td><td>+130€ TTC</td><td>+130€ TTC</td><td>+130€ TTC</td><td>+130€ TTC</td></tr>
            <tr><td>Zone non habitable < 200m²</td><td>+160€ TTC</td><td>+160€ TTC</td><td>+160€ TTC</td><td>+160€ TTC</td></tr>
        </tbody>
    </table>

    <div class="prestations-section">
        <h3 class="text-center text-primary mb-4">Créer votre devis</h3>

        <form method="POST" action="{{ route('devis.calculer') }}">
            @csrf

            <fieldset class="mb-4">
                <legend class="fs-6 fw-bold text-danger">Type de bien</legend>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="typeBien" id="vente" value="vente" required>
                    <label class="form-check-label" for="vente">Maison à vendre</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="typeBien" id="location" value="location">
                    <label class="form-check-label" for="location">Maison à louer</label>
                </div>
            </fieldset>

            {{-- Prestations supplémentaires --}}
            <fieldset class="mb-4">
                <legend class="fs-6 fw-bold text-danger">Prestations supplémentaires</legend>
                @php $options = old('options', []); @endphp
                @foreach([
                    'gaz_cuisson' => 'Gaz cuisson',
                    'gaz_chaudiere' => 'Gaz chaudière',
                    'plomb' => 'Plomb (maison < 1949)',
                    'zone_non_habitable_50' => 'Zone non habitable < 50m²',
                    'zone_non_habitable_100' => 'Zone non habitable < 100m²',
                    'zone_non_habitable_150' => 'Zone non habitable < 150m²',
                    'zone_non_habitable_200' => 'Zone non habitable < 200m²'
                ] as $value => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="options[]" value="{{ $value }}" id="{{ $value }}"
                            {{ in_array($value, $options) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $value }}">{{ $label }}</label>
                    </div>
                @endforeach
            </fieldset>

            {{-- Surface --}}
            <fieldset class="mb-4">
                <legend class="fs-6 fw-bold text-danger">Surface du bien</legend>
                @foreach(['<50m²','<100m²','<150m²','<200m²'] as $surface)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="surface" id="surface{{ $loop->index }}" value="{{ $surface }}" required>
                        <label class="form-check-label" for="surface{{ $loop->index }}">Maison {{ $surface }}</label>
                    </div>
                @endforeach
            </fieldset>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Calculer le devis</button>
            </div>
        </form>
    </div>

    @guest
        <div class="login-prompt">
            Connectez-vous pour recevoir le devis par email
        </div>
    @endguest
</div>
@endsection
