<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'VISIONBF CRM') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-100 antialiased bg-slate-950 selection:bg-amber-500 selection:text-slate-950">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-950">
            <div>
                <a href="/">
                    <div class="p-2 bg-slate-900 rounded-full border-2 border-amber-500/80 shadow-lg shadow-amber-500/10 hover:border-amber-400 transition">
                        <img src="{{ asset('images/logo.png') }}" alt="VISIONBF" class="h-20 w-20 rounded-full object-cover" />
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-slate-900 border border-amber-500/20 shadow-2xl shadow-amber-500/5 sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>