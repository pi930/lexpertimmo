@extends('layouts.app')

@section('title', 'Message envoyé – Lexpertimmo')

@section('content')
<div class="max-w-4xl mx-auto mt-10">

    {{-- Carte principale --}}
    <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">

        {{-- En-tête --}}
        <div class="flex items-center gap-4 mb-6">
            <div class="bg-blue-600 text-white w-12 h-12 flex items-center justify-center rounded-full text-xl font-bold">
                {{ strtoupper(substr($contact->nom, 0, 1)) }}
            </div>

            <div>
                <h2 class="text-3xl font-semibold text-gray-800">
                    Message de {{ $contact->nom }}
                </h2>
                <p class="text-gray-500 text-sm">
                    Reçu via le formulaire de contact
                </p>
            </div>
        </div>

        {{-- Informations --}}
        <div class="space-y-4 text-gray-700">

            <p>
                <span class="font-semibold text-gray-900">Email :</span>
                {{ $contact->email }}
            </p>

            <p>
                <span class="font-semibold text-gray-900">Adresse :</span>
                {{ $contact->rue }},
                {{ $contact->code_postal }}
                {{ $contact->ville }},
                {{ $contact->pays }}
            </p>

            <p>
                <span class="font-semibold text-gray-900">Sujet :</span>
                {{ $contact->sujet }}
            </p>

            <div>
                <span class="font-semibold text-gray-900 block mb-1">Message :</span>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 leading-relaxed">
                    {{ $contact->message }}
                </div>
            </div>

        </div>

        {{-- Bouton retour --}}
        <div class="mt-8">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
                ← Retour
            </a>
        </div>

    </div>
</div>
@endsection
