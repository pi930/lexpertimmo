@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">✏️ Modifier le message</h2>

    <form action="{{ route('messages.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Sujet</label>
            <input type="text" name="sujet" value="{{ old('sujet', $contact->sujet) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Message</label>
            <textarea name="message" rows="5"
                      class="w-full border rounded px-3 py-2">{{ old('message', $contact->message) }}</textarea>
        </div>

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            💾 Enregistrer
        </button>
    </form>
</div>
@endsection