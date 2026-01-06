<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Application')</title>

    {{-- Styles & Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

    {{-- Bandeau tricolore --}}
    <div class="w-full flex h-2">
        <div class="flex-1 bg-blue-600"></div>
        <div class="flex-1 bg-white"></div>
        <div class="flex-1 bg-red-600"></div>
    </div>

    {{-- Menu de navigation --}}
    @include('dashboard.menu')

    {{-- Contenu principal --}}
    <main class="max-w-7xl mx-auto px-6 py-8">
        @yield('content')
    </main>

</body>
</html>

