<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} – Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show"
             class="mb-4 p-4 rounded bg-blue-100 border border-blue-300 text-blue-800 relative">
            {{ session('success') }}
            <button @click="show = false"
                    class="absolute top-2 right-2 text-blue-600 hover:text-red-600 font-bold text-lg leading-none">
                &times;
            </button>
        </div>
    @endif

    <div class="min-h-screen flex flex-col justify-center items-center py-6">
        <div class="w-full max-w-md bg-white shadow-md rounded px-6 py-8">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
