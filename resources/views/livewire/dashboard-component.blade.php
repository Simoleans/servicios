<div x-data="{open : true,openExpired : true}">
    @if(count(auth()->user()->closestEndSubscription()) > 0)
        <div x-show.transition.duration.900ms.scale.0="open" class="bg-teal-lightest border-t-4 border-teal rounded-b text-teal-darkest px-4 py-3 shadow-md my-2 bg-orange-400 border-orange-600" role="alert">
            <div class="flex justify-between">
                <svg class="h-6 w-6 text-teal mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
                <div class="flex-1">
                    <p class="font-bold">{{ auth()->user()->name }} Tienes {{ count(auth()->user()->closestEndSubscription()) }} servicio(s) a punto de expirar.</p>
                    @foreach(auth()->user()->closestEndSubscription() as $v)
                        <p class="text-sm">- {{ $v['nombre'] }}
                            <a href="{{ route('servicio.renovar.show',$v['slug']) }}" class="text-blue-500 font-medium mt-2">Renovar</a>
                        </p>
                    @endforeach
                    <a href="{{ route('my-subscriptions') }}" class="text-blue-500 font-medium mt-2">Ver Todo</a>
                </div>
                <svg class="h-6 w-6 text-red"  @click="open = false" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </div>
        </div>
        {{-- {{ dd(auth()->user()->closestEndSubscription()) }} --}}
      @endif
      {{-- {{ dd(auth()->user()->ownsTeam(auth()->user()->currentTeam))  }} --}}
      {{-- {{ dd(auth()->user()->rol())  }} --}}
      {{-- {{ dd(auth()->user()->expiredSubscription()) }} --}}
      @if(count(auth()->user()->expiredSubscription()) > 0)
        <div x-show.transition.duration.900ms.scale.0="openExpired" class="bg-teal-lightest border-t-4 border-teal rounded-b text-teal-darkest px-4 py-3 shadow-md my-2 bg-red-400 border-red-600" role="alert">
            <div class="flex justify-between">
                <svg class="h-6 w-6 text-teal mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
                <div class="flex-1">
                    <p class="font-bold">{{ auth()->user()->name }} Tienes {{ count(auth()->user()->expiredSubscription()) }} servicio(s) vencidos.</p>
                    @foreach(auth()->user()->expiredSubscription() as $v)
                        <p class="text-sm">- {{ $v['nombre'] }}
                            <a href="{{ route('servicio.renovar.show',$v['slug']) }}" class="text-blue-500 font-medium mt-2">Renovar</a>
                        </p>
                    @endforeach
                </div>
                <svg class="h-6 w-6 text-red"  @click="openExpired = false" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </div>
        </div>
      @endif
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

