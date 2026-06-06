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
    <body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- iOS-style header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ config('app.name', 'Gestion des incidents') }}</h1>
                <div class="mt-2 h-1 w-12 bg-green-500 rounded-full mx-auto"></div>
            </div>
            
            <!-- iOS-style card -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 md:p-8">
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <p class="text-center text-xs text-gray-400 mt-6">
                Gestion des incidents - Rabat
            </p>
        </div>
    </body>
</html>