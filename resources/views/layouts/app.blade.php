<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <meta name="csrf-token" content="{{ csrf_token() }}">
       

        <title>{{ nameApp() }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ asset(faviconApp()) }}" type="image/x-icon"/>


        @livewireStyles

        <!-- Scripts -->
        
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        {{-- <script src="{{ asset('js/alpine.js') }}" defer></script> --}}
        
        <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js" defer></script>
        <script type="text/javascript" src="{{ asset('js/mercadopago-function.js') }}" defer></script>
    </head>
    <style type="text/css">
        .input-background {
          background-position: 98% 50%;
          background-repeat: no-repeat;
          background-color: #fff;
        }
        [x-cloak] { display: none; }
    </style>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-800" x-data="dark()" x-init="init()">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-500 shadow">
                <div class=" flex justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold dark:text-white text-xl text-gray-800 leading-tight capitalize">
                        {{ $header }}
                    </h2>
                     <button class="p-1 rounded bg-gray-200" @click="activateDArkMode">
                        <svg class="w-6 h-6 text-black dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>
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
    <script>
         function dark()
        {
            return {
                init() {
                    if (localStorage.theme === 'dark' || (!'theme' in localStorage && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        checkedDarkMode = true;
                        document.querySelector('html').classList.add('dark')
                    } else if (localStorage.theme === 'dark') {
                        checkedDarkMode = false;
                        document.querySelector('html').classList.add('dark')
                    }
                },
                activateDArkMode() {
                    let htmlClasses = document.querySelector('html').classList;
        
                    if(localStorage.theme == 'dark') {
                      checkedDarkMode = false;
                        htmlClasses.remove('dark');
                        localStorage.removeItem('theme')
                    } else {
                      checkedDarkMode = true;
                        htmlClasses.add('dark');
                        localStorage.theme = 'dark';
                    }
                }
            }
        }
    </script>
</html>
