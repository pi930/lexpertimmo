<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Application')</title>

    {{-- Chargement des styles et scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">

    {{-- Inclusion du menu de navigation --}}
    @include('dashboard.menu')

    {{-- Contenu principal --}}
    <main class="max-w-7xl mx-auto px-6 py-8">
        @yield('content')
    </main>

    </body>
</html>
