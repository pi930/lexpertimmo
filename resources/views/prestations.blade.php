@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, red, white, blue);
        min-height: 100vh;
        padding-bottom: 100px;
    }
    .table-title {
        margin-top: 2rem;
        font-size: 1.5rem;
        font-weight: bold;
    }
    table {
        background-color: white;
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 2rem;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
        border: 1px solid #ccc;
        padding: 0.75rem;
        text-align: center;
    }
    .prestations-section {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 3rem;
    }
    .prestations-section h3 {
        margin-bottom: 1rem;
    }
    .prestations-section .form-check {
        margin-bottom: 0.5rem;
    }
    .login-prompt {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #ffffffcc;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        font-size: 1rem;
    }
</style>

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
</hr>
</hr>
</hr>

   <div class="prestations-section">
    <h3>Prestations</h3>
    <form method="POST" action="{{ route('devis.calculer') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Type de bien :</label><br>
            <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="typeBien" id="vente" value="vente" required>
                     {{ in_array('vente', old('options', [])) ? 'checked' : '' }}>

                <label class="form-check-label" for="vente">Maison à vendre</label>
            </div>
</hr>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="typeBien" id="location" value="location">
                 {{ in_array('location', old('options', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="location">Maison à louer</label>
            </div>
        </div>
</hr>
        <div class="mb-3">
    <label class="form-label">Prestations supplémentaires :</label><br>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="gaz_cuisson" id="gaz_cuisson">
        {{ in_array('gaz_cuisson', old('options', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="gaz_cuisson">Gaz cuisson</label>
</div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="gaz_chaudiere" id="gaz_chaudiere">
        {{ in_array('gaz_chaudiere', old('options', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="gaz_chaudiere">Gaz chaudière</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="plomb" id="plomb">
          {{ in_array('plmob', old('options', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="plomb">Plomb (maison < 1949)</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="zone_non_habitable_50" id="zone_non_habitable_50">
         {{ in_array('zone_non_habitable_50', old('options', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="zone_non_habitable_50">Zone non habitable < 50m²</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="zone_non_habitable_100" id="zone_non_habitable_100">
        {{ in_array('zone_non_habitable_100', old('options', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="zone_non_habitable_100">Zone non habitable < 100m²</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="zone_non_habitable_150" id="zone_non_habitable_150">
        {{ in_array('zone_non_habitable_150', old('options', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="zone_non_habitable_150">Zone non habitable < 150m²</label>
    </div>
</hr>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="options[]" value="zone_non_habitable_200" id="zone_non_habitable_200">
         {{ in_array('zone_non_habitable_200', old('options', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="zone_non_habitable_200">Zone non habitable < 200m²</label>
    </div>
</div>
</hr>

        <div class="mb-3">
            <label class="form-label">Surface :</label><br>
            @foreach(['<50m²','<100m²','<150m²','<200m²'] as $surface)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="surface" id="surface{{ $loop->index }}" value="{{ $surface }}" required>
                    <label class="form-check-label" for="surface{{ $loop->index }}">Maison {{ $surface }}</label>
                </div>
            @endforeach
        </div>
</hr>
</hr>

        <button type="submit" class="btn btn-primary">Calculer</button>
    
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