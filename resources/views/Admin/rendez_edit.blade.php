@extends('layouts.app')

@section('content')

<h2>Modifier le rendez-vous</h2>

<form action="{{ route('admin.rendezvous.update', $rdv->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Date :</label>
    <input type="datetime-local" name="date" value="{{ $rdv->date->format('Y-m-d\TH:i') }}">

    <label>Zone :</label>
    <input type="text" name="zone" value="{{ $rdv->zone }}">

    <label>Heures de travail :</label>
    <input type="number" name="travail_heure" value="{{ $rdv->travail_heure }}">

    <button type="submit">Mettre à jour</button>
</form>

@endsection

