<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @production
            {{ vite_assets() }}
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endproduction
    </head>
    <body class="font-sans antialiased">
        <div class="fonts-sans text-gray-900 antialiased">
            <x-header></x-header>
            {{ $slot }}
            <x-footer></x-footer>
        </div>
    </body>
</html>
