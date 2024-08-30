<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
        <title>{{ config('app.name', 'Dengue Task Force') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

         <!-- Scripts -->
        

         <!-- DISABLING VITE CDN AND USING TAILWIND CDN | If you have nodejs install you can use vite instead for faster development-->
         <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
         <script src="https://cdn.tailwindcss.com"></script>

         <!-- Bladewind UI -->
         <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
         <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
         <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
         
         <script src="//unpkg.com/alpinejs" defer></script>
         <link rel="stylesheet" href="{{ asset('css/component.css') }}" />

        <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')
           
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-2 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
                
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
