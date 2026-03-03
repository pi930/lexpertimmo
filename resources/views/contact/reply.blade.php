@extends('layouts.app')

@section('title', 'Répondre à un message – Lexpertimmo')

@section('content')
<div class="max-w-3xl mx-auto mt-10">

    {{-- Carte principale --}}
    <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">

        {{-- En-tête --}}
        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-gray-800 flex items-center gap-3">
                <span class="bg-blue-600 text-white w-10 h-10 flex items-center justify-center rounded-full text-lg font-bold">
                    {{ strtoupper(substr($user->nom, 0, 1)) }}
                </span>
                Répondre à {{ $user->nom }}
            </h2>
            <p class="text-gray-500 text-sm mt-1">
                Vous êtes sur le point d’envoyer une réponse à ce message.
            </p>
        </div>

        {{-- Message original --}}
        <div class="mb-6">
            <span class="font-semibold text-gray-900 block mb-1">Message original :</span>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 leading-relaxed text-gray-700">
                {{ $message->contenu }}
            </div>
        </div>

        {{-- Formulaire de réponse --}}
        <form action="{{ route('send.reply', $message->id) }}" method="POST" class="space-y-4">
            @csrf

            <input type="hidden" name="contact_id" value="{{ $message->id }}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="admin" value="{{ $admin }}">

            <div>
                <label class="font-semibold text-gray-800 mb-1 block">Votre réponse</label>
                <textarea
                    name="reponse"
                    rows="6"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="Écrivez votre réponse ici..."
                ></textarea>
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition"
            >
                Envoyer la réponse
            </button>
        </form>

        {{-- Retour --}}
        <div class="mt-6">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
                ← Retour
            </a>
        </div>

    </div>
</div>
@endsection
