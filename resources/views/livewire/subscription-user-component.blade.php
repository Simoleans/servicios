<div class="py-12">
    @if($modalConfirmBaja)
        @include('servicios.modal.baja-confirm')
    @endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-2 border-white">
            @if (session()->has('message'))
                <div class="bg-green-600 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                    <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
                </div>
            @endif
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center border-b border-gray-900 dark:border-white py-2 w-full">
                    <input wire:model.debounce.300ms="search" class="appearance-none bg-transparent border-none w-full text-gray-700 dark:text-white mr-3 pb-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Buscar" aria-label="Buscar">
                    <div class="pr-7">
                        <div  wire:loading wire:target="search"  class="spinner"></div>
                    </div>
                </div>
                @if($subscriptions->count())
                    <div class="md:grid md:grid-cols-2 grid grid-cols-1 mt-3 gap-4">
                        @foreach($subscriptions as $s)
                            <div class="flex flex-col md:flex-row w-full bg-white dark:bg-gray-800 border-2 border-white shadow-lg rounded-lg overflow-hidden">
                                <div class="md:hidden">
                                    <img alt="Placeholder" class="block h-auto w-full" src="{{asset('storage/'.$s->servicio->foto)}}">
                                </div> 
                                <div class="w-1/3" style="background-image: url('{{asset('storage/'.$s->servicio->foto)}}')">
                                </div> 
                                <div class="md:w-2/3 p-4">
                                    <h1 class="text-gray-900 font-bold text-xl dark:text-white"> {{ $s->servicio->nombre }}</h1>
                                    <p class="mt-2 text-gray-600 text-sm dark:text-white"> {{ $s->servicio->descripcion_corta }}</p>
                                    
                                    <div class="flex item-center flex-row-reverse mt-3 gap-3">
                                    @if(!auth()->user()->serviceExpired($s->servicio->id))
                                    <a href="{{ route('my-store',$s->servicio->slug) }}" class="mt-3 btn-buy-services  transform hover:-translate-y-1 motion-reduce:transition-none hover:scale-110 motion-reduce:transform-none hover:bg-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        Ver
                                    </a>
                                    @endif
                                    <a href="{{ route('servicio.renovar.show',$s->servicio->slug) }}" class="mt-3 btn-renovar-services  transform hover:-translate-y-1 motion-reduce:transition-none hover:scale-110 motion-reduce:transform-none hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                        </svg>
                                        Renovar
                                    </a>
                                    </div>
                                    <div class="flex item-center flex-row-reverse mt-3 gap-3">
                                    <button wire:click="confirmBaja({{ $s->id }})" class="mt-3 cursor-pointer text-white hover:text-red-800 bg-yellow-400 dark:text-black flex-1 rounded-md py-2 text-center font-semibold hover:bg-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        Darse de baja
                                        </button>
                                    </div>
                                </div>
                                </div>
                        @endforeach
                    </div>
                    <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6 dark:bg-gray-800">
                        {{ $subscriptions->links() }}
                    </div>
                    @else
                    <div class="bg-white px-4 py-3 border-t dark:bg-gray-800 border-gray-200 sm:px-6 dark:text-white">
                    No Hay Resultados para la busqueda {{$this->search}}, compra un servicio/producto <a href="{{ route('dashboard') }}" class="text-blue-500 font-bold">Aquí</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div> 

