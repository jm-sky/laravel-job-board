<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="/fontawesome/css/solid.min.css" rel="stylesheet">

    <!-- Scripts -->
    @production
        {{ vite_assets() }}
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endproduction
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>

</html>
