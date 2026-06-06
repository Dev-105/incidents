<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Gestion des incidents') }}</title>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
                -webkit-font-smoothing: antialiased;
            }
        </style>
    </head>
    <body class="bg-gray-50">
        @include('layouts.navigation')
        
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-20">
            {{ $slot }}
        </main>
        
        <footer class="fixed bottom-0 left-0 right-0 bg-white/80 backdrop-blur-md border-t border-gray-100 py-4 text-center text-xs text-gray-500">
            Gestion des incidents - Rabat
        </footer>
    </body>
</html>