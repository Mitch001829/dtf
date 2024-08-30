<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="class">
    
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
                if (localStorage.getItem('darkMode') === 'true') {
                    document.documentElement.classList.add('dark');
                }
            });
    </script>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
        <title>{{ config('app.name', 'Dengue Task Force') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

         <!-- Scripts -->
        

         
            
         <!-- Bladewind UI -->
         <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
         <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
         <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
         
         <script src="//unpkg.com/alpinejs" defer></script>
         <link rel="stylesheet" href="{{ asset('css/component.css') }}" />

        <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>


        <!-- DISABLING VITE CDN AND USING TAILWIND CDN | If you have nodejs install you can use vite instead for faster development -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>

        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>

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
                @if($errors->any())
                    <div class="z-1 notif-banner alert alert-error bg-red-300 text-center fixed py-2 w-full px-5 text-white font-bold">
                        <p>Error: Please check the form for errors</p>
                    </div>
                @endif


                @if(session('error'))
                    <div class="notif-banner alert alert-error bg-red-300 text-center fixed py-2 w-full px-5 text-white font-bold">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('warning'))
                    <div class="notif-banner alert alert-warning bg-orange-300 text-center py-2 fixed w-full px-5 text-white font-bold">
                        {{ session('warning') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="notif-banner alert alert-success bg-green-300 text-center py-2 fixed w-full px-5 text-white font-bold">
                        {{ session('success') }}
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
        <footer>
            <div class="flex-1">
                <p class="text-center p-3">Pasig Dengue Task Force ©Copyright 2024-2025</p>
              </div>
        </footer>
    </body>

    <script>
        $(document).ready(function() {
            $('.bw-table').DataTable({
                searching: true,
                compact: true,
                columnDefs: [
                {
                    targets: '_all',
                    render: function(data, type, row, meta) {
                        // Exclude the last column (meta.col == row.length - 1)
                        if (type === 'display' && meta.col !== row.length - 1 && data.length > 20) {
                            return data.substr(0, 20) + '...';
                        }
                        return data;
                    }
                },
                    {
                        targets: -1,
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        width: '150px'
                    }
                ]
            });
        });
        
        setTimeout(() => {
            $('.notif-banner').fadeOut();
        }, 2000);

    </script>
</html>
