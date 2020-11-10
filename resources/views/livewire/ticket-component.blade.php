<div class="py-12" x-data="{show : false}" x-init="show = false" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button x-on:click="show = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Ticket</button>
           
            @include('ticket.modal.create')
           
              <div class="flex items-center border-b border-gray-900 py-2 w-full">
                <input wire:model.debounce.300ms="search" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 pb-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Buscar" aria-label="Buscar">
                <div class="pr-7">
                  <div  wire:loading wire:target="search" class="spinner"></div>
                </div>
              </div>
            {{-- <input class="form-input rounded-md shadow-sm mt-1 block" type="text" wire:model.debounce.500ms="search" placeholder="Buscar"> --}}
           
              
            
            @if($tickets->count())
              <div class="md:grid grid-cols-3 mt-3 gap-4">
                @foreach($tickets as $t)
                  <div class="wrapper max-w-xs bg-gray-50 rounded-b-md shadow-lg mb-2">
                     <div>
                        <img class="object-cover h-60 w-full" src="{{asset('storage/'.$t->foto)}}" alt="montaña" />
                     </div>
                     <div class="p-3 space-y-3">
                        <h3 class="text-gray-700 font-semibold text-md">
                           {{ $t->nombre }}
                        </h3>
                        <p class="text-sm text-gray-900 leading-sm">
                           {{ $t->descripcion_larga }}
                        </p>
                     </div>
                     <div class=" pt-4 pb-2">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">${{ $t->precio_normal }}</span>
                      </div>
                     <div class="grid grid-cols-2">
                        <a class="bg-teal-600 justify-center py-2 text-center text-white font-semibold transition duration-300 hover:bg-teal-500" href="{{ route('servicio.show',$t->id) }}">
                            Agregar Producto
                        </a>
                        <button class="bg-red-600 justify-center py-2 text-white font-semibold transition duration-300 hover:bg-red-500">
                            Eliminar
                        </button>
                     </div>
                  </div>
                @endforeach
              </div>
            <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
              {{ $tickets->links() }}
            </div>
            @else
              <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                No Hay Resultados para la busqueda {{$search}}
              </div>
            @endif
        </div>
    </div>
  </div>
  
  
  
  