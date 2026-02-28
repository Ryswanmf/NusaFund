<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/nusafac.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-zinc-900 antialiased bg-zinc-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-zinc-50 dark:bg-zinc-950 px-4">
            <div class="mb-6">
                <a href="/" class="flex items-center gap-2 group transition">
                    <span class="text-3xl font-bold tracking-tight text-maroon-800 dark:text-white">Nusa<span class="text-amber-500 font-extrabold">Fund</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white dark:bg-zinc-900 shadow-2xl shadow-maroon-900/5 overflow-hidden rounded-[1.5rem] border border-zinc-100 dark:border-zinc-800">
                <div class="px-6 py-8">
                    {{ $slot }}
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-sm text-zinc-400 font-medium tracking-wide uppercase">&copy; 2026 NusaFund Indonesia</p>
            </div>
        </div>
    </body>
</html>
