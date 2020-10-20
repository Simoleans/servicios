<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               {{--  <x-jet-welcome /> --}}
                {{-- <x-form-mercado-pago></x-form-mercado-pago> --}}
                <div class="container mx-auto px-4 py-4">
                    <div class="grid grid-cols-4 gap-4 grid-rows-2">
                        <div class="bg-blue-200">a</div>
                        <div class="bg-blue-300">b</div>
                        <div class="bg-blue-400 col-span-2 row-span-2">c</div>
                        <div class="bg-blue-500">d</div>
                        <div class="bg-blue-600">e</div>
                    </div>
                    <br>
                    <br>
                    <div class="grid grid-flow-col grid-rows-1">
                        <div class="bg-blue-100">1</div>
                        <div class="bg-blue-200">2</div>
                        <div class="bg-blue-300">3</div>
                        <div class="bg-blue-400">4</div>
                        <div class="bg-blue-500">5</div>
                        <div class="bg-blue-600">6</div>
                        <div class="bg-blue-700">7</div>
                        <div class="bg-blue-800">8</div>
                        <div class="bg-blue-900">9</div>
                    </div>
                    <br>
                    <br>
                    <h1 class="font-sans text-3xl font-black">Este es un titulo de prueba</h1>
                    <p class="font-serif">akhkdhgkdsdjdhkds</p>
                    <ul>
                        <li class="font-mono text-sm italic">elemento 1</li>
                        <li class="font-mono text-sm italic">Elemento 2</li>
                        <li class="font-mono text-sm italic">Elemento 3</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
    
</x-app-layout>
