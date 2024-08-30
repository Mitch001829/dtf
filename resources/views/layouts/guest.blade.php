<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="class">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pasig DTF') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>

        <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
        <link rel="stylesheet" href="{{ asset('vendor/validate-password-requirements/css/jquery.passwordRequirements.css') }}">
        <script src="{{ asset('vendor/validate-password-requirements/js/jquery.passwordRequirements.min.js') }}"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>

        
    </head>
    
    
   
    <body class="font-sans text-gray-900 antialiased"> 
        
        <x-head-navigation />
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            
           
            <div>
                <a href="/">
                    <div>
                        <x-login-logo  />
                    </div>
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-120 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
                
            </div>
        </div>
        
    </body>
</html>
