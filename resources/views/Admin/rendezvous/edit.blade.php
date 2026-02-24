@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <h1 class="text-2xl font-semibold mb-4">✏️ Modifier le rendez-vous</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded">
            <ul class="list-disc ml-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rendezvous.update', $rdv->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Date</label>
            <input type="date" name="date" value="{{ $rdv->date }}"
                   class="border p-2 w-full rounded">
        </div>

        <div>
            <label class="block font-medium">Zone</label>
            <input type="text" name="zone" value="{{ $rdv->zone }}"
                   class="border p-2 w-full rounded">
        </div>

        <div>
            <label class="block font-medium">Heures de travail</label>
            <input type="number" name="travail_heure" value="{{ $rdv->travail_heure }}"
                   class="border p-2 w-full rounded" min="1">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Mettre à jour
        </button>
    </form>

    <div class="mt-6">
        <a href="{{ route('admin.rendezvous') }}" class="text-blue-600 hover:underline">
            ⬅️ Retour à la liste des rendez-vous
        </a>
    </div>

</div>
@endsection

