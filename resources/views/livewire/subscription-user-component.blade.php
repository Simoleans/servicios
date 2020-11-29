<div>
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
                <div class="container mx-auto px-4 py-4">
                    <div class="flex items-center border-b border-gray-900 py-2 w-full">
                        <input wire:model.debounce.300ms="search" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 pb-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Buscar" aria-label="Buscar">
                        <div class="pr-7">
                          <div  wire:loading wire:target="search"  class="spinner"></div>
                        </div>
                    </div>
                    @if($subscriptions->count())
                        <div class="md:grid md:grid-cols-4 grid grid-cols-1 mt-3 gap-4">
                            @foreach($subscriptions as $s)
                                <!-- Article -->
                                <article class="inline overflow-hidden rounded-md shadow-xl mt-4 sm:mt-5 md:mt-4">
                                    <a href="#">
                                        <img alt="Placeholder" class="block h-auto w-full" src="{{asset('storage/'.$s->servicio->foto)}}">
                                    </a>
                                    <div class="flex items-center  flex-col justify-between leading-tight p-2 md:p-4">
                                        <h1 class="text-lg">
                                            <a class="no-underline hover:underline text-black ">
                                            {{ $s->servicio->nombre }}
                                            </a>
                                        </h1>
                                        <p class="text-grey-darker text-lg mt-5">
                                            Vencimiento
                                        </p>
                                        <p class="text-grey-darker text-2xl text-red-400 mb-4">
                                            {{ $s->end_date->format('d-m-Y') }}
                                        </p>
                                        <p class="text-grey-darker text-sm text-green-400 mb-4">
                                            Tienes {{ $s->servicio->productos->count() }} productos en oferta
                                        </p>
                                        <a href="{{ route('my-store',$s->servicio->slug) }}" class="mt-3 btn-buy-services  transform hover:-translate-y-1 motion-reduce:transition-none hover:scale-110 motion-reduce:transform-none hover:bg-blue-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                            Ver
                                        </a>
                                        <p class="text-sm text-gray-900 leading-sm mt-6">
                                            {{ $s->servicio->descripcion_larga }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
                            {{ $subscriptions->links() }}
                        </div>
                     @else
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        No Hay Resultados para la busqueda {{$this->search}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> 
</div>

