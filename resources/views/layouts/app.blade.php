<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            #page-loader { transition: opacity 0.3s ease-out, visibility 0.3s; }
            .loader-progress {
                width: 0; height: 3px; position: fixed; top: 0; left: 0; z-index: 10000;
                background: linear-gradient(to right, #800000, #b91c1c);
                box-shadow: 0 0 10px rgba(128, 0, 0, 0.5);
                transition: width 0.4s ease-out;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Page Loader -->
        <div id="page-loader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm">
            <div class="loader-progress" id="loader-progress"></div>
            <div class="flex flex-col items-center gap-5">
                <div class="relative">
                    <div class="w-12 h-12 border-4 border-maroon-100 dark:border-maroon-900/30 rounded-xl rotate-45"></div>
                    <div class="absolute inset-0 w-12 h-12 border-t-4 border-maroon-800 rounded-xl rotate-45 animate-spin"></div>
                </div>
            </div>
        </div>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loader = document.getElementById('page-loader');
                const progress = document.getElementById('loader-progress');
                if (progress) {
                    progress.style.width = '40%';
                    setTimeout(() => { progress.style.width = '100%'; }, 100);
                }
                window.addEventListener('load', function() {
                    setTimeout(() => {
                        if (loader) {
                            loader.style.opacity = '0';
                            loader.style.visibility = 'hidden';
                        }
                    }, 200);
                });
                document.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', function(e) {
                        const href = this.getAttribute('href');
                        if (href && !href.startsWith('#') && !href.startsWith('javascript') && this.target !== '_blank' && !e.ctrlKey && !e.metaKey) {
                            if (loader) {
                                loader.style.opacity = '1';
                                loader.style.visibility = 'visible';
                                if (progress) progress.style.width = '0%';
                                setTimeout(() => { if (progress) progress.style.width = '70%'; }, 10);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>
