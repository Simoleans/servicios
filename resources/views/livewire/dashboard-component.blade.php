<div>
    <h1 class="font-extrabold text-5xl mx-1 my-1 text-center">SERVICIOS DISPONIBLES</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                        <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                    </div>
                @endif
               {{--  <x-jet-welcome /> --}}
                {{-- <x-form-mercado-pago></x-form-mercado-pago> --}}
                <div class="container mx-auto px-4 py-4">
                    <div class="flex items-center border-b border-gray-900 py-2 w-full">
                        <input wire:model.debounce.300ms="search" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 pb-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Buscar" aria-label="Buscar">
                        <div class="pr-7">
                          <div  wire:loading wire:target="search"  class="spinner"></div>
                        </div>
                    </div>
                    <x-servicios-dashboard :servicios="$servicios" :productos="$productos"/>
                </div>
            </div>
        </div>
    </div> 
    <h1 class="font-extrabold text-5xl mx-1 my-1 text-center">PRODUCTOS DISPONIBLES</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               
               {{--  <x-jet-welcome /> --}}
                {{-- <x-form-mercado-pago></x-form-mercado-pago> --}}
                <div class="container mx-auto px-4 py-4">
                    <div class="flex items-center border-b border-gray-900 py-2 w-full">
                        <input wire:model.debounce.300ms="searchProducto" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 pb-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Buscar" aria-label="Buscar">
                        <div class="pr-7">
                          <div  wire:loading wire:target="searchProducto"  class="spinner"></div>
                        </div>
                    </div>
                    <x-productos-dashboard :productos="$productos" :servicios="$servicios"/>
                </div>
            </div>
        </div>
    </div> 
</div>

