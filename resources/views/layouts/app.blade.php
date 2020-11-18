<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        {{-- <script src="{{ asset('js/alpine.js') }}" defer></script> --}}
        
        {{-- <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
        <script type="text/javascript" src="{{ asset('js/mercadopago-function.js') }}" defer></script> --}}
    </head>
    <style type="text/css">
        .input-background {
          background-position: 98% 50%;
          background-repeat: no-repeat;
          background-color: #fff;
        }
    </style>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ strtoupper($header) }}
                    </h2>
                </div>
            </header>

            
            <!-- Page Content -->
            <main>
                <div class="container mx-auto px-4 py-4">
                {{ $slot }}
                </div>
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        
    </body>
</html>
