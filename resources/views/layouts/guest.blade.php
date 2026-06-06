<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gestion des incidents') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="site-header">
            <div class="container">
                <h1>{{ config('app.name', 'Gestion des incidents') }}</h1>
            </div>
        </header>

        <main class="container" style="max-width: 500px; margin-top: 24px;">
            <div class="card">
                {{ $slot }}
            </div>
        </main>
    </body>
</html>
