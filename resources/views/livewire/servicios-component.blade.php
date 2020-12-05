
<div class="py-12"  x-data="servicios()"
                    x-init="() => {
                      window.addEventListener('show', event => {
                        showCreate = false;
                      })  
                      window.addEventListener('index', event => {
                          index = false;
                      }) 
                      window.addEventListener('editShow', event => {
                        show = event.detail.show;
                    })            
                    }"
                    >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-show=" index == true" 
                                                  x-transition:enter="ease-out duration-300"
                                                  x-transition:enter-start="opacity-0"
                                                  x-transition:enter-end="opacity-100"
                                                  x-transition:leave="ease-in duration-200"
                                                  x-transition:leave-start="opacity-100"
                                                  x-transition:leave-end="opacity-0">
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
            <button x-on:click="showCreate = true" x-show="showCreate == false" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Servicio</button>
            <button x-on:click="showCreate = false" x-cloak x-show="showCreate == true" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-3">Cerrar Formulario</button>

            @include('servicios.create')
              <div class="flex items-center border-b border-gray-900 py-2 w-full">
                <input wire:model.debounce.300ms="search" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 pb-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Buscar por Nombre" aria-label="Buscar">
                <div class="pr-7">
                  <div  wire:loading wire:target="search"  class="spinner"></div>
                </div>
              </div>
             
            @if($servicios->count())
              <div class="md:grid grid-cols-3 mt-3 gap-4">
                @foreach($servicios as $s)
                  <div class="wrapper max-w-xs bg-gray-50 rounded-b-md shadow-lg mb-2">
                     <div>
                        <img class="object-cover h-60 w-full" src="{{asset('storage/'.$s->foto)}}" alt="{{ $s->slug }}" />
                     </div>
                     <div class="p-3 space-y-3">
                        <h3 class="text-gray-700 font-semibold text-md">
                           {{ $s->nombre }}
                        </h3>
                        <p class="text-sm text-gray-900 leading-sm">
                           {{ $s->descripcion_larga }}
                        </p>
                     </div>
                     <div class=" pt-4 pb-2">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">${{ $s->precio_normal }}</span>
                      </div>
                     <div class="grid grid-cols-2">
                        <a class="bg-teal-600 justify-center py-2 text-center text-white font-semibold transition duration-300 hover:bg-teal-500" href="{{ route('servicio.show',$s->id) }}">
                            Agregar Producto
                        </a>
                        <button wire:click="delete({{ $s->id }})" class="bg-red-600 justify-center py-2 text-white font-semibold transition duration-300 hover:bg-red-500">
                            Eliminar
                        </button>
                        <button wire:click="edit({{ $s->id }})"  wire:loading.attr="disabled" class="bg-green-400 col-span-2 justify-center py-2 text-white font-semibold transition duration-300 hover:bg-green-300">
                          Editar
                      </button>
                     </div>
                  </div>
                @endforeach
              </div>
            <div class="bg-white px-4 py-3 border-t mt-4 border-gray-200 sm:px-6">
              {{ $servicios->links() }}
            </div>
            @else
              <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                No Hay Resultados para la busqueda {{$search}}
              </div>
            @endif
        </div>
    </div>
    @include('servicios.edit')
  </div>

  <script>
     
      function servicios()
      {
        return {
          showCreate : false,
          index : true,
          show : false,
          editCiclo : false,
          deleteInpu(index) {
            this.inputs.splice(index, 1);
          }
        }
      }
  </script>
  
  
  
  